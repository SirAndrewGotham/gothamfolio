@extends('backend.legacy.layouts.app')

@section('meta-title')
    {{ __('Create a Customer') }}
@stop

@section('page-title')
    {{ __('Create a Customer') }}
@stop

@section('breadcrumb-title')
    {{ __('New Customer') }}
@stop

@section('content')
    <form role="form" action="{{ route('admin.customers.store') }}" method="POST" enctype="multipart/form-data">
        {!! csrf_field() !!}

        @include('backend.legacy.layouts._formErrors')

        <div class="form-group">
            <input type="text" name="label" value="{{ old('label') }}" placeholder="{{ __('Label') }}" class="form-control">
        </div>
        <div class="form-group">
            <textarea class="form-control summernote" name="description" placeholder="{{ __('Description') }}" cols="30" rows="10">{{ old('description') }}</textarea>
        </div>
        <div class="form-group">
            <label for="image">{{ __('Image') }}</label>
            <input type="file" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-rw btn-primary">{{ __('Submit') }}</button>
    </form>
@stop
