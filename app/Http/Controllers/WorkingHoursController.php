<?php

namespace App\Http\Controllers;

use App\Models\Sellers;
use App\Models\WorkingHours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WorkingHoursController extends Controller
{
    //
    public function listWorkingHours()
    {
        $workingHours = WorkingHours::select('title', 'start_time', 'end_time', 'seller_id', 'working_hours.id')
            ->join('sellers', 'sellers.id', '=', 'working_hours.seller_id')
            ->join('users', 'users.id', '=', 'sellers.user_id')
            ->where('users.id', '=', Auth::user()->id)
            ->get();
        return view('dashboard.working-hours.working-hours', compact('workingHours'));
    }

    public function addWorkingHours(Request $request)
    {
        $v = Validator::make($request->all(),
            [
                'title' => 'required|max:250',
                'start_time' => 'required',
                'end_time' => 'required',
                'user_id' => 'required'
            ]);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {
            $sellerInfo = Sellers::where('user_id', '=', $request->get('user_id'))->first();
            $data['title'] = $request->get('title');
            $data['start_time'] = $request->get('start_time');
            $data['end_time'] = $request->get('end_time');
            $data['seller_id'] = $sellerInfo->id;
            $insert = WorkingHours::create($data);
            if ($insert) {
                return redirect('dashboard/working-hours');
            }
        }
    }

    public function showUpdateWorkingHourView($id)
    {
        $data = WorkingHours::where('id', $id)->first();
        return view('dashboard.working-hours.edit-working-hours', compact('data'));

    }

    public function updateWorkingHours(Request $request, $id)
    {
        $v = Validator::make($request->all(),
            [
                'title' => 'required|max:250',
                'start_time' => 'required',
                'end_time' => 'required',
            ]);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        } else {
            $data['title'] = $request->get('title');
            $data['start_time'] = $request->get('start_time');
            $data['end_time'] = $request->get('end_time');
            $insert = WorkingHours::where('id', $id)->update($data);
            if ($insert) {
                return redirect('dashboard/working-hours');
            }
        }
    }

    public function deleteWorkingHours(Request $request)
    {
        WorkingHours::where('id', $request->get('id'))->delete();
        return 'success';
    }
}
