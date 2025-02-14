@extends('backend.legacy.layouts.app')

@section('meta-title')
    {{ __('Create a User') }}
@endsection

@section('page-title')
    {{ __('Create a User') }}
@endsection

@section('breadcrumb-title')
    {{ __('New User') }}
@endsection

@section('content')
    <form role="form" action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        @include('backend.legacy.layouts._formErrors')

        <div class="form-group">
            <input type="text" name="name" placeholder="{{ __('Name') }}" value="{{ old('name') }}" class="form-control">
        </div>
        <div class="form-group">
            <input type="email" name="email" placeholder="{{ __('Emai') }}l" value="{{ old('email') }}" class="form-control">
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
