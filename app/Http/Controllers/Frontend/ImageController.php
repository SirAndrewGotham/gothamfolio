<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\View;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Models\Image;

class ImageController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('imageUpload');
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
    public function store(StoreImageRequest $request): \Illuminate\Http\RedirectResponse
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = Image::read($request->file('image'));

        // Main Image Upload on Folder Code
        $imageName = time().'-'.$request->file('image')->getClientOriginalName();
        $destinationPath = public_path('images/');
        $image->save($destinationPath.$imageName);

        // Generate Thumbnail Image Upload on Folder Code
        $destinationPathThumbnail = public_path('images/thumbnail/');
        $image->resize(100,100);
        $image->save($destinationPathThumbnail.$imageName);

        /**
         * Write Code for Image Upload Here,
         *
         * $upload = new Images();
         * $upload->file = $imageName;
         * $upload->save();
         */

        return back()
            ->with('success','Photo Upload successful')
            ->with('imageName',$imageName);
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Image $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImageRequest $request, Image $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $photo)
    {
        //
    }
}
