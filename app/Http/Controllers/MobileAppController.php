<?php

namespace App\Http\Controllers;

use App\Models\Banners;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Locations;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\HomeSettings;
use App\Models\OrderTracker;
use App\Models\ProductContact;
use App\Models\Reviews;
use App\Models\Settings;
use Illuminate\Support\Facades\Auth;
use Cart;
use App\Models\Stock;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class MobileAppController extends Controller
{
    public function GetAllMenus()
    {
        $menus = Menu::with([
            'categories' => function ($query) {
                $query->with(['subcategories' => function ($query1) {
                    $query1->with(['products' => function ($query2) {
                        $query2->with('product_image')
                            ->with('product_images')
                            ->with('brand')
                            ->with('locations')
                            ->with('conditions');
                    }]);
                }]);
            },
        ])
            ->OrderBy('id', 'asc')
            ->get();
        return json_encode($menus);
    }

    public function GetAllBanners()
    {
        $banners = Banners::orderBy('id')->get();
        return json_encode($banners);
    }

    public function Menus()
    {
        $menus = Menu::select('id', 'name', 'image', 'imageforapp')->orderBy('id')->get();
        return json_encode($menus);
    }

    public function SpecificCategories($menuid)
    {
        $menu = Menu::find($menuid);
        if ($menu) {
            $categories = Category::select('id', 'name', 'img', 'imageforapp')->where('menu_id', $menuid)->get();
            return response()->json(['data' => $categories, 'status' => '200']);
        } else {
            return response()->json(['data' => '', 'status' => '200']);
        }
    }

    public function SpecificSubCategories($category_id)
    {
        $category = Category::find($category_id);
        if ($category) {
            $subcategories = SubCategory::select('id', 'name'/*'image','imageforapp'*/)->where('category_id', $category_id)->get();
            return response()->json(['data' => $subcategories, 'status' => '200']);
        } else {
            return response()->json(['data' => '', 'status' => '200']);
        }
    }

    public function Products()
    {
        $products = Product::with('product_image')->orderBy('id')->get();
        return json_encode($products);
    }

    public function GetSubcategoryProducts($subcategory_id)
    {
        $sub = SubCategory::where('id', $subcategory_id)->first();
        if ($sub) {
            $products = Product::with('product_image')->with('subcategories')
                ->select('id', 'name', 'model_no', 'new_price', 'new_sale_price', 'description')
                ->where('subcategory_id', $subcategory_id)
                ->where('type', 'Parent')
                ->get();


            $minPrice = Product::where('subcategory_id', $subcategory_id)->where('type', 'Parent')->min('new_sale_price');
            $maxPrice = Product::where('subcategory_id', $subcategory_id)->where('type', 'Parent')->max('new_sale_price');


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

            $singleProduct = Product::with(['product_locations' => function ($query) {
                $query->with(['location2' => function ($query2) {
                    $query2->select(['id', 'name']);
                }]);
            }])
                ->with('conditions')
                ->with('product_images')
                ->with('shipping_details')
                ->with('stock')
                ->where('id', $id)
                ->first([
                    'id', 'name', 'model_no', 'description',
                    'new_price', 'new_sale_price', 'details', 'subcategory_id',
                    'make', 'created_by as vendor_id', 'attachment', 'slug'
                ]);

            $locations = Locations::select('name', 'address', 'email')->get();
            $disclaimer = Settings::select('disclaimer')->first();


            return response()->json(['data' => $singleProduct, 'brand' => $brand, 'office_locations' => $locations, 'disclaimer' => $disclaimer, 'status' => '200']);
        } else {
            return response()->json(['data' => '', 'status' => '200']);
        }
    }

    public function GetRelatedProducts(Request $request, $subcategory_id, $product_id)
    {
        if ($request->isMethod('get')) {
            $relatedProducts = Product::with('product_image')
                ->select('id', 'name', 'model_no', 'new_price', 'new_sale_price', 'description')
                ->where('subcategory_id', $subcategory_id)
                ->where('type', 'Parent')
                ->where('id', '!=', $product_id)
                ->get([
                    'id', 'name', 'model_no', 'description',
                    'new_price', 'new_sale_price', 'details', 'subcategory_id'
                ]);

            return Response::json(['data' => $relatedProducts, 'status' => '200']);
        } else {
            return Response::json(['data' => 'Bad Method Call', 'status' => '200']);
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
                'model_no' => 'required|max:255|min:1',
                'brand_name' => 'required|max:255|min:1',
                'moq' => 'required|max:255|min:1',
                'delivery_location' => 'required|max:255|min:1',
                'company' => 'required|max:255|min:1',
                'address' => 'required|max:255|min:1',
                'phoneno' => 'required|max:255|min:1',
                'vendor_id' => 'required'
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
                'vendor_id.required' => 'The Vendor field is required'
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

    public function OrderSubmit(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'country' => 'required|string',
                'address_01' => 'required|string',
                'address_02' => 'required|string',
                'city' => 'required|string',
                'state' => 'required|string',
                'postal_code' => 'required|string',
                'phone1' => 'required|string',
                'phone2' => 'required|string',
                'email' => 'required|string|email',
                'customer_id' => 'required|numeric',
                'products.0.id' => 'required|exists:products,id|numeric',
                'products.0.name' => 'required|string',
                'products.0.slug' => 'required|string',
                'products.0.quantity' => 'required|numeric|min:1',
                'products.0.amount_new' => 'required|numeric',
                'products.0.amount_old' => 'required|numeric',
                'products.0.image' => 'required|string',
                'products.0.conditiontype' => 'required|string',
                'products.0.shipping_charges' => 'required|numeric',
                'products.0.locatedin' => 'required|string',
                'products.0.import_charges' => 'required|numeric',
                'products.0.tax_charges' => 'required|numeric',
                'products.0.other_charges' => 'required|numeric',
                'products.0.shipping_days' => 'required|numeric',
                'products.0.brand_id' => 'required|numeric',
                'products.0.brand_logo' => 'required|string',
                'products.0.vendor_id' => 'required|numeric'
            ], [
                'products.0.id.required' => 'The products object is required.',
                'products.0.name.required' => 'The product name is required.',
                'products.0.slug.required' => 'The product slug is required.',
                'products.0.quantity.required' => 'The product quantity is required.',
                'products.0.amount_new.required' => 'The product amount new is required.',
                'products.0.amount_old.required' => 'The product amount old is required.',
                'products.0.image.required' => 'The product image is required.',
                'products.0.conditiontype.required' => 'The product condition type is required.',
                'products.0.shipping_charges.required' => 'The product shipping charges is required.',
                'products.0.locatedin.required' => 'The product location field is required.',
                'products.0.import_charges.required' => 'The product import charges field is required.',
                'products.0.tax_charges.required' => 'The product tax charges field is required.',
                'products.0.other_charges.required' => 'The product other charges field is required.',
                'products.0.shipping_days.required' => 'The product shipping days field is required.',
                'products.0.brand_id.required' => 'The product brand id field is required.',
                'products.0.brand_logo.required' => 'The product brand logo field is required.',
                'products.0.vendor_id.required' => 'The product vendor id field is required.',
            ]);

            if ($validator->fails()) {
                return Response::json(['error' => $validator->errors()], 401);
            }


            $order = Order::create($request->all());
            $order->date = date('Y-m-d');
            $order->status = 'In Process';
            $order->payment_method = 'CASH IN HAND';
            $order->shipping = date('Y-m-d', strtotime(date('Y-m-d') . ' + 7 day'));
            $order->customer_id = $request->customer_id;
            $order->save();

            $codes = 1;
            $code = Stock::where('type', '=',  'ORDER')->orderBy('bill_no', 'desc')->first();
            if (isset($code) > 0) {
                $codes = (int)$code->bill_no + 1;
            }

            $orderDetailsArray = array();
            foreach ($request->products as $value) {
                $orderDetails = new OrderDetails();
                $orderDetails->order_id = $order->id;
                $orderDetails->product_id = $value['id'];
                $orderDetails->product_name = $value['name'];
                $orderDetails->slug = $value['slug'];
                $orderDetails->customer_id = $request->customer_id;
                $orderDetails->quantity = $value['quantity'];
                $orderDetails->price = $value['amount_new'];
                $orderDetails->total = $value['amount_new'] * $value['quantity'];
                $orderDetails->image = $value['image'];
                $orderDetails->amount_old = $value['amount_old'];
                $orderDetails->amount_new = $value['amount_new'];
                $orderDetails->conditionType = $value['conditiontype'];
                $orderDetails->ship_charges = $value['shipping_charges'];
                $orderDetails->locatedin = $value['locatedin'];
                $orderDetails->imp_charges = $value['import_charges'];
                $orderDetails->t_charges = $value['tax_charges'];
                $orderDetails->oth_charges = $value['other_charges'];
                $orderDetails->ship_days = $value['shipping_days'];
                $orderDetails->brand_id = $value['brand_id'];
                $orderDetails->brand_logo = $value['brand_logo'];
                $orderDetails->vendor_id = $value['vendor_id'];
                $orderDetails->save();

                $stock = new Stock();
                $stock->date = date('Y-m-d');
                $stock->bill_no = $codes;
                $stock->pro_id = $value['id'];
                $stock->unit_id = 2;
                $stock->cost = $value['amount_new'];
                $stock->total = $value['amount_new'] * $value['quantity'];
                $stock->type = 'SALE';
                $stock->qty_out = $value['quantity'];
                $stock->biller_id = $value['vendor_id'];
                $stock->save();

                $orderDetailsArray[] = $orderDetails;
            }

            $orderTracker = new OrderTracker();
            $orderTracker->order_id = $order->id;
            $orderTracker->datetime = date('Y-m-d h:i:s');
            $orderTracker->status = 'In Process';
            $orderTracker->country = 'Pakistan';
            $orderTracker->icon = 'fa fa-certificate';
            $orderTracker->save();


            return Response::json(['message' => 'Order Submitted Successfully', 'status' => '201', 'order' => $order, 'order_details' => $orderDetailsArray]);
        } else {
            return Response::json(['message' => 'Bad Method Call', 'status' => '200']);
        }
    }

    public function GetProductReviews($pro_id)
    {
        $reviews = Reviews::where('product_id', $pro_id)->first();
        if ($reviews) {
            $reviews = Reviews::select('customer_name', 'review', 'rating', 'created_at')->where('product_id', $pro_id)->get();
            $avg_rating = Reviews::where('product_id', $pro_id)->avg('rating');
            $per_rating = number_format((($avg_rating / 5) * 100), 2);
            return Response::json(['data' => $reviews, 'avg_rating' => $avg_rating, 'per_rating' => $per_rating, 'status' => '200']);
        } else {
            return Response::json(['data' => 'Incorrect Product Information', 'status' => '200']);
        }
    }

    public function AddProductReview(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'product_id' => 'required',
                'customer_name' => 'required',
                'review' => 'required',
                'customer_email' => 'required',
                'rating' => 'required'
            ], [
                'product_id.required' => 'The product field is required',
            ]);

            if ($validator->fails()) {
                return Response::json(['error' => $validator->errors()], 401);
            }
            $r = Reviews::create($request->all());
            $r->status = 0;
            $r->save();

            return Response::json(['data' => 'Review Added Successfully', 'status' => '200']);
        } else {
            return Response::json(['data' => 'Bad Method Call', 'status' => '200']);
        }
    }

    public function GetOrders($customer_id)
    {
        $orders = Order::select('id', 'date as order_date', 'shipping as shipping_date', 'status', 'payment_method')
            ->with('customer_orders:id,order_id,quantity,total')
            ->where('customer_id', 16)
            ->where('id', 36)
            ->get();

        return Response::json(['data' => $orders]);
    }

    public function GetOrdersDetails($order_id)
    {
        $order = Order::find($order_id);
        if ($order) {
            $orderDetails = OrderDetails::join('products', 'products.id', '=', 'order_details.product_id')
                ->join('product_images', 'product_images.pro_id', '=', 'products.id')
                ->select(
                    'products.name',
                    'products.description',
                    'products.model_no',
                    'order_details.quantity',
                    'order_details.price',
                    'order_details.total',
                    'product_images.image'
                )
                ->get();



            return Response::json(['data' => $orderDetails]);
        } else {
            return Response::json(['data' => 'Data Not Found', 'status' => '200']);
        }
    }
    public function Home_setting()
    {
        $HomeSettings = HomeSettings::select('id', 'center_image1', 'center_image2')->first();
        return Response::json(['data' => $HomeSettings]);
    }

    public function SearchProduct($character)
    {
        $products = Product::with('menu:id,name,icon,image')
            ->with('subcategories:id,name')
            ->where('products.name', 'like', '%' . $character . '%')
            ->OrWhere('products.model_no', 'like', '%' . $character . '%')
            ->where('products.type', 'Parent')
            ->orderBy('name')
            ->get();
        $arr = array();
        foreach ($products as $product) {
            $arr[] = array(
                'product_id' => $product->id, 'name' => $product->name, 'model_no' => $product->model_no,
                'menu_id' => $product->menu_id, 'subcategory_id' => $product->subcategory_id
            );
        }

        return Response::json(['data' => $arr]);
    }
}