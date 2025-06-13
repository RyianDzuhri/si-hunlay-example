<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengajuan Warga</title>
    <!-- Tailwind CSS CDN - Pastikan Anda memuat ini jika tidak menggunakan PostCSS/Webpack -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Contoh font Inter, jika Anda ingin menggunakannya -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Tambahkan link Google Fonts untuk Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            /* Mengubah font-family menjadi Poppins */
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .form-container {
            background-color: #ffffff;
            padding: 2.5rem;
            border-radius: 0.75rem; /* rounded-lg */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* shadow-md */
            max-width: 28rem; /* max-w-md */
            width: 100%;
        }
        select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='currentColor'%3E%3Cpath fill-rule='evenodd' d='M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z' clip-rule='evenodd'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem; /* Untuk memberi ruang pada ikon panah */
        }
    </style>
</head>
<body>
    <div class="max-w-5xl mx-auto px-4 py-6">
        <div class="mb-4 text-sm text-gray-500"><a href="{{ route('warga.dashboard') }}">Dashboard</a> > Pengajuan RTLH</div>
        <h1 class="text-2xl font-bold mb-1">Formulir Pengajuan Bantuan RTLH</h1>
        <p class="text-gray-600 mb-6">Silahkan lengkapi formulir di bawah ini dengan data yang benar</p>
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg" role="alert">
                <p class="font-bold mb-2">Terjadi Kesalahan, mohon periksa kembali isian Anda:</p>
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- Penting: Tambahkan enctype="multipart/form-data" untuk upload file --}}
        <form id="form" action="{{ route('warga.pengajuan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Data Lokasi -->
            <div class="bg-white shadow rounded-lg p-4 mb-6">
                <h2 class="text-base font-semibold mb-3 border-l-4 border-blue-500 pl-2">Data Lokasi</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- Kecamatan -->
                    <div>
                        <label for="lokasi_kecamatan" class="block text-sm text-gray-700 mb-1">Kecamatan</label>
                        <select id="lokasi_kecamatan" name="kecamatan_id"
                                class="w-full border border-gray-300 rounded px-3 py-2 text-sm text-gray-700 focus:outline-none focus:ring focus:ring-blue-400">
                            <option value="" class="text-gray-400">-- Pilih Kecamatan --</option>
                            @foreach($kecamatans as $kecamatan)
                                <option value="{{ $kecamatan->id }}">{{ $kecamatan->nama_kecamatan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Kelurahan -->
                    <div>
                        <label for="lokasi_kelurahan" class="block text-sm text-gray-700 mb-1">Kelurahan</label>
                        <select id="lokasi_kelurahan" name="kelurahan_id"
                                class="w-full border border-gray-300 rounded px-3 py-2 text-sm text-gray-700 focus:outline-none focus:ring focus:ring-blue-400"
                                disabled>
                            <option value="" class="text-gray-400">Pilih Kecamatan Terlebih Dahulu</option>
                        </select>
                    </div>

                    <!-- Alamat -->
                    <div class="md:col-span-2">
                        <label for="alamat_lengkap" class="block text-sm text-gray-700 mb-1">Alamat Lengkap</label>
                        <textarea id="alamat_lengkap" name="alamat_lengkap"
                                rows="2"
                                class="w-full border border-gray-300 rounded px-3 py-2 text-sm text-gray-700 focus:outline-none focus:ring focus:ring-blue-400"
                                placeholder="Contoh: Jl. Mawar No.10 RT 03 / RW 05"></textarea>
                    </div>
                </div>
            </div>

            <!-- Administrasi -->
            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <h2 class="text-lg font-semibold mb-4 border-l-4 border-blue-500 pl-2">Administrasi</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    {{-- No. KK --}}
                    <div>
                        <label for="no_kk" class="block text-sm font-medium text-gray-700">No. KK</label>
                        <input type="text" id="no_kk" name="no_kk"
                            value="{{ $warga->no_kk ?? '' }}"
                            readonly
                            class="w-full mt-1 border border-gray-300 rounded px-3 py-2 bg-gray-100 text-sm text-gray-700 cursor-not-allowed">
                    </div>

                    {{-- NIK --}}
                    <div>
                        <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                        <input type="text" id="nik" name="nik"
                            value="{{ $warga->nik ?? '' }}"
                            readonly
                            class="w-full mt-1 border border-gray-300 rounded px-3 py-2 bg-gray-100 text-sm text-gray-700 cursor-not-allowed">
                    </div>

                    {{-- Pekerjaan --}}
                    <div>
                        <label for="pekerjaan" class="block text-sm font-medium text-gray-700">Pekerjaan Utama</label>
                        <select name="pekerjaan" id="pekerjaan"
                                class="w-full mt-1 border border-gray-300 rounded px-3 py-2 text-sm text-gray-700">
                            <option value="" class="text-gray-400">-- Pilih Pekerjaan --</option>
                            <option value="buruh_harian">Buruh Harian</option>
                            <option value="petani">Petani</option>
                            <option value="nelayan">Nelayan</option>
                            <option value="tidak_bekerja">Tidak Bekerja</option>
                        </select>
                    </div>

                    {{-- Penghasilan --}}
                    <div>
                        <label for="penghasilan" class="block text-sm font-medium text-gray-700">Penghasilan Perbulan</label>
                        <select name="penghasilan" id="penghasilan"
                                class="w-full mt-1 border border-gray-300 rounded px-3 py-2 text-sm text-gray-700">
                            <option value="" class="text-gray-400">-- Pilih Nominal --</option>
                            <option value="1200000">&lt; 1,2 juta</option>
                            <option value="2000000">1,9 - 2,1 juta</option>
                            <option value="2400000">2,2 - 2,6 juta</option>
                            <option value="2750000">2,7 - 2,8 juta</option>
                            <option value="2900000">&gt; 2,8 juta</option>
                        </select>
                    </div>

                </div>
            </div>

            <!-- Kondisi Fisik Rumah -->
            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <h2 class="text-lg font-semibold mb-4 border-l-4 border-blue-500 pl-2">Kondisi Fisik Rumah</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    <!-- Atap -->
                    <div>
                        <label class="block text-sm font-semibold mb-2">Atap</label>
                        <div class="space-y-1 text-sm text-gray-700">
                            <label><input type="checkbox" name="kondisi_atap[]" value="daun_plastik" class="mr-2">Daun / Plastik</label><br>
                            <label><input type="checkbox" name="kondisi_atap[]" value="rangka_lapuk" class="mr-2">Rangka lapuk</label><br>
                            <label><input type="checkbox" name="kondisi_atap[]" value="roboh_berlubang" class="mr-2">Roboh / Berlubang</label><br>
                            <label><input type="checkbox" name="kondisi_atap[]" value="masih_layak" class="mr-2">Masih layak</label>
                        </div>
                    </div>

                    <!-- Dinding -->
                    <div>
                        <label class="block text-sm font-semibold mb-2">Dinding</label>
                        <div class="space-y-1 text-sm text-gray-700">
                            <label><input type="checkbox" name="kondisi_dinding[]" value="bilik_bambu" class="mr-2">Bilik bambu</label><br>
                            <label><input type="checkbox" name="kondisi_dinding[]" value="hampir_roboh" class="mr-2">Hampir roboh</label><br>
                            <label><input type="checkbox" name="kondisi_dinding[]" value="tembok_kokoh" class="mr-2">Tembok kokoh</label>
                        </div>
                    </div>

                    <!-- Lantai -->
                    <div>
                        <label class="block text-sm font-semibold mb-2">Lantai</label>
                        <div class="space-y-1 text-sm text-gray-700">
                            <label><input type="checkbox" name="kondisi_lantai[]" value="tanah" class="mr-2">Tanah</label><br>
                            <label><input type="checkbox" name="kondisi_lantai[]" value="kayu" class="mr-2">Kayu</label><br>
                            <label><input type="checkbox" name="kondisi_lantai[]" value="keramik" class="mr-2">Keramik / Beton</label>
                        </div>
                    </div>

                    <!-- Ventilasi -->
                    <div>
                        <label class="block text-sm font-semibold mb-2">Ventilasi & Cahaya</label>
                        <div class="space-y-1 text-sm text-gray-700">
                            <label><input type="checkbox" name="ventilasi_pencahayaan[]" value="tidak_ada" class="mr-2">Tidak ada ventilasi</label><br>
                            <label><input type="checkbox" name="ventilasi_pencahayaan[]" value="alami_minim" class="mr-2">Cahaya alami minim</label><br>
                            <label><input type="checkbox" name="ventilasi_pencahayaan[]" value="cukup" class="mr-2">Ventilasi & cahaya cukup</label>
                        </div>
                    </div>

                    <!-- Sanitasi -->
                    <div class="lg:col-span-2">
                        <label class="block text-sm font-semibold mb-2">Sanitasi & Air Bersih</label>
                        <div class="space-y-1 text-sm text-gray-700">
                            <label><input type="checkbox" name="sanitasi_airbersih[]" value="tidak_ada_kloset" class="mr-2">Tidak ada kloset</label><br>
                            <label><input type="checkbox" name="sanitasi_airbersih[]" value="jarak_jauh" class="mr-2">Jarak > 30 menit</label><br>
                            <label><input type="checkbox" name="sanitasi_airbersih[]" value="air_tidak_bersih" class="mr-2">Air bau / berwarna</label><br>
                            <label><input type="checkbox" name="sanitasi_airbersih[]" value="mikroorganisme_logam" class="mr-2">Mengandung logam berat</label><br>
                            <label><input type="checkbox" name="sanitasi_airbersih[]" value="layak_tersedia" class="mr-2">Sanitasi & Air tersedia</label>
                        </div>
                    </div>

                    <!-- Luas & Penghuni -->
                    <div>
                        <label for="luas_rumah" class="block text-sm font-medium mb-1">Luas Rumah (m²)</label>
                        <input type="number" name="luas_rumah" id="luas_rumah"
                            class="w-full border border-gray-300 rounded px-3 py-2 text-sm"
                            placeholder="Contoh: 36">

                        <label for="jumlah_penghuni" class="block text-sm font-medium mt-4 mb-1">Jumlah Penghuni</label>
                        <input type="number" name="jumlah_penghuni" id="jumlah_penghuni"
                            class="w-full border border-gray-300 rounded px-3 py-2 text-sm"
                            placeholder="Contoh: 4">
                    </div>

                </div>
            </div>


            <!-- Dokumen Pendukung -->
            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <h2 class="text-lg font-semibold mb-4 border-l-4 border-blue-500 pl-2">Dokumen Pendukung</h2>
                <div class="grid grid-cols-1 gap-6">

                    @php
                        $dokumen = [
                            'file_ktp' => 'Fotokopi KTP',
                            'file_kk' => 'Fotokopi Kartu Keluarga (KK)',
                            'file_sktm' => 'Surat Keterangan Tidak Mampu (SKTM)',
                            'file_kepemilikan_rumah' => 'Bukti Kepemilikan Rumah (Sertifikat/SPPT/Surat Keterangan)',
                            'foto_tampak_depan' => 'Foto Rumah Tampak Depan',
                            'foto_tampak_belakang' => 'Foto Rumah Tampak Belakang',
                            'foto_bagian_rusak' => 'Foto Bagian Rumah yang Rusak'
                        ];
                    @endphp

                    @foreach ($dokumen as $name => $label)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
                            <div class="flex items-center justify-center w-full">
                                <label for="{{ $name }}" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <img src="{{ asset('images/img-icon.png') }}" alt="Upload Icon" class="w-8 h-8 mb-4 text-gray-500">
                                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> atau seret dan lepas</p>
                                        <p class="text-xs text-gray-500">JPG, PNG, PDF (Max. 2MB)</p>
                                    </div>
                                    <input 
                                        id="{{ $name }}" 
                                        type="file" 
                                        name="{{ $name == 'foto_bagian_rusak' ? $name.'[]' : $name }}" 
                                        {{ $name == 'foto_bagian_rusak' ? 'multiple' : '' }} 
                                        class="hidden" 
                                        accept=".jpg,.jpeg,.png,.pdf" 
                                        onchange="displayFileName(this, '{{ $name }}_name')" 
                                    />
                                </label>
                            </div>
                            <span id="{{ $name }}_name" class="block text-sm text-gray-600 mt-2"></span>
                            @error($name)
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            @if ($name == 'foto_bagian_rusak')
                                @error($name . '.*')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            @endif
                            <span id="{{ $name }}_error" class="text-red-500 text-xs mt-1"></span>
                        </div>
                    @endforeach

                </div>
            </div>

            <!-- Persetujuan & Submit -->
            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <h2 class="text-lg font-semibold mb-4 border-l-4 border-blue-500 pl-2">Persetujuan</h2>
                <div class="space-y-4">
                    <label class="flex items-start space-x-2">
                        <input type="checkbox" name="persetujuan" required class="mt-1">
                        <span class="text-sm text-gray-700">
                            Saya menyatakan bahwa seluruh informasi dan dokumen yang saya lampirkan adalah benar dan dapat dipertanggungjawabkan.
                        </span>
                    </label>

                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-150">
                        Kirim Pengajuan
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Menunggu seluruh halaman HTML dimuat sebelum menjalankan script
        document.addEventListener('DOMContentLoaded', function() {
            
            // Ambil elemen dropdown berdasarkan ID yang ada di HTML Anda
            const kecamatanSelect = document.getElementById('lokasi_kecamatan');
            const kelurahanSelect = document.getElementById('lokasi_kelurahan');

            // Pengecekan penting: jika salah satu dropdown tidak ditemukan, hentikan script
            if (!kecamatanSelect || !kelurahanSelect) {
                console.error('Elemen dropdown Kecamatan atau Kelurahan tidak ditemukan.');
                return;
            }

            // Event listener yang berjalan setiap kali pengguna mengubah pilihan kecamatan
            kecamatanSelect.addEventListener('change', function() {
                const kecamatanId = this.value; // Ambil ID kecamatan yang dipilih

                // Reset dan non-aktifkan dropdown kelurahan
                kelurahanSelect.innerHTML = '<option value="">Memuat...</option>';
                kelurahanSelect.disabled = true;

                // Jika pengguna memilih opsi kosong "-- Pilih Kecamatan --"
                if (!kecamatanId) {
                    kelurahanSelect.innerHTML = '<option value="">-- Pilih Kecamatan Terlebih Dahulu --</option>';
                    return;
                }

                // Panggil API backend kita. Pastikan URL ini cocok dengan yang ada di routes/web.php
                const url = `/warga/get-kelurahan-by-kecamatan/${kecamatanId}`;

                fetch(url)
                    .then(response => {
                        if (!response.ok) { // Jika status error (e.g., 404, 500)
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json(); // Ubah response menjadi JSON
                    })
                    .then(data => {
                        // PENTING: Tampilkan data yang diterima dari server di Console
                        console.log('Data diterima dari server:', data); 

                        // Kosongkan dropdown kelurahan sebelum diisi data baru
                        kelurahanSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';
                        
                        if (data.length === 0) {
                            kelurahanSelect.innerHTML = '<option value="">-- Tidak ada kelurahan --</option>';
                        } else {
                            // Loop data JSON dan buat <option> baru untuk setiap kelurahan
                            data.forEach(function(kelurahan) {
                                const option = document.createElement('option');
                                option.value = kelurahan.id;
                                // Pastikan propertinya `nama_kelurahan` sesuai dengan yang dikirim controller
                                option.textContent = kelurahan.nama_kelurahan; 
                                kelurahanSelect.appendChild(option);
                            });
                        }

                        // Aktifkan kembali dropdown kelurahan
                        kelurahanSelect.disabled = false;
                    })
                    .catch(error => {
                        // Tangani jika ada error saat fetch (misal route tidak ada atau controller error)
                        console.error('Gagal mengambil data kelurahan:', error);
                        kelurahanSelect.innerHTML = '<option value="">Gagal memuat data</option>';
                    });
            });
        });

        function displayFileName(input, spanId) {
            const span = document.getElementById(spanId);
            if (input.files.length > 1) {
                span.innerText = `${input.files.length} file dipilih`;
            } else if (input.files.length === 1) {
                span.innerText = input.files[0].name;
            } else {
                span.innerText = '';
            }
        }

        document.querySelector('form').addEventListener('submit', function(e) {
            const maxSize = 2 * 1024 * 1024; // 2MB
            const fileInputs = [
                'file_ktp', 'file_kk', 'file_sktm',
                'file_kepemilikan_rumah', 'foto_tampak_depan',
                'foto_tampak_belakang', 'foto_bagian_rusak'
            ];

            let error = false;

            fileInputs.forEach(inputName => {
                const input = document.getElementById(inputName);
                const errorSpan = document.getElementById(`${inputName}_error`);
                if (!input || !errorSpan) return;

                errorSpan.innerText = ''; // Reset error

                const files = input.files;
                for (let i = 0; i < files.length; i++) {
                    if (files[i].size > maxSize) {
                        error = true;
                        errorSpan.innerText = `Ukuran file "${files[i].name}" melebihi 2MB.`;
                    }
                }
            });

            if (error) {
                e.preventDefault(); // Hentikan form submit
            }
        });
    </script>
</body>
</html>