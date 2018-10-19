<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use Mail;
use App\Mail\Contact;

class ContactController extends Controller
{
    //
    public function showContactForm() {
        return view('contact');
    }

    //
    public function mailContactForm( ContactRequest $request ) {
        Mail::to('support@learnwebcode.online')->send(new Contact($request));

        // If everything went well, we show the flash message.
        flash()->success('Success! - Message received, we will reply shortly');
        return back(); // Lastly we return back to the page.
       
    } 
}
