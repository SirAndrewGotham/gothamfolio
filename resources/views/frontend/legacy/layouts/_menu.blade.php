<div class="navbar-collapse collapse navHeaderCollapse" role="navigation">
    <ul class="nav navbar-nav navbar-right">
        <li{{ Request::is('/') ? ' class=active' : '' }}>
            <a href="{{ route('home') }}">{{ trans('app.menu.home') }}</a>
        </li>
        <li{{ Request::is('resume') ? ' class=active' : '' }}>
            <a href="{{ route('resume') }}">{{ trans('app.menu.resume') }}</a>
        </li>
        <li{{ Request::segment(1) == 'works' ? ' class=active' : '' }}>
            <a href="{{ route('works.index') }}">{{ trans('app.menu.works') }}</a>
        </li>
        <li{{ Request::segment(1) == 'blog' ? ' class=active' : '' }}>
            <a href="{{ route('blog.index') }}">{{ trans('app.menu.blog') }}</a>
        </li>
        <li{{ Request::is('contact') ? ' class=active' : '' }}>
            <a href="{{ route('contact.show') }}">{{ trans('app.menu.contact') }}</a>
        </li>
        <li class="dropdown mt-4 pt-4" style="margin-top: 24px; margin-bottom: 0px; padding-left: 2px; padding-right: 2px;  vertical-align: top">
            <button class="btn btn-default dropdown-toggle" style="border: 0px" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <svg height="18px" width="24px" style="">
                        {!! file_get_contents(public_path('assets/flags/'.app()->getLocale().'.svg')) !!}
                    </svg>
                <span style="vertical-align: top">{{ strtoupper(app()->getLocale()) }} ({{ App\Models\Language::where('code', app()->getLocale())->first()->name }})</span>
                <span class="caret" style="vertical-align: top; margin-top: 8px;"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                @foreach(App\Models\Language::where('is_active', true)->get() as $locale)
                    <li class="">
                        <a class="" href="{{ route('locale', $locale->code) }}">
                            @if(file_exists(public_path('assets/flags/'.$locale->code.'.svg')))
                                <span class="mr-2">
                                    <svg height="18px" width="24px" style="">
                                        {!! file_get_contents(public_path('assets/flags/'.$locale->code.'.svg')) !!}
                                    </svg>
                                </span>
                            @endif
                            {{ strtoupper($locale->code) }} ({{ $locale->name }})
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>
        <li class="navbar-social visible-lg-block"><a href="https://github.com/sirandrewgotham" class="btn btn-social-icon btn-rw btn-primary btn-xs"><i class="fa fa-github-alt"></i></a></li>
        <li class="navbar-social visible-lg-block"><a href="https://www.linkedin.com/pub/andrewgotham/32/427/778" class="btn btn-social-icon btn-rw btn-primary btn-xs"><i class="fa fa-linkedin"></i></a></li>
        <li class="navbar-social visible-lg-block"><a href="https://t.me/sirandrewgotham" class="btn btn-social-icon btn-rw btn-primary btn-xs"><i class="fa fa-twitter"></i></a></li>
    </ul>
</div>
