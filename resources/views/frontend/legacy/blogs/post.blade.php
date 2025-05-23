<div class="blog-post mb40">
    @if($links == true)
        <a href="{{ route('blog.show', $post->slug) }}">
            <img class="img-responsive full-width" src="{{ asset('uploads/posts/'.$post->image) }}" alt="{{ $post->title }}">
        </a>
    @else
        <img class="img-responsive full-width" src="{{ asset('uploads/posts/'.$post->image) }}" alt="">
    @endif
    <div class="blog-post-holder">
        <ul class="list-inline posted-info">
{{--            <li>{{ trans('app.by') }} <a href="#">{{ $post->user->name }}</a></li>--}}
            <li>{{ $post->created_at->diffForHumans() }}</li>
{{--            @if(!empty($post->tags))--}}
            @if(!empty($tags))
                <li>
                    @foreach($post->tags as $tag)
{{--                    @foreach($tags as $tag)--}}
                        <a class="label label-info" href="{{ route('blog.tag.show', $tag) }}">{{ $tag->name }}</a>
                    @endforeach
                </li>
            @endif
        </ul>
        <hr align="left" class="mt15 mb10">
            <h2>{{ $post->title }}</h2>
        {!! $post->body !!}
    </div>
</div>
