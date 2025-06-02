<!DOCTYPE html>
<html lang="id">
<head>
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
<<<<<<< HEAD
  <div class="container loading" id="profileContainer">
    <div class="profile-photo">
      <img id="profileImage" src="default-avatar.png" alt="Foto Profil" class="fade-in" />
=======
    <!-- Kontainer Profil Pengguna -->
    <div class="container" id="profileContainer">
        <div class="profile-pic"></div>
     <p>Nama: </p>
     <p>Email: </p>
     <p>No HP: </p>
@foreach ($biodata as $data)
    <p>{{ $data->nama}}</p>
    <p>{{ $data->email}}</p>
    <p>{{ $data->nohp }}</p>
@endforeach
        <br><br><br>
        <div class="button-container">
            <a href="{{ url('/editprofil') }}" class="button">Edit Akun</a>
            <a href="{{ url('/biodata') }}" class="button">Biodata</a>
        </div><br><br><br><br><br>
        <p><a href="javascript:void(0)" class="menu-item" onclick="confirmLogout()">Logout</a></p>

>>>>>>> 817f91c4efa9020bd08c08355f13d82491af875c
    </div>

    <div class="info">
      <span class="label">Nama Lengkap</span>
      <div id="nama">Loading...</div>
    </div>

    <div class="info">
      <span class="label">Email</span>
      <div id="email">Loading...</div>
    </div>

    <a href="{{ url('/editprofil') }}" class="action-btn">Edit Profil</a>
    <br> <a href="{{ url('/biodata') }}" class="action-btn">Biodata</a>
  </div>

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
        
        // Add smooth transition class
        container.classList.add('loading');
        
        // Use requestAnimationFrame for smoother animations
        requestAnimationFrame(() => {
          // Get data from localStorage with fallback
          const data = JSON.parse(localStorage.getItem('profileData')) || {
            nama: 'Belum diisi',
            email: 'Belum diisi',
            profileImage: 'default-avatar.png'
          };
          
          // Animate the content updates
          animateContentUpdate('nama', data.nama);
          animateContentUpdate('email', data.email);
          
          // Smooth image loading
          const profileImage = document.getElementById('profileImage');
          if (data.profileImage && data.profileImage !== profileImage.src) {
            profileImage.style.opacity = '0';
            setTimeout(() => {
              profileImage.src = data.profileImage;
              profileImage.style.opacity = '1';
            }, 200);
          }
          
          // Remove loading class when done
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
  </script>
</body>
</html>