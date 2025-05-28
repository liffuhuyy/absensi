<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Profil Pengguna</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            width: 100%;
            max-width: 300px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .profile-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin: 0 auto 15px;
            overflow: hidden;
            background-size: cover;
            background-position: center;
        }
        .profile-pic img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .profile-info {
            margin-bottom: 20px;
            text-align: left;
            padding: 0 10px;
        }
        .profile-info p {
            margin: 10px 0;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
        .button-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 20px;
        }
        .button {
            width: 100%;
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
            box-sizing: border-box;
            transition: all 0.3s ease;
        }
        .button:hover {
            background: #1e293b;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .logout-link {
            text-decoration: none;
            color: black;
            display: inline-block;
            margin-top: 20px;
            transition: color 0.3s;
            cursor: pointer;
        }
        .logout-link:hover {
            color: #e74c3c;
        }
        @media (max-width: 400px) {
            .container {
                padding: 15px;
            }
            .profile-pic {
                width: 80px;
                height: 80px;
            }
        }
    </style>
</head>
<body>
    <!-- Kontainer Profil Pengguna -->
    <div class="container" id="profileContainer">
        <div class="profile-pic">
            @if(isset($biodata[0]->foto) && $biodata[0]->foto)
                <img src="{{ asset('storage/' . $biodata[0]->foto) }}?v={{ time() }}" alt="Profile Picture" id="profileImage">
            @else
                <div style="background: #ccc; width: 100%; height: 100%;" id="defaultProfile"></div>
            @endif
        </div>
        
        <div class="profile-info">
            @foreach ($biodata as $data)
                <p><strong>Nama:</strong> {{ $data->nama }}</p>
                <p><strong>No HP:</strong> {{ $data->nohp }}</p>
                <!-- Tambahkan field lainnya sesuai kebutuhan -->
            @endforeach
        </div>
        
        <div class="button-container">
            <a href="{{ url('/editprofil') }}" class="button">Edit Profil</a>
            <a href="{{ url('/biodata') }}" class="button">Biodata</a>
        </div>
        
        <p><a href="javascript:void(0)" class="logout-link" onclick="confirmLogout()">Logout</a></p>
    </div>

    <script>
        // Confirm logout
        function confirmLogout() {
            const isConfirmed = confirm("Apakah Anda yakin ingin logout?");
            if (isConfirmed) {
                // Add loading effect
                const container = document.getElementById('profileContainer');
                container.style.opacity = '0.7';
                container.style.pointerEvents = 'none';
                
                // Redirect after delay
                setTimeout(() => {
                    window.location.href = "{{ url('/index') }}";
                }, 500);
            }
        }

        // Add animation when page loads
        document.body.style.opacity = '0';
        setTimeout(() => {
            document.body.style.transition = 'opacity 0.5s ease';
            document.body.style.opacity = '1';
        }, 100);

        // Function to refresh profile image
        function refreshProfileImage() {
            const profileImage = document.getElementById('profileImage');
            if (profileImage) {
                // Add timestamp to prevent caching
                profileImage.src = "{{ isset($biodata[0]->foto) ? asset('storage/' . $biodata[0]->foto) : '' }}?v=" + new Date().getTime();
            }
        }

        // Check for updates when returning from edit profile
        window.addEventListener('focus', function() {
            refreshProfileImage();
        });

        // Also refresh when page is shown (for mobile)
        document.addEventListener('visibilitychange', function() {
            if (!document.hidden) {
                refreshProfileImage();
            }
        });
    </script>
</body>
</html>