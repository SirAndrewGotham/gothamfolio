@extends('backend.legacy.layouts.app')

@section('meta-title')
    {{ __('Editing User') }} "{{ $user->name }}"
@endsection

@section('page-title')
    {{ __('Editing User') }} "{{ $user->name }}"
@endsection

@section('breadcrumb-title')
    {{ __('Edit User') }}
@endsection

@section('content')
    <form role="form" action="{{ route('admin.users.update', $user->slug) }}" method="POST">
        @csrf
        @method('PUT')

        @include('backend.legacy.layouts._formErrors')

        <div class="form-group">
            <input type="text" name="name" placeholder="{{ __('Name') }}" value="{{ old('name', $user->name) }}" class="form-control">
        </div>
        <div class="form-group">
            <input type="email" name="email" placeholder="{{ __('Email') }}" value="{{ $user->email }}" class="form-control" disabled="disabled">
            <input type="hidden" name="email" value="{{ $user->email }}">
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="{{ __('Password') }}" class="form-control">
        </div>
        <div class="form-group">
            <input type="password" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" class="form-control">
        </div>
        <button type="submit" class="btn btn-rw btn-primary">{{ __('Submit') }}</button>
    </form>
@endsection
