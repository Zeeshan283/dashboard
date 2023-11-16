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
use App\Models\Color;
use App\Models\ProductColors;
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
        $colors = Color::select('id', 'name')->orderBy('id')->get();


        $ActiveAdmin = User::whereId(Auth::User()->id)->first();

        $vendors = User::select(DB::raw('CONCAT(`id`, "_", `name`) AS `id`, `name`'))
            ->whereRole('Vendor')
            ->pluck('name', 'id')
            ->prepend($ActiveAdmin->name, $ActiveAdmin->id . '_' . $ActiveAdmin->name);

        return view('products.addproduct', compact('brands', 'menus', 'categories', 'sub_categories', 'locations', 'conditions', 'type', 'productsList', 'vendors', 'colors'));
    }

    public function test()
    {
        return view('products.test');
    }

    public function testupload(Request $request)
    {
        dd($request);
        return view('products.test');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        // dd($user);
        // dd($request->all());
        if (!$user->first_name == '' && !$user->phone1 == '' && !$user->address1 == '' && !$user->city == '') {
            $this->validate(
                $request,
                [


                    'name' => 'required',
                    'make' => 'required',
                    // 'min_order' => 'required',
                    'sku' => 'required|unique:products',
                    'new_price' => 'nullable|gt:new_sale_price',
                    'new_sale_price' => 'nullable',
                    'refurnished_price' => 'nullable|gt:refurnished_sale_price',
                    'refurnished_sale_price' => 'nullable',
                    'feature_image' => 'required',
                    // 'images.0' => 'required',
                    'attachment' => 'mimes:pdf,zip|max:20480',
                    'description' => 'required',
                    'menu_id' => 'required',
                    'category_id' => 'required',
                    'subcategory_id' => 'required',
                    'brand_id' => 'required',

                ],
                [

                    'name.required' => 'The Product name field is required',
                    // 'condition.0.required' => 'The Condition field is required',
                    'make.required' => 'The Make field is required',
                    'sku.exists' => 'The SKU already exist',
                    'new_sale_price.lte' => 'Sale price must be less than or equal to the old price.',
                    'refurnished_sale_price.lte' => 'Refurbished Sale price must be less than or equal to the old Refurbished price.',
                    'feature_image.required' => 'The Feature Image field is required',
                    // 'images.0.required' => 'The Image field is required',
                    'description.required' => 'The Description field is required',
                    'brand_id.required' => 'The Brand field is required',
                    'menu_id.required' => 'The Menu field is required',
                    'category_id.required' => 'The Category field is required',
                    'subcategory_id.required' => 'The Sub Category field is required',
                ]

            );

            // dd($request->all());
            if ($request->hasFile('feature_image')) {
                $image = $request->file('feature_image');
                $imageName = uniqid() . '.' . $image->extension();
                $image->move('upload/products', $imageName);
            }

            $productData = $request->all();

            if ($request->hasFile('feature_image')) {
                $productData['url'] = asset('upload/products/' . $imageName);
                $productData['feature_image'] = $imageName;
            }


            $p = Product::create($productData);
            // $p = Product::create($request->all());

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

            if (isset($request->colors)) {
                for ($i = 0; $i < count($request->colors); $i++) {
                    $productColor = new ProductColors();
                    $productColor->pro_id = $p->id;
                    $productColor->color_id = $request->colors[$i];
                    $productColor->save();
                }
            }

            if ($request->hasFile('images')) {
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



            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move('upload/products/attachments', $fileName);

                $p->attachment = $fileName;
                $p->save();
            }
            Toastr::success('Product Added successfully', 'Success');
            return redirect()->back();
        } else {
            Toastr::success('Please Fill Your Profile First', 'Success');
            $user_id = Auth::user()->id;
            return redirect()->to('vendor-profile/' . $user_id);
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
            ->with('colors')
            ->with('product_images')
            // ->where('created_by', Auth::User()->id)
            ->findOrFail($id);
        // dd($edit);
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

            $colors = Color::orderBy('id')->get(['name', 'id']);

            return view('products.edit', compact('edit', 'brands', 'menus', 'categories', 'sub_categories', 'locations', 'type', 'productsList', 'conditions', 'colors'));
        } else {
            abort(404);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [

                'name' => 'required',
                'make' => 'required',
                // 'min_order' => 'required',
                // 'feature_image' => 'required',
                'sku' => 'required',
                'new_price' => 'nullable|gt:new_sale_price',
                'new_sale_price' => 'nullable',
                'refurnished_price' => 'nullable|gt:refurnished_sale_price',
                'refurnished_sale_price' => 'nullable',
                'description' => 'required',
                'attachment' => 'mimes:pdf,zip|max:20480',
                'menu_id' => 'required',
                'category_id' => 'required',
                'subcategory_id' => 'required',
                'brand_id' => 'required',

            ],
            [
                'name.required' => 'The Product name field is required',
                'make.required' => 'The Make field is required',
                'sku.exists' => 'The SKU already exist',
                'new_sale_price.lte' => 'Sale price must be less than or equal to the old price.',
                'refurnished_sale_price.lte' => 'Refurbished Sale price must be less than or equal to the old Refurbished price.',
                'feature_image.required' => 'The Feature Image field is required',
                // 'images.0.required' => 'The Image field is required',
                'description.required' => 'The Description field is required',
                'brand_id.required' => 'The Brand field is required',
                'menu_id.required' => 'The Menu field is required',
                'category_id.required' => 'The Category field is required',
                'subcategory_id.required' => 'The Sub Category field is required',
            ]

        );


        $edit = Product::findOrFail($id);

        if ($request->hasFile('feature_image')) {
            $image = $request->file('feature_image');
            $imageName = uniqid() . '.' . $image->extension();
            $image->move('upload/products', $imageName);
        }

        $productData = $request->all();
        if ($request->hasFile('feature_image')) {
            $productData['url'] = asset('upload/products/' . $imageName);
            $productData['feature_image'] = $imageName;
        }

        $edit->update($productData);

        // $edit->update($request->all());

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
        if (isset($request->colors)) {
            if (count($request->colors) > 0) {
                ProductColors::where('pro_id', $id)->delete();

                for ($i = 0; $i < count($request->colors); $i++) {
                    $ProductColors = new ProductColors();
                    $ProductColors->pro_id = $edit->id;
                    $ProductColors->color_id = $request->colors[$i];
                    $ProductColors->save();
                }
            }
        }

        // if (count($request->images) > 0) {
        //     ProductImages::where('pro_id', $id)->delete();

        //     for ($i = 0; $i < count($request->images); $i++) {
        //         $pImages = new ProductImages();
        //         $pImages->pro_id = $edit->id;
        //         $pImages->image = $request->images[$i];
        //         $pImages->url = 'root/upload/products/'.$request->images[$i];
        //         $pImages->save();
        //     }
        // }


        if ($request->hasFile('images')) {
            if (count($request->images) > 0) {

                ProductImages::where('pro_id', $id)->delete();



                for ($i = 0; $i < count($request->images); $i++) {
                    $pImages = new ProductImages();
                    $pImages->pro_id = $edit->id;

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
        }

        if ($request->hasFile('attachment')) {
            File::delete('upload/products/attachments/' . $edit->attachment);

            $file = $request->file('attachment');
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move('upload/products/attachments', $fileName);
            $edit->attachment = $fileName;
            $edit->save();
        }

        return redirect('products')->with(Toastr::success('Product Updated Successfully!'));
    }

    public function dupe($id)
    {

        $edit = Product::with('shipping_details')
            ->with('locations')
            ->with('conditions')
            ->with('colors')
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
            $colors = Color::orderBy('id')->get(['name', 'id']);

            return view('products.dupe', compact('edit', 'brands', 'menus', 'categories', 'sub_categories', 'locations', 'type', 'productsList', 'conditions', 'colors'));
        } else {
            abort(404);
        }
    }

    public function duplicate(Request $request, $id)
    {
        $this->validate(
            $request,
            [

                'name' => 'required',
                'make' => 'required',
                // 'min_order' => 'required',
                'attachment' => 'mimes:pdf,zip|max:20480',
                'sku' => 'required|unique:products',
                'new_price' => 'nullable|gt:new_sale_price',
                'new_sale_price' => 'nullable',
                'refurnished_price' => 'nullable|gt:refurnished_sale_price',
                'refurnished_sale_price' => 'nullable',
                'description' => 'required',
                // 'images.0' => 'required',
                'feature_image' => 'required',
                'menu_id' => 'required',
                'category_id' => 'required',
                'subcategory_id' => 'required',
                'brand_id' => 'required',

            ],
            [
                'name.required' => 'The Product name field is required',
                'make.required' => 'The Make field is required',
                'sku.exists' => 'The SKU already exist',
                'new_sale_price.lte' => 'Sale price must be less than or equal to the old price.',
                'refurnished_sale_price.lte' => 'Refurbished Sale price must be less than or equal to the old Refurbished price.',
                // 'images.0.required' => 'The Image field is required',
                'description.required' => 'The Description field is required',
                'feature_image.required' => 'The Feature Image field is required',
                'brand_id.required' => 'The Brand field is required',
                'menu_id.required' => 'The Menu field is required',
                'category_id.required' => 'The Category field is required',
                'subcategory_id.required' => 'The Sub Category field is required',
            ]

        );

        // dd($request->all());
        // $p = Product::findOrFail($id);

        if ($request->hasFile('feature_image')) {
            $image = $request->file('feature_image');
            $imageName = uniqid() . '.' . $image->extension();
            $image->move('upload/products', $imageName);
        }

        $productData = $request->all();

        if ($request->hasFile('feature_image')) {
            $productData['url'] = asset('upload/products/' . $imageName);
            $productData['feature_image'] = $imageName;
        }

        $p = Product::create($productData);


        // $p = Product::create($request->all());

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

        if (isset($request->colors)) {
            if (count($request->colors) > 0) {
                ProductColors::where('pro_id', $id)->delete();

                for ($i = 0; $i < count($request->colors); $i++) {
                    $ProductColors = new ProductColors();
                    $ProductColors->pro_id = $p->id;
                    $ProductColors->color_id = $request->colors[$i];
                    $ProductColors->save();
                }
            }
        }

        // if (count($request->images) > 0) {
        //     for ($i = 0; $i < count($request->images); $i++) {
        //         $pImages = new ProductImages();
        //         $pImages->pro_id = $p->id;
        //         $pImages->image = $request->images[$i];
        //         $pImages->url = 'root/upload/products/'.$request->images[$i];
        //         $pImages->save();
        //     }
        // }
        if ($request->hasFile('images')) {
            if (count($request->images) > 0) {
                for ($i = 0; $i < count($request->images); $i++) {
                    $pImages = new ProductImages();
                    $pImages->pro_id = $p->id;
                    $uploadedImage = $request->images[$i];
                    $imageName = uniqid() . '_' . $uploadedImage->getClientOriginalName();
                    $uploadedImage->move('upload/products', $imageName);

                    $pImages->image = $imageName;
                    $pImages->url =  url('upload/products/' . $imageName);
                    $pImages->save();
                }
            }
        }

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move('upload/products/attachments', $fileName);
            $p->attachment = $fileName;
            $p->save();
        }

        Toastr::success('Product Duplicated Successfully!', 'Success');
        return redirect()->back();
        // return redirect()->back()->with(Toastr::success('Product Duplicated Successfully!','success'));

    }


    public function destroy($id)
    {
        $pro = Product::findOrFail($id);

        File::delete('upload/products/attachments/' . $pro->attachment);
        $pro->delete();

        ProductConditions::where('pro_id', $id)->delete();
        $pImages = ProductImages::where('pro_id', $id)->get();
        foreach ($pImages as $value) {
            File::delete('upload/products/' . $value->image);
        }
        ProductImages::where('pro_id', $id)->delete();
        ProductLocations::where('pro_id', $id)->delete();
        ProductSizes::where('pro_id', $id)->delete();
        ProductShippment::where('pro_id', $id)->delete();

        // Toastr::success('Product Deleted successfully', 'Success');
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
        File::delete('upload/products/' . $request->path);

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

        $image->move('upload/products/attachments', $new_name);
        return response()->json([
            'message'   => 'Image Upload Successfully'
        ]);
    }

    public function ProductsContacts(Request $request)
    {
        if (Auth::User()->role == 'Admin') {
            $productContacts = array();
            if ($request->from_date != null && $request->to_date != null) {
                $productContacts = ProductContact::whereDate('created_at', '>=', $request->from_date)
                    ->whereDate('created_at', '<=', $request->to_date)
                    ->orderBy('id', 'desc')->get();
            }
            return view('products.contacts', compact('productContacts'));
        } else if (Auth::User()->role == 'Vendor') {
            $productContacts = ProductContact::where('vendor_id', Auth::User()->id)->orderBy('id', 'desc')->get();
            return view('products.vendor_contacts', compact('productContacts'));
        }
    }

    public function getProductChartData()
    {
        $productCounts = Product::groupBy('category_id')
            ->selectRaw('count(*) as total_count, category_id')
            ->pluck('total_count', 'category_id');

        // Get the category names for the chart labels
        $categories = Category::whereIn('id', $productCounts->keys())->pluck('name');

        $data = [
            'categories' => $categories,
            'productCounts' => array_values($productCounts->toArray()),
        ];

        return response()->json($data);
    }
}
