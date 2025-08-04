<?php

?>
<!DOCTYPE html>
<html lang="id">

<head>
<<<<<<< HEAD
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Profil Saya</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    body {
      background-color: #f0f2f5;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 20px;
      transition: background-color 0.3s ease;
    }
    .container {
      background: white;
      padding: 30px 20px;
      border-radius: 12px;
      width: 100%;
      max-width: 300px;
      text-align: center;
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
      transform: translateY(0);
      transition: all 0.3s ease;
    }
    .container:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }
    .profile-photo {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      overflow: hidden;
      margin: 0 auto 15px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.2);
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
    .info {
      margin: 10px 0;
      font-size: 14px;
      color: #333;
      opacity: 1;
      transition: opacity 0.5s ease;
    }
    .loading .info {
      opacity: 0.5;
    }
    .label {
      font-weight: bold;
      display: block;
      margin-bottom: 5px;
      color: #555;
    }
    .action-btn {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 18px;
      background-color: #0f172a;
      color: #fff;
      border: none;
      border-radius: 20px;
      text-decoration: none;
      transition: all 0.3s ease;
      cursor: pointer;
      transform: scale(1);
    }
    .action-btn:hover {
      background-color: #1e293b;
      transform: scale(1.05);
    }
    .action-btn:active {
      transform: scale(0.98);
    }
    .fade-in {
      animation: fadeIn 0.5s ease-in-out;
    }
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
  </style>
</head>
<body>
  <div class="container loading" id="profileContainer">
    <div class="profile-photo">
      <img id="profileImage" src="default-avatar.png" alt="Foto Profil" class="fade-in" />
    </div>

    {{-- Biodata dari Database --}}
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

    {{-- Tombol Navigasi --}}
    <a href="{{ url('/editprofil') }}" class="action-btn">Edit Profil</a>
    <br><a href="{{ url('/biodata') }}" class="action-btn">Biodata</a>
=======
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
            max-width: 800px;
            margin: 0 auto;
            padding: 15px;
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

        .logout-wrapper {
            text-align: center;
            margin-top: 20px;
        }

        .logout-link {
            text-decoration: none;
            color: white;
            background-color: #000000;
            padding: 10px 20px;
            border-radius: 6px;
            display: inline-block;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .logout-link:hover {
            background-color: #172a46;
        }

        .info-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 30px;
        }

        .info {
            text-align: center;
            margin-bottom: 15px;
        }

        .label {
            font-weight: bold;
            color: #555;
            display: block;
            margin-bottom: 5px;
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

        .upload-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 15px;
        }

        .upload-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
            justify-content: space-between;
        }

        .upload-group input[type="file"] {
            flex: 1 1 60%;
            padding: 5px;
        }

        .upload-group button {
            flex: 1 1 35%;
            padding: 8px 12px;
            background-color: #000000;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            white-space: nowrap;
        }

        .upload-group button:hover {
            background-color: #172a46;
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

        @media (max-width: 768px) {

            #absensiTable th,
            #absensiTable td {
                white-space: nowrap;
            }
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
                src="{{ Auth::user()->biodata && Auth::user()->biodata->foto ? asset('storage/' . Auth::user()->biodata->foto) : 'https://ui-avatars.com/api/?name=' . Auth::user()->nama . '&background=random' }}"
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
>>>>>>> 44734077802f2dac236b168425133a99aa31d034

    <br><br>
    <p><a href="javascript:void(0)" class="menu-item" onclick="confirmLogout()">Logout</a></p>

<<<<<<< HEAD
    {{-- Data dari localStorage --}}
    <div class="info">
      <span class="label">Nama Lengkap</span>
      <div id="nama">Loading...</div>
=======
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
        @if (!empty($biodata) && $biodata->count())
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
        @else
            <p class="text-muted">Isi biodata terlebih dahulu!!!</p>
        @endif

        <br>
        <div class="button-container">
            <label>Lengkapi Profil dan Biodata anda dibawah sini👇🏻</label>
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
        <div class="logout-wrapper">
            <p><a href="javascript:void(0)" class="link" onclick="confirmLogout()">Logout</a></p>
        </div>
>>>>>>> 44734077802f2dac236b168425133a99aa31d034
    </div>
    <div class="info">
      <span class="label">Email</span>
      <div id="email">Loading...</div>
    </div>
  </div>

<<<<<<< HEAD
  <script>
    // Wait for everything to load
    window.addEventListener('load', () => {
      // Add a slight delay to simulate loading (optional)
      setTimeout(loadProfileData, 300);
    });

    function loadProfileData() {
      try {
        // Get container element
        const container = document.getElementById('profileContainer');
        container.classList.add('loading');


        requestAnimationFrame(() => {
          const data = JSON.parse(localStorage.getItem('profileData')) || {
            nama: 'Belum diisi',
            email: 'Belum diisi',
            profileImage: 'default-avatar.png'
          };

          animateContentUpdate('nama', data.nama);
          animateContentUpdate('email', data.email);

          const profileImage = document.getElementById('profileImage');
          if (data.profileImage && data.profileImage !== profileImage.src) {
            profileImage.style.opacity = '0';
            setTimeout(() => {
              profileImage.src = data.profileImage;
              profileImage.style.opacity = '1';
            }, 200);
          }
          
          setTimeout(() => {
            container.classList.remove('loading');
          }, 500);
        });
      } catch (error) {
        console.error('Error loading profile data:', error);
        // Fallback to default values if error occurs
        document.getElementById('nama').textContent = 'Belum diisi';
        document.getElementById('email').textContent = 'Belum diisi';
        document.getElementById('profileContainer').classList.remove('loading');
      }
    }

    function animateContentUpdate(elementId, newValue) {
      const element = document.getElementById(elementId);
      element.style.opacity = '0';
      element.style.transform = 'translateY(5px)';

      setTimeout(() => {
        element.textContent = newValue;
        element.style.opacity = '1';
        element.style.transform = 'translateY(0)';
        element.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
      }, 200);
    }

    // Optional: Add event listener for storage changes to update in real-time
    window.addEventListener('storage', (event) => {
      if (event.key === 'profileData') {
        loadProfileData();
      }
    });
=======


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
>>>>>>> 44734077802f2dac236b168425133a99aa31d034

    // Example function for logout confirmation
    function confirmLogout() {
      if (confirm('Apakah Anda yakin ingin logout?')) {
        window.location.href = '/logout'; // Ganti dengan route logout yang sesuai
      }
    }
  </script>
