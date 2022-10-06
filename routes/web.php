<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Q1;
use App\Http\Controllers\Q2;

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

Route::get('/greeting', function () {
    return 'Hello World';
});

Route::get('/topposts', [Q1::class, 'q1']);

Route::get('/search', [Q2::class, 'q2']);