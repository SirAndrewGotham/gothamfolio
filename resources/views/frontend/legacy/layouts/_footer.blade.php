{{-- Footer --}}
<footer class="footer">
    <div class="container">
        @if(config('gothamfolio.frontend.footer') === 'on')
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
        @endif

        {{-- Copyright --}}
        @include('frontend.legacy.layouts._copyright')
        {{-- /Copyright --}}
    </div>
</footer>
{{-- /Footer --}}
