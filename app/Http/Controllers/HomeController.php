<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductContact;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\Purchase;
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
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index()
    {
        $data = "";
        if (Auth::User()->role == 'Admin') {
            $totalOrders = Order::count();
            $currenOrders = Order::where('status', '!=', 'confirmed')->count();
            $products = Product::count();
            $pending = Order::where('status', '=', 'pending')->count();
            $confirmed = Order::where('status', '=', 'confirmed')->count();
            $packaging = Order::where('status', '=', 'packaging')->count();
            $ftod = Order::where('status', '=', 'Field to Deliver')->count();
            $delivered = Order::where('status', '=', 'delivered')->count();
            $canceled = Order::where('status', '=', 'canceled')->count();
            $returned = Order::where('status', '=', 'returned')->count();
            $customer = User::where('role', '=', 'Customer')->count();
            $customerQueries = ProductContact::count();
            $vendorlist = User::where('role', '=', 'Vendor')->count();


            $top_products = Product::take(10)->get();
            $new_users = User::where('role', '=', 'Customer')->latest()->take(20)->get();

            $coupons = Coupon::take(15)->get();

            // out of stock pproducts
            $outofstock = Purchase::where('quantity', '=', 0)->with('product')->get();

            $isAdmin = Auth::user()->role == 'Admin';

            return view(
                'dashboard.dashboardv1',
                compact(
                    'totalOrders',
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
                    'vendorlist',
                    'top_products',
                    'new_users',
                    'isAdmin',
                    'coupons',
                    'outofstock'
                )
            );
        } else {
            $totalOrders = Order::where('o_vendor_id', Auth::User()->id)->count();
            // $currenOrders = Order::where('status', '!=', 'confirmed')->count();
            $currenOrders = Order::where('o_vendor_id', Auth::user()->id)->where('status', 'pending')->count();
            $products = Product::where('created_by', Auth::User()->id)->count();
            $pending = Order::where('o_vendor_id', Auth::user()->id)->where('status', 'pending')->count();
            $confirmed = Order::where('o_vendor_id', Auth::user()->id)->where('status', 'confirmed')->count();
            $packaging = Order::where('o_vendor_id', Auth::user()->id)->where('status', 'packaging')->count();
            $ftod = Order::where('o_vendor_id', Auth::user()->id)->where('status', 'Field to Deliver')->count();
            $delivered = Order::where('o_vendor_id', Auth::user()->id)->where('status', 'delivered')->count();
            $canceled = Order::where('o_vendor_id', Auth::user()->id)->where('status', 'canceled')->count();
            $returned = Order::where('o_vendor_id', Auth::user()->id)->where('status', 'returned')->count();
            // $returned = Order::where('status', '=', 'returned')->count();

            $customer = User::count();
            $customerQueries = ProductContact::where('vendor_id', '=', Auth::user()->id)->count();

            $top_products = Product::take(10)->get();
            $new_users = User::where('role', '=', 'Customer')->latest()->take(15)->get();

            $outofstock = Purchase::where('quantity', '=', 0)->where('user_id', '=', Auth::user()->id)->get();

            $isAdmin = Auth::user();

            $coupons = Coupon::where('id', '=', $isAdmin->id)->latest()->take(15)->get();

            return view(
                'dashboard.dashboardv1',
                compact(
                    'totalOrders',
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
                    'top_products',
                    'new_users',
                    'isAdmin',
                    'coupons',
                    'outofstock'
                )
            );
        }
    }
}
