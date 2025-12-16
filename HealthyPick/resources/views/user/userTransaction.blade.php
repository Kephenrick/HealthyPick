@extends('layout.main')

@section('title', __('messages.history'))
@section('content')
    <div class="px-4 py-4 mb-5">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>{{ __('messages.product') }}</th>
                    <th>{{ __('messages.price') }}</th>
                    <th>{{ __('messages.status') }}</th>
                </tr>
            </thead>
            <tbody>
                {{-- loop here --}}
                <tr>
                    <td>product here</td>
                    <td>123</td>
                    <td><span class="badge bg-success">{{ __('messages.active') }}</span></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection