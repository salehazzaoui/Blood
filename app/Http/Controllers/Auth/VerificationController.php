<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Models\user;
use Illuminate\Auth\Events\Verified;

class VerificationController extends Controller
{
    public function __construct(){
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1',)->only('verify','resend');
    }

    public function index(Request $request){
        return $request->user()->hasVerifiedEmail()
                        ? redirect('/')
                        : view('auth.verify');
    }

    public function verify(Request $request, User $user){
        // check if the url is a valid signed
        if(!URL::hasValidSignature($request)){
             return back()->with('error', 'Invalid verification link');
        }
        // check if user already verified
        if($user->hasVerifiedEmail()){
            return back()->with('error', 'Email address already verified');
       }
       
       if ($request->user()->markEmailAsVerified()) {
        event(new Verified($request->user()));
       }
       return redirect('/')->with('success', 'Email successfully verified');
    }

    public function resend(Request $request, User $user){
        $this->validate($request, [
            'email' =>['email', 'required'],
        ]);
        $user = User::where('email', $request->email)->first();
        if(!$user){
            return back()->with('error', 'No user could be found with this email address');
        }
        if($user->hasVerifiedEmail()){
            return back()->with('error', 'Email address already verified');
        }
        $user->sendEmailVerificationNotification();
        return back()->with('resent', true);
    }
}
