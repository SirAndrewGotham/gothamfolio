@extends('backend.legacy.layouts.app')

@section('meta-title')
{{ __('Language') }} "{{ $language->name }}"
@endsection

@section('page-title')
    {{ __('Language') }} "{{ $language->name }}"
@endsection

@section('breadcrumb-title')
    {{ __('Language') }}
@endsection

@section('content')
    <section class="mt40 mb40">
        <div class="container-fluid">
            <div class="row">
                <svg class="col-sm-12">
{{--                    <div class="blog-post mb40">--}}
{{--                        <img class="img-responsive full-width" src="{{ $language->image }}" alt="">--}}
{{--                        <div class="blog-post-holder">--}}
{{--                            <ul class="list-inline posted-info">--}}
{{--                                <li>{{ $language->created_at->diffForHumans() }}</li>--}}
{{--                            </ul>--}}
{{--                            <hr align="left" class="mt15 mb10">--}}
{{--                            <h2>{{ $language->title }}</h2>--}}
{{--                            {!! $language->content !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    @if(file_exists(public_path('assets/flags/'.$language->code.'.svg')))
                        <svg width="64px" height="64px">
                            {!! file_get_contents(public_path('assets/flags/'.$language->code.'.svg')) !!}
                        </svg>
                    @else
                        No flag for the language
                    @endif
                    <p>Name: {{ $language->name }}</p>
                    <p>English: {{ $language->english }}</p>
                    <p>Available: {{ $language->is_available }}</p>
                    <p>Active: {{ $language->is_active }}</p>
                    <p>Default: {{ $language->is_default }}</p>
                    <p>Fallback: {{ $language->fallback }}</p>
                    <p>Language code: {{ $language->fallback }}</p>
                    <p>Regional code: {{ $language->fallback }}</p>
                    <p>Script: {{ $language->fallback }}</p>
                    <p>Writing direction: {{ $language->fallback }}</p>
                </div>
            </div>
        </div>
    </section>
@endsection
