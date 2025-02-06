@extends('backend.legacy.layouts.app')

@section('meta-title')
    {{ __('Customer') }} "{{ $customer->label }}"
@endsection

@section('page-title')
    {{ __('Customer') }} "{{ $customer->label }}"
@endsection

@section('breadcrumb-title')
    {{ __('Customer') }}
@endsection

@section('content')
    <section class="mt40 mb40">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="blog-post mb40">
                        <img class="img-responsive full-width" src="{{ $customer->image }}" alt="">
                        <div class="blog-post-holder">
                            <hr align="left" class="mt15 mb10">
                            <h2>{{ $customer->label }}</h2>
                            {!! $customer->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
