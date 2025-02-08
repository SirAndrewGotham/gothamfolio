<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkRequest;
use App\Http\Requests\UpdateWorkRequest;
use App\Models\Tag;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $works = Work::latest()->paginate(15);

        return view('backend.legacy.works.index', compact('works'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.legacy.works.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkRequest $request)
    {
        $this->saveWork($request->all());

        return redirect()->route('admin.works.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Work $work)
    {
        return view('backend.legacy.works.show', compact('work'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Work $work)
    {
        return view('backend.legacy.works.edit', compact('work'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkRequest $request, Work $work)
    {
        $this->saveWork($request->all(), $work);

        return redirect()->route('admin.works.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Work $work)
    {
        $work->delete();

        return redirect()->route('admin.works.index');
    }

    protected function saveWork(array $data = [], $work = null)
    {
        // Image Handling
        if (isset($data['image'])) {
            $data['image'] = $this->buildImage($data['slug'], $data['image']);
        }

        // We create the Work
        if ($work === null) {
            $data['user_id'] = Auth::id();

            $work = Work::create($data);
        } else {
            $work->find($work);
//            $work = Work::where('id', $id->id)->update($data, $work);
            $work->update($data);
        }

        $this->saveTags($data, $work);
    }

    /**
     * Build the image.
     *
     * @param string       $slug
     * @param UploadedFile $image
     *
     * @return string
     */
    protected function buildImage($slug, $image)
    {
        $filePath = 'uploads/works/'.$slug.'.'.$image->getClientOriginalExtension();
        Image::read($image)->save(public_path('/'.$filePath));

        return $filePath;
    }

    /**
     * Save the tags for the Post.
     *
     * @param array $data
     * @param       $post
     */
    protected function saveTags(array $data, $work)
    {
        if($data['tags'])
        {
            $tagIds = collect();
            $tags = explode(',', $data['tags']);
            foreach ($tags as $tag) {
                $tagId = Tag::firstOrCreate(['name' => $tag]);
                $tagIds->push($tagId);
            }
            $work->tags()->sync($tagIds->pluck('id')->toArray());
        }
    }
}
