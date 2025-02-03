<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Sir. Andrew Gotham <andreogotema@gmail.com>">
    <meta name="description" content="Personal CV portfolio Web site">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="shortcut icon" href="{{ asset('assets/frontend/legacy/img/favicon.png') }}">
    <title>Andrew Gotham - Software Engineer, Web Developer and Photographer!</title>

    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700%7CRaleway:200,300,400,700">
    <link rel="stylesheet" href="{{ asset('assets/frontend/legacy/css/frontend.css') }}">
</head>
<body>

{{-- Header --}}
<header>
    {{-- Navigation --}}
    <div class="navbar navbar-fixed-top">
        <div class="container container-header">
            <div class="navbar-header">
                {{-- Logo --}}
                @include('frontend.legacy.layouts._logo')
                {{-- /Logo --}}

                {{-- Mobile Navigation --}}
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                {{-- /Mobile Navigation --}}
            </div>

            {{-- Main Navigation --}}
            @include('frontend.legacy.layouts._menu')
            {{-- /Main Navigation --}}
        </div>
    </div>
    {{-- /Navigation --}}
</header>
{{-- /Header --}}

{{-- Main Container --}}
<div class="main-container">
    @yield('content')
</div>
{{-- /Main Container --}}

{{-- Footer --}}
<footer class="footer">
    <div class="container">
        <div class="row">
            {{-- About --}}
            @include('frontend.legacy.layouts._about')
            {{-- /About --}}

            {{-- Recent Post --}}
            @include('frontend.legacy.layouts._lastPosts')
            {{-- /Recent Post --}}

            {{-- Contact --}}
            @include('frontend.legacy.layouts._contact')
            {{-- /Contact --}}

            {{-- Social --}}
            @include('frontend.legacy.layouts._social')
            {{-- /Social --}}
        </div>

        {{-- Copyright --}}
        @include('frontend.legacy.layouts._copyright')
        {{-- /Copyright --}}
    </div>
</footer>
{{-- /Footer --}}

<a href="#" class="scroll-top"><div class="scrolltop-holder"><i class="fa fa-arrow-up scrolltop"></i></div></a>

<script src="{{ asset('assets/frontend/legacy/js/frontend.js') }}"></script>
@include('frontend.legacy.layouts._analytics')
</body>
</html>
