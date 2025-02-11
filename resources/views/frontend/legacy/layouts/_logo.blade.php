@if(Request::is('/'))
    <span class="navbar-brand row">
        <img src="{{ asset('assets/frontend/legacy/img/ag-logo.png') }}" class="pull-left" style="margin-right: 6px" width="28px" /> {{--<div class="css-logo"></div>--}}<span class="pull-left">AndrewGotham</span>
    </span>
@else
    <a href="{{ route('home') }}" class="navbar-brand row items-center">
        <img src="{{ asset('assets/frontend/legacy/img/ag-logo.png') }}" class="pull-left" width="28px" style="margin-right: 6px" /> {{--<div class="css-logo"></div>--}}<span class="pull-left ml-4 align-middle">AndrewGotham</span>
    </a>
@endif
