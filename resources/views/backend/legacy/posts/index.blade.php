@extends('backend.legacy.layouts.app')

@section('meta-title')
    {{ __('Posts') }}
@endsection

@section('page-title')
    {{ __('Posts') }} <a href="{{ route('admin.posts.create') }}" class="btn btn-sm btn-primary">{{ __('Create a New Post') }}</a>
@endsection

@section('breadcrumb-title')
    {{ __('Posts') }}
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
        @forelse($posts as $post)
            <tr>
                <td>{{ $post->title }}</td>
                <td>/blog/{{ $post->slug }}</td>
                <td><a href="{{ route('admin.users.show', $post->user->slug) }}" target="_blank">{{ $post->user->name }}</a></td>
                <td>{{ $post->updated_at->diffForHumans() }}</td>
                <td>
                    <div class="row btn-group">
                        <div class="col-md-4">
                            <a href="{{ route('admin.postTranslations.index', $post->slug) }}" class="btn btn-info">
                                <i class="fa fa-eye"></i>
                                {{ __('View') }}
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.posts.edit', $post->slug) }}" class="btn btn-warning">
                                <i class="fa fa-pencil"></i>
                                {{ __('Edit') }}
                            </a>
                        </div>
                        <div class="col-md-4">
                            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash-o"></i> {{ __('Delete') }}
                                </button>
                            </form>
                        </div>
{{--                    <a href="{{ route('admin.posts.destroy', $post->slug) }}" class="btn btn-danger"><i class="fa fa-trash-o"></i>--}}
{{--                        {{ __('Delete') }}</a></td>--}}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">{{ __('No Posts found.') }}</td>
            </tr>
        @endforelse
    </table>
@endsection
