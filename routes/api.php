<?php

use App\Http\Controllers\appController;
use App\Http\Controllers\loginController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('user_registration',[appController::class,'user_registration']);
Route::post('search_datas',[appController::class,'search_data_new']);
Route::post('user_login',[appController::class,'user_login']);
Route::get('user_profile/{id}',[appController::class,'user_profile']);
Route::post('signup_app',[appController::class,'signup_app']);
Route::post('forget_password',[appController::class,'fpassword']);
Route::post('updatePassword',[appController::class,'updatePassword']);

Route::get('main_category',[appController::class,'main_category']);
Route::get('home_category',[appController::class,'home_category']);
Route::get('sub_category/{id}',[appController::class,'sub_category']);

Route::post('profile_update/{id}',[appController::class,'profile_update']);

Route::get('provider_list/{id}',[appController::class,'provider_list']);

Route::post('provider_list_subcat/{id}',[appController::class,'provider_list_subcat']);

Route::post('resend_otp',[appController::class,'resend_otp']);

Route::get('provider_detail/{id}',[appController::class,'provider_detail']);

Route::get('wish_list/{id}',[appController::class,'wish_list']);

Route::get('service_list/{id}',[appController::class,'service_list']);

Route::get('service_response/{id}',[appController::class,'service_response']);

Route::get('service_queries/{id}',[appController::class,'service_queries']);

Route::get('notification/{id}',[appController::class,'notification']);

Route::post('send_Offer/{id}',[appController::class,'send_Offer']);

Route::post('send_Offer_App/{id}',[appController::class,'send_Offer_App']);

Route::post('user_review/{id}',[appController::class,'user_review']);

Route::post('enquiry_list/{id}',[appController::class,'enquiry_list']);

Route::post('subscription/{id}',[appController::class,'subscription']);

Route::post('search_data',[appController::class,'search_data']);

Route::post('user_chat/{id}',[appController::class,'user_chat']);

Route::post('chat_list',[appController::class,'chat_list']);

Route::post('show_response',[appController::class,'show_response']);

Route::post('addtowish/{id}',[appController::class,'addtowish']);

Route::get('removefromwish/{id}',[appController::class,'removefromwish']);

Route::get('servicefilter/{id}',[appController::class,'servicefilter']);

Route::get('editService/{id}',[appController::class,'editService']);

Route::post('addService/{id}',[appController::class,'addService']);

Route::post('updateService/{id}',[appController::class,'updateService']);

Route::post('add_images/{id}',[appController::class,'add_images']);

Route::get('delete_service/{id}',[appController::class,'delete_service']);

Route::get('state_list',[appController::class,'state_list']);

Route::get('city_list/{id}',[appController::class,'city_list']);

Route::get('images_list/{id}',[appController::class,'images_list']);

Route::get('lead_history/{id}',[appController::class,'lead_history']);

Route::get('auction_list/{id}',[appController::class,'auction_list']);

Route::get('upcoming_auction_list/{id}',[appController::class,'upcoming_auction_list']);

Route::get('participants_list/{id}',[appController::class,'participants_list']);

Route::post('palce_bid/{id}',[appController::class,'palce_bid']);

Route::get('search_crone',[appController::class,'search_crone']);

Route::get('subscription_list',[appController::class,'subscription_list']);



