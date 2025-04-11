@extends('backend.legacy.layouts.app')

@section('meta-title')
{{ __('Work Translation') }}: "{{ $workTranslation->title }}"
@endsection

@section('page-title')
    {{ __('Work Translation') }}: "{{ $workTranslation->title }}"
@endsection

@section('breadcrumb-title')
    {{ __('Work Translation') }}
@endsection

@section('content')
    <section class="mt40 mb40">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="work-translation mb40">
                        <img class="img-responsive full-width" src="{{ asset('uploads/works/'.$workTranslation->id.'/'.$workTranslation->image) }}" alt="">
                        <div>&nbsp;</div>
                        <div class="work-translation-holder mt-3">
                            <ul class="list-inline posted-info">
                                <li>{{ __('By') }} {{ $workTranslation->user->name }}</li>
                                <li>{{ $workTranslation->title }}</a></li>
                                <li>{!! $workTranslation->excerpt !!}</a></li>
                                <li>{{ $workTranslation->created_at }} ({{ $workTranslation->created_at->diffForHumans() }})</li>
                            </ul>
                            <hr align="left" class="mt15 mb10">
                            {!! $workTranslation->body !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

{{--    <table class="table table-bordered">--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th>{{ __('Cover') }}</th>--}}
{{--            <th>{{ __('Title') }}</th>--}}
{{--            <th>{{ __('Language') }}</th>--}}
{{--            <th>{{ __('Author') }}</th>--}}
{{--            <th>{{ __('Updated') }}</th>--}}
{{--            <th>{{ __('Actions') }}</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        @forelse($workTranslation->translations as $work)--}}
{{--            <tr>--}}
{{--                <td>--}}
{{--                    <img src="{{ asset('uploads/works/'.$workTranslation->id.'/'.$workTranslation->image) }}" height="50px" >--}}
{{--                </td>--}}
{{--                <td>--}}
{{--                    {{ $workTranslation->title }}--}}
{{--                </td>--}}
{{--                <td>--}}
{{--                    {{ $workTranslation->language->name }}--}}
{{--                </td>--}}
{{--                <td>--}}
{{--                    <a href="{{ route('admin.users.show', $workTranslation->user->slug) }}" target="_blank">--}}
{{--                        {{ $workTranslation->user->name }}--}}
{{--                    </a>--}}
{{--                </td>--}}
{{--                <td>--}}
{{--                    {{ $workTranslation->updated_at->diffForHumans() }}--}}
{{--                </td>--}}
{{--                <td>--}}
{{--                    <a href="{{ route('admin.workTranslations.show', $workTranslation->slug) }}" class="btn btn-info" target="_blank">--}}
{{--                        <i class="fa fa-eye"></i>--}}
{{--                        {{ __('View') }}--}}
{{--                    </a>--}}
{{--                    <a href="{{ route('admin.workTranslations.edit', $workTranslation->slug) }}" class="btn btn-warning">--}}
{{--                        <i class="fa fa-pencil"></i>--}}
{{--                        {{ __('Edit') }}--}}
{{--                    </a>--}}
{{--                    <a href="{{ route('admin.workTranslations.create', $workTranslation->slug) }}" class="btn btn-default">--}}
{{--                        <i class="fa fa-pencil"></i>--}}
{{--                        {{ __('Translate') }}--}}
{{--                    </a>--}}
{{--                    <a href="{{ route('admin.workTranslations.destroy', $workTranslation->slug) }}" class="btn btn-danger">--}}
{{--                        <i class="fa fa-trash-o"></i>--}}
{{--                        {{ __('Delete') }}--}}
{{--                    </a>--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--        @empty--}}
{{--            <tr>--}}
{{--                <td colspan="6">{{ __('No Works found.') }}</td>--}}
{{--            </tr>--}}
{{--        @endforelse--}}
{{--    </table>--}}
@endsection
