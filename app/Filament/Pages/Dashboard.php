<?php

namespace App\Filament\Pages;

use App\Models\Report;
use App\Models\Category;
use App\Services\AIClusteringService;
use Filament\Pages\Page;

class Dashboard extends Page
{
    protected string $view = 'filament.pages.dashboard';

    protected static ?string $title = '';

    protected static ?string $navigationLabel = 'Dashboard';

    protected static ?int $navigationSort = 0;

    protected function getViewData(): array
    {
        $totalReports = Report::count();

        $pendingReports = Report::whereHas('status', fn ($q) => $q->where('name', 'Pending'))->count();
        $verifiedReports = Report::whereHas('status', fn ($q) => $q->where('name', 'Diverifikasi'))->count();
        $processReports = Report::whereHas('status', fn ($q) => $q->where('name', 'Diproses'))->count();
        $doneReports = Report::whereHas('status', fn ($q) => $q->where('name', 'Selesai'))->count();

        $categoryReports = Category::withCount('reports')->get();

        $aiPriorities = app(AIClusteringService::class)
            ->getPriorityResult()
            ->take(4);

        $mapReports = Report::with(['category', 'status'])
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->latest()
            ->take(20)
            ->get();

        return compact(
            'totalReports',
            'pendingReports',
            'verifiedReports',
            'processReports',
            'doneReports',
            'categoryReports',
            'aiPriorities',
            'mapReports'
        );
    }
}