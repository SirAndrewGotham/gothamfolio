@extends('backend.legacy.layouts.app')

@section('styles')
    <link href="{{ asset('assets/backend/legacy/css/summernote0818/summernote-bs4.min.css') }}" rel="stylesheet">
@endsection

@section('meta-title')
    {{ __('Create a Post') }}
@endsection

@section('page-title')
    {{ __('Create a Post') }}
@endsection

@section('breadcrumb-title')
    {{ __('New Post') }}
@endsection

@section('content')
    <form role="form" action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('backend.legacy.layouts._formErrors')

        <div class="form-group">
            <label for="Languages">{{ __('Language') }}</label>
            <select class="form-control" id="language" name="language">
                {{-- in case a prompt needed rather then just language --}}
                {{-- <option value="">{{ __('Choose your language') }}</option> --}}
                @foreach($languages as $language)
                    <option value="{{ $language->code }}" {{ app()->getLocale() == $language->code ? 'selected' : '' }}>
                        {{ $language->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="title">{{ __('Title') }}</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="excerpt">{{ __('Excerpt') }}</label>
            <textarea name="excerpt" id="excerpt" cols="30" rows="10" class="form-control summernote">{{ old('excerpt') }}</textarea>
        </div>
        <div class="form-group">
            <label for="body">{{ __('Body') }}</label>
            <textarea name="body" id="body" cols="30" rows="10" class="form-control summernote">{{ old('body') }}</textarea>
        </div>
        <div class="form-group">
            <label for="tags">{{ __('Tags') }}</label>
            <input type="text" name="tags" id="tags" value="{{ old('tags') }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="image">{{ __('Image') }}</label>
            <input type="file" name="image" id="image">
        </div>
        <div class="form-group">
            <label for="published_at">{{ __('Publication date') }}</label>
            <input type="datetime-local" name="published_at" class="form-control"
                   value="{{-- date_format(date_create($productInovoice->date), 'd/m/Y')) --}}">

            {{--            <input type="text" name="tags" id="tags" value="{{ old('tags') }}" class="form-control">--}}
        </div>        <button type="submit" class="btn btn-rw btn-primary">{{ __('Submit') }}</button>
    </form>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            $('.summernote_excerpt').summernote();
            $('.summernote_body').summernote();

        });
    </script>
@endsection
