<?php

namespace App\Http\Controllers\Backend;

use App\Actions\WorkSaveAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkRequest;
use App\Http\Requests\UpdateWorkRequest;
use App\Models\Work;

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
        $languages = auth()->user()->languages;

        return view('backend.legacy.works.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkRequest $request, WorkSaveAction $workSaveAction)
    {
        $workSaveAction->handle($request->validated());

        return redirect()->route('admin.works.index')->with('success', 'Your Work created successfully!');
        // next one if save and create another one
        //        return redirect()->back()->with('success', 'Your Work created successfully!');
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
}
