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
=======
>>>>>>> d7390f319b47b889a80ef08f85da0dc72aacab79
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 15px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            color: #ffffff;
        }

        .input-section {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }

        .input-section input[type="date"],
        .input-section input[type="text"] {
            flex: 1 1 200px;
            padding: 8px;
            font-size: 1rem;
        }

        .input-section button {
            padding: 8px 16px;
            font-size: 1rem;
            cursor: pointer;
        }

        form select {
            margin-top: 1px;
            width: 50%;
            padding: 8px;
        }

        button {
            background-color: #000000;
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
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
            border: 2px solid #1a252f;
            border-radius: 4px;
            outline: none;
            cursor: pointer;
        }

        .task-checkbox:checked {
            background-color: #010101;
            border-color: #1a252f;
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
            margin-left: 10px;
        }

        h1 {
            color: rgb(255, 255, 255);
            text-align: center;
            margin: 0 auto;
        }

        h2 {
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

        table th,
        table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #000000;
            color: #ffffff;
        }

        table tr:hover {
            background-color: #f5f5f5;
        }

        .btn-hapus {
            background-color: #cb1919;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
            border: none;
        }

        .btn-hapus:hover {
            background-color: #651515;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #333;
        }
    </style>
    <div class="container">
        <div class="header">
            <h1>Management Tugas</h1>
        </div>

        <form method="POST" action="{{ url('/simpan-tugas') }}">
            @csrf
            <div class="input-section">
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                <input type="date" name="tanggal" id="tanggal" required>
                <script>
                    document.getElementById('tanggal').value = new Date().toISOString().split('T')[0];
                </script>
                <input type="text" name="tugas" required placeholder="Tugas...">
                <button type="submit" class="btn btn-primary mt-2">Tambah Tugas</button>
            </div>
        </form>

        <h2>Daftar Tugas</h2>
        <br>
        <form method="GET" action="{{ route('filter') }}">
            <select name="bulan" id="bulan" class="form-select">
                <option value="">Pilih Bulan</option>
                @php
                    $bulanIndonesia = [
                        1 => 'Januari',
                        2 => 'Februari',
                        3 => 'Maret',
                        4 => 'April',
                        5 => 'Mei',
                        6 => 'Juni',
                        7 => 'Juli',
                        8 => 'Agustus',
                        9 => 'September',
                        10 => 'Oktober',
                        11 => 'November',
                        12 => 'Desember',
                    ];
                @endphp

                @foreach ($bulanIndonesia as $angka => $nama)
                    <option value="{{ $angka }}">{{ $nama }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary mt-2">Cari</button>
        </form>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Tugas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tugas as $item)
                        <tr>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->tugas }}</td>
                            <td>
                                <form action="{{ route('tugas.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-hapus">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="text-align: center; color: red;">
                                Belum ada data tugas bulan ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
