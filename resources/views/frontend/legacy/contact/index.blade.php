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

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Contact -->
    <section class="mt40 mb40">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="heading mb20">
                        <h4>{{ trans('app.frontend.contact.form-heading') }}</h4>
                    </div>
                    <p class="mb20">
                        {{ trans('app.frontend.contact.form-text') }}
                    </p>

                    @include('frontend.legacy.layouts._formErrors')

                    @if (isset($success))
                        <div class="alert alert-success">
                            {!! $success !!}
                        </div>
                    @endif
                    <form role="form" method="POST" action="{{ route('contact.store') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="contactName" value="{{ old('contactName') }}" placeholder="{{ trans('app.frontend.contact.name') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="email" name="contactEmail" value="{{ old('contactEmail') }}" placeholder="{{ trans('app.email') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="contactMessage" placeholder="{{ trans('app.message') }}" rows="7">{{ old('contactMessage') }}</textarea>
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
                                <p><strong>{{ env('CONTACT_NAME', "Andrew Gotham") }}</strong></p>
                                <p><i class="fa fa-home"></i> {{ env('CONTACT_CITY', 'City') }}</p>
                                <p><i class="fa fa-phone"></i> {{ env('CONTACT_PHONE', 'Phone') }}</p>
                                <p><i class="fa fa-envelope-o "></i> {{ env('CONTACT_EMAIL', 'email') }}</p>
                                <p>
                                    <a href="https://github.com/sirandrewgotham" class="btn btn-social-icon btn-github btn-sm"><i class="fa fa-github-alt"></i></a>
                                    <a href="https://www.linkedin.com/pub/andrewgotham/32/427/778" class="btn btn-social-icon btn-linkedin btn-sm"><i class="fa fa-linkedin"></i></a>
                                    <a href="https://t.me/sirandrewgotham" class="btn btn-social-icon btn-twitter btn-sm"><i class="fa fa-twitter"></i></a>
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
