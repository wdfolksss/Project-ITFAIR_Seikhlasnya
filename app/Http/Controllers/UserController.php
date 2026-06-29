<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class UserController extends Controller
{
    public function navbar()
    {
        return view('navbar');
    }

    public function homeUser()
    {

         $totalReports = Report::count();

        $processReports = Report::whereHas('status', function ($query) {
            $query->where('name', 'Diproses');
        })->count();

        $doneReports = Report::whereHas('status', function ($query) {
            $query->where('name', 'Selesai');
        })->count();

        $pendingReports = Report::whereHas('status', function ($query) {
            $query->where('name', 'Pending');
        })->count();

        return view('homeuser.homeUser', compact(
            'totalReports',
            'processReports',
            'doneReports',
            'pendingReports'
        ));
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
    public function showLogin()
    {
        return view('admin.login');
    }
}
