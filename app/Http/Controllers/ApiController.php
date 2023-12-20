<?php

namespace App\Http\Controllers;

use App\Models\Banners;
use App\Models\Brand;
use App\Models\Category;
use App\Models\HomeSettings;
use App\Models\Menu;
use App\Models\FAQ;
use App\Models\Page;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductContact;
use App\Models\Settings;
use App\Models\Coupon;
use App\Models\FAQCategory;
use App\Models\Purchase;
use App\Models\SubCategory;
use App\Models\vendorProfile;
use App\Models\TermsConditions;
use App\Models\HelpCenter;
use App\Models\User;
use App\Models\Blogs;
use App\Models\Cfeatures;
use App\Models\BlogsCategories;
use App\Models\BlogsSubCategories;

use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;



class ApiController extends Controller
{
    public function stock_values($id)
    {
        $stock = Purchase::where('product_id', $id)->first('quantity');
        return $stock;
    }

    private function product_with_stock($p_with_stock)
    {
        $p_with_stock_items = is_array($p_with_stock) ? $p_with_stock : [$p_with_stock];

        foreach ($p_with_stock_items as $p_with_stock_item) {
            $product = Product::with('product_images', 'colors', 'brand')->find($p_with_stock_item);
            $stock = $this->stock_values($p_with_stock_item);
            $product->stock = $stock;
            $with_stock = $product;
        }
        return $with_stock;
    }
    public function menus()
    {
        $menus = Menu::select('id', 'name', 'icon', 'image', 'imageforapp')->orderBy('id')->get();
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

    public function subCategories123($id)
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

    public function Home_Banners()
    {
        $homeBanners =  Banners::all();
        return Response::json(['data' => $homeBanners]);
    }

    public function Site_Profile()
    {
        $Site_Profile =  Settings::all();
        return Response::json(['data' => $Site_Profile]);
    }

    public function Brands()
    {
        $Brands =  Brand::where('type', '=', 'brand')->select('id', 'brand_name', 'logo')->get();
        return Response::json(['data' => $Brands]);
    }

    public function homepage()
    {
        $menus = Menu::all();
        $categories = Category::all();
        $sub_categories = SubCategory::all();
        $products = Product::with('product_images')->with('colors')->with('brand')->get();
        $banners = Banners::all();
        $brands = Brand::all();
        $settings = Settings::all();
        $homesettings = HomeSettings::all();
        $coupons = Coupon::all();
        $terms_and_conditions = TermsConditions::all();
        $help_center = HelpCenter::all();
        $payment_method = PaymentMethod::all();

        $data = [];

        $data['brands'] = $brands->toArray();
        $data['banners'] = $banners->toArray();
        $data['Homesetting'] = $homesettings->toArray();
        $data['coupons'] = $coupons->toArray();
        $data['terms_and_conditions'] = $terms_and_conditions->toArray();
        $data['help_center'] = $help_center->toArray();
        $data['payment_method'] = $payment_method->toArray();


        foreach ($menus as $menu) {
            $menuNameWords = explode(' ', $menu->name);
            $menuName = $menuNameWords[0] ?? $menu->name;


            $menuData = [
                'menu_name' => $menu->name,
                'categories' => [],
            ];


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

                                        // Retrieve product images and add them to the product data
                                        $productImages = $product->product_images->toArray();
                                        $productData['product_images'] = $productImages;

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
    }

    public function storeOrder(Request $request)
    {
        // Extract customer information
        $customerInfo = $request->json('customer_info', []);

        $customerData = [
            'first_name' => $customerInfo['first_name'] ?? null,
            'last_name' => $customerInfo['last_name'] ?? null,
            'company' => $customerInfo['company'] ?? null,
            'country' => $customerInfo['country'] ?? null,
            'address_01' => $customerInfo['address_01'] ?? null,
            'address_02' => $customerInfo['address_02'] ?? null,
            'city' => $customerInfo['city'] ?? null,
            'state' => $customerInfo['state'] ?? null,
            'postal_code' => $customerInfo['postal_code'] ?? null,
            'phone1' => $customerInfo['phone1'] ?? null,
            'phone2' => $customerInfo['phone2'] ?? null,
            'email' => $customerInfo['email'] ?? null,
            'comments' => $customerInfo['comments'] ?? null,
            'payment_method' => $customerInfo['payment_method'] ?? null,
            'status' => $customerInfo['status'] ?? null,
            'shipping' => $customerInfo['shipping'] ?? null,
            'customer_id' => $customerInfo['customer_id'] ?? null,
            'o_vendor_id' => $customerInfo['o_vendor_id'] ?? null,
            'discount' => $customerInfo['discount'] ?? null,
            'total_price' => $customerInfo['total_price'] ?? null,
            'date' => Carbon::now(), // Set the current date and time
        ];

        // Create the order with customer information
        $order = Order::create($customerData);

        // Retrieve product details from the request
        $products = $request->json('products', []);

        // Loop through the products and create order details
        foreach ($products as $product) {
            $orderDetail = new OrderDetail([
                'product_id' => $product['product_id'],
                'quantity' => $product['quantity'],
                'p_vendor_id' => $product['p_vendor_id'],
                'p_price' => $product['p_price'],
            ]);
            // Save the order detail and associate it with the order
            $order->orderDetails()->save($orderDetail);

            // Handle stock related to the product
            $p_id = $orderDetail->product_id;
            $p_stock = Purchase::where('product_id', $p_id)->first();
            $p_stock->quantity -= $orderDetail->quantity;
            $p_stock->save();
        }

        // Return a JSON response indicating success
        return response()->json(['order_id' => $order->id, 'message' => 'Order created successfully'], 201);
    }


    public function getUserOrders($userId)
    {

        // $orders = Order::where('customer_id', $userId)->with('orderDetails')->get();

        $orders = Order::where('customer_id', $userId)
            ->with(['orderDetails.product:id,name,model_no,url'])
            ->get();


        return response()->json(['orders' => $orders]);
    }

    public function vendorprofile($id)

    {
        try {

        $vendors = vendorProfile::with('user')->where('vendor_id', '=', $id)->first();

        return response()->json(['vendors' => $vendors]);
        }catch (\Exception $e) {
            return response()->json(['error' => ' not found '], 404);
        }
    }

    public function vendorcoupon($id)
    {
        try {

        $vendorcoupon = Coupon::where('vendor_id', '=', $id)->get();

        return response()->json(['vendorcoupon' => $vendorcoupon]);
    }catch (\Exception $e) {
        return response()->json(['error' => ' not found '], 404);
    }
    }

    public function FAQs()
    {
        $faq = FAQCategory::with('faqs')->get();
        return response()->json($faq);
    }

    public function Pages()
    {
        $page = Page::select('question as title', 'answer as details')->get();
        return response()->json($page);
    }

    public function allProducts($identifier)
    {
        try {
            $cat = is_numeric($identifier)
                ? Category::findOrFail($identifier)
                : Category::where('slug', $identifier)->firstOrFail();

            $products = Product::with('product_image', 'subcategories', 'colors', 'brand')
                ->where('category_id', $cat->id)
                ->get()
                ->map(function ($product) {
                    $product->stock = $this->stock_values($product->id);
                    return $product;
                });

            return response()->json([
                'category' => $cat,
                'products' => $products,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Record not found
            return response()->json(['error' => 'Record not found.'], 404);
        } catch (\Exception $e) {
            // Handle other exceptions
            return response()->json(['error' => 'Internal Server Error.'], 500);
        }
    }

    public function allProductAMenu($identifier)
    {
        try {
            $menu = is_numeric($identifier)
                ? Menu::findOrFail($identifier)
                : Menu::where('slug', $identifier)->firstOrFail();

            $products_without_stock = Product::with('product_image', 'subcategories', 'colors', 'brand')
                ->where('menu_id', $menu->id)
                ->get();

            $products = [];
            foreach ($products_without_stock as $product) {
                $p_with_stock = $product->id;
                $products_stock = $this->product_with_stock($p_with_stock);
                $products[] = $products_stock;
            }

            return response()->json([
                'menu' => $menu,
                'products' => $products,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Record not found
            return response()->json(['error' => 'Record not found.'], 404);
        }
    }


    public function allProductSubcategories($id)
    {
        try {
            $sub_cat = is_numeric($id) ? SubCategory::findOrFail($id) : SubCategory::where('slug', $id)->firstOrFail();

            $products_without_stock = Product::with('product_image', 'subcategories', 'colors')
                ->where('subcategory_id', $sub_cat->id)
                ->get();

            $products = $products_without_stock->map(function ($product) {
                $p_with_stock = $product->id;
                return $this->product_with_stock($p_with_stock);
            });

            return response()->json([
                'sub_cat' => $sub_cat,
                'products' => $products,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Record not found
            return response()->json(['error' => 'Record not found.'], 404);
        }
    }



    public function SearchProduct($character)
    {
        try {
            $products = Product::with('product_images', 'colors', 'brand')
                ->where(function ($query) use ($character) {
                    $query->where('name', 'like', '%' . $character . '%')
                        ->orWhere('model_no', 'like', '%' . $character . '%')
                        ->orWhere('slug', 'like', '%' . $character . '%')
                        ->orWhere('sku', 'like', '%' . $character . '%');
                })
                ->orderBy('name')
                ->get()
                ->map(function ($product) {
                    $product->stock = $this->stock_values($product->id);
                    return $product;
                });

            return response()->json(['product' => $products]);
        } catch (\Exception $e) {
            // Handle the exception
            return response()->json(['error' => 'Internal Server Error.'], 500);
        }
    }

    public function FeaturesProduct()
    {
        try {
            $products = Product::with('product_images', 'colors', 'brand')
                ->orderBy('name')
                ->take(15)
                ->get();

            $formattedProducts = $products->map(function ($product) {
                $p_with_stock = $product->id;
                return $this->product_with_stock($p_with_stock);
            });

            return response()->json(['FeaturesProduct' => $formattedProducts]);
        } catch (\Exception $e) {
            // Handle the exception
            return response()->json(['error' => 'not found.'], 400);
        }
    }

    public function SponserdProduct()
    {
        try {
            $coupons = Coupon::where('status', 'active')->get();
            $products = Product::with('product_images', 'colors', 'brand')
                ->orderBy('id')
                ->take(15)
                ->get();

            $formattedProducts = $products->map(function ($product) {
                $p_with_stock = $product->id;
                return $this->product_with_stock($p_with_stock);
            });

            return response()->json(['SponserdProduct' => $formattedProducts, 'Coupons' => $coupons]);
        } catch (\Exception $e) {
            // Handle the exception
            return response()->json(['error' => 'internel server error.'], 500);
        }
    }


    public function HotProduct()
    {
        try {
            $products = Product::with('product_images', 'colors', 'brand')
                ->orderBy('model_no')
                ->take(30)
                ->get();

            $formattedProducts = $products->map(function ($product) {
                $p_with_stock = $product->id;
                return $this->product_with_stock($p_with_stock);
            });

            return response()->json(['HotProduct' => $formattedProducts]);
        } catch (\Exception $e) {
            // Handle the exception
            return response()->json(['error' => 'not found.'], 400);
        }
    }

    public function DealProduct()
    {
        try {
            $coupons = Coupon::where('status', 'active')->get();
            $products = Product::with('product_images', 'colors', 'brand')
                ->orderBy('model_no', 'desc')
                ->take(10)
                ->get();

            $formattedProducts = $products->map(function ($product) {
                $p_with_stock = $product->id;
                return $this->product_with_stock($p_with_stock);
            });

            return response()->json(['DealProduct' => $formattedProducts, 'Coupons' => $coupons]);
        } catch (\Exception $e) {
            // Handle the exception
            return response()->json(['error' => 'not found.'], 400);
        }
    }

    public function homePageAll()
    {
        try {
            $menus = Menu::all();
            $categories = Category::all();
            $sub_categories = SubCategory::all();
            $banners = Banners::select('id', 'title1', 'url', 'image')->orderBy('id')->get();
            $homesettings = HomeSettings::first();

            $menuData = [];

            foreach ($menus as $menu) {
                $menuNameWords = explode(' ', $menu->name);
                $menuName = $menuNameWords[0] ?? $menu->name;

                $menuData[] = [
                    'id' => $menu->id,
                    'menu_name' => $menu->name,
                    'slug' => $menu->slug,
                    'icon' => $menu->icon,
                    'image' => $menu->image,
                    'imageforapp' => $menu->imageforapp,
                    'sliders' => $menu->sliders,
                    'categories' => [],
                ];

                foreach ($categories as $category) {
                    if ($category->menu_id == $menu->id) {
                        $categoryData = $category->toArray();
                        $categoryData['sub_categories'] = [];

                        foreach ($sub_categories as $sub_category) {
                            if ($sub_category->category_id == $category->id) {
                                $subCategoryData = $sub_category->toArray();

                                $categoryData['sub_categories'][] = $subCategoryData;
                            }
                        }

                        $menuData[count($menuData) - 1]['categories'][] = $categoryData;
                    }
                }
            }

            if ($homesettings) {
                $categories_info = [];

                $categoryKeys = [
                    'category1',
                    'category2',
                    'category3',
                    'category4',
                ];

                foreach ($categoryKeys as $categoryKey) {
                    $categoryId = $homesettings->$categoryKey;
                    $subCategories = SubCategory::where('category_id', $categoryId)->take(4)->get();

                    $categories_info[$categoryKey] = [
                        'category' => $categoryId,
                        'subcategories' => $subCategories,
                    ];
                }
            } else {
                throw new \Exception('Home setting is empty');
            }

            $data['menus'] = $menuData;
            $data['banners'] = $banners->toArray();
            $data['Homesetting'] = $homesettings->toArray();
            $data['home_settings'] = $categories_info;

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getBlogs()
    {
        $blogs = Blogs::with('blogCategory', 'blogSubCategory')->get();
        return response()->json($blogs);
    }

    public function getBlog($id)
    {
        $blog = Blogs::with('blogCategory', 'blogSubCategory')->find($id);

        if (!$blog) {
            return response()->json(['error' => 'Blog not found'], 404);
        }

        return response()->json($blog);
    }

    public function cfeatures()
    {
        $cfeatures = Cfeatures::all();
        return response()->json($cfeatures, 200);
    }
    public function GetSingleProduct($id)
    {
        try {
            $products_without_stock  = Product::where('id', $id)->with('product_image', 'brand', 'colors')->first();
            $p_with_stock = $products_without_stock->id;
            $products_stock = $this->product_with_stock($p_with_stock);
            $product = $products_stock;


            return response()->json($product);
        } catch (\Exception $e) {
            return response()->json(['error' => 'product not found'], 404);
        }
    }
}
