<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct(){
        return $this->middleware(['auth', 'admin']);
    }

    public function index(){
        $admins = User::where('is_admin', true)->orderby('created_at', 'asc')->get();

        return view('admin.adminstrator', [
            'admins' => $admins
        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['required', 'numeric', 'min:10', 'unique:users,phone'],
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'is_admin' => true
        ]);

        return back()->with('success', 'Admin added successfully');
    }

    public function destroy($id){
        $admin = User::findOrFail($id);
        $admin->delete();

        return response()->json(['success' => 'Admin deleted successfully']);
    }
}
