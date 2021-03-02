<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    //
    public function listProducts(){
        //        if (Auth::user()->role === 'admin') {
        $categories = Products::select('type', 'category_webaddress', 'category_name', 'category_image', 'category_description', 'id')
            ->latest('categories.created_at')
            ->paginate(5);
        return view('dashboard.category.category', compact('categories'));
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
}
