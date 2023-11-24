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
use Illuminate\Support\Facades\Route;
use App\Models\Notification;

class OrderController extends Controller
{
    use fontAwesomeTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->role == 'Admin') {
            $data = Order::orderBy('id', 'desc')->get();
        } else {
            $data = Order::where('timestamp', Auth::user()->id)->orderBy('id', 'desc')->get();
        }
 return view('orders.allorders', compact('data'));
    }

	public function order_details()
{
    return $this->hasMany(OrderDetails::class, 'order_id');
}

    public function showOrders()
    {
        $routeName = Route::currentRouteName();

        if ($routeName === 'pendingorders') {
            $data = Order::where('status', '=', 'pending')->orderBy('id', 'desc')->get();
            return view('orders.pendingorders', compact('data'));
        }
        if ($routeName === 'confirmedorders') {
            $data = Order::where('status', '=', 'confirmed')->orderBy('id', 'desc')->get();
            return view('orders.confirmedorders', compact('data'));
        }
        if ($routeName === 'packagingorders') {
            $data = Order::where('status', '=', 'packaging')->orderBy('id', 'desc')->get();
            return view('orders.packagingorders', compact('data'));
        }
        if ($routeName === 'outofdelivery') {
            $data = Order::where('status', '=', 'out of delivery')->orderBy('id', 'desc')->get();
            return view('orders.outofdelivery', compact('data'));
        }
        if ($routeName === 'delivered') {
            $data = Order::where('status', '=', 'delivered')->orderBy('id', 'desc')->get();
            return view('orders.delivered', compact('data'));
        }
        if ($routeName === 'returned') {
            $data = Order::where('status', '=', 'returned')->orderBy('id', 'desc')->get();
            return view('orders.returned', compact('data'));
        }
        if ($routeName === 'ftod') {
            $data = Order::where('status', '=', 'Field to Deliver')->orderBy('id', 'desc')->get();
            return view('orders.ftod', compact('data'));
        }
        if ($routeName === 'canceled') {
            $data = Order::where('status', '=', 'canceled')->orderBy('id', 'desc')->get();
            return view('orders.canceled', compact('data'));
        }
    }

    public function thanks($id)
    {
        $thanks = Order::findOrFail($id);
        return view('thankyou', compact('thanks'));
    }

    public function create()
    {
        return view('order.fetch_date');
    }

    public function store(Request $request)
    {
        $fromDate = $request->get('from_date');
        $toDate = $request->get('to_date');

        $order = Order::whereDate('created_at', '>=', $fromDate)
            ->whereDate('created_at', '<=', $toDate)
            ->get();
    
        $order = Order::whereDate('created_at', '>=', $fromDate)
            ->whereDate('created_at', '<=', $toDate)
            ->first();
    
        if ($order) {
            Notification::create([
                'user_id' => Auth::user()->id,
                'Order_id' => 'New order placed with ID ' . $order->id,
            ]);
    
            $order->status = $request->status;
            $order->update();
        }
    
        return view('order.order_report', compact('fromDate', 'toDate', 'order'));
    }
    
    

    public function show($id)
    {
        $order = Order::findOrFail($id);

        return view('orders.details', compact('order'));
    }

    public function edit($id)
    {
        $edit = Order::findOrFail($id);
        $status = array(
            '' => 'Select Option',
            'In Process' => 'In Process',
            'Your order has arrived in port' => 'Your order has arrived in port',
            'Your order has arrived in courier' => 'Your order has arrived in courier',
            'Your order has arrived in warehouse' => 'Your order has arrived in warehouse',
            'Left from warehouse' => 'Left from warehouse',
            'Left from port' => 'Left from port',
            'Left from courier' => 'Left from courier',
            'Your order has been delivered' => 'Your order has been delivered'
        );
        $locations = Locations::pluck('name', 'name');

        $orderTrackerDetails = OrderTracker::where('order_id', $id)->get();
        $data = $this->fontIndex();
        return view('order.edit_status', compact('edit', 'status', 'locations', 'orderTrackerDetails', 'data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'order_id' => 'required',
            'status' => 'required',
            'id' => 'required',
        ], [
            'status.required' => 'The status field is required',
        ]);

        $order_status = Order::where('id', $request->id)->first();
        $order_status->status = $request->status;
        $order_status->update();

        return redirect()->back();
    }

    public function VendorOrders()
    {
        $data = OrderDetails::with('order')->where('vendor_id', Auth::user()->id)->get();
        return view('order.vendor-index', compact('data'));
    }

    public function VendorOrderReceipt($id)
    {
        $order_detail = OrderDetails::with('products')->find($id);
        $order = Order::findOrFail($order_detail->order_id);

        return view('order.vendor_order_report', compact('order', 'order_detail'));
    }


    // public function notification(Request $request)
    // {
    //     $request->validate([
    //         'id' => 'required|string|max:255',
    //         'order_id' => 'required|string',
    //     ]);
    
    //     $order = new Order();
    //     $order->id = Auth::user()->id;
    //     $order->order_id = $request->order_id;
    //     $order->timestamp = now();
    //     $order->save();
    
    //     // Create a new notification record
    //     $notification = new Notification();
    //     $notification->id = Auth::user()->id;
    //     $notification->order_id = $request->order_id;
    //     $notification->timestamp = now();
    //     $notification->save();
    
    //     $data = Order::where('timestamp', '>=', now()->subDay())->get();
    
    //     return redirect()->route('orders.allorder')->with('data', $data);
    // }
    
    // public function getNotifications()
    // {
    //     $unreadNotifications = Notification::where('name', Auth::user()->name)
    //         ->where('read', false)
    //         ->where('timestamp', '>=', now()->subDay())
    //         ->get();
    
    //     $unreadNotificationsCount = $unreadNotifications->count();
    
    //     return view('layouts.header', compact('unreadNotifications', 'unreadNotificationsCount'));
    // }
    
    public function destroy($id)
    {
        // Your destroy method code here
    }
}
