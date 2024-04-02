<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        $pelanggan = Pelanggan::all();
        return view('dashboard', [
            'pelanggan' => $pelanggan,
        ]);
    }
}
