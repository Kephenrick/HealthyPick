<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>@yield('title', 'HealthyPick')</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a href="/" class="navbar-brand">HealthyPick</a>
            <div>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="{{ route('user.userProduct') }}" class="nav-link">Products</a></li>
                    <li class="nav-item"><a href="{{ route('user.userVendor') }}" class="nav-link">Vendors</a></li>
                    <li class="nav-item"><a href="{{ route('user.userTransaction') }}" class="nav-link">History</a></li>
                    <li class="nav-item"><a href="{{ route('user.userAbout') }}" class="nav-link">About Us</a></li>
                    <li class="nav-item"><a href="{{ route('auth.login') }}" class="nav-link">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container my-4">
        @yield('content')
    </div>

    <footer class="bg-light text-center py-3"><p class="mb-0">&copy; {{ date('Y') }} HealthyPick</p></footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>