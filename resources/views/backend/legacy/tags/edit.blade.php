@extends('backend.legacy.layouts.app')

@section('meta-title')
    {{ __('Editing Tag') }} "{{ $tag->name }}"
@endsection

@section('page-title')
    {{ __('Editing Tag') }} "{{ $tag->name }}"
@endsection

@section('breadcrumb-title')
    {{ __('Edit Tag') }}
@endsection

@section('content')
    <form role="form" action="{{ route('admin.tags.update', $tag->id) }}" method="POST">
        {!! csrf_field() !!}
        <input type="hidden" name="_method" value="PUT">

        @include('backend.legacy.layouts._formErrors')

        <div class="form-group">
            <input type="text" name="name" value="{{ old('name', $tag->name) }}" placeholder="{{ __('Name') }}" class="form-control">
        </div>
        <div class="form-group">
            <input type="text" name="slug" value="{{ $tag->slug }}" placeholder="{{ __('Slug') }}" class="form-control" disabled="disabled">
            <input type="hidden" name="slug" value="{{ $tag->slug }}">
        </div>
        <button type="submit" class="btn btn-rw btn-primary">{{ __('Submit') }}</button>
    </form>
@endsection
