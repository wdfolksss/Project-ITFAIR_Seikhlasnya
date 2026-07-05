<?php

namespace App\Filament\Widgets;

use App\Services\AIClusteringService;
use Filament\Widgets\Widget;

class AiPriorityWidget extends Widget
{
    protected string $view = 'filament.widgets.ai-priority-widget';

    protected int|string|array $columnSpan = 'full';

    public function getViewData(): array
    {
        $priorities = app(AIClusteringService::class)
            ->getPriorityResult()
            ->sortByDesc('priority_score')
            ->take(5)
            ->values();

        return [
            'priorities' => $priorities,
        ];
    }
}