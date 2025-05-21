<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f5f5;
        }
        .container {
            max-width: 500px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            
        }
        
        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            background: linear-gradient(to right, #0a192f, #000000);
            color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .menu-toggle {
            cursor: pointer;
        }

        .menu-toggle span {
            display: block;
            width: 25px;
            height: 3px;
            background-color: white;
            margin: 5px 0;
            border-radius: 3px;
        }

        .profile-icon img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: -250px;
            width: 250px;
            height: 100%;
            background: #0a192f;
            transition: left 0.3s ease;
            z-index: 1000;
            padding-top: 60px;
            color: white;
        }

        .sidebar.active {
            left: 0;
        }

        .close-sidebar {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 24px;
            cursor: pointer;
        }

        .menu-item {
            padding: 12px 30px;
            display: block;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s;
            cursor: pointer;
        }

        .menu-group {
            margin-bottom: 20px;
        }

        .menu-item:hover {
            background-color: #172a46;
        }
        .menu-title {
            padding: 10px 20px;
            font-weight: bold;
            color: #bdc3c7;
        }
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .welcome-card, .stats-card {
            background-color: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
        }

        .stats-card {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .stat-item {
            flex: 1;
            min-width: 200px;
            text-align: center;
        }

        .stat-icon {
            font-size: 2.5rem;
            color: #0a192f;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: bold;
            color: #0a192f;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 999;
        }

        .overlay.active {
            display: block;
        }

.header h1 {
    flex: 1;
    text-align: center;
    margin: 0;
}

.container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        h1 {
            text-align: center;
            color: #0a192f;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        select {
            background-color: white;
        }

        :root {
            --primary-bg: linear-gradient(to right, #0a192f, #000000);
            --primary-text: white;
            --hover-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .btn {
            padding: 1rem 2.5rem;
            border: none;
            border-radius: 5px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            text-decoration: none;
            text-align: center;
            outline: none;
        }

        .btn:hover {
            background-color: #172a46;
        }

        .btn-submit {
            background: var(--primary-bg);
            color: var(--primary-text);
        }

        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
<div class="header">
        <div class="menu-toggle" id="menuToggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <h3>SMKN 1 SUBANG</h3>

            <div class="profile-icon">
                <a href="{{ url('/profil') }}">
                    <img src="{{ url('/profil') }}" alt="Profile Picture">
                </a>
            </div>            
    </div>

    <div class="overlay" id="overlay"></div>

    <div class="sidebar" id="sidebar">
        <div class="close-sidebar" id="closeSidebar">×</div>
        
        <div class="menu-group">
            <a href="{{ url('/beranda') }}" class="menu-item">Beranda</a>
            <a href="{{ url('/profil') }}" class="menu-item">Profil Saya</a>
        </div>
        
        <div class="menu-group">
            <div class="menu-title">Menu Utama</div>
            <a href="{{ url('/presensi') }}" class="menu-item">Presensi</a>
            <a href="{{ url('/manajementugas') }}" class="menu-item">Management Tugas</a>
            <a href="{{ url('/pengajuan') }}" class="menu-item">Pengajuan Magang</a>
        </div>
        
        <div class="menu-group">
            <div class="menu-title">Lainnya</div>
            <a href="{{ url('/kontak') }}" class="menu-item">Kontak</a>
            <a href="javascript:void(0)" class="menu-item" onclick="confirmLogout()">Logout</a>
        </div>
    </div>

 <div class="container">
<h1>Form Pengajuan Magang</h1>
<div class="form-group">
<form method="POST" action="{{ url('/pengajuan') }}">
    @csrf
    <div class="form-group">
        <label for="nama">Nama Lengkap</label>
        <input type="text" id="nama" name="nama" required>
    </div>

    <div class="form-group">
        <label for="jurusan">Jurusan</label>
        <select id="jurusan" name="jurusan" required>
            <option value="">Pilih Jurusan</option>
            <option value="AKL">Akuntansi Keuangan dan Lembaga</option>
            <option value="RPL">Rekayasa Perangkat Lunak</option>
            <option value="TKJ">Teknik Jaringan dan Komputer</option>
            <option value="KL">Kuliner</option>
            <option value="TL">Teknik Logistik</option>
            <option value="MPLB">Manajemen Perkantoran dan Layanan Bisnis</option>
            <option value="TO">Teknik Otomotif</option>
            <option value="TPM">Teknik Permesinan</option>
            <option value="DKV">Desain Komunikasi Visual</option>
            <option value="PM">Pemasaran</option>
        </select>
    </div>

    <div class="form-group">
        <label for="tanggal_masuk">Tanggal Mulai Magang</label>
        <input type="date" id="tanggal_masuk" name="tanggal_masuk" required>
    </div>

    <div class="form-group">
        <label for="tanggal_keluar">Tanggal Selesai Magang</label>
        <input type="date" id="tanggal_keluar" name="tanggal_keluar" required>
    </div>

    <div class="form-group">
        <label for="perusahaan">Perusahaan:</label>
        <input type="text" name="perusahaan" id="perusahaan" required>
    </div>

    <div class="button-container">
        <button type="submit" class="btn btn-submit">Ajukan Permohonan Magang</button>
    </div>
</form>

    </div>

    <script>
    function confirmLogout() {
        let confirmAction = confirm("Apakah Anda yakin ingin logout?");
        if (confirmAction) {
            window.location.href = "{{ url('/index') }}";
        }
    }
    
    // Menu toggle functionality
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const closeSidebar = document.getElementById('closeSidebar');  
    const overlay = document.getElementById('overlay');

    menuToggle.addEventListener('click', function() {
        sidebar.classList.add('active');
        overlay.classList.add('active');
    });

    closeSidebar.addEventListener('click', function() {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
    });

    overlay.addEventListener('click', function() {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
    });
    </script>
</body>
</html>