<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Delivers;
use App\Models\Districts;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
class DeliversController extends Controller
{
    public function index(){
		$districts = Districts::where('provinces_id', 1)->get();
        $delivers = Delivers::join('districts', 'delivers.district_id', 'districts.id')
        ->join('users', 'delivers.user_id', 'users.id')->get();
		return view('dashboard.delivers.delivers', compact('districts', 'delivers'));
	}

    public function insert(Request $request){

    	$request->validate([
		    'email' => 'required|email',
		    'deliver_name' => 'required',
		    'profile_picture' => 'mimes:jpeg,png,bmp,jpg|max:20000',
		    'full_address' => 'required',
		    'district_id' => 'required',
		    'password' => 'required|confirmed|min:6',

		]);

    	$user = new User;
    	$user->email = $request->email;
    	$user->phone = $request->phone;
    	$user->account_type = 'deliver';
    	$user->password = bcrypt($request->password);
    	$user->save();
    	$imageaddress = $this->storeImage($request);
    	return $this->insertDeliver($request, $user->id, $imageaddress);
    
    	
    }

    public function insertDeliver($request, $userid, $profilePic){

    	$deliver = new Delivers;
    	$deliver->user_id = $userid;
    	$deliver->deliver_name = $request->deliver_name;
    	$deliver->profile_picture = $profilePic;
    	$deliver->full_address = $request->full_address;
    	$deliver->geolocation = $request->geolocation;
    	$deliver->village = $request->village;
    	$deliver->district_id = $request->district_id;

    	$deliver->save();

    	return redirect()->back()->with('message', 'deliver successfully added!');
    }

    public function storeImage($request){

        $image=$request->file('profile_picture');
        Storage::makeDirectory('profilepictures');
        $imgpath=date("Y-m-d-h-i-sa").rand(1,1000).".".$image->getClientOriginalExtension();

        Storage::put('profilepictures/'.$imgpath, \File::get($image));

        return $imgpath;
                
    }
}
