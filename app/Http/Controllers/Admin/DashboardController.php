<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, Contact};

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware(['admin','auth']);
    }

    public function index()
    {
        $users = User::where('is_admin', false)->orderby('created_at','desc')->paginate(5);
        $donors = User::whereNotNull('blood_type')->where('is_admin', false)->get();
        $Ap = User::where('blood_type', 'A+');
        $An = User::where('blood_type', 'A-');
        $Bp = User::where('blood_type', 'B+');
        $Bn = User::where('blood_type', 'B-');
        $ABp = User::where('blood_type', 'AB+');
        $ABn = User::where('blood_type', 'AB-');
        $Op = User::where('blood_type', 'O+');
        $On = User::where('blood_type', 'O-');
        $contactsIsNotRead = Contact::where('is_read', false)->get();
        return view('admin.dashboard',[
            'users' => $users,
            'donors' => $donors,
            'Ap' =>$Ap,
            'An' =>$An,
            'Bp' =>$Bp,
            'Bn' =>$Bn,
            'ABp' =>$ABp,
            'ABn' =>$ABn,
            'Op' =>$Op,
            'On' =>$On,
            'contactsIsNotRead' =>$contactsIsNotRead
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
}
