<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\GalleryStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Models\Gallery;
use Illuminate\Database\Eloquent\Builder;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        [$galleries, $tags] = $this->prepareView();

        return view('frontend.legacy.galleries.index', compact('galleries', 'tags'));
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
    public function store(StoreGalleryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        //
    }

    public function prepareView($gallery = null): array
    {
        $languages = $this->getLanguages();

        $galleries = Gallery::where(function (Builder $query) {
            $query->where('status', GalleryStatus::Published);
            })
            ->orderBy('order', 'asc')
            ->with(['tags'])
            ->paginate(10);

        $tags = collect();

        foreach ($galleries as $gallery) {
            foreach ($gallery->tags as $tag) {
                if($tags->doesntContain('id', $tag->id)) {
                    $tags->push($tag);
                }
            }
        }

        return [$galleries, $tags];
    }
}
