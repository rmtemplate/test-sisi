<?php

use App\Http\Controllers\GenerateMenuController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\MenuController;
use App\Models\Karyawan;
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

Route::get('/no1-no2', function () {
    return view('no1no2');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/{heading}/{slug}', [GenerateMenuController::class, 'index'])->name('manageMenu.index');

    Route::prefix('heading-menu')->group(function () {
        Route::post('/store', [MenuController::class, 'storeHeadingMenu'])->name('headingMenu.store');
        Route::post('/destroy/heading', [MenuController::class, 'destroyHeadingMenu'])->name('headingMenu.destroy');
        Route::post('/destroy/menu', [MenuController::class, 'destroyMenu'])->name('menu.destroy');
        Route::post('/store/menu', [MenuController::class, 'storeMenu'])->name('menu.store');
    });

    Route::prefix('jabatan')->group(function () {
        Route::post('/store', [JabatanController::class, 'store'])->name('jabatan.store');
        Route::post('/destroy', [JabatanController::class, 'destroy'])->name('jabatan.destroy');
    });

    Route::prefix('karyawan')->group(function () {
        Route::get('/detail/{id}', [KaryawanController::class, 'detail'])->name('karyawan.detail');
        Route::post('/store', [KaryawanController::class, 'store'])->name('karyawan.store');
        Route::post('/destroy', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');

        Route::post('/absensi', [KaryawanController::class, 'storeAbsensi'])->name('karyawan.storeAbsen');
        Route::post('/absensi/destroy', [KaryawanController::class, 'destroyAbsensi'])->name('karyawan.destroyAbsen');

        // Cuti
        Route::post('/cuti', [KaryawanController::class, 'storeCuti'])->name('karyawan.storeCuti');
        Route::post('/cuti/destroy', [KaryawanController::class, 'destroyCuti'])->name('karyawan.destroyCuti');

        Route::post('/gaji', [KaryawanController::class, 'storeGaji'])->name('karyawan.storeGaji');
        Route::post('/gaji/destroy', [KaryawanController::class, 'destroyGaji'])->name('karyawan.destroyGaji');
    });
});
