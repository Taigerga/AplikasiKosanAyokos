<?php $__env->startSection('title', 'AyoKos - Tempat Cari Kos Terbaik & Terpercaya'); ?>

<?php $__env->startSection('content'); ?>

<!-- ==================== HERO BANNER FULL-WIDTH ==================== -->
<section class="relative bg-yellow-400 pt-28 pb-16 md:pt-32 md:pb-20 overflow-hidden border-b-4 border-black">
    <div class="container mx-auto px-4 hero-content text-center">
        <div class="max-w-4xl mx-auto" data-aos="fade-up" data-aos-duration="1000">
            <!-- Icon box -->
            <div class="w-20 h-20 md:w-24 md:h-24 bg-black border-4 border-black shadow-[4px_4px_0px_#000] flex items-center justify-center mx-auto mb-8">
                <i class="fas fa-home text-white text-3xl md:text-4xl"></i>
            </div>

            <h1 class="text-4xl md:text-6xl lg:text-7xl font-black mb-6 text-black leading-tight tracking-tight">
                Temukan <span class="bg-black text-white px-3 py-1 inline-block">Ruang Nyaman</span> untuk Hidup Lebih Baik
            </h1>

            <p class="text-lg md:text-xl text-gray-900 mb-10 max-w-2xl mx-auto leading-relaxed font-medium">
                Jelajahi ribuan kos premium dengan fasilitas lengkap, harga transparan, dan lokasi strategis di seluruh Indonesia.
            </p>

            <form action="<?php echo e(route('public.kos.index')); ?>" method="GET" class="max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                <div class="bg-white border-4 border-black shadow-[6px_6px_0px_#000] p-4">
                    <div class="flex flex-col md:flex-row gap-3">
                        <div class="flex-1 relative">
                            <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-900"></i>
                            <input type="text" name="search" placeholder="Cari nama kos atau lokasi..."
                                class="w-full pl-12 pr-4 py-4 bg-white border-2 border-black text-black placeholder-gray-700 focus:outline-none focus:ring-4 focus:ring-yellow-400 transition text-sm font-medium">
                        </div>
                        <div class="relative md:w-56">
                            <i class="fas fa-users absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-900"></i>
                            <select name="jenis_kos"
                                class="w-full pl-12 pr-10 py-4 bg-white border-2 border-black text-black focus:outline-none focus:ring-4 focus:ring-yellow-400 appearance-none transition text-sm font-medium">
                                <option value="" class="text-gray-900">Semua Jenis</option>
                                <option value="putra" class="text-gray-900">Putra</option>
                                <option value="putri" class="text-gray-900">Putri</option>
                                <option value="campuran" class="text-gray-900">Campuran</option>
                            </select>
                            <i class="fas fa-chevron-down absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-900 pointer-events-none"></i>
                        </div>
                        <button type="submit"
                            class="px-8 py-4 bg-lime-400 hover:bg-lime-500 text-black font-black border-2 border-black shadow-[4px_4px_0px_#000] transition text-sm uppercase tracking-wide">
                            <i class="fas fa-search mr-2"></i> Cari Kos
                        </button>
                    </div>
                </div>
            </form>

            <!-- Quick Stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-14 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="400">
                <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-5 text-center">
                    <div class="text-3xl md:text-4xl font-black text-black"><?php echo e($totalKos ?? '120'); ?>+</div>
                    <div class="text-sm font-bold text-gray-700 mt-1">Kos Tersedia</div>
                </div>
                <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-5 text-center">
                    <div class="text-3xl md:text-4xl font-black text-black"><?php echo e($totalKamar ?? '680'); ?>+</div>
                    <div class="text-sm font-bold text-gray-700 mt-1">Kamar Kosong</div>
                </div>
                <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-5 text-center">
                    <div class="text-3xl md:text-4xl font-black text-black"><?php echo e($kotaTerdaftar ?? '25'); ?>+</div>
                    <div class="text-sm font-bold text-gray-700 mt-1">Kota</div>
                </div>
                <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-5 text-center">
                    <div class="text-3xl md:text-4xl font-black text-black"><?php echo e($penghuniAktif ?? '2.5K'); ?>+</div>
                    <div class="text-sm font-bold text-gray-700 mt-1">Penghuni Aktif</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== TENTANG / DESKRIPSI KOS ==================== -->
<section class="section-padding bg-white border-t-4 border-black">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-16">
            <div class="lg:w-1/2" data-aos="fade-right">
                <span class="inline-block px-4 py-1 text-sm font-black bg-pink-400 text-black border-2 border-black shadow-[2px_2px_0px_#000] mb-4">Tentang AyoKos</span>
                <h2 class="text-3xl md:text-4xl font-black text-black mb-6 leading-tight">
                    Platform Pencarian Kos <span class="bg-black text-white px-2">Terlengkap</span> di Indonesia
                </h2>
                <p class="text-gray-800 leading-relaxed mb-4 font-medium">
                    AyoKos hadir untuk memudahkan Anda menemukan hunian sementara yang nyaman, aman, dan sesuai budget. 
                    Dengan lebih dari ratusan pilihan kos di berbagai kota, kami menyediakan informasi lengkap mulai dari 
                    fasilitas, harga, foto, hingga review dari penghuni sebelumnya.
                </p>
                <p class="text-gray-800 leading-relaxed mb-6 font-medium">
                    Setiap properti telah diverifikasi oleh tim kami untuk memastikan keakuratan data dan kenyamanan Anda 
                    selama tinggal. Proses pencarian yang cepat, filter yang lengkap, dan dukungan pelanggan 24/7 
                    menjadikan AyoKos pilihan utama para pencari kos di Indonesia.
                </p>
                <a href="<?php echo e(route('public.kos.index')); ?>" class="inline-flex items-center px-6 py-3 bg-lime-400 hover:bg-lime-500 text-black font-black border-2 border-black shadow-[4px_4px_0px_#000] transition-all duration-200 text-sm uppercase">
                    Jelajahi Kos <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            <div class="lg:w-1/2 grid grid-cols-2 gap-4" data-aos="fade-left">
                <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=400&h=300&fit=crop" alt="Kos modern" class="border-4 border-black shadow-[4px_4px_0px_#000] w-full h-44 object-cover" loading="lazy">
                <img src="https://images.unsplash.com/photo-1560185893-a55cbc8c57e8?w=400&h=300&fit=crop" alt="Kamar kos" class="border-4 border-black shadow-[4px_4px_0px_#000] w-full h-44 object-cover" loading="lazy">
                <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=400&h=300&fit=crop" alt="Ruang tamu" class="border-4 border-black shadow-[4px_4px_0px_#000] w-full h-44 object-cover" loading="lazy">
                <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=400&h=300&fit=crop" alt="Fasilitas kos" class="border-4 border-black shadow-[4px_4px_0px_#000] w-full h-44 object-cover" loading="lazy">
            </div>
        </div>
    </div>
</section>

<!-- ==================== FASILITAS ==================== -->
<section class="section-padding bg-white border-t-4 border-black">
    <div class="container mx-auto px-4">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="inline-block px-4 py-1 text-sm font-black bg-pink-400 text-black border-2 border-black shadow-[2px_2px_0px_#000] mb-3">Fasilitas Unggulan</span>
            <h2 class="text-3xl md:text-4xl font-black text-black mb-4">Fasilitas yang Mendukung <span class="bg-black text-white px-2">Kenyamanan</span> Anda</h2>
            <p class="text-gray-800 max-w-xl mx-auto font-medium">Setiap kos yang terdaftar dilengkapi dengan fasilitas standar hingga premium</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 md:gap-6">
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 text-center transition-transform hover:scale-105" data-aos="zoom-in" data-aos-delay="0">
                <div class="w-14 h-14 bg-black text-white text-2xl flex items-center justify-center mx-auto mb-4 border-2 border-black">
                    <i class="fas fa-wifi"></i>
                </div>
                <h4 class="font-black text-black mb-1">WiFi Cepat</h4>
                <p class="text-xs font-medium text-gray-700">Internet stabil 24 jam</p>
            </div>
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 text-center transition-transform hover:scale-105" data-aos="zoom-in" data-aos-delay="100">
                <div class="w-14 h-14 bg-black text-white text-2xl flex items-center justify-center mx-auto mb-4 border-2 border-black">
                    <i class="fas fa-tshirt"></i>
                </div>
                <h4 class="font-black text-black mb-1">Laundry</h4>
                <p class="text-xs font-medium text-gray-700">Mesin cuci & setrika</p>
            </div>
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 text-center transition-transform hover:scale-105" data-aos="zoom-in" data-aos-delay="200">
                <div class="w-14 h-14 bg-black text-white text-2xl flex items-center justify-center mx-auto mb-4 border-2 border-black">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h4 class="font-black text-black mb-1">Keamanan 24/7</h4>
                <p class="text-xs font-medium text-gray-700">CCTV & satpam</p>
            </div>
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 text-center transition-transform hover:scale-105" data-aos="zoom-in" data-aos-delay="300">
                <div class="w-14 h-14 bg-black text-white text-2xl flex items-center justify-center mx-auto mb-4 border-2 border-black">
                    <i class="fas fa-car"></i>
                </div>
                <h4 class="font-black text-black mb-1">Parkir Luas</h4>
                <p class="text-xs font-medium text-gray-700">Motor & mobil</p>
            </div>
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 text-center transition-transform hover:scale-105" data-aos="zoom-in" data-aos-delay="400">
                <div class="w-14 h-14 bg-black text-white text-2xl flex items-center justify-center mx-auto mb-4 border-2 border-black">
                    <i class="fas fa-snowflake"></i>
                </div>
                <h4 class="font-black text-black mb-1">AC</h4>
                <p class="text-xs font-medium text-gray-700">Kamar sejuk nyaman</p>
            </div>
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 text-center transition-transform hover:scale-105" data-aos="zoom-in" data-aos-delay="500">
                <div class="w-14 h-14 bg-black text-white text-2xl flex items-center justify-center mx-auto mb-4 border-2 border-black">
                    <i class="fas fa-kitchen-set"></i>
                </div>
                <h4 class="font-black text-black mb-1">Dapur Bersama</h4>
                <p class="text-xs font-medium text-gray-700">Peralatan lengkap</p>
            </div>
        </div>
    </div>
</section>

<!-- ==================== KEUNGGULAN / USP ==================== -->
<section class="section-padding bg-white border-t-4 border-black">
    <div class="container mx-auto px-4">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="inline-block px-4 py-1 text-sm font-black bg-pink-400 text-black border-2 border-black shadow-[2px_2px_0px_#000] mb-3">Mengapa AyoKos?</span>
            <h2 class="text-3xl md:text-4xl font-black text-black mb-4">Keunggulan yang Membuat <span class="bg-black text-white px-2">Perbedaan</span></h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center bg-white border-4 border-black shadow-[6px_6px_0px_#000] p-8" data-aos="fade-up" data-aos-delay="0">
                <div class="w-16 h-16 bg-pink-400 text-black text-2xl flex items-center justify-center mx-auto mb-5 border-2 border-black">
                    <i class="fas fa-clipboard-check"></i>
                </div>
                <h3 class="text-xl font-black text-black mb-3">100% Terverifikasi</h3>
                <p class="text-gray-800 text-sm font-medium leading-relaxed">Semua pemilik dan properti telah melalui proses verifikasi ketat untuk menjamin keamanan dan kenyamanan Anda.</p>
            </div>
            <div class="text-center bg-white border-4 border-black shadow-[6px_6px_0px_#000] p-8" data-aos="fade-up" data-aos-delay="150">
                <div class="w-16 h-16 bg-yellow-400 text-black text-2xl flex items-center justify-center mx-auto mb-5 border-2 border-black">
                    <i class="fas fa-tag"></i>
                </div>
                <h3 class="text-xl font-black text-black mb-3">Harga Transparan</h3>
                <p class="text-gray-800 text-sm font-medium leading-relaxed">Informasi biaya lengkap tanpa biaya tersembunyi. Bandingkan harga dengan mudah dan temukan yang terbaik.</p>
            </div>
            <div class="text-center bg-white border-4 border-black shadow-[6px_6px_0px_#000] p-8" data-aos="fade-up" data-aos-delay="300">
                <div class="w-16 h-16 bg-lime-400 text-black text-2xl flex items-center justify-center mx-auto mb-5 border-2 border-black">
                    <i class="fas fa-headset"></i>
                </div>
                <h3 class="text-xl font-black text-black mb-3">Dukungan 24/7</h3>
                <p class="text-gray-800 text-sm font-medium leading-relaxed">Tim kami siap membantu kapan pun melalui live chat, telepon, atau email untuk pertanyaan dan keluhan Anda.</p>
            </div>
        </div>
    </div>
</section>

<!-- ==================== REKOMENDASI KOS (DETAIL) ==================== -->
<section class="section-padding bg-white border-t-4 border-black">
    <div class="container mx-auto px-4">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="inline-block px-4 py-1 text-sm font-black bg-pink-400 text-black border-2 border-black shadow-[2px_2px_0px_#000] mb-3">Rekomendasi</span>
            <h2 class="text-3xl md:text-4xl font-black text-black mb-4">Kos Pilihan <span class="bg-black text-white px-2">Terbaik</span> Untuk Anda</h2>
            <p class="text-gray-800 max-w-xl mx-auto font-medium">Hunian nyaman dengan fasilitas lengkap dan harga bersahabat</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__currentLoopData = $rekomendasiKos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white border-4 border-black shadow-[6px_6px_0px_#000] overflow-hidden transition-transform hover:-translate-y-1" data-aos="fade-up" data-aos-delay="<?php echo e($loop->index * 100); ?>">
                <div class="relative h-52 overflow-hidden border-b-2 border-black">
                    <?php if($kos->foto_utama): ?>
                        <?php
                            $filePath = storage_path('app/public/' . $kos->foto_utama);
                            $fileExists = file_exists($filePath);
                        ?>
                        <?php if($fileExists): ?>
                            <img src="<?php echo e(url('storage/' . $kos->foto_utama)); ?>" alt="<?php echo e($kos->nama_kos); ?>"
                                class="w-full h-full object-cover hover:scale-105 transition duration-500" loading="lazy">
                        <?php else: ?>
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center border-2 border-black">
                                <i class="fas fa-home text-4xl text-gray-400"></i>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center border-2 border-black">
                            <i class="fas fa-home text-4xl text-gray-400"></i>
                        </div>
                    <?php endif; ?>
                    <div class="absolute top-3 left-3">
                        <span class="px-3 py-1 text-xs font-black bg-yellow-400 text-black border-2 border-black">
                            <?php echo e(ucfirst($kos->jenis_kos)); ?>

                        </span>
                    </div>
                    <div class="absolute top-3 right-3">
                        <?php
                            $minHarga = $kos->kamar->min('harga') ?? 0;
                            $hargaText = $minHarga > 1000000 ? 'Rp ' . number_format($minHarga/1000000, 1) . ' Jt' : 'Rp ' . number_format($minHarga, 0, ',', '.');
                        ?>
                        <span class="px-3 py-1 text-xs font-black bg-lime-400 text-black border-2 border-black">
                            <?php echo e($hargaText); ?>

                        </span>
                    </div>
                </div>

                <div class="p-5 flex flex-col flex-grow">
                    <div class="flex items-start justify-between mb-2">
                        <h3 class="text-lg font-black text-black line-clamp-1"><?php echo e($kos->nama_kos); ?></h3>
                        <?php if($kos->reviews->avg('rating')): ?>
                        <div class="flex items-center text-black text-sm ml-2 shrink-0 bg-yellow-400 px-2 py-0.5 border-2 border-black">
                            <i class="fas fa-star mr-1"></i>
                            <span class="font-black"><?php echo e(number_format($kos->reviews->avg('rating'), 1)); ?></span>
                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="flex items-center text-gray-800 text-sm mb-3 font-medium">
                        <i class="fas fa-map-marker-alt mr-2 text-pink-500"></i>
                        <span class="truncate"><?php echo e($kos->alamat); ?></span>
                    </div>

                    <div class="flex flex-wrap gap-1.5 mb-4">
                        <?php $__currentLoopData = $kos->fasilitas->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="px-2.5 py-1 text-xs font-medium bg-gray-100 text-black border-2 border-black">
                            <i class="fas fa-<?php echo e($fas->icon ?? 'check'); ?> mr-1 text-pink-500"></i><?php echo e($fas->nama_fasilitas); ?>

                        </span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if($kos->fasilitas->count() > 4): ?>
                        <span class="px-2.5 py-1 text-xs font-medium bg-gray-100 text-black border-2 border-black">
                            +<?php echo e($kos->fasilitas->count() - 4); ?>

                        </span>
                        <?php endif; ?>
                    </div>

                    <p class="text-sm text-gray-800 mb-4 line-clamp-2 font-medium">
                        <?php echo e($kos->deskripsi ?? 'Kos nyaman dengan lingkungan asri, akses mudah ke transportasi umum, dan fasilitas lengkap.'); ?>

                    </p>

                    <div class="mt-auto">
                        <a href="<?php echo e(route('public.kos.show', $kos->id_kos)); ?>"
                            class="block w-full text-center border-2 border-black bg-lime-400 hover:bg-lime-500 text-black font-black rounded-none px-5 py-2.5 transition-all duration-200 text-sm uppercase shadow-[2px_2px_0px_#000]">
                            Lihat Detail <i class="fas fa-arrow-right ml-1 text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="text-center mt-10" data-aos="fade-up">
            <a href="<?php echo e(route('public.kos.index')); ?>"
                class="inline-flex items-center px-6 py-3 border-2 border-black bg-white hover:bg-gray-100 text-black font-black transition-all duration-200 uppercase shadow-[4px_4px_0px_#000]">
                Lihat Semua Kos <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- ==================== DAFTAR KAMAR & HARGA ==================== -->
<section class="section-padding bg-white border-t-4 border-black">
    <div class="container mx-auto px-4">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="inline-block px-4 py-1 text-sm font-black bg-pink-400 text-black border-2 border-black shadow-[2px_2px_0px_#000] mb-3">Harga</span>
            <h2 class="text-3xl md:text-4xl font-black text-black mb-4">Estimasi <span class="bg-black text-white px-2">Biaya Hunian</span></h2>
            <p class="text-gray-800 max-w-xl mx-auto font-medium">Gambaran harga kos berdasarkan tipe dan fasilitas</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto">
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 text-center" data-aos="flip-left" data-aos-delay="0">
                <div class="w-14 h-14 bg-yellow-400 text-black text-xl flex items-center justify-center mx-auto mb-4 border-2 border-black">
                    <i class="fas fa-star"></i>
                </div>
                <h4 class="font-black text-black mb-2">Standar</h4>
                <div class="text-3xl font-black text-black mb-1">Rp 500K</div>
                <p class="text-sm font-medium text-gray-700 mb-4">per bulan</p>
                <ul class="text-sm font-medium text-gray-800 space-y-2 text-left">
                    <li><i class="fas fa-check text-lime-600 mr-2"></i>Kamar 3x3 m</li>
                    <li><i class="fas fa-check text-lime-600 mr-2"></i>Kamar mandi dalam</li>
                    <li><i class="fas fa-check text-lime-600 mr-2"></i>WiFi dasar</li>
                </ul>
            </div>
            <div class="bg-white border-4 border-yellow-400 shadow-[6px_6px_0px_#000] p-6 text-center relative transform scale-105" data-aos="flip-left" data-aos-delay="150">
                <span class="absolute -top-3 left-1/2 transform -translate-x-1/2 bg-yellow-400 text-black px-4 py-1 border-2 border-black text-xs font-black">Populer</span>
                <div class="w-14 h-14 bg-yellow-400 text-black text-xl flex items-center justify-center mx-auto mb-4 border-2 border-black">
                    <i class="fas fa-crown"></i>
                </div>
                <h4 class="font-black text-black mb-2">Premium</h4>
                <div class="text-3xl font-black text-black mb-1">Rp 1.2 Jt</div>
                <p class="text-sm font-medium text-gray-700 mb-4">per bulan</p>
                <ul class="text-sm font-medium text-gray-800 space-y-2 text-left">
                    <li><i class="fas fa-check text-lime-600 mr-2"></i>Kamar 4x4 m</li>
                    <li><i class="fas fa-check text-lime-600 mr-2"></i>AC & WiFi cepat</li>
                    <li><i class="fas fa-check text-lime-600 mr-2"></i>Laundry gratis</li>
                </ul>
            </div>
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 text-center" data-aos="flip-left" data-aos-delay="300">
                <div class="w-14 h-14 bg-purple-400 text-black text-xl flex items-center justify-center mx-auto mb-4 border-2 border-black">
                    <i class="fas fa-gem"></i>
                </div>
                <h4 class="font-black text-black mb-2">VIP</h4>
                <div class="text-3xl font-black text-black mb-1">Rp 2.5 Jt</div>
                <p class="text-sm font-medium text-gray-700 mb-4">per bulan</p>
                <ul class="text-sm font-medium text-gray-800 space-y-2 text-left">
                    <li><i class="fas fa-check text-lime-600 mr-2"></i>Kamar 5x5 m</li>
                    <li><i class="fas fa-check text-lime-600 mr-2"></i>AC, TV, WiFi</li>
                    <li><i class="fas fa-check text-lime-600 mr-2"></i>Dapur pribadi</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- ==================== TESTIMONI PENGHUNI ==================== -->
<section class="section-padding bg-white border-t-4 border-black">
    <div class="container mx-auto px-4">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="inline-block px-4 py-1 text-sm font-black bg-pink-400 text-black border-2 border-black shadow-[2px_2px_0px_#000] mb-3">Testimoni</span>
            <h2 class="text-3xl md:text-4xl font-black text-black mb-4">Apa Kata <span class="bg-black text-white px-2">Mereka</span>?</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6" data-aos="fade-up" data-aos-delay="0">
                <div class="flex items-center gap-1 text-yellow-400 mb-3">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <p class="text-gray-800 text-sm mb-4 italic font-medium leading-relaxed">"Proses pencarian kos jadi sangat mudah. Filter yang lengkap membantu saya menemukan kos putri dekat kampus dalam hitungan menit. Sangat direkomendasikan!"</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-pink-400 text-black flex items-center justify-center font-black border-2 border-black">RA</div>
                    <div>
                        <div class="font-black text-black text-sm">Rina A.</div>
                        <div class="text-xs font-medium text-gray-700">Mahasiswi ITB</div>
                    </div>
                </div>
            </div>
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6" data-aos="fade-up" data-aos-delay="150">
                <div class="flex items-center gap-1 text-yellow-400 mb-3">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <p class="text-gray-800 text-sm mb-4 italic font-medium leading-relaxed">"Foto dan detail kos sangat jelas. Tidak perlu survey satu per satu. Sangat menghemat waktu dan tenaga. Terima kasih AyoKos!"</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-lime-400 text-black flex items-center justify-center font-black border-2 border-black">AP</div>
                    <div>
                        <div class="font-black text-black text-sm">Andi P.</div>
                        <div class="text-xs font-medium text-gray-700">Pekerja Swasta</div>
                    </div>
                </div>
            </div>
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6" data-aos="fade-up" data-aos-delay="300">
                <div class="flex items-center gap-1 text-yellow-400 mb-3">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <p class="text-gray-800 text-sm mb-4 italic font-medium leading-relaxed">"Pemilik kos responsif dan proses booking cepat. Saya langsung dapat kamar dalam 2 hari. Pelayanan sangat memuaskan!"</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-purple-400 text-black flex items-center justify-center font-black border-2 border-black">SD</div>
                    <div>
                        <div class="font-black text-black text-sm">Sari D.</div>
                        <div class="text-xs font-medium text-gray-700">Karyawan BUMN</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== LOKASI / MAP ==================== -->
<section class="section-padding bg-white border-t-4 border-black">
    <div class="container mx-auto px-4">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="inline-block px-4 py-1 text-sm font-black bg-pink-400 text-black border-2 border-black shadow-[2px_2px_0px_#000] mb-3">Lokasi</span>
            <h2 class="text-3xl md:text-4xl font-black text-black mb-4">Sebaran Kos <span class="bg-black text-white px-2">di Indonesia</span></h2>
            <p class="text-gray-800 max-w-xl mx-auto font-medium">Kami hadir di berbagai kota besar di Indonesia</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-4xl mx-auto" data-aos="fade-up">
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-5 text-center hover:shadow-[6px_6px_0px_#000] transition">
                <i class="fas fa-city text-pink-500 text-2xl mb-2"></i>
                <div class="font-black text-black">Jakarta</div>
                <div class="text-xs font-medium text-gray-700">45+ Kos</div>
            </div>
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-5 text-center hover:shadow-[6px_6px_0px_#000] transition">
                <i class="fas fa-city text-pink-500 text-2xl mb-2"></i>
                <div class="font-black text-black">Bandung</div>
                <div class="text-xs font-medium text-gray-700">60+ Kos</div>
            </div>
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-5 text-center hover:shadow-[6px_6px_0px_#000] transition">
                <i class="fas fa-city text-pink-500 text-2xl mb-2"></i>
                <div class="font-black text-black">Surabaya</div>
                <div class="text-xs font-medium text-gray-700">35+ Kos</div>
            </div>
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-5 text-center hover:shadow-[6px_6px_0px_#000] transition">
                <i class="fas fa-city text-pink-500 text-2xl mb-2"></i>
                <div class="font-black text-black">Malang</div>
                <div class="text-xs font-medium text-gray-700">28+ Kos</div>
            </div>
        </div>

        <div class="text-center mt-8" data-aos="fade-up">
            <a href="<?php echo e(route('public.kos.peta')); ?>" class="inline-flex items-center px-6 py-3 border-2 border-black bg-lime-400 hover:bg-lime-500 text-black font-black transition-all duration-200 uppercase shadow-[4px_4px_0px_#000]">
                <i class="fas fa-map-marked-alt mr-2"></i> Lihat Peta Interaktif
            </a>
        </div>
    </div>
</section>

<!-- ==================== FAQ ==================== -->
<section class="section-padding bg-white border-t-4 border-black">
    <div class="container mx-auto px-4 max-w-3xl">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="inline-block px-4 py-1 text-sm font-black bg-pink-400 text-black border-2 border-black shadow-[2px_2px_0px_#000] mb-3">FAQ</span>
            <h2 class="text-3xl md:text-4xl font-black text-black mb-4">Pertanyaan <span class="bg-black text-white px-2">Umum</span></h2>
        </div>

        <div data-aos="fade-up">
            <div class="faq-item border-2 border-black mb-4">
                <button class="faq-question flex justify-between items-center w-full text-left p-4 bg-white border-b-2 border-black font-black text-black hover:bg-gray-50" onclick="toggleFAQ(this)">
                    <span>Bagaimana cara memesan kos melalui AyoKos?</span>
                    <i class="fas fa-chevron-down faq-icon transition-transform"></i>
                </button>
                <div class="faq-answer hidden p-4 bg-gray-50 font-medium text-gray-800">
                    Anda dapat mencari kos melalui halaman pencarian, melihat detail, lalu menghubungi pemilik kos langsung melalui kontak yang tersedia. Proses pemesanan dilakukan secara langsung antara penghuni dan pemilik.
                </div>
            </div>
            <div class="faq-item border-2 border-black mb-4">
                <button class="faq-question flex justify-between items-center w-full text-left p-4 bg-white border-b-2 border-black font-black text-black hover:bg-gray-50" onclick="toggleFAQ(this)">
                    <span>Apakah data kos yang ditampilkan akurat?</span>
                    <i class="fas fa-chevron-down faq-icon transition-transform"></i>
                </button>
                <div class="faq-answer hidden p-4 bg-gray-50 font-medium text-gray-800">
                    Ya, semua kos telah diverifikasi oleh tim kami. Namun kami tetap menyarankan untuk melakukan survey langsung sebelum memutuskan untuk menyewa.
                </div>
            </div>
            <div class="faq-item border-2 border-black mb-4">
                <button class="faq-question flex justify-between items-center w-full text-left p-4 bg-white border-b-2 border-black font-black text-black hover:bg-gray-50" onclick="toggleFAQ(this)">
                    <span>Berapa biaya layanan AyoKos?</span>
                    <i class="fas fa-chevron-down faq-icon transition-transform"></i>
                </button>
                <div class="faq-answer hidden p-4 bg-gray-50 font-medium text-gray-800">
                    AyoKos tidak memungut biaya apapun dari pencari kos. Layanan kami 100% gratis untuk penghuni.
                </div>
            </div>
            <div class="faq-item border-2 border-black mb-4">
                <button class="faq-question flex justify-between items-center w-full text-left p-4 bg-white border-b-2 border-black font-black text-black hover:bg-gray-50" onclick="toggleFAQ(this)">
                    <span>Bagaimana jika ada masalah dengan kos yang disewa?</span>
                    <i class="fas fa-chevron-down faq-icon transition-transform"></i>
                </button>
                <div class="faq-answer hidden p-4 bg-gray-50 font-medium text-gray-800">
                    Anda dapat menghubungi tim dukungan kami 24/7 melalui email atau telepon yang tertera di halaman kontak. Kami akan membantu memediasi masalah Anda.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== CTA FINAL ==================== -->
<section class="section-padding bg-black text-white border-t-4 border-yellow-400">
    <div class="container mx-auto px-4 text-center" data-aos="fade-up">
        <h2 class="text-3xl md:text-5xl font-black mb-4 text-yellow-400">Siap Tinggal di Kos Impian?</h2>
        <p class="text-lg text-gray-300 mb-8 max-w-xl mx-auto font-medium">Daftar sekarang dan dapatkan rekomendasi kos terbaik sesuai preferensimu. Gratis!</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?php echo e(route('public.kos.index')); ?>" class="px-8 py-4 bg-yellow-400 hover:bg-yellow-500 text-black font-black border-2 border-yellow-400 shadow-[4px_4px_0px_#fff] transition text-lg uppercase">
                <i class="fas fa-search mr-2"></i> Cari Kos Sekarang
            </a>
            <?php if(auth()->guard()->guest()): ?>
            <a href="<?php echo e(route('register')); ?>" class="px-8 py-4 bg-white text-black font-black border-2 border-white shadow-[4px_4px_0px_#fff] hover:bg-gray-200 transition text-lg uppercase">
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
        const answer = item.querySelector('.faq-answer');
        const icon = btn.querySelector('.faq-icon');
        const isOpen = !answer.classList.contains('hidden');
        
        // Tutup semua
        document.querySelectorAll('.faq-answer').forEach(el => el.classList.add('hidden'));
        document.querySelectorAll('.faq-icon').forEach(el => el.classList.remove('fa-chevron-up'));
        document.querySelectorAll('.faq-icon').forEach(el => el.classList.add('fa-chevron-down'));
        
        // Buka yang diklik jika sebelumnya tidak aktif
        if (!isOpen) {
            answer.classList.remove('hidden');
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-up');
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views\public\home.blade.php ENDPATH**/ ?>