<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function navbar()
    {
        return view('navbar');
    }

    public function homeUser()
    {
        return view('homeuser.homeUser');
    }

    public function formLaporan()
    {
        return view('homeuser.formLaporan');
    }

    public function laporanPublik()
    {
        return view('homeuser.laporanPublik');
    }

    public function detailLaporan()
    {
        return view('homeuser.detailLaporan');
    }
}
