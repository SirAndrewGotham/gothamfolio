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
    public function index(Post $post)
    {
        $post_translations = PostTranslation::where('post_id', $post->id)->get();

        return view('backend.legacy.post_translation.index', compact(['post', 'post_translations']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Post $post)
    {
        $user_languages = auth()->user()->languages;

        $already_used_languages = collect(PostTranslation::where('post_id', $post->id)->get()->pluck('language_id'));

        $languages = $user_languages->whereNotIn('id', $already_used_languages);

        return view('backend.legacy.post_translation.create', compact(['languages', 'post']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function translate(PostTranslation $postTranslation)
    {
        $user_languages = auth()->user()->languages;

        $already_used_languages = collect($postTranslation::where('post_id', $postTranslation->post_id)->get()->pluck('language_id'));

        $languages = $user_languages->whereNotIn('id', $already_used_languages);

        return view('backend.legacy.post_translation.translate', compact(['languages', 'postTranslation']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostTranslationRequest $request, PostTranslationSaveAction $postTranslationSaveAction)
    {
        $postTranslationSaveAction->handle($request->validated());

        $slug = Post::where('id', $request->post_id)->first();

        return redirect()->route('admin.postTranslations.index', $slug)->with('success', 'Your Post Translation created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PostTranslation $postTranslation)
    {
        return view('backend.legacy.post_translation.show', compact('postTranslation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PostTranslation $postTranslation)
    {
        return view('backend.legacy.post_translation.edit', compact('postTranslation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostTranslationRequest $request, PostTranslation $postTranslation)
    {
        (new PostTranslationUpdateAction)->handle($request->validated(), $postTranslation);

        return redirect()->route('admin.postTranslations.index', $postTranslation->post->slug)->with('success', 'Your Post Translation updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostTranslation $postTranslation)
    {
        $postTranslation->delete();

        return redirect()->back();
    }

    public function forceDelete(PostTranslation $postTranslation)
    {
        $postTranslation->forceDelete();

        return redirect()->back();
    }
}
