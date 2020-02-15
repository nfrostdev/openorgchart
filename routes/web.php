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
    Route::middleware('role:Administrator', 'role:Editor')->group(function () {
        Route::resource('departments', 'DepartmentController')->except('show');
        Route::resource('employees', 'EmployeeController');
    });

    Route::middleware('role:Administrator')->group(function () {
        Route::resource('users', 'UserController')->except('edit', 'update');
    });

    Route::resource('users', 'UserController')->only('edit', 'update');
});

Route::get('/', 'HomeController@index')->name('index');
Route::resource('departments', 'DepartmentController')->only(['show']);
