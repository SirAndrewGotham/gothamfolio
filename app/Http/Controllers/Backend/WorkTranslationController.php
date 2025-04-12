<?php

namespace App\Http\Controllers\Backend;

use App\Actions\WorkTranslationSaveAction;
use App\Actions\WorkTranslationUpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkTranslationRequest;
use App\Http\Requests\UpdateWorkTranslationRequest;
use App\Models\Work;
use App\Models\WorkTranslation;
use JetBrains\PhpStorm\NoReturn;

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
    public function create(Work $work)
    {
        $user_languages = auth()->user()->languages;

        $already_used_languages = collect(WorkTranslation::where('work_id', $work->id)->get()->pluck('language_id'));

        $languages = $user_languages->whereNotIn('id', $already_used_languages);

        return view('backend.legacy.work_translation.create', compact(['languages', 'work']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function translate(WorkTranslation $workTranslation)
    {
        $user_languages = auth()->user()->languages;

        $already_used_languages = collect($workTranslation::where('work_id', $workTranslation->work_id)->get()->pluck('language_id'));

        $languages = $user_languages->whereNotIn('id', $already_used_languages);

        return view('backend.legacy.work_translation.translate', compact(['languages', 'workTranslation']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkTranslationRequest $request, WorkTranslationSaveAction $workTranslationSaveAction)
    {
        $workTranslationSaveAction->handle($request->validated());

        $slug = Work::where('id', $request->work_id)->first();

        return redirect()->route('admin.workTranslations.index', $slug)->with('success', 'Your Work Translation created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(WorkTranslation $workTranslation)
    {
        return view('backend.legacy.work_translation.show', compact('workTranslation'));
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
    //    #[NoReturn] public function update(UpdateWorkTranslationRequest $request, WorkTranslation $workTranslation)
    public function update(UpdateWorkTranslationRequest $request, WorkTranslation $workTranslation)
    {
        (new WorkTranslationUpdateAction)->handle($request->validated(), $workTranslation);

        return redirect()->route('admin.workTranslations.index', $workTranslation->work->slug)->with('success', 'Your Work Translation updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkTranslation $workTranslation)
    {
        $workTranslation->delete();

        return redirect()->back();

        //        return redirect()->route('admin.work_translation.index');
    }

    public function forceDelete(WorkTranslation $workTranslation)
    {
        $workTranslation->forceDelete();

        return redirect()->back();
    }
}
