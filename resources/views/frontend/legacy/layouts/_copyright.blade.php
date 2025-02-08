<div class="row">
    @if(config('gothamfolio.frontend.footer') === 'on')
        <hr class="dark-hr">
    @endif
    <div class="col-sm-12">
        <p class="copyright">{!! trans('app.blocks.common.copyright', ['this_year' => date('Y')]) !!}</p>
    </div>
</div>
