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
        <div class="form-group">
            <label for="excerpt">{{ __('Excerpt') }}</label>
            <textarea name="excerpt" id="excerpt" cols="30" rows="10" class="form-control summernote">{{ old('excerpt', $work->excerpt) }}</textarea>
        </div>
        <div class="form-group">
            <label for="content">{{ __('Content') }}</label>
            <textarea name="content" id="content" cols="30" rows="10" class="form-control summernote">{{ old('content', $work->content) }}</textarea>
        </div>
        <div class="form-group">
            <label for="tags">{{ __('Tags') }}</label>
            <input type="text" name="tags" id="tags" value="{{ old('tags', $work->tags->implode('name', ',')) }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="order">{{ __('Order') }}</label>
            <input type="text" name="order" id="order" value="{{ $work->order }}" class="form-control">
        </div>
        <div class="form-group">
            <div>
                @if ($work->image)
                    <img src="{{ asset($work->image) }}" alt="" height="100">
                @endif
            </div>
            <label for="image">{{ __('Image') }}</label>
            <input type="file" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-rw btn-primary">{{ __('Submit') }}</button>
    </form>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            $('.summernote_excerpt'').summernote();
            $('.summernote_content').summernote();

        });
    </script>
@endsection
