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
    </style>
    <div class="container">
        <h1>Penilaian Akhir Magang</h1>
        <div class="form-group">
            <form method="POST">
                @csrf
                <input type="hidden" name="pengguna_id" value="{{ auth()->user()->id }}">

                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" required>
                </div>

                <div class="form-group">
                    <label for="tanggal_keluar">Tanggal Selesai Magang</label>
                    <input type="date" id="tanggal_keluar" name="tanggal_keluar" required>
                </div>

                <div class="button-container">
                    <button type="submit" class="btn">Ajukan Penilaian</button>
                </div>
            </form>
        </div>
    </div>
@endsection
