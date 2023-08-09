<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Http\Input;
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

class FormanController extends Controller
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
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $code = Purchase::where('status', '=', 'ISSUE')->latest()->first();;
        if(isset($code) > 0){
        $codes = (int)$code->bill_no + 1;
    }
        else{
            $codes = 1;
        }

       $p = Product::select(DB::raw('CONCAT(`id`, "_", `name`, "_", `price`, "_", `code`) AS `id`, `name`'))->OrderBy('id', 'asc')->pluck('name', 'id')->prepend('Select Product', '0')->toArray();
       $uom = UOM::select(DB::raw('CONCAT(`id`, "_", `uom`) AS `id`, `uom`'))->OrderBy('id', 'asc')->pluck('uom', 'id')->toArray();
        $carat = Carat::select(DB::raw('CONCAT(`id`, "_", `name`) AS `id`, `name`'))->OrderBy('id', 'asc')->pluck('name', 'id')->toArray();

//return $c;
      //  $p = Product::OrderBy('name')->pluck('name','id');
       $c = Account::with('accounts')->OrderBy('account_name')->pluck('account_name','id');
       // $uom = UOM::OrderBy('uom')->pluck('uom','id');
        return view('forman.create', compact('p', 'c', 'uom', 'codes', 'carat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
public function store(Request $request)
    {
        //return $request;
        $check = Purchase::where('bill_no', '=', $request->bill_no)->where('status', '=', 'ISSUE')->get();
       //return $check;
        //foreach($check as $data){
            if(count($check) > 0){
                //return "update";
               PurchaseDetail::where('purchase_id', '=', $check[0]->id)->delete();
              
               $quotation = Purchase::findOrFail($check[0]->id);
              // return  $quotation;
               
               $quotation->update($request->all());
              ///  return $quotation;
                 $count = Count($request->produc_id);
                // return $count;
                for($i=0; $i<$count; $i++)
                {
                     $detail = new PurchaseDetail();
                     $detail->purchase_id = $quotation['id'];
                     $detail->produc_id = $request->produc_id[$i];
                     $detail->unit_id = $request->unit_id[$i];
                     $detail->carat_id = $request->carat_id[$i];
                     $detail->quantity_out = $request->quantity_out[$i];
                     $detail->cost = $request->cost[$i];
                     $detail->total = $request->total[$i];
                     $detail->save();
                
                }
              
               
            }
            else{
                //return $request;

                $quotation = Purchase::create($request->all());

                $count = Count($request->produc_id);
                //return $count;
                for($i=0; $i<$count; $i++)
                {
                     $detail = new PurchaseDetail();
                     $detail->purchase_id = $quotation['id'];
                     $detail->produc_id = $request->produc_id[$i];
                     $detail->unit_id = $request->unit_id[$i];
                     $detail->carat_id = $request->carat_id[$i];
                     $detail->quantity_out = $request->quantity_out[$i];
                     $detail->cost = $request->cost[$i];
                     $detail->total = $request->total[$i];
                     $detail->save();
                }
            }
        //}
         //return $request->all();

     

        Session::flash('flash_message', 'Record successfully added!');
        return redirect('forman/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $details = Purchase::with('users')->with('accounts')->with(['purchase_details' => function($query){
            $query->with('prodcts');
            $query->with('uoms');
            $query->with('carats');
        }])
        ->where('id', '=', $id)
        ->where('status', '=', 'ISSUE')
        ->get();
      //  return $details;
         return view('forman.show-forman-details', compact('details'));
    }

    public function destroy($id)
    {
        //return $id;
        
        PurchaseDetail::where('purchase_id', '=', $id)->delete();
        $purchase = Purchase::findOrFail($id);
        $purchase->delete();
        Session::flash('flash_message', 'Record Deleted Successfully!');
        return redirect('forman/create');
    }

public function ProductKeyUp(Request $request)
    {
        $productID = $request->get('product_ID');
         $productsArray = Purchase::where('id', '=', 'bill_no')->get();
        return $productsArray;
    }
    
public function showbill(Request $request)
    {
     $bill = $request->get('bill_no'); 
   // return $bill;
      $p = Purchase::with('purchase_details')->with(['purchase_details' => function($query){
           $query->with('prodcts');
           $query->with('uoms');
            $query->with('carats');
          
       }])
       ->where('bill_no', '=', $bill)
       ->where('status', '=', 'ISSUE')
       ->get();

 //   return $details;
    return $p; 
    }

}
