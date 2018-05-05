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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Resource
Route::get('/resources', 'ResourceController@index');
Route::post('/resources', 'ResourceController@add');

// Appointment
Route::post('/appointments', 'AppointmentController@index');
Route::post('/appointments/add', 'AppointmentController@add');
Route::get('/appointments/{id}', 'AppointmentController@view');
Route::put('/appointments/{id}', 'AppointmentController@update');

// Calendar Routes
Route::get('/waitlist', 'CalendarController@getWaitlist');