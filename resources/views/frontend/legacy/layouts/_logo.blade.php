@if(Request::is('/'))
    <span class="navbar-brand row">
        <img src="{{ asset('assets/frontend/legacy/img/ag-logo.png') }}" class="pull-left" style="margin-right: 6px" width="28px" /> {{--<div class="css-logo"></div>--}}<span class="pull-left"><div>AndrewGotham</div>
            @if(config('gothamfolio.frontend.status') == 'on')
                <div style="color: black;font-size: medium;font-weight: normal;">{{ __('app.frontend.home.status') }}: {{ \Illuminate\Support\Str::lower(__('app.frontend.home.looking')) }}</div>
            @endif
        </span>
    </span>
@else
    <a href="{{ route('home') }}" class="navbar-brand row items-center">
        <img src="{{ asset('assets/frontend/legacy/img/ag-logo.png') }}" class="pull-left" width="28px" style="margin-right: 6px" /> {{--<div class="css-logo"></div>--}}<span class="pull-left"><div>AndrewGotham</div>
            @if(config('gothamfolio.frontend.status') == 'on')
                <div style="color: black;font-size: medium;font-weight: normal;">{{ __('app.frontend.home.status') }}: {{ \Illuminate\Support\Str::lower(__('app.frontend.home.looking')) }}</div>
            @endif
        </span>
    </a>
@endif
