<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>@yield('title', 'HealthyPick')</title>
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a href="/" class="navbar-brand">HealthyPick</a>
            <div>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="{{ route('user.userProduct') }}" class="nav-link">{{ __('messages.products') }}</a></li>
                    <li class="nav-item"><a href="{{ route('user.userVendor') }}" class="nav-link">{{ __('messages.vendors') }}</a></li>
                    <li class="nav-item"><a href="{{ route('user.userTransaction') }}" class="nav-link">{{ __('messages.history') }}</a></li>
                    <li class="nav-item"><a href="{{ route('user.userAbout') }}" class="nav-link">{{ __('messages.about') }}</a></li>
                    <li class="nav-item"><a href="{{ route('auth.login') }}" class="nav-link">{{ __('messages.login') }}</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    @if (session('success'))
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <main class="container my-4 flex-grow-1">
        @yield('content')
    </main>

    <footer class="bg-light text-center py-3 mt-auto">
        <p class="mb-0">{{ __('messages.copyright', ['year' => date('Y')]) }}</p>

        <div class="text-decoration-underline">
            <a href="{{ route('lang.switch', 'en') }}" class="nav-link text-decoration-underline">EN</a>
            <a href="{{ route('lang.switch', 'id') }}" class="nav-link text-decoration-underline">ID</a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>