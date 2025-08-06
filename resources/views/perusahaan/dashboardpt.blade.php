<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Perusahaan Dashboard</title>
    <link rel="shortcut icon" href="./assets/compiled/svg/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon"
        href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC"
        type="image/png">
    <link rel="stylesheet" href="./assets/compiled/css/app.css">
    <link rel="stylesheet" href="./assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="./assets/compiled/css/iconly.css">
</head>

<body>
    @include('perusahaan.layout.header')
    @include('perusahaan.layout.sidebar')
    <div class="page-heading">
        <h3>Dashboard Perusahaan</h3>
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

                    <!-- Terlambat -->
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="stats-icon warning mb-2">
                                    <i class="iconly-boldTime-Circle"></i>
                                </div>
                                <h6 class="text-muted font-semibold">Terlambat</h6>
                                <h6 class="font-extrabold mb-0">{{ $jumlahTerlambat ?? 0 }}</h6>
                            </div>
                        </div>
                    </div>

                    <!-- Total Siswa -->
                    <div class="col-6 col-md-3 col-lg-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row align-items-center">
                                    <div class="col-4 d-flex justify-content-start">
                                        <div class="stats-icon purple mb-2" style="font-size: 2rem;">
                                            <i class="bi bi-people-fill"></i> {{-- Icon pengguna --}}
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <h6 class="text-muted font-semibold">Total Peserta Magang Aktif</h6>
                                        <h4 class="font-extrabold mb-0" style="font-size: 2rem;">{{ $totalSiswa }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3 col-lg-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row align-items-center">
                                    <div class="col-4 d-flex justify-content-start">
                                        <div class="stats-icon purple mb-2" style="font-size: 2rem;">
                                            <i class="iconly-boldShow"></i> {{-- Sama seperti ikon sebelumnya --}}
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <h6 class="text-muted font-semibold">Pesert Magang Menunggu</h6>
                                        <h4 class="font-extrabold mb-0" style="font-size: 2rem;">
                                            {{ $totalSiswaMenunggu }}</h4>
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
                <h4>Grafik Kehadiran Bulanan</h4>
            </div>
            <div class="card-body">
                <div id="grafikKehadiranBulanan"></div>
            </div>
        </div>
    </div>
    @include('admin.layout.footer')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var options = {
                chart: {
                    type: 'bar',
                    height: 400
                },
                series: [{
                        name: 'Hadir',
                        data: @json(array_column($dataGrafik, 'hadir'))
                    },
                    {
                        name: 'Terlambat',
                        data: @json(array_column($dataGrafik, 'terlambat'))
                    },
                    {
                        name: 'Izin',
                        data: @json(array_column($dataGrafik, 'izin'))
                    },
                    {
                        name: 'Sakit',
                        data: @json(array_column($dataGrafik, 'sakit'))
                    }
                ],
                colors: ['#2ecc71', '#e74c3c', '#3498db',
                    '#f1c40f'
                ], // Warna untuk Hadir, Terlambat, Izin, Sakit
                xaxis: {
                    categories: @json($bulanLabels)
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '50%'
                    }
                },
                dataLabels: {
                    enabled: true
                },
                legend: {
                    position: 'top'
                }
            };

            var chart = new ApexCharts(document.querySelector("#grafikKehadiranBulanan"), options);
            chart.render();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="assets/static/js/initTheme.js"></script>
    <script src="assets/static/js/components/dark.js"></script>
    <script src="assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/compiled/js/app.js"></script>
    <!-- Need: Apexcharts -->
    <script src="assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="assets/static/js/pages/dashboard.js"></script>
</body>

</html>
