<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Data Pembimbing</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="./assets/compiled/svg/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="./assets/compiled/css/app.css">
    <link rel="stylesheet" href="./assets/compiled/css/app-dark.css">
</head>

<style>
    #roleFilter {
        width: 150px;
        font-size: 14px;
        padding: 5px;
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
                        <div class="theme-toggle d-flex gap-2 align-items-center mt-2">
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
                                <input class="form-check-input me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
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
                        <div class="sidebar-toggler x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>
                        <li class="sidebar-item">
                            <a href="{{ url('/dashboardmin') }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ url('/ringkasanabsen') }}" class='sidebar-link'>
                                <i class="bi bi-journal-check"></i>
                                <span>Ringkasan Absen</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ url('/pengguna') }}" class='sidebar-link'>
                                <i class="bi bi-journal-check"></i>
                                <span>Data Pengguna</span>
                            </a>
                        </li>
                        <li class="sidebar-item active">
                            <a href="{{ url('/datapembimbing') }}" class='sidebar-link'>
                                <i class="bi bi-journal-check"></i>
                                <span>Data Pembimbing</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ url('/notif') }}" class='sidebar-link'>
                                <i class="bi bi-bell"></i>
                                <span>Notifikasi</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
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
                            <h3>Data Pembimbing</h3>
                            <p class="text-subtitle text-muted">Kelola data pembimbing dengan mudah</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/dashboardmin') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Data Pembimbing</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Modal Tambah Pembimbing -->
                <div id="addModal" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Pembimbing</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="addForm">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label>Nama Pembimbing</label>
                                        <input type="text" id="namaPembimbing" class="form-control" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>NIP</label>
                                        <input type="text" id="nipPembimbing" class="form-control" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Jurusan</label>
                                        <select id="jurusanPembimbing" class="form-control" required>
                                            <option value="">Pilih Jurusan</option>
                                            <option value="RPL">Rekayasa Perangkat Lunak</option>
                                            <option value="TKJ">Teknik Komputer dan Jaringan</option>
                                            <option value="MM">Multimedia</option>
                                            <option value="OTKP">Otomatisasi dan Tata Kelola Perkantoran</option>
                                            <option value="AKL">Akuntansi dan Keuangan Lembaga</option>
                                            <option value="BDP">Bisnis Daring dan Pemasaran</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Kelas Bimbingan</label>
                                        <input type="text" id="kelasPembimbing" class="form-control" placeholder="Contoh: XII RPL 1" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>No HP</label>
                                        <input type="text" id="nohpPembimbing" class="form-control" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Email</label>
                                        <input type="email" id="emailPembimbing" class="form-control" required>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="button" class="btn btn-primary" id="saveButton">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Edit Pembimbing -->
                <div id="editModal" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Data Pembimbing</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="editForm">
                                    @csrf
                                    <input type="hidden" id="pembimbingId">
                                    <div class="form-group mb-3">
                                        <label>Nama Pembimbing</label>
                                        <input type="text" id="namaPembimbing_edit" class="form-control" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>NIP</label>
                                        <input type="text" id="nipPembimbing_edit" class="form-control" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Jurusan</label>
                                        <select id="jurusanPembimbing_edit" class="form-control" required>
                                            <option value="">Pilih Jurusan</option>
                                            <option value="RPL">Rekayasa Perangkat Lunak</option>
                                            <option value="TKJ">Teknik Komputer dan Jaringan</option>
                                            <option value="MM">Multimedia</option>
                                            <option value="OTKP">Otomatisasi dan Tata Kelola Perkantoran</option>
                                            <option value="AKL">Akuntansi dan Keuangan Lembaga</option>
                                            <option value="BDP">Bisnis Daring dan Pemasaran</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Kelas Bimbingan</label>
                                        <input type="text" id="kelasPembimbing_edit" class="form-control" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>No HP</label>
                                        <input type="text" id="nohpPembimbing_edit" class="form-control" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Email</label>
                                        <input type="email" id="emailPembimbing_edit" class="form-control" required>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="button" class="btn btn-primary" id="updateButton">Update</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Basic Tables start -->
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Kelola Data Pembimbing</h5>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <input type="text" id="searchBox" class="form-control form-control-sm" placeholder="Cari berdasarkan nama...">
                                    </div>
                                </div>
                                <a href="#" class="btn btn-sm btn-outline-primary ms-2" id="openAddModal">Tambah Pembimbing</a>
                            </div>
                        </div>    
                        <div class="card-body">
                            <div class="table-responsive">
                                @if (isset($pembimbing) && $pembimbing->count()) 
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>NIP</th>
                                                <th>Jurusan</th>
                                                <th>Kelas</th>
                                                <th>Email</th>
                                                <th>No HP</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="dataPembimbing">
                                            @foreach ($pembimbing as $user)
                                                <tr>
                                                    <td>{{ $user->nama }}</td>
                                                    <td>{{ $user->nip }}</td>
                                                    <td>{{ $user->jurusan }}</td>
                                                    <td>{{ $user->kelas }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->no_hp }}</td>
                                                    <td>
                                                        <a href="#" class="btn btn-sm btn-warning editButton" 
                                                           data-id="{{ $user->id }}"
                                                           data-nama="{{ $user->nama }}"
                                                           data-nip="{{ $user->nip }}"
                                                           data-jurusan="{{ $user->jurusan }}"
                                                           data-kelas="{{ $user->kelas }}"
                                                           data-email="{{ $user->email }}"
                                                           data-nohp="{{ $user->no_hp }}">Edit</a>
                                                        <a href="#" class="btn btn-sm btn-danger deleteButton" data-id="{{ $user->id }}">Hapus</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="center-text">
                                        <p>Belum ada pembimbing yang terdaftar.</p>
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
            </div>
        </div>
    </div>

    <script src="assets/static/js/components/dark.js"></script>
    <script src="assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/extensions/jquery/jquery.min.js"></script>
    <script src="assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="assets/static/js/pages/datatables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Setup CSRF Token untuk AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Fungsi untuk memuat data pembimbing
        function loadData() {
            $.get('/datapembimbing', function(data) {
                console.log("Data pembimbing berhasil dimuat:", data);
            }).fail(function(xhr) {
                console.error('Error loading data:', xhr.responseText);
            });
        }

        // Panggil fungsi saat halaman dimuat
        $(document).ready(function() {
            loadData();
        });

        // Fungsi pencarian
        $('#searchBox').on('input', function() {
            let query = $(this).val().toLowerCase();
            $('#dataPembimbing tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(query) > -1);
            });
        });

        // Buka modal tambah pembimbing
        $('#openAddModal').click(function(e) {
            e.preventDefault();
            $('#addModal').modal('show');
        });

        // Simpan data pembimbing baru
        $('#saveButton').click(function(e) {
            e.preventDefault();

            let data = {
                _token: $('meta[name="csrf-token"]').attr('content'),
                nama: $('#namaPembimbing').val(),
                nip: $('#nipPembimbing').val(),
                jurusan: $('#jurusanPembimbing').val(),
                kelas: $('#kelasPembimbing').val(),
                no_hp: $('#nohpPembimbing').val(),
                email: $('#emailPembimbing').val()
            };

            // Validasi form
            if (!data.nama || !data.nip || !data.jurusan || !data.kelas || !data.no_hp || !data.email) {
                alert('Semua field harus diisi!');
                return;
            }

            $.post('/pembimbing/tambah', data, function(response) {
                alert(response.message || 'Data pembimbing berhasil ditambahkan!');
                $('#addModal').modal('hide');
                $('#addForm')[0].reset();
                location.reload();
            }).fail(function(xhr) {
                let errorMessage = 'Terjadi kesalahan: ';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage += xhr.responseJSON.message;
                } else {
                    errorMessage += xhr.responseText;
                }
                alert(errorMessage);
            });
        });

        // Edit pembimbing
        $(document).on('click', '.editButton', function(e) {
            e.preventDefault();
            
            let id = $(this).data('id');
            let nama = $(this).data('nama');
            let nip = $(this).data('nip');
            let jurusan = $(this).data('jurusan');
            let kelas = $(this).data('kelas');
            let email = $(this).data('email');
            let nohp = $(this).data('nohp');

            // Isi form edit dengan data yang ada
            $('#pembimbingId').val(id);
            $('#namaPembimbing_edit').val(nama);
            $('#nipPembimbing_edit').val(nip);
            $('#jurusanPembimbing_edit').val(jurusan);
            $('#kelasPembimbing_edit').val(kelas);
            $('#emailPembimbing_edit').val(email);
            $('#nohpPembimbing_edit').val(nohp);

            $('#editModal').modal('show');
        });

        // Update data pembimbing
        $('#updateButton').click(function(e) {
            e.preventDefault();

            let id = $('#pembimbingId').val();
            let data = {
                _token: $('meta[name="csrf-token"]').attr('content'),
                _method: 'PUT',
                nama: $('#namaPembimbing_edit').val(),
                nip: $('#nipPembimbing_edit').val(),
                jurusan: $('#jurusanPembimbing_edit').val(),
                kelas: $('#kelasPembimbing_edit').val(),
                no_hp: $('#nohpPembimbing_edit').val(),
                email: $('#emailPembimbing_edit').val()
            };

            // Validasi form
            if (!data.nama || !data.nip || !data.jurusan || !data.kelas || !data.no_hp || !data.email) {
                alert('Semua field harus diisi!');
                return;
            }

            $.ajax({
                url: '/pembimbing/update/' + id,
                type: 'POST',
                data: data,
                success: function(response) {
                    alert(response.message || 'Data pembimbing berhasil diupdate!');
                    $('#editModal').modal('hide');
                    location.reload();
                },
                error: function(xhr) {
                    let errorMessage = 'Terjadi kesalahan: ';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage += xhr.responseJSON.message;
                    } else {
                        errorMessage += xhr.responseText;
                    }
                    alert(errorMessage);
                }
            });
        });

        // Hapus pembimbing
        $(document).on('click', '.deleteButton', function(e) {
            e.preventDefault();
            let id = $(this).data('id');

            if (confirm('Apakah Anda yakin ingin menghapus data pembimbing ini?')) {
                $.ajax({
                    url: '/pembimbing/hapus/' + id,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message || 'Data pembimbing berhasil dihapus!');
                        location.reload();
                    },
                    error: function(xhr) {
                        let errorMessage = 'Terjadi kesalahan: ';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage += xhr.responseJSON.message;
                        } else {
                            errorMessage += xhr.responseText;
                        }
                        alert(errorMessage);
                    }
                });
            }
        });
    </script>
</body>
</html>