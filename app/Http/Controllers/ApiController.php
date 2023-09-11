<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Locations;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Settings;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    //
    
    public function menus(){
        $menus = Menu::select('id', 'name','image', 'imageforapp')->orderBy('id')->get();
        return json_encode($menus);
    }

    public function categories($id){
        $menu = Menu::findOrFail($id);
        
        if($menu){
        $categories = Category::where('menu_id',$id)->get();
        return response()->json(['data'=>$categories,'status' => '200']);
        }
        else{
        return response()->json(['data'=> 'Menu Not Found','status' => '200']);
        }
    }

    public function subCategories($id){
        $category = Category::findOrFail($id);
        
        if($category){
        $sub_categories = SubCategory::where('category_id',$id)->get();
        return response()->json(['data'=>$sub_categories,'status' => '200']);
        }
        else{
        return response()->json(['data'=> 'Category Not Found','status' => '200']);
        }
    }

    public function Products(){
        $products = Product::with('product_image')->with('colors')->orderBy('id')->get();
        return response()->json([$products]);
    }

    public function GetSubCategoryProduct($id){
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

    public function GetSingleProduct($id){
        $product = Product::whereId($id)->first();
        if ($product) {
            $brand = Brand::select('id', 'brand_name', 'logo')->whereid($product->brand_id)->first();

            $singleProduct = Product::with('colors')
                ->with('product_images')
                ->with('stock')
                ->where('id', $id)->get();

            $disclaimer = Settings::select('disclaimer')->first();


            return response()->json(['data' => $singleProduct,
                                    'brand' => $brand, 
                                    'disclaimer' => $disclaimer, 
                                    'status' => '200']);
            } else {
                return response()->json(['data' => 'Product Not Found', 'status' => '200']);
            }
    }

}
