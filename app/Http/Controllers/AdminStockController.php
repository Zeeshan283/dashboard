<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Category;
use App\Models\Account;
use App\Models\UOM;
use App\Models\PurchaseDetail;
use App\Models\User;
use App\Models\Carat;
use App\Models\Product;

use Auth;
use Session;
use DB;
class AdminStockController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $code = Purchase::latest()->first();
     //  return  $code;
        if(isset($code) > 0){
        $codes = (int)$code->bill_no + 1;
        //return "u";
    }
        else{
            $codes = 1;
            //return "b";
        }

       $p = Product::OrderBy('id', 'asc')->pluck('name', 'id')->prepend('All Products', '0')->toArray();
//return $c;
      //  $p = Product::OrderBy('name')->pluck('name','id');
      
       // $uom = UOM::OrderBy('uom')->pluck('uom','id');
        return view('admin-stock.create', compact('p'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fromDate = $request->get('from_date');
        $toDate = $request->get('to_date');
        $producID = $request->get('produc_id');
        if($producID == "0"){
            $purchase = Purchase::with('accounts')->whereDate('created_at', '>=', $fromDate)
    ->whereDate('created_at', '<=', $toDate)
    ->get();
 //   $c = Account::with('accounts')->OrderBy('account_name')->pluck('account_name','id');
  // return $purchase;
    return view('admin-stock.report', compact('fromDate', 'toDate', 'purchase'));

        }else{
             $purchase = PurchaseDetail::where('produc_id', '=', $producID)
        ->whereDate('created_at', '>=', $fromDate)
    ->whereDate('created_at', '<=', $toDate)
    ->get();

    return view('admin-stock.report', compact('fromDate', 'toDate', 'purchase'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      //  return view('admin-stock.report');
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
