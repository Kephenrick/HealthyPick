@extends('layout.main')

@section('title', __('messages.about'))
@section('content')
    <div class="text-center px-5 py-5 mb-4">
        <h1 class="mb-3">{{ __('messages.about_title') }}</h1>
        <p>
            {{ __('messages.about_paragraph') }}
        </p>
    </div>

    <div class="row text-center mt-4">
        <div class="col-md-6">
            <h2>{{ __('messages.vision_title') }}</h2>
            <p>
                {{ __('messages.vision_text') }}
            </p>
        </div>
        <div class="col-md-6">
            <h2>{{ __('messages.mission_title') }}</h2>
            <p>
                {{ __('messages.mission_text') }}
            </p>
        </div>
    </div>
@endsection