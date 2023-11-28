<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RefundController;
use App\Http\Controllers\VendorsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\EwalletController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductContactController;
use App\Http\Controllers\InsertVendorsController;
use App\Http\Controllers\TermsConditionsController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeSettingsController;
use App\Http\Controllers\BannersController;
use App\Http\Controllers\FaqCategoriesController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\HelpCenterController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
use App\Http\Middleware\VendorOnly;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\AdvertisementSellerController;
use App\Http\Controllers\AdvertisementOrder;
use App\Http\Controllers\StripePaymentController;

use App\Models\User;
use App\Models\Order;

use Illuminate\Support\Facades\DB;



/*

|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);



// Route::get('/', function () {
//     return view('dashboard.dashboardv1');
// });
// Route::view('/', 'starter')->name('starter');
Route::get('large-compact-sidebar/dashboard/dashboard1', function () {
    // set layout sesion(key)
    session(['layout' => 'compact']);
    return view('dashboard.dashboardv1');
})->name('compact');

Route::get('large-sidebar/dashboard/dashboard1', function () {
    // set layout sesion(key)
    session(['layout' => 'normal']);
    return view('dashboard.dashboardv1');
})->name('normal');

Route::get('horizontal-bar/dashboard/dashboard1', function () {
    // set layout sesion(key)
    session(['layout' => 'horizontal']);
    return view('dashboard.dashboardv1');
})->name('horizontal');

Route::get('vertical/dashboard/dashboard1', function () {
    // set layout sesion(key)
    session(['layout' => 'vertical']);
    return view('dashboard.dashboardv1');
})->name('vertical');




// sellers
// Route::view('addseller' , 'sellers.addseller')->name('addseller');
// Route::view('vendorlist', 'sellers.vendorlist')->name('vendorlist');
Route::view('withdrawl', 'sellers.vendorwithdrawal')->name('withdrawl');
// Route::get('sellers.addseller', [InsertVendorsController::class, 'vendorlist']);
// Route::post('add', [InsertVendorsController::class, 'add']);
// Route::get('vendorlist', [VendorsController::class, 'vendorlist'])->name('vendorlist');
Route::get('customerlist', [CustomerController::class, 'index'])->name('customerlist');





// Refund

Route::get('pendingrefund', [RefundController::class, 'pendingRefunds'])->name('pendingrefund');
Route::get('approvedrefund', [RefundController::class, 'approvedRefunds'])->name('approvedrefund');
Route::get('refundrejected', [RefundController::class, 'rejectedRefunds'])->name('refundrejected');
Route::get('refunded', [RefundController::class, 'refundedRefunds'])->name('refunded');





// chart
// Route::get('fetch-vendor-products', function () {
//     $vendorProductData = DB::table('products')
//         ->select('created_by', DB::raw('COUNT(*) as totalProducts'))
//         ->groupBy('created_by')
//         ->get();
//     return response()->json($vendorProductData);
// });


Route::get('fetch-vendor-products', function () {
    $vendorProductData = DB::table('products')
        ->join('users', 'products.created_by', '=', 'users.id')
        ->select('users.name', 'users.name as vendor_full_name', DB::raw('COUNT(*) as totalProducts'))
        ->groupBy('products.created_by', 'users.name', 'users.name')
        ->get();
    return response()->json($vendorProductData);
});


// total oders by date

// routes/web.php
Route::get('/get-chart-data', [OrderController::class, 'getChartData']);

Route::get('/order-data', function () {
    $endDate = now()->format('Y-m-d');  // Current date
    $startDate = now()->subDays(29)->format('Y-m-d'); // 29 days ago

    // Retrieve the data for the date range
    $orderData = Order::select(DB::raw('DATE(order_date) as date'))
        ->whereBetween('order_date', [$startDate, $endDate])
        ->get();

    // Process the data to create an array for the last 30 days
    $last30DaysData = [];
    $currentDate = strtotime($endDate);

    for ($i = 0; $i < 30; $i++) {
        $date = date('Y-m-d', $currentDate);
        $totalOrders = $orderData->where('date', $date)->first();

        $last30DaysData[] = [
            'date' => $date,
            'total_orders' => $totalOrders ? $totalOrders->total_orders : 0,
        ];

        $currentDate = strtotime('-1 day', $currentDate);
    }

    return view('/', compact('last30DaysData'));
});


Route::get('/get-product-chart-data', [ProductController::class, 'getProductChartData']); // product chart data

// views 
// Route::get('/views-over-last-20-days', function () {
//     $twentyDaysAgo = now()->subDays(20);

//     $viewsData = DB::table('views')
//         ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(count) as total_views'))
//         ->where('created_at', '>=', $twentyDaysAgo)
//         ->groupBy('date')
//         ->orderBy('date', 'asc')
//         ->get();

//     return response()->json($viewsData);
// });


// Route::view('adduser', 'users.adduser')->name('adduser');
// Route::view('userlist','users.userlist')->name('userlist');
Route::get('users/userlist', [UserController::class, 'index'])->name('userlist');
Route::get('users/add', [UserController::class, 'add'])->name('user.add');
Route::post('users/adduser', [UserController::class, 'adduser'])->name('user.adduser');
Route::get('users/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::post('users/update/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('users/delete/{id}', [UserController::class, 'delete_user'])->name('user.delete');

// product reviews
// Routes accessible only by vendors
Route::middleware(['vendorOnly'])->group(function () {
    Route::get('/dashboard', [VendorsController::class, 'dashboard'])->name('vendor.dashboard');
    Route::resource('products', ProductController::class);
    Route::get('allproducts', [ProductController::class, 'index'])->name('allproducts');
    Route::get('product/{id}/dupe', [ProductController::class, 'dupe']);
    Route::post('products/{id}/duplicate', [ProductController::class, 'duplicate']);
    Route::get('products/{id}/destroy', [ProductController::class, 'destroy']);
});

// Other routes accessible to all users
// Route::view('customerqueries', 'products.customerqueries')->name('customerqueries');
Route::view('productinfo', 'products.productinfo')->name('productinfo');
Route::view('productreviews', 'products.productreviews')->name('productreviews');
// Route::view('cwallet', 'customer.cwallet')->name('cwallet');
Route::get('cwallet', [CustomerController::class, 'cwallet'])->name('cwallet');



// datatables
Route::view('datatables/basic-tables', 'datatables.basic-tables')->name('basic-tables');

// sessions
Route::view('sessions/signIn', 'sessions.signIn')->name('signIn');
Route::view('sessions/signUp', 'sessions.signUp')->name('signUp');
Route::view('sessions/forgot', 'sessions.forgot')->name('forgot');


// Auth::routes();



// login/sign-up checking

// Route::view('login','auth.login')->name('login');
// Route::view('signup','auth.register')->name('register');

// Auth::routes();


Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('admin');
});


Auth::routes(['verify' => true]);

Route::resource('products', ProductController::class);
// Route::get('allproducts', [ProductController::class,'index'])->name('allproducts');
Route::get('product/{id}/dupe', [ProductController::class, 'dupe']);
Route::post('products/{id}/duplicate', [ProductController::class, 'duplicate']);
Route::get('products/{id}/destroy', [ProductController::class, 'destroy']);

Route::resource('CustomerQueries', ProductContactController::class);


Route::get('/get-categories', [ProductController::class, 'GetCategories']);
Route::get('/get-subcategories', [ProductController::class, 'GetSubCategories']);
// orders using controller
Route::get('allorders', [OrderController::class, 'index'])->name('allorders');
Route::get('order-invoice/{id}', [OrderController::class, 'show'])->name('orderInvoice');
Route::get('pendingorders', [OrderController::class, 'showOrders'])->name('pendingorders');
Route::get('confirmedorders', [OrderController::class, 'showOrders'])->name('confirmedorders');
Route::get('packagingorders', [OrderController::class, 'showOrders'])->name('packagingorders');
Route::get('outofdelivery', [OrderController::class, 'showOrders'])->name('outofdelivery');
Route::get('delivered', [OrderController::class, 'showOrders'])->name('delivered');
Route::get('returned', [OrderController::class, 'showOrders'])->name('returned');
Route::get('ftod', [OrderController::class, 'showOrders'])->name('ftod');
Route::get('canceled', [OrderController::class, 'showOrders'])->name('canceled');

Route::patch('orderstatus', [OrderController::class, 'update'])->name('order.status');

Route::get('orders/{id}', [OrderController::class, 'show']);
// home controller route
// Route::get('/',[HomeController::class, 'index'])->name('admin');

// customer controller route
Route::get('customerlist', [CustomerController::class, 'index'])->name('customerlist');

// Sub-Category controller route
Route::get('allcat', [CategoryController::class, 'index'])->name('allcat');
Route::get('addcat', [CategoryController::class, 'create'])->name('addcat');
Route::post('addcat', [CategoryController::class, 'store'])->name('addcat.store');
Route::get('allsubcat', [SubCategoryController::class, 'index'])->name('allsubcat');
// Route::get('addsubcat', [SubCategoryController::class, 'create'])->name('addsubcat');
// Route::post('addsubcat', [SubCategoryController::class, 'store'])->name('addsubcat.store');
Route::get('category/editcat/{id}', [CategoryController::class, 'edit'])->name('category.editcat');
Route::put('category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

Route::resource('sub-category', SubCategoryController::class);
//categories
// Route::resource('category', CategoryController::class);
// menu controller route
Route::get('allterm', [TermsConditionsController::class, 'index'])->name('allterm');
Route::get('addterm', [TermsConditionsController::class, 'create'])->name('addterm');
Route::post('addterm', [TermsConditionsController::class, 'store'])->name('addterm.store');
Route::get('terms/edit/{id}', [TermsConditionsController::class, 'edit'])->name('terms.edit');
Route::put('terms/update/{id}', [TermsConditionsController::class, 'update'])->name('terms.update');
Route::delete('terms/delete/{id}', [TermsConditionsController::class, 'destroy'])->name('terms.destroy');
Route::get('terms/show/{id}', [TermsConditionsController::class, 'show'])->name('terms.show');

Route::resource('helpcenter', HelpCenterController::class);
Route::get('helpcenter/{id}/destroy', [HelpCenterController::class, 'destroy']);

Route::resource('pages', PageController::class);
Route::get('page/{id}/destroy', [PageController::class, 'destroy'])->name('page.destroy');

Route::resource('faqs_categories', FaqCategoriesController::class);
Route::get('faqs_category/{id}/destroy', [FaqCategoriesController::class, 'destroy'])->name('faqs_category.destroy');
Route::resource('faqs', FAQController::class);
Route::get('faq/{id}/destroy', [FAQController::class, 'destroy'])->name('faq.destroy');


//terms & Conditions
Route::get('allmenu', [MenuController::class, 'index'])->name('allmenu');
Route::get('addmenu', [MenuController::class, 'create'])->name('addmenu');
Route::post('addmenu', [MenuController::class, 'store'])->name('addmenu.store');
Route::get('menu/edit/{id}', [MenuController::class, 'edit'])->name('menu.edit');
Route::put('menu/update/{id}', [MenuController::class, 'update'])->name('menu.update');
Route::delete('menu/delete/{id}', [MenuController::class, 'destroy'])->name('menu.destroy');

//allcat
Route::get('allcat', [CategoryController::class, 'index'])->name('allcat');
Route::get('allsubcat', [SubCategoryController::class, 'index'])->name('allsubcat');

// Route::resource('menu', MenuController::class);

Route::resource('cat', CategoryController::class);

Route::resource('sub-category', SubCategoryController::class);
// customer reviews controller

Route::get('creviews', [ReviewsController::class, 'index'])->name('creviews');


// refund controller

// Route::view('refunded', 'refund.refunded')->name('refunded');
Route::get('allrefunds', [RefundController::class, 'refundstatus'])->name('allrefunds');
Route::get('createrefund', [RefundController::class, 'create'])->name('createrefund');
Route::post('/store-refund', [RefundController::class, 'store'])->name('refund.store');
Route::post('/allrefunds', [RefundController::class, 'update'])->name('refund.update');



// vendors route

Route::resource('vendor', VendorsController::class);
Route::post('vendor', [VendorsController::class, 'store'])->name('vendor.store');

Route::get('vendor-profile/{id}', [VendorsController::class, 'vendorProfile'])->name('vendorProfile');
Route::patch('vendorProfileSave/{id}', [VendorsController::class, 'vendorProfileSave']);


Route::get('verified-seller/{id}', [VendorsController::class, 'verifiedSeller']);
Route::post('trustedSellerSave/{id}', [VendorsController::class, 'trustedSellerSave']);
Route::patch('verifiedSellerSave/{id}', [VendorsController::class, 'verifiedSellerSave']);

Route::post('SellerDocumentSave/{id}', [VendorsController::class, 'SellerDocumentSave']);

Route::get('vendor_document/{id}/delete', [VendorsController::class, 'delete_document']);
Route::get('bank/{id}/delete', [VendorsController::class, 'delete_bank_details']);

Route::delete('delete-image/{image}', [VendorsController::class, 'deleteImage'])->name('delete.image');


Route::post('/delete-image', 'VendorsController@deleteImage');

// end

// add user role

Route::resource('users', RoleController::class);
Route::resource('coupon', CouponController::class);
Route::post('/toggle-coupon-status', [CouponController::class, 'toggleStatus']);
Route::get('coupon/{id}/destroy', [PurchaseController::class, 'destroy']);


Route::resource('purchase', PurchaseController::class);
Route::get('purchase/{id}/destroy', [PurchaseController::class, 'destroy']);
Route::get('purchase/history', [PurchaseController::class, 'history'])->name('purchaseHistory');
Route::get('purchase/{id}/edit', [PurchaseController::class, 'edit']);
Route::get('/purchase/create', [PurchaseController::class, 'create'])->name('purchase.create');
Route::get('/get-product-name/{sku}', [PurchaseController::class, 'getProductName']);
Route::get('/purchase/invoice/{purchaseId}', [PurchaseController::class, 'invoice'])->name('purchase.invoice');
Route::get('/purchase/bill/{purchaseId}', [PurchaseController::class, 'bill'])->name('purchase.bill');


Route::resource('supplier', SupplierController::class);
// Route::get('/get-product-name/{sku}', [PurchaseController::class,'getProductName'])->name('get.product.name');
// Route::get('coupon/all',[CouponController::class, 'all'])->name('couponall');

Route::resource('brands', BrandController::class);
Route::get('brands/{id}/destroy', [BrandController::class, 'destroy']);

Route::resource('payment_method', PaymentController::class);
Route::get('payment_method/{id}/destroy', [PaymentController::class, 'destroy']);


Route::get('/home-settings', [HomeSettingsController::class, 'index'])->name('home-settings');
Route::post('/update-home-settings', [HomeSettingsController::class, 'UpdateHomeSettings']);

Route::resource('/banners', BannersController::class);
Route::get('/banners/destroy/{id}', [BannersController::class, 'destroy'])->whereNumber('id');

Route::resource('/settings', SettingsController::class);


// Ewallet 
Route::get('ewallet/collectedcash', [EwalletController::class, 'collectedcash'])->name('collectedcash');
Route::get('ewallet/Totalbuying', [EwalletController::class, 'Totalbuying'])->name('Totalbuying');
Route::get('ewallet/totalpendingwithdrawls', [EwalletController::class, 'totalpendingwithdrawls'])->name('totalpendingwithdrawls');
Route::get('ewallet/totalrefund', [EwalletController::class, 'totalrefund'])->name('totalrefund');
Route::get('ewallet/totalspendondeals', [EwalletController::class, 'totalspendondeals'])->name('totalspendondeals');
Route::get('ewallet/totalwithdrawl', [EwalletController::class, 'totalwithdrawl'])->name('totalwithdrawl');
Route::get('ewallet/transcationhistory', [EwalletController::class, 'transcationhistory'])->name('transcationhistory');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// admin
Route::resource('advertisements', AdvertisementController::class);
Route::get('advertisement/{id}/destroy', [AdvertisementController::class, 'destroy'])->name('advertisement.destroy');

Route::get('a_details', [AdvertisementOrder::class, 'details'])->name('advertisementSellers.details');
Route::post('a_s_i_a/{id}', [AdvertisementOrder::class, 'advertisementOrderImageStatusUpdate'])->name('advertisementOrderImageUpdate');
Route::post('a_s_i_a_1/{id}', [AdvertisementOrder::class, 'advertisementOrderDisplayStatus'])->name('advertisementOrderDisplayStatus');

// VendorOnly
Route::resource('advertisementSellers', AdvertisementSellerController::class);
Route::post('advertisementOrder', [AdvertisementSellerController::class, 'formOrder']);
Route::get('a_s_details', [AdvertisementOrder::class, 'SellerDetails'])->name('advertisementSellers.ASDetails');
Route::post('a_s_image/{id}', [AdvertisementOrder::class, 'advertisementImage'])->name('advertisementImage');

Route::get('stripe1', [StripePaymentController::class, 'stripe']);
Route::post('stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');
