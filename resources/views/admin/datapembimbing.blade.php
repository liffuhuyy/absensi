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
    @include('admin.layout.sidebar')
    @include('admin.layout.header')

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
                            <li class="breadcrumb-item"><a href="{{ url('/dashboardmin') }}">Dashboard</a>
                            </li>
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
                                    <option value="DKV">Desain Komunikasi Visual</option>
                                    <option value="MPLB">Otomatisasi dan Tata Kelola Perkantoran</option>
                                    <option value="AKL">Akuntansi dan Keuangan Lembaga</option>
                                    <option value="TL">Teknik Logistik</option>
                                    <option value="BDP">Bisnis Daring dan Pemasaran</option>
                                    <option value="KL">Kuliner</option>
                                    <option value="TPM">Teknik Pemesinan</option>
                                    <option value="TO">Teknik Otomotif</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>Kelas Bimbingan</label>
                                <input type="text" id="kelasPembimbing" class="form-control"
                                    placeholder="Contoh: XII RPL 1" required>
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
                                    <option value="DKV">Desain Komunikasi Visual</option>
                                    <option value="MPLB">Otomatisasi dan Tata Kelola Perkantoran</option>
                                    <option value="AKL">Akuntansi dan Keuangan Lembaga</option>
                                    <option value="TL">Teknik Logistik</option>
                                    <option value="BDP">Bisnis Daring dan Pemasaran</option>
                                    <option value="KL">Kuliner</option>
                                    <option value="TPM">Teknik Pemesinan</option>
                                    <option value="TO">Teknik Otomotif</option>
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
                                <input type="text" id="searchBox" class="form-control form-control-sm"
                                    placeholder="Cari berdasarkan nama...">
                            </div>
                        </div>
                        <a href="#" class="btn btn-sm btn-outline-primary ms-2" id="openAddModal">Tambah
                            Pembimbing</a>
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
                                                    data-id="{{ $user->id }}" data-nama="{{ $user->nama }}"
                                                    data-nip="{{ $user->nip }}"
                                                    data-jurusan="{{ $user->jurusan }}"
                                                    data-kelas="{{ $user->kelas }}"
                                                    data-email="{{ $user->email }}"
                                                    data-nohp="{{ $user->no_hp }}">Edit</a>
                                                <a href="#" class="btn btn-sm btn-danger deleteButton"
                                                    data-id="{{ $user->id }}">Hapus</a>
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
        @include('admin.layout.footer')

        <script src="assets/static/js/components/dark.js"></script>
        <script src="assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="assets/extensions/jquery/jquery.min.js"></script>
        <script src="assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
        <script src="assets/static/js/pages/datatables.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="assets/static/js/initTheme.js"></script>

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
