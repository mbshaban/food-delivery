<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sliders;
use Illuminate\Support\Facades\Storage;
class SlidersController extends Controller
{
    public function index(){

        $sliders = Sliders::paginate(12);
		return view('dashboard.sliders.sliders', compact('sliders'));
	}

	public function insert(Request $request){

    	$request->validate([
		    'slider_image' => 'required|mimes:jpeg,png,bmp,jpg|max:20000'
		]);

    	$imageaddress = $this->storeImage($request);

    	$user = new Sliders;
    	$user->link = $request->link;
    	$user->slider_image = $imageaddress;
    	$user->save();
    	
    	return redirect()->back()->with('message', 'slider successfully added!');
    
    	
    }

    public function storeImage($request){

        $image=$request->file('slider_image');
        Storage::makeDirectory('sliders');
        $imgpath=date("Y-m-d-h-i-sa").rand(1,1000).".".$image->getClientOriginalExtension();

        Storage::put('sliders/'.$imgpath, \File::get($image));

        return $imgpath;
                
    }
}
