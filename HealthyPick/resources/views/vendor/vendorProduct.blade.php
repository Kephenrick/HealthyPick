@extends('layout.dashboard')

@section('title', __('messages.manage_products'))
@section('page-title', __('messages.manage_products'))
@section('content')
    <div class="mb-3 text-end">
        <a href="{{ route('vendor.vendorAdd') }}" class="btn btn-primary">{{ __('messages.add_product') }}</a>
    </div>

    <table class="table table-striped table-bordered table-dark">
        <thead>
            <tr>
                <th>{{ __('messages.name') }}</th>
                <th>{{ __('messages.description') }}</th>
                <th>{{ __('messages.price') }}</th>
                <th>{{ __('messages.stock') }}</th>
                <th>{{ __('messages.action') }}</th>
            </tr>
        </thead>
        <tbody>
            {{-- loop here --}}
            <tr class="align-middle">
                <td>
                    name
                    <img src="https://picsum.photos/200/200" alt="" class="img-fluid d-block">
                </td>
                <td>description</td>
                <td>money</td>
                <td>123</td>
                <td>
                    <a href="" class="btn btn-sm btn-warning">edit</a>
                    <a href="" class="btn btn-sm btn-danger">delete</a>
                </td>
            </tr>
        </tbody>
    </table>
@endsection