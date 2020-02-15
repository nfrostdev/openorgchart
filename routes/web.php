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

Auth::routes([
    'register' => false,
    'verify' => false,
    'confirm' => false
]);

Route::middleware('auth')->group(function () {
    Route::middleware('role:Administrator,Editor')->group(function () {
        // Administrators and Editors can modify Departments and Employees.
        Route::resource('departments', 'DepartmentController')->except('show');
        Route::resource('employees', 'EmployeeController');
    });

    Route::middleware('role:Administrator')->group(function () {
        // Only Administrators can manage other users.
        Route::resource('users', 'UserController')->except('edit', 'update');
    });

    // Users can always edit their own information to a varying degree.
    Route::resource('users', 'UserController')->only('edit', 'update');
});

// These routes will conditionally have authentication requirements depending on the "AUTHENTICATION_REQUIRED" env value.
Route::get('/', 'HomeController@index')->name('index');
Route::resource('departments', 'DepartmentController')->only(['show']);
