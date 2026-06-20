<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

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

        // langsung publish (atau bisa Pending kalau mau admin approve)
        $validated['status_id'] = 2;

        Report::create($validated);

        return redirect()->route('homeuser')
            ->with('success', 'Laporan berhasil dikirim!');
    }

    public function index()
    {
        $laporan = Report::with(['category', 'status'])
            ->latest()
            ->get();

        return view('homeuser.laporanPublik', compact('laporan'));
    }
}