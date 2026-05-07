@extends('layouts.app')

@section('title', 'Cara Memesan - AyoKos')

@section('content')

<style>
    /* Section Umum */
    .section-padding {
        padding: 6rem 0;
    }

    @media (max-width: 768px) {
        .section-padding {
            padding: 4rem 0;
        }
    }

    /* Badge */
    .badge-soft {
        display: inline-block;
        padding: 0.35rem 1rem;
        border-radius: 999px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    /* Card Hover */
    .card-hover {
        transition: all 0.3s ease;
    }
    .card-hover:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 40px -12px rgba(0,0,0,0.1);
        border-color: #cbd5e1;
    }

    /* Step Number */
    .step-number {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        font-weight: 700;
        flex-shrink: 0;
        position: relative;
        z-index: 10;
    }

    /* Step Connector */
    .step-connector {
        position: absolute;
        left: 28px;
        top: 56px;
        bottom: -24px;
        width: 2px;
        background: linear-gradient(to bottom, #e2e8f0, #cbd5e1);
    }

    @media (max-width: 768px) {
        .step-connector {
            left: 28px;
        }
    }

    /* Scroll halus */
    html {
        scroll-behavior: smooth;
    }

    /* FAQ */
    .faq-item {
        border: 1px solid #e2e8f0;
        border-radius: 1rem;
        margin-bottom: 0.75rem;
        overflow: hidden;
        background: #ffffff;
    }

    .faq-question {
        width: 100%;
        padding: 1.25rem 1.5rem;
        text-align: left;
        font-weight: 600;
        color: #1e293b;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        background: transparent;
        border: none;
        font-size: 1rem;
    }

    .faq-answer {
        padding: 0 1.5rem 1.25rem;
        color: #64748b;
        line-height: 1.7;
        display: none;
        font-size: 0.95rem;
    }

    .faq-item.active .faq-answer {
        display: block;
    }

    .faq-item.active .faq-icon {
        transform: rotate(180deg);
    }

    .faq-icon {
        transition: transform 0.3s ease;
        color: #94a3b8;
    }

    /* Payment Card */
    .payment-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 0.75rem;
        padding: 1rem;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    .payment-card:hover {
        border-color: #0ea5e9;
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.1);
    }
    .payment-card.active {
        border-color: #0ea5e9;
        background: #f0f9ff;
    }
</style>

<!-- ==================== HERO SECTION ==================== -->
<section class="relative min-h-[50vh] flex items-center justify-center overflow-hidden" style="background: linear-gradient(160deg, #0f172a 0%, #1e293b 40%, #1e3a5f 100%);">
    <!-- Decorative gradients -->
    <div class="absolute top-[-30%] left-[-15%] w-[70%] h-[160%] bg-[radial-gradient(circle_at_35%_35%,rgba(56,189,248,0.12),transparent_60%)] pointer-events-none"></div>
    <div class="absolute bottom-[-20%] right-[-10%] w-[60%] h-[140%] bg-[radial-gradient(circle_at_70%_80%,rgba(99,102,241,0.08),transparent_60%)] pointer-events-none"></div>

    <div class="container mx-auto px-4 relative z-10 text-center" data-aos="fade-up" data-aos-duration="1000">
        <div class="w-20 h-20 md:w-24 md:h-24 bg-white/10 backdrop-blur-md border-2 border-white/20 rounded-2xl flex items-center justify-center mx-auto mb-8 shadow-2xl">
            <i class="fas fa-map-signs text-white text-3xl md:text-4xl"></i>
        </div>

        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-6 leading-tight tracking-tight">
            Cara Memesan <span class="text-sky-300">Kos Impian</span>
        </h1>

        <p class="text-lg md:text-xl text-slate-300 max-w-3xl mx-auto leading-relaxed mb-8">
            Ikuti panduan langkah demi langkah untuk menemukan dan memesan kos yang sempurna untuk Anda. 
            Proses mudah, transparan, dan aman.
        </p>

        <div class="flex flex-wrap justify-center gap-3">
            <span class="badge-soft bg-white/10 text-sky-200 border border-white/10 backdrop-blur-sm">
                <i class="fas fa-clock mr-1.5 text-sky-300"></i> 5 Langkah Mudah
            </span>
            <span class="badge-soft bg-white/10 text-sky-200 border border-white/10 backdrop-blur-sm">
                <i class="fas fa-shield-alt mr-1.5 text-sky-300"></i> Aman & Terpercaya
            </span>
            <span class="badge-soft bg-white/10 text-sky-200 border border-white/10 backdrop-blur-sm">
                <i class="fas fa-bolt mr-1.5 text-sky-300"></i> Proses Cepat
            </span>
        </div>
    </div>
