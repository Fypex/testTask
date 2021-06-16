<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function user(){
        return response()->json(Auth::user()->with('Discounts.Discount')->first(), 200);
    }

}
