@extends('layout.dashboard')

@section('title', 'Dashboard')
@section('title-page', 'Overview')
@section('content')
    <div class="row g-3">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6>Total Products</h6>
                    <p class="fs-3 fw-bold">number here</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6>Bought or smth?</h6>
                    <p class="fs-3 fw-bold">number here</p>
                </div>
            </div>
        </div>
    </div>
@endsection