@extends('backend.legacy.layouts.app')

@section('styles')
{{--    <link rel="stylesheet" href="{{ asset('assets/backend/legacy/css/bootstrap441/bootstrap.min.css') }}">--}}
    <link href="{{ asset('assets/backend/legacy/css/summernote0818/summernote-bs4.min.css') }}" rel="stylesheet">
@endsection

@section('meta-title')
    {{ __('Translate Post into new language') }}: "{{ $postTranslation->title }}"
@endsection

@section('page-title')
    {{ __('Translate Post into new language') }}: "{{ $postTranslation->title }}"
@endsection

@section('breadcrumb-title')
    {{ __('Translate Post') }}
@endsection

@section('content')
    @unless($languages->count() > 0)
        <section class="mt40 mb40">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="post-translation mb40">
                            <p>
                                {{ __('You\'ve got translations for all of your available languages already.') }}
                            </p>
                            <p>
                                {{ __('If you want to add a translation in another language, please enable corresponding language in your available languages configuration first.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <form role="form" action="{{ route('admin.postTranslations.store', $postTranslation->post) }}" method="POST" enctype="multipart/form-data">
            @csrf
    {{--        @method('PUT')--}}

            @include('backend.legacy.layouts._formErrors')

            <input name="post_id" type="hidden" value="{{ Crypt::encrypt($postTranslation->post->id) }}">

            <div class="form-group">
                <label for="title">{{ __('Translating from') }}: {{ $postTranslation->language->name }}</label>
            </div>

            <div class="form-group">
                <label for="Languages">{{ __('Choose your translation language') }}</label>
                <select class="form-control" id="language" name="language">
                    {{-- in case a prompt needed rather then just language --}}
    {{--                <option value="selected">{{ __('Choose your language') }}</option>--}}
                    @foreach($languages as $language)
                        <option value="{{ $language->code }}" {{ app()->getLocale() == $language->code ? 'selected' : '' }}>
                            {{ $language->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="title">{{ __('Title') }}</label>
                <input type="text" name="title" value="{{ old('title', $postTranslation->title) }}" class="form-control">
            </div>
    {{--        <div class="form-group">--}}
    {{--            <label for="slug">{{ __('Slug') }}</label>--}}
    {{--            <input type="text" name="slug" id="slug" value="{{ $postTranslation->slug }}" class="form-control" disabled="disabled">--}}
    {{--        </div>--}}
            <div class="form-group">
                <label for="excerpt">{{ __('Excerpt') }}</label>
                <textarea name="excerpt" id="excerpt" cols="30" rows="10" class="form-control summernote">{{ old('excerpt', $postTranslation->excerpt) }}</textarea>
            </div>
            <div class="form-group">
                <label for="body">{{ __('Content') }}</label>
                <textarea name="body" id="body" cols="30" rows="10" class="form-control summernote">{{ old('body', $postTranslation->body) }}</textarea>
            </div>
            <div class="form-group">
                <label for="tags">{{ __('Tags') }}</label>
                <input type="text" name="tags" id="tags" value="{{ old('tags', $postTranslation->tags->implode('name', ',')) }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="order">{{ __('Order') }}</label>
                <input type="text" name="order" id="order" value="{{ $postTranslation->order }}" class="form-control">
            </div>
            <div class="form-group">
                <div>
                    @if ($postTranslation->image)
                        <img src="{{ asset($postTranslation->image) }}" alt="" height="100">
                    @endif
                </div>
                <label for="image">{{ __('Image') }}</label>
                <input type="file" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-rw btn-primary">{{ __('Submit') }}</button>
        </form>
    @endunless
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            $('.summernote_excerpt'').summernote();
            $('.summernote_body').summernote();

        });
    </script>
@endsection
