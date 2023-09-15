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
    {   $data = "";
        if (Auth::User()->role == 'Admin') {
            $totalOrders = Order::count();
            $currenOrders = Order::where('status', '!=', 'confirmed')->count();
            $products = Product::count();
            $pending = OrderDetails::join('orders','orders.id','=','order_details.order_id')->where('order_details.vendor_id',Auth::User()->id)->count();
            $confirmed = Order::where('status', '=', 'confirmed')->count();
            $packaging = Order::where('status', '=', 'packaging')->count();
            $ftod = Order::where('status', '=', 'Field to Deliver')->count();
            $delivered = Order::where('status', '=', 'delivered')->count();
            $canceled = Order::where('status', '=', 'canceled')->count();
            $returned = Order::where('status', '=', 'returned')->count();
            $customer = User::where('role', '=', 'Customer')->count();
            $customerQueries = ProductContact::count();
            $vendorlist = User::where('role','=','Vendor')->count();

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
            'customer',
            'customerQueries',
            'vendorlist'));
        } else {
            $totalOrders = OrderDetails::where('vendor_id', Auth::User()->id)->count();
            // $currenOrders = Order::where('status', '!=', 'confirmed')->count();
            $currenOrders = OrderDetails::join('orders','orders.id','=','order_details.order_id')
            ->where('order_details.vendor_id',Auth::User()->id)
            ->where('orders.status', '!=' , 'confirmed')->count();
            $products = Product::where('created_by', Auth::User()->id)->count();
            // $pending = OrderDetails::join('orders','orders.id','=','order_details.order_id')->where('order_details.vendor_id',Auth::User()->id)->count();
            $pending = OrderDetails::join('orders','orders.id','=','order_details.order_id')
            ->where('order_details.vendor_id',Auth::User()->id)
            ->where('orders.status','=', 'pending')->count();
            $confirmed = OrderDetails::join('orders','orders.id','=','order_details.order_id')
            ->where('order_details.vendor_id',Auth::User()->id)
            ->where('orders.status','=', 'confirmed')->count();
            $packaging = OrderDetails::join('orders','orders.id','=','order_details.order_id')
            ->where('order_details.vendor_id',Auth::User()->id)
            ->where('orders.status','=', 'packaging')->count();
            // $ftod = Order::where('status', '=', 'Field to Deliver')->count();
            $ftod = OrderDetails::join('orders','orders.id','=','order_details.order_id')
            ->where('order_details.vendor_id',Auth::User()->id)
            ->where('orders.status','=', 'Dield to Deliver')->count();
            // $delivered = Order::where('status', '=', 'delivered')->count();
            $delivered = OrderDetails::join('orders','orders.id','=','order_details.order_id')
            ->where('order_details.vendor_id',Auth::User()->id)
            ->where('orders.status','=', 'delivered')->count();
            // $canceled = Order::where('status', '=', 'canceled')->count();
            $canceled = OrderDetails::join('orders','orders.id','=','order_details.order_id')
            ->where('order_details.vendor_id',Auth::User()->id)
            ->where('orders.status','=', 'canceled')->count();
            // $returned = Order::where('status', '=', 'returned')->count();
            $returned = OrderDetails::join('orders','orders.id','=','order_details.order_id')
            ->where('order_details.vendor_id',Auth::User()->id)
            ->where('orders.status','=', 'returned')->count();
            $customer = User::count();
            $customerQueries = ProductContact::where('vendor_id','=',Auth::user()->id )->count();
            
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
            'customer',
            'customerQueries'));
        }

        
        
    }
}
