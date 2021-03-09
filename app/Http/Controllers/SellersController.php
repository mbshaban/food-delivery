<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sellers;
use App\Models\User;
use App\Models\Districts;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SellersController extends Controller
{
	public function index(){
		$districts = Districts::where('provinces_id', 1)->get();
        $sellers = Sellers::all();
		return view('dashboard.sellers.sellers', compact('districts', 'sellers'));
	}

    public function insert(Request $request){

    	$request->validate([
		    'email' => 'required|email',
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

    public function edit($id){
        $districts = Districts::where('provinces_id', 1)->get();
        $seller = Sellers::where('sellers.id', $id)
        ->join('districts', 'sellers.district_id', 'districts.id')
        ->join('users', 'sellers.user_id', 'users.id')
        ->select('sellers.*', 'districts.district_name', 'users.email', 'users.phone')->first();
        return view('dashboard.sellers.edit', compact('districts', 'seller'));
    }
    public function updateAccount(Request $request){

        $request->validate([
            'user_id' => 'required',
            'email' => 'required|email',
            'phone' => 'required',

        ]);

        $user['email'] = $request->get('email');
        $user['phone'] = $request->get('phone');

        User::where('id', $request->get('user_id'))->update($user);

        return redirect()->back()->with('message', 'Account Successfully Updated');

    }

    public function updateInfo(Request $request){

        $request->validate([
            'business_name' => 'required',
            'district_id' => 'required',
            'logo' => 'mimes:jpeg,png,bmp,jpg|max:20000',
        ]);

        //update customer

        $data['owner_name'] = $request->get('owner_name');
        $data['business_name'] = $request->get('business_name');
        $data['seller_type'] = $request->get('seller_type');
        $data['full_address'] = $request->get('full_address');
        $data['geolocation'] = $request->get('geolocation');
        $data['village'] = $request->get('village');
        $data['district_id'] = $request->get('district_id');
        
        Sellers::where('user_id', $request->get('user_id'))->update($data);
        return redirect()->back()->with('message', 'Your Info Successfully Updated');
        
    }

    public function updatePassword(Request $request){

        $request->validate([
            'current_password' => 'required|min:6',
            'password' => 'required|confirmed|min:6',

        ]);

        if (Hash::check($request->get('current_password'), \Auth::user()->password)) {
            
                $data['password'] = bcrypt($request->get('password'));
                $v = User::where('id', $request->get('user_id'))->update($data);
                if ($v) {
                    return redirect()->back()->with('message', 'Your Password Successfully Updated');
                }
            
        } else {
            $pfaild = "رمز عبور فعلی شما درست نیست!";
            return redirect()->back()->with('pfaild', $pfaild);
        }
        
    }

    public function delete(Request $request)
    {

        DB::beginTransaction();

        Sellers::where('id', $request->get('id'))->delete();
        DB::commit();
        return "success";

    }
}
