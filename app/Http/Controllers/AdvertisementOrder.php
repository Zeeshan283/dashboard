<?php

namespace App\Http\Controllers;

use App\Models\AdvertisementOrder as ModelsAdvertisementOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;

class AdvertisementOrder extends Controller
{
    //
    public function details()
    {
        $data = ModelsAdvertisementOrder::with('user', 'advertisement')->get();
        return view('advertisementOrder.details', compact('data'));
    }

    public function SellerDetails()
    {

        $data = ModelsAdvertisementOrder::where('customer_id', Auth::user()->id)->get();
        $data1 = ModelsAdvertisementOrder::with('user', 'advertisement')->first();
        return view('advertisementOrder.sellerDetails', compact('data', 'data1'));
    }

    public function advertisementImage(Request $request)
    {
        // return dd($request->all());

        $update =  ModelsAdvertisementOrder::findOrFail($request->a_d_i);
        if ($request->hasFile('image')) {
            File::delete($update->image);
            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->extension();
            $image->move('upload/advertisementSeller', $imageName);
            $update->image = 'upload/advertisementSeller/' . $imageName;
        }

        $update->update();


        Toastr::success('Advertisement Added successfully', 'Success');
        return redirect()->back();
    }

    public function advertisementOrderImageStatusUpdate(Request $request)
    {

        // dd($request->all());
        $update =  ModelsAdvertisementOrder::findOrFail($request->a_d_i_admin);
        $update->display_status = $request->display_status;
        if ($request->display_time_start) {
            $update->display_time_start = $request->display_time_start;
            // $update->display_end_start = $request->display_end_start;
        }
        $startDate = Carbon::parse($request->display_time_start);
        $endDate = $startDate->copy()->addDays($request->days);

        $update->display_end_start = $endDate;


        $update->update();


        Toastr::success('Display Status Upated', 'Success');
        return redirect()->back();
    }
}
