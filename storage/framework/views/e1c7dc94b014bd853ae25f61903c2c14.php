<?php $__env->startSection('title', $kos->nama_kos . ' - AyoKos'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-yellow-50 py-8 md:py-12 min-h-screen">
    <div class="container mx-auto px-4 space-y-6">
        <!-- Breadcrumb -->
        <nav class="bg-white border-2 border-black shadow-[2px_2px_0px_#000] px-4 py-3" data-aos="fade-down">
            <ol class="inline-flex items-center space-x-1 md:space-x-3 text-sm font-bold">
                <li class="inline-flex items-center">
                    <a href="<?php echo e(route('public.home')); ?>" class="text-gray-600 hover:text-black transition">
                        <i class="fas fa-home mr-1"></i> Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right mx-2 text-gray-400 text-xs"></i>
                        <a href="<?php echo e(route('public.kos.index')); ?>" class="text-gray-600 hover:text-black transition">
                            Kos
                        </a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right mx-2 text-gray-400 text-xs"></i>
                        <span class="text-black font-black truncate max-w-xs"><?php echo e($kos->nama_kos); ?></span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Gallery -->
                <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] overflow-hidden" data-aos="fade-up">
                    <?php if($kos->foto_utama): ?>
                        <img src="<?php echo e(asset('storage/' . $kos->foto_utama)); ?>" 
                             alt="<?php echo e($kos->nama_kos); ?>" 
                             class="w-full h-64 md:h-80 object-cover hover:scale-105 transition-transform duration-700">
                    <?php else: ?>
                        <div class="w-full h-64 md:h-80 bg-gray-200 flex items-center justify-center border-b-2 border-black">
                            <i class="fas fa-home text-6xl text-gray-400"></i>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Basic Info -->
                <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-6">
                        <div class="flex-1">
                            <h1 class="text-2xl md:text-3xl font-black text-black mb-2"><?php echo e($kos->nama_kos); ?></h1>
                            <div class="flex items-start text-gray-700 font-bold mb-4">
                                <i class="fas fa-map-marker-alt text-pink-500 mr-2 mt-0.5 flex-shrink-0"></i>
                                <span class="leading-relaxed"><?php echo e($kos->alamat); ?>, <?php echo e($kos->kecamatan); ?>, <?php echo e($kos->kota); ?></span>
                            </div>
                            
                            <?php if($kos->reviews->count() > 0): ?>
                            <div class="flex items-center">
                                <div class="flex items-center">
                                    <div class="flex text-yellow-500 mr-2">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <?php if($i <= floor($averageRating)): ?>
                                                <i class="fas fa-star"></i>
                                            <?php elseif($i - 0.5 <= $averageRating): ?>
                                                <i class="fas fa-star-half-alt"></i>
                                            <?php else: ?>
                                                <i class="far fa-star"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </div>
                                    <span class="text-lg font-black text-black mr-2"><?php echo e(number_format($averageRating, 1)); ?></span>
                                </div>
                                <span class="text-gray-600 font-bold">(<?php echo e($totalReviews); ?> ulasan)</span>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3">
                            <div class="flex flex-wrap gap-2">
                                <span class="px-3 py-1 text-xs font-black bg-yellow-400 text-black border-2 border-black shadow-[1px_1px_0px_#000] capitalize">
                                    <?php echo e($kos->jenis_kos); ?>

                                </span>
                                <span class="px-3 py-1 text-xs font-black bg-lime-400 text-black border-2 border-black shadow-[1px_1px_0px_#000]">
                                    <?php echo e($kos->kamar->count()); ?> Kamar
                                </span>
                            </div>
                            <button onclick="shareKos()" 
                                    class="px-3 py-1.5 text-xs font-black bg-white text-black border-2 border-black shadow-[1px_1px_0px_#000] hover:shadow-[2px_2px_0px_#000] transition-all flex items-center">
                                <i class="fas fa-share-alt mr-1"></i> Bagikan
                            </button>
                        </div>
                    </div>
                    
                    <!-- Pemilik Info -->
                    <?php if($kos->pemilik): ?>
                    <div class="border-t-2 border-gray-200 pt-4">
                        <div class="flex items-center space-x-4">
                            <?php if($kos->pemilik->foto_profil): ?>
                                <?php
                                    $filePath = storage_path('app/public/' . $kos->pemilik->foto_profil);
                                    $fileExists = file_exists($filePath);
                                ?>
                                <?php if($fileExists): ?>
                                    <img src="<?php echo e(url('storage/' . $kos->pemilik->foto_profil)); ?>" 
                                         alt="<?php echo e($kos->pemilik->nama); ?>" 
                                         class="w-12 h-12 object-cover border-2 border-black">
                                <?php else: ?>
                                    <div class="w-12 h-12 bg-pink-400 border-2 border-black flex items-center justify-center">
                                        <span class="text-white font-black text-lg"><?php echo e(strtoupper(substr($kos->pemilik->nama, 0, 1))); ?></span>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="w-12 h-12 bg-gray-200 border-2 border-black flex items-center justify-center">
                                    <i class="fas fa-user-tie text-gray-500 text-lg"></i>
                                </div>
                            <?php endif; ?>
                            <div class="flex-1">
                                <h3 class="font-black text-black text-lg">Pemilik Kos</h3>
                                <p class="text-sm font-bold text-pink-600"><?php echo e($kos->pemilik->nama); ?></p>
                                <p class="text-xs font-bold text-gray-500 mt-1">Terverifikasi • <?php echo e($kos->created_at->format('Y')); ?></p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-emerald-500 border-2 border-black"></div>
                                <span class="text-xs font-black text-emerald-600">Aktif</span>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Description -->
                <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6" data-aos="fade-up" data-aos-delay="150">
                    <h2 class="text-xl font-black text-black mb-4 flex items-center">
                        <i class="fas fa-file-alt text-pink-500 mr-3"></i> Deskripsi Kos
                    </h2>
                    <div class="text-gray-700 font-medium leading-relaxed whitespace-pre-line">
                        <?php echo e($kos->deskripsi); ?>

                    </div>
                </div>

                <!-- Facilities -->
                <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6" data-aos="fade-up" data-aos-delay="200">
                    <h2 class="text-xl font-black text-black mb-6 flex items-center">
                        <i class="fas fa-th-large text-pink-500 mr-3"></i> Fasilitas
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <?php $__currentLoopData = $kos->fasilitas->groupBy('kategori'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori => $fasilitasList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div>
                            <h3 class="font-black text-black mb-4 capitalize text-lg border-b-2 border-black pb-2">
                                <?php echo e(str_replace('_', ' ', $kategori)); ?>

                            </h3>
                            <div class="space-y-3">
                                <?php $__currentLoopData = $fasilitasList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fasilitas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-gray-100 border-2 border-black flex items-center justify-center text-pink-500">
                                        <?php switch($fasilitas->kategori):
                                            case ('umum'): ?> <i class="fas fa-wifi"></i> <?php break; ?>
                                            <?php case ('kamar_mandi'): ?> <i class="fas fa-shower"></i> <?php break; ?>
                                            <?php case ('dapur'): ?> <i class="fas fa-utensils"></i> <?php break; ?>
                                            <?php case ('parkir'): ?> <i class="fas fa-parking"></i> <?php break; ?>
                                            <?php case ('keamanan'): ?> <i class="fas fa-shield-alt"></i> <?php break; ?>
                                            <?php default: ?> <i class="fas fa-check"></i>
                                        <?php endswitch; ?>
                                    </div>
                                    <span class="text-gray-700 font-bold"><?php echo e($fasilitas->nama_fasilitas); ?></span>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <!-- Available Rooms -->
                <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6" data-aos="fade-up" data-aos-delay="250">
                    <h2 class="text-xl font-black text-black mb-6 flex items-center">
                        <i class="fas fa-door-open text-pink-500 mr-3"></i> Kamar Tersedia
                    </h2>
                    <div class="space-y-6">
                        <?php $__empty_1 = true; $__currentLoopData = $kos->kamar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kamar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="bg-white border-2 border-black p-6" data-aos="fade-up" data-aos-delay="<?php echo e($loop->index * 100); ?>">
                            <div class="flex flex-col lg:flex-row gap-6">
                                <div class="flex-1">
                                    <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-4">
                                        <div>
                                            <h3 class="text-xl font-black text-black">Kamar <?php echo e($kamar->nomor_kamar); ?></h3>
                                            <div class="flex items-center space-x-3 mt-2">
                                                <span class="text-sm font-bold text-gray-700 bg-gray-100 border-2 border-black px-3 py-1"><?php echo e($kamar->tipe_kamar); ?></span>
                                                <span class="text-sm font-bold text-gray-700 bg-gray-100 border-2 border-black px-3 py-1"><?php echo e($kamar->luas_kamar); ?></span>
                                                <span class="text-sm font-bold text-gray-700 bg-gray-100 border-2 border-black px-3 py-1"><?php echo e($kamar->kapasitas); ?> orang</span>
                                            </div>
                                        </div>
                                        <span class="px-3 py-1 text-xs font-black bg-lime-400 text-black border-2 border-black">Tersedia</span>
                                    </div>
                                    
                                    <?php
                                        $fasilitasKamar = $kamar->fasilitas_kamar;
                                        $maxAttempts = 3;
                                        $attempts = 0;
                                        while (is_string($fasilitasKamar) && $attempts < $maxAttempts) {
                                            $decoded = json_decode($fasilitasKamar, true);
                                            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                                $fasilitasKamar = $decoded;
                                            } else {
                                                break;
                                            }
                                            $attempts++;
                                        }
                                        if (is_string($fasilitasKamar)) {
                                            $fasilitasKamar = [$fasilitasKamar];
                                        }
                                        $fasilitasKamar = is_array($fasilitasKamar) ? $fasilitasKamar : [];
                                        $fasilitasKamar = array_filter($fasilitasKamar);
                                    ?>

                                    <?php if(count($fasilitasKamar) > 0): ?>
                                    <div class="mb-4">
                                        <h4 class="font-black text-pink-600 mb-3">Fasilitas Kamar:</h4>
                                        <div class="flex flex-wrap gap-2">
                                            <?php $__currentLoopData = $fasilitasKamar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fasilitas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(is_string($fasilitas)): ?>
                                                <span class="px-3 py-1 text-xs font-bold bg-gray-100 text-black border-2 border-black">
                                                    <i class="fas fa-check-circle mr-1 text-pink-500"></i> <?php echo e($fasilitas); ?>

                                                </span>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="lg:text-right lg:border-l-2 lg:border-gray-200 lg:pl-6 lg:min-w-48">
                                    <div class="mb-4">
                                        <p class="text-3xl font-black text-black mb-1">
                                            Rp <?php echo e(number_format($kamar->harga, 0, ',', '.')); ?>

                                        </p>
                                        <p class="text-sm font-bold text-gray-600">per 
                                            <?php if($kos->tipe_sewa == 'harian'): ?> hari
                                            <?php elseif($kos->tipe_sewa == 'mingguan'): ?> minggu
                                            <?php elseif($kos->tipe_sewa == 'bulanan'): ?> bulan
                                            <?php elseif($kos->tipe_sewa == 'tahunan'): ?> tahun
                                            <?php else: ?> bulan
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                    <?php if(auth()->guard()->check()): ?>
                                        <?php
                                            $user = auth()->user();
                                            $isAllowed = true;
                                            if ($kos->jenis_kos == 'putra' && $user->penghuni->jenis_kelamin != 'L') $isAllowed = false;
                                            if ($kos->jenis_kos == 'putri' && $user->penghuni->jenis_kelamin != 'P') $isAllowed = false;
                                        ?>
                                        <?php if($user->role === 'penghuni' && $isAllowed): ?>
                                        <a href="<?php echo e(route('penghuni.kontrak.create', $kos->id_kos)); ?>" 
                                           class="w-full lg:w-auto px-6 py-3 bg-lime-400 hover:bg-lime-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] hover:translate-y-[-1px] transition-all inline-block uppercase tracking-wide text-sm">
                                            <i class="fas fa-check mr-2"></i> Pilih Kamar Ini
                                        </a>
                                        <?php elseif($user->role === 'penghuni'): ?>
                                        <button disabled 
                                                class="w-full lg:w-auto px-6 py-3 bg-red-100 text-red-600 border-2 border-black font-black inline-block cursor-not-allowed text-sm">
                                            <i class="fas fa-ban mr-2"></i> Khusus <?php echo e(ucfirst($kos->jenis_kos)); ?>

                                        </button>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('login')); ?>" 
                                           class="w-full lg:w-auto px-6 py-3 bg-black text-white font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] hover:translate-y-[-1px] transition-all inline-block uppercase tracking-wide text-sm">
                                            <i class="fas fa-sign-in-alt mr-2"></i> Login untuk Pesan
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="text-center py-12" data-aos="fade-up">
                            <div class="w-20 h-20 bg-gray-200 border-2 border-black flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-door-closed text-3xl text-gray-400"></i>
                            </div>
                            <h3 class="text-xl font-black text-black mt-4">Tidak Ada Kamar Tersedia</h3>
                            <p class="text-gray-600 font-bold mt-2">Semua kamar sudah terisi untuk saat ini.</p>
                            <a href="<?php echo e(route('public.kos.index')); ?>" 
                               class="inline-block mt-6 px-6 py-3 bg-black text-white font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all uppercase tracking-wide text-sm">
                                <i class="fas fa-search mr-2"></i> Cari Kos Lainnya
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Rules -->
                <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6" data-aos="fade-up" data-aos-delay="300">
                    <h2 class="text-xl font-black text-black mb-6 flex items-center">
                        <i class="fas fa-clipboard-list text-pink-500 mr-3"></i> Peraturan Kos
                    </h2>
                    <div class="bg-gray-100 border-2 border-black p-5">
                        <pre class="whitespace-pre-wrap font-sans text-gray-700 font-medium text-sm leading-relaxed"><?php echo e($kos->peraturan); ?></pre>
                    </div>
                </div>

                <!-- Reviews -->
                <?php if($kos->reviews->count() > 0): ?>
                <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6" data-aos="fade-up" data-aos-delay="350">
                    <h2 class="text-xl font-black text-black mb-6 flex items-center">
                        <i class="fas fa-comments text-pink-500 mr-3"></i> Ulasan Penghuni
                    </h2>
                    
                    <div class="bg-gray-100 border-2 border-black p-6 mb-8">
                        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                            <div class="text-center md:text-left">
                                <div class="text-5xl font-black text-black mb-2"><?php echo e(number_format($averageRating, 1)); ?></div>
                                <div class="flex justify-center md:justify-start text-yellow-500 text-xl mb-3">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <?php if($i <= floor($averageRating)): ?>
                                            <i class="fas fa-star"></i>
                                        <?php elseif($i - 0.5 <= $averageRating): ?>
                                            <i class="fas fa-star-half-alt"></i>
                                        <?php else: ?>
                                            <i class="far fa-star"></i>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </div>
                                <div class="text-gray-600 font-bold">Berdasarkan <?php echo e($totalReviews); ?> ulasan</div>
                            </div>
                            <div class="w-full md:w-64">
                                <?php for($rating = 5; $rating >= 1; $rating--): ?>
                                <?php
                                    $count = $kos->reviews->where('rating', $rating)->count();
                                    $percentage = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
                                ?>
                                <div class="flex items-center mb-3">
                                    <span class="text-sm font-bold text-gray-600 w-8"><?php echo e($rating); ?> <i class="fas fa-star text-yellow-500"></i></span>
                                    <div class="flex-1 bg-white border-2 border-black h-3 mx-3">
                                        <div class="bg-yellow-500 h-full" style="width: <?php echo e($percentage); ?>%"></div>
                                    </div>
                                    <span class="text-sm font-bold text-gray-600 w-8 text-right"><?php echo e($count); ?></span>
                                </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <?php $__currentLoopData = $kos->reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="border-b-2 border-gray-200 pb-6 last:border-b-0">
                            <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-4">
                                <div class="flex items-center space-x-4">
                                    <?php if($review->penghuni->foto_profil): ?>
                                        <?php
                                            $filePath = storage_path('app/public/' . $review->penghuni->foto_profil);
                                            $fileExists = file_exists($filePath);
                                        ?>
                                        <?php if($fileExists): ?>
                                            <img src="<?php echo e(url('storage/' . $review->penghuni->foto_profil)); ?>" 
                                                 alt="<?php echo e($review->penghuni->nama); ?>" 
                                                 class="w-12 h-12 object-cover border-2 border-black">
                                        <?php else: ?>
                                            <div class="w-12 h-12 bg-gray-200 border-2 border-black flex items-center justify-center text-black font-black text-lg">
                                                <?php echo e(strtoupper(substr($review->penghuni->nama, 0, 1))); ?>

                                            </div>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <div class="w-12 h-12 bg-gray-200 border-2 border-black flex items-center justify-center text-black font-black text-lg">
                                            <?php echo e(strtoupper(substr($review->penghuni->nama, 0, 1))); ?>

                                        </div>
                                    <?php endif; ?>
                                    <div>
                                        <h4 class="font-black text-black"><?php echo e($review->penghuni->nama); ?></h4>
                                        <p class="text-sm font-bold text-gray-500">
                                            <?php echo e($review->created_at->format('d M Y')); ?>

                                            <?php if($review->updated_at->gt($review->created_at)): ?>
                                            <span class="text-xs text-gray-400 ml-1">(diedit)</span>
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="flex text-yellow-500">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <?php if($i <= $review->rating): ?>
                                                <i class="fas fa-star"></i>
                                            <?php else: ?>
                                                <i class="far fa-star"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </div>
                                    
                                    <?php if(auth()->guard()->check()): ?>
                                        <?php $authPenghuni = auth()->user()->penghuni; ?>
                                        <?php if(auth()->user()->role === 'penghuni' && $authPenghuni && $authPenghuni->id_penghuni == $review->id_penghuni): ?>
                                        <div class="relative review-action-btn">
                                            <button type="button" class="text-gray-500 hover:text-black px-2 py-1 border-2 border-transparent hover:border-black transition">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="absolute right-0 mt-2 w-40 bg-white border-2 border-black shadow-[3px_3px_0px_#000] hidden z-10">
                                                <a href="<?php echo e(route('penghuni.reviews.edit', $review->id_review)); ?>" 
                                                   class="flex items-center px-4 py-3 text-sm font-bold text-gray-700 hover:bg-yellow-100 transition">
                                                    <i class="fas fa-edit mr-3 text-pink-500"></i> Edit
                                                </a>
                                                <button type="button"
                                                    data-ajax-action="/api/penghuni/reviews/<?php echo e($review->id_review); ?>"
                                                    data-ajax-method="DELETE"
                                                    data-confirm="Apakah Anda yakin ingin menghapus review ini?"
                                                    data-success-msg="Review berhasil dihapus"
                                                    data-redirect="<?php echo e(route('penghuni.reviews.history')); ?>"
                                                    class="flex items-center w-full text-left px-4 py-3 text-sm font-bold text-red-500 hover:bg-red-50 transition">
                                                    <i class="fas fa-trash mr-3"></i> Hapus
                                                </button>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <p class="text-gray-700 font-medium leading-relaxed whitespace-pre-line"><?php echo e($review->komentar); ?></p>
                            
                            <?php if($review->foto_review): ?>
                            <div class="mt-4">
                                <img src="<?php echo e(asset('storage/' . $review->foto_review)); ?>" 
                                     alt="Foto review" 
                                     class="w-40 h-40 object-cover border-2 border-black cursor-pointer hover:shadow-[3px_3px_0px_#000] transition-shadow"
                                     onclick="openImageModal('<?php echo e(asset('storage/' . $review->foto_review)); ?>')">
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php else: ?>
                <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 text-center" data-aos="fade-up" data-aos-delay="350">
                    <div class="w-20 h-20 bg-yellow-100 border-2 border-black flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-comment text-3xl text-yellow-600"></i>
                    </div>
                    <h3 class="text-xl font-black text-black">Belum Ada Ulasan</h3>
                    <p class="text-gray-600 font-bold mt-2">Jadilah yang pertama memberikan ulasan untuk kos ini.</p>
                     
                     <?php if(auth()->guard()->check()): ?>
                         <?php if(auth()->user()->role === 'penghuni'): ?>
                         <?php
                             $penghuni = auth()->user()->penghuni;
                             $canReview = false;
                             $hasReviewed = false;
                             if ($penghuni) {
                                 $kontrak = \App\Models\KontrakSewa::where('id_penghuni', $penghuni->id_penghuni)
                                     ->where('id_kos', $kos->id_kos)
                                     ->whereIn('status_kontrak', ['aktif', 'selesai'])
                                     ->first();
                                 if ($kontrak) {
                                     $canReview = true;
                                     $existingReview = \App\Models\Review::where('id_penghuni', $penghuni->id_penghuni)
                                         ->where('id_kos', $kos->id_kos)
                                         ->first();
                                     if ($existingReview) $hasReviewed = true;
                                 }
                             }
                         ?>
                         
                         <?php if($canReview && !$hasReviewed): ?>
                         <div class="mt-6">
                             <a href="<?php echo e(route('penghuni.reviews.create', $kos->id_kos)); ?>" 
                                class="inline-flex items-center px-6 py-3 bg-yellow-400 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all uppercase tracking-wide text-sm">
                                 <i class="fas fa-star mr-2"></i> Beri Review Pertama
                             </a>
                         </div>
                         <?php elseif($hasReviewed): ?>
                         <p class="text-emerald-600 font-black mt-6">✅ Anda sudah memberikan review untuk kos ini.</p>
                         <?php endif; ?>
                         <?php endif; ?>
                     <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Action Card -->
                <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6" data-aos="fade-left" data-aos-delay="0">
                    <h2 class="text-xl font-black text-black mb-6 flex items-center">
                        <i class="fas fa-calendar-check text-pink-500 mr-3"></i> Informasi Booking
                    </h2>
                    
                    <?php if($kos->kamar->min('harga') > 0): ?>
                        <div class="mb-6">
                            <h3 class="font-black text-pink-600 mb-1">Harga Mulai Dari</h3>
                            <p class="text-4xl font-black text-black">Rp <?php echo e(number_format($kos->kamar->min('harga'), 0, ',', '.')); ?></p>
                            <p class="text-sm font-bold text-gray-600 mt-1">per <?php echo e($kos->tipe_sewa ?? 'bulan'); ?></p>
                        </div>
                    <?php else: ?>
                        <p class="text-lg font-black text-red-600 bg-red-100 border-2 border-black px-3 py-2 mb-6">Penuh</p>
                    <?php endif; ?>

                    <div class="space-y-3 mb-6 text-sm border-t-2 border-gray-200 pt-4">
                        <div class="flex justify-between"><span class="font-bold text-gray-600">Jenis Kos:</span><span class="font-black text-black capitalize"><?php echo e($kos->jenis_kos); ?></span></div>
                        <div class="flex justify-between"><span class="font-bold text-gray-600">Tipe Sewa:</span><span class="font-black text-black capitalize"><?php echo e($kos->tipe_sewa); ?></span></div>
                        <div class="flex justify-between"><span class="font-bold text-gray-600">Kamar Tersedia:</span><span class="font-black text-black"><?php echo e($kos->kamar->count()); ?> kamar</span></div>
                        <div class="flex justify-between"><span class="font-bold text-gray-600">Lokasi:</span><span class="font-black text-black text-right"><?php echo e($kos->kota); ?>, <?php echo e($kos->provinsi); ?></span></div>
                    </div>

                    <?php if(auth()->guard()->check()): ?>
                        <?php if(auth()->user()->role === 'penghuni'): ?>
                        <?php
                            $user = auth()->user();
                            $isAllowed = true;
                            if ($kos->jenis_kos == 'putra' && $user->penghuni->jenis_kelamin != 'L') $isAllowed = false;
                            if ($kos->jenis_kos == 'putri' && $user->penghuni->jenis_kelamin != 'P') $isAllowed = false;
                        ?>
                        <?php if($kos->kamar->count() > 0): ?>
                            <?php if($isAllowed): ?>
                            <a href="<?php echo e(route('penghuni.kontrak.create', $kos->id_kos)); ?>" 
                               class="block w-full px-6 py-3 bg-lime-400 hover:bg-lime-500 text-black font-black border-2 border-black shadow-[3px_3px_0px_#000] hover:shadow-[4px_4px_0px_#000] hover:translate-y-[-1px] transition-all text-center uppercase tracking-wide text-sm">
                                <i class="fas fa-home mr-2"></i> Daftar Sekarang
                            </a>
                            <?php else: ?>
                            <button disabled class="block w-full px-6 py-3 bg-red-100 text-red-600 border-2 border-black font-black cursor-not-allowed text-center text-sm">
                                <i class="fas fa-ban mr-2"></i> Khusus <?php echo e(ucfirst($kos->jenis_kos)); ?>

                            </button>
                            <?php endif; ?>
                        <?php else: ?>
                        <button disabled class="block w-full px-6 py-3 bg-gray-100 text-gray-500 border-2 border-black font-black cursor-not-allowed text-center text-sm">
                            <i class="fas fa-times mr-2"></i> Penuh
                        </button>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="text-center border-t-2 border-gray-200 pt-4">
                            <p class="text-gray-600 font-bold mb-4">Login untuk mendaftar</p>
                            <div class="space-y-3">
                                <a href="<?php echo e(route('login')); ?>" class="block w-full px-6 py-3 bg-black text-white font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all uppercase tracking-wide text-sm">Login</a>
                                <a href="<?php echo e(route('register')); ?>" class="block w-full px-6 py-3 bg-yellow-400 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all uppercase tracking-wide text-sm">Daftar Akun Baru</a>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php endif; ?>

                    <!-- Review Section for Sidebar -->
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(auth()->user()->role === 'penghuni'): ?>
                        <?php
                            $penghuni = auth()->user()->penghuni;
                            $canReview = false;
                            $hasReviewed = false;
                            if ($penghuni) {
                                $kontrak = \App\Models\KontrakSewa::where('id_penghuni', $penghuni->id_penghuni)
                                    ->where('id_kos', $kos->id_kos)
                                    ->whereIn('status_kontrak', ['aktif', 'selesai'])
                                    ->first();
                                if ($kontrak) {
                                    $canReview = true;
                                    $existingReview = \App\Models\Review::where('id_penghuni', $penghuni->id_penghuni)
                                        ->where('id_kos', $kos->id_kos)
                                        ->first();
                                    if ($existingReview) $hasReviewed = true;
                                }
                            }
                        ?>
                        <?php if($canReview && !$hasReviewed): ?>
                        <div class="mt-6 pt-6 border-t-2 border-gray-200">
                            <a href="<?php echo e(route('penghuni.reviews.create', $kos->id_kos)); ?>" 
                               class="block w-full px-6 py-3 bg-yellow-400 hover:bg-yellow-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all text-center uppercase tracking-wide text-sm">
                                <i class="fas fa-star mr-2"></i> Beri Review
                            </a>
                        </div>
                        <?php elseif($hasReviewed): ?>
                        <div class="mt-6 pt-6 border-t-2 border-gray-200">
                            <p class="text-sm font-bold text-gray-600 mb-3">Review Anda:</p>
                            <a href="<?php echo e(route('penghuni.reviews.edit', $existingReview->id_review)); ?>" 
                               class="block w-full px-6 py-3 bg-lime-400 hover:bg-lime-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all text-center uppercase tracking-wide text-sm">
                                <i class="fas fa-edit mr-2"></i> Edit Review
                            </a>
                        </div>
                        <?php endif; ?>
                        <?php endif; ?>
                     <?php endif; ?>

                     <!-- Contact -->
                    <?php if($kos->pemilik): ?>
                    <div class="mt-6 pt-6 border-t-2 border-gray-200">
                        <h3 class="font-black text-black mb-3 flex items-center"><i class="fas fa-headset text-pink-500 mr-2"></i>Butuh Bantuan?</h3>
                        <div class="space-y-3">
                            <?php
                                $waNumber = $kos->pemilik->no_hp;
                                if (str_starts_with($waNumber, '0')) $waNumber = '62' . substr($waNumber, 1);
                                elseif (str_starts_with($waNumber, '+')) $waNumber = substr($waNumber, 1);
                            ?>
                            <a href="https://wa.me/<?php echo e($waNumber); ?>?text=Halo%20<?php echo e(urlencode($kos->pemilik->nama)); ?>,%20saya%20tertarik%20dengan%20kos%20<?php echo e(urlencode($kos->nama_kos)); ?>" 
                               target="_blank"
                               class="flex items-center justify-center px-4 py-3 bg-lime-400 hover:bg-lime-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all uppercase tracking-wide text-sm">
                                <i class="fab fa-whatsapp mr-2"></i> WhatsApp
                            </a>
                            <button onclick="showContactModal()" class="w-full px-4 py-3 bg-white text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all uppercase tracking-wide text-sm">
                                <i class="fas fa-phone mr-2"></i> Kontak Pemilik
                            </button>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Location Card -->
                <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6" data-aos="fade-left" data-aos-delay="100">
                    <h2 class="text-xl font-black text-black mb-4 flex items-center">
                        <i class="fas fa-map-marker-alt text-pink-500 mr-3"></i> Lokasi
                    </h2>
                    <div class="space-y-3 text-sm">
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-location-dot text-pink-500 mt-1"></i>
                            <div>
                                <p class="font-black text-black"><?php echo e($kos->alamat); ?></p>
                                <p class="font-bold text-gray-600"><?php echo e($kos->kecamatan); ?>, <?php echo e($kos->kota); ?> - <?php echo e($kos->kode_pos); ?></p>
                            </div>
                        </div>
                        <?php if($kos->latitude && $kos->longitude): ?>
                        <div id="map" class="h-64 z-0 mt-4 border-2 border-black"></div>
                        <div class="flex justify-between mt-3">
                            <button id="locate-btn" class="text-pink-600 hover:text-black font-black text-sm flex items-center">
                                <i class="fas fa-location-crosshairs mr-1"></i> Lokasi Saya
                            </button>
                            <a href="https://www.google.com/maps/dir/?api=1&destination=<?php echo e($kos->latitude); ?>,<?php echo e($kos->longitude); ?>" target="_blank" class="text-emerald-600 hover:text-black font-black text-sm flex items-center">
                                <i class="fas fa-directions mr-1"></i> Petunjuk Arah
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Similar Kos -->
                <?php if($similarKos->count() > 0): ?>
                <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6" data-aos="fade-left" data-aos-delay="200">
                    <h2 class="text-xl font-black text-black mb-4 flex items-center">
                        <i class="fas fa-building text-pink-500 mr-3"></i> Kos Serupa
                    </h2>
                    <div class="space-y-4">
                        <?php $__currentLoopData = $similarKos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $similar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('public.kos.show', $similar->id_kos)); ?>" class="block bg-white border-2 border-black p-4 hover:shadow-[3px_3px_0px_#000] transition-shadow">
                            <div class="flex space-x-4">
                                <?php if($similar->foto_utama): ?>
                                    <img src="<?php echo e(asset('storage/' . $similar->foto_utama)); ?>" alt="<?php echo e($similar->nama_kos); ?>" class="w-16 h-16 object-cover border-2 border-black flex-shrink-0">
                                <?php else: ?>
                                    <div class="w-16 h-16 bg-gray-200 border-2 border-black flex items-center justify-center text-gray-400"><i class="fas fa-home"></i></div>
                                <?php endif; ?>
                                <div class="min-w-0">
                                    <h4 class="font-black text-black text-sm truncate"><?php echo e($similar->nama_kos); ?></h4>
                                    <p class="text-black font-black text-sm mt-1">
                                        <?php if($similar->kamar->count() > 0): ?>
                                            Rp <?php echo e(number_format($similar->kamar->min('harga'), 0, ',', '.')); ?>

                                        <?php else: ?>
                                            <span class="text-red-500">Penuh</span>
                                        <?php endif; ?>
                                    </p>
                                    <div class="flex items-center mt-1 gap-2 text-xs font-bold text-gray-600">
                                        <span class="capitalize"><?php echo e($similar->jenis_kos); ?></span>
                                        <span>•</span>
                                        <span><?php echo e($similar->kota); ?></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div id="image-modal" class="fixed inset-0 bg-black/70 z-50 hidden items-center justify-center p-4">
    <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white text-2xl bg-black border-2 border-white w-10 h-10 flex items-center justify-center hover:bg-yellow-400 hover:text-black transition">
        <i class="fas fa-times"></i>
    </button>
    <img id="modal-image" class="max-w-full max-h-[90vh] border-4 border-black shadow-[8px_8px_0px_#000]">
</div>

<?php if($kos->pemilik): ?>
<!-- Contact Owner Modal -->
<div id="contactModal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4">
    <div class="fixed inset-0 bg-black/70" data-modal-close></div>
    <div class="relative bg-white border-4 border-black shadow-[8px_8px_0px_#000] w-full max-w-sm">
        <div class="border-b-4 border-black p-5">
            <h5 class="text-lg font-black text-black flex items-center">
                <i class="fas fa-headset text-pink-500 mr-2"></i> Hubungi Pemilik
            </h5>
        </div>
        <div class="p-6 text-center">
            <div class="mb-4">
                <?php if($kos->pemilik->foto_profil): ?>
                    <img src="<?php echo e(url('storage/' . $kos->pemilik->foto_profil)); ?>" alt="<?php echo e($kos->pemilik->nama); ?>" class="w-20 h-20 object-cover border-4 border-black mx-auto">
                <?php else: ?>
                    <div class="w-20 h-20 bg-yellow-400 border-4 border-black flex items-center justify-center mx-auto">
                        <i class="fas fa-user-tie text-black text-3xl"></i>
                    </div>
                <?php endif; ?>
            </div>
            <h5 class="text-xl font-black text-black"><?php echo e($kos->pemilik->nama); ?></h5>
            <p class="text-gray-600 font-bold text-sm mb-4">Pemilik <?php echo e($kos->nama_kos); ?></p>
            <div class="bg-gray-100 border-2 border-black p-4 mb-4">
                <p class="text-xs font-black text-gray-500 uppercase mb-1">Nomor Telepon</p>
                <p class="text-2xl font-black text-black"><?php echo e($kos->pemilik->no_hp); ?></p>
            </div>
            <div class="grid grid-cols-1 gap-3">
                <a href="tel:<?php echo e($kos->pemilik->no_hp); ?>" class="flex items-center justify-center px-6 py-3 bg-black text-white font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all uppercase tracking-wide text-sm">
                    <i class="fas fa-phone-alt mr-2"></i> Telepon Sekarang
                </a>
                <?php
                    $waNumber = $kos->pemilik->no_hp;
                    if (str_starts_with($waNumber, '0')) $waNumber = '62' . substr($waNumber, 1);
                    elseif (str_starts_with($waNumber, '+')) $waNumber = substr($waNumber, 1);
                ?>
                <a href="https://wa.me/<?php echo e($waNumber); ?>?text=Halo%20<?php echo e(urlencode($kos->pemilik->nama)); ?>,%20saya%20ingin%20bertanya%20tentang%20kos%20<?php echo e(urlencode($kos->nama_kos)); ?>" target="_blank"
                   class="flex items-center justify-center px-6 py-3 bg-lime-400 hover:bg-lime-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all uppercase tracking-wide text-sm">
                    <i class="fab fa-whatsapp mr-2"></i> WhatsApp
                </a>
            </div>
        </div>
        <div class="p-4 bg-gray-100 text-center border-t-2 border-black">
            <button type="button" class="modal-close-btn text-gray-600 hover:text-black font-black text-sm">Kembali</button>
        </div>
    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<!-- Leaflet via CDN (agar peta tetap berfungsi meski bundle app.js gagal dimuat di hosting) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
<script>
    function openImageModal(src) {
        document.getElementById('modal-image').src = src;
        document.getElementById('image-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeImageModal() {
        document.getElementById('image-modal').classList.add('hidden');
        document.body.style.overflow = '';
    }
    document.getElementById('image-modal').addEventListener('click', function(e) {
        if (e.target.id === 'image-modal') closeImageModal();
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeImageModal();
    });

    function shareKos() {
        const url = window.location.href;
        if (navigator.share) {
            navigator.share({
                title: '<?php echo e($kos->nama_kos); ?>',
                text: 'Lihat kos ini: <?php echo e($kos->nama_kos); ?> - <?php echo e($kos->alamat); ?>, <?php echo e($kos->kota); ?>',
                url: url
            }).catch(() => copyToClipboard(url));
        } else {
            copyToClipboard(url);
        }
    }
    function copyToClipboard(text) {
        const textarea = document.createElement('textarea');
        textarea.value = text;
        document.body.appendChild(textarea);
        textarea.select();
        try {
            document.execCommand('copy');
            alert('Link berhasil disalin!');
        } catch (err) {
            prompt('Salin link ini:', text);
        }
        document.body.removeChild(textarea);
    }

    document.addEventListener('DOMContentLoaded', function() {
        <?php if($kos->latitude && $kos->longitude): ?>
        const map = L.map('map').setView([<?php echo e($kos->latitude); ?>, <?php echo e($kos->longitude); ?>], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        const houseIcon = L.divIcon({
            html: `<div class="relative"><div class="absolute -inset-1 bg-gray-100 animate-ping"></div><div class="relative bg-pink-600 w-10 h-10 flex items-center justify-center shadow-lg border-2 border-black"><i class="fas fa-home text-white text-sm"></i></div></div>`,
            iconSize: [40, 40],
            iconAnchor: [20, 40],
            popupAnchor: [0, -40]
        });
        const marker = L.marker([<?php echo e($kos->latitude); ?>, <?php echo e($kos->longitude); ?>], { icon: houseIcon }).addTo(map);
        marker.bindPopup(`<b><?php echo e($kos->nama_kos); ?></b><br><?php echo e($kos->alamat); ?>`);

        document.getElementById('locate-btn').addEventListener('click', function() {
            if (navigator.geolocation) {
                this.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Mencari...';
                navigator.geolocation.getCurrentPosition(function(position) {
                    const userLat = position.coords.latitude;
                    const userLng = position.coords.longitude;
                    if (window.userMarker) map.removeLayer(window.userMarker);
                    const userIcon = L.divIcon({
                        html: `<div class="relative"><div class="absolute -inset-1 bg-gray-100 animate-ping"></div><div class="relative bg-black w-8 h-8 flex items-center justify-center shadow-lg border-2 border-white"><i class="fas fa-location-dot text-white text-xs"></i></div></div>`,
                        iconSize: [32, 32],
                        iconAnchor: [16, 32]
                    });
                    window.userMarker = L.marker([userLat, userLng], { icon: userIcon }).addTo(map).bindPopup('Lokasi Anda').openPopup();
                    const bounds = L.latLngBounds([[userLat, userLng], [<?php echo e($kos->latitude); ?>, <?php echo e($kos->longitude); ?>]]);
                    map.fitBounds(bounds, { padding: [50, 50] });
                    document.getElementById('locate-btn').innerHTML = '<i class="fas fa-location-crosshairs mr-1"></i> Lokasi Saya';
                }, function() {
                    alert('Tidak dapat mengakses lokasi. Periksa izin.');
                    document.getElementById('locate-btn').innerHTML = '<i class="fas fa-location-crosshairs mr-1"></i> Lokasi Saya';
                });
            } else {
                alert('Geolokasi tidak didukung.');
            }
        });
        <?php endif; ?>

        <?php if($kos->pemilik): ?>
        const contactModal = new Modal('contactModal');
        window.showContactModal = () => contactModal.show();
        <?php endif; ?>

        document.querySelectorAll('.review-action-btn').forEach(btn => {
            const button = btn.querySelector('button');
            const menu = btn.querySelector('.absolute');
            if (!button || !menu) return;
            button.addEventListener('mouseenter', () => menu.classList.remove('hidden'));
            btn.addEventListener('mouseleave', () => setTimeout(() => { if (!menu.matches(':hover')) menu.classList.add('hidden'); }, 100));
            menu.addEventListener('mouseenter', () => menu.classList.remove('hidden'));
            menu.addEventListener('mouseleave', () => menu.classList.add('hidden'));
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', ['hideFooter' => true], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views\public\kos\show.blade.php ENDPATH**/ ?>