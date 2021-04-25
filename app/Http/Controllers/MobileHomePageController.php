<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Sellers;
use App\Models\Sliders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MobileHomePageController extends Controller
{
    //
    public function getHomeData()
    {
        $sliders = null;
        $slider = Sliders::select()->get();
        for ($i = 0; $i < count($slider); $i++) {
            $slider[$i]->slider_image = "http://192.168.137.64:8000/api/image-file/sliders/" . $slider[$i]->slider_image;
        }
        $categories = Categories::select()->get();
        for ($i = 0; $i < count($categories); $i++) {
            $categories[$i]->category_image = "http://192.168.137.64:8000/api/image-file/categories/" . $categories[$i]->category_image;
        }
        $sellers = Sellers::select('id', 'business_name', 'seller_type', 'full_address', 'village',
            'status_id', 'isNew', 'isFavourite', 'delivery_time', 'review')->get();

        for ($i = 0; $i < count($sellers); $i++) {
            $sellers[$i]['discount'] = 10;
        }
        return response()->json([
            'slider' => $slider,
            'categories' => $categories,
            'sellers' => $sellers
        ]);
    }
}
