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


//Main home page
Route::get('/', 'HomeController@index');

//Login
Route::get('/login', 'Auth\LoginController@showLoginForm');
Route::post('/login', 'Auth\LoginController@login')->name('login');

//Logout
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

//User redirection and validation
Route::get('/user', 'UserController@index');

//Admin routes
Route::get('admin/home', 'AdministratorController@index');
Route::get('/admin/register-partner', 'PartnerController@create');
Route::post('/admin/register-partner', 'PartnerController@store')->name('register-partner');
Route::get('admin/register-social-service', 'SocialServiceController@create');
Route::post('admin/register-social-service', 'SocialServiceController@store')->name('register-social-service');
//------------

//Partner routes
Route::get('partner/home', 'PartnerController@index');
Route::get('partner/register-social-service', 'SocialServiceController@create');
Route::post('partner/register-social-service', 'SocialServiceController@store')->name('register-social-service');
//------------

//Student routes
Route::get('student/home', 'StudentController@index');
//------------