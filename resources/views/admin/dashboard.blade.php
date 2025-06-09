<!-- resources/views/admin/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SI-Hunlay</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin/auth/login.css') }}"> <!-- Gunakan CSS yang sudah ada untuk konsistensi -->
    <style>
        .dashboard {
            display: flex;
            height: 100vh;
            background: #f5f7fa;
            font-family: 'Poppins', sans-serif;
        }

        .sidebar {
            width: 250px;
            background: #fff;
            padding: 20px;
            border-right: 1px solid #e0e0e0;
        }

        .sidebar h2 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #1E60E1;
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar ul li {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            color: #333;
        }

        .sidebar ul li.active {
            background: #e9f2fd;
            color: #1E60E1;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: inherit;
        }

        .main-content {
            flex: 1;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            font-weight: 600;
            color: #1E60E1;
        }

        .header .user-info {
            display: flex;
            align-items: center;
        }

        .header .user-info span {
            margin-right: 10px;
            font-weight: 500;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .stat-card h3 {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }

        .stat-card p {
            font-size: 20px;
            font-weight: 600;
            color: #1E60E1;
        }

        .charts {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .chart-card {
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .table {
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .table table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }

        .table th {
            background: #f5f7fa;
            font-weight: 600;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <div class="sidebar">
            <h2><span style="color: #1E60E1;">🏠</span> SI-Hunlay</h2>
            <ul>
                <li class="active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li>Pengajuan Bantuan</li>
                <li>Penugasan</li>
                <li>Hasil Verifikasi</li>
                <li>Akun Pengguna</li>
                <li>Akun Petugas</li>
                <li>Bantuan</li>
                <li>Profile</li>
                <li>Keluar</li>
            </ul>
        </div>
        <div class="main-content">
            <div class="header">
                <h1>Selamat Datang, Admin</h1>
                <div class="user-info">
                    <span>KR Krisnaaaaa</span>
                    <button>🔍</button>
                </div>
            </div>
            <p class="subtitle">Ringkasan data dan aktivitas SI-Hunlay Kota Kendari</p>
            <div class="stats">
                <div class="stat-card">
                    <h3>Total Pengajuan Masuk</h3>
                    <p>100 <span style="color: green;">↑ 50% dari bulan lalu</span></p>
                </div>
                <div class="stat-card">
                    <h3>Pengajuan Diverifikasi</h3>
                    <p>100 <span style="color: green;">↑ 50% dari bulan lalu</span></p>
                </div>
                <div class="stat-card">
                    <h3>Disetujui</h3>
                    <p>100 <span style="color: green;">↑ 50% dari bulan lalu</span></p>
                </div>
                <div class="stat-card">
                    <h3>Ditolak</h3>
                    <p>100 <span style="color: green;">↑ 50% dari bulan lalu</span></p>
                </div>
            </div>
            <div class="charts">
                <div class="chart-card">
                    <h3>Statistik Pengajuan per Kecamatan</h3>
                    <div style="height: 200px; background: #e0e0e0;">[Placeholder untuk Bar Chart]</div>
                </div>
                <div class="chart-card">
                    <h3>Status Pengajuan</h3>
                    <div style="height: 200px; background: #e0e0e0;">[Placeholder untuk Pie Chart]</div>
                </div>
            </div>
            <div class="table">
                <h3>Pengajuan Terbaru</h3>
                <table>
                    <tr>
                        <th>ID Pengajuan</th>
                        <th>Nama</th>
                        <th>Kecamatan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    <tr>
                        <td>RTLH-2025-01-041</td>
                        <td>Gusti Krisna Pranata</td>
                        <td>Baruga</td>
                        <td>3 Juni 2025</td>
                        <td>Verifikasi</td>
                        <td>Detail</td>
                    </tr>
                    <tr>
                        <td>RTLH-2025-01-041</td>
                        <td>Gusti Krisna Pranata</td>
                        <td>Baruga</td>
                        <td>3 Juni 2025</td>
                        <td>Verifikasi</td>
                        <td>Detail</td>
                    </tr>
                    <tr>
                        <td>RTLH-2025-01-041</td>
                        <td>Gusti Krisna Pranata</td>
                        <td>Baruga</td>
                        <td>3 Juni 2025</td>
                        <td>Verifikasi</td>
                        <td>Detail</td>
                    </tr>
                    <tr>
                        <td>RTLH-2025-01-041</td>
                        <td>Gusti Krisna Pranata</td>
                        <td>Baruga</td>
                        <td>3 Juni 2025</td>
                        <td>Verifikasi</td>
                        <td>Detail</td>
                    </tr>
                    <tr>
                        <td>RTLH-2025-01-041</td>
                        <td>Gusti Krisna Pranata</td>
                        <td>Baruga</td>
                        <td>3 Juni 2025</td>
                        <td>Verifikasi</td>
                        <td>Detail</td>
                    </tr>
                </table>
            </div>
            <div class="footer">
                © 2025 SI-Hunlay Kota Kendari. Hak Cipta Dilindungi. | Bantuan | Kebijakan Privasi | Syarat & Ketentuan
            </div>
        </div>
    </div>
</body>
</html>