<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Account;

class PurchaseReportController extends Controller
{
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
        $c = Account::with('accounts')->OrderBy('account_name')->pluck('account_name','id');
       // $purchase = Purchase::with('accounts')->pluck('account_name','id');
        return view('purchase-report.reportcreate', compact('c'));
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
        $SupplierID = $request->get('supplier_id');
        if($SupplierID == "0"){
            $purchase = Purchase::whereDate('date', '>=', $fromDate)
    ->whereDate('date', '<=', $toDate)
    ->get();
  //  $c = Account::with('accounts')->OrderBy('account_name')->pluck('account_name','id');
  // return $purchase;
    return view('purchase-report.purchase-report-show', compact('fromDate', 'toDate', 'purchase'));

        }else{
             $purchase = Purchase::where('supplier_id', '=', $SupplierID)
        ->whereDate('date', '>=', $fromDate)
    ->whereDate('date', '<=', $toDate)
    ->get();

    return view('purchase-report.purchase-report-show', compact('fromDate', 'toDate', 'purchase'));
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
