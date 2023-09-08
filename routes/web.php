<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){

    //admin login route
    Route::match(['get', 'post'], '/login', 'AdminController@login');

    Route::group(['middleware'=>['admin']], function()
    {
    
        //admin dashboard route
        Route::get('/dashboard', 'AdminController@dashboard');

        //check admin current password
        Route::post('/check-admin-password', 'AdminController@CheckPassword');

        //update admins password
        Route::match(['get', 'post'], '/update-admin-password', 'AdminController@updatePassword');

        //update admin details
        Route::match(['get', 'post'], '/update-admin-details', 'AdminController@updateAdminDetail');

        //update vendor personal details
        Route::match(['get', 'post'], '/update-vendor-details/{slug}', 'AdminController@updateVendorDetail');

        //admin management admin
        Route::get('/admins/{type?}', 'AdminController@admins');

        //view vendors details
        Route::get('/view-vendor-details/{id?}', 'AdminController@viewVendorDetail');

        //update admin status
        Route::post('update-admin-status', 'AdminController@updateAdminStatus');
        
        //sections
        Route::get('/sections', 'SectionController@sections');
        Route::post('/update-section-status', 'SectionController@updateSectionStatus');
        Route::get('/delete-section/{id}', 'SectionController@deleteSection');
        Route::match(['get', 'post'], '/add-edit-section/{id?}', 'SectionController@addEditSection');

        //admin Categories
        Route::get('/categories', 'CategoryController@categories');
        Route::match(['get', 'post'], 'add-edit-category/{id?}', 'CategoryController@addEditCategory');
        Route::post('/update-category-status', 'CategoryController@updateCategoryStatus');
        Route::get('/delete-category/{id}', 'CategoryController@deleteCategory');
        Route::get('/delete-category-image/{id}', 'CategoryController@deleteCategoryImage');

        //brands
        Route::get('/brands', 'BrandController@brands');
        Route::post('/update-brand-status', 'BrandController@updateBrandStatus');
        Route::get('/delete-brand/{id}', 'BrandController@deleteBrand');
        Route::match(['get', 'post'], '/add-edit-brand/{id?}', 'BrandController@addEditBrand');

        //products
        Route::get('/products', 'ProductsController@products');
        Route::post('/update-product-status', 'ProductsController@updateProductStatus');
        Route::get('delete-product/{id}', 'ProductsController@deleteProduct');
        Route::match(['get', 'post'], '/add-edit-product/{id?}', 'ProductsController@addEditProduct');
        Route::get('/delete-product-image/{id}', 'ProductsController@deleteProductImage');
        Route::get('/delete-product-video/{id}', 'ProductsController@deleteProductVideo');

        //product attributes
        Route::match(['get', 'post'], '/add-edit-product-attribute/{id}', 'ProductsController@addProductAttribute');
        Route::post('/edit-attributes/{id}', 'ProductsController@updateAttribute');
        Route::post('/update-product-attribute-status', 'ProductsController@updateAttributeStatus');
        Route::get('/delete-product-attribute/{id}', 'ProductsController@deleteAttribute');

        //products image
        Route::match(['get','post'], '/add-images/{id?}', 'ProductsController@addImage');
        Route::post('/update-product-images-status', 'ProductsController@updateImageStatus');
        Route::get('/delete-images/{id}', 'ProductsController@deleteImage');

        //banners
        Route::get('/banners', 'BannersController@banner');
        Route::match(['get','post'], '/add-edit-banner/{id?}', 'BannersController@addEditBanner');
        Route::post('/update-banner-status', 'BannersController@updateBannerStatus');
        Route::get('/delete-banner/{id}', 'BannersController@deleteBanner');

    });
    //admin logout
    Route::get('/logout', 'AdminController@logout');
});

Route::namespace('App\Http\Controllers\Front')->group(function(){
    Route::get('/', 'IndexController@index');

    $catUrls = Category::select('url')->where('status', 1)->get()->pluck('url')->toArray();
    //dd($catUrls);
    foreach($catUrls as $key => $url)
    {
        Route::match(['get', 'post'], '/'.$url , 'ProductsController@listing');
    }

});


