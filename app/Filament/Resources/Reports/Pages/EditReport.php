<?php

namespace App\Filament\Resources\Reports\Pages;

use App\Filament\Resources\Reports\ReportResource;
use App\Models\ReportTimeline;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditReport extends EditRecord
{
    protected static string $resource = ReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        ReportTimeline::create([
            'report_id'   => $this->record->id,
            'status_id'   => $this->record->status_id,
            'title'       => $this->record->status->name,
            'description' => match ($this->record->status->name) {
                'Pending' => 'Laporan sedang menunggu verifikasi.',
                'Diverifikasi' => 'Laporan telah diverifikasi oleh admin.',
                'Diproses' => 'Laporan sedang diproses oleh pihak terkait.',
                'Selesai' => 'Penanganan laporan telah selesai.',
                default => 'Status laporan diperbarui.',
            },
        ]);
    }
}