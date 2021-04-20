<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use JWTAuth;

class AuthController extends Controller
{

//    public function __construct()
//    {
//        $this->middleware('auth:api', ['except' => ['login', 'register']]);
//    }

    public function register(Request $request)
    {
        Log::info($request->all());
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|between:10,10',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $userExist = User::where('phone', $request['phone'])->first();

        try {
            if ($userExist) {
                return response()->json(['duplicate phone']);
            } else {
                DB::beginTransaction();
                $user = new User;
                $user->phone = $request['phone'];
                $user->account_type = 'customer';
                $user->password = bcrypt($request['password']);
                $user->save();

                $customer = new Customers();
                $customer->user_id = $user->id;
                $customer->save();

                $token = auth()->login($user);
                DB::commit();
                return $this->respondWithToken($token, $user->id);
            }


        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'error' => $exception->getMessage()
            ], 500);
        }
    }

    public function checkUser(Request $request)
    {
        Log::info($request->all());
        $userExist = User::where('phone', $request['phone'])->first();
        if ($userExist) {
            return response()->json(['isExist' => true]);
        } else {
            return response()->json(['isExist' => false]);
        }

    }

    public function addUserDetails(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'isMale' => 'required',
            'profile_picture' => ''

        ]);
    }

    public function getUser()
    {
        Log::info('hello');
        return response()->json(['text' => 'hello']);
    }

    protected function respondWithToken($token, $userId)
    {
        return response()->json([
            'user_id' => $userId,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 180
        ]);
    }

}
