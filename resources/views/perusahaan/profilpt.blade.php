<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    // Menampilkan daftar semua perusahaan
    public function index()
    {
        $perusahaan = Perusahaan::all();
        return view('perusahaan.index', compact('perusahaan'));
    }

    // Menampilkan form tambah data
    public function create()
    {
        return view('perusahaan.create');
    }

<<<<<<< HEAD
=======
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
                    <p class="text-subtitle text-muted">Lengkapi biodata dari perusahaan.</p>
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
                        <h5 class="mb-3">Tambah data Perusahaan</h5>
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

>>>>>>> 037f74dcf11eaf6f1fa54ebb5b6298b7a1c6f796
    // Simpan data perusahaan baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:perusahaan,email',
            'telepon' => 'required|string',
            'deskripsi' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $logoPath = $request->hasFile('logo') ? $request->file('logo')->store('logos', 'public') : null;

        Perusahaan::create([
            'pengguna_id' => Auth::id(),
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'deskripsi' => $request->deskripsi,
            'logo' => $logoPath,
        ]);

        return redirect()->route('perusahaan.index')->with('success', 'Data perusahaan berhasil disimpan!');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        return view('perusahaan.edit', compact('perusahaan'));
    }

    // Update data perusahaan
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:perusahaan,email,' . $id,
            'telepon' => 'required|string',
            'deskripsi' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $perusahaan = Perusahaan::findOrFail($id);
        $logoPath = $request->hasFile('logo') ? $request->file('logo')->store('logos', 'public') : $perusahaan->logo;

        $perusahaan->update([
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'deskripsi' => $request->deskripsi,
            'logo' => $logoPath,
        ]);

        return redirect()->route('perusahaan.index')->with('success', 'Data perusahaan berhasil diperbarui!');
    }

    // Hapus perusahaan
    public function destroy($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        $perusahaan->delete();

        return redirect()->route('perusahaan.index')->with('success', 'Data perusahaan berhasil dihapus!');
    }

    // Tampilkan data perusahaan untuk detail AJAX
    public function show($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        return response()->json($perusahaan);
    }

    // Tampilkan profil perusahaan milik user login
    public function profilpt()
    {
        $perusahaan = Perusahaan::where('pengguna_id', Auth::id())->first();

        // Tambahkan pengecekan agar tidak error saat $perusahaan null
        if (!$perusahaan) {
            return redirect()->route('perusahaan.create')->with('warning', 'Silakan lengkapi data perusahaan Anda terlebih dahulu.');
        }

        return view('perusahaan.profilpt', compact('perusahaan'));
    }
}
