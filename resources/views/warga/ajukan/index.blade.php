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
    <style>
        body {
            font-family: 'Inter', sans-serif;
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

        {{-- Penting: Tambahkan enctype="multipart/form-data" untuk upload file --}}
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Data Lokasi -->
            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <h2 class="text-lg font-semibold mb-4 border-l-4 border-blue-500 pl-2">Data Lokasi</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <!-- Label dan Dropdown untuk Kecamatan -->
                        <label for="lokasi_kecamatan" class="block text-sm font-medium text-gray-700">Kecamatan</label>
                        <select id="lokasi_kecamatan" name="lokasi_kecamatan"
                                class="w-full mt-1 border border-gray-300 rounded p-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Pilih Kecamatan</option>
                            {{-- Mengisi dropdown kecamatan dengan data dari controller --}}
                            @foreach($kecamatan as $itemKecamatan)
                                <option value="{{ $itemKecamatan->id }}">{{ $itemKecamatan->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Perubahan: Menghapus 'mt-4' dari div Kelurahan untuk meratakan posisinya --}}
                    <div>
                        <!-- Label dan Dropdown untuk Kelurahan -->
                        <label for="lokasi_kelurahan" class="block text-sm font-medium text-gray-700">Kelurahan</label>
                        <select id="lokasi_kelurahan" name="lokasi_kelurahan"
                                class="w-full mt-1 border border-gray-300 rounded p-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" disabled>
                            <option value="">Pilih Kelurahan</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium">Alamat Lengkap</label>
                        <textarea name="alamat_lengkap" class="w-full mt-1 border border-gray-300 rounded p-2" rows="2"></textarea>
                    </div>
                </div>
            </div>

            <!-- Administrasi -->
            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <h2 class="text-lg font-semibold mb-4 border-l-4 border-blue-500 pl-2">Administrasi</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- No. KK (Kartu Keluarga) --}}
                    <div>
                        <label for="no_kk" class="block text-sm font-medium text-gray-700">No. KK</label>
                        <input type="text" name="no_kk" id="no_kk" class="w-full mt-1 border border-gray-300 rounded p-2 bg-gray-100 cursor-not-allowed" placeholder="Nomor Kartu Keluarga" value="{{ $warga->no_kk ?? '' }}" readonly>
                    </div>

                    {{-- NIK (Nomor Induk Kependudukan) --}}
                    <div>
                        <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                        <input type="text" name="nik" id="nik" class="w-full mt-1 border border-gray-300 rounded p-2 bg-gray-100 cursor-not-allowed" placeholder="Nomor Induk Kependudukan" value="{{ $warga->nik ?? '' }}" readonly>
                    </div>

                    {{-- Pekerjaan Utama --}}
                    <div>
                        <label for="pekerjaan_utama" class="block text-sm font-medium text-gray-700">Pekerjaan Utama</label>
                        <select name="pekerjaan_utama" id="pekerjaan_utama" class="w-full mt-1 border border-gray-300 rounded p-2">
                            <option value="">Pilih Pekerjaan</option>
                            <option value="buruh_harian">Buruh Harian</option>
                            <option value="petani">Petani</option>
                            <option value="nelayan">Nelayan</option>
                            <option value="tidak_bekerja">Tidak Bekerja</option>
                        </select>
                    </div>

                    {{-- Penghasilan Perbulan --}}
                    <div>
                        <label for="penghasilan_perbulan" class="block text-sm font-medium text-gray-700">Penghasilan Perbulan</label>
                        <select name="penghasilan_perbulan" id="penghasilan_perbulan" class="w-full mt-1 border border-gray-300 rounded p-2">
                            <option value="">Pilih Nominal</option>
                            <option value="kurang_dari_1_2jt">< 1,2 juta</option>
                            <option value="1_9-2_1jt">1,9 - 2,1 juta</option>
                            <option value="2_2-2_6jt">2,2 - 2,6 juta</option>
                            <option value="2_7-2_8jt">2,7 - 2,8 juta</option>
                            <option value="lebih_dari_2_8jt">> 2,8 juta</option>
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
                        <label class="block font-semibold mb-2">Atap</label>
                        <div class="space-y-2">
                            <label><input type="checkbox" name="atap[]" value="daun_plastik" class="mr-2">Terbuat dari daun/Plastik</label><br>
                            <label><input type="checkbox" name="atap[]" value="rangka_lapuk" class="mr-2">Rangka atap lapuk</label><br>
                            <label><input type="checkbox" name="atap[]" value="roboh_berlubang" class="mr-2">Sebagian roboh/berlubang</label><br>
                            <label><input type="checkbox" name="atap[]" value="masih_layak" class="mr-2">Masih Layak</label>
                        </div>
                    </div>

                    <!-- Dinding -->
                    <div>
                        <label class="block font-semibold mb-2">Dinding</label>
                        <div class="space-y-2">
                            <label><input type="checkbox" name="dinding[]" value="bilik_bambu" class="mr-2">Terbuat dari bilik bambu</label><br>
                            <label><input type="checkbox" name="dinding[]" value="hampir_roboh" class="mr-2">Hampir roboh/tidak kokoh</label><br>
                            <label><input type="checkbox" name="dinding[]" value="tembok_kokoh" class="mr-2">Masih layak (tembok kokoh)</label>
                        </div>
                    </div>

                    <!-- Lantai -->
                    <div>
                        <label class="block font-semibold mb-2">Lantai</label>
                        <div class="space-y-2">
                            <label><input type="checkbox" name="lantai[]" value="tanah" class="mr-2">Tanah</label><br>
                            <label><input type="checkbox" name="lantai[]" value="kayu" class="mr-2">Kayu</label><br>
                            <label><input type="checkbox" name="lantai[]" value="keramik" class="mr-2">Masih layak (Keramik/beton utuh)</label>
                        </div>
                    </div>

                    <!-- Ventilasi -->
                    <div>
                        <label class="block font-semibold mb-2">Ventilasi & Pencahayaan</label>
                        <div class="space-y-2">
                            <label><input type="checkbox" name="ventilasi[]" value="tidak_ada" class="mr-2">Tidak ada ventilasi sama sekali</label><br>
                            <label><input type="checkbox" name="ventilasi[]" value="alami_minim" class="mr-2">Pencahayaan alami minim</label><br>
                            <label><input type="checkbox" name="ventilasi[]" value="cukup" class="mr-2">Cukup ventilasi dan cahaya</label>
                        </div>
                    </div>

                    <!-- Sanitasi -->
                    <div class="lg:col-span-2">
                        <label class="block font-semibold mb-2">Akses Sanitasi & Air Bersih</label>
                        <div class="space-y-2">
                            <label><input type="checkbox" name="sanitasi[]" value="tidak_ada_kloset" class="mr-2">Tidak ada kloset</label><br>
                            <label><input type="checkbox" name="sanitasi[]" value="jarak_jauh" class="mr-2">Jarak jangkau maksimal 30 menit</label><br>
                            <label><input type="checkbox" name="sanitasi[]" value="air_tidak_bersih" class="mr-2">Air tidak berasa, berbau, berwarna</label><br>
                            <label><input type="checkbox" name="sanitasi[]" value="mikroorganisme_logam" class="mr-2">Mengandung mikroorganisme dan logam berat</label>
                        </div>
                    </div>

                    <!-- Ukuran & Penghuni -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Luas Rumah (m²)</label>
                        <input type="text" name="luas_rumah" class="w-full border border-gray-300 rounded p-2" placeholder="Masukkan Luas Rumah">
                        <label class="block text-sm font-medium mt-4 mb-1">Jumlah Penghuni</label>
                        <input type="number" name="jumlah_penghuni" class="w-full border border-gray-300 rounded p-2">
                    </div>
                </div>
            </div>

            <!-- Dokumen Pendukung - Bagian Baru -->
            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <h2 class="text-lg font-semibold mb-4 border-l-4 border-blue-500 pl-2">Dokumen Pendukung</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Fotokopi KTP -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fotokopi KTP</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="file_ktp" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    {{-- Mengganti ikon SVG dengan tag <img> untuk ikon lokal --}}
                                    <img src="{{ asset('images/img-icon.png') }}" alt="Upload Icon" class="w-8 h-8 mb-4 text-gray-500">
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> atau seret dan lepas</p>
                                    <p class="text-xs text-gray-500">PDF, JPG, PNG (MAX. 5MB)</p>
                                </div>
                                <input id="file_ktp" type="file" name="file_ktp" class="hidden" accept=".pdf, .jpg, .jpeg, .png" onchange="displayFileName(this, 'file_ktp_name')" />
                            </label>
                        </div>
                        <span id="file_ktp_name" class="block text-sm text-gray-600 mt-2"></span>
                    </div>

                    <!-- Fotokopi Kartu Keluarga (KK) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fotokopi Kartu Keluarga (KK)</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="file_kk" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    {{-- Mengganti ikon SVG dengan tag <img> untuk ikon lokal --}}
                                    <img src="{{ asset('images/img-icon.png') }}" alt="Upload Icon" class="w-8 h-8 mb-4 text-gray-500">
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> atau seret dan lepas</p>
                                    <p class="text-xs text-gray-500">PDF, JPG, PNG (MAX. 5MB)</p>
                                </div>
                                <input id="file_kk" type="file" name="file_kk" class="hidden" accept=".pdf, .jpg, .jpeg, .png" onchange="displayFileName(this, 'file_kk_name')" />
                            </label>
                        </div>
                        <span id="file_kk_name" class="block text-sm text-gray-600 mt-2"></span>
                    </div>

                    <!-- Surat Keterangan Tidak Mampu (SKTM) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Surat Keterangan Tidak Mampu (SKTM)</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="file_sktm" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    {{-- Mengganti ikon SVG dengan tag <img> untuk ikon lokal --}}
                                    <img src="{{ asset('images/img-icon.png') }}" alt="Upload Icon" class="w-8 h-8 mb-4 text-gray-500">
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> atau seret dan lepas</p>
                                    <p class="text-xs text-gray-500">PDF, JPG, PNG (MAX. 5MB)</p>
                                </div>
                                <input id="file_sktm" type="file" name="file_sktm" class="hidden" accept=".pdf, .jpg, .jpeg, .png" onchange="displayFileName(this, 'file_sktm_name')" />
                            </label>
                        </div>
                        <span id="file_sktm_name" class="block text-sm text-gray-600 mt-2"></span>
                    </div>

                    <!-- Bukti Kepemilikan Rumah -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Bukti Kepemilikan Rumah (Sertifikat/SPPT/Surat Keterangan)</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="file_kepemilikan_rumah" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    {{-- Mengganti ikon SVG dengan tag <img> untuk ikon lokal --}}
                                    <img src="{{ asset('images/img-icon.png') }}" alt="Upload Icon" class="w-8 h-8 mb-4 text-gray-500">
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> atau seret dan lepas</p>
                                    <p class="text-xs text-gray-500">PDF, JPG, PNG (MAX. 5MB)</p>
                                </div>
                                <input id="file_kepemilikan_rumah" type="file" name="file_kepemilikan_rumah" class="hidden" accept=".pdf, .jpg, .jpeg, .png" onchange="displayFileName(this, 'file_kepemilikan_rumah_name')" />
                            </label>
                        </div>
                        <span id="file_kepemilikan_rumah_name" class="block text-sm text-gray-600 mt-2"></span>
                    </div>

                    <!-- Foto Rumah Tampak Depan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Foto Rumah Tampak Depan</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="file_foto_depan" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    {{-- Mengganti ikon SVG dengan tag <img> untuk ikon lokal --}}
                                    <img src="{{ asset('images/img-icon.png') }}" alt="Upload Icon" class="w-8 h-8 mb-4 text-gray-500">
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> atau seret dan lepas</p>
                                    <p class="text-xs text-gray-500">JPG, PNG (MAX. 5MB)</p>
                                </div>
                                <input id="file_foto_depan" type="file" name="file_foto_depan" class="hidden" accept=".jpg, .jpeg, .png" onchange="displayFileName(this, 'file_foto_depan_name')" />
                            </label>
                        </div>
                        <span id="file_foto_depan_name" class="block text-sm text-gray-600 mt-2"></span>
                    </div>

                    <!-- Foto Rumah Tampak Belakang -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Foto Rumah Tampak Belakang</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="file_foto_belakang" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    {{-- Mengganti ikon SVG dengan tag <img> untuk ikon lokal --}}
                                    <img src="{{ asset('images/img-icon.png') }}" alt="Upload Icon" class="w-8 h-8 mb-4 text-gray-500">
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> atau seret dan lepas</p>
                                    <p class="text-xs text-gray-500">JPG, PNG (MAX. 5MB)</p>
                                </div>
                                <input id="file_foto_belakang" type="file" name="file_foto_belakang" class="hidden" accept=".jpg, .jpeg, .png" onchange="displayFileName(this, 'file_foto_belakang_name')" />
                            </label>
                        </div>
                        <span id="file_foto_belakang_name" class="block text-sm text-gray-600 mt-2"></span>
                    </div>

                    <!-- Foto Bagian Rumah yang Rusak -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Foto Bagian Rumah yang Rusak</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="file_foto_rusak" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    {{-- Mengganti ikon SVG dengan tag <img> untuk ikon lokal --}}
                                    <img src="{{ asset('images/img-icon.png') }}" alt="Upload Icon" class="w-8 h-8 mb-4 text-gray-500">
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> atau seret dan lepas</p>
                                    <p class="text-xs text-gray-500">JPG, PNG (MAX. 5MB)</p>
                                </div>
                                {{-- Perubahan: Menambahkan 'multiple' dan mengubah nama input menjadi array 'file_foto_rusak[]' --}}
                                <input id="file_foto_rusak" type="file" name="file_foto_rusak[]" class="hidden" accept=".jpg, .jpeg, .png" multiple onchange="displayFileName(this, 'file_foto_rusak_name')" />
                            </label>
                        </div>
                        <span id="file_foto_rusak_name" class="block text-sm text-gray-600 mt-2"></span>
                    </div>

                </div> {{-- End of grid for Dokumen Pendukung --}}
            </div> {{-- End of Dokumen Pendukung section --}}


            <!-- Tombol Submit -->
            <div class="text-right">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                    Kirim Pengajuan
                </button>
            </div>
        </form>
    </div>

    {{-- Script untuk memuat kelurahan secara dinamis --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const kecamatanSelect = document.getElementById('lokasi_kecamatan');
            const kelurahanSelect = document.getElementById('lokasi_kelurahan');

            // Event listener saat pilihan kecamatan berubah
            kecamatanSelect.addEventListener('change', function() {
                const kecamatanId = this.value; // Dapatkan ID kecamatan yang dipilih

                // Reset dan nonaktifkan dropdown kelurahan jika tidak ada kecamatan yang dipilih
                kelurahanSelect.innerHTML = '<option value="">Memuat Kelurahan...</option>';
                kelurahanSelect.disabled = true;

                if (kecamatanId) {
                    // Lakukan permintaan AJAX ke endpoint Laravel
                    // URL diubah agar sesuai dengan nama rute singular: '/get-kelurahan-by-kecamatan/'
                    fetch(`/warga/get-kelurahan-by-kecamatan/${kecamatanId}`) // URL diperbarui
                        .then(response => {
                            // Cek jika respons tidak OK (misal 404, 500)
                            if (!response.ok) {
                                // Buat error agar masuk ke blok catch
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            return response.json(); // Parsing respons sebagai JSON
                        })
                        .then(data => {
                            // Setelah data kelurahan diterima, isi dropdown
                            kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>'; // Reset opsi
                            // Iterasi data kelurahan yang diterima dan tambahkan ke dropdown
                            data.forEach(function(kelurahan) {
                                const option = document.createElement('option');
                                option.value = kelurahan.id;
                                option.textContent = kelurahan.nama;
                                kelurahanSelect.appendChild(option);
                            });
                            kelurahanSelect.disabled = false; // Aktifkan kembali dropdown kelurahan
                        })
                        .catch(error => {
                            // Tangani error jika permintaan AJAX gagal (misal masalah jaringan, 404, 500)
                            console.error('Error fetching kelurahan:', error); // 'kelurahans' diubah menjadi 'kelurahan'
                            kelurahanSelect.innerHTML = '<option value="">Gagal memuat Kelurahan</option>';
                            kelurahanSelect.disabled = true;
                        });
                } else {
                    // Jika tidak ada kecamatan yang dipilih, reset kelurahan
                    kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
                    kelurahanSelect.disabled = true;
                }
            });
        });

        // Fungsi JavaScript untuk menampilkan nama file yang dipilih
        // Diperbarui untuk menangani multiple files
        function displayFileName(input, targetId) {
            const fileNameSpan = document.getElementById(targetId);
            if (input.files.length > 1) {
                fileNameSpan.textContent = `${input.files.length} file terpilih`;
            } else if (input.files.length === 1) {
                fileNameSpan.textContent = `File terpilih: ${input.files[0].name}`;
            } else {
                fileNameSpan.textContent = '';
            }
        }
    </script>
</body>
</html>
