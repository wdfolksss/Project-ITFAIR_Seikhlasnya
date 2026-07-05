<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-gray-50 text-gray-900">

    @include('navbar')

    <section class="px-5 py-8 sm:px-8 lg:px-12">
        <div class="mx-auto max-w-7xl">

            <div class="mb-5">
                <div class="flex items-center gap-2 text-xs text-gray-500">
                    <a href="{{ route('homeuser') }}" class="text-blue-600 hover:underline">Beranda</a>
                    <span>›</span>
                    <a href="{{ route('laporanPublik') }}" class="text-blue-600 hover:underline">Laporan Publik</a>
                    <span>›</span>
                    <span>Detail Laporan</span>
                </div>

                {{-- <a href="{{ route('laporanPublik') }}"
                    class="mt-4 inline-flex items-center gap-2 text-sm font-medium text-blue-600 hover:underline">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali ke Daftar Laporan
                </a> --}}
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                <div class="space-y-5 lg:col-span-2">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">
                           {{ $report->category->name }}
                        </h1>

                        <p class="mt-2 text-sm text-gray-500">
                            {{ $report->description }}
                        </p>
                    </div>

                    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-md">
                        <div class="flex border-b border-gray-200">
                            <button
                                class="border-b-2 border-blue-600 px-5 py-3 text-sm font-semibold text-blue-600">
                                Detail Laporan
                            </button>

                            <button class="px-5 py-3 text-sm font-medium text-gray-500">
                                Dokumentasi
                            </button>

                            <button class="px-5 py-3 text-sm font-medium text-gray-500">
                                Tanggapan
                            </button>
                        </div>

                        <div class="divide-y divide-gray-200 text-sm">
                            <div class="grid grid-cols-1 gap-2 px-5 py-4 sm:grid-cols-[160px_1fr]">
                                <p class="font-semibold text-gray-900">Lokasi</p>
                                <div>
                                    <p class="text-gray-600">
                                        {{ $report->address }}
                                    </p>
                                    <a href="#" class="text-xs font-medium text-blue-600 hover:underline">
                                        Lihat di Peta
                                    </a>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 gap-2 px-5 py-4 sm:grid-cols-[160px_1fr]">
                                <p class="font-semibold text-gray-900">Kategori</p>
                                <p class="text-gray-600">
                                    {{ $report->category->name }}
                                </p>
                            </div>

                            <div class="grid grid-cols-1 gap-2 px-5 py-4 sm:grid-cols-[160px_1fr]">
                                <p class="font-semibold text-gray-900">Prioritas</p>
                                <p>
                                    <span
                                        class="rounded-full px-3 py-1 text-xs font-semibold
                                        {{ $report->severity == 'ringan' ? 'bg-green-100 text-green-600' : '' }}
                                        {{ $report->severity == 'sedang' ? 'bg-yellow-100 text-yellow-600' : '' }}
                                        {{ $report->severity == 'berat' ? 'bg-red-100 text-red-600' : '' }}">
                                        
                                        Prioritas {{ ucfirst($report->severity) }}
                                    </span>
                                </p>
                            </div>

                            <div class="grid grid-cols-1 gap-2 px-5 py-4 sm:grid-cols-[160px_1fr]">
                                <p class="font-semibold text-gray-900">Dibuat Oleh</p>
                                <div class="flex items-center gap-3">
                                    <span class="flex h-7 w-7 items-center justify-center rounded-full bg-gray-200">
                                        <i class="fa-regular fa-user text-xs text-gray-500"></i>
                                    </span>

                                    <span class="font-medium text-gray-700">Warga</span>

                                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-600">
                                        Terverifikasi
                                    </span>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 gap-2 px-5 py-4 sm:grid-cols-[160px_1fr]">
                                <p class="font-semibold text-gray-900">Tanggal Laporan</p>
                                <p class="text-gray-600">
                                    <i class="fa-regular fa-calendar mr-2 text-gray-500"></i>
                                    {{ $report->created_at->format('d M Y, H:i') }}
                                </p>
                            </div>

                            <div class="grid grid-cols-1 gap-2 px-5 py-4 sm:grid-cols-[160px_1fr]">
                                <p class="font-semibold text-gray-900">Terakhir Update</p>
                                <p class="text-gray-600">
                                    <i class="fa-regular fa-calendar-check mr-2 text-gray-500"></i>
                                    {{ $report->updated_at->format('d M Y, H:i') }}
                                </p>
                            </div>

                            <div class="grid grid-cols-1 gap-2 px-5 py-4 sm:grid-cols-[160px_1fr]">
                                <p class="font-semibold text-gray-900">Deskripsi</p>
                                <p class="leading-relaxed text-gray-600">
                                    {{ $report->description }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-md">

                        <h2 class="mb-4 text-sm font-bold text-gray-900">
                            Dokumentasi Laporan
                        </h2>

                        @if ($report->image)
                            <img
                                src="{{ asset('storage/' . $report->image) }}"
                                class="w-full object-cover rounded-lg border"
                                alt="Dokumentasi Laporan"
                            >
                        @else
                            <p class="text-sm text-gray-400">
                                Belum ada dokumentasi
                            </p>
                        @endif

                    </div>

                    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-md">
                        <h2 class="mb-4 text-sm font-bold text-gray-900">
                            Tanggapan dari Pihak Terkait
                        </h2>

                        <div class="rounded-lg bg-gray-100 p-4">
                            <div class="flex items-start gap-4">
                                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-orange-500 text-white">
                                    <i class="fa-solid fa-building"></i>
                                </span>

                                <div>
                                    <div class="flex flex-wrap items-center gap-2">
                                        <h3 class="text-sm font-bold text-gray-900">
                                            Dinas Pekerjaan Umum Kabupaten Sukabumi
                                        </h3>

                                        <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-600">
                                            Pihak Terkait
                                        </span>
                                    </div>

                                    <p class="mt-1 text-xs text-gray-500">
                                        15 Mei 2025, 09:20 WIB
                                    </p>

                                    <p class="mt-2 text-sm leading-relaxed text-gray-600">
                                        Terima kasih atas laporannya, kami sudah menjadwalkan tim untuk melakukan
                                        survei lokasi dan segera melakukan koordinasi untuk perbaikan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <aside class="space-y-5 lg:mt-[85px]">
                    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-md">
                        <h2 class="mb-4 text-sm font-bold text-gray-900">
                            Lokasi Laporan
                        </h2>

                        <div class="relative z-0 h-64 overflow-hidden rounded-lg bg-gray-200">
                            <div id="detailMap" class="h-full w-full"></div>
                        </div>

                        <div class="mt-4 text-sm text-gray-600">
                            <p>{{ $report->address }}</p>
                            <p class="mt-1 text-xs text-gray-500">Jawa Barat 43351</p>

                            <a href="#" class="mt-2 inline-block text-xs font-semibold text-blue-600 hover:underline">
                                Buka di Google Maps
                            </a>
                        </div>
                    </div>

                    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-md">
                        <h2 class="mb-5 text-sm font-bold text-gray-900">
                            Status Laporan
                        </h2>

                        <div class="space-y-5">
                            <div class="flex gap-3">
                                <span class="mt-1 h-3 w-3 shrink-0 rounded-full bg-green-600"></span>

                                <div>
                                    <h3 class="text-sm font-bold text-gray-900">Diverifikasi</h3>
                                    <p class="text-xs text-gray-500">
                                        Laporan telah diverifikasi oleh admin.
                                    </p>
                                    <p class="mt-1 text-xs text-gray-400">
                                        12 Mei 2025, 11:15 WIB
                                    </p>
                                </div>
                            </div>

                            <div class="flex gap-3">
                                <span class="mt-1 h-3 w-3 shrink-0 rounded-full bg-orange-500"></span>

                                <div>
                                    <h3 class="text-sm font-bold text-gray-900">Dalam Proses</h3>
                                    <p class="text-xs text-gray-500">
                                        Laporan sedang ditindaklanjuti oleh pihak terkait.
                                    </p>
                                    <p class="mt-1 text-xs text-gray-400">
                                        15 Mei 2025, 09:20 WIB
                                    </p>
                                </div>
                            </div>

                            <div class="flex gap-3">
                                <span class="mt-1 h-3 w-3 shrink-0 rounded-full bg-gray-300"></span>

                                <div>
                                    <h3 class="text-sm font-bold text-gray-900">Menunggu Penyelesaian</h3>
                                    <p class="text-xs text-gray-500">
                                        Proses perbaikan sedang menunggu jadwal lapangan.
                                    </p>
                                    <p class="mt-1 text-xs text-gray-400">
                                        18 Mei 2025, 14:45 WIB
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-md">
                        <h2 class="text-sm font-bold text-gray-900">
                            Laporkan masalah serupa di lokasi ini
                        </h2>

                        <p class="mt-2 text-sm text-gray-500">
                            Bantu kami memantau infrastruktur di sekitar Anda.
                        </p>

                        <a href="{{ route('formLaporan') }}"
                            class="mt-4 inline-flex w-full items-center justify-center rounded-lg bg-blue-600 px-4 py-3 text-sm font-semibold text-white hover:bg-blue-700">
                            Buat Laporan Baru
                        </a>
                    </div>
                </aside>

            </div>
        </div>
    </section>

    @include('footer')

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        const lat = {{ $report->latitude }};
        const lng = {{ $report->longitude }};

        const detailMap = L.map('detailMap').setView([lat, lng], 16);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap'
        }).addTo(detailMap);

        L.marker([lat, lng])
            .addTo(detailMap)
            .bindPopup("Lokasi Laporan")
            .openPopup();

        setTimeout(() => detailMap.invalidateSize(), 300);
    </script>

</body>

</html>