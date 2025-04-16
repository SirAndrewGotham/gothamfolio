@extends('backend.legacy.layouts.app')

@section('meta-title')
{{ __('Post Translation') }}: "{{ $postTranslation->title }}"
@endsection

@section('page-title')
    {{ __('Post Translation') }}: "{{ $postTranslation->title }}"
@endsection

@section('breadcrumb-title')
    {{ __('Post Translation') }}
@endsection

@section('content')
    <section class="mt40 mb40">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="post-translation mb40">
                        <img class="img-responsive full-width" src="{{ asset('uploads/posts/'.$postTranslation->id.'/'.$postTranslation->image) }}" alt="">
                        <div>&nbsp;</div>
                        <div class="post-translation-holder mt-3">
                            <ul class="list-inline posted-info">
                                <li>{{ __('By') }} {{ $postTranslation->user->name }}</li>
                                <li>{{ $postTranslation->title }}</a></li>
                                <li>{!! $postTranslation->excerpt !!}</a></li>
                                <li>{{ $postTranslation->created_at }} ({{ $postTranslation->created_at->diffForHumans() }})</li>
                            </ul>
                            <hr align="left" class="mt15 mb10">
                            {!! $postTranslation->body !!}
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
{{--        @forelse($postTranslation->translations as $post)--}}
{{--            <tr>--}}
{{--                <td>--}}
{{--                    <img src="{{ asset('uploads/posts/'.$postTranslation->id.'/'.$postTranslation->image) }}" height="50px" >--}}
{{--                </td>--}}
{{--                <td>--}}
{{--                    {{ $postTranslation->title }}--}}
{{--                </td>--}}
{{--                <td>--}}
{{--                    {{ $postTranslation->language->name }}--}}
{{--                </td>--}}
{{--                <td>--}}
{{--                    <a href="{{ route('admin.users.show', $postTranslation->user->slug) }}" target="_blank">--}}
{{--                        {{ $postTranslation->user->name }}--}}
{{--                    </a>--}}
{{--                </td>--}}
{{--                <td>--}}
{{--                    {{ $postTranslation->updated_at->diffForHumans() }}--}}
{{--                </td>--}}
{{--                <td>--}}
{{--                    <a href="{{ route('admin.postTranslations.show', $postTranslation->slug) }}" class="btn btn-info" target="_blank">--}}
{{--                        <i class="fa fa-eye"></i>--}}
{{--                        {{ __('View') }}--}}
{{--                    </a>--}}
{{--                    <a href="{{ route('admin.postTranslations.edit', $postTranslation->slug) }}" class="btn btn-warning">--}}
{{--                        <i class="fa fa-pencil"></i>--}}
{{--                        {{ __('Edit') }}--}}
{{--                    </a>--}}
{{--                    <a href="{{ route('admin.postTranslations.create', $postTranslation->slug) }}" class="btn btn-default">--}}
{{--                        <i class="fa fa-pencil"></i>--}}
{{--                        {{ __('Translate') }}--}}
{{--                    </a>--}}
{{--                    <a href="{{ route('admin.postTranslations.destroy', $postTranslation->slug) }}" class="btn btn-danger">--}}
{{--                        <i class="fa fa-trash-o"></i>--}}
{{--                        {{ __('Delete') }}--}}
{{--                    </a>--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--        @empty--}}
{{--            <tr>--}}
{{--                <td colspan="6">{{ __('No Posts found.') }}</td>--}}
{{--            </tr>--}}
{{--        @endforelse--}}
{{--    </table>--}}
@endsection
