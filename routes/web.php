<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

Route::group(['middleware' => ['adminUser']], function () {
//User
    Route::get('user_type', 'backend\UserController@selectUser_type');
    Route::post('insertUserType', 'backend\UserController@insertUserType');
    Route::get('user', 'backend\UserController@selectUser');
    Route::get('selectUserFromUserPanel', 'backend\UserController@selectUserFromUserPanel');
    Route::get('getAllUserType', 'backend\UserController@getAllUserType');
    Route::post('insertUser', 'backend\UserController@insertUser');
    Route::post('getUserListByID', 'backend\UserController@getUserListByID');
    Route::post('deleteUser', 'backend\UserController@deleteUser');
    Route::get('about_us', 'backend\UserController@about_us');
    Route::post('insertAboutUs', 'backend\UserController@insertAboutUs');
    Route::post('getAboutUS', 'backend\UserController@getAboutUS');
    Route::get('contact_us ', 'backend\UserController@contact_us');
    Route::post('getContactUs ', 'backend\UserController@getContactUs');

//Login
    Route::get('dashboard ', 'backend\UserController@dashboard');
//Product & Service
    Route::get('mainSlide', 'backend\ProductController@mainSlide');
    Route::post('insertMainSlide', 'backend\ProductController@insertMainSlide');
    Route::post('getMainSlideById', 'backend\ProductController@getMainSlideById');
    Route::post('deleteSlideList', 'backend\ProductController@deleteSlideList');
    Route::get('category', 'backend\ProductController@selectCategory');
    Route::post('insertCategory', 'backend\ProductController@insertCategory');
    Route::post('getCategoryList', 'backend\ProductController@getCategoryList');
    Route::post('deleteCategory', 'backend\ProductController@deleteCategory');
    Route::get('subcategory', 'backend\ProductController@selectSubCategory');
    Route::get('getCategoryListAll', 'backend\ProductController@getCategoryListAll');
    Route::post('insertSubcategory', 'backend\ProductController@insertSubcategory');
    Route::post('insertSellerShopCategory', 'backend\ProductController@insertSellerShopCategory');
    Route::post('getSellerShopCategoryList', 'backend\ProductController@getSellerShopCategoryList');
    Route::post('getSubCategoryList', 'backend\ProductController@getSubCategoryList');
    Route::post('deleteSubCategory', 'backend\ProductController@deleteSubCategory');
    Route::get('product', 'backend\ProductController@selectProduct');
    Route::get('productSearchFromAdmin', 'backend\ProductController@productSearchFromAdmin');
    Route::post('insertProducts', 'backend\ProductController@insertProducts');
    Route::get('delivery_charge', 'backend\ProductController@delivery_charge');
    Route::post('getDeliveryCharge', 'backend\ProductController@getDeliveryCharge');
    Route::post('insertDeliveryCharge', 'backend\ProductController@insertDeliveryCharge');
    Route::post('getProductSalesOrderListByDate', 'backend\ReportController@getProductSalesOrderListByDate');
    Route::get('coupon', 'backend\ProductController@coupon');
    Route::post('insertCoupon', 'backend\ProductController@insertCoupon');
    Route::post('getCouponList', 'backend\ProductController@getCouponList');
    Route::post('deleteCoupon', 'backend\ProductController@deleteCoupon');
//Report
    Route::get('salesReport', 'backend\ReportController@salesReport');
    Route::get('approvalChange', 'backend\ReportController@approvalChange');
    Route::get('posSale', 'backend\ReportController@posSale');
    Route::get('getPOSProductSearch', 'backend\ReportController@getPOSProductSearch');
    Route::get('getPOSProductAdd', 'backend\ReportController@getPOSProductAdd');
    Route::post('insertPOSSale', 'backend\ReportController@insertPOSSale');
    Route::get('printInvoice', 'backend\ReportController@printInvoice');

//Accounting
    Route::get('accountName', 'backend\ReportController@accountName');
    Route::post('insertAccountName', 'backend\ReportController@insertAccountName');
    Route::post('getAccountingNameListById', 'backend\ReportController@getAccountingNameListById');
    Route::get('accountHead', 'backend\ReportController@accountHead');
    Route::post('insertAccountHead', 'backend\ReportController@insertAccountHead');
    Route::post('getAccountingHeadListById', 'backend\ReportController@getAccountingHeadListById');
    Route::get('accounting', 'backend\ReportController@accounting');
    Route::post('insertAccounting', 'backend\ReportController@insertAccounting');
    Route::get('getAccountHeadListAll', 'backend\ReportController@getAccountHeadListAll');
    Route::post('getAccountingReportByDate', 'backend\ReportController@getAccountingReportByDate');
    Route::post('getAccountingListById', 'backend\ReportController@getAccountingListById');
//sms & Others
    Route::get('datascrapForm', 'backend\SmsController@datascrapForm');
    Route::post('datascrap', 'backend\SmsController@datascrap');
    Route::get('sms', 'backend\SmsController@sms');
    Route::post('smsSend', 'backend\SmsController@smsSend');
    Route::get('pageSettings', 'backend\UserController@pageSettings');
    Route::get('getAllPagesText', 'backend\UserController@getAllPagesText');
    Route::post('insertPrivacy', 'backend\UserController@insertPrivacy');
    Route::post('insertTerms', 'backend\UserController@insertTerms');
});
Route::group(['middleware' => ['buyer']], function () {
    Route::post('getUserListByIdProfile', 'backend\UserController@getUserListByID');
    Route::get('myProductOrder', 'backend\UserController@myProductOrder');
    Route::post('changeAddress', 'backend\UserController@changeAddress');
    Route::post('updateProfile', 'backend\UserController@updateProfile');
});

    if(Cookie::get('buyer') != null){
        Route::get('/', 'frontend\FrontController@homepageManager');
    }
    elseif(Cookie::get('admin') != null){
        Route::get('/', 'backend\UserController@dashboard');
    }
    else{
        Route::get('/', 'frontend\FrontController@homepageManager');
    }
    Route::get('login', function () {
        return view('frontend.login');
    });
    Route::get('/clear-cache', function() {
        $exitCode = Artisan::call('cache:clear');
    });
    //Signup
    Route::get('signup', function () {
        return view('frontend.signup');
    });
    //Forgot Password
    Route::get('forgotPasswordLink', 'frontend\AuthController@forgotPasswordLink');
    Route::post('verifyEmail', 'frontend\AuthController@verifyEmail');
    Route::post('verifyForgetCode', 'frontend\AuthController@verifyForgetCode');
    Route::post('passwordUpdate', 'frontend\AuthController@passwordUpdate');
    Route::get('getAllCategory', 'backend\ProductController@getAllCategory');
    Route::get('getSubCategoryListAll', 'backend\ProductController@getSubCategoryListAll');
    Route::post('getProductList', 'backend\ProductController@getProductList');
    Route::post('deleteProduct', 'backend\ProductController@deleteProduct');

    Route::post('getUserList', 'backend\UserController@getUserList');
    Route::post('insertUser', 'backend\UserController@insertUser');
    Route::get('changeWorkingStatusProvider', 'backend\UserController@changeWorkingStatusProvider');
    Route::get('cart_view', 'frontend\FrontController@cart_view');

    Route::get('homepageManager', 'frontend\FrontController@homepageManager');
    Route::get('getAllUserTypeSignUp' , 'frontend\AuthController@getAllUserTypeSignUp');
    Route::post('insertNewUser' , 'frontend\AuthController@insertNewUser');
    Route::get('getC_wardListAll' , 'backend\UserController@getC_wardListAll');
    Route::post('verifyUser' , 'frontend\AuthController@verifyUsers');
    Route::post('verifyUser' , 'frontend\AuthController@verifyUsers');

    //FrontRoute
    Route::get('homepage' , 'frontend\FrontController@homepageManager');
    Route::get('logout' , 'frontend\AuthController@logout');
    Route::get('shop-by-cat/{id}', 'frontend\FrontController@getProductByCatId');
    Route::get('shop-by-subCat/{id}', 'frontend\FrontController@getProductBySubCatId');
    Route::post('getProductMiqty', 'frontend\FrontController@getProductMiqty');
    Route::get('cart_view', 'frontend\FrontController@cart_view');
    Route::post('product/cart_add', 'frontend\FrontController@cart_add');
    Route::post('product/cart_fetch', 'frontend\FrontController@cart_fetch');
    Route::post('product/cart_details', 'frontend\FrontController@cart_details');
    Route::post('product/cart_delete', 'frontend\FrontController@cart_delete');
    Route::post('product/cart_delete_donate', 'frontend\FrontController@cart_delete_donate');
    Route::post('product/donate', 'frontend\FrontController@donate');
    Route::post('product/donateQuantityChange', 'frontend\FrontController@donateQuantityChange');
    Route::post('sales', 'frontend\FrontController@sales');
    Route::post('transaction', 'frontend\AuthController@transaction');
    Route::post('insertContactUs', 'backend\UserController@insertContactUs');
    Route::get('getAllSaleCategory', 'frontend\FrontController@getAllSaleCategory');
    Route::post('insertSaleProduct', 'frontend\FrontController@insertSaleProduct');
    Route::get('productSales', 'frontend\FrontController@productSales');
    Route::get('searchProduct', 'frontend\FrontController@searchProduct');
    Route::get('getProductSearchByName', 'frontend\FrontController@getProductSearchByName');
    Route::get('getProductSearchDesktopByName', 'frontend\FrontController@getProductSearchDesktopByName');
    Route::post('add_wishlist', 'frontend\FrontController@add_wishlist');
    Route::post('add_comparelist', 'frontend\FrontController@add_comparelist');
    Route::post('clear_cart_wishlist', 'frontend\FrontController@clear_cart_wishlist');
    Route::post('clear_cart_compare', 'frontend\FrontController@clear_cart_compare');
    Route::post('wishlist_delete', 'frontend\FrontController@wishlist_delete');
    Route::post('compare_delete', 'frontend\FrontController@compare_delete');
    Route::post('newsletter_email_insert', 'frontend\FrontController@newsletter_email_insert');

    //New Layout Fronend
    Route::get('contact', function () {
        return view('frontend.contact');
    });
    Route::get('about', function () {
        return view('frontend.about');
    });
    Route::get('ss', function () {
        return view('frontend.my-account');
    });
    Route::get('shop', 'frontend\FrontController@shop');
    Route::get('cart', 'frontend\FrontController@cart');
    Route::get('products/{id}/{slug}', 'frontend\FrontController@productById');
    Route::get('shop-by-price/{id}', 'frontend\FrontController@shopByPrice');
    Route::post('productQuantityChange', 'frontend\FrontController@productQuantityChange');
    Route::post('clear_cart', 'frontend\FrontController@clear_cart');
    Route::get('checkout', 'frontend\FrontController@checkout');
    Route::post('verifyUserFromCheckout', 'frontend\AuthController@verifyUserFromCheckout');
    Route::post('couponCheck', 'frontend\FrontController@couponCheck');
    Route::get('sellerShop-by-id/{id}', 'frontend\FrontController@sellerShopById');
    Route::get('changeOrderStatus', 'backend\ReportController@changeOrderStatus');
    Route::get('shop-by-sub-cat', 'frontend\FrontController@shopBySubCat');
    Route::get('roleAssign', 'frontend\AuthController@roleAssign');
    Route::post('insertUserRole', 'frontend\AuthController@insertUserRole');
    Route::get('roleAssignEditPage', 'frontend\AuthController@roleAssignEditPage');
    Route::post('updateUserRole', 'frontend\AuthController@updateUserRole');
    Route::get('getSubcategoryByCat', 'frontend\FrontController@getSubcategoryByCat');
    Route::get('pages/{id}', 'backend\UserController@getPages');
    Route::get('wishlist', 'frontend\FrontController@wishlist');
    Route::get('compare', 'frontend\FrontController@compare');
    Route::get('product-increase/{id}', 'frontend\FrontController@nextproducts');
    Route::get('product-decrease/{id}', 'frontend\FrontController@beforeproducts');
    Route::get('getProductOnScroll', 'frontend\FrontController@getProductOnScroll');

    //Payment Gateway
    Route::post('getPaymentCartView', 'frontend\PaymentController@getPaymentCartView');
    Route::get('paymentFromVariousMarket', 'frontend\PaymentController@paymentFromVariousMarket');

