@extends('backend.legacy.layouts.app')

@section('meta-title')
    {{ __('Read Feedback') }}
@endsection

@section('page-title')
    {{ __('Read Feedback') }}
@endsection

@section('breadcrumb-title')
    {{ __('Read Feedback') }}
@endsection

@section('content')
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Email') }}</th>
            <th>{{ __('Created') }}</th>
            <th>{{ __('Content') }}</th>
            <th>{{ __('Read') }}</th>
            <th>{{ __('Actions') }}</th>
        </tr>
        </thead>
        @forelse($feedbacks->where('read', true) as $feedback)
{{--            {{ dd($feedback) }}--}}
            <tr>
                <td>{{ $feedback->name }}</td>
                <td>{{ $feedback->email }}</td>
                <td>{{ $feedback->created_at }}</td>
                <td>{{ $feedback->message }}</td>
                <td>{{ $feedback->read }}</td>
                <td>
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{ route('admin.feedback.unread', $feedback) }}" class="btn btn-default">
                                <i class="fa fa-check"></i>
                                {{ __('Unread') }}
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{-- route('admin.feedback.show', $feedback) --}}" class="btn btn-info">
                                <i class="fa fa-eye"></i>
                                {{ __('View') }}
                            </a>
                        </div>
                        <div class="col-md-3">
                            <form action="{{ route('admin.feedback.destroy', $feedback) }}" class="btn btn-warning" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-link btn-anchor"><i class="fa fa-trash-o"></i> {{ __('Delete') }}</button>
                            </form>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.feedback.forceDelete', $feedback) }}" class="btn btn-danger">
                                <i class="fa fa-trash-o"></i>
                                {{ __('Force delete') }}
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">{{ __('No read feedback found.') }}</td>
            </tr>
        @endforelse
    </table>
    {{ $feedbacks->links() }}
@endsection
