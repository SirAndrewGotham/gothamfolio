@extends('frontend.legacy.layouts.app')

@push('styles')
    {{-- fancyBox CSS --}}
    <link href="{{ asset('assets/frontend/legacy/css/jquery.fancybox.min.css') }}" rel="stylesheet">

    <style>
        .thumb img {
            -webkit-filter: grayscale(0);
            filter: none;
            border-radius: 5px;
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 5px;
        }

        .thumb img:hover {
            -webkit-filter: grayscale(1);
            filter: grayscale(1);
        }

        .thumb {
            padding: 5px;
        }
    </style>
@endpush
@push('scripts')
    {{-- fancyBox JS --}}
    <script src="{{ asset('assets/frontend/legacy/js/jquery.fancybox.min.js') }}"></script>
@endpush

@section('content')
    @include('frontend.legacy.layouts._headerPage', ['pageName' => trans('app.frontend.galleries.show.page-title', ['gallery_title' => $gallery->title]), 'pageNameBreadcrumb' => trans('app.frontend.galleries.show.breadcrumb-title')])

    {{-- Gallery Details --}}
    <section class="mt40 mb40">
        <div class="container">
            <div class="container">
                <div class="row">
                    <div class="col-6 col-sm-6 col-lg-6">
                        <p class="lead mb30">{{ $gallery->title }}</p>
                        <img class="img-thumbnail" src="{{ asset('uploads/galleries/'.$gallery->id.'/'.$gallery->cover) }}" alt="{{ $gallery->title }}">
                    </div>
                    <div class="col-6 col-sm-6 col-lg-6">
                        {!! $gallery->description !!}
                        @if($gallery->tags->count() > 0)
                            <div class="row mt40">
                                {{ __('Tags') }}:
                                @foreach($gallery->tags as $tag)
                                    <span class="label label-info">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
{{--            <div class="row text-center">--}}
{{--                <p class="lead mb30">{{ $gallery->title }}</p>--}}
{{--                <img class="img-thumbnail" src="{{ asset('uploads/galleries/'.$gallery->id.'/'.$gallery->cover) }}" alt="{{ $gallery->title }}">--}}
{{--                @if($gallery->tags->count() > 0)--}}
{{--                    <div class="row mt40">--}}
{{--                        {{ __('Tags') }}:--}}
{{--                        @foreach($gallery->tags as $tag)--}}
{{--                            <span class="label label-info">{{ $tag->name }}</span>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            </div>--}}

{{--            <div class="row mt40">--}}
{{--                {!! $gallery->description !!}--}}
{{--            </div>--}}

            <hr />
        </div>



        <div class="row">
            <div class="col-sm-12 text-center">
                @foreach($images as $i => $image)
                    @if( ($i+0)%3 == 0 )
                        <div class="clearfix">&nbsp;</div>
                    @endif
                        <div class="item illustration col-sm-4 mix all inline-block float-none">
                            <a data-fancybox="gallery" href="{{ asset('/uploads/galleries/' . $image->gallery->id . '/' . $image->image) }}">
                                <img class="img-fluid img-thumbnail" src="{{ asset('/uploads/galleries/' . $image->gallery->id . '/' . $image->image) }}" alt="{{ $image->caption }}">
                            </a>
                        </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- /Project Details -->

    <!-- Recent Gallery -->
    <section class="pt40 mb40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
{{--                    <div class="heading mb30">--}}
{{--                        <h4>{{ trans('app.frontend.galleries.show.recent-gallery') }}</h4>--}}
                        <div class="owl-controls">
                            <div id="customNav" class="owl-nav"></div>
                        </div>
{{--                    </div>--}}
                    {{-- will do without latest for now --}}
{{--                    @include('frontend.legacy.gallery._lastGalleries', ['galleries' => $galleries])--}}
                </div>
            </div>
        </div>
    </section>
    <!-- /Recent Gallery -->
@endsection
