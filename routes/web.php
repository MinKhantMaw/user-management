<?php

use App\Http\Controllers\DataTableController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExcelExportController;
use App\Http\Controllers\SmsController;

Route::get('/','UserController@index')->name('user.index');
Route::get('/user-create','UserController@create')->name('user.create');
Route::post('/user-store','UserController@store')->name('user.store');
Route::get('/user-show/{id}','UserController@show')->name('user.show');
Route::get('/edit-user/{id}','UserController@edit')->name('user.edit');
Route::post('/update/{id}','UserController@update')->name('user.update');
Route::post('/delete','UserController@destroy')->name('user.destroy');
Route::get('/user-search','UserController@userSearch')->name('user.search');

// Route::get('/delete','UserController@delete')->name('delete');

// excel export

// Route::get('/user-export','ExcelExportController@export')->name('user.export');

// Route::get('/user-export','ExcelExportController@excelExport')->name('export');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// datatable route
Route::get('/user-datatable',[DataTableController::class,'index'])->name('user.datatable');


// mail route
// Route::get('mail-test', function () {

//     $user = [
//         'name' => 'Harsukh Makwana',
//         'info' => 'Laravel & Python Devloper'
//     ];

//     // Mail::to('harsukh21@gmail.org')->send(new \App\Mail\NewMail($user));
//     Mail::to('mr.minkhantmaw@gmail.com')->send(new \App\Mail\TestMail($user));


// });


// Route::get('/sms-noti',[SmsController::class,'smsMessage'])->name('sms-noti');
