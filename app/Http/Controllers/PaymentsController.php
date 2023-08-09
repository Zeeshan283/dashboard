<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe;
use Stripe\Charge;
use Cart;

class PaymentsController extends Controller
{
    public function stripePost(Request $request)
    {
        // return $request->all();
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $data = Charge::create ([
                "amount" => $request->amount * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "This payment is tested purpose phpcodingstuff.com"
        ]);

        if($data->status=="succeeded")
        {

            Session::flash('success', 'Payment successful!');
            return redirect('');
        }else{
            Session::flash('failure', 'Payment Not Send!');
        }
        
        return back();
    }
}
