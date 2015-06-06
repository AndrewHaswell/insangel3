<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Intervention\Image\Facades\Image;

Route::get('/', 'GigController@index');

Route::get('/pic2', function () {

  $img = Image::make('downloads/band_logos/gunsN\'Roses.png')->trim();

  return $img->response('png');
});

Route::get('/bands', 'BandController@index');
Route::get('/venues', 'VenueController@index');

Route::get('admin/download', 'GigAdminController@gig_list');

Route::resource('admin/gig', 'GigAdminController');
Route::resource('admin/band', 'BandAdminController');
Route::resource('admin/venue', 'VenueAdminController');
Route::resource('admin/cms', 'CmsAdminController');

Route::get('ajax/bands/{count}', 'AjaxController@band_drop_downs');
Route::get('admin', 'GigAdminController@index');

Route::controllers(['auth'     => 'Auth\AuthController',
                    'password' => 'Auth\PasswordController',]);
