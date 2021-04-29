<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Menu;
use App\Models\Products;
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
        $slider = Sliders::select()->get();
        for ($i = 0; $i < count($slider); $i++) {
            $slider[$i]->slider_image = "http://169.254.90.11:8000/api/image-file/sliders/" . $slider[$i]->slider_image;
        }
        $categories = Categories::select()->get();
        for ($i = 0; $i < count($categories); $i++) {
            $categories[$i]->category_image = "http://169.254.90.11:8000/api/image-file/categories/" . $categories[$i]->category_image;
        }
        $sellers = Sellers::select('id', 'business_name', 'seller_type', 'full_address', 'village', 'image',
            'status_id', 'is_new', 'is_favourite', 'delivery_time', 'review')->get();

        for ($i = 0; $i < count($sellers); $i++) {
            $sellers[$i]['discount'] = 10;
            $sellers[$i]['image'] = 'http://169.254.90.11:8000/api/image-file/sellers/' . $sellers[$i]->image;

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
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['discount'] = 10;
            $data[$i]['delivery_cost'] = 50;
            $data[$i]['image'] = 'http://169.254.90.11:8000/api/image-file/sellers/' . $data[$i]->image;
            $data[$i]['logo'] = 'http://169.254.90.11:8000/api/image-file/logo/' . $data[$i]->logo;

        }
        return response()->json($data);
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
                    'http://169.254.90.11:8000/api/image-file/product_image/' . $menuDetails[$i]['products'][$j]->product_image;
            }
        }
        return response()->json($menuDetails);
    }

}
