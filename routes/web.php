<?php

use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('web')
    ->prefix(config('formbuilder.url_path', '/form-builder'))
    ->group(function () {
        Route::redirect('/', url(config('formbuilder.url_path', '/form-builder').'/forms'));

        /**
         * Public form url
         */
        Route::get('/form/{identifier}', [App\Http\Controllers\RenderFormController::class, 'render'])->name('form.render');
        Route::resource('/forms', 'App\Http\Controllers\FormController');
    });
