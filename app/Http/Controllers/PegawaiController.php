<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PegawaiController extends Controller
{
    public function index ()
    {
        return view('pegawai.dashboard');
    }
}
