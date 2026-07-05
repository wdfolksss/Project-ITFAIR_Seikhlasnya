<?php

namespace App\Filament\Widgets;

use App\Models\Report;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Laporan', Report::count()),

            Stat::make(
                'Menunggu Verifikasi',
                Report::where('status_id', 1)->count()
            ),

            Stat::make(
                'Sedang Diproses',
                Report::where('status_id', 2)->count()
            ),

            Stat::make(
                'Selesai',
                Report::where('status_id', 3)->count()
            ),
        ];
    }
}