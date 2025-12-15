@extends('layout.main')

@section('title', 'Dashboard')
@section('content')
    <div class="container mt-5">
        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Selamat Datang, {{ Auth::user()->name }}!</h3>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-light btn-sm">Logout</button>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Data Profil Anda</h5>
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Nama:</strong></td>
                                        <td>{{ Auth::user()->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email:</strong></td>
                                        <td>{{ Auth::user()->email }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Nomor Telepon:</strong></td>
                                        <td>{{ Auth::user()->phone_number ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Terdaftar:</strong></td>
                                        <td>{{ Auth::user()->created_at->format('d M Y') }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h5 class="card-title">Info Keamanan</h5>
                                        <p class="card-text">Akun Anda dilindungi dengan enkripsi password tingkat tinggi.</p>
                                        <a href="#" class="btn btn-sm btn-primary">Ubah Password</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
