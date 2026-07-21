<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Auth\{LoginController, RegisterController, ForgotPasswordController, ResetPasswordController};
use App\Http\Controllers\Web\Public\{HomeController, KosController, PageController};
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\NotificationController;
use App\Http\Controllers\Web\Penghuni\{
    DashboardController as PenghuniDashboard,
    KontrakController as PenghuniKontrak,
    PembayaranController as PenghuniPembayaran,
    ReviewController as PenghuniReview,
    AnalisisController as PenghuniAnalisis
};
use App\Http\Controllers\Web\Pemilik\{
    DashboardController as PemilikDashboard,
    KontrakController as PemilikKontrak,
    PembayaranController as PemilikPembayaran,
    KosController as PemilikKos,
    KamarController as PemilikKamar,
    ReviewController as PemilikReview,
    AnalisisController as PemilikAnalisis
};
use App\Http\Controllers\Web\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Web\Admin\UserController as AdminUser;
use App\Http\Controllers\Web\Admin\KosController as AdminKos;

use App\Http\Controllers\Web\Admin\ReviewController as AdminReview;
use App\Http\Controllers\Web\Admin\LaporanController as AdminLaporan;
use App\Http\Controllers\Web\Admin\AduanController as AdminAduan;
use App\Http\Controllers\Web\Admin\KeuanganController as AdminKeuangan;
use App\Http\Controllers\Web\Admin\AnalisisController as AdminAnalisis;
use App\Http\Controllers\Web\Pemilik\AduanController as PemilikAduan;
use App\Http\Controllers\Web\Penghuni\AduanController as PenghuniAduan;

/* --------------------------------------------------------------------------
 *  PUBLIC ROUTES
 * -------------------------------------------------------------------------- */
Route::get('/', [HomeController::class, 'index'])->name('public.home');
Route::get('/kos', [KosController::class, 'index'])->name('public.kos.index');
Route::get('/kos/{id}', [KosController::class, 'show'])->name('public.kos.show');
Route::get('/peta', [KosController::class, 'peta'])->name('public.kos.peta');

// Static pages
Route::prefix('pages')->as('public.')->group(function () {
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/how-to', [PageController::class, 'howto'])->name('howto');
    Route::get('/terms', [PageController::class, 'terms'])->name('terms');
    Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
});

/* --------------------------------------------------------------------------
 *  AUTH ROUTES
 * -------------------------------------------------------------------------- */
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:login');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->middleware('throttle:register');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Password Reset
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email')->middleware('throttle:forgot-password');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update')->middleware('throttle:reset-password');

/* --------------------------------------------------------------------------
 *  FILE ROUTES (public storage)
 * -------------------------------------------------------------------------- */
Route::get('/storage/{folder}/{filename}', function ($folder, $filename) {
    $allowed = ['kos', 'kamar', 'ktp', 'bukti', 'pembayaran', 'profiles', 'reviews', 'kontrak', 'foto_profil', 'bukti_pembayaran', 'aduan'];
    abort_unless(in_array($folder, $allowed), 403, 'Folder tidak diizinkan');

    $path = storage_path("app/public/{$folder}/{$filename}");
    abort_unless(file_exists($path), 404, 'File tidak ditemukan');

    return response()->file($path);
})->name('storage.file');

// Aliases for backward compatibility
Route::get('/files/{folder}/{filename}', function ($folder, $filename) {
    return redirect()->route('storage.file', ['folder' => $folder, 'filename' => $filename]);
})->where(['folder' => 'pembayaran|bukti|reviews|kos']);

/* --------------------------------------------------------------------------
 *  TEST / DEBUG ROUTES
 * -------------------------------------------------------------------------- */
