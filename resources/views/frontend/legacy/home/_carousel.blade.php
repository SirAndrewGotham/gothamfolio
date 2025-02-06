{{-- Carousel --}}
<div class="carousel">
    <div id="carouselHome" class="carousel slide carousel-fade" data-ride="carousel" data-interval="15000">
        {{-- Indicators --}}
        <ol class="carousel-indicators">
            <li data-target="#carouselHome" data-slide-to="0" class="active"></li>
            <li data-target="#carouselHome" data-slide-to="1"></li>
            <li data-target="#carouselHome" data-slide-to="2"></li>
        </ol>
        {{-- /Indicators --}}

        {{-- Wrapper for slides --}}
        <div class="carousel-inner">
            {{-- Item 1 --}}
            <div class="item active">
                <div class="background-main carousel-item1" data-0="background-position:0px 0px;" data-500="background-position:0px -250px;">
                    <div class="container">
                        <div class="row carousel-content center-vertically-right">
                            <div class="fadeInRight-animated" data-animation="fadeInRight">
                                <div class="carousel-description col-sm-5">
                                    <h3 class="heavy text-white"><span class="carousel-title-bgclear">{{ trans('app.frontend.home.carousel.1.title') }}</span></h3>
                                    <p>
                                        {!! trans('app.frontend.home.carousel.1.content') !!}
                                    </p>
                                    <a href="{{ route('blog.index') }}" class="btn btn-rw btn-default">{{ trans('app.frontend.home.carousel.1.link') }} <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                            <div class="fadeInLeft-animated" data-animation="fadeInLeft">
                                <div class="col-sm-6 col-sm-offset-1">
                                    <img src="{{ asset('assets/frontend/legacy/img/showcase-full.png') }}" class="img-responsive carousel-image" alt="Responsive Showcase" width="540" height="270px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- /Item 1 --}}

            {{-- Item 2 --}}
            <div class="item">
                <div class="carousel-item2" data-0="background-position:0px 0px;" data-500="background-position:0px -250px;">
                    <div class="container">
                        <div class="row carousel-content center-vertically-left">
                            <div class="fadeInLeft-animated" data-animation="fadeInLeft">
                                <div class="col-sm-6 hidden-xs">
                                    <img src="{{ asset('assets/frontend/legacy/img/showcase2.png') }}" width="510" height="328" class="img-responsive carousel-image" alt="Responsive Showcase">
                                </div>
                            </div>
                            <div class="fadeInRight-animated" data-animation="fadeInRight">
                                <div class="carousel-description mt10 col-sm-5 col-sm-offset-1">
                                    <h4 class="heavy text-white"><span class="carousel-title-bg">{{ trans('app.frontend.home.carousel.2.title') }}</span></h4>
                                    <p>
                                        {!! trans('app.frontend.home.carousel.2.content') !!}
                                    </p>
                                    <a href="{{ route('blog.index') }}" class="btn btn-rw btn-primary">{{ trans('app.frontend.home.carousel.2.link') }} <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- /Item 2 --}}

            {{-- Item 3 --}}
            <div class="item">
                <div class="carousel-item3" data-0="background-position:0px 0px;" data-500="background-position:0px -250px;">
                    <div class="container">
                        <div class="row carousel-content center-vertically-right">
                            <div class="fadeInUpBig-animated" data-animation="fadeInUpBig">
                                <div class="carousel-description col-sm-8 col-sm-offset-2 text-center">
                                    <h2 class="heavy text-white">
                                            <span class="carousel-title-bgclear">
                                                {{ trans('app.frontend.home.carousel.3.title') }}
                                            </span>
                                    </h2>
                                    <p>
                                        {!! trans('app.frontend.home.carousel.3.content') !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- /Item 3 --}}
        </div>
        {{-- /Wrapper for slides --}}

        {{-- Controls --}}
        <a class="left carousel-control" href="#carouselHome" role="button" data-slide="prev"><i class="fa fa-arrow-left carousel-arrow-left" aria-hidden="true"></i></a>
        <a class="right carousel-control" href="#carouselHome" role="button" data-slide="next"><i class="fa fa-arrow-right carousel-arrow-right" aria-hidden="true"></i></a>
        {{-- /Controls --}}
    </div>
</div>
{{-- /Carousel --}}
