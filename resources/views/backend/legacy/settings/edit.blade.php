@extends('backend.legacy.layouts.app')

@section('meta-title')
    {{ __('Edit Settings') }}
@endsection

@section('page-title')
    {{ __('Edit Settings') }}
@endsection

@section('breadcrumb-title')
    {{ __('Edit Settings') }}
@endsection

@section('content')
    <form role="form" action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        @method('PUT')

        @include('backend.legacy.layouts._formErrors')

        <h1>TODO TODO TODO</h1>

        <button type="submit" class="btn btn-rw btn-primary">{{ __('Submit') }}</button>
    </form>
@endsection
