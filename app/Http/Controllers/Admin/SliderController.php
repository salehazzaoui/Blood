<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Slider;

class SliderController extends Controller
{
    public function __construct(){
        return $this->middleware(['auth', 'admin']);
    }

    public function index(){
        $sliders = Slider::all();
        return view('admin.slider', [
            'sliders' => $sliders
        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => ['required'],
            'image' => ['required','mimes:jpg,png,gif,jepg'],
        ]);

        // upload image
        $image = $request->file('image');
        $pathName = $image->getPathName();
        $filename = time().'_'.preg_replace('/\s+/', '_', strtolower($image->getClientOriginalName()));
        $image->storeAs('uploads/original', $filename, 'public');
        // resizing the image
        $img = Image::make($image->path());
        $img->resize(840, 400, function ($constraint){
            $constraint->aspectRatio();
        })->save($slide = storage_path('app/public/uploads/original/'.$filename));
        if(Storage::disk('public')
            ->put('uploads/slider/'.$filename, fopen($slide, 'r+'))){
                File::delete($slide);
        }

        $slider = auth()->user()->sliders()->create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'image' => $filename
        ]);

        return back()->with('success', 'Slider created successfully');
    }

    public function destroy($id){
        $slider = Slider::findOrFail($id);
        if(Storage::disk('public')->exists("uploads/slider/".$slider->image)){
            Storage::disk('public')->delete("uploads/slider/".$slider->image);
        }

        $slider->delete();

        return response()->json(['success' => 'Slider deleted successfully']);
    }
}
