<?php

use Illuminate\Support\Facades\{
    Route,
    Auth
};

Route::get('/', function () {
    return redirect('login');
});

Auth::routes(['register' => false]);
Route::group(['middleware' => ['auth']], function() {
    // Admin Access
    Route::group(['middleware' => ['checkRole:admin']], function() {
        Route::get('dashboard-admin', [App\Http\Controllers\Admin\DashboardAdminController::class, 'index'])->name('dashboard.admin');
        Route::resource('users', App\Http\Controllers\Admin\UserController::class, ['except' => 'show']);
    });

    //Pimpinan Acccess
    Route::group(['middleware' => ['checkRole:pimpinan']], function() {
        Route::get('dashboard-pimpinan', [App\Http\Controllers\Pimpinan\DashboardPimpinanController::class, 'index'])->name('dashboard-pimpinan');
        Route::get('/cetak-laporan', [App\Http\Controllers\Pimpinan\DashboardPimpinanController::class, 'cetakLaporan'])->name('cetaklaporan');
        Route::group(['prefix' => 'schedule'], function() {
            Route::resource('pimpinan-offsets', App\Http\Controllers\Pimpinan\PimpinanOffsetController::class)->only(['index','show']);
            Route::get('/pimpinan/offsets/cetak-pdf', [App\Http\Controllers\Pimpinan\PimpinanOffsetController::class, 'cetakpdf'])->name('pimpinan.offsets');
            Route::resource('pimpinan-productions', App\Http\Controllers\Pimpinan\PimpinanProductionController::class)->only(['index','show']);
            Route::get('/pimpinan/productions/cetak-pdf', [App\Http\Controllers\Pimpinan\PimpinanProductionController::class, 'cetakpdf'])->name('pimpinan.productions');
            Route::resource('pimpinan-finishings', App\Http\Controllers\Pimpinan\PimpinanFinishingController::class)->only(['index','show']);
            Route::get('/pimpinan/finishings/cetak-pdf', [App\Http\Controllers\Pimpinan\PimpinanFinishingController::class, 'cetakpdf'])->name('pimpinan.finishings');
        });

    });

    // Customer Services Access
    Route::group(['middleware' => ['checkRole:customer_service']], function() {
        Route::get('/dashboard-cs', [App\Http\Controllers\Cs\DashboardCsController::class, 'index']);
        Route::group(['prefix' => 'schedule'], function() {
            Route::resource('offsets', App\Http\Controllers\Cs\CsOffsetController::class, ['except' => 'show']);
            Route::get('/offsets/cetak-pdf', [App\Http\Controllers\Cs\CsOffsetController::class, 'cetakpdf'])->name('offsets.cetakpdf');
            Route::resource('productions', App\Http\Controllers\Cs\OffsetProductionController::class)->only(['index','edit','update']);
            Route::get('/productions/cetak-pdf', [App\Http\Controllers\Cs\OffsetProductionController::class, 'cetakpdf'])->name('productions.cetakpdf');
            Route::resource('finishings', App\Http\Controllers\Cs\OffsetFinishingController::class)->only(['index','edit','update']);
            Route::get('/finishings/cetak-pdf', [App\Http\Controllers\Cs\OffsetFinishingController::class, 'cetakpdf'])->name('finishings.cetakpdf');
        });
    });

    // Kepala Divisi Offset Access
    Route::group(['middleware' => ['checkRole:kadiv_offset']], function(){
        Route::get('/dashboard-kadiv-offset', [App\Http\Controllers\KadivOffset\DashboardKadivOffsetController::class, 'index']);
        Route::resource('kadiv-offset', App\Http\Controllers\KadivOffset\KadivOffsetController::class)->only(['index','update']);
    });

    // Kepala Divisi Produksi Access
    Route::group(['middleware' => ['checkRole:kadiv_produksi']], function() {
        Route::get('/dashboard-kadiv-produksi', [App\Http\Controllers\KadivProduksi\DashboardKadivProductionController::class, 'index']);
        Route::resource('kadiv-produksi', App\Http\Controllers\KadivProduksi\KadivProductionController::class)->only(['index', 'update']);
    });

    // Kepala Divisi Finishing Access
    Route::group(['middleware' => ['checkRole:kadiv_finishing']], function() {
        Route::get('/dashboard-kadiv-finishing', [App\Http\Controllers\KadivFinishing\DashboardKadivFinishingController::class, 'index']);
        Route::resource('kadiv-finishing', App\Http\Controllers\KadivFinishing\KadivFinishingController::class)->only(['index', 'update']);
    });

    Route::get('/logout', [App\Http\Controllers\Auth\LogoutController::class, 'logout'])->name('logout');
});