<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Status;
use App\Models\ReportTimeline;
use App\Services\BlockchainService;

class LaporanController extends Controller
{
   public function store(Request $request)
    {
        $validated = $request->validate([
            'reporter_name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'severity' => 'required|in:ringan,sedang,berat',
            'address' => 'required|string',
            'district' => 'nullable|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // upload image
        $validated['image'] = $request->file('image')->store('reports', 'public');

        // STATUS DEFAULT (PENDING = 1)
        $validated['status_id'] = 1;

        // Simpan laporan
        $report = Report::create($validated);

        $block = app(\App\Services\BlockchainService::class)->createBlock($report);

        $report->updateQuietly([
            'hash' => $block['hash'],
            'previous_hash' => $block['previous_hash'],
        ]);

        // Simpan timeline pertama
        ReportTimeline::create([
            'report_id' => $report->id,
            'status_id' => $report->status_id,
            'title' => 'Laporan dibuat',
            'description' => 'Laporan berhasil dikirim oleh masyarakat.',
        ]);

        return redirect()->route('homeuser')
            ->with('success', 'Laporan berhasil dikirim!');
    }


public function index(Request $request)
{
    $search = $request->search;
    $category = $request->category;
    $status = $request->status;

    $laporan = Report::with(['category', 'status'])

        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%")
                  ->orWhereHas('category', function ($q2) use ($search) {
                      $q2->where('name', 'like', "%{$search}%");
                  });
            });
        })

        ->when($category, function ($query) use ($category) {
            $query->where('category_id', $category);
        })

        ->when($status, function ($query) use ($status) {
            $query->where('status_id', $status);
        })

        ->latest()
        ->get();

    
    $categories = Category::all();
    $statuses = Status::all();

    $totalReports = Report::count();
    $doneReports = Report::whereHas('status', function ($q) {
        $q->where('name', 'Selesai');
    })->count();

    $processReports = Report::whereHas('status', function ($q) {
        $q->where('name', 'Diproses');
    })->count();

    $pendingReports = Report::whereHas('status', function ($q) {
        $q->where('name', 'Pending');
    })->count();

    $verifiedReports = Report::whereHas('status', function ($q) {
        $q->where('name', 'Diverifikasi');
    })->count();

    $mapReports = Report::with(['category', 'status'])
        ->whereNotNull('latitude')
        ->whereNotNull('longitude')
        ->get();

    return view('homeuser.laporanPublik', compact(
        'laporan',
        'categories',
        'statuses',
        'totalReports',
        'doneReports',
        'pendingReports',
        'processReports',
        'verifiedReports',

        //map
        'mapReports',
    ));
}

    public function detailLaporan(Report $report)
    {
    $report->load([
        'category',
        'status',
        'timelines.status'
    ]);

    return view('homeuser.detailLaporan', compact('report'));
    }

    

}

