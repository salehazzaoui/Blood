<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Slider, Wilaya, Commune, User};

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderby('created_at', 'desc')->get();
        $wilayas = Wilaya::all();
        $communes = Commune::all();
        $users = User::where('is_admin', false)
            ->whereNotNull('blood_type')
            ->orderby('created_at', 'desc')
            ->paginate(15);
        
        return view('public.home', [
            'sliders' => $sliders,
            'wilayas' => $wilayas,
            'communes' => $communes,
            'users' => $users
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

    public function search(Request $request)
    {
        $wilaya = trim($request->get('wilaya'));
        $commune = trim($request->get('commune'));
        $blood = trim($request->get('blood'));
        $users = User::query()
            ->where('wilaya', 'like', "%{$wilaya}%")
            ->Where('commune', 'like', "%{$commune}%")
            ->Where('blood_type', 'like', "%{$blood}%")
            ->orderBy('created_at', 'desc')
            ->get();
        return view('public.search', ['users' => $users]);
    }
}