</section>

<!-- ==================== LANGKAH-LANGKAH ==================== -->
<section class="section-padding bg-white">
    <div class="container mx-auto px-4 max-w-5xl">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="badge-soft bg-sky-50 text-sky-700 border border-sky-100 mb-3">Panduan</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">5 Langkah <span class="text-sky-600">Sederhana</span></h2>
            <p class="text-slate-500 max-w-xl mx-auto">Dari pencarian hingga check-in, kami memandu Anda di setiap langkah</p>
        </div>

        <div class="relative space-y-12">
            <!-- Step 1: Cari Kos -->
            <div class="flex flex-col md:flex-row items-start gap-6 md:gap-10 relative" data-aos="fade-up">
                <div class="step-number bg-gradient-to-br from-sky-50 to-blue-50 text-sky-600 border-2 border-sky-100 shadow-sm" data-aos="zoom-in">
                    1
                </div>
                <div class="flex-1 w-full">
                    <div class="flex items-center gap-3 mb-4">
                        <h3 class="text-xl md:text-2xl font-bold text-slate-900">Cari Kos yang Tepat</h3>
                        <span class="hidden md:inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-sky-50 text-sky-700">
                            <span class="w-1.5 h-1.5 bg-sky-500 rounded-full mr-1.5 animate-pulse"></span>
                            Mulai Disini
                        </span>
                    </div>
                    
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm card-hover">
                        <div class="grid md:grid-cols-3 gap-4 mb-6">
                            <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-xl">
                                <div class="w-10 h-10 bg-sky-100 rounded-lg flex items-center justify-center text-sky-600 shrink-0">
                                    <i class="fas fa-search"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-slate-900 text-sm">Filter Pintar</h4>
                                    <p class="text-xs text-slate-500 mt-0.5">Cari berdasarkan lokasi, harga, dan fasilitas</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-xl">
                                <div class="w-10 h-10 bg-sky-100 rounded-lg flex items-center justify-center text-sky-600 shrink-0">
                                    <i class="fas fa-images"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-slate-900 text-sm">Detail Lengkap</h4>
                                    <p class="text-xs text-slate-500 mt-0.5">Foto, fasilitas, dan peraturan kos</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-xl">
                                <div class="w-10 h-10 bg-sky-100 rounded-lg flex items-center justify-center text-sky-600 shrink-0">
                                    <i class="fas fa-star"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-slate-900 text-sm">Review Asli</h4>
                                    <p class="text-xs text-slate-500 mt-0.5">Ulasan dari penghuni sebelumnya</p>
                                </div>
                            </div>
                        </div>
                        
                        <a href="{{ route('public.kos.index') }}" class="inline-flex items-center px-5 py-2.5 bg-sky-600 hover:bg-sky-700 text-white rounded-xl font-medium transition shadow-sm text-sm">
                            <i class="fas fa-search mr-2"></i> Cari Kos Sekarang
                        </a>
                    </div>
                </div>
                <!-- Connector -->
                <div class="step-connector hidden md:block"></div>
            </div>

            <!-- Step 2: Daftar/Login -->
            <div class="flex flex-col md:flex-row items-start gap-6 md:gap-10 relative" data-aos="fade-up">
                <div class="step-number bg-gradient-to-br from-emerald-50 to-green-50 text-emerald-600 border-2 border-emerald-100 shadow-sm" data-aos="zoom-in" data-aos-delay="100">
                    2
                </div>
                <div class="flex-1 w-full">
                    <div class="flex items-center gap-3 mb-4">
                        <h3 class="text-xl md:text-2xl font-bold text-slate-900">Daftar atau Login Akun</h3>
                    </div>
                    
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm card-hover">
                        <div class="grid md:grid-cols-2 gap-6">
                            <!-- Register -->
                            <div class="p-5 bg-slate-50 rounded-xl border border-slate-100">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="w-10 h-10 bg-sky-100 rounded-lg flex items-center justify-center text-sky-600">
                                        <i class="fas fa-user-plus"></i>
                                    </div>
                                    <h4 class="font-semibold text-slate-900">Belum Punya Akun?</h4>
                                </div>
                                <ul class="space-y-3 text-sm text-slate-500">
                                    <li class="flex items-start gap-2">
                                        <i class="fas fa-check text-sky-500 mt-0.5 text-xs"></i>
                                        <span>Klik tombol <strong class="text-slate-700">"Daftar"</strong> di pojok kanan atas</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <i class="fas fa-check text-sky-500 mt-0.5 text-xs"></i>
                                        <span>Isi data diri lengkap dengan benar</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <i class="fas fa-check text-sky-500 mt-0.5 text-xs"></i>
                                        <span>Verifikasi email untuk mengaktifkan akun</span>
                                    </li>
                                </ul>
                            </div>
                            
                            <!-- Login -->
                            <div class="p-5 bg-slate-50 rounded-xl border border-slate-100">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center text-emerald-600">
                                        <i class="fas fa-sign-in-alt"></i>
                                    </div>
                                    <h4 class="font-semibold text-slate-900">Sudah Punya Akun?</h4>
                                </div>
                                <ul class="space-y-3 text-sm text-slate-500">
                                    <li class="flex items-start gap-2">
                                        <i class="fas fa-check text-emerald-500 mt-0.5 text-xs"></i>
                                        <span>Login dengan <strong class="text-slate-700">username dan password</strong></span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <i class="fas fa-check text-emerald-500 mt-0.5 text-xs"></i>
                                        <span>Pastikan data profil sudah lengkap</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <i class="fas fa-check text-emerald-500 mt-0.5 text-xs"></i>
                                        <span>Siap untuk mengajukan kontrak sewa</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="step-connector hidden md:block"></div>
            </div>

            <!-- Step 3: Ajukan Kontrak -->
            <div class="flex flex-col md:flex-row items-start gap-6 md:gap-10 relative" data-aos="fade-up">
                <div class="step-number bg-gradient-to-br from-purple-50 to-indigo-50 text-purple-600 border-2 border-purple-100 shadow-sm" data-aos="zoom-in" data-aos-delay="200">
                    3
                </div>
                <div class="flex-1 w-full">
                    <div class="flex items-center gap-3 mb-4">
                        <h3 class="text-xl md:text-2xl font-bold text-slate-900">Ajukan Kontrak Sewa</h3>
                    </div>
                    
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm card-hover">
                        <div class="grid md:grid-cols-2 gap-4 mb-6">
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center text-purple-600 shrink-0 text-sm">
                                    <i class="fas fa-door-open"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-slate-900 text-sm">Pilih Kamar</h4>
                                    <p class="text-xs text-slate-500 mt-0.5">Pilih kamar yang tersedia pada kos yang diinginkan</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center text-purple-600 shrink-0 text-sm">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-slate-900 text-sm">Isi Formulir</h4>
                                    <p class="text-xs text-slate-500 mt-0.5">Lengkapi data pengajuan kontrak dengan benar</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center text-purple-600 shrink-0 text-sm">
                                    <i class="fas fa-id-card"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-slate-900 text-sm">Upload KTP</h4>
                                    <p class="text-xs text-slate-500 mt-0.5">Foto KTP yang jelas dan valid untuk verifikasi</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center text-purple-600 shrink-0 text-sm">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-slate-900 text-sm">Tentukan Durasi</h4>
                                    <p class="text-xs text-slate-500 mt-0.5">Pilih periode sewa yang sesuai kebutuhan Anda</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-purple-50 border border-purple-100 rounded-xl p-4 flex items-start gap-3">
                            <i class="fas fa-info-circle text-purple-500 mt-0.5"></i>
                            <div>
                                <p class="text-sm font-medium text-purple-900">Proses Verifikasi</p>
                                <p class="text-xs text-purple-700 mt-1 leading-relaxed">
                                    Pengajuan kontrak akan diverifikasi oleh pemilik kos dalam waktu <strong>1-3 hari kerja</strong>. Anda akan menerima notifikasi via email dan dashboard.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="step-connector hidden md:block"></div>
            </div>

            <!-- Step 4: Bayar Uang Muka -->
            <div class="flex flex-col md:flex-row items-start gap-6 md:gap-10 relative" data-aos="fade-up">
                <div class="step-number bg-gradient-to-br from-amber-50 to-yellow-50 text-amber-600 border-2 border-amber-100 shadow-sm" data-aos="zoom-in" data-aos-delay="300">
                    4
                </div>
                <div class="flex-1 w-full">
                    <div class="flex items-center gap-3 mb-4">
                        <h3 class="text-xl md:text-2xl font-bold text-slate-900">Bayar Uang Muka</h3>
                    </div>
                    
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm card-hover">
                        <div class="mb-6">
                            <h4 class="font-semibold text-slate-900 mb-4 flex items-center text-sm uppercase tracking-wider">
                                <i class="fas fa-credit-card text-amber-500 mr-2"></i> Metode Pembayaran
                            </h4>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                <div class="payment-card">
                                    <div class="w-10 h-10 bg-amber-50 rounded-lg flex items-center justify-center mx-auto mb-2 text-amber-600">
                                        <i class="fas fa-university"></i>
                                    </div>
                                    <p class="text-xs font-medium text-slate-700">Transfer Bank</p>
                                </div>
                                <div class="payment-card">
                                    <div class="w-10 h-10 bg-amber-50 rounded-lg flex items-center justify-center mx-auto mb-2 text-amber-600">
                                        <i class="fas fa-qrcode"></i>
                                    </div>
                                    <p class="text-xs font-medium text-slate-700">QRIS</p>
                                </div>
                                <div class="payment-card">
                                    <div class="w-10 h-10 bg-amber-50 rounded-lg flex items-center justify-center mx-auto mb-2 text-amber-600">
                                        <i class="fas fa-wallet"></i>
                                    </div>
                                    <p class="text-xs font-medium text-slate-700">E-Wallet</p>
                                </div>
                                <div class="payment-card">
                                    <div class="w-10 h-10 bg-amber-50 rounded-lg flex items-center justify-center mx-auto mb-2 text-amber-600">
                                        <i class="fas fa-mobile-alt"></i>
                                    </div>
                                    <p class="text-xs font-medium text-slate-700">Virtual Account</p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-xl">
                                <i class="fas fa-clock text-amber-500 mt-0.5"></i>
                                <p class="text-sm text-slate-600">Lakukan pembayaran uang muka setelah kontrak disetujui pemilik kos</p>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-xl">
                                <i class="fas fa-upload text-amber-500 mt-0.5"></i>
                                <p class="text-sm text-slate-600">Upload bukti pembayaran melalui dashboard Anda</p>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-xl">
                                <i class="fas fa-hourglass-half text-amber-500 mt-0.5"></i>
                                <p class="text-sm text-slate-600">Tunggu konfirmasi dari sistem (maksimal <strong class="text-slate-800">24 jam</strong>)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="step-connector hidden md:block"></div>
            </div>

            <!-- Step 5: Mulai Tinggal -->
            <div class="flex flex-col md:flex-row items-start gap-6 md:gap-10 relative" data-aos="fade-up">
                <div class="step-number bg-gradient-to-br from-rose-50 to-red-50 text-rose-600 border-2 border-rose-100 shadow-sm" data-aos="zoom-in" data-aos-delay="400">
                    5
                </div>
                <div class="flex-1 w-full">
                    <div class="flex items-center gap-3 mb-4">
                        <h3 class="text-xl md:text-2xl font-bold text-slate-900">Mulai Tinggal</h3>
                        <span class="hidden md:inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700">
                                    <i class="fas fa-check mr-1"></i> Selesai
                        </span>
                    </div>
                    
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm card-hover">
                        <div class="bg-emerald-50 border border-emerald-100 rounded-xl p-4 mb-6 flex items-center gap-3">
                            <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 shrink-0">
                                <i class="fas fa-check-circle text-xl"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-emerald-900">Kontrak Anda telah aktif!</p>
                                <p class="text-xs text-emerald-700 mt-0.5">Sekarang Anda bisa mulai koordinasi check-in dengan pemilik kos</p>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-4 mb-6">
                            <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-xl">
                                <div class="w-8 h-8 bg-rose-100 rounded-lg flex items-center justify-center text-rose-600 shrink-0 text-sm">
                                    <i class="fas fa-search"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-slate-900 text-sm">Cek Kondisi</h4>
                                    <p class="text-xs text-slate-500 mt-0.5">Lakukan pengecekan kondisi kamar bersama pemilik</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-xl">
                                <div class="w-8 h-8 bg-rose-100 rounded-lg flex items-center justify-center text-rose-600 shrink-0 text-sm">
                                    <i class="fas fa-home"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-slate-900 text-sm">Check-in</h4>
                                    <p class="text-xs text-slate-500 mt-0.5">Anda sudah bisa menempati kamar yang dipesan</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-sky-50 border border-sky-100 rounded-xl p-4 flex items-start gap-3">
                            <i class="fas fa-lightbulb text-sky-500 mt-0.5"></i>
                            <div>
                                <p class="text-sm font-medium text-sky-900">Tips Penting</p>
                                <p class="text-xs text-sky-700 mt-1 leading-relaxed">
                                    Jangan lupa untuk membayar tagihan bulanan tepat waktu melalui dashboard Anda. Aktifkan notifikasi untuk pengingat pembayaran otomatis.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== FAQ SECTION ==================== -->
