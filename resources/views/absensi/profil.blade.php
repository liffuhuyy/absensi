<!DOCTYPE html>
<html lang="id">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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

        .header h1 {
            margin: 0;
            font-size: 20px;
        }

        .menu-toggle {
            font-size: 19px;
            color: #ffffff;
            cursor: pointer;
            padding: 10px;
            display: inline-block;
        }

        .menu-toggle:hover {
            color: #000;
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .welcome-card,
        .stats-card {
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
            background: white;
            border-radius: 10px;
            padding: 20px;
            width: 500px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .profile-pic {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #ddd;
            display: inline-block;
            margin-bottom: 10px;
        }

        .button-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .button {
            width: 100%;
            /* Pastikan lebar tombol sama */
            padding: 12px;
            background: #0f172a;
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            display: inline-block;
            /* Pastikan tidak berubah ukurannya */
            box-sizing: border-box;
            /* Hindari perubahan ukuran karena padding */
        }

        .logout-link {
            text-decoration: none;
            color: black;
        }

        .label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        .profile-photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        .profile-photo:hover {
            transform: scale(1.05);
        }

        .profile-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.3s ease;
        }

        .upload-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .upload-group input[type="file"] {
            flex: 1;
            padding: 6px;
        }

        .upload-group button {
            padding: 5px 10px;
            background-color: #000000;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .upload-group button:hover {
            background-color: #2c4e82;
        }

        .alert {
            padding: 12px 20px;
            border-radius: 4px;
            position: relative;
            margin-bottom: 10px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .btn-close {
            position: absolute;
            right: 10px;
            top: 10px;
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: #000;
        }
    </style>
</head>

<body>
    <div class="header">
        <a href="{{ url('/beranda') }}" class="menu-toggle" id="menuToggle">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h4>SMKN 1 SUBANG</h4>
        <div class="profile-icon">
        </div>
    </div>

    <!-- Kontainer Profil Pengguna -->
    <div class="container" id="profileContainer">
        <div class="profile-photo">
            <img id="profileImage"
                src="{{ Auth::user()->biodata && Auth::user()->biodata->foto ? asset('storage/' . Auth::user()->biodata->foto) : asset('default-avatar.png') }}"
                alt="Foto Profil" class="fade-in" width="150">
        </div>
        <div class="mb-1">
            <div class="info">
                <span class="label">Foto Profil</span>
            </div>
            @php
                $biodataLengkap =
                    Auth::user()->biodata &&
                    Auth::user()->biodata->nama &&
                    Auth::user()->biodata->nisn &&
                    Auth::user()->biodata->alamat; // tambahkan validasi kolom lain sesuai kebutuhan
            @endphp

            <form action="{{ route('foto.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="upload-group">
                    <input type="file" name="foto" accept="image/*" required
                        {{ !$biodataLengkap ? 'disabled' : '' }}>

                    <script>
                        const inputFoto = document.querySelector('input[name="foto"]');
                        if (inputFoto) {
                            inputFoto.addEventListener('change', function(e) {
                                const file = e.target.files[0];
                                if (file) {
                                    document.getElementById('profileImage').src = URL.createObjectURL(file);
                                }
                            });
                        }
                    </script>

                    <button type="submit" {{ !$biodataLengkap ? 'disabled' : '' }}>Simpan</button>
                </div>
            </form>

        </div>
        @foreach ($biodata as $data)
            <div class="info">
                <span class="label">Nama:</span>
                <p>{{ $data->nama }}</p>
            </div>
            <div class="info">
                <span class="label">Email:</span>
                <p>{{ $data->email }}</p>
            </div>
            <div class="info">
                <span class="label">No HP:</span>
                <p>{{ $data->nohp }}</p>
            </div>
        @endforeach

        <br>
        <div class="button-container">
            <label>Lengkapi Profil dan Biodata anda dibawah sini!</label>
            <button class="btn btn-secondary" onclick="window.location.href='{{ url('/biodata') }}'">Biodata</button>
            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                data-bs-whatever="@mdo">
                Ubah Kata Sandi
            </button>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center"
                role="alert">
                <div>{{ session('success') }}</div>
                <span class="ms-3 text-dark fw-bold" style="cursor: pointer;" onclick="closeAlert(this)">x</span>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between align-items-center"
                role="alert">
                <div>{{ session('error') }}</div>
                <span class="ms-3 text-dark fw-bold" style="cursor: pointer;" onclick="closeAlert(this)">x</span>
            </div>
        @endif

        <br><br><br><br><br><br>
        <p><a href="javascript:void(0)" class="label" onclick="confirmLogout()">Logout</a></p>
    </div>



    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pengubahan Kata Sandi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('ubah.password') }}" method="POST">
                        @csrf
                        <div class="mb-3 position-relative">
                            <label for="current-password" class="form-label">Kata sandi saat ini</label>
                            <div class="input-group">
                                <input type="password" name="current_password" class="form-control"
                                    id="current-password" required>
                                <button class="btn btn-outline-secondary" type="button"
                                    onclick="togglePassword('current-password', this)">
                                    <i class="fas fa-eye-slash"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="new-password" class="form-label">Kata sandi baru</label>
                            <div class="input-group">
                                <input type="password" name="new_password" class="form-control" id="new-password"
                                    oninput="checkPasswordMatch()" required>
                                <button class="btn btn-outline-secondary" type="button"
                                    onclick="togglePassword('new-password', this)">
                                    <i class="fas fa-eye-slash"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="confirm-password" class="form-label">Konfirmasi kata sandi baru</label>
                            <div class="input-group">
                                <input type="password" name="confirm_password" class="form-control"
                                    id="confirm-password" oninput="checkPasswordMatch()" required>
                                <button class="btn btn-outline-secondary" type="button"
                                    onclick="togglePassword('confirm-password', this)">
                                    <i class="fas fa-eye-slash"></i>
                                </button>
                            </div>
                            <div id="password-error" class="form-text text-danger d-none">
                                Kata sandi tidak cocok!
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Ubah Kata Sandi</button>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <script>
            function closeAlert(el) {
                const alert = el.parentElement;
                alert.classList.remove('show');
                setTimeout(() => {
                    alert.classList.add('d-none');
                }, 300); // waktu fade sesuai bootstrap
            }
        </script>
        <script>
            function togglePassword(id, el) {
                const input = document.getElementById(id);
                const icon = el.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                }
            }
        </script>
        <script>
            function togglePassword(inputId, btn) {
                const input = document.getElementById(inputId);
                const icon = btn.querySelector('i');
                if (input.type === "password") {
                    input.type = "text";
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                } else {
                    input.type = "password";
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                }
            }

            function checkPasswordMatch() {
                const newPassword = document.getElementById('new-password').value;
                const confirmPassword = document.getElementById('confirm-password').value;
                const error = document.getElementById('password-error');

                if (confirmPassword && newPassword !== confirmPassword) {
                    error.classList.remove('d-none');
                } else {
                    error.classList.add('d-none');
                }
            }
        </script>
        <script>
            // Menu toggle functionality
            const menuToggle = document.getElementById('menuToggle');
            const sidebar = document.getElementById('sidebar');
            const closeSidebar = document.getElementById('closeSidebar');
            const overlay = document.getElementById('overlay');

            menuToggle.addEventListener('click', function() {
                sidebar.classList.add('active');
                overlay.classList.add('active');
            });

            closeSidebar.addEventListener('click', function() {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            });

            overlay.addEventListener('click', function() {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            });

            function confirmLogout() {
                let confirmAction = confirm("Apakah Anda yakin ingin logout?");
                if (confirmAction) {
                    window.location.href =
                        "{{ url('/index') }}"; // Ganti dengan halaman atau logika logout sesuai kebutuhan
                }
                return false; // Mencegah link langsung berpindah jika pengguna membatalkan
            }
        </script>
</body>

</html>
