<?php
    namespace App\Http\Controllers\Admin;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Http\Request;
    use App\Models\Customer;
?>
<?php
    Class AdminController extends Controller {
        public function __construct()   
        {
            $this -> middleware('guest:customer')->except('logout','registerView','dashboardView','loginView');
        }
        public function register(Request $request)
        {
            $validator=Validator::make($request->all(),[
                'fname'    =>  'required|min:5|string',
                'lname'    =>  'required|min:5|string',
                'email'    =>  'required|unique:customers,email',
                'password' =>  'required|confirmed|min:8',
            ]);
           if($validator->fails())
           {
                return response()->json([
                    'status' => "failed",
                    'errors' => $validator->errors(),
                ],422);
           }
           $name         =     $request ->  input('fname')." ".$request->input('lname');
           $email        =     $request ->  input('email');
           $password     =     $request ->  input('password');
           $passwordhash =     Hash::make($password);

           Customer::create([
                'name'      =>  $name,
                'email'     =>  $email,
                'password'  =>  $passwordhash,
           ]);

           return response() -> json([
                'status' => 'success',
                'msg'    => 'user registered successfully',
           ]);
        }
        public function registerView()
        {
            if(Auth::guard('customer')->check()) {
                return redirect()->route('customer.dashboard');
            }
            return view('register');
        }
        public function login(Request $request)
        {
            $validate = Validator::make($request->all(),[
                'email'     =>  'required|string|email:rfc,domain', 
                'password'  =>  'required|string|min:8',
            ]);
            if($validate->fails())
            {
                 return response()->json([
                     'status' => "failed",
                     'errors' => $validate->errors(),
                 ],422);
            }
            $credentials=[
                "email"        =>     $request ->  input('email'),
                "password"     =>     $request ->  input('password')
            ];
           
            if(Auth::guard('customer')->attempt($credentials))
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
                    'msg'   =>'user doesnt exists',
                ],200);
            }
        }
        public function loginView()
        {
            if(Auth::guard('customer')->check()) {
                return redirect()->route('customer.dashboard');
            }
            return view('login');
        }
        public function logout()
        {
            if(Auth::guard('customer')->check())
            {
                Auth::guard('customer')->logout();
                session()->invalidate();  
            } 
            return redirect()->route('customer.login');
        }
        public function dashboardView()
        {
            if(Auth::guard('customer')->check())
            {
                return view('Customer.pages.artist-detail');
            }
            else
            {
                return redirect()->route('customer.login');
            }
        }
    }
?>