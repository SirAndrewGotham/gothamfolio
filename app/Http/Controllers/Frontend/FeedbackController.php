<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeedbackRequest;
use App\Mail\FeedbackMailer;
use App\Models\Feedback;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    public function index()
    {
        return view('frontend.'.config('gothamfolio.frontend.theme').'.feedback.index');
    }

    public function store(StoreFeedbackRequest $request)
    {
        if (config('gothamfolio.frontend.feedback-to-db') == 'on') {
            Feedback::create($request->validated());
        }

        // send email to the requester if set in configuration
        if (config('gothamfolio.frontend.feedback-to-requester') == 'on') {
            try {
                Mail::to($request->validated()['email'])->send(new FeedbackMailer($request->validated()));
            } catch (\Exception $e) {
                echo $e->getMessage();
                Log::info('Feedback mail not sent'.$e->getMessage());
            }
        }

        // send email to admin if set in configuration
        if (config('gothamfolio.frontend.feedback-to-admin') == 'on') {
            try {
                Mail::to(config('mail.from.reply_to.address'))->send(new FeedbackMailer($request->validated()));
            } catch (\Exception $e) {
                echo $e->getMessage();
                Log::info('Feedback mail not sent'.$e->getMessage());
            }
        }

        // for queuing (later on)
        //        Mail::to($data->email)->queue(new FeedbackMailer($data));

        return redirect()->route('feedback.index')->with('success', trans('app.frontend.contact.confirmMailSent'));
    }
}
