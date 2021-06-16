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

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json(true, 200);
        }

        return response('The provided credentials do not match our records.', 400);

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

        return response(true, 200);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response(true, 200);
    }
}
