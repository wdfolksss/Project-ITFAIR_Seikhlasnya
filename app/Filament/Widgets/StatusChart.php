<?php

namespace App\Filament\Widgets;

use App\Models\Status;
use Filament\Widgets\ChartWidget;

class StatusChart extends ChartWidget
{
    protected ?string $heading = 'Status Penanganan';

    protected function getData(): array
    {
        $statuses = Status::withCount('reports')->get();

        return [
            'datasets' => [
                [
                    'data' => $statuses->pluck('reports_count')->toArray(),
                ],
            ],

            'labels' => $statuses->pluck('name')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}