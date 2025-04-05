<?php

namespace App\Http\Controllers\Backend;

use App\Actions\WorkTranslationSaveAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkRequest;
use App\Http\Requests\StoreWorkTranslationRequest;
use App\Http\Requests\UpdateWorkTranslationRequest;
use App\Models\WorkTranslation;

class WorkTranslationController extends Controller
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
    public function store(StoreWorkRequest $request, WorkTranslationSaveAction $workTranslationSaveAction)
    {
        $workTranslationSaveAction->handle($request->validated());

        return redirect()->route('admin.works.index')->with('success', 'Your Work created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(WorkTranslation $workTranslation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WorkTranslation $workTranslation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkTranslationRequest $request, WorkTranslation $workTranslation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkTranslation $workTranslation)
    {
        //
    }
}
