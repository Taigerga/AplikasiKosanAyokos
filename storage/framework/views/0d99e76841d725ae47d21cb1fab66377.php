<?php $__env->startSection('title', 'History Review - AyoKos'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-4 md:p-6 lg:p-8 max-w-7xl mx-auto space-y-6">
    <!-- Breadcrumb -->
    <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-xl p-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="<?php echo e(route('penghuni.dashboard')); ?>" class="inline-flex items-center text-sm font-medium text-white/60 hover:text-white transition-colors">
                        <i class="fas fa-gauge mr-2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="inline-flex items-center">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-white/40 text-xs mx-2"></i>
                        <a href="<?php echo e(route('penghuni.reviews.history')); ?>" class="inline-flex items-center text-sm font-medium text-white">
                            <i class="fas fa-star mr-2"></i>
                            Riwayat Review
                        </a>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Page Header -->
    <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-white mb-2">
                    <i class="fas fa-star mr-3"></i>
                    History Review
                </h1>
                <p class="text-white/60">Review yang telah Anda berikan untuk kos-kos</p>
            </div>
            <div class="flex space-x-3">
                <a href="<?php echo e(route('public.kos.index')); ?>"
                   class="px-4 py-2 bg-blue-500/20 backdrop-blur-sm border border-blue-500/20 text-white rounded-xl hover:bg-blue-500/30 transition flex items-center">
                    <i class="fas fa-search mr-2"></i>
                    Cari Kos
                </a>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    <?php if(session('success')): ?>
    <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-300 px-4 py-3 rounded-xl flex items-center justify-between backdrop-blur-sm" role="alert">
        <div class="flex items-center">
            <div class="w-8 h-8 bg-white/5 backdrop-blur-sm rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-check text-white"></i>
            </div>
            <div>
                <span class="font-medium">Berhasil!</span>
                <span class="block text-sm text-emerald-300/80"><?php echo e(session('success')); ?></span>
            </div>
        </div>
        <button type="button" class="text-emerald-400 hover:text-emerald-300" onclick="this.parentElement.style.display='none'">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
    <div class="bg-red-500/10 border border-red-500/20 text-red-300 px-4 py-3 rounded-xl flex items-center justify-between backdrop-blur-sm" role="alert">
        <div class="flex items-center">
            <div class="w-8 h-8 bg-white/5 backdrop-blur-sm rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-times text-white"></i>
            </div>
            <div>
                <span class="font-medium">Error!</span>
                <span class="block text-sm text-red-300/80"><?php echo e(session('error')); ?></span>
            </div>
        </div>
        <button type="button" class="text-red-400 hover:text-red-300" onclick="this.parentElement.style.display='none'">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <?php endif; ?>

    <?php if(session('warning')): ?>
    <div class="bg-yellow-500/10 border border-yellow-500/20 text-yellow-300 px-4 py-3 rounded-xl flex items-center justify-between backdrop-blur-sm" role="alert">
        <div class="flex items-center">
            <div class="w-8 h-8 bg-white/5 backdrop-blur-sm rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-exclamation-triangle text-white"></i>
            </div>
            <div>
                <span class="font-medium">Perhatian!</span>
                <span class="block text-sm text-yellow-300/80"><?php echo e(session('warning')); ?></span>
            </div>
        </div>
        <button type="button" class="text-yellow-400 hover:text-yellow-300" onclick="this.parentElement.style.display='none'">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <?php endif; ?>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-xl p-5">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 rounded-lg bg-white/5 backdrop-blur-sm">
                    <i class="fas fa-star text-white text-xl"></i>
                </div>
                <span class="text-sm font-medium px-2 py-1 rounded-full bg-blue-50 text-blue-600">
                    <?php echo e($reviews->total()); ?>

                </span>
            </div>
            <h3 class="text-2xl font-bold text-white mb-1"><?php echo e($reviews->total()); ?></h3>
            <p class="text-sm text-white/60">Total Review</p>
        </div>

        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-xl p-5">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 rounded-lg bg-white/5 backdrop-blur-sm">
                    <i class="fas fa-chart-line text-white text-xl"></i>
                </div>
                <span class="text-sm font-medium px-2 py-1 rounded-full bg-yellow-50 text-yellow-600">
                    Rata-rata
                </span>
            </div>
            <h3 class="text-2xl font-bold text-white mb-1">
                <?php echo e(number_format($reviews->avg('rating') ?? 0, 1)); ?>

            </h3>
            <p class="text-sm text-white/60">Rating Rata-rata</p>
        </div>

        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-xl p-5">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 rounded-lg bg-white/5 backdrop-blur-sm">
                    <i class="fas fa-calendar-alt text-white text-xl"></i>
                </div>
                <span class="text-sm font-medium px-2 py-1 rounded-full bg-emerald-50 text-emerald-600">
                    Terbaru
                </span>
            </div>
            <h3 class="text-2xl font-bold text-white mb-1">
                <?php echo e($reviews->first() ? $reviews->first()->updated_at->format('d M') : '-'); ?>

            </h3>
            <p class="text-sm text-white/60">Terakhir Diupdate</p>
        </div>
    </div>

    <!-- Reviews List -->
    <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl overflow-hidden">
        <?php if($reviews->count() > 0): ?>
            <div class="divide-y divide-white/20">
                <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="p-6 hover:bg-white/5 transition-all duration-300">
                    <div class="flex flex-col lg:flex-row lg:items-start gap-6">
                        <!-- Kos Image -->
                        <div class="w-full lg:w-48 flex-shrink-0">
                            <div class="relative h-48 lg:h-full rounded-xl overflow-hidden">
                                <?php if($review->kos && $review->kos->foto_utama): ?>
                                    <img src="<?php echo e(asset('storage/' . $review->kos->foto_utama)); ?>"
                                        alt="<?php echo e($review->kos->nama_kos); ?>"
                                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-300 cursor-pointer"
                                        onclick="openImage('<?php echo e(asset('storage/' . $review->kos->foto_utama)); ?>')">
                                <?php else: ?>
                                    <div class="w-full h-full bg-white/5 backdrop-blur-sm flex items-center justify-center">
                                        <i class="fas fa-home text-4xl text-white/40"></i>
                                    </div>
                                <?php endif; ?>

                                <!-- Rating Badge -->
                                <div class="absolute top-3 left-3">
                                    <span class="px-2 py-1 text-xs font-medium rounded-lg bg-yellow-50 text-yellow-600">
                                        <?php echo e($review->rating); ?>/5
                                    </span>
                                </div>

                                <!-- Kos Type Badge -->
                                <div class="absolute bottom-3 left-3">
                                    <span class="px-2 py-1 text-xs font-medium rounded-lg bg-emerald-50 text-emerald-600">
                                        <?php echo e($review->kos->jenis_kos); ?>

                                    </span>
                                </div>
                            </div>

                            <!-- Review Photo -->
                            <?php if($review->foto_review): ?>
                            <div class="mt-3">
                                <img src="<?php echo e(asset('storage/' . $review->foto_review)); ?>"
                                    alt="Foto review"
                                    class="w-full h-24 object-cover rounded-lg cursor-pointer hover:scale-105 transition-transform duration-300"
                                    onclick="openImage('<?php echo e(asset('storage/' . $review->foto_review)); ?>')">
                                <p class="text-xs text-white/60 mt-1 text-center">Foto Review</p>
                            </div>
                            <?php endif; ?>
                        </div>

                        <!-- Review Content -->
                        <div class="flex-1">
                            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 mb-4">
                                <div>
                                    <div class="flex items-center space-x-3 mb-2">
                                        <?php if(auth()->guard('penghuni')->check()): ?>
                                            <?php $penghuniUser = auth('penghuni')->user(); ?>
                                            <?php if($penghuniUser && $penghuniUser->penghuni && $penghuniUser->penghuni->foto_profil): ?>
                                                <?php
                                                    $filePath = storage_path('app/public/' . $penghuniUser->penghuni->foto_profil);
                                                    $fileExists = file_exists($filePath);
                                                ?>
                                                <?php if($fileExists): ?>
                                                    <img src="<?php echo e(asset('storage/' . $penghuniUser->penghuni->foto_profil)); ?>"
                                                         alt="<?php echo e($penghuniUser->penghuni->nama ?? $penghuniUser->nama); ?>"
                                                         class="w-10 h-10 rounded-full object-cover border-2 border-emerald-400">
                                                <?php else: ?>
                                                    <div class="w-10 h-10 bg-white/5 backdrop-blur-sm rounded-full flex items-center justify-center">
                                                        <span class="text-white font-medium text-sm"><?php echo e(strtoupper(substr($penghuniUser->penghuni->nama ?? $penghuniUser->nama, 0, 1))); ?></span>
                                                    </div>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <div class="w-10 h-10 bg-white/5 backdrop-blur-sm rounded-full flex items-center justify-center">
                                                    <i class="fas fa-user text-white text-sm"></i>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <div>
                                            <h3 class="text-xl font-semibold text-white mb-1"><?php echo e($review->kos->nama_kos); ?></h3>
                                            <p class="text-sm text-emerald-400">Review oleh <?php echo e(($penghuniUser->penghuni->nama ?? $penghuniUser->nama) ?? 'User'); ?></p>
                                        </div>
                                    </div>
                                    <div class="flex items-center text-white/60 text-sm mb-2">
                                        <i class="fas fa-map-marker-alt mr-2 text-emerald-400"></i>
                                        <span><?php echo e($review->kos->alamat); ?>, <?php echo e($review->kos->kota); ?></span>
                                    </div>
                                </div>

                                <!-- Date Info -->
                                <div class="flex flex-col text-sm text-white/60">
                                    <div class="flex items-center">
                                        <i class="fas fa-calendar-alt mr-2 text-emerald-400"></i>
                                        <span>Dibuat: <?php echo e($review->created_at->format('d M Y')); ?></span>
                                    </div>
                                    <?php if($review->updated_at != $review->created_at): ?>
                                    <div class="flex items-center mt-1">
                                        <i class="fas fa-edit mr-2 text-yellow-400"></i>
                                        <span>Diedit: <?php echo e($review->updated_at->format('d M Y')); ?></span>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Stars Rating -->
                            <div class="flex items-center mb-4">
                                <div class="flex text-yellow-400 mr-3">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <?php if($i <= $review->rating): ?>
                                            <i class="fas fa-star"></i>
                                        <?php else: ?>
                                            <i class="far fa-star"></i>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </div>
                                <span class="text-white font-medium"><?php echo e($review->rating); ?>.0</span>
                            </div>

                            <!-- Comment -->
                            <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-xl p-4 mb-4">
                                <div class="flex items-start">
                                    <i class="fas fa-comment text-emerald-400 mr-3 mt-1"></i>
                                    <p class="text-white/80"><?php echo e($review->komentar); ?></p>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-wrap gap-3">
                                <a href="<?php echo e(route('public.kos.show', $review->kos->id_kos)); ?>"
                                   class="px-4 py-2 bg-blue-500/20 backdrop-blur-sm border border-blue-500/20 text-white rounded-xl hover:bg-blue-500/30 transition flex items-center">
                                    <i class="fas fa-eye mr-2"></i>
                                    Lihat Kos
                                </a>

                                <a href="<?php echo e(route('penghuni.reviews.edit', $review->id_review)); ?>"
                                   class="px-4 py-2 bg-yellow-500/20 backdrop-blur-sm border border-yellow-500/20 text-white rounded-xl hover:bg-yellow-500/30 transition flex items-center">
                                    <i class="fas fa-edit mr-2"></i>
                                    Edit Review
                                </a>

                                <button type="button"
                                        onclick="showDeleteModal(<?php echo e($review->id_review); ?>)"
                                        class="px-4 py-2 bg-red-500/20 backdrop-blur-sm border border-red-500/20 text-white rounded-xl hover:bg-red-500/30 transition flex items-center">
                                    <i class="fas fa-trash mr-2"></i>
                                    Hapus Review
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-white/20">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-white/60">
                        Menampilkan <?php echo e($reviews->firstItem()); ?> - <?php echo e($reviews->lastItem()); ?> dari <?php echo e($reviews->total()); ?> review
                    </div>
                    <div class="flex space-x-2">
                        <?php echo e($reviews->links('vendor.pagination.custom-dark')); ?>

                    </div>
                </div>
            </div>
        <?php else: ?>
        <!-- Empty State -->
        <div class="text-center py-12">
            <div class="w-20 h-20 bg-white/5 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-star text-white text-3xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-white mt-4">Belum Ada Review</h3>
            <p class="text-white/60 mt-2 max-w-md mx-auto">
                Anda belum memberikan review untuk kos manapun. Berikan pengalaman Anda untuk membantu penghuni lain.
            </p>
            <div class="mt-6">
                <a href="<?php echo e(route('public.kos.index')); ?>"
                   class="inline-flex items-center px-6 py-3 bg-emerald-500/20 backdrop-blur-sm border border-emerald-500/20 text-white rounded-xl hover:bg-emerald-500/30 transition">
                    <i class="fas fa-search mr-2"></i>
                    Cari Kos untuk Direview
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Image Modal -->
<div id="image-modal" class="fixed inset-0 bg-black/90 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
    <div class="relative max-w-4xl max-h-full">
        <button onclick="closeImage()"
                class="absolute -top-12 right-0 text-white text-2xl hover:text-white/60 transition">
            <div class="w-10 h-10 bg-white/5 backdrop-blur-sm rounded-full flex items-center justify-center">
                <i class="fas fa-times"></i>
            </div>
        </button>
        <img id="modal-image" class="max-w-full max-h-[90vh] rounded-2xl shadow-2xl">
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

    document.getElementById('image-modal').addEventListener('click', function(e) {
        if (e.target.id === 'image-modal') {
            closeImage();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeImage();
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('[role="alert"]');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.opacity = '0';
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 300);
            }, 5000);
        });
    });
