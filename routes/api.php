<?php

use Illuminate\Support\Facades\Route;

/* ============================================================
   AUTH
   ============================================================ */
use App\Http\Controllers\Api\AuthController;

/* ============================================================
   PUBLIC / BROWSING
   ============================================================ */
use App\Http\Controllers\Api\PublicController;
use App\Http\Controllers\Api\KosController;
use App\Http\Controllers\Api\KamarController;
use App\Http\Controllers\Api\FasilitasController;
use App\Http\Controllers\Api\ReviewController;

/* ============================================================
   ADMIN
   ============================================================ */
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\API\AdminDashboardController;

/* ============================================================
   PEMILIK
   ============================================================ */
use App\Http\Controllers\Api\PemilikController;
use App\Http\Controllers\API\PemilikDashboardController;
use App\Http\Controllers\API\PemilikKosController;
use App\Http\Controllers\API\PemilikKamarController;
use App\Http\Controllers\API\PemilikKontrakController;
use App\Http\Controllers\API\PemilikPembayaranController;
use App\Http\Controllers\API\PemilikReviewController;
use App\Http\Controllers\API\PemilikProfileController;
use App\Http\Controllers\API\PemilikAnalisisController;

/* ============================================================
   PENGHUNI
   ============================================================ */
use App\Http\Controllers\Api\PenghuniController;
use App\Http\Controllers\API\PenghuniDashboardController;
use App\Http\Controllers\API\PenghuniKontrakController;
use App\Http\Controllers\API\PenghuniPembayaranController;
use App\Http\Controllers\API\PenghuniReviewController;
use App\Http\Controllers\API\PenghuniProfileController;
use App\Http\Controllers\API\PenghuniAnalisisController;

/* ============================================================
   LAINNYA
   ============================================================ */
use App\Http\Controllers\Api\KontrakSewaController;
use App\Http\Controllers\Api\PembayaranController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\PengaturanKosController;
use App\Http\Controllers\API\FotoKosController;
use App\Http\Controllers\API\KosFasilitasController;
use App\Http\Controllers\API\PaymentCallbackController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// ==================== PUBLIC API ====================
Route::prefix('public')->group(function () {
    Route::get('/home', [PublicController::class, 'home']);
    Route::get('/kos', [PublicController::class, 'kosIndex']);
    Route::get('/kos/{id}', [PublicController::class, 'kosShow']);
    Route::get('/peta', [PublicController::class, 'peta']);
    Route::get('/about', [PublicController::class, 'about']);
    Route::get('/how-to', [PublicController::class, 'howto']);
    Route::get('/terms', [PublicController::class, 'terms']);
    Route::get('/privacy', [PublicController::class, 'privacy']);
});

// ==================== AUTH (PUBLIC) ====================
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register/penghuni', [AuthController::class, 'registerPenghuni']);
    Route::post('/register/pemilik', [AuthController::class, 'registerPemilik']);
});

// ==================== PUBLIC RESOURCES (BROWSING ONLY) ====================
// Hanya index & show yang dibuka untuk publik
Route::apiResource('kos', KosController::class)->only(['index', 'show']);
Route::apiResource('kamar', KamarController::class)->only(['index', 'show']);
Route::apiResource('fasilitas', FasilitasController::class)->only(['index', 'show']);
Route::apiResource('reviews', ReviewController::class)->only(['index', 'show']);

// ==================== PAYMENT CALLBACK (WEBHOOK) ====================
Route::post('/payment/callback', [PaymentCallbackController::class, 'handleCallback']);
Route::get('/payment/simulate/{externalId}', [PaymentCallbackController::class, 'simulatePayment']);

