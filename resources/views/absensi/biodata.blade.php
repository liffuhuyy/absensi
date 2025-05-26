<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lengkapi Biodata Siswa</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f5f5f5;
            color: #333;
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

        .container {
            max-width: 900px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .form-card {
            background-color: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .form-title {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            color: #0a192f;
            text-align: center;
            border-bottom: 2px solid #0a192f;
            padding-bottom: 10px;
        }

        .form-subtitle {
            color: #7f8c8d;
            margin-bottom: 2rem;
            text-align: center;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .form-col {
            flex: 1;
            min-width: 250px;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #0a192f;
        }

        .form-input {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-input:focus {
            border-color: #0a192f;
            outline: none;
            box-shadow: 0 0 0 2px rgba(10, 25, 47, 0.2);
        }

        .form-select {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            background-color: white;
            transition: border-color 0.3s;
            cursor: pointer;
        }

        .form-select:focus {
            border-color: #0a192f;
            outline: none;
            box-shadow: 0 0 0 2px rgba(10, 25, 47, 0.2);
        }

        .radio-group {
            display: flex;
            gap: 1.5rem;
            padding: 0.5rem 0;
        }

        .radio-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }

        .form-radio {
            cursor: pointer;
        }

        .form-textarea {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s;
            resize: vertical;
            min-height: 100px;
        }

        .form-textarea:focus {
            border-color: #0a192f;
            outline: none;
            box-shadow: 0 0 0 2px rgba(10, 25, 47, 0.2);
        }

        .form-submit {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
        }

        .btn {
            padding: 1rem 2.5rem;
            border: none;
            border-radius: 5px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-save {
            background: linear-gradient(to right, #0a192f, #000000);
            color: white;
        }

        .required-mark {
            color: #e74c3c;
            margin-left: 3px;
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

        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
                gap: 1rem;
            }
            
            .form-col {
                min-width: 100%;
            }
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
            <a href="{{ url('/pengajuan') }}" class="menu-item">Pengajuan Magang</a>
        </div>
        
        <div class="menu-group">
            <div class="menu-title">Lainnya</div>
            <a href="{{ url('/kontak') }}" class="menu-item">Kontak</a>
            <a href="javascript:void(0)" class="menu-item" onclick="confirmLogout()">Logout</a>
        </div>
    </div>

    <div class="container">
        <div class="form-card">
            <h2 class="form-title">Biodata Siswa</h2>

  <form method="POST" action="{{ isset($biodata) ? route('biodata.update', $biodata->id) : route('biodata.store') }}">
       @csrf
            @if(isset($biodata))
        @method('PUT')
             @endif
                <!-- Nama dan NISN -->
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="nama" class="form-label">Nama Lengkap<span class="required-mark">*</span></label>
                            <input type="text" id="nama" name="nama" class="form-input" placeholder="Masukkan nama lengkap" value="{{ $biodata->nama ?? '' }}">
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="nisn" class="form-label">NISN<span class="required-mark">*</span></label>
                          <input type="text" id="nisn" name="nisn" class="form-input" placeholder="Masukkan NISN" value="{{ $biodata->nisn ?? '' }}">
                        </div>
                    </div>
                </div>
                
                <!-- Contact Info -->
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="nohp" class="form-label">Nomor HP<span class="required-mark">*</span></label>
                            <input type="tel" id="nohp" name="nohp" class="form-input" placeholder="Contoh: 08123456789" value="{{ $biodata->nohp ?? '' }}">
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="email" class="form-label">Email<span class="required-mark">*</span></label>
                           <input type="email" id="email" name="email" class="form-input" placeholder="contoh@email.com" value="{{ $biodata->email ?? '' }}">
                        </div>
                    </div>
                </div>
                
                <!-- Jenis Kelamin -->
                <div class="form-group">
                    <label class="form-label">Jenis Kelamin<span class="required-mark">*</span></label>
                    <div class="radio-group">
                      <label class="radio-item">
                         <input type="radio" name="jenis_kelamin" value="laki-laki" class="form-radio"
                         {{ old('jenis_kelamin', $biodata->jenis_kelamin ?? '') == 'laki-laki' ? 'checked' : '' }}>Laki-laki
                      </label>
                      <label class="radio-item">
                        <input type="radio" name="jenis_kelamin" value="perempuan" class="form-radio"
                        {{ old('jenis_kelamin', $biodata->jenis_kelamin ?? '') == 'perempuan' ? 'checked' : '' }}>Perempuan
                    </label>
                    </div>
                </div>
                
                <!-- Tempat dan Tanggal Lahir -->
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir<span class="required-mark">*</span></label>
                            <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-input" placeholder="Masukkan kota kelahiran" value="{{ $biodata->tempat_lahir ?? '' }}">
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir<span class="required-mark">*</span></label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-input" value="{{ $biodata->tanggal_lahir ?? '' }}">
                        </div>
                    </div>
                </div>
                
                <!-- Jurusan dan Kelas -->
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
            <label for="jurusan" class="form-label">Jurusan<span class="required-mark">*</span></label>
<select id="jurusan" name="jurusan" class="form-select" required>
    <option value="" disabled {{ empty($biodata->jurusan) ? 'selected' : '' }}>Pilih Jurusan</option>
    <option value="akuntansi" {{ (isset($biodata) && $biodata->jurusan == 'akuntansi') ? 'selected' : '' }}>Akuntansi Keuangan dan Lembaga</option>
    <option value="pemasaran" {{ (isset($biodata) && $biodata->jurusan == 'pemasaran') ? 'selected' : '' }}>Pemasaran</option>
    <option value="manajemen" {{ (isset($biodata) && $biodata->jurusan == 'manajemen') ? 'selected' : '' }}>Manajemen Perkantoran dan Layanan Bisnis</option>
    <option value="rpl" {{ (isset($biodata) && $biodata->jurusan == 'rpl') ? 'selected' : '' }}>Rekayasa Perangkat Lunak</option>
    <option value="tkj" {{ (isset($biodata) && $biodata->jurusan == 'tkj') ? 'selected' : '' }}>Teknik Komputer dan Jaringan</option>
    <option value="dkv" {{ (isset($biodata) && $biodata->jurusan == 'dkv') ? 'selected' : '' }}>Desain Komunikasi Visual</option>
    <option value="mesin" {{ (isset($biodata) && $biodata->jurusan == 'mesin') ? 'selected' : '' }}>Teknik Mesin</option>
    <option value="otomotif" {{ (isset($biodata) && $biodata->jurusan == 'otomotif') ? 'selected' : '' }}>Teknik Otomotif</option>
    <option value="logistik" {{ (isset($biodata) && $biodata->jurusan == 'logistik') ? 'selected' : '' }}>Teknik Logistik</option>
    <option value="kuliner" {{ (isset($biodata) && $biodata->jurusan == 'kuliner') ? 'selected' : '' }}>Kuliner</option>
</select>
       </div>
             </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="kelas" class="form-label">Kelas<span class="required-mark">*</span></label>
                            <select id="kelas" name="kelas" class="form-select" required>
                                <option value="" disabled selected>Pilih Kelas</option>
                                <option value="11" {{ (isset($biodata) && $biodata->kelas == '11') ? 'selected' : '' }}>Kelas 11</option>
                                <option value="12" {{ (isset($biodata) && $biodata->kelas == '12') ? 'selected' : '' }}>Kelas 12</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Agama -->
                <div class="form-group">
                    <label for="agama" class="form-label">Agama<span class="required-mark">*</span></label>
                    <select id="agama" name="agama" class="form-select" required>
                 <option value="" disabled {{ empty($biodata->agama) ? 'selected' : '' }}>Pilih Agama</option>
                 <option value="islam" {{ (isset($biodata) && $biodata->agama == 'islam') ? 'selected' : '' }}>Islam</option>
                 <option value="kristen" {{ (isset($biodata) && $biodata->agama == 'kristen') ? 'selected' : '' }}>Kristen</option>
                 <option value="buddha" {{ (isset($biodata) && $biodata->agama == 'buddha') ? 'selected' : '' }}>Buddha</option>
                 <option value="hindu" {{ (isset($biodata) && $biodata->agama == 'hindu') ? 'selected' : '' }}>Hindu</option>
                    </select>
                </div>
                
                <!-- Alamat Rumah -->
                <div class="form-group">
                    <label for="alamat" class="form-label">Alamat Rumah<span class="required-mark">*</span></label>
                    <textarea id="alamat" name="alamat" class="form-textarea">{{ old('alamat', optional($biodata)->alamat) }}</textarea>
                </div>
                    <button type="submit" class="btn btn-save">Simpan Data</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const menuToggle = document.getElementById("menuToggle");
            const sidebar = document.getElementById("sidebar");
            const overlay = document.getElementById("overlay");
            const closeSidebar = document.getElementById("closeSidebar");

            // Menampilkan sidebar saat menu toggle diklik
            menuToggle.addEventListener("click", function () {
                sidebar.classList.add("active");
                overlay.classList.add("active");
            });

            // Menyembunyikan sidebar saat tombol close diklik
            closeSidebar.addEventListener("click", function () {
                sidebar.classList.remove("active");
                overlay.classList.remove("active");
            });

            // Menyembunyikan sidebar saat overlay diklik
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

        document.getElementById('biodataForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Data berhasil disimpan!');
            window.location.href = 'beranda.php'; // Ganti dengan halaman beranda yang sesuai
        });
    </script>
</body>
</html>