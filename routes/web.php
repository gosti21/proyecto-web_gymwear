<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FamilyController;
use App\Http\Controllers\Admin\CategoryController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
    ->prefix('admin')
    ->group(base_path('routes/admin.php'));

    
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/families', [FamilyController::class, 'index'])->name('families.index');
    Route::get('/families/{family}/edit', [FamilyController::class, 'edit'])->name('families.edit');
    Route::get('/families/create', [FamilyController::class, 'create'])->name('families.create'); // Ruta para crear
    Route::post('/families', [FamilyController::class, 'store'])->name('families.store'); // Ruta para almacenar
    Route::put('/families/{family}', [FamilyController::class, 'update'])->name('families.update'); // Ruta para actualizar
    Route::delete('/families/{family}', [FamilyController::class, 'destroy'])->name('families.destroy'); // Ruta para eliminar


// Definir la ruta para categorías
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});
