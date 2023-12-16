<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\VendorController;
use App\Http\Controllers\API\ChatController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\VendorBiding\VendorBidingController;

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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('check-mobile-exist', [AuthController::class, 'checkMobile']);
Route::post('forgot-password', [AuthController::class, 'generateOtp']);
Route::post('reset-password', [AuthController::class, 'verifyOtpandResetPassword']);
Route::post('verify-otp', [AuthController::class, 'verifyOtp']);
Route::post('resend-otp', [AuthController::class, 'resendOtp']);
Route::get('logout/{user_id}', [AuthController::class, 'logout']);

Route::get('category-list', [CategoryController::class, 'category_list']);
Route::get('get-category', [CategoryController::class, 'get_category_list']);
Route::get('get-subcategory/{category_id}', [CategoryController::class, 'get_subcategory']);

Route::post('vendor-list', [VendorController::class, 'vendor_list']);
Route::post('more-vendors', [VendorController::class, 'getMoreVendors']);
Route::post('add-vendor', [AuthController::class, 'add_vendor']);
Route::post('add-business-profile', [VendorController::class, 'add_business_profile']);
Route::post('save-vendor', [VendorController::class, 'save_vendor']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('device-token/{user_id}', [AuthController::class, 'updateDeviceToken']);
    Route::post('membership-plan', [AuthController::class, 'membership_plan']);
    Route::post('search', [AuthController::class, 'searchDataApi']);
    Route::get('search-api', [AuthController::class, 'searchListApi']);

    Route::post('vendor-rating', [VendorController::class, 'save_vendor_rating']);
    Route::get('vendor-rating/{vendor_id}', [VendorController::class, 'get_vendor_rating']);
    Route::get('vendor-lead/{vendor_id}', [VendorController::class, 'get_vendor_lead']);
    Route::get('all-vendor-lead/{user_id}', [VendorController::class, 'get_all_vendor_lead']);
    Route::get('update-lead/{lead_id}/{status}', [VendorController::class, 'update_lead']);
    Route::post('update-host', [VendorController::class, 'update_scrapper_host']);
    Route::post('/save-vendor-plan', [VendorController::class, 'saveVendorPlan']);
    Route::post('/save-vendor-lead', [VendorController::class, 'saveVendorLead']);
    Route::get('/vendor-history/{vendor_id}', [VendorController::class, 'vendor_history']);
    Route::get('get-call-history/{id}', [VendorController::class, 'get_call_history']);
    Route::post('/save-call-logs', [VendorController::class, 'save_call_history']);

    Route::post('create-chat', [ChatController::class, 'create_chat']);
    Route::post('create-web-chat', [ChatController::class, 'createWebChat']);
    Route::get('get-chat/{user_id}', [ChatController::class, 'get_chat']);
    Route::get('get-chat-history/{chat_id}', [ChatController::class, 'get_chat_history']);
    Route::get('get-admin-chat/{user_id}', [ChatController::class, 'get_admin_chat']);
    Route::get('/get-vendor-for-chat/{chat_id}', [ChatController::class, 'getVendorForChat']);

    Route::get('user-profile/{user_id}', [UserController::class, 'user_profile']);
    Route::post('user-validate', [UserController::class, 'user_validate']);
    Route::post('edit-user-profile/{user_id}', [UserController::class, 'edit_user_profile']);
    Route::post('add-executive-number', [UserController::class, 'add_executive_number']);
    Route::post('refer-number', [UserController::class, 'refer_number']);
    Route::get('get-executive-number', [UserController::class, 'get_executive_number']);
    Route::get('get-notification/{user}', [NotificationController::class, 'get_notification']);
    Route::get('read-notification/{id}', [NotificationController::class, 'update_notification']);
    Route::get('notification/{id}', [NotificationController::class, 'notification_count']);

    Route::get('get-membership-area', [VendorController::class, 'get_membership_area']);
});

