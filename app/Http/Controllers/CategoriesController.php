<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{

    public function addProductCategory(Request $request)
    {
        Log::info($request->all());
//        if (Auth::user()->role === 'admin' || Auth::user()->role === 'blogger') {
        $v = Validator::make($request->all(),
            [
                'type' => 'required|max:250',
                'category_webaddress' => 'required|max:250',
                'category_name' => 'required|max:250',
                'category_image' => 'mimes:jpeg,png,bmp,jpg|max:20000',
                'category_description' => 'required'
            ]);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {
            $image = $request->file('category_image');
            Storage::makeDirectory('categoryImage');
            $imagePath = date("Y-m-d-h-i-sa") . rand(1, 1000) . "." . $image->getClientOriginalExtension();
            $data['type'] = $request->get('type');
            $data['category_webaddress'] = $request->get('category_webaddress');
            $data['category_name'] = $request->get('category_name');
            $data['category_description'] = $request->get('category_description');
            $data['category_image'] = $imagePath;
            $insert = Categories::create($data);
            Storage::put('categoryImage/' . $imagePath, \File::get($image));

            if ($insert) {
                return redirect('dashboard/categories');
            }
        }
//        } else {
//            App::abort(503);
//        }
    }

    public function listCategories()
    {
//        if (Auth::user()->role === 'admin') {
        $categories = Categories::select('type', 'category_webaddress', 'category_name', 'category_image', 'category_description', 'id')
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
