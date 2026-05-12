<?php $__env->startSection('title', 'Riwayat Kontrak - AyoKos'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-4 md:p-6 lg:p-8 space-y-6 max-w-7xl mx-auto">
    <!-- Breadcrumb -->
    <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-xl p-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="<?php echo e(route('penghuni.dashboard')); ?>" class="inline-flex items-center text-sm font-medium text-slate-400 hover:text-white transition-colors">
                        <i class="fas fa-gauge mr-2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="inline-flex items-center">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-slate-500 text-xs mx-2"></i>
                        <a href="<?php echo e(route('penghuni.kontrak.index')); ?>" class="inline-flex items-center text-sm font-medium text-white">
                            <i class="fas fa-file-contract mr-2"></i>
                            Riwayat Kontrak
                        </a>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Header Section -->
    <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-white mb-2">
                <i class="fas fa-file-contract mr-3"></i>
                    Riwayat Kontrak Saya</h1>
                <p class="text-slate-100">Kelola dan pantau semua kontrak kos Anda</p>
            </div>
            <a href="<?php echo e(route('public.kos.index')); ?>" 
            class="mt-4 md:mt-0 px-6 py-3 bg-sky-500/20 backdrop-blur-sm border border-sky-500/20 hover:bg-sky-500/10 text-white font-semibold rounded-xl transition-all duration-300">
                <i class="fas fa-plus mr-2"></i>
                Ajukan Kontrak Baru
            </a>
        </div>
    </div>

    <!-- Notifications -->
    <?php if(session('success')): ?>
    <div class="bg-emerald-500/20 backdrop-blur-sm border border-emerald-500/20 text-white px-4 py-3 rounded-xl">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-3 text-emerald-400"></i>
            <span><?php echo e(session('success')); ?></span>
        </div>
    </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
    <div class="bg-red-500/20 backdrop-blur-sm border border-red-500/20 text-white px-4 py-3 rounded-xl">
        <div class="flex items-center">
            <i class="fas fa-exclamation-circle mr-3 text-red-400"></i>
            <span><?php echo e(session('error')); ?></span>
        </div>
    </div>
    <?php endif; ?>

    <!-- Kontrak List -->
    <div class="space-y-4">
        <?php $__empty_1 = true; $__currentLoopData = $kontrak; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="card-hover bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-5 transition-all duration-300
            <?php echo e($k->status_kontrak == 'aktif' ? 'hover:border-emerald-500/50' : 
               ($k->status_kontrak == 'pending' ? 'hover:border-amber-500/50' : 
               ($k->status_kontrak == 'ditolak' ? 'hover:border-red-500/50' : 'hover:border-slate-500/50'))); ?>">
            
            <div class="flex flex-col lg:flex-row lg:items-start justify-between">
                <!-- Left Content -->
                <div class="flex-1">
                    <!-- Header with Status -->
                    <div class="flex flex-col md:flex-row md:items-center justify-between mb-4">
                        <div class="flex items-center space-x-3 mb-3 md:mb-0">
                            <div class="w-12 h-12 rounded-xl bg-white/5 backdrop-blur-sm flex items-center justify-center">
                                <i class="fas fa-home text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-white"><?php echo e($k->kos->nama_kos); ?></h3>
                                <div class="flex items-center space-x-3 mt-1">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium
                                        <?php echo e($k->status_kontrak == 'aktif' ? 'bg-emerald-50 text-emerald-600' : 
                                           ($k->status_kontrak == 'pending' ? 'bg-yellow-50 text-yellow-600' : 
                                           ($k->status_kontrak == 'ditolak' ? 'bg-red-50 text-red-600' : 'bg-gray-100 text-slate-500'))); ?>">
                                        <?php echo e(ucfirst($k->status_kontrak)); ?>

                                    </span>
                                    <span class="text-xs text-slate-400">
                                        <?php echo e($k->created_at->format('d M Y, H:i')); ?>

                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Price -->
                        <div class="text-right">
                            <div class="text-xl font-bold text-white">
                                Rp <?php echo e(number_format($k->harga_sewa, 0, ',', '.')); ?>

                            </div>
                            <div class="text-sm text-slate-400">per bulan</div>
                        </div>
                    </div>

                    <!-- Details Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                        <!-- Kamar Info -->
                        <div class="bg-slate-900/50 backdrop-blur-sm border border-sky-900/50 rounded-xl p-3">
                            <div class="flex items-center space-x-2 mb-1">
                                <i class="fas fa-door-closed text-sky-500 text-sm"></i>
                                <span class="text-sm text-slate-400">Kamar</span>
                            </div>
                            <div class="text-white font-medium"><?php echo e($k->kamar->nomor_kamar); ?></div>
                            <div class="text-xs text-slate-400"><?php echo e($k->kamar->tipe_kamar); ?></div>
                        </div>

                        <!-- Durasi -->
                        <div class="bg-slate-900/50 backdrop-blur-sm border border-sky-900/50 rounded-xl p-3">
                            <div class="flex items-center space-x-2 mb-1">
                                <i class="fas fa-calendar-alt text-emerald-500 text-sm"></i>
                                <span class="text-sm text-slate-400">Durasi</span>
                            </div>
                            <div class="text-white font-medium"><?php echo e($k->durasi_sewa); ?> <?php echo e($k->unit_label_lower); ?></div>
                        </div>

                        <!-- Tanggal Mulai -->
                        <?php if($k->tanggal_mulai): ?>
                        <div class="bg-slate-900/50 backdrop-blur-sm border border-sky-900/50 rounded-xl p-3">
                            <div class="flex items-center space-x-2 mb-1">
                                <i class="fas fa-play-circle text-blue-500 text-sm"></i>
                                <span class="text-sm text-slate-400">Mulai</span>
                            </div>
                            <div class="text-white font-medium"><?php echo e($k->tanggal_mulai ? $k->tanggal_mulai->format('d M Y') : '-'); ?></div>
                        </div>
                        <?php endif; ?>

                        <!-- Tanggal Selesai -->
                        <?php if($k->tanggal_selesai): ?>
                        <div class="bg-slate-900/50 backdrop-blur-sm border border-sky-900/50 rounded-xl p-3">
                            <div class="flex items-center space-x-2 mb-1">
                                <i class="fas fa-flag-checkered text-indigo-500 text-sm"></i>
                                <span class="text-sm text-slate-400">Selesai</span>
                            </div>
                            <div class="text-white font-medium"><?php echo e($k->tanggal_selesai ? $k->tanggal_selesai->format('d M Y') : '-'); ?></div>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Rejection Reason -->
                    <?php if($k->alasan_ditolak): ?>
                    <div class="mt-4 p-4 bg-red-500/10 backdrop-blur-sm border border-red-500/20 rounded-xl">
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-exclamation-triangle text-red-400 mt-1"></i>
                            <div>
                                <div class="text-sm font-medium text-white mb-1">Alasan Penolakan</div>
                                <p class="text-sm text-slate-400"><?php echo e($k->alasan_ditolak); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Action Buttons -->
                <div class="mt-4 lg:mt-0 lg:ml-4 flex lg:flex-col space-x-2 lg:space-x-0 lg:space-y-2">
                    <a href="<?php echo e(route('penghuni.kontrak.show', $k->id_kontrak)); ?>" 
                       class="flex items-center justify-center px-4 py-2 bg-sky-500/20 backdrop-blur-sm border border-sky-500/20 hover:bg-sky-500/10 text-white rounded-lg transition-all duration-300">
                        <i class="fas fa-eye mr-2"></i>
                        <span class="hidden lg:inline">Detail</span>
                    </a>
                    
                    <!-- Additional actions based on status -->
                    <?php if($k->status_kontrak == 'aktif' && $k->tanggal_selesai > now()): ?>
                    <a href="<?php echo e(route('penghuni.pembayaran.create')); ?>?kontrak=<?php echo e($k->id_kontrak); ?>" 
                       class="flex items-center justify-center px-4 py-2 bg-emerald-500/20 backdrop-blur-sm border border-emerald-500/20 hover:bg-emerald-500/10 text-white rounded-lg transition-all duration-300">
                        <i class="fas fa-credit-card mr-2"></i>
                        <span class="hidden lg:inline">Bayar</span>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <!-- Empty State -->
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-8 text-center">
            <div class="w-24 h-24 bg-white/5 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-home text-4xl text-white"></i>
            </div>
            <h3 class="text-xl font-semibold text-white mb-3">Belum Ada Kontrak</h3>
            <p class="text-slate-100 mb-6 max-w-md mx-auto">
                Anda belum memiliki riwayat kontrak kos. Mulai cari kos yang sesuai dengan kebutuhan Anda.
            </p>
            <a href="<?php echo e(route('public.kos.index')); ?>" 
               class="inline-flex items-center justify-center px-6 py-3 bg-sky-500/20 backdrop-blur-sm border border-sky-500/20 hover:bg-sky-500/10 text-white font-semibold rounded-xl transition-all duration-300">
                <i class="fas fa-search mr-2"></i>
                Cari Kos Sekarang
            </a>
        </div>
        <?php endif; ?>
        
        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-white/20">
            <div class="flex items-center justify-between">
                <div class="text-sm text-slate-400">
                    Menampilkan <?php echo e($kontrak->firstItem()); ?> - <?php echo e($kontrak->lastItem()); ?> dari <?php echo e($kontrak->total()); ?> kontrak
                </div>
                <div class="flex space-x-2">
                    <?php echo e($kontrak->links('vendor.pagination.custom-dark')); ?>

                </div>
            </div>
        </div>
    </div>

    <!-- Stats Summary -->
    <?php if($kontrak->count() > 0): ?>
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-xl p-4">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-2xl font-bold text-white"><?php echo e($kontrak->count()); ?></div>
                    <div class="text-sm text-slate-100">Total Kontrak</div>
                </div>
                <div class="w-10 h-10 rounded-lg bg-white/5 backdrop-blur-sm flex items-center justify-center">
                    <i class="fas fa-file-contract text-white"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-xl p-4">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-2xl font-bold text-white">
                        <?php echo e($kontrak->where('status_kontrak', 'aktif')->count()); ?>

                    </div>
                    <div class="text-sm text-slate-100">Aktif</div>
                </div>
                <div class="w-10 h-10 rounded-lg bg-white/5 backdrop-blur-sm flex items-center justify-center">
                    <i class="fas fa-check-circle text-white"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-xl p-4">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-2xl font-bold text-white">
                        <?php echo e($kontrak->where('status_kontrak', 'pending')->count()); ?>

                    </div>
                    <div class="text-sm text-slate-100">Menunggu</div>
                </div>
                <div class="w-10 h-10 rounded-lg bg-white/5 backdrop-blur-sm flex items-center justify-center">
                    <i class="fas fa-clock text-white"></i>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/penghuni/kontrak/index.blade.php ENDPATH**/ ?>