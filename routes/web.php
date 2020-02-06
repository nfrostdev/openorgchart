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
    Route::resource('departments', 'DepartmentController')->except('index', 'show');
    Route::resource('teams', 'TeamController');
    Route::resource('employees', 'EmployeeController');
    Route::resource('users', 'UserController');
});

Route::get('/', 'HomeController@index')->name('index');
Route::resource('departments', 'DepartmentController')->only(['index', 'show']);
