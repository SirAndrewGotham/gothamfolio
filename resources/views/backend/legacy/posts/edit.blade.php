@extends('backend.legacy.layouts.app')

@section('styles')
    <link href="{{ asset('assets/backend/legacy/css/summernote0818/summernote-bs4.min.css') }}" rel="stylesheet">
@endsection

@section('meta-title')
    {{ __('Editing Post') }} "{{ $post->title }}"
@endsection

@section('page-title')
    {{ __('Editing Post') }} "{{ $post->title }}"
@endsection

@section('breadcrumb-title')
    {{ __('Edit Post') }}
@endsection

@section('content')
    <form role="form" action="{{ route('admin.posts.update', $post->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('backend.legacy.layouts._formErrors')

        <div class="form-group">
            <label for="title">{{ __('Title') }}</label>
            <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="slug">{{ __('Slug') }}</label>
            <input type="text" name="slug" id="slug" value="{{ $post->slug }}" class="form-control" disabled="disabled">
        </div>
        <button type="submit" class="btn btn-rw btn-primary">{{ __('Submit') }}</button>
    </form>
@endsection

@section('scripts')

@endsection
