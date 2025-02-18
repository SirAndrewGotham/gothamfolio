<div class="col-sm-3 mg25-xs">
    <div class="heading-footer">
        <h4>{{ trans('app.blocks.common.contact.title') }}</h4>
    </div>
    <p>
        <i class="fa fa-home footer-info-icons"></i>
        @unless(app()->getLocale() === 'ru')
            <small class="address">{{ trans('app.blocks.common.contact.country') }}</small>
        @else
            <small class="address">{{ trans('app.blocks.common.contact.city') }}</small>
        @endunless
    </p>
    <p>
        <i class="fa fa-envelope-o footer-info-icons"></i>
        <a href="mailto:andreogotema@gmail.com" target="_blank"><small class="address">{{ __('AndrewGotham') }}</small></a>
    </p>
{{--    <p>--}}
{{--        <i class="fa fa-phone footer-info-icons"></i>--}}
{{--        <small class="address">{{ trans('app.blocks.common.contact.phone') }}</small>--}}
{{--    </p>--}}
    <p>
        <i class="fa fa-whatsapp footer-info-icons"></i>
        <span class="inline-block">
            <a href="https://wa.me/+77755569244" target="_blank">
                <small class="address">
                    {{ trans('app.blocks.common.contact.whatsapp') }}
                </small>
            </a>
        </span>
    </p>
{{--    <p>--}}
{{--        <span class="footer-info-icons"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" style="fill: whitesmoke;"><path fill="currentColor" d="m20.665 3.717l-17.73 6.837c-1.21.486-1.203 1.161-.222 1.462l4.552 1.42l10.532-6.645c.498-.303.953-.14.579.192l-8.533 7.701h-.002l.002.001l-.314 4.692c.46 0 .663-.211.921-.46l2.211-2.15l4.599 3.397c.848.467 1.457.227 1.668-.785l3.019-14.228c.309-1.239-.473-1.8-1.282-1.434"/></svg></span>--}}
{{--        <a href="https://t.me/sirandrewgotham" target="_blank"><small class="address">{{ trans('app.blocks.common.contact.telegram') }}</small></a>--}}
{{--    </p>--}}
{{--    <p>--}}
{{--        <i class="fa fa-github footer-info-icons"></i>--}}
{{--        <a href="https://github.com/SirAndrewGotham" target="_blank"><small class="address">{{ trans('app.blocks.common.contact.github') }}</small></a>--}}
{{--    </p>--}}
</div>
