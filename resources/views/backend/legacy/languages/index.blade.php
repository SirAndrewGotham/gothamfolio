@extends('backend.legacy.layouts.app')

@section('meta-title')
    {{ __('Languages') }}
@endsection

@section('page-title')
    {{ __('Languages') }}
{{--    <a href="{{ route('admin.languages.create') }}" class="btn btn-sm btn-primary">--}}
{{--        {{ __('Create new Language') }}--}}
{{--    </a>--}}
@endsection

@section('breadcrumb-title')
    {{ __('Languages') }}
@endsection

@section('content')
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Active') }}</th>
            <th>{{ __('Default') }}</th>
            <th>{{ __('Fallback') }}</th>
            <th>{{ __('Actions') }}</th>
        </tr>
        </thead>
        @forelse($languages as $language)
            <tr>
                <td>{{ $language->english }}</td>
                <td>{{ $language->is_active }}</td>
                <td>{{ $language->is_default }}</td>
                <td>{{ $language->fallback }}</td>
                <td>
                    <a href="{{ route('admin.languages.show', $language->slug) }}" class="btn btn-info">
                        <i class="fa fa-eye"></i>
                        {{ __('View') }}
                    </a>
                    <a href="{{ route('admin.languages.edit', $language->slug) }}" class="btn btn-warning">
                        <i class="fa fa-pencil"></i>
                        {{ __('Edit') }}
                    </a>
{{--                    <a href="{{ route('admin.languages.destroy', $language->slug) }}" class="btn btn-danger">--}}
{{--                        <i class="fa fa-trash-o"></i>--}}
{{--                        {{ __('Delete') }}--}}
{{--                    </a>--}}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">{{ __('No Languages found.') }}</td>
            </tr>
        @endforelse
    </table>
@endsection
