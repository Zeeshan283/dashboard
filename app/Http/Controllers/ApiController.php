<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Product;
use App\Models\ProductContact;
use App\Models\Settings;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class ApiController extends Controller
{
    //

    public function menus()
    {
        $menus = Menu::select('id', 'name', 'icon','image', 'imageforapp')->orderBy('id')->get();
        return json_encode($menus);
    }

    public function categories($id)
    {
        $menu = Menu::findOrFail($id);

        if ($menu) {
            $categories = Category::where('menu_id', $id)->get();
            return response()->json(['data' => $categories, 'status' => '200']);
        } else {
            return response()->json(['data' => 'Menu Not Found', 'status' => '200']);
        }
    }

    public function subCategories($id)
    {
        $category = Category::findOrFail($id);

        if ($category) {
            $sub_categories = SubCategory::where('category_id', $id)->get();
            return response()->json(['data' => $sub_categories, 'status' => '200']);
        } else {
            return response()->json(['data' => 'Category Not Found', 'status' => '200']);
        }
    }

    public function Products()
    {
        $products = Product::with('product_image')->with('colors')->orderBy('id')->get();
        return response()->json([$products]);
    }
    
    public function GetSubCategoryProduct($id)
    {
        $sub = SubCategory::where('id', $id)->first();
        if ($sub) {
            $products = Product::with('product_image')->with('subcategories')->with('colors')
                ->where('subcategory_id', $id)
                ->get();

            $minPrice = Product::where('subcategory_id', $id)->min('new_sale_price');
            $maxPrice = Product::where('subcategory_id', $id)->max('new_sale_price');

            return response()->json(['data' => $products, 'minPrice' => $minPrice, 'maxPrice' => $maxPrice, 'status' => '200']);
        } else {
            return response()->json(['data' => '', 'status' => '200']);
        }
    }

    public function GetSingleProduct($id)
    {
        $product = Product::whereId($id)->first();
        if ($product) {
            $brand = Brand::select('id', 'brand_name', 'logo')->whereid($product->brand_id)->first();

            $singleProduct = Product::with('colors')
                ->with('product_images')
                ->with('stock')
                ->where('id', $id)->get();

            $disclaimer = Settings::select('disclaimer')->first();


            return response()->json([
                'data' => $singleProduct,
                'brand' => $brand,
                'disclaimer' => $disclaimer,
                'status' => '200'
            ]);
        } else {
            return response()->json(['data' => 'Product Not Found', 'status' => '200']);
        }
    }

    public function ProductContactSendMessage(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'make' => 'required|max:255|min:1',
                'pro_id' => 'required|max:255|min:1',
                'pro_name' => 'required|max:255|min:1',
                'message' => 'required|max:400|min:1',
                'model_no' => 'max:255|min:1',
                'brand_name' => 'max:255|min:1',
                'moq' => 'max:255|min:1',
                'delivery_location' => 'max:255|min:1',
                'company' => 'max:255|min:1',
                'address' => 'required|max:255|min:1',
                'phoneno' => 'required|max:255|min:1',
                'vendor_id' => 'required',
                'email' => 'required',
            ], [
                'pro_id.required' => 'Something went wrong',
                'make.required' => 'Something went wrong',
                'pro_name.required' => 'The Product Name field is required',
                'message.required' => 'The Message field is required',
                'model_no.required' => 'The Model No field is required',
                'brand_name.required' => 'The Brand Name field is required',
                'moq.required' => 'The MOQ field is required',
                'delivery_location.required' => 'The Location field is required',
                'phoneno.required' => 'The Phone no field is required',
                'vendor_id.required' => 'The Vendor field is required',
                'email.required' => 'The Email field is required'
            ]);

            if ($validator->fails()) {
                return Response::json(['error' => $validator->errors()], 401);
            }

            $p = ProductContact::create($request->all());
            $p->vendor_id = $request->vendor_id;
            $p->save();

            return Response::json(['data' => 'Thanks for contacting us! We will get in touch with you shortly.', 'status' => '200']);
        } else {
            return Response::json(['data' => 'Bad Method Call', 'status' => '200']);
        }
    }

    public function SearchProduct($character)
    {
        $products = Product::where('products.name', 'like', '%' . $character . '%')
            ->OrWhere('products.model_no', 'like', '%' . $character . '%')
            ->orderBy('name')
            ->get();
        // $arr = array();
        // foreach ($products as $product) {
        //     $arr[] = array(
        //         'product_id' => $product->id, 'name' => $product->name, 'model_no' => $product->model_no,
        //     );
        // }

        return Response::json(['data' => $products]);
    }
}
