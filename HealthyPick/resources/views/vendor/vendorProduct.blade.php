@extends('layout.dashboard')

@section('title', 'Manage Product')
@section('page-title', 'Manage Products')
@section('content')
    <div class="mb-3 text-end">
        <a href="" class="btn btn-primary">Add Product</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            {{-- loop here --}}
            <tr>
                <td>Food</td>
                <td>money</td>
                <td><span class="badge bg-success">Active</span></td>
                <td>
                    <a href="" class="btn btn-sm btn-warning">Edit</a>
                    <a href="" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
        </tbody>
    </table>
@endsection