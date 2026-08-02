<?php

use Illuminate\Support\Facades\Route;

/* ============================================================
   AUTH
   ============================================================ */
use App\Http\Controllers\API\Auth\AuthController;

/* ============================================================
   PUBLIC / BROWSING
   ============================================================ */
use App\Http\Controllers\API\Public\PublicController;
use App\Http\Controllers\API\Public\KosController;
use App\Http\Controllers\API\Public\KamarController;
use App\Http\Controllers\API\Public\FasilitasController;
use App\Http\Controllers\API\Public\ReviewController;

/* ============================================================
   ADMIN
   ============================================================ */
use App\Http\Controllers\API\Admin\AdminController;
use App\Http\Controllers\API\Admin\AdminDashboardController;
use App\Http\Controllers\API\Admin\PemilikController;
use App\Http\Controllers\API\Admin\PenghuniController;
use App\Http\Controllers\API\Admin\KontrakSewaController;
use App\Http\Controllers\API\Admin\PembayaranController;
use App\Http\Controllers\API\Admin\AdminAduanController;
use App\Http\Controllers\API\Admin\AdminStatusAkunController;
use App\Http\Controllers\API\Keuangan\KeuanganController;

/* ============================================================
   PEMILIK
   ============================================================ */
use App\Http\Controllers\API\Pemilik\PemilikDashboardController;
use App\Http\Controllers\API\Pemilik\PemilikAnalisisController;
use App\Http\Controllers\API\Pemilik\PemilikProfileController;
use App\Http\Controllers\API\Pemilik\PemilikKosController;
use App\Http\Controllers\API\Pemilik\PemilikKamarController;
use App\Http\Controllers\API\Pemilik\PemilikKontrakController;
use App\Http\Controllers\API\Pemilik\PemilikPembayaranController;
use App\Http\Controllers\API\Pemilik\PemilikReviewController;
use App\Http\Controllers\API\Pemilik\PengaturanKosController;
use App\Http\Controllers\API\Pemilik\FotoKosController;
use App\Http\Controllers\API\Pemilik\KosFasilitasController;

/* ============================================================
   ADUAN
   ============================================================ */
use App\Http\Controllers\API\Aduan\AduanController as AduanController;
use App\Http\Controllers\API\Pemilik\PemilikAduanController;

/* ============================================================
   PENGHUNI
   ============================================================ */
use App\Http\Controllers\API\Penghuni\PenghuniDashboardController;
use App\Http\Controllers\API\Penghuni\PenghuniAnalisisController;
use App\Http\Controllers\API\Penghuni\PenghuniProfileController;
use App\Http\Controllers\API\Penghuni\PenghuniKontrakController;
use App\Http\Controllers\API\Penghuni\PenghuniPembayaranController;
use App\Http\Controllers\API\Penghuni\PenghuniReviewController;

/* ============================================================
   LAINNYA
   ============================================================ */
use App\Http\Controllers\API\NotificationController;
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
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:api-login');
    Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:api-register');
    Route::post('/register/penghuni', [AuthController::class, 'registerPenghuni'])->middleware('throttle:api-register');
    Route::post('/register/pemilik', [AuthController::class, 'registerPemilik'])->middleware('throttle:api-register');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->middleware('throttle:forgot-password');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->middleware('throttle:reset-password');
});

// ==================== PUBLIC RESOURCES (BROWSING ONLY) ====================
Route::apiResource('kos', KosController::class)->only(['index', 'show']);
Route::apiResource('kamar', KamarController::class)->only(['index', 'show']);
Route::apiResource('fasilitas', FasilitasController::class)->only(['index', 'show']);
Route::apiResource('reviews', ReviewController::class)->only(['index', 'show']);

// ==================== PAYMENT CALLBACK (WEBHOOK) ====================
Route::post('/payment/callback', [PaymentCallbackController::class, 'handleCallback']);

