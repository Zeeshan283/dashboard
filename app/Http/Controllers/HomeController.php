<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\ProductContact;
use App\Models\Product;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
  

    public function index()
    {   
        $totalOrders = Order::count();
        $currenOrders = Order::where('status', '!=', 'confirmed')->count();
        $products = Product::count();
        $pending = Order::where('status', '=', 'In Process')->count();
        $confirmed = Order::where('status', '=', 'confirmed')->count();
        $packaging = Order::where('status', '=', 'packaging')->count();
        $ftod = Order::where('status', '=', 'Field to Deliver')->count();
        $delivered = Order::where('status', '=', 'delivered')->count();
        $canceled = Order::where('status', '=', 'canceled')->count();
        $returned = Order::where('status', '=', 'returned')->count();
        $customer = User::count();
        return view('dashboard.dashboardv1', 
        compact('totalOrders',
        'currenOrders', 
        'products',
        'pending',
        'confirmed',
        'packaging',
        'ftod', 
        'delivered',
        'canceled',
        'returned', 
        'customer'));
    }
}
