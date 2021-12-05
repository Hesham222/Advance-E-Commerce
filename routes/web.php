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

        Route::get('dashboard','AdminController@dashboard')->name('admin.dashboard');

########################## Begin Settings Routes #########################################################################


        Route::get('settings','AdminController@settings')->name('admin.settings');
        Route::get('logout','AdminController@logout')->name('admin.logout');
        Route::post('check-cuurent-pwd','AdminController@checkCuurentPassword')->name('admin.check-password');
        Route::post('update-cuurent-pwd','AdminController@updateCuurentPassword')->name('admin.update-password');
        Route::match(['get','post'],'update-admin-details','AdminController@updateAdminDetails');



########################## End Settings Routes #########################################################################

########################## Begin Sections Routes #########################################################################

        Route::get('sections','SectionController@sections')->name('admin.sections');
        Route::post('update-section-status','SectionController@updateSectionStatus')->name('admin.update-section');



########################## End Sections Routes #########################################################################

########################## Begin category Routes #########################################################################

        Route::get('categories','CategoryController@categories')->name('categories');
        Route::post('update-category-status','CategoryController@updateCategoryStatus')->name('admin.update-category');

        Route::match(['get','post'],'add-edit-category/{id?}','CategoryController@addEditCategory');
        Route::post('append-categoreies-level','CategoryController@appendCategorieslevel');
        Route::get('delete-category-image/{id}','CategoryController@deleteCategoryIamge');
        Route::get('delete-category/{id}','CategoryController@deleteCategory');

########################## End category Routes #########################################################################

########################## Begin Products Routes #########################################################################

        Route::get('products','ProductController@products')->name('products');
        Route::post('update-product-status','ProductController@updateProductStatus')->name('admin.update-product');
        Route::get('delete-product/{id}','ProductController@deleteProduct');
        Route::match(['get','post'],'add-edit-product/{id?}','ProductController@addEditProduct');
        Route::get('delete-product-image/{id}','ProductController@deleteProductIamge');
        Route::get('delete-product/{id}','ProductController@deleteproduct');
        Route::get('delete-product-video/{id}','ProductController@deleteProductVideo');



########################## End Products Routes #########################################################################

########################## Begin Products Attributes #########################################################################

        Route::match(['get','post'],'add-attributes/{id}','ProductController@addAttributes');
        Route::post('edit-attributes/{id}','ProductController@editAttributes');
        Route::post('update-attribute-status','ProductController@updateAttributeStatus')->name('admin.update-attribute');
        Route::get('delete-attribute/{id}','ProductController@deleteAttribute');


########################## End Products Attributesoutes #########################################################################
//images
        Route::match(['get','post'],'add-images/{id}','ProductController@addImages');
        Route::post('update-image-status','ProductController@updateImageStatus')->name('admin.update-image');
        Route::get('delete-image/{id}','ProductController@deleteImage');

########################## Begin Brands Routes #########################################################################

Route::get('brands','BrandController@brands')->name('admin.brands');
Route::post('update-brand-status','BrandController@updateBrandStatus')->name('admin.update-brand');
Route::match(['get','post'],'add-edit-brand/{id?}','BrandController@addEditBrands');




########################## End Sections Routes #########################################################################


    });

});