<section class="section-padding bg-slate-50">
    <div class="container mx-auto px-4 max-w-3xl">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="badge-soft bg-sky-50 text-sky-700 border border-sky-100 mb-3">FAQ</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Pertanyaan <span class="text-sky-600">Umum</span></h2>
            <p class="text-slate-500 max-w-xl mx-auto">Temukan jawaban untuk pertanyaan yang sering diajukan</p>
        </div>

        <div data-aos="fade-up">
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFAQ(this)">
                    <span>Berapa lama proses verifikasi kontrak?</span>
                    <i class="fas fa-chevron-down faq-icon"></i>
                </button>
                <div class="faq-answer">
                    Proses verifikasi biasanya memakan waktu <strong>1-3 hari kerja</strong>. Pemilik kos akan mengecek kelengkapan data dan dokumen yang Anda submit. Anda akan menerima notifikasi via email dan dashboard setelah verifikasi selesai.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question" onclick="toggleFAQ(this)">
                    <span>Apa yang terjadi jika kontrak ditolak?</span>
                    <i class="fas fa-chevron-down faq-icon"></i>
                </button>
                <div class="faq-answer">
                    Jika kontrak ditolak, Anda akan mendapatkan notifikasi beserta alasannya. Anda dapat mengajukan ulang dengan melengkapi data yang diminta atau mencari kos lain yang lebih sesuai.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question" onclick="toggleFAQ(this)">
                    <span>Bagaimana jika ada masalah selama tinggal?</span>
                    <i class="fas fa-chevron-down faq-icon"></i>
                </button>
                <div class="faq-answer">
                    Anda dapat melaporkan masalah melalui dashboard atau menghubungi pemilik kos langsung. AyoKos juga menyediakan fitur pelaporan dan mediasi jika diperlukan.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question" onclick="toggleFAQ(this)">
                    <span>Apakah uang muka bisa dikembalikan?</span>
                    <i class="fas fa-chevron-down faq-icon"></i>
                </button>
                <div class="faq-answer">
                    Kebijakan pengembalian uang muka tergantung pada ketentuan masing-masing pemilik kos. Pastikan untuk membaca syarat dan ketentuan kontrak sebelum melakukan pembayaran.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question" onclick="toggleFAQ(this)">
                    <span>Bisakah saya mengubah durasi sewa setelah kontrak aktif?</span>
                    <i class="fas fa-chevron-down faq-icon"></i>
                </button>
                <div class="faq-answer">
                    Ya, Anda dapat mengajukan perpanjangan atau perubahan durasi sewa melalui dashboard. Namun, perubahan tersebut memerlukan persetujuan dari pemilik kos.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== CTA FINAL ==================== -->
