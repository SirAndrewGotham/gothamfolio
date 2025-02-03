@if(Request::is('/'))
    <span class="navbar-brand">
        <div class="css-logo"></div>AndrewGotham
    </span>
@else
    <a href="{{ route('home') }}" class="navbar-brand">
        <div class="css-logo"></div>AndrewGotham
    </a>
@endif
