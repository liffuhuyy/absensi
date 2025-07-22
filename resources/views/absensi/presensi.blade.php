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

        .btn-pulangAwal {
            background-color: #f39c12;
            color: white;
        }

        .btn-pulangAwal:hover:not(:disabled) {
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

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #333;
        }

        @media (max-width: 768px) {

            #absensiTable th,
            #absensiTable td {
                white-space: nowrap;
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
                    <button id="btnPulangAwal" class="btn-pulangAwal" data-bs-toggle="modal"
                        data-bs-target="#modalPulangAwal">
                        Pulang Awal
                    </button>
                    <button id="btnIzin" class="btn-izin" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        data-bs-whatever="@mdo">Ajukan Izin</button>
                </div>
            </div>
        </div>

        <!-- Modal Pulang Awal -->
        <div class="modal fade" id="modalPulangAwal" tabindex="-1" aria-labelledby="modalPulangAwalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="modalPulangAwalLabel">Form Pulang Awal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="alasanPulangAwal" class="form-label">Alasan Pulang Awal</label>
                            <input type="text" class="form-control" id="alasanPulangAwal"
                                placeholder="Masukkan alasan..." required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" id="submitPulangAwal">Kirim</button>
                    </div>

                </div>
            </div>
        </div>


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
                                <label for="keterangan" class="form-label">Keterangan:</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="4" placeholder="Masukkan keterangan..."></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" id="btnIzinKirim">Kirim</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal hidupkan lokasi -->
        <div id="lokasiModal"
            style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); z-index:9999; justify-content:center; align-items:center;">
            <div style="background:#fff; padding:20px; border-radius:10px; max-width:90%; text-align:center;">
                <h4>📍 Lokasi Tidak Terdeteksi</h4>
                <p>Pastikan:</p>
                <ul style="text-align:left; font-size:14px;">
                    <li>✅ GPS sudah aktif</li>
                    <li>✅ Izin lokasi diizinkan untuk browser</li>
                    <li>✅ Lokasi presisi diaktifkan</li>
                </ul>
                <button id="aktifkanLokasiBtn"
                    style="padding:10px 20px; background:#042857; color:#fff; border:none; border-radius:5px; cursor:pointer;">Aktifkan
                    Lokasi</button>
            </div>
        </div>

        <div id="absenContainer" class="container p-2">
            <h2 class="card-title text-center">Riwayat Absensi</h2>
            <label class="text-muted mb-3">Pilih bulan dan tahun untuk melihat riwayat absensi.</label>
            <div class="d-flex justify-content-center mb-3">
                @php
                    $bulan = $bulan ?? now()->format('m');
                    $tahun = $tahun ?? now()->format('Y');
                @endphp
                <select class="form-select me-2" id="bulan">
                    @php $daftarBulan = ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember']; @endphp
                    @foreach ($daftarBulan as $val => $nama)
                        <option value="{{ str_pad($val, 2, '0', STR_PAD_LEFT) }}" {{ $bulan == $val ? 'selected' : '' }}>
                            {{ $nama }}</option>
                    @endforeach
                </select>

                <select class="form-select me-2" id="tahun">
                    @for ($i = date('Y'); $i <= date('Y') + 5; $i++)
                        <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>{{ $i }}
                        </option>
                    @endfor
                </select>

                <button class="btn btn-primary" id="cariData">Cari Data</button>
            </div>

            <div class="stats-card d-flex justify-content-around mb-3" id="statistikAbsensi">
                @php
                    $stat = ['hadir' => '✔️', 'terlambat' => '⏰', 'izin' => '📝', 'sakit' => '🤒'];
                @endphp
                @foreach ($stat as $key => $icon)
                    <div class="stat-item text-center">
                        <h3>{{ ucfirst($key) }}</h3>
                        <span class="stat-icon">{{ $icon }}</span>
                        <span class="stat-value" id="stat-{{ $key }}">{{ $statistik[$key] ?? 0 }}</span>
                    </div>
                @endforeach
            </div>

            <div class="card p-3">
                <div style="overflow-x: auto;">
                    <table class="table" id="absensiTable" style="min-width: 600px;">
                        <thead class="table-dark">
                            <tr>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                                <th>Pulang awal</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody id="absensiTbody">
                            @forelse ($absensiData as $absen)
                                <tr>
                                    <td>{{ $absen->tanggal ?? '-' }}</td>
                                    <td>{{ $absen->status ?? '-' }}</td>
                                    <td>{{ $absen->absen_masuk ?? '-' }}</td>
                                    <td>{{ $absen->absen_pulang ?? '-' }}</td>
                                    <td>{{ $absen->pulang_awal ? 'Ya' : '-' }}</td>
                                    <td>{{ $absen->keterangan ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada data presensi</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <script>
            // Setup CSRF agar semua request AJAX aman
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        <!-- Mencari data berdasrkan bulan dan tahun-->
        <script>
            $(document).ready(function() {
                $('#cariData').on('click', function() {
                    const bulan = $('#bulan').val();
                    const tahun = $('#tahun').val();

                    $.ajax({
                        url: '/riwayat-absensi/ajax',
                        method: 'GET',
                        data: {
                            bulan,
                            tahun
                        },
                        success: function(res) {
                            // Update statistik
                            const stat = res.statistik ?? {};
                            $('#stat-hadir').text(stat.hadir ?? 0);
                            $('#stat-terlambat').text(stat.terlambat ?? 0);
                            $('#stat-izin').text(stat.izin ?? 0);
                            $('#stat-sakit').text(stat.sakit ?? 0);

                            // Update tabel absensi
                            const tbody = $('#absensiTbody');
                            tbody.empty();

                            if (res.absensi && res.absensi.length > 0) {
                                res.absensi.forEach(item => {
                                    tbody.append(`
                            <tr>
                                <td>${item.tanggal ?? '-'}</td>
                                <td>${item.status ?? '-'}</td>
                                <td>${item.absen_masuk ?? '-'}</td>
                                <td>${item.absen_pulang ?? '-'}</td>
                                <td>${item.pulang_awal ? 'Ya' : '-'}</td>
                                <td>${item.keterangan ?? '-'}</td>
                            </tr>
                        `);
                                });
                            } else {
                                tbody.append(
                                    '<tr><td colspan="6" class="text-center">Belum ada data presensi</td></tr>'
                                );
                            }
                        },
                        error: function(xhr) {
                            const message = xhr.responseJSON?.error ||
                                'Terjadi kesalahan saat mengambil data.';
                            alert(message);
                        }
                    });
                });

                // Trigger otomatis saat halaman dimuat
                $('#cariData').trigger('click');
            });
        </script>


        <!-- Sistem Absen Masuk, Pulang, Izin/Sakit, Pulang awal, Dan Lokasi/Gps -->
        <script>
            $(document).ready(function() {
                let jadwalKerja = null;
                let sudahAbsenMasuk = false;
                let sudahIzin = false;
                let sudahAbsenHariIni = false;

                // Cek dukungan lokasi di awal
                if (!navigator.geolocation) {
                    alert("Browser Anda tidak mendukung fitur lokasi. Fitur absensi tidak bisa digunakan.");
                    disableAllButtons(true);
                }

                // Ambil data jadwal kerja
                fetch('/get-jadwal-kerja')
                    .then(res => res.json())
                    .then(data => {
                        if (data.error) {
                            disableAllButtons(true);
                            alert(data.error);
                        } else {
                            jadwalKerja = data;
                            cekStatusAbsensiHariIni();
                            setInterval(() => kontrolTombolBerdasarkanWaktu(), 10000);
                        }
                    });

                function disableAllButtons(disable = true) {
                    $('#btnMasuk, #btnPulang, #btnPulangAwal, #btnIzin').prop('disabled', disable);
                }

                function waktuDalamMenit(jamStr) {
                    const [jam, menit] = jamStr.split(":");
                    return parseInt(jam) * 60 + parseInt(menit);
                }

                function waktuSekarangDalamMenit() {
                    const now = new Date();
                    return now.getHours() * 60 + now.getMinutes();
                }

                function kontrolTombolBerdasarkanWaktu() {
                    if (!jadwalKerja) return;

                    const now = waktuSekarangDalamMenit();
                    const masuk = waktuDalamMenit(jadwalKerja.jam_masuk);
                    const keluar = waktuDalamMenit(jadwalKerja.jam_keluar);
                    const batasPulang = 19 * 60;

                    $('#btnMasuk').prop('disabled', now < masuk || sudahAbsenMasuk || sudahAbsenHariIni || sudahIzin);
                    $('#btnIzin').prop('disabled', sudahAbsenMasuk || sudahAbsenHariIni || sudahIzin);
                    $('#btnPulangAwal').prop('disabled', !sudahAbsenMasuk || sudahAbsenHariIni);

                    if (!sudahAbsenMasuk || sudahAbsenHariIni || now < keluar || now > batasPulang) {
                        $('#btnPulang').prop('disabled', true).text('Belum Waktu Pulang');
                    } else {
                        $('#btnPulang').prop('disabled', false).text('Absen Pulang');
                    }
                }

                function cekStatusAbsensiHariIni() {
                    fetch('/get-absen-hari-ini')
                        .then(res => res.json())
                        .then(data => {
                            if (data.status === 'Izin' || data.status === 'Sakit') {
                                sudahIzin = true;
                                sudahAbsenHariIni = true;
                            } else if (data.absen_masuk) {
                                sudahAbsenMasuk = true;
                                if (data.absen_pulang || data.pulang_awal) {
                                    sudahAbsenHariIni = true;
                                }
                            }
                            kontrolTombolBerdasarkanWaktu();
                        });
                }

                function getLocation(callback) {
                    // Langkah 1: Cek apakah browser support geolocation
                    if (!navigator.geolocation) {
                        alert(
                            "Browser Anda tidak mendukung fitur lokasi. Silakan gunakan Chrome atau Firefox terbaru."
                        );
                        return;
                    }

                    // Langkah 2: Cek status izin lokasi jika browser mendukung
                    if (navigator.permissions) {
                        navigator.permissions.query({
                            name: 'geolocation'
                        }).then(result => {
                            if (result.state === 'denied') {
                                alert(
                                    "Izin lokasi ditolak. Silakan buka pengaturan browser Anda dan aktifkan izin lokasi."
                                );
                                return;
                            }
                            if (result.state === 'prompt') {
                                console.log("Lokasi akan diminta setelah pengguna menyetujui.");
                            }

                            // Tetap lanjutkan untuk meminta lokasi
                            ambilLokasi(callback);
                        }).catch(() => {
                            // Browser tidak mendukung Permissions API, langsung ambil lokasi
                            ambilLokasi(callback);
                        });
                    } else {
                        // Permissions API tidak tersedia
                        ambilLokasi(callback);
                    }

                    // Fungsi untuk ambil lokasi
                    function ambilLokasi(callback) {
                        let lokasiDiperoleh = false;
                        const timeout = setTimeout(() => {
                            if (!lokasiDiperoleh) {
                                alert(
                                    "Gagal mendapatkan lokasi.\n\n🔧 Pastikan:\n• GPS aktif\n• Lokasi presisi diaktifkan\n• Browser diizinkan akses lokasi\n• Koneksi internet stabil"
                                );
                            }
                        }, 15000);

                        navigator.geolocation.getCurrentPosition(
                            pos => {
                                lokasiDiperoleh = true;
                                clearTimeout(timeout);

                                const lat = pos.coords.latitude;
                                const long = pos.coords.longitude;

                                if (!lat || !long || (lat === 0 && long === 0)) {
                                    alert(
                                        "Lokasi tidak valid (0,0). Pastikan Anda berada di tempat dengan sinyal GPS yang baik."
                                    );
                                    return;
                                }

                                callback(lat.toFixed(6), long.toFixed(6));
                            },
                            err => {
                                clearTimeout(timeout);
                                let pesan = "Gagal mendapatkan lokasi.";

                                if (err.code === 1) {
                                    pesan =
                                        "📍 Izin lokasi ditolak.\n\nBuka pengaturan browser Anda, lalu aktifkan izin lokasi.";
                                } else if (err.code === 2) {
                                    pesan =
                                        "Lokasi tidak tersedia. Coba di tempat terbuka atau aktifkan lokasi presisi.";
                                } else if (err.code === 3) {
                                    pesan =
                                        "Timeout saat mendeteksi lokasi. Pastikan GPS menyala dan koneksi stabil.";
                                }

                                alert(pesan);
                            }, {
                                enableHighAccuracy: true,
                                timeout: 15000,
                                maximumAge: 0
                            }
                        );
                    }
                }


                $('#btnMasuk').click(function() {
                    if (!jadwalKerja) return alert("Jadwal kerja belum tersedia.");
                    if (sudahIzin || sudahAbsenHariIni) return alert("Tidak bisa absen masuk.");

                    const now = waktuSekarangDalamMenit();
                    const masuk = waktuDalamMenit(jadwalKerja.jam_masuk);
                    const status = now > (masuk + 10) ? 'Terlambat' : 'Hadir';

                    getLocation((lat, long) => {
                        $.post('/absen/masuk', {
                            _token: '{{ csrf_token() }}',
                            latitude: lat,
                            longitude: long,
                            status: status
                        }).done(res => {
                            alert(res.message);
                            location.reload();
                        }).fail(err => alert(err.responseJSON?.error || 'Gagal absen masuk.'));
                    });
                });

                $('#btnPulang').click(function() {
                    if (!sudahAbsenMasuk || sudahAbsenHariIni) return alert("Tidak bisa absen pulang.");

                    getLocation((lat, long) => {
                        $.post('/absen/pulang', {
                            _token: '{{ csrf_token() }}',
                            latitude: lat,
                            longitude: long
                        }).done(res => {
                            alert(res.message);
                            location.reload();
                        }).fail(err => alert(err.responseJSON?.error || 'Gagal absen pulang.'));
                    });
                });

                $('#submitPulangAwal').click(function() {
                    if (!sudahAbsenMasuk || sudahAbsenHariIni) return alert("Tidak bisa pulang awal.");

                    const keterangan = $('#alasanPulangAwal').val().trim();
                    if (!keterangan) return alert("Isi alasan pulang awal.");

                    getLocation((lat, long) => {
                        $.post('/absen/pulang-awal', {
                            _token: '{{ csrf_token() }}',
                            keterangan: keterangan,
                            latitude: lat,
                            longitude: long
                        }).done(res => {
                            alert(res.message);
                            $('#modalPulangAwal').modal('hide');
                            location.reload();
                        }).fail(err => alert(err.responseJSON?.error || 'Gagal pulang awal.'));
                    });
                });

                $('#btnIzinKirim').click(function() {
                    if (sudahAbsenMasuk || sudahAbsenHariIni || sudahIzin) {
                        alert("Sudah absen atau izin hari ini.");
                        return;
                    }

                    let jenis = $('#statusIzin').val().trim();
                    const keterangan = $('#keterangan').val().trim();

                    if (!jenis) return alert("Pilih jenis izin.");
                    if (!keterangan) return alert("Isi keterangan izin.");

                    // Force jenis to Capital-case
                    jenis = jenis.charAt(0).toUpperCase() + jenis.slice(1).toLowerCase();

                    const csrfToken = $('meta[name="csrf-token"]').attr('content');

                    getLocation((lat, long) => {
                        $.ajax({
                            url: '/absen/izin',
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            data: {
                                jenis: jenis,
                                keterangan: keterangan,
                                latitude: lat,
                                longitude: long
                            },
                            success: function(res) {
                                alert(res.message);
                                $('#exampleModal').modal('hide');
                                location.reload();
                            },
                            error: function(err) {
                                const error = err.responseJSON?.error ||
                                    "Gagal mengirim izin.";
                                alert(error);
                            }
                        });
                    });
                });
            });
        </script>


        <!-- Jam dan tanggal -->
        <script>
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
