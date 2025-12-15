@extends('layout.main')

@section('title', 'Products')
@section('content')
    <div class="text-center mb-4">
        <h1 class="mb-4">Menu</h1>
        <p>lorem ipsum or smth</p>
    </div>

    {{-- Product card format for loop --}}
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <img src="https://picsum.photos/300/200" alt="" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Name</h5>
                    <p class="card-text">description</p>
                    <p class="fw-bold">price tag</p>
                    <a href="#" class="btn btn-success w-100">Purchase</a>
                </div>
            </div>
        </div>
    </div>
@endsection