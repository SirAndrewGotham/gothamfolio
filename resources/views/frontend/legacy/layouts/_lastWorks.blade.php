{{--@if($works->count() > 0)--}}
    <div id="owl-carousel-thumb" class="owl-carousel">
        @foreach($works as $work)
            <div>
                <div class="thumbnail">
                    <div class="caption">
                        <div class="thumbnail-caption-holder">
                            <h4 class="text-white">{{ $work->title }}</h4>
                            <a href="{{ route('works.show', $work->slug) }}" class="btn btn-rw btn-clear"><span class="ion-android-search"></span> View</a>
                        </div>
                    </div>
{{--                    {{ dd($work) }}--}}
{{--                    <img src="{{ asset($work->image) }}" alt="...">--}}
                    <img class="img-responsive" src="{{ asset('uploads/works/'.$work->work_id.'/'.$work->image) }}" alt="{{ $work->title }}" style="width: auto; height: 200px;" />
                </div>
            </div>
        @endforeach
    </div>
{{--@else--}}
{{--    <p>{{ trans('app.frontend.home.recent-work.no-work-found') }}</p>--}}
{{--@endif--}}
