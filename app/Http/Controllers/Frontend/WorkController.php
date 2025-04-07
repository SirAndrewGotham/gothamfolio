<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\WorkStatus;
use App\Http\Requests\StoreWorkRequest;
use App\Http\Requests\UpdateWorkRequest;
use App\Models\Language;
use App\Models\Work;
use App\Models\WorkTranslation;
use Illuminate\Database\Eloquent\Builder;

class WorkController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        [$works, $tags] = $this->prepareIndex();

        return view('frontend.legacy.works.index', compact('works', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(WorkTranslation $work)
    {
        // TODO: implement language procedures
        $works = WorkTranslation::where('work_id','!=',$work->id)->latest()->take(5)->get();

        $work->increment('views');
        $work->saveQuietly();

        return view('frontend.legacy.works.show', compact('work', 'works'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Work $work)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkRequest $request, Work $work)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Work $work)
    {
        //
    }

    public function prepareIndex(): array
    {
        $languages[] = Language::where('code', app()->getLocale())->first()->id;
        if (auth()->check()) {
            $languages = Language::where('id', auth()->user()->language_id)->pluck('id');
            if (auth()->user()->languages) {
                $languages = auth()->user()->languages->pluck('id');
            }
        }

        $works = WorkTranslation::where(function (Builder $query) {
            $query->where('status', WorkStatus::Published)
                ->where(function (Builder $query) {
                    $query->whereNull('published_at')
                        ->orWhere('published_at', '<=', now());
                })
                ->where(function (Builder $query) {
                    $query->whereNull('published_through')
                        ->orWhere('published_through', '>=', now());
                });
        })
            ->whereIn('language_id', $languages)
//            ->latest()
            ->orderBy('order', 'asc')
            ->with(['tags'])
            ->paginate(10);

        $tags = collect();

        foreach ($works as $work) {
            foreach ($work->tags as $tag) {
                if($tags->doesntContain('id', $tag->id)) {
                    $tags->push($tag);
                }
            }
        }

        return [$works, $tags];
    }
}
