@extends('backend.legacy.layouts.app')

@section('meta-title')
    {{ __('User') }} "{{ $user->name }}"
@stop

@section('page-title')
    {{ __('User') }} "{{ $user->name }}"
@stop

@section('breadcrumb-title')
    {{ __('User Details') }}
@stop

@section('content')
    <section class="mt40 mb40">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="blog-post mb40">
                        <div class="blog-post-holder">
                            <h1>{{ $user->name }}</h1>
                            <h3>{{ $user->email }}</h3>
                            <h3><img src="//www.gravatar.com/avatar/{{ md5($user->email) }}?s=90" class="img-circle" alt="User Image"></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
