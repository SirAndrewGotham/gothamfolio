<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;

class ContactController
{
    public function show()
    {
        return view('frontend.'. config('gothamfolio.frontend.theme') .'.contact.index');
    }

    public function store(StoreContactRequest $request)
    {
        $this->dispatch(new SendContactEmail($request->all()));

        return view('frontend.'. config('gothamfolio.frontend.theme') .'.contact.index')->withSuccess(trans('app.frontend.contact.confirmMailSent'));
    }
}
