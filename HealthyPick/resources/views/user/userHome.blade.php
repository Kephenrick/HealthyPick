@extends('layout.main')

@section('title', __('messages.hero_title'))
@section('content')
    <div class="hero text-center px-5 py-5 my-5">
        <h1 class="fw-bold">{{ __('messages.hero_title') }}</h1>
        <p class="text-muted">
            {{ __('messages.hero_subtitle') }}
        </p>
        <a href="{{ route('user.userProduct') }}" class="btn btn-secondary btn-lg">{{ __('messages.order_now') }}</a>
    </div>

    <div class="row text-center">
        <div class="col-md-4">
            <h2>{{ __('messages.healthy_options') }}</h2>
        </div>
        <div class="col-md-4">
            <h2>{{ __('messages.fast_delivery') }}</h2>
        </div>
        <div class="col-md-4">
            <h2>{{ __('messages.easy_payment') }}</h2>
        </div>
    </div>
@endsection