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

class OrderController extends Controller
{
	use fontAwesomeTrait;
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$data = Order::orderBy('id', 'desc')->get();
		return view('order.index', compact('data'));
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

		return view('order.order_report', compact('fromDate', 'toDate', 'order'));
	}

	public function show($id)
	{
		 $order = Order::with(['order_details' => function ($query) {
			$query->with('products')->with('product_image')->with('vendor');
		}])->where('id', '=', $id)->first();
		
		$cus= $order->order_details[0]->vendor;
		
		// $vendor = OrderDetails::where('customer_id',$cus->id,)->get();

		return view('order.details', compact('order','cus'));
	
	
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

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'order_id' => 'required',
			'updatedby' => 'required',
			'datetime' => 'required',
			'status1' => 'required',
			// 'direction' => 'required',
			'icon' => 'required'
		], [
			'status1.required' => 'The status field is required'
		]);
		$totalTrackOrder = OrderTracker::where('order_id', $id)->count();
		if ($totalTrackOrder > 5) {
			return redirect()->back()->with(Toastr::error('Sorry! 6 Steps are completed'));
		} else {
			$findSameOrderTracker = OrderTracker::where('order_id', $id)->where('status', $request->status1)->count();
			if ($findSameOrderTracker > 0) {
				return redirect()->back()->with(Toastr::error('Sorry! Status Already Exist!!!'));
			} else {
				$update = Order::findOrFail($id);
				if ($update) {
					$update->status = $request->status1;
					$update->save();

					$orderTracker = OrderTracker::create($request->all());
					$orderTracker->status = $request->status1;
					$orderTracker->save();

					if (Auth::User()->role == 'Vendor') {
						return redirect('/vendor-orders')->with(Toastr::success('Status Updated Successfully!'));
					}

					return redirect('/orders')->with(Toastr::success('Status Updated Successfully!'));
				} else {
					return redirect()->back()->with(Toastr::error('Something went wrong!!!'));
				}
			}
		}
	}

	public function VendorOrders()
	{
		$data = OrderDetails::with('order')->where('vendor_id', Auth::User()->id)->get();
		return view('order.vendor-index', compact('data'));
	}

	public function VendorOrderReceipt($id)
	{
		$order_detail = OrderDetails::with('products')->with('product_image')->find($id);
		$order = Order::findOrFail($order_detail->order_id);

		return view('order.vendor_order_report', compact('order', 'order_detail'));
	}

	public function destroy($id)
	{
		//
	}
}
