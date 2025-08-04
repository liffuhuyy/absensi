<!DOCTYPE html>
<html lang="id">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            background: linear-gradient(to right, #0a192f, #000000);
            color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .date-time {
            background-color: #002b56;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 16px;
        }

        .time-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
        }

        .time-block {
            text-align: center;
            flex: 1;
        }

        .time-block h3 {
            margin: 0 0 5px 0;
            color: #001f3f;
            font-size: 16px;
        }

        .time-block p {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        .action-btn {
            display: block;
            width: 97%;
            padding: 13px;
            background-color: #001f3f;
            color: white;
            border: none;
            border-radius: 20px;
            font-size: 17px;
            font-weight: bold;
            cursor: pointer;
            margin-bottom: 15px;
            transition: background-color 0.3s;
        }

        .action-btn:hover {
            background-color: #003366;
        }

        .action-btn:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }

        .secondary-btn {
            background-color: #f8f9fa;
            color: #001f3f;
            border: 2px solid #001f3f;
        }

        .secondary-btn:hover {
            background-color: #e9ecef;
        }

        .status {
            text-align: center;
            margin-top: 10px;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
        }

        .status.success {
            background-color: #d4edda;
            color: #155724;
        }

        .status.late {
            background-color: #f8d7da;
            color: #721c24;
        }

        .status.waiting {
            background-color: #fff3cd;
            color: #856404;
        }

        .hide {
            display: none;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            width: 90%;
            max-width: 400px;
        }

        .modal-content h3 {
            color: #001f3f;
            margin-top: 0;
        }

        .modal-content textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            min-height: 100px;
        }

        .modal-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .modal-btn {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .confirm-btn {
            background-color: #001f3f;
            color: white;
        }

        .cancel-btn {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
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

        .welcome-card,
        .stats-card {
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

        body,
        h1,
        h2,
        table {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
            color: #ffffff;
        }

        h2 {
            margin-top: 20px;
            color: #007bff;
        }

        a {
            text-decoration: none;
            color: #0056b3;
            margin: 0 10px;
        }

        a:hover {
            text-decoration: underline;
            color: rgb(255, 255, 255);
        }

        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #003366;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .tombol {
            display: inline-block;
            padding: 15px 25px;
            font-size: 18px;
            color: white;
            background-color: rgb(0, 0, 0);
            border: none;
            border-radius: 8px;
            text-decoration: none;
            cursor: pointer;
            text-align: center;
            font-weight: bold;
        }

        .tombol:hover {
            background-color: #172a46;
        }

        .table-responsive {
            overflow-x: auto;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }

        table th {
            background-color: #000000;
            color: #ffffff;
        }

        table tr:hover {
            background-color: #f5f5f5;
        }

        h2 {
            color: rgb(255, 255, 255);
            text-align: center;
            margin: 0 auto;
        }

        @media (max-width: 600px) {
            .container {
                padding: 10px;
            }

            .header h2 {
                font-size: 1.3rem;
            }

            .tombol {
                width: 100%;
                padding: 12px;
            }
        }

        .btn-custom-black {
            background-color: #000000;
            color: #ffffff;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-custom-black:hover {
            background-color: #172a46;
            color: #ffffff;
        }
    </style>
</head>

<body>
    @include('siswa.layout.sidebar')
    @include('siswa.layout.header')
<<<<<<< HEAD
    <div class="container">
        <h2>Daftar Pengajuan Magang</h2>
        @if (isset($pengajuan) && $pengajuan->count() > 0)
            <table border="1">
                <thead>
                    <tr>
<<<<<<< HEAD
                        <th>Nama Siswa</th>
                        <th>Jurusan</th>
                        <th>Tanggal Masuk</th>
                        <th>Tanggal Keluar</th>
                        <th>Perusahaan</th>
                        <th>status</th>
=======
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->jurusan }}</td>
                        <td>{{ $p->tanggal_masuk }}</td>
                        <td>{{ $p->tanggal_keluar ?? '-' }}</td>
                        <td>{{ $p->perusahaan }}</td>
                        <td>
                        <div class="text-dark bg-{{ $p->status == 'Ditolak' ? 'danger' : ($p->status == 'Menunggu' ? 'warning' : 'success') }}">
                      <div class="row">
                        <div class="col">
                          <div class="text-white text-center p-2">
                              {{ $p->status }}
                          </div>
                       </div>
                     </div>
                </div>
                      </td>
>>>>>>> 913a91d1e1e322536d058017e05e56f3692897c6
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengajuan as $p)
=======
    <div class="container mt-4">
        <div class="card shadow-sm p-4">
            <div class="header">
                <h2>Daftar Pengajuan Magang</h2>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">
                    <thead class="table-dark">
>>>>>>> 44734077802f2dac236b168425133a99aa31d034
                        <tr>
                            <th>Nama Siswa</th>
                            <th>Jurusan</th>
                            <th>Tanggal Masuk</th>
                            <th>Tanggal Keluar</th>
                            <th>Perusahaan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($pengajuan) && $pengajuan->count() > 0)
                            @foreach ($pengajuan as $p)
                                <tr>
                                    <td>{{ $p->nama }}</td>
                                    <td>{{ $p->jurusan }}</td>
                                    <td>{{ $p->tanggal_masuk }}</td>
                                    <td>{{ $p->tanggal_keluar ?? '-' }}</td>
                                    <td>{{ $p->perusahaan->nama ?? '-' }}</td>
                                    <td>
                                        <span
                                            class="badge bg-{{ $p->status == 'Ditolak' ? 'danger' : ($p->status == 'Menunggu' ? 'warning text-dark' : 'success') }}">
                                            {{ $p->status }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">Belum ada data pengajuan.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="text-end mt-3">
                <a href="{{ url('/pengajuan1') }}" class="btn btn-custom-black">Buat Pengajuan</a>
            </div>
        </div>
    </div>
    <script>
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
