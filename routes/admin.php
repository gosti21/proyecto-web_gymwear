<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FamilyController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\VariantController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('admin.dashboard');
})->name('dashboard');

Route::get('/options', [OptionController::class, 'index'])->name('options.index');

Route::resource('categories', CategoryController::class);
Route::resource('families', FamilyController::class);
Route::resource('categories', CategoryController::class);
Route::resource('subcategories', SubCategoryController::class);
Route::resource('products', ProductController::class);

Route::get('/products/{product}/variants', [VariantController::class, 'create'])
    ->name('variants.create')
    ->scopeBindings();
Route::get('/products/{product}/variants/{variant}', [VariantController::class, 'edit'])
    ->name('variants.edit')
    ->scopeBindings();
Route::match(['put', 'patch'], '/products/{product}/variants/{variant}', [VariantController::class, 'update'])
    ->name('variants.update')
    ->scopeBindings();