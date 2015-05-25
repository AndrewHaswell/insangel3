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


Route::get('/', 'GigController@index');

Route::resource('admin/gig', 'GigAdminController');
Route::resource('admin/band', 'BandAdminController');
Route::get('ajax/bands/{count}', 'AjaxController@band_drop_downs');
Route::get('admin', 'GigAdminController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
