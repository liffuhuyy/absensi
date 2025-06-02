<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Presensi</title>
    <style>
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

        .container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
        }
        
        header {
            background-color: #0a192f;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            margin-bottom: 20px;
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
        
        .btn-keluar {
            background-color: #e74c3c;
            color: white;
        }
        
        .btn-keluar:hover:not(:disabled) {
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
            color:  #0a192f;
        }
        
        .stat-hadir .value { color:  #0a192f; }
        .stat-terlambat .value { color:  #0a192f; }
        .stat-izin .value { color:  #0a192f; }
        .stat-sakit .value { color:  #0a192f; }
        
        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
            color: white;
        }
        
        .status-hadir { background-color: #0a192f; }
        .status-terlambat { background-color:  #0a192f; }
        .status-izin { background-color:  #0a192f; }
        .status-sakit { background-color: #0a192f; }
        
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
<form method="POST" action="{{ url('/absen/masuk') }}">
    <div class="container">
        <header>
            <h1>Sistem Presensi Siswa</h1>
        </header>       
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
    </div>
</div>
<tbody>
    @if(isset($absensiData) && count($absensiData) > 0)
        @foreach($absensiData as $absen)
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
            <td style="text-align: center">Belum ada data presensi bulan ini.</td>
        </tr>
    @endif
</tbody>
   </div>
      </div>
    </form>

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
        });
        // Fungsi untuk sidebar
        document.addEventListener("DOMContentLoaded", function () {
            const menuToggle = document.getElementById("menuToggle");
            const sidebar = document.getElementById("sidebar");
            const overlay = document.getElementById("overlay");
            const closeSidebar = document.getElementById("closeSidebar");
            menuToggle.addEventListener("click", function () {
                sidebar.classList.add("active");
                overlay.classList.add("active");
            });
            closeSidebar.addEventListener("click", function () {
                sidebar.classList.remove("active");
                overlay.classList.remove("active");
            });
            overlay.addEventListener("click", function () {
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
                dataPresensi[index] = {...dataPresensi[index], ...data};
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
                    const formattedDate = `${itemDate.getDate().toString().padStart(2, '0')}-${(itemDate.getMonth() + 1).toString().padStart(2, '0')}-${itemDate.getFullYear()}`;
                    
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
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ user_id: 1, jam_masuk: "08:00:00" })
})
.then(response => response.json())
.then(data => console.log(data))
.catch(error => console.error(error));

   document.getElementById('btnMasuk').addEventListener('click', async function () {
    const now = new Date();
    const jam = now.getHours().toString().padStart(2, '0') + ':' + now.getMinutes().toString().padStart(2, '0');
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
                user_id: 1,  // Ambil user_id dari sesi atau input pengguna
                jam_masuk: jam
            })
        });

        const data = await response.json();
        if (response.ok) {
            absensiList.push({ tanggal, jamMasuk: jam, jamKeluar: null, status, keterangan: null });
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
    const jam = now.getHours().toString().padStart(2, '0') + ':' + now.getMinutes().toString().padStart(2, '0');
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
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ status: jenis, alasan: alasan })
    });

    const data = await response.json();
    alert(data.message);

    document.getElementById('modalIzin').style.display = 'none';
    document.getElementById('formIzin').reset();
});
     </script>   


     <script>
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