<?php

namespace App\Http\Controllers;

use App\Models\Locations;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\OrderTracker;
use Illuminate\Support\Facades\Auth;
use Cart;
use App\Models\Stock;

class ShopController extends Controller
{
    public function CheckOut()
    {
        if (Auth::User()) {
            if (Cart::getContent()->count() > 0) {
                $countriesList = Locations::orderBy('name')->pluck('name', 'id');
                return view('website.checkout', compact('countriesList'));
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    public function OrderSubmit(Request $request)
    {
        if (Auth::User()->id == null) {
            return redirect('/login');
        }
        if (Cart::getContent()->count() == 0) {
            abort(404);
        }

        if ($request->isMethod('post')) {
            $order = Order::create($request->all());
            $order->date = date('Y-m-d');
            $order->status = 'In Process';
            $order->payment_method = 'CASH IN HAND';
            $order->shipping = date('Y-m-d', strtotime(date('Y-m-d') . ' + 7 day'));
            $order->customer_id = Auth::User()->id;
            $order->save();


            $code = Stock::where('type', '=',  'ORDER')->orderBy('bill_no', 'desc')->first();
            if (isset($code) > 0) {
                $codes = (int)$code->bill_no + 1;
            } else {
                $codes = 1;
            }

            $cart = Cart::getContent();
            foreach ($cart as $value) {
                $orderDetails = new OrderDetails();
                $orderDetails->order_id = $order->id;
                $orderDetails->product_id = $value->id;
                $orderDetails->product_name = $value->name;
                $orderDetails->slug = $value->attributes->slug;
                $orderDetails->customer_id = Auth::User()->id;
                $orderDetails->quantity = $value->quantity;
                $orderDetails->price = $value->attributes->amount_new;
                $orderDetails->total = $value->attributes->amount_new * $value->quantity;
                $orderDetails->image = $value->attributes->image;
                $orderDetails->color = $value->attributes->color;
                $orderDetails->amount_old = $value->attributes->amount_old;
                $orderDetails->amount_new = $value->attributes->amount_new;
                $orderDetails->conditionType = $value->attributes->conditionType;
                $orderDetails->ship_charges = $value->attributes->ship_charges;
                $orderDetails->locatedin = $value->attributes->locatedin;
                $orderDetails->imp_charges = $value->attributes->imp_charges;
                $orderDetails->t_charges = $value->attributes->t_charges;
                $orderDetails->oth_charges = $value->attributes->oth_charges;
                $orderDetails->ship_days = $value->attributes->ship_days;
                $orderDetails->brand_id = $value->attributes->brand_id;
                $orderDetails->brand_logo = $value->attributes->brand_logo;
                $orderDetails->vendor_id = $value->attributes->vendor_id;
                $orderDetails->save();

                $stock = new Stock();
                $stock->date = date('Y-m-d');
                $stock->bill_no = $codes;
                $stock->pro_id = $value->id;
                $stock->unit_id = 2;
                $stock->cost = $value->attributes->amount_new;
                $stock->total = $value->attributes->amount_new * $value->quantity;
                $stock->type = 'SALE';
                $stock->qty_out = $value->quantity;
                $stock->biller_id = $value->attributes->vendor_id;
                $stock->save();
            }

            $orderTracker = new OrderTracker();
            $orderTracker->order_id = $order->id;
            $orderTracker->datetime = date('Y-m-d h:i:s');
            $orderTracker->status = 'In Process';
            $orderTracker->country = 'Pakistan';
            $orderTracker->icon = 'fa fa-certificate';
            $orderTracker->save();


            Cart::clear();
            return redirect('thankyou/' . $order->id);
        } else {
            abort(404);
        }
    }

    public function thanks($id)
    {
        if (!Auth::User()) {
            return redirect('/login');
        }

        $order = Order::findOrFail($id);
        if ($order) {
            $order = Order::findOrFail($id);
            $orderDetails = OrderDetails::with('products')->where('order_id', $id)->get();
            return view('website.thanks', compact('order', 'orderDetails'));
        } else {
            abort(404);
        }
    }
}
