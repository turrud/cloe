<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LmsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\ProfileController;

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

 Route::get('/', [ViewController::class, 'index'])->name(
        'home.index'
    );

Route::get('/admin', function () {
    return view('welcome');
});

Route::middleware(['auth'])
    ->get('/dashboard', function () {
        return view('dashboard');
    })
    ->name('dashboard');

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name(
        'profile.edit'
    );
    Route::patch('/profile', [ProfileController::class, 'update'])->name(
        'profile.update'
    );
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name(
        'profile.destroy'
    );
});

Route::prefix('/admin')
    ->middleware('auth')
    ->group(function () {
        Route::get('all-lms', [LmsController::class, 'index'])->name(
            'all-lms.index'
        );
        Route::post('all-lms', [LmsController::class, 'store'])->name(
            'all-lms.store'
        );
        Route::get('all-lms/create', [LmsController::class, 'create'])->name(
            'all-lms.create'
        );
        Route::get('all-lms/{lms}', [LmsController::class, 'show'])->name(
            'all-lms.show'
        );
        Route::get('all-lms/{lms}/edit', [LmsController::class, 'edit'])->name(
            'all-lms.edit'
        );
        Route::put('all-lms/{lms}', [LmsController::class, 'update'])->name(
            'all-lms.update'
        );
        Route::delete('all-lms/{lms}', [LmsController::class, 'destroy'])->name(
            'all-lms.destroy'
        );
    });