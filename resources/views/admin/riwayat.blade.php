@extends('admin.layout.admin_layout')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row mb-3">
                <!-- Judul -->
                <div class="col-12">
                    <h3>Riwayat absen</h3>
                    <p class="text-subtitle text-muted">Memperlihatkan riwayat absensi seluruh siswa yang sedang melaksanakan
                        magang.</p>
                </div>

                <!-- Breadcrumb kanan -->
                <div class="col-12 d-flex justify-content-md-end justify-content-start align-items-center">
                    <nav aria-label="breadcrumb" class="breadcrumb-header">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboardpt') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Riwayat</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <section class="section">
                <div class="row" id="basic-table">
                    <div class="col-12 align-kiri"> {{-- Perbaikan di sini --}}
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Riwayat Kehadiran Siswa</h4>
                            </div>
                            <div class="card-body">
                                {{-- Filter Bulan & Tahun --}}
                                <p class="text-muted mb-3">Pilih bulan dan tahun untuk melihat riwayat absensi siswa.</p>
                                <form method="GET" action="{{ route('riwayat.index') }}">
                                    <div class="row mb-4">
                                        @php
                                            $daftarBulan = [
                                                '01' => 'Januari',
                                                '02' => 'Februari',
                                                '03' => 'Maret',
                                                '04' => 'April',
                                                '05' => 'Mei',
                                                '06' => 'Juni',
                                                '07' => 'Juli',
                                                '08' => 'Agustus',
                                                '09' => 'September',
                                                '10' => 'Oktober',
                                                '11' => 'November',
                                                '12' => 'Desember',
                                            ];
                                        @endphp

                                        <div class="col-md-4 mb-2">
                                            <select class="form-select" name="bulan" id="bulan" required>
                                                <option value="">Pilih Bulan</option>
                                                @foreach ($daftarBulan as $val => $nama)
                                                    <option value="{{ $val }}"
                                                        {{ request('bulan') == $val ? 'selected' : '' }}>
                                                        {{ $nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4 mb-2">
                                            <select class="form-select" name="tahun" id="tahun" required>
                                                <option value="">Pilih Tahun</option>
                                                @for ($i = date('Y'); $i <= date('Y') + 5; $i++)
                                                    <option value="{{ $i }}"
                                                        {{ request('tahun') == $i ? 'selected' : '' }}>
                                                        {{ $i }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>

                                        <div class="col-md-4 mb-2">
                                            <button class="btn btn-primary w-100" type="submit">Cari Data</button>
                                        </div>
                                    </div>
                                </form>

                                <div class="card p-3">
                                    <table class="table table-bordered table-striped">
                                        <thead class="table-dark text-center">
                                            <tr>
                                                <th>Nama</th>
                                                <th>Tanggal</th>
                                                <th>Status</th>
                                                <th>Keterangan</th>
                                                <th>Jam Masuk</th>
                                                <th>Jam Keluar</th>
                                                <th>Pulang Awal</th>
                                                <th>Perusahaan</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center" id="absensiBody">
                                            @forelse ($riwayat as $absen)
                                                <tr>
                                                    <td>{{ $absen->pengguna->nama ?? '-' }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($absen->tanggal)->format('d-m-Y') }}</td>
                                                    <td>{{ $absen->status ?? '-' }}</td>
                                                    <td>{{ $absen->keterangan ?? '-' }}</td>
                                                    <td>{{ $absen->absen_masuk ?? '-' }}</td>
                                                    <td>{{ $absen->absen_pulang ?? '-' }}</td>
                                                    <td>{{ $absen->pulang_awal ? 'Ya' : '-' }}</td>
                                                    <td>{{ $absen->pengguna->pengajuan->perusahaan->nama ?? '-' }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8">Belum ada data absensi.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endsection
