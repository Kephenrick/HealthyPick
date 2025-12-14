@extends('layout.main')

@section('title', 'HealthyPick')
@section('content')
    <div class="text-center mb-5">
        <h1 class="fw-bold">HealthyPick</h1>
        <p class="text-muted">desc placeholder</p>
        <a href="{{ route('user.userProduct') }}" class="btn btn-primary btn-lg">Order Now</a>
    </div>

    <div class="row text-center">
        <div class="col-md-4">
            <h5>Menu description</h5>
        </div>
        <div class="col-md-4">
            <h5>Fast Delivery</h5>
        </div>
        <div class="col-md-4">
            <h5>easy payment yadi yada</h5>
        </div>
    </div>
@endsection