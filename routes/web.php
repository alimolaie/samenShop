<?php

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
//use App\Model\Admin\Category;
// use Illuminate\Http\Request;

use App\Http\Controllers\front\CategoryComponent;

Route::get('/','IndexController@index');

Route::get('cart', 'IndexController@cart')->name('cart');
Route::get('add-to-cart/{id}', 'IndexController@addToCart')->name('add.to.cart');
Route::patch('update-cart', 'IndexController@updateCart')->name('update.cart');
Route::delete('remove-from-cart','IndexController@removeCart')->name('remove.from.cart');
Route::get('payment', 'IndexController@payment')->name('payment');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('user');






//admin router
Route::prefix('admin')->group(function () {

    Route::get('/', 'AdminAuthController@index');
    Route::post('/login', 'AdminAuthController@login')->name('adminLogin');
    Route::get('/logout', 'AdminAuthController@logout')->name('adminLogout');
    Route::get('/home','AdminController@index')->middleware('Admin');
    Route::get('/forgot', 'AdminAuthController@forgot');
    Route::post('/email', 'AdminAuthController@sendResetLinkEmail')->name('admin.email');
    Route::get('/forgot/{token}', 'AdminAuthController@showResetForm')->name('admin.reset');
    Route::post('/forgot/{token}', 'AdminAuthController@resetPassword')->name('admin.token');


});



//user authentication
/*
Route::get('/login', 'UserAuthController@index');
Route::post('/user/login', 'UserAuthController@login')->name('userLogin');
Route::get('/user/logout', 'HomeController@logout')->name('user.logout');
Route::get('/user/home', 'HomeController@index');
Route::get('/user/forgot', 'UserAuthController@forgot');
Route::post('user/email', 'UserAuthController@sendResetLinkEmail')->name('user.email');
Route::get('user/forgot/{token}', 'UserAuthController@showResetForm')->name('user.reset');
Route::post('user/forgot/{token}', 'UserAuthController@resetPassword')->name('user.token');

*/



    //Login Routes
    Route::get('/login','Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login','Auth\LoginController@login');
    Route::get('/user/logout', 'HomeController@logout')->name('user.logout');

    //Forgot Password Routes
    Route::get('/password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

    //Reset Password Routes
    Route::get('/password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('/password/reset','Auth\ResetPasswordController@reset')->name('password.update');

    //chnage Admin password
    Route::middleware(['Admin'])->group(function () {
     Route::get('/admin/Change/Password','AdminController@changePassword')->name('admin.password.change');
    Route::post('/admin/password/update','AdminController@updatePass')->name('admin.password.update');

    });
    //Admin section
    //category
    Route::group(['middleware' => ['Admin']], function () {
        Route::get('/admin/categories','Admin\Category\CategoryController@category')->name('categories');
    Route::post('/admin/categories/post','Admin\Category\CategoryController@storeCategory')->name('store.category');
    Route::delete('/delete/categories/{id}','Admin\Category\CategoryController@deleteCategory');
    Route::get('edit/category/{id}','Admin\Category\CategoryController@editCategory');
    Route::post('update/categories/{id}','Admin\Category\CategoryController@updateCategory')->name('update.category');
    });
    //category

    //brands
    Route::group(['middleware' => ['Admin']], function () {
    Route::get('/admin/brands','BrandController@brands')->name('brands');
    Route::post('/admin/brands/store','BrandController@storeBrand')->name('store.brand');
    Route::get('edit/brand/{id}','BrandController@editBrand');
    Route::post('update/brand/{id}','BrandController@updateBrand')->name('update.brand');
});
    //subcategory
    Route::group(['middleware' => ['Admin']], function () {
    Route::get('/admin/sub-category','Admin\Category\SubCategoryController@subCategory')->name('subCategories');
    Route::post('/admin/sub-category/post','Admin\Category\SubCategoryController@storeSubCategory')->name('store.subcategory');
    Route::get('edit/subcategory/{id}','Admin\Category\SubCategoryController@editSubCategory');
    Route::post('update/subcategory/{id}','Admin\Category\SubCategoryController@updateSubCategory')->name('update.subcategory');
});
    //coupon
    Route::group(['middleware' => ['Admin']], function () {
    Route::get('/admin/coupon','Admin\Category\CouponController@coupon')->name('admin.coupon');
    Route::post('/admin/coupon/post','Admin\Category\CouponController@storeCoupon')->name('store.coupon');
    Route::delete('/delete/coupon','Admin\Category\CouponController@deleteCoupon');

    Route::get('edit/coupon/{id}','Admin\Category\CouponController@editCoupon');
    Route::post('update/coupon/{id}','Admin\Category\CouponController@updateCoupon')->name('update.coupon');
});

    //Newslaters
    Route::group(['middleware' => ['Admin']], function () {
    Route::get('/admin/newslaters','Admin\Category\CouponController@newslaters')->name('admin.newslaters');
});
    //frontend Newslaters

    Route::post('/admin/newslater/post','IndexController@storeNewslater')->name('store.subscriber');

    //Product All routers
    Route::group(['middleware' => ['Admin']], function () {
    Route::get('/admin/product/all','Admin\ProductController@index')->name('all.product');
    Route::get('/admin/product/add','Admin\ProductController@create')->name('add.product');
    Route::post('/admin/product/store','Admin\ProductController@store')->name('store.product');


    Route::get('/inactive/product/{id}','Admin\ProductController@inActive');
    Route::get('/active/product/{id}','Admin\ProductController@active');

    Route::get('/active/product/{id}','Admin\ProductController@active');

    Route::get('/edit/product/{id}','Admin\ProductController@edit');
    Route::post('/admin/product/update/{id}','Admin\ProductController@update')->name('update.product');
    Route::delete('/admin/product/delete/{id}','Admin\ProductController@destroy')->name('delete.product');
    //for show subcategory with ajax

    Route::get('/get/subcategory/{category_id}','Admin\ProductController@getSubCategory');
});

//blog admin routers
Route::group(['middleware' => ['Admin']], function () {
    Route::get('/blog/category/list','PostController@blogCategoryList')->name('add.blog.categorylist');
    Route::post('store/blog/categories/','PostController@storeBlogCategory')->name('store.category.blog');
    Route::get('/delete/blog/category/{id}','PostController@deleteBlogCategory');
    Route::get('/edit/blog/category/{id}','PostController@editBlogCategory');
    Route::post('/update/blog/category/{id}','PostController@updateBlogCategory')->name('update.category.blog');

});
