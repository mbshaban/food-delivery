<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\PostDec;

class MenuController extends Controller
{
    //
    public function listMenu()
    {
        $menus = Menu::select('*')->latest('menu.created_at')
            ->paginate(5);;
        return view('dashboard.menu.menu', compact('menus'));
    }

    public function addMenu(Request $request)
    {
        $v = Validator::make($request->all(),
            [
                'title' => 'required|max:250',
            ]);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {
            $data['title'] = $request->get('title');
            $insert = Menu::create($data);
            if ($insert) {
                return redirect('dashboard/menu');
            }
        }
    }

    public function showUpdateMenuView($id)
    {
        $data = Menu::where('id', $id)->first();
        return view('dashboard.menu.edit-menu', compact('data'));
    }

    public function updateMenu(Request $request, $id)
    {
        $v = Validator::make($request->all(),
            [
                'title' => 'required|max:250',
            ]);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {
            $data['title'] = $request->get('title');
            $insert = Menu::where('id', $id)->update($data);
            if ($insert) {
                return redirect('dashboard/menu');
            }
        }
    }

    public function deleteMenu(Request $request)
    {
        Menu::where('id', $request->get('id'))->delete();
        return 'success';
    }
}
