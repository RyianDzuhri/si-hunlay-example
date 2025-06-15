<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Verifikasi Lapangan</title>
    <!-- Memuat Tailwind CSS dari CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Memuat Font Poppins dari Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        /* Menyembunyikan ikon kalender default di beberapa browser */
        input[type="date"]::-webkit-calendar-picker-indicator {
            display: none;
            -webkit-appearance: none;
        }
        .transition-smooth {
            transition: all 0.3s ease-in-out;
        }

        select, input, textarea {
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        select:focus, input:focus, textarea:focus {
            outline: none;
            border-color: #6366F1; /* indigo-500 */
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2); /* indigo-200 */
        }
    </style>
</head>
<body class="bg-gray-50">
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
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-6">
            <nav class="text-sm text-gray-500 mb-1" aria-label="Breadcrumb">
                <ol class="list-reset flex">
                    <li>
                        <a href="{{ route('petugas.tugas') }}" class="hover:underline">Daftar Tugas</a>
                    </li>
                    <li><span class="mx-2">&gt;</span></li>
                    <li>
                        Verifikasi RTLH
                    </li>
                </ol>
            </nav>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Formulir Verifikasi Lapangan</h1>
        </div>

        <!-- KARTU 1: DATA PENGAJUAN WARGA (READ-ONLY) -->
            <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
                <h2 class="text-lg font-semibold border-b border-gray-200 pb-3 mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 12.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                    </svg>
                    Data Pengajuan Warga
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-sm">
                    <!-- Kolom Kiri -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-500">Nama Lengkap</label>
                            <p class="font-medium text-gray-800">{{ $pengajuan->warga->user->nama }}</p>
                        </div>
                        <div>
                            <label class="block text-gray-500">NIK</label>
                            <p class="font-medium text-gray-800">{{ $pengajuan->warga_nik }}</p>
                        </div>
                        <div>
                            <label class="block text-gray-500">No. Kartu Keluarga</label>
                            <p class="font-medium text-gray-800">{{ $pengajuan->warga->no_kk }}</p>
                        </div>
                        <div>
                            <label class="block text-gray-500">Alamat Pengaju</label>
                            <p class="font-medium text-gray-800">
                                {{ $pengajuan->alamat_lengkap }}, Kelurahan {{ $pengajuan->kelurahan->nama_kelurahan }}, Kecamatan {{ $pengajuan->kelurahan->kecamatan->nama_kecamatan }}
                            </p>
                        </div>
                        <div>
                            <label class="block text-gray-500">Tanggal Pengajuan</label>
                            <p class="font-medium text-gray-800">{{ $pengajuan->tgl_pengajuan->format('d F Y') }}</p>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-500">Pekerjaan</label>
                            <p class="font-medium text-gray-800">{{ Str::ucfirst(str_replace('_', ' ', $pengajuan->pekerjaan ?? '')) }}</p>
                        </div>
                        <div>
                            <label class="block text-gray-500">Penghasilan/Bulan</label>
                            <p class="font-medium text-gray-800">Rp {{ number_format($pengajuan->penghasilan, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <label class="block text-gray-500">Luas Rumah</label>
                            <p class="font-medium text-gray-800">{{ $pengajuan->luas_rumah }} m²</p>
                        </div>
                        <div>
                            <label class="block text-gray-500">Jumlah Penghuni</label>
                            <p class="font-medium text-gray-800">{{ $pengajuan->jumlah_penghuni }}</p>
                        </div>
                        <div>
                            <label class="block text-gray-500">Kerusakan Dilaporkan Warga</label>
                            <ul class="list-disc list-inside mt-1 font-medium text-gray-800">
                                @foreach($pengajuan->jenis_kerusakan as $kerusakan)
                                    <li>{{ Str::ucfirst(str_replace('_', ' ', $kerusakan)) }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>



        <!-- KARTU 2: DOKUMEN YANG DIAJUKAN WARGA -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
            <h2 class="text-lg font-semibold border-b border-gray-200 pb-3 mb-4 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" /></svg>
                Dokumen yang Diajukan Warga
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($pengajuan->dokumen as $doc)
                    <a href="{{ $doc->url }}" target="_blank" class="block group border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-200">
                        <div class="relative">
                            <img src="{{ $doc->url }}" alt="{{ $doc->nama }}" class="w-full h-32 object-cover">
                            <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                Lihat Detail
                            </div>
                        </div>
                        <div class="p-2 text-center text-sm font-medium text-gray-700">
                            {{ $doc->nama }}
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- KARTU 3: FORMULIR VERIFIKASI PETUGAS (DESAIN BARU) -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-lg font-semibold text-gray-800">Verifikasi Lapangan</h2>
            <form action="{{-- route('petugas.verifikasi.store', $pengajuan->id) --}}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-8">
                @csrf

                {{-- Bagian 1 --}}
                <fieldset>
                    <legend class="text-xl font-semibold text-gray-800 border-b pb-3 mb-6">1. Detail & Kelengkapan</legend>
                    <div class="grid gap-6 sm:grid-cols-2">
                        <div>
                            <label for="tgl_survey" class="block text-sm font-semibold text-gray-700">Tanggal Survei</label>
                            <input type="date" name="tgl_survey" id="tgl_survey" required value="{{ date('Y-m-d') }}"
                                class="mt-1 block w-full bg-gray-50 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                        </div>

                        <div>
                            <label for="status_kepemilikan" class="block text-sm font-semibold text-gray-700">Status Kepemilikan</label>
                            <select id="status_kepemilikan" name="status_kepemilikan" required
                                class="mt-1 block w-full bg-gray-50 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                                <option disabled selected hidden>Pilih Status</option>
                                <option value="Milik Sendiri">Milik Sendiri</option>
                                <option value="Sewa">Sewa</option>
                                <option value="Menumpang">Menumpang</option>
                                <option value="Tidak Jelas">Tidak Jelas</option>
                            </select>
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700">Verifikasi Ekonomi</label>
                            <div class="mt-2 space-y-2">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="verifikasi_ekonomi" value="Sesuai" required
                                        class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                    <span class="ml-2 text-sm">Sesuai (Layak dibantu)</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="verifikasi_ekonomi" value="Tidak Sesuai"
                                        class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                    <span class="ml-2 text-sm">Tidak Sesuai (Mampu)</span>
                                </label>
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Detail Verifikasi Dokumen</label>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                @php
                                    $dokumen = ['KTP_KK' => 'KTP & KK', 'SKTM' => 'SKTM', 'KEPEMILIKAN' => 'Kepemilikan Rumah'];
                                @endphp
                                @foreach ($dokumen as $key => $label)
                                    <div>
                                        <label class="block text-sm text-gray-700 mb-1">{{ $label }}</label>
                                        <select name="detail_verifikasi_dokumen[{{ $key }}]"
                                            class="w-full rounded-md border-gray-300 bg-gray-50 shadow-sm text-sm py-1 focus:ring-indigo-500 focus:border-indigo-500 transition">
                                            <option value="Valid">Valid</option>
                                            <option value="Tidak Valid">Tidak Valid</option>
                                        </select>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </fieldset>

                {{-- Bagian 2 --}}
                <fieldset>
                    <legend class="text-xl font-semibold text-gray-800 border-b pb-3 mb-6">2. Kondisi Fisik & Kesehatan Rumah</legend>
                    <div class="grid gap-6 sm:grid-cols-2">
                        @php
                            $kondisi = [
                                'kondisi_atap_aktual' => 'Kondisi Atap Aktual',
                                'kondisi_dinding_aktual' => 'Kondisi Dinding Aktual',
                                'kondisi_lantai_aktual' => 'Kondisi Lantai Aktual',
                                'ventilasi_pencahayaan_aktual' => 'Ventilasi & Pencahayaan',
                                'sanitasi_airbersih_aktual' => 'Sanitasi & Air Bersih'
                            ];
                            $options = [
                                'kondisi_atap_aktual' => [
                                    'baik' => 'Baik / Kokoh',
                                    'daun_atau_plastik' => 'Daun / Plastik',
                                    'rangka_lapuk' => 'Rangka Lapuk',
                                    'sebagian_roboh' => 'Sebagian Roboh'
                                ],
                                'kondisi_dinding_aktual' => [
                                    'baik' => 'Tembok / Kokoh',
                                    'bilik_bambu' => 'Bilik Bambu',
                                    'tidak_kokoh' => 'Tidak Kokoh'
                                ],
                                'kondisi_lantai_aktual' => [
                                    'keramik_semen' => 'Keramik / Semen',
                                    'tanah' => 'Tanah',
                                    'kayu_lapuk' => 'Kayu Lapuk'
                                ],
                                'ventilasi_pencahayaan_aktual' => [
                                    'cukup' => 'Cukup',
                                    'tidak_ada_ventilasi' => 'Tidak Ada Ventilasi',
                                    'pencahayaan_kurang' => 'Pencahayaan Kurang'
                                ],
                                'sanitasi_airbersih_aktual' => [
                                    'layak' => 'Layak',
                                    'tidak_ada_kloset' => 'Tidak Ada WC',
                                    'air_tidak_layak' => 'Air Tidak Layak'
                                ]
                            ];
                        @endphp
                        @foreach ($kondisi as $name => $label)
                            <div>
                                <label for="{{ $name }}" class="block text-sm font-semibold text-gray-700">{{ $label }}</label>
                                <select name="{{ $name }}" id="{{ $name }}" required
                                    class="mt-1 block w-full bg-gray-50 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($options[$name] as $val => $text)
                                        <option value="{{ $val }}">{{ $text }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                    </div>
                </fieldset>

                {{-- Bagian 3 --}}
                <fieldset>
                    <legend class="text-xl font-semibold text-gray-800 border-b pb-3 mb-6">3. Catatan & Bukti</legend>
                    <div class="space-y-6">
                        <div>
                            <label for="catatan_survei" class="block text-sm font-semibold text-gray-700">Catatan Survei</label>
                            <textarea name="catatan_survei" id="catatan_survei" rows="4"
                                class="mt-1 w-full bg-gray-50 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition"
                                placeholder="Tulis temuan di lapangan..."></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Upload Bukti Foto</label>
                            <div class="px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg bg-white text-center">
                                <img class="mx-auto h-12 w-12" src="/images/img-icon.png" alt="Upload Icon">
                                <div class="flex justify-center text-sm text-gray-600 mt-2">
                                    <label for="bukti_survei" class="cursor-pointer text-indigo-600 hover:text-indigo-500">
                                        <span>Klik atau seret file ke sini</span>
                                        <input id="bukti_survei" name="bukti_survei[]" type="file" accept="image/*" class="sr-only" multiple onchange="displayFileName(this, 'fileNameSpan')">
                                    </label>
                                </div>
                                <span id="fileNameSpan" class="text-xs text-gray-500 block mt-2"></span>
                            </div>
                        </div>
                    </div>
                </fieldset>

                {{-- Bagian 4 --}}
                <fieldset>
                    <legend class="text-xl font-semibold text-gray-800 border-b pb-3 mb-6">4. Rekomendasi Akhir</legend>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700">Status Rekomendasi</label>
                            <div class="mt-2 space-y-2">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="status_rekomendasi" value="Layak" required
                                        class="h-4 w-4 text-green-600 border-gray-300 focus:ring-green-500">
                                    <span class="ml-2 font-medium text-green-700">Layak</span>
                                </label><br>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="status_rekomendasi" value="Tidak Layak"
                                        class="h-4 w-4 text-red-600 border-gray-300 focus:ring-red-500">
                                    <span class="ml-2 font-medium text-red-700">Tidak Layak</span>
                                </label>
                            </div>
                        </div>

                        <div id="alasan_penolakan_div" class="hidden">
                            <label for="alasan_penolakan" class="block text-sm font-semibold text-gray-700">Alasan Penolakan <span class="text-red-600">*</span></label>
                            <textarea name="alasan_penolakan" id="alasan_penolakan" rows="3"
                                class="mt-1 block w-full bg-gray-50 rounded-md border-gray-300 shadow-sm focus:ring-red-500 focus:border-red-500 transition"
                                placeholder="Contoh: Status rumah sewa, penghasilan tinggi..."></textarea>
                        </div>
                    </div>
                </fieldset>

                {{-- Tombol --}}
                <div class="pt-6">
                    <button type="submit"
                        class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-md shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200">
                        Simpan Hasil Verifikasi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function displayFileName(input, targetId) {
            const target = document.getElementById(targetId);
            const files = Array.from(input.files).map(f => f.name);
            target.textContent = files.join(', ') || 'Tidak ada file dipilih.';
        }

        // Untuk tampilkan textarea alasan_penolakan saat Tidak Layak dipilih
        document.addEventListener('DOMContentLoaded', () => {
            const radios = document.querySelectorAll('input[name="status_rekomendasi"]');
            const alasanDiv = document.getElementById('alasan_penolakan_div');

            radios.forEach(radio => {
                radio.addEventListener('change', function () {
                    if (this.value === 'Tidak Layak') {
                        alasanDiv.classList.remove('hidden');
                    } else {
                        alasanDiv.classList.add('hidden');
                    }
                });
            });
        });
    </script>

</body>
</html>