Route::prefix('test')->group(function () {
    Route::get('/auth', function () {
        if (auth()->check()) {
            $user = auth()->user();
            return [
                'role' => $user->role,
                'user' => $user->only(['id', 'username', 'role']),
            ];
        }

        return [
            'status' => 'Not logged in',
        ];
    });

    Route::get('/email/kontrak-diterima/{id}', fn($id) => testMail(\App\Mail\Penghuni\KontrakDiterimaMail::class, $id));
    Route::get('/email/kontrak-ditolak/{id}', fn($id) => testMail(\App\Mail\Penghuni\KontrakDitolakMail::class, $id));
});

Route::get('/redirect', function () {
    if (auth()->check()) {
        $success = session('success');
        $route = match (auth()->user()->role) {
            'penghuni' => route('penghuni.dashboard'),
            'pemilik' => route('pemilik.dashboard'),
            'admin' => route('admin.dashboard'),
            default => '/',
        };
        return redirect($route)->with('success', $success);
    }
    return redirect('/');
})->name('redirect');

/* --------------------------------------------------------------------------
 *  NOTIFICATIONS (auth)
 * -------------------------------------------------------------------------- */
Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
});

/* --------------------------------------------------------------------------
 *  PENGHUNI ROUTES
 * -------------------------------------------------------------------------- */
Route::prefix('penghuni')->as('penghuni.')->group(function () {
    /* --- protected routes --- */
    Route::middleware(['auth', 'penghuni'])->group(function () {
        Route::get('/dashboard', [PenghuniDashboard::class, 'index'])->name('dashboard');

        // Kontrak
        Route::get('/kontrak/create/{kosId}', [PenghuniKontrak::class, 'create'])->name('kontrak.create');
        Route::post('/kontrak', [PenghuniKontrak::class, 'store'])->name('kontrak.store');
        Route::get('/kontrak/{id}', [PenghuniKontrak::class, 'show'])->name('kontrak.show');
        Route::get('/kontrak', [PenghuniKontrak::class, 'index'])->name('kontrak.index');
        Route::get('/kontrak/notifikasi-tenggat', [PenghuniKontrak::class, 'notifikasiTenggat'])->name('kontrak.notifikasi');

        // Pembayaran
        Route::get('/pembayaran', [PenghuniPembayaran::class, 'index'])->name('pembayaran.index');
        Route::get('/pembayaran/create', [PenghuniPembayaran::class, 'create'])->name('pembayaran.create');
        Route::post('/pembayaran', [PenghuniPembayaran::class, 'store'])->name('pembayaran.store');
        Route::get('/pembayaran/{id}', [PenghuniPembayaran::class, 'show'])->name('pembayaran.show');

        // Reviews
        Route::get('/reviews/create/{kos}', [PenghuniReview::class, 'create'])->name('reviews.create');
        Route::post('/reviews/store', [PenghuniReview::class, 'store'])->name('reviews.store');
        Route::get('/reviews/history', [PenghuniReview::class, 'history'])->name('reviews.history');
        Route::get('/reviews/{review}/edit', [PenghuniReview::class, 'edit'])->name('reviews.edit');
        Route::put('/reviews/{review}', [PenghuniReview::class, 'update'])->name('reviews.update');
        Route::delete('/reviews/{review}', [PenghuniReview::class, 'destroy'])->name('reviews.destroy');

        // Cari Kos (stays in dashboard layout)
        Route::get('/cari-kos', [PenghuniKontrak::class, 'cariKos'])->name('cari-kos');

        // Profile
        Route::get('/profile', [ProfileController::class, 'showPenghuni'])->name('profile.show');
        Route::get('/profile/edit', [ProfileController::class, 'editPenghuni'])->name('profile.edit');
        Route::put('/profile/update', [ProfileController::class, 'updatePenghuni'])->name('profile.update');
        Route::post('/profile/upload-photo', [ProfileController::class, 'uploadPhotoPenghuni'])->name('profile.upload-photo');

        // Analisis
        Route::get('/analisis', [PenghuniAnalisis::class, 'index'])->name('analisis.index');
        Route::get('/analisis/spending', [PenghuniAnalisis::class, 'getSpendingAnalysis'])->name('analisis.spending');

        // Aduan
        Route::get('/aduan', [PenghuniAduan::class, 'index'])->name('aduan.index');
        Route::get('/aduan/create', [PenghuniAduan::class, 'create'])->name('aduan.create');
        Route::post('/aduan', [PenghuniAduan::class, 'store'])->name('aduan.store');
        Route::get('/aduan/{id}', [PenghuniAduan::class, 'show'])->name('aduan.show');
        Route::post('/aduan/{id}/komentar', [PenghuniAduan::class, 'tambahKomentar'])->name('aduan.komentar');
    });
});

