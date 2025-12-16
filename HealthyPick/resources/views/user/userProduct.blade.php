@extends('layout.main')

@section('title', __('messages.products'))
@section('content')
    <div class="text-center mb-4">
        <h1 class="mb-4">{{ __('messages.menu') }}</h1>
    </div>

    {{-- Product card format for loop --}}
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <img src="https://picsum.photos/300/200" alt="" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">{{ __('messages.name') }}</h5>
                    <p class="card-text">{{ __('messages.description') }}</p>
                    <p class="fw-bold">{{ __('messages.price') }}</p>
                    <a href="#" class="btn btn-success w-100">{{ __('messages.purchase') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection