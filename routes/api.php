<?php

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

Route::get('/menus',[ApiController::class,'menus']);
Route::get('/categories/{menu_id}',[ApiController::class,'categories']);
Route::get('/sub_categories/{category_id}',[ApiController::class,'subCategories']);

//product Api
Route::get('/products',[ApiController::class,'Products']);
Route::get('/products/{sub_cat_Id}',[ApiController::class,'GetSubCategoryProduct'])->whereNumber('sub_cat_Id');
Route::get('/single-product/{id}', [ApiController::class, 'GetSingleProduct'])->whereNumber('id');