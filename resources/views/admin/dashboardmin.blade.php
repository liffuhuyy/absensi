@extends('admin.layout.admin_layout')
@section('content')
    <div class="page-heading">
        <h3>Dashboard</h3>
    </div>

    <div class="page-content">
        <section class="row">
            <!-- Kolom Kanan (Full Lebar) -->
            <div class="col-12">
                <div class="row">
                    <!-- Hadir -->
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="stats-icon blue mb-2">
                                    <i class="iconly-boldTick-Square"></i>
                                </div>
                                <h6 class="text-muted">Hadir</h6>
                                <h6 class="font-extrabold mb-0">{{ $jumlahHadir ?? 0 }}</h6>
                            </div>
                        </div>
                    </div>

                    <!-- Izin -->
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="stats-icon orange mb-2">
                                    <i class="iconly-boldShield-Done"></i>
                                </div>
                                <h6 class="text-muted font-semibold">Izin</h6>
                                <h6 class="font-extrabold mb-0">{{ $jumlahIzin ?? 0 }}</h6>
                            </div>
                        </div>
                    </div>

                    <!-- Sakit -->
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="stats-icon red mb-2">
                                    <i class="iconly-boldClose-Square"></i>
                                </div>
                                <h6 class="text-muted font-semibold">Sakit</h6>
                                <h6 class="font-extrabold mb-0">{{ $jumlahSakit ?? 0 }}</h6>
                            </div>
                        </div>
                    </div>

                    <!-- Tanpa Keterangan -->
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="stats-icon dark mb-2">
                                    <i class="iconly-boldDanger"></i>
                                </div>
                                <h6 class="text-muted font-semibold" style="font-size: 0.60rem;">Tanpa
                                    Keterangan</h6>
                                <h6 class="font-extrabold mb-0">{{ $jumlahTanpaKeterangan ?? 0 }}</h6>
                            </div>
                        </div>
                    </div>

                    <!-- Total Siswa -->
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row align-items-center">
                                    <div class="col-4 d-flex justify-content-start">
                                        <div class="stats-icon purple mb-2" style="font-size: 2rem;">
                                            <i class="iconly-boldShow"></i>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <h6 class="text-muted font-semibold">Total Siswa</h6>
                                        <h4 class="font-extrabold mb-0" style="font-size: 2rem;">{{ $totalSiswa ?? 0 }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Perusahaan Partner -->
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row align-items-center">
                                    <div class="col-4 d-flex justify-content-start">
                                        <div class="stats-icon blue mb-2" style="font-size: 2rem;">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <h6 class="text-muted font-semibold">Perusahaan Partner</h6>
                                        <h4 class="font-extrabold mb-0" style="font-size: 2rem;">{{ $totalPerusahaan ?? 0 }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Grafik Kehadiran Mingguan -->
        <section class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Grafik Kehadiran Mingguan</h4>
                    </div>
                    <div class="card-body">
                        <div id="chart-profile-visit"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Tabel Ringkasan Absen Terbaru -->
        <section class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Ringkasan Absen Terbaru</h4>
                        <a href="{{ route('admin.absen.export') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-download"></i> Export
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Nama Siswa</th>
                                        <th>NIM</th>
                                        <th>Perusahaan</th>
                                        <th>Status</th>
                                        <th>Jam Masuk</th>
                                        <th>Jam Pulang</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($ringkasanAbsen as $absen)
                                        <tr>
                                            <td>{{ $absen->tanggal_absen->format('d/m/Y') }}</td>
                                            <td>{{ $absen->nama_siswa }}</td>
                                            <td>{{ $absen->nim_siswa }}</td>
                                            <td>{{ $absen->nama_perusahaan }}</td>
                                            <td>
                                                @switch($absen->status_kehadiran)
                                                    @case('hadir')
                                                        <span class="badge bg-success">Hadir</span>
                                                    @break

                                                    @case('izin')
                                                        <span class="badge bg-warning">Izin</span>
                                                    @break

                                                    @case('sakit')
                                                        <span class="badge bg-danger">Sakit</span>
                                                    @break

                                                    @case('tanpa_keterangan')
                                                        <span class="badge bg-dark">Tanpa Keterangan</span>
                                                    @break
                                                @endswitch
                                            </td>
                                            <td>{{ $absen->jam_masuk ? $absen->jam_masuk->format('H:i') : '-' }}</td>
                                            <td>{{ $absen->jam_pulang ? $absen->jam_pulang->format('H:i') : '-' }}</td>
                                            <td>{{ $absen->keterangan ?? '-' }}</td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">Belum ada data absen</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            @if ($ringkasanAbsen->hasPages())
                                <div class="d-flex justify-content-center">
                                    {{ $ringkasanAbsen->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        </div>

        @push('scripts')
            <script>
                // Data untuk grafik kehadiran mingguan
                const grafikData = @json($grafikMingguan ?? []);

                // Script untuk chart (sesuaikan dengan library chart yang Anda gunakan)
                // Contoh menggunakan Chart.js atau ApexCharts
                if (grafikData.length > 0) {
                    // Implementasi chart di sini
                    console.log('Data grafik:', grafikData);
                }
            </script>
        @endpush
    @endsection
