@extends('layout.dashboard')

@section('title', __('messages.dashboard'))
@section('title-page', 'Overview')
@section('content')
    <div class="row g-3">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6>{{ __('messages.total_products') }}</h6>
                    <p class="fs-3 fw-bold">{{ isset($totalProducts) ? $totalProducts : 0 }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6>{{ __('messages.orders') }}</h6>
                    <p class="fs-3 fw-bold">{{ isset($totalOrders) ? $totalOrders : 0 }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection