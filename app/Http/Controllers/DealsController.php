<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Deals;
use App\Models\Product;

class DealsController extends Controller
{
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
        $validatedData = $request->validate([
            'sku' => 'required|unique:deals,sku',
        ]);
    
        // Fetch the product using the provided SKU
        $product = Product::where('sku', $request->sku)->first();
    
        // Check if product exists
        if (!$product) {
            return redirect()->back()->withErrors(['sku' => 'Product with this SKU not found.']);
        }
    
        // Store the deal in the database
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
    
        return redirect()->route('Deals.index')->with('success', 'Deal added successfully!');
    }
    public function edit($id)
{
    $deal = Deals::findOrFail($id);
    return view('Deals.edit', ['edit' => $deal]);
}

public function update(Request $request, $id)
{
    // Validate the request
    $request->validate([
        'sku' => [
            'required',
            Rule::unique('deals')->ignore($id),
        ],
    ]);

    $product = Product::where('sku', $request->sku)->first();
    
    if (!$product) {
        return redirect()->back()->withErrors(['sku' => 'Product with this SKU not found.']);
    }

    $deal = Deals::findOrFail($id);
    $deal->id = $product->id;  
    $deal->sku = $request->sku;
    $deal->name = $product->name;  
    $deal->make = $product->make; 
    $deal->url = $product->url; 
    $deal->feature_image = $product->feature_image; 
    $deal->status = $request->status;
    $deal->save();

    return redirect()->route('Deals.index')->with('success', 'Deal updated successfully!');
}

public function destroy($id)
{
    $deal = Deals::findOrFail($id); // Find the deal by its ID

    $deal->delete(); // Delete the deal

    return redirect()->route('Deals.index')->with('success', 'Deal deleted successfully!');
}

}
