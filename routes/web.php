<?php

use App\Http\Controllers\addListController;
use App\Http\Controllers\addressController;
use App\Http\Controllers\addressVerifyrController;
use App\Http\Controllers\AjexController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\companyFormController;
use App\Http\Controllers\CompanyVerificationController;
use App\Http\Controllers\DutyDetail;
use App\Http\Controllers\DutyReport;
use App\Http\Controllers\employeeFormController;
use App\Http\Controllers\EmployeeVerificationController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\FilterValueController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\MasterValueController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\staffController;
use App\Http\Controllers\subFooterController;
use App\Http\Controllers\userListController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\SubscriptionController;
use App\Models\Brand;
use App\Models\Client;
use App\Models\Company;
use App\Models\CompanyVerification;
use App\Models\Cpr_ad_category;
use App\Models\Cpr_ad_enquiry;
use App\Models\Cpr_Add_post;
use App\Models\Employee;
use App\Models\Product;
use App\Models\User;
use App\Models\webUser;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
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
// Route::get('testing', function()
// {
//     $ip = request()->ip();
    

//     dd($currentUserInfo = Location::get($ip));
    
   
// });
Route::group(['middleware' => 'prevent-back-history'], function () {

    Route::get('/admin', function () {
        if (isset(auth()->user()->id)) {
            return redirect(route('dashboard'));
        } else {
            return view('gr.login');
        }
    })->name('admin');

    Route::get('/dashboard', function () {
        $del = Cpr_ad_category::where('status',1)->count('id');
        $rice = webUser::where('status',1)->count('id');
        $free = webUser::where('status',1)->where('plan','free')->count('id');
        $Boost = webUser::where('status',1)->where('plan','Boost')->count('id');
        $Premium = webUser::where('status',1)->where('plan','Premium')->count('id');
        $use =  Cpr_Add_post::count('id');
        $activeAdd =  Cpr_Add_post::where('status',1)->count('id');
        $prod =  Cpr_ad_enquiry::where('status',1)->count('id');
        return view('gr.dashboard',compact('del','rice','use','prod','activeAdd','free','Boost','Premium'));
    })->name('dashboard')->middleware('auth');

    //login

    Route::post('/login', [loginController::class, 'submitlogin']);
    Route::get('/logout', [loginController::class, 'logout']);

    //company
    Route::resource('Company',CompanyController::class)->middleware('auth');

    //company_desable
    Route::get('company_desable/{id}',[CompanyController::class,'company_desable'])->name('company_desable')->middleware('auth');
    Route::get('company_delete/{id}',[CompanyController::class,'company_delete'])->name('company_delete')->middleware('auth');
    Route::get('editcompany',[CompanyController::class,'editcompany'])->name('editcompany')->middleware('auth');
    
    

    //staff
    Route::resource('Staff',staffController::class)->middleware('auth');

    Route::get('staff_desable/{id}',[staffController::class,'staff_desable'])->name('staff_desable')->middleware('auth');
    Route::get('staff_delete/{id}',[staffController::class,'staff_delete'])->name('staff_delete')->middleware('auth');
    Route::get('editstaff',[staffController::class,'editstaff'])->name('editstaff')->middleware('auth');

    //Ricemill
    Route::resource('Client',ClientController::class)->middleware('auth');

    //client_desable
    Route::get('client_desable/{id}',[ClientController::class,'client_desable'])->name('client_desable')->middleware('auth');
    Route::get('client_delete/{id}',[ClientController::class,'client_delete'])->name('client_delete')->middleware('auth');


    //dealer
    Route::get('/dealer', [ClientController::class, 'dealer']);
    //Employee
    Route::resource('Freelancer',EmployeeController::class)->middleware('auth');
    Route::get('client_desable/{id}',[EmployeeController::class,'client_desable'])->name('client_desable')->middleware('auth');
    Route::get('employee_delete/{id}',[EmployeeController::class,'employee_delete'])->name('employee_delete')->middleware('auth');
    Route::get('editemployee',[EmployeeController::class,'editemployee'])->name('editemployee')->middleware('auth');
    Route::get('employee_desable/{id}',[EmployeeController::class,'employee_desable'])->name('employee_desable')->middleware('auth');
    //Product
    Route::resource('Product',ProductController::class)->middleware('auth');

    //product_desable
    Route::get('product_desable/{id}',[ProductController::class,'product_desable'])->name('product_desable')->middleware('auth');
    Route::get('product_delete/{id}',[ProductController::class,'product_delete'])->name('product_delete')->middleware('auth');

    Route::get('ajaxcity',[AjexController::class,'ajaxcity'])->name('ajaxcity')->middleware('auth');
    Route::get('getVendor',[AjexController::class,'getVendor'])->name('getVendor')->middleware('auth');
    Route::get('getSubAdmin',[AjexController::class,'getSub'])->name('getSub')->middleware('auth');
    Route::get('getVendorList',[AjexController::class,'getVendorList'])->name('getVendorList')->middleware('auth');
    Route::get('auction_delete/{id}',[addListController::class,'auction_delete'])->name('auction_delete')->middleware('auth');
    Route::get('auction_won/{id}',[addListController::class,'auction_won'])->name('auction_won')->middleware('auth');

    //master
    Route::resource('Master',MasterController::class)->middleware('auth');

    //master_desable
    Route::get('master_desable/{id}',[MasterController::class,'master_desable'])->name('master_desable')->middleware('auth');
    Route::get('master_delete/{id}',[MasterController::class,'master_delete'])->name('master_delete')->middleware('auth');


    //MasterValue
    Route::resource('MasterValue',MasterValueController::class)->middleware('auth');

    //masterValue_desable
    Route::get('masterValue_desable/{id}',[MasterValueController::class,'masterValue_desable'])->name('masterValue_desable')->middleware('auth');
    Route::get('masterValue_delete/{id}',[MasterValueController::class,'masterValue_delete'])->name('masterValue_delete')->middleware('auth');
    Route::get('editmastervalue',[MasterValueController::class,'editmastervalue'])->name('editmastervalue')->middleware('auth');


    //Branch
    Route::resource('Branch',BranchController::class)->middleware('auth');

    //branch_desable
    Route::get('branch_desable/{id}',[BranchController::class,'branch_desable'])->name('branch_desable')->middleware('auth');
    Route::get('branch_delete/{id}',[BranchController::class,'branch_delete'])->name('branch_delete')->middleware('auth');
    Route::get('editbranch',[BranchController::class,'editbranch'])->name('editbranch')->middleware('auth');

    Route::resource('addressVerify',addressVerifyrController::class)->middleware('auth');
    Route::get('addfieldname',[AjexController::class,'addfieldname'])->name('addfieldname')->middleware('auth');
    Route::get('fatchinput',[AjexController::class,'fatchinput'])->name('fatchinput')->middleware('auth');
    Route::get('removeDiv',[AjexController::class,'removeDiv'])->name('removeDiv')->middleware('auth');
    Route::resource('address',addressController::class)->middleware('auth');


    Route::resource('companyVerify',CompanyVerificationController::class)->middleware('auth');
    Route::get('companyaddfieldname',[AjexController::class,'companyaddfieldname'])->name('companyaddfieldname')->middleware('auth');
    Route::get('fatchinputcompany',[AjexController::class,'fatchinputcompany'])->name('fatchinputcompany')->middleware('auth');
    Route::get('removeDivcompany',[AjexController::class,'removeDivcompany'])->name('removeDivcompany')->middleware('auth');
    Route::resource('companyForm',companyFormController::class)->middleware('auth');

    Route::resource('employeeVerify',EmployeeVerificationController::class)->middleware('auth');
    Route::get('addfieldnameEmployee',[AjexController::class,'addfieldnameEmployee'])->name('addfieldnameEmployee')->middleware('auth');
    Route::get('fatchinputEmployee',[AjexController::class,'fatchinputEmployee'])->name('fatchinputEmployee')->middleware('auth');
    Route::get('removeDivEmployee',[AjexController::class,'removeDivEmployee'])->name('removeDivEmployee')->middleware('auth');
    Route::resource('employeeForm',employeeFormController::class)->middleware('auth');

    Route::resource('Brand',BrandController::class)->middleware('auth');
    Route::get('brand_delete/{id}',[BrandController::class,'brand_delete'])->name('brand_delete')->middleware('auth');
    Route::get('brand_desable/{id}',[BrandController::class,'brand_desable'])->name('brand_desable')->middleware('auth');
    Route::get('editbrand',[BrandController::class,'editbrand'])->name('editbrand')->middleware('auth');

    Route::resource('Uploads',VerificationController::class)->middleware('auth');
    Route::resource('DutyReport',DutyReport::class)->middleware('auth');
    Route::resource('DutyDetail',DutyDetail::class)->middleware('auth');
    Route::get('filterReport',[DutyReport::class,'filterReport'])->name('filterReport')->middleware('auth');
    Route::get('DutyDetailshow/{id}/{date}',[DutyDetail::class,'DutyDetailshow'])->name('DutyDetailshow')->middleware('auth');
    Route::get('verifyDetail/{id}/{type}',[DutyDetail::class,'verifyDetail'])->name('verifyDetail')->middleware('auth');

    Route::resource('Category',CategoryController::class)->middleware('auth');
    Route::get('ad-category/{id}',[CategoryController::class,'lowerCat'])->name('ad-category')->middleware('auth');
    Route::get('create-categary/{id}',[CategoryController::class,'createCategary'])->name('create-categary')->middleware('auth');
    Route::get('Category_desable/{id}/{parent_id}',[CategoryController::class,'Category_desable'])->name('Category_desable')->middleware('auth');
    Route::get('Category_enable/{id}/{parent_id}',[CategoryController::class,'Category_enable'])->name('Category_enable')->middleware('auth');
    Route::get('category_delete/{id}/{parent_id}',[CategoryController::class,'category_delete'])->name('category_delete')->middleware('auth');
    Route::get('category_edit/{id}/{parent_id}',[CategoryController::class,'category_edit'])->name('category_edit')->middleware('auth');
    Route::get('service_category_edit/{id}/{parent_id}',[CategoryController::class,'service_category_edit'])->name('service_category_edit')->middleware('auth');
    Route::get('viewSub',[CategoryController::class,'viewSub'])->name('viewSub')->middleware('auth');
    Route::get('search_category',[CategoryController::class,'search_category'])->name('search_category')->middleware('auth');
    Route::get('setHome',[CategoryController::class,'setHome'])->name('setHome')->middleware('auth');
    
    Route::get('apicat',[CategoryController::class,'apicat'])->name('apicat')->middleware('auth');
    Route::get('mapCategory',[CategoryController::class,'mapCategory'])->name('mapCategory')->middleware('auth');
    
    

    Route::resource('Filter',FilterController::class)->middleware('auth');
    Route::get('Filter_desable/{id}',[FilterController::class,'Filter_desable'])->name('Filter_desable')->middleware('auth');
    Route::get('Filter_enable/{id}',[FilterController::class,'Filter_enable'])->name('Filter_enable')->middleware('auth');
    Route::get('Filter_delete/{id}',[FilterController::class,'Filter_delete'])->name('Filter_delete')->middleware('auth');

    Route::resource('FilterValue',FilterValueController::class)->middleware('auth');
    Route::get('FilterValue_desable/{id}',[FilterValueController::class,'FilterValue_desable'])->name('FilterValue_desable')->middleware('auth');
    Route::get('FilterValue_enable/{id}',[FilterValueController::class,'Filtervalue_enable'])->name('Filtervalue_enable')->middleware('auth');
    Route::get('FilterValue_delete/{id}',[FilterValueController::class,'Filtervalue_delete'])->name('Filtervalue_delete')->middleware('auth');

    Route::resource('Banner',BannerController::class)->middleware('auth');
    Route::get('banner_disable/{id}',[BannerController::class,'banner_disable'])->name('banner_disable')->middleware('auth');
    Route::get('banner_enable/{id}',[BannerController::class,'banner_enable'])->name('banner_enable')->middleware('auth');
    Route::get('banner_delete/{id}',[BannerController::class,'banner_delete'])->name('banner_delete')->middleware('auth');

    Route::resource('Pages',PagesController::class)->middleware('auth');
    Route::get('pages_disable/{id}',[PagesController::class,'pages_disable'])->name('pages_disable')->middleware('auth');
    Route::get('pages_enable/{id}',[PagesController::class,'pages_enable'])->name('pages_enable')->middleware('auth');
    Route::get('pages_delete/{id}',[PagesController::class,'pages_delete'])->name('pages_delete')->middleware('auth');
    
    Route::resource('Footer',FooterController::class)->middleware('auth');
    Route::get('Footer_disable/{id}',[FooterController::class,'Footer_disable'])->name('Footer_disable')->middleware('auth');
    Route::get('Footer_enable/{id}',[FooterController::class,'Footer_enable'])->name('Footer_enable')->middleware('auth');
    Route::get('Footer_delete/{id}',[FooterController::class,'Footer_delete'])->name('Footer_delete')->middleware('auth');
    
    Route::resource('subFooter',subFooterController::class)->middleware('auth');
    Route::get('subFooter_disable/{id}',[subFooterController::class,'subFooter_disable'])->name('subFooter_disable')->middleware('auth');
    Route::get('subFooter_enable/{id}',[subFooterController::class,'subFooter_enable'])->name('subFooter_enable')->middleware('auth');
    Route::get('subFooter_delete/{id}',[subFooterController::class,'subFooter_delete'])->name('subFooter_delete')->middleware('auth');

    Route::resource('UserList',userListController::class)->middleware('auth');
    Route::get('user_reject/{id}',[userListController::class,'user_reject'])->name('user_reject')->middleware('auth');
    Route::get('user_approve/{id}',[userListController::class,'user_approve'])->name('user_approve')->middleware('auth');
    Route::get('user_delete/{id}',[userListController::class,'user_delete'])->name('user_delete')->middleware('auth');
    Route::get('rejectedUser',[userListController::class,'rejectedUser'])->name('rejectedUser')->middleware('auth');
    
    Route::get('api_vendors',[userListController::class,'api_vendors'])->name('api_vendors')->middleware('auth');
    Route::get('api_vendors_without_cat',[userListController::class,'api_vendors_without_cat'])->name('api_vendors_without_cat')->middleware('auth');
    
    Route::get('approveBuyer',[userListController::class,'approveBuyer'])->name('approveBuyer')->middleware('auth');
    Route::get('rejectedBuyer',[userListController::class,'rejectedBuyer'])->name('rejectedBuyer')->middleware('auth');
    
    Route::get('editUser',[userListController::class,'editUser'])->name('editUser')->middleware('auth');
    Route::post('userUpdate',[userListController::class,'userUpdate'])->name('userUpdate')->middleware('auth');
    
    Route::get('adminAddlist',[addListController::class,'index'])->name('adminAddlist')->middleware('auth');
    Route::get('adminApiAddlist',[addListController::class,'adminApiAddlist'])->name('adminApiAddlist')->middleware('auth');
    Route::get('viewImages',[addListController::class,'viewImages'])->name('viewImages')->middleware('auth');
    Route::get('Add_disable/{id}',[addListController::class,'Add_disable'])->name('Add_disable')->middleware('auth');
    Route::get('Add_enable/{id}',[addListController::class,'Add_enable'])->name('Add_enable')->middleware('auth');
    Route::get('Add_delete/{id}',[addListController::class,'Add_delete'])->name('Add_delete')->middleware('auth');
    
    // adCatReport
    Route::get('adCatReport',[addListController::class,'adCatReport'])->name('adCatReport')->middleware('auth');
    Route::get('adfilter',[addListController::class,'adfilter'])->name('adfilter')->middleware('auth');
    Route::get('adReport',[addListController::class,'adReport'])->name('adReport')->middleware('auth');
    Route::get('subReport',[addListController::class,'subReport'])->name('subReport')->middleware('auth');
    Route::get('subFilter',[addListController::class,'subFilter'])->name('subReport')->middleware('auth');
    Route::get('userReport',[addListController::class,'userReport'])->name('userReport')->middleware('auth');
    
    Route::get('adenquiry',[addListController::class,'adenquiry'])->name('adenquiry')->middleware('auth');
    Route::get('filtEnquiry',[addListController::class,'filtEnquiry'])->name('filtEnquiry')->middleware('auth');
    Route::post('assignvendor',[addListController::class,'assignvendor'])->name('assignvendor')->middleware('auth');
    
    Route::get('auctionlist',[addListController::class,'auctionlist'])->name('auctionlist')->middleware('auth');
    Route::get('getBidderList',[addListController::class,'getBidderList'])->name('getBidderList')->middleware('auth');
    

    Route::post('create_auction',[addListController::class,'create_auction'])->name('create_auction')->middleware('auth');

    Route::get('enquiry_enable/{id}',[addListController::class,'enquiry_enable'])->name('enquiry_enable')->middleware('auth');
    Route::get('enquiry_disable/{id}',[addListController::class,'enquiry_disable'])->name('enquiry_disable')->middleware('auth');
    Route::get('enquiry_delete/{id}',[addListController::class,'enquiry_delete'])->name('enquiry_delete')->middleware('auth');
    
    Route::get('SubscriberRep/{id}',[addListController::class,'SubscriberRep'])->name('SubscriberRep')->middleware('auth');
    
    Route::get('setEvent',[addListController::class,'setEvent'])->name('setEvent')->middleware('auth');
    
    Route::get('contactReport',[addListController::class,'contactReport'])->name('contactReport')->middleware('auth');
    
    Route::get('subscription_list',[SubscriptionController::class,'subscription_list'])->name('subscription_list')->middleware('auth');
    Route::post('subscription_store',[SubscriptionController::class,'subscription_store'])->name('subscription_store')->middleware('auth');
    Route::patch('subscription_update/{id}',[SubscriptionController::class,'subscription_update'])->name('subscription_update')->middleware('auth');
    Route::get('subscription_delete/{id}',[SubscriptionController::class,'subscription_delete'])->name('subscription_delete')->middleware('auth');
    Route::get('subscription_edit/{id}',[SubscriptionController::class,'subscription_edit'])->name('subscription_edit')->middleware('auth');
    Route::get('subscription_enable/{id}',[SubscriptionController::class,'subscription_enable'])->name('subscription_enable')->middleware('auth');
    Route::get('subscription_disable/{id}',[SubscriptionController::class,'subscription_disable'])->name('subscription_disable')->middleware('auth');
    Route::get('subscription_create',[SubscriptionController::class,'subscription_create'])->name('subscription_create')->middleware('auth');
    
    Route::get('active_status',[SubscriptionController::class,'active_status'])->name('active_status')->middleware('auth');
    Route::get('cat_short',[CategoryController::class,'cat_short'])->name('cat_short')->middleware('auth');
    
// 








    

});
