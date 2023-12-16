<?php

use App\Http\Controllers\CommonController;

use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\ChatController;
use App\Http\Controllers\Web\PageController;
use App\Http\Controllers\Auth\BusinessController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\AdminMenuController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\BusinessController as AdminBusinessController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\UserReviewController;
use App\Http\Controllers\Admin\EmailTemplateController;
use App\Http\Controllers\Admin\CmspagesController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\WebChatController;
use App\Http\Controllers\Admin\AssignChatController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\QueryController;
use App\Http\Controllers\Admin\MembershipPlanController;
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
Auth::routes();

Route::get('/', function () {
    return view('index');
});

Route::get('/home', function () {
    return view('index');
})->name('home');

Route::get('/contact-us', function () {
    return view('contact_us');
})->name('contact.us');
Route::post('/contact-us', [PageController::class, 'contact_us_submit'])->name('contact_us_submit');

//chat
Route::post('/chat', [ChatController::class, 'createWebChat'])->name('home.createWebChat');
Route::post('/getchat', [ChatController::class, 'getChat']);
Route::post('/getVendorForChat', [ChatController::class, 'getVendorForChat']);

//Category routes
Route::get('/category', [CategoryController::class, 'category_list']);
Route::get('/category/{slug}', [CategoryController::class, 'category_list'])->name('vendor_filter_type');
Route::get('/all-category', [CategoryController::class, 'all_category'])->name('all_category');
Route::get('/category', [CategoryController::class, 'category_list'])->name('vendor_filter');
Route::get('/search', [CategoryController::class, 'category_filter'])->name('ajax.search.auto');
Route::get('/category/{slug}/{search_title}', [CategoryController::class, 'category_list'])->name('vendor_filter_search');
Route::get('/profile/{user}', [CategoryController::class, 'vendor_details'])->name('vendor.details');
Route::post('/enquiry-now', [CategoryController::class, 'inquiry_lawyer_submit'])->name('enquiry_vendor_submit');
Route::post('ajax/vendor_review_submit', [CategoryController::class, 'vendor_review_submit']);

//common list
Route::get('/getcategory', [CommonController::class, 'getCategory'])->name('get_category');
Route::get('/getcountry', [CommonController::class, 'getCountry'])->name('get_country');
Route::get('/getstate', [CommonController::class, 'getState'])->name('get_state');
Route::get('/getcity', [CommonController::class, 'getCity'])->name('get_city');

//Login & register routes
Route::get('/otp-login', [UserController::class, 'otp_login'])
    ->middleware(['web', 'guest'])
    ->name('otp.login');
Route::get('/otp-generator', [UserController::class, 'otp_generator'])->name('otp.generator');
Route::get('/verify-otp/{id}', [UserController::class, 'show_verify_otp'])->name('verify_otp');
Route::post('/verify-otp/{id}', [UserController::class, 'verify_otp'])->name('verify_otp');

Route::post('/ajax/login', [UserController::class, 'login'])->name('ajax.login');
Route::post('/register', [UserController::class, 'register'])->name('register_save');

Route::group(['prefix' => '', 'middleware' => ['auth', 'App\Http\Middleware\UserVerification']], function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

    Route::get('/user/profile-edit', [UserController::class, 'profile_edit'])->name('user.profile_edit');
    Route::post('/user/profile-edit-save', [UserController::class, 'profile_edit_save'])->name('user.profile_edit.post');

    Route::get('/change_password', [UserController::class, 'changepassword'])->name('change.password');
    Route::post('/change_password', [UserController::class, 'changepasswordsave'])->name('change.password.save');

    Route::get('/user/enquiry', [UserController::class, 'user_enquiry'])->name('user.enquiry');
    Route::get('/user/enquiry-send', [UserController::class, 'user_enquiry_send'])->name('user.enquiry_send');

    Route::get('/user/business/profile', [BusinessController::class, 'business_profile'])->name('user.business_profile');

    Route::get('/user/business/{id}/general', [BusinessController::class, 'general_information']);

    Route::get('/user/business/general', [BusinessController::class, 'general_information'])->name('user.general_information');
    Route::post('/user/business/general', [BusinessController::class, 'general_information_save'])->name('user.general_information_save');

    Route::get('/user/business/contact', [BusinessController::class, 'business_contact'])->name('user.business_contact');
    Route::post('/user/business/contact', [BusinessController::class, 'business_contact_save'])->name('user.business_contact_save');

    Route::get('/user/business/service-location', [BusinessController::class, 'service_location'])->name('user.service_location');
    Route::post('/user/business/service-location', [BusinessController::class, 'service_location_save'])->name('user.service_location_save');

    Route::get('/user/business/other', [BusinessController::class, 'business_other'])->name('user.business_other');
    Route::post('/user/business/other', [BusinessController::class, 'business_other_save'])->name('user.business_other_save');

    Route::get('/user/business/business', [BusinessController::class, 'business_Business'])->name('user.business_Business');

    Route::get('/user/business/upload_video', [BusinessController::class, 'business_upload_video'])->name('user.business_upload_video');
    Route::post('/user/business/upload_video', [BusinessController::class, 'business_upload_video_save'])->name('user.business_upload_video_save');
    Route::get('/user/upload_video_delete/{id}', [BusinessController::class, 'business_upload_video_delete'])->name('user.upload_video_delete');
});

