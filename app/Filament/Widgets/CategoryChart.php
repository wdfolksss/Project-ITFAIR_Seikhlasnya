<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use Filament\Widgets\ChartWidget;

class CategoryChart extends ChartWidget
{
    protected ?string $heading = 'Laporan Berdasarkan Kategori';

    protected function getData(): array
    {
        $categories = Category::withCount('reports')->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Laporan',
                    'data' => $categories->pluck('reports_count')->toArray(),
                ],
            ],

            'labels' => $categories->pluck('name')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}