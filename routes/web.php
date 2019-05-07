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

use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
//    dispatch(new \App\Jobs\SendOrderEmail);
    return view('welcome');
});

Route::get('mail', 'MailController@index');

Route::get('davery', function() {
    Mail::to('danny@example.com')->queue(new \App\Mail\Test());
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
