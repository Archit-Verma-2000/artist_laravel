<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function Register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'fname' => 'required|min:5|regex:/(?!.*\s+)(?!.*\W+)(?!.*\d)[a-zA-Z]{5,}/',
            'lname' => 'required|min:5|regex:/(?!.*\s+)(?!.*\W+)(?!.*\d)[a-zA-Z]{5,}',
            'email' => 'required|regex://',
            'pass' =>  'required|min:5|regex://',
            'rpass' => 'required|min:8|regex://',
        ]);
        if($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'errors' => $validator->errors()
            ],422);
        }

    }
}
