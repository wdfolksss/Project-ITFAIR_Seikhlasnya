<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Status;
use Illuminate\Http\Request;

class ReportController extends Controller
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

        $validated['image'] = $request->file('image')->store('reports', 'public');

        $status = Status::where('name', 'Pending')->first();

        $validated['status_id'] = $status->id;

        Report::create($validated);

        return redirect()->back()->with('success', 'Laporan berhasil dikirim.');
    }
}