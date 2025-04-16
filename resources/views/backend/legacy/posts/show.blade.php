@extends('backend.legacy.layouts.app')

@section('meta-title')
    {{ __('Post') }} "{{ $post->title }}"
@endsection

@section('page-title')
    {{ __('Post') }} "{{ $post->title }}"
@endsection

@section('breadcrumb-title')
    {{ __('Post') }}
@endsection

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.posts.edit', $post->slug) }}" class="btn btn-default">
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
        @forelse($post->translations as $post)
            <tr>
                <td>
                    <img src="{{ asset('uploads/posts/'.$post->id.'/'.$post->image) }}" height="50px" >
                </td>
                <td>
                    {{ $post->title }}
                </td>
                <td>
                    {{ $post->language->name }}
                </td>
                <td>
                    <a href="{{ route('admin.users.show', $work->user->slug) }}">
                        {{ $post->user->name }}
                    </a>
                </td>
                <td>
                    {{ $post->updated_at->diffForHumans() }}
                </td>
                <td>
                    <a href="{{ route('admin.postTranslations.show', $post->slug) }}" class="btn btn-info">
                        <i class="fa fa-eye"></i>
                        {{ __('View') }}
                    </a>
                    <a href="{{ route('admin.post.edit', $post->slug) }}" class="btn btn-warning">
                        <i class="fa fa-pencil"></i>
                        {{ __('Edit') }}
                    </a>
                    <a href="{{ route('admin.postTranslations.create', $post->slug) }}" class="btn btn-default">
                        <i class="fa fa-pencil"></i>
                        {{ __('Translate') }}
                    </a>
                    <a href="{{ route('admin.post.destroy', $post->slug) }}" class="btn btn-danger">
                        <i class="fa fa-trash-o"></i>
                        {{ __('Delete') }}
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">{{ __('No Posts found.') }}</td>
            </tr>
        @endforelse
    </table>
@endsection
