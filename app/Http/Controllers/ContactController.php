<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUs;

class ContactController extends Controller
{
    public function index(){
        return view('public.contact');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'numeric' ,'min:10'],
            'message' => ['required', 'string', 'min:10', 'max:244'],
        ]);
        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message
        ]);

        Mail::to('blood@bank.dz')->send(new ContactUs($contact));

        return back()->with('success', 'Thank you for contacting us');
    }
}
