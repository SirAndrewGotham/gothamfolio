@extends('frontend.legacy.layouts.app')

@section('content')
    @include('frontend.legacy.layouts._headerPage', ['pageName' => trans('app.frontend.works.show.page-title', ['work_title' => $work->title]), 'pageNameBreadcrumb' => trans('app.frontend.works.show.breadcrumb-title')])

    <!-- Project Details -->
    <section class="mt40 mb40">
        <div class="container">
            <div class="row text-center">
                <p class="lead mb30">{{ $work->title }}</p>
                <img class="img-thumbnail" src="{{ asset('uploads/works/'.$work->work_id.'/'.$work->image) }}" alt="{{ $work->title }}">
                <div class="row mt40">
                    {{ __('Technologies used') }}:
                    @foreach($work->tags as $tag)
                        <span class="label label-info">{{ $tag->name }}</span>
                    @endforeach
                </div>
            </div>

            <div class="row mt40">
                {!! $work->body !!}
            </div>
        </div>
    </section>
    <!-- /Project Details -->

    <!-- Recent Work -->
    <section class="pt40 mb40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="heading mb30">
                        <h4>{{ trans('app.frontend.works.show.recent-work') }}</h4>
                        <div class="owl-controls">
                            <div id="customNav" class="owl-nav"></div>
                        </div>
                    </div>
                    @include('frontend.legacy.layouts._lastWorks', ['works' => $works])
                </div>
            </div>
        </div>
    </section>
    <!-- /Recent Work -->
@endsection
