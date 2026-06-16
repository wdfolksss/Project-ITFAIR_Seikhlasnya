<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Laporan', '248')
                ->description('12% dari bulan lalu'),

            Stat::make('Menunggu Verifikasi', '32'),

            Stat::make('Sedang Diproses', '74'),

            Stat::make('Selesai', '128'),
        ];
    }
}