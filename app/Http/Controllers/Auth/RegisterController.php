<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Wilaya, Commune, User};
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Carbon\Carbon;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index()
    {
        $wilayas = Wilaya::all();

        return view('auth.register', [
            'wilayas' => $wilayas,
        ]);
    }

    public function communes($WilayaName)
    {
        $wilaya = Wilaya::where('name', '=', $WilayaName)->first();
        $communes = Commune::where('wilaya_id', '=', $wilaya->id)->get();

        return response()->json([
            'communes' => $communes
        ]);
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['required', 'numeric', 'min:10', 'unique:users,phone'],
            'password' => ['required', 'confirmed', 'min:6'],
            /*'wilaya' => ['required', 'string'],
            'commune' => ['required', 'string'],
            'blood_type' => ['required', 'string'],
            'contact_type' => ['required', 'string'],
            'contact_time' => ['required', 'string'],*/
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            /*'wilaya' => $request->wilaya,
            'commune' => $request->commune,
            'blood_type' => $request->blood_type,
            'contact_type' => $request->contact_type,
            'contact_time' => $request->contact_time,*/
        ]);
        event(new Registered($user));

        Auth::attempt($request->only('email', 'password'));

        return redirect('/dashboard')->with('Registered successfully');
    }

    public function registerWithGoogle()
    {
        $driver = 'google';
        return Socialite::driver($driver)->redirect();
    }

    public function redirectWithGoogle()
    {
        $driver = 'google';
        $user = Socialite::driver($driver)->user();
        $google_user = (bool) User::where('email', $user->email)
            ->where('driver', $driver)
            ->first();
        if ($google_user == true) {
            $current_user = User::where('email', $user->email)->first();
            Auth::login($current_user, true);
            return redirect('/')->with('success', 'Login successfully');
        }

        $local_user = (bool) User::where('email', $user->email)
            ->where('driver', 'local')
            ->first();
        if ($local_user == true) {
            return redirect('/')->with('error', 'email must be unique');
        }
        $user = User::create([
            'name' => $user->name,
            'email' => $user->email,
            'password' => Hash::make(Str::random(16)),
            'driver' => $driver,
        ]);
        $user->markEmailAsVerified();

        Auth::login($user, true);

        return redirect('/')->with('success', 'Registered successfully');
    }

    public function registerWithFacebook()
    {
        $driver = 'facebook';
        return Socialite::driver($driver)->redirect();
    }

    public function redirectWithFacebook()
    {
        $driver = 'facebook';
        $user = Socialite::driver($driver)->user();
        $google_user = (bool) User::where('email', $user->email)
            ->where('driver', $driver)
            ->first();
        if ($google_user == true) {
            $current_user = User::where('email', $user->email)->first();
            Auth::login($current_user, true);
            return redirect('/')->with('success', 'Login successfully');
        }

        $local_user = (bool) User::where('email', $user->email)
            ->where('driver', 'local')
            ->first();
        if ($local_user == true) {
            return redirect('/')->with('error', 'email must be unique');
        }
        $user = User::create([
            'name' => $user->name,
            'email' => $user->email,
            'password' => Hash::make(Str::random(16)),
            'driver' => $driver,
        ]);

        Auth::login($user, true);

        return redirect('/')->with('success', 'Registered successfully');
    }
}
