<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Account;
use App\Models\UOM;
use App\Models\Carat;
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
        $data = Stock::where('biller_id', Auth::User()->id)
            ->select('id', 'date', 'bill_no')
            ->where('type', 'PURCHASE')
            ->orderBy('bill_no', 'desc')
            ->groupBy('bill_no')
            ->distinct()
            ->get();

        return view('purchase.index', compact('data'));
    }

    public function create()
    {
        $code = Stock::where('biller_id', Auth::User()->id)
            ->where('type', '=',  'PURCHASE')
            ->orderBy('bill_no', 'desc')
            ->first();

        if (isset($code) > 0) {
            $codes = (int)$code->bill_no + 1;
        } else {
            $codes = 1;
        }

        $p = Product::select(DB::raw('CONCAT(`id`, "_", `name`, "_", `new_sale_price`, "_", `sku`) AS `id`, `name`, `sku`'))->where('created_by', Auth::User()->id)->OrderBy('id', 'asc')->pluck('sku', 'id')->prepend('Select SKU', '')->toArray();
        $uom = UOM::select(DB::raw('CONCAT(`id`, "_", `uom`) AS `id`, `uom`'))->OrderBy('id', 'asc')->pluck('uom', 'id')->toArray();
        $carat = Carat::select(DB::raw('CONCAT(`id`, "_", `name`) AS `id`, `name`'))->OrderBy('id', 'asc')->pluck('name', 'id')->toArray();

        $c = Account::with('accounts')->OrderBy('account_name')->pluck('account_name', 'id');
        return view('purchase.create', compact('p', 'c', 'uom', 'codes', 'carat'));
    }

    public function store(Request $request)
    {
        if (!isset($request->product_id)) {
            return redirect()->back()->with('failure_message', 'Enter 1 Record Must');
        }
        if (!isset($request->bill_no)) {
            return redirect()->back()->with('failure_message', 'Enter Bill No Must');
        }

        $check = Stock::where('bill_no', '=', $request->bill_no)->where('type', '=', 'PURCHASE')->get();

        if (count($check) > 0) {
            Stock::where('bill_no', '=', $request->bill_no)->where('type', 'PURCHASE')->delete();

            $count = count($request->product_id);
            for ($i = 0; $i < $count; $i++) {
                $stock = new Stock();
                $stock->bill_no = $request->bill_no;
                $stock->date = $request->date;
                $stock->pro_id = $request->product_id[$i];
                $stock->unit_id = 2;
                $stock->cost = $request->cost[$i];
                $stock->total = $request->cost[$i] * $request->quantity[$i];
                $stock->type = $request->type;
                $stock->qty_in = $request->quantity[$i];
                $stock->qty_out = 0;
                $stock->biller_id = Auth::User()->id;
                $stock->save();
            }
        } else {
            if (!isset($request->product_id)) {
                return redirect()->back()->with('failure_message', 'Enter 1 Record Must');
            }
            if (!isset($request->bill_no)) {
                return redirect()->back()->with('failure_message', 'Enter Bill No Must');
            }
            $count = count($request->product_id);
            for ($i = 0; $i < $count; $i++) {
                $stock = new Stock();
                $stock->bill_no = $request->bill_no;
                $stock->date = $request->date;
                $stock->pro_id = $request->product_id[$i];
                $stock->unit_id = 2;
                $stock->cost = $request->cost[$i];
                $stock->total = $request->cost[$i] * $request->quantity[$i];
                $stock->type = $request->type;
                $stock->qty_in = $request->quantity[$i];
                $stock->qty_out = 0;
                $stock->biller_id = Auth::User()->id;
                $stock->save();
            }
        }

        return redirect()->back()->with('flash_message', 'Record successfully added!');
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

    public function showbill(Request $request)
    {
        $bill = $request->bill_no;
        $p = Stock::with('product')
            ->with('uoms')
            ->where('bill_no', $bill)
            ->where('type', 'PURCHASE')
            ->get();

        return $p;
    }
}
