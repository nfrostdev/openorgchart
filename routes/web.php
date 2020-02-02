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
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
    Route::resource('departments', 'DepartmentController');
    Route::resource('teams', 'TeamController');
    Route::resource('employees', 'EmployeeController');
});

Route::get('/', 'HomeController@index')->name('index');
