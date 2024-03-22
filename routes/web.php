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

        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/schools', 'AdminController@schools')->name('schools');
            Route::get('/schools/edit', 'AdminController@editSchool')->name('schools.edit');

            Route::get('/departments', 'AdminController@departments')->name('departments');
            Route::get('/departments/edit', 'AdminController@editDepartment')->name('departments.edit');

            Route::get('/teachers', 'AdminController@teachers')->name('teachers');
            Route::get('/teachers/edit', 'AdminController@editTeacher')->name('teachers.edit');
            Route::delete('/teachers/delete', 'AdminController@deleteTeacher')->name('teachers.destroy');


            Route::get('/levels', 'AdminController@levels')->name('levels');

            Route::get('/classrooms', 'AdminController@classrooms')->name('classrooms');
            Route::get('/classrooms/edit', 'AdminController@editClassroom')->name('classrooms.edit');
        });

        Route::prefix('weeks')->name('weeks.')->group(function () {
            Route::get('/', 'WeekController@index')->name('index');
            Route::get('/create', 'WeekController@create')->name('create');
            Route::get('/edit', 'WeekController@edit')->name('edit');
            Route::get('/show', 'WeekController@show')->name('show');
            Route::delete('/delete', 'WeekController@destroy')->name('destroy');
        });
        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('/admin/schools', 'ReportingController@schoolReport')->name('schools');
            Route::get('/admin/schools/data', 'ReportingController@getSchoolReportData')->name('school.data');
            Route::get('/admin/departments', 'ReportingController@departmentReport')->name('departments');
            Route::get('/admin/departments/data', 'ReportingController@getDepartmentReportData')->name('department.data');
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

        Route::prefix('levels')->name('levels.')->group(function () {
            Route::get('/', 'LevelController@index')->name('index');
            Route::get('/create', 'LevelController@create')->name('create');
            Route::get('/edit', 'LevelController@edit')->name('edit');
            Route::get('/show', 'LevelController@show')->name('show');
            Route::delete('/delete', 'LevelController@destroy')->name('destroy');
        });

        Route::prefix('classrooms')->name('classrooms.')->group(function () {
            Route::get('/', 'ClassroomController@index')->name('index');
            Route::get('/create', 'ClassroomController@create')->name('create');
            Route::get('/edit', 'ClassroomController@edit')->name('edit');
            Route::get('/show', 'ClassroomController@show')->name('show');
            Route::delete('/delete', 'ClassroomController@destroy')->name('destroy');
        });


        Route::prefix('teachers')->name('teachers.')->group(function () {
            Route::get('/', 'TeacherController@index')->name('index');
            Route::get('/teachers', 'TeacherController@teachers')->name('teachers');
            Route::get('/create', 'TeacherController@create')->name('create');
            Route::get('/edit', 'TeacherController@edit')->name('edit');
            Route::get('/show', 'TeacherController@show')->name('show');
            Route::delete('/delete', 'TeacherController@destroy')->name('destroy');
        });

        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('/official/school', 'ReportingController@officialSchoolReport')->name('official.schools');
            Route::get('/official/school/data', 'ReportingController@getOfficialSchoolReportData')->name('official.school.data');
            Route::get('/official/department', 'ReportingController@officialDepartmentReport')->name('official.departments');
            Route::get('/official/department/data', 'ReportingController@getOfficialDepartmentReportData')->name('official.department.data');

        });

    });


    Route::middleware(['sub-admin'])->group(function () {

        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('/sub_admin/school', 'ReportingController@subAdminSchoolReport')->name('sub_admin.schools');
            Route::get('/sub_admin/school/data', 'ReportingController@getsubAdminSchoolReportData')->name('sub_admin.school.data');
            Route::get('/sub_admin/department', 'ReportingController@subAdminDepartmentReport')->name('sub_admin.departments');
            Route::get('/sub_admin/department/data', 'ReportingController@getsubAdminDepartmentReportData')->name('sub_admin.department.data');

        });

        Route::prefix('sub_admin')->name('sub_admin.')->group(function () {
            Route::get('/schools', 'SubAdminController@schools')->name('schools');
            Route::get('/departments', 'SubAdminController@departments')->name('departments');
            Route::get('/teachers', 'SubAdminController@teachers')->name('teachers');
            Route::get('/levels', 'SubAdminController@levels')->name('levels');
            Route::get('/classrooms', 'SubAdminController@classrooms')->name('classrooms');
        });

        // Route::middleware(['check-weeks'])->prefix('reviews')->name('reviews.')->group(function () {
        //     Route::get('/', 'ReviewController@index')->name('index');
        //     Route::get('/create', 'ReviewController@create')->name('create');
        //     Route::get('/edit', 'ReviewController@edit')->name('edit');
        //     Route::get('/show', 'ReviewController@show')->name('show');
        //     Route::delete('/delete', 'ReviewController@destroy')->name('destroy');
        // });
    });


    Route::middleware(['department-owner'])->group(function () {

        Route::middleware(['check-weeks'])->prefix('reviews')->name('reviews.')->group(function () {
            Route::get('/', 'ReviewController@index')->name('index');
            Route::get('/create', 'ReviewController@create')->name('create');
            Route::get('/edit', 'ReviewController@edit')->name('edit');
            Route::get('/show', 'ReviewController@show')->name('show');
            Route::delete('/delete', 'ReviewController@destroy')->name('destroy');
        });


        Route::prefix('department_owner')->name('department-owner.')->group(function () {
            Route::get('/departments', 'DepartmentOwnerController@departments')->name('departments');
            Route::get('/teachers', 'DepartmentOwnerController@teachers')->name('teachers');
            Route::get('/levels', 'DepartmentOwnerController@levels')->name('levels');
            Route::get('/classrooms', 'DepartmentOwnerController@classrooms')->name('classrooms');
        });
    });






});


