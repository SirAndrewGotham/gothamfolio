@extends('backend.legacy.layouts.app')

@section('meta-title')
    {{ __('Post Translations for') }}: "{{ $post->title }}"
@endsection

@section('page-title')
    {{ __('Post Translations for') }}: "{{ $post->title }}"
@endsection

@section('breadcrumb-title')
    {{ __('Post Translations') }}
@endsection

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.postTranslations.create', $post) }}" class="btn btn-default">
            <i class="fa fa-pencil"></i>
            {{ __('Add translation') }}
        </a>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>{{ __('Cover') }}</th>
            <th>{{ __('Title') }}</th>
            <th>{{ __('Excerpt') }}</th>
            <th>{{ __('Language') }}</th>
            <th>{{ __('Author') }}</th>
            <th>{{ __('Updated') }}</th>
            <th>{{ __('Actions') }}</th>
        </tr>
        </thead>
        @forelse($post->translations as $post)
            <tr>
                <td>
{{--                    @if (Storage::disk('public')->exists('uploads/posts/'.$post->id.'/'.$post->image)) {--}}
                    @if (file_exists( public_path() . '/uploads/posts/'.$post->id.'/'.$post->image)) {
                        <img src="{{ asset('uploads/posts/'.$post->id.'/'.$post->image) }}" height="50px" >
                    @else
                        {{-- Put a placeholder here --}}
                    @endif
                </td>
                <td>
                    {{ $post->title }}
                </td>
                <td>
                    {!! $post->excerpt !!}
                </td>
                <td>
                    {{ $post->language->name }}
                </td>
                <td>
                    <a href="{{ route('admin.users.show', $post->user->slug) }}">
                        {{ $post->user->name }}
                    </a>
                </td>
                <td>
                    {{ $post->updated_at->diffForHumans() }}
                </td>
                <td>
                    <div class="row btn-group">
                        <div class="col-md-3">
                            <a href="{{ route('admin.postTranslations.show', $post) }}" class="btn btn-info">
                                <i class="fa fa-eye"></i>
                                {{ __('View') }}
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.postTranslations.edit', $post->slug) }}" class="btn btn-warning">
                                <i class="fa fa-pencil"></i>
                                {{ __('Edit') }}
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.postTranslations.translate', $post) }}" class="btn btn-default">
                                <i class="fa fa-pencil"></i>
                                {{ __('Translate') }}
                            </a>
                        </div>
                        <div class="col-md-3">
                            <form action="{{ route('admin.postTranslations.destroy', $post) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i> {{ __('Delete') }}</button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">{{ __('No Posts found.') }}</td>
            </tr>
        @endforelse
    </table>
@endsection
