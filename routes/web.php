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

// Route::get('/', function () {
//     return view('index');
// })->name('home');

Route::get('/', 'SearchController@index')->name('home');

Route::post('/search', 'SearchController@searchResults')->name('search_property');
Route::post('/autosuggest', 'SearchController@getColumndata')->name('autosuggest');


Route::get('login', 'AuthenticationController@login')->name('login');
Route::post('login', 'AuthenticationController@attemptLogin')->name('attemptLogin');
Route::get('register', 'AuthenticationController@register')->name('register');
Route::post('register', 'UserController@store')->name('store_user');
Route::get('forgot_password', 'AuthenticationController@forgotPassword')->name('forgot_password');
Route::get('/logout', 'AuthenticationController@logout')->name('logout');

Route::group(['prefix' => 'dashboard'], function() {
Route::get('/superadmin', 'HomeController@superadmin')->name('superadmin_dash');
Route::get('/admin', 'HomeController@admin')->name('admin_dash');
Route::get('/agent', 'HomeController@agent')->name('agent_dash');
// Route::get('create', 'UserController@create')->name('create_user');
Route::post('create', 'UserController@store')->name('store_user');
// Route::put('{userId}/edit', 'UserController@update')->name('update_user');
// Route::get('{userId}/delete', 'UserController@delete')->name('delete_user');
});

Route::group(['prefix' => 'users'], function() {
    Route::get('/', 'UserController@index')->name('agent_index');
//     Route::get('/create', 'HouseController@create')->name('create_house');
//     Route::post('/create', 'HouseController@store')->name('store_house');
    Route::get('/show/{userId}', 'UserController@show')->name('show_user');
    Route::get('/edit/{userId}', 'UserController@edit')->name('edit_agent');
    Route::put('/edit/{userId}', 'UserController@update')->name('update_agent');
    Route::get('/{userId}/delete', 'UserController@destroy')->name('delete_agent');
    Route::get('/my-profile/{userId}', 'UserController@show')->name('my_profile');
    Route::put('/my-profile/change-password/{userId}', 'UserController@change_password')->name('change_password');
});

Route::group(['prefix' => 'landlords'], function() {
    Route::get('/', 'LandlordController@index')->name('landlord_index');
    Route::get('/create', 'LandlordController@create')->name('create_landlord');
    Route::post('/create', 'LandlordController@store')->name('store_landlord');
    Route::get('/show/{landlordId}', 'LandlordController@show')->name('show_landlord');
    Route::get('/edit/{landlordId}', 'LandlordController@edit')->name('edit_landlord');
    Route::put('/edit/{landlordId}', 'LandlordController@update')->name('update_landlord');
    Route::get('/{landlordId}/delete', 'LandlordController@destroy')->name('delete_landlord');
    Route::get('/properties/{landlordId}', 'LandlordController@show_all_property')->name('all_property');
});

Route::group(['prefix' => 'houses'], function() {
    // Route::get('/', 'HouseController@index')->name('house_index');
    Route::get('/','HouseController@index')->name('house_index');
    Route::get('/create', 'HouseController@create')->name('create_house');
    Route::post('/create', 'HouseController@store')->name('store_house');

    Route::get('/create/{landlordId}', 'HouseController@create_from_landlord_profile')->name('create_house_from_landlord');
    Route::get('/show/{houseId}', 'HouseController@show')->name('show_house');
    Route::get('/edit/{houseId}', 'HouseController@edit')->name('edit_house');
    Route::put('/edit/{houseId}', 'HouseController@update')->name('update_house');
    Route::get('/{houseId}/delete', 'HouseController@destroy')->name('delete_house');
    Route::get('/allocate/{houseId}', 'HouseController@allocate')->name('allocate_house');
    Route::post('/allocate', 'HouseController@store_allocation')->name('save_house_allocation');
    Route::get('/sell-house/{houseId}', 'HouseController@sellHouse')->name('sell_house');
    Route::post('/sell-house/', 'HouseController@store_sellHouse')->name('save_house_sale');
    Route::get('/de_allocate/{houseId}', 'HouseController@de_allocate')->name('de_allocate_house');
});

Route::group(['prefix' => 'lands'], function() {
    Route::get('/','LandController@index')->name('land_index');
    Route::get('/create', 'LandController@create')->name('create_land');
    Route::post('/create', 'LandController@store')->name('store_land');

    Route::get('/create/{landlordId}', 'LandController@create_from_landlord_profile')->name('create_land_from_landlord');
    Route::get('/show/{landId}', 'LandController@show')->name('show_land');
    Route::get('/edit/{landId}', 'LandController@edit')->name('edit_land');
    Route::put('/edit/{landId}', 'LandController@update')->name('update_land');
    Route::get('/{landId}/delete', 'LandController@destroy')->name('delete_land');
    Route::get('/allocate/{landId}', 'LandController@allocate')->name('allocate_land');
    Route::post('/allocate', 'LandController@store_allocation')->name('save_land_allocation');
    Route::get('/sell-land/{landId}', 'LandController@sellLand')->name('sell_land');
    Route::post('/sell-land/', 'LandController@store_sellLand')->name('save_land_sale');
    Route::get('/de_allocate/{landId}', 'LandController@de_allocate')->name('de_allocate_land');
});

Route::group(['prefix' => 'shops'], function() {
    Route::get('/','ShopController@index')->name('shop_index');
    Route::get('/create', 'ShopController@create')->name('create_shop');
    Route::post('/create', 'ShopController@store')->name('store_shop');

    Route::get('/create/{landlordId}', 'ShopController@create_from_landlord_profile')->name('create_shop_from_landlord');
    Route::get('/show/{shopId}', 'ShopController@show')->name('show_shop');
    Route::get('/edit/{shopId}', 'ShopController@edit')->name('edit_shop');
    Route::put('/edit/{shopId}', 'ShopController@update')->name('update_shop');
    Route::get('/{shopId}/delete', 'ShopController@destroy')->name('delete_shop');
    Route::get('/allocate/{shopId}', 'ShopController@allocate')->name('allocate_shop');
    Route::post('/allocate', 'ShopController@store_allocation')->name('save_shop_allocation');
    Route::get('/sell_shop/{shopId}', 'ShopController@sellShop')->name('sell_shop');
    Route::post('/sell-shop/', 'ShopController@store_sellShop')->name('save_shop_sale');
    Route::get('/de_allocate/{shopId}', 'ShopController@de_allocate')->name('de_allocate_shop');
});


// for clients
    Route::get('/about', 'ClientController@about')->name('about');
    Route::get('/agents', 'ClientController@agent')->name('agents');
    Route::get('/propertysell', 'ClientController@forSell')->name('forsell');
    Route::get('/propertyrent', 'ClientController@forRent')->name('forrent');
    Route::get('/propertylease', 'ClientController@forLease')->name('forlease');
    Route::get('/gallery', 'ClientController@gallery')->name('gallery');
    Route::get('/service', 'ClientController@service')->name('service');
    Route::get('/faqs', 'ClientController@faqs')->name('faqs');
    Route::get('/show/{propertyId}', 'ClientController@show')->name('show_property');
    Route::get('/request_property/{propertyId}', 'ClientController@request_property')->name('request_prop');
    Route::post('/request_property', 'ClientController@store_request')->name('store_request');
    Route::post('/get_intouch', 'ClientController@get_intouch')->name('store_get_intouch');
    Route::get('/allhouses', 'ClientController@allhouses')->name('view_houses');
    Route::get('/alllands', 'ClientController@alllands')->name('view_lands');
    Route::get('/allshops', 'ClientController@allshops')->name('view_shops');
   
