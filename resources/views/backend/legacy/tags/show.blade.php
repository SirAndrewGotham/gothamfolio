@extends('backend.legacy.layouts.app')

@section('meta-title')
    {{ __('Tag') }} "{{ $tag->name }}"
@stop

@section('page-title')
    {{ __('Tag') }} "{{ $tag->name }}"
@stop

@section('breadcrumb-title')
    {{ __('Tag Details') }}
@stop

@section('content')
    <section class="mt40 mb40">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="blog-post mb40">
                        <div class="blog-post-holder">
                            <h1>{{ $tag->name }}</h1>
                            <h2>{{ $tag->slug }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
