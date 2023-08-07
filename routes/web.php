<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

Route::get('/', function () {
    return view('dashboard.dashboardv1');
});
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


Route::view('admin/', 'dashboard.dashboardv1')->name('admin');


// orders
Route::view('allorders', 'orders.allorders')->name('allorders');
Route::view('pendingorders', 'orders.pendingorders')->name('pendingorders');
Route::view('confirmedorders', 'orders.confirmedorders')->name('confirmedorders');
Route::view('packagingorders', 'orders.packagingorders')->name('packagingorders');
Route::view('outofdelivery', 'orders.outofdelivery')->name('outofdelivery');
Route::view('delivered', 'orders.delivered')->name('delivered');
Route::view('returned', 'orders.returned')->name('returned');
Route::view('ftod', 'orders.ftod')->name('ftod');
Route::view('canceled', 'orders.canceled')->name('canceled');


// sellers
Route::view('addseller' , 'sellers.addseller')->name('addseller');
Route::view('vendorlist', 'sellers.vendorlist')->name('vendorlist');
Route::view('withdrawl', 'sellers.vendorwithdrawal')->name('withdrawl');


// Refund
Route::view('pendingrefund', 'refund.pendingrefund')->name('pendingrefund');
Route::view('approvedrefund', 'refund.approvedrefund')->name('approvedrefund');
Route::view('refunded', 'refund.refunded')->name('refunded');
Route::view('refundrejected', 'refund.refundrejected')->name('refundrejected');

// Customer

Route::view('customerlist', 'customer.customerlist')->name('customerlist');
Route::view('creviews', 'customer.creviews')->name('creviews');
Route::view('cwallet', 'customer.cwallet')->name('cwallet');

// cateories

Route::view('allmenu','category.allmenu')->name('allmenu');
Route::view('allcat','category.allcat')->name('allcat');
Route::view('allsubcat','category.allsubcat')->name('allsubcat');

// Users

Route::view('adduser', 'users.adduser')->name('adduser');
Route::view('userlist','users.userlist')->name('userlist');

// product reviews

Route::view('addproduct','products.addproduct')->name('addproduct');
Route::view('allproducts','products.allproducts')->name('allproducts');
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
