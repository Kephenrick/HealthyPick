@extends('layout.main')

@section('title', __('messages.dashboard'))
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
                        <h3 class="mb-0">{{ __('messages.welcome_user', ['name' => Auth::user()->name]) }}</h3>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-light btn-sm">{{ __('messages.logout') }}</button>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>{{ __('messages.profile_data') }}</h5>
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>{{ __('messages.name_label') }}</strong></td>
                                        <td>{{ Auth::user()->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('messages.email_label') }}</strong></td>
                                        <td>{{ Auth::user()->email }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('messages.phone_label') }}</strong></td>
                                        <td>{{ Auth::user()->phone ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('messages.registered_label') }}</strong></td>
                                        <td>{{ Auth::user()->created_at->format('d M Y') }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ __('messages.password_protected') }}</h5>
                                        <p class="card-text">{{ __('messages.password_protected') }}</p>
                                        <a href="#" class="btn btn-sm btn-primary">{{ __('messages.change_password') }}</a>
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
