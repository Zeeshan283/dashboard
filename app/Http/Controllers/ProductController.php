<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\Menu;
use App\Models\Brand;
use App\Models\Conditions;
use App\Models\Locations;
use App\Models\ProductConditions;
use App\Models\ProductContact;
use App\Models\ProductImages;
use App\Models\ProductLocations;
use App\Models\ProductShippment;
use App\Models\ProductSizes;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image as Image;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
        $data = "";
        if (Auth::User()->role == 'Admin') {
            $data = Product::with('product_image')
                ->with('categories:id,name')
                ->with('subcategories:id,name')
                ->OrderBy('id', 'desc')
                ->get();
        } else {
            $data = Product::with('product_image')
                ->with('categories:id,name')
                ->with('subcategories:id,name')
                ->where('created_by', Auth::User()->id)
                ->OrderBy('id', 'desc')
                ->get();
        }


        return view('products.allproducts', compact('data'));
    }

    public function create()
    {
        $brands = Brand::OrderBy('brand_name')->pluck('brand_name', 'id')->prepend('Select Brand', '');
        $menus = Menu::orderBy('name')->pluck('name', 'id')->prepend('Select Menu', '');
        $categories = Category::orderBy('name')->pluck('name', 'id')->prepend('Select Category', '');
        $sub_categories = SubCategory::orderBy('name')->pluck('name', 'id')->prepend('Select Sub Category', '');
        $locations = Locations::select('id', 'name')->orderBy('id')->get();
        $conditions = Conditions::select('id', 'name')->orderBy('id')->get();
        $type = array('Parent' => 'Parent', 'Child' => 'Child');
        $productsList = Product::whereType('parent')->orderBy('name')->pluck('sku', 'id');
       // $productsList = Product::whereType('parent')->orderBy('name')->pluck('model_no', 'id');


        $ActiveAdmin = User::whereId(Auth::User()->id)->first();

        $vendors = User::select(DB::raw('CONCAT(`id`, "_", `name`) AS `id`, `name`'))
        ->whereRole('Vendor')
        ->pluck('name','id')
        ->prepend($ActiveAdmin->name, $ActiveAdmin->id.'_'.$ActiveAdmin->name);

        return view('products.addproduct', compact('brands', 'menus', 'categories', 'sub_categories', 'locations', 'conditions', 'type', 'productsList','vendors'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // $this->validate($request, [
        //     // 'code' => 'required',
        //     'name' => 'required',
        //     // 'location.0' => 'required',
        //     // 'condition.0' => 'required',
        //     // 'new_price' => 'required',
        //     // 'new_sale_price' => 'required',
        //     'new_warranty_days' => 'required',
        //     'new_return_days' => 'required',
        //     // 'refurnished_price' => 'required',
        //     // 'refurnished_sale_price' => 'required',
        //     // 'refurnished_warranty_days' => 'required',
        //     // 'refurnished_return_days' => 'required',
        //     'model_no' => 'required',
        //     'make' => 'required',
        //     'min_order' => 'required',
        //     'images.0' => 'required',
        //     'attachment' => 'mimes:pdf,zip|max:11264',
        //     'sku' => 'required|unique:products',
        //     'description' => 'required',
        //     // 'details' => 'required',
        //     'type' => 'required',
        //     'menu_id' => 'required',
        //     'category_id' => 'required',
        //     'subcategory_id' => 'required',
        //     'brand_id' => 'required',
        //     // 'parent_id'=>'required',
        //     // 'width'=>'required',
        //     // 'height'=>'required',
        //     // 'depth'=>'required',
        //     // 'weight'=>'required',



        //     // 'shipping_days.*'=>'required',
        //     // 'shipping_charges.*'=>'required',
        //     // 'import_charges.*'=>'required',
        //     // 'tax_charges.*'=>'required',
        //     // 'other_charges.*'=>'required'
        // ], [
        //     'code.required' => 'The Product code field is required',
        //     'name.required' => 'The Product name field is required',
        //     'location.0.required' => 'The Location field is required',
        //     'condition.0.required' => 'The Condition field is required',
        //     'model_no.required' => 'The Model No field is required',
        //     'make.required' => 'The Make field is required',
        //     'sku.exists' => 'The SKU already exist',
        //     'images.0.required' => 'The Image field is required',
        //     'type.required' => 'The Type field is required',
        //     'description.required' => 'The Description field is required',
        //     'brand_id.required' => 'The Brand field is required',
        //     'menu_id.required' => 'The Menu field is required',
        //     'category_id.required' => 'The Category field is required',
        //     'subcategory_id.required' => 'The Sub Category field is required',
        //     'new_price.required' => 'The New price field is required',
        //     'new_sale_price.required' => 'The New Sale price field is required',
        //     'new_warranty_days.required' => 'The New Warranty days field is required',
        //     'new_return_days.required' => 'The New Return days field is required',
        //     'refurnished_price.required' => 'The Refurbished price field is required',
        //     'refurnished_sale_price.required' => 'The Refubnished sale price field is required',
        //     'refurnished_warranty_days.required' => 'The Refubnished Warranty days field is required',
        //     'refurnished_return_days.required' => 'The Refubnished Return days field is required',
        //     'parent_id.required' => 'The Product list field is required',

        //     'shipping_days.*.required' => 'The Shipping Days field is required',
        //     'shipping_charges.*.required' => 'The shipping charges field is required',
        //     'import_charges.*.required' => 'The import charges field is required',
        //     'tax_charges.*.required' => 'The Tax charges field is required',
        //     'other_charges.*.required' => 'The Other charges field is required'
        // ]);

        $counteShippingDays = 0;

        for ($i = 0; $i < count($request->shipping_days); $i++) {
            if ($request->shipping_days[$i] != null) {
                $counteShippingDays++;
            }
        }


        if ($counteShippingDays > 0) {

            $p = Product::create($request->all());

            if ($request->type == 'Child') {
                $p->parent_id = $request->parent_id;
            } else {
                $p->parent_id = $p->id;
            }

            $p->slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name)));
            $p->created_by = Auth::User()->id;
            $p->save();

            if (isset($request->condition)) {
                for ($i = 0; $i < count($request->condition); $i++) {
                    $ProductConditions = new ProductConditions();
                    $ProductConditions->pro_id = $p->id;
                    $ProductConditions->condition_id = $request->condition[$i];
                    $ProductConditions->save();
                }
            }

            if (count($request->images) > 0) {
                for ($i = 0; $i < count($request->images); $i++) {
                    $pImages = new ProductImages();
                    $pImages->pro_id = $p->id;
        
                    // Get the uploaded image file
                    $uploadedImage = $request->images[$i];
                    
                    // Generate a unique filename for the image
                    $imageName = uniqid() . '_' . $uploadedImage->getClientOriginalName();
        
                    // Move the uploaded image to the "upload" folder
                    $uploadedImage->move('upload/products', $imageName);
        
                    // Save the image details
                    $pImages->image = $imageName;
                    $pImages->url =  url('upload/products/' . $imageName); // Adjust this URL as needed
                    $pImages->save();
                }
            }


            // if (count($request->images) > 0) {
            //     for ($i = 0; $i < count($request->images); $i++) {
            //         $pImages = new ProductImages();
            //         $pImages->pro_id = $p->id;
            //         $pImages->image = $request->images[$i];
            //         $pImages->url =  base_path('upload/products/'.$request->images[$i]);
            //         $pImages->save();
            //     }
            // }


            // if ($request->has('images')) {
            //     foreach ($request->file('images') as $image) {
            //         $pImages = new ProductImages();
            //         $pImages->pro_id = $p->id;

            //         // Save the image to storage and get its URL
            //         $imagePath = 'upload/products/';
            //         $imageName = time() . '_' . $image->getClientOriginalName();
            //         $image->move(public_path($imagePath), $imageName);

            //         $pImages->image = $imageName;
            //         $pImages->url = $imagePath . $imageName;
            //         $pImages->save();
            //     }}


            if (count($request->shipping_days) > 0) {
                for ($i = 0; $i < count($request->shipping_days); $i++) {
                    if ($request->shipping_days[$i] != null) {
                        $product_shippment = new ProductShippment();
                        $product_shippment->pro_id = $p->id;
                        $product_shippment->shipping_days = $request->shipping_days[$i];
                        $product_shippment->shipping_charges = $request->shipping_charges[$i];
                        $product_shippment->import_charges = $request->import_charges[$i];
                        $product_shippment->tax_charges = $request->tax_charges[$i];
                        $product_shippment->other_charges = $request->other_charges[$i];
                        $product_shippment->location_id = $request->location_id[$i];
                        $product_shippment->new_price = $p->new_price;
                        $product_shippment->new_sale_price = $p->new_sale_price;
                        $product_shippment->new_warranty_days = $p->new_warranty_days;
                        $product_shippment->refurnished_price = $p->refurnished_price;
                        $product_shippment->refurnished_sale_price = $p->refurnished_sale_price;
                        $product_shippment->refurnished_warranty_days = $p->refurnished_warranty_days;
                        $product_shippment->save();

                        $Productlocation = new ProductLocations();
                        $Productlocation->pro_id = $p->id;
                        $Productlocation->location_id = $request->location_id[$i];
                        $Productlocation->save();
                    }
                }
            } else {
                $this->validate($request, [
                    'shipping_days.*' => 'required'
                ]);
            }

            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move('root/upload/products/attachments', $fileName);
                $p->attachment = $fileName;
                $p->save();
            }

            return redirect()->back()->with(Toastr::success('Product Added Successfully!'));
        } else {
            return redirect()->back()->with(Toastr::error('Shipping Data Required !!!'));
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $edit = Product::with('shipping_details')
            ->with('locations')
            ->with('conditions')
            ->with('product_images')
            // ->where('created_by', Auth::User()->id)
            ->findOrFail($id);
        if ($edit) {
            $brands = Brand::OrderBy('brand_name')->pluck('brand_name', 'id')->prepend('Select Brand', '');
            $menus = Menu::orderBy('name')->pluck('name', 'id')->prepend('Select Menu', '');
            $categories = Category::orderBy('name')->pluck('name', 'id')->prepend('Select Category', '');
            $sub_categories = SubCategory::orderBy('name')->pluck('name', 'id')->prepend('Select Sub Category', '');
            $locations = Locations::orderBy('id')->get(['id', 'name']);
            $conditions = Conditions::orderBy('id')->get(['name', 'id']);
            $type = array('Parent' => 'Parent', 'Child' => 'Child');
            // $productsList = Product::whereType('parent')->orderBy('name')->pluck('model_no', 'id');
            $productsList = Product::whereType('parent')->orderBy('name')->pluck('sku', 'id');

            return view('products.edit', compact('edit', 'brands', 'menus', 'categories', 'sub_categories', 'locations', 'type', 'productsList', 'conditions'));
        } else {
            abort(404);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            // 'code' => 'required',
            'name' => 'required',
            // 'location.0' => 'required',
            'condition.0' => 'required',
            // 'new_price' => 'required',
            // 'new_sale_price' => 'required',
            'new_warranty_days' => 'required',
            'new_return_days' => 'required',
            // 'refurnished_price' => 'required',
            // 'refurnished_sale_price' => 'required',
            // 'refurnished_warranty_days' => 'required',
            // 'refurnished_return_days' => 'required',
            'model_no' => 'required',
            'make' => 'required',
            'min_order' => 'required',
            'images.0' => 'required',
            'attachment' => 'mimes:pdf,zip|max:11264',
            'sku' => 'required',
            'description' => 'required',
            // 'details' => 'required',
            'type' => 'required',
            'menu_id' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'brand_id' => 'required',
            // 'parent_id'=>'required',
            // 'width'=>'required',
            // 'height'=>'required',
            // 'depth'=>'required',
            // 'weight'=>'required',



            // 'shipping_days.*'=>'required',
            // 'shipping_charges.*'=>'required',
            // 'import_charges.*'=>'required',
            // 'tax_charges.*'=>'required',
            // 'other_charges.*'=>'required'
        ], [
            'code.required' => 'The Product code field is required',
            'name.required' => 'The Product name field is required',
            'location.0.required' => 'The Location field is required',
            'condition.0.required' => 'The Condition field is required',
            'model_no.required' => 'The Model No field is required',
            'make.required' => 'The Make field is required',
            'images.0.required' => 'The Image field is required',
            'type.required' => 'The Type field is required',
            'description.required' => 'The Description field is required',
            'brand_id.required' => 'The Brand field is required',
            'menu_id.required' => 'The Menu field is required',
            'category_id.required' => 'The Category field is required',
            'subcategory_id.required' => 'The Sub Category field is required',
            'new_price.required' => 'The New price field is required',
            'new_sale_price.required' => 'The New Sale price field is required',
            'new_warranty_days.required' => 'The New Warranty days field is required',
            'new_return_days.required' => 'The New Return days field is required',
            'refurnished_price.required' => 'The Refurbished price field is required',
            'refurnished_sale_price.required' => 'The Refubnished sale price field is required',
            'refurnished_warranty_days.required' => 'The Refubnished Warranty days field is required',
            'refurnished_return_days.required' => 'The Refurbished Return days field is required',
            'parent_id.required' => 'The Product list field is required',

            'shipping_days.*.required' => 'The Shipping Days field is required',
            'shipping_charges.*.required' => 'The shipping charges field is required',
            'import_charges.*.required' => 'The import charges field is required',
            'tax_charges.*.required' => 'The Tax charges field is required',
            'other_charges.*.required' => 'The Other charges field is required'
        ]);

        $edit = Product::findOrFail($id);

        $counteShippingDays = 0;

        for ($i = 0; $i < count($request->shipping_days); $i++) {
            if ($request->shipping_days[$i] != null) {
                $counteShippingDays++;
            }
        }


        if ($counteShippingDays > 0) {

            $edit->update($request->all());

            if ($request->type == 'Child') {
                $edit->parent_id = $request->parent_id;
            }

            $edit->slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name)));
            $edit->updated_by = Auth::User()->id;
            $edit->save();

            if (isset($request->condition)) {
                if (count($request->condition) > 0) {
                    ProductConditions::where('pro_id', $id)->delete();

                    for ($i = 0; $i < count($request->condition); $i++) {
                        $ProductConditions = new ProductConditions();
                        $ProductConditions->pro_id = $edit->id;
                        $ProductConditions->condition_id = $request->condition[$i];
                        $ProductConditions->save();
                    }
                }
            }

            if (count($request->images) > 0) {
                ProductImages::where('pro_id', $id)->delete();

                for ($i = 0; $i < count($request->images); $i++) {
                    $pImages = new ProductImages();
                    $pImages->pro_id = $edit->id;
                    $pImages->image = $request->images[$i];
                    $pImages->url = 'root/upload/products/'.$request->images[$i];
                    $pImages->save();
                }
            }


            if (isset($request->shipping_days)) {
                if (count($request->shipping_days) > 0) {
                    ProductShippment::where('pro_id', $id)->delete();

                    for ($i = 0; $i < count($request->shipping_days); $i++) {
                        if ($request->shipping_days[$i] != null) {
                            $product_shippment = new ProductShippment();
                            $product_shippment->pro_id = $edit->id;
                            $product_shippment->shipping_days = $request->shipping_days[$i];
                            $product_shippment->shipping_charges = $request->shipping_charges[$i];
                            $product_shippment->import_charges = $request->import_charges[$i];
                            $product_shippment->tax_charges = $request->tax_charges[$i];
                            $product_shippment->other_charges = $request->other_charges[$i];
                            $product_shippment->location_id = $request->location_id[$i];
                            $product_shippment->new_price = $edit->new_price;
                            $product_shippment->new_sale_price = $edit->new_sale_price;
                            $product_shippment->new_warranty_days = $edit->new_warranty_days;
                            $product_shippment->refurnished_price = $edit->refurnished_price;
                            $product_shippment->refurnished_sale_price = $edit->refurnished_sale_price;
                            $product_shippment->refurnished_warranty_days = $edit->refurnished_warranty_days;
                            $product_shippment->save();

                            $Productlocation = new ProductLocations();
                            $Productlocation->pro_id = $edit->id;
                            $Productlocation->location_id = $request->location_id[$i];
                            $Productlocation->save();
                        }
                    }
                }
            } else {
                $this->validate($request, [
                    'shipping_days.*' => 'required'
                ]);
            }

            if ($request->hasFile('attachment')) {
                File::delete('root/upload/products/attachments/' . $edit->attachment);

                $file = $request->file('attachment');
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move('root/upload/products/attachments', $fileName);
                $edit->attachment = $fileName;
                $edit->save();
            }

            return redirect('products')->with(Toastr::success('Product Updated Successfully!'));
        } else {
            return redirect()->back()->with(Toastr::error('Shipping Data Required !!!'));
        }
    }

    public function dupe($id)
    {
        $edit = Product::with('shipping_details')
            ->with('locations')
            ->with('conditions')
            ->with('product_images')
            // ->where('created_by', Auth::User()->id)
            ->findOrFail($id);
        if ($edit) {
            $brands = Brand::OrderBy('brand_name')->pluck('brand_name', 'id')->prepend('Select Brand', '');
            $menus = Menu::orderBy('name')->pluck('name', 'id')->prepend('Select Menu', '');
            $categories = Category::orderBy('name')->pluck('name', 'id')->prepend('Select Category', '');
            $sub_categories = SubCategory::orderBy('name')->pluck('name', 'id')->prepend('Select Sub Category', '');
            $locations = Locations::orderBy('id')->get(['id', 'name']);
            $conditions = Conditions::orderBy('id')->get(['name', 'id']);
            $type = array('Parent' => 'Parent', 'Child' => 'Child');
            $productsList = Product::whereType('parent')->orderBy('name')->pluck('model_no', 'id');

            return view('products.dupe', compact('edit', 'brands', 'menus', 'categories', 'sub_categories', 'locations', 'type', 'productsList', 'conditions'));
        } else {
            abort(404);
        }
    }

    public function duplicate(Request $request, $id)
    {
        $this->validate($request, [
            // 'code' => 'required',
            'name' => 'required',
            // 'location.0' => 'required',
            'condition.0' => 'required',
            // 'new_price' => 'required',
            // 'new_sale_price' => 'required',
            'new_warranty_days' => 'required',
            'new_return_days' => 'required',
            // 'refurnished_price' => 'required',
            // 'refurnished_sale_price' => 'required',
            // 'refurnished_warranty_days' => 'required',
            // 'refurnished_return_days' => 'required',
            'model_no' => 'required',
            'make' => 'required',
            'min_order' => 'required',
            'images.0' => 'required',
            'attachment' => 'mimes:pdf,zip|max:11264',
            'sku' => 'required|unique:products',
            'description' => 'required',
            // 'details' => 'required',
            'type' => 'required',
            'menu_id' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'brand_id' => 'required',
            // 'parent_id'=>'required',
            // 'width'=>'required',
            // 'height'=>'required',
            // 'depth'=>'required',
            // 'weight'=>'required',



            // 'shipping_days.*'=>'required',
            // 'shipping_charges.*'=>'required',
            // 'import_charges.*'=>'required',
            // 'tax_charges.*'=>'required',
            // 'other_charges.*'=>'required'
        ], [
            'code.required' => 'The Product code field is required',
            'name.required' => 'The Product name field is required',
            'location.0.required' => 'The Location field is required',
            'condition.0.required' => 'The Condition field is required',
            'model_no.required' => 'The Model No field is required',
            'make.required' => 'The Make field is required',
            'sku.exists' => 'The SKU already exist',
            'images.0.required' => 'The Image field is required',
            'type.required' => 'The Type field is required',
            'description.required' => 'The Description field is required',
            'brand_id.required' => 'The Brand field is required',
            'menu_id.required' => 'The Menu field is required',
            'category_id.required' => 'The Category field is required',
            'subcategory_id.required' => 'The Sub Category field is required',
            'new_price.required' => 'The New price field is required',
            'new_sale_price.required' => 'The New Sale price field is required',
            'new_warranty_days.required' => 'The New Warranty days field is required',
            'new_return_days.required' => 'The New Return days field is required',
            'refurnished_price.required' => 'The Refurbished price field is required',
            'refurnished_sale_price.required' => 'The Refubnished sale price field is required',
            'refurnished_warranty_days.required' => 'The Refubnished Warranty days field is required',
            'refurnished_return_days.required' => 'The Refubnished Return days field is required',
            'parent_id.required' => 'The Product list field is required',

            'shipping_days.*.required' => 'The Shipping Days field is required',
            'shipping_charges.*.required' => 'The shipping charges field is required',
            'import_charges.*.required' => 'The import charges field is required',
            'tax_charges.*.required' => 'The Tax charges field is required',
            'other_charges.*.required' => 'The Other charges field is required'
        ]);

        $counteShippingDays = 0;

        for ($i = 0; $i < count($request->shipping_days); $i++) {
            if ($request->shipping_days[$i] != null) {
                $counteShippingDays++;
            }
        }


        if ($counteShippingDays > 0) {

            $p = Product::create($request->all());

            if ($request->type == 'Child') {
                $p->parent_id = $request->parent_id;
            } else {
                $p->parent_id = $p->id;
            }

            $p->slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name)));
            $p->created_by = Auth::User()->id;
            $p->save();

            if (isset($request->condition)) {
                for ($i = 0; $i < count($request->condition); $i++) {
                    $ProductConditions = new ProductConditions();
                    $ProductConditions->pro_id = $p->id;
                    $ProductConditions->condition_id = $request->condition[$i];
                    $ProductConditions->save();
                }
            }

            if (count($request->images) > 0) {
                for ($i = 0; $i < count($request->images); $i++) {
                    $pImages = new ProductImages();
                    $pImages->pro_id = $p->id;
                    $pImages->image = $request->images[$i];
                    $pImages->url = 'root/upload/products/'.$request->images[$i];
                    $pImages->save();
                }
            }



            if (count($request->shipping_days) > 0) {
                for ($i = 0; $i < count($request->shipping_days); $i++) {
                    if ($request->shipping_days[$i] != null) {
                        $product_shippment = new ProductShippment();
                        $product_shippment->pro_id = $p->id;
                        $product_shippment->shipping_days = $request->shipping_days[$i];
                        $product_shippment->shipping_charges = $request->shipping_charges[$i];
                        $product_shippment->import_charges = $request->import_charges[$i];
                        $product_shippment->tax_charges = $request->tax_charges[$i];
                        $product_shippment->other_charges = $request->other_charges[$i];
                        $product_shippment->location_id = $request->location_id[$i];
                        $product_shippment->new_price = $p->new_price;
                        $product_shippment->new_sale_price = $p->new_sale_price;
                        $product_shippment->new_warranty_days = $p->new_warranty_days;
                        $product_shippment->refurnished_price = $p->refurnished_price;
                        $product_shippment->refurnished_sale_price = $p->refurnished_sale_price;
                        $product_shippment->refurnished_warranty_days = $p->refurnished_warranty_days;
                        $product_shippment->save();

                        $Productlocation = new ProductLocations();
                        $Productlocation->pro_id = $p->id;
                        $Productlocation->location_id = $request->location_id[$i];
                        $Productlocation->save();
                    }
                }
            } else {
                $this->validate($request, [
                    'shipping_days.*' => 'required'
                ]);
            }

            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move('root/upload/products/attachments', $fileName);
                $p->attachment = $fileName;
                $p->save();
            }

            return redirect()->back()->with(Toastr::success('Product Added Successfully!'));
        } else {
            return redirect()->back()->with(Toastr::error('Shipping Data Required !!!'));
        }
    }

    public function destroy($id)
    {
        $pro = Product::findOrFail($id);

        File::delete(base_path() . '/upload/products/attachments/' . $pro->attachment);
        $pro->delete();

        ProductConditions::where('pro_id', $id)->delete();
        $pImages = ProductImages::where('pro_id', $id)->get();
        foreach ($pImages as $value) {
            File::delete(base_path() . '/upload/products/' . $value->image);
        }
        ProductImages::where('pro_id', $id)->delete();
        ProductLocations::where('pro_id', $id)->delete();
        ProductSizes::where('pro_id', $id)->delete();
        ProductShippment::where('pro_id', $id)->delete();

        return redirect()->back()->with(Toastr::success('Product Deleted Successfully!'));
    }

    public function GetCategories(Request $request)
    {
        $categories = Category::whereMenuId($request->menu_id)->get(['id', 'name']);
        return json_encode($categories);
    }

    public function GetSubCategories(Request $request)
    {
        $subcategories = SubCategory::where('category_id', $request->cat_id)->get(['id', 'name']);
        return json_encode($subcategories);
    }

    public function UploadImageAJax(Request $request)
    {
        // return count($request->select_file);
        $validation = Validator::make($request->all(), [
            'select_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        if (!$validation->failed()) {
            $imagesName = [];
            foreach ($request->select_file as $key => $file) {
                $image = $file;
                $new_name = uniqid() . $image->getClientOriginalName();

                // $image->move('root/upload/products', $new_name);
                
                $imagePath =  base_path('upload/products/' . $new_name);
                $img = Image::make($image);
                $img->resize(1000, 957);
                $img->save($imagePath);

                $imagesName[$key] = $new_name;
            }
            return response()->json($imagesName);
            // return response()->json([
            //   'message'   => 'Image Upload Successfully',
            //   'uploaded_image' =>
            //   '<label id="row' . $new_name . '">
            //     <img src="../root/upload/products/' . $new_name . '" class="img-thumbnail" style="width:100px;height:80px;" />
            //       <span data-path="' . $new_name . '" id="remove_button" style="position:relative;top:-35px;left:-10px;background:red;color:white;padding:0px 5px 3px 5px;border-radius:100%;cus">x</span>
            //     </div>
            //    </label>',
            //   'class_name'  => 'alert-success',
            //   'name' => $new_name
            // ]);
        } else {
            return response()->json([
                'message'   => $validation->errors()->all(),
                'uploaded_image' => '',
                'class_name'  => 'alert-danger'
            ]);
        }
    }

    public function DeleteImageAJax(Request $request)
    {
        File::delete('root/upload/products/' . $request->path);

        ProductImages::where('image', $request->path)->delete();
        return "Deleted";
    }

    public function UploadAttachmentAJax(Request $request)
    {
        if ($request->hasFile('attachment')) {
            return 1;
        } else {
            return 2;
        }
        return $request->all();
        $image = $request->file('attachment');
        $new_name = uniqid() . $image->getClientOriginalName();

        $image->move('root/upload/products/attachments', $new_name);
        return response()->json([
            'message'   => 'Image Upload Successfully'
        ]);
    }

    public function ProductsContacts(Request $request)
    {
        if (Auth::User()->role == 'Admin') {
            $productContacts=array();
            if($request->from_date!=null && $request->to_date!=null)
            {
                $productContacts = ProductContact::whereDate('created_at','>=',$request->from_date)
                ->whereDate('created_at','<=',$request->to_date)
                ->orderBy('id', 'desc')->get();
            }
            return view('products.contacts', compact('productContacts'));
        } else if (Auth::User()->role == 'Vendor') {
            $productContacts = ProductContact::where('vendor_id', Auth::User()->id)->orderBy('id', 'desc')->get();
            return view('products.vendor_contacts', compact('productContacts'));
        }
    }
}
