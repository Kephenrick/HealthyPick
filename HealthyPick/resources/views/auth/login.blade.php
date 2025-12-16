@extends('layout.main')

@section('title', __('messages.login'))
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-secondary text-white text-center">
                        <h3 class="mb-0">{{ __('messages.login') }}</h3>
                    </div>
                    <div class="card-body">
                        {{-- Error Message from Validation --}}
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong><i class="bi bi-exclamation-circle"></i> Gagal Login!</strong>
                                <hr class="my-2">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li class="mt-2"><strong>{{ $error }}</strong></li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        {{-- Error Message from Exception --}}
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong><i class="bi bi-exclamation-circle"></i> Error!</strong>
                                <p class="mb-0 mt-2"><strong>{{ session('error') }}</strong></p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        {{-- Success Message --}}
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong><i class="bi bi-check-circle"></i> Sukses!</strong>
                                <p class="mb-0 mt-2"><strong>{{ session('success') }}</strong></p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        {{-- DEBUG: Cek jika ada errors --}}
                        @php
                            if ($errors->any()) {
                                \Log::info('Login errors:', $errors->messages());
                            }
                        @endphp

                        <form action="{{ route('login.submit') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}"
                                    placeholder="Masukkan email Anda" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Masukkan password Anda" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-secondary w-100">{{ __('messages.login') }}</button>
                        </form>

                        <hr>

                        <p class="text-center mb-0">
                            {{ __('messages.dont_have_account') }}
                            <a href="{{ route('register') }}" class="text-primary fw-bold">{{ __('messages.register_here') }}</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
