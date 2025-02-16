<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostTranslationRequest;
use App\Http\Requests\UpdatePostTranslationRequest;
use App\Models\PostTranslation;

class PostTranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StorePostTranslationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PostTranslation $postTranslation)
    {
        dd('1');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PostTranslation $postTranslation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostTranslationRequest $request, PostTranslation $postTranslation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostTranslation $postTranslation)
    {
        //
    }
}
