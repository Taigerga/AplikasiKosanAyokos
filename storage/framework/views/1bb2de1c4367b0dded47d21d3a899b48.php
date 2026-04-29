<?php $__env->startSection('title', 'Kelola Kontrak - AyoKos'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <!-- Breadcrumb -->
    <div class="bg-dark-card/50 border border-dark-border rounded-xl p-4 mb-6">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="<?php echo e(route('pemilik.dashboard')); ?>" class="inline-flex items-center text-sm font-medium text-dark-muted hover:text-white transition-colors">
                        <i class="fas fa-home mr-2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="inline-flex items-center">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-dark-muted text-xs mx-2"></i>
                        <a href="<?php echo e(route('pemilik.kontrak.index')); ?>" class="inline-flex items-center text-sm font-medium text-white">
                            <i class="fas fa-file-contract mr-2"></i>
                            Kelola Kontrak
                        </a>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-primary-900/30 to-indigo-900/30 border border-primary-800/30 rounded-2xl p-6 mb-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-white mb-2">
                    <i class="fas fa-file-contract mr-3"></i>
                    Kelola Kontrak Kos</h1>
                <p class="text-dark-muted">Kelola semua permohonan dan kontrak sewa kos Anda</p>
            </div>
            <div class="mt-4 md:mt-0">
                 <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary-900/30 text-primary-300 border border-primary-700/30">
                     <i class="fas fa-file-contract mr-2"></i>
                     Total: <?php echo e($kontrakPendingCount + $kontrakAktifCount + $kontrakSelesaiCount + $kontrakDitolakCount); ?> kontrak
                 </span>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    <?php if(session('success')): ?>
    <div class="bg-green-900/20 border border-green-800/30 text-green-300 px-4 py-3 rounded-lg mb-6 flex items-center">
        <i class="fas fa-check-circle mr-3 text-green-400"></i>
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
    <div class="bg-red-900/20 border border-red-800/30 text-red-300 px-4 py-3 rounded-lg mb-6 flex items-center">
        <i class="fas fa-times-circle mr-3 text-red-400"></i>
        <?php echo e(session('error')); ?>

    </div>
    <?php endif; ?>

    <!-- Tabs Navigation -->
     
    <div class="bg-dark-card border border-dark-border rounded-2xl overflow-hidden">
        <div class="border-b border-dark-border">
            <nav class="-mb-px flex overflow-x-auto">
                <button onclick="showTab('pending')" 
                        class="tab-button flex-1 py-4 px-6 border-b-2 font-medium text-sm whitespace-nowrap transition-all duration-300 <?php echo e(request('tab', 'pending') === 'pending' ? 'border-primary-500 text-primary-300 bg-primary-900/10' : 'border-transparent text-dark-muted hover:text-white hover:bg-dark-border/50'); ?>"
                        id="tab-pending">
                    <div class="flex items-center justify-center">
                        <i class="fas fa-clock mr-2 <?php echo e(request('tab', 'pending') === 'pending' ? 'text-primary-400' : 'text-dark-muted'); ?>"></i>
                        Permohonan Pending
                        <?php if($kontrakPending->count() > 0): ?>
                        <span class="ml-2 bg-yellow-900/30 text-yellow-300 px-2 py-1 rounded-full text-xs min-w-[24px] text-center">
                            <?php echo e($kontrakPending->count()); ?>

                        </span>
                        <?php endif; ?>
                    </div>
                </button>
                
                <button onclick="showTab('aktif')" 
                        class="tab-button flex-1 py-4 px-6 border-b-2 font-medium text-sm whitespace-nowrap transition-all duration-300 <?php echo e(request('tab') === 'aktif' ? 'border-green-500 text-green-300 bg-green-900/10' : 'border-transparent text-dark-muted hover:text-white hover:bg-dark-border/50'); ?>"
                        id="tab-aktif">
                    <div class="flex items-center justify-center">
                        <i class="fas fa-check-circle mr-2 <?php echo e(request('tab') === 'aktif' ? 'text-green-400' : 'text-dark-muted'); ?>"></i>
                        Kontrak Aktif
                        <?php if($kontrakAktif->count() > 0): ?>
                        <span class="ml-2 bg-green-900/30 text-green-300 px-2 py-1 rounded-full text-xs min-w-[24px] text-center">
                            <?php echo e($kontrakAktif->count()); ?>

                        </span>
                        <?php endif; ?>
                    </div>
                </button>
                
                <button onclick="showTab('selesai')" 
                        class="tab-button flex-1 py-4 px-6 border-b-2 font-medium text-sm whitespace-nowrap transition-all duration-300 <?php echo e(request('tab') === 'selesai' ? 'border-gray-500 text-gray-300 bg-gray-900/10' : 'border-transparent text-dark-muted hover:text-white hover:bg-dark-border/50'); ?>"
                        id="tab-selesai">
                    <div class="flex items-center justify-center">
                        <i class="fas fa-history mr-2 <?php echo e(request('tab') === 'selesai' ? 'text-gray-400' : 'text-dark-muted'); ?>"></i>
                        Riwayat Selesai
                        <?php if($kontrakSelesai->count() > 0): ?>
                        <span class="ml-2 bg-gray-900/30 text-gray-300 px-2 py-1 rounded-full text-xs min-w-[24px] text-center">
                            <?php echo e($kontrakSelesai->count()); ?>

                        </span>
                        <?php endif; ?>
                    </div>
                </button>
                
                <button onclick="showTab('ditolak')" 
                        class="tab-button flex-1 py-4 px-6 border-b-2 font-medium text-sm whitespace-nowrap transition-all duration-300 <?php echo e(request('tab') === 'ditolak' ? 'border-red-500 text-red-300 bg-red-900/10' : 'border-transparent text-dark-muted hover:text-white hover:bg-dark-border/50'); ?>"
                        id="tab-ditolak">
                    <div class="flex items-center justify-center">
                        <i class="fas fa-times-circle mr-2 <?php echo e(request('tab') === 'ditolak' ? 'text-red-400' : 'text-dark-muted'); ?>"></i>
                        Riwayat Ditolak
                        <?php if($kontrakDitolak->count() > 0): ?>
                        <span class="ml-2 bg-red-900/30 text-red-300 px-2 py-1 rounded-full text-xs min-w-[24px] text-center">
                            <?php echo e($kontrakDitolak->count()); ?>

                        </span>
                        <?php endif; ?>
                    </div>
                </button>
            </nav>
        </div>

        <!-- Tab Content Container -->
        <div class="p-6">
            <!-- Tab Content: Pending -->
            <div id="content-pending" class="tab-content <?php echo e(request('tab', 'pending') !== 'pending' ? 'hidden' : ''); ?>">
                <?php if($kontrakPending->count() > 0): ?>
                <div class="space-y-4">
                    <?php $__currentLoopData = $kontrakPending; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kontrak): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-dark-bg/50 border border-dark-border rounded-xl p-5 hover:border-yellow-500/50 transition-all duration-300">
                        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                            <!-- User Info -->
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-yellow-900/30 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-user text-yellow-400 text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-white"><?php echo e($kontrak->penghuni->nama ?? 'N/A'); ?></h3>
                                    <p class="text-sm text-dark-muted"><?php echo e($kontrak->penghuni->no_hp ?? '-'); ?></p>
                                    <p class="text-xs text-dark-muted/70 mt-1">Terdaftar: <?php echo e($kontrak->created_at->format('d M Y')); ?></p>
                                </div>
                            </div>
                            
                            <!-- Kos & Kamar Info -->
                            <div class="lg:text-center">
                                <div class="text-sm font-medium text-white"><?php echo e($kontrak->kos->nama_kos ?? 'N/A'); ?></div>
                                <div class="text-xs text-dark-muted">Kamar <?php echo e($kontrak->kamar->nomor_kamar ?? '-'); ?></div>
                                <div class="text-xs text-dark-muted mt-1"><?php echo e($kontrak->durasi_sewa ?? 0); ?> bulan</div>
                            </div>
                            
                            <!-- Price -->
                            <div class="lg:text-right">
                                <div class="text-lg font-bold text-white">Rp <?php echo e(number_format($kontrak->harga_sewa ?? 0, 0, ',', '.')); ?></div>
                                <div class="text-xs text-dark-muted">per bulan</div>
                            </div>
                            
                            <!-- Actions -->
                            <div class="flex space-x-2">
                                <button onclick="showApproveModal('<?php echo e(route('pemilik.kontrak.approve', $kontrak->id_kontrak)); ?>', '<?php echo e($kontrak->penghuni->nama ?? 'Penghuni'); ?>')"
                                        class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm font-medium transition flex items-center">
                                    <i class="fas fa-check mr-2"></i>
                                    Setujui
                                </button>
                                <button onclick="showRejectModal(<?php echo e($kontrak->id_kontrak); ?>, '<?php echo e($kontrak->penghuni->nama ?? 'Penghuni'); ?>')"
                                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition flex items-center">
                                    <i class="fas fa-times mr-2"></i>
                                    Tolak
                                </button>
                                <a href="<?php echo e(route('pemilik.kontrak.show', $kontrak->id_kontrak)); ?>"
                                   class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg text-sm font-medium transition flex items-center">
                                    <i class="fas fa-eye mr-2"></i>
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php else: ?>
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-yellow-900/30 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-check-circle text-yellow-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-3">Tidak Ada Permohonan Pending</h3>
                    <p class="text-dark-muted">Semua permohonan sudah diproses.</p>
                </div>
                <?php endif; ?>
            </div>

            <!-- Tab Content: Aktif -->
            <div id="content-aktif" class="tab-content <?php echo e(request('tab') !== 'aktif' ? 'hidden' : ''); ?>">
                <?php if($kontrakAktif->count() > 0): ?>
                <div class="space-y-4">
                    <?php $__currentLoopData = $kontrakAktif; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kontrak): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-dark-bg/50 border border-dark-border rounded-xl p-5 hover:border-green-500/50 transition-all duration-300">
                        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                            <!-- User Info -->
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-green-900/30 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-user text-green-400 text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-white"><?php echo e($kontrak->penghuni->nama ?? 'N/A'); ?></h3>
                                    <p class="text-sm text-dark-muted"><?php echo e($kontrak->penghuni->no_hp ?? '-'); ?></p>
                                    <p class="text-xs text-dark-muted/70 mt-1">
                                        <?php if($kontrak->tanggal_mulai && $kontrak->tanggal_selesai): ?>
                                            <?php echo e($kontrak->tanggal_mulai->format('d M Y')); ?> - <?php echo e($kontrak->tanggal_selesai->format('d M Y')); ?>

                                        <?php else: ?>
                                            <span class="text-yellow-400">Belum ada periode (menunggu pembayaran pertama)</span>
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Kos & Kamar Info -->
                            <div class="lg:text-center">
                                <div class="text-sm font-medium text-white"><?php echo e($kontrak->kos->nama_kos ?? 'N/A'); ?></div>
                                <div class="text-xs text-dark-muted">Kamar <?php echo e($kontrak->kamar->nomor_kamar ?? '-'); ?></div>
                            </div>
                            
                            <!-- Time Remaining -->
                            <div class="lg:text-right">
                                <?php if($kontrak->tanggal_selesai): ?>
                                    <?php
                                        $sisaHari = (int) ceil(now()->diffInDays($kontrak->tanggal_selesai, false));
                                    ?>
                                    <?php if($sisaHari > 30): ?>
                                        <span class="inline-flex items-center bg-green-900/30 text-green-300 px-3 py-1.5 rounded-lg text-sm">
                                            <i class="fas fa-calendar-alt mr-2"></i>
                                            <?php echo e((int)ceil($sisaHari/30)); ?> bulan lagi
                                        </span>
                                    <?php elseif($sisaHari > 0): ?>
                                        <span class="inline-flex items-center bg-yellow-900/30 text-yellow-300 px-3 py-1.5 rounded-lg text-sm">
                                            <i class="fas fa-clock mr-2"></i>
                                            <?php echo e($sisaHari); ?> hari lagi
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center bg-red-900/30 text-red-300 px-3 py-1.5 rounded-lg text-sm">
                                            <i class="fas fa-exclamation-triangle mr-2"></i>
                                            Telah berakhir
                                        </span>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="text-dark-muted text-sm">Belum ditentukan</span>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Actions -->
                            <div class="flex space-x-2">
                                <a href="<?php echo e(route('pemilik.kontrak.show', $kontrak->id_kontrak)); ?>"
                                   class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg text-sm font-medium transition flex items-center">
                                    <i class="fas fa-eye mr-2"></i>
                                    Detail
                                </a>
                                <?php if($kontrak->tanggal_selesai && now()->greaterThanOrEqualTo($kontrak->tanggal_selesai)): ?>
                                <form method="POST" action="<?php echo e(route('pemilik.kontrak.selesai', $kontrak->id_kontrak)); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('POST'); ?>
                                    <button type="submit" 
                                            class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg text-sm font-medium transition flex items-center"
                                            onclick="return confirm('Tandai kontrak <?php echo e($kontrak->penghuni->nama ?? ''); ?> sebagai selesai?')">
                                        <i class="fas fa-history mr-2"></i>
                                        Selesai
                                    </button>
                                </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php else: ?>
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-green-900/30 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-home text-green-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-3">Tidak Ada Kontrak Aktif</h3>
                    <p class="text-dark-muted">Belum ada penghuni yang aktif di kos Anda.</p>
                </div>
                <?php endif; ?>
            </div>

            <!-- Tab Content: Selesai -->
            <div id="content-selesai" class="tab-content <?php echo e(request('tab') !== 'selesai' ? 'hidden' : ''); ?>">
                <?php if($kontrakSelesai->count() > 0): ?>
                <div class="space-y-4">
                    <?php $__currentLoopData = $kontrakSelesai; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kontrak): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-dark-bg/50 border border-dark-border rounded-xl p-5 hover:border-gray-500/50 transition-all duration-300">
                        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                            <!-- User Info -->
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-gray-900/30 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-user text-gray-400 text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-white"><?php echo e($kontrak->penghuni->nama ?? 'N/A'); ?></h3>
                                    <p class="text-sm text-dark-muted"><?php echo e($kontrak->penghuni->no_hp ?? '-'); ?></p>
                                    <p class="text-xs text-dark-muted/70 mt-1">
                                        <?php if($kontrak->tanggal_mulai && $kontrak->tanggal_selesai): ?>
                                            <?php echo e($kontrak->tanggal_mulai->format('d M Y')); ?> - <?php echo e($kontrak->tanggal_selesai->format('d M Y')); ?>

                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Kos & Kamar Info -->
                            <div class="lg:text-center">
                                <div class="text-sm font-medium text-white"><?php echo e($kontrak->kos->nama_kos ?? 'N/A'); ?></div>
                                <div class="text-xs text-dark-muted">Kamar <?php echo e($kontrak->kamar->nomor_kamar ?? '-'); ?></div>
                            </div>
                            
                            <!-- Status -->
                            <div class="lg:text-right">
                                <span class="inline-flex items-center bg-gray-900/30 text-gray-300 px-3 py-1.5 rounded-lg text-sm">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    Selesai
                                </span>
                            </div>
                            
                            <!-- Actions -->
                            <div class="flex space-x-2">
                                <a href="<?php echo e(route('pemilik.kontrak.show', $kontrak->id_kontrak)); ?>"
                                   class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg text-sm font-medium transition flex items-center">
                                    <i class="fas fa-eye mr-2"></i>
                                    Detail
                                </a>
                                <form method="POST" action="<?php echo e(route('pemilik.kontrak.destroy', $kontrak->id_kontrak)); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" 
                                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition flex items-center"
                                            onclick="return confirm('Hapus riwayat kontrak dari <?php echo e($kontrak->penghuni->nama ?? 'penghuni'); ?>?\\n\\nData yang dihapus tidak dapat dikembalikan!')">
                                        <i class="fas fa-trash mr-2"></i>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php else: ?>
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-gray-900/30 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-history text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-3">Tidak Ada Riwayat Kontrak Selesai</h3>
                    <p class="text-dark-muted">Belum ada kontrak yang selesai.</p>
                </div>
                <?php endif; ?>
            </div>

            <!-- Tab Content: Ditolak -->
            <div id="content-ditolak" class="tab-content <?php echo e(request('tab') !== 'ditolak' ? 'hidden' : ''); ?>">
                <?php if($kontrakDitolak->count() > 0): ?>
                <div class="space-y-4">
                    <?php $__currentLoopData = $kontrakDitolak; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kontrak): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-dark-bg/50 border border-dark-border rounded-xl p-5 hover:border-red-500/50 transition-all duration-300">
                        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                            <!-- User Info -->
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-red-900/30 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-user text-red-400 text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-white"><?php echo e($kontrak->penghuni->nama ?? 'N/A'); ?></h3>
                                    <p class="text-sm text-dark-muted"><?php echo e($kontrak->penghuni->no_hp ?? '-'); ?></p>
                                    <p class="text-xs text-dark-muted/70 mt-1">
                                        Ditolak: <?php echo e($kontrak->created_at->format('d M Y')); ?>

                                    </p>
                                </div>
                            </div>
                            
                            <!-- Kos & Kamar Info -->
                            <div class="lg:text-center">
                                <div class="text-sm font-medium text-white"><?php echo e($kontrak->kos->nama_kos ?? 'N/A'); ?></div>
                                <div class="text-xs text-dark-muted">Kamar <?php echo e($kontrak->kamar->nomor_kamar ?? '-'); ?></div>
                            </div>
                            
                            <!-- Rejection Reason -->
                            <div class="lg:text-right max-w-xs">
                                <div class="text-sm text-dark-muted">
                                    <?php if($kontrak->alasan_ditolak): ?>
                                        <span class="text-red-300 italic">"<?php echo e($kontrak->alasan_ditolak); ?>"</span>
                                    <?php else: ?>
                                        <span class="text-dark-muted/50">Tidak ada alasan</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- Actions -->
                            <div class="flex space-x-2">
                                <a href="<?php echo e(route('pemilik.kontrak.show', $kontrak->id_kontrak)); ?>"
                                   class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg text-sm font-medium transition flex items-center">
                                    <i class="fas fa-eye mr-2"></i>
                                    Detail
                                </a>
                                <form method="POST" action="<?php echo e(route('pemilik.kontrak.destroy', $kontrak->id_kontrak)); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" 
                                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition flex items-center"
                                            onclick="return confirm('Hapus riwayat kontrak yang ditolak dari <?php echo e($kontrak->penghuni->nama ?? 'penghuni'); ?>?\\n\\nData yang dihapus tidak dapat dikembalikan!')">
                                        <i class="fas fa-trash mr-2"></i>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php else: ?>
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-red-900/30 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-times-circle text-red-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-3">Tidak Ada Riwayat Kontrak Ditolak</h3>
                    <p class="text-dark-muted">Belum ada kontrak yang ditolak.</p>
                </div>
                <?php endif; ?>
            </div>
            <!-- Table Footer -->
            <?php if($kontrakDitolak->hasPages()): ?>
            <div class="px-6 py-4 border-t border-dark-border">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-dark-muted">
                        Menampilkan <?php echo e($kontrakDitolak->firstItem()); ?> - <?php echo e($kontrakDitolak->lastItem()); ?> dari <?php echo e($kontrakDitolak->total()); ?> kontrak
                    </div>
                    <div class="flex space-x-2">
                        <?php echo e($kontrakDitolak->links('vendor.pagination.custom-dark')); ?>

                    </div>
                </div>
            </div>
            <?php endif; ?>

            
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border border-dark-border w-96 shadow-2xl rounded-2xl bg-dark-card">
        <div class="mt-3">
            <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                <i class="fas fa-times-circle text-red-400 mr-2"></i>
                Tolak Permohonan Kontrak
            </h3>
            <p class="text-sm text-dark-muted mb-4" id="rejectUserName">
                Alasan penolakan untuk: <span class="text-white font-medium"></span>
            </p>
            
            <form method="POST" action="" id="rejectForm">
                <?php echo csrf_field(); ?>
                <?php echo method_field('POST'); ?>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-white mb-2">Alasan Penolakan *</label>
                    <textarea name="alasan_ditolak" 
                              class="w-full px-3 py-2 bg-dark-bg border border-dark-border text-white rounded-lg focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-500/30"
                              rows="4" 
                              placeholder="Berikan alasan penolakan yang jelas..."
                              required></textarea>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" 
                            onclick="closeRejectModal()"
                            class="px-4 py-2 bg-dark-border text-white rounded-lg hover:bg-dark-border/80 transition">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-lg hover:from-red-700 hover:to-red-800 transition shadow-lg">
                        <i class="fas fa-times mr-2"></i>
                        Tolak Kontrak
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="approveModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border border-dark-border w-96 shadow-2xl rounded-2xl bg-dark-card">
        <div class="mt-3">
            <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                <i class="fas fa-check-circle text-green-400 mr-2"></i>
                Setujui Permohonan Kontrak
            </h3>
            <p class="text-sm text-dark-muted mb-4" id="approveUserName">
                Konfirmasi persetujuan untuk: <span class="text-white font-medium"></span>
            </p>
            
            <form method="POST" action="" id="approveForm">
                <?php echo csrf_field(); ?>
                <?php echo method_field('POST'); ?>
                
                <p class="text-sm text-gray-300 mb-6">
                    Apakah Anda yakin ingin menyetujui kontrak ini? Status kamar akan berubah menjadi terisi dan kontrak akan aktif.
                </p>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" 
                            onclick="closeApproveModal()"
                            class="px-4 py-2 bg-dark-border text-white rounded-lg hover:bg-dark-border/80 transition">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-lg hover:from-green-700 hover:to-green-800 transition shadow-lg">
                        <i class="fas fa-check mr-2"></i>
                        Setujui Kontrak
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Tab functionality
    function showTab(tabName) {
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.add('hidden');
        });
        
        // Remove active styles from all tabs
        document.querySelectorAll('.tab-button').forEach(button => {
            button.classList.remove('border-primary-500', 'border-green-500', 'border-gray-500', 'border-red-500');
            button.classList.remove('text-primary-300', 'text-green-300', 'text-gray-300', 'text-red-300');
            button.classList.remove('bg-primary-900/10', 'bg-green-900/10', 'bg-gray-900/10', 'bg-red-900/10');
            button.classList.add('border-transparent', 'text-dark-muted');
        });
        
        // Show selected tab content
        document.getElementById('content-' + tabName).classList.remove('hidden');
        
        // Add active style to selected tab
        const activeTab = document.getElementById('tab-' + tabName);
        const colors = {
            'pending': { border: 'border-primary-500', text: 'text-primary-300', bg: 'bg-primary-900/10' },
            'aktif': { border: 'border-green-500', text: 'text-green-300', bg: 'bg-green-900/10' },
            'selesai': { border: 'border-gray-500', text: 'text-gray-300', bg: 'bg-gray-900/10' },
            'ditolak': { border: 'border-red-500', text: 'text-red-300', bg: 'bg-red-900/10' }
        };
        
        activeTab.classList.remove('border-transparent', 'text-dark-muted');
        activeTab.classList.add(colors[tabName].border, colors[tabName].text, colors[tabName].bg);
        
        // Update URL without page reload
        const url = new URL(window.location);
        url.searchParams.set('tab', tabName);
        window.history.pushState({}, '', url);
    }

    // Reject modal functionality
    function showRejectModal(kontrakId, userName) {
        document.querySelector('#rejectUserName span').textContent = userName;
        document.getElementById('rejectForm').action = '/pemilik/kontrak/' + kontrakId + '/reject';
        document.getElementById('rejectModal').classList.remove('hidden');
    }

    function closeRejectModal() {
        document.getElementById('rejectModal').classList.add('hidden');
        document.getElementById('rejectForm').reset();
    }

    // Approve modal functionality
    function showApproveModal(actionUrl, userName) {
        document.querySelector('#approveUserName span').textContent = userName;
        document.getElementById('approveForm').action = actionUrl;
        document.getElementById('approveModal').classList.remove('hidden');
    }

    function closeApproveModal() {
        document.getElementById('approveModal').classList.add('hidden');
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const rejectModal = document.getElementById('rejectModal');
        const approveModal = document.getElementById('approveModal');
        
        if (event.target === rejectModal) {
            closeRejectModal();
        }
        if (event.target === approveModal) {
            closeApproveModal();
        }
    }

    // Initialize based on URL parameter
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const tab = urlParams.get('tab') || 'pending';
        showTab(tab);
    });
</script>

<style>
    .tab-button {
        min-width: 0;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .tab-button:hover {
        background-color: rgba(71, 85, 105, 0.2) !important;
        color: #e2e8f0 !important;
    }
    
    .tab-button.active {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px -2px rgba(0, 0, 0, 0.3);
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/pemilik/kontrak/index.blade.php ENDPATH**/ ?>