<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryServices; 
use App\Models\Cprofile;


class CategoryServicesController extends Controller
{
    public function index()
    {
        $data = CategoryServices::all();
        return view('categoryservices.index', compact('data'));
    }

    public function create()
    {
        // Fetch categories from Cprofile model
        $categories = Cprofile::pluck('pcategory', 'id');
    
        return view('service.create', compact('categories'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
        ]);

        // Handle file upload
        $imagePath = $request->file('image')->store('uploads', 'public');

        CategoryServices::create([
            'title' => $request->input('title'),
            'category' => $request->input('category'),
            'image' => $imagePath,
            'description' => $request->input('description'),
        ]);

        return redirect()->route('service.index')->with('success', 'Service created successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
        ]);

        $service = CategoryServices::findOrFail($id);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
            $service->image = $imagePath;
        }

        $service->title = $request->input('title');
        $service->category = $request->input('category');
        $service->description = $request->input('description');

        $service->save();

        return redirect()->route('service.index')->with('success', 'Service updated successfully');
    }

    public function destroy($id)
    {
        $service = CategoryServices::findOrFail($id);
        $service->delete();

        return redirect()->route('service.index')->with('success', 'Service deleted successfully');
    }
}
