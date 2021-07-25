<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use App\Models\{User, Wilaya, Commune};

class AddDonorController extends Controller
{
    public function __construct(){
        $this->middleware(['auth', 'admin']);
    }

    public function index(){
        $wilayas = Wilaya::all();

        return view('admin.adonor', [
            'wilayas' => $wilayas,
        ]);
    }

    public function communes($WilayaName){
        $wilaya = Wilaya::where('name', '=', $WilayaName)->first();
        $communes = Commune::where('wilaya_id', '=', $wilaya->id)->get();

        return response()->json([
            'communes' => $communes
        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['required', 'numeric', 'min:10', 'unique:users,phone'],
            'password' => ['required', 'confirmed', 'min:6'],
            'wilaya' => ['required', 'string'],
            'commune' => ['required', 'string'],
            'blood_type' => ['required', 'string'],
            'contact_type' => ['required', 'string'],
            'contact_time' => ['required', 'string'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'wilaya' => $request->wilaya,
            'commune' => $request->commune,
            'blood_type' => $request->blood_type,
            'contact_type' => $request->contact_type,
            'contact_time' => $request->contact_time,
        ]);
        event(new Registered($user));

        return redirect('/admin/donors')->with('Donor added successfully');
    }
}
