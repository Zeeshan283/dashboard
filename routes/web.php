<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\CommissionController;
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
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\ProductContactController;
use App\Http\Controllers\HomecouponsController;
use App\Http\Controllers\InsertVendorsController;
use App\Http\Controllers\BlogsCategoriesController;
use App\Http\Controllers\BlogsSubCategoriesController;
use App\Http\Controllers\CfeaturesController;
use App\Http\Controllers\TermsConditionsController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeSettingsController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DisputeController;
use App\Http\Controllers\BannersController;
use App\Http\Controllers\FaqCategoriesController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DealsController;
use App\Http\Controllers\HelpCenterController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
// use App\Http\Middleware\VendorOnly;
// use App\Http\Middleware\AdminMiddleware;
// use App\Http\Middleware\VendorMiddleware;
// use App\Http\Middleware\BothMiddleware;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\AdvertisementSellerController;
use App\Http\Controllers\AdvertisementOrder;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\CprofileController;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\CategoryServicesController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\TrainingsController;
use App\Http\Controllers\TrainingCategoriesController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\Auth\LoginController;





Route::get('large-compact-sidebar/dashboard/dashboard1', function () {

    session(['layout' => 'compact']);
    notify()->success('new user added');
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




// Route::middleware(['vendorOnly'])->group(function () {
//     Route::get('/dashboard', [VendorsController::class, 'dashboard'])->name('vendor.dashboard');
//     Route::resource('products', ProductController::class);
//     Route::get('allproducts', [ProductController::class, 'index'])->name('allproducts');
//     Route::get('product/{id}/dupe', [ProductController::class, 'dupe']);
//     Route::post('products/{id}/duplicate', [ProductController::class, 'duplicate']);
//     Route::get('products/{id}/destroy', [ProductController::class, 'destroy']);
// });


Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('admin');
});


Auth::routes(['verify' => true]);

