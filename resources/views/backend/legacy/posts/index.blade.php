@extends('backend.legacy.layouts.app')

@section('meta-title')
    {{ __('Posts') }}
@stop

@section('page-title')
    {{ __('Posts') }} <a href="{{ route('admin.posts.create') }}" class="btn btn-sm btn-primary">{{ __('Create a New Post') }}</a>
@stop

@section('breadcrumb-title')
    {{ __('Posts') }}
@stop

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
        @forelse($posts as $post)
            <tr>
                <td>{{ $post->title }}</td>
                <td>/blog/{{ $post->slug }}</td>
                <td><a href="{{ route('admin.users.show', $post->user->slug) }}" target="_blank">{{ $post->user->name }}</a></td>
                <td>{{ $post->updated_at->diffForHumans() }}</td>
                <td><a href="{{ route('admin.posts.show', $post->slug) }}" class="btn btn-info" target="_blank"><i class="fa fa-eye"></i>
                    {{ __('View') }}</a>
                    <a href="{{ route('admin.posts.edit', $post->slug) }}" class="btn btn-warning"><i class="fa fa-pencil"></i>
                        {{ __('Edit') }}</a>
                    <a href="{{ route('admin.posts.destroy', $post->slug) }}" class="btn btn-danger"><i class="fa fa-trash-o"></i>
                        {{ __('Delete') }}</a></td>
            </tr>
        @empty
            <tr>
                <td colspan="6">{{ __('No Posts found.') }}</td>
            </tr>
        @endforelse
    </table>
@stop
