<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Perusahaan</title>
    <link rel="shortcut icon" href="./assets/compiled/svg/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon"
        href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC"
        type="image/png">
    <link rel="stylesheet" href="assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="./assets/compiled/css/table-datatable-jquery.css">
    <link rel="stylesheet" href="./assets/compiled/css/app.css">
    <link rel="stylesheet" href="./assets/compiled/css/app-dark.css">
</head>
<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);

    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 600px;
        border-radius: 10px;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .container {
        margin-top: 20px;
    }

    .card {
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
    }

    .logo-preview {
        width: 100px;
        height: 100px;
        background: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #ccc;
    }

    .btn-black {
        background: black;
        color: white;
    }
</style>

<body>
    <script src="assets/static/js/initTheme.js"></script>
    @include('perusahaan.layout.sidebar')
    @include('perusahaan.layout.header')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Profil Perusahaan</h3>
                    <p class="text-subtitle text-muted">Lengkapi Profil Perusahaan Anda Sekarang Juga!</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboardpt') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profil Perusahaan</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <!-- Form Tambah Perusahaan -->
            <div class="container mt-">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3">Tambah Perusahaan</h5>
                        <form id="formTambahPerusahaan" method="POST" action="{{ route('perusahaan.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Nama Perusahaan</label>
                                <input type="text" name="nama_perusahaan" class="form-control"
                                    placeholder="Masukkan Nama Perusahaan" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <input type="text" name="alamat" class="form-control" placeholder="Masukkan Alamat"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Masukkan Email"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nomor Telepon</label>
                                <input type="text" name="telepon" class="form-control"
                                    placeholder="Masukkan Nomor Telepon" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Logo Perusahaan</label>
                                <input type="file" name="logo" accept="image/*">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Deskripsi Perusahaan</label>
                                <textarea name="deskripsi" class="form-control" placeholder="Masukkan Deskripsi Perusahaan"></textarea>
                            </div>

                            <button type="submit" class="btn btn-success w-100">Simpan Data</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Edit Perusahaan -->
            <div id="modalEditPerusahaan" class="modal" style="display: none;">
                <div class="modal-content">
                    <span class="close" onclick="tutupModalEdit()"
                        style="position: absolute; right: 15px; top: 10px; cursor: pointer;">&times;</span>
                    <br>
                    <h2>Edit Perusahaan</h2>

                    <form id="formEditPerusahaan" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editId" name="id">

                        <div class="mb-3">
                            <label class="form-label">Nama Perusahaan</label>
                            <input type="text" id="editNamaPerusahaan" name="nama_perusahaan" class="form-control"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <input type="text" id="editAlamat" name="alamat" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" id="editEmail" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="text" id="editTelepon" name="telepon" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Logo Perusahaan</label>
                            <input type="file" id="editLogo" name="logo" accept="image/*">
                            <img id="editLogoPreview" width="100">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi Perusahaan</label>
                            <textarea id="editDeskripsi" name="deskripsi" class="form-control" placeholder="Masukkan Deskripsi Perusahaan"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
                    </form>
                </div>
            </div>

            <div class="container mt-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3">Data Perusahaan</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama Perusahaan</th>
                                    <th>Alamat</th>
                                    <th>Email</th>
                                    <th>Telepon</th>
                                    <th>Logo</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($perusahaan as $data)
                                    <tr>
                                        <td>{{ $data->nama_perusahaan }}</td>
                                        <td>{{ $data->alamat }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->telepon }}</td>
                                        <td>
                                            @if ($data->logo)
                                                <img src="{{ asset('storage/' . $data->logo) }}" width="50">
                                            @else
                                                <img src="{{ asset('images/default-logo.png') }}" width="50">
                                            @endif
                                        </td>
                                        <td>{{ $data->deskripsi }}</td>
                                        <td>
                                            <button class="btn btn-warning btn-sm"
                                                onclick="bukaModalEdit({{ $data->id }})">Edit</button>
                                            <form action="{{ route('perusahaan.destroy', $data->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @include('admin.layout.footer')
            <script src="assets/static/js/components/dark.js"></script>
            <script src="assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
            <script src="assets/compiled/js/app.js"></script>
            <script src="assets/extensions/jquery/jquery.min.js"></script>
            <script src="assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
            <script src="assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
            <script src="assets/static/js/pages/datatables.js"></script>