<section class="section-padding bg-gradient-to-r from-slate-800 via-slate-900 to-slate-800 text-white relative overflow-hidden">
    <div class="absolute top-0 right-0 w-[50%] h-full bg-[radial-gradient(circle_at_80%_50%,rgba(56,189,248,0.08),transparent_60%)] pointer-events-none"></div>
    
    <div class="container mx-auto px-4 text-center relative z-10" data-aos="fade-up">
        <h2 class="text-3xl md:text-5xl font-bold mb-4">Siap Mencari Kos Impian Anda?</h2>
        <p class="text-lg text-slate-300 mb-8 max-w-2xl mx-auto">
            Bergabunglah dengan ribuan penghuni yang telah menemukan rumah kedua mereka melalui AyoKos. Proses mudah, transparan, dan aman.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('public.kos.index') }}" class="px-8 py-4 bg-sky-500 hover:bg-sky-600 text-white font-semibold rounded-xl transition shadow-lg text-lg">
                <i class="fas fa-search mr-2"></i> Mulai Pencarian
            </a>
            @guest
            <a href="{{ route('register') }}" class="px-8 py-4 bg-white/10 backdrop-blur border border-white/20 text-white font-semibold rounded-xl hover:bg-white/20 transition text-lg">
                <i class="fas fa-user-plus mr-2"></i> Daftar Gratis
            </a>
            @endguest
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // FAQ Toggle
    function toggleFAQ(btn) {
        const item = btn.closest('.faq-item');
        const isActive = item.classList.contains('active');
        
        // Tutup semua
        document.querySelectorAll('.faq-item').forEach(el => el.classList.remove('active'));
        
        // Buka yang diklik jika sebelumnya tidak aktif
        if (!isActive) {
            item.classList.add('active');
        }
    }

    // Mobile touch feedback
    document.addEventListener('DOMContentLoaded', function() {
        const interactiveElements = document.querySelectorAll('button, a, .card-hover, .payment-card');
        interactiveElements.forEach(el => {
            el.addEventListener('touchstart', function() { this.style.opacity = '0.85'; });
            el.addEventListener('touchend', function() { this.style.opacity = '1'; });
        });
    });
</script>
@endpush