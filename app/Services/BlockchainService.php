<?php

namespace App\Services;

use App\Models\Report;

class BlockchainService
{

   public function getLastHash(): string
    {
        $lastReport = Report::whereNotNull('hash')
            ->latest('id')
            ->first();

        if (!$lastReport) {
            return str_repeat('0',64);
        }

        return $lastReport->hash;
    }

    public function generateHash(array $data): string
    {
        return hash('sha256', json_encode($data));
    }

    public function createBlock(Report $report): array
    {
        $previousReport = Report::where('id', '<', $report->id)
            ->whereNotNull('hash')
            ->orderByDesc('id')
            ->first();

        $previousHash = $previousReport
            ? $previousReport->hash
            : str_repeat('0', 64);

        $payload = [
            'id' => $report->id,
            'district' => $report->district,
            'severity' => $report->severity,
            'status' => $report->status_id,
            'created_at' => $report->created_at->toDateTimeString(),
            'previous_hash' => $previousHash,
        ];

        return [
            'hash' => $this->generateHash($payload),
            'previous_hash' => $previousHash,
        ];
    }

    public function verifyBlockchain(): array
    {
        $reports = Report::orderBy('id')->get();

        if ($reports->count() === 0) {
            return [
                'valid' => true,
                'message' => 'Blockchain kosong.',
                'invalid_block' => null,
            ];
        }

        $previousHash = str_repeat('0', 64);

        foreach ($reports as $report) {

            $payload = [

                'id' => $report->id,
                'district' => $report->district,
                'severity' => $report->severity,
                'status' => $report->status_id,
                'created_at'=>$report->created_at->toDateTimeString(),
                'previous_hash' => $previousHash,

            ];

            $currentHash = hash('sha256', json_encode($payload));

            // cek previous hash
            if ($report->previous_hash !== $previousHash) {

                return [

                    'valid' => false,
                    'message' => 'Previous hash tidak cocok.',
                    'invalid_block' => $report->id,

                ];

            }

            // cek hash block
            if ($report->hash !== $currentHash) {

                return [

                    'valid' => false,
                    'message' => 'Hash telah berubah.',
                    'invalid_block' => $report->id,

                ];

            }

            $previousHash = $report->hash;
        }

        return [

            'valid' => true,
            'message' => 'Blockchain Valid.',
            'invalid_block' => null,

        ];
    }

    public function getStatus(): string
    {
        return $this->verifyBlockchain()['valid']
            ? 'VALID'
            : 'INVALID';
    }
}