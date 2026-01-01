@extends('layout.dashboard')

@section('title', __('messages.add_product'))
@section('title-page', 'Add Product')
@section('content')
    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-secondary text-white text-center">
                        <h3 class="mb-0">{{ __('messages.add_product') }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('messages.name') }}</label>
                                <input
                                    type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                                    placeholder="{{ __('messages.name') }}"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">{{ __('messages.description') }}</label>
                                <input
                                    type="textarea"
                                    class="form-control @error('description') is-invalid @enderror"
                                    id="description"
                                    name="description"
                                    placeholder="{{ __('messages.description') }}"
                                    required>
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
                                    placeholder="{{ __('messages.stock') }}"
                                    required>
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                    <label for="image" class="form-label">image upload</label>
                                    <input 
                                        type="file" 
                                        class="form-control @error('image') is-invalid @enderror" 
                                        id="image" 
                                        placeholder="{{ __('messages.image') }}" 
                                        required>
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            <button type="submit" class="btn btn-secondary w-100">{{ __('messages.login') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection