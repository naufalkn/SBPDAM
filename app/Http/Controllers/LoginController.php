<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.login', [
            'title' => 'Login'
        ]);
    }

    public function prosesLogin(Request $request)
    {
        $loginField = $request->input('login_field'); // Input field yang mungkin berisi email atau username
        $password = $request->input('password');

        // Anda dapat memeriksa apakah input adalah email atau username
        $fieldType = filter_var($loginField, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $fieldType => $loginField,
            'password' => $password,
        ];

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role->nama == "user" || Auth::user()->role->nama == "pelanggan") {
                return redirect('/beranda');
            } else if (Auth::user()->role->nama == "superadmin") {
                return redirect('/dashboard');
            } elseif (Auth::user()->role->nama == "unit") {
                if (Auth::user()->adminUnit->status == "aktif") {
                    return redirect('/unit');
                } else {
                    return back()->with('error', 'Login gagal, silahkan coba lagi!');
                }
            } else if (Auth::user()->role->nama == "pegawai") {
                if (Auth::user()->pegawai->status == "aktif") {
                    return redirect('/dashboard-pegawai');
                } else {
                    return back()->with('error', 'Login gagal, silahkan coba lagi!');
                }
            }
        } else {
            return redirect()->back()->with('error', 'Email atau Password Salah');
        }
    }


    public function daftar()
    {
        return view('auth.registrasi', [
            'title' => 'Daftar'
        ]);
    }

    public function prosesDaftar(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'nama' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = new User;
        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect('/login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

}