// ==================== PROTECTED ROUTES (SANCTUM) ====================
Route::middleware('auth:sanctum')->group(function () {

    // -------- Auth --------
    Route::prefix('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);
    });

    // -------- Notifications --------
    Route::prefix('notifications')->group(function () {
        Route::post('menunggu-persetujuan/{kontrakId}', [NotificationController::class, 'sendMenungguPersetujuan']);
        Route::post('persetujuan-diterima/{kontrakId}', [NotificationController::class, 'sendPersetujuanDiterima']);
        Route::post('persetujuan-ditolak/{kontrakId}', [NotificationController::class, 'sendPersetujuanDitolak']);
        Route::post('pengajuan-baru/{kontrakId}', [NotificationController::class, 'sendPengajuanBaru']);
    });

    // -------- Special Routes (spesifik harus di atas resource) --------
    Route::get('/pengaturan-kos/kos/{idKos}', [PengaturanKosController::class, 'showByKos']);
    Route::get('/foto-kos/kos/{idKos}', [FotoKosController::class, 'showByKos']);
    Route::get('/kos-fasilitas/kos/{idKos}', [KosFasilitasController::class, 'showByKos']);

    // ==================== ADMIN ====================
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index']);

        // CRUD data master (dipindahkan ke sini biar gak conflict dengan prefix pemilik/penghuni)
        Route::apiResource('/data-pemilik', PemilikController::class);
        Route::apiResource('/data-penghuni', PenghuniController::class);
        Route::apiResource('/data-kontrak', KontrakSewaController::class);
        Route::apiResource('/data-pembayaran', PembayaranController::class);
        Route::apiResource('/admin-users', AdminController::class);
    });

    // ==================== PEMILIK ====================
    Route::prefix('pemilik')->group(function () {

        // ---- Dashboard (spesifik, ditaruh paling atas) ----
        Route::get('/dashboard', [PemilikDashboardController::class, 'index']);
        Route::get('/dashboard/stats/kos', [PemilikDashboardController::class, 'getKosStats']);
        Route::get('/dashboard/pendapatan/{tahun?}', [PemilikDashboardController::class, 'getPendapatanTahunan']);
        Route::get('/dashboard/aktivitas', [PemilikDashboardController::class, 'getAktivitasTerbaru']);

        // ---- Analisis ----
        Route::get('/analisis', [PemilikAnalisisController::class, 'index']);

        // ---- Profile ----
        Route::get('/profile', [PemilikProfileController::class, 'show']);
        Route::get('/profile/edit', [PemilikProfileController::class, 'edit']);
        Route::put('/profile/update', [PemilikProfileController::class, 'update']);
        Route::post('/profile/upload-photo', [PemilikProfileController::class, 'uploadPhoto']);
        Route::post('/profile/change-password', [PemilikProfileController::class, 'changePassword']);

        // ---- Resources ----
        Route::apiResource('/kos', PemilikKosController::class);
        Route::apiResource('/kamar', PemilikKamarController::class);
        Route::apiResource('/kontrak', PemilikKontrakController::class);
        Route::apiResource('/pembayaran', PemilikPembayaranController::class);
        Route::apiResource('/reviews', PemilikReviewController::class);

        // ---- Custom Actions ----
        Route::post('/kontrak/{id}/approve', [PemilikKontrakController::class, 'approve']);
        Route::post('/kontrak/{id}/reject', [PemilikKontrakController::class, 'reject']);
        Route::post('/kontrak/{id}/selesai', [PemilikKontrakController::class, 'selesai']);
        Route::post('/pembayaran/{id}/approve', [PemilikPembayaranController::class, 'approve']);
        Route::post('/pembayaran/{id}/reject', [PemilikPembayaranController::class, 'reject']);
    });

    // ==================== PENGHUNI ====================
    Route::prefix('penghuni')->group(function () {

        // ---- Dashboard ----
        Route::get('/dashboard', [PenghuniDashboardController::class, 'index']);
        Route::get('/dashboard/notifikasi-tenggat', [PenghuniDashboardController::class, 'notifikasiTenggat']);

        // ---- Analisis ----
        Route::get('/analisis', [PenghuniAnalisisController::class, 'index']);
        Route::get('/analisis/spending', [PenghuniAnalisisController::class, 'getSpendingAnalysis']);

        // ---- Profile ----
        Route::get('/profile', [PenghuniProfileController::class, 'show']);
        Route::get('/profile/edit', [PenghuniProfileController::class, 'edit']);
        Route::put('/profile/update', [PenghuniProfileController::class, 'update']);
        Route::post('/profile/upload-photo', [PenghuniProfileController::class, 'uploadPhoto']);
        Route::post('/profile/change-password', [PenghuniProfileController::class, 'changePassword']);

        // ---- Kontrak ----
        Route::get('/kontrak', [PenghuniKontrakController::class, 'index']);
        Route::get('/kontrak/{id}', [PenghuniKontrakController::class, 'show']);
        Route::get('/kontrak/create/{kosId}', [PenghuniKontrakController::class, 'create']);
        Route::post('/kontrak', [PenghuniKontrakController::class, 'store']);
        Route::post('/kontrak/{id}/extend', [PenghuniKontrakController::class, 'extend']);
        Route::get('/cari-kos', [PenghuniKontrakController::class, 'cariKos']);

        // ---- Resources ----
        Route::apiResource('/pembayaran', PenghuniPembayaranController::class);
        Route::apiResource('/reviews', PenghuniReviewController::class);

        // ---- Reviews Custom ----
        Route::get('/reviews/create/{kos}', [PenghuniReviewController::class, 'create']);
        Route::get('/reviews/history', [PenghuniReviewController::class, 'history']);
    });

    // ==================== GLOBAL PROTECTED RESOURCES ====================
    Route::apiResource('pengaturan-kos', PengaturanKosController::class);
    Route::apiResource('foto-kos', FotoKosController::class);
    Route::apiResource('kos-fasilitas', KosFasilitasController::class);
});