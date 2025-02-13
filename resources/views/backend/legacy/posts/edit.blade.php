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
        {!! csrf_field() !!}
        <input type="hidden" name="_method" value="PUT">

        @include('backend.legacy.layouts._formErrors')

        <div class="form-group">
            <label for="title">{{ __('Title') }}</label>
            <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="slug">{{ __('Slug') }}</label>
            <input type="text" name="slug" id="slug" value="{{ $post->slug }}" class="form-control" disabled="disabled">
        </div>
        <div class="form-group">
            <label for="excerpt">{{ __('Excerpt') }}</label>
            <textarea name="excerpt" id="excerpt" cols="30" rows="10" class="form-control summernote">{{ old('excerpt', $post->excerpt) }}</textarea>
        </div>
        <div class="form-group">
            <label for="content">{{ __('Content') }}</label>
            <textarea name="content" id="content" cols="30" rows="10" class="form-control summernote">{{ old('content', $post->content) }}</textarea>
        </div>
        <div class="form-group">
            <label for="tags">{{ __('Tags') }}</label>
            <input type="text" name="tags" id="tags" value="{{ old('tags', $post->tags->implode('name', ',')) }}" class="form-control">
        </div>
        <div class="form-group">
            <div>
                @if ($post->image)
                    <img src="{{ asset($post->image) }}" alt="" height="100">
                @endif
            </div>
            <label for="image">{{ __('Image') }}</label>
            <input type="file" name="image" id="image">
        </div>
        <button type="submit" class="btn btn-rw btn-primary">{{ __('Submit') }}</button>
    </form>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            $('.summernote_excerpt').summernote();
            $('.summernote_content').summernote();

        });
    </script>
@endsection
