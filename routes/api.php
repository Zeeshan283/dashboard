<?php

use App\Http\Controllers\API\UserAPIController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//  Route::middleware('auth:api')->get('/user', function (Request $request) {     return $request->user();
// });



Route::middleware(['auth:api'])->group(function () {
    Route::get('/user', function (Request $request) {
        return response()->json(['user' => $request->user()]);
    });
});

// Route::post('/send-verification-email', 'Auth\VerificationController@sendVerificationEmail')->middleware('auth:api');
Route::post('/send-verification-email/{email}', [VerificationController::class, 'sendVerificationEmail']);


// User Api
Route::controller(UserAPIController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
    Route::get('/profile/{id}', 'details')->whereNumber('id');
    Route::match(['patch', 'put'], '/update-profile', 'UpdateProfile');
});


// Auth::routes(['verify' => true]);

Route::get('/menus', [ApiController::class, 'menus']);
Route::get('/categories/{menu_id}', [ApiController::class, 'categories']);
Route::get('/sub_categories/{category_id}', [ApiController::class, 'subCategories123']);
Route::get('/products', [ApiController::class, 'Products']);
Route::get('/products/{sub_cat_Id}', [ApiController::class, 'GetSubCategoryProduct'])->whereNumber('sub_cat_Id');
Route::match(['get', 'post'], 'send-product-contact-message', [ApiController::class, 'ProductContactSendMessage']);
Route::get('/home-banners', [ApiController::class, 'Home_Banners']);
Route::get('/home-setting', [ApiController::class, 'Home_setting']);
Route::get('/site-profile', [ApiController::class, 'Site_Profile']);
Route::match(['get', 'post'], '/order-submit', [ApiController::class, 'OrderSubmit']);
Route::get('/homeapi', [ApiController::class, 'homepage']);
Route::post('/checkout', [ApiController::class, 'storeOrder']);
Route::get('/user/{userId}/orders', [ApiController::class, 'getUserOrders']);
Route::get('/vprofile/{id}', [ApiController::class, 'vendorprofile']);
Route::get('/vcoupon/{id}', [ApiController::class, 'vendorcoupon']);



// new api
Route::get('/faqs', [ApiController::class, 'FAQs']); // all faqs
// Route::get('/blogs', [ApiController::class, 'blogs']); //all blogs
Route::get('/blogs', [ApiController::class, 'getBlogs']);
Route::get('/blogs/{id}', [ApiController::class, 'getBlog']);
Route::get('/cfeatures', [ApiController::class, 'cfeatures']);
Route::get('/pages', [ApiController::class, 'Pages']);
Route::get('/brands', [ApiController::class, 'Brands']); 
Route::get('/single-product/{id}', [ApiController::class, 'GetSingleProduct'])->whereNumber('id'); 
Route::get('/p_b_menu/{identifier}', [ApiController::class, 'allProductAMenu']); 
Route::get('/p_b_cat/{identifier}', [ApiController::class, 'allProducts']); 
Route::get('/p_b_sub/{identifier}', [ApiController::class, 'allProductSubcategories']); 
Route::get('/search/product/{character}', [ApiController::class, 'SearchProduct']); 
Route::get('/f_product', [ApiController::class, 'FeaturesProduct']); 
Route::get('/s_product', [ApiController::class, 'SponserdProduct']); 
Route::get('/h_product', [ApiController::class, 'HotProduct']); 
Route::get('/d_product', [ApiController::class, 'DealProduct']); 
Route::get('/home_page_all', [ApiController::class, 'homePageAll']);
