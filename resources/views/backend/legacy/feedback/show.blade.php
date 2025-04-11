@extends('backend.legacy.layouts.app')

@section('meta-title')
    {{ __('Feedback message') }}
@endsection

@section('page-title')
    {{ __('Feedback message') }}
@endsection

@section('breadcrumb-title')
    {{ __('Feedback message') }}
@endsection

@section('content')
    <section class="mt40 mb40">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="feedback mb40">
{{--                        <img class="img-responsive full-width" src="{{ $post->image }}" alt="">--}}
                        <div class="feedback-holder">
                            <ul class="list-inline posted-info">
                                <li>{{ __('By') }} {{ $feedback->name }}</li>
                                <li>{{ $feedback->email }}</a></li>
                                <li>{{ $feedback->created_at }} ({{ $feedback->created_at->diffForHumans() }})</li>
                            </ul>
                            <hr align="left" class="mt15 mb10">
                            {!! $feedback->message !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