/* --------------------------------------------------------------------------
 *  PEMILIK ROUTES
 * -------------------------------------------------------------------------- */
Route::prefix('pemilik')->as('pemilik.')->group(function () {
    /* --- protected routes --- */
    Route::middleware(['auth', 'pemilik'])->group(function () {
        Route::get('/dashboard', [PemilikDashboard::class, 'index'])->name('dashboard');

        // Kontrak
        Route::get('/kontrak', [PemilikKontrak::class, 'index'])->name('kontrak.index');
        Route::get('/kontrak/{id}', [PemilikKontrak::class, 'show'])->name('kontrak.show');
        Route::post('/kontrak/{id}/approve', [PemilikKontrak::class, 'approve'])->name('kontrak.approve');
        Route::post('/kontrak/{id}/reject', [PemilikKontrak::class, 'reject'])->name('kontrak.reject');
        Route::post('/kontrak/{id}/selesai', [PemilikKontrak::class, 'selesai'])->name('kontrak.selesai');
        Route::delete('/kontrak/{id}', [PemilikKontrak::class, 'destroy'])->name('kontrak.destroy');

        // Pembayaran
        Route::get('/pembayaran', [PemilikPembayaran::class, 'index'])->name('pembayaran.index');
        Route::post('/pembayaran/{id}/approve', [PemilikPembayaran::class, 'approve'])->name('pembayaran.approve');
        Route::post('/pembayaran/{id}/reject', [PemilikPembayaran::class, 'reject'])->name('pembayaran.reject');

        // Kos
        Route::get('/kos', [PemilikKos::class, 'index'])->name('kos.index');
        Route::get('/kos/create', [PemilikKos::class, 'create'])->name('kos.create');
        Route::post('/kos', [PemilikKos::class, 'store'])->name('kos.store');
        Route::get('/kos/{id}/edit', [PemilikKos::class, 'edit'])->name('kos.edit');
        Route::put('/kos/{id}', [PemilikKos::class, 'update'])->name('kos.update');
        Route::delete('/kos/{id}', [PemilikKos::class, 'destroy'])->name('kos.destroy');
        Route::get('/kos/{id}/show', [PemilikKos::class, 'show'])->name('kos.show');

        // Kamar
        Route::get('/kamar', [PemilikKamar::class, 'index'])->name('kamar.index');
        Route::get('/kamar/create', [PemilikKamar::class, 'create'])->name('kamar.create');
        Route::post('/kamar', [PemilikKamar::class, 'store'])->name('kamar.store');
        Route::get('/kamar/{id}/edit', [PemilikKamar::class, 'edit'])->name('kamar.edit');
        Route::put('/kamar/{id}', [PemilikKamar::class, 'update'])->name('kamar.update');
        Route::delete('/kamar/{id}', [PemilikKamar::class, 'destroy'])->name('kamar.destroy');

        // Review
        Route::get('/reviews', [PemilikReview::class, 'index'])->name('reviews.index');

        // Profile
        Route::get('/profile', [ProfileController::class, 'showPemilik'])->name('profile.show');
        Route::get('/profile/edit', [ProfileController::class, 'editPemilik'])->name('profile.edit');
        Route::put('/profile/update', [ProfileController::class, 'updatePemilik'])->name('profile.update');
        Route::post('/profile/upload-photo', [ProfileController::class, 'uploadPhotoPemilik'])->name('profile.upload-photo');

        // Analisis
        Route::get('/analisis', [PemilikAnalisis::class, 'index'])->name('analisis.index');

        // Aduan
        Route::get('/aduan', [PemilikAduan::class, 'index'])->name('aduan.index');
        Route::get('/aduan/create', [PemilikAduan::class, 'create'])->name('aduan.create');
        Route::post('/aduan', [PemilikAduan::class, 'store'])->name('aduan.store');
        Route::get('/aduan/{id}', [PemilikAduan::class, 'show'])->name('aduan.show');
        Route::post('/aduan/{id}/komentar', [PemilikAduan::class, 'tambahKomentar'])->name('aduan.komentar');
    });
});

