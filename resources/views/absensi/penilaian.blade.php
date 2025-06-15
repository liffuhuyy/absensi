@extends('siswa.layout.siswa_layout')
@section('content')
    <style>
        .container {
            width: 90%;
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333333;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 6px;
            font-size: 16px;
        }

        .button-container {
            text-align: center;
            margin-top: 30px;
        }

        .btn {
            background-color: #000000;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #172a46;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 18px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-danger:hover {
            background-color: #6b0d16;
        }

        .card {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 30px auto;
            font-family: 'Segoe UI', sans-serif;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table th,
        .table td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .table thead {
            background-color: #343a40;
            color: #ffffff;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table tbody tr:hover {
            background-color: #e9f5ff;
        }
    </style>
    <div class="container">
        <h1>Penilaian Akhir Magang</h1>
        <form method="POST" action="{{ route('penilaian.store') }}">
            @csrf
            <input type="hidden" name="pengguna_id" value="{{ auth()->user()->id }}">

            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" name="nama" required>
            </div>

            <div class="form-group">
                <label for="tanggal_keluar">Tanggal Selesai Magang</label>
                <input type="date" name="tanggal_keluar" required>
            </div>

            <div class="button-container">
                <button type="submit" class="btn">Ajukan Penilaian</button>
            </div>
        </form>
    </div>

    <h1 class="text-center">Daftar Penilaian</h1>

    <div id="penilaianTable" class="card p-2">
        <label colspan="5">Untuk pengisian nilai dilakukan oleh perusahaan!!</label>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Tanggal Penilaian</th>
                    <th>Nilai</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($penilaian as $nilai)
                    <tr>
                        <td>{{ $nilai->nama }}</td>
                        <td>{{ $nilai->tanggal_keluar }}</td>
                        <td>{{ $nilai->nilai ?? '-' }}</td>
                        <td>{{ $nilai->keterangan ?? '-' }}</td>
                        <td>
                            <form action="{{ route('penilaian.destroy', $nilai->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada penilaian</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
