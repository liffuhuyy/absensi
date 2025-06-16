@extends('siswa.layout.siswa_layout')
@section('content')
    <style>
        .container {
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 50px;
            width: 200%;
            max-width: 700px;
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

        select,
        input,
        button {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 20px;
            font-size: 16px;
        }

        select,
        input {
            flex-grow: 1;
            background-color: white;
            color: #333;
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
            background-color: #f2f2f2;
            color: #333;
        }

        table tr:hover {
            background-color: #f5f5f5;
        }
    </style>
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
        </body>
    @endsection
