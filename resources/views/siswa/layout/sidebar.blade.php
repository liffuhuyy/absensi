   <div class="overlay" id="overlay"></div>

   <div class="sidebar" id="sidebar">
       <div class="close-sidebar" id="closeSidebar">×</div>

       <div class="menu-group">
           <a href="{{ url('/beranda') }}" class="menu-item">Beranda</a>
           <a href="{{ url('/profil') }}" class="menu-item">Profil</a>
       </div>

       <div class="menu-group">
           <div class="menu-title">Menu Utama</div>
           <a href="{{ url('/presensi') }}" class="menu-item">Presensi</a>
           <a href="{{ url('/manajementugas') }}" class="menu-item">Management Tugas</a>
           <a href="{{ url('/magang') }}" class="menu-item">Pengajuan Magang</a>
           <a href="{{ url('/penilaian') }}" class="menu-item">Penilaian Akhir</a>
       </div>

       <div class="menu-group">
           <div class="menu-title">Lainnya</div>
           <a href="{{ url('/kontak') }}" class="menu-item">Kontak</a>
           <a href="javascript:void(0)" class="menu-item" onclick="confirmLogout()">Logout</a>
       </div>
   </div>
   <script>
       function confirmLogout() {
           let confirmAction = confirm("Apakah Anda yakin ingin logout?");
           if (confirmAction) {
               window.location.href = "{{ url('/index') }}"; // Ganti dengan halaman atau logika logout sesuai kebutuhan
           }
           return false; // Mencegah link langsung berpindah jika pengguna membatalkan
       }
   </script>