Route::get('login/google',[LoginController::class,'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [LoginController::class,'handleGoogleCallback']);

// ADMIN ACCESS
Route::middleware(['admin'])->group(function () {

    Route::get('allmenu', [MenuController::class, 'index'])->name('allmenu');
    Route::get('addmenu', [MenuController::class, 'create'])->name('addmenu');
    Route::post('addmenu', [MenuController::class, 'store'])->name('addmenu.store');
    Route::get('menu/edit/{id}', [MenuController::class, 'edit'])->name('menu.edit');
    Route::put('menu/update/{id}', [MenuController::class, 'update'])->name('menu.update');
    Route::delete('menu/delete/{id}', [MenuController::class, 'destroy'])->name('menu.destroy');
    Route::resource('cat', CategoryController::class);
    Route::get('allcat', [CategoryController::class, 'index'])->name('allcat');
    Route::get('addcat', [CategoryController::class, 'create'])->name('addcat');
    Route::post('addcat', [CategoryController::class, 'store'])->name('addcat.store');
    Route::get('allsubcat', [SubCategoryController::class, 'index'])->name('allsubcat');
    Route::get('category/editcat/{id}', [CategoryController::class, 'edit'])->name('category.editcat');
    Route::put('category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::resource('sub-category', SubCategoryController::class);


    Route::get('users/userlist', [UserController::class, 'index'])->name('userlist');
    Route::get('users/add', [UserController::class, 'add'])->name('user.add');
    Route::post('users/adduser', [UserController::class, 'adduser'])->name('user.adduser');
    Route::get('users/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('users/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('users/delete/{id}', [UserController::class, 'delete_user'])->name('user.delete');
    Route::get('customerlist', [CustomerController::class, 'index'])->name('customerlist');
    Route::resource('users', RoleController::class);


    Route::resource('vendors', VendorsController::class);
    // Route::get('vendorlist', [VendorsController::class, 'index']);
    Route::post('vendors', [VendorsController::class, 'store'])->name('vendors.store');

    Route::resource('faqs_categories', FaqCategoriesController::class);
    Route::get('faqs_category/{id}/destroy', [FaqCategoriesController::class, 'destroy'])->name('faqs_category.destroy');
    Route::resource('faqs', FAQController::class);
    Route::get('faq/{id}/destroy', [FAQController::class, 'destroy'])->name('faq.destroy');
    Route::resource('pages', PageController::class);
    Route::get('page/{id}/destroy', [PageController::class, 'destroy'])->name('page.destroy');
    Route::resource('helpcenter', HelpCenterController::class);
    Route::get('helpcenter/{id}/destroy', [HelpCenterController::class, 'destroy']);
    Route::get('allterm', [TermsConditionsController::class, 'index'])->name('allterm');
    Route::get('addterm', [TermsConditionsController::class, 'create'])->name('addterm');
    Route::post('addterm', [TermsConditionsController::class, 'store'])->name('addterm.store');
    Route::get('terms/edit/{id}', [TermsConditionsController::class, 'edit'])->name('terms.edit');
    Route::put('terms/update/{id}', [TermsConditionsController::class, 'update'])->name('terms.update');
    Route::delete('terms/delete/{id}', [TermsConditionsController::class, 'destroy'])->name('terms.destroy');
    Route::get('terms/show/{id}', [TermsConditionsController::class, 'show'])->name('terms.show');
    Route::resource('brands', BrandController::class);
    Route::get('brands/{id}/destroy', [BrandController::class, 'destroy']);
    Route::resource('payment_method', PaymentController::class);
    Route::get('payment_method/{id}/destroy', [PaymentController::class, 'destroy']);
    Route::get('/home-settings', [HomeSettingsController::class, 'index'])->name('home-settings');
    Route::post('/update-home-settings', [HomeSettingsController::class, 'UpdateHomeSettings']);
    Route::resource('/banners', BannersController::class);
    Route::get('/banners/destroy/{id}', [BannersController::class, 'destroy'])->whereNumber('id');
    Route::resource('/settings', SettingsController::class);
    Route::resource('contacts', ContactUsController::class);
    Route::resource('reports', ReportController::class);
    Route::resource('disputes', DisputeController::class);
    Route::resource('Deals', 'App\Http\Controllers\DealsController');
    Route::resource('Homecoupons', HomecouponsController::class);
    Route::get('/notifications', 'NotificationController@showNotifications')->name('showNotifications');
    // Route::get('services/{id}/destroy', [TermsConditionsController::class, 'destroy']);
    Route::resource('blog_categories', BlogsCategoriesController::class);
    Route::get('blogs_categories/{id}/destroy', [BlogsCategoriesController::class, 'destroy']);
    Route::resource('blogs', BlogsController::class);
    Route::get('blogs/{id}/destroy', [BlogsController::class, 'destroy']);
    Route::resource('blog_subcategories', BlogsSubCategoriesController::class);
    Route::get('blogs.blog_subcategories/{id}/destroy', [BlogsSubCategoriesController::class, 'destroy']);
    Route::get('/get-subcategories-blog', [BlogsController::class, 'GetSubCategories'])->name('GetSubCategoriesForBlog');
    // Route::resource('cfeatures', CfeaturesController::class);
    Route::resource('trainingCategories', TrainingCategoriesController::class);
    Route::resource('trainings', TrainingsController::class);
    Route::resource('instructor', InstructorController::class);

    Route::get('/notifications', 'NotificationController@index')->name('notifications.index');
    Route::post('/notifications', 'NotificationController@notification')->name('notifications.notification');
    Route::get('/user-notifications', [UserController::class, 'showNotifications']);
    Route::get('/user-unread-notifications', [UserController::class, 'showUnreadNotifications']);
    Route::get('/mark-all-notifications-as-read/{userId}', [UserController::class, 'markAllNotificationsAsRead']);
    Route::resource('emails', EmailController::class);


    Route::resource('advertisements', AdvertisementController::class);
    Route::get('advertisement/{id}/destroy', [AdvertisementController::class, 'destroy'])->name('advertisement.destroy');

    Route::get('a_details', [AdvertisementOrder::class, 'details'])->name('advertisementSellers.details');
    Route::post('a_s_i_a/{id}', [AdvertisementOrder::class, 'advertisementOrderImageStatusUpdate'])->name('advertisementOrderImageUpdate');
    Route::post('a_s_i_a_1/{id}', [AdvertisementOrder::class, 'advertisementOrderDisplayStatus'])->name('advertisementOrderDisplayStatus');
});
//  ============================================================================================================================

// VENDOR ACCESS
Route::middleware(['vendor'])->group(function () {

    Route::resource('coupon', CouponController::class);
    Route::post('/toggle-coupon-status', [CouponController::class, 'toggleStatus']);
    Route::get('coupon/{id}/destroy', [PurchaseController::class, 'destroy']);

    Route::get('vendor-profile/{id}', [VendorsController::class, 'vendorProfile'])->name('vendorProfile')->middleware(['vendorOwnId']);
    Route::patch('vendorProfileSave/{id}', [VendorsController::class, 'vendorProfileSave']);
    Route::get('verified-seller/{id}', [VendorsController::class, 'verifiedSeller'])->middleware(['vendorOwnId']);
    Route::post('trustedSellerSave/{id}', [VendorsController::class, 'trustedSellerSave']);
    Route::patch('verifiedSellerSave/{id}', [VendorsController::class, 'verifiedSellerSave']);
    Route::post('SellerDocumentSave/{id}', [VendorsController::class, 'SellerDocumentSave']);
    Route::get('vendor_document/{id}/delete', [VendorsController::class, 'delete_document']);
    Route::get('bank/{id}/delete', [VendorsController::class, 'delete_bank_details']);
    Route::delete('delete-image/{image}', [VendorsController::class, 'deleteImage'])->name('delete.image');
    Route::post('/delete-image', 'VendorsController@deleteImage');


    Route::resource('purchase', PurchaseController::class);
    Route::get('purchase/{id}/destroy', [PurchaseController::class, 'destroy']);
    Route::get('purchase/history', [PurchaseController::class, 'history'])->name('purchaseHistory');
    Route::get('purchase/{id}/edit', [PurchaseController::class, 'edit']);
    Route::get('/purchase/create', [PurchaseController::class, 'create'])->name('purchase.create');
    Route::get('/get-product-name/{sku}', [PurchaseController::class, 'getProductName']);
    Route::get('/purchase/invoice/{purchaseId}', [PurchaseController::class, 'invoice'])->name('purchase.invoice');
    Route::get('/purchase/bill/{purchaseId}', [PurchaseController::class, 'bill'])->name('purchase.bill');
    Route::resource('supplier', SupplierController::class);

    Route::resource('advertisementSellers', AdvertisementSellerController::class);
    Route::post('advertisementOrder', [AdvertisementSellerController::class, 'formOrder']);
    Route::get('a_s_details', [AdvertisementOrder::class, 'SellerDetails'])->name('advertisementSellers.ASDetails');
    Route::post('a_s_image/{id}', [AdvertisementOrder::class, 'advertisementImage'])->name('advertisementImage');
    Route::get('stripe1', [StripePaymentController::class, 'stripe']);
    Route::post('stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');

    Route::resource('services', ServicesController::class);
    Route::resource('portfolios', PortfolioController::class);

});
//  ============================================================================================================================




// BOTH ACCESS
Route::middleware(['bothAccess'])->group(function () {

    Route::resource('products', ProductController::class);
    Route::get('product/{id}/dupe', [ProductController::class, 'dupe']);
    Route::post('products/{id}/duplicate', [ProductController::class, 'duplicate']);
    Route::get('products/{id}/destroy', [ProductController::class, 'destroy']);
    Route::get('/get-categories', [ProductController::class, 'GetCategories']);
    Route::get('/get-subcategories', [ProductController::class, 'GetSubCategories']);
    Route::resource('CustomerQueries', ProductContactController::class);
    Route::get('creviews', [ReviewsController::class, 'index'])->name('creviews');
    Route::view('productreviews', 'products.productreviews')->name('productreviews');
    Route::view('productinfo', 'products.productinfo')->name('productinfo');

    Route::get('/productsView', [ProductController::class, 'productsView'])->name('productsView');


    Route::get('order_details', [OrderController::class, 'OrderDetailIndex'])->name('order_details');
    Route::patch('order_details_status', [OrderController::class, 'order_details_status'])->name('order_details_status');
    Route::get('get_order_detail_status/{id}', [OrderController::class, 'GetOrderDetailStatus'])->name('get_order_detail_status');
    Route::get('get_order_details/{id}', [OrderController::class, 'GetOrderDetail'])->name('get_order_details');

// Route::get('/invoice1/{id}',function(){
//     return view('orders.invoice');
// })->name('orderInvoice1');

    Route::get('allorders', [OrderController::class, 'index'])->name('allorders');
    Route::get('orders/{id}', [OrderController::class, 'show']);
    Route::get('order_invoice/{id}', [OrderController::class, 'orderInvoice'])->name('orderInvoice');
    // Route::get('order-invoice/{id}', [OrderController::class, 'show'])->name('orderInvoice');
    Route::get('pendingorders', [OrderController::class, 'showOrders'])->name('pendingorders');
    Route::get('confirmedorders', [OrderController::class, 'showOrders'])->name('confirmedorders');
    Route::get('packagingorders', [OrderController::class, 'showOrders'])->name('packagingorders');
    Route::get('outofdelivery', [OrderController::class, 'showOrders'])->name('outofdelivery');
    Route::get('delivered', [OrderController::class, 'showOrders'])->name('delivered');
    Route::get('returned', [OrderController::class, 'showOrders'])->name('returned');
    Route::get('ftod', [OrderController::class, 'showOrders'])->name('ftod');
    Route::get('canceled', [OrderController::class, 'showOrders'])->name('canceled');
    Route::get('customer_canceled', [OrderController::class, 'showOrders'])->name('customer_canceled');
    Route::patch('orderstatus', [OrderController::class, 'update'])->name('order.status');

    Route::get('pendingrefund', [RefundController::class, 'pendingRefunds'])->name('pendingrefund');
    Route::get('approvedrefund', [RefundController::class, 'approvedRefunds'])->name('approvedrefund');
    Route::get('refundrejected', [RefundController::class, 'rejectedRefunds'])->name('refundrejected');
    Route::get('refunded', [RefundController::class, 'refundedRefunds'])->name('refunded');
    Route::get('allrefunds', [RefundController::class, 'refundstatus'])->name('allrefunds');
    Route::get('createrefund', [RefundController::class, 'create'])->name('createrefund');
    Route::post('/store-refund', [RefundController::class, 'store'])->name('refund.store');
    Route::post('/allrefunds', [RefundController::class, 'update'])->name('refund.update');

    Route::get('ewallet/collectedcash', [EwalletController::class, 'collectedcash'])->name('collectedcash');
    Route::get('ewallet/Totalbuying', [EwalletController::class, 'Totalbuying'])->name('Totalbuying');
    Route::get('ewallet/totalpendingwithdrawls', [EwalletController::class, 'totalpendingwithdrawls'])->name('totalpendingwithdrawls');
    Route::get('ewallet/totalrefund', [EwalletController::class, 'totalrefund'])->name('totalrefund');
    Route::get('ewallet/totalspendondeals', [EwalletController::class, 'totalspendondeals'])->name('totalspendondeals');
    Route::get('ewallet/totalwithdrawl', [EwalletController::class, 'totalwithdrawl'])->name('totalwithdrawl');
    Route::get('ewallet/transcationhistory', [EwalletController::class, 'transcationhistory'])->name('transcationhistory');
    Route::get('ewallet/paymentmethod', [EwalletController::class, 'paymentmethod'])->name('paymentmethod');
    Route::view('withdrawl', 'sellers.vendorwithdrawal')->name('withdrawl');
    Route::get('cwallet', [CustomerController::class, 'cwallet'])->name('cwallet');
    Route::get('sellers/show/{id}', [VendorsController::class, 'show1'])->name('sellers.show');

    // sales
    Route::resource('sales', SaleController::class);
    Route::resource('commissions', CommissionController::class);

});
//  ============================================================================================================================


// HOME PAGE CHART



// CHART

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

Route::get('/nabeeldevelops', function () {
    return view('develops.index');
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
Route::get('/fetch-notifications', 'NotificationController@fetchNotifications')->name('fetch.notifications');
Route::resource('cprofile', CprofileController::class);
Route::resource('v_service', CategoryServicesController::class);
Route::get('/products/customerqueries', [ProductContactController::class, 'index'])->name('products.customerqueries');


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
