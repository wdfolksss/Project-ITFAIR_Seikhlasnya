<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class CategoryChart extends ChartWidget
{
    protected ?string $heading = 'Laporan Berdasarkan Kategori';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Laporan',
                    'data' => [45, 28, 17, 35, 22],
                ],
            ],
            'labels' => [
                'Jalan Berlubang',
                'Aspal Rusak',
                'Drainase',
                'Jembatan',
                'Lampu Jalan',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}