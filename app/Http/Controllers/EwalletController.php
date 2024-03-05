<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EwalletController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function collectedcash()
    {
        return view('ewallet.collectedcash');
    }
    public function Totalbuying()
    {
        return view('ewallet.Totalbuying');
    }
    public function totalpendingwithdrawls()
    {
        return view('ewallet.totalpendingwithdrawls');
    }
    public function totalrefund()
    {
        return view('ewallet.totalrefund');
    }
    public function totalspendondeals()
    {
        return view('ewallet.totalspendondeals');
    }
    public function totalwithdrawl()
    {
        return view('ewallet.totalwithdrawl');
    }
    public function transcationhistory()
    {
        return view('ewallet.transcationhistory');
    }

    public function paymentmethod()
    {
        return view('ewallet.paymentmethod');
    }
}
