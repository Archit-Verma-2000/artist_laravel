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
        $this->middleware('guest:admin')->except('logout');
    }

    public function Register(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'fname' => 'required|min:5|string',
            'lname' => 'required|min:5|string',
            'email' => 'required|unique:Customers,email',
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

        // Prepare credentials for login attempt
        $credentials = [
            'email' => $email,
            'password' => $password  // Use the plain password here
        ];

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json([
                'status' => 'success',
                'message' => 'User registered and logged in successfully',
            ], 200);
        }

        // If authentication fails
        return response()->json([
            'status' => 'failed',
            'message' => 'Authentication failed after registration',
        ], 401);
    }

   

    public function registerView() {
        if(Auth::check())
        {
            return redirect()->route('products');
        }
        $response = response()->view('register');
        $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', '0');
        return $response;
    }

    public function logout() {
        if(Auth::check())
        {
            Auth::logout();
            session()->invalidate();  
            session()->regenerateToken();  
        } 
        return redirect()->route('login');
    }
}


