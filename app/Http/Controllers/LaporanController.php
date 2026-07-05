<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Status;

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
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // upload image
        $validated['image'] = $request->file('image')->store('reports', 'public');

        // STATUS DEFAULT (PENDING = 1)
        $validated['status_id'] = 1;

        Report::create($validated);

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

    // Tambahkan ini
    $categories = Category::all();
    $statuses = Status::all();

    $totalReports = Report::count();
    $doneReports = Report::where('status_id', 2)->count();
    $pendingReports = Report::where('status_id', 1)->count();
    $processReports = Report::where('status_id', 3)->count();

    return view('homeuser.laporanPublik', compact(
        'laporan',
        'categories',
        'statuses',
        'totalReports',
        'doneReports',
        'pendingReports',
        'processReports'
    ));
}

    public function detailLaporan(Report $report)
    {
        $report->load(['category', 'status']);

        return view('homeuser.detailLaporan', compact('report'));
    }

}

