<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
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

    public function sambungan()
    {
        return view('user.form-sambungan',[
            'nama'=> auth::user()->username,
        ]);
    }

}
