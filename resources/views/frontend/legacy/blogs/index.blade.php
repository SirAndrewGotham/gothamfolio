@extends('frontend.legacy.layouts.app')

@section('content')
    @include('frontend.legacy.layouts._headerPage', ['pageName' => trans('app.frontend.blog.index.page-title'), 'pageNameBreadcrumb' => trans('app.frontend.blog.index.breadcrumb-title')])

    <section class="mt40 mb40">
        <div class="container">
            <div class="row">
                <!-- Blog Posts -->
                <div class="col-sm-8">
                    @forelse($posts as $post)
                        @include('frontend.legacy.blogs.post', ['links' => true])
                    @empty
                        <p>
                            {{ trans('app.frontend.blog.index.no-post-found') }}
                        </p>
                    @endforelse

                    <nav class="text-center">
                        {!! $posts->render() !!}
                    </nav>
                </div>

                <!-- Sidebar -->
                <div class="col-sm-4">
                    @include('frontend.legacy.blogs.sidebar')
                </div>
                <!-- /Sidebar -->
            </div>
        </div>
    </section>
@stop
