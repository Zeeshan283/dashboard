<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\AdvertisementOrder;
use App\Models\Advertisement;


class StripePaymentController extends Controller
{
    
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe(Request $request)
    {
        $customer_id = $request->customer_id;
        $product_id = $request->product_id;
        $bill  = $request->bill;
        $name = $request->name;
        $phone =  $request->phone;
        $image =  $request->image;

        return view('advertisementOrder.stripe', compact('customer_id', 'product_id', 'bill', 'name', 'phone', 'image'));
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        // Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        // Stripe\Charge::create([
        //     "amount" => $request->bill * 100,
        //     "currency" => "pkr",
        //     "source" => $request->stripeToken,
        //     "description" => "payment successfully.",
        // ]);

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        // dd($request->all());
        // Convert the amount to paisa (multiply by 100)
        $amount = $request->bill * 100;

        Stripe\Charge::create([
            "amount" => $amount,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Payment successfully.",
        ]);
        $data = new AdvertisementOrder();
        $data->customer_id = $request->customer_id;
        $data->product_id = $request->product_id;
        $data->bill = $request->bill;
        $data->status = 'paid';
        $data->name = $request->name;
        $data->phone = $request->phone;

        $data->save();


        $product = Advertisement::find($request->product_id);

        if ($product) {
            // Check if the product quantity is greater than zero before decrementing
            if ($product->quantity > 0) {
                $product->quantity -= 1; // You can modify this based on your needs
                $product->save();
            }
        }

        Session::flash('success', 'Payment successful!');
        Toastr::success('Payment successful!', 'Success');
        return back();
    }
}
