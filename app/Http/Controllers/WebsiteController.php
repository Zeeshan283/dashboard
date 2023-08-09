<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use PDF;
use Cart;
use App\Models\FAQ2;
use App\Models\Menu;
use App\Models\User;
use App\Models\Blogs;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Stock;
use App\Models\Events;
use App\Models\Skills;
use App\Models\Banners;
use App\Models\Product;
use App\Models\Reviews;
use App\Models\Category;
use App\Models\Services;
use App\Models\Settings;
use App\Models\Wishlist;
use App\Models\ContactUs;
use App\Models\Locations;
use App\Models\Trainings;
use App\Models\Conditions;
use App\Models\Instructor;
use App\Models\SubCategory;
use App\Models\VendorAlbum;
use Illuminate\Support\Str;
use App\Models\BlogsSetting;
use App\Models\HomeSettings;
use App\Models\OrderDetails;
use App\Models\OrderTracker;
use App\Models\Testimonials;
use Illuminate\Http\Request;
use App\Models\FaqCategories;
use App\Models\ProductContact;
use App\Models\BlogsCategories;
use App\Models\BlogSubCategory;
use App\Models\EventCategories;
use App\Models\TermsConditions;
use App\Rules\MatchOldPassword;
use App\Models\SingleProductInfo;
use App\Models\TrainingCategories;
use Illuminate\Support\Facades\DB;
use App\Models\ReturnExchangePolicy;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class WebsiteController extends Controller
{
	public function __construct()
	{
		$ProductConditions = Conditions::pluck('name', 'id');
		View::share('ProductConditions', $ProductConditions);
	}
	public function searchProduct(Request $request)
	{
		if ($request->get('query')) {
			$query = $request->get('query');
			$products = Product::
			with('product_image')
				->where('type', 'Parent')
				->where('name', 'like', '%' . $query . '%')
				->OrWhere('model_no', 'like', '%' . $query . '%')
				->get();
			$output = '<ul class="dropdown-menu" style="display:block; position:relative;list-style-type: none;">';
			foreach ($products as $products) {
				$output .= '<a href="'.asset('single-product/'.$products->id."/".$products->slug.'').'"><li style=" width: 400px;height:53px;font-size:120%;"><img   src='.asset($products->product_image->url).' style="height:50px;width:50px;" > &emsp;&emsp;<b>' .$products->name. '&nbsp;&nbsp;&nbsp;</b>'.$products->model_no.'</li></a>';
			}
			$output .= '</ul>';
			echo $output;
		}
	}

	public function index()

	{
		//  $menus = Menu::with([
		// 	'categories' => function ($query) {
		// 		$query->with('subcategories');
		// 	},
		// ])->OrderBy('id', 'asc')->get();
		// return $menus[0]->categories[0]->img;
		
		// $products = Product::
		// 	with('product_image')
		// 		// ->where('type', 'Parent')
		// 		// ->where('name', 'like', '%' . $query . '%')
		// 		// ->OrWhere('model_no', 'like', '%' . $query . '%')
		// 		->get();
		// return $products;
		$brands = Brand::select('brand_name', 'logo', 'link')->whereType('brand')->orderBy('id')->get();
		$partners = Brand::select('brand_name', 'logo', 'link')->whereType('partner')->orderBy('id')->get();

		$homeSettings = HomeSettings::first();

		$category1 = Category::select('name')->whereId($homeSettings->category1)->first();
		$category2 = Category::select('name')->whereId($homeSettings->category2)->first();
		$category3 = Category::select('name')->whereId($homeSettings->category3)->first();
		$category4 = Category::select('name')->whereId($homeSettings->category4)->first();

		$SubcategoriesList1 = SubCategory::where('category_id', $homeSettings->category1)->take(5)->get();
		$SubcategoriesList2 = SubCategory::where('category_id', $homeSettings->category2)->take(5)->get();
		$SubcategoriesList3 = SubCategory::where('category_id', $homeSettings->category3)->take(5)->get();
		$SubcategoriesList4 = SubCategory::where('category_id', $homeSettings->category4)->take(5)->get();
		$relatedreviews = Reviews::where('status',1)->get();
		// $relatedreviews = [0,1];
	  	$products = Product::with('product_image')
			->with('categories:id,name')
			->with('subcategories:id,name,slug')
			->with('locations')
			->with('conditions')
			->with('brand:id,logo')
			->with('stock')
			->with(['shipping_details' => function ($query) {
				$query->with('location');
			}])->where('type', 'Parent')
			->orderBy('id','desc')

			// ->take(5)	
			->get();
		
	
        // // return $count;
		// 	$count = count($productss);
        // for ($i = $count; $i > ($count-5); $i--) {

		// 	$products = $productss->reverse()->slice(1)->reverse();
		

		// }
		// // return	1;
		// // return	$count = count($products);
		//  $products;
		$banners = Banners::OrderBy('id')->get();

		return view(
			'website.index',
			compact(
				'brands',
				'partners',
				'category1',
				'category2',
				'category3',
				'category4',
				'SubcategoriesList1',
				'SubcategoriesList2',
				'SubcategoriesList3',
				'SubcategoriesList4',
				'homeSettings',
				'products',
				'banners',
				'relatedreviews'
			)
		);
	}

	public function shop($id)
	{
		$total_items = Cart::getContent()->count();
		$products = Product::Where('subcategory_id', '=', $id)->get();
		$wishlist_items = 0;
		if (isset(Auth::User()->id)) {
			$wishlist_items = Wishlist::where('user_id', Auth::User()->id)->count();
		}
		return view('website-jewellery.shop', Compact('products', 'total_items', 'wishlist_items'));
	}

	public function ShopSubCatProductList(Request $request, $id, $slug)
	{
		// return $request->path();
		$subCategorySingle = SubCategory::whereId($id)->whereSlug($slug)->first(['id', 'name', 'category_id', 'slug']);

		if ($subCategorySingle) {
			$subCategoryList = SubCategory::where('category_id', $subCategorySingle->category_id)->get();
			$products = Product::with('product_image')
				->with('categories:id,name')
				->with('locations')
				->with('conditions')
				->with('brand:id,logo')
				->with('stock')
				->with(['shipping_details' => function ($query) {
					$query->with('location');
				}])->where('subcategory_id', $id)
				->where('type', 'Parent')
				->paginate(12);
				// return $products->product_image;
			$settings = Settings::first('currency');
			$brands = Brand::select('id', 'brand_name', 'logo', 'link')->whereType('brand')->orderBy('id')->get();
			$categoriesList = Category::with('subcategories')->get();
			$singleCategory = Category::findOrFail($subCategorySingle->category_id);

			$minPrice = Product::where('subcategory_id', $id)->where('type', 'Parent')->min('new_sale_price');
			$maxPrice = Product::where('subcategory_id', $id)->where('type', 'Parent')->max('new_sale_price');
			$relatedreviews = Reviews::where('status',1)->get();
				// return $singleCategory;
			return view('website.subcategories-product-list', compact('subCategorySingle', 'subCategoryList', 'products', 'settings', 'brands', 'categoriesList', 'singleCategory', 'minPrice', 'maxPrice','relatedreviews'));
		} else {
			abort(404);
		}
	}

	public function SingleProduct($id, $slug)
	{
		$product = Product::with(['conditions' => function ($query) {
			$query->with('condition');
		}])->with(['locations' => function ($query) {
			$query->with('location');
		}])->with('categories:id,name')
			->with('subcategories:id,name,slug')
			->with('biller:id,name,image,phone1')
			->with(['shipping_details' => function ($query) {
				$query->with('location');
			}])
			->with(['brand' => function ($query) {
				$query->where('type', 'brand')->get();
			}])
			->whereId($id)
			->whereSlug($slug)
			->first();


		if ($product) {
			$productCountries = Locations::with(['product_shippment' => function ($query) use ($id) {
				$query->where('pro_id', $id);
			}])->get();
			
			$relatedProducts = Product::with('product_image')
				->with('categories:id,name')
				->with('locations')
				->with('conditions')
				->with('brand:id,logo')
				->with(['shipping_details' => function ($query) {
					$query->with('location');
				}])->where('subcategory_id', $product->subcategory_id)
				// ->where('type', 'Child')
				->where('id', '!=', $id)
				->orderby('id', 'desc')
				->take(4)
				->get();

			$childProducts = Product::whereParentId($product->id)->whereType('Child')->get();
			$settings = Settings::first(['currency', 'disclaimer']);

			$StockIn = Stock::where('pro_id', $id)->sum('qty_in');
			$StockOut = Stock::where('pro_id', $id)->sum('qty_out');
			$totalStock = $StockIn - $StockOut;
			$relatedinout = Stock::orderby('pro_id')->get();

			$productInfo = SingleProductInfo::findOrFail(1);

			$overAllProductRating = Reviews::where('product_id',$id)->where('status',1)->count();
		// return	$starSingle = Reviews::where('product_id',$id)->where('status',1)->get();
			$ReviewsNo5 = Reviews::select(DB::raw('COUNT(rating) as total_user_rating'))
									->where('product_id',$id)->where('status',1)
									->where('rating',5)
									->first();

			$ReviewsNo4 = Reviews::select(DB::raw('COUNT(rating) as total_user_rating'))
									->where('product_id',$id)->where('status',1)
									->where('rating',4)
									->groupBy('rating')
									->first();
								
			$ReviewsNo3 = Reviews::select(DB::raw('COUNT(rating) as total_user_rating'))
									->where('product_id',$id)->where('status',1)
									->where('rating',3)
									->groupBy('rating')
									->first();
			$ReviewsNo2 = Reviews::select(DB::raw('COUNT(rating) as total_user_rating'))
									->where('product_id',$id)->where('status',1)
									->where('rating',2)
									->groupBy('rating')
									->first();
			$ReviewsNo1 = Reviews::select(DB::raw('COUNT(rating) as total_user_rating'))
									->where('product_id',$id)->where('status',1)
									->where('rating',1)
									->groupBy('rating')
									->first();
			$reviewsAverage = Reviews::where('product_id',$id)->where('status',1)->average('rating');
			$relatedreviews = Reviews::where('id', '!=', $id)->where('status',1)->orderby('product_id')->get();
			// ->where('status',1)->average('rating');
					// return $product;
			return view('website.single-product', 
				compact(
					'product', 
					'childProducts', 
					'settings', 
					'productCountries', 
					'relatedProducts', 
					'relatedreviews', 
					'totalStock', 
					'productInfo',
					'overAllProductRating',
					'reviewsAverage',
					'ReviewsNo5',
					'ReviewsNo4',
					'ReviewsNo3',
					'ReviewsNo2',
					'ReviewsNo1',
					'relatedinout'
				));
		} else {
			abort(404);
		}
	}

	public function generateSingleProductDetailsPDF($id)
	{
		$pro = Product::whereId($id)->first('details');
		if ($pro) {
			$pdf = PDF::loadView('Single-Product-Details', array('pro' => $pro));
			return $pdf->download('product-details.pdf');
		} else {
			abort(404);
		}
	}

	public function ProductContactSendMessage(Request $request)
	{
		if ($request->isMethod('post')) {
			$v = Validator::make($request->all(), [
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
				'phoneno' => 'required|max:255|min:1'
			], [
				'pro_id.required' => 'Something went wrong',
				'make.required' => 'Something went wrong',
				'pro_name.required' => 'The Product Name field is required',
				'message.required' => 'The Message field is required',
				'model_no.required' => 'The Model No field is required',
				'brand_name.required' => 'The Brand Name field is required',
				'moq.required' => 'The MOQ field is required',
				'delivery_location.required' => 'The Location field is required',
				'phoneno.required' => 'The Phone no field is required'
			]);

			if ($v->fails()) {
				return redirect(url()->previous() . "#productContactForm")->withErrors($v->errors());
			}

			$p = ProductContact::create($request->all());
			$p->vendor_id = $request->vid;
			$p->save();

			return redirect()->back()->with(Toastr::info('Thanks for contacting us! We will get in touch with you shortly.'));
		} else {
			abort(404);
		}
	}

	public function FilterByCategories($id)
	{
		$Category = Category::findOrFail($id);
		if ($Category) {
			$subCategoryList = SubCategory::where('category_id', $id)->get();
			$subCategorySingle = SubCategory::with('categories')->first(['id', 'name', 'category_id', 'slug']);

			$products = Product::with('product_image')->with('categories:id,name')
				->with('stock')
				->where('type', 'Parent')
				->where('category_id', $id)
				->paginate(12);

			$settings = Settings::first('currency');
			$brands = Brand::select('id', 'brand_name', 'logo', 'link')->whereType('brand')->orderBy('id')->get();
			$categoriesList = Category::with('subcategories')->get();
			$singleCategory = Category::findOrFail($subCategorySingle->category_id);

			$minPrice = Product::where('type', 'Parent')
				->where('category_id', $id)
				->min('new_sale_price');

			$maxPrice = Product::where('type', 'Parent')
				->where('category_id', $id)
				->max('new_sale_price');

			if ($minPrice == 0 || $minPrice == null) {
				$minPrice = 0;
			}
			if ($maxPrice == 0 || $maxPrice == null) {
				$maxPrice = 0;
			}
			$relatedreviews = Reviews::where('status',1)->get();
			return view('website.subcategories-product-list', compact('subCategorySingle', 'subCategoryList', 'products', 'settings', 'brands', 'categoriesList', 'singleCategory', 'minPrice', 'maxPrice','relatedreviews'));
		} else {
			abort(404);
		}
	}

	public function FilterProductByName(Request $request)
	{
		$this->validate($request, [
			'sub_category_id' => 'required',
			'product_name_model' => 'required'
		], [
			'sub_category_id.required' => 'Something went wrong',
			'product_name_model.required' => 'The Product field is required'
		]);

		$subcatid = $request->sub_category_id;
		$subCategorySingle = SubCategory::whereId($subcatid)->first(['id', 'name', 'category_id', 'slug']);

		if ($subCategorySingle) {
			$subCategoryList = SubCategory::where('category_id', $subCategorySingle->category_id)->get();

			$products = Product::with('product_image')->with('categories:id,name')
				->with('stock')
				->where('type', 'Parent')
				->where('subcategory_id', $subcatid)
				->where('name', 'like', '%' . $request->product_name_model . '%')
				->OrWhere('model_no', 'like', '%' . $request->product_name_model . '%')
				->paginate(12);

			$settings = Settings::first('currency');
			$brands = Brand::select('id', 'brand_name', 'logo', 'link')->whereType('brand')->orderBy('id')->get();
			$categoriesList = Category::with('subcategories')->get();
			$singleCategory = Category::findOrFail($subCategorySingle->category_id);

			$minPrice = Product::where('type', 'Parent')
				->where('subcategory_id', $subcatid)
				->where('name', 'like', '%' . $request->product_name_model . '%')
				->OrWhere('model_no', 'like', '%' . $request->product_name_model . '%')
				->min('new_sale_price');
			$maxPrice = Product::where('type', 'Parent')
				->where('subcategory_id', $subcatid)
				->where('name', 'like', '%' . $request->product_name_model . '%')
				->OrWhere('model_no', 'like', '%' . $request->product_name_model . '%')
				->max('new_sale_price');

			if ($minPrice == 0 || $minPrice == null) {
				$minPrice = 0;
			}
			if ($maxPrice == 0 || $maxPrice == null) {
				$maxPrice = 0;
			}
			$relatedreviews = Reviews::where('status',1)->get();

			return view('website.subcategories-product-list', compact('relatedreviews','subCategorySingle', 'subCategoryList', 'products', 'settings', 'brands', 'categoriesList', 'singleCategory', 'minPrice', 'maxPrice'));
		} else {
			abort(404);
		}
	}

	public function FilterProductByMaker(Request $request)
	{
		$this->validate($request, [
			'sub_category_id' => 'required',
			'maker_name' => 'required'
		], [
			'sub_category_id.required' => 'Something went wrong',
			'maker_name.required' => 'The Product Maker Name field is required'
		]);

		$subcatid = $request->sub_category_id;
		$maker_name = $request->maker_name;
		$subCategorySingle = SubCategory::whereId($subcatid)->first(['id', 'name', 'category_id', 'slug']);

		if ($subCategorySingle) {
			$subCategoryList = SubCategory::where('category_id', $subCategorySingle->category_id)->get();

			$products = Product::with('product_image')->with('categories:id,name')
				->with('stock')
				->where('subcategory_id', $subcatid)
				->where('make', $maker_name)
				->paginate(12);

			$settings = Settings::first('currency');
			$brands = Brand::select('id', 'brand_name', 'logo', 'link')->whereType('brand')->orderBy('id')->get();
			$categoriesList = Category::with('subcategories')->get();
			$singleCategory = Category::findOrFail($subCategorySingle->category_id);


			$minPrice = Product::where('type', 'Parent')
				->where('subcategory_id', $subcatid)
				->where('make', $maker_name)
				->min('new_sale_price');
			$maxPrice = Product::where('type', 'Parent')
				->where('subcategory_id', $subcatid)
				->where('make', $maker_name)
				->max('new_sale_price');

			if ($minPrice == 0 || $minPrice == null) {
				$minPrice = 0;
			}
			if ($maxPrice == 0 || $maxPrice == null) {
				$maxPrice = 0;
			}
			$relatedreviews = Reviews::where('status',1)->get();
			return view('website.subcategories-product-list', compact('relatedreviews','subCategorySingle', 'subCategoryList', 'products', 'settings', 'brands', 'categoriesList', 'singleCategory', 'minPrice', 'maxPrice'));
		} else {
			abort(404);
		}
	}

	public function FilterProductByType(Request $request)
	{
		$this->validate($request, [
			'sub_category_id' => 'required',
			'type' => 'required'
		], [
			'sub_category_id.required' => 'Something went wrong',
			'type.required' => 'The Product Type field is required'
		]);

		$subcatid = $request->sub_category_id;
		$type = $request->type;
		$subCategorySingle = SubCategory::whereId($subcatid)->first(['id', 'name', 'category_id', 'slug']);

		if ($subCategorySingle) {
			$subCategoryList = SubCategory::where('category_id', $subCategorySingle->category_id)->get();

			$products = Product::with('product_image')->with('categories:id,name')
				->with('stock')
				->where('subcategory_id', $subcatid)
				->where('type', $type)
				->paginate(12);

			$settings = Settings::first('currency');
			$brands = Brand::select('id', 'brand_name', 'logo', 'link')->whereType('brand')->orderBy('id')->get();
			$categoriesList = Category::with('subcategories')->get();
			$singleCategory = Category::findOrFail($subCategorySingle->category_id);



			$minPrice = Product::where('subcategory_id', $subcatid)
				->where('type', $type)
				->min('new_sale_price');
			$maxPrice = Product::where('subcategory_id', $subcatid)
				->where('type', $type)
				->max('new_sale_price');

			if ($minPrice == 0 || $minPrice == null) {
				$minPrice = 0;
			}
			if ($maxPrice == 0 || $maxPrice == null) {
				$maxPrice = 0;
			}

			$relatedreviews = Reviews::where('status',1)->get();
			return view('website.subcategories-product-list', compact('relatedreviews','subCategorySingle', 'subCategoryList', 'products', 'settings', 'brands', 'categoriesList', 'singleCategory', 'minPrice', 'maxPrice'));
		} else {
			abort(404);
		}
	}

	public function FilterProductByCondition(Request $request)
	{
		$this->validate($request, [
			'sub_category_id' => 'required',
			'condition' => 'required'
		], [
			'sub_category_id.required' => 'Something went wrong',
			'condition.required' => 'The Product Condition field is required'
		]);

		$subcatid = $request->sub_category_id;
		$condition = $request->condition;
		$subCategorySingle = SubCategory::whereId($subcatid)->first(['id', 'name', 'category_id', 'slug']);

		if ($subCategorySingle) {
			$subCategoryList = SubCategory::where('category_id', $subCategorySingle->category_id)->get();

			$products = Product::with('product_image')->with('categories:id,name')
				->with('stock')
				->where('subcategory_id', $subcatid)
				->whereHas('conditions', function ($query) use ($condition) {
					$query->where('condition_id', $condition);
				})->paginate(12);

			$settings = Settings::first('currency');
			$brands = Brand::select('id', 'brand_name', 'logo', 'link')->whereType('brand')->orderBy('id')->get();
			$categoriesList = Category::with('subcategories')->get();
			$singleCategory = Category::findOrFail($subCategorySingle->category_id);


			$minPrice = Product::where('subcategory_id', $subcatid)
				->whereHas('conditions', function ($query) use ($condition) {
					$query->where('condition_id', $condition);
				})->min('new_sale_price');
			$maxPrice = Product::where('subcategory_id', $subcatid)
				->whereHas('conditions', function ($query) use ($condition) {
					$query->where('condition_id', $condition);
				})->max('new_sale_price');

			if ($minPrice == 0 || $minPrice == null) {
				$minPrice = 0;
			}
			if ($maxPrice == 0 || $maxPrice == null) {
				$maxPrice = 0;
			}
			$relatedreviews = Reviews::where('status',1)->get();
			return view('website.subcategories-product-list', compact('relatedreviews','subCategorySingle', 'subCategoryList', 'products', 'settings', 'brands', 'categoriesList', 'singleCategory', 'minPrice', 'maxPrice'));
		} else {
			abort(404);
		}
	}

	public function FilterProductByPrice($id, $filterNo)
	{
		$subCategorySingle = SubCategory::whereId($id)->first(['id', 'name', 'category_id', 'slug']);

		if ($subCategorySingle) {
			$subCategoryList = SubCategory::where('category_id', $subCategorySingle->category_id)->get();
			if ($filterNo == 1) {
				$products = Product::with('product_image')->with('categories:id,name')
					->with('stock')
					->where('subcategory_id', $id)
					->where('new_sale_price', '>=', 1)
					->where('new_sale_price', '<=', 100)
					->paginate(12);
			} else
			if ($filterNo == 2) {
				$products = Product::with('product_image')->with('categories:id,name')
					->with('stock')
					->where('subcategory_id', $id)
					->where('new_sale_price', '>=', 100)
					->where('new_sale_price', '<=', 200)
					->paginate(12);
			} else
			if ($filterNo == 3) {
				$products = Product::with('product_image')->with('categories:id,name')
					->with('stock')
					->where('subcategory_id', $id)
					->where('new_sale_price', '>=', 200)
					->where('new_sale_price', '<=', 300)
					->paginate(12);
			} else
			if ($filterNo == 4) {
				$products = Product::with('product_image')->with('categories:id,name')
					->with('stock')
					->where('subcategory_id', $id)
					->where('new_sale_price', '>=', 300)
					->where('new_sale_price', '<=', 500)
					->paginate(12);
			} else
			if ($filterNo == 5) {
				$products = Product::with('product_image')->with('categories:id,name')
					->with('stock')
					->where('subcategory_id', $id)
					->where('new_sale_price', '>=', 500)
					->paginate(12);
			} else {
				abort(404);
			}

			$settings = Settings::first('currency');
			$brands = Brand::select('id', 'brand_name', 'logo', 'link')->whereType('brand')->orderBy('id')->get();
			$categoriesList = Category::with('subcategories')->get();
			$singleCategory = Category::findOrFail($subCategorySingle->category_id);
			$relatedreviews = Reviews::where('status',1)->get();
			return view('website.subcategories-product-list', compact('relatedreviews','subCategorySingle', 'subCategoryList', 'products', 'settings', 'brands', 'categoriesList', 'singleCategory'));
		} else {
			abort(404);
		}
	}

	public function FilterProductByPriceMinMax(Request $request)
	{
		// return $request;
		$this->validate($request, [
			'sub_category_id' => 'required',
			'min_price' => 'required',
			'max_price' => 'required'
		], [
			'sub_category_id.required' => 'Something went wrong',
			'min_price.required' => 'Min Price field is required',
			'max_price.required' => 'Max Price field is required',
		]);


		$id = $request->sub_category_id;
		$minPrice = $request->min_price;
		$maxPrice = $request->max_price;


		$subCategorySingle = SubCategory::whereId($id)->first(['id', 'name', 'category_id']);
		if ($subCategorySingle) {
			$subCategoryList = SubCategory::where('category_id', $subCategorySingle->category_id)->get();
			$products = Product::with('product_image')->with('categories:id,name')
				->with('stock')
				->where('subcategory_id', $id)
				->where('new_sale_price', '>=', $minPrice)
				->where('new_sale_price', '<=', $maxPrice)
				->paginate(12);

			$settings = Settings::first('currency');
			$brands = Brand::select('id', 'brand_name', 'logo', 'link')->whereType('brand')->orderBy('id')->get();
			$categoriesList = Category::with('subcategories')->get();
			$singleCategory = Category::findOrFail($subCategorySingle->category_id);


			$minPrice = Product::where('subcategory_id', $id)
				->where('new_sale_price', '>=', $minPrice)
				->where('new_sale_price', '<=', $maxPrice)
				->min('new_sale_price');
			$maxPrice = Product::where('subcategory_id', $id)
				->where('new_sale_price', '>=', $minPrice)
				->where('new_sale_price', '<=', $maxPrice)
				->max('new_sale_price');

			if ($minPrice == 0 || $minPrice == null) {
				$minPrice = 0;
			}
			if ($maxPrice == 0 || $maxPrice == null) {
				$maxPrice = 0;
			}
			$relatedreviews = Reviews::where('status',1)->get();
			return view('website.subcategories-product-list', compact('relatedreviews','subCategorySingle', 'subCategoryList', 'products', 'settings', 'brands', 'categoriesList', 'singleCategory', 'minPrice', 'maxPrice'));
		} else {
			abort(404);
		}
	}

	public function FilterProductByBrand(Request $request)
	{
		$this->validate($request, [
			'sub_category_id' => 'required'
		], [
			'sub_category_id.required' => 'Something went wrong'
		]);

		$id = $request->sub_category_id;
		$brand_id = $request->brand_id;

		$subCategorySingle = SubCategory::whereId($id)->first(['id', 'name', 'category_id']);
		if ($subCategorySingle) {
			$subCategoryList = SubCategory::where('category_id', $subCategorySingle->category_id)->get();
			$products = Product::with('product_image')->with('categories:id,name')
				->with('stock')
				->where('subcategory_id', $id)
				->where('brand_id', $brand_id)
				->paginate(12);

			$settings = Settings::first('currency');
			$brands = Brand::select('id', 'brand_name', 'logo', 'link')->whereType('brand')->orderBy('id')->get();
			$categoriesList = Category::with('subcategories')->get();
			$singleCategory = Category::findOrFail($subCategorySingle->category_id);



			$minPrice = Product::where('subcategory_id', $id)
				->where('brand_id', $brand_id)
				->min('new_sale_price');
			$maxPrice = Product::where('subcategory_id', $id)
				->where('brand_id', $brand_id)
				->max('new_sale_price');

			if ($minPrice == 0 || $minPrice == null) {
				$minPrice = 0;
			}
			if ($maxPrice == 0 || $maxPrice == null) {
				$maxPrice = 0;
			}
			$relatedreviews = Reviews::where('status',1)->get();
			return view('website.subcategories-product-list', compact('relatedreviews','subCategorySingle', 'subCategoryList', 'products', 'settings', 'brands', 'categoriesList', 'singleCategory', 'minPrice', 'maxPrice'));
		} else {
			abort(404);
		}
	}

	public function FilterProductByLocation(Request $request)
	{
		$this->validate($request, [
			'sub_category_id' => 'required'
		], [
			'sub_category_id.required' => 'Something went wrong'
		]);

		$id = $request->sub_category_id;
		$location_id = $request->location_id;
		$minPrice = 0;
		$maxPrice = 0;

		$subCategorySingle = SubCategory::whereId($id)->first(['id', 'name', 'category_id']);
		if ($subCategorySingle) {
			$subCategoryList = SubCategory::where('category_id', $subCategorySingle->category_id)->get();
			$products = Product::with('product_image')->with('categories:id,name')
				->with('stock')
				->with(['locations' => function ($query) use ($location_id) {
					$query->where('location_id', $location_id);
				}])
				->where('subcategory_id', $id)
				->get();
			if ($products[0]->locations != null) {
				$products = Product::with('product_image')->with('categories:id,name')
					->with('stock')
					->with(['locations' => function ($query) use ($location_id) {
						$query->where('location_id', $location_id);
					}])
					->where('subcategory_id', $id)
					->paginate(12);

				$minPrice = Product::with(['locations' => function ($query) use ($location_id) {
					$query->where('location_id', $location_id);
				}])
					->where('subcategory_id', $id)
					->min('new_sale_price');
				$maxPrice = Product::with(['locations' => function ($query) use ($location_id) {
					$query->where('location_id', $location_id);
				}])
					->where('subcategory_id', $id)
					->max('new_sale_price');
			} else {
				$products = Product::where('subcategory_id', 0)->paginate(12);
				$minPrice = Product::where('subcategory_id', 0)->min('new_sale_price');
				$maxPrice = Product::where('subcategory_id', 0)->max('new_sale_price');
			}

			// return $products[0]->locations;
			$brands = Brand::select('id', 'brand_name', 'logo', 'link')->whereType('brand')->orderBy('id')->get();
			$categoriesList = Category::with('subcategories')->get();
			$singleCategory = Category::findOrFail($subCategorySingle->category_id);
			$settings = Settings::first('currency');

			if ($minPrice == 0 || $minPrice == null) {
				$minPrice = 0;
			}
			if ($maxPrice == 0 || $maxPrice == null) {
				$maxPrice = 0;
			}
			$relatedreviews = Reviews::where('status',1)->get();
			return view('website.subcategories-product-list', compact('relatedreviews','subCategorySingle', 'subCategoryList', 'products', 'settings', 'brands', 'categoriesList', 'singleCategory', 'minPrice', 'maxPrice'));
		} else {
			abort(404);
		}
	}

	public function AddToWishlist($id)
	{
		if (Auth::User()) {
			$pro = Product::findOrFail($id);
			if ($pro) {
				$findWishlist = Wishlist::where('user_id', Auth::User()->id)->where('pro_id', $id)->count();
				if ($findWishlist > 0) {
					return redirect()->back()->with(Toastr::info('Item Added To Wishlist Successfully!'));
				}

				$w = new Wishlist();
				$w->user_id = Auth::User()->id;
				$w->pro_id = $id;
				$w->save();

				return redirect()->back()->with(Toastr::info('Item Added To Wishlist Successfully!'));
			} else {
			}
		} else {
			return redirect('/login');
		}
	}

	public function Wishlist()
	{
		if (Auth::User()) {
			$wishlist_items = Wishlist::with(['product' => function ($query) {
				$query->with('product_image');
			}])->where('user_id', Auth::User()->id)->get();
			$settings = Settings::first('currency');

			return view('website.wishlist', compact('wishlist_items', 'settings'));
		} else {
			return redirect('/login');
		}
	}

	public function RemoveWishlistItem($id)
	{
		if (Auth::User()) {
			Wishlist::where('user_id', Auth::User()->id)->where('pro_id', $id)->delete();
			return redirect()->back()->with(Toastr::info('Item Deleted To Wishlist Successfully!'));
		} else {
			abort(500);
		}
	}

	public function cart()
	{
		$cartData = Cart::getContent();
		$cartTotal = Cart::getTotal();
		$settings = Settings::first('currency');
		// return $cartData;
		return view('website.cart', compact('cartData', 'settings', 'cartTotal'));
	}

	public function addtocart(Request $request)
	{
		$product = Product::find($request->id);
		if ($product) {
			$add = Cart::add([
				'id' => $request->id,
				'name' => $request->name,
				'quantity' => $request->quantity,
				'price' => $request->price,
				'attributes' => [
					'image' => $request->image,
					'color' => $request->color,
					'slug' => $request->slug,
					'amount_old' => $request->amount_old,
					'amount_new' => $request->amount_new,
					'conditionType' => $request->conditionType,
					'ship_charges' => $request->ship_charges,
					'locatedin' => $request->locatedin,
					'imp_charges' => $request->imp_charges,
					't_charges' => $request->t_charges,
					'oth_charges' => $request->oth_charges,
					'ship_days' => $request->ship_days,
					'brand_id' => $request->brand_id,
					'brand_logo' => $request->brand_logo,
					'vendor_id' => $product->created_by
				]
			]);
			if ($add) {
				// return $add;
				// if($request->form_no=='f2')
				// {
				// 	return redirect('buynow-checkout')->with(Toastr::info('Item Added To Cart Successfully!'));
				// }
				return redirect()->back()->with(Toastr::info('Item Added To Cart Successfully!'));
			}
		} else {
			return redirect()->back()->with(Toastr::error('Something went wrong!'));
		}
	}

	public function updateCart(Request $request, $id)
	{
		$p = Product::find($id);
		if ($p) {
			$cart = Cart::getContent();
			if ($request->change_to === 'down') {

				if (isset($cart[$id])) {
					if ($cart[$id]->quantity > 1) {
						$cart[$id]->quantity--;
						return redirect()->back()->with(Toastr::info('Item Updated To Cart Successfully!'));
					} else {
						Cart::remove($id);
						return redirect()->back()->with(Toastr::info('Item Updated To Cart Successfully!'));
					}
				}
			} else {

				if (isset($cart[$id])) {
					$cart[$id]->quantity++;
					return redirect()->back()->with(Toastr::info('Item Added To Cart Successfully!'));
				}
			}
		} else {
			abort(404);
		}
	}

	public function trashCart($id)
	{
		$p = Product::find($id);
		if ($p) {
			Cart::remove($id);
			return redirect()->back()->with(Toastr::info('Item Delete From Cart Successfully!'));
		} else {
			abort(404);
		}
	}

	public function ClearCart()
	{
		Cart::clear();
		return redirect()->back()->with(Toastr::info('Cart Empty Successfully!'));
	}

	public function AboutUs()
	{
		$about = AboutUs::orderBy('id')->get();
		$services = Services::orderBy('id')->take(6)->get();
		$testimonials = Testimonials::orderBy('id')->get();
		$skills = Skills::orderBy('id')->get(['title', 'percentage']);
		$skillsCss = "";
		$skillsCss2 = "";
		foreach ($skills as $skill) {
			$skillsCss .= '.bar .progress-line.' . Str::lower($skill->title) . ' span {
                width: ' . $skill->percentage . '%;
            }';
			$skillsCss2 .= '.progress-line.' . Str::lower($skill->title) . ' span::after {
				content: "' . $skill->percentage . '%";
			}';
		}
		// return $skillsCss2;
		return view('website.about-us', compact('about','services', 'testimonials', 'skills', 'skillsCss', 'skillsCss2'));
	}

	public function ContactUs()
	{
		return view('website.contact-us');
	}

	public function SendContactMessage(Request $request)
	{
		if ($request->isMethod('post')) {
			$this->validate($request, [
				'first_name' => 'required',
				'last_name' => 'required',
				'job_title' => 'required',
				'job_function' => 'required',
				'company' => 'required',
				'industry' => 'required',
				'email' => 'required|email',
				'phoneno' => 'required',
				'city' => 'required',
				'state' => 'required',
				'subject' => 'required',
				'message' => 'required'
			]);

			ContactUs::create($request->all());
			return redirect()->back()->with(Session::flash('flash_message', 'Thanks For Contact. We will contact you soon!!!'));
		} else {
			return redirect()->back()->with(Session::flash('failure_message', 'Something went wrong!!!'));
		}
	}

	public function ShopByBrand()
	{
		$brands = Brand::select('brand_name', 'logo', 'link')->whereType('brand')->orderBy('id')->get();
		return view('website.shop-by-brand', compact('brands'));
	}

	public function Blogs()
	{
		$homeSettings = BlogsSetting::first();


		$category1 = BlogsCategories::select('id','title')->whereId($homeSettings->blog_category1)->first();
		$category2 = BlogsCategories::select('id','title')->whereId($homeSettings->blog_category2)->first();
		$category3 = BlogsCategories::select('id','title')->whereId($homeSettings->blog_category3)->first();
		$category4 = BlogsCategories::select('id','title')->whereId($homeSettings->blog_category4)->first();
		// $showAll1 = 

		$SubcategoriesList1 = BlogSubCategory::where('blog_category_id', $homeSettings->blog_category1)->orderBy('id')->take(5)->get();
		$SubcategoriesList2 = BlogSubCategory::where('blog_category_id', $homeSettings->blog_category2)->orderBy('id')->take(5)->get();
		$SubcategoriesList3 = BlogSubCategory::where('blog_category_id', $homeSettings->blog_category3)->orderBy('id')->take(5)->get();
		$SubcategoriesList4 = BlogSubCategory::where('blog_category_id', $homeSettings->blog_category4)->orderBy('id')->take(5)->get();

		$blogs = Blogs::with('blog_category:id,title')->with('created_by_user:id,first_name,last_name')->orderBy('id')->get();
		 $bannerimages = Blogs::with('blog_category:id,title')->with('created_by_user:id,first_name,last_name')->take(3)->orderBy('id','desc')->get();
		return view('website.blogs', 
		compact(
			'category1',
			'category2',
			'category3',
			'category4',
			'SubcategoriesList1',
			'SubcategoriesList2',
			'SubcategoriesList3',
			'SubcategoriesList4',
			'homeSettings',
			'blogs',
			'bannerimages'
		));

	}

	public function SingleBlog($id, $slug)
	{
		$blogs_categories = BlogsCategories::orderBy('id')->get(['title']);
		//return $sub=BlogSubCategory::all();
	 	 $Singleblog = Blogs::with('blog_category:id,title')
			->with('created_by_user:id,first_name,last_name')
			->whereId($id)
			->whereSlug($slug)
			->firstOrFail();
			
		 $sidebarcategories = BlogSubCategory::
		 where('id',$Singleblog->blog_sub_category_id)
		 ->distinct()
		 ->get();
			
		if ($Singleblog) {
			 $relatedblog=Blogs::where('id','!=',$id)->where('blog_category_id',$Singleblog->blog_category_id)->take(7)->get();
			return view('website.single-blog', compact('blogs_categories', 'Singleblog','relatedblog','sidebarcategories'));
		} else {
			abort(404);
		}
	}

	public function MyAccount()
	{
		if (Auth::User()) {
			$orders = Order::with('order_details')->where('customer_id', Auth::User()->id)->get();
			return view('website.my-account', compact('orders'));
		} else {
			return redirect('/login');
		}
	}
	// public function TrackLink(){
	// 	$order = Order::where('id',$request->order_id)->where('email',$request->email)->first();
	// 		if ($order) {
	// 			 	$orderTracker = OrderTracker::where('order_id', $request->order_id)->orderBy('id')->get();
	// 				 	$orderDetails = OrderDetails::with('products')->where('order_id', $request->order_id)->orderBy('id')->get();
	// 			return view('website.track-single-order', compact('order', 'orderTracker', 'orderDetails'));
	// 		} else {
	// 			return redirect()->back()->with('flash_message', 'Your credentials are incorrect please try again');
	// 		}
	// }

	public function UpdateProfile(Request $request)
	{
		if ($request->isMethod('post')) {
			if ($request->cur_password != null || $request->new_password != null || $request->new_confirm_password != null) {
				$request->validate([
					'cur_password' => ['required', 'min:8', 'max:16', new MatchOldPassword],
					'new_password' => ['required', 'min:8', 'max:16'],
					'new_confirm_password' => ['same:new_password', 'min:8', 'max:16']
				], [
					'cur_password.required' => 'The Current password field is required'
				]);

				$user = User::find(Auth::User()->id);
				$user->password = Hash::make($request->new_password);
				$user->save();
				Auth::logout();

				return redirect('/login')->with(Toastr::info('Profile Updated Successfully!'));
			} else {
				$request->validate([
					'first_name' => 'required|regex:/^[a-zA-Z ]*$/',
					'last_name' => 'required|regex:/^[a-zA-Z ]*$/'
				]);

				$user = User::find(Auth::User()->id);
				$user->first_name = $request->first_name;
				$user->last_name = $request->last_name;
				$user->save();

				return redirect()->back()->with(Toastr::info('Profile Updated Successfully!'));
			}
		} else {
			abort(404);
		}
	}

	public function PrintOrderReceipt($orderid)
	{
		$order = Order::with('order_details')->findOrFail($orderid);
		return view('website.order-receipt', compact('order'));
	}

	public function FAQS1()
	{
		$wishlist_items = 0;
		if (isset(Auth::User()->id)) {
			$wishlist_items = Wishlist::where('user_id', Auth::User()->id)->count();
		}

		$total_items = Cart::getContent()->count();
		$faqs1 = FaqCategories::with('faq1')->OrderBy('id')->get();
		return view('website-jewellery.faqs', compact('wishlist_items', 'total_items', 'faqs1'));
	}

	public function FAQS2()
	{
		$wishlist_items = 0;
		if (isset(Auth::User()->id)) {
			$wishlist_items = Wishlist::where('user_id', Auth::User()->id)->count();
		}

		$total_items = Cart::getContent()->count();
		$faqs2 = FAQ2::OrderBy('id')->get();
		return view('website-jewellery.faqs2', compact('wishlist_items', 'total_items', 'faqs2'));
	}

	public function TermsConditions()
	{
		$wishlist_items = 0;
		if (isset(Auth::User()->id)) {
			$wishlist_items = Wishlist::where('user_id', Auth::User()->id)->count();
		}

		$total_items = Cart::getContent()->count();
		$termsConditions = TermsConditions::OrderBy('id')->get();
		return view('website-jewellery.terms-conditions', compact('wishlist_items', 'total_items', 'termsConditions'));
	}

	public function ReturnsExchanges()
	{
		$wishlist_items = 0;
		if (isset(Auth::User()->id)) {
			$wishlist_items = Wishlist::where('user_id', Auth::User()->id)->count();
		}

		$total_items = Cart::getContent()->count();
		$returnExchangePolicy = ReturnExchangePolicy::OrderBy('id')->get();
		return view('website-jewellery.returns-exchanges', compact('wishlist_items', 'total_items', 'returnExchangePolicy'));
	}

	public function TrackOrder()
	{
		return view('website.track-order');
	}

	public function SearchTrackOrder(Request $request)
	{
		
		if ($request->isMethod('post')) {
			$this->validate($request, [
				'order_id' => 'required',
				'email' => 'required|email'
			]);
			
			// $order = Order::whereId($request->order_id)->whereEmail($request->email)->first();
			$order = Order::where('id',$request->order_id)->where('email',$request->email)->first();
			if ($order) {
				 	$orderTracker = OrderTracker::where('order_id', $request->order_id)->orderBy('id')->get();
					 	$orderDetails = OrderDetails::with('products')->where('order_id', $request->order_id)->orderBy('id')->get();
				return view('website.track-single-order', compact('order', 'orderTracker', 'orderDetails'));
			} else {
				return redirect()->back()->with('flash_message', 'Your credentials are incorrect please try again');
			}
		} else {
			abort(404);
		}
	}

	public function Services()
	{
		$services = Services::all();
		return view('website.services', compact('services'));
	}

	public function MediaSignature()
	{
		return view('website.under-construction');
	}

	public function Events()
	{
		$events_categories = EventCategories::select('title')->orderBy('id')->get();
		$events = Events::with('event_category:id,title')->with('created_by_user')->orderBy('id', 'desc')->get();
		$totalEvents = Events::count();
		return view('website.events', compact('events_categories', 'events', 'totalEvents'));
	}

	public function SingleEvents($slug)
	{
		$event_categories = EventCategories::select('title')->orderBy('id')->get();
		$SingleEvent = Events::with('event_category:id,title')
			->with('created_by_user')
			->whereSlug($slug)
			->firstOrFail();
		if ($SingleEvent) {
			return view('website.single-event', compact('event_categories', 'SingleEvent'));
		} else {
			abort(404);
		}
	}

	public function Trainings()
	{
		$training_categories = TrainingCategories::select('title')->orderBy('id')->get();
		$trainings = Trainings::with('training_category:id,title')->with('created_by_user')->orderBy('id', 'desc')->get();
		$totalTrainings = Trainings::count();
		return view('website.trainings', compact('training_categories', 'trainings', 'totalTrainings'));
	}
	public function SingleTraining($id,$slug)
	{
		$training_categories = TrainingCategories::select('title')->orderBy('id')->get();
		$trainings = Trainings::with('training_category:id,title')->with('created_by_user')->with('instructor')->orderBy('id', 'desc')->get();
		 $SingleTraining = Trainings::with('training_category:id,title')
			->with('created_by_user')
			->with('instructor')
			->whereId($id)
			->whereSlug($slug)
			->firstOrFail();
		if ($SingleTraining) {
			$instructor=Instructor::where('id',$SingleTraining->intructor_id)->get();
			 $relatedblog=Trainings::where('id','!=',$id)->where('training_category_id',$SingleTraining->training_category_id)->get();
			return view('website.single-training', compact('training_categories', 'SingleTraining','relatedblog','trainings','instructor'));
		} else {
			abort(404);
		}
	}

	public function VendorProducts($vendorId)
	{
		$vendor = User::whereId($vendorId)->whereRole('Vendor')->first();
		if ($vendor) {
			$products = Product::with('product_image')
				->with('categories:id,name')
				->with('locations')
				->with('conditions')
				->with('brand:id,logo')
				->with('stock')
				->with(['shipping_details' => function ($query) {
					$query->with('location');
				}])
				->where('created_by', $vendorId)
				->where('type', 'Parent')
				->paginate(12);

			$relatedProducts = Product::with('product_image')
				->with('categories:id,name')
				->with('locations')
				->with('conditions')
				->with('brand:id,logo')
				->with(['shipping_details' => function ($query) {
					$query->with('location');
				}])
				->where('created_by', $vendorId)
				->where('type', 'Parent')
				->take(12)
				->get();

			$settings = Settings::first('currency');
			$brands = Brand::select('id', 'brand_name', 'logo', 'link')->whereType('brand')->orderBy('id')->get();
			$productInfo = SingleProductInfo::findOrFail(1);
			$locations = Locations::all();
			$vendorAlbums = VendorAlbum::where('vendor_id',$vendorId)->get();
			$relatedreviews = Reviews::where('status',1)->get();
			$relatedinout = Stock::orderby('pro_id')->get();	
			// return $vendor;
			return view('website.vendor_profile', compact('products', 'relatedProducts','settings', 'brands', 'vendor','productInfo','locations','vendorAlbums','relatedreviews','relatedinout'));
		} else {
			abort(404);
		}
	}

	public function UnderConstruction()
	{
		return view('website.under-construction');
	}

	public function Ratings()
	{
		 $orderProductsList = OrderDetails::with(['order' => function ($query) {
			$query->where('customer_id', Auth::User()->id);
		}])->with('product_image')->get();
		$relatedreviews = Reviews::where('status',1)->get();
		return view('website.ratings', compact('orderProductsList','relatedreviews'));
	}

	public function AddReview(Request $request)
	{
		if($request->isMethod('post'))
		{
			$validator = Validator::make($request->all(), [
				'product_id'=>'required',
				'customer_name'=>'required',
				'review'=>'required'
			]);

			if ($validator->fails()) {
				return redirect()->back()->with(Toastr::error('Something went wrong! Try Again.'));
			}

			$r = Reviews::create($request->all());
			$r->status = 0;
			$r->save();
			return redirect()->back()->with(Toastr::info('Review Added Successfully !!!'));
		}else{	
			abort(404);
		}
	}
	

	public function VendorContactSendMessage(Request $request)
	{
		if ($request->isMethod('post')) {
			$v = Validator::make($request->all(), [
				'make' => 'required|max:255|min:1',
				// 'pro_id' => 'required|max:255|min:1',
				// 'pro_name' => 'required|max:255|min:1',
				'message' => 'required|max:400|min:1',
				'model_no' => 'required|max:255|min:1',
				'brand_name' => 'required|max:255|min:1',
				'moq' => 'required|max:255|min:1',
				'delivery_location' => 'required|max:255|min:1',
				'company' => 'required|max:255|min:1',
				'address' => 'required|max:255|min:1',
				'phoneno' => 'required|max:255|min:1'
			], [
				// 'pro_id.required' => 'Something went wrong',
				'make.required' => 'Something went wrong',
				// 'pro_name.required' => 'The Product Name field is required',
				'message.required' => 'The Message field is required',
				'model_no.required' => 'The Model No field is required',
				'brand_name.required' => 'The Brand Name field is required',
				'moq.required' => 'The MOQ field is required',
				'delivery_location.required' => 'The Location field is required',
				'phoneno.required' => 'The Phone no field is required'
			]);

			if ($v->fails()) {
				return redirect(url()->previous() . "#vendorContactForm")->withErrors($v->errors());
			}

			$p = ProductContact::create($request->all());
			$p->vendor_id = $request->vid;
			$p->save();

			return redirect()->back()->with(Toastr::info('Thanks for contacting us! We will get in touch with you shortly.'));
		} else {
			abort(404);
		}
	}
}
