<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    SiswaController,
    ProgramController,
    KriteriaController,
    NilaiController,
    KeputusanController,
    Auth\LoginController
};

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

// Authentication Routes
Auth::routes([
    'register' => false,
    'verify' => false,
    'reset' => false
]);

// Custom Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Redirect root to login
Route::redirect('/', '/login');

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // Siswa Resource with additional routes
    Route::prefix('siswas')->name('siswas.')->group(function () {
        Route::get('/', [SiswaController::class, 'index'])->name('index');
        Route::get('/create', [SiswaController::class, 'create'])->name('create');
        Route::post('/', [SiswaController::class, 'store'])->name('store');
        Route::get('/{siswa}', [SiswaController::class, 'show'])->name('show');
        Route::get('/{siswa}/edit', [SiswaController::class, 'edit'])->name('edit');
        Route::put('/{siswa}', [SiswaController::class, 'update'])->name('update');
        Route::delete('/{siswa}', [SiswaController::class, 'destroy'])->name('destroy');
    });
    
    // Other resources
    Route::resource('programs', ProgramController::class)->except(['show']);
    Route::resource('kriterias', KriteriaController::class)->except(['show']);
    
    // Nilai with additional routes
    Route::prefix('nilais')->name('nilais.')->group(function () {
        Route::get('/', [NilaiController::class, 'index'])->name('index');
        Route::get('/create', [NilaiController::class, 'create'])->name('create');
        Route::post('/', [NilaiController::class, 'store'])->name('store');
        Route::get('/{nilai}/edit', [NilaiController::class, 'edit'])->name('edit');
        Route::put('/{nilai}', [NilaiController::class, 'update'])->name('update');
        Route::delete('/{nilai}', [NilaiController::class, 'destroy'])->name('destroy');
        Route::post('/store-multiple', [NilaiController::class, 'storeMultiple'])->name('store-multiple');
    });
    
    // Decision System
    Route::prefix('keputusan')->name('keputusan.')->group(function () {
        Route::get('/', [KeputusanController::class, 'index'])->name('index');
        Route::get('/{siswa}', [KeputusanController::class, 'show'])->name('show');
        Route::get('/{siswa}/hasil', [KeputusanController::class, 'hasil'])->name('hasil');
    });
    
    // Reports
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/', [KeputusanController::class, 'laporan'])->name('index');
        Route::get('/export', [KeputusanController::class, 'export'])->name('export');
    });
});