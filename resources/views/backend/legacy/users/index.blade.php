@extends('backend.legacy.layouts.app')

@section('meta-title')
    {{ __('Users') }}
@endsection

@section('page-title')
    {{ __('Users') }} <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-primary">{{ __('Create New User') }}</a>
@endsection

@section('breadcrumb-title')
    Users
@endsection

@section('content')
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Email') }}</th>
            <th>{{ __('Member Since') }}</th>
            <th>{{ __('Actions') }}</th>
        </tr>
        </thead>
        @forelse($users as $user)
            <tr>
                <td><img src="//www.gravatar.com/avatar/{{ md5($user->email) }}?s=20" class="img-circle" alt="User Image"> {{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->diffForHumans() }}</td>
                <td><a href="{{ route('admin.users.show', $user->slug) }}" class="btn btn-info" target="_blank"><i class="fa fa-eye"></i> View</a>
                    <a href="{{ route('admin.users.edit', $user->slug) }}" class="btn btn-warning"><i class="fa fa-pencil"></i>
                        {{ __('Edit') }}</a>
                    <a href="{{ route('admin.users.destroy', $user->slug) }}" class="btn btn-danger"><i class="fa fa-trash-o"></i>
                        {{ __('Delete') }}</a></td>
            </tr>
        @empty
            <tr>
                <td colspan="6">{{ __('No Users found.') }}</td>
            </tr>
        @endforelse
    </table>
@endsection
