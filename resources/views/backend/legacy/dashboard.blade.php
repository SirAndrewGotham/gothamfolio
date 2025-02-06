@extends('backend.legacy.layouts.app')

@section('meta-title')
{{ __('Dashboard') }}
@endsection

@section('page-title')
{{ __('Dashboard') }}
@endsection

@section('breadcrumb-title')
{{ __('Dashboard') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ $postsCount }}</h3>
                    <p>{{ __('Blog Posts') }}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-wordpress"></i>
                </div>
                <a href="{{ route('admin.posts.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $worksCount }}</h3>
                    <p>{{ __('Work Entries') }}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-briefcase"></i>
                </div>
                <a href="{{ route('admin.works.index') }}" class="small-box-footer">{{ __('More info') }} <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ $customersCount }}</h3>
                    <p>{{ __('Customers') }}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="{{ route('admin.customers.index') }}" class="small-box-footer">{{ __('More info') }} <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ $usersCount }}</h3>
                    <p>{{ __('Registered Users') }}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user"></i>
                </div>
                <a href="{{ route('admin.users.index') }}" class="small-box-footer">{{ __('More info') }} <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
@endsection
