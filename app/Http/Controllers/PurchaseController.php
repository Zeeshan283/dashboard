<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Stock;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $data = Stock::where('biller_id', Auth::User()->id)
        //     ->select('id', 'date', 'bill_no')
        //     ->where('type', 'PURCHASE')
        //     ->orderBy('bill_no', 'desc')
        //     ->groupBy('bill_no')
        //     ->distinct()
        //     ->get();

        return view('purchase.index' );
    }

    public function create()
    {
        $user = auth()->user();
        $products = Product::where('created_by', '=', $user->id)->get();
        
        return view('purchase.addpurchase', compact('products'));
    }

    public function store(Request $request)
    {
         // dd($request->all());
        $product = Product::where('sku', $request->product_sku)->first();

        // Validate the form input
        $request->validate([
            'date' => 'required|date',
            'bill_number' => 'required|numeric',
            'product_sku' => 'required',
            'selected_product_model' => 'required',
            'quantity' => 'required|integer',
            'selected_product_price' => 'required|numeric',
            'total_value' => 'required|numeric',
        ]);

        // Create a new Purchase instance and fill it with form data
        $purchase = new Purchase();
        $purchase->date = $request->date;
        $purchase->bill_number = $request->bill_number;
        $purchase->user_id = auth()->user()->id; // Assuming you're using Laravel's built-in authentication
        $purchase->product_id = $product->id; // Use the product_id from the retrieved product
        $purchase->selected_product_model = $request->selected_product_model;
        $purchase->quantity = $request->quantity;
        $purchase->selected_product_price = $request->selected_product_price;
        $purchase->total_value = $request->total_value;

       
        // Save the purchase record
        $purchase->save();

        Toastr::success('Purchase Added successfully', 'Success');

        return redirect()->back();
    }

    
    public function show($id)
    {
        $details = Stock::with('product')
            ->with('uoms')
            ->with('user')
            ->where('bill_no', $id)
            ->where('type', 'PURCHASE')
            ->get();

        return view('purchase.show', compact('details'));
    }

    public function destroy($id)
    {
        Stock::where('bill_no', $id)->where('type', 'PURCHASE')->delete();
        return redirect()->back()->with(Toastr::success('Purchase Deleted Successfully!'));
    }

    public function ProductKeyUp(Request $request)
    {
        $productID = $request->get('product_ID');
        $productsArray = Product::where('id', '=', 'bill_no')->get();
        return $productsArray;
    }


    public function getProductName($sku)
    {
        // dd($sku);
        $product = Product::where('sku',$sku)->first();

        if ($product) {
            return response()->json([
                'productName' => $product->name,
                'productPrice' => $product->new_sale_price,
                'productModel' => $product->model_no,
            ]);
        } else {
            return response()->json([
                'productName' => '',
                'productPrice' => '',
                'productModel' => '',
            ]);
        }
        
    }

}
