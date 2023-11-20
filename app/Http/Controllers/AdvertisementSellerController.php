<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\AdvertisementOrder;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class AdvertisementSellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = Advertisement::all();
        return view('advertisement_seller.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Advertisement::findOrFail($id);
        return view('advertisement_seller.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function formOrder(Request $request)
    {
        // dd($request->all());

        $product = Advertisement::find($request->product_id);
        if ($product->quantity > 0) {
            $data = new AdvertisementOrder();
            $data->customer_id = $request->customer_id;
            $data->product_id = $request->product_id;
            $data->bill = $request->bill;
            $data->status = 'pending';
            $data->name = $request->name;
            $data->phone = $request->phone;

            $data->save();



            if ($product) {
                // Check if the product quantity is greater than zero before decrementing
                if ($product->quantity > 0) {
                    $product->quantity -= 1; // You can modify this based on your needs
                    $product->save();
                }
            }
            Toastr::success('Order successfully Placed', 'Success');
            return redirect()->back();
        } else {
            Toastr::success('Not Avaiable', 'Success');
            return redirect()->back();
        }
    }
}
