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
                    SUKABUMI SMART CITY
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
                        <span class="flex h-11 w-11 items-center justify-center rounded-lg bg-blue-600 text-white">
                            <i class="fa-solid fa-circle-check"></i>
                        </span>

                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">{{ $verifiedReports }}</h3>
                            <p class="text-xs text-gray-500">Diverifikasi</p>
                        </div>
                    </div>

                <!-- Dalam Proses -->
                <div class="flex items-center gap-4 rounded-md border border-gray-200 p-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-md bg-yellow-100">
                        <i class="fa-solid fa-clock text-xl text-yellow-500"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">{{$processReports}}</h3>
                        <p class="text-xs text-gray-500">Dalam Proses</p>
                    </div>
                </div>

                <!-- Selesai -->
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
                    <a href="" class="text-xs font-medium text-blue-600">Lihat Semua</a>
                </div>

                <div class="space-y-4">
                    @foreach ([
                        ['1', 'Jalan Raya Cibadak', 'Cibadak, Sukabumi', '127 laporan • Risiko Tinggi', '90%', 'bg-red-600'],
                        ['2', 'Jalan Cisaat', 'Cisaat, Sukabumi', '94 laporan • Risiko Tinggi', '90%', 'bg-orange-500'],
                        ['3', 'Jalan ParungKuda', 'Parungkuda, Sukabumi', '72 laporan • Risiko Sedang', '90%', 'bg-yellow-500'],
                        ['4', 'Jalan Sukaraja', 'Sukaraja, Sukabumi', '56 laporan • Risiko Sedang', '90%', 'bg-green-600'],
                        ['5', 'Jalan Warudoyong', 'Warudoyong, Sukabumi', '42 laporan • Risiko Rendah', '90%', 'bg-blue-600']
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

<section class="bg-white px-5 py-10 sm:px-8 lg:px-12">
    <div class="mx-auto max-w-7xl">
        <div class="grid grid-cols-1 items-center gap-8 rounded-3xl bg-slate-900 p-6 text-white shadow-lg lg:grid-cols-2 lg:p-10">

            <!-- LEFT -->
            <div>
                <span class="rounded-full bg-blue-600 px-4 py-1 text-xs font-semibold">
                    Blockchain Transparency
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

    @include('footer')

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