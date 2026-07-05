<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Beranda  |   Kelawar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="overflow-x-hidden font-montserrat bg-white dark:bg-slate-950 text-black dark:bg-black dark:text-white">
    @include('navbar')

    @if(session('success'))
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">
        <div class="w-[90%] max-w-md rounded-3xl bg-white p-8 text-center shadow-2xl">
            <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-blue-100">
            <i class="fa-solid fa-circle-check text-4xl text-blue-600"></i>
        </div>

        <h2 class="mt-5 text-2xl font-bold text-gray-900">
            Laporan Berhasil Dikirim!
        </h2>
        <p class="mt-3 text-sm text-gray-600">
            Terima kasih sudah melaporkan kerusakan infrastruktur.
            Laporan kamu akan diverifikasi oleh admin.
        </p>

        <button onclick="this.closest('.fixed').remove()"class="mt-6 w-full rounded-xl bg-blue-600 px-5 py-3 font-semibold text-white transition hover:bg-blue-700">
            Kembali
        </button>
    </div>
</div>
@endif
    {{-- section 1 --}}
    <section
        class="relative min-h-[360px] sm:min-h-[420px] lg:min-h-[40rem] py-[2rem] px-[1rem] sm:py-[2rem] sm:px-[1rem] md:py-[2rem] xl:py-[10rem] flex items-center bg-cover bg-center"
        style="background-image: url('{{ asset('img/hero.jpeg') }}');">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-900/70 to-slate-900/30"></div>
        <div class="relative z-10 w-full max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
            <div class="max-w-[55rem] pb-[4rem]">
                <span
                    class="inline-flex px-3 py-1 rounded-full bg-green-600 text-white text-[10px] sm:text-xs font-semibold">
                    Dari Warga, Untuk Sukabumi
                </span>

                <h1 class="mt-4 text-2xl sm:text-4xl lg:text-5xl font-Plus Jakarta Sans font-bold text-white leading-tight">
                    Bersama Warga, 
                    <span class="text-blue-400"> Bangun Infrastruktur </span> 
                    yang Lebih Baik
                </h1>

                <p class="mt-3 text-xs sm:text-sm lg:text-base text-gray-200 leading-relaxed max-w-md">
                    Laporkan kerusakan infrastruktur di sekitar Anda,
                    pantau status penanganan, dan wujudkan Sukabumi yang
                    lebih nyaman.
                </p>

                 <!-- BUTTON -->
            <div class="mt-8 flex flex-col gap-3 sm:flex-row">

                <a href="{{ route('formLaporan') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">

                    <i class="fa-solid fa-paper-plane"></i>
                    Laporkan Sekarang
                </a>

                <a href="#petaInfrastruktur"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/20 bg-white/10 px-6 py-3 text-sm font-semibold text-white backdrop-blur transition hover:bg-white/20">

                    <i class="fa-solid fa-map-location-dot"></i>
                    Lihat Peta
                </a>

            </div>
            </div>
        </div>
    </section>

    {{-- section 2 --}}
    <section id="petaInfrastruktur" class="relative z-20 -mt-16 rounded-t-[40px] bg-white px-5 pt-10 pb-6 sm:px-8 lg:px-12">
    <div class="mx-auto max-w-7xl space-y-4">
        <div class="rounded-xl bg-white p-4 shadow-md">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-sm font-bold text-gray-900">Ringkasan Laporan</h2>
                {{-- <a href="#" class="text-xs font-medium text-blue-600">Lihat Semua Statistik ›</a> --}}
            </div>
            
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-5">
                
                <!-- Total Laporan -->
                <div class="flex items-center gap-4 rounded-md border border-gray-200 p-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-md bg-red-100">
                        <i class="fa-solid fa-file-lines text-xl text-red-600"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">{{ $totalReports }}</h3>
                        <p class="text-xs text-gray-500">Total Laporan</p>
                    </div>
                </div>
                
                <!-- Belum Diverifikasi -->
                <div class="flex items-center gap-4 rounded-md border border-gray-200 p-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-md bg-purple-100">
                        <i class="fa-solid fa-user-check text-xl text-purple-700"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">{{ $pendingReports }}</h3>
                        <p class="text-xs text-gray-500">Belum Diverifikasi</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-lg border border-gray-200 p-4">
                        <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-blue-600 text-white">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>

                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">{{ $verifiedReports }}</h3>
                            <p class="text-xs text-gray-500">Diverifikasi</p>
                        </div>
                    </div>

                <div class="flex items-center gap-4 rounded-md border border-gray-200 p-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-md bg-yellow-100">
                        <i class="fa-solid fa-clock text-xl text-yellow-500"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">{{$processReports}}</h3>
                        <p class="text-xs text-gray-500">Dalam Proses</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-md border border-gray-200 p-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-md bg-green-100">
                        <i class="fa-solid fa-circle-check text-xl text-green-600"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">{{ $doneReports }}</h3>
                        <p class="text-xs text-gray-500">Selesai</p>
                    </div>
                </div>


            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">

            <div class="rounded-xl bg-white p-4 shadow-md lg:col-span-2">
                <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">Peta Infrastruktur</h2>
                        <p class="text-xs text-gray-500">Klik pada marker untuk melihat detail laporan</p>
                    </div>

                    <div class="flex flex-wrap gap-4 text-[10px] text-gray-700">
                        <span class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-red-600"></span>Kerusakan Berat</span>
                        <span class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-yellow-400"></span>Kerusakan Sedang</span>
                        <span class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-green-600"></span>Kerusakan Ringan</span>
                        <span class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-blue-600"></span>Teratasi</span>
                    </div>
                </div>

                <div class="relative h-[260px] overflow-hidden rounded-lg bg-green-100">
                  <div id="map" class="h-[350px] w-full rounded-2xl"></div>
                    <button class="absolute bottom-4 left-4 rounded-md bg-white px-3 py-2 text-xs font-medium text-gray-700 shadow">
                        Filter Peta
                    </button>
                </div>
            </div>
            

            <div class="rounded-xl bg-white p-4 shadow-md">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-900">Prioritas Tertinggi (AI)</h2>
                    <a href="#" class="text-xs font-medium text-blue-600">Lihat Semua</a>
                </div>

                <div class="space-y-4">

                    @forelse($aiPriorities as $index => $item)

                        @php
                            if (str_contains($item['priority'], 'Tinggi')) {
                                $badge = 'Risiko Tinggi';
                                $color = 'bg-red-600';
                            } elseif (str_contains($item['priority'], 'Sedang')) {
                                $badge = 'Risiko Sedang';
                                $color = 'bg-yellow-500';
                            } else {
                                $badge = 'Risiko Rendah';
                                $color = 'bg-green-600';
                            }
                        @endphp

                        <div class="flex items-center justify-between gap-3">
                            <div class="flex items-start gap-3">
                                <span class="flex h-7 w-7 items-center justify-center rounded-full bg-gray-200 text-xs font-bold text-gray-700">
                                    {{ $index + 1 }}
                                </span>

                                <div>
                                    <h3 class="text-sm font-bold text-gray-900">
                                        {{ $item['address'] }}
                                    </h3>

                                    <p class="text-xs text-gray-500">
                                        {{ $item['address'] }}
                                    </p>

                                    <p class="text-xs text-gray-500">
                                        {{ $item['report_count'] }} laporan • {{ $badge }}
                                    </p>
                                </div>
                            </div>

                            <span class="{{ $color }} rounded-md px-4 py-1 text-xs font-bold text-white">
                                {{ number_format($item['priority_score'], 1) }}
                            </span>
                        </div>

                    @empty

                        <div class="flex flex-col items-center justify-center rounded-xl border border-dashed border-gray-300 py-10 text-center">
                            <svg class="mb-3 h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 17v-6h13M9 5l-7 7 7 7"/>
                            </svg>

                            <p class="text-sm font-semibold text-gray-600">
                                Belum ada data laporan
                            </p>

                            <p class="mt-1 text-xs text-gray-400">
                                AI akan menampilkan wilayah prioritas setelah terdapat laporan yang masuk.
                            </p>
                        </div>

                    @endforelse

                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-white px-5 py-10 sm:px-8 lg:px-12">
    <div class="mx-auto max-w-7xl">
        <div class="grid grid-cols-1 items-center gap-8 rounded-3xl bg-slate-900 p-6 text-white shadow-lg lg:grid-cols-2 lg:p-10">

            <!-- LEFT -->
            <div>
                <span class="rounded-full bg-blue-600 px-4 py-1 text-xs font-semibold">
                    Blockchain Transparansi
                </span>

                <h2 class="mt-4 text-2xl font-bold sm:text-3xl">
                    Data Laporan Infrastruktur
                    Lebih Aman dan Transparan
                </h2>

                <p class="mt-3 text-sm leading-relaxed text-slate-300">
                    Setiap laporan kerusakan jalan memiliki riwayat digital
                    yang tercatat sehingga perubahan status dapat dipantau
                    secara transparan.
                </p>

                <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div class="rounded-2xl bg-white/10 p-4">

                        <i class="fa-solid fa-fingerprint text-2xl text-blue-400"></i>
                        <h3 class="mt-3 font-semibold">Identitas Laporan</h3>
                        <p class="mt-1 text-xs text-slate-300">
                            Setiap laporan memiliki kode unik untuk menjaga keaslian data.
                        </p>
                    </div>

                    <div class="rounded-2xl bg-white/10 p-4">

                        <i class="fa-solid fa-clock-rotate-left text-2xl text-green-400"></i>
                        <h3 class="mt-3 font-semibold">Riwayat Status</h3>
                        <p class="mt-1 text-xs text-slate-300">Perubahan laporan tersimpan dari awal hingga selesai.</p>
                    </div>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="rounded-3xl bg-white p-5 text-slate-900">
                <div class="space-y-4">
                    <div class="flex items-center gap-4 rounded-2xl border p-4">
                        <span class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 text-blue-600">
                            <i class="fa-solid fa-file-circle-plus text-xl"></i>
                        </span>

                        <div>
                            <h3 class="font-bold">Laporan Dibuat</h3>
                            <p class="text-xs text-gray-500">Data laporan masuk ke sistem.</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 rounded-2xl border p-4">
                        <span class="flex h-12 w-12 items-center justify-center rounded-full bg-purple-100 text-purple-600">
                            <i class="fa-solid fa-fingerprint text-xl"></i>
                        </span>

                        <div>
                            <h3 class="font-bold"> Hash Data Terbentuk</h3>
                            <p class="text-xs text-gray-500"> Data memiliki identitas digital yang unik.</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 rounded-2xl border p-4">
                        <span class="flex h-12 w-12 items-center justify-center rounded-full bg-yellow-100 text-yellow-600">
                            <i class="fa-solid fa-clock text-xl"></i>
                        </span>

                        <div>
                            <h3 class="font-bold">Tracking Proses</h3>
                            <p class="text-xs text-gray-500">Status laporan tercatat setiap perubahan.</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 rounded-2xl border p-4">
                        <span class="flex h-12 w-12 items-center justify-center rounded-full bg-green-100 text-green-600">
                            <i class="fa-solid fa-circle-check text-xl"></i>
                        </span>

                        <div>
                            <h3 class="font-bold">Laporan Selesai</h3>
                            <p class="text-xs text-gray-500"> Masyarakat dapat melihat hasil penanganan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-white px-5 py-8 sm:px-8 lg:px-12">
    <div class="mx-auto max-w-7xl rounded-2xl border border-gray-200 bg-white p-6 shadow-md">

        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="flex items-center gap-2">
                    <span class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-600 text-white">
                        <i class="fa-solid fa-cube"></i>
                    </span>

                    <h2 class="text-xl font-bold text-gray-900">
                        Blockchain Transparansi
                    </h2>
                </div>

                <p class="mt-2 text-sm text-gray-500">
                    Setiap aktivitas laporan dicatat sebagai block menggunakan hash SHA-256.
                </p>
            </div>

            <div class="flex items-center gap-3">
                @if($blockchain['valid'])
                    <span class="rounded-full bg-green-100 px-4 py-2 text-xs font-bold text-green-700">
                        <i class="fa-solid fa-circle-check mr-1"></i>
                        Blockchain Valid
                    </span>
                @else
                    <span class="rounded-full bg-red-100 px-4 py-2 text-xs font-bold text-red-700">
                        <i class="fa-solid fa-triangle-exclamation mr-1"></i>
                        Perlu Dicek
                    </span>
                @endif

                <span class="rounded-lg border border-blue-200 px-4 py-2 text-xs font-semibold text-blue-600">
                    Total Block: {{ $totalBlock }}
                </span>
            </div>
        </div>

        <div class="relative">
            <div class="absolute left-0 right-0 top-4 hidden h-[2px] bg-blue-200 lg:block"></div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-5">
                @forelse($latestBlocks as $block)
                    <div class="relative rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
                        <span class="absolute -top-2 left-1/2 hidden h-4 w-4 -translate-x-1/2 rounded-full border-2 border-white bg-blue-500 lg:block"></span>

                        <p class="text-sm font-bold text-blue-600">
                            Block #{{ $block->id }}
                        </p>

                        <h3 class="mt-3 min-h-[42px] text-sm font-bold text-gray-900">
                            {{ $block->title ?? 'Aktivitas laporan tercatat' }}
                        </h3>

                        <p class="mt-2 text-xs text-gray-500">
                            <i class="fa-regular fa-calendar mr-1"></i>
                            {{ $block->created_at->format('d M Y, H:i') }} WIB
                        </p>

                        <p class="mt-2 text-xs text-gray-500">
                            Oleh:
                            {{ $block->actor ?? 'Sistem' }}
                        </p>

                        <div class="mt-4 border-t border-gray-100 pt-3">
                            <p class="text-xs text-gray-500">Hash</p>

                            <p class="mt-1 rounded-lg bg-gray-100 px-3 py-2 font-mono text-[11px] text-gray-700">
                                {{ \Illuminate\Support\Str::limit($block->hash, 24) }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full rounded-xl border border-dashed border-gray-300 p-6 text-center text-sm text-gray-500">
                        Belum ada aktivitas blockchain.
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</section>

<section class="bg-white px-5 py-6 sm:px-8 lg:px-12">
    <div class="mx-auto grid max-w-7xl grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

        <div class="flex items-center gap-4 rounded-lg border border-gray-200 bg-white p-4 shadow-md">
            <span class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-600 text-white">
                <i class="fa-solid fa-pen-to-square"></i>
            </span>

            <div>
                <h3 class="text-sm font-bold text-gray-900">Laporkan Kerusakan</h3>
                <p class="mt-1 text-xs text-gray-500">
                    Laporkan kerusakan infrastruktur di sekitar Anda dengan mudah.
                </p>
            </div>
        </div>

        <div class="flex items-center gap-4 rounded-lg border border-gray-200 bg-white p-4 shadow-md">
            <span class="flex h-10 w-10 items-center justify-center rounded-full bg-green-600 text-white">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>

            <div>
                <h3 class="text-sm font-bold text-gray-900">Pantau Status</h3>
                <p class="mt-1 text-xs text-gray-500">
                    Pantau perkembangan laporan yang telah Anda kirimkan.
                </p>
            </div>
        </div>

        <div class="flex items-center gap-4 rounded-lg border border-gray-200 bg-white p-4 shadow-md">
            <span class="flex h-10 w-10 items-center justify-center rounded-full bg-orange-500 text-white">
                <i class="fa-solid fa-chart-simple"></i>
            </span>

            <div>
                <h3 class="text-sm font-bold text-gray-900">Data Transparan</h3>
                <p class="mt-1 text-xs text-gray-500">
                    Semua data laporan dapat dilihat secara transparan oleh publik.
                </p>
            </div>
        </div>

        <div class="flex items-center gap-4 rounded-lg border border-gray-200 bg-white p-4 shadow-md">
            <span class="flex h-10 w-10 items-center justify-center rounded-full bg-purple-600 text-white">
                <i class="fa-solid fa-shield-halved"></i>
            </span>

            <div>
                <h3 class="text-sm font-bold text-gray-900">Keamanan Terjamin</h3>
                <p class="mt-1 text-xs text-gray-500">
                    Sistem kami aman dan data Anda terlindungi dengan baik.
                </p>
            </div>
        </div>
    </div>
</section>

    @include('footer')

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>
<script>
    const map = L.map('map').setView([-6.9277, 106.9299], 12);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    const reports = @json($mapReports);

    const markerCluster = L.markerClusterGroup({
        showCoverageOnHover: false,
        maxClusterRadius: 45,
        spiderfyOnMaxZoom: true,
    });

    function getMarkerColor(report) {
        const status = report.status?.name?.toLowerCase();

        if (status === 'selesai') {
            return '#2563eb'; // biru = teratasi
        }

        if (report.severity === 'berat') {
            return '#dc2626'; // merah
        }

        if (report.severity === 'sedang') {
            return '#eab308'; // kuning
        }

        return '#16a34a'; // hijau
    }

    reports.forEach(report => {
        if (!report.latitude || !report.longitude) return;

        const color = getMarkerColor(report);

        const icon = L.divIcon({
            className: '',
            html: `
                <div style="
                    width: 30px;
                    height: 30px;
                    border-radius: 9999px;
                    background: ${color};
                    border: 3px solid white;
                    box-shadow: 0 4px 10px rgba(0,0,0,.35);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: white;
                    font-size: 13px;
                    font-weight: 800;
                ">
                    !
                </div>
            `,
            iconSize: [30, 30],
            iconAnchor: [15, 15],
            popupAnchor: [0, -12],
        });

        const marker = L.marker([report.latitude, report.longitude], { icon })
            .bindPopup(`
                <div style="min-width:190px">
                    <b>${report.category?.name ?? 'Laporan Infrastruktur'}</b><br>
                    <small>${report.address ?? '-'}</small><br><br>
                    <b>Kerusakan:</b> ${report.severity ?? '-'}<br>
                    <b>Status:</b> ${report.status?.name ?? '-'}<br><br>
                    <a href="/detailLaporan/${report.id}" style="color:#2563eb;font-weight:700;">
                        Lihat Detail
                    </a>
                </div>
            `);

        markerCluster.addLayer(marker);
    });

    map.addLayer(markerCluster);

    setTimeout(() => {
        map.invalidateSize();
    }, 300);
</script>
</body>
</html>