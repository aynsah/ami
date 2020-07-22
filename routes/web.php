<?php

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
    return view('home');
})->name('index');

Route::get('/tentang-kami', 'ZakatController@front')->name('aboutus');


Route::group(['prefix' => 'donasi'], function(){
  Route::get('/', 'CampaignController@front')->name('campaigns.front');
});

Route::group(['prefix' => 'zakat'], function(){
  Route::get('/', 'ZakatController@front')->name('zakats.front');
});

Route::group(['prefix' => 'profil'], function(){
  Route::get('/', 'UserController@front')->name('users.front');
});

Route::group(['prefix' => 'berita'], function(){
  Route::get('/', 'NewController@index')->name('news.front');
});

Route::get('/', 'HomeController@index')->name('index');

Auth::routes();

// Auth::routes(['verify' => true]);
// Route::get('/home', 'HomeController@index')->middleware('verified');

Route::group(['prefix' => 'admin'], function(){
  Route::get('/', 'HomeController@home')->name('home'); 
  
  Route::resource('events', 'EventController');

  Route::resource('news', 'NewsController');

  Route::resource('campaigns', 'CampaignController');

  Route::resource('users', 'UserController');

  Route::resource('zakats', 'ZakatController');

  Route::resource('donations', 'DonationController');

  Route::resource('campaignCategories', 'CampaignCategoryController');

  Route::resource('campaignReports', 'CampaignReportController');

  Route::resource('campaignUpdates', 'CampaignUpdateController');

  Route::resource('campaignReports', 'CampaignReportController');

  Route::resource('campaignUpdates', 'CampaignUpdateController');

  Route::resource('reportCategories', 'ReportCategoryController');

  Route::resource('wishlists', 'WishlistController');
});