// ==================== PROTECTED ROUTES (SANCTUM) ====================
Route::middleware(['auth:sanctum', 'account.status'])->group(function () {

    // -------- Auth --------
    Route::prefix('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);
    });

    // -------- Notifications (in-app) --------
    Route::prefix('notifications')->group(function () {
        Route::get('/', [NotificationController::class, 'index']);
        Route::get('/unread-count', [NotificationController::class, 'unreadCount']);
        Route::post('/{id}/read', [NotificationController::class, 'markAsRead']);
        Route::post('/mark-all-read', [NotificationController::class, 'markAllAsRead']);
    });

    // -------- Notifications (email trigger) --------
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
    Route::prefix('admin')->middleware('admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index']);

        Route::apiResource('/data-pemilik', PemilikController::class);
        Route::apiResource('/data-penghuni', PenghuniController::class);
        Route::apiResource('/data-kontrak', KontrakSewaController::class);
        Route::apiResource('/data-pembayaran', PembayaranController::class);
        Route::apiResource('/admin-users', AdminController::class);

        Route::post('/data-pemilik/{id}/status', [AdminStatusAkunController::class, 'updateStatusPemilik']);
        Route::post('/data-penghuni/{id}/status', [AdminStatusAkunController::class, 'updateStatusPenghuni']);

        Route::get('/aduan', [AdminAduanController::class, 'index']);
        Route::get('/aduan/statistik', [AdminAduanController::class, 'statistik']);
        Route::get('/aduan/{id}', [AdminAduanController::class, 'show']);
        Route::post('/aduan/{id}/status', [AdminAduanController::class, 'updateStatus']);
        Route::post('/aduan/{id}/komentar', [AdminAduanController::class, 'tambahKomentar']);

        Route::get('/keuangan', [KeuanganController::class, 'ringkasan']);
        Route::get('/keuangan/pendapatan-bulanan', [KeuanganController::class, 'pendapatanBulanan']);
        Route::get('/keuangan/transaksi-terbaru', [KeuanganController::class, 'transaksiTerbaru']);
        Route::get('/keuangan/statistik-pemilik', [KeuanganController::class, 'statistikPemilik']);

        Route::get('/payment/simulate/{externalId}', [PaymentCallbackController::class, 'simulatePayment']);
    });

    // ==================== PEMILIK ====================
    Route::prefix('pemilik')->group(function () {

        Route::get('/dashboard', [PemilikDashboardController::class, 'index']);

        Route::get('/aduan', [PemilikAduanController::class, 'index']);
        Route::post('/aduan', [PemilikAduanController::class, 'store']);
        Route::get('/aduan/{id}', [PemilikAduanController::class, 'show']);
        Route::post('/aduan/{id}/komentar', [PemilikAduanController::class, 'tambahKomentar']);
        Route::get('/dashboard/stats/kos', [PemilikDashboardController::class, 'getKosStats']);
        Route::get('/dashboard/pendapatan/{tahun?}', [PemilikDashboardController::class, 'getPendapatanTahunan']);
        Route::get('/dashboard/aktivitas', [PemilikDashboardController::class, 'getAktivitasTerbaru']);

        Route::get('/analisis', [PemilikAnalisisController::class, 'index']);

        Route::get('/profile', [PemilikProfileController::class, 'show']);
        Route::get('/profile/edit', [PemilikProfileController::class, 'edit']);
        Route::put('/profile/update', [PemilikProfileController::class, 'update']);
        Route::post('/profile/upload-photo', [PemilikProfileController::class, 'uploadPhoto']);
        Route::post('/profile/change-password', [PemilikProfileController::class, 'changePassword']);

        Route::apiResource('/kos', PemilikKosController::class);
        Route::apiResource('/kamar', PemilikKamarController::class);
        Route::apiResource('/kontrak', PemilikKontrakController::class);
        Route::apiResource('/pembayaran', PemilikPembayaranController::class);
        Route::apiResource('/reviews', PemilikReviewController::class);

        Route::post('/kontrak/{id}/approve', [PemilikKontrakController::class, 'approve']);
        Route::post('/kontrak/{id}/reject', [PemilikKontrakController::class, 'reject']);
        Route::post('/kontrak/{id}/selesai', [PemilikKontrakController::class, 'selesai']);
        Route::post('/pembayaran/{id}/approve', [PemilikPembayaranController::class, 'approve']);
        Route::post('/pembayaran/{id}/reject', [PemilikPembayaranController::class, 'reject']);
    });

    // ==================== PENGHUNI ====================
    Route::prefix('penghuni')->group(function () {

        Route::get('/dashboard', [PenghuniDashboardController::class, 'index']);

        Route::get('/aduan', [AduanController::class, 'index']);
        Route::post('/aduan', [AduanController::class, 'store']);
        Route::get('/aduan/{id}', [AduanController::class, 'show']);
        Route::post('/aduan/{id}/komentar', [AduanController::class, 'tambahKomentar']);
        Route::get('/dashboard/notifikasi-tenggat', [PenghuniDashboardController::class, 'notifikasiTenggat']);

        Route::get('/analisis', [PenghuniAnalisisController::class, 'index']);
        Route::get('/analisis/spending', [PenghuniAnalisisController::class, 'getSpendingAnalysis']);

        Route::get('/profile', [PenghuniProfileController::class, 'show']);
        Route::get('/profile/edit', [PenghuniProfileController::class, 'edit']);
        Route::put('/profile/update', [PenghuniProfileController::class, 'update']);
        Route::post('/profile/upload-photo', [PenghuniProfileController::class, 'uploadPhoto']);
        Route::post('/profile/change-password', [PenghuniProfileController::class, 'changePassword']);

        Route::get('/kontrak', [PenghuniKontrakController::class, 'index']);
        Route::get('/kontrak/{id}', [PenghuniKontrakController::class, 'show']);
        Route::get('/kontrak/create/{kosId}', [PenghuniKontrakController::class, 'create']);
        Route::post('/kontrak', [PenghuniKontrakController::class, 'store']);
        Route::get('/cari-kos', [PenghuniKontrakController::class, 'cariKos']);

        Route::apiResource('/pembayaran', PenghuniPembayaranController::class);
        Route::apiResource('/reviews', PenghuniReviewController::class);

        Route::get('/reviews/create/{kos}', [PenghuniReviewController::class, 'create']);
        Route::get('/reviews/history', [PenghuniReviewController::class, 'history']);
    });

    Route::apiResource('pengaturan-kos', PengaturanKosController::class);
    Route::apiResource('foto-kos', FotoKosController::class);
    Route::apiResource('kos-fasilitas', KosFasilitasController::class);
});
