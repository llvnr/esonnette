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

Route::get('/qrcode', function () {
    return view('qrcode');
});

Route::get('/nouvelle-propriete', function() {
    return view("addpropriete");
});

Route::get('/propriete', function () {
    return view('propriete');
});

Route::get('/profil', function () {
    return view('profil');
});

Route::get('/inscription', function () {
    return view('inscription');
});

Route::get('/connexion', function () {
    return view('connexion');
});

Route::get('/', function () {
    return view('dashboard');
});
