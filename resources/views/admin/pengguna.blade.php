<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Data Siswa</title>
    
    
    <!-- Tambahkan Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="shortcut icon" href="./assets/compiled/svg/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC" type="image/png">
    
  <link rel="stylesheet" href="./assets/compiled/css/app.css">
  <link rel="stylesheet" href="./assets/compiled/css/app-dark.css">
</head>
<style>
   #searchBox {
  width: 300px; /* Sesuaikan lebar sesuai kebutuhan */
  height: 40px; /* Sesuaikan tinggi sesuai kebutuhan */
  font-size: 16px; /* Mengatur ukuran teks */
  padding: 8px; /* Memberikan ruang di dalam kotak */
}
    .center-text {
        text-align: center;
        margin-top: 20px;
    }
</style>
<body>
    <script src="assets/static/js/initTheme.js"></script>
    <div id="app">
        <div id="sidebar">
            <div class="sidebar-wrapper active">
    <div class="sidebar-header position-relative">
        <div class="d-flex justify-content-between align-items-center">
            <div class="logo">
                <a href="{{ url('/dashboardmin') }}"><img src="./assets/compiled/svg/logo.svg" alt="Logo" srcset=""></a>
            </div>
            <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                    role="img" class="iconify iconify--system-uicons" width="20" height="20"
                    preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                    <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path
                            d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                            opacity=".3"></path>
                        <g transform="translate(-210 -1)">
                            <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                            <circle cx="220.5" cy="11.5" r="4"></circle>
                            <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
                        </g>
                    </g>
                </svg>
                <div class="form-check form-switch fs-6">
                    <input class="form-check-input  me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                    <label class="form-check-label"></label>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                    role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet"
                    viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                    </path>
                </svg>
            </div>
            <div class="sidebar-toggler  x">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
    </div>
    <div class="sidebar-menu">
      <ul class="menu">
            <li class="sidebar-title">Menu</li>
            
            <li
            class="sidebar-item">
            <a href="{{ url('/dashboardmin') }}" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li
        class="sidebar-item">
        <a href="{{ url('/ringkasanabsen') }}" class='sidebar-link'>
            <i class="bi bi-journal-check"></i>
            <span>Ringkasan Absen</span>
        </a>
    </li>
<li
    class="sidebar-item">
    <a href="{{ url('/pengguna') }}" class='sidebar-link'>
        <i class="bi bi-journal-check"></i>
        <span>Data Pengguna</span>
    </a>
</li>
    <li
    class="sidebar-item">
    <a href="{{ url('/notif') }}" class='sidebar-link'>
        <i class="bi bi-bell"></i>
        <span>Notifikasi</span>
    </a>
    </li>
        <li
        class="sidebar-item">
        <a href="{{ url('/pengaturan') }}" class='sidebar-link'>
            <i class="bi bi-gear"></i>
            <span>Pengaturan</span>
        </a>
    </li>
        </ul>
    </div>
</div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            
            
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Pengguna</h3>
                <p class="text-subtitle text-muted">Kelola akun siswa dan perusahaan dengan mudah!</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboardmin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data pengguna siswa</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


<!-- Modal Tambah Siswa -->
<div id="addModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addForm">
                    <div class="form-group">
                        <label>Nama Pengguna</label>
                        <input type="text" id="namaPengguna" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="emailPengguna" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" id="passwordPengguna" class="form-control" required minlength="6">
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select id="rolePengguna" class="form-control">
                            <option value="user">User</option>
                            <option value="perusahaan">Perusahaan</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <form id="addForm">
                        <button type="submit" class="btn btn-primary" id="saveButton">Simpan</button>
                    </form>
                </form>
            </div>
        </div>
    </div>
</div>

 <!-- Basic Tables start -->
 <section class="section">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Kelola Data pengguna </h5>
            <div class="d-flex align##-items-center justify-content-between mb-3">
<div class="row mb-3">
    <div class="col-md-6">
        <input type="text" id="searchBox" class="form-control form-control-sm" placeholder="Cari berdasarkan nama">
    </div>
</div>
    <a href="#" class="btn btn-sm btn-outline-primary ms-2" id="openAddModal" >Tambah Data</a>
</div>
    </div>    
        <div class="card-body">
            <div class="table-responsive">
               @if (isset($pengguna) && $pengguna->count()) 
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Password</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="dataPengguna">
            @foreach ($pengguna as $user)
                <tr>
                    <td>{{ $user->nama }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->password }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <form method="POST" action="/pengguna/hapus/{{ $user->id }}">
                             @csrf
                              @method('DELETE')
                              <a href="#" class="btn btn-sm btn-danger deleteButton" data-id="{{ $user->id }}">Hapus</a>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
<div class="center-text">
    <p>Belum ada pengguna yang terdaftar.</p>
</div>
     @endif
        </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <div class="footer clearfix mb-0 text-muted">
        <div class="float-start">
            <p>2025 &copy; SMKN 1 SUBANG</p>
        </div>
        <div class="float-end">
            <p>Create by RPL <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span></p>
        </div>
    </div>
</footer>
    <script src="assets/static/js/components/dark.js"></script>
    <script src="assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<!-- SCRIPT DITARUH SEBELUM </BODY> -->
<script src="assets/extensions/jquery/jquery.min.js"></script>
<script src="assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="assets/static/js/pages/datatables.js"></script>
<!-- Tambahkan Bootstrap Bundle (JS + Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $('.close').click(function() {
    $('#addModal').modal('hide');
});
    // Fungsi untuk memuat data pengguna ke dalam tabel
    function loadData() {
$.get('/pengguna', function(data) {
    console.log("Data yang diterima:", data);
    console.log("Tipe data:", typeof data);
});

    }
    // Panggil fungsi saat halaman dimuat
    loadData();
    // Tangani pencarian pengguna
    $('#searchBox').on('input', function() {
        let query = $(this).val().toLowerCase();
        $('#dataPengguna tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(query) > -1);
        });
    });

    // Pencarian berdasarkan teks input
    $('#searchBox').on('input', function () {
        let query = $(this).val().toLowerCase();
        $('#dataPengguna tr').filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(query) > -1);
        });
    });

    // Pencarian berdasarkan dropdown role
    $('#roleFilter').on('change', function () {
        let selectedRole = $(this).val().toLowerCase();
        $('#dataPengguna tr').filter(function () {
            if (selectedRole === 'all') {
                $(this).show(); // Tampilkan semua jika pilih "All"
            } else {
                $(this).toggle($(this).find('td.role').text().toLowerCase() === selectedRole);
            }
        });
    });


    // Tangani submit formulir tambah pengguna
    $('#addForm').submit(function(e) {
        e.preventDefault();

        let data = {
            _token: '{{ csrf_token() }}',
            namaPengguna: $('#namaPengguna').val(),
            emailPengguna: $('#emailPengguna').val(),
            passwordPengguna: $('#passwordPengguna').val(),
            role: $('#rolePengguna').val()
        };

        $.post('/pengguna/tambah', data, function(response) {
            alert(response.message);
            $('#addModal').modal('hide'); // Tutup modal setelah simpan
            location.reload(); // Perbarui tabel pengguna
        }).fail(function(xhr) {
            alert('Terjadi kesalahan: ' + xhr.responseText);
        });
    });

    // Tangani klik tombol tambah pengguna
    $('#openAddModal').click(function() {
        $('#addModal').modal('show');
    });
 
    // Tangani klik tombol hapus pengguna
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('click', '.deleteButton', function(e) {
    e.preventDefault();
    let id = $(this).data('id');

    if (confirm('Apakah Anda yakin ingin menghapus pengguna ini?')) {
        $.ajax({
            url: '/pengguna/hapus/' + id,
            type: 'DELETE',
            success: function(response) {
                alert(response.message);
                location.reload();
            },
            error: function(xhr) {
                alert('Terjadi kesalahan: ' + xhr.responseText);
            }
        });
    }
});

$.ajax({
    url: '/pengguna/hapus/' + id,
    type: 'DELETE',
    data: {
        _token: '{{ csrf_token() }}'
    },
    success: function(response) {
        alert(response.message);
        location.reload();
    },
    error: function(xhr) {
        alert('Terjadi kesalahan: ' + xhr.responseText);
    }
});

$(document).ready(function () {
    function filterUsers() {
        let query = $('#searchBox').val().toLowerCase();
        let selectedRole = $('#roleFilter').val().toLowerCase();

        $('#dataPengguna tr').each(function () {
            let textMatch = $(this).find('td:first-child').text().toLowerCase().indexOf(query) > -1; // Cari berdasarkan nama
            let roleMatch = selectedRole === 'all' || $(this).find('td:nth-child(4)').text().toLowerCase() === selectedRole; // Cari berdasarkan role

            $(this).toggle(textMatch && roleMatch); // Tampilkan hanya yang sesuai
        });
    }

    // Pencarian berdasarkan teks input
    $('#searchBox').on('input', filterUsers);

    // Filter berdasarkan role
    $('#roleFilter').on('change', filterUsers);
});

</script>
</body>

</html>
