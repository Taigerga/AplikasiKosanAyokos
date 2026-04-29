<?php
use App\Http\Controllers\API\PemilikDashboardController;
use App\Http\Controllers\API\NotificationController;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->group(function () {
    // Dashboard routes
    Route::get('/pemilik/dashboard', [PemilikDashboardController::class, 'index']);
    Route::get('/pemilik/dashboard/stats/kos', [PemilikDashboardController::class, 'getKosStats']);
    Route::get('/pemilik/dashboard/pendapatan/{tahun?}', [PemilikDashboardController::class, 'getPendapatanTahunan']);
    Route::get('/pemilik/dashboard/aktivitas', [PemilikDashboardController::class, 'getAktivitasTerbaru']);
});


Route::prefix('notifications')->group(function () {
    Route::post('menunggu-persetujuan/{kontrakId}', [NotificationController::class, 'sendMenungguPersetujuan']);
    Route::post('persetujuan-diterima/{kontrakId}', [NotificationController::class, 'sendPersetujuanDiterima']);
    Route::post('persetujuan-ditolak/{kontrakId}', [NotificationController::class, 'sendPersetujuanDitolak']);
    Route::post('pengajuan-baru/{kontrakId}', [NotificationController::class, 'sendPengajuanBaru']);
});
