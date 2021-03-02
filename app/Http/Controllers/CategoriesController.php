<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{

    public function addProductCategory(Request $request)
    {
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

    public function deleteProductCategory(Request $request)
    {

//        if (Auth::user()->role === 'admin' || Auth::user()->role === 'blogger') {

        DB::beginTransaction();
//            $data = BlogContent::select('title', 'blog_id', 'content', 'path as image_path', 'blog_details.id as content_id', 'files.id as file_id')
//                ->leftJoin('blog_details_files', 'blog_details.id', '=', 'blog_details_files.blog_details_id')
//                ->leftJoin('files', 'blog_details_files.file_id', '=', 'files.id')
//                ->where('blog_details.blog_id', '=', $request->get('id'))
//                ->get();
//            for ($i = 0; $i < count($data); $i++) {
//                if ($data[$i]->image_path !== null) {
//                    BlogContentFile::where('blog_details_files.blog_details_id', $data[$i]->content_id)->delete();
//                    Storage::delete('blogContentFile/' . $data[$i]->image_path);
//                    BlogContent::where('id', $data[$i]->content_id)->delete();
//                    File::where('id', $data[$i]->file_id)->delete();
//                } else {
//                    BlogContent::where('id', $data[$i]->content_id)->delete();
//                }
//            }
        Categories::where('id', $request->get('id'))->delete();
        DB::commit();
        return "success";

//        } else {
//            App::abort(503);
//        }
    }

    public function showUpdateCategoryView($id)
    {
//        if (Auth::user()->role === 'admin' || Auth::user()->role === 'blogger') {

        $data = Categories::where('id', $id)->first();
        Log::info($data);
        return view('dashboard.category.edit-category', compact('data'));
//        } else {
//            App::abort(503);
//        }
    }

    public function updateCategory(Request $request, $id)
    {

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
            $data['type'] = $request->get('type');
            $data['category_webaddress'] = $request->get('category_webaddress');
            $data['category_name'] = $request->get('category_name');
            $data['category_description'] = $request->get('category_description');
            if ($request->hasFile('category_image')) {
                $image = $request->file('category_image');
                Storage::makeDirectory('categoryImage');
                $imagePath = date("Y-m-d-h-i-sa") . rand(1, 1000) . "." . $image->getClientOriginalExtension();
                $data['category_image'] = $imagePath;
                $update = Categories::where('id', $id)->update($data);
                if ($update) {
                    Storage::put('categoryImage/' . $imagePath, \File::get($image));
                    Storage::delete('categoryImage/' . $request->get('prev_image_path'));
                }
            } else {
                Categories::where('id', $id)->update($data);
            }
            return redirect('dashboard/categories');
        }
    }
}
