<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <title>Home User</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="overflow-x-hidden bg-white text-black dark:bg-black dark:text-white">
    @include('navbar')
    {{-- section 1 --}}
    <section
        class="relative min-h-[360px] sm:min-h-[420px] lg:min-h-[45rem] py-[2rem] px-[1rem] sm:py-[2rem] sm:px-[1rem] md:py-[2rem] xl:py-[6rem] flex items-center bg-cover bg-center"
        style="background-image: url('{{ asset('img/hero.jpeg') }}');">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-900/70 to-slate-900/30"></div>
        <div class="relative z-10 w-full max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
            <div class="max-w-[45rem]">
                <span
                    class="inline-flex px-3 py-1 rounded-full bg-green-600 text-white text-[10px] sm:text-xs font-semibold">
                    SUKABUMI SMART CITY
                </span>

                <h1 class="mt-4 text-2xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight">
                    Bersama Warga,
                    <br class="hidden sm:block-0.5">
                    Bangun Infrastruktur yang Lebih Baik
                </h1>

                <p class="mt-3 text-xs sm:text-sm lg:text-base text-gray-200 leading-relaxed max-w-md">
                    Laporkan kerusakan infrastruktur di sekitar Anda,
                    pantau status penanganan, dan wujudkan Sukabumi yang
                    lebih nyaman.
                </p>

                <div class="mt-6 flex flex-col sm:flex-row gap-3 sm:gap-4">
                    <a href="#"
                        class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-md bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium transition">
                        <span class="w-4 h-4 rounded-full bg-white/80"></span>
                        Laporkan Sekarang
                    </a>

                    <a href="#"
                        class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-md bg-white hover:bg-gray-100 text-gray-800 text-sm font-medium transition">
                        <span class="w-4 h-4 rounded-full bg-gray-300"></span>
                        Lihat Peta
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- section 2 --}}
    <section class="bg-gray-50 px-5 py-6 sm:px-8 lg:px-12">
    <div class="mx-auto max-w-7xl space-y-4">

        <div class="rounded-xl bg-white p-4 shadow-md">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-sm font-bold text-gray-900">Ringkasan Laporan</h2>
                <a href="#" class="text-xs font-medium text-blue-600">Lihat Semua Statistik ›</a>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <div class="flex items-center gap-4 rounded-md border border-gray-200 p-4">
                    <div class="h-10 w-10 rounded-md bg-red-600"></div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">3.241</h3>
                        <p class="text-xs text-gray-500">Total Laporan</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-md border border-gray-200 p-4">
                    <div class="h-10 w-10 rounded-md bg-yellow-400"></div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">876</h3>
                        <p class="text-xs text-gray-500">Dalam proses</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-md border border-gray-200 p-4">
                    <div class="h-10 w-10 rounded-md bg-green-600"></div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">2.134</h3>
                        <p class="text-xs text-gray-500">Selesai</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 rounded-md border border-gray-200 p-4">
                    <div class="h-10 w-10 rounded-md bg-purple-700"></div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">231</h3>
                        <p class="text-xs text-gray-500">Belum Diverifikasi</p>
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
                    <div class="absolute left-[20%] top-[18%] rounded-full bg-red-600 px-3 py-1 text-xs font-bold text-white">12</div>
                    <div class="absolute left-[50%] top-[22%] rounded-full bg-yellow-500 px-3 py-1 text-xs font-bold text-white">8</div>
                    <div class="absolute left-[63%] top-[35%] rounded-full bg-red-600 px-3 py-1 text-xs font-bold text-white">8</div>
                    <div class="absolute left-[30%] top-[58%] rounded-full bg-red-500 px-3 py-1 text-xs font-bold text-white">3</div>
                    <div class="absolute left-[42%] top-[48%] rounded-full bg-yellow-500 px-3 py-1 text-xs font-bold text-white">14</div>
                    <div class="absolute right-[14%] top-[38%] rounded-full bg-green-600 px-3 py-1 text-xs font-bold text-white">25</div>

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
                    @foreach ([
                        ['1', 'Jalan Raya Cibadak', 'Cibadak, Sukabumi', '127 laporan • Risiko Tinggi', 'Skor 95', 'bg-red-600'],
                        ['2', 'Jalan Cisaat', 'Cisaat, Sukabumi', '94 laporan • Risiko Tinggi', 'Skor 91', 'bg-orange-500'],
                        ['3', 'Jalan ParungKuda', 'Parungkuda, Sukabumi', '72 laporan • Risiko Sedang', 'Skor 88', 'bg-yellow-500'],
                        ['4', 'Jalan Sukaraja', 'Sukaraja, Sukabumi', '56 laporan • Risiko Sedang', 'Skor 75', 'bg-green-600'],
                        ['5', 'Jalan Warudoyong', 'Warudoyong, Sukabumi', '42 laporan • Risiko Rendah', 'Skor 65', 'bg-blue-600']
                    ] as $item)
                        <div class="flex items-center justify-between gap-3">
                            <div class="flex items-start gap-3">
                                <span class="flex h-7 w-7 items-center justify-center rounded-full bg-gray-200 text-xs font-bold text-gray-700">
                                    {{ $item[0] }}
                                </span>
                                <div>
                                    <h3 class="text-sm font-bold text-gray-900">{{ $item[1] }}</h3>
                                    <p class="text-xs text-gray-500">{{ $item[2] }}</p>
                                    <p class="text-xs text-gray-500">{{ $item[3] }}</p>
                                </div>
                            </div>

                            <span class="{{ $item[5] }} rounded-md px-4 py-1 text-xs font-bold text-white">
                                {{ $item[4] }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    const map = L.map('map').setView([-6.9175, 106.9296], 11);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    L.marker([-6.9175, 106.9296])
        .addTo(map)
        .bindPopup('Laporan Jalan Rusak');
</script>
</body>
</html>