<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PayController extends Controller
{
    public function bayar(Request $request)
    {
        $pelanggan = Pelanggan::where('user_id', auth()->id())->first();

        $transaksi = Transaksi::create([
            'pelanggan_id' => $pelanggan->id,
            'email' => $pelanggan->email,
            'total_bayar' => 23000,
            'valid' => '',
            'status' => 'PENDING',
        ]);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $transaksi->valid = $transaksi->id . "-" . time();

        $params = [
            'transaction_details' => [
                'order_id' => $transaksi->valid,
                'gross_amount' => 23000,
            ],
            'customer_details' => [
                'first_name' => $pelanggan->nama,
                'email' => $pelanggan->user->email,
                'phone' => $pelanggan->no_hp,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $transaksi->snap_token = $snapToken;
        $transaksi->save();

        return redirect()->route('berhasil', $transaksi->id);

    }

    public function berhasil($id)
    {
        $bayar = Transaksi::where('id', $id)->first();
        return view('user.berhasil', compact('bayar'));
    }

    public function tagihan(Transaksi $transaksi)
    {
        // $transaksi = Transaksi::where('pelanggan_id', auth()->user()->pelanggan->id)->get();
        // dd($transaksi);
        return view('user.tagihan', compact('transaksi'));
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $our_key = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($our_key == $request->signature_key) {
            if ($request->transaction_status == 'capture' or $request->transaction_status == 'settlement') {
                $log = fopen("log_sementara.txt", "w");

                fwrite($log, $request);

                fclose($log);
                $transaksi = Transaksi::where('valid', $request->order_id)->first();
                $transaksi->status = 'SUCCESS';
                $transaksi->save();
            } else if ($request->transaction_status == 'cancel' or $request->transaction_status == 'deny' or $request->transaction_status == 'expire' or $request->transaction_status == 'failure') {
                $transaksi = Transaksi::where('valid', $request->order_id)->first();
                $transaksi->status = 'FAILED';
                $transaksi->save();
            }
        }

    }


}