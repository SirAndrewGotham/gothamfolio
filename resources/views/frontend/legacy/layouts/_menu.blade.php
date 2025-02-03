<nav class="navbar-collapse collapse navHeaderCollapse" role="navigation">
    <ul class="nav navbar-nav navbar-right">
        <li{{ Request::is('/') ? ' class=active' : '' }}><a href="{{ route('home') }}">{{ trans('app.menu.home') }}</a></li>
        <li{{ Request::is('resume') ? ' class=active' : '' }}><a href="{{ route('resume') }}">{{ trans('app.menu.resume') }}</a></li>
        <li{{ Request::segment(1) == 'works' ? ' class=active' : '' }}><a href="{{ route('works.index') }}">{{ trans('app.menu.works') }}</a></li>
        <li{{ Request::segment(1) == 'blog' ? ' class=active' : '' }}><a href="{{ route('blog.index') }}">{{ trans('app.menu.blog') }}</a></li>
        <li{{ Request::is('contact') ? ' class=active' : '' }}><a href="{{ route('contact.show') }}">{{ trans('app.menu.contact') }}</a></li>

        @if(app()->getLocale() == 'en')
            <li><a href="{{ route('translate', ['lang' => 'fr']) }}" data-toggle="tooltip" data-placement="bottom" title="Version française"><img src="{{ asset('assets/frontend/legacy/img/fr.png') }}" width="16" height="11" alt=""></a></li>
        @else
            <li><a href="{{ route('locale', 'eo') }}" data-toggle="tooltip" data-placement="bottom" title="English Version"><img src="{{ asset('assets/frontend/legacy/img/us.png') }}" width="16" height="11" alt=""></a></li>
        @endif
        <li class="navbar-social visible-lg-block"><a href="https://github.com/sirandrewgotham" class="btn btn-social-icon btn-rw btn-primary btn-xs"><i class="fa fa-github-alt"></i></a></li>
        <li class="navbar-social visible-lg-block"><a href="https://www.linkedin.com/pub/andrewgotham/32/427/778" class="btn btn-social-icon btn-rw btn-primary btn-xs"><i class="fa fa-linkedin"></i></a></li>
        <li class="navbar-social visible-lg-block"><a href="https://t.me/sirandrewgotham" class="btn btn-social-icon btn-rw btn-primary btn-xs"><i class="fa fa-twitter"></i></a></li>
    </ul>
</nav>
