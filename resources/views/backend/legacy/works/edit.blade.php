@extends('backend.legacy.layouts.app')

@section('styles')
{{--    <link rel="stylesheet" href="{{ asset('assets/backend/legacy/css/bootstrap441/bootstrap.min.css') }}">--}}
    <link href="{{ asset('assets/backend/legacy/css/summernote0818/summernote-bs4.min.css') }}" rel="stylesheet">
@endsection

@section('meta-title')
    {{ __('Editing Work') }} "{{ $work->title }}"
@endsection

@section('page-title')
    {{ __('Editing Work') }} "{{ $work->title }}"
@endsection

@section('breadcrumb-title')
    {{ __('Edit Work') }}
@endsection

@section('content')
    <form role="form" action="{{ route('admin.works.update', $work->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('backend.legacy.layouts._formErrors')

        <div class="form-group">
            <label for="title">{{ __('Title') }}</label>
            <input type="text" name="title" value="{{ old('title', $work->title) }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="slug">{{ __('Slug') }}</label>
            <input type="text" name="slug" id="slug" value="{{ $work->slug }}" class="form-control" disabled="disabled">
        </div>
        <button type="submit" class="btn btn-rw btn-primary">{{ __('Submit') }}</button>
    </form>
@endsection

@section('scripts')

@endsection
