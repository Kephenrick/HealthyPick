@extends('layout.dashboard')

@section('title', __('messages.sales_history'))
@section('title-page', __('messages.sales_history'))
@section('content')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>{{ __('messages.customer') }}</th>
                <th>{{ __('messages.product') }}</th>
                <th>{{ __('messages.stock') }}</th>
                <th>{{ __('messages.status') }}</th>
            </tr>
        </thead>
        <tbody>
            {{-- loop here --}}
            <tr>
                <td>Customer name here</td>
                <td>product here</td>
                <td>123</td>
                <td><span class="badge bg-success">{{ __('messages.active') }}</span></td>
            </tr>
        </tbody>
    </table>
@endsection