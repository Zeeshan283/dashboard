<?php

namespace App\Http\Controllers;

use App\Models\Banners;
use App\Models\Brand;
use App\Models\Category;
use App\Models\HomeSettings;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductContact;
use App\Models\Settings;
use App\Models\Coupon;
use App\Models\Purchase;
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
        $products = Product::with('product_image')->with('colors')->with('brand')->orderBy('id')->get();
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

    public function Home_setting()
    {
        $HomeSettings = HomeSettings::with([
            'category1Info', 
            'category2Info', 
            'category3Info', 
            'category4Info', 
        ])->get();
        // dd($HomeSettings);
        return Response::json(['data' => $HomeSettings]);
    }

    public function Home_Banners(){
        $homeBanners =  Banners::all();
        return Response::json(['data'=> $homeBanners]);
    }

    public function Site_Profile()
    {
        $Site_Profile =  Settings::all();
        return Response::json(['data' => $Site_Profile]);
    }

    public function Brands()
    {
        $Brands =  Brand::where('type','=','brand')->select('id','brand_name','logo')->get();
        return Response::json(['data' => $Brands]);
    }

    public function homepage()
    {
        $menus = Menu::all();
        $categories = Category::all();
        $sub_categories = SubCategory::all();
        $products = Product::with('product_image')->with('colors')->with('brand')->get();
        $banners = Banners::all();
        $brands = Brand::all();
        $settings = Settings::all();
        $homesettings = HomeSettings::all();
        $coupons = Coupon::all();

        $data = [];

        $data['brands'] = $brands->toArray();
        $data['banners'] = $banners->toArray();
        $data['Homesetting'] = $homesettings->toArray();
        $data['coupons'] = $coupons->toArray();


        foreach ($menus as $menu) {
            $menuNameWords = explode(' ', $menu->name);
            $menuName = $menuNameWords[0] ?? $menu->name;
    
            
            $menuData = [
                'menu_name' => $menu->name,
                'categories' => [],
            ];
    
    
            foreach ($categories as $category) {
                if ($category->menu_id == $menu->id) {
                    $categoryData = $category->toArray();
                    $categoryData['sub_categories'] = [];
    
                    foreach ($sub_categories as $sub_category) {
                        if ($sub_category->category_id == $category->id) {
                            $subCategoryData = $sub_category->toArray();
                            $subCategoryData['products'] = [];
    
                            foreach ($products as $product) {
                                if ($product->subcategory_id == $sub_category->id) {
                                    $productData = $product->toArray();
    
                                    // Add stock information to the product data
                                    $productData['stock'] = $product->purchases->sum('quantity');
    
                                    $subCategoryData['products'][] = $productData;
                                }
                            }
    
                            $categoryData['sub_categories'][] = $subCategoryData;
                        }
                    }
    
                    $menuData['categories'][] = $categoryData;
                }
            }
    
            // Use the first word from the menu name as the key for categories
            $data['menus'][$menuName] = $menuData;
        }
    
        $data['setting'] = $settings->toArray();
    
        return response()->json($data);
    }

    public function storeOrder(Request $request)
	{
        
		$order = new Order();
		$order->date = now(); // Use the current date and time
		$order->first_name = $request->input('first_name');
		$order->last_name = $request->input('last_name');
		$order->company = $request->input('company');
		$order->country = $request->input('country');
		$order->address_01 = $request->input('address_01');
		$order->address_02 = $request->input('address_02');
		$order->city = $request->input('city');
		$order->state = $request->input('state');
		$order->postal_code = $request->input('postal_code');
		$order->phone1 = $request->input('phone1');
		$order->phone2 = $request->input('phone2');
		$order->email = $request->input('email');
		$order->comments = $request->input('comments');
		$order->payment_method = $request->input('payment_method');
		$order->status = $request->input('status');
		$order->shipping = $request->input('shipping');
		$order->customer_id = $request->input('customer_id');
        $order->o_vendor_id = $request->input('o_vendor_id');
        
		$order->save();

        $orderID = $order->id;

		// Retrieve product details from the form
		$productIds = $request->input('product_ids');
		$quantities = $request->input('quantities');
		$pVendorIds = $request->input('p_vendor_ids'); // Assuming this is the product vendor ID
        $p_price = $request->input('p_price');
	
		// Store product details in the orderdetails table

        if (!is_array($productIds)) {
            // If there's only one product, convert it to an array for consistency.
            $productIds = [$productIds];
            $quantities = [$quantities];
            $pVendorIds = [$pVendorIds];
            $p_price = [$p_price];

        }


		foreach ($productIds as $index => $productId) {
            
			$orderDetail = new OrderDetail();
			$orderDetail->order_id = $orderID;
			$orderDetail->product_id = $productId;
			$orderDetail->quantity = $quantities[$index];
			$orderDetail->p_vendor_id = $pVendorIds[$index];
			$orderDetail->p_price = $p_price[$index];
            
            // handling stock related to product 

            $p_id = $orderDetail->product_id;
            $p_stock = Purchase::where('product_id', $p_id)->first();
            $p_stock->quantity = $p_stock->quantity - $orderDetail->quantity ;
            $p_stock->update();


			$orderDetail->save();
		}

		return Response::json(['data' => 'Thanks for contacting us! We will get in touch with you shortly.', 'status' => '200']);
	}


}
