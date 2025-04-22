<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\GalleryStatus;
use App\Enums\ImageStatus;
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

        return view('frontend.legacy.gallery.index', compact('galleries', 'tags'));
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
        // TODO: implement language procedures
        //        $galleries = Gallery::where('gallery_id','!=',$gallery->id)->latest()->take(5)->get();

        [$galleries, $tags, $images] = $this->prepareView($gallery);

        $gallery->increment('views');
        $gallery->saveQuietly();

        return view('frontend.legacy.gallery.show', compact('gallery', 'galleries', 'tags', 'images'));
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

    public function prepareView($gallery = null, $tags = null, $images = null): array
    {
        //        $languages = $this->getLanguages();

        if ($gallery == null) {
            $galleries = $this->prepareIndexGalleries();
        } else {
            $images = collect();
            foreach ($gallery->images as $image) {
                if ($image->status == ImageStatus::Published->value) {
                    $images->push($image);
                }
            }
            $galleries = $this->prepareShowGalleries($gallery->id);
            foreach ($galleries as $gallery) {
                foreach ($gallery->images as $image) {
                    if ($image->status === ImageStatus::Published->value) {
                        $images->push($image);
                    }
                }
            }
        }

        $tags = collect();

        foreach ($galleries as $gallery) {
            foreach ($gallery->tags as $tag) {
                if ($tags->doesntContain('id', $tag->id)) {
                    $tags->push($tag);
                }
            }
        }

        return [$galleries, $tags, $images];
    }

    public function prepareIndexGalleries()
    {
        $galleries = Gallery::where('gallery_id', null)
            ->where(function (Builder $query) {
                $query->where('status', GalleryStatus::Published)
                    ->where(function (Builder $query) {
                        $query->whereNull('published_at')
                            ->orWhere('published_at', '<=', now());
                    })
                    ->where(function (Builder $query) {
                        $query->whereNull('published_through')
                            ->orWhere('published_through', '>=', now());
                    });
            })
            ->orderBy('order', 'asc')
            ->with(['tags', 'images'])
            ->paginate(9);

        return $galleries;
    }

    public function prepareShowGalleries($id)
    {
        $galleries = Gallery::where('status', GalleryStatus::Published)
            ->where('gallery_id', $id)
            ->where(function (Builder $query) {
                $query->where(function (Builder $query) {
                    $query->whereNull('published_at')
                        ->orWhere('published_at', '<=', now());
                })
                    ->where(function (Builder $query) {
                        $query->whereNull('published_through')
                            ->orWhere('published_through', '>=', now());
                    });
            })
            ->orderBy('order', 'asc')
            ->with(['tags', 'images'])
            ->get();

        return $galleries;
    }
}
