<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Sir. Andrew Gotham <andreogotema@gmail.com>">
    <meta name="description" content="Personal CV portfolio Web site">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="shortcut icon" href="{{ asset('assets/frontend/legacy/img/favicon.png') }}">
    <title>Andrew Gotham - Software Engineer, Web Developer and Photographer!</title>

    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700%7CRaleway:200,300,400,700">
    <link rel="stylesheet" href="{{ asset('assets/frontend/legacy/css/frontend.css') }}">

    <style>
        [x-cloak]{
            display: none !important;
        }
    </style>
    {{-- Styles --}}
    {{-- i've got everything i need in frontend.css, use bootstrap if you need to customize --}}
{{--    <link href="--}}{{-- asset('assets/frontend/legacy/css/bootstrap.min.css') --}}{{--" rel="stylesheet">--}}

    {{-- Scripts --}}
{{--    @vite(['resources/css/app.css', 'resources/js/app.js'])--}}

    @stack('styles')

</head>
<body>

{{-- Header --}}
<header>
    {{-- Navigation --}}
        @include('frontend.legacy.layouts._navbar')
    {{-- /Navigation --}}
</header>
{{-- /Header --}}

{{-- Main Container --}}
<div class="main-container">
    @yield('content')
</div>
{{-- /Main Container --}}

{{-- Footer --}}
    @include('frontend.legacy.layouts._footer')
{{-- /Footer --}}

<a href="#" class="scroll-top"><div class="scrolltop-holder"><i class="fa fa-arrow-up scrolltop"></i></div></a>

{{-- jQuery --}}
<script src="{{ asset('assets/frontend/legacy/js/jquery-3.2.1.min.js') }}"></script>
{{-- Popper --}}
{{--<script src="{{ asset('assets/frontend/legacy/js/popper.min.js') }}"></script>--}}
{{-- Bootstrap JS --}}
{{-- this conflicts with language drop-down, change mechanics if need to use the following --}}
{{--<script src="{{ asset('assets/frontend/legacy/js/bootstrap.min.js') }}"></script>--}}

<script src="{{ asset('assets/frontend/legacy/js/frontend.js') }}"></script>
@include('frontend.legacy.layouts._analytics')
@stack('scripts')
</body>
</html>
