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

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('students')->group(function(){
        Route::get('/', 'StudentController@index')->name('students');
        Route::match(['GET','POST'],'/add', 'StudentController@add')->name('students.add');
        Route::match(['GET','POST'],'/show/{std}', 'StudentController@show')->name('students.show');
    });

    Route::prefix('courses')->group(function(){
        Route::get('/', 'CourseController@index')->name('courses');
        Route::post('/add', 'CourseController@add')->name('courses.add');
        Route::post('/edit/{c}', 'CourseController@edit')->name('courses.edit');
        Route::get('/del/{c}', 'CourseController@delete')->name('courses.del');
    });

    Route::prefix('payments')->group(function(){
        
        Route::post('/add', 'PaymentController@add')->name('payments.add');
        Route::post('/edit/{pay}', 'PaymentController@edit')->name('payments.edit');
        Route::get('/del/{pay}', 'PaymentController@delete')->name('payments.del');
    });

    Route::prefix('slots')->group(function(){
        Route::get('/', 'SlotController@index')->name('slots');
        Route::post('/add', 'SlotController@add')->name('slots.add');
        Route::post('/edit/{slot}', 'SlotController@edit')->name('slots.edit');
        Route::get('/del/{slot}', 'SlotController@delete')->name('slots.del');
    });

    Route::prefix('attendances')->group(function(){
        Route::get('/', 'AttendanceController@index')->name('attendances');
        Route::post('/save', 'AttendanceController@save')->name('attendances.save');
        Route::post('/get', 'AttendanceController@get')->name('attendances.get');
    });

    
});
