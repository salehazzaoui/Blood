<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Wilaya, User};
use Illuminate\Support\Facades\Validator;
use App\Rules\{OldPassword, SamePassword};

class UserDashboardController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth']);
    }

    public function index()
    {
        $user = auth()->user();

        return view('public.dashboard', [
            'user' => $user,
        ]);
    }

    public function showDonor()
    {
        $user = auth()->user();
        $wilayas = Wilaya::all();

        return view('public.donor', [
            'user' => $user,
            'wilayas' => $wilayas,
        ]);
    }

    public function updateDonor(Request $request)
    {

        $this->validate($request, [
            'wilaya' => ['required', 'string'],
            'commune' => ['required', 'string'],
            'blood_type' => ['required', 'string'],
            'contact_type' => ['required', 'string'],
            'contact_time' => ['required', 'string']
        ]);

        $user = User::findOrFail(auth()->user()->id);

        $user->update([
            'wilaya' => $request->wilaya,
            'commune' => $request->commune,
            'blood_type' => $request->blood_type,
            'contact_type' => $request->contact_type,
            'contact_time' => $request->contact_time
        ]);

        return redirect('/')->with('success', 'Now you are a new donor');
    }

    public function information(Request $request){
        $user = User::findOrFail(auth()->user()->id);

        $validator = validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required'],
            'phone' => ['required', 'numeric', 'min:10'],
        ]);
        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone
        ]);

        return response()->json(['success' => 'Your information updated successfully']);
    }
 
    public function passwordUpdate(Request $request){
        $user = User::findOrFail(auth()->user()->id);

        $validator = validator::make($request->all(), [
            'current_password' => ['required', new OldPassword],
            'password' => ['required', 'confirmed', 'min:6', new SamePassword],
        ]);
        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $user->update([
            'password' => bcrypt($request->password)
        ]);

        return response()->json(['success' => 'Your password updated successfully']);
    }
}
