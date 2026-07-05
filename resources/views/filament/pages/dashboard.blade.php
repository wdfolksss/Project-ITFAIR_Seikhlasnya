<x-filament-panels::page>
    <div class="space-y-6">

        {{-- HEADER --}}
        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                Dashboard
            </h1>
            <p class="mt-1 text-sm text-gray-500">
                Selamat datang kembali, Admin! Berikut ringkasan laporan infrastruktur.
            </p>
        </div>

        {{-- STAT CARDS --}}
        <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-5">

            <div class="rounded-2xl border bg-white p-5 shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-md bg-red-100">
                        <i class="fa-solid fa-file-lines text-xl text-red-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total Laporan</p>
                        <h2 class="text-3xl font-bold">{{ $totalReports }}</h2>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border bg-white p-5 shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-md bg-purple-100">
                        <i class="fa-solid fa-user-check text-xl text-purple-700"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Belum Diverifikasi</p>
                        <h2 class="text-3xl font-bold">{{ $pendingReports }}</h2>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border bg-white p-5 shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-blue-600 text-white">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                    <div>
                        <p class="text-sm text-gray-500">Diverifikasi</p>
                        <h2 class="text-3xl font-bold">{{ $verifiedReports }}</h2>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border bg-white p-5 shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-md bg-yellow-100">
                        <i class="fa-solid fa-clock text-xl text-yellow-500"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Diproses</p>
                        <h2 class="text-3xl font-bold">{{ $processReports }}</h2>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border bg-white p-5 shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-md bg-green-100">
                        <i class="fa-solid fa-circle-check text-xl text-green-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Selesai</p>
                        <h2 class="text-3xl font-bold">{{ $doneReports }}</h2>
                    </div>
                </div>
            </div>

        </div>

        {{-- CHART + STATUS --}}
        <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">

            <div class="rounded-2xl border bg-white p-6 shadow-sm">
                <div class="mb-5 flex items-center justify-between">
                    <h2 class="text-lg font-bold">Jumlah Laporan Berdasarkan Kategori</h2>
                    <span class="rounded-lg bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-600">
                        Real-time
                    </span>
                </div>

                <div class="space-y-4">
                    @foreach($categoryReports as $category)
                        @php
                            $percent = $totalReports > 0
                                ? ($category->reports_count / $totalReports) * 100
                                : 0;
                        @endphp

                        <div>
                            <div class="mb-1 flex justify-between text-sm">
                                <span class="font-medium text-gray-700">{{ $category->name }}</span>
                                <span class="font-bold">{{ $category->reports_count }}</span>
                            </div>

                            <div class="h-3 rounded-full bg-gray-100">
                                <div class="h-3 rounded-full bg-blue-600"
                                    style="width: {{ $percent }}%">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="rounded-2xl border bg-white p-6 shadow-sm">
                <h2 class="mb-5 text-lg font-bold">Status Penanganan</h2>

                <div class="space-y-4">
                    @php
                        $statuses = [
                            ['Belum Diverifikasi', $pendingReports, 'bg-yellow-500'],
                            ['Diverifikasi', $verifiedReports, 'bg-blue-500'],
                            ['Diproses', $processReports, 'bg-purple-500'],
                            ['Selesai', $doneReports, 'bg-green-500'],
                        ];
                    @endphp

                    @foreach($statuses as [$label, $value, $color])
                        @php
                            $percent = $totalReports > 0 ? ($value / $totalReports) * 100 : 0;
                        @endphp

                        <div>
                            <div class="mb-1 flex justify-between text-sm">
                                <span>{{ $label }}</span>
                                <span class="font-bold">{{ $value }}</span>
                            </div>

                            <div class="h-3 rounded-full bg-gray-100">
                                <div class="h-3 rounded-full {{ $color }}"
                                    style="width: {{ $percent }}%">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

        {{-- MAP + AI --}}
        <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">

            <div class="rounded-2xl border bg-white p-6 shadow-sm">
                <h2 class="mb-4 text-lg font-bold">Peta Sebaran Laporan</h2>

                <div class="h-80 overflow-hidden rounded-xl bg-gray-100">
                    <div id="adminMap" class="h-full w-full"></div>
                </div>

                <div class="mt-4 flex flex-wrap gap-4 text-xs text-gray-500">
                    <span>🟡 Belum Diverifikasi</span>
                    <span>🟣 Diproses</span>
                    <span>🟢 Selesai</span>
                </div>
            </div>

            <div class="rounded-2xl border bg-white p-6 shadow-sm">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-lg font-bold">Prioritas AI Clustering</h2>
                    <span class="rounded-lg bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-600">
                        AI Active
                    </span>
                </div>

                <div class="space-y-3">
                    @forelse($aiPriorities as $index => $item)
                        @php
                            $priority = $item['priority'];

                            if (str_contains($priority, 'Tinggi')) {
                                $color = 'bg-red-100 text-red-600';
                            } elseif (str_contains($priority, 'Sedang')) {
                                $color = 'bg-yellow-100 text-yellow-600';
                            } else {
                                $color = 'bg-green-100 text-green-600';
                            }
                        @endphp

                        <div class="flex items-center justify-between rounded-xl border p-4">
                            <div class="flex items-center gap-4">
                                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 font-bold text-blue-600">
                                    #{{ $index + 1 }}
                                </span>

                                <div>
                                    <h3 class="font-bold text-gray-900">{{ $item['district'] ?? $item['address'] }}</h3>
                                    <p class="text-xs text-gray-500">{{ $item['report_count'] }} laporan</p>
                                </div>
                            </div>

                            <div class="text-right">
                                <p class="text-sm font-bold">{{ number_format($item['priority_score'], 2) }}</p>
                                <span class="rounded-full px-3 py-1 text-xs font-bold {{ $color }}">
                                    {{ str_replace('Prioritas ', '', $priority) }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-xl border border-dashed p-8 text-center text-sm text-gray-500">
                            Belum ada data AI.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

        {{-- SISTEM --}}
        <div class="grid grid-cols-1 gap-5 md:grid-cols-4">
            <div class="rounded-2xl border bg-white p-5 shadow-sm">
                <p class="text-sm text-gray-500">Blockchain</p>
                <h3 class="mt-1 font-bold text-green-600">● Aktif</h3>
            </div>

            <div class="rounded-2xl border bg-white p-5 shadow-sm">
                <p class="text-sm text-gray-500">AI Clustering</p>
                <h3 class="mt-1 font-bold text-green-600">● Aktif</h3>
            </div>

            <div class="rounded-2xl border bg-white p-5 shadow-sm">
                <p class="text-sm text-gray-500">Total Aktivitas</p>
                <h3 class="mt-1 text-2xl font-bold">{{ $totalReports }}</h3>
            </div>

            <div class="rounded-2xl border bg-white p-5 shadow-sm">
                <p class="text-sm text-gray-500">Pembaruan Terakhir</p>
                <h3 class="mt-1 font-bold text-blue-600">Baru saja</h3>
            </div>
        </div>

    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        setTimeout(() => {
            const adminMap = L.map('adminMap').setView([-6.9277, 106.9299], 11);

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap'
            }).addTo(adminMap);

            const reports = @json($mapReports);

            reports.forEach(report => {
                if (!report.latitude || !report.longitude) return;

                let color = '#f59e0b';

                if (report.status?.name === 'Selesai') color = '#22c55e';
                if (report.status?.name === 'Diproses') color = '#8b5cf6';
                if (report.status?.name === 'Diverifikasi') color = '#3b82f6';

                const icon = L.divIcon({
                    className: '',
                    html: `
                        <div style="
                            width:28px;
                            height:28px;
                            border-radius:50%;
                            background:${color};
                            border:3px solid white;
                            box-shadow:0 4px 10px rgba(0,0,0,.3);
                        "></div>
                    `,
                    iconSize: [28, 28],
                    iconAnchor: [14, 14],
                });

                L.marker([report.latitude, report.longitude], { icon })
                    .addTo(adminMap)
                    .bindPopup(`
                        <b>${report.category?.name ?? 'Laporan'}</b><br>
                        ${report.address ?? '-'}
                    `);
            });

            adminMap.invalidateSize();
        }, 500);
    </script>
</x-filament-panels::page>