@extends('backend.legacy.layouts.app')

@section('styles')
{{--    <link rel="stylesheet" href="{{ asset('assets/backend/legacy/css/bootstrap441/bootstrap.min.css') }}">--}}
    <link href="{{ asset('assets/backend/legacy/css/summernote0818/summernote-bs4.min.css') }}" rel="stylesheet">
@endsection

@section('meta-title')
    {{ __('Create a Work') }}
@endsection

@section('page-title')
    {{ __('Create a Work') }}
@endsection

@section('breadcrumb-title')
    {{ __('New Work') }}
@endsection

@section('content')
    <form role="form" action="{{ route('admin.works.store') }}" method="POST" enctype="multipart/form-data">
        {!! csrf_field() !!}

        @include('backend.legacy.layouts._formErrors')

        <div class="form-group">
            <label for="title">{{ __('Title') }}</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="slug">{{ __('Slug') }}</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug') }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="excerpt">{{ __('Excerpt') }}</label>
            <textarea name="excerpt" id="excerpt" cols="30" rows="10" class="form-control summernote">{{ old('excerpt') }}</textarea>
        </div>
        <div class="form-group">
            <label for="content">{{ __('Content') }}</label>
            <textarea name="content" id="content" cols="30" rows="10" class="form-control summernote">{{ old('content') }}</textarea>
        </div>
        <div class="form-group">
            <label for="tags">{{ __('Tags') }}</label>
            <input type="text" name="tags" id="tags" value="{{ old('tags') }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="order">{{ __('Order') }}</label>
            <input type="text" name="order" id="order" value="{{ old('order') }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="image">{{ __('Image') }}</label>
            <input type="file" id="image" name="image">
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
