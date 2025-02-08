<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkRequest;
use App\Http\Requests\UpdateWorkRequest;
use App\Models\Tag;
use App\Models\Work;

class WorkController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $works = Work::where('published_at', '<=', now())->orderBy('order', 'asc')->with('tags')->get();
        $tags = Tag::has('works')->get();

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
    public function show(Work $work)
    {
        $works = Work::latest()->take(5)->get();

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
}
