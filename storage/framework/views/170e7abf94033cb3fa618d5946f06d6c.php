 

<?php $__env->startSection('title', 'Dashboard Penghuni - AyoKos'); ?>

<?php $__env->startSection('content'); ?>
    <div class="p-4 md:p-6 lg:p-8 space-y-6 max-w-7xl mx-auto">
        <!-- Welcome Banner -->
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-white mb-2">
                        <i class="fas fa-home mr-3"></i>
                        Halo, <?php echo e($user->penghuni->nama); ?>! 🎉</h1>
                    <p class="text-slate-100">Kelola hunian dan aktivitas sewa Anda dengan mudah</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-50 text-blue-600 border border-blue-200">
                        <i class="fas fa-user mr-2"></i>
                        Penghuni Kos
                    </span>
                </div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Kos Aktif Card -->
            <div class="card-hover bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 rounded-lg bg-white/5 backdrop-blur-sm">
                        <i class="fas fa-home text-white text-xl"></i>
                    </div>
                    <span class="text-sm font-medium px-2 py-1 rounded-full bg-white/5 backdrop-blur-sm text-white">
                        <?php echo e($kontrakAktif->count() > 0 ? '+' . $kontrakAktif->count() : '0'); ?>

                    </span>
                </div>
                <h3 class="text-2xl font-bold text-white mb-1"><?php echo e($kontrakAktif->count()); ?></h3>
                <p class="text-sm text-slate-100">Kos Aktif</p>
            </div>

            <!-- Total Pembayaran Card -->
            <div class="card-hover bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 rounded-lg bg-white/5 backdrop-blur-sm">
                        <i class="fas fa-wallet text-white text-xl"></i>
                    </div>
                    <span class="text-sm font-medium px-2 py-1 rounded-full bg-white/5 backdrop-blur-sm text-white">
                        Total
                    </span>
                </div>
                <h3 class="text-2xl font-bold text-white mb-1">Rp <?php echo e(number_format($totalPembayaran, 0, ',', '.')); ?></h3>
                <p class="text-sm text-slate-100">Total Pembayaran</p>
            </div>

            <!-- Status Penghuni Card -->
            <div class="card-hover bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 rounded-lg bg-white/5 backdrop-blur-sm">
                        <i
                            class="fas 
                            <?php echo e($user->status_penghuni == 'aktif' ? 'fa-check-circle' :
        ($user->status_penghuni == 'calon' ? 'fa-clock' : 'fa-times-circle')); ?> text-white text-xl"></i>
                    </div>
                    <span class="text-sm font-medium px-2 py-1 rounded-full bg-white/5 backdrop-blur-sm text-white">
                        Status
                    </span>
                </div>
                <h3 class="text-2xl font-bold text-white mb-1 capitalize"><?php echo e(ucfirst($user->status_penghuni)); ?></h3>
                <p class="text-sm text-slate-100">Status Penghuni</p>
            </div>

            <!-- Kontrak Berakhir Card -->
            <div class="card-hover bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 rounded-lg bg-white/5 backdrop-blur-sm">
                        <i class="fas fa-clock text-white text-xl"></i>
                    </div>
                    <?php
                        $berakhirSegera = $kontrakAktif->filter(function ($kontrak) {
                            return $kontrak->sisaHari <= 30 && !$kontrak->sudahBerakhir;
                        })->count();
                    ?>
                    <span class="text-sm font-medium px-2 py-1 rounded-full bg-white/5 backdrop-blur-sm text-white">
                        <?php echo e($berakhirSegera > 0 ? 'Perhatian' : 'Aman'); ?>

                    </span>
                </div>
                <h3 class="text-2xl font-bold text-white mb-1"><?php echo e($berakhirSegera); ?></h3>
                <p class="text-sm text-slate-100">Akan Berakhir</p>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
            <h2 class="text-xl font-bold text-white mb-4 flex items-center">
                <i class="fas fa-bolt text-yellow-600 mr-3"></i>
                Aksi Cepat
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
                <a href="<?php echo e(route('public.kos.index')); ?>"
                    class="bg-sky-500/20 backdrop-blur-sm border border-sky-500/20 hover:bg-sky-500/10 text-white text-center py-3 rounded-xl transition-all duration-300 flex flex-col items-center justify-center">
                    <i class="fas fa-search text-lg mb-1"></i>
                    <span class="text-sm font-medium">Cari Kos</span>
                </a>
                <a href="<?php echo e(route('penghuni.kontrak.index')); ?>"
                    class="bg-emerald-500/20 backdrop-blur-sm border border-emerald-500/20 hover:bg-emerald-500/10 text-white text-center py-3 rounded-xl transition-all duration-300 flex flex-col items-center justify-center">
                    <i class="fas fa-file-contract text-lg mb-1"></i>
                    <span class="text-sm font-medium">Kontrak Saya</span>
                </a>
                <a href="<?php echo e(route('penghuni.pembayaran.index')); ?>"
                    class="bg-indigo-500/20 backdrop-blur-sm border border-indigo-500/20 hover:bg-indigo-500/10 text-white text-center py-3 rounded-xl transition-all duration-300 flex flex-col items-center justify-center">
                    <i class="fas fa-credit-card text-lg mb-1"></i>
                    <span class="text-sm font-medium">Pembayaran</span>
                </a>
                <a href="<?php echo e(route('penghuni.reviews.history')); ?>"
                    class="bg-amber-500/20 backdrop-blur-sm border border-amber-500/20 hover:bg-amber-500/10 text-white text-center py-3 rounded-xl transition-all duration-300 flex flex-col items-center justify-center">
                    <i class="fas fa-star text-lg mb-1"></i>
                    <span class="text-sm font-medium">Review Saya</span>
                </a>
                <a href="<?php echo e(route('penghuni.analisis.index')); ?>"
                    class="bg-blue-500/20 backdrop-blur-sm border border-blue-500/20 hover:bg-blue-500/10 text-white text-center py-3 rounded-xl transition-all duration-300 flex flex-col items-center justify-center">
                    <i class="fas fa-chart-bar text-lg mb-1"></i>
                    <span class="text-sm font-medium">Analisis Saya</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Kontrak Aktif Section -->
            <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-file-contract text-emerald-500 mr-3"></i>
                        Kontrak Aktif
                    </h2>
                    <?php if($kontrakAktif->count() > 0): ?>
                        <span class="bg-emerald-500/20 backdrop-blur-sm border border-emerald-500/20 text-white px-3 py-1 rounded-full text-sm font-medium">
                            <?php echo e($kontrakAktif->count()); ?> aktif
                        </span>
                    <?php endif; ?>
                </div>

                <?php if($kontrakAktif->count() > 0): ?>
                    <div class="space-y-4">
                        <?php $__currentLoopData = $kontrakAktif->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kontrak): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div
                                    class="relative bg-slate-900/50 backdrop-blur-sm border border-emerald-900/50 rounded-xl p-4 hover:border-emerald-500 transition-all duration-300">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between mb-3">
                                                <h3 class="font-semibold text-white"><?php echo e($kontrak->kos->nama_kos); ?></h3>
                                                <span class="text-xs px-2 py-1 rounded-full 
                                                    <?php echo e($kontrak->statusWarna == 'green' ? 'bg-emerald-50 text-emerald-600' :
                            ($kontrak->statusWarna == 'yellow' ? 'bg-yellow-50 text-yellow-600' :
                                ($kontrak->statusWarna == 'red' ? 'bg-red-50 text-red-600' :
                                    'bg-gray-100 text-slate-500'))); ?>">
                                                    <?php echo e($kontrak->statusText ?? ($kontrak->sudahBerakhir ? 'Berakhir' : 'Aktif')); ?>

                                                </span>
                                            </div>
                                            <p class="text-sm text-slate-200 mb-3">Kamar <?php echo e($kontrak->kamar->nomor_kamar); ?></p>

                                            
                                            <?php if($kontrak->persentaseAkhir !== null): ?>
                                            <div class="mb-3">
                                                <div class="flex justify-between text-xs text-slate-400 mb-1">
                                                    <span>Sisa waktu kontrak</span>
                                                    <span><?php echo e(round($kontrak->persentaseAkhir)); ?>%</span>
                                                </div>
                                            </div>
                                            <?php endif; ?>

                                            <div class="flex items-center justify-between text-sm">
                                                <span class="text-slate-400">
                                                    <?php if($kontrak->sisaHari !== null): ?>
                                                        <?php echo e($kontrak->sisaHari); ?> hari tersisa
                                                    <?php else: ?>
                                                        <?php echo e($kontrak->statusText); ?>

                                                    <?php endif; ?>
                                                </span>
                                                <span class="font-bold text-white">
                                                    Rp <?php echo e(number_format($kontrak->harga_sewa, 0, ',', '.')); ?>/<?php echo e($kontrak->unit_label_lower); ?>

                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php if($kontrakAktif->count() > 3): ?>
                            <div class="text-center pt-2">
                                <a href="<?php echo e(route('penghuni.kontrak.index')); ?>"
                                    class="inline-flex items-center text-emerald-500 hover:text-emerald-600 text-sm font-medium">
                                    Lihat semua <?php echo e($kontrakAktif->count()); ?> kontrak
                                    <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-emerald-500/20 backdrop-blur-sm border border-emerald-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-home text-white text-2xl"></i>
                        </div>
                        <p class="text-slate-100 mb-3">Belum ada kontrak aktif</p>
                        <a href="<?php echo e(route('public.kos.index')); ?>"
                            class="text-emerald-500 hover:text-emerald-600 text-sm font-medium">
                            <i class="fas fa-search mr-1"></i>
                            Cari kos sekarang
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Riwayat Pembayaran Section -->
            <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-history text-indigo-500 mr-3"></i>
                        Riwayat Pembayaran
                    </h2>
                    <?php if($pembayaranTerakhir->count() > 0): ?>
                        <a href="<?php echo e(route('penghuni.pembayaran.index')); ?>"
                            class="px-4 py-2 bg-indigo-500/20 backdrop-blur-sm border border-indigo-500/20 hover:bg-indigo-500/10 text-white rounded-lg text-sm font-medium transition flex items-center">
                            Lihat Semua
                        </a>
                    <?php endif; ?>
                </div>

                <?php if($pembayaranTerakhir->count() > 0): ?>
                    <div class="space-y-4">
                        <?php $__currentLoopData = $pembayaranTerakhir->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pembayaran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div
                                    class="flex items-center justify-between relative bg-slate-900/50 backdrop-blur-sm border border-indigo-900/50 rounded-xl p-4 hover:border-indigo-500 transition-all duration-300">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 rounded-full 
                                            <?php echo e($pembayaran->status_pembayaran == 'lunas' ? 'bg-indigo-50' :
                            ($pembayaran->status_pembayaran == 'pending' ? 'bg-yellow-50' :
                                ($pembayaran->status_pembayaran == 'terlambat' ? 'bg-red-50' :
                                    'bg-gray-100'))); ?> flex items-center justify-center">
                                            <i class="fas fa-<?php echo e($pembayaran->status_pembayaran == 'lunas' ? 'check' : 'clock'); ?> 
                                                <?php echo e($pembayaran->status_pembayaran == 'lunas' ? 'text-indigo-600' :
                            ($pembayaran->status_pembayaran == 'pending' ? 'text-yellow-600' :
                                ($pembayaran->status_pembayaran == 'terlambat' ? 'text-red-600' :
                                    'text-slate-500'))); ?>"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-white"><?php echo e($pembayaran->kontrak->kos->nama_kos); ?></p>
                                            <p class="text-xs text-slate-400"><?php echo e($pembayaran->bulan_tahun); ?></p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-bold text-white">Rp <?php echo e(number_format($pembayaran->jumlah, 0, ',', '.')); ?></p>
                                        <span class="inline-block px-2 py-1 text-xs rounded-full 
                                            <?php echo e($pembayaran->status_pembayaran == 'lunas' ? 'bg-indigo-50 text-white-600' :
                            ($pembayaran->status_pembayaran == 'pending' ? 'bg-yellow-50 text-yellow-600' :
                                ($pembayaran->status_pembayaran == 'terlambat' ? 'bg-red-50 text-red-600' :
                                    'bg-gray-100 text-slate-500'))); ?>">
                                            <?php echo e(ucfirst($pembayaran->status_pembayaran)); ?>

                                        </span>
                                    </div>
                                </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-indigo-500/20 backdrop-blur-sm border border-indigo-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-credit-card text-white text-2xl"></i>
                        </div>
                        <p class="text-slate-100 mb-3">Belum ada pembayaran</p>
                        <?php if($kontrakAktif->count() > 0): ?>
                            <a href="<?php echo e(route('penghuni.pembayaran.create')); ?>"
                                class="text-indigo-500 hover:text-indigo-600 text-sm font-medium">
                                <i class="fas fa-credit-card mr-1"></i>
                                Bayar sekarang
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Kontrak Akan Berakhir -->
            <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-hourglass-end text-amber-500 mr-3"></i>
                        Kontrak Berakhir Segera
                    </h2>
                    <?php
                        $kontrakBerakhirSegera = $kontrakAktif->filter(function ($kontrak) {
                            return $kontrak->sisaHari <= 15 && !$kontrak->sudahBerakhir;
                        });
                    ?>
                    <?php if($kontrakBerakhirSegera->count() > 0): ?>
                        <span class="bg-amber-500/20 backdrop-blur-sm border border-amber-500/20 text-white px-3 py-1 rounded-full text-sm font-medium">
                            <?php echo e($kontrakBerakhirSegera->count()); ?> kontrak
                        </span>
                    <?php endif; ?>
                </div>

                <?php if($kontrakBerakhirSegera->count() > 0): ?>
                    <div class="space-y-4">
                        <?php $__currentLoopData = $kontrakBerakhirSegera->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kontrak): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-slate-800 mb-2"><?php echo e($kontrak->kos->nama_kos); ?></h3>
                                        <p class="text-sm text-slate-500 mb-2">Kamar <?php echo e($kontrak->kamar->nomor_kamar); ?></p>
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs text-slate-500">
                                                <i class="fas fa-calendar-day mr-1"></i>
                                                <?php echo e(\Carbon\Carbon::parse($kontrak->tanggal_selesai)->format('d M Y')); ?>

                                            </span>
                                            <span class="inline-block px-2 py-1 text-xs rounded-full bg-red-50 text-red-600">
                                                <?php echo e($kontrak->sisaHari); ?> hari lagi
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php if($kontrakBerakhirSegera->count() > 3): ?>
                            <div class="text-center pt-2">
                                <a href="<?php echo e(route('penghuni.kontrak.index')); ?>"
                                    class="inline-flex items-center text-amber-600 hover:text-amber-700 text-sm font-medium">
                                    Lihat semua <?php echo e($kontrakBerakhirSegera->count()); ?> kontrak
                                    <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-amber-500/20 backdrop-blur-sm border border-amber-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-check-circle text-white text-2xl"></i>
                        </div>
                        <p class="text-slate-100">Tidak ada kontrak yang akan berakhir</p>
                        <p class="text-sm text-slate-400">Semua kontrak masih memiliki waktu yang cukup</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Informasi Status -->
            <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
                <h2 class="text-xl font-bold text-white mb-6 flex items-center">
                    <i class="fas fa-info-circle text-sky-500 mr-3"></i>
                    Informasi Status
                </h2>

                <div class="space-y-4">
                    <!-- Status Card -->
                    <div class="bg-slate-900/50 backdrop-blur-sm border border-sky-900/50 rounded-xl p-4">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="font-semibold text-white">Status Saat Ini</h3>
                            <span class="px-3 py-1 rounded-full text-sm font-medium
                                <?php echo e($user->status_penghuni == 'aktif' ? 'bg-emerald-50 text-emerald-600' :
        ($user->status_penghuni == 'calon' ? 'bg-yellow-50 text-yellow-600' :
            'bg-red-50 text-red-600')); ?>">
                                <?php echo e(ucfirst($user->status_penghuni)); ?>

                            </span>
                        </div>
                        <p class="text-sm text-slate-400">
                            <?php if($user->status_penghuni == 'aktif'): ?>
                                Anda adalah penghuni aktif dengan <?php echo e($kontrakAktif->count()); ?> kontrak aktif.
                            <?php elseif($user->status_penghuni == 'calon'): ?>
                                Anda adalah calon penghuni. Segera lakukan pembayaran untuk mengaktifkan kontrak.
                            <?php else: ?>
                                Status penghuni Anda nonaktif. Hubungi admin untuk informasi lebih lanjut.
                            <?php endif; ?>
                        </p>
                    </div>

                    <!-- Kontak Bantuan -->
                    <div class="bg-sky-500/10 backdrop-blur-sm border border-sky-500/20 rounded-xl p-4">
                        <h3 class="font-semibold text-white mb-3 flex items-center">
                            <i class="fas fa-headset text-sky-500 mr-2"></i>
                            Kontak Bantuan
                        </h3>
                        <ul class="space-y-2 text-sm text-slate-400">
                            <li class="flex items-center">
                                <i class="fas fa-envelope w-4 mr-3 text-sky-500"></i>
                                <span>valorant270306@gmail.com</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-phone w-4 mr-3 text-sky-500"></i>
                                <span>082121730722</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-clock w-4 mr-3 text-sky-500"></i>
                                <span>08:00 - 17:00</span>
                            </li>
                        </ul>
                    </div>

                    <!-- CTA Button -->
                    <div class="text-center pt-2">
                        <a href="<?php echo e(route('public.kos.index')); ?>"
                            class="inline-flex items-center justify-center w-full py-3 bg-sky-500/20 backdrop-blur-sm border border-sky-500/20 hover:bg-sky-500/10 text-white rounded-xl transition-all duration-300">
                            <i class="fas fa-search mr-2"></i>
                            Cari Kos Lainnya
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Notification Modal -->


    <script>
        // Initialize tooltips if any
        document.addEventListener('DOMContentLoaded', function () {
            // Add any initialization code here
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/penghuni/dashboard.blade.php ENDPATH**/ ?>