<?php

use App\Http\Controllers\Admin\DashboardController;
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
    Route::get('/dashboard', fn() => Auth::user()->isAdmin() ? redirect()->route('admin.dashboard') : view('dashboard'))->name('dashboard');
    Route::get('/home', fn() => redirect()->route('dashboard'))->name('app.home');
    Route::get('/timer', fn() => view('timer'))->name('timer');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('admin')->group(function () {
        Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    });

    Route::get('/subject', [SubjectController::class, 'index'])->name('subject.index');
    Route::get('/subject/create', [SubjectController::class, 'create'])->name('subject.create');
    Route::post('/subject', [SubjectController::class, 'store'])->name('subject.store');
    Route::get('/subject/search', [SubjectController::class, 'search'])->name('subject.search');
    Route::get('/subject/{id}', [SubjectController::class, 'show'])->whereNumber('id')->name('subject.show');
    Route::get('/subject/{id}/view', [SubjectController::class, 'view'])->name('subject.view');
    Route::post('/subject/{id}/update', [SubjectController::class, 'update'])->name('subject.update');
    Route::post('/subject/{id}/toggle', [SubjectController::class, 'toggle'])->name('subject.toggle');
    Route::get('/subject/{id}/destroy', [SubjectController::class, 'destroy'])->name('subject.destroy');

    // Conteúdos ficam dentro de cada matéria.
    Route::get('/subject/{subjectId}/content/create', [ContentController::class, 'create'])->name('content.create');
    Route::post('/subject/{subjectId}/content', [ContentController::class, 'store'])->name('content.store');
    Route::get('/content/{id}/view', [ContentController::class, 'view'])->name('content.view');
    Route::post('/content/{id}/update', [ContentController::class, 'update'])->name('content.update');
    Route::post('/content/{id}/toggle', [ContentController::class, 'toggle'])->name('content.toggle');
    Route::get('/content/{id}/destroy', [ContentController::class, 'destroy'])->name('content.destroy');
});

require __DIR__.'/auth.php';
