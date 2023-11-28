<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertisement;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image as Image;
use Brian2694\Toastr\Facades\Toastr;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data = Advertisement::all();
        return view('advertisement.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('advertisement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $this->validate(
            $request,
            [
                'name' => 'required',
                'make' => 'required',
                'created_by' => 'required',
                // 'image' => 'required',
                'days' => 'required',
                'quantity' => 'required',
                'old_price' => 'nullable|gt:sale_price',
                'sale_price' => 'nullable',
            ],

        );

        $data = new Advertisement;

        $data->name = $request->name;
        $data->make = $request->make;
        $data->created_by = $request->created_by;
        $data->days = $request->days;
        $data->quantity = $request->quantity;
        $data->old_price = $request->old_price;
        $data->sale_price = $request->sale_price;
        $data->details = $request->details;
        $data->imageDimention = $request->imageDimention;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->extension();
            $image->move('upload/advertisement', $imageName);
            $data->image = 'upload/advertisement/' . $imageName;
        }

        $data->save();


        Toastr::success('Advertisement Added successfully', 'Success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit = Advertisement::findOrFaIL($id);
        return view('advertisement.edit', compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $this->validate(
            $request,
            [
                'name' => 'required',
                'make' => 'required',
                'created_by' => 'required',
                // 'image' => 'required',
                'days' => 'required',
                'quantity' => 'required',
                'old_price' => 'nullable|gt:sale_price',
                'sale_price' => 'nullable',
            ],

        );

        $update =  Advertisement::findOrFail($id);

        $update->name = $request->name;
        $update->make = $request->make;
        $update->created_by = $request->created_by;
        $update->days = $request->days;
        $update->quantity = $request->quantity;
        $update->old_price = $request->old_price;
        $update->sale_price = $request->sale_price;
        $update->details = $request->details;
        $update->imageDimention = $request->imageDimention;

        if ($request->hasFile('image')) {
            File::delete($update->image);
            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->extension();
            $image->move('upload/advertisement', $imageName);
            $update->image = 'upload/advertisement/' . $imageName;
        }

        $update->update();


        Toastr::success('Advertisement Added successfully', 'Success');
        return redirect('advertisements');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
