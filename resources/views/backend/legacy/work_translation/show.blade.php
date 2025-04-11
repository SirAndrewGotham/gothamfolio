@extends('backend.legacy.layouts.app')

@section('meta-title')
{{ __('Work') }} "{{ $work->title }}"
@endsection

@section('page-title')
    {{ __('Work') }} "{{ $work->title }}"
@endsection

@section('breadcrumb-title')
    {{ __('Work') }}
@endsection

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.works.edit', $work->slug) }}" class="btn btn-default">
            <i class="fa fa-pencil"></i>
            {{ __('Add translation') }}
        </a>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>{{ __('Cover') }}</th>
            <th>{{ __('Title') }}</th>
            <th>{{ __('Language') }}</th>
            <th>{{ __('Author') }}</th>
            <th>{{ __('Updated') }}</th>
            <th>{{ __('Actions') }}</th>
        </tr>
        </thead>
        @forelse($work->translations as $work)
            <tr>
                <td>
                    <img src="{{ asset('uploads/works/'.$work->id.'/'.$work->image) }}" height="50px" >
                </td>
                <td>
                    {{ $work->title }}
                </td>
                <td>
                    {{ $work->language->name }}
                </td>
                <td>
                    <a href="{{ route('admin.users.show', $work->user->slug) }}" target="_blank">
                        {{ $work->user->name }}
                    </a>
                </td>
                <td>
                    {{ $work->updated_at->diffForHumans() }}
                </td>
                <td>
                    <a href="{{ route('admin.workTranslations.show', $work->slug) }}" class="btn btn-info" target="_blank">
                        <i class="fa fa-eye"></i>
                        {{ __('View') }}
                    </a>
                    <a href="{{ route('admin.workTranslations.edit', $work->slug) }}" class="btn btn-warning">
                        <i class="fa fa-pencil"></i>
                        {{ __('Edit') }}
                    </a>
                    <a href="{{ route('admin.workTranslations.create', $work->slug) }}" class="btn btn-default">
                        <i class="fa fa-pencil"></i>
                        {{ __('Translate') }}
                    </a>
                    <a href="{{ route('admin.workTranslations.destroy', $work->slug) }}" class="btn btn-danger">
                        <i class="fa fa-trash-o"></i>
                        {{ __('Delete') }}
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">{{ __('No Works found.') }}</td>
            </tr>
        @endforelse
    </table>
@endsection
