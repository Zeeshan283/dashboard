<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        
        $data = "";
        if (Auth::User()->role == 'Admin') {
            $data = Product::with('product_image')
                ->with('categories:id,name')
                ->with('subcategories:id,name')
                ->OrderBy('id', 'desc')
                ->get();
        } else {
            $data = Product::with('product_image')
                ->with('categories:id,name')
                ->with('subcategories:id,name')
                ->where('created_by', Auth::User()->id)
                ->OrderBy('id', 'desc')
                ->get();
        }


        return view('products.allproducts', compact('data'));
    }
}
