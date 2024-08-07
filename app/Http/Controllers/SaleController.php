<?php

namespace App\Http\Controllers;

use App\Models\Locations;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\OrderTracker;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Traits\fontAwesomeTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Models\Notification;
use App\Models\OrderDetail;
use App\Models\Subcategory;
use Carbon\Carbon;
class SaleController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::User()->role == 'Admin') {
            $data = OrderDetail::with('order', 'product', 'vendor')->OrderBy('id', 'desc')
                ->get();
                $totalSale = OrderDetail::with('order', 'product', 'vendor')->where('status', 'Delivered')
                ->count();
        } else {
            $data = OrderDetail::with('order',  'product', 'vendor')->where('p_vendor_id', Auth::User()->id)
                ->OrderBy('id', 'desc')
                ->get();
                $totalSale = OrderDetail::with('order',  'product', 'vendor')->where('p_vendor_id', Auth::User()->id)
                ->where('status', 'Delivered')
                ->count();
        }
        foreach ($data as $orderDetail) {
            
            $subcategory = Subcategory::find($orderDetail->product->subcategory_id);
            $commission = $subcategory->commission;
        //    Calculate commission based on the subcategory commission rate
            $commission = $orderDetail->p_price * $orderDetail->quantity * ($subcategory->commission / 100);
            
            // Add commission to the order detail object
            $orderDetail->commission = $commission;
        }
        // $data = Order::orderBy('id', 'desc')->get();
        return view('sales.index', compact('data','totalSale'));
        // return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
