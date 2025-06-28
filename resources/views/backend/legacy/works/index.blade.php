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
                <th>{{ __('Author') }}</th>
                <th>{{ __('Updated') }}</th>
                <th>{{ __('Languages') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        @forelse($works as $work)
            <tr>
                <td>{{ $work->title }}</td>
                <td><a href="{{ route('admin.users.show', $work->user->slug) }}" target="_blank">{{ $work->user->name }}</a></td>
                <td>{{ $work->updated_at->diffForHumans() }}</td>
                <td>
                    @foreach($work->translations as $translation)
                        <a href="{{ route('admin.workTranslations.show', $translation->slug) }}">
                            <i class="fa fa-eye"></i>&nbsp;
                            {{ $translation->language->code }}
                            <br />
                        </a>
                    @endforeach
                </td>
                <td>
                    <div class="row btn-group">
                        <div class="col-md-4">
                            <a href="{{ route('admin.workTranslations.index', $work->slug) }}" class="btn btn-info">
                                <i class="fa fa-eye"></i>
                                {{ __('View') }}
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.works.edit', $work->slug) }}" class="btn btn-warning">
                                <i class="fa fa-pencil"></i>
                                {{ __('Edit') }}
                            </a>
                        </div>
                        <div class="col-md-4">
                            <form action="{{ route('admin.works.destroy', $work) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash-o"></i> {{ __('Delete') }}
                                </button>
                            </form>
                        </div>
{{--                    <a href="{{ route('admin.works.destroy', $work->slug) }}" class="btn btn-danger"><i class="fa fa-trash-o"></i>--}}
{{--                        {{ __('Delete') }}</a></td>--}}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">{{ __('No Works found.') }}</td>
            </tr>
        @endforelse
    </table>
@endsection
