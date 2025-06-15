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
            <form action="{{ route('petugas.verifikasi.store', $pengajuan->id) }}" method="POST" class="mt-6 space-y-6" enctype="multipart/form-data">
                @csrf
                <!-- Tanggal Survei -->
                <div>
                    <label for="tgl_survey" class="block text-sm font-semibold text-gray-700">Tanggal Survei</label>
                    <div class="relative mt-1">
                        <input type="date" name="tgl_survey" id="tgl_survey"
                            value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                            readonly
                            class="block w-full rounded-md border-gray-300 bg-gray-100 text-gray-700 shadow-sm focus:ring-0 focus:border-gray-300 sm:text-sm pl-3 pr-10 py-2 cursor-not-allowed">
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Hasil Verifikasi Status Kepemilikan -->
                <div>
                    <label for="status_kepemilikan" class="block text-sm font-semibold text-gray-700">Hasil Verifikasi Status Kepemilikan</p>
                    <select id="status_kepemilikan" name="status_kepemilikan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 sm:text-sm">
                        <option>Pilih Status</option>
                        <option value="Milik Sendiri">Milik Sendiri</option>
                        <option value="Sewa">Sewa</option>
                        <option value="Menumpang">Menumpang</option>
                    </select>
                </div>

                <!-- Hasil Verifikasi Kondisi Ekonomi -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700">Hasil Verifikasi Kondisi Ekonomi</label>
                    <div class="mt-2 space-y-2">
                        <label class="inline-flex items-center"><input type="radio" name="verifikasi_ekonomi" value="Sesuai" class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500"> <span class="ml-2 text-sm">Sesuai (Layak dibantu)</span></label><br>
                        <label class="inline-flex items-center"><input type="radio" name="verifikasi_ekonomi" value="Tidak Sesuai" class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500"> <span class="ml-2 text-sm">Tidak Sesuai (Layak dibantu)</span></label>
                    </div>
                </div>

                <!-- Detail Verifikasi Dokumen -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700">Detail Verifikasi Dokumen</label>
                    <div class="mt-2 space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-800">KTP & KK</span>
                            <select name="detail_verifikasi_dokumen[KTP_KK]" class="rounded-md border-gray-300 shadow-sm text-sm py-1 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                                <option>Valid</option><option>Tidak Valid</option>
                            </select>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-800">SKTM</span>
                            <select name="detail_verifikasi_dokumen[SKTM]" class="rounded-md border-gray-300 shadow-sm text-sm py-1 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                                <option>Valid</option><option>Tidak Valid</option>
                            </select>
                        </div>
                         <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-800">Dokumen Kepemilikan Rumah</span>
                            <select name="detail_verifikasi_dokumen[KEPEMILIKAN]" class="rounded-md border-gray-300 shadow-sm text-sm py-1 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                                <option>Valid</option><option>Tidak Valid</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Catatan Survei -->
                <div>
                    <label for="catatan_survei" class="block text-sm font-semibold text-gray-700">Catatan Survei</label>
                    <textarea id="catatan_survei" name="catatan_survei" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 sm:text-sm" placeholder="Tulis temuan atau observasi di lapangan..."></textarea>
                </div>

                <!-- Upload Bukti Foto -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700">Upload Bukti Foto Survei (Wajib)</label>
                    <div class="mt-1 px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md bg-white">
                        <div class="space-y-1 text-center">
                            <img class="mx-auto h-12 w-12" src="{{ asset('images/img-icon.png') }}" alt="Upload Ikon">
                            <div class="flex text-sm text-gray-600 justify-center">
                                <label for="bukti_survei" class="relative cursor-pointer rounded-md font-medium text-indigo-600 hover:text-indigo-500">
                                    <span>Klik atau seret file ke sini</span>
                                    <input id="bukti_survei" name="bukti_survei[]" type="file" accept="image/*" class="sr-only" multiple onchange="displayFileName(this, 'fileNameSpan')">
                                </label>
                            </div>
                            <!-- Menampilkan nama file -->
                            <span id="fileNameSpan" class="text-xs text-gray-500 block mt-1"></span>
                        </div>
                    </div>
                </div>

                
                <hr class="my-4">
                
                <!-- Rekomendasi Akhir -->
                <fieldset>
                    <legend class="block text-sm font-semibold text-gray-700">Rekomendasi Akhir</legend>
                     <div class="mt-2 space-y-2">
                        <label class="inline-flex items-center"><input type="radio" id="status_layak" name="status_rekomendasi" value="Layak" class="h-4 w-4 text-indigo-600 border-gray-300"> <span class="ml-2 text-sm">Layak Mendapatkan Bantuan</span></label><br>
                        <label class="inline-flex items-center"><input type="radio" id="status_tidak_layak" name="status_rekomendasi" value="Tidak Layak" class="h-4 w-4 text-indigo-600 border-gray-300"> <span class="ml-2 text-sm">Tidak Layak</span></label>
                     </div>
                </fieldset>

                <!-- Alasan Penolakan -->
                <div id="alasan_penolakan_div" class="hidden">
                    <label for="alasan_penolakan" class="block text-sm font-semibold text-gray-700">Alasan Penolakan <span class="text-red-500">*</span></label>
                    <!-- PERUBAHAN DI SINI: Mengganti input dengan textarea -->
                    <textarea name="alasan_penolakan" id="alasan_penolakan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 sm:text-sm" placeholder="Contoh: Status rumah sewa, penghasilan di atas UMR..."></textarea>
                </div>
                
                <div class="pt-5 flex justify-end">
                    <button type="submit" class="w-full sm:w-auto flex justify-center py-2 px-8 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                        Simpan Hasil Verifikasi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const statusLayak = document.getElementById('status_layak');
        const statusTidakLayak = document.getElementById('status_tidak_layak');
        const alasanDiv = document.getElementById('alasan_penolakan_div');
        const alasanInput = document.getElementById('alasan_penolakan');

        const toggleAlasan = () => {
            if (statusTidakLayak.checked) {
                alasanDiv.classList.remove('hidden');
                alasanInput.required = true;
            } else {
                alasanDiv.classList.add('hidden');
                alasanInput.required = false;
            }
        };

        statusLayak.addEventListener('change', toggleAlasan);
        statusTidakLayak.addEventListener('change', toggleAlasan);
    
    //Untuk Dokumen
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
    </script>

</body>
</html>
