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
        if ($pelanggan->transaksi()->exists() && $pelanggan->transaksi()->where('status', 'PENDING')->exists()) {
            // $transaksi = $pelanggan->transaksi()->first();
            $transaksi = $pelanggan->transaksi()->latest()->first();
            return redirect()->route('berhasil', $transaksi->id);
        } else {
            $transaksi = Transaksi::create([
                'pelanggan_id' => $pelanggan->id,
                'nama' => $pelanggan->nama,
                'no_telepon' => $pelanggan->no_telepon,
                'email' => $pelanggan->email,
                'total_bayar' => 23000,
                'order_id' => '',
                'channel' => '',
                'tanggal_pembayaran' => null,
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

            $transaksi->order_id = $transaksi->id . "-" . time();
            $params = [
                'transaction_details' => [
                    'order_id' => $transaksi->order_id,
                    'gross_amount' => 23000,
                ],
                'customer_details' => [
                    'nama' => $pelanggan->nama,
                    'email' => $pelanggan->email,
                    'no_telepon' => $pelanggan->no_hp,
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

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $our_key = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($our_key == $request->signature_key) {
            if ($request->transaction_status == 'capture' or $request->transaction_status == 'settlement') {
                $log = fopen("log_sementara.txt", "w");
                fwrite($log, $request);
                fclose($log);
                $transaksi = Transaksi::where('order_id', $request->order_id)->first();
                $transaksi->status = 'SUCCESS';
                $transaksi->channel = $request->payment_type;
                $transaksi->tanggal_pembayaran = now();
                $transaksi->save();
                $pelanggan = Pelanggan::where('id', $transaksi->pelanggan_id)->first();
                $pelanggan->is_pelanggan = 1;
                $pelanggan->save();
            } else if ($request->transaction_status == 'expire') {
                $transaksi = Transaksi::where('order_id', $request->order_id)->first();

                // Set your Merchant Server Key
                \Midtrans\Config::$serverKey = config('midtrans.server_key');
                // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
                \Midtrans\Config::$isProduction = false;
                // Set sanitization on (default)
                \Midtrans\Config::$isSanitized = true;
                // Set 3DS transaction for credit card to true
                \Midtrans\Config::$is3ds = true;

                $transaksi->order_id = $transaksi->id . "-" . time();
                $params = [
                    'transaction_details' => [
                        'order_id' => $transaksi->order_id,
                        'gross_amount' => 23000,
                    ],
                    'customer_details' => [
                        'nama' => $transaksi->nama,
                        'email' => $transaksi->email,
                        'no_telepon' => $transaksi->no_hp,
                    ],
                ];
                $snapToken = \Midtrans\Snap::getSnapToken($params);
                $transaksi->snap_token = $snapToken;
                $transaksi->update();
                return redirect()->route('berhasil', $transaksi->id);
            } else if ($request->transaction_status == 'cancel' or $request->transaction_status == 'deny' or $request->transaction_status == 'failure') {
                $transaksi = Transaksi::where('order_id', $request->order_id)->first();
                $transaksi->status = 'FAILED';
                $transaksi->save();
            }
        }

    }

    



}