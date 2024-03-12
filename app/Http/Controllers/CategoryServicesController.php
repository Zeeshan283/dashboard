<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryServices;
use App\Models\Cprofile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\VendorProfile;

class CategoryServicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if (Auth::user()->role == 'Admin') {
            $data = CategoryServices::all();
        } elseif (Auth::user()->role == 'Vendor') {
            $data = CategoryServices::orderBy('id', 'desc')->where('vendor_id', Auth::user()->id)->get();
        }
        $data = CategoryServices::with('Category')->get();
        return view('service.index', compact('data'));
    }

    public function create()
    {
        $categories = Cprofile::pluck('pcategory', 'id');
        return view('service.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'vendor_id' => 'required',
            'title' => 'required|string|max:255',
            'category' => 'required|exists:cprofiles,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
        ]);
        $service = new CategoryServices();
        $service->vendor_id = $request->vendor_id;
        $service->title = $request->title;
        $service->category = $request->category;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/blogs/'), $fileName);
            $service->image = $fileName;
        }
        $service->description = $request->description;
        $service->save();
        notify()->success('Service created successfully', 'Success');
        return redirect()->route('service.index')->with('success', 'Service created successfully');
    }
    public function edit($id)
    {
        if (Auth::user()->role == 'Admin') {
            $data = CategoryServices::all();
        } elseif (Auth::user()->role == 'Vendor') {
            $data = CategoryServices::orderBy('id', 'desc')->where('vendor_id', Auth::user()->id)->get();
        }
        $edit = CategoryServices::findOrFail($id);
        $categories = Cprofile::pluck('pcategory', 'id'); // Fetch categories here
        return view('service.edit', compact('edit', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'vendor_id' => 'required',
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
        ]);

        $service = CategoryServices::findOrFail($id);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/blogs/'), $fileName);
            $service->image = $fileName;
        }
        $service->vendor_id = $request->vendor_id;
        $service->title = $request->title;
        $service->category = $request->category;
        $service->description = $request->description;
        $data = Cprofile::all();
        $service->save();
        notify()->success('Service updated successfully', 'Success');
        return redirect()->route('service.index')->with('success', 'Service updated successfully');
    }

    public function destroy($id)
    {
        $service = CategoryServices::findOrFail($id);
        $service->delete();

        return redirect()->route('service.index')->with('success', 'Service deleted successfully');
    }
}
