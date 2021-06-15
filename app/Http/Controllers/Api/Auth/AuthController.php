<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Discounts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function signIn(Request $request){


        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $user->tokens()->delete();
            $token = $user->createToken($request->email)->plainTextToken;
            return response(['token' => $token], 200);
        }else{
            return response('Unauthorised', 401);
        }

    }

    public static function signUp(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6'
        ]);

        if ($validator->fails()){
            return response($validator->errors()->first(), 400);
        }

        if(!empty(User::where('email', $request->email)->first()->id)){
            return response('User with this email already registered', 200);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $discount = Discount::first();
        if ($discount){
            $user->Discounts()->create([
                'discount_id' => $discount->id,
                'active' => true
            ]);
        }

        $token = $user->createToken('default')->plainTextToken;
        return response(['token' => $token], 200);
    }
}
