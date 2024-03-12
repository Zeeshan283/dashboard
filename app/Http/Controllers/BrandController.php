<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image as Image;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(request $request)
    {
        $allbrands = Brand::all();
        $query = Brand::query();
    if ($request->has('brands')) {
        $brands = $request->input('brands');
        if (is_array($brands)) {
            $query->whereIn('brand_name', $brands);
        } else {
            $query->where('brand_name', $brands);
        }
    }
    if ($request->has('dateTime')) {
        $dateTimeRange = explode(' - ', $request->input('dateTime'));
        $startDateTime = Carbon::createFromFormat('m/d/Y h:i A', $dateTimeRange[0])->format('Y-m-d H:i:s');
        $endDateTime = Carbon::createFromFormat('m/d/Y h:i A', $dateTimeRange[1])->format('Y-m-d H:i:s');

        $query->whereBetween('created_at', [$startDateTime, $endDateTime]);
    }
    $data = $query->get();

        // $data = Brand::whereType('brand')->orderBy('brand_name')->get(['id', 'brand_name', 'logo']);
        return view('brands.index', compact('data','allbrands'));
    }

    public function create()
    {
        return view('brands.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'brand_name' => 'required|unique:brands',
            'logo' => 'required|mimes:png,jpg',
            'link' => '',
            'type' => ''
        ], [
            'brand_name' => 'The Brand name field is required'
        ]);

        $b = Brand::create($request->all());

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = uniqid() . $file->getClientOriginalName();

            //prorgam image save in 410 x 186
            $imagePath =  'upload/brands/big/' . $fileName;
            $img = Image::make($file);
            $img->resize(410, 186);
            $img->save($imagePath);

            //prorgam image save in 136 x 62
            $imagePath = 'upload/brands/small/' . $fileName;
            $img = Image::make($file);
            $img->resize(136, 62);
            $img->save($imagePath);

            $b->logo = $imagePath;
            $b->save();
        }
        notify()->success('Brand added successfully', 'Success');
        Toastr::success('Brand Added Successfully!');
        return redirect('brands');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Brand::findOrFail($id);
        return view('brands.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'brand_name' => 'required',
            'logo' => 'mimes:png,jpg',
            'link' => '',
            'type' => ''
        ], [
            'brand_name' => 'The Brand name field is required'
        ]);
        $update1 = Brand::findOrFail($id);
        $update = Brand::findOrFail($id);
        $update->update($request->all());

        if ($request->hasFile('logo')) {
            File::delete('upload/brands/big/' . $update1->logo);
            File::delete('upload/brands/small/' . $update1->logo);

            $file = $request->file('logo');
            $fileName = uniqid() . $file->getClientOriginalName();

            $imagePath =  'upload/brands/big/' . $fileName;
            $img = Image::make($file);
            $img->resize(410, 186);
            $img->save($imagePath);

            //prorgam image save in 136 x 62
            $imagePath =  'upload/brands/small/' . $fileName;
            $img = Image::make($file);
            $img->resize(136, 62);
            $img->save($imagePath);

            $update->logo = $imagePath;
            $update->save();
        }
        notify()->success('Brand update successfully', 'Success');
        Toastr::success('Brand Updated Successfully!');
        return redirect('brands');
    }

    public function destroy($id)
    {
        $delete = Brand::findOrFail($id);
        File::delete('upload/brands/big/' . $delete->logo);
        File::delete('upload/brands/small/' . $delete->logo);
        $delete->delete();
        notify()->success('Brand deleted successfully', 'Success');
        return redirect()->back()->with(Toastr::success('Brand Deleted Successfully!'));
    }
}
