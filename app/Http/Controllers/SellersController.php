<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sellers;
use App\Models\User;
use App\Models\Districts;
use Illuminate\Support\Facades\Storage;

class SellersController extends Controller
{
	public function index(){
		$districts = Districts::where('provinces_id', 1)->get();
		return view('dashboard.sellers.sellers', compact('districts'));
	}

    public function insert(Request $request){

    	$request->validate([
		    'email' => 'required|email:rfc,dns',
		    'business_name' => 'required',
		    'seller_type' => 'required',
		    'owner_name' => 'required',
		    'logo' => 'required|mimes:jpeg,png,bmp,jpg|max:20000',
		    'full_address' => 'required',
		    'district_id' => 'required',
		    'password' => 'required|confirmed|min:6',

		]);

    	$user = new User;
    	$user->email = $request->email;
    	$user->phone = $request->phone;
    	$user->account_type = 'seller';
    	$user->password = bcrypt($request->password);
    	$user->save();
    	$imageaddress = $this->storeImage($request);
    	return $this->insertSeller($request, $user->id, $imageaddress);
    
    	
    }

    public function insertSeller($request, $userid, $logo){

    	$seller = new Sellers;
    	$seller->user_id = $userid;
    	$seller->business_name = $request->business_name;
    	$seller->seller_type = $request->seller_type;
    	$seller->owner_name = $request->owner_name;
    	$seller->logo = $logo;
    	$seller->full_address = $request->full_address;
    	$seller->geolocation = $request->geolocation;
    	$seller->village = $request->village;
    	$seller->order_status = 'open';
    	$seller->district_id = $request->district_id;

    	$seller->save();

    	return redirect()->back()->with('message', 'seller successfully added!');
    }

    public function storeImage($request){

        $image=$request->file('logo');
        Storage::makeDirectory('logos');
        $imgpath=date("Y-m-d-h-i-sa").rand(1,1000).".".$image->getClientOriginalExtension();

        Storage::put('logos/'.$imgpath, \File::get($image));

        return $imgpath;
                
    }
}
