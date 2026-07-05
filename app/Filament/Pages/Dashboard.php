<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Filament\Widgets\DashboardStats;
use App\Filament\Widgets\CategoryChart;
use App\Filament\Widgets\StatusChart;
use App\Filament\Widgets\AiPriorityWidget;

class Dashboard extends Page
{
    protected string $view = 'filament.pages.dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            DashboardStats::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            CategoryChart::class,
            StatusChart::class,
            AiPriorityWidget::class,
            
        ];
    }
}