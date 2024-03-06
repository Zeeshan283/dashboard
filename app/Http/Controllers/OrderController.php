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
use Carbon\Carbon;

class OrderController extends Controller
{
    use fontAwesomeTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $data = "";
        $orders = Order::all();
        $query = Order::query();

        if ($request->has('first_name . last_name')) {
            $first = $request->input('first_name . last_name');
            if (is_array($first)) {
                $query->whereIn('first_name . last_name', $first);
            } else {
                $query->where('first_name . last_name', $first);
            }
        }

        if ($request->has('total_price')) {
            $total = $request->input('total_price');
            if (is_array($total)) {
                $query->whereIn('total_price', $total);
            } else {
                $query->where('total_price', $total);
            }
        }

        if ($request->has('shipping_address . shipping_city . shipping_state . shipping_zipcode . shipping_country')) {
            $address = $request->input('shipping_address . shipping_city . shipping_state . shipping_zipcode . shipping_country');
            if (is_array($address)) {
                $query->whereIn('shipping_address . shipping_city . shipping_state . shipping_zipcode . shipping_country', $address);
            } else {
                $query->where('shipping_address . shipping_city . shipping_state . shipping_zipcode . shipping_country', $address);
            }
        }

        if ($request->has('created_by')) {
            $date = $request->input('created_by');
            if (is_array($date)) {
                $query->whereIn('created_by', $date);
            } else {
                $query->where('created_by', $date);
            }
        }

        if (Auth::user()->role === 'Admin') {
            $orders = Order::all();
            $allorders = Order::count();
            $allparcels = OrderDetail::count();
            $data = Order::orderBy('id', 'desc')->get();
        } else {
            $orders = Order::all();
            $allorders = Order::count();
            $allparcels = OrderDetail::where('p_vendor_id', Auth::user()->id)->count();
            $data = Order::with(['orderDetails' => function ($query) {
                $query->where('p_vendor_id', Auth::user()->id);
            }])
            ->whereHas('orderDetails', function ($query) {
                $query->where('p_vendor_id', Auth::user()->id);
            })
            ->orderBy('id', 'desc')
            ->get();
        }

