@extends('siswa.layout.siswa_layout')
@section('content')
    <style>
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

        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
            color: white;
        }

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

        <!-- Modal Pulang Awal -->


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
        </div>
        <div id="modalPulangAwal">
            <input type="text" id="alasanPulangAwal" placeholder="Alasan pulang awal">
            <button id="submitPulangAwal">Submit</button>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
            setInterval(updateTime, 1000);
            updateTime(); // Panggil sekali untuk inisialisasi
        </script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    </body>
@endsection
