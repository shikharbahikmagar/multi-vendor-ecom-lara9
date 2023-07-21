<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
        //admin catalogue
        Route::get('admins/catalogue/{type}', 'AdminController@adminCatalogue');
        //vendor catalogue
        Route::get('vendor/{type}', 'AdminController@vendorCatalogue');
        //add edit vendor catalogue
        Route::match(['get', 'post'], 'add-edit-catalogue/{id?}', 'AdminController@addEditGenre');
        //update genre status
        Route::post('/update-genre-status', 'AdminController@updateGenreStatus');
        Route::get('/delete-genre/{id}', 'AdminController@deleteGenre');

    });
    //admin logout
    Route::get('/logout', 'AdminController@logout');
});


