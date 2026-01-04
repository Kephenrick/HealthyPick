@extends('layout.dashboard')

@section('title', isset($product) ? __('messages.edit_product') : __('messages.add_product'))
@section('title-page', isset($product) ? __('messages.edit_product') : __('messages.add_product'))
@section('content')
    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="mb-0">{{ isset($product) ? __('messages.edit_product') : __('messages.add_product') }}</h3>
                    </div>
                    <div class="card-body">
                        @if(isset($product))
                            <form action="{{ route('vendor.vendorUpdate', $product->Product_ID) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                        @else
                            <form action="{{ route('vendor.vendorAdd.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                        @endif
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('messages.name') }}</label>
                                <input
                                    type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    id="name"
                                    name="name"
                                    value="{{ old('name', isset($product) ? $product->Name : '') }}"
                                    placeholder="{{ __('messages.name') }}"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">{{ __('messages.description') }}</label>
                                <textarea
                                    class="form-control @error('description') is-invalid @enderror"
                                    id="description"
                                    name="description"
                                    placeholder="{{ __('messages.description') }}">{{ old('description', isset($product) ? $product->Description : '') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">{{ __('messages.price') }}</label>
                                <input
                                    type="number"
                                    class="form-control @error('price') is-invalid @enderror"
                                    id="price"
                                    name="price"
                                    value="{{ old('price', isset($product) ? $product->Price : '') }}"
                                    placeholder="{{ __('messages.price') }}"
                                    required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="stock" class="form-label">{{ __('messages.stock') }}</label>
                                <input
                                    type="number"
                                    class="form-control @error('stock') is-invalid @enderror"
                                    id="stock"
                                    name="stock"
                                    value="{{ old('stock', isset($product) ? $product->Stock : 0) }}"
                                    placeholder="{{ __('messages.stock') }}"
                                    required>
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">{{ __('messages.image') }}</label>
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            @if(isset($product) && $product->Image)
                                <div class="mb-3">
                                    <label class="form-label">Current Image</label>
                                    <div>
                                        <img src="{{ asset('img/' . $product->Image) }}" alt="{{ $product->Name }}" style="max-width:150px;">
                                    </div>
                                </div>
                            @endif

                            <button type="submit" class="btn btn-primary w-100">{{ isset($product) ? __('messages.edit') : __('messages.add_product') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection