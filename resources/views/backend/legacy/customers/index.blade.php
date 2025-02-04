@extends('backend.legacy.layouts.app')

@section('meta-title')
    {{ __('Customers') }}
@stop

@section('page-title')
    {{ __('Customers') }} <a href="{{ route('admin.customers.create') }}" class="btn btn-sm btn-primary">{{ __('Create New Customer') }}</a>
@stop

@section('breadcrumb-title')
    {{ __('Customers') }}
@stop

@section('content')
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>{{ __('Label') }}</th>
            <th>{{ __('Description') }}</th>
            <th>{{ __('Image') }}</th>
            <th>{{ __('Updated') }}</th>
            <th>{{ __('Actions') }}</th>
        </tr>
        </thead>
        @forelse($customers as $customer)
            <tr>
                <td>{{ $customer->label }}</td>
                <td>{{ $customer->description }}</td>
                <td>
                    @if($customer->image !== null)
                        <img class="img-responsive" src="{{ $customer->image }}" alt="">
                    @endif
                </td>
                <td>{{ $customer->updated_at->diffForHumans() }}</td>
                <td><a href="{{ route('admin.customers.show', $customer->id) }}" class="btn btn-info" target="_blank"><i class="fa fa-eye"></i>
                    {{ __('View') }}</a>
                    <a href="{{ route('admin.customers.edit', $customer->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i>
                        {{ __('Edit') }}</a>
                    <a href="{{ route('admin.customers.destroy', $customer->id) }}" class="btn btn-danger"><i class="fa fa-trash-o"></i>
                        {{ __('Delete') }}</a></td>
            </tr>
        @empty
            <tr>
                <td colspan="6">{{ __('No Customers Found.') }}</td>
            </tr>
        @endforelse
    </table>
@stop
