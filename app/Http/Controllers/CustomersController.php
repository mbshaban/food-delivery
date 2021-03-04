<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\Districts;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class CustomersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
		$districts = Districts::where('provinces_id', 1)->get();
        $customers = Customers::where('user_id', Auth::user()->id)->first();
		return view('dashboard.customers.customers', compact('districts', 'customers'));
	}
    public function settings(){
        $districts = Districts::where('provinces_id', 1)->get();
        $customer = Customers::where('user_id', Auth::user()->id)->first();
        return view('dashboard.customers.settings', compact('districts', 'customer'));
    }
    public function updateAccount(Request $request){

    	$request->validate([
		    'email' => 'required|email',
		    'phone' => 'required',

		]);

    	$user['email'] = $request->get('email');
    	$user['phone'] = $request->get('phone');
    	
    	User::where('id', Auth::user()->id)->update($user);

    	return redirect()->back()->with('message', 'Account Successfully Updated');

    }

    public function updateInfo(Request $request){

        $request->validate([
            'customer_name' => 'required',
            'district_id' => 'required',
            'profile_picture' => 'mimes:jpeg,png,bmp,jpg|max:20000',
        ]);

        $customer = Customers::where('user_id', Auth::user()->id)->first();

        if($customer){
            //update customer

            $data['customer_name'] = $request->get('customer_name');
            $data['isMale'] = $request->get('isMale');
            $data['full_address'] = $request->get('full_address');
            $data['geolocation'] = $request->get('geolocation');
            $data['village'] = $request->get('village');
            $data['district_id'] = $request->get('district_id');
            
            Customers::where('user_id', Auth::user()->id)->update($data);
            return redirect()->back()->with('message', 'Your Info Successfully Updated');
        }
        else{
            //insert customer

            $user = new Customers;
            $user->customer_name = $request->customer_name;
            $user->isMale = $request->isMale;
            $user->full_address = $request->full_address;
            $user->geolocation = $request->geolocation;
            $user->village = $request->village;
            $user->user_id = Auth::user()->id;
            $user->district_id   = $request->district_id ;
            $user->save();
            
            return redirect()->back()->with('message', 'Your Info Successfully Updated');
        }
        
        
    }

    public function updatePassword(Request $request){

        $request->validate([
            'current_password' => 'required|min:6',
            'password' => 'required|confirmed|min:6',

        ]);

        if (Hash::check($request->get('current_password'), \Auth::user()->password)) {
            
                $data['password'] = bcrypt($request->get('password'));
                $v = User::where('id', Auth::user()->id)->update($data);
                if ($v) {
                    return redirect()->back()->with('message', 'Your Password Successfully Updated');
                }
            
        } else {
            $pfaild = "رمز عبور فعلی شما درست نیست!";
            return redirect()->back()->with('pfaild', $pfaild);
        }
        
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
