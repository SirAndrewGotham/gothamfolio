@extends('frontend.legacy.layouts.app')

@section('content')
    {{-- Carousel --}}
        @include('frontend.legacy.home._carousel')
    {{-- /Carousel --}}

    {{-- 3 Services --}}
        @include('frontend.legacy.home._services')
    {{-- /3 Services --}}

    {{-- Accordion + IMG --}}
    <div class="mt40 mb40">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 mb20">
                    <div class="heading">
                        <h4>{{ trans('app.frontend.home.about-me.title') }}</h4>
                    </div>
                </div>
            </div>

            {{-- Accordion --}}
                @include('frontend.legacy.home._accordion')
            {{-- /Accordion --}}
        </div>
    </div>
    {{-- Accordion + IMG --}}

    {{-- Recent Work --}}
    <section class="pt40 mb40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="heading mb30">
                        @if($works->count() > 0)
                            <div class="owl-controls">
                                <div id="customNav" class="owl-nav"></div>
                            </div>
                        @endif
                        <h4>
                            {{ trans('app.frontend.home.recent-work.title') }}
                        </h4>
                    </div>
                    @include('frontend.legacy.layouts._lastWorks')
                </div>
            </div>
        </div>
    </section>
    {{-- /Recent Work --}}

    {{-- Customers --}}
    <section class="mb40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="heading mb30">
                        <h4>{{ trans('app.frontend.home.customers.title') }}</h4>
                        <div class="owl-controls">
                            <div id="customNav" class="owl-nav"></div>
                        </div>
                    </div>
                    @include('frontend.legacy.layouts._customers')
                </div>
            </div>
        </div>
    </section>
    {{-- /Customers --}}
@endsection
