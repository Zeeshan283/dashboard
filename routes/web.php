<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RefundController;
use App\Http\Controllers\VendorsController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InsertVendorsController;
use App\Http\Controllers\VendorsController;
use App\Models\User;



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
Route::view('vendorlist', 'sellers.vendorlist')->name('vendorlist');
Route::view('withdrawl', 'sellers.vendorwithdrawal')->name('withdrawl');
Route::get('sellers.addseller', [InsertVendorsController::class, 'vendorlist']);
 Route::post('add', [InsertVendorsController::class, 'add']);
 Route::get('vendorlist', [VendorsController::class, 'vendorlist'])->name('vendorlist');
//  Route::get('customerlist',[CustomerController::class,'index'])->name('customerlist');

    Route::get('editseller/{id}',[InsertVendorsController::class,'edit']);
    Route::put('update_seller/{id}',[InsertVendorsController::class,'update']);
    // Route::get('deleteseller/{id}',[InsertVendorsController::class,'deleteseller']);








// Refund
Route::view('pendingrefund', 'refund.pendingrefund')->name('pendingrefund');
Route::view('approvedrefund', 'refund.approvedrefund')->name('approvedrefund');
Route::view('refundrejected', 'refund.refundrejected')->name('refundrejected');

// Customer

Route::view('cwallet', 'customer.cwallet')->name('cwallet');


// Users

Route::view('adduser', 'users.adduser')->name('adduser');
Route::view('userlist','users.userlist')->name('userlist');

// product reviews

// Route::view('addproduct','products.addproduct')->name('addproduct');
// Route::view('allproducts','products.allproducts')->name('allproducts');
Route::view('customerqueries','products.customerqueries')->name('customerqueries');
Route::view('productinfo','products.productinfo')->name('productinfo');
Route::view('productreviews','products.productreviews')->name('productreviews');

// datatables
Route::view('datatables/basic-tables', 'datatables.basic-tables')->name('basic-tables');

// sessions
Route::view('sessions/signIn', 'sessions.signIn')->name('signIn');
Route::view('sessions/signUp', 'sessions.signUp')->name('signUp');
Route::view('sessions/forgot', 'sessions.forgot')->name('forgot');

// widgets
Route::view('widgets/card', 'widgets.card')->name('widget-card');
Route::view('widgets/statistics', 'widgets.statistics')->name('widget-statistics');
Route::view('widgets/list', 'widgets.list')->name('widget-list');
Route::view('widgets/app', 'widgets.app')->name('widget-app');
Route::view('widgets/weather-app', 'widgets.weather-app')->name('widget-weather-app');

// others
Route::view('others/notFound', 'others.notFound')->name('notFound');
Route::view('others/user-profile', 'others.user-profile')->name('user-profile');
Route::view('others/starter', 'starter')->name('starter');
Route::view('others/faq', 'others.faq')->name('faq');
Route::view('others/pricing-table', 'others.pricing-table')->name('pricing-table');
Route::view('others/search-result', 'others.search-result')->name('search-result');


// Auth::routes();



// login/sign-up checking

// Route::view('login','auth.login')->name('login');
// Route::view('signup','auth.register')->name('register');

// Auth::routes();




Route::get('/home', 'HomeController@index')->name('home');


Auth::routes();




    Route::resource('products', ProductController::class);
Route::get('allproducts', [ProductController::class,'index'])->name('allproducts');
Route::get('/get-categories', [ProductController::class, 'GetCategories']);
Route::get('/get-subcategories', [ProductController::class, 'GetSubCategories']);
// orders using controller
Route::get('allorders', [OrderController::class,'index'])->name('allorders');
Route::get('pendingorders', [OrderController::class,'showOrders'])->name('pendingorders');
Route::get('confirmedorders', [OrderController::class,'showOrders'])->name('confirmedorders');
Route::get('packagingorders', [OrderController::class,'showOrders'])->name('packagingorders');
Route::get('outofdelivery', [OrderController::class,'showOrders'])->name('outofdelivery');
Route::get('delivered', [OrderController::class,'showOrders'])->name('delivered');
Route::get('returned', [OrderController::class,'showOrders'])->name('returned');
Route::get('ftod', [OrderController::class,'showOrders'])->name('ftod');
Route::get('canceled', [OrderController::class,'showOrders'])->name('canceled');

// home controller route
Route::get('/',[HomeController::class, 'index'])->name('admin');
// Route::get('/',[HomeController::class, 'index'])->name('admin');

// customer controller route
Route::get('customerlist',[CustomerController::class,'index'])->name('customerlist');


// menu controller route
Route::get('allmenu',[MenuController::class, 'index'])->name('allmenu');
Route::get('allcat',[CategoryController::class,'index'])->name('allcat');
Route::get('allsubcat',[SubCategoryController::class, 'index'])->name('allsubcat');

// customer reviews controller

Route::get('creviews',[ReviewsController::class,'index'])->name('creviews');


// refund controller

// Route::view('refunded', 'refund.refunded')->name('refunded');
Route::get('allrefunds',[RefundController::class,'refundstatus'])->name('allrefunds');
Route::get('refunded',[RefundController::class, 'index'])->name('refunded');
Route::get('createrefund',[RefundController::class, 'create'])->name('createrefund');
Route::post('/store-refund', [RefundController::class, 'store'])->name('refund.store');

// vendors route

Route::resource('/vendor', VendorsController::class);

// add user role

Route::resource('user', RoleController::class);

