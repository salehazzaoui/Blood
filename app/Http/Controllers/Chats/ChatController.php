<?php

namespace App\Http\Controllers\Chats;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, Message};
use Illuminate\Support\Facades\Mail;
use App\Mail\{MessageHim, ResponseHim};

class ChatController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth', 'verified']);
    }

    public function index($id)
    {
        $donor = User::findOrFail($id);

        switch($donor->contact_time){
            case 'From 8am to 3pm':
                if(time() >= strtotime("08:00:00") && time() <= strtotime("15:00:00")){
                    return back()->with('error', 'You are not able to contact him at this time');   
                }
                break;
            case 'From 3pm to 11pm':
                if(time() >= strtotime("15:00:00") && time() <= strtotime("23:00:00")){
                    return back()->with('error', 'You are not able to contact him at this time');    
                }
                break;
        }
        return view('public.chat', [
            'donor' => $donor
        ]);
    }

    public function store(Request $request)
    {

        $exsite_email = (bool) User::where('email', $request->recipient_email)->first();
        if (!$exsite_email) {
            return back()->with('error', 'email not found');
        }
        $this->validate($request, [
            'recipient_email' => 'required',
            'body' => 'required|max:255',
        ]);

        if(!isset(auth()->user()->phone)){
            return redirect('dashboard')->with('error', 'You should have a phone number to send message');
        }

        $message = auth()->user()->messages()->create([
            'user_id' => auth()->user()->id,
            'recipient_email' => $request->recipient_email,
            'body' => $request->body
        ]);

        Mail::to($request->recipient_email)->send(new MessageHim($message));

        return back()->with('success', 'your message has been sent');
    }

    public function response($id, $email)
    {
        $message = Message::findOrFail($id);
        $sender = User::where('email', $message->recipient_email)->first();

        Mail::to($email)->send(new ResponseHim($message, $sender));

        return redirect('/')->with('success', 'Your response has been sent');
    }

    public function getMessages()
    {
        $messages = Message::where('recipient_email', auth()->user()->email)->orderby('created_at', 'desc')->paginate(10);
        return view('public.messages', [
            'messages' => $messages
        ]);
    }
}
