@extends('layouts.app')

@section('title', 'Kebijakan Privasi - AyoKos')

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

    /* Section Number */
    .section-number {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.875rem;
        font-weight: 700;
        flex-shrink: 0;
    }

    /* Scroll halus */
    html {
        scroll-behavior: smooth;
    }

    /* Alert Box */
    .alert-box {
        border-radius: 1rem;
        padding: 1.25rem;
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
    }

    /* List Item */
    .list-check {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
    }
    .list-check i {
        margin-top: 0.375rem;
        font-size: 0.5rem;
    }

    /* Smooth border transition */
    .border-transition {
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }
    .border-transition:hover {
        border-color: #0ea5e9;
    }
</style>

<!-- ==================== HERO SECTION ==================== -->
<section class="relative min-h-[45vh] flex items-center justify-center overflow-hidden" style="background: linear-gradient(160deg, #0f172a 0%, #1e293b 40%, #1e3a5f 100%);">
    <!-- Decorative gradients -->
    <div class="absolute top-[-30%] left-[-15%] w-[70%] h-[160%] bg-[radial-gradient(circle_at_35%_35%,rgba(56,189,248,0.12),transparent_60%)] pointer-events-none"></div>
    <div class="absolute bottom-[-20%] right-[-10%] w-[60%] h-[140%] bg-[radial-gradient(circle_at_70%_80%,rgba(99,102,241,0.08),transparent_60%)] pointer-events-none"></div>

    <div class="container mx-auto px-4 relative z-10 text-center" data-aos="fade-up" data-aos-duration="1000">
        <div class="w-20 h-20 md:w-24 md:h-24 bg-white/10 backdrop-blur-md border-2 border-white/20 rounded-2xl flex items-center justify-center mx-auto mb-8 shadow-2xl">
            <i class="fas fa-shield-alt text-white text-3xl md:text-4xl"></i>
        </div>

        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-6 leading-tight tracking-tight">
            Kebijakan <span class="text-sky-300">Privasi</span>
        </h1>

        <p class="text-lg md:text-xl text-slate-300 max-w-3xl mx-auto leading-relaxed mb-8">
            Kami menghargai privasi Anda dan berkomitmen untuk melindungi data pribadi yang Anda berikan. 
            Pelajari bagaimana kami mengelola informasi Anda.
        </p>

        <div class="badge-soft bg-white/10 text-sky-200 border border-white/10 backdrop-blur-sm inline-flex items-center">
            <i class="fas fa-calendar-alt mr-2 text-sky-300"></i>
            Terakhir diperbarui: {{ date('d F Y') }}
        </div>
    </div>
</section>

<!-- ==================== KONTEN KEBIJAKAN PRIVASI ==================== -->
<section class="section-padding bg-white">
    <div class="container mx-auto px-4 max-w-4xl">
        
        <!-- Pengantar -->
        <div class="mb-16" data-aos="fade-up">
            <div class="bg-white border border-slate-200 rounded-2xl p-8 shadow-sm card-hover">
                <div class="flex items-start gap-5">
                    <div class="w-14 h-14 bg-gradient-to-br from-sky-50 to-blue-50 rounded-xl flex items-center justify-center text-sky-600 text-2xl shrink-0">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900 mb-4">Pengantar</h2>
                        <div class="space-y-3 text-slate-500 leading-relaxed">
                            <p>
                                Kebijakan Privasi ini menjelaskan bagaimana AyoKos mengumpulkan, menggunakan, menyimpan, 
                                dan melindungi informasi pribadi Anda ketika Anda menggunakan platform kami.
                            </p>
                            <p>
                                Dengan menggunakan AyoKos, Anda menyetujui pengumpulan dan penggunaan informasi sesuai dengan 
                                kebijakan ini. Jika Anda tidak setuju, mohon untuk tidak menggunakan platform kami.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 1: Informasi yang Kami Kumpulkan -->
        <div class="mb-16" data-aos="fade-up">
            <div class="flex items-center gap-4 mb-8">
                <div class="section-number bg-gradient-to-br from-sky-500 to-blue-600 text-white shadow-lg shadow-sky-200">1</div>
                <h2 class="text-2xl md:text-3xl font-bold text-slate-900">Informasi yang Kami Kumpulkan</h2>
            </div>

            <!-- Informasi Pribadi -->
            <div class="bg-white border border-slate-200 rounded-2xl p-6 md:p-8 shadow-sm mb-6 card-hover">
                <h3 class="text-xl font-semibold text-slate-900 mb-6 flex items-center">
                    <i class="fas fa-user-circle text-sky-500 mr-3"></i> Informasi Pribadi
                </h3>
                
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="p-5 bg-slate-50 rounded-xl border border-slate-100">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-sky-100 rounded-lg flex items-center justify-center text-sky-600">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <h4 class="font-semibold text-slate-900">Saat Pendaftaran</h4>
                        </div>
                        <ul class="space-y-2.5">
                            <li class="list-check text-sm text-slate-600">
                                <i class="fas fa-circle text-sky-500"></i>
                                <span>Nama lengkap</span>
                            </li>
                            <li class="list-check text-sm text-slate-600">
                                <i class="fas fa-circle text-sky-500"></i>
                                <span>Alamat email</span>
                            </li>
                            <li class="list-check text-sm text-slate-600">
                                <i class="fas fa-circle text-sky-500"></i>
                                <span>Nomor telepon</span>
                            </li>
                            <li class="list-check text-sm text-slate-600">
                                <i class="fas fa-circle text-sky-500"></i>
                                <span>Username dan password</span>
                            </li>
                        </ul>
                    </div>

                    <div class="p-5 bg-slate-50 rounded-xl border border-slate-100">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center text-emerald-600">
                                <i class="fas fa-file-contract"></i>
                            </div>
                            <h4 class="font-semibold text-slate-900">Saat Transaksi</h4>
                        </div>
                        <ul class="space-y-2.5">
                            <li class="list-check text-sm text-slate-600">
                                <i class="fas fa-circle text-emerald-500"></i>
                                <span>Foto KTP (untuk verifikasi)</span>
                            </li>
                            <li class="list-check text-sm text-slate-600">
                                <i class="fas fa-circle text-emerald-500"></i>
                                <span>Alamat domisili</span>
                            </li>
                            <li class="list-check text-sm text-slate-600">
                                <i class="fas fa-circle text-emerald-500"></i>
                                <span>Data pembayaran</span>
                            </li>
                            <li class="list-check text-sm text-slate-600">
                                <i class="fas fa-circle text-emerald-500"></i>
                                <span>Bukti pembayaran</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Informasi Penggunaan -->
            <div class="bg-white border border-slate-200 rounded-2xl p-6 md:p-8 shadow-sm card-hover">
                <h3 class="text-xl font-semibold text-slate-900 mb-6 flex items-center">
                    <i class="fas fa-chart-line text-sky-500 mr-3"></i> Informasi Penggunaan
                </h3>
                
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="p-5 bg-slate-50 rounded-xl border border-slate-100">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center text-indigo-600">
                                <i class="fas fa-server"></i>
                            </div>
                            <h4 class="font-semibold text-slate-900">Data Teknis</h4>
                        </div>
                        <ul class="space-y-2.5">
                            <li class="list-check text-sm text-slate-600">
                                <i class="fas fa-circle text-indigo-500"></i>
                                <span>Alamat IP</span>
                            </li>
                            <li class="list-check text-sm text-slate-600">
                                <i class="fas fa-circle text-indigo-500"></i>
                                <span>Jenis browser dan versi</span>
                            </li>
                            <li class="list-check text-sm text-slate-600">
                                <i class="fas fa-circle text-indigo-500"></i>
                                <span>Sistem operasi</span>
                            </li>
                            <li class="list-check text-sm text-slate-600">
                                <i class="fas fa-circle text-indigo-500"></i>
                                <span>Data cookies</span>
                            </li>
                        </ul>
                    </div>

                    <div class="p-5 bg-slate-50 rounded-xl border border-slate-100">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center text-purple-600">
                                <i class="fas fa-mouse-pointer"></i>
                            </div>
                            <h4 class="font-semibold text-slate-900">Data Aktivitas</h4>
                        </div>
                        <ul class="space-y-2.5">
                            <li class="list-check text-sm text-slate-600">
                                <i class="fas fa-circle text-purple-500"></i>
                                <span>Halaman yang dikunjungi</span>
                            </li>
                            <li class="list-check text-sm text-slate-600">
                                <i class="fas fa-circle text-purple-500"></i>
                                <span>Waktu akses</span>
                            </li>
                            <li class="list-check text-sm text-slate-600">
                                <i class="fas fa-circle text-purple-500"></i>
                                <span>Interaksi dengan platform</span>
                            </li>
                            <li class="list-check text-sm text-slate-600">
                                <i class="fas fa-circle text-purple-500"></i>
                                <span>Pencarian yang dilakukan</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 2: Bagaimana Kami Menggunakan Informasi -->
        <div class="mb-16" data-aos="fade-up">
            <div class="flex items-center gap-4 mb-8">
                <div class="section-number bg-gradient-to-br from-sky-500 to-blue-600 text-white shadow-lg shadow-sky-200">2</div>
                <h2 class="text-2xl md:text-3xl font-bold text-slate-900">Bagaimana Kami Menggunakan Informasi Anda</h2>
            </div>

            <div class="grid md:grid-cols-2 gap-5">
                <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm card-hover border-transition">
                    <div class="w-12 h-12 bg-sky-50 rounded-xl flex items-center justify-center text-sky-600 text-xl mb-4">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <h4 class="font-semibold text-slate-900 mb-2">Menyediakan Layanan</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Untuk memproses pendaftaran, mengelola akun, dan menyediakan layanan yang Anda minta secara optimal.
                    </p>
                </div>

                <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm card-hover border-transition">
                    <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 text-xl mb-4">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4 class="font-semibold text-slate-900 mb-2">Verifikasi & Keamanan</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Untuk memverifikasi identitas, mencegah penipuan, dan melindungi keamanan platform.
                    </p>
                </div>

                <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm card-hover border-transition">
                    <div class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center text-purple-600 text-xl mb-4">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <h4 class="font-semibold text-slate-900 mb-2">Analisis & Pengembangan</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Untuk menganalisis penggunaan platform dan mengembangkan fitur-fitur baru yang bermanfaat.
                    </p>
                </div>

                <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm card-hover border-transition">
                    <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center text-amber-600 text-xl mb-4">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h4 class="font-semibold text-slate-900 mb-2">Komunikasi</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Untuk mengirim notifikasi, pembaruan, dan informasi penting terkait layanan Anda.
                    </p>
                </div>
            </div>
        </div>

        <!-- Section 3: Berbagi Data -->
        <div class="mb-16" data-aos="fade-up">
            <div class="flex items-center gap-4 mb-8">
                <div class="section-number bg-gradient-to-br from-sky-500 to-blue-600 text-white shadow-lg shadow-sky-200">3</div>
                <h2 class="text-2xl md:text-3xl font-bold text-slate-900">Berbagi Data dengan Pihak Ketiga</h2>
            </div>

            <!-- Alert -->
            <div class="alert-box bg-amber-50 border border-amber-200 mb-8">
                <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center text-amber-600 shrink-0">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div>
                    <p class="font-semibold text-amber-900 text-sm">Prinsip Kami</p>
                    <p class="text-amber-700 text-sm mt-1">Kami <strong>tidak menjual</strong> data pribadi Anda kepada pihak ketiga. Data hanya dibagikan sesuai kebutuhan operasional dan kewajiban hukum.</p>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm card-hover">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-sky-100 rounded-lg flex items-center justify-center text-sky-600">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <h4 class="font-semibold text-slate-900">Penyedia Layanan</h4>
                    </div>
                    <ul class="space-y-2.5">
                        <li class="list-check text-sm text-slate-600">
                            <i class="fas fa-circle text-sky-500"></i>
                            <span>Penyedia hosting dan server</span>
                        </li>
                        <li class="list-check text-sm text-slate-600">
                            <i class="fas fa-circle text-sky-500"></i>
                            <span>Layanan pembayaran</span>
                        </li>
                        <li class="list-check text-sm text-slate-600">
                            <i class="fas fa-circle text-sky-500"></i>
                            <span>Layanan analitik</span>
                        </li>
                        <li class="list-check text-sm text-slate-600">
                            <i class="fas fa-circle text-sky-500"></i>
                            <span>Layanan email marketing</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm card-hover">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-rose-100 rounded-lg flex items-center justify-center text-rose-600">
                            <i class="fas fa-balance-scale"></i>
                        </div>
                        <h4 class="font-semibold text-slate-900">Situasi Khusus</h4>
                    </div>
                    <ul class="space-y-2.5">
                        <li class="list-check text-sm text-slate-600">
                            <i class="fas fa-circle text-rose-500"></i>
                            <span>Kepatuhan hukum</span>
                        </li>
                        <li class="list-check text-sm text-slate-600">
                            <i class="fas fa-circle text-rose-500"></i>
                            <span>Perlindungan hak dan properti</span>
                        </li>
                        <li class="list-check text-sm text-slate-600">
                            <i class="fas fa-circle text-rose-500"></i>
                            <span>Keamanan publik</span>
                        </li>
                        <li class="list-check text-sm text-slate-600">
                            <i class="fas fa-circle text-rose-500"></i>
                            <span>Merger atau akuisisi</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Section 4: Keamanan Data -->
        <div class="mb-16" data-aos="fade-up">
            <div class="flex items-center gap-4 mb-8">
                <div class="section-number bg-gradient-to-br from-sky-500 to-blue-600 text-white shadow-lg shadow-sky-200">4</div>
                <h2 class="text-2xl md:text-3xl font-bold text-slate-900">Keamanan Data</h2>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl p-6 md:p-8 shadow-sm">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-14 h-14 bg-gradient-to-br from-emerald-50 to-green-50 rounded-xl flex items-center justify-center text-emerald-600 text-2xl">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-900">Kami Melindungi Data Anda dengan</h3>
                        <p class="text-slate-500 text-sm mt-1">Sistem keamanan berlapis untuk melindungi informasi Anda</p>
                    </div>
                </div>

                <div class="grid md:grid-cols-3 gap-5">
                    <div class="bg-slate-50 border border-slate-100 rounded-xl p-6 text-center card-hover">
                        <div class="w-14 h-14 bg-emerald-100 rounded-xl flex items-center justify-center mx-auto mb-4 text-emerald-600 text-2xl">
                            <i class="fas fa-lock"></i>
                        </div>
                        <h4 class="font-semibold text-slate-900 mb-2">Enkripsi SSL</h4>
                        <p class="text-slate-500 text-sm">Data ditransmisikan secara aman dengan enkripsi end-to-end</p>
                    </div>

                    <div class="bg-slate-50 border border-slate-100 rounded-xl p-6 text-center card-hover">
                        <div class="w-14 h-14 bg-emerald-100 rounded-xl flex items-center justify-center mx-auto mb-4 text-emerald-600 text-2xl">
                            <i class="fas fa-shield-virus"></i>
                        </div>
                        <h4 class="font-semibold text-slate-900 mb-2">Firewall</h4>
                        <p class="text-slate-500 text-sm">Perlindungan dari akses tidak sah dan serangan siber</p>
                    </div>

                    <div class="bg-slate-50 border border-slate-100 rounded-xl p-6 text-center card-hover">
                        <div class="w-14 h-14 bg-emerald-100 rounded-xl flex items-center justify-center mx-auto mb-4 text-emerald-600 text-2xl">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h4 class="font-semibold text-slate-900 mb-2">Monitoring 24/7</h4>
                        <p class="text-slate-500 text-sm">Pemantauan keamanan terus menerus oleh tim kami</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 5: Hak-Hak Anda -->
        <div class="mb-16" data-aos="fade-up">
            <div class="flex items-center gap-4 mb-8">
                <div class="section-number bg-gradient-to-br from-sky-500 to-blue-600 text-white shadow-lg shadow-sky-200">5</div>
                <h2 class="text-2xl md:text-3xl font-bold text-slate-900">Hak-Hak Anda</h2>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl p-6 md:p-8 shadow-sm">
                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div class="p-5 bg-sky-50 rounded-xl border border-sky-100">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-sky-100 rounded-lg flex items-center justify-center text-sky-600">
                                <i class="fas fa-user-check"></i>
                            </div>
                            <h4 class="font-semibold text-slate-900">Akses dan Koreksi</h4>
                        </div>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3 text-sm text-slate-600">
                                <i class="fas fa-eye text-sky-500 mt-0.5"></i>
                                <span>Hak untuk mengakses data pribadi Anda kapan saja</span>
                            </li>
                            <li class="flex items-start gap-3 text-sm text-slate-600">
                                <i class="fas fa-edit text-sky-500 mt-0.5"></i>
                                <span>Hak untuk memperbaiki data yang tidak akurat</span>
                            </li>
                        </ul>
                    </div>

                    <div class="p-5 bg-rose-50 rounded-xl border border-rose-100">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-rose-100 rounded-lg flex items-center justify-center text-rose-600">
                                <i class="fas fa-user-slash"></i>
                            </div>
                            <h4 class="font-semibold text-slate-900">Penghapusan dan Pembatasan</h4>
                        </div>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3 text-sm text-slate-600">
                                <i class="fas fa-trash-alt text-rose-500 mt-0.5"></i>
                                <span>Hak untuk meminta penghapusan data</span>
                            </li>
                            <li class="flex items-start gap-3 text-sm text-slate-600">
                                <i class="fas fa-ban text-amber-500 mt-0.5"></i>
                                <span>Hak untuk membatasi pemrosesan data</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="bg-slate-50 border border-slate-100 rounded-xl p-5 flex items-start gap-4">
                    <div class="w-10 h-10 bg-sky-100 rounded-lg flex items-center justify-center text-sky-600 shrink-0">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Untuk menggunakan hak-hak Anda, silakan hubungi kami melalui email di 
                            <a href="mailto:valorant270306@gmail.com" class="text-sky-600 hover:text-sky-700 font-medium hover:underline">valorant270306@gmail.com</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hubungi Kami -->
        <div class="mb-16" data-aos="fade-up">
            <div class="bg-white border border-slate-200 rounded-2xl p-6 md:p-8 shadow-sm">
                <h2 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                    <i class="fas fa-headset text-sky-500 mr-3"></i> Hubungi Kami
                </h2>
                
                <p class="text-slate-500 mb-8 leading-relaxed">
                    Jika Anda memiliki pertanyaan tentang Kebijakan Privasi ini, jangan ragu untuk menghubungi kami. Tim kami siap membantu Anda.
                </p>

                <div class="grid md:grid-cols-2 gap-6">
                    <div class="p-5 bg-slate-50 rounded-xl border border-slate-100">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-sky-100 rounded-lg flex items-center justify-center text-sky-600">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <h4 class="font-semibold text-slate-900">Petugas Privasi Data</h4>
                        </div>
                        <div class="space-y-3 ml-13">
                            <div class="flex items-center gap-3 text-sm text-slate-600">
                                <i class="fas fa-envelope text-sky-500 w-4"></i>
                                <a href="mailto:valorant270306@gmail.com" class="hover:text-sky-600 transition">valorant270306@gmail.com</a>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-slate-600">
                                <i class="fas fa-phone text-sky-500 w-4"></i>
                                <span>+6282121730722</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-5 bg-slate-50 rounded-xl border border-slate-100">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center text-emerald-600">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <h4 class="font-semibold text-slate-900">Alamat Kantor</h4>
                        </div>
                        <div class="space-y-1 text-sm text-slate-600 ml-13">
                            <p>Jl. Kebijakan Privasi No. 123</p>
                            <p>Jakarta Selatan, DKI Jakarta</p>
                            <p>Indonesia 12560</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- ==================== CTA FINAL ==================== -->
