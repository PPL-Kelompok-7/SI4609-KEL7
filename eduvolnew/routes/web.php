<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landingpage');
});

Route::get('register', function () {
    return view('register');
})->name('register');
 
Route::get('login', function () {
    return view('login');
})->name('login');
//Menuju halaman register oleh Selsya dan SitiN

Route::get('register', function () {
    return view('register');
})->name('register');

//


Route::get('login', function () {
    return view('login');
})->name('login');

