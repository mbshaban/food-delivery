<?php

namespace App\Http\Controllers;

use App\Models\WorkingHours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkingHoursController extends Controller
{
    //
    public function listWorkingHours()
    {
        $workingHours = WorkingHours::select('title', 'start_time', 'end_time', 'seller_id')
            ->join('sellers', 'sellers.id', '=', 'working_hours.seller_id')
            ->join('users', 'users.id', '=', 'sellers.user_id')
            ->where('users.id', '=', Auth::user()->id)
            ->get();
        return view('dashboard.working-hours.working-hours', compact('workingHours'));
    }
}
