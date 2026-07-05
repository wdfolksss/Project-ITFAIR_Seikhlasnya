<?php

namespace App\Services;

use App\Models\Report;
use Illuminate\Support\Collection;
use Phpml\Clustering\KMeans;

class AIClusteringService
{

    public function prepareData(): Collection
    {
        $reports = Report::whereNotNull('district')->get();

        return $reports
            ->groupBy('district')
            ->map(function ($items, $district) {

                $severityScore = $items->sum(function ($report) {
                    return match ($report->severity) {
                        'ringan' => 1,
                        'sedang' => 2,
                        'berat'  => 3,
                        default  => 0,
                    };
                });

                return [

                    'district' => $district,
                    'address'  => $district,

                    'report_count' => $items->count(),

                    'severity_score' => $severityScore,

                    'pending' => $items->where('status_id', 1)->count(),

                    'verified' => $items->where('status_id', 2)->count(),

                    'process' => $items->where('status_id', 3)->count(),

                    'done' => $items->where('status_id', 4)->count(),

                ];

            })
            ->values();
    }


    public function prepareSamples(): array
    {
        $data = $this->prepareData();

        $samples = [];
        $mapping = [];

        foreach ($data as $index => $item) {

            $samples[] = [

                $item['report_count'],
                $item['severity_score'],
                $item['pending'],
                $item['process']

            ];

            $mapping[$index] = $item;

        }

        return [

            'samples' => $samples,

            'mapping' => $mapping

        ];
    }

    public function runKMeans(): array
    {
        $prepared = $this->prepareSamples();

        $samples = $prepared['samples'];

        $mapping = $prepared['mapping'];

        // Belum ada data
        if (count($samples) == 0) {

            return [

                'clusters' => [],

                'mapping' => []

            ];

        }

        // Jumlah cluster otomatis
        $clusterCount = min(3, count($samples));

        $kmeans = new KMeans($clusterCount);

        $clusters = $kmeans->cluster($samples);

        return [

            'clusters' => $clusters,

            'mapping' => $mapping

        ];
    }

    private function calculateCentroid(array $cluster): float
    {
        if (count($cluster) === 0) {
            return 0;
        }

        $total = 0;

        foreach ($cluster as $sample) {

            $total +=
                ($sample[0] * 0.30) +
                ($sample[1] * 0.40) +
                ($sample[2] * 0.20) +
                ($sample[3] * 0.10);

        }

        return $total / count($cluster);
    }

    private function getPriorityLabel(float $score): string
    {
        if ($score >= 4) {
            return 'Prioritas Tinggi';
        }

        if ($score >= 2) {
            return 'Prioritas Sedang';
        }

        return 'Prioritas Rendah';
    }

    public function getPriorityResult(): Collection
    {
        $result = $this->runKMeans();

        $clusters = $result['clusters'];
        $mapping  = $result['mapping'];

        // kalau data kosong
        if (empty($clusters)) {
            return collect();
        }


        $clusterScore = [];

        foreach ($clusters as $clusterIndex => $cluster) {

            $clusterScore[$clusterIndex] =
                $this->calculateCentroid($cluster);

        }


        arsort($clusterScore);

        $labels = [];
        $rank = 0;

        foreach ($clusterScore as $clusterIndex => $score) {

            switch ($rank) {

                case 0:
                    $labels[$clusterIndex] = 'Prioritas Tinggi';
                    break;

                case 1:
                    $labels[$clusterIndex] = 'Prioritas Sedang';
                    break;

                default:
                    $labels[$clusterIndex] = 'Prioritas Rendah';
                    break;

            }

            $rank++;
        }


        $resultData = [];

        foreach ($clusters as $clusterIndex => $cluster) {

            foreach ($cluster as $sample) {

                foreach ($mapping as $item) {

                    if (

                        $item['report_count'] == $sample[0] &&
                        $item['severity_score'] == $sample[1] &&
                        $item['pending'] == $sample[2] &&
                        $item['process'] == $sample[3]

                    ) {

                        $priorityScore =

                            ($item['report_count'] * 0.30) +
                            ($item['severity_score'] * 0.40) +
                            ($item['pending'] * 0.20) +
                            ($item['process'] * 0.10);

                        $item['priority_score'] = round($priorityScore, 2);
                        $item['priority'] = $this->getPriorityLabel($priorityScore);

                        $resultData[] = $item;

                        break;
                    }

                }

            }

        }
        

        return collect($resultData)
            ->sortByDesc('priority_score')
            ->values();
    }

}