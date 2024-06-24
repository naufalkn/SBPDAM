<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PayController extends Controller
{
    public function bayar(Request $request)
    {
        $pelanggan = Pelanggan::where('user_id', auth()->id())->first();

        if ($pelanggan->transaksi()->exists()) {
            $transaksi = $pelanggan->transaksi()->first();
            return redirect()->route('berhasil', $transaksi->id);
        } else {
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
    }

    public function berhasil($id)
    {
        $pelanggan = Pelanggan::where('user_id', auth()->id())->first();
        $transaksi = $pelanggan->transaksi()->first();
        $bayar = Transaksi::where('id', $id)->first();
        return view('user.berhasil', compact([
            'pelanggan',
            'transaksi',
            'bayar',
        ]));
    }

    public function tagihan(Transaksi $transaksi)
    {
        $pelanggan = Pelanggan::where('user_id', auth()->id())->with('transaksi')->first();
        // dd($pelanggan);
        // $transaksi = $pelanggan->transaksi()->first();
        return view('user.tagihan', [
            // 'transaksi' => $transaksi,
            'pelanggan' => $pelanggan,
        ]);
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
            } else if ($request->transaction_status == 'cancel' or $request->transaction_status == 'deny' or $request->transaction_status == 'expire' or $request->transaction_status == 'failure') 
            {
                $transaksi = Transaksi::where('valid', $request->order_id)->first();
                $transaksi->status = 'FAILED';
                $transaksi->save();
            }
        }

    }

    public function cetakPembayaran(Request $request)
    {
        $pelanggan = Pelanggan::where('user_id', auth()->id())->first();
        $transaksi = $pelanggan->transaksi()->first();
        // dd($transaksi);
        $pdf = Pdf::loadview('user.cetak',['pelanggan'=>$pelanggan, 'transaksi'=>$transaksi]);
        return $pdf->stream();
    }
    


}