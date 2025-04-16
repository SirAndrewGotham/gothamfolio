@extends('backend.legacy.layouts.app')

@section('meta-title')
    {{ __('Tags') }}
@endsection

@section('page-title')
    {{ __('Tags') }} <a href="{{ route('admin.tags.create') }}" class="btn btn-sm btn-primary">{{ __('Create New Tag') }}</a>
@endsection

@section('breadcrumb-title')
    {{ __('Tags') }}
@endsection

@section('content')
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>{{ __('Name') }}</th>
            <th>{{ __('URL') }}</th>
            <th>{{ __('Updated') }}</th>
            <th>{{ __('Actions') }}</th>
        </tr>
        </thead>
        @forelse($tags as $tag)
            <tr>
                <td>{{ $tag->name }}</td>
                <td><a href="{{-- route('works.tag', $tag->slug) --}}" target="_blank">/works/tag/{{ $tag->slug }}</a></td>
                <td>{{-- $tag->updated_at->diffForHumans() --}}</td>
                <td><a href="{{ route('admin.tags.show', $tag->id) }}" class="btn btn-info" target="_blank"><i class="fa fa-eye"></i>
                    {{ __('View') }}</a>
                    <a href="{{ route('admin.tags.edit', $tag->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i>
                        {{ __('Edit') }}</a>
                    <a href="{{ route('admin.tags.destroy', $tag->id) }}" class="btn btn-danger"><i class="fa fa-trash-o"></i>
                        {{ __('Delete') }}</a></td>
            </tr>
        @empty
            <tr>
                <td colspan="6">{{ __('No Tags Found.') }}</td>
            </tr>
        @endforelse
    </table>
@endsection
