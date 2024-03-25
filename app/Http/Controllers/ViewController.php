<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    // USER
    public function index()
    {
        return view('user.beranda',[
            'nama'=> auth::user()->username,
        ]);
    }
    public function riwayat()
    {
        return view('user.riwayat',[
            'nama'=> auth::user()->username,
        ]);
    }
    public function bantuan()
    {
        return view('user.bantuan',[
            'nama'=> auth::user()->username,
        ]);
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}
