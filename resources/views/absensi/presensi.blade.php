@extends('siswa.layout.siswa_layout')
@section('content')
    <style>
<<<<<<< HEAD
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
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
            display: flex;
            flex-direction: column;
            cursor: pointer;
        }

        .menu-toggle span {
            width: 25px;
            height: 3px;
            background-color: white;
            margin: 2px 0;
            border-radius: 3px;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: -250px;
            width: 250px;
            height: 100%;
            background: linear-gradient(to bottom, #0a192f, #111827);
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
            font-size: 20px;
            cursor: pointer;
        }

        .menu-group {
            margin-bottom: 20px;
        }

        .menu-title {
            padding: 10px 20px;
            font-weight: bold;
            color: #bdc3c7;
        }

        .menu-item {
            padding: 12px 30px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
            color: white;
            display: block;
        }

        .menu-item:hover {
            background-color: #172a46;
        }

        .profile-icon a {
             display: block;
             width: 100%;
             height: 100%;
        }
        .profile-icon img {
             width: 40px;
             height: 40px;
             border-radius: 50%;
             object-fit: cover;
             cursor: pointer;
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

=======
>>>>>>> d7390f319b47b889a80ef08f85da0dc72aacab79
        .container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
        }

        header {
            background-color: #0a192f;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 4px;
            margin-bottom: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .jam-digital {
            font-size: 2.5rem;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
            padding: 15px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .tanggal {
            font-size: 1.2rem;
            text-align: center;
            margin-bottom: 20px;
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 15px;
            color: #2c3e50;
            border-bottom: 2px solid #ecf0f1;
            padding-bottom: 10px;
        }

        .button-group {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
        }

        button {
            padding: 12px 25px;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .btn-masuk {
            background-color: #0a192f;
            color: white;
        }

        .btn-masuk:hover:not(:disabled) {
            background-color: #27ae60;
        }

        .btn-pulang {
            background-color: #e74c3c;
            color: white;
        }

        .btn-pulang:hover:not(:disabled) {
            background-color: #c0392b;
        }

        .btn-izin {
            background-color: #f39c12;
            color: white;
        }

        .btn-izin:hover:not(:disabled) {
            background-color: #d35400;
        }

        .alert {
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-weight: bold;
            display: none;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

<<<<<<< HEAD
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            max-width: 500px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            animation: modalFadeIn 0.3s;
        }

        @keyframes modalFadeIn {
            from {opacity: 0; transform: translateY(-50px);}
            to {opacity: 1; transform: translateY(0);}
        }

=======
>>>>>>> d7390f319b47b889a80ef08f85da0dc72aacab79
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }

        .btn-submit {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn-submit:hover {
            background-color: #2980b9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

<<<<<<< HEAD
        table th, table td {
=======
        table th,
        table td {
>>>>>>> d7390f319b47b889a80ef08f85da0dc72aacab79
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
            color: #333;
        }

        table tr:hover {
            background-color: #f5f5f5;
        }

        .statistik {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .stat-item {
            flex: 1;
            min-width: 120px;
            padding: 15px;
            margin: 5px;
            background: white;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .stat-item h3 {
            margin-bottom: 10px;
            font-size: 1.2rem;
            color: #555;
        }

        .stat-item .value {
            font-size: 2rem;
            font-weight: bold;
            color: #0a192f;
        }

<<<<<<< HEAD
        .stat-hadir .value { color:  #0a192f; }
        .stat-terlambat .value { color:  #0a192f; }
        .stat-izin .value { color:  #0a192f; }
        .stat-sakit .value { color:  #0a192f; }
=======
        .stat-hadir .value {
            color: #0a192f;
        }

        .stat-terlambat .value {
            color: #0a192f;
        }

        .stat-izin .value {
            color: #0a192f;
        }

        .stat-sakit .value {
            color: #0a192f;
        }
>>>>>>> d7390f319b47b889a80ef08f85da0dc72aacab79

        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
            color: white;
        }

<<<<<<< HEAD
        .status-hadir { background-color: #0a192f; }
        .status-terlambat { background-color:  #0a192f; }
        .status-izin { background-color:  #0a192f; }
        .status-sakit { background-color: #0a192f; }
=======
        .status-hadir {
            background-color: #0a192f;
        }

        .status-terlambat {
            background-color: #0a192f;
        }

        .status-izin {
            background-color: #0a192f;
        }

        .status-sakit {
            background-color: #0a192f;
        }
>>>>>>> d7390f319b47b889a80ef08f85da0dc72aacab79

        @media (max-width: 768px) {
            .button-group {
                flex-direction: column;
                gap: 10px;
            }

            button {
                width: 100%;
            }

            .statistik {
                flex-direction: column;
            }

            .stat-item {
                margin: 5px 0;
            }

            .jam-digital {
                font-size: 2rem;
            }
        }
<<<<<<< HEAD
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
        .menu-title {
            padding: 10px 20px;
            font-weight: bold;
            color: #bdc3c7;
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

        .menu-group {
            margin-bottom: 20px;
        }

        .menu-item {
            padding: 12px 30px;
            display: block;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s;
            cursor: pointer;
        }

        .menu-item:hover {
            background-color: : #0a192f;
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
        .modal {
    display: none;
    position: fixed;
    z-index: 999;
    left: 0; top: 0;
    width: 100%; height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
    background-color: #fff;
    margin: 10% auto;
    padding: 20px;
    border-radius: 8px;
    width: 40%;
    position: relative;
}

.close {
    position: absolute;
    right: 15px;
    top: 10px;
    font-size: 20px;
    cursor: pointer;
}
=======
>>>>>>> d7390f319b47b889a80ef08f85da0dc72aacab79
    </style>
    </head>

    <body>
        <div class="container">
            <header>
                <h2>Sistem Presensi Siswa</h2>
            </header>

            <div class="card">
                <div class="tanggal" id="tanggal"></div>
                <div class="jam-digital" id="jam"></div>
                <div id="alertBox" class="alert"></div>

                <!-- Tombol Absensi -->
                <div class="button-group">
                    <button id="btnMasuk" class="btn-masuk">Absen Masuk</button>
                    <button id="btnPulang" class="btn-pulang">Absen Pulang</button>
                    <button id="btnIzin" class="btn-izin" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        data-bs-whatever="@mdo">Ajukan Izin</button>
                </div>
            </div>
        </div>

<<<<<<< HEAD
            <div class="profile-icon">
                <a href="{{ url('/profil') }}">
                    <img src="{{ url('/profil') }}" alt="Profile Picture">
                </a>
            </div>

        <div class="profile-icon">
            <a href="{{ url('/profil') }}">
                <img src="{{ url('/profil') }}" alt="Profile Picture">
            </a>
        </div>
    </div>
=======
        <!-- Modal Pulang Awal -->
>>>>>>> d7390f319b47b889a80ef08f85da0dc72aacab79


<<<<<<< HEAD
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
            <a href="{{ url('/magang') }}" class="menu-item">Pengajuan Magang</a>
        </div>

        <div class="menu-group">
            <div class="menu-title">Lainnya</div>
            <a href="{{ url('/kontak') }}" class="menu-item">Kontak</a>
            <a href="javascript:void(0)" class="menu-item" onclick="confirmLogout()">Logout</a>
        </div>
    </div>

<form method="POST" action="{{ url('/absensi') }}">


<body>
<form method="POST" action="{{ url('/absensi') }}">
<form method="POST" action="{{ url('/absen/masuk') }}">
    <div class="container">
        <header>
            <h1>Sistem Presensi Siswa</h1>
        </header>
        <div class="card">
        <!-- Tombol untuk kembali ke halaman sebelumnya -->
<a href="javascript:history.back()" class="btn btn-primary">Kembali</a>
<a href="{{ url('/dashboard') }}" class="btn btn-primary">Kembali ke Dashboard</a>

        <div class="card">
            <div class="tanggal" id="tanggal"></div>
            <div class="jam-digital" id="jam"></div>
         <div id="alertBox" class="alert"></div>
              <div class="button-group">
<form method="POST" action="{{ url('/absen/masuk') }}">
    @csrf
    <button id="btnMasuk" class="btn-masuk">Absen Masuk</button>
</form>
<form method="POST" action="{{ url('/absen/keluar') }}">
    @csrf
    <button id="btnKeluar" class="btn-keluar" disabled>Absen Keluar</button>
</form>
<form method="POST" action="{{ url('/izin') }}">
    @csrf
      <button id="btnIzin" class="btn-izin">Izin / Sakit</button>
</form>
         </div>
        </div>
     <div class="card">
   <h2 class="card-title">Riwayat Absensi - <span id="bulanTahun"></span></h2>
<div class="statistik">
    <div class="stat-item stat-hadir">
        <h3>Hadir</h3>
        <div class="value">{{ $data['hadir'] ?? 0 }}</div>
    </div>
    <div class="stat-item stat-terlambat">
        <h3>Terlambat</h3>
        <div class="value">{{ $data['terlambat'] ?? 0 }}</div>
    </div>
    <div class="stat-item stat-izin">
        <h3>Izin</h3>
        <div class="value">{{ $data['izin'] ?? 0 }}</div>
    </div>
    <div class="stat-item stat-sakit">
        <h3>Sakit</h3>
        <div class="value">{{ $data['sakit'] ?? 0 }}</div>
<div class="container">
    <header>
        <h1>Sistem Presensi Siswa</h1>
    </header>
=======
        <!-- Modal Izin -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Pengajuan Izin/Sakit</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Jenis Izin</label>
                                <select class="form-select" id="statusIzin">
                                    <option value="Izin">Izin</option>
                                    <option value="Sakit">Sakit</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="col-form-label">Keterangan:</label>
                                <textarea class="form-control" id="keterangan"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Send message</button>
                    </div>
                </div>
            </div>
        </div>
>>>>>>> d7390f319b47b889a80ef08f85da0dc72aacab79

        <div id="absenContainer" class="container p-3">
            <h2 class="card-title text-center">Riwayat Absensi</h2>

            <div class="d-flex justify-content-center mb-3">
                <select class="form-select me-2" id="bulan">
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>

                <select class="form-select me-2" id="tahun">
                    @for ($i = date('Y'); $i <= date('Y') + 5; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>

                <button class="btn btn-primary" id="cariData">Cari Data</button>
            </div>

            <div class="stats-card d-flex justify-content-around mb-3">
                <div class="stat-item text-center">
                    <h3>Hadir</h3>
                    <span class="stat-icon">✔️</span>
                    <span class="stat-value">{{ $statistik['hadir'] ?? 0 }}</span>
                </div>
                <div class="stat-item text-center">
                    <h3>Terlambat</h3>
                    <span class="stat-icon">⏰</span>
                    <span class="stat-value">{{ $statistik['terlambat'] ?? 0 }}</span>
                </div>
                <div class="stat-item text-center">
                    <h3>Izin</h3>
                    <span class="stat-icon">📝</span>
                    <span class="stat-value">{{ $statistik['izin'] ?? 0 }}</span>
                </div>
                <div class="stat-item text-center">
                    <h3>Sakit</h3>
                    <span class="stat-icon">🤒</span>
                    <span class="stat-value">{{ $statistik['sakit'] ?? 0 }}</span>
                </div>
            </div>

            <div id="absensiTable" class="card p-3">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($absensiData as $absen)
                            <tr>
                                <td>{{ $absen->tanggal ?? '' }}</td>
                                <td>{{ $absen->status ?? '' }}</td>
                                <td>{{ $absen->absen_masuk ?? '' }}</td>
                                <td>{{ $absen->jam_keluar ?? '' }}</td>
                                <td>{{ $absen->keterangan ?? '' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
<<<<<<< HEAD
            <button type="submit" class="btn-submit">Kirim</button>
        </form>
    </div>
</div>

<div id="liburContainer" class="container" style="display: none;">
    <p style="font-size: 18px; font-weight: bold;">Hari ini bukan hari kerja atau merupakan hari libur nasional.</p>
    <img src="/img/liburan.png" alt="Libur" style="max-width: 200px; margin-top: 10px;">
</div>

<div id="absenContainer" class="container">
        <h2 class="card-title">Riwayat Absensi -
        <select id="bulan">
            <option value="01">Januari</option>
            <option value="02">Februari</option>
            <option value="03">Maret</option>
            <option value="04">April</option>
            <option value="05">Mei</option>
            <option value="06">Juni</option>
            <option value="07">Juli</option>
            <option value="08">Agustus</option>
            <option value="09">September</option>
            <option value="10">Oktober</option>
            <option value="11">November</option>
            <option value="12">Desember</option>
        </select>

        <select id="tahun">
            @for ($i = date('Y'); $i >= date('Y') - 5; $i--)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </h2><div class="stats-card">
        <div class="stat-item stat-hadir">
            <h3>Hadir</h3>
            <span class="stat-icon">✔️</span>
            <span class="stat-value">{{ $statistik['hadir'] ?? 0 }}</span>
        </div>
        <div class="stat-item stat-terlambat">
            <h3>Terlambat</h3>
            <span class="stat-icon">⏰</span>
            <span class="stat-value ">{{ $statistik['terlambat'] ?? 0 }}</span>
        </div>
        <div class="stat-item stat-izin">
            <h3>Izin</h3>
            <span class="stat-icon">📝</span>
            <span class="stat-value">{{ $statistik['izin'] ?? 0 }}</span>
        </div>
        <div class="stat-item stat-sakit">
            <h3>Sakit</h3>
            <span class="stat-icon">🤒</span>
            <span class="stat-value">{{ $statistik['sakit'] ?? 0 }}</span>
        </div>
    </div>
=======
        </div>
        <div id="modalPulangAwal">
            <input type="text" id="alasanPulangAwal" placeholder="Alasan pulang awal">
            <button id="submitPulangAwal">Submit</button>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
>>>>>>> d7390f319b47b889a80ef08f85da0dc72aacab79

        <script>
            // Jam Digital
            function updateTime() {
                const now = new Date();
                const options = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };
                document.getElementById('tanggal').textContent = now.toLocaleDateString('id-ID', options);
                document.getElementById('jam').textContent = now.toLocaleTimeString('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });
            }
<<<<<<< HEAD
        }


        // Jam Digital
        function updateTime() {
            const now = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById('tanggal').textContent = now.toLocaleDateString('id-ID', options);
            document.getElementById('jam').textContent = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        }
        setInterval(updateTime, 1000);
        updateTime(); // Panggil sekali untuk inisialisasi

        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
<script>
// Global constants
const jamMasuk = "07:30";
const jamPulang = "16:00";
const hariKerja = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat"];

// Status absen dari localStorage
let statusAbsen = localStorage.getItem("statusAbsen") || "masuk";
let sudahAbsenMasuk = localStorage.getItem("sudahAbsenMasuk") === "true";
let sudahAbsenPulang = localStorage.getItem("sudahAbsenPulang") === "true";
let sudahIzin = localStorage.getItem("sudahIzin") === "true";
let lastPosition = null; // untuk menyimpan lokasi GPS terakhir

$(document).ready(function () {
    cekHariKerjaDanLibur().then((bolehAbsen) => {
        if (!bolehAbsen) return;

        updateTombol();

        // Event Absen Masuk
        $("#btnMasuk").click(function () {
            cekLokasiAktif(async function (position) {
                const currentTime = getWaktuWIB();
                if (currentTime < jamMasuk) {
                    alert("Belum waktunya absen masuk!");
                    return;
                }

                const kodeKota = await getKodeKota(position);
                kirimAbsen("/absen/masuk", position, "masuk", kodeKota);
            });
        });

        // Event Absen Pulang
        $("#btnPulang").click(function () {
            cekLokasiAktif(async function (position) {
                const currentTime = getWaktuWIB();

                if (currentTime < jamPulang) {
                    $("#modalPulangAwal").fadeIn();

                    $("#formPulangAwal").off("submit").on("submit", async function (e) {
                        e.preventDefault();
                        const alasan = $("#alasan_pulang_awal").val();
                        if (!alasan) {
                            alert("Isi alasan pulang lebih awal.");
                            return;
                        }

                        const kodeKota = await getKodeKota(position);

                        $.ajax({
                            type: "POST",
                            url: "/absen/pulang-awal",
                            data: {
                                alasan_pulang_awal: alasan,
                                latitude: position.coords.latitude,
                                longitude: position.coords.longitude,
                                kode_kota: kodeKota,
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (response) {
                                alert(response.message);
                                $("#modalPulangAwal").fadeOut();
                                localStorage.setItem("sudahAbsenPulang", "true");
                                sudahAbsenPulang = true;
                                updateTombol();
                            },
                            error: function (xhr) {
                                console.error(xhr.responseText);
                                alert("Gagal kirim data pulang awal.");
                            }
                        });
                    });

                    return;
                }

                if (currentTime > "19:00") {
                    alert("Batas absen pulang jam 19:00.");
                    return;
                }

                const kodeKota = await getKodeKota(position);
                kirimAbsen("/absen/pulang", position, "pulang", kodeKota);
            });
        });

        // Event Ajukan Izin
        $("#btnIzin").click(function () {
            $("#modalIzin").fadeIn();
        });

        // Submit Izin
        $("#formIzin").submit(function (e) {
            e.preventDefault();
            const jenis = $("#jenis_izin").val();
            const alasan = $("#alasan_izin").val();

            if (!jenis || !alasan) {
                alert("Lengkapi semua data!");
                return;
            }

            $.ajax({
                type: "POST",
                url: "/absen/izin",
                data: {
                    status: jenis,
                    keterangan: alasan,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function () {
                    alert("Izin berhasil diajukan!");
                    $("#modalIzin").fadeOut();
                    localStorage.setItem("sudahIzin", "true");
                    sudahIzin = true;
                    updateTombol();
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    alert("Gagal ajukan izin.");
                }
            });
        });

        // Reset setiap jam 00:00 WIB
        setInterval(function () {
            const currentTime = getWaktuWIB();
            if (currentTime === "00:00") {
                localStorage.clear();
                statusAbsen = "masuk";
                sudahAbsenMasuk = false;
                sudahAbsenPulang = false;
                sudahIzin = false;
                updateTombol();
            }
        }, 60000);
    });

    // Tutup modal
    $(".close").click(function () {
        $("#modalIzin, #modalPulangAwal").fadeOut();
    });

    $(window).click(function (event) {
        if ($(event.target).is("#modalIzin") || $(event.target).is("#modalPulangAwal")) {
            $("#modalIzin, #modalPulangAwal").fadeOut();
        }
    });
});

function getWaktuWIB() {
    const now = new Date();
    const utc = now.getTime() + now.getTimezoneOffset() * 60000;
    const wib = new Date(utc + 7 * 3600000);
    const jam = wib.getHours().toString().padStart(2, "0");
    const menit = wib.getMinutes().toString().padStart(2, "0");
    return `${jam}:${menit}`;
}

function tampilkanLibur(pesan) {
    $("#absenContainer").hide();
    $("#liburContainer").html(`
        <p style="font-size: 18px; font-weight: bold;">${pesan}</p>
        <img src="/img/liburan.png" alt="Libur" style="max-width: 200px; margin-top: 10px;">
    `).show();
    $("#btnMasuk, #btnPulang, #btnIzin").prop("disabled", true);
}

async function cekHariKerjaDanLibur() {
    const now = new Date();
    const utc = now.getTime() + now.getTimezoneOffset() * 60000;
    const wib = new Date(utc + 7 * 3600000);

    const hari = wib.toLocaleDateString("id-ID", { weekday: "long" });
    const tanggal = wib.getDate();
    const bulan = wib.getMonth() + 1;
    const tahun = wib.getFullYear();

    if (!hariKerja.includes(hari)) {
        tampilkanLibur("Hari ini bukan hari kerja.");
        return false;
    }

    try {
        const response = await $.ajax({
            url: `https://dayoffapi.vercel.app/api?year=${tahun}&month=${bulan}&day=${tanggal}`,
            method: "GET",
            dataType: "json"
        });

        if (response && response.length > 0 && response[0].is_national_holiday) {
            tampilkanLibur(`Selamat berlibur: ${response[0].event}`);
            return false;
        }
    } catch (error) {
        console.warn("Gagal cek libur:", error);
    }

    $("#absenContainer").show();
    $("#liburContainer").hide();
    return true;
}

function updateTombol() {
    const currentTime = getWaktuWIB();

    $("#btnMasuk").text("Absen Masuk");
    $("#btnPulang").text("Absen Pulang");
    $("#btnIzin").text("Ajukan Izin");

    const disableSemua = currentTime < jamMasuk || currentTime > "19:00";
    $("#btnMasuk, #btnPulang, #btnIzin").prop("disabled", disableSemua);

    if (!disableSemua) {
        $("#btnMasuk").prop("disabled", sudahAbsenMasuk || sudahIzin);
        $("#btnPulang").prop("disabled", !sudahAbsenMasuk || sudahAbsenPulang || sudahIzin);
        $("#btnIzin").prop("disabled", sudahAbsenMasuk || sudahAbsenPulang || sudahIzin);
    }

    $("#btnMasuk").toggle(!sudahAbsenMasuk && !sudahIzin);
    $("#btnPulang").toggle(sudahAbsenMasuk && !sudahAbsenPulang && !sudahIzin);

    if (sudahAbsenMasuk && sudahAbsenPulang) {
        $("#btnMasuk, #btnPulang, #btnIzin").prop("disabled", true);
        $("#btnMasuk").text("Anda sudah absen hari ini");
    } else if (sudahIzin) {
        $("#btnMasuk, #btnPulang").prop("disabled", true);
        $("#btnIzin").prop("disabled", true).text("Sudah mengajukan izin");
    }
}

function kirimAbsen(url, position, status, kodeKota = "Tidak diketahui") {
    if (!position || !status) {
        alert("Data absen tidak valid.");
        return;
    }

    $.ajax({
        type: "POST",
        url: url,
        data: {
            latitude: position.coords.latitude,
            longitude: position.coords.longitude,
            status: status,
            kode_kota: kodeKota,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function () {
            alert(`Absen berhasil (${status})`);
            if (status === "masuk") {
                statusAbsen = "pulang";
                localStorage.setItem("statusAbsen", "pulang");
                localStorage.setItem("sudahAbsenMasuk", "true");
                sudahAbsenMasuk = true;
            } else {
                localStorage.setItem("sudahAbsenPulang", "true");
                sudahAbsenPulang = true;
            }
            updateTombol();
        },
        error: function (xhr) {
            console.error(xhr.responseText);
            alert(`Gagal mengirim absen (${status})`);
        }
    });
}

function cekLokasiAktif(callback) {
    if (!navigator.geolocation) {
        alert("Perangkat Anda tidak mendukung geolokasi.");
        return;
    }

    navigator.geolocation.getCurrentPosition(
        function (position) {
            console.log("Lokasi didapat:", position.coords.latitude, position.coords.longitude);
            lastPosition = position;
            callback(position);
        },
        function (error) {
            alert("Lokasi tidak aktif. Nyalakan GPS!");
        }
    );
}

async function getKodeKota(position) {
    const lat = position.coords.latitude;
    const lon = position.coords.longitude;

    try {
        const response = await $.ajax({
            url: `https://nominatim.openstreetmap.org/reverse`,
            data: {
                format: "json",
                lat: lat,
                lon: lon
            }
        });
<<<<<<< HEAD

        const city = response.address.city || response.address.town || response.address.village || "Tidak diketahui";
        return city;
    } catch (error) {
        console.warn("Gagal ambil kota:", error);
        return "Tidak diketahui";
    }
}
</script>

    const data = await response.json();
    alert(data.message);

    document.getElementById('modalIzin').style.display = 'none';
    document.getElementById('formIzin').reset(); 
     </script>


     <script>
        // Event listener untuk form pulang awal
        document.getElementById('formPulangAwal').addEventListener('submit', function(e) {
            e.preventDefault();

            const alasan = document.getElementById('alasan_pulang_cepat').value;
            const now = new Date();
            const jam = formatJam(now);
            const tanggal = now.toISOString().split('T')[0];

            // Update data presensi
            updateDataPresensi(tanggal, {
                jamKeluar: jam,
                keterangan: alasan
            });
            // Sembunyikan modal
            document.getElementById('modalPulangAwal').style.display = 'none';
            // Reset form
            document.getElementById('formPulangAwal').reset();
            // Tampilkan pesan
            showAlert('Berhasil absen keluar dengan keterangan pulang lebih awal!', 'success');
        });

        // Modal controls
        const modalIzin = document.getElementById('modalIzin');
        const modalPulangAwal = document.getElementById('modalPulangAwal');
        const spans = document.getElementsByClassName('close');

        // Tutup modal ketika klik tombol close (×)
        for (let i = 0; i < spans.length; i++) {
            spans[i].onclick = function() {
                modalIzin.style.display = 'none';
                modalPulangAwal.style.display = 'none';
            }
        }

        // Tutup modal ketika klik di luar modal
        window.onclick = function(event) {
            if (event.target == modalIzin) {
                modalIzin.style.display = 'none';
            }
            if (event.target == modalPulangAwal) {
                modalPulangAwal.style.display = 'none';
            }
        }

        // Inisialisasi tampilan
        updateTabelPresensi();

        document.getElementById("btnMasuk").addEventListener("click", function() {
    let tanggal = new Date().toISOString().split('T')[0];
    let jamMasuk = new Date().toLocaleTimeString();

    fetch('/absensi', {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            tanggal: tanggal,
            status: "Hadir",
            jam_masuk: jamMasuk,
            jam_keluar: "",
            keterangan: ""
        })
    })
    .then(response => response.json())
    .then(data => alert(data.message))
    .catch(error => console.error("Error:", error));
});
fetch("/absensi")
    .then(response => response.json())
    .then(data => {
        let tabel = document.getElementById("tabelPresensi");
        tabel.innerHTML = "";

        data.forEach(item => {
            let row = `<tr>
                <td>${item.tanggal}</td>
                <td>${item.status}</td>
                <td>${item.jam_masuk || "-"}</td>
                <td>${item.jam_keluar || "-"}</td>
                <td>${item.keterangan || "-"}</td>
            </tr>`;
            tabel.innerHTML += row;
        });
    })
    .catch(error => console.error("Error:", error));

    document.getElementById("formIzin").addEventListener("submit", function(event) {
    event.preventDefault();

    let jenisIzin = document.getElementById("jenis_izin").value;
    let alasanIzin = document.getElementById("alasan_izin").value;

    fetch("/absensi/izin", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
        },
        body: JSON.stringify({ jenis_izin: jenisIzin, alasan_izin: alasanIzin })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        window.location.reload();
    })
    .catch(error => console.error("Terjadi kesalahan:", error));
});

document.getElementById("formPulangAwal").addEventListener("submit", function(event) {
    event.preventDefault();

    let alasanPulang = document.getElementById("alasan_pulang_cepat").value;

    fetch("/absensi/pulang-awal", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
        },
        body: JSON.stringify({ alasan_pulang_cepat: alasanPulang })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        window.location.reload();
    })
    .catch(error => console.error("Terjadi kesalahan:", error));
});

       document.getElementById('formPulangAwal').addEventListener('submit', function(e) {
    e.preventDefault();

    const alasan = document.getElementById('alasan_pulang_cepat').value;
    const now = new Date();
    const jam = now.getHours().toString().padStart(2, '0') + ':' + now.getMinutes().toString().padStart(2, '0');
    const tanggal = now.toISOString().split('T')[0];

    let absensiData = JSON.parse(localStorage.getItem('absensiData')) || [];

    // Cek apakah sudah absen masuk hari ini sebelum bisa pulang lebih awal
    let absenHariIniIndex = absensiData.findIndex(absen => absen.tanggal === tanggal && absen.jamMasuk);
    if (absenHariIniIndex === -1) {
        showAlert('Anda belum absen masuk hari ini!', 'error');
        return;
    }

    // Cek apakah sudah absen keluar hari ini
    if (absensiData[absenHariIniIndex].jamKeluar) {
        showAlert('Anda sudah absen pulang hari ini!', 'error');
        return;
    }

    // Update data absensi dengan jam keluar dan alasan pulang lebih awal
    absensiData[absenHariIniIndex].jamKeluar = jam;
    absensiData[absenHariIniIndex].keterangan = alasan;
    localStorage.setItem('absensiData', JSON.stringify(absensiData));

    // Sembunyikan modal dan reset form
    document.getElementById('modalPulangAwal').style.display = 'none';
    document.getElementById('formPulangAwal').reset();

    // Tampilkan pesan keberhasilan
    showAlert('Berhasil absen keluar dengan keterangan pulang lebih awal!', 'success');
});

// Modal controls
const modalIzin = document.getElementById('modalIzin');
const modalPulangAwal = document.getElementById('modalPulangAwal');
const spans = document.getElementsByClassName('close');

// Tutup modal ketika klik tombol close (×)
for (let i = 0; i < spans.length; i++) {
    spans[i].onclick = function() {
        modalIzin.style.display = 'none';
        modalPulangAwal.style.display = 'none';
    };
}

// Tutup modal ketika klik di luar modal
window.onclick = function(event) {
    if (event.target == modalIzin) {
        modalIzin.style.display = 'none';
    }
    if (event.target == modalPulangAwal) {
        modalPulangAwal.style.display = 'none';
    }
};

// Inisialisasi tampilan
updateTabelPresensi();
updateStatistik();
updateJam();
    </script>

</body>
</html>
=======
            setInterval(updateTime, 1000);
            updateTime(); // Panggil sekali untuk inisialisasi
        </script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    </body>
@endsection
>>>>>>> d7390f319b47b889a80ef08f85da0dc72aacab79
