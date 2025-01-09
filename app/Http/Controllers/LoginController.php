<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
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
                'status'=> "failed",
                'error' => $validate->errors()
            ],422);
        }
        $credentials=[
            'email' => $request->input('email'),
            'password' =>$request->input('password')
        ];
       if(Auth::attempt($credentials))
       {
            $request->session()->regenerate();
            return response()->json([
                'status' => 'success',
            ],200);
       }
       else
       {
            return response()->json([
                'status' => 'failed',
                'error' => 'user not found',
            ],200);
       }
    }
}
