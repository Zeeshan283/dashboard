<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Deals;
use App\Models\Product;

class DealsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data = Deals::all();
        return view('Deals.alldeals', ['data' => $data]);
    }

    public function create()
    {
        return view('Deals.create');
    }

    public function store(Request $request)
    {
        // Validate input data
        // dd($request->all());
        $validatedData = $request->validate([
            'sku' => 'required|unique:deals,sku',
        ]);

        $product = Product::where('sku', $request->sku)->first();

        if (!$product) {
            return redirect()->back()->withErrors(['sku' => 'Product with this SKU not found.']);
        }
        $deal = new Deals;
        $deal->sku = $request->sku;
        $deal->id = $product->id;
        $deal->name = $product->name;
        $deal->sku = $product->sku;
        $deal->make = $product->make;
        $deal->url = $product->url;
        $deal->feature_image = $product->feature_image;
        $deal->status = $request->status;
        $deal->save();
        notify()->success('Deals created successfully', 'Success');
        return redirect()->route('Deals.index')->with('success', 'Deal added successfully!');
    }
    public function edit($id)
{
    $deal = Deals::findOrFail($id);
    return view('Deals.edit', ['edit' => $deal]);
}

public function destroy($id)
{
    $deal = Deals::findOrFail($id);

    $deal->delete();
    notify()->success('Deals deleted  successfully', 'Success');
    return redirect()->route('Deals.index')->with('success', 'Deal deleted successfully!');
}

}
