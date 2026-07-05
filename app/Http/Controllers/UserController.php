<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Services\AIClusteringService;
use App\Services\BlockchainService;


class UserController extends Controller
{
    public function navbar()
    {
        return view('navbar');
    }

    public function homeUser()
    {
        $aiPriorities = app(AIClusteringService::class)
            ->getPriorityResult()
            ->sortByDesc('priority_score')
            ->take(5)
            ->values();

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

        $verifiedReports = Report::whereHas('status', function ($query) {
            $query->where('name', 'Diverifikasi');
        })->count();

        $latest = Report::latest()->first();
        $totalBlock = Report::count();
        $latestHash = $latest?->hash;
        $previousHash = $latest?->previous_hash;

        $latestBlocks = Report::latest()
            ->take(5)
            ->get();

        $blockchain = app(BlockchainService::class)
            ->verifyBlockchain();

        $mapReports = Report::with(['category', 'status'])
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        return view('homeuser.homeUser', compact(
            'totalReports',
            'processReports',
            'doneReports',
            'pendingReports',
            'verifiedReports',
            'aiPriorities',

            // Blockchain
            'blockchain',
            'totalBlock',
            'latestHash',
            'previousHash',
            'latestBlocks',

            //map
            'mapReports',
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

    public function detailLaporan($id)
    {
    $report = Report::with(['category', 'status'])->findOrFail($id);

    return view('homeuser.detailLaporan', compact('report'));
    }

    public function showLogin()
    {
        return view('admin.login');
    }

    public function statusLaporan($id)
    {
    $report = Report::with([
        'category',
        'status',
        'timelines.status'
    ])->findOrFail($id);

    return view('homeuser.detailLaporan', compact('report'));
    }

    
}
