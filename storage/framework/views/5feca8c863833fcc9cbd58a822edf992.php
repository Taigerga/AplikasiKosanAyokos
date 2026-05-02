<?php $__env->startSection('title', 'AyoKos - Tempat Cari Kos Terbaik & Terpercaya'); ?>

<?php $__env->startSection('content'); ?>

<style>
    /* Hero Section */
    .hero-full {
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
        background: linear-gradient(160deg, #0f172a 0%, #1e293b 40%, #1e3a5f 100%);
        overflow: hidden;
        margin-top: 0;
        padding-top: 0;
    }

    .hero-full::before {
        content: '';
        position: absolute;
        top: -30%;
        left: -15%;
        width: 70%;
        height: 160%;
        background: radial-gradient(circle at 35% 35%, rgba(56, 189, 248, 0.12), transparent 60%);
        pointer-events: none;
    }

    .hero-full::after {
        content: '';
        position: absolute;
        bottom: -20%;
        right: -10%;
        width: 60%;
        height: 140%;
        background: radial-gradient(circle at 70% 80%, rgba(99, 102, 241, 0.08), transparent 60%);
        pointer-events: none;
    }

    .hero-content {
        position: relative;
        z-index: 10;
    }

    /* Section Umum */
    .section-padding {
        padding: 6rem 0;
    }

    @media (max-width: 768px) {
        .section-padding {
            padding: 4rem 0;
        }
        .hero-full {
            min-height: 90vh;
        }
    }

    /* Card Kos Detail */
    .kos-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 1.25rem;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .kos-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 40px -12px rgba(0,0,0,0.1);
        border-color: #cbd5e1;
    }

    /* Fasilitas Card */
    .facility-card {
        background: #ffffff;
        border: 1px solid #f1f5f9;
        border-radius: 1rem;
        padding: 2rem 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
    }

    .facility-card:hover {
        box-shadow: 0 12px 28px rgba(0,0,0,0.05);
        border-color: #e2e8f0;
        transform: translateY(-2px);
    }

    .facility-icon {
        width: 56px;
        height: 56px;
        border-radius: 1rem;
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.25rem;
        font-size: 1.5rem;
    }

    /* Testimoni Card */
    .testi-card {
        background: #ffffff;
        border: 1px solid #f1f5f9;
        border-radius: 1.25rem;
        padding: 2rem;
        box-shadow: 0 4px 16px rgba(0,0,0,0.02);
        transition: all 0.3s ease;
    }

    .testi-card:hover {
        box-shadow: 0 12px 32px rgba(0,0,0,0.06);
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

    /* Scroll halus */
    html {
        scroll-behavior: smooth;
    }

    /* Badge */
    .badge-soft {
        display: inline-block;
        padding: 0.35rem 1rem;
        border-radius: 999px;
        font-size: 0.8rem;
        font-weight: 500;
    }
</style>

<!-- ==================== HERO BANNER FULL-WIDTH ==================== -->
<section class="hero-full">
    <div class="container mx-auto px-4 hero-content text-center">
        <div class="max-w-4xl mx-auto" data-aos="fade-up" data-aos-duration="1000">
            <div class="w-20 h-20 md:w-24 md:h-24 bg-white/10 backdrop-blur-md border-2 border-white/20 rounded-2xl flex items-center justify-center mx-auto mb-8 shadow-2xl">
                <i class="fas fa-home text-white text-3xl md:text-4xl"></i>
            </div>

            <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold mb-6 text-white leading-tight tracking-tight">
                Temukan <span class="text-sky-300">Ruang Nyaman</span> untuk Hidup Lebih Baik
            </h1>

            <p class="text-lg md:text-xl text-slate-300 mb-10 max-w-2xl mx-auto leading-relaxed">
                Jelajahi ribuan kos premium dengan fasilitas lengkap, harga transparan, dan lokasi strategis di seluruh Indonesia.
            </p>

            <form action="<?php echo e(route('public.kos.index')); ?>" method="GET" class="max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                <div class="bg-white/5 backdrop-blur-lg border border-white/15 rounded-2xl p-2.5 md:p-3 shadow-2xl">
                    <div class="flex flex-col md:flex-row gap-2.5 md:gap-3">
                        <div class="flex-1 relative">
                            <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                            <input type="text" name="search" placeholder="Cari nama kos atau lokasi..."
                                class="w-full pl-12 pr-4 py-4 bg-white/10 border border-white/10 text-white placeholder-slate-400 rounded-xl focus:outline-none focus:border-sky-400 focus:bg-white/20 transition text-sm">
                        </div>
                        <div class="relative md:w-56">
                            <i class="fas fa-users absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                            <select name="jenis_kos"
                                class="w-full pl-12 pr-10 py-4 bg-white/10 border border-white/10 text-white rounded-xl focus:outline-none appearance-none transition text-sm">
                                <option value="" class="text-slate-900">Semua Jenis</option>
                                <option value="putra" class="text-slate-900">Putra</option>
                                <option value="putri" class="text-slate-900">Putri</option>
                                <option value="campuran" class="text-slate-900">Campuran</option>
                            </select>
                            <i class="fas fa-chevron-down absolute right-4 top-1/2 transform -translate-y-1/2 text-slate-400 pointer-events-none"></i>
                        </div>
                        <button type="submit"
                            class="px-8 py-4 bg-sky-500 hover:bg-sky-600 text-white font-semibold rounded-xl transition shadow-lg text-sm">
                            <i class="fas fa-search mr-2"></i> Cari Kos
                        </button>
                    </div>
                </div>
            </form>

            <!-- Quick Stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-14 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="400">
                <div class="bg-white/5 backdrop-blur-sm rounded-xl p-5 border border-white/10">
                    <div class="text-3xl md:text-4xl font-bold text-white"><?php echo e($totalKos ?? '120'); ?>+</div>
                    <div class="text-sm text-slate-400 mt-1">Kos Tersedia</div>
                </div>
                <div class="bg-white/5 backdrop-blur-sm rounded-xl p-5 border border-white/10">
                    <div class="text-3xl md:text-4xl font-bold text-white"><?php echo e($totalKamar ?? '680'); ?>+</div>
                    <div class="text-sm text-slate-400 mt-1">Kamar Kosong</div>
                </div>
                <div class="bg-white/5 backdrop-blur-sm rounded-xl p-5 border border-white/10">
                    <div class="text-3xl md:text-4xl font-bold text-white"><?php echo e($kotaTerdaftar ?? '25'); ?>+</div>
                    <div class="text-sm text-slate-400 mt-1">Kota</div>
                </div>
                <div class="bg-white/5 backdrop-blur-sm rounded-xl p-5 border border-white/10">
                    <div class="text-3xl md:text-4xl font-bold text-white"><?php echo e($penghuniAktif ?? '2.5K'); ?>+</div>
                    <div class="text-sm text-slate-400 mt-1">Penghuni Aktif</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== TENTANG / DESKRIPSI KOS ==================== -->
<section class="section-padding bg-white">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-16">
            <div class="lg:w-1/2" data-aos="fade-right">
                <span class="badge-soft bg-sky-50 text-sky-700 border border-sky-100 mb-4">Tentang AyoKos</span>
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6 leading-tight">
                    Platform Pencarian Kos <span class="text-sky-600">Terlengkap</span> di Indonesia
                </h2>
                <p class="text-slate-500 leading-relaxed mb-4">
                    AyoKos hadir untuk memudahkan Anda menemukan hunian sementara yang nyaman, aman, dan sesuai budget. 
                    Dengan lebih dari ratusan pilihan kos di berbagai kota, kami menyediakan informasi lengkap mulai dari 
                    fasilitas, harga, foto, hingga review dari penghuni sebelumnya.
                </p>
                <p class="text-slate-500 leading-relaxed mb-6">
                    Setiap properti telah diverifikasi oleh tim kami untuk memastikan keakuratan data dan kenyamanan Anda 
                    selama tinggal. Proses pencarian yang cepat, filter yang lengkap, dan dukungan pelanggan 24/7 
                    menjadikan AyoKos pilihan utama para pencari kos di Indonesia.
                </p>
                <a href="<?php echo e(route('public.kos.index')); ?>" class="inline-flex items-center px-6 py-3 bg-sky-600 text-white font-semibold rounded-xl hover:bg-sky-700 transition shadow-md">
                    Jelajahi Kos <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            <div class="lg:w-1/2 grid grid-cols-2 gap-4" data-aos="fade-left">
                <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=400&h=300&fit=crop" alt="Kos modern" class="rounded-2xl shadow-md w-full h-40 object-cover" loading="lazy">
                <img src="https://images.unsplash.com/photo-1560185893-a55cbc8c57e8?w=400&h=300&fit=crop" alt="Kamar kos" class="rounded-2xl shadow-md w-full h-40 object-cover mt-6" loading="lazy">
                <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=400&h=300&fit=crop" alt="Ruang tamu" class="rounded-2xl shadow-md w-full h-40 object-cover" loading="lazy">
                <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=400&h=300&fit=crop" alt="Fasilitas kos" class="rounded-2xl shadow-md w-full h-40 object-cover mt-6" loading="lazy">
            </div>
        </div>
    </div>
</section>

<!-- ==================== FASILITAS ==================== -->
<section class="section-padding bg-slate-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="badge-soft bg-sky-50 text-sky-700 border border-sky-100 mb-3">Fasilitas Unggulan</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Fasilitas yang Mendukung <span class="text-sky-600">Kenyamanan</span> Anda</h2>
            <p class="text-slate-500 max-w-xl mx-auto">Setiap kos yang terdaftar dilengkapi dengan fasilitas standar hingga premium</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 md:gap-6">
            <div class="facility-card" data-aos="zoom-in" data-aos-delay="0">
                <div class="facility-icon"><i class="fas fa-wifi"></i></div>
                <h4 class="font-semibold text-slate-900 mb-1">WiFi Cepat</h4>
                <p class="text-xs text-slate-400">Internet stabil 24 jam</p>
            </div>
            <div class="facility-card" data-aos="zoom-in" data-aos-delay="100">
                <div class="facility-icon"><i class="fas fa-tshirt"></i></div>
                <h4 class="font-semibold text-slate-900 mb-1">Laundry</h4>
                <p class="text-xs text-slate-400">Mesin cuci & setrika</p>
            </div>
            <div class="facility-card" data-aos="zoom-in" data-aos-delay="200">
                <div class="facility-icon"><i class="fas fa-shield-alt"></i></div>
                <h4 class="font-semibold text-slate-900 mb-1">Keamanan 24/7</h4>
                <p class="text-xs text-slate-400">CCTV & satpam</p>
            </div>
            <div class="facility-card" data-aos="zoom-in" data-aos-delay="300">
                <div class="facility-icon"><i class="fas fa-car"></i></div>
                <h4 class="font-semibold text-slate-900 mb-1">Parkir Luas</h4>
                <p class="text-xs text-slate-400">Motor & mobil</p>
            </div>
            <div class="facility-card" data-aos="zoom-in" data-aos-delay="400">
                <div class="facility-icon"><i class="fas fa-snowflake"></i></div>
                <h4 class="font-semibold text-slate-900 mb-1">AC</h4>
                <p class="text-xs text-slate-400">Kamar sejuk nyaman</p>
            </div>
            <div class="facility-card" data-aos="zoom-in" data-aos-delay="500">
                <div class="facility-icon"><i class="fas fa-kitchen-set"></i></div>
                <h4 class="font-semibold text-slate-900 mb-1">Dapur Bersama</h4>
                <p class="text-xs text-slate-400">Peralatan lengkap</p>
            </div>
        </div>
    </div>
</section>

<!-- ==================== KEUNGGULAN / USP ==================== -->
<section class="section-padding bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="badge-soft bg-sky-50 text-sky-700 border border-sky-100 mb-3">Mengapa AyoKos?</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Keunggulan yang Membuat <span class="text-sky-600">Perbedaan</span></h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-8" data-aos="fade-up" data-aos-delay="0">
                <div class="w-16 h-16 bg-gradient-to-br from-sky-50 to-blue-50 rounded-2xl flex items-center justify-center mx-auto mb-5 text-sky-600 text-2xl">
                    <i class="fas fa-clipboard-check"></i>
                </div>
                <h3 class="text-xl font-semibold text-slate-900 mb-3">100% Terverifikasi</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Semua pemilik dan properti telah melalui proses verifikasi ketat untuk menjamin keamanan dan kenyamanan Anda.</p>
            </div>
            <div class="text-center p-8" data-aos="fade-up" data-aos-delay="150">
                <div class="w-16 h-16 bg-gradient-to-br from-sky-50 to-blue-50 rounded-2xl flex items-center justify-center mx-auto mb-5 text-sky-600 text-2xl">
                    <i class="fas fa-tag"></i>
                </div>
                <h3 class="text-xl font-semibold text-slate-900 mb-3">Harga Transparan</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Informasi biaya lengkap tanpa biaya tersembunyi. Bandingkan harga dengan mudah dan temukan yang terbaik.</p>
            </div>
            <div class="text-center p-8" data-aos="fade-up" data-aos-delay="300">
                <div class="w-16 h-16 bg-gradient-to-br from-sky-50 to-blue-50 rounded-2xl flex items-center justify-center mx-auto mb-5 text-sky-600 text-2xl">
                    <i class="fas fa-headset"></i>
                </div>
                <h3 class="text-xl font-semibold text-slate-900 mb-3">Dukungan 24/7</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Tim kami siap membantu kapan pun melalui live chat, telepon, atau email untuk pertanyaan dan keluhan Anda.</p>
            </div>
        </div>
    </div>
</section>

<!-- ==================== REKOMENDASI KOS (DETAIL) ==================== -->
<section class="section-padding bg-slate-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="badge-soft bg-sky-50 text-sky-700 border border-sky-100 mb-3">Rekomendasi</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Kos Pilihan <span class="text-sky-600">Terbaik</span> Untuk Anda</h2>
            <p class="text-slate-500 max-w-xl mx-auto">Hunian nyaman dengan fasilitas lengkap dan harga bersahabat</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__currentLoopData = $rekomendasiKos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="kos-card" data-aos="fade-up" data-aos-delay="<?php echo e($loop->index * 100); ?>">
                <div class="relative h-52 overflow-hidden">
                    <?php if($kos->foto_utama): ?>
                        <?php
                            $filePath = storage_path('app/public/' . $kos->foto_utama);
                            $fileExists = file_exists($filePath);
                        ?>
                        <?php if($fileExists): ?>
                            <img src="<?php echo e(url('storage/' . $kos->foto_utama)); ?>" alt="<?php echo e($kos->nama_kos); ?>"
                                class="w-full h-full object-cover hover:scale-105 transition duration-500" loading="lazy">
                        <?php else: ?>
                            <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                                <i class="fas fa-home text-4xl text-slate-300"></i>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                            <i class="fas fa-home text-4xl text-slate-300"></i>
                        </div>
                    <?php endif; ?>
                    <div class="absolute top-3 left-3">
                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-white/90 text-slate-700 shadow-sm">
                            <?php echo e(ucfirst($kos->jenis_kos)); ?>

                        </span>
                    </div>
                    <div class="absolute top-3 right-3">
                        <?php
                            $minHarga = $kos->kamar->min('harga') ?? 0;
                            $hargaText = $minHarga > 1000000 ? 'Rp ' . number_format($minHarga/1000000, 1) . ' Jt' : 'Rp ' . number_format($minHarga, 0, ',', '.');
                        ?>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                            <?php echo e($hargaText); ?>

                        </span>
                    </div>
                </div>

                <div class="p-5 flex flex-col flex-grow">
                    <div class="flex items-start justify-between mb-2">
                        <h3 class="text-lg font-semibold text-slate-900 line-clamp-1"><?php echo e($kos->nama_kos); ?></h3>
                        <?php if($kos->reviews->avg('rating')): ?>
                        <div class="flex items-center text-amber-500 text-sm ml-2 shrink-0">
                            <i class="fas fa-star mr-1"></i>
                            <span class="text-slate-700 font-medium"><?php echo e(number_format($kos->reviews->avg('rating'), 1)); ?></span>
                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="flex items-center text-slate-500 text-sm mb-3">
                        <i class="fas fa-map-marker-alt mr-2 text-sky-500"></i>
                        <span class="truncate"><?php echo e($kos->alamat); ?></span>
                    </div>

                    <div class="flex flex-wrap gap-1.5 mb-4">
                        <?php $__currentLoopData = $kos->fasilitas->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="px-2.5 py-1 text-xs rounded-full bg-slate-50 text-slate-600 border border-slate-100">
                            <i class="fas fa-<?php echo e($fas->icon ?? 'check'); ?> mr-1 text-sky-500"></i><?php echo e($fas->nama_fasilitas); ?>

                        </span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if($kos->fasilitas->count() > 4): ?>
                        <span class="px-2.5 py-1 text-xs rounded-full bg-slate-50 text-slate-400 border border-slate-100">
                            +<?php echo e($kos->fasilitas->count() - 4); ?>

                        </span>
                        <?php endif; ?>
                    </div>

                    <p class="text-sm text-slate-500 mb-4 line-clamp-2">
                        <?php echo e($kos->deskripsi ?? 'Kos nyaman dengan lingkungan asri, akses mudah ke transportasi umum, dan fasilitas lengkap.'); ?>

                    </p>

                    <div class="mt-auto">
                        <a href="<?php echo e(route('public.kos.show', $kos->id_kos)); ?>"
                            class="block w-full text-center bg-white border-2 border-sky-100 text-sky-600 hover:bg-sky-50 hover:border-sky-200 py-2.5 rounded-xl font-medium transition text-sm">
                            Lihat Detail <i class="fas fa-arrow-right ml-1 text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="text-center mt-10" data-aos="fade-up">
            <a href="<?php echo e(route('public.kos.index')); ?>"
                class="inline-flex items-center px-6 py-3 border-2 border-slate-200 text-slate-700 rounded-xl hover:bg-slate-50 hover:border-slate-300 transition font-medium">
                Lihat Semua Kos <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- ==================== DAFTAR KAMAR & HARGA ==================== -->
<section class="section-padding bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="badge-soft bg-sky-50 text-sky-700 border border-sky-100 mb-3">Harga</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Estimasi <span class="text-sky-600">Biaya Hunian</span></h2>
            <p class="text-slate-500 max-w-xl mx-auto">Gambaran harga kos berdasarkan tipe dan fasilitas</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto">
            <div class="bg-white border border-slate-200 rounded-2xl p-6 text-center shadow-sm" data-aos="flip-left" data-aos-delay="0">
                <div class="w-14 h-14 bg-amber-50 rounded-xl flex items-center justify-center mx-auto mb-4 text-amber-600 text-xl">
                    <i class="fas fa-star"></i>
                </div>
                <h4 class="font-semibold text-slate-900 mb-2">Standar</h4>
                <div class="text-3xl font-bold text-slate-900 mb-1">Rp 500K</div>
                <p class="text-sm text-slate-400 mb-4">per bulan</p>
                <ul class="text-sm text-slate-500 space-y-2 text-left">
                    <li><i class="fas fa-check text-emerald-500 mr-2"></i>Kamar 3x3 m</li>
                    <li><i class="fas fa-check text-emerald-500 mr-2"></i>Kamar mandi dalam</li>
                    <li><i class="fas fa-check text-emerald-500 mr-2"></i>WiFi dasar</li>
                </ul>
            </div>
            <div class="bg-white border-2 border-sky-200 rounded-2xl p-6 text-center shadow-md relative transform scale-105" data-aos="flip-left" data-aos-delay="150">
                <span class="absolute -top-3 left-1/2 transform -translate-x-1/2 bg-sky-600 text-white px-4 py-1 rounded-full text-xs font-semibold">Populer</span>
                <div class="w-14 h-14 bg-sky-50 rounded-xl flex items-center justify-center mx-auto mb-4 text-sky-600 text-xl">
                    <i class="fas fa-crown"></i>
                </div>
                <h4 class="font-semibold text-slate-900 mb-2">Premium</h4>
                <div class="text-3xl font-bold text-slate-900 mb-1">Rp 1.2 Jt</div>
                <p class="text-sm text-slate-400 mb-4">per bulan</p>
                <ul class="text-sm text-slate-500 space-y-2 text-left">
                    <li><i class="fas fa-check text-emerald-500 mr-2"></i>Kamar 4x4 m</li>
                    <li><i class="fas fa-check text-emerald-500 mr-2"></i>AC & WiFi cepat</li>
                    <li><i class="fas fa-check text-emerald-500 mr-2"></i>Laundry gratis</li>
                </ul>
            </div>
            <div class="bg-white border border-slate-200 rounded-2xl p-6 text-center shadow-sm" data-aos="flip-left" data-aos-delay="300">
                <div class="w-14 h-14 bg-indigo-50 rounded-xl flex items-center justify-center mx-auto mb-4 text-indigo-600 text-xl">
                    <i class="fas fa-gem"></i>
                </div>
                <h4 class="font-semibold text-slate-900 mb-2">VIP</h4>
                <div class="text-3xl font-bold text-slate-900 mb-1">Rp 2.5 Jt</div>
                <p class="text-sm text-slate-400 mb-4">per bulan</p>
                <ul class="text-sm text-slate-500 space-y-2 text-left">
                    <li><i class="fas fa-check text-emerald-500 mr-2"></i>Kamar 5x5 m</li>
                    <li><i class="fas fa-check text-emerald-500 mr-2"></i>AC, TV, WiFi</li>
                    <li><i class="fas fa-check text-emerald-500 mr-2"></i>Dapur pribadi</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- ==================== TESTIMONI PENGHUNI ==================== -->
<section class="section-padding bg-slate-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="badge-soft bg-sky-50 text-sky-700 border border-sky-100 mb-3">Testimoni</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Apa Kata <span class="text-sky-600">Mereka</span>?</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="testi-card" data-aos="fade-up" data-aos-delay="0">
                <div class="flex items-center gap-1 text-amber-400 mb-3">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <p class="text-slate-600 text-sm mb-4 italic leading-relaxed">"Proses pencarian kos jadi sangat mudah. Filter yang lengkap membantu saya menemukan kos putri dekat kampus dalam hitungan menit. Sangat direkomendasikan!"</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-sky-100 rounded-full flex items-center justify-center text-sky-600 font-semibold">RA</div>
                    <div>
                        <div class="font-semibold text-slate-800 text-sm">Rina A.</div>
                        <div class="text-xs text-slate-400">Mahasiswi ITB</div>
                    </div>
                </div>
            </div>
            <div class="testi-card" data-aos="fade-up" data-aos-delay="150">
                <div class="flex items-center gap-1 text-amber-400 mb-3">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <p class="text-slate-600 text-sm mb-4 italic leading-relaxed">"Foto dan detail kos sangat jelas. Tidak perlu survey satu per satu. Sangat menghemat waktu dan tenaga. Terima kasih AyoKos!"</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 font-semibold">AP</div>
                    <div>
                        <div class="font-semibold text-slate-800 text-sm">Andi P.</div>
                        <div class="text-xs text-slate-400">Pekerja Swasta</div>
                    </div>
                </div>
            </div>
            <div class="testi-card" data-aos="fade-up" data-aos-delay="300">
                <div class="flex items-center gap-1 text-amber-400 mb-3">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <p class="text-slate-600 text-sm mb-4 italic leading-relaxed">"Pemilik kos responsif dan proses booking cepat. Saya langsung dapat kamar dalam 2 hari. Pelayanan sangat memuaskan!"</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 font-semibold">SD</div>
                    <div>
                        <div class="font-semibold text-slate-800 text-sm">Sari D.</div>
                        <div class="text-xs text-slate-400">Karyawan BUMN</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== LOKASI / MAP ==================== -->
<section class="section-padding bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="badge-soft bg-sky-50 text-sky-700 border border-sky-100 mb-3">Lokasi</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Sebaran Kos <span class="text-sky-600">di Indonesia</span></h2>
            <p class="text-slate-500 max-w-xl mx-auto">Kami hadir di berbagai kota besar di Indonesia</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-4xl mx-auto" data-aos="fade-up">
            <div class="bg-slate-50 border border-slate-100 rounded-xl p-5 text-center hover:shadow-md transition cursor-default">
                <i class="fas fa-city text-sky-500 text-2xl mb-2"></i>
                <div class="font-semibold text-slate-900">Jakarta</div>
                <div class="text-xs text-slate-400">45+ Kos</div>
            </div>
            <div class="bg-slate-50 border border-slate-100 rounded-xl p-5 text-center hover:shadow-md transition cursor-default">
                <i class="fas fa-city text-sky-500 text-2xl mb-2"></i>
                <div class="font-semibold text-slate-900">Bandung</div>
                <div class="text-xs text-slate-400">60+ Kos</div>
            </div>
            <div class="bg-slate-50 border border-slate-100 rounded-xl p-5 text-center hover:shadow-md transition cursor-default">
                <i class="fas fa-city text-sky-500 text-2xl mb-2"></i>
                <div class="font-semibold text-slate-900">Surabaya</div>
                <div class="text-xs text-slate-400">35+ Kos</div>
            </div>
            <div class="bg-slate-50 border border-slate-100 rounded-xl p-5 text-center hover:shadow-md transition cursor-default">
                <i class="fas fa-city text-sky-500 text-2xl mb-2"></i>
                <div class="font-semibold text-slate-900">Malang</div>
                <div class="text-xs text-slate-400">28+ Kos</div>
            </div>
        </div>

        <div class="text-center mt-8" data-aos="fade-up">
            <a href="<?php echo e(route('public.kos.peta')); ?>" class="inline-flex items-center px-6 py-3 bg-white border-2 border-slate-200 text-slate-700 rounded-xl hover:bg-slate-50 transition font-medium">
                <i class="fas fa-map-marked-alt mr-2 text-sky-500"></i> Lihat Peta Interaktif
            </a>
        </div>
    </div>
</section>

<!-- ==================== FAQ ==================== -->
<section class="section-padding bg-slate-50">
    <div class="container mx-auto px-4 max-w-3xl">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="badge-soft bg-sky-50 text-sky-700 border border-sky-100 mb-3">FAQ</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Pertanyaan <span class="text-sky-600">Umum</span></h2>
        </div>

        <div data-aos="fade-up">
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFAQ(this)">
                    <span>Bagaimana cara memesan kos melalui AyoKos?</span>
                    <i class="fas fa-chevron-down faq-icon"></i>
                </button>
                <div class="faq-answer">
                    Anda dapat mencari kos melalui halaman pencarian, melihat detail, lalu menghubungi pemilik kos langsung melalui kontak yang tersedia. Proses pemesanan dilakukan secara langsung antara penghuni dan pemilik.
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFAQ(this)">
                    <span>Apakah data kos yang ditampilkan akurat?</span>
                    <i class="fas fa-chevron-down faq-icon"></i>
                </button>
                <div class="faq-answer">
                    Ya, semua kos telah diverifikasi oleh tim kami. Namun kami tetap menyarankan untuk melakukan survey langsung sebelum memutuskan untuk menyewa.
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFAQ(this)">
                    <span>Berapa biaya layanan AyoKos?</span>
                    <i class="fas fa-chevron-down faq-icon"></i>
                </button>
                <div class="faq-answer">
                    AyoKos tidak memungut biaya apapun dari pencari kos. Layanan kami 100% gratis untuk penghuni.
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFAQ(this)">
                    <span>Bagaimana jika ada masalah dengan kos yang disewa?</span>
                    <i class="fas fa-chevron-down faq-icon"></i>
                </button>
                <div class="faq-answer">
                    Anda dapat menghubungi tim dukungan kami 24/7 melalui email atau telepon yang tertera di halaman kontak. Kami akan membantu memediasi masalah Anda.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== CTA FINAL ==================== -->
<section class="section-padding bg-gradient-to-r from-slate-800 via-slate-900 to-slate-800 text-white">
    <div class="container mx-auto px-4 text-center" data-aos="fade-up">
        <h2 class="text-3xl md:text-5xl font-bold mb-4">Siap Tinggal di Kos Impian?</h2>
        <p class="text-lg text-slate-300 mb-8 max-w-xl mx-auto">Daftar sekarang dan dapatkan rekomendasi kos terbaik sesuai preferensimu. Gratis!</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?php echo e(route('public.kos.index')); ?>" class="px-8 py-4 bg-sky-500 hover:bg-sky-600 text-white font-semibold rounded-xl transition shadow-lg text-lg">
                <i class="fas fa-search mr-2"></i> Cari Kos Sekarang
            </a>
            <?php if(auth()->guard()->guest()): ?>
            <a href="<?php echo e(route('register')); ?>" class="px-8 py-4 bg-white/10 backdrop-blur border border-white/20 text-white font-semibold rounded-xl hover:bg-white/20 transition text-lg">
                <i class="fas fa-user-plus mr-2"></i> Daftar Gratis
            </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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

    // Scroll halus untuk anchor link
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href === '#') return;
            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // Mobile touch feedback
    document.addEventListener('DOMContentLoaded', function() {
        const interactiveElements = document.querySelectorAll('button, a, .touch-target');
        interactiveElements.forEach(el => {
            el.addEventListener('touchstart', function() { this.style.opacity = '0.85'; });
            el.addEventListener('touchend', function() { this.style.opacity = '1'; });
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/public/home.blade.php ENDPATH**/ ?>