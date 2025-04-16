@extends('frontend.legacy.layouts.app')

@section('content')
    @include('frontend.legacy.layouts._headerPage', ['pageName' => trans('app.frontend.galleries.show.page-title', ['gallery_title' => $gallery->title]), 'pageNameBreadcrumb' => trans('app.frontend.galleries.show.breadcrumb-title')])

    <!-- Project Details -->
    <section class="mt40 mb40">
        <div class="container">
            <div class="row text-center">
                <p class="lead mb30">{{ $gallery->title }}</p>
                <img class="img-thumbnail" src="{{ asset('uploads/galleries/'.$gallery->id.'/'.$gallery->image) }}" alt="{{ $gallery->title }}">
                <div class="row mt40">
                    {{ __('Technologies used') }}:
                    @foreach($gallery->tags as $tag)
                        <span class="label label-info">{{ $tag->name }}</span>
                    @endforeach
                </div>
            </div>

            <div class="row mt40">
                {!! $gallery->body !!}
            </div>
        </div>
    </section>
    <!-- /Project Details -->

    <!-- Recent Gallery -->
    <section class="pt40 mb40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="heading mb30">
                        <h4>{{ trans('app.frontend.galleries.show.recent-gallery') }}</h4>
                        <div class="owl-controls">
                            <div id="customNav" class="owl-nav"></div>
                        </div>
                    </div>
                    @include('frontend.legacy.layouts._lastGalleries', ['galleries' => $galleries])
                </div>
            </div>
        </div>
    </section>
    <!-- /Recent Gallery -->
@endsection