/* --------------------------------------------------------------------------
 *  ADMIN ROUTES
 * -------------------------------------------------------------------------- */
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    // Users (CRUD)
    Route::get('/users', [AdminUser::class, 'index'])->name('users.index');
    Route::get('/users/create', [AdminUser::class, 'create'])->name('users.create');
    Route::post('/users', [AdminUser::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [AdminUser::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [AdminUser::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [AdminUser::class, 'destroy'])->name('users.destroy');

    // Kos (read-only monitoring)
    Route::get('/kos', [AdminKos::class, 'index'])->name('kos.index');

    // Reviews (moderasi)
    Route::get('/reviews', [AdminReview::class, 'index'])->name('reviews.index');
    Route::delete('/reviews/{id}', [AdminReview::class, 'destroy'])->name('reviews.destroy');

    // Laporan
    Route::get('/laporan', [AdminLaporan::class, 'index'])->name('laporan.index');

    // Aduan
    Route::get('/aduan', [AdminAduan::class, 'index'])->name('aduan.index');
    Route::get('/aduan/{id}', [AdminAduan::class, 'show'])->name('aduan.show');
    Route::post('/aduan/{id}/status', [AdminAduan::class, 'updateStatus'])->name('aduan.status');
    Route::post('/aduan/{id}/komentar', [AdminAduan::class, 'tambahKomentar'])->name('aduan.komentar');

    // Analisis Platform
    Route::get('/analisis', [AdminAnalisis::class, 'index'])->name('analisis.index');

    // Keuangan Platform (bagi hasil 90/10)
    Route::get('/keuangan', [AdminKeuangan::class, 'index'])->name('keuangan.index');

    // Data Pemilik
    Route::get('/data-pemilik', [AdminUser::class, 'dataPemilik'])->name('data-pemilik.index');
    Route::get('/data-pemilik/{id}', [AdminUser::class, 'showPemilik'])->name('data-pemilik.show');
    Route::post('/data-pemilik/{id}/status', [AdminUser::class, 'updateStatusPemilik'])->name('data-pemilik.status');

    // Data Penghuni
    Route::get('/data-penghuni', [AdminUser::class, 'dataPenghuni'])->name('data-penghuni.index');
    Route::get('/data-penghuni/{id}', [AdminUser::class, 'showPenghuni'])->name('data-penghuni.show');
    Route::post('/data-penghuni/{id}/status', [AdminUser::class, 'updateStatusPenghuni'])->name('data-penghuni.status');
});

 /* --------------------------------------------------------------------------
 *  HELPERS
 * -------------------------------------------------------------------------- */
if (!function_exists('testMail')) {
    function testMail(string $mailable, int $id): string
    {
        $kontrak = \App\Models\KontrakSewa::find($id);
        if (!$kontrak) return 'Kontrak tidak ditemukan';

        \Mail::to('test@example.com')->send(new $mailable($kontrak));
        $short = class_basename($mailable);
        return "Email {$short} berhasil dikirim!";
    }
}

