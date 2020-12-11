<?php

use App\Http\Controllers\AccountController;
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
Route::get('/test', function () {

    foreach(\App\Models\Slot::all() as $slot){
        $std=\App\Models\Student::where('slot_id',$slot->id)->select('name')->get()->toArray();
        $ss=[];
        foreach($std as $s){
            array_push($ss,$s['name']);
        }
        echo implode(',',$ss) ."<br>";
    }
});
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard','DashboardController@index')->name('dashboard');

    Route::prefix('students')->group(function(){
        Route::get('/', 'StudentController@index')->name('students');
        Route::match(['GET','POST'],'/add', 'StudentController@add')->name('students.add');
        Route::match(['GET','POST'],'/show/{std}', 'StudentController@show')->name('students.show');
        Route::match(['GET','POST'],'/ledger/{std}', 'StudentController@ledger')->name('students.ledger');
        Route::match(['GET','POST'],'/attendance/{std}', 'StudentController@attendance')->name('students.attendance');
        Route::match(['GET','POST'],'/passout/{std}', 'StudentController@passout')->name('students.passout');
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

        Route::get( 'plans/{course}', 'PaymentController@plan')->name('payment.plan');
        route::post('plan/add', 'PaymentController@planAdd')->name('payment.plan.add');
        route::post('plan/edit/{plan}', 'PaymentController@planEdit')->name('payment.plan.edit');
        route::get('plan/del/{plan}', 'PaymentController@planDel')->name('payment.plan.del');
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

    Route::prefix('users')->group(function(){
        route::get('/','UserController@index')->name('users');
        route::post('/add','UserController@add')->name('users.add');
        route::post('/edit/{user}','UserController@edit')->name('users.edit');
        route::post('/cedit','UserController@changepass')->name('users.pass');

    });

    Route::prefix('Account')->group(function(){
        route::match(['GET','POST'],'daily','AccountController@daily')->name('account.daily');
        route::match(['GET','POST'],'accept','AccountController@accept')->name('account.daily.accept');
        route::match(['GET','POST'],'acceptall','AccountController@acceptall')->name('account.daily.acceptall');

        route::match(['GET','POST'],'due','AccountController@due')->name('account.due');

    });
});
