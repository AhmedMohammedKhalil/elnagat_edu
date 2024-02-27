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


//Route::get('/', 'HomeController@index')->name('home');
Route::middleware(['guest'])->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
});


Route::middleware(['auth'])->group(function () {

    Route::get('/profile', 'UserController@profile')->name('profile');
    Route::get('/settings', 'UserController@settings')->name('settings');
    Route::get('/changePassword', 'UserController@changePassword')->name('changePassword');
    Route::get('/logout', 'UserController@logout')->name('logout');

    Route::middleware(['admin'])->group(function () {
        Route::prefix('officials')->name('officials.')->group(function () {
            Route::get('/', 'OfficialController@index')->name('index');
            Route::get('/create', 'OfficialController@create')->name('create');
            Route::get('/edit', 'OfficialController@edit')->name('edit');
            Route::get('/show', 'OfficialController@show')->name('show');
            Route::delete('/delete', 'OfficialController@destroy')->name('destroy');
        });

    });

    Route::middleware(['admin-official'])->group(function () {
        Route::get('/dashboard', 'UserController@dashboard')->name('dashboard');
        Route::prefix('sub_admins')->name('sub_admins.')->group(function () {
            Route::get('/', 'SubAdminController@index')->name('index');
            Route::get('/create', 'SubAdminController@create')->name('create');
            Route::get('/edit', 'SubAdminController@edit')->name('edit');
            Route::get('/show', 'SubAdminController@show')->name('show');
            Route::delete('/delete', 'SubAdminController@destroy')->name('destroy');
        });

        Route::prefix('schools')->name('schools.')->group(function () {
            Route::get('/', 'SchoolController@index')->name('index');
            Route::get('/create', 'SchoolController@create')->name('create');
            Route::get('/edit', 'SchoolController@edit')->name('edit');
            Route::get('/show', 'SchoolController@show')->name('show');
            Route::delete('/delete', 'SchoolController@destroy')->name('destroy');
        });

        Route::prefix('departments')->name('departments.')->group(function () {
            Route::get('/', 'DepartmentController@index')->name('index');
            Route::get('/create', 'DepartmentController@create')->name('create');
            Route::get('/edit', 'DepartmentController@edit')->name('edit');
            Route::get('/show', 'DepartmentController@show')->name('show');
            Route::delete('/delete', 'DepartmentController@destroy')->name('destroy');
        });


        Route::prefix('teachers')->name('teachers.')->group(function () {
            Route::get('/', 'TeacherController@index')->name('index');
            Route::get('/teachers', 'TeacherController@teachers')->name('teachers');
            Route::get('/create', 'TeacherController@create')->name('create');
            Route::get('/edit', 'TeacherController@edit')->name('edit');
            Route::get('/show', 'TeacherController@show')->name('show');
            Route::delete('/delete', 'TeacherController@destroy')->name('destroy');
        });



    });


    Route::middleware(['sub-admin'])->group(function () {
    });






});


