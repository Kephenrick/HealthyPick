@extends('layout.main')

@section('title', __('messages.products'))
@section('content')
    <div class="text-center mb-4">
        <h1 class="mb-4">{{ __('messages.menu') }}</h1>
    </div>

    {{-- Product card format for loop --}}
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-4 mb-3">
            @foreach ($products as $product)
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ asset('img/' . $product->Image) }}" alt="{{ $product->Name }}" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->Name }}</h5>
                            <p class="card-text">{{ $product->Description }}</p>
                            <p class="fw-bold">Rp {{ number_format($product->Price, 0, ',', '.') }}</p>
                            <a href="#" class="btn btn-success w-100">Purchase</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection