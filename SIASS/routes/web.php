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
//------------

//Login
Route::get('/login', 'Auth\LoginController@showLoginForm');
Route::post('/login', 'Auth\LoginController@login')->name('login');
//------------

//Logout
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
//------------

//User redirection and validation
Route::get('/user', 'UserController@index');
//------------

//Admin routes
Route::get('admin/home', 'AdministratorController@index');
Route::get('/admin/register-partner', 'PartnerController@create');

Route::post('/admin/register-partner', 'PartnerController@store')->name('register-partner');
Route::get('admin/register-social-service', 'SocialServiceController@create');

Route::post('admin/confirm-social-service', 'SocialServiceController@confirm')->name('confirm-social-service');

Route::get('admin/register-student-to-social-service', 'AdministratorController@createStudentToSocialServiceRegistrationForm');
Route::post('admin/register-student-to-social-service', 'AdministratorController@storeStudentServiceObject')->name('admin-registers-student-service');

Route::get('admin/certify-student-hours', 'AdministratorController@createHoursCertificationForm');
Route::post('admin/certify-student-hours', 'AdministratorController@certifyStudentHours')->name('admin-certifies-student-hours');

Route::get('admin/filter-social-services', 'AdministratorController@filterSocialServices');
Route::get('admin/filter-students', 'AdministratorController@filterStudents');
//------------

//Partner routes
Route::get('partner/home', 'PartnerController@index');

Route::get('partner/register-social-service', 'SocialServiceController@create');
Route::post('partner/register-social-service', 'SocialServiceController@store')->name('register-social-service');

Route::get('partner/register-student-to-social-service', 'PartnerController@createStudentToSocialServiceRegistrationForm');
Route::post('partner/register-student-to-social-service', 'PartnerController@storeStudentServiceObject')->name('partner-registers-student-service');

Route::get('partner/certify-student-hours', 'PartnerController@createHoursCertificationForm');
Route::post('partner/certify-student-hours', 'PartnerController@certifyStudentHours')->name('partner-certifies-student-hours');

Route::get('partner/filter-students', 'PartnerController@filterStudents');
//------------

//Student routes
Route::get('student/home', 'StudentController@index');
//------------
