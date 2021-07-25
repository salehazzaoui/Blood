<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DonorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin','auth']);
    }

    public function index()
    {
        $users = User::where('is_admin', false)->orderby('created_at','desc')->paginate(15);
        return view('admin.donor',[
            'users' => $users
        ]);
    }

    public function search(Request $request){
        $key = trim($request->get('q'));
        $users = User::query()
            ->where('name', 'like', "%{$key}%")
            ->orWhere('blood_type', 'like', "%{$key}%")
            ->orWhere('wilaya', 'like', "%{$key}%")
            ->orWhere('commune', 'like', "%{$key}%")
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.search', ['users' => $users]);
    }
    public function searchKeyup(Request $request){
        $key = trim($request->get('q'));
        $users = User::query()
            ->where('name', 'like', "%{$key}%")
            ->get();
        foreach ($users as $user){
            $usersNames[] = $user->name;
        }
        return response()->json(['users' => $usersNames],200);
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['success' => 'Donor deleted successfully']);
    }
}
