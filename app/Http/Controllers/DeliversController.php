<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Delivers;
use App\Models\Districts;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
class DeliversController extends Controller
{
    public function index(){
		$districts = Districts::where('provinces_id', 1)->get();
        $delivers = Delivers::join('districts', 'delivers.district_id', 'districts.id')
        ->join('users', 'delivers.user_id', 'users.id')
        ->select('delivers.*', 'districts.district_name', 'users.email', 'users.phone')->get();
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
    public function edit($id){
        $districts = Districts::where('provinces_id', 1)->get();
        $deliver = Delivers::where('delivers.id', $id)
        ->join('districts', 'delivers.district_id', 'districts.id')
        ->join('users', 'delivers.user_id', 'users.id')
        ->select('delivers.*', 'districts.district_name', 'users.email', 'users.phone')->first();
        return view('dashboard.delivers.edit', compact('districts', 'deliver'));
    }

    public function updateInfo(Request $request){

        $request->validate([
            'id' => 'required',
            'deliver_name' => 'required',
            'district_id' => 'required',
            'profile_picture' => 'mimes:jpeg,png,bmp,jpg|max:20000',
        ]);

        //update customer

        $data['deliver_name'] = $request->get('deliver_name');
        $data['full_address'] = $request->get('full_address');
        $data['geolocation'] = $request->get('geolocation');
        $data['village'] = $request->get('village');
        $data['district_id'] = $request->get('district_id');
        if ($request->hasFile('profile_picture')){
            $imageaddress = $this->storeImage($request);
            $data['profile_picture'] = $imageaddress;
        }
        $insert = Delivers::where('id', $request->get('id'))->update($data);
        if($insert){
            return redirect()->back()->with('message', 'Your Info Successfully Updated');
        }
    }
     public function updatePassword(Request $request){

        $request->validate([
            'current_password' => 'required|min:6',
            'password' => 'required|confirmed|min:6',

        ]);
        $user = User::where('id', $request->get('user_id'))->first();
        if (Hash::check($request->get('current_password'), $user->password)) {
            
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

        Delivers::where('id', $request->get('id'))->delete();
        DB::commit();
        return "success";
    }
}
