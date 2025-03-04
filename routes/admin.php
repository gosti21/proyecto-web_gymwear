<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FamilyController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');


Route::resource('families', FamilyController::class);

route::resource('categories', CategoryController::class); 