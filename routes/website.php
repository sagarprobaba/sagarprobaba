<?php

use App\Http\Controllers\website\addPostController;
use App\Http\Controllers\website\FooterController;
use App\Http\Controllers\website\indexController;
use App\Http\Controllers\website\loginController;
use App\Http\Controllers\website\websiteController;
use App\Models\webUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;


Route::get('/',[indexController::class,'index'])->name('/');
Route::get('/login',[loginController::class,'index'])->name('login');
Route::get('/loginWOA',[loginController::class,'loginWOA'])->name('loginWOA');

Route::get('/forgotPassword',[loginController::class,'forgotPassword'])->name('forgotPassword');
Route::get('/resendFotp',[loginController::class,'resendFotp'])->name('resendFotp');
Route::get('/flogin',[loginController::class,'flogin'])->name('flogin');
Route::post('/fpassword',[loginController::class,'fpassword'])->name('fpassword');
Route::post('/otpmatch',[loginController::class,'otpmatch'])->name('otpmatch');
Route::post('/updatePassword',[loginController::class,'updatePassword'])->name('updatePassword');

Route::get('/logoutWeb',[loginController::class,'logout'])->name('logoutWeb');
Route::get('/resendOTP',[loginController::class,'resendOTP'])->name('logoutWeb');
Route::get('/register',[loginController::class,'register'])->name('register');
Route::post('/registerUser',[loginController::class,'registerUser'])->name('registerUser');
Route::post('/submitlogin',[loginController::class,'submitlogin'])->name('submitlogin');
Route::resource('Home',indexController::class);
Route::resource('AddPost',addPostController::class);
Route::get('/ajaxcity',[addPostController::class,'ajaxcity']);
Route::get('/product_detail/{id}',[addPostController::class,'product_detail']);
Route::post('/add_enquiry',[addPostController::class,'add_enquiry']);
Route::get('/getUserData',[addPostController::class,'getUserData']);
Route::get('/addwishList/{id}/{adId}',[addPostController::class,'addwishList']);
Route::post('/updateProfile/{id}',[addPostController::class,'updateProfile']);
Route::post('/updateProfilepassword/{id}',[addPostController::class,'updateProfilepassword']);
Route::get('/removeWish',[addPostController::class,'removeWish']);
Route::get('/deleteAdd/{id}',[addPostController::class,'deleteAdd']);
Route::get('/editAd',[addPostController::class,'editAd']);
Route::post('/addreview',[addPostController::class,'addreview']);
Route::post('/sellerreview',[addPostController::class,'sellerreview']);
Route::get('/removeImage',[addPostController::class,'removeImage']);

Route::post('/uploadImages',[addPostController::class,'uploadImages']);
Route::get('/setImageOrder',[addPostController::class,'setImageOrder']);
Route::get('/deleteTempImages',[addPostController::class,'deleteTempImages']);
Route::get('/loadimage',[addPostController::class,'loadimage']);

Route::get('/merchant-profile/{id}',[websiteController::class,'merchantProfile']);
Route::get('/follow/{id}',[websiteController::class,'follow']);
Route::get('/unfollow/{id}',[websiteController::class,'unfollow']);

Route::get('/deleteNoti/{id}',[websiteController::class,'deleteNoti']);
Route::get('/page/{slug}',[websiteController::class,'pages']);

Route::get('/terms-conditions',[websiteController::class,'termsconditions']);
Route::get('/privacy-policy',[websiteController::class,'privacypolicy']);
Route::get('/faq',[websiteController::class,'faq']);
Route::get('/about',[websiteController::class,'about']);
Route::get('/contact',[websiteController::class,'contact']);

Route::get('/getSub',[websiteController::class,'getSub']);
Route::get('/getFilter',[websiteController::class,'getFilter']);
Route::get('/userdashboard',[websiteController::class,'userdashboard'])->name('userdashboard')->middleware('webAuth');
Route::get('/adlist/{slug}',[websiteController::class,'adlist']);
Route::get('/addfilter',[websiteController::class,'addfilter']);
Route::get('/getRes',[websiteController::class,'getRes']);
Route::post('/chating',[websiteController::class,'chating']);
Route::get('/startChat/{id}',[websiteController::class,'startChat']);

Route::get('/search',[indexController::class,'search']);
Route::get('/autocomplete-search',[indexController::class,'autocompleteSearch']);
Route::post('/contactMsg',[indexController::class,'contactMsg']);
Route::get('/allcat',[indexController::class,'allcat']);

Route::get('/subcat/{slug}',[indexController::class,'subcat']);

 
Route::get('/auth/google/redirect', function () {
    return Socialite::driver('google')->redirect();
});
 
Route::get('/auth/google/callback', function () {
    $user = Socialite::driver('google')->user();
    loginController::socialLogin($user);    
    return redirect()->route('userdashboard');
});
Route::get('/auth/fbook/redirect', function () {
    return Socialite::driver('facebook')->redirect();
});
 
Route::get('/auth/fbook/callback', function () {
    $user = Socialite::driver('facebook')->user();
    loginController::socialLogin($user);   
    return redirect()->route('userdashboard');
});
Route::post('payment',[indexController::class,'payment']);
Route::get('paymentVerify',[indexController::class,'paymentVerify']);
