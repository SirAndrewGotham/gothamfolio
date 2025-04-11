<?php

namespace App\Http\Controllers\Backend;

use App\Actions\WorkSaveAction;
use App\Actions\WorkTranslationSaveAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkRequest;
use App\Http\Requests\StoreWorkTranslationRequest;
use App\Http\Requests\UpdateWorkTranslationRequest;
use App\Models\Language;
use App\Models\Work;
use App\Models\WorkTranslation;

class WorkTranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Work $work)
    {
        $work_translations = WorkTranslation::where('work_id', $work->id)->get();
        return view('backend.legacy.work_translation.index', compact(['work', 'work_translations']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = auth()->user()->languages;

        return view('backend.legacy.work_translation.translate', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function translate(WorkTranslation $workTranslation)
    {
        $user_languages = auth()->user()->languages;

        $already_used_languages = collect($workTranslation::where('work_id', $workTranslation->work_id)->get()->pluck('language_id'));

//        dd($used);

        $languages = $user_languages->whereNotIn('id', $already_used_languages);

        return view('backend.legacy.work_translation.translate', compact(['languages', 'workTranslation']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkTranslationRequest $request, WorkSaveAction $workTranslationSaveAction)
    {
        $workTranslationSaveAction->handle($request->validated());

        return redirect()->route('admin.work_translation.index', ['work_id', $request->work_id])->with('success', 'Your Work created successfully!');
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
        return view('backend.legacy.work_translation.edit', compact('workTranslation'));
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
