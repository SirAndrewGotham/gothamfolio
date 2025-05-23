@extends('frontend.legacy.layouts.app')

@push('styles')
    <link
        rel="stylesheet"
        href="{{ asset('assets/frontend/legacy/css/fancybox.css') }}"
    />
@endpush
@push('scripts')
    <script src="{{ asset('assets/frontend/legacy/js/fancybox.umd.js') }}"></script>
@endpush

@section('content')
    @include('frontend.legacy.layouts._headerPage', ['pageName' => trans('app.frontend.galleries.index.page-title'), 'pageNameBreadcrumb' => trans('app.frontend.galleries.index.breadcrumb-title')])

    <section class="mt40 mb10">
        <div id="portfolio" class="container">
             {{-- Gallery Filter --}}
            @if($tags->count() > 0)
                <div class="row mb30" style="visibility: visible; ">
                    <ul class="nav nav-pills col-xs-12 text-center">
                        <li class="filter active" data-filter=".all">{{ trans('app.all') }}</li>
                        @foreach($tags->sortBy('name') as $tag)
                            @if($tag->name)
                                <li class="filter" data-filter=".{{ $tag->slug }}">{{ __($tag->name) }}</li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Gallery (Category) Items --}}
            <div class="row">
            <div id="PhotoGallery" class="col-sm-12 text-center">
                @forelse($galleries as $i => $gallery)
                    @if( ($i+0)%3 == 0 )
                        <div class="clearfix"></div>
                    @endif
                    <div class="item illustration col-sm-4 mix all {{ $gallery->tags->implode('slug', ' ') }} inline-block float-none">
                        <div class="border">
                            <div class="view port-borderless image-hover-1">
                                <center>
                                    <img class="img-responsive" src="{{ asset('uploads/galleries/'.$gallery->id.'/'.$gallery->cover) }}" alt="{{ $gallery->title }}" style="width: auto; height: 200px;" />
                                </center>
                                <div class="mask">
                                    <div class="image-hover-content">
                                        <a href="{{ asset('uploads/galleries/'.$gallery->id.'/'.$gallery->image) }}" class="info image-zoom-link">
                                            <div class="image-icon-holder">
                                                <span class="fa fa-search portfolio-icons"></span>
                                            </div>
                                        </a>
                                        <a href="{{ route('galleries.show', $gallery->slug) }}" class="info">
                                            <div class="image-icon-holder"><span class="fa fa-link portfolio-icons"></span></div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="portfolio-text background-white">
                                <h3 class="portfolio-title">
                                    <a href="{{ route('galleries.show', $gallery->slug) }}">
                                        {{ $gallery->title }}
                                    </a>
                                </h3>
                                <div>
                                    {!! $gallery->excerpt !!}
                                </div>
                                <div class="project-category">{{ $gallery->tags->count() > 0 ? ucfirst($gallery->tags->first()->name) : '' }}</div>
                            </div>
                        </div>
                    </div>
                @empty
                    <li>
                        <p>
                            {{ trans('app.frontend.galleries.index.no-gallery-found') }}
                        </p>
                    </li>
                @endforelse
            </div>
            </div>
            <div class="text-center">
                {{ $galleries->links() }}
            </div>
        </div>
    </section>
@endsection
