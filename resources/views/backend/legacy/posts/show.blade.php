@extends('backend.legacy.layouts.app')

@section('meta-title')
    {{ __('Post') }} "{{ $post->title }}"
@endsection

@section('page-title')
    {{ __('Post') }} "{{ $post->title }}"
@endsection

@section('breadcrumb-title')
    {{ __('Post') }}
@endsection

@section('content')
    <section class="mt40 mb40">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="blog-post mb40">
                        <img class="img-responsive full-width" src="{{ $post->image }}" alt="">
                        <div class="blog-post-holder">
                            <ul class="list-inline posted-info">
                                <li>{{ __('By') }} <a href="#">{{ $post->user->name }}</a></li>
                                <li>{{ $post->created_at->diffForHumans() }}</li>
                            </ul>
                            <hr align="left" class="mt15 mb10">
                            <h2>{{ $post->title }}</h2>
                            {!! $post->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