</body>
<script>
    document.getElementById("editLogo").addEventListener("change", function(event) {
        let file = event.target.files[0]; // Ambil file yang dipilih

        if (file) {
            let reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById("editLogoPreview").src = e.target.result;
                document.getElementById("editLogoPreview").style.display =
                    "block"; // Pastikan gambar terlihat
            };
            reader.readAsDataURL(file); // Baca file dan tampilkan sebagai gambar
        }
    });

    // Menampilkan data di tabel
    function loadPerusahaan() {
        $.ajax({
            type: "GET",
            url: "/perusahaan",
            success: function(data) {
                if (!Array.isArray(data)) {
                    console.error("Data yang diterima bukan array:", data);
                    return;
                }

                let tableBody = "";
                data.forEach(function(perusahaan) {
                    const logoUrl = perusahaan.logo ? `/storage/${perusahaan.logo}` :
                        "/images/default-logo.png";
                    tableBody += `
                    <tr>
                        <td>${perusahaan.nama_perusahaan}</td>
                        <td>${perusahaan.alamat}</td>
                        <td>${perusahaan.email}</td>
                        <td>${perusahaan.telepon}</td>
                        <td><img src="${logoUrl}" width="50"></td>
                        <td>${perusahaan.deskripsi}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="bukaModalEdit(${perusahaan.id})">Edit</button>
                            <button class="btn btn-danger btn-sm" onclick="hapusPerusahaan(${perusahaan.id})">Hapus</button>
                        </td>
                    </tr>`;
                });

                $("#tablePerusahaan tbody").html(tableBody);
            },
            error: function(xhr) {
                console.error("Gagal memuat data perusahaan:", xhr.responseText);
                alert("Gagal memuat data perusahaan.");
            }
        });
    }

    // Panggil saat halaman dimuat
    $(document).ready(function() {
        loadPerusahaan();
    });

    // Simpan data perusahaan baru
    $("#formTambahPerusahaan").submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "/perusahaan",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
            },
            success: function(response) {
                alert(response.message || "Data perusahaan berhasil disimpan.");
                $("#formTambahPerusahaan")[0].reset();
                location.reload(); // Refresh halaman setelah menyimpan
            },
            error: function(xhr) {
                console.error("Error saat menyimpan:", xhr.responseText);
                alert(xhr.responseJSON?.message || "Gagal menyimpan data perusahaan.");
            }
        });
    });

    // Tampilkan form edit perusahaan
    function bukaModalEdit(id) {
        $.ajax({
            type: "GET",
            url: `/perusahaan/${id}`,
            success: function(data) {
                if (!data || data.error) {
                    alert("Data perusahaan tidak ditemukan!");
                    return;
                }

                $("#editId").val(data.id);
                $("#editNamaPerusahaan").val(data.nama_perusahaan);
                $("#editAlamat").val(data.alamat);
                $("#editEmail").val(data.email);
                $("#editTelepon").val(data.telepon);
                $("#editDeskripsi").val(data.deskripsi);
                const logoUrl = data.logo ? `/storage/${data.logo}` : "/images/default-logo.png";
                $("#editLogoPreview").attr("src", logoUrl);
                $("#modalEditPerusahaan").fadeIn();
            },
            error: function(xhr) {
                console.error("Gagal mengambil data:", xhr.responseText);
                alert("Gagal mengambil data perusahaan.");
            }
        });
    }

    function tutupModalEdit() {
        $("#modalEditPerusahaan").fadeOut();
    }

    // Update data perusahaan
    $("#formEditPerusahaan").submit(function(e) {
        e.preventDefault();
        let id = $("#editId").val();
        let formData = new FormData(this);

        formData.append('_method', 'PUT'); // Simulasikan PUT via POST

        $.ajax({
            type: "POST",
            url: `/perusahaan/${id}`,
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
            },
            success: function(response) {
                alert(response.message || "Data perusahaan berhasil diperbarui.");
                location.reload(); // Refresh halaman setelah update
            },
            error: function(xhr) {
                console.error("Error saat update:", xhr.responseText);
                alert(xhr.responseJSON?.message || "Gagal memperbarui data perusahaan.");
            }
        });
    });

    // Hapus perusahaan
    function hapusPerusahaan(id) {
        if (!confirm("Apakah Anda yakin ingin menghapus perusahaan ini?")) return;

        $.ajax({
            type: "POST",
            url: `/perusahaan/${id}`,
            data: {
                _method: "DELETE",
                _token: $('meta[name="csrf-token"]').attr("content")
            },
            success: function(response) {
                alert(response.message || "Data perusahaan berhasil dihapus.");
                location.reload(); // Refresh halaman setelah hapus
            },
            error: function(xhr) {
                console.error("Error saat menghapus:", xhr.responseText);
                alert("Gagal menghapus data perusahaan.");
            }
        });
    }
</script>

</html>
