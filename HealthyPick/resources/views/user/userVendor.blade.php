@extends('layout.main')

@section('title', 'Vendors')
@section('content')
    <h1 class="mb-4">Food Vendors</h1>
    <p>lorem ipsum or smth</p>

    {{-- Vendor card format for loop --}}
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Name</h5>
                    <p class="card-text">description</p>
                    <a href="#" class="btn btn-outline-primary">products?</a>
                </div>
            </div>
        </div>
    </div>
@endsection