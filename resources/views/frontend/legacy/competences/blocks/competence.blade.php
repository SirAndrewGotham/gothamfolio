<div class="competence mb40">
    @if($links == true)
        <a href="{{ route('blog.show', $competence->slug) }}">
            <img class="img-responsive full-width" src="{{ asset('uploads/competences/'.$competence->image) }}" alt="{{ $competence->title }}">
        </a>
    @else
        <img class="img-responsive full-width" src="{{ asset('uploads/competences/'.$competence->image) }}" alt="">
    @endif
    <div class="competence-holder">
        <ul class="list-inline competence-info">
{{--            <li>{{ trans('app.by') }} <a href="#">{{ $competence->user->name }}</a></li>--}}
            <li>{{ $competence->created_at->diffForHumans() }}</li>
{{--            @if(!empty($competence->tags))--}}
            @if(!empty($tags))
                <li>
                    @foreach($competence->tags as $tag)
{{--                    @foreach($tags as $tag)--}}
                        <a class="label label-info" href="{{ route('blog.tag.show', $tag) }}">{{ $tag->name }}</a>
                    @endforeach
                </li>
            @endif
        </ul>
        <hr class="mt15 mb10">
        @if($links == true)
            <h2><a href="{{ route('blog.show', $competence->slug) }}">{{ $competence->title }}</a></h2>
        @else
            <h2>{{ $competence->title }}</h2>
        @endif
        {!! $competence->excerpt !!}
        <a href="{{ route('blog.show', $competence->slug) }}" class="btn btn-rw btn-primary mt10">{{ trans('app.btn-read-more') }}</a>
    </div>
</div>
