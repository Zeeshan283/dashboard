<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\OrderTracker;
use App\Models\Product;
use App\Models\ProductConditions;
use App\Models\ProductContact;
use App\Models\ProductImages;
use App\Models\ProductLocations;
use App\Models\ProductShippment;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;

class VendorsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $vendors = User::select('id','name','phone1','email','status')->whereRole('vendor')->get();
        $data = Order::orderBy('id', 'desc')->get();
        return view('sellers.vendorlist',compact('vendors', 'data'));
    }

    public function create()
    {
        $status = array('0'=>'Active','1'=>'In Active');
        return view('sellers.addseller',compact('status'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'first_name'=>'required',
            'last_name'=>'required',
            'phone1'=>'required',
            'email'=>'required|unique:users,email',
            'password'=>'required',
            'image'=>'required|mimes:jpg,png,jpeg',
        ],[
            'phone1.required'=>'The phone no field is required'
        ]);

        $user = User::create($request->all());
        $user->name = $request->first_name.' '.$request->last_name;
        $user->password = bcrypt($request->password);
        $user->save();

        Toastr::success('New Vendor Added Successfully!');

        return redirect()->back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $edit = User::findOrFail($id);
        $status = array('0'=>'Active','1'=>'In Active');
        return view('vendors.edit',compact('edit','status'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'first_name'=>'required',
            'last_name'=>'required',
            'phone1'=>'required',
            'image'=>'mimes:jpg,png,jpeg',
        ],[
            'phone1.required'=>'The phone no field is required'
        ]);

        $edit1 = User::findOrFail($id);
        $edit = User::findOrFail($id);

        $edit->name = $request->first_name.' '.$request->last_name;
        $edit->status = $request->status;
        $edit->save();

        Toastr::success('Vendor Updated Successfully!');

        return redirect('vendors')->back();
    }

    public function destroy($id)
    {
        $vendor = User::findOrFail($id);
        File::delete('root/upload/logo/'.$vendor->image);

        $order_details = OrderDetails::where('vendor_id',$vendor->id)->get();
        foreach($order_details as $order_detail)
        {
            Order::find($order_detail->order_id)->delete();
            OrderTracker::where('order_id',$order_detail->order_id)->delete();
        }
        OrderDetails::where('vendor_id',$vendor->id)->delete();


        $products = Product::where('created_by',$id)->get();


        foreach($products as $product){
            File::delete('root/upload/products/attachments/'.$product->attachment);


            ProductConditions::where('pro_id',$product->id)->delete();
            ProductContact::where('pro_id',$product->id)->delete();
            $product_images = ProductImages::where('pro_id',$product->id)->get();
            foreach($product_images as $pimage){
                File::delete('root/upload/products/'.$pimage->image);
            }
            ProductImages::where('pro_id',$product->id)->delete();
            ProductLocations::where('pro_id',$product->id)->delete();
            ProductShippment::where('pro_id',$product->id)->delete();
            Stock::where('pro_id',$product->id)->delete();
        }

        $vendor->delete();

        Toastr::success('Vendor Deleted Successfully!');

        return redirect('vendors')->back();

    }
    public function dashboard()
    {
        $isVendor = auth()->user()->roles->contains('name', 'vendorOnly');
        $disableProductsLink = $isVendor ? '' : 'disabled';

        return view('vendor.dashboard', [
            'disableProductsLink' => $disableProductsLink,
        ]);
    }

    public function createProduct()
    {
        $isVendor = auth()->user()->roles->contains('name', 'vendorOnly');

        if (!$isVendor) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to create products.');
        }
        return redirect()->route('dashboard')->with('success', 'Product created successfully.');
    }
}
