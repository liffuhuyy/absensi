<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0; /* Menghilangkan margin default */
        }
        .container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            width: 250px;
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
            width: 100%; /* Pastikan lebar tombol sama */
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
            display: inline-block; /* Pastikan tidak berubah ukurannya */
            box-sizing: border-box; /* Hindari perubahan ukuran karena padding */
        }

        .edit-container input {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .logout-link {
    text-decoration: none;
    color: black;
}

    </style>
    <script>
            function confirmLogout() {
        let confirmAction = confirm("Apakah Anda yakin ingin logout?");
        if (confirmAction) {
            window.location.href = "{{ url('/index') }}"; // Ganti '/index' dengan URL logout sebenarnya
        }
    }
        function showEditProfile() {
            document.getElementById('profileContainer').style.display = 'none';
            document.getElementById('editProfile').style.display = 'block';
        }
    </script>
</head>
<body>
    <!-- Kontainer Profil Pengguna -->
    <div class="container" id="profileContainer">
        <div class="profile-pic"></div>
@foreach ($biodata as $data)
    <p>Nama: {{ $data->nama}}</p>
    <p>No Hp: {{ $data->nohp }}</p>
@endforeach
        <br><br><br>
        <div class="button-container">
            <a href="{{ url('/editprofil') }}" class="button">Edit Akun</a>
            <a href="{{ url('/biodata') }}" class="button">Biodata</a>
        </div><br><br><br><br><br>
        <p><a href="javascript:void(0)" class="menu-item" onclick="confirmLogout()">Logout</a></p>

    </div>

</body>
</html> 