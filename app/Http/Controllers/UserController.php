<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function navbar()
    {
        return view('navbar');
    }
    public function homeuser()
    {
        return view('homeuser.homeuser');
    }
}
