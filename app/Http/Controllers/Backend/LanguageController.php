<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Models\Language;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LanguageController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::query()
            ->orderBy('is_active', 'desc')
            ->get();

        return view('backend.legacy.languages.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.legacy.languages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLanguageRequest $request)
    {
        Language::query()->create($request->validated());

        return redirect()->route('admin.languages.index')->with('success', 'Language created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Language $language)
    {
        return view('backend.legacy.languages.show', compact('language'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Language $language)
    {
        return view('backend.legacy.languages.edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLanguageRequest $request, Language $language)
    {
        if ($request->boolean('default') && Language::where('default', true)->where('id', '!=', $language->id)->exists()) {
            return redirect()->back()->with('error', 'Only one language can be default.');
        }

        $language->update($request->validated());

        return redirect()->route('admin.languages.index')->with('success', 'Language updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Language $language)
    {
        if ($language->default) {
            return redirect()->back()->with('error', 'Cannot delete default language.');
        }

        $language->delete();

        return redirect()->route('admin.languages.index')->with('success', 'Language deleted successfully.');
    }
}
