<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->only([]);
        $this->middleware('auth:admin')->only('logout');
    }
    public function login(Request $request)
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
    public function loginView() {
        if(Auth::check())
        {
            return redirect()->route('products');
        }
        $response = response()->view('login');
        $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', '0');
        return $response;
    }
}
