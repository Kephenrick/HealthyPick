<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>@yield('title', 'Dashboard')</title>
</head>
<body>
    <div class="d-flex">
        <aside class="bg-dark text-white p-3" style="width: 260px; min-height: 100vh">
            <h4 class="mb-4">Panel</h4>
            <ul class="nav flex-column gap-1">
                <li class="nav-item">
                    <a href="{{ route('vendor.vendorHome') }}" class="nav-link text-white">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('vendor.vendorProduct') }}" class="nav-link text-white">Product</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('vendor.vendorTransaction') }}" class="nav-link text-white">Transaction</a>
                </li>
                <li class="nav-item mt-3">
                    <form method="POST" action="">
                        @csrf
                        <button class="btn btn-outline-danger w-100">Logout</button>
                    </form>
                </li>
            </ul>
        </aside>
    </div>

    <main class="flex-fill p-4">
        <div class="mb-4">
            @yield('title-page')
        </div>

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>