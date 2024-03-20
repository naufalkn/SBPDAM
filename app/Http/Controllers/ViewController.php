<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    public function index()
    {
        return view('welcome',[
            'nama'=> auth::user()->username,
        ]);
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}
