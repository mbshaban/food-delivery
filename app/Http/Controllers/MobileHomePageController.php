<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\CustomerLocation;
use App\Models\Customers;
use App\Models\Menu;
use App\Models\Products;
use App\Models\Sellers;
use App\Models\Sliders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use JWTAuth;

class MobileHomePageController extends Controller
{
    //
    protected $user;


    public function getHomeData($id)
    {
        $slider = Sliders::select()->get();
        for ($i = 0; $i < count($slider); $i++) {
            $slider[$i]->slider_image = "http://10.10.10.245:8000/api/image-file/sliders/" . $slider[$i]->slider_image;
        }
        $categories = Categories::select()->get();
        for ($i = 0; $i < count($categories); $i++) {
            $categories[$i]->category_image = "http://10.10.10.245:8000/api/image-file/categories/" . $categories[$i]->category_image;
        }
        $sellers = Sellers::select('*')->get();

        for ($i = 0; $i < count($sellers); $i++) {
            $sellers[$i]['discount'] = 10;
            $sellers[$i]['delivery_cost'] = 50;
            $sellers[$i]['latitude'] = 123445;
            $sellers[$i]['longitude'] = 2154878;
            $sellers[$i]['logo'] = 'http://10.10.10.245:8000/api/image-file/logo/' . $sellers[$i]->logo;
            $sellers[$i]['image'] = 'http://10.10.10.245:8000/api/image-file/sellers/' . $sellers[$i]->image;

        }
        $customer = Customers::select('name','customers.email','gender','date_of_birth','profile_picture','phone')
            ->join('users','customers.user_id','=','users.id')
            ->where('user_id', $id)->get();
        for ($i = 0; $i < count($customer); $i++) {
            $customer[$i]->profile_picture = "http://10.10.10.245:8000/api/image-file/customer-image/" . $customer[$i]->profile_picture;
        }
        return response()->json([
            'slider' => $slider,
            'categories' => $categories,
            'sellers' => $sellers,
            'customer' => $customer
        ]);
    }

    public function getRestaurantByCategory($category_id)
    {
        try {
            $data = Sellers::select('*')->join('seller_category', 'sellers.id', '=', 'seller_category.seller_id')
                ->where('seller_category.category_id', '=', $category_id)->get();
            for ($i = 0; $i < count($data); $i++) {
                $data[$i]['discount'] = 10;
                $data[$i]['delivery_cost'] = 50;
                $data[$i]['latitude'] = 123445;
                $data[$i]['longitude'] = 2154878;
                $data[$i]['image'] = 'http://10.10.10.245:8000/api/image-file/sellers/' . $data[$i]->image;
                $data[$i]['logo'] = 'http://10.10.10.245:8000/api/image-file/logo/' . $data[$i]->logo;

            }
            return response()->json($data);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], 500);
        }
    }

    public function getRestaurantDetails($id)
    {
        $menuDetails = array();
        $menu = Menu::select('*')->get();
        for ($i = 0; $i < count($menu); $i++) {
            $menuDetails[$i]['title'] = $menu[$i]->title;
            $menuDetails[$i]['id'] = $menu[$i]->id;
            $menuDetails[$i]['products'] = Products::select('*')->where([
                ['seller_id', '=', $id], ['menu_id', '=', $menu[$i]->id]
            ])->get();
            for ($j = 0; $j < count($menuDetails[$i]['products']); $j++) {
                $menuDetails[$i]['products'][$j]->product_image =
                    'http://10.10.10.245:8000/api/image-file/product-image/' . $menuDetails[$i]['products'][$j]->product_image;
            }
        }
        return response()->json($menuDetails);
    }

    public function addCustomerAddress(Request $request)
    {
        try {
            DB::beginTransaction();
            $customer = Customers::where('user_id', $request->get('user_id'))->first();
            $data['longitude'] = $request->get('longitude');
            $data['latitude'] = $request->get('latitude');
            $data['map_address'] = $request->get('location_name');
            $data['title'] = $request->get('location_title');
            $data['address'] = $request->get('location_description');
            $data['phone'] = $request->get('phone');
            $data['customer_id'] = $customer->id;

            $location = CustomerLocation::create($data);
            DB::commit();
            return response()->json([
                'location_id' => $location->id
            ], 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'error' => $exception->getMessage()
            ], 500);
        }
    }

    public function getCustomerAddress($id)
    {
        try {
            DB::beginTransaction();
            $customer = Customers::where('user_id', $id)->first();
            $data = CustomerLocation::where('customer_id', $customer->id)->get();
            DB::commit();
            return response()->json($data, 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'error' => $exception->getMessage()
            ], 500);
        }

    }

    public function updateCustomer(Request $request, $id)
    {
        $imagePath = '';
        try {
            $prevFile = Customers::where('user_id', $id)->first();
            $prevImage = $prevFile->profile_picture;
            $data['name'] = $request->get('name');
            $data['email'] = $request->get('email');
            $data['gender'] = $request->get('gender');
            $data['date_of_birth'] = $request->get('dob');
            $image = $request->file('file');
            if ($request->hasFile('file')) {
                Storage::makeDirectory('customerImage');
                $imagePath = date("Y-m-d-h-i-sa") . rand(1, 1000) . "." . $image->getClientOriginalExtension();
                if ($prevImage) {
                    Storage::delete('customerImage/' . $prevImage);
                }
                Storage::put('customerImage/' . $imagePath, \File::get($image));
            }

            $data['profile_picture'] = $imagePath;
            $update = Customers::where('user_id', $id)->update($data);
            if ($update) {
                return response()->json($id, 200);
            }

        } catch (\Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], 500);
        }
    }

    public function getCustomer($id)
    {
        try {
            $data = Customers::select('*')->where('user_id', $id)->get();
            for ($i = 0; $i < count($data); $i++) {
                $data[$i]->profile_picture = "http://10.10.10.245:8000/api/image-file/customer-image/" . $data[$i]->profile_picture;
            }
            return response()->json($data, 200);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], 500);
        }
    }
}
