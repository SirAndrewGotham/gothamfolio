<?php

namespace App\Http\Controllers\Frontend;

use App\Actions\PostIndexAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Language;
use App\Models\Post;
use App\Models\PostTranslation;
use App\Models\Tag;
use App\Models\User;

class BlogController
{
    /**
     * Display a listing of the resource.
     */
    public function index(PostIndexAction $postIndexAction)
    {
        $languages[] = Language::where('code', app()->getLocale())->first()->id;
        if(auth()->check())
        {
            $languages = Language::where('id', auth()->user()->language_id)->pluck('id');
            if(auth()->user()->languages)
            {
                $languages = auth()->user()->languages->pluck('id');
            }
        }

        $posts = PostTranslation::where('status', 'Published')->whereIn('language_id', $languages)->latest()->with(['tags'])->paginate(10);

        $tags = collect();

        foreach($posts as $post)
        {
            foreach($post->tags as $tag)
            {
                $tags[] = $tag;
            }
        }

        return view('frontend.legacy.blogs.index', compact('posts', 'tags'));
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
    public function store(StorePostRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PostTranslation $post)
    {
        $tags = Tag::all();

        return view('frontend.legacy.blogs.show', compact('post', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
