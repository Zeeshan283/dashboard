<?php

use App\Http\Controllers\API\UserAPIController;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(UserAPIController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
    Route::get('/profile/{id}', 'details')->whereNumber('id');
    Route::match(['patch', 'put'], '/update-profile', 'UpdateProfile');
});

Route::get('/menus', [ApiController::class, 'menus']);
Route::get('/categories/{menu_id}', [ApiController::class, 'categories']);
Route::get('/sub_categories/{category_id}', [ApiController::class, 'subCategories']);

//product Api
Route::get('/products', [ApiController::class, 'Products']);
Route::get('/products/{sub_cat_Id}', [ApiController::class, 'GetSubCategoryProduct'])->whereNumber('sub_cat_Id');
Route::get('/single-product/{id}', [ApiController::class, 'GetSingleProduct'])->whereNumber('id');

Route::match(['get', 'post'], 'send-product-contact-message', [ApiController::class, 'ProductContactSendMessage']);
Route::get('/search/product/{character}', [ApiController::class, 'SearchProduct']);

Route::get('/brands', [ApiController::class, 'Brands']);
Route::get('/home-banners', [ApiController::class, 'Home_Banners']);
Route::get('/home-setting', [ApiController::class, 'Home_setting']);
Route::get('/site-profile', [ApiController::class, 'Site_Profile']);

Route::match(['get', 'post'], '/order-submit', [ApiController::class, 'OrderSubmit']);
