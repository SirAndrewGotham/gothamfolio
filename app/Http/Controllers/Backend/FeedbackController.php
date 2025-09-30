<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::query()
            ->where('read', false)
            ->latest()
            ->paginate(15);

        return view('backend.legacy.feedback.index', compact('feedbacks'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Feedback $feedback)
    {
        return view('backend.legacy.feedback.show', compact('feedback'));
    }

    public function read()
    {
        $feedbacks = Feedback::query()
            ->where('read', true)
            ->latest()
            ->paginate(15);

        return view('backend.legacy.feedback.read', compact('feedbacks'));
    }

    public function markAsRead(Feedback $feedback)
    {
        $feedback->read = true;
        $feedback->save();

        return redirect()->route('admin.feedback.index');
    }

    public function unread(Feedback $feedback)
    {
        $feedback->read = false;
        $feedback->save();

        return redirect()->route('admin.feedback.read');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        return redirect()->route('admin.feedback.index');
    }

    public function forceDelete(Feedback $feedback)
    {
        $feedback->forceDelete();

        return redirect()->route('admin.feedback.read');
    }
}
