<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Formulir Pengajuan Bantuan RTLH</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="max-w-5xl mx-auto px-4 py-6">
        <div class="mb-4 text-sm text-gray-500">Dashboard > Pengajuan RTLH</div>
        <h1 class="text-2xl font-bold mb-1">Formulir Pengajuan Bantuan RTLH</h1>
        <p class="text-gray-600 mb-6">Silahkan lengkapi formulir di bawah ini dengan data yang benar</p>

        <form action="#" method="POST">
            @csrf

            <!-- Data Lokasi -->
            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <h2 class="text-lg font-semibold mb-4 border-l-4 border-blue-500 pl-2">Data Lokasi</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium">Kecamatan</label>
                        <select name="lokasi_kecamatan" class="w-full mt-1 border border-gray-300 rounded p-2">
                            <option value="">Pilih Kecamatan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Kelurahan</label>
                        <select name="lokasi_kelurahan" class="w-full mt-1 border border-gray-300 rounded p-2">
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
                    <div>
                        <label class="block text-sm font-medium">Kecamatan</label>
                        <select name="administrasi_kecamatan" class="w-full mt-1 border border-gray-300 rounded p-2">
                            <option value="">Pilih Kecamatan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Pekerjaan Utama</label>
                        <select name="pekerjaan_utama" class="w-full mt-1 border border-gray-300 rounded p-2">
                            <option value="">Pilih Pekerjaan</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium">Penghasilan Perbulan</label>
                        <select name="penghasilan_perbulan" class="w-full mt-1 border border-gray-300 rounded p-2">
                            <option value="">Pilih Nominal</option>
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
                        <label class="block text-sm font-medium mb-1">Luas Rumah</label>
                        <input type="text" name="luas_rumah" class="w-full border border-gray-300 rounded p-2" placeholder="Dalam meter²">
                        <label class="block text-sm font-medium mt-4 mb-1">Jumlah Penghuni</label>
                        <input type="number" name="jumlah_penghuni" class="w-full border border-gray-300 rounded p-2">
                    </div>
                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="text-right">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                    Kirim Pengajuan
                </button>
            </div>
        </form>
    </div>
</body>
</html>
