<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use App\Notifications\NewUserNotification;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    //
    public function listProducts()
    {
        //        if (Auth::user()->role === 'admin') {
        $products = Products::select('product_title', 'price', 'discount', 'product_image', 'product_status', 'products.id', 'isApproved',
            'description', 'category_id', 'serller_id', 'categories.category_name', 'sellers.business_name')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->join('sellers', 'sellers.id', '=', 'products.serller_id')
            ->latest('products.created_at')
            ->paginate(5);
        $categories = Categories::select('type', 'category_webaddress', 'category_name', 'category_image', 'category_description', 'id')
            ->latest('categories.created_at')
            ->get();
        return view('dashboard.product.product', compact('products', 'categories'));
//        } elseif (Auth::user()->role === 'blogger') {
//            $blogs = Blog::select('blog.title', 'blog.created_at', 'language', 'author', 'blog.id', 'blog.user_id')
//                ->where('blog.user_id', '=', Auth::user()->id)
//                ->latest('blog.created_at')
//                ->paginate(10);
//            return view('dashboard.blog.view', compact('blogs'));
//
//        } else {
//            App::abort(503);
//        }
    }

    public function addProduct(Request $request)
    {
        $user = null;
        //        if (Auth::user()->role === 'admin' || Auth::user()->role === 'blogger') {
        $v = Validator::make($request->all(),
            [
                'product_title' => 'required|max:250',
                'category_id' => 'required',
                'description' => 'required',
                'seller_id' => 'required',
                'price' => 'required|max:250',
                'discount' => 'required|max:250',
                'product_status' => 'required|max:250',
                'isApproved' => 'required|max:250',
                'product_image' => 'mimes:jpeg,png,bmp,jpg|max:20000'
            ]);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {
            $image = $request->file('product_image');
            Storage::makeDirectory('productImage');
            $imagePath = date("Y-m-d-h-i-sa") . rand(1, 1000) . "." . $image->getClientOriginalExtension();
            $data['product_title'] = $request->get('product_title');
            $data['category_id'] = $request->get('category_id');
            $data['description'] = $request->get('description');
            $data['serller_id'] = $request->get('seller_id');
            $data['price'] = $request->get('price');
            $data['discount'] = $request->get('discount');
            $data['product_status'] = $request->get('product_status');
            $data['isApproved'] = $request->get('isApproved');
            $data['product_image'] = $imagePath;
            $insert = Products::create($data);
            Storage::put('productImage/' . $imagePath, \File::get($image));
            Notification::send($user, new NewUserNotification($request->get('product_title')));
            if ($insert) {
                return redirect('dashboard/products');
            }
        }
//        } else {
//            App::abort(503);
//        }
    }

    public function deleteProduct(Request $request)
    {

        Products::where('id', $request->get('id'))->delete();
        DB::commit();
        return "success";
    }

    public function updateProductView($id)
    {
        $data = Products::where('id', $id)->first();
        $categories = Categories::select('type', 'category_webaddress', 'category_name', 'category_image', 'category_description', 'id')
            ->latest('categories.created_at')
            ->get();
        return view('dashboard.product.edit-product', compact('data', 'categories'));
    }

    public function updateProduct(Request $request, $id)
    {
        $v = Validator::make($request->all(),
            [
                'product_title' => 'required|max:250',
                'category_id' => 'required',
                'description' => 'required',
                'seller_id' => 'required',
                'price' => 'required|max:250',
                'discount' => 'required|max:250',
                'product_status' => 'required|max:250',
                'isApproved' => 'required|max:250',
                'product_image' => 'mimes:jpeg,png,bmp,jpg|max:20000'
            ]);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {
            $data['product_title'] = $request->get('product_title');
            $data['category_id'] = $request->get('category_id');
            $data['description'] = $request->get('description');
            $data['serller_id'] = $request->get('seller_id');
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
            return redirect('dashboard/products');
        }
    }
}
