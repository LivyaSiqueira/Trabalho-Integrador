<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Auth::check() ? redirect()->route('dashboard') : view('home');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
    Route::get('/home', fn() => redirect()->route('dashboard'))->name('app.home');
    Route::get('/timer', fn() => view('timer'))->name('timer');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('admin')->group(function () {
        Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    });

    Route::get('/subject', [SubjectController::class, 'index'])->name('subject.index');
    Route::get('/subject/create', [SubjectController::class, 'create'])->name('subject.create');
    Route::post('/subject', [SubjectController::class, 'store'])->name('subject.store');
    Route::get('/subject/search', [SubjectController::class, 'search'])->name('subject.search');
    Route::get('/subject/{id}/view', [SubjectController::class, 'view'])->name('subject.view');
    Route::post('/subject/{id}/update', [SubjectController::class, 'update'])->name('subject.update');
    Route::get('/subject/{id}/destroy', [SubjectController::class, 'destroy'])->name('subject.destroy');

    Route::get('/content', [ContentController::class, 'index'])->name('content.index');
    Route::get('/content/create', [ContentController::class, 'create'])->name('content.create');
    Route::post('/content', [ContentController::class, 'store'])->name('content.store');
    Route::get('/content/search', [ContentController::class, 'search'])->name('content.search');
    Route::get('/content/{id}/view', [ContentController::class, 'view'])->name('content.view');
    Route::post('/content/{id}/update', [ContentController::class, 'update'])->name('content.update');
    Route::get('/content/{id}/destroy', [ContentController::class, 'destroy'])->name('content.destroy');
});

require __DIR__.'/auth.php';
