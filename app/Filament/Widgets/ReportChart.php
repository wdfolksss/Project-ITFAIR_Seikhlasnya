<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class ReportChart extends ChartWidget
{
    protected ?string $heading = 'Report Chart';

    protected function getData(): array
    {
        return [
            //
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
