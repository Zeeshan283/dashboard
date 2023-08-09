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
use Intervention\Image\Facades\Image as Image;
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
        return view('vendors.index',compact('vendors', 'data'));
    }

    public function create()
    {
        $status = array('0'=>'Active','1'=>'In Active');
        return view('vendors.create',compact('status'));
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

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = uniqid() . $file->getClientOriginalName();

            //prorgam image save in 2388 x 1150
            $imagePath =  base_path('upload/logo/' . $fileName);
            $img = Image::make($file);
            $img->resize(2388, 1150);
            $img->save($imagePath);

            $user->image = $fileName;
            $user->save();
        }

        return redirect()->back()->with(Toastr::success('New Vendor Added Successfully!'));
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

        if ($request->hasFile('image')) {
            File::delete('root/upload/logo/'.$edit1->image);

            $file = $request->file('image');
            $fileName = uniqid() . $file->getClientOriginalName();

            //prorgam image save in 2388 x 1150
            $imagePath =  base_path('upload/logo/' . $fileName);
            $img = Image::make($file);
            $img->resize(2388, 1150);
            $img->save($imagePath);

            $edit->image = $fileName;
            $edit->save();
        }

        return redirect('vendors')->with(Toastr::success('Vendor Updated Successfully!'));
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

        return redirect()->back()->with(Toastr::success('Vendor Deleted Successfully!'));
    }
}
