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
        $statusChanged = $this->record->wasChanged('status_id');
        $responseChanged = $this->record->wasChanged('admin_response');

        if (! $statusChanged && ! $responseChanged) {
            return;
        }

        $messages = [
            'Pending' => 'Laporan sedang menunggu verifikasi.',
            'Diverifikasi' => 'Laporan telah diverifikasi oleh admin.',
            'Diproses' => 'Laporan sedang diproses oleh admin.',
            'Selesai' => 'Penanganan laporan telah selesai.',
        ];

        if ($responseChanged && ! $statusChanged) {
            ReportTimeline::create([
                'report_id' => $this->record->id,
                'status_id' => $this->record->status_id,
                'title' => 'Admin menanggapi laporan',
                'description' => 'Admin memberikan tanggapan terhadap laporan masyarakat.',
                'admin_response' => $this->record->admin_response,
            ]);

            return;
        }

        ReportTimeline::create([
            'report_id' => $this->record->id,
            'status_id' => $this->record->status_id,
            'title' => $this->record->status->name,
            'description' => $messages[$this->record->status->name] ?? 'Laporan diperbarui oleh admin.',
            'admin_response' => $this->record->admin_response,
        ]);
    }
}