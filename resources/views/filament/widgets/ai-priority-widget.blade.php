<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            Prioritas AI Clustering
        </x-slot>

        <div class="space-y-4">

            @forelse($priorities as $index => $item)

                <div class="rounded-xl border border-gray-200 p-4">

                    <div class="flex items-start justify-between">

                        <div>
                            <h3 class="font-bold text-lg">
                                #{{ $index + 1 }} {{ $item['address'] }}
                            </h3>

                            <div class="mt-2 text-sm text-gray-600 space-y-1">
                                <p>
                                    📄 Jumlah Laporan :
                                    <strong>{{ $item['report_count'] }}</strong>
                                </p>

                                <p>
                                    ⚠ Severity Score :
                                    <strong>{{ $item['severity_score'] }}</strong>
                                </p>

                                <p>
                                    🤖 Priority Score :
                                    <strong>{{ number_format($item['priority_score'],2) }}</strong>
                                </p>
                            </div>
                        </div>

                        <div>

                            @if(str_contains($item['priority'], 'Tinggi'))

                                <span class="rounded-full bg-red-100 px-4 py-2 text-sm font-semibold text-red-700">
                                    🔴 Prioritas Tinggi
                                </span>

                            @elseif(str_contains($item['priority'], 'Sedang'))

                                <span class="rounded-full bg-yellow-100 px-4 py-2 text-sm font-semibold text-yellow-700">
                                    🟡 Prioritas Sedang
                                </span>

                            @else

                                <span class="rounded-full bg-green-100 px-4 py-2 text-sm font-semibold text-green-700">
                                    🟢 Prioritas Rendah
                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            @empty

                <div class="text-center py-8 text-gray-500">
                    Belum ada data untuk dianalisis AI.
                </div>

            @endforelse

        </div>

    </x-filament::section>
</x-filament-widgets::widget>