@extends('backend.legacy.layouts.app')

@section('meta-title')
{{ __('Work') }} "{{ $work->title }}"
@endsection

@section('page-title')
    {{ __('Work') }} "{{ $work->title }}"
@endsection

@section('breadcrumb-title')
    {{ __('Work') }}
@endsection

@section('content')
    <section class="mt40 mb40">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="blog-post mb40">
                        {{dd($work->image)}}
                        <img class="img-responsive full-width" src="{{ $work->image }}" alt="">
                        <div class="blog-post-holder">
                            <ul class="list-inline posted-info">
                                <li>By <a href="#">{{ $work->user->name }}</a></li>
                                <li>{{ $work->created_at->diffForHumans() }}</li>
                            </ul>
                            <hr align="left" class="mt15 mb10">
                            <h2>{{ $work->title }}</h2>
                            {!! $work->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
