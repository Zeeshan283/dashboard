<?php

namespace App\Http\Controllers;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseHistory;
use App\Models\Supplier;
use App\Models\User;
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
        $user = Auth::user();
        $purchases = Purchase::where('user_id','=',$user->id)->get();
        return view('purchase.all', compact('purchases') );
    }

    public function create()
    {
        $user = auth()->user();
        $suppliers = Supplier::where('added_by', Auth::user()->id)->orderBy('id', 'asc')->get();
        $products = Product::where('created_by', '=', $user->id)->get();
        
        return view('purchase.addpurchase', compact('products','suppliers'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        foreach ($request->record as $purchase) {
            // Validate the form input
            // $validator = Validator::make($purchase, [
            //     'date' => 'required|date',
            //     'bill_number' => 'required|numeric',
            //     'product_sku' => 'required',
            //     'selected_product_model' => 'required',
            //     'quantity' => 'required|integer',
            //     'selected_product_price' => 'required|numeric',
            //     'total_value' => 'required|numeric',
            // ]);

            // if ($validator->fails()) {
            //     // Handle validation errors
            //     return redirect()->back()->withErrors($validator)->withInput();
            // }

            // Find the product by SKU
            $product = Product::where('sku', $purchase['product_sku'])->first();

            // Check if the product exists
            if ($product) {
                // Check if a purchase with the same product SKU and user ID exists
                $existingPurchase = Purchase::where('product_id', $product->id)
                    ->where('user_id', auth()->user()->id)
                    ->first();

                if ($existingPurchase) {
                    $new_quantity = $purchase['quantity'] + $existingPurchase->quantity;

                    // Update the existing purchase record
                    $existingPurchase->update([
                        'date' => $purchase['date'],
                        'bill_number' => $purchase['bill_number'],
                        'selected_product_model' => $purchase['selected_product_model'],
                        'quantity' => $new_quantity,
                        'selected_product_price' => $purchase['selected_product_price'],
                        'total_value' => $purchase['total_value'],
                    ]);



                    DB::table('purchase_history')->insert([
                        'purchase_id' => $existingPurchase->id,
                        'date' => $existingPurchase->date,
                        'bill_number' => $existingPurchase->bill_number,
                        'supplier' => $existingPurchase->supplier, 
                        'product_model' => $existingPurchase->selected_product_model,
                        'product_name' => $product->name,
                        'product_sku' => $product->sku,
                        'user_id'=> auth()->user()->id,
                        'product_id' => $product->id, 
                        'quantity' => $purchase['quantity'],
                        'cost' => $existingPurchase->selected_product_price,
                        'total' => $existingPurchase->total_value ,
                    ]);


                    Toastr::success('Purchase Updated successfully', 'Success');
                } else {
                    // Create a new purchase instance
                    $newPurchase = new Purchase();
                    $newPurchase->date = $purchase['date'];
                    $newPurchase->bill_number = $purchase['bill_number'];
                    $newPurchase->supplier = $purchase['supplier'];
                    $newPurchase->user_id = auth()->user()->id;
                    $newPurchase->product_id = $product->id;
                    $newPurchase->selected_product_model = $purchase['selected_product_model'];
                    $newPurchase->quantity = $purchase['quantity'];
                    $newPurchase->selected_product_price = $purchase['selected_product_price'];
                    $newPurchase->total_value = $newPurchase->quantity * $newPurchase->selected_product_price;

                    // Save the new purchase record
                    $newPurchase->save();

                    
                    DB::table('purchase_history')->insert([
                        'purchase_id' => $newPurchase->id,
                        'date' => $newPurchase->date,
                        'bill_number' => $newPurchase->bill_number,
                        'supplier' => $newPurchase->supplier,
                        'user_id'=> auth()->user()->id,
                        'product_id' => $newPurchase->product_id,
                        'product_name' => $product->name,
                        'product_model' => $newPurchase->selected_product_model,
                        'product_sku' => $product->sku,
                        'quantity' => $newPurchase->quantity,
                        'cost' => $newPurchase->selected_product_price,
                        'total' => $newPurchase->total_value,
                    ]);
                    

                    Toastr::success('Purchase Added successfully', 'Success');
                }
            } else {
                // Handle the case where the product with the given SKU doesn't exist
                Toastr::error('Product with SKU ' . $purchase['product_sku'] . ' not found', 'Error');
            }
        }

        return redirect('purchase');
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();
        // dd($request->all());
        $purchase = Purchase::findOrFail($id);

        // Update the purchase record with the form input
        $purchase->update([
            'date' => $request->input('date'),
            'bill_number' => $request->input('bill_number'),
            'supplier' => $request->input('supplier'),
            // 'selected_product_name' => $request->input('selected_product_name'),
            'selected_product_model' => $request->input('selected_product_model'),
            'quantity' => $request->input('quantity'),
            'selected_product_price' => $request->input('selected_product_price'),
            'total_value' => $request->input('total_value'),
        ]);

        // dd($purchase->id);


        DB::table('purchase_history')->insert([
            'purchase_id' => $purchase->id,
            'date' => $purchase->date,
            'bill_number' => $purchase->bill_number,
            'supplier' => $purchase->supplier,
            'user_id'=> auth()->user()->id,
            'product_id' => $purchase->product_id,
            // 'product_model' => $newPurchase->selected_product_model,
            // 'product_sku' => $newPurchase->selected_product_sku,
            'quantity' => $purchase->quantity,
            'cost' => $purchase->selected_product_price,
            'total' => $purchase->total_value,
        ]);
        

        // Redirect back with a success message
        Toastr::success('Purchase Updated successfully', 'Success');

        return redirect()->route('purchase.index');
    }


    
    public function edit($id)
    {
        // dd($id);
        $purchases = Purchase::find($id);
        $user = auth()->user();
        $products = Product::where('created_by', '=', $user->id)->get();

        // dd($purchases);
        return view('purchase.edit', compact('purchases', 'products'));
    }

    public function destroy($id)
    {
        $purchase = Purchase::find($id);
        PurchaseHistory::where('purchase_id', $id)->delete();
        // Stock::where('bill_no', $id)->where('type', 'PURCHASE')->delete();
        Purchase::where('id', $id)->delete();
        // return redirect()->back()->with(Toastr::success('Purchase Deleted Successfully!'));

        Toastr::success('Purchase Deleted successfully', 'Success');

        return redirect()->back();
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

   

    public function show()
    {
        $user = auth()->user();
        
        // Use Eloquent to fetch records
        $histories = PurchaseHistory::where('user_id', $user->id)->get();

        return view('purchase.history', compact('histories'));
    }
    
    public function invoice($purchaseId)
    {
        $user = auth()->user();

        // Retrieve the purchase information based on $purchaseId
        $purchase = Purchase::find($purchaseId);

        // Retrieve associated PurchaseHistory records for the purchase
        $purchaseHistory = PurchaseHistory::where('purchase_id', $purchaseId)->get();

        // Calculate totals
        $total_cost = 0;
        $total_quantity = 0;

        foreach ($purchaseHistory as $invoice) {
            $total_quantity += $invoice->quantity;
            $total_cost += $invoice->total;
            $purchae_id = $invoice->purchase_id;
        }

        $currentDate = Carbon::now();
        $formattedDate = $currentDate->format('Y-m-d');

        return view('purchase.invoice', compact('purchaseHistory', 'total_cost', 'total_quantity', 'purchae_id', 'formattedDate'));
    }

    public function bill($purchaseId)
    {
        $user = auth()->user();

        // Retrieve the purchase information based on $purchaseId
        $purchase = Purchase::find($purchaseId);

        // Retrieve associated PurchaseHistory records for the purchase
        $purchaseHistory = PurchaseHistory::where('bill_number', $purchaseId)->get();
        


        // Calculate totals
        $total_cost = 0;
        $total_quantity = 0;

        foreach ($purchaseHistory as $invoice) {
            $total_quantity += $invoice->quantity;
            $total_cost += $invoice->total;
            $purchae_id = $invoice->purchase_id;
            $bill_num = $invoice->bill_number;
            $suppliers = $invoice->supplier;
            $user= $invoice->user_id;
        }

        $bill_to = User::where('id',$user)->get();

        $bill_from = Supplier::where('id',$suppliers)->get();

        // dd($bill_from);

        $currentDate = Carbon::now();
        $formattedDate = $currentDate->format('Y-m-d');

        return view('purchase.invoice', compact('purchaseHistory', 'total_cost', 'total_quantity', 'purchae_id','bill_from','bill_to' ,'bill_num', 'formattedDate'));
    }

    
    
}



