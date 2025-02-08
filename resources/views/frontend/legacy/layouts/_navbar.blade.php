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
