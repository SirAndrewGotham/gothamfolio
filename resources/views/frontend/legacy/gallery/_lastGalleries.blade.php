@php use App\Models\Gallery; @endphp
@if(Gallery::all()->count() > 0)
    <div class="col-sm-3 hidden-xs">
        <div class="heading-footer"><h4>{{ trans('app.blocks.common.last-galleries.title') }}</h4></div>
        <ul class="list-arrow">
            @forelse(Gallery::latest()->take(5)->get() as $gallery)
                <li><a href="{{ route('galleries.show', $gallery->slug) }}">{{ $gallery->title }}</a></li>
            @empty
                <li><p>{{ trans('app.blocks.common.last-galleries.no-gallery-found') }}</p></li>
            @endforelse
        </ul>
    </div>
@else
    <div class="col-sm-3 hidden-xs">
        <div class="heading-footer">
            <h4>
                {{ trans('app.blocks.common.last-galleries.title') }}
            </h4>
        </div>
        {{ trans('app.blocks.common.no-galleries') }}
    </div>
@endif
