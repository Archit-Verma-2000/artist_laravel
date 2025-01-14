<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;  // For hashing the password


class RegisterController extends Controller
{
    public function __construct() {
        $this->middleware('guest:admin')->except('logout','registerView');
    }

    public function Register(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'fname' => 'required|min:5|string',
            'lname' => 'required|min:5|string',
            'email' => 'required|unique:admins,email',
            'password' => 'required|confirmed|min:8',  // Added min:8 for password security
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Prepare the data to save
        $name = $request->input('fname') . " " . $request->input('lname');
        $email = $request->input('email');
        $password = $request->input('password');  // Using the plain password for authentication
        $hashedPassword = Hash::make($password);  // Hash the password for security

        // Insert data using the Customer model
        Admin::create([
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
        ]);

            return response()->json([
                'status' => 'success',
                'message' => 'User registered and logged in successfully',
            ], 200);
    }

  

    public function registerView() {
        if(Auth::guard('admin')->check())
        {
            return redirect()->route('dashboard');
        }
        return view('register');
    }

    public function logout() {
        if(Auth::guard('admin')->check())
        {
            Auth::guard('admin')->logout();
            session()->invalidate();  

        } 
        return redirect()->route('login');
    }

}

