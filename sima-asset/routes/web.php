<?php

use App\Http\Controllers\Admin\AsetController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InventarisController;
use App\Http\Controllers\Admin\PelaporanController;
use App\Http\Controllers\Admin\PerbaikanController;
use App\Http\Controllers\Admin\RuanganController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
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

Route::get('/', [AuthController::class, 'index'])->name('login-show');
Route::post('/', [AuthController::class, 'login'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    });

    Route::prefix('inventaris')->group(function(){
        Route::get('/', [InventarisController::class,'index'])->name('inventaris-index');
        Route::get('/create', [InventarisController::class, 'create'])->name('inventaris-create');
        Route::post('/store', [InventarisController::class, 'store'])->name('inventaris-store');
        Route::get('/edit/{inventarisId}', [InventarisController::class, 'edit'])->name('inventaris-edit');
        Route::put('/update/{inventarisId}', [InventarisController::class, 'update'])->name('inventaris-update');
        Route::delete('/delete/{inventarisId}', [InventarisController::class, 'destroy'])->name('inventaris-delete');
        Route::get('/inventaris/{inventarisId}', [InventarisController::class, 'show'])->name('inventaris-detail');
        Route::get('/export-pdf/{inventarisId}', [InventarisController::class, 'exportPDF'])->name('inventaris-export-pdf');
        Route::get('/generate-qr/{inventarisId}', [InventarisController::class, 'generateQrCode'])->name('invetaris-generate-qr');
        Route::get('/export-qr/{ivnentarisId}', [InventarisController::class, 'exportBarcode'])->name('inventaris-export-barcode');
    });

    Route::prefix('master')->group(function () {
        Route::prefix('user')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('user-index');
            Route::get('/create', [UserController::class, 'create'])->name('user-create');
            Route::post('/store', [UserController::class, 'store'])->name('user-store');
            Route::get('/edit/{userId}', [UserController::class, 'edit'])->name('user-edit');
            Route::put('/update/{userId}', [UserController::class, 'update'])->name('user-update');
            Route::delete('/delete/{userId}', [UserController::class, 'destroy'])->name('user-delete');
        });

        Route::prefix('aset')->group(function () {
            Route::get('/', [AsetController::class, 'index'])->name('aset-index');
            Route::get('/create', [AsetController::class, 'create'])->name('aset-create');
            Route::post('/store', [AsetController::class, 'store'])->name('aset-store');
            Route::get('/edit/{asetId}', [AsetController::class, 'edit'])->name('aset-edit');
            Route::put('/update/{asetId}', [AsetController::class, 'update'])->name('aset-update');
            Route::delete('/delete/{asetId}', [AsetController::class, 'destroy'])->name('aset-delete');
        });

        Route::prefix('ruangan')->group(function () {
            Route::get('/', [RuanganController::class, 'index'])->name('ruangan-index');
            Route::get('/create', [RuanganController::class, 'create'])->name('ruangan-create');
            Route::post('/store', [RuanganController::class, 'store'])->name('ruangan-store');
            Route::get('/edit/{ruanganId}', [RuanganController::class, 'edit'])->name('ruangan-edit');
            Route::put('/update/{ruanganId}', [RuanganController::class, 'update'])->name('ruangan-update');
            Route::delete('/delete/{ruanganId}', [RuanganController::class, 'destroy'])->name('ruangan-delete');
        });
    });

    Route::prefix('pemeliharaan')->group(function(){
        Route::prefix('pelaporan')->group(function(){
            Route::get('/', [PelaporanController::class, 'index'])->name('pelaporan-index');
            Route::get('/create', [PelaporanController::class, 'create'])->name('pelaporan-create');
            Route::get('/detail/{pelaporanId}', [PelaporanController::class,'show'])->name('pelaporan-detail');
            Route::post('/store', [PelaporanController::class, 'store'])->name('pelaporan-store');
            Route::delete('/delete/{pelaporanId}', [PelaporanController::class, 'destroy'])->name('pelaporan-delete');
        }); 

        Route::prefix('perbaikan')->group(function(){
            Route::get('/', [PerbaikanController::class, 'index'])->name('perbaikan-index');
            Route::get('/detail/{perbaikanId}', [PerbaikanController::class, 'show'])->name('perbaikan-detail');
            Route::get('/approved/{perbaikanId}', [PerbaikanController::class, 'approved'])->name('perbaikan-approved');
            Route::put('/{perbaikanId}', [PerbaikanController::class, 'perbaikan'])->name('perbaikan');
            Route::put('/done/{perbaikanId}', [PerbaikanController::class, 'done'])->name('perbaikan-done');
        });
    });
});
