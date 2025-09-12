<div class="blog-heading">
    <h3>{{ trans('app.blocks.blog.last-competences.title') }}</h3>
</div>
<ul class="list-unstyled latest-competences">
    @forelse($lastCompetences as $competence)
        <li>
            <h3 class="no-margin"><a href="{{ route('blog.show', ['slug', $competence->slug]) }}">{{ $competence->title }}</a></h3>
            <small>
                <ul class="list-inline competence-info">
                    <li>{{ $competence->created_at->diffForHumans() }}</li>
                </ul>
            </small>
            {!! $competence->excerpt !!}
        </li>
    @empty
        <li>{{ trans('app.blocks.blog.last-competences.no-competences-found') }}</li>
    @endforelse
</ul>
