<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;  // For hashing the password


//register controller
class RegisterController extends Controller
{

    public function __construct() {
        $this->middleware('guest:admin')->except('logout','registerView','dashboardView','loginView');
    }



                //<<<<<<<<<Register code starts>>>>>>>>>>
    public function Register(Request $request)//register post req
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
                'message' => 'Admin registered  successfully',
            ], 200);
    }

  

    public function registerView() { //register get request
        if(Auth::guard('admin')->check())
        {
            return redirect()->route('admin.dashboard');
        }
        return view('register');
    }
                //<<<<<<<<<Register code ends>>>>>>>>>>


                //<<<<<<<<Login code starts>>>>>>>>>>>
 public function login(Request $request)//login post request
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
    if(Auth::guard('admin')->attempt($credentials))
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
 public function loginView() { //login get request
     if(Auth::guard('admin')->check())
     {
         return redirect()->route('admin.dashboard');
     }
     else if(Auth::guard('customer')->check()) {
        return redirect()->route('customer.dashboard');
    }
     return view('login');
 }
                        //<<<<<<<Login code ends>>>>>>>



    public function logout() { //logout
        if(Auth::guard('admin')->check())
        {
            Auth::guard('admin')->logout();
            session()->invalidate();  

        } 
        return redirect()->route('admin.login');
    }

   

    public function dashboardView() { //dashboard view
        if(Auth::guard('admin')->check())
        {
            return view('Admin.pages.Admin');
        }
        else
        {
            return redirect()->route('admin.login');
        }
    }
}

