@extends('siswa.layout.siswa_layout')
@section('content')
    <div class="container">
        <div class="welcome-card">
            <h3 class="welcome-title">Selamat Datang!</h3>
            <p class="welcome-subtitle">Selamat datang di portal siswa SMK NEGERI 1 SUBANG. Silahkan lengkapi biodata Anda
                dan ajukan program magang untuk memulai perjalanan pendidikan Anda.</p>
            <div class="action-buttons">
                <a href="{{ url('/biodata') }}" class="btn btn-primary">Lengkapi Biodata</a>
                <a href="{{ url('/magang') }}" class="btn btn-secondary">Ajukan Magang</a>
            </div>
        </div>

        <div class="stats-card">
            <div class="stat-item">
                <div>
                    <a href="{{ url('/manajementugas') }}" class="stat-icon">📚</a>
                </div>
                <div class="stat-value">
                    @php
                        use Illuminate\Support\Facades\Auth;

                        $pengguna = Auth::user();
                        $jumlahTugas = \App\Models\Tugas::where('pengguna_id', $pengguna->id)->count();
                        $jumlahNilai = \App\Models\Penilaian::where('pengguna_id', $pengguna->id)
                            ->whereNotNull('nama')
                            ->where('nama', '!=', '')
                            ->count();
                    @endphp
                    Tugas: {{ $jumlahTugas }}
                </div>
            </div>

            <div class="stat-item">
                <div class="stat-icon">
                    <a href="{{ url('/penilaian') }}" class="stat-icon">📋</a>
                </div>
                <div class="stat-value">
                    Penilaian: {{ $jumlahNilai }}
                </div>
            </div>


            <div class="view-more-container">
                <a href="{{ url('/manajementugas') }}" class="btn btn-primary">Lihat Selengkapnya</a>
            </div>
        </div>
    </div>
@endsection
