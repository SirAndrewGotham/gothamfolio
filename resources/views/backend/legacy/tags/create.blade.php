@extends('backend.legacy.layouts.app')

@section('meta-title')
    {{ __('Create a Tag') }}
@stop

@section('page-title')
    {{ __('Create a Tag') }}
@stop

@section('breadcrumb-title')
    {{ __('New Tag') }}
@stop

@section('content')
    <form role="form" action="{{ route('admin.tags.store') }}" method="POST">
        {!! csrf_field() !!}

        @include('backend.legacy.layouts._formErrors')

        <div class="form-group">
            <input type="text" name="name" value="{{ old('name') }}" placeholder="{{ __('Name') }}" class="form-control">
        </div>
        <div class="form-group">
            <input type="text" name="slug" value="{{ old('slug') }}" placeholder="{{ __('Slug') }}" class="form-control">
        </div>
        <button type="submit" class="btn btn-rw btn-primary">{{ __('Submit') }}</button>
    </form>
@stop
