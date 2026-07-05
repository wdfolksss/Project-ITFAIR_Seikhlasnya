@php
use Illuminate\Support\Facades\Storage;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Publik   |   Kelawar</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css">
</head>

<body class="bg-white text-gray-900">

    @include('navbar')

    <section class="px-5 py-8 sm:px-8 lg:px-12">
        <div class="mx-auto max-w-7xl">

            <div class="mb-6">
                <div class="flex items-center gap-2 text-xs text-gray-500">
                    <a href="{{ route('homeuser') }}" class="text-blue-600 hover:underline">Beranda</a>
                    <span>›</span>
                    <span>Laporan Publik</span>
                </div>

                <h1 class="mt-4 text-2xl font-bold sm:text-3xl">
                    Laporan Publik Infrastruktur
                </h1>

                <p class="mt-2 text-sm text-gray-500">
                    Lihat dan pantau laporan kerusakan infrastruktur yang telah diverifikasi secara terbuka oleh admin.
                </p>
            </div>

            <div class="mb-6 rounded-xl border border-gray-200 bg-white p-5 shadow-md">
                <h2 class="mb-4 text-sm font-bold">Statistik Laporan Publik</h2>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-5">
                    <div class="flex items-center gap-4 rounded-lg border border-gray-200 p-4">
                        <span class="flex h-11 w-11 items-center justify-center rounded-lg bg-red-700 text-white">
                            <i class="fa-solid fa-bullseye"></i>
                        </span>
                   
                        <div>
                            <h3 class="text-2xl font-bold">{{ $totalReports }}</h3>
                            <p class="text-xs text-gray-500">Total Laporan</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 rounded-lg border border-gray-200 p-4">
                        <span class="flex h-11 w-11 items-center justify-center rounded-lg bg-purple-700 text-white">
                            <i class="fa-solid fa-shield-halved"></i>
                        </span>
                        <div>
                            <h3 class="text-2xl font-bold">{{ $pendingReports }}</h3>
                            <p class="text-xs text-gray-500">Belum Diverifikasi</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 rounded-lg border border-gray-200 p-4">
                        <span class="flex h-11 w-11 items-center justify-center rounded-lg bg-blue-600 text-white">
                            <i class="fa-solid fa-circle-check"></i>
                        </span>

                        <div>
                            <h3 class="text-2xl font-bold">{{ $verifiedReports }}</h3>
                            <p class="text-xs text-gray-500">Diverifikasi</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 rounded-lg border border-gray-200 p-4">
                        <span class="flex h-11 w-11 items-center justify-center rounded-lg bg-orange-500 text-white">
                            <i class="fa-regular fa-clock"></i>
                        </span>
                        <div>
                            <h3 class="text-2xl font-bold">{{$processReports}}</h3>
                            <p class="text-xs text-gray-500">Dalam Proses</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 rounded-lg border border-gray-200 p-4">
                        <span class="flex h-11 w-11 items-center justify-center rounded-lg bg-green-700 text-white">
                            <i class="fa-regular fa-circle-check"></i>
                        </span>
                        <div>
                            <h3 class="text-2xl font-bold">{{ $doneReports }}</h3>
                            <p class="text-xs text-gray-500">Selesai</p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-md lg:col-span-2">
                    <form action="{{ route('laporanPublik') }}" method="GET">
                        <div class="grid grid-cols-1 gap-3 md:grid-cols-3">

                            {{-- Search --}}
                            <div class="relative">
                                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

                                <input
                                    type="text"
                                    name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Cari lokasi, kategori, atau kata kunci..."
                                    class="w-full rounded-lg border border-gray-200 py-3 pl-10 pr-4 text-sm outline-none focus:border-blue-500">
                            </div>

                            {{-- Filter Kategori --}}
                            <select
                                name="category"
                                onchange="this.form.submit()"
                                class="rounded-lg border border-gray-200 px-4 py-3 text-sm outline-none focus:border-blue-500">

                                <option value="">Semua Kategori</option>

                                @foreach($categories as $category)
                                    <option
                                        value="{{ $category->id }}"
                                        {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach

                            </select>

                            {{-- Filter Status --}}
                            <select
                                name="status"
                                onchange="this.form.submit()"
                                onchange="this.form.submit()"
                                class="rounded-lg border border-gray-200 px-4 py-3 text-sm outline-none focus:border-blue-500">

                                <option value="">Semua Status</option>

                                @foreach($statuses as $status)
                                    <option
                                        value="{{ $status->id }}"
                                        {{ request('status') == $status->id ? 'selected' : '' }}>
                                        {{ $status->name }}
                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <button
                            type="submit"
                            class="mt-3 rounded-lg bg-blue-600 px-4 py-2 text-white">
                            Cari
                        </button>
                    </form>

                    <h2 class="mt-5 text-sm font-bold">Daftar Laporan</h2>

                    <div class="mt-4 space-y-3">
                       @foreach ($laporan as $item)

                            <div class="grid grid-cols-1 gap-4 rounded-lg border border-gray-200 p-4 md:grid-cols-[150px_1fr_auto] md:items-center">
                                <div class="rounded-lg bg-gray-200 overflow-hidden">
                                    @if($item->image)
                                        <img
                                            src="{{ url('storage/' . $item->image) }}"
                                            alt="Foto Laporan"
                                        >
                                    @endif
                                </div>

                                <div>
                                    <h3 class="font-bold text-gray-900"> 
                                        {{ $item->category->name ?? 'Kategori' }}
                                    </h3>
                                    <div class="mt-3 space-y-2 text-xs text-gray-500">

                                    <div class="flex items-start gap-2">
                                        <span class="leading-5">
                                            {{ $item->address }}
                                        </span>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <span>
                                            {{ $item->created_at->translatedFormat('d F Y') }}
                                            •
                                            {{ $item->created_at->format('H:i') }} WIB
                                        </span>
                                    </div>

                                </div>
                                </div>
                            <div>
                                <span class="rounded-full bg-green-100 px-3 py-1 text-xs text-green-700">
                                    {{ $item->status->name }}
                                    </span>

                                    <a href="{{ route('detailLaporan', $item->id) }}" class="mt-3 block rounded-lg border border-blue-500 px-4 py-2 text-center text-xs text-blue-600">
                                    Lihat Detail
                                    </a>
                                </div>
                            </div>
                            @endforeach

                            
                            {{-- <div class="grid grid-cols-1 gap-4 rounded-lg border border-gray-200 p-4 md:grid-cols-[150px_1fr_auto] md:items-center">
                                <div class="h-28 rounded-lg bg-gray-200"></div>

                                <div>
                                    <h3 class="font-bold text-gray-900">{{ $item[0] }}</h3>
                                    <p class="mt-1 text-sm text-gray-500">{{ $item[1] }}</p>

                                    <div class="mt-3 flex flex-wrap gap-4 text-xs text-gray-500">
                                        <span><i class="fa-solid fa-location-dot mr-1"></i>{{ $item[2] }}</span>
                                        <span><i class="fa-regular fa-calendar mr-1"></i>{{ $item[3] }}</span>
                                    </div>
                                </div>

                                <div class="flex flex-col gap-2 md:items-end">
                                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                        <i class="fa-solid fa-check mr-1"></i>{{ $item[4] }}
                                    </span>

                                    <span class="rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold text-orange-600">
                                        <i class="fa-solid fa-arrow-up mr-1"></i>{{ $item[5] }}
                                    </span>

                                    <a href="{{ route('detailLaporan') }}"
                                        class="mt-2 rounded-lg border border-blue-500 px-4 py-2 text-center text-xs font-semibold text-blue-600 hover:bg-blue-50">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        @endforeach
                            </div> --}}
                    </div>
                </div>

                <div class="space-y-5">
                    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-md">
                        <h2 class="mb-4 text-sm font-bold">Peta Sebaran Laporan</h2>

                        <div class="relative z-0 h-72 overflow-hidden rounded-lg bg-gray-200">
                            <div id="map" class="h-full w-full"></div>
                        </div>

                        <button class="mt-4 w-full rounded-lg bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                            <i class="fa-solid fa-location-dot mr-2 text-blue-600"></i>
                            Buka Peta
                        </button>
                    </div>

                    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-md">
                        <div class="mb-5 flex items-center gap-3">
                            <span class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-600 text-white">
                                <i class="fa-solid fa-info"></i>
                            </span>
                            <h2 class="font-bold">Informasi untuk Warga</h2>
                        </div>

                        <div class="space-y-4 text-sm text-gray-600">
                            <p><i class="fa-regular fa-user mr-3 text-blue-600"></i>Data Pelapor disamarkan</p>
                            <p><i class="fa-solid fa-shield-halved mr-3 text-blue-600"></i>Hanya laporan valid yang ditampilkan</p>
                            <p><i class="fa-solid fa-arrows-rotate mr-3 text-blue-600"></i>Status diperbarui oleh admin</p>
                        </div>
                    </div>
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