<section class="section-padding bg-gradient-to-r from-slate-800 via-slate-900 to-slate-800 text-white relative overflow-hidden">
    <div class="absolute top-0 right-0 w-[50%] h-full bg-[radial-gradient(circle_at_80%_50%,rgba(56,189,248,0.08),transparent_60%)] pointer-events-none"></div>
    
    <div class="container mx-auto px-4 text-center relative z-10" data-aos="fade-up">
        <h2 class="text-3xl md:text-5xl font-bold mb-4">Punya Pertanyaan?</h2>
        <p class="text-lg text-slate-300 mb-8 max-w-2xl mx-auto">
            Kami siap membantu menjawab segala pertanyaan terkait privasi dan keamanan data Anda.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="mailto:valorant270306@gmail.com" class="px-8 py-4 bg-sky-500 hover:bg-sky-600 text-white font-semibold rounded-xl transition shadow-lg text-lg">
                <i class="fas fa-envelope mr-2"></i> Hubungi Kami
            </a>
            <a href="{{ route('public.kos.index') }}" class="px-8 py-4 bg-white/10 backdrop-blur border border-white/20 text-white font-semibold rounded-xl hover:bg-white/20 transition text-lg">
                <i class="fas fa-search mr-2"></i> Jelajahi Kos
            </a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // Mobile touch feedback
    document.addEventListener('DOMContentLoaded', function() {
        const interactiveElements = document.querySelectorAll('button, a, .card-hover');
        interactiveElements.forEach(el => {
            el.addEventListener('touchstart', function() { this.style.opacity = '0.85'; });
            el.addEventListener('touchend', function() { this.style.opacity = '1'; });
        });
    });
</script>
@endpush