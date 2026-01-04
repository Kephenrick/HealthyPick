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
            @forelse($products as $product)
                <tr>
                    <td>{{ $product->Name }}</td>
                    <td>{{ $product->Description }}</td>
                    <td>Rp {{ number_format($product->Price, 0, ',', '.') }}</td>
                    <td>{{ $product->Stock }}</td>
                    <td>
                        <a href="{{ route('vendor.vendorEdit', $product->Product_ID) }}" class="btn btn-sm btn-warning">{{ __('messages.edit') }}</a>

                        <form action="{{ route('vendor.vendorDelete', $product->Product_ID) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">{{ __('messages.delete') }}</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada produk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection