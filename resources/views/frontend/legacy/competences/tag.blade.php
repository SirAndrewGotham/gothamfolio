@extends('frontend.legacy.layouts.app')

@section('content')
    @include('frontend.legacy.layouts._headerPage', ['pageName' => trans('app.frontend.blog.tag.page-title', ['tag_name' => $tag->name]), 'pageNameBreadcrumb' => trans('app.frontend.blog.tag.breadcrumb-title')])

    <section class="mt40 mb40">
        <div class="container">
            <div class="row">
                <!-- Competences -->
                <div class="col-sm-8">
                    @forelse($competences as $competence)
                        @include('frontend.legacy.competences.blocks.competence', ['links' => true])
                    @empty
                        <p>
                            {{ trans('app.frontend.blog.tag.no-competences-found') }}
                        </p>
                    @endforelse

                    <nav class="text-center">
                        {!! $competences->render() !!}
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
