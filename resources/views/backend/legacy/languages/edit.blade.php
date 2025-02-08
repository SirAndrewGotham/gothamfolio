@extends('backend.legacy.layouts.app')

@section('meta-title')
    {{ __('Editing Language') }} "{{ $language->name }}"
@endsection

@section('page-title')
    {{ __('Editing Language') }} "{{ $language->name }}"
@endsection

@section('breadcrumb-title')
    {{ __('Edit Language') }}
@endsection

@section('content')
    Work in progress, not ready yet.
{{--    <form role="form" action="{{ route('admin.languages.update', $language->slug) }}" method="POST" enctype="multipart/form-data">--}}
{{--        {!! csrf_field() !!}--}}
{{--        <input type="hidden" name="_method" value="PUT">--}}

{{--        @include('backend.legacy.layouts._formErrors')--}}

{{--        <div class="form-group">--}}
{{--            <label for="title">{{ __('Title') }}</label>--}}
{{--            <input type="text" name="title" value="{{ old('title', $language->title) }}" class="form-control">--}}
{{--        </div>--}}
{{--        <div class="form-group">--}}
{{--            <label for="slug">{{ __('Slug') }}</label>--}}
{{--            <input type="text" name="slug" id="slug" value="{{ $language->slug }}" class="form-control" disabled="disabled">--}}
{{--        </div>--}}
{{--        <div class="form-group">--}}
{{--            <label for="excerpt">{{ __('Excerpt') }}</label>--}}
{{--            <textarea name="excerpt" id="excerpt" cols="30" rows="10" class="form-control summernote">{{ old('excerpt', $language->excerpt) }}</textarea>--}}
{{--        </div>--}}
{{--        <div class="form-group">--}}
{{--            <label for="content">{{ __('Content') }}</label>--}}
{{--            <textarea name="content" id="content" cols="30" rows="10" class="form-control summernote">{{ old('content', $language->content) }}</textarea>--}}
{{--        </div>--}}
{{--        <div class="form-group">--}}
{{--            <label for="tags">{{ __('Tags') }}</label>--}}
{{--            <input type="text" name="tags" id="tags" value="{{ old('tags', $language->tags->implode('name', ',')) }}" class="form-control">--}}
{{--        </div>--}}
{{--        <div class="form-group">--}}
{{--            <div>--}}
{{--                @if ($language->image)--}}
{{--                    <img src="{{ asset($language->image) }}" alt="" height="100">--}}
{{--                @endif--}}
{{--            </div>--}}
{{--            <label for="image">{{ __('Image') }}</label>--}}
{{--            <input type="file" id="image" name="image">--}}
{{--        </div>--}}
{{--        <button type="submit" class="btn btn-rw btn-primary">{{ __('Submit') }}</button>--}}
{{--    </form>--}}
@endsection
