<?php
namespace App\Http\Controllers;

use App\Models\User;  // Correct import for User model
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;  // For hashing the password

class RegisterController extends Controller
{
    public function Register(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'fname' => 'required|min:5|string',
            'lname' => 'required|min:5|string',
            'email' => 'required|unique:users,email',
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
        $pass = Hash::make($request->input('password'));  // Hash the password for security

        // Insert data using the User model
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = $pass;
        $user->save();  // Save the user to the database
        
        return response()->json([
            'status' => 'success',
            'message' => 'User registered successfully',
        ], 200);
    }
}

