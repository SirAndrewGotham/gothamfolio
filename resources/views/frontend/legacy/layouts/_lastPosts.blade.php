@php use App\Models\Post; @endphp
@if(Post::all()->count() > 0)
    <div class="col-sm-3 hidden-xs">
        <div class="heading-footer"><h4>{{ trans('app.blocks.common.last-posts.title') }}</h4></div>
        <ul class="list-arrow">
            @forelse(Post::latest()->take(5)->get() as $post)
                <li><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></li>
            @empty
                <li><p>{{ trans('app.blocks.common.last-posts.no-post-found') }}</p></li>
            @endforelse
        </ul>
    </div>
@else
    <div class="col-sm-3 hidden-xs">
        <div class="heading-footer">
            <h4>
                {{ trans('app.blocks.common.last-posts.title') }}
            </h4>
        </div>
        {{ trans('app.blocks.common.no-posts') }}
    </div>
@endif
