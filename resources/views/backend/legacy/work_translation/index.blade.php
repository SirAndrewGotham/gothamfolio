@extends('backend.legacy.layouts.app')

@section('meta-title')
    {{ __('Work Translations for') }}: "{{ $work->title }}"
@endsection

@section('page-title')
    {{ __('Work Translations for') }}: "{{ $work->title }}"
@endsection

@section('breadcrumb-title')
    {{ __('Work Translations') }}
@endsection

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.workTranslations.create', $work) }}" class="btn btn-default">
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
        @forelse($work->translations as $work)
            <tr>
                <td>
{{--                    @if (Storage::disk('public')->exists('uploads/works/'.$work->id.'/'.$work->image)) {--}}
                    @if (file_exists( public_path() . '/uploads/works/'.$work->id.'/'.$work->image)) {
                        <img src="{{ asset('uploads/works/'.$work->id.'/'.$work->image) }}" height="50px" >
                    @else
                        {{-- Put a placeholder here --}}
                    @endif
                </td>
                <td>
                    {{ $work->title }}
                </td>
                <td>
                    {!! $work->excerpt !!}
                </td>
                <td>
                    {{ $work->language->name }}
                </td>
                <td>
                    <a href="{{ route('admin.users.show', $work->user->slug) }}">
                        {{ $work->user->name }}
                    </a>
                </td>
                <td>
                    {{ $work->updated_at->diffForHumans() }}
                </td>
                <td>
                    <div class="row btn-group">
                        <div class="col-md-3">
                            <a href="{{ route('admin.workTranslations.show', $work) }}" class="btn btn-info">
                                <i class="fa fa-eye"></i>
                                {{ __('View') }}
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.workTranslations.edit', $work->slug) }}" class="btn btn-warning">
                                <i class="fa fa-pencil"></i>
                                {{ __('Edit') }}
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.workTranslations.translate', $work) }}" class="btn btn-default">
                                <i class="fa fa-pencil"></i>
                                {{ __('Translate') }}
                            </a>
                        </div>
                        <div class="col-md-3">
                            <form action="{{ route('admin.workTranslations.destroy', $work) }}" method="POST">
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
                <td colspan="6">{{ __('No Works found.') }}</td>
            </tr>
        @endforelse
    </table>
@endsection
