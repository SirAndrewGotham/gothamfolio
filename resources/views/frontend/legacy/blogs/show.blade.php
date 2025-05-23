@extends('frontend.legacy.layouts.app')

@section('content')
    @include('frontend.legacy.layouts._headerPage', ['pageName' => trans('app.frontend.blog.show.page-title', ['post_title' => $post->title]), 'pageNameBreadcrumb' => trans('app.frontend.blog.show.breadcrumb-title')])

    <section class="mt40 mb40">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    @include('frontend.legacy.blogs.post', ['links' => false])
                    {{-- Comments will go here --}}
{{--                    <div id="disqus_thread"></div>--}}
{{--                    <script type="text/javascript">--}}
{{--                        /* * * CONFIGURATION VARIABLES * * */--}}
{{--                        var disqus_shortname = 'sirandrewgotham';--}}

{{--                        /* * * DON'T EDIT BELOW THIS LINE * * */--}}
{{--                        (function() {--}}
{{--                            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;--}}
{{--                            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';--}}
{{--                            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);--}}
{{--                        })();--}}
{{--                    </script>--}}
{{--                    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>--}}
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
