<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class StatusChart extends ChartWidget
{
    protected ?string $heading = 'Status Penanganan';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'data' => [32, 74, 128, 14],
                ],
            ],
            'labels' => [
                'Verifikasi',
                'Diproses',
                'Selesai',
                'Ditolak',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}