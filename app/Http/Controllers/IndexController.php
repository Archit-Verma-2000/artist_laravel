<?php
    namespace App\Http\Controllers;
    use App\Http\Controllers\Controller;

    Class IndexController extends Controller 
    {
        public function __construct()
        {
            $this->middleware('auth:admin');
        }
        public function indexView()
        {
            return view('Admin.pages.Admin');
        }
    }
?>