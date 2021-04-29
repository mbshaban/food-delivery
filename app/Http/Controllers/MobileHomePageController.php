<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Sellers;
use App\Models\Sliders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use JWTAuth;

class MobileHomePageController extends Controller
{
    //
    protected $user;


    public function getHomeData()
    {
        Log::info('hleloooooooooooooooooo');
        $slider = Sliders::select()->get();
        for ($i = 0; $i < count($slider); $i++) {
            $slider[$i]->slider_image = "http://192.168.137.64:8000/api/image-file/sliders/" . $slider[$i]->slider_image;
        }
        $categories = Categories::select()->get();
        for ($i = 0; $i < count($categories); $i++) {
            $categories[$i]->category_image = "http://192.168.137.64:8000/api/image-file/categories/" . $categories[$i]->category_image;
        }
        $sellers = Sellers::select('id', 'business_name', 'seller_type', 'full_address', 'village', 'image',
            'status_id', 'is_new', 'is_favourite', 'delivery_time', 'review')->get();

        Log::info($slider);
        for ($i = 0; $i < count($sellers); $i++) {
            $sellers[$i]['discount'] = 10;
            $sellers[$i]['image'] = 'http://192.168.137.64:8000/api/image-file/sellers/' . $sellers[$i]->image;

        }
        return response()->json([
            'slider' => $slider,
            'categories' => $categories,
            'sellers' => $sellers
        ]);
    }

    public function getRestaurantByCategory($category_id)
    {
        $data = Sellers::select('*')->join('seller_category', 'sellers.id', '=', 'seller_category.seller_id')
            ->where('seller_category.category_id', '=', $category_id)->get();
        return response()->json($data);
    }

}
