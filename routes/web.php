<?php
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/admin')->namespace('Admin')->group(function(){
//all admin routes
    Route::match(['get','post'],'/','AdminController@login');
    Route::group(['middleware'=> ['admin'] ],function(){
        Route::get('dashboard','AdminController@Dashboard')->name('admin.dashboard');
        Route::get('settings','AdminController@settings')->name('admin.settings');
        Route::get('logout','AdminController@logout')->name('admin.logout');
        Route::post('check-cuurent-pwd','AdminController@checkCuurentPassword')->name('admin.check-password');
        Route::post('update-cuurent-pwd','AdminController@updateCuurentPassword')->name('admin.update-password');
        Route::match(['get','post'],'update-admin-details','AdminController@updateAdminDetails');
    });

});
