<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Sellers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
    //
    public function listOrders()
    {
        $sellers = Sellers::all();
        return view('dashboard.orders.order', compact('sellers'));
    }

    public function addOrder(Request $request)
    {
        $v = Validator::make($request->all(),
            [
                'location' => 'required|max:250',
                'geolocation' => 'required|max:250',
                'village' => 'required|max:250',
                'customer_id' => 'required',
                'seller_id' => 'required',
                'order_status' => 'required',
            ]);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {
            $data['location'] = $request->get('location');
            $data['geolocation'] = $request->get('geolocation');
            $data['village'] = $request->get('village');
            $data['seller_id'] = $request->get('seller_id');
            $data['customer_id'] = $request->get('customer_id');
            $data['order_status'] = $request->get('order_status');
            $insert = Orders::create($data);

            if ($insert) {
                return redirect('dashboard/orders');
            }
        }
    }
}
