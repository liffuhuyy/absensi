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
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center">Belum ada notifikasi.</p>
            @endif
        </div>
        <br>
    @endsection
