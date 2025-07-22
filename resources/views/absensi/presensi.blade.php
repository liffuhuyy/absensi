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
        <form method="POST" action="{{ url('/absen/masuk') }}">
            <form method="POST" action="{{ url('/absensi') }}">


                <body>

                    =======
                    <form method="POST" action="{{ url('/absensi') }}">
                        >>>>>>> 609387950bd37071a356c5d6c67352d34da61e06
                        =======
                        <form method="POST" action="{{ url('/absen/masuk') }}">
                            >>>>>>> 817f91c4efa9020bd08c08355f13d82491af875c
                            >>>>>>> 84e2654294087cac1211415410a44418b73f26ad
                            <div class="container">
                                <header>
                                    <h1>Sistem Presensi Siswa</h1>
                                </header>
                                <div class="card">
                                    <<<<<<< HEAD=======<<<<<<< HEAD <<<<<<< HEAD <!-- Tombol untuk kembali ke halaman
                                        sebelumnya -->
                                        <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>
                                        <a href="{{ url('/dashboard') }}" class="btn btn-primary">Kembali ke Dashboard</a>

                                        <div class="card">
                                            =======
                                            >>>>>>> 609387950bd37071a356c5d6c67352d34da61e06
                                            =======
                                            >>>>>>> 3edbfbba53ee6f0fb49ddd9c251ef44a41646aa8
                                            >>>>>>> 84e2654294087cac1211415410a44418b73f26ad
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
                                                    <button id="btnKeluar" class="btn-keluar" disabled>Absen
                                                        Keluar</button>
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
                                                    <<<<<<< HEAD </div>
                                                </div>
                                                <tbody>
                                                    @if (isset($absensiData) && count($absensiData) > 0)
                                                        @foreach ($absensiData as $absen)
                                                            <tr>
                                                                <td>{{ $absen->tanggal }}</td>
                                                                <td>{{ $absen->status }}</td>
                                                                <td>{{ $absen->jam_masuk ?? '-' }}</td>
                                                                <td>{{ $absen->jam_keluar ?? '-' }}</td>
                                                                <td>{{ $absen->keterangan ?? '-' }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td style="text-align: center">Belum ada data presensi bulan
                                                                ini.</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </div>
                                        </div>
                        </form>
                        =======
                        =======
                        <div class="container">
                            <header>
                                <h1>Sistem Presensi Siswa</h1>
                            </header>
                            >>>>>>> 84e2654294087cac1211415410a44418b73f26ad

                            <!-- Modal Izin / Sakit -->
                            <form method="POST" action="{{ url('/izin') }}">
                                @csrf
                                <div id="modalIzin" class="modal">
                                    <div class="modal-content">
                                        <span class="close">&times;</span>
                                        <h2>Form Izin / Sakit</h2>
                                        <form id="formIzin">
                                            <div class="form-group">
                                                <label for="jenis_izin">Jenis Izin</label>
                                                <select name="jenis_izin" id="jenis_izin" class="form-control" required>
                                                    <option value="Izin">Izin</option>
                                                    <option value="Sakit">Sakit</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="alasan_izin">Alasan</label>
                                                <textarea name="alasan_izin" id="alasan_izin" class="form-control" rows="4" required></textarea>
                                            </div>
                                            <button type="submit" class="btn-submit">Kirim</button>
                                        </form>
                                    </div>
                                    >>>>>>> d1d392254c622b58447032346056bcba254f97de
                                </div>
                            </form>

                            <!-- Modal Pulang Lebih Awal -->
                            <form method="POST" action="{{ url('/absensi/pulang-cepat') }}">
                                @csrf
                                <div id="modalPulangAwal" class="modal">
                                    <div class="modal-content">
                                        <span class="close">&times;</span>
                                        <h2>Pulang Lebih Awal</h2>
                                        <p>Anda pulang sebelum jam 17:00. Silakan berikan alasan:</p>
                                        <form id="formPulangAwal">
                                            <div class="form-group">
                                                <label for="alasan_pulang_cepat">Alasan Pulang Lebih Awal</label>
                                                <textarea name="alasan_pulang_cepat" id="alasan_pulang_cepat" class="form-control" rows="4" required></textarea>
                                            </div>
                                            <button type="submit" class="btn-submit">Konfirmasi</button>
                                        </form>
                                    </div>
                                </div>
                            </form>

                            <script>
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
                                }); <<
                                << << < HEAD

                                    ===
                                    === = >>>
                                    >>> > 609387950 bd37071a356c5d6c67352d34da61e06
                                // Fungsi untuk sidebar
                                document.addEventListener("DOMContentLoaded", function() {
                                    const menuToggle = document.getElementById("menuToggle");
                                    const sidebar = document.getElementById("sidebar");
                                    const overlay = document.getElementById("overlay");
                                    const closeSidebar = document.getElementById("closeSidebar");
                                    menuToggle.addEventListener("click", function() {
                                        sidebar.classList.add("active");
                                        overlay.classList.add("active");
                                    });
                                    closeSidebar.addEventListener("click", function() {
                                        sidebar.classList.remove("active");
                                        overlay.classList.remove("active");
                                    });
                                    overlay.addEventListener("click", function() {
                                        sidebar.classList.remove("active");
                                        overlay.classList.remove("active");
                                    });
                                });

                                function confirmLogout() {
                                    let confirmAction = confirm("Apakah Anda yakin ingin logout?");
                                    if (confirmAction) {
                                        window.location.href = "{{ url('/index') }}";
                                    }
                                }


                                // Data presensi (simulasi penyimpanan data)
                                let dataPresensi = JSON.parse(localStorage.getItem('dataPresensi')) || [];
                                // Fungsi untuk mendapatkan nama bulan dalam bahasa Indonesia
                                function getNamaBulan(bulan) {
                                    const namaBulan = [
                                        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                                    ];
                                    return namaBulan[bulan];
                                }

                                // Fungsi untuk mendapatkan tanggal dan jadwal
                                function formatTanggal(date) {
                                    const hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                                    return `${hari[date.getDay()]}, ${date.getDate()} ${getNamaBulan(date.getMonth())} ${date.getFullYear()}`;
                                }

                                function formatJam(date) {
                                    return date.toTimeString().substring(0, 8);
                                }

                                function formatJamPendek(timeStr) {
                                    if (!timeStr) return '-';
                                    return timeStr.substring(0, 5);
                                }
                                // Fungsi untuk menampilkan jam dan tanggal
                                function updateJam() {
                                    const now = new Date();
                                    document.getElementById('jam').textContent = formatJam(now);
                                    document.getElementById('tanggal').textContent = formatTanggal(now);
                                    document.getElementById('bulanTahun').textContent = `${getNamaBulan(now.getMonth())} ${now.getFullYear()}`;

                                    const jamMenit = now.getHours() * 60 + now.getMinutes();
                                    const btnMasuk = document.getElementById('btnMasuk');


                                    // Tombol absen masuk hanya aktif mulai jam 09:00
                                    if (!cekSudahAbsenMasuk()) {
                                        if (jamMenit < 9 * 60) {
                                            btnMasuk.disabled = true;
                                            btnMasuk.title = "Absen masuk dimulai pukul 09:00";
                                        } else {
                                            btnMasuk.disabled = false;
                                            btnMasuk.title = "";
                                        }
                                    } else {
                                        btnMasuk.disabled = true;
                                        btnMasuk.title = "Anda sudah absen masuk hari ini";
                                    }
                                }

                                // Update jam setiap detik
                                setInterval(updateJam, 1000);
                                updateJam(); // Panggil sekali untuk inisialisasi

                                // Tampilkan pesan alert
                                function showAlert(message, type = 'success') {
                                    const alertBox = document.getElementById('alertBox');
                                    alertBox.className = 'alert alert-' + type;
                                    alertBox.textContent = message;
                                    alertBox.style.display = 'block';

                                    // Sembunyikan pesan setelah 5 detik
                                    setTimeout(() => {
                                        alertBox.style.display = 'none';
                                    }, 5000);
                                }

                                // Fungsi untuk menambahkan data presensi
                                function tambahDataPresensi(data) {
                                    dataPresensi.push(data);
                                    localStorage.setItem('dataPresensi', JSON.stringify(dataPresensi));
                                    updateTabelPresensi();
                                }

                                // Fungsi untuk memperbarui data presensi yang sudah ada
                                function updateDataPresensi(tanggal, data) {
                                    const index = dataPresensi.findIndex(item => item.tanggal === tanggal);
                                    if (index !== -1) {
                                        dataPresensi[index] = {
                                            ...dataPresensi[index],
                                            ...data
                                        };
                                        localStorage.setItem('dataPresensi', JSON.stringify(dataPresensi));
                                        updateTabelPresensi();
                                    }
                                }


                                // Perbarui tabel presensi dan statistik
                                function updateTabelPresensi() {
                                    const tabelBody = document.getElementById('tabelPresensi');
                                    const bulanIni = new Date().getMonth();

                                    // Filter data bulan ini
                                    const dataPresensiFiltered = dataPresensi.filter(item => {
                                        const itemDate = new Date(item.tanggal);
                                        return itemDate.getMonth() === bulanIni;
                                    }).sort((a, b) => new Date(b.tanggal) - new Date(a.tanggal)); // Sort descending

                                    // Bersihkan tabel
                                    tabelBody.innerHTML = '';

                                    // Jika tidak ada data
                                    if (dataPresensiFiltered.length === 0) {
                                        const row = document.createElement('tr');
                                        row.innerHTML = '<td colspan="5" style="text-align: center;">Belum ada data presensi bulan ini.</td>';
                                        tabelBody.appendChild(row);
                                    } else {
                                        // Tampilkan data
                                        dataPresensiFiltered.forEach(item => {
                                            const row = document.createElement('tr');

                                            // Format tanggal DD-MM-YYYY
                                            const itemDate = new Date(item.tanggal);
                                            const formattedDate =
                                                `${itemDate.getDate().toString().padStart(2, '0')}-${(itemDate.getMonth() + 1).toString().padStart(2, '0')}-${itemDate.getFullYear()}`;

                                            row.innerHTML = `
                        <td>${formattedDate}</td>
                        <td><span class="status-badge status-${item.status.toLowerCase()}">${item.status}</span></td>
                        <td>${item.jamMasuk ? formatJamPendek(item.jamMasuk) : '-'}</td>
                        <td>${item.jamKeluar ? formatJamPendek(item.jamKeluar) : '-'}</td>
                        <td>${item.keterangan || '-'}</td>
                    `;
                                            tabelBody.appendChild(row);
                                        });
                                    }

                                    // Update statistik
                                    updateStatistik();
                                }

                                // Update statistik
                                function updateStatistik() {
                                    const bulanIni = new Date().getMonth();
                                    const statHadir = document.getElementById('statHadir');
                                    const statTerlambat = document.getElementById('statTerlambat');
                                    const statIzin = document.getElementById('statIzin');
                                    const statSakit = document.getElementById('statSakit');

                                    // Filter data bulan ini
                                    const dataPresensiFiltered = dataPresensi.filter(item => {
                                        const itemDate = new Date(item.tanggal);
                                        return itemDate.getMonth() === bulanIni;
                                    });

                                    // Hitung statistik
                                    let countHadir = 0;
                                    let countTerlambat = 0;
                                    let countIzin = 0;
                                    let countSakit = 0;

                                    dataPresensiFiltered.forEach(item => {
                                        if (item.status === 'Hadir') countHadir++;
                                        else if (item.status === 'Terlambat') countTerlambat++;
                                        else if (item.status === 'Izin') countIzin++;
                                        else if (item.status === 'Sakit') countSakit++;
                                    });

                                    // Update tampilan
                                    statHadir.textContent = countHadir;
                                    statTerlambat.textContent = countTerlambat;
                                    statIzin.textContent = countIzin;
                                    statSakit.textContent = countSakit;
                                }
                            </script>


                            <script>
                                function cekSudahAbsenMasuk() {
                                    let absensiList = JSON.parse(localStorage.getItem('absensiData')) || [];
                                    let tanggal = new Date().toISOString().split('T')[0];
                                    return absensiList.some(absen => absen.tanggal === tanggal);
                                }
                                //tombol untuk absensi masuk
                                function cekSudahAbsenMasuk() {
                                    let absensiList = JSON.parse(localStorage.getItem('absensiData')) || [];
                                    let tanggal = new Date().toISOString().split('T')[0];
                                    return absensiList.some(absen => absen.tanggal === tanggal);
                                }
                                fetch('/api/absen-masuk', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json'
                                        },
                                        body: JSON.stringify({
                                            user_id: 1,
                                            jam_masuk: "08:00:00"
                                        })
                                    })
                                    .then(response => response.json())
                                    .then(data => console.log(data))
                                    .catch(error => console.error(error));

                                document.getElementById('btnMasuk').addEventListener('click', async function() {
                                    const now = new Date();
                                    const jam = now.getHours().toString().padStart(2, '0') + ':' + now.getMinutes().toString().padStart(
                                        2, '0');
                                    const tanggal = now.toISOString().split('T')[0];
                                    const jamMenit = now.getHours() * 60 + now.getMinutes();
                                    const batasWaktuMasuk = 9 * 60 + 5;

                                    let status, pesan;

                                    // Menentukan status kehadiran
                                    if (jamMenit <= batasWaktuMasuk) {
                                        status = 'Hadir';
                                        pesan = 'Berhasil absen masuk!';
                                    } else {
                                        status = 'Terlambat';
                                        pesan = 'Berhasil absen masuk tetapi Anda terlambat!';
                                    }

                                    // Cek apakah sudah absen hari ini (di localStorage)
                                    let absensiList = JSON.parse(localStorage.getItem('absensiData')) || [];
                                    let sudahAbsen = absensiList.some(absen => absen.tanggal === tanggal);

                                    if (sudahAbsen) {
                                        showAlert('Anda sudah absen hari ini!', 'info');
                                        return;
                                    }

                                    // **KIRIM DATA KE BACKEND LARAVEL**
                                    try {
                                        const response = await fetch('/api/absen-masuk', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'Authorization': 'Bearer TOKEN_KAMU' // Tambahkan jika API pakai autentikasi
                                            },
                                            body: JSON.stringify({
                                                user_id: 1, // Ambil user_id dari sesi atau input pengguna
                                                jam_masuk: jam
                                            })
                                        });

                                        const data = await response.json();
                                        if (response.ok) {
                                            absensiList.push({
                                                tanggal,
                                                jamMasuk: jam,
                                                jamKeluar: null,
                                                status,
                                                keterangan: null
                                            });
                                            localStorage.setItem('absensiData', JSON.stringify(absensiList));
                                            showAlert(pesan, 'success');
                                        } else {
                                            showAlert(`Gagal absen: ${data.message}`, 'error');
                                        }
                                    } catch (error) {
                                        console.error('Error:', error);
                                        showAlert('Terjadi kesalahan saat absen!', 'error');
                                    }
                                });
                            </script>


                            <script>
                                document.getElementById('btnMasuk').addEventListener('click', function() {
                                    const now = new Date();
                                    const jam = now.getHours().toString().padStart(2, '0') + ':' + now.getMinutes().toString().padStart(2,
                                        '0');
                                    const tanggal = now.toISOString().split('T')[0];

                                    let absensiData = JSON.parse(localStorage.getItem('absensiData')) || [];

                                    // Cek apakah sudah ada data absensi hari ini yang belum diisi jam keluar
                                    let absenHariIni = absensiData.find(absen => absen.tanggal === tanggal && !absen.jamKeluar);
                                    if (absenHariIni) {
                                        showAlert('Anda belum absen keluar. Harap selesaikan absensi sebelum membuat yang baru.', 'error');
                                        return;
                                    }

                                    // Buat data absensi baru
                                    absensiData.push({
                                        tanggal: tanggal,
                                        jamMasuk: jam,
                                        jamKeluar: null,
                                        status: 'Hadir'
                                    });
                                    localStorage.setItem('absensiData', JSON.stringify(absensiData));

                                    showAlert('Berhasil absen masuk!', 'success');
                                });
                            </script>



                            <script>
                                document.getElementById('btnIzin').addEventListener('click', function() {
                                    document.getElementById('modalIzin').style.display = 'block';
                                });

                                document.getElementById('formIzin').addEventListener('submit', async function(e) {
                                    e.preventDefault();

                                    const jenis = document.getElementById('jenis_izin').value;
                                    const alasan = document.getElementById('alasan_izin').value;

                                    const response = await fetch('http://127.0.0.1:8000/absenIzin', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json'
                                        },
                                        body: JSON.stringify({
                                            status: jenis,
                                            alasan: alasan
                                        })
                                    });

                                    const data = await response.json();
                                    alert(data.message);

                                    document.getElementById('modalIzin').style.display = 'none';
                                    document.getElementById('formIzin').reset();
                                });
                            </script>


                            <script>
                                const data = await response.json();
                                alert(data.message);

                                document.getElementById('modalIzin').style.display = 'none';
                                document.getElementById('formIzin').reset();
                                });
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
                                            headers: {
                                                "Content-Type": "application/json"
                                            },
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
                                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                                                    "content")
                                            },
                                            body: JSON.stringify({
                                                jenis_izin: jenisIzin,
                                                alasan_izin: alasanIzin
                                            })
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
                                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                                                    "content")
                                            },
                                            body: JSON.stringify({
                                                alasan_pulang_cepat: alasanPulang
                                            })
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            alert(data.message);
                                            window.location.reload();
                                        })
                                        .catch(error => console.error("Terjadi kesalahan:", error));
                                });
                                updateStatistik();
                                updateJam();
                                document.getElementById('formPulangAwal').addEventListener('submit', function(e) {
                                    e.preventDefault();

                                    const alasan = document.getElementById('alasan_pulang_cepat').value;
                                    const now = new Date();
                                    const jam = now.getHours().toString().padStart(2, '0') + ':' + now.getMinutes().toString().padStart(2,
                                        '0');
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
                                });
                            </script>
                </body>

                </html>
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
                    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT"
                    crossorigin="anonymous">
    </body>
@endsection
