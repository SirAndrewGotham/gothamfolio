<!DOCTYPE html>
<html lang="en" class="h-screen">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
{{--    <link rel="preload" href="{{ asset('assets/frontend/blakie/fonts/GeistMonoVF.woff2') }}" as="font" crossorigin="" type="font/woff2">--}}
{{--    <link href="{{ asset('assets/frontend/blakie/fonts/GeistMonoVF.woff2') }}" rel="stylesheet">--}}
    {{--    <link rel="stylesheet" href="{{ asset('assets/frontend/blakie/css/style.css') }}" data-precedence="next">--}}
    <meta name="next-size-adjust" content="">
    <title>Portfolio of Sir. Andrew Gotham</title>
    <meta name="description"
          content="Portfolio of Sir. Andrew Gotham. It contains all my projects, experiences, skills and a blog where I share my thoughts and ideas.">
    <link rel="icon" href="/favicon.ico" type="image/x-icon" sizes="16x16">
{{--    <script src="{{ asset('assets/frontend/blackie/js/polyfills.js') }}" nomodule=""></script>--}}

    <style>
        [x-cloak]{
            display: none !important;
        }
    </style>
{{--    <style type="text/css">--}}
{{--        @font-face {--}}
{{--            font-family: Muli-Bold;--}}
{{--            src: url({{ asset('assets/frontend/blakie/fonts/GeistMonoVF.woff2') }});--}}
{{--        }--}}
{{--    </style>--}}
{{--    <link rel="preload" href="{{ asset('assets/frontend/blackie/css/blackie.css') }}" as="style">--}}
    {{-- Scripts --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen flex-col antialiased bg-black">
<header class="py-8 text-white xl:py-12">
    <div class="container mx-auto flex items-center justify-between"><a class="group" aria-label="Home page" href="/">
            <h1 class="text-4xl font-light group-hover:text-accent">
                <span
                    class="group-hover:text-blue-600">And</span><span class="group-hover:text-white">rew</span><span
                    class="group-hover:text-red-600">Gotham</span><span
                    class="text-accent group-hover:text-transparent">.</span></h1>
        </a>
        <div class="hidden items-center gap-8 xl:flex">
            <nav class="flex gap-8"><a
                    class="border-b-2 border-accent text-accent font-medium capitalize transition-all duration-500 hover:text-accent"
                    aria-label="home page" href="/">home</a><a
                    class="false font-medium capitalize transition-all duration-500 hover:text-accent"
                    aria-label="services page" href="/services">services</a><a
                    class="false font-medium capitalize transition-all duration-500 hover:text-accent"
                    aria-label="resume page" href="/resume">resume</a><a
                    class="false font-medium capitalize transition-all duration-500 hover:text-accent"
                    aria-label="work page" href="/work">work</a><a
                    class="false font-medium capitalize transition-all duration-500 hover:text-accent"
                    aria-label="blog page" href="/posts">blog</a><a
                    class="false font-medium capitalize transition-all duration-500 hover:text-accent"
                    aria-label="contact page" href="/contact">contact</a></nav>
            <a aria-label="Contact me" href="/contact">
                <button
                    class="inline-flex items-center justify-center whitespace-nowrap rounded-full text-base font-semibold ring-offset-white transition-colors hover:bg-accent-hover h-[44px] px-6 bg-accent text-primary"
                    aria-label="Contact me">Hire me
                </button>
            </a>
        </div>
        <div class="xl:hidden">
            <button type="button" aria-haspopup="dialog" aria-expanded="false"
                    aria-controls="radix-:R1jb:" data-state="closed" class="flex items-center justify-center"
                    aria-label="Toggle menu">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                     viewBox="0 0 24 24" class="text-[32px] text-accent" height="1em" width="1em"
                     xmlns="http://www.w3.org/2000/svg">
                    <g id="Menu_Fries">
                        <path
                            d="M20.437,19.937c0.276,0 0.5,0.224 0.5,0.5c0,0.276 -0.224,0.5 -0.5,0.5l-16.874,0.002c-0.276,-0 -0.5,-0.224 -0.5,-0.5c-0,-0.276 0.224,-0.5 0.5,-0.5l16.874,-0.002Z">
                        </path>
                        <path
                            d="M20.437,11.5c0.276,-0 0.5,0.224 0.5,0.5c0,0.276 -0.224,0.5 -0.5,0.5l-10,0.001c-0.276,-0 -0.5,-0.224 -0.5,-0.5c-0,-0.276 0.224,-0.5 0.5,-0.5l10,-0.001Z">
                        </path>
                        <path
                            d="M20.437,3.062c0.276,-0 0.5,0.224 0.5,0.5c0,0.276 -0.224,0.5 -0.5,0.5l-16.874,0.001c-0.276,-0 -0.5,-0.224 -0.5,-0.5c-0,-0.276 0.224,-0.5 0.5,-0.5l16.874,-0.001Z">
                        </path>
                    </g>
                </svg>
            </button>
        </div>
    </div>
</header>
<main class="grow">
    <div>
            @yield('content')
    </div>
</main>

</body>

</html>