Route::group(['prefix' => 'admin', 'middleware' => 'App\Http\Middleware\AdminMiddleware'], function () {
    Route::get('/home', [HomeController::class, 'home'])->name('admin_home');

    Route::get('/link', [MenuController::class, 'linkadd']);

    Route::resource('/email-templates', EmailTemplateController::class);

    Route::resource('/admin', HomeController::class);

    Route::get('log/{admin_id}', [HomeController::class, 'admin_log'])->name('admin_log');
    Route::delete('log/{admin_id}/delet', [HomeController::class, 'admin_log_delete'])->name('admin_log_delet');

    Route::resource('/category', AdminCategoryController::class, [
        'names' => [
            'index' => 'admin_category',
            'create' => 'admin_category_create',
            'edit' => 'admin_category_edit',
        ],
    ]);

    Route::post('/getCategory', [AdminCategoryController::class, 'category_list']);

    Route::resource('/menu', MenuController::class, [
        'names' => [
            'index' => 'menu',
            'create' => 'create',
            'edit' => 'edit',
        ],
    ]);
    Route::resource('/admin_menu', AdminMenuController::class, [
        'names' => [
            'index' => 'admin_menu',
            'create' => 'admin_menu_create',
            'edit' => 'admin_menu_edit',
        ],
    ]);

    Route::resource('/cmspages', CmspagesController::class, [
        'names' => [
            'index' => 'admin_page',
            'create' => 'admin_page_create',
            'edit' => 'admin_page_edit',
        ],
    ]);
    Route::resource('/user', AdminUserController::class, [
        'names' => [
            'index' => 'admin_user',
            'create' => 'admin_user_create',
            'edit' => 'admin_user_edit',
        ],
    ]);

    Route::get('/user/{id}/business/profile', [AdminBusinessController::class, 'business_profile'])->name('admin.user.business_profile');

    Route::get('/user/{userid}/business/location/{id?}', [AdminBusinessController::class, 'business_location'])->name('admin.user.business_location');
    Route::post('/user/{userid}/business/location/{id?}', [AdminBusinessController::class, 'business_location_save'])->name('admin.user.business_location_save');

    Route::get('/user/business/{id}/contact', [AdminBusinessController::class, 'business_contact'])->name('admin.user.business_contact');
    Route::post('/user/business/{id}/contact', [AdminBusinessController::class, 'business_contact_save'])->name('admin.user.business_contact_save');

    Route::get('/user/business/{id}/service_location', [AdminBusinessController::class, 'service_location'])->name('admin.user.service_location');
    Route::post('/user/business/{id}/service_location', [AdminBusinessController::class, 'service_location_save'])->name('admin.user.service_location_save');

    Route::get('/user/business/{id}/other', [AdminBusinessController::class, 'business_other'])->name('admin.user.business_other');
    Route::post('/user/business/{id}/other', [AdminBusinessController::class, 'business_other_save'])->name('admin.user.business_other_save');

    Route::get('/user/business/{id}/business', [AdminBusinessController::class, 'business_Business'])->name('admin.user.business_Business');

    Route::get('/user/business/{id}/upload_video', [AdminBusinessController::class, 'business_upload_video'])->name('admin.user.business_upload_video');
    Route::post('/user/business/{id}/upload_video', [AdminBusinessController::class, 'business_upload_video_save'])->name('admin.user.business_upload_video_save');
    Route::get('/user/business/{id}/upload_video/{file?}', [AdminBusinessController::class, 'upload_video_delete'])->name('admin.user.upload_video_delete');
    Route::delete('/user/business/{id}', [AdminBusinessController::class, 'business_delete']);

    Route::resource('/contact', ContactController::class, [
        'names' => [
            'index' => 'admin_contact',
            'create' => 'admin_contact_create',
            'edit' => 'admin_contact_edit',
        ],
    ]);

    Route::resource('/role', RoleController::class, [
        'names' => [
            'index' => 'role',
            'create' => 'create',
            'edit' => 'edit',
        ],
    ]);

    Route::resource('/permission', PermissionController::class, [
        'names' => [
            'index' => 'permission',
            'create' => 'create',
        ],
    ]);

    Route::get('/web_chat', [WebChatController::class, 'index']);
    Route::post('/web_chat', [WebChatController::class, 'index']);
    Route::post('/chat', [WebChatController::class, 'createChat']);
    Route::post('/openChat', [WebChatController::class, 'openChat']);

    Route::resource('/review', UserReviewController::class, [
        'names' => [
            'index' => 'admin_review',
            'create' => 'admin_review_create',
            'edit' => 'admin_review_edit',
        ],
    ]);

    Route::resource('/membership-plan', MembershipPlanController::class, [
        'names' => [
            'index' => 'membership-plan',
            'create' => 'membership-plan_create',
            'edit' => 'membership-plan_edit',
        ],
    ]);

    Route::get('/query_for_vendor', [QueryController::class, 'index'])->name('query_for_vendor');
    Route::get('/assign-vendor-query/{id}', [QueryController::class, 'show_assign']);
    Route::post('/assign-vendor-query', [QueryController::class, 'assign_query']);

    Route::get('/assign-query/{id}', [AssignChatController::class, 'assign'])->name('admin.assignChat.assign');
    Route::get('/view-query/{id}', [AssignChatController::class, 'viewQuery']);
    Route::post('/query-assign', [AssignChatController::class, 'assign_query']);

    Route::get('/query_assign', [AssignChatController::class, 'index']);

    Route::get('/setting', [SettingController::class, 'index'])->name('admin_setting');

    Route::PUT('/setting', [SettingController::class, 'update_bulk'])->name('admin_setting_update');
    Route::get('/profile', [HomeController::class, 'profile'])->name('admin_profile');

    Route::put('/profile/{aid}', [HomeController::class, 'profile_update']);

    Route::post('/assign-query', [HomeController::class, 'assign_query']);

    Route::post('/vendor-list', [VendorController::class, 'vendor_list']);
    Route::post('/vendor-google-list', [VendorController::class, 'vendor_google_list']);
    Route::post('/vendor-share', [VendorController::class, 'vendor_share']);
    Route::get('/get-online-vendor', [VendorController::class, 'google_vendor_view'])->name('get_google_vendor');
    Route::get('/add-google-vendor', [VendorController::class, 'google_vendor_create'])->name('create_google_vendor');
    Route::post('/google-vendor-save', [VendorController::class, 'google_vendor_save']);
    Route::delete('/google-vendor/{id}', [VendorController::class, 'google_vendor_delete']);
    Route::get('/google-vendor/{id}/edit', [VendorController::class, 'google_vendor_editview']);
    Route::put('/google-vendor/{id}', [VendorController::class, 'google_vendor_edit']);
    Route::get('/membership-vendor', [VendorController::class, 'vendor_membership']);
    Route::get('/membership-vendor/{id}/upgrade', [VendorController::class, 'vendor_membership_create']);
    Route::post('/membership-vendor/add_vendor_plan', [VendorController::class, 'add_vendor_plan']);
    Route::get('/membership-vendor/{id}', [VendorController::class, 'vendor_membership_delete']);
    Route::post('/move-google-vendor', [VendorController::class, 'move_google_vendor']);

    Route::get('/logout', [HomeController::class, 'logout'])->name('admin_logout');

   
});

Route::get('/admin', [HomeController::class, 'login'])->name('admin');
Route::post('/save-token', [HomeController::class, 'saveToken'])->name('save_token');
Route::post('/save-user-token', [UserController::class, 'saveUserToken'])->name('save_user_token');

Route::post('/admin/login', [HomeController::class, 'login_save']);

Route::get('/{Cmspages}', [PageController::class, 'page']);
