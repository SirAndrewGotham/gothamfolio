{{-- Accordion --}}
<div class="row">
    <div class="col-sm-6 reveal">
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            {{ trans('app.frontend.home.about-me.1.title') }}
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="panel-body">
                        {!! trans('app.frontend.home.about-me.1.content') !!}
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">{{ trans('app.frontend.home.about-me.2.title') }}</a></h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="panel-body">
                        {!! trans('app.frontend.home.about-me.2.content', ['blog_url' => route('blog.index')]) !!}
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">{{ trans('app.frontend.home.about-me.3.title') }}</a></h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse">
                    <div class="panel-body">
                        {!! trans('app.frontend.home.about-me.3.content') !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <a href="{{ route('resume') }}" class="btn btn-rw btn-primary">{{ trans('app.frontend.home.about-me.link') }}</a>
        </div>
    </div>

    <div class="col-sm-6 reveal">
        <img src="{{ asset('assets/frontend/legacy/img/showcase.png') }}" width="555" height="316" class="img-responsive showcase-image" alt="Responsive Showcase">
    </div>
</div>
{{-- /Accordion --}}
