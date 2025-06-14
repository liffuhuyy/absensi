<?php

?>
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
            font-family: 'Poppins', sans-serif;
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
            background-color: #172a46;
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
        .container {
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 30px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            color: #1a252f;
        }

        .input-section {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        select, input, button {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 20px;
            font-size: 16px;
        }

        select, input {
            flex-grow: 1;
            background-color: white;
            color: #333;
        }

        button {
            background-color: #1a252f;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
            border: none;
        }

        button:hover {
            background-color: #172a46;
        }

        .task-list {
            background-color: #f1f1f1;
            border-radius: 5px;
            padding: 10px;
        }

        .task-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 10px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .task-details {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .task-checkbox {
            appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid  #1a252f;
            border-radius: 4px;
            outline: none;
            cursor: pointer;
        }

        .task-checkbox:checked {
            background-color:  #1a252f;
            border-color:  #1a252f;
        }

        .task-checkbox:checked::after {
            content: '✔';
            color: white;
            display: block;
            text-align: center;
            line-height: 20px;
        }

        small {
            color: #666;
            margin-left: 10px;
        }

         h1 {
            color: rgb(255, 255, 255);
            text-align: center;
            margin: 0 auto;
            }
            h2{
                text-align: center;
            }
        h3 {
             color: rgb(255, 255, 255);
        }
               
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        table th, table td {
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
            <a href="{{ url('/magang') }}" class="menu-item">Pengajuan Magang</a>
        </div>
        
        <div class="menu-group">
            <div class="menu-title">Lainnya</div>
            <a href="{{ url('/kontak') }}" class="menu-item">Kontak</a>
            <a href="javascript:void(0)" class="menu-item" onclick="confirmLogout()">Logout</a>
        </div>
    </div>
<div class="container">
        <div class="header">
            <h1>Management Tugas</h1>
        </div>

        <form method="POST" action="{{ url('/simpan-tugas') }}">
    @csrf <!-- Token keamanan Laravel -->


<div class="input-section">
 <input type="date" name="tanggal" id="tanggal" required>
       <script>
          document.getElementById('tanggal').value = new Date().toISOString().split('T')[0];
       </script>
 <input type="text" name="tugas" required>
     <button type="submit">Tambah Tugas</button>
    </div>
</form>

<br>
<h2>Daftar Tugas</h2>
<br>
<form method="GET" action="{{ route('filter') }}">
    <select name="bulan" id="bulan" class="form-select">
        <option value="">Pilih Bulan</option>
        @foreach (range(1, 12) as $bulan)
            <option value="{{ $bulan }}">{{ date('F', mktime(0, 0, 0, $bulan, 1)) }}</option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-primary mt-2">Cari</button>
</form>

<table class="table">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Tugas</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tugas as $item)
        <tr>
            <td>{{ $item->tanggal }}</td>
            <td>{{ $item->tugas }}</td>
        </tr>
        @endforeach

        @if ($tugas->isEmpty())
        <tr>
            <td colspan="2" style="text-align: center; color: red;">Belum ada data tugas bulan ini.</td>
        </tr>
        @endif
    </tbody>
</table>

        <br> 
        <script>
    function confirmLogout() {
        let confirmAction = confirm("Apakah Anda yakin ingin logout?");
        if (confirmAction) {
            window.location.href = "{{ url('/index') }}"; // Ganti '/index' dengan URL logout sebenarnya
        }
    }
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const closeSidebar = document.getElementById('closeSidebar');
        const overlay = document.getElementById('overlay');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        });

        closeSidebar.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });
    </script>
</body>
</html>
