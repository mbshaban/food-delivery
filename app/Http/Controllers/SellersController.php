<?php

namespace App\Http\Controllers;

use App\Models\SellerStatus;
use Illuminate\Http\Request;
use App\Models\Sellers;
use App\Models\User;
use App\Models\Districts;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SellersController extends Controller
{
    public function index()
    {
        $districts = Districts::where('provinces_id', 1)->get();
        $sellers = Sellers::all();
		return view('dashboard.sellers.sellers', compact('districts', 'sellers'));
	}
    public function register(){
        $districts = Districts::where('provinces_id', 1)->get();
        return view('sellers.register', compact('districts'));
    }
    public function orders(){
        $districts = Districts::where('provinces_id', 1)->get();
        return view('sellers.orders', compact('districts'));
    }
    public function products(){
        $products = Products::join('categories', 'categories.id', '=', 'products.category_id')
            ->join('sellers', 'sellers.id', '=', 'products.serller_id')->where('sellers.user_id', Auth::user()->id)
            ->select('products.*', 'categories.category_name', 'sellers.business_name')
            ->latest('products.created_at')
            ->paginate(12);
        $categories = Categories::select('type', 'category_webaddress', 'category_name', 'category_image', 'category_description', 'id')
            ->latest('categories.created_at')
            ->get();
        return view('sellers.products', compact('products', 'categories'));
    }
    public function insertProduct(Request $request){
        $seller = Sellers::where('user_id', Auth::user()->id)->first();
        $request->validate([
        'product_title' => 'required|max:250',
            'category_id' => 'required',
            'description' => 'required',
            'seller_id' => 'required',
            'price' => 'required|max:250',
            'discount' => 'required|max:250',
            'product_status' => 'required|max:250',
            'isApproved' => 'required|max:250',
            'product_image' => 'required|mimes:jpeg,png,bmp,jpg|max:20000'
        ]);
        $image = $request->file('product_image');
        Storage::makeDirectory('productImage');
        $imagePath = date("Y-m-d-h-i-sa") . rand(1, 1000) . "." . $image->getClientOriginalExtension();
        $data['product_title'] = $request->get('product_title');
        $data['category_id'] = $request->get('category_id');
        $data['description'] = $request->get('description');
        $data['serller_id'] = $seller->id;
        $data['price'] = $request->get('price');
        $data['discount'] = $request->get('discount');
        $data['product_status'] = $request->get('product_status');
        $data['isApproved'] = $request->get('isApproved');
        $data['product_image'] = $imagePath;
        $insert = Products::create($data);
        Storage::put('productImage/' . $imagePath, \File::get($image));

        if ($insert) {
             return redirect()->back()->with('message', 'Product Successfully Added');
        }

    }

    public function editProduct($id)
    {
        $data = Products::where('id', $id)->first();
        $categories = Categories::select('type', 'category_webaddress', 'category_name', 'category_image', 'category_description', 'id')
            ->latest('categories.created_at')
            ->get();
        return view('sellers.products.edit', compact('data', 'categories'));
    }

    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'product_title' => 'required|max:250',
            'category_id' => 'required',
            'description' => 'required',
            'price' => 'required|max:250',
            'discount' => 'required|max:250',
            'product_status' => 'required|max:250',
            'isApproved' => 'required|max:250',
            'product_image' => 'mimes:jpeg,png,bmp,jpg|max:20000'
        ]);
        $data['product_title'] = $request->get('product_title');
        $data['category_id'] = $request->get('category_id');
        $data['description'] = $request->get('description');
        $data['price'] = $request->get('price');
        $data['discount'] = $request->get('discount');
        $data['product_status'] = $request->get('product_status');
        $data['isApproved'] = $request->get('isApproved');
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            Storage::makeDirectory('productImage');
            $imagePath = date("Y-m-d-h-i-sa") . rand(1, 1000) . "." . $image->getClientOriginalExtension();
            $data['product_image'] = $imagePath;
            $update = Products::where('id', $id)->update($data);
            if ($update) {
                Storage::put('productImage/' . $imagePath, \File::get($image));
                Storage::delete('productImage/' . $request->get('prev_image_path'));
            }
        } else {
            Products::where('id', $id)->update($data);
        }
        return redirect('sellers/products');
    }

    public function deleteProduct(Request $request){

        DB::beginTransaction();

        Products::where('id', $request->get('id'))->delete();
        DB::commit();
        return "success";

    }

    public function insert(Request $request)
    {

        try{
            Log::info($request->all());
            $request->validate([
                'email' => 'required|email',
                'business_name' => 'required',
                'seller_type' => 'required',
                'owner_name' => 'required',
                'delivery_time' => '',
                'delivery_cost' => '',
                'status_id' => 'required',
                'logo' => 'required|mimes:jpeg,png,bmp,jpg|max:20000',
                'image' => 'required|mimes:jpeg,png,bmp,jpg|max:20000',
                'full_address' => 'required',
                'district_id' => 'required',
                'password' => 'required|confirmed|min:6',

            ]);
            Log::info($request->all());
            DB::beginTransaction();
            $user = new User;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->account_type = 'seller';
            $user->password = bcrypt($request->password);
            $user->save();
            $logoAddrsess = $this->storeLogo($request);
            $imageAddress = $this->storeImage($request);
            DB::commit();
            return $this->insertSeller($request, $user->id, $logoAddrsess, $imageAddress);

        }catch (\Exception $exception){
            DB::rollBack();
        }

    }

    public function insertSeller($request, $userid, $logo, $image)
    {
        $seller = new Sellers;
        $seller->user_id = $userid;
        $seller->business_name = $request->business_name;
        $seller->seller_type = $request->seller_type;
        $seller->owner_name = $request->owner_name;
        $seller->logo = $logo;
        $seller->image = $image;
        $seller->status_id = $request->status_id;
        $seller->full_address = $request->full_address;
        $seller->longitude = '12345';
        $seller->latitude = '34234';
        $seller->delivery_time = $request->delivery_time;
        $seller->delivery_cost = $request->delivery_cost;
        $seller->village = $request->village;
        $seller->district_id = $request->district_id;
        Log::info($seller);
        $seller->save();

        return redirect()->back()->with('message', 'seller successfully added!');
    }

    public function storeLogo($request)
    {

        $image = $request->file('logo');
        Storage::makeDirectory('logos');
        $imgpath = date("Y-m-d-h-i-sa") . rand(1, 1000) . "." . $image->getClientOriginalExtension();

        Storage::put('logos/' . $imgpath, \File::get($image));

        return $imgpath;

    }

    public function storeImage($request)
    {

        $image = $request->file('image');
        Storage::makeDirectory('sellerImage');
        $imgpath = date("Y-m-d-h-i-sa") . rand(1, 1000) . "." . $image->getClientOriginalExtension();

        Storage::put('sellerImage/' . $imgpath, \File::get($image));

        return $imgpath;

    }

    public function edit($id)
    {
        $districts = Districts::where('provinces_id', 1)->get();
        $seller = Sellers::where('sellers.id', $id)
            ->join('districts', 'sellers.district_id', 'districts.id')
            ->join('users', 'sellers.user_id', 'users.id')
            ->select('sellers.*', 'districts.district_name', 'users.email', 'users.phone')->first();
        return view('dashboard.sellers.edit', compact('districts', 'seller'));
    }

    public function updateAccount(Request $request)
    {

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

    public function updateInfo(Request $request)
    {

        $request->validate([
            'business_name' => 'required',
            'district_id' => 'required',
            'logo' => 'mimes:jpeg,png,bmp,jpg|max:20000',
            'image' => 'mimes:jpeg,png,bmp,jpg|max:20000',
        ]);

        //update customer

        $data['owner_name'] = $request->get('owner_name');
        $data['business_name'] = $request->get('business_name');
        $data['seller_type'] = $request->get('seller_type');
        $data['full_address'] = $request->get('full_address');
        $data['geolocation'] = $request->get('geolocation');
        $data['village'] = $request->get('village');
        $data['district_id'] = $request->get('district_id');
        if ($request->hasFile('logo')) {
            $imageaddress = $this->storeLogo($request);
            $data['logo'] = $imageaddress;
        }
        if ($request->hasFile('image')) {
            $imageaddress = $this->storeImage($request);
            $data['image'] = $imageaddress;
        }
        Sellers::where('user_id', $request->get('user_id'))->update($data);
        return redirect()->back()->with('message', 'Your Info Successfully Updated');

    }

    public function updatePassword(Request $request)
    {

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
