@extends('frontend.legacy.layouts.app')

@section('content')
    @include('frontend.legacy.layouts._headerPage', ['pageName' => trans('app.frontend.resume.page-title'), 'pageNameBreadcrumb' => trans('app.frontend.resume.breadcrumb-title')])

    <section>
        <div class="container">
            <div class="heading no-margin-bottom pt15">
                <h2>{{ trans('app.frontend.resume.work-experience.title') }}</h2>
            </div>
            <ul class="timeline no-margin">
                <li>
                    <div class="timeline-panel">
                        <div class="heading">
                            <h4>
                                {!! trans('app.frontend.resume.work-experience.1.job-title') !!}
                            </h4>
                            <small class="heading-caption hidden-xs">
                                <i class="fa fa-calendar"></i> {{ trans('app.frontend.resume.work-experience.1.dates') }}
                            </small>
                        </div>
                        <div class="timeline-body">
                            {!! trans('app.frontend.resume.work-experience.1.details') !!}
                        </div>
                    </div>
                </li>
                <li>
                    <div class="timeline-panel">
                        <div class="heading">
                            <h4>
                                {!! trans('app.frontend.resume.work-experience.2.job-title') !!}
                            </h4>
                            <small class="heading-caption hidden-xs">
                                <i class="fa fa-calendar"></i> {{ trans('app.frontend.resume.work-experience.2.dates') }}
                            </small>
                        </div>
                        <div class="timeline-body">
                            {!! trans('app.frontend.resume.work-experience.2.details') !!}
                        </div>
                    </div>
                </li>
{{--                <li>--}}
{{--                    <div class="timeline-panel">--}}
{{--                        <div class="heading">--}}
{{--                            <h4>{!! trans('app.frontend.resume.work-experience.3.job-title') !!}</h4>--}}
{{--                            <small class="heading-caption hidden-xs"><i class="fa fa-calendar"></i> {{ trans('app.frontend.resume.work-experience.3.dates') }}</small>--}}
{{--                        </div>--}}
{{--                        <div class="timeline-body">--}}
{{--                            {!! trans('app.frontend.resume.work-experience.3.details') !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <div class="timeline-panel">--}}
{{--                        <div class="heading">--}}
{{--                            <h4>{!! trans('app.frontend.resume.work-experience.4.job-title') !!}</h4>--}}
{{--                            <small class="heading-caption hidden-xs"><i class="fa fa-calendar"></i> {{ trans('app.frontend.resume.work-experience.4.dates') }}</small>--}}
{{--                        </div>--}}
{{--                        <div class="timeline-body">--}}
{{--                            {!! trans('app.frontend.resume.work-experience.4.details') !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <div class="timeline-panel">--}}
{{--                        <div class="heading">--}}
{{--                            <h4>{!! trans('app.frontend.resume.work-experience.5.job-title') !!}</h4>--}}
{{--                            <small class="heading-caption hidden-xs"><i class="fa fa-calendar"></i> {{ trans('app.frontend.resume.work-experience.5.dates') }}</small>--}}
{{--                        </div>--}}
{{--                        <div class="timeline-body">--}}
{{--                            {!! trans('app.frontend.resume.work-experience.5.details') !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </li>--}}
            </ul>

            <p>{!! trans('app.frontend.resume.work-experience.notes') !!}</p>

            <div class="heading no-margin-bottom pt15">
                <h2>{{ trans('app.frontend.resume.education.title') }}</h2>
            </div>
            <ul class="timeline no-margin">
                <li>
                    <div class="timeline-panel">
                        <div class="heading no-margin">
                            <h4>{!! trans('app.frontend.resume.education.1.title') !!}</h4>
                            <small class="heading-caption hidden-xs"><i class="fa fa-calendar"></i> {{ trans('app.frontend.resume.education.1.dates') }}</small>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="timeline-panel">
                        <div class="heading no-margin">
                            <h4>{!! trans('app.frontend.resume.education.2.title') !!}</h4>
                            <small class="heading-caption hidden-xs"><i class="fa fa-calendar"></i> {{ trans('app.frontend.resume.education.2.dates') }}</small>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="timeline-panel">
                        <div class="heading no-margin">
                            <h4>{!! trans('app.frontend.resume.education.3.title') !!}</h4>
                            <small class="heading-caption hidden-xs"><i class="fa fa-calendar"></i> {{ trans('app.frontend.resume.education.3.dates') }}</small>
                        </div>
                    </div>
                </li>
            </ul>

            <div class="heading pt15">
                <h2>{{ trans('app.frontend.resume.skills.title') }}</h2>
            </div>
            <div>
                {{-- 1 --}}
                <p class="progress-head">{!! trans('app.frontend.resume.skills.1.label') !!}</p>
                <div class="progress reveal-left">
                    <div class="progress-bar progress-bar-primary" role="progressbar" style="width: 100%">
                        <span class="progress-bar-tooltip">{{ trans('app.frontend.resume.skills.1.level') }}</span>
                    </div>
                </div>
                {{--// 1 --}}
                {{-- 2 --}}
                <p class="progress-head">{!! trans('app.frontend.resume.skills.2.label') !!}</p>
                <div class="progress reveal-right">
                    <div class="progress-bar progress-bar-primary" role="progressbar" style="width: 100%">
                        <span class="progress-bar-tooltip">{{ trans('app.frontend.resume.skills.2.level') }}</span>
                    </div>
                </div>
                {{--// 2 --}}
                {{-- 3 --}}
                <p class="progress-head">{!! trans('app.frontend.resume.skills.3.label') !!}</p>
                <div class="progress reveal-left">
                    <div class="progress-bar progress-bar-primary" role="progressbar" style="width: 100%">
                        <span class="progress-bar-tooltip">{{ trans('app.frontend.resume.skills.3.level') }}</span>
                    </div>
                </div>
                {{--// 3 --}}
                {{-- 4 --}}
                <p class="progress-head">{!! trans('app.frontend.resume.skills.4.label') !!}</p>
                <div class="progress reveal-right">
                    <div class="progress-bar progress-bar-primary" role="progressbar" style="width: 100%">
                        <span class="progress-bar-tooltip">{{ trans('app.frontend.resume.skills.4.level') }}</span>
                    </div>
                </div>
                {{--// 4 --}}
                {{-- 5 --}}
                <p class="progress-head">{!! trans('app.frontend.resume.skills.5.label') !!}</p>
                <div class="progress reveal-left">
                    <div class="progress-bar progress-bar-primary" role="progressbar" style="width: 100%">
                        <span class="progress-bar-tooltip">{{ trans('app.frontend.resume.skills.5.level') }}</span>
                    </div>
                </div>
                {{--// 5 --}}
                {{-- 6 --}}
                <p class="progress-head">{!! trans('app.frontend.resume.skills.6.label') !!}</p>
                <div class="progress reveal-right">
                    <div class="progress-bar progress-bar-primary" role="progressbar" style="width: 100%">
                        <span class="progress-bar-tooltip">{{ trans('app.frontend.resume.skills.6.level') }}</span>
                    </div>
                </div>
                {{--// 6 --}}
                {{-- 7 --}}
                <p class="progress-head">{!! trans('app.frontend.resume.skills.7.label') !!}</p>
                <div class="progress reveal-left">
                    <div class="progress-bar progress-bar-primary" role="progressbar" style="width: 90%">
                        <span class="progress-bar-tooltip">{{ trans('app.frontend.resume.skills.7.level') }}</span>
                    </div>
                </div>
                {{--// 7 --}}
                {{-- 8 --}}
                <p class="progress-head">{!! trans('app.frontend.resume.skills.8.label') !!}</p>
                <div class="progress reveal-left">
                    <div class="progress-bar progress-bar-primary" role="progressbar" style="width: 90%">
                        <span class="progress-bar-tooltip">{{ trans('app.frontend.resume.skills.8.level') }}</span>
                    </div>
                </div>
                {{--// 8 --}}
                {{-- 9 --}}
                <p class="progress-head">{!! trans('app.frontend.resume.skills.9.label') !!}</p>
                <div class="progress reveal-left">
                    <div class="progress-bar progress-bar-primary" role="progressbar" style="width: 90%">
                        <span class="progress-bar-tooltip">{{ trans('app.frontend.resume.skills.9.level') }}</span>
                    </div>
                </div>
                {{--// 9 --}}
                {{-- 10 --}}
                <p class="progress-head">{!! trans('app.frontend.resume.skills.10.label') !!}</p>
                <div class="progress reveal-left">
                    <div class="progress-bar progress-bar-primary" role="progressbar" style="width: 80%">
                        <span class="progress-bar-tooltip">{{ trans('app.frontend.resume.skills.10.level') }}</span>
                    </div>
                </div>
                {{--// 10 --}}
            </div>
        </div>
    </section>
@endsection
