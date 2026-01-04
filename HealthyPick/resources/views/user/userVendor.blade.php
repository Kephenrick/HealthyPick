@extends('layout.main')

@section('title', __('messages.vendors'))
@section('content')
    <div class="text-center mb-4">
        <h1 class="mb-4">{{ __('messages.food_vendors') }}</h1>
    </div>

    {{-- Vendor card format for loop --}}
    <div class="container">
        <div class="row">
            @forelse($vendors as $vendor)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                    <img src="https://picsum.photos/300/200?random={{ rand() }}" 
                    alt="{{ $vendor->user->name ?? 'Vendor' }}" 
                    class="card-img-top" 
                    style="height: 200px; object-fit: cover;">

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $vendor->user->name ?? 'Vendor' }}</h5>
                            <p class="card-text">
                                <strong>Address:</strong> {{ $vendor->address ?? 'N/A' }}<br>
                            </p>
                            <a href="{{ route('user.userProduct', ['vendor_id' => $vendor->Vendor_ID]) }}" 
                               class="btn btn-outline-secondary w-100 mt-auto">
                                {{ __('messages.products_button') }}
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <p class="mb-0">Tidak ada vendor yang tersedia.</p>
                    </div>
                </div>
            @endforelse
        </div>


        @if($vendors->hasPages())
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        {{-- Previous Page Link --}}
                        @if ($vendors->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $vendors->previousPageUrl() }}" rel="prev">Previous</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($vendors->getUrlRange(1, $vendors->lastPage()) as $page => $url)
                            @if ($page == $vendors->currentPage())
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
                        @if ($vendors->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $vendors->nextPageUrl() }}" rel="next">Next</a>
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
    </div>
@endsection