<?php $__env->startSection('title', 'Ulasan Kos Saya - AyoKos'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto p-4 md:p-6 lg:p-8 space-y-6">
    <!-- Alerts -->
    <?php if(session('success')): ?>
        <div class="bg-emerald-400 border-2 border-black shadow-[3px_3px_0px_#000] p-6 mb-6">
            <div class="flex items-start space-x-4">
                <div class="p-2 bg-emerald-400 border-2 border-black">
                    <i class="fas fa-check-circle text-black"></i>
                </div>
                <div>
                    <h3 class="text-black font-black">Berhasil!</h3>
                    <p class="text-black text-sm mt-1"><?php echo e(session('success')); ?></p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="bg-red-400 border-2 border-black shadow-[3px_3px_0px_#000] p-6 mb-6">
            <div class="flex items-start space-x-4">
                <div class="p-2 bg-red-400 border-2 border-black">
                    <i class="fas fa-exclamation-circle text-black"></i>
                </div>
                <div>
                    <h3 class="text-black font-black">Gagal!</h3>
                    <p class="text-black text-sm mt-1"><?php echo e(session('error')); ?></p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Breadcrumb -->
    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="<?php echo e(route('pemilik.dashboard')); ?>" class="inline-flex items-center text-sm font-bold text-gray-600 hover:text-black transition-colors">
                        <i class="fas fa-home mr-2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="inline-flex items-center">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                        <a href="<?php echo e(route('pemilik.reviews.index')); ?>" class="inline-flex items-center text-sm font-bold text-black">
                            <i class="fas fa-star mr-2"></i>
                            Kelola Reviews
                        </a>
                    </div>
                </li>
            </ol>
        </nav>
    </div>   
    
    <!-- Header Section -->
    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>

                <h1 class="text-2xl md:text-3xl font-black text-black mb-2 flex items-center">
                    <i class="fas fa-star mr-3"></i>
                    Ulasan untuk Kos Saya
                </h1>
                <p class="text-gray-700">Semua ulasan yang diberikan penghuni untuk kos yang Anda miliki</p>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-lime-400 border-2 border-black">
                    <i class="fas fa-comment-alt text-black text-xl"></i>
                </div>
                <span class="text-sm font-black px-2 py-1 bg-black text-white border-2 border-black">
                    Total
                </span>
            </div>
            <h3 class="text-2xl font-black text-black mb-1"><?php echo e($reviews->total()); ?></h3>
            <p class="text-sm text-gray-600">Total Ulasan</p>
        </div>

        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-yellow-400 border-2 border-black">
                    <i class="fas fa-star text-black text-xl"></i>
                </div>
                <span class="text-sm font-black px-2 py-1 bg-black text-white border-2 border-black">
                    Rata-rata
                </span>
            </div>
             <h3 class="text-2xl font-black text-black mb-1"><?php echo e(number_format($overall_avg_rating ?? 0, 1)); ?></h3>
            <p class="text-sm text-gray-600">Rating Rata-rata</p>
        </div>

        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-pink-400 border-2 border-black">
                    <i class="fas fa-calendar-alt text-black text-xl"></i>
                </div>
                <span class="text-sm font-black px-2 py-1 bg-black text-white border-2 border-black">
                    Terbaru
                </span>
            </div>
             <h3 class="text-2xl font-black text-black mb-1">
                 <?php echo e($latest_review ? $latest_review->created_at->format('d M Y') : '-'); ?>

             </h3>
            <p class="text-sm text-gray-600">Terakhir Diterima</p>
        </div>
    </div>

    <!-- Reviews List -->
    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] overflow-hidden">
        <?php if($reviews->count() > 0): ?>
            <div class="divide-y-2 divide-gray-200">
                <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="p-6 hover:bg-yellow-100 transition-all duration-300">
                    <div class="flex flex-col lg:flex-row lg:items-start gap-6">
                        <!-- Left Content -->
                        <div class="flex-1">
                            <div class="flex items-start space-x-4">
                                <!-- Kos Image -->
                                <div class="flex-shrink-0">
                                    <?php if($review->kos && $review->kos->foto_utama): ?>
                                        <?php
                                        $filePath = storage_path('app/public/' . $review->kos->foto_utama);
                                        $fileExists = file_exists($filePath);
                                        ?>
                                        <?php if($fileExists): ?>
                                            <img src="<?php echo e(url('storage/' . $review->kos->foto_utama)); ?>" 
                                                 alt="<?php echo e($review->kos->nama_kos); ?>" 
                                                 class="w-20 h-20 object-cover border-2 border-black">
                                        <?php else: ?>
                                            <div class="w-20 h-20 bg-gray-200 border-2 border-black flex items-center justify-center">
                                                <i class="fas fa-home text-2xl text-gray-500"></i>
                                            </div>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <div class="w-20 h-20 bg-gray-200 border-2 border-black flex items-center justify-center">
                                            <i class="fas fa-home text-2xl text-gray-500"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Review Content -->
                                <div class="flex-1">
                                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2 mb-3">
                                        <div>
                                            <h3 class="font-black text-black text-lg hover:text-black transition cursor-pointer">
                                                <?php echo e(optional($review->kos)->nama_kos ?? '—'); ?>

                                            </h3>
                                            <div class="flex items-center text-sm text-gray-600 mt-1">
                                                <i class="fas fa-map-marker-alt mr-2 text-sky-600"></i>
                                                <?php echo e(optional($review->kos)->alamat ?? '-'); ?>, <?php echo e(optional($review->kos)->kota ?? '-'); ?>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Rating -->
                                    <div class="flex items-center flex-wrap gap-3 mb-3">
                                        <div class="flex text-yellow-500">
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                <?php if($i <= $review->rating): ?>
                                                    <i class="fas fa-star text-sm"></i>
                                                <?php else: ?>
                                                    <i class="far fa-star text-sm"></i>
                                                <?php endif; ?>
                                            <?php endfor; ?>
                                        </div>
                                        <span class="text-sm font-bold text-black"><?php echo e($review->rating); ?>/5</span>
                                        <span class="text-gray-500">•</span>
                                        <span class="text-sm text-gray-500"><?php echo e($review->created_at->format('d M Y H:i')); ?></span>
                                    </div>

                                    <!-- Comment -->
                                    <p class="text-black mt-3 bg-gray-100 p-4 border-2 border-black">
                                        <i class="fas fa-quote-left text-sky-400 mr-2"></i>
                                        <?php echo e($review->komentar); ?>

                                    </p>

                                    <!-- Review Image -->
                                    <?php if($review->foto_review): ?>
                                    <div class="mt-4">
                                        <img src="<?php echo e(asset('storage/' . $review->foto_review)); ?>" 
                                             alt="Foto review" 
                                             class="w-24 h-24 object-cover border-2 border-black hover:border-yellow-400 cursor-pointer transition-all duration-300 hover:scale-105"
                                             onclick="openImage('<?php echo e(asset('storage/' . $review->foto_review)); ?>')">
                                        <p class="text-xs text-gray-500 mt-1">Klik untuk memperbesar</p>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Right Actions -->
                        <div class="lg:w-48 flex flex-col space-y-3">
                            <a href="<?php echo e(route('pemilik.kos.show', optional($review->kos)->id_kos)); ?>" 
                               class="flex items-center justify-center space-x-2 px-4 py-2.5 bg-sky-400 hover:bg-sky-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all duration-300 uppercase tracking-wide text-sm">
                                <i class="fas fa-eye"></i>
                                <span>Lihat Kos</span>
                            </a>
                            
                            <div class="bg-gray-100 border-2 border-black p-3">
                                <div class="flex items-center space-x-2">
                                    <?php if($review->penghuni && $review->penghuni->foto_profil): ?>
                                        <?php
                                        $filePath = storage_path('app/public/' . $review->penghuni->foto_profil);
                                        $fileExists = file_exists($filePath);
                                        ?>
                                        <?php if($fileExists): ?>
                                            <img src="<?php echo e(url('storage/' . $review->penghuni->foto_profil)); ?>" 
                                                 alt="<?php echo e($review->penghuni->nama); ?>" 
                                                 class="w-8 h-8 object-cover border-2 border-emerald-400">
                                        <?php else: ?>
                                            <div class="w-8 h-8 bg-emerald-400 border-2 border-black flex items-center justify-center">
                                                <span class="text-black font-black text-xs"><?php echo e(strtoupper(substr($review->penghuni->nama, 0, 1))); ?></span>
                                            </div>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <div class="w-8 h-8 bg-emerald-400 border-2 border-black flex items-center justify-center">
                                            <i class="fas fa-user text-black text-xs"></i>
                                        </div>
                                    <?php endif; ?>
                                    <div>
                                        <p class="text-xs text-gray-500">Penghuni</p>
                                        <p class="text-sm font-bold text-black"><?php echo e(optional($review->penghuni)->nama ?? 'Penghuni'); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Table Footer -->
            <?php if($reviews->hasPages()): ?>
                <div class="px-6 py-4 border-t-2 border-black">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-700">
                            Menampilkan <?php echo e($reviews->firstItem()); ?> - <?php echo e($reviews->lastItem()); ?> dari <?php echo e($reviews->total()); ?> ulasan
                        </div>
                        <div class="flex space-x-2">
                            <?php echo e($reviews->links('vendor.pagination.custom-dark')); ?>

                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php else: ?>
        <!-- Empty State -->
        <div class="text-center py-16">
            <div class="w-24 h-24 bg-gray-200 border-2 border-black shadow-[2px_2px_0px_#000] flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-comment-slash text-4xl text-gray-700"></i>
            </div>
            <h3 class="text-xl font-black text-gray-700 mb-2">Belum Ada Ulasan</h3>
            <p class="text-gray-600 max-w-md mx-auto mb-6">
                Belum ada ulasan untuk kos Anda. Ulasan akan muncul di sini setelah penghuni memberikan rating.
            </p>
            <a href="<?php echo e(route('pemilik.kos.index')); ?>" 
               class="inline-flex items-center space-x-2 px-6 py-3 bg-white text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all duration-300">
                <i class="fas fa-home"></i>
                <span>Kelola Kos Anda</span>
            </a>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Image Modal -->
<div id="image-modal" class="fixed inset-0 bg-black/90 z-50 hidden items-center justify-center p-4">
    <div class="relative max-w-4xl max-h-full">
        <button onclick="closeImage()" 
                class="absolute -top-12 right-0 text-white text-2xl hover:text-gray-300 transition">
            <i class="fas fa-times"></i>
        </button>
        <img id="modal-image" class="max-w-full max-h-[80vh] border-4 border-black shadow-[4px_4px_0px_#000]">
        <div class="text-center text-white text-sm mt-4 opacity-75">
            Klik di luar gambar untuk menutup
        </div>
    </div>
</div>

<script>
    function openImage(src) {
        document.getElementById('modal-image').src = src;
        document.getElementById('image-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    
    function closeImage() {
        document.getElementById('image-modal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
    
    // Close modal when clicking outside
    document.getElementById('image-modal').addEventListener('click', function(e) {
        if (e.target.id === 'image-modal') closeImage();
    });
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) { 
        if (e.key === 'Escape') closeImage(); 
    });
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/pemilik/reviews/index.blade.php ENDPATH**/ ?>