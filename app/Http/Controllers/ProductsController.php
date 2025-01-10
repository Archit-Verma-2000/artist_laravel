<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');//checks if guest authorize nhi authorized 
    }
    public function ProductView() {
        return view('Customer.pages.product-detail');
    }
}