</script>

<!-- Delete Confirmation Modal -->
<div id="delete-modal" class="fixed inset-0 bg-black/90 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
    <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl max-w-md w-full p-6 relative">
        <button onclick="closeDeleteModal()"
                class="absolute top-4 right-4 text-white/60 hover:text-white transition">
            <i class="fas fa-times text-xl"></i>
        </button>

        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-red-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-exclamation-triangle text-red-400 text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-white mb-2">Konfirmasi Hapus</h3>
            <p class="text-white/60">Apakah Anda yakin ingin menghapus review ini? Tindakan ini tidak dapat dibatalkan.</p>
        </div>

        <form id="delete-form" action="" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>

            <div class="flex gap-3">
                <button type="button"
                        onclick="closeDeleteModal()"
                        class="flex-1 px-4 py-2 bg-white/5 backdrop-blur-sm border border-white/20 text-white rounded-xl hover:bg-white/10 transition">
                    Batal
                </button>
                <button type="submit"
                        class="flex-1 px-4 py-2 bg-red-500/20 backdrop-blur-sm border border-red-500/20 text-white rounded-xl hover:bg-red-500/30 transition">
                    <i class="fas fa-trash mr-2"></i>
                    Hapus
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function showDeleteModal(reviewId) {
        const modal = document.getElementById('delete-modal');
        const form = document.getElementById('delete-form');
        form.action = `/penghuni/reviews/${reviewId}`;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeDeleteModal() {
        const modal = document.getElementById('delete-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto';
    }

    document.getElementById('delete-modal').addEventListener('click', function(e) {
        if (e.target.id === 'delete-modal') {
            closeDeleteModal();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDeleteModal();
            closeImage();
        }
    });
</script>

<style>
    #image-modal img {
        scrollbar-width: thin;
        scrollbar-color: #475569 transparent;
    }

    #image-modal img::-webkit-scrollbar {
        width: 8px;
    }

    #image-modal img::-webkit-scrollbar-track {
        background: transparent;
    }

    #image-modal img::-webkit-scrollbar-thumb {
        background: #475569;
        border-radius: 4px;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/penghuni/reviews/history.blade.php ENDPATH**/ ?>