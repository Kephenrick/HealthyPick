@extends('layout.main')

@section('title', __('messages.products'))
@section('content')
    <div class="text-center mb-4">
        <h1 class="mb-4">{{ __('messages.menu') }}</h1>
        @if(isset($vendor))
            <p class="text-muted">Produk dari: <strong>{{ $vendor->user->name ?? 'Vendor' }}</strong></p>
            <a href="{{ route('user.userProduct') }}" class="btn btn-sm btn-outline-secondary">Lihat Semua Produk</a>
        @endif
    </div>

    {{-- Search Bar --}}
    <div class="container mb-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('user.userProduct') }}" method="GET" class="d-flex">
                    <input type="text" 
                           name="search" 
                           class="form-control me-2" 
                           placeholder="Cari produk..." 
                           value="{{ request('search') }}">
                    <button type="submit" class="btn btn-outline-primary">Search</button>
                    @if(request('search') || request('vendor_id'))
                        <a href="{{ route('user.userProduct') }}" class="btn btn-outline-secondary ms-2">Clear</a>
                    @endif
                    @if(request('vendor_id'))
                        <input type="hidden" name="vendor_id" value="{{ request('vendor_id') }}">
                    @endif
                </form>
            </div>
        </div>
    </div>

    {{-- Success/Error Messages --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session('error') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Product card format for loop --}}
    <div class="row d-flex justify-content-center align-items-center">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('img/' . $product->Image) }}" alt="{{ $product->Name }}" class="card-img-top" style="height: 250px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->Name }}</h5>
                        <p class="card-text">{{ $product->Description }}</p>
                        <p class="fw-bold">Rp {{ number_format($product->Price, 0, ',', '.') }}</p>
                        <p class="fw-bold">Stocks: {{ $product->Stock }}</p>
                        
                        @if($product->Stock > 0)
                            <form action="{{ route('user.product.purchase', $product->Product_ID) }}" method="POST" class="mt-auto">
                                @csrf
                                <div class="d-flex align-items-center justify-content-center mb-3">
                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="decreaseQuantity('{{ $product->Product_ID }}', {{ $product->Stock }})">-</button>
                                    <input type="number" 
                                           id="quantity_{{ $product->Product_ID }}" 
                                           name="quantity" 
                                           value="1" 
                                           min="1" 
                                           max="{{ $product->Stock }}" 
                                           class="form-control text-center mx-2" 
                                           style="width: 80px;"
                                           readonly>
                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="increaseQuantity('{{ $product->Product_ID }}', {{ $product->Stock }})">+</button>
                                </div>
                                <button type="submit" class="btn btn-success w-100">Buy</button>
                            </form>
                        @else
                            <button class="btn btn-secondary w-100" disabled>Out of Stock</button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <script>
        function increaseQuantity(productId, maxStock) {
            const input = document.getElementById('quantity_' + productId);
            let currentValue = parseInt(input.value);
            if (currentValue < maxStock) {
                input.value = currentValue + 1;
            }
        }

        function decreaseQuantity(productId, maxStock) {
            const input = document.getElementById('quantity_' + productId);
            let currentValue = parseInt(input.value);
            if (currentValue > 1) {
                input.value = currentValue - 1;
            }
        }
    </script>

    {{-- Pagination Bootstrap 5.2 --}}
    @if($products->hasPages())
        <div class="d-flex justify-content-center mt-4">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($products->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link">Previous</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $products->previousPageUrl() }}" rel="prev">Previous</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                        @if ($page == $products->currentPage())
                            <li class="page-item active" aria-current="page">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($products->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $products->nextPageUrl() }}" rel="next">Next</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link">Next</span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    @endif
@endsection