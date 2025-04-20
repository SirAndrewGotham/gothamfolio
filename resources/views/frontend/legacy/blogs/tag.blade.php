@extends('frontend.legacy.layouts.app')

@section('content')
    @include('frontend.legacy.layouts._headerPage', ['pageName' => trans('app.frontend.blog.tag.page-title', ['tag_name' => $tag->name]), 'pageNameBreadcrumb' => trans('app.frontend.blog.tag.breadcrumb-title')])

    <section class="mt40 mb40">
        <div class="container">
            <div class="row">
                <!-- Blog Posts -->
                <div class="col-sm-8">
                    @forelse($posts as $post)
                        @include('frontend.legacy.blogs.blocks.post', ['links' => true])
                    @empty
                        <p>
                            {{ trans('app.frontend.blog.tag.no-post-found') }}
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
@endsection
