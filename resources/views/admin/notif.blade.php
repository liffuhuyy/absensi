@extends('admin.layout.admin_layout')
@section('content')
    <style>
        .button {
            background: #1b2a49;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .button:hover {
            background: #162035;
        }
    </style>
    </head>

    <body>
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Notifikasi</h3>
                        <p class="text-subtitle text-muted">Notif dari pengajuan tentang para siswa yang mengalami kendala.
                        </p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/dashboardmin') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Notifikasi</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            @if (isset($notifikasi) && $notifikasi->isNotEmpty())
                <div class="row">
                    @foreach ($notifikasi as $notif)
                        <div class="col-md-6">
                            <div class="card shadow-sm mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $notif->name }}</h5>
                                    <h6 class="card-subtitle text-muted">{{ $notif->email }}</h6>
                                    <p class="card-text">{{ $notif->message }}</p>
                                    <small class="text-muted">{{ $notif->created_at->diffForHumans() }}</small>
                                    <form action="{{ route('notifikasi.destroy', $notif->id) }}" method="POST"
                                        class="mt-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center">Belum ada notifikasi.</p>
            @endif
            <br>
        @endsection
