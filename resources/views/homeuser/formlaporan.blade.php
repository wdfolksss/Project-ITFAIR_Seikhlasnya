<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Form Laporan | Kelawar</title>
</head>
<body>
    @include('navbar')
    <section class="font-montserrat min-h-screen bg-gray-50 px-5 py-10 sm:px-8 lg:px-12">
    <div class="mx-auto max-w-7xl">

        <div class="mb-6">
            <div class="flex items-center gap-2 text-xs text-gray-500">
                <a href="{{ route('homeuser') }}" class="text-blue-600 hover:text-blue-700 hover:underline">
                    Beranda
                </a>
                <span>›</span>
                <span>Laporan Kerusakan</span>
            </div>

            <h1 class="mt-4 text-2xl font-bold text-gray-900 sm:text-3xl">
                Laporkan Kerusakan Infrastruktur
            </h1>

            <p class="mt-2 text-sm text-gray-500">
                Isi formulir berikut agar laporan dapat diverifikasi admin sebelum ditindaklanjuti.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <div class="rounded-2xl bg-white p-6 shadow-md lg:col-span-2">
                <h2 class="mb-5 text-lg font-bold text-gray-900">Form Laporan</h2>
                <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">     
                    @csrf               
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-gray-700">Nama Pelapor</label>
                            <input type="text" name="reporter_name" placeholder="Masukkan nama lengkap Anda"
                                class="w-full rounded-lg border border-gray-200 bg-gray-100 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:bg-white">
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-semibold text-gray-700">No. HP / Email</label>
                            <input type="text" name="contact" placeholder="Contoh: 0812XXXXX atau nama@email.com"
                                class="w-full rounded-lg border border-gray-200 bg-gray-100 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:bg-white">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-gray-700">Kategori Kerusakan</label>
                            <select name="category_id"
                                class="w-full rounded-lg border border-gray-200 bg-gray-100 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:bg-white">
                                <option value="">Pilih kategori kerusakan</option>
                                <option value="1">Jalan Rusak</option>
                                <option value="2">Jembatan</option>
                                <option value="3">Lampu Jalan</option>
                                <option value="4">Drainase</option>
                            </select>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-semibold text-gray-700">
                                Tingkat Kerusakan
                            </label>
                            
                            <div class="grid grid-cols-3 gap-3">
                                <label class="cursor-pointer">
                                    <input type="radio" name="severity" value="ringan" class="peer hidden">
                                    <div class="rounded-lg bg-gray-100 px-4 py-3 text-center text-sm text-gray-600 peer-checked:bg-blue-600 peer-checked:text-white">
                                        Ringan
                                    </div>
                                </label>

                                <label class="cursor-pointer">
                                    <input type="radio" name="severity" value="sedang" class="peer hidden">
                                    <div class="rounded-lg bg-gray-100 px-4 py-3 text-center text-sm text-gray-600 peer-checked:bg-blue-600 peer-checked:text-white">
                                        Sedang
                                    </div>
                                </label>

                                <label class="cursor-pointer">
                                    <input type="radio" name="severity" value="berat" class="peer hidden">
                                    <div class="rounded-lg bg-gray-100 px-4 py-3 text-center text-sm text-gray-600 peer-checked:bg-blue-600 peer-checked:text-white">
                                        Berat
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="w-full">
                        <label class="mb-2 block text-sm font-semibold text-gray-700">Alamat Detail</label>
                        <input type="text" name="address" placeholder="Masukkan alamat detail atau titik acuan terdekat"
                            class="w-full rounded-lg border border-gray-200 bg-gray-100 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:bg-white">
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Titik Lokasi pada Peta
                        </label>

                        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                            <div class="relative z-0 h-64 overflow-hidden rounded-xl bg-gray-200 md:col-span-2">
                                <div id="map" class="z-0 h-full w-full"></div>
                            </div>

                            <div class="flex flex-col justify-between rounded-lg bg-gray-100 p-4">
                                <p class="text-xs text-gray-600">
                                    Klik titik lokasi kerusakan pada peta. Koordinat akan terisi otomatis.
                                </p>

                                <div class="mt-4 space-y-3">
                                    <input type="text" id="latitude" name="latitude" placeholder="Latitude"
                                        class="w-full rounded-lg border border-gray-200 px-3 py-2 text-xs">

                                    <input type="text" id="longitude" name="longitude" placeholder="Longitude"
                                        class="w-full rounded-lg border border-gray-200 px-3 py-2 text-xs">

                                    <input type="hidden" id="district" name="district">

                                    <button type="button" id="pilihLokasi"
                                        class="w-full rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                                        Pilih Lokasi
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-gray-700">Deskripsi / Detail Lokasi</label>
                        <textarea rows="4" name="description" placeholder="Jelaskan kondisi kerusakan, penyebab jika diketahui, dan dampaknya. Lalu Sertakan Detail Lokasinya"
                            class="w-full resize-none rounded-lg border border-gray-200 bg-gray-100 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:bg-white"></textarea>
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-semibold text-gray-700">
                            Unggah Foto
                        </label>
                        <p class="mb-3 text-xs text-gray-500">
                            Maksimal 1 Foto (JPG, PNG, JPEG)
                        </p>
                        
                        <div id="notifFoto"
                            class="hidden mb-3 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-xs font-medium text-red-600">
                        </div>

                        <div id="preview-container" class="mb-3"></div>

                        <label id="uploadBox"
                            class="flex h-28 cursor-pointer flex-col items-center justify-center rounded-lg border border-dashed border-gray-300 bg-white text-sm text-gray-600 hover:bg-gray-50">
                            <span class="text-2xl text-blue-600">＋</span>
                            Tambah Foto
                            <input type="file" id="fotoInput" name="image" class="hidden" accept="image/*">
                        </label>
                    </div>
                     
                    <div class="pt-4">
                        <label class="flex items-start gap-3 text-sm text-gray-600">
                            <input type="checkbox" class="mt-1 h-4 w-4 rounded border-gray-300">
                            Saya menyatakan laporan yang saya kirim sesuai kondisi sebenarnya.
                        </label>

                        <div class="mt-5 flex gap-3">                                           
                            <button type="submit" class="cursor-pointer rounded-lg bg-blue-600 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-700">
                                Kirim Laporan
                            </button>
                            <button type="reset" class="cursor-pointer rounded-lg border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-100">
                                Reset Form
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="space-y-5">
                <div class="rounded-2xl bg-white p-6 shadow-md">
                    <h2 class="text-lg font-bold text-black">Panduan Laporan</h2>
                    <div class="mt-5 space-y-4">
                        <div class="flex gap-3">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full text-blue-600">
                                <i class="fa-solid fa-circle-check text-lg"></i>
                            </span>
                            <p class="text-sm text-gray-600"><span class="font-bold text-gray-900">Berikan informasi yang jelas dan lengkap</span>
                                <br>Isi seluruh data dengan benar agar mudah diverifikasi.</p>
                        </div>

                        <div class="flex gap-3">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full text-blue-600">
                                <i class="fa-solid fa-circle-check text-lg"></i>
                            </span>
                            <p class="text-sm text-gray-600"><span class="font-bold text-gray-900">Pilih lokasi yang tepat pada peta</span>
                                <br>Pastikan titik lokasi sesuai dengan lokasi kerusakan.</p>
                        </div>

                        <div class="flex gap-3">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full text-blue-600">
                                <i class="fa-solid fa-circle-check text-lg"></i>
                            </span>
                            <p class="text-sm text-gray-600"><span class="font-bold text-gray-900">Unggah foto yang jelas</span>
                                <br>Foto membantu admin memahami kondisi kerusakan dengan lebih akurat.</p>
                        </div>

                        <div class="flex gap-3">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full text-blue-600">
                                <i class="fa-solid fa-circle-check text-lg"></i>
                            </span>
                            <p class="text-sm text-gray-600"><span class="font-bold text-gray-900">Gunakan bahasa yang sopan</span>
                                <br>Laporan yang baik mempercepat proses tindak lanjut.</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl bg-white p-6 shadow-md">
                    <h2 class="text-lg font-bold text-black">Alur Laporan</h2>
                    <div class="mt-5 space-y-4">
                        <div class="flex gap-3">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full text-blue-600">
                                <i class="fa-solid fa-paper-plane text-lg"></i>
                            </span>
                            <p class="text-sm text-gray-600"><span class="font-bold text-gray-900">Laporan Dikirim</span>
                                <br>Laporan Anda berhasil dikirim dan masuk ke sistem.</p>
                        </div>

                        <div class="flex gap-3">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full text-blue-600">
                                <i class="fa-solid fa-magnifying-glass text-lg"></i>
                            </span>
                            <p class="text-sm text-gray-600"><span class="font-bold text-gray-900">Verifikasi Admin</span>
                                <br>Admin memeriksa kelengkapan dan kebenaran laporan.</p>
                        </div>

                        <div class="flex gap-3">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full text-blue-600">
                                <i class="fa-solid fa-globe text-lg"></i>
                            </span>
                            <p class="text-sm text-gray-600"><span class="font-bold text-gray-900">Masuk ke Laporan Publik</span>
                                <br>Laporan yang valid akan tampil di halaman Laporan Publik.</p>
                        </div>

                        <div class="flex gap-3">
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full text-blue-600">
                                <i class="fa-solid fa-screwdriver-wrench text-lg"></i>
                            </span>
                            <p class="text-sm text-gray-600"><span class="font-bold text-gray-900">Proses Penanganan</span>
                                <br>Laporan diteruskan ke instansi terkait untuk ditindaklanjuti.</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl bg-white p-6 shadow-md">
                    <h2 class="text-lg font-bold text-black">Kategori Kerusakan</h2>
                    <div class="mt-5 space-y-4">
                        <div class="grid grid-cols-3 gap-3">
                            <div class="flex items-center gap-2 rounded-lg bg-blue-50 px-3 py-2 text-xs text-blue-600">
                                <i class="fa-solid fa-road"></i>
                                <span>Jalan</span>
                            </div>

                            <div class="flex items-center gap-2 rounded-lg bg-cyan-50 px-3 py-2 text-xs text-cyan-600">
                                <i class="fa-solid fa-bridge"></i>
                                <span>Jembatan</span>
                            </div>

                            <div class="flex items-center gap-2 rounded-lg bg-yellow-50 px-3 py-2 text-xs text-yellow-600">
                                <i class="fa-regular fa-lightbulb"></i>
                                <span>Lampu</span>
                            </div>

                            <div class="flex items-center gap-2 rounded-lg bg-green-50 px-4 py-3 text-xs text-green-600">
                                <i class="fa-solid fa-droplet"></i>
                                <span>Drainase</span>
                            </div>
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
    document.getElementById('pilihLokasi').addEventListener('click', function () {
        alert('Silakan klik titik kerusakan pada peta.');
    });
    
    const map = L.map('map').setView([-6.9277, 106.9299], 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    let marker;
    map.on('click', function(e) {
        const lat = e.latlng.lat;
        const lng = e.latlng.lng;
        
        // Isi input koordinat otomatis
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;
        
        if (marker) {
            map.removeLayer(marker);
        }
        marker = L.marker([lat, lng]).addTo(map)
            .bindPopup('Lokasi kerusakan dipilih')
            .openPopup();

        // --- HACK BARU: AMBIL ALAMAT OTOMATIS (REVERSE GEOCODING) ---
        const alamatInput = document.querySelector('input[name="address"]');
        alamatInput.value = "Mencari alamat...";

        fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`)
            .then(response => response.json())
            .then(data => {


                if (data && data.display_name) {

                alamatInput.value = data.display_name;

                document.getElementById('district').value =
                    data.address.suburb ??
                    data.address.city_district ??
                    data.address.village ??
                    data.address.town ??
                    data.address.city ??
                    '';

                console.log(data.address);
            }
            })
            .catch(error => {
                console.error('Error Geocoding:', error);
                alamatInput.value = ""; 
            });
    });
</script>

<script>
    const fotoInput = document.getElementById('fotoInput');
    const previewContainer = document.getElementById('preview-container');
    const notifFoto = document.getElementById('notifFoto');
    const uploadBox = document.getElementById('uploadBox');

    fotoInput.addEventListener('change', function () {
        const file = this.files[0];

        if (!file) return;

        if (!file.type.startsWith('image/')) {
            showNotif('File harus berupa gambar.');
            this.value = '';
            return;
        }

        if (file.size > 2 * 1024 * 1024) {
            showNotif('Ukuran foto maksimal 2MB.');
            this.value = '';
            return;
        }

        const reader = new FileReader();

        reader.onload = function (e) {
            uploadBox.classList.add('hidden');

            previewContainer.innerHTML = `
                <div class="relative">
                    <a href="${e.target.result}" target="_blank">
                        <img
                            src="${e.target.result}"
                            class="h-40 w-full rounded-lg border border-gray-200 object-cover hover:opacity-80"
                            alt="Preview Foto">
                    </a>
                    <button
                        type="button"
                        id="hapusFoto"
                        class="absolute right-2 top-2 flex h-7 w-7 items-center justify-center rounded-full bg-red-600 text-sm font-bold text-white shadow hover:bg-red-700">
                        ×
                    </button>
                </div>
            `;

            document.getElementById('hapusFoto').addEventListener('click', function () {
                fotoInput.value = '';
                previewContainer.innerHTML = '';
                uploadBox.classList.remove('hidden');
            });
        };

        reader.readAsDataURL(file);
    });

    function showNotif(message) {
        notifFoto.textContent = message;
        notifFoto.classList.remove('hidden');

        setTimeout(() => {
            notifFoto.classList.add('hidden');
        }, 2500);
    }
</script>
</body>
</html>