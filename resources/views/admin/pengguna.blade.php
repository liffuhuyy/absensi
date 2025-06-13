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
    <link rel="shortcut icon"
        href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC"
        type="image/png">

    <link rel="stylesheet" href="./assets/compiled/css/app.css">
    <link rel="stylesheet" href="./assets/compiled/css/app-dark.css">
</head>
<style>
    #searchBox {
        width: 300px;
        /* Sesuaikan lebar sesuai kebutuhan */
        height: 40px;
        /* Sesuaikan tinggi sesuai kebutuhan */
        font-size: 16px;
        /* Mengatur ukuran teks */
        padding: 8px;
        /* Memberikan ruang di dalam kotak */
    }

    .center-text {
        text-align: center;
        margin-top: 20px;
    }
</style>

<body>
    <script src="assets/static/js/initTheme.js"></script>
    @include('admin.layout.sidebar')
    @include('admin.layout.header')
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
                            <li class="breadcrumb-item active" aria-current="page">Data pengguna</li>
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
                                <input type="password" id="passwordPengguna" class="form-control" required
                                    minlength="6">
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
                                <input type="text" id="searchBox" class="form-control form-control-sm"
                                    placeholder="Cari berdasarkan nama">
                            </div>
                        </div>
                        <a href="#" class="btn btn-sm btn-outline-primary ms-2" id="openAddModal">Tambah Data</a>
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
                                                    <a href="#" class="btn btn-sm btn-danger deleteButton"
                                                        data-id="{{ $user->id }}">Hapus</a>
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

        @include('admin.layout.footer')
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
            $('#searchBox').on('input', function() {
                let query = $(this).val().toLowerCase();
                $('#dataPengguna tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(query) > -1);
                });
            });

            // Pencarian berdasarkan dropdown role
            $('#roleFilter').on('change', function() {
                let selectedRole = $(this).val().toLowerCase();
                $('#dataPengguna tr').filter(function() {
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

            $(document).ready(function() {
                function filterUsers() {
                    let query = $('#searchBox').val().toLowerCase();
                    let selectedRole = $('#roleFilter').val().toLowerCase();

                    $('#dataPengguna tr').each(function() {
                        let textMatch = $(this).find('td:first-child').text().toLowerCase().indexOf(query) > -
                            1; // Cari berdasarkan nama
                        let roleMatch = selectedRole === 'all' || $(this).find('td:nth-child(4)').text()
                            .toLowerCase() === selectedRole; // Cari berdasarkan role

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
