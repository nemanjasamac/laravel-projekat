<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AdminConsultationsController;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\RestrictUserAccessMiddleware;
use App\Http\Middleware\CheckRole;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/services/{service}', [HomeController::class, 'service'])->name('service.details');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/consultations/create', [ConsultationController::class, 'create'])->name('consultations.create');
    Route::post('/consultations', [ConsultationController::class, 'store'])->name('consultations.store');
    Route::delete('/consultations/{id}', [ConsultationController::class, 'destroy'])->name('consultations.destroy');
    Route::get('/consultations/{id}/edit', [ConsultationController::class, 'edit'])->name('consultations.edit');
    Route::put('/consultations/{id}', [ConsultationController::class, 'update'])->name('consultations.update');
});

Route::middleware(['auth', CheckRole::class.':admin,editor'])->prefix('admin')->group(function () {
    Route::get('services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::put('services/{service}', [ServiceController::class, 'update'])->name('services.update');
    
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    
    Route::get('consultations', [AdminConsultationsController::class, 'index'])->name('admin.consultations.index');
    Route::get('consultations/{consultation}/edit', [AdminConsultationsController::class, 'edit'])->name('admin.consultations.edit');
    Route::put('consultations/{consultation}', [AdminConsultationsController::class, 'update'])->name('admin.consultations.update');
});

Route::middleware(['auth', CheckRole::class.':admin'])->prefix('admin')->group(function () {
    Route::get('services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('services', [ServiceController::class, 'store'])->name('services.store');
    Route::delete('services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');
    
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    
    Route::get('consultations/create', [AdminConsultationsController::class, 'create'])->name('admin.consultations.create');
    Route::post('consultations', [AdminConsultationsController::class, 'store'])->name('admin.consultations.store');
    Route::delete('consultations/{consultation}', [AdminConsultationsController::class, 'destroy'])->name('admin.consultations.destroy');
});

require __DIR__.'/auth.php';
