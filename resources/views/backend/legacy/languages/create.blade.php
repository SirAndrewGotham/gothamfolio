@extends('backend.legacy.layouts.app')

@section('meta-title')
    {{ __('Create a Language') }}
@endsection

@section('page-title')
    {{ __('Create a Language') }}
@endsection

@section('breadcrumb-title')
    {{ __('New Language') }}
@endsection

@section('content')
    <form role="form" action="{{ route('admin.languages.store') }}" method="POST">
        @csrf

        @include('backend.legacy.layouts._formErrors')

        <div class="form-group">
            <label for="name">{{ __('Language Name') }}</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="code">{{ __('Language Code (e.g., en)') }}</label>
            <input type="text" name="code" id="code" value="{{ old('code') }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="english">{{ __('English Name (e.g., English)') }}</label>
            <input type="text" name="english" id="english" value="{{ old('english') }}" class="form-control">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" name="default" id="default" value="1" class="form-check-input" {{ old('default') ? 'checked' : '' }}>
            <label class="form-check-label" for="default">{{ __('Set as Default Language') }}</label>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" name="is_active" id="is_active" value="1" class="form-check-input" {{ old('is_active', true) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">{{ __('Is Active') }}</label>
        </div>

        <button type="submit" class="btn btn-rw btn-primary">{{ __('Submit') }}</button>
    </form>
@endsection
