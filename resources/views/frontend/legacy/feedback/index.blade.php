@extends('frontend.legacy.layouts.app')

@section('content')
    @include('frontend.legacy.layouts._headerPage', ['pageName' => trans('app.frontend.contact.page-title'), 'pageNameBreadcrumb' => trans('app.frontend.contact.breadcrumb-title')])

    {{-- Map, API key is needed  --}}
{{--    <div class="container-fluid">--}}
{{--        <div class="row">--}}
{{--            <div class="col-xs-12 no-padding" style="margin-bottom: -7px;">--}}
{{--                <iframe class="googleMaps" height="350" src="https://maps.app.goo.gl/MEfa9zJyzqiPEyFg7"></iframe>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!-- /Map -->

    <!-- Contact -->
    <section class="mt40 mb40">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="heading mb20">
                        <h4>{{ trans('app.frontend.contact.form-heading') }}</h4>
                    </div>
                    @unless(Session::get('success'))
                        <p class="mb20">
                            {{ trans('app.frontend.contact.form-text') }}
                        </p>
                    @else
                        <div class="alert alert-success">
                            {!! Session::get('success') !!}
                        </div>
                    @endunless

                    @include('frontend.legacy.layouts._formErrors')

{{--                    @if (Session::get('success'))--}}
{{--                        <div class="alert alert-success">--}}
{{--                            {!! Session::get('success') !!}--}}
{{--                        </div>--}}
{{--                    @endif--}}
                    <form role="form" method="POST" action="{{ route('feedback.store') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="{{ trans('app.frontend.contact.name') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="{{ trans('app.email') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" placeholder="{{ trans('app.message') }}" rows="7">{{ old('message') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-rw btn-primary">{{ trans('app.btn-submit') }}</button>
                    </form>
                </div>
                <div class="col-sm-4 mt30-xs">
                    <div class="panel panel-primary no-margin">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ trans('app.information') }}</h3>
                        </div>
                        <div class="panel-body">
                            <address class="no-margin">
                                <p>
                                    <strong>
                                        {{ trans('app.Andrew Gotham') }}
                                    </strong>
                                </p>
                                <p>
                                    <i class="fa fa-home"></i>
                                    @unless(app()->getLocale() === 'ru')
                                        <small class="address">{{ trans('app.blocks.common.contact.country') }}</small>
                                    @else
                                        <small class="address">{{ trans('app.blocks.common.contact.country') }}</small>
                                    @endunless
                                </p>
                                <p>
                                    <i class="fa fa-whatsapp"></i>
                                    <a href="https://wa.me/+77755569244" target="_blank">
                                        <small class="address">
                                            {{ trans('app.blocks.common.contact.whatsapp') }}
                                        </small>
                                    </a>
                                </p>
                                <p>
                                    <i class="fa fa-envelope-o "></i>
                                    <a href="mailto:andreogotema@gmail.com" target="_blank">
                                        <small class="address">
                                            {{ __('AndrewGotham') }}
                                        </small>
                                    </a>
                                </p>
                                <p>
                                    <a href="https://github.com/sirandrewgotham" class="btn btn-social-icon btn-rw btn-primary btn-xs" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1228 1000" style="fill: currentColor; width: 65%; height: 65%; margin-top: 4px; margin-bottom: 0;"><path fill="currentColor" d="M1078.94-.985c-33.192-.491-110.295 10.777-239.027 96.936c-70.161-17.535-144.812-26.188-219.591-26.188c-82.278 0-165.425 10.448-242.965 31.719C192.534-24.605 110.955 1.234 110.955 1.234c-53.258 133.183-20.347 231.788-10.344 256.277C38.014 325.069-.2 411.338-.2 517.07c0 79.822 9.085 151.416 31.281 213.653c1.231 4.803.832 3.732 2.906 7.844c4.89 12.884 10.327 25.39 16.438 37.468c2.094 4.346 4 7.563 4 7.563c62.395 116.307 185.396 191.438 404.244 215.028l330.995.375c233.392-23.144 345.386-98.499 396.994-215.591l3.281-7.625c4.89-11.828 9.153-24.135 20.813-65.562c11.659-41.427 16.875-113.172 16.875-193.185c0-114.755-43.1-206.577-113.092-276.434c12.231-39.48 28.57-127.158-16.313-239.402c0 0-6.293-1.995-19.281-2.188zM818.1 420.133c53.893-.117 100.057 9.136 134.717 45.499v.031c43.369 45.541 68.749 100.525 68.749 159.778c0 276.658-177.932 284.183-397.4 284.183c-219.506 0-397.4-38.336-397.4-284.183c0-58.861 25.009-113.516 67.843-158.872c71.451-75.59 192.365-35.562 329.558-35.562c70.423-.011 136.564-10.75 193.935-10.875zm-408.807 81.468c-45.666 0-82.687 61.741-82.687 137.936c0 76.206 37.019 137.967 82.687 137.967c45.666 0 82.687-61.761 82.687-137.967c0-76.184-37.019-137.881-82.687-137.936m443.649 0c-45.666 0-82.687 61.741-82.687 137.936c0 76.206 37.019 137.967 82.687 137.967c45.666 0 82.687-61.761 82.687-137.967c0-76.184-37.019-137.881-82.687-137.936"/></svg>
                                    </a>
                                    <a href="https://vk.com/andrewgotham" class="btn btn-social-icon btn-rw btn-primary btn-xs" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90%" viewBox="0 0 24 24" style="margin-top: 2px; margin-bottom: 2px;"><g fill="none" fill-rule="evenodd"><path d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="currentColor" d="M7 3a4 4 0 0 0-4 4v10a4 4 0 0 0 4 4h10a4 4 0 0 0 4-4V7a4 4 0 0 0-4-4zm10.332 7.055a1 1 0 0 0-1.664-1.11c-.354.47-.725.92-1.159 1.32c-.503.464-1.012.812-1.508 1.018l-.008-1.9A1 1 0 0 0 12 8.5c-.542.031-1 .431-1 1v4.373c-1.948-.54-3-2.43-3-4.373a1 1 0 0 0-2 0c0 3.632 2.51 6.5 6 6.5a1 1 0 0 0 1-1v-1.563c1.332.106 2.624 1.047 3.106 2.01a1 1 0 1 0 1.788-.894c-.478-.957-1.37-1.852-2.468-2.436c.148-.121.295-.249.44-.382a9.807 9.807 0 0 0 1.466-1.68"/></g></svg>
                                    </a>
                                    <a href="https://t.me/sirandrewgotham" class="btn btn-social-icon btn-rw btn-primary btn-xs" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: currentColor; width: 85%; height: 85%; margin-top: 4px; margin-bottom: 0;"><path d="m20.665 3.717-17.73 6.837c-1.21.486-1.203 1.161-.222 1.462l4.552 1.42 10.532-6.645c.498-.303.953-.14.579.192l-8.533 7.701h-.002l.002.001-.314 4.692c.46 0 .663-.211.921-.46l2.211-2.15 4.599 3.397c.848.467 1.457.227 1.668-.785l3.019-14.228c.309-1.239-.473-1.8-1.282-1.434z"></path></svg>
                                    </a>
                                </p>
                            </address>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Contact -->
@endsection
