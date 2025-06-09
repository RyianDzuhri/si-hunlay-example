<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI-Hunlay Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            min-height: 100vh;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: white;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            padding: 20px 0;
        }

        .logo {
            display: flex;
            align-items: center;
            padding: 0 20px 30px;
            color: #3b82f6;
            font-weight: 600;
            font-size: 18px;
        }

        .logo::before {
            content: "🏠";
            margin-right: 8px;
            font-size: 20px;
        }

        .menu-section {
            margin-bottom: 30px;
        }

        .menu-title {
            padding: 0 20px;
            color: #9ca3af;
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #6b7280;
            text-decoration: none;
            transition: all 0.3s;
            font-weight: 400;
        }

        .menu-item:hover {
            background: #f3f4f6;
            color: #3b82f6;
        }

        .menu-item.active {
            background: #eff6ff;
            color: #3b82f6;
            border-right: 3px solid #3b82f6;
        }

        .menu-item::before {
            margin-right: 12px;
            font-size: 16px;
        }

        .menu-item[data-icon="dashboard"]::before { content: "🏠"; }
        .menu-item[data-icon="pengajuan"]::before { content: "📝"; }
        .menu-item[data-icon="progress"]::before { content: "📊"; }
        .menu-item[data-icon="bantuan"]::before { content: "❓"; }
        .menu-item[data-icon="profile"]::before { content: "👤"; }
        .menu-item[data-icon="keluar"]::before { content: "🚪"; }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 20px 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .welcome {
            color: #1f2937;
        }

        .welcome h1 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .welcome p {
            color: #6b7280;
            font-size: 14px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .notification-bell {
            width: 40px;
            height: 40px;
            background: #f3f4f6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: #3b82f6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
        }

        /* Action Cards */
        .action-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .action-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: transform 0.3s;
        }

        .action-card:hover {
            transform: translateY(-2px);
        }

        .action-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .action-card h3 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #1f2937;
        }

        .action-card p {
            font-size: 13px;
            color: #6b7280;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            font-size: 13px;
        }

        .btn-primary {
            background: #3b82f6;
            color: white;
        }

        .btn-primary:hover {
            background: #2563eb;
        }

        .btn-outline {
            background: white;
            color: #3b82f6;
            border: 1px solid #3b82f6;
        }

        .btn-outline:hover {
            background: #3b82f6;
            color: white;
        }

        .card-blue .action-icon {
            background: #dbeafe;
            color: #3b82f6;
        }

        .card-orange .action-icon {
            background: #fed7aa;
            color: #ea580c;
        }

        .card-green .action-icon {
            background: #dcfce7;
            color: #16a34a;
        }

        /* Progress Section */
        .progress-section {
            background: white;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .progress-section h2 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 30px;
            color: #1f2937;
        }

        .progress-steps {
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            margin-bottom: 20px;
        }

        .progress-line {
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 3px;
            background: #e5e7eb;
            z-index: 1;
        }

        .progress-line::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 60%;
            background: #3b82f6;
        }

        .progress-step {
            position: relative;
            z-index: 2;
            text-align: center;
            flex: 1;
        }

        .step-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin: 0 auto 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: white;
        }

        .step-circle.completed {
            background: #3b82f6;
        }

        .step-circle.pending {
            background: #e5e7eb;
            color: #9ca3af;
        }

        .step-label {
            font-size: 12px;
            color: #6b7280;
            font-weight: 500;
        }

        /* Info Section */
        .info-section {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .info-section h2 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #1f2937;
        }

        .info-item {
            display: flex;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            transition: background 0.3s;
        }

        .info-item:hover {
            background: #f9fafb;
        }

        .info-item.highlight {
            background: #eff6ff;
        }

        .info-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 18px;
        }

        .info-icon.blue {
            background: #dbeafe;
            color: #3b82f6;
        }

        .info-icon.green {
            background: #dcfce7;
            color: #16a34a;
        }

        .info-icon.yellow {
            background: #fef3c7;
            color: #d97706;
        }

        .info-content h3 {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 5px;
            color: #1f2937;
        }

        .info-content p {
            font-size: 13px;
            color: #6b7280;
            line-height: 1.4;
        }

        .view-all {
            text-align: center;
            margin-top: 20px;
        }

        .view-all a {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
        }

        .view-all a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">SI-Hunlay</div>
            
            <div class="menu-section">
                <div class="menu-title">Menu Utama</div>
                <a href="#" class="menu-item active" data-icon="dashboard">Dashboard</a>
                <a href="#" class="menu-item" data-icon="pengajuan">Pengajuan Saya</a>
                <a href="#" class="menu-item" data-icon="progress">Progress Pengajuan</a>
            </div>

            <div class="menu-section">
                <div class="menu-title">Lainnya</div>
                <a href="#" class="menu-item" data-icon="bantuan">Bantuan</a>
                <a href="#" class="menu-item" data-icon="profile">Profile</a>
                <a href="#" class="menu-item" data-icon="keluar">Keluar</a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <div class="welcome">
                    <h1>Halo, Krisnaaaaaaa</h1>
                    <p>Selamat datang di dashboard SI-Hunlay</p>
                </div>
                <div class="user-profile">
                    <div class="notification-bell">🔔</div>
                    <div class="user-avatar">KR</div>
                    <span>Krisnaaaaaaa</span>
                </div>
            </div>

            <!-- Action Cards -->
            <div class="action-cards">
                <div class="action-card card-blue">
                    <div class="action-icon">➕</div>
                    <h3>Ajukan Bantuan</h3>
                    <p>Buat Pengajuan bantuan rumah tidak layak huni baru</p>
                    <button class="btn btn-primary">Ajukan Sekarang</button>
                </div>

                <div class="action-card card-orange">
                    <div class="action-icon">⏰</div>
                    <h3>Pengajuan Saya</h3>
                    <p>Lihat status dan riwayat pengajuan bantuan anda</p>
                    <button class="btn btn-outline">Lihat Riwayat</button>
                </div>

                <div class="action-card card-green">
                    <div class="action-icon">📋</div>
                    <h3>Panduan Pengajuan</h3>
                    <p>Pelajari cara mengajukan bantuan dengan benar</p>
                    <button class="btn btn-outline">Baca Panduan</button>
                </div>
            </div>

            <!-- Progress Section -->
            <div class="progress-section">
                <h2>Progress Pengajuan</h2>
                <div class="progress-steps">
                    <div class="progress-line"></div>
                    <div class="progress-step">
                        <div class="step-circle completed">✓</div>
                        <div class="step-label">Pengajuan<br>Diterima</div>
                    </div>
                    <div class="progress-step">
                        <div class="step-circle completed">✓</div>
                        <div class="step-label">Verifikasi<br>Dokumen</div>
                    </div>
                    <div class="progress-step">
                        <div class="step-circle completed">✓</div>
                        <div class="step-label">Jadwal<br>Survei</div>
                    </div>
                    <div class="progress-step">
                        <div class="step-circle pending">4</div>
                        <div class="step-label">Survei<br>Lapangan</div>
                    </div>
                    <div class="progress-step">
                        <div class="step-circle pending">5</div>
                        <div class="step-label">Keputusan<br>Bantuan</div>
                    </div>
                </div>
            </div>

            <!-- Info Section -->
            <div class="info-section">
                <h2>Informasi Terbaru</h2>
                
                <div class="info-item highlight">
                    <div class="info-icon blue">⏰</div>
                    <div class="info-content">
                        <h3>Jadwal Survei</h3>
                        <p>Tim survei akan mengunjungi lokasi Anda pada tanggal 20 Juni 2025</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon green">📢</div>
                    <div class="info-content">
                        <h3>Pengumuman</h3>
                        <p>Periode pengajuan bantuan RTLH tahap II akan dibuka pada 1 Juli 2025</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon yellow">📄</div>
                    <div class="info-content">
                        <h3>Dokumen Terverifikasi</h3>
                        <p>Dokumen KTP dan Kartu Keluarga Anda telah diverifikasi</p>
                    </div>
                </div>

                <div class="view-all">
                    <a href="#">Lihat semua informasi</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>