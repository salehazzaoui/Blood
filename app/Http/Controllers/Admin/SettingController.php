<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Rules\{OldPassword, SamePassword};

class SettingController extends Controller
{
    public function __construct(){
        return $this->middleware(['auth', 'admin']);
    }

    public function index($id){
        $admin = User::findOrFail($id);

        return view('admin.setting', [
            'admin' => $admin
        ]);
    }

    public function information(Request $request, $id){
        $admin = User::findOrFail($id);

        $validator = validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required'],
            'phone' => ['required', 'numeric', 'min:10'],
        ]);
        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        
        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone
        ]);

        return response()->json(['success' => 'Your information updated successfully']);
    }
 
    public function passwordUpdate(Request $request, $id){
        $admin = User::findOrFail($id);

        $validator = validator::make($request->all(), [
            'current_password' => ['required', new OldPassword],
            'password' => ['required', 'confirmed', 'min:6', new SamePassword],
        ]);
        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $admin->update([
            'password' => bcrypt($request->password)
        ]);

        return response()->json(['success' => 'Your password updated successfully']);
       //return back()->with('success', 'Your password updated successfully');
    }
}
