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


Route::get('/', 'HomeController@index')->name('home');
Route::middleware(['guest:admin', 'guest:company', 'guest:user'])->group(function () {
    Route::get('/admin/login', 'AdminController@showLoginForm')->name('admin.login');
    Route::get('/company/login', 'CompanyController@showLoginForm')->name('company.login');
    Route::get('/user/login', 'UserController@showLoginForm')->name('user.login');
    Route::get('/user/register', 'UserController@showRegisterForm')->name('user.register');
});


Route::middleware(['auth:admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');
    Route::get('/profile', 'AdminController@profile')->name('profile');
    Route::get('/settings', 'AdminController@settings')->name('settings');
    Route::get('/changePassword', 'AdminController@changePassword')->name('changePassword');
    Route::get('/logout', 'AdminController@logout')->name('logout');
});

Route::middleware(['auth:company'])->name('company.')->prefix('company')->group(function () {
    Route::get('/dashboard', 'CompanyController@dashboard')->name('dashboard');
    Route::get('/profile', 'CompanyController@profile')->name('profile');
    Route::get('/settings', 'CompanyController@settings')->name('settings');
    Route::get('/changePassword', 'CompanyController@changePassword')->name('changePassword');
    Route::get('/logout', 'CompanyController@logout')->name('logout');
});


Route::middleware(['auth:user'])->name('user.')->prefix('user')->group(function () {
    Route::get('/profile', 'UserController@profile')->name('profile');
    Route::get('/settings', 'UserController@settings')->name('settings');
    Route::get('/changePassword', 'UserController@changePassword')->name('changePassword');
    Route::get('/logout', 'UserController@logout')->name('logout');
});
