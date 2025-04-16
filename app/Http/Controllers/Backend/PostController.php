<?php

namespace App\Http\Controllers\Backend;

use App\Actions\PostSaveAction;
use App\Actions\TagsSaveAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\PostTranslation;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('translations')->latest()->paginate(15);

        return view('backend.legacy.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = auth()->user()->languages;

        return view('backend.legacy.posts.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request, PostSaveAction $postSaveAction)
    {
        $postSaveAction->handle($request->validated());

        return redirect()->route('admin.posts.index')->with('message', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('backend.legacy.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('backend.legacy.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
	(new PostUpdateAction())->handle($request->validated(), $post);

        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
