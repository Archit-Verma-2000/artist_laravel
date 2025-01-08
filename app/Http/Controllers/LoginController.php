<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class LoginController extends Controller
{
    public function Login(Request $request)
    {
        $validate=Validator::make($request->all(),[
            'email' => 'required|string|regex:/^[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}$/',
            'password' => 'required|string|min:8',
        ]);
        if($validate->fails()) {
            return response()->json([
                'status'=>'failed',
                'errors'=>$validate->errors()
            ],422);
        }
    }
}
