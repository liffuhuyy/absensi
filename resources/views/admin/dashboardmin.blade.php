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
                                @if (isset($jumlahAbsensi))
                                    <h6 class="font-extrabold mb-0">{{ $jumlahAbsensi }}</h6>
                                @else
                                    <h6 class="font-extrabold mb-0">0</h6>
                                @endif
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
                                <h6 class="font-extrabold mb-0">30</h6>
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
                                <h6 class="font-extrabold mb-0">15</h6>
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
                                <h6 class="text-muted font-semibold" style="font-size: 0.60rem;">Tanpa Keterangan</h6>
                                <h6 class="font-extrabold mb-0">5</h6>
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
                                        <h4 class="font-extrabold mb-0" style="font-size: 2rem;">380</h4>
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
                                        <h4 class="font-extrabold mb-0" style="font-size: 2rem;">100</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tambahan item lain bisa disisipkan di sini -->
                </div>
            </div>
        </section>
    </div>
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
    </div>
    </div>
    </section>
    </div>
    </div>
@endsection
