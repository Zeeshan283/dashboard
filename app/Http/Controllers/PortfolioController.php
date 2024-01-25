<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VendorPortfolio;
use Illuminate\Support\Facades\Auth;       
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\File;
use Brian2694\Toastr\Facades\Toastr;                                                                                                                                                                 
class PortfolioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = VendorPortfolio::where('vendor_id',Auth::user()->id)->OrderBy('id')->get(['id', 'title', 'image']);
        return view('sellers.portfolio.index', compact('data'));
    }

    public function create()
    {
        return view('sellers.portfolio.create');
    }

    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'title' => 'required',
            'vendor_id' => 'required',
            'image' => 'required'
        ]);
        $s = new VendorPortfolio;
        $s->title = $request->title;
        $s->vendor_id = $request->vendor_id;
        $s->slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title)));
        $s->save();
  
        $images = [];

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                if ($image->isValid()) {
                    $extension = $image->getClientOriginalExtension();
                    $fileName = uniqid() . '.' . $extension;
                    $path = $image->move('upload/vendorProfile/portfolio', $fileName);

                    $images[] = $path->getPathname();
                }
            }
            $s->image = json_encode($images);
            $s->save();
        }

        return redirect('/portfolios')->with(Toastr::success('Service Added Successfully!'));
    }

    public function show(VendorPortfolio $portfolio)
    {
        //
    }

    public function edit($id)
    {
        $edit = VendorPortfolio::findOrFail($id);
        return view('sellers.portfolio.edit', compact('edit'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'image' => 'mimes:png,jpg,jpeg|max:2048'
        ]);
        $edit1 = VendorPortfolio::findOrFail($id);
        $edit = VendorPortfolio::findOrFail($id);
        $edit->update($request->all());

        $edit->slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title)));
        $edit->save();


        if ($request->hasFile('image')) {
            File::delete($edit1->image);
            
            $file = $request->file('image');
            $fileName = uniqid() . $file->getClientOriginalName();

            //Service image save in 1200 x 800
            $imagePath =  'upload/vendorProfile/portfolio/' . $fileName;
            $img = Image::make($request->file('image'));
            $img->save($imagePath);

            $edit->image = $imagePath;
            $edit->save();
        }

        return redirect('/portfolios')->with(Toastr::success('Service Updated Successfully!'));
    }

        public function destroy($id)
{
    $portfolio = VendorPortfolio::findOrFail($id);

    $filename = pathinfo($portfolio->image, PATHINFO_FILENAME);

    $files = glob(public_path('upload/vendorProfile/portfolio') . '/' . $filename . '.*');
   
    foreach ($files as $file) {
        File::delete($file);
    }

    // Delete the portfolio entry
    $portfolio->delete();

    return redirect('/portfolios')->with(Toastr::success('Service Deleted Successfully!'));
}

    
}
