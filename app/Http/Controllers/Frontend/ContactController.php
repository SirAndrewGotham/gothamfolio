<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;

class ContactController
{
    public function show()
    {
        return view('frontend.legacy.contact');
    }

    public function store(StoreContactRequest $request)
    {
        $this->dispatch(new SendContactEmail($request->all()));

        return view('frontend.legacy.contact')->withSuccess(trans('app.frontend.contact.confirmMailSent'));
    }
}
