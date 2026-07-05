<?php

namespace App\Observers;

use App\Models\Report;
use App\Services\BlockchainService;

class ReportObserver
{
    public function created(Report $report): void
    {
        $blockchain = app(BlockchainService::class);
        $block = $blockchain->createBlock($report);
        $report->updateQuietly([
            'hash' => $block['hash'],
            'previous_hash' => $block['previous_hash'],
        ]);
    }
}