        return view('orders.allorders', compact('data', 'orders','allorders','allparcels'));
    }


    public function OrderDetailIndex()
    {
        if (Auth::User()->role == 'Admin') {
            $data = OrderDetail::with('order', 'product', 'vendor','order_tracker')->OrderBy('id', 'desc')
                ->get();
        } else {
            $data = OrderDetail::with('order', 'product', 'vendor','order_tracker')->where('p_vendor_id', Auth::User()->id)
                ->OrderBy('id', 'desc')
                ->get();
        }
        // $data = Order::orderBy('id', 'desc')->get();
        // dd($data);
        // return response()->json([$data]);
        return view('orders.order_details', compact('data'));
    }


    public function order_details_status(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            // 'order_id' => 'required',
            'status' => 'required' ,
            // 'id' => 'required',
        ], [
            'status.required' => 'The status field is required',
        ]);

        $order_status = OrderDetail::where('id', $request->id)->first();

        if ($order_status->status != $request->status) {
            $order_status->status = $request->status;
            $order_status->update();

            $order_tracker = new OrderTracker;
            $order_tracker->order_id = $request->id;
            $order_tracker->status = $request->status;
            $order_tracker->datetime = Carbon::now();
            $order_tracker->save();
        }else
        {
            return redirect()->back()->with(Toastr::error('error','This status field is already Updated'));
        }



        return redirect()->back()->with(Toastr::success('Status Updated Successfully!'));
    }
    public function GetOrderDetailStatus($id){
        $status = OrderTracker::where('order_id',$id)->orderBy('datetime', 'asc')->get();
        return view('orders.getOrderDetailStatus', compact('status'));
    }


    public function showOrders()
    {
if (Auth::user()->role == 'Vendor') {
    $routeName = Route::currentRouteName();

        if ($routeName === 'pendingorders') {
            $data = OrderDetail::with('order', 'product', 'vendor')->where('p_vendor_id', Auth::User()->id)
                ->where('status', '=', 'In Process')->orderBy('id', 'desc')->get();
            return view('orders.pendingorders', compact('data'));
        }
        if ($routeName === 'confirmedorders') {
            $data = OrderDetail::with('order', 'product', 'vendor')->where('p_vendor_id', Auth::User()->id)
                ->where('status', '=', 'Confirmed')->orderBy('id', 'desc')->get();
            return view('orders.confirmedorders', compact('data'));
        }
        if ($routeName === 'packagingorders') {
            $data = OrderDetail::with('order', 'product', 'vendor')->where('p_vendor_id', Auth::User()->id)
                ->where('status', '=', 'Packaging')->orderBy('id', 'desc')->get();
            return view('orders.packagingorders', compact('data'));
        }
        if ($routeName === 'outofdelivery') {
            $data = OrderDetail::with('order', 'product', 'vendor')->where('p_vendor_id', Auth::User()->id)
                ->where('status', '=', 'Out of delivery')->orderBy('id', 'desc')->get();
            return view('orders.outofdelivery', compact('data'));
        }
        if ($routeName === 'delivered') {
            $data = OrderDetail::with('order', 'product', 'vendor')->where('p_vendor_id', Auth::User()->id)
                ->where('status', '=', 'Delivered')->orderBy('id', 'desc')->get();
            return view('orders.delivered', compact('data'));
        }
        if ($routeName === 'returned') {
            $data = OrderDetail::with('order', 'product', 'vendor')->where('p_vendor_id', Auth::User()->id)
                ->where('status', '=', 'Returned')->orderBy('id', 'desc')->get();
            return view('orders.returned', compact('data'));
        }
        if ($routeName === 'ftod') {
            $data = OrderDetail::with('order', 'product', 'vendor')->where('p_vendor_id', Auth::User()->id)
                ->where('status', '=', 'Failed to Deliver')->orderBy('id', 'desc')->get();
            return view('orders.ftod', compact('data'));
        }
        if ($routeName === 'canceled') {
            $data = OrderDetail::with('order', 'product', 'vendor')->where('p_vendor_id', Auth::User()->id)
                ->where('status', '=', 'Canceled')->orderBy('id', 'desc')->get();
            return view('orders.canceled', compact('data'));
        }
        if ($routeName === 'customer_canceled') {
            $data = OrderDetail::with('order', 'product', 'vendor')->where('p_vendor_id', Auth::User()->id)
                ->where('customer_cancel_status', '=', 'Canceled')->orderBy('id', 'desc')->get();
            return view('orders.canceled', compact('data'));
        }
    } elseif (Auth::user()->role == 'Admin') {
        $routeName = Route::currentRouteName();
        if ($routeName === 'pendingorders') {
            $data = OrderDetail::with('order', 'product', 'vendor')
                ->where('status', '=', 'In Process')->orderBy('id', 'desc')->get();
            return view('orders.pendingorders', compact('data'));
        }
        if ($routeName === 'confirmedorders') {
            $data = OrderDetail::with('order', 'product', 'vendor')
                ->where('status', '=', 'Confirmed')->orderBy('id', 'desc')->get();
            return view('orders.confirmedorders', compact('data'));
        }
        if ($routeName === 'packagingorders') {
            $data = OrderDetail::with('order', 'product', 'vendor')
                ->where('status', '=', 'Packaging')->orderBy('id', 'desc')->get();
            return view('orders.packagingorders', compact('data'));
        }
        if ($routeName === 'outofdelivery') {
            $data = OrderDetail::with('order', 'product', 'vendor')
                ->where('status', '=', 'Out of delivery')->orderBy('id', 'desc')->get();
            return view('orders.outofdelivery', compact('data'));
        }
        if ($routeName === 'delivered') {
            $data = OrderDetail::with('order', 'product', 'vendor')
                ->where('status', '=', 'Delivered')->orderBy('id', 'desc')->get();
            return view('orders.delivered', compact('data'));
        }
        if ($routeName === 'returned') {
            $data = OrderDetail::with('order', 'product', 'vendor')
                ->where('status', '=', 'Returned')->orderBy('id', 'desc')->get();
            return view('orders.returned', compact('data'));
        }
        if ($routeName === 'ftod') {
            $data = OrderDetail::with('order', 'product', 'vendor')
                ->where('status', '=', 'Failed to Deliver')->orderBy('id', 'desc')->get();
            return view('orders.ftod', compact('data'));
        }
        if ($routeName === 'canceled') {
            $data = OrderDetail::with('order', 'product', 'vendor')
                ->where('status', '=', 'Canceled')->orderBy('id', 'desc')->get();
            return view('orders.canceled', compact('data'));
        }
        if ($routeName === 'customer_canceled') {
            $data = OrderDetail::with('order', 'product', 'vendor')
                ->where('customer_cancel_status', '=', 'Canceled')->orderBy('id', 'desc')->get();
            return view('orders.customer_canceled', compact('data'));
        }
    }

    }

    public function GetOrderDetail($id){
        // dd($id);
        if(Auth::user()->role == 'Vendor')
        $GetOrderDetails = OrderDetail::with('order', 'product', 'vendor')->where('p_vendor_id' , Auth::user()->id)->where('order_id' ,'=', $id)->get();
        else{
        $GetOrderDetails = OrderDetail::with('order', 'product', 'vendor')->where('order_id' ,'=', $id) ->get();

        }
        return view('orders.getOrderDetails',compact('GetOrderDetails'));
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


    public function orderInvoice($id){

        if(Auth::user()->role == 'Vendor'){
        $invoice = OrderDetail::with('order', 'product','vendorProfile', 'vendor','order_tracker')->where('p_vendor_id' , Auth::user()->id)->where('order_id' ,'=', $id)->first();
        $invoiceProduct = OrderDetail::with('order', 'product','vendorProfile', 'vendor','order_tracker')->where('p_vendor_id' , Auth::user()->id)->where('order_id' ,'=', $id)->get();
        return view('orders.invoice', compact('invoice','invoiceProduct'));
        }
        elseif(Auth::user()->role == 'Admin')
        {
            $invoice = OrderDetail::with('order', 'product','vendorProfile', 'vendor','order_tracker')->where('order_id' ,'=', $id)->first();
        $invoiceProduct = OrderDetail::with('order', 'product','vendorProfile', 'vendor','order_tracker')->where('order_id' ,'=', $id)->get();
        return view('orders.invoice', compact('invoice','invoiceProduct'));
        }else{
            return "Unauthorized";
        }

    }

    public function show($id)
    {
        $order = Order::with(['order_details' => function ($query) {
            $query->with('products')->with('product_image')->with('vendor')->with('user');
        }])->where('id', '=', $id)->first();

        $cus = $order->order_details[0]->vendor;

        // $vendor = OrderDetails::where('customer_id',$cus->id,)->get();

        return view('orders.details', compact('order', 'cus'));


        // 	$order = Order::with(['order_details' => function ($query) {
        // 	$query->with('products')->with('product_image');
        // }])->where('id', '=', $id)->first();

        // return view('order.details', compact('order'));
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

    public function destroy($id)
    {
        //
    }
}
