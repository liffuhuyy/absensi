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
            <h3>Notifikasi</h3>
        </div>
<<<<<<< HEAD
    </div>
    <div class="sidebar-menu">
      <ul class="menu">
            <li class="sidebar-title">Menu</li>
            
            <li
            class="sidebar-item">
            <a href="{{ url('/dashboardmin') }}" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li
        class="sidebar-item">
        <a href="{{ url('/ringkasanabsen') }}" class='sidebar-link'>
            <i class="bi bi-journal-check"></i>
            <span>Ringkasan Absen</span>
        </a>
    </li>
<li
    class="sidebar-item">
    <a href="{{ url('/pengguna') }}" class='sidebar-link'>
        <i class="bi bi-journal-check"></i>
        <span>Data Pengguna</span>
    </a>
</li>
<li
    class="sidebar-item">
    <a href="{{ url('/datapembimbing') }}" class='sidebar-link'>
        <i class="bi bi-journal-check"></i>
        <span>Data Pembimbing</span>
    </a>
</li>
    <li
    class="sidebar-item">
    <a href="{{ url('/notif') }}" class='sidebar-link'>
        <i class="bi bi-bell"></i>
        <span>Notifikasi</span>
    </a>
    </li>
        <li
        class="sidebar-item">
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
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Notifikasi</title>
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
        <h3>Notifikasi</h3>
    </div>
<div class="container mt-4">
    @if(isset($notifikasi) && $notifikasi->isNotEmpty())
        <div class="row">
            @foreach($notifikasi as $notif)
                <div class="col-md-6">
                    <div class="card shadow-sm mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $notif->name }}</h5>
                            <h6 class="card-subtitle text-muted">{{ $notif->email }}</h6>
                            <p class="card-text">{{ $notif->message }}</p>
                            <small class="text-muted">{{ $notif->created_at->diffForHumans() }}</small>                        
                            <form action="{{ route('notifikasi.destroy', $notif->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
=======
        <div class="container mt-4">
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
>>>>>>> d7390f319b47b889a80ef08f85da0dc72aacab79
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center">Belum ada notifikasi.</p>
            @endif
        </div>
        <br>
    @endsection
