@extends('backend.legacy.layouts.app')

@section('meta-title')
    {{ __('Works') }}
@endsection

@section('page-title')
    {{ __('Works') }} <a href="{{ route('admin.works.create') }}" class="btn btn-sm btn-primary">{{ __('Create new Work') }}</a>
@endsection

@section('breadcrumb-title')
    {{ __('Works') }}
@endsection

@section('content')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>{{ __('Title') }}</th>
                <th>{{ __('URL') }}</th>
                <th>{{ __('Author') }}</th>
                <th>{{ __('Updated') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        @forelse($works as $work)
            <tr>
                <td>{{ $work->title }}</td>
                <td>/works/{{ $work->slug }}</td>
                <td><a href="{{ route('admin.users.show', $work->user->slug) }}" target="_blank">{{ $work->user->name }}</a></td>
                <td>{{ $work->updated_at->diffForHumans() }}</td>
                <td><a href="{{ route('admin.works.show', $work->slug) }}" class="btn btn-info" target="_blank"><i class="fa fa-eye"></i>
                    {{ __('View') }}</a>
                    <a href="{{ route('admin.works.edit', $work->slug) }}" class="btn btn-warning"><i class="fa fa-pencil"></i>
                        {{ __('Edit') }}</a>
                    <a href="{{ route('admin.works.destroy', $work->slug) }}" class="btn btn-danger"><i class="fa fa-trash-o"></i>
                        {{ __('Delete') }}</a></td>
            </tr>
        @empty
            <tr>
                <td colspan="6">{{ __('No Works found.') }}</td>
            </tr>
        @endforelse
    </table>
@endsection
