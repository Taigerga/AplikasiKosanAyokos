 

<?php $__env->startSection('title', 'Dashboard Penghuni - AyoKos'); ?>

<?php $__env->startSection('content'); ?>
    <div class="p-4 md:p-6 lg:p-8 space-y-6 max-w-7xl mx-auto">
        <!-- Welcome Banner -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between">
                <div>
                    <h1 class="text-2xl md:text-3xl font-black text-black mb-2">
                        <i class="fas fa-home mr-3"></i>
                        Halo, <?php echo e($user->penghuni->nama); ?>!</h1>
                    <p class="text-gray-700 font-black">Kelola hunian dan aktivitas sewa Anda dengan mudah</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <span
                        class="inline-flex items-center px-3 py-1 text-xs font-black bg-sky-400 text-black border-2 border-black">
                        <i class="fas fa-user mr-2"></i>
                        Penghuni Kos
                    </span>
                </div>
            </div>
        </div>

        <?php if(session('success')): ?>
            <div class="bg-emerald-400 border-2 border-black text-black font-black px-4 py-3 shadow-[3px_3px_0px_#000]">
                <div class="flex items-center"><i class="fas fa-check-circle mr-3"></i><?php echo e(session('success')); ?></div>
            </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="bg-red-400 border-2 border-black text-black font-black px-4 py-3 shadow-[3px_3px_0px_#000]">
                <div class="flex items-center"><i class="fas fa-exclamation-circle mr-3"></i><?php echo e(session('error')); ?></div>
            </div>
        <?php endif; ?>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Kos Aktif Card -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 hover:shadow-[6px_6px_0px_#000] hover:-translate-y-1 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-black border-2 border-black flex items-center justify-center">
                        <i class="fas fa-home text-white text-xl"></i>
                    </div>
                    <span class="text-xs font-black px-2 py-1 border-2 border-black bg-yellow-400 text-black">
                        <?php echo e($kontrakAktif->count() > 0 ? '+' . $kontrakAktif->count() : '0'); ?>

                    </span>
                </div>
                <h3 class="text-2xl font-black text-black mb-1"><?php echo e($kontrakAktif->count()); ?></h3>
                <p class="text-sm text-gray-700 font-black">Kos Aktif</p>
            </div>

            <!-- Total Pembayaran Card -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 hover:shadow-[6px_6px_0px_#000] hover:-translate-y-1 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-black border-2 border-black flex items-center justify-center">
                        <i class="fas fa-wallet text-white text-xl"></i>
                    </div>
                    <span class="text-xs font-black px-2 py-1 border-2 border-black bg-yellow-400 text-black">
                        Total
                    </span>
                </div>
                <h3 class="text-2xl font-black text-black mb-1">Rp <?php echo e(number_format($totalPembayaran, 0, ',', '.')); ?></h3>
                <p class="text-sm text-gray-700 font-black">Total Pembayaran</p>
            </div>

            <!-- Status Penghuni Card -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 hover:shadow-[6px_6px_0px_#000] hover:-translate-y-1 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-black border-2 border-black flex items-center justify-center">
                        <i
                            class="fas 
                            <?php echo e($user->penghuni->status_penghuni == 'aktif' ? 'fa-check-circle' :
                            ($user->penghuni->status_penghuni == 'calon' ? 'fa-clock' : 'fa-times-circle')); ?> text-white text-xl"></i>
                    </div>
                    <span class="text-xs font-black px-2 py-1 border-2 border-black bg-yellow-400 text-black">
                        Status
                    </span>
                </div>
                <h3 class="text-2xl font-black text-black mb-1 capitalize"><?php echo e(ucfirst($user->penghuni->status_penghuni)); ?></h3>
                <p class="text-sm text-gray-700 font-black">Status Penghuni</p>
            </div>

            <!-- Kontrak Berakhir Card -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 hover:shadow-[6px_6px_0px_#000] hover:-translate-y-1 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-black border-2 border-black flex items-center justify-center">
                        <i class="fas fa-clock text-white text-xl"></i>
                    </div>
                    <?php
                        $berakhirSegera = $kontrakAktif->filter(function ($kontrak) {
                            return $kontrak->sisaHari <= 30 && !$kontrak->sudahBerakhir;
                        })->count();
                    ?>
                    <span class="text-xs font-black px-2 py-1 border-2 border-black bg-yellow-400 text-black">
                        <?php echo e($berakhirSegera > 0 ? 'Perhatian' : 'Aman'); ?>

                    </span>
                </div>
                <h3 class="text-2xl font-black text-black mb-1"><?php echo e($berakhirSegera); ?></h3>
                <p class="text-sm text-gray-700 font-black">Akan Berakhir</p>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <h2 class="text-xl font-black text-black mb-4 flex items-center">
                <i class="fas fa-bolt text-yellow-600 mr-3"></i>
                Aksi Cepat
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
                <a href="<?php echo e(route('public.kos.index')); ?>"
                    class="bg-sky-400 hover:bg-sky-500 text-black font-black text-center py-3 border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] hover:translate-y-[-1px] transition-all flex flex-col items-center justify-center uppercase tracking-wide text-sm">
                    <i class="fas fa-search text-lg mb-1"></i>
                    <span>Cari Kos</span>
                </a>
                <a href="<?php echo e(route('penghuni.kontrak.index')); ?>"
                    class="bg-emerald-400 hover:bg-emerald-500 text-black font-black text-center py-3 border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] hover:translate-y-[-1px] transition-all flex flex-col items-center justify-center uppercase tracking-wide text-sm">
                    <i class="fas fa-file-contract text-lg mb-1"></i>
                    <span>Kontrak Saya</span>
                </a>
                <a href="<?php echo e(route('penghuni.pembayaran.index')); ?>"
                    class="bg-purple-400 hover:bg-purple-500 text-black font-black text-center py-3 border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] hover:translate-y-[-1px] transition-all flex flex-col items-center justify-center uppercase tracking-wide text-sm">
                    <i class="fas fa-credit-card text-lg mb-1"></i>
                    <span>Pembayaran</span>
                </a>
                <a href="<?php echo e(route('penghuni.reviews.history')); ?>"
                    class="bg-yellow-400 hover:bg-yellow-500 text-black font-black text-center py-3 border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] hover:translate-y-[-1px] transition-all flex flex-col items-center justify-center uppercase tracking-wide text-sm">
                    <i class="fas fa-star text-lg mb-1"></i>
                    <span>Review Saya</span>
                </a>
                <a href="<?php echo e(route('penghuni.analisis.index')); ?>"
                    class="bg-pink-400 hover:bg-pink-500 text-black font-black text-center py-3 border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] hover:translate-y-[-1px] transition-all flex flex-col items-center justify-center uppercase tracking-wide text-sm">
                    <i class="fas fa-chart-bar text-lg mb-1"></i>
                    <span>Analisis Saya</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Kontrak Aktif Section -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-black text-black flex items-center">
                        <i class="fas fa-file-contract text-emerald-500 mr-3"></i>
                        Kontrak Aktif
                    </h2>
                    <?php if($kontrakAktif->count() > 0): ?>
                        <span class="bg-emerald-400 border-2 border-black shadow-[2px_2px_0px_#000] text-black px-3 py-1 text-sm font-black">
                            <?php echo e($kontrakAktif->count()); ?> aktif
                        </span>
                    <?php endif; ?>
                </div>

                <?php if($kontrakAktif->count() > 0): ?>
                    <div class="space-y-4">
                        <?php $__currentLoopData = $kontrakAktif->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kontrak): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div
                                    class="relative bg-gray-100 border-2 border-black p-4">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between mb-3">
                                                <h3 class="font-black text-black"><?php echo e($kontrak->kos->nama_kos); ?></h3>
                                                <span class="text-xs font-black px-2 py-1 border-2 border-black
                                                    <?php echo e($kontrak->statusWarna == 'green' ? 'bg-emerald-400 text-black' :
                            ($kontrak->statusWarna == 'yellow' ? 'bg-yellow-400 text-black' :
                                ($kontrak->statusWarna == 'red' ? 'bg-red-400 text-white' :
                                    'bg-gray-200 text-black'))); ?>">
                                                    <?php echo e($kontrak->statusText ?? ($kontrak->sudahBerakhir ? 'Berakhir' : 'Aktif')); ?>

                                                </span>
                                            </div>
                                            <p class="text-sm text-gray-700 mb-3">Kamar <?php echo e($kontrak->kamar->nomor_kamar); ?></p>

                                            
                                            <?php if($kontrak->persentaseAkhir !== null): ?>
                                            <div class="mb-3">
                                                <div class="flex justify-between text-xs text-gray-600 mb-1">
                                                    <span>Sisa waktu kontrak</span>
                                                    <span><?php echo e(round($kontrak->persentaseAkhir)); ?>%</span>
                                                </div>
                                            </div>
                                            <?php endif; ?>

                                            <div class="flex items-center justify-between text-sm">
                                                <span class="text-gray-600">
                                                    <?php if($kontrak->sisaHari !== null): ?>
                                                        <?php echo e($kontrak->sisaHari); ?> hari tersisa
                                                    <?php else: ?>
                                                        <?php echo e($kontrak->statusText); ?>

                                                    <?php endif; ?>
                                                </span>
                                                <span class="font-black text-black">
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
                                    class="inline-flex items-center text-emerald-600 hover:text-black font-black text-sm transition-colors">
                                    Lihat semua <?php echo e($kontrakAktif->count()); ?> kontrak
                                    <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-emerald-400 border-2 border-black shadow-[3px_3px_0px_#000]  flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-home text-black text-2xl"></i>
                        </div>
                        <p class="text-gray-700 font-black mb-3">Belum ada kontrak aktif</p>
                        <a href="<?php echo e(route('public.kos.index')); ?>"
                            class="text-emerald-500 hover:text-emerald-600 text-sm font-black">
                            <i class="fas fa-search mr-1"></i>
                            Cari kos sekarang
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Riwayat Pembayaran Section -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-black text-black flex items-center">
                        <i class="fas fa-history text-indigo-500 mr-3"></i>
                        Riwayat Pembayaran
                    </h2>
                    <?php if($pembayaranTerakhir->count() > 0): ?>
                        <a href="<?php echo e(route('penghuni.pembayaran.index')); ?>"
                            class="px-4 py-2 bg-purple-400 hover:bg-purple-500 text-black font-black text-sm border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all flex items-center uppercase tracking-wide">
                            Lihat Semua
                        </a>
                    <?php endif; ?>
                </div>

                <?php if($pembayaranTerakhir->count() > 0): ?>
                    <div class="space-y-4">
                        <?php $__currentLoopData = $pembayaranTerakhir->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pembayaran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div
                                    class="flex items-center justify-between relative bg-gray-100 border-2 border-black p-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 border-2 border-black flex items-center justify-center
                                            <?php echo e($pembayaran->status_pembayaran == 'lunas' ? 'bg-emerald-400' :
                            ($pembayaran->status_pembayaran == 'pending' ? 'bg-yellow-400' :
                                ($pembayaran->status_pembayaran == 'terlambat' ? 'bg-red-400' :
                                    'bg-gray-200'))); ?>">
                                            <i class="fas fa-<?php echo e($pembayaran->status_pembayaran == 'lunas' ? 'check' : 'clock'); ?> text-black"></i>
                                        </div>
                                        <div>
                                            <p class="font-black text-black"><?php echo e($pembayaran->kontrak->kos->nama_kos); ?></p>
                                            <p class="text-xs text-gray-600"><?php echo e($pembayaran->bulan_tahun); ?></p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-black text-black">Rp <?php echo e(number_format($pembayaran->jumlah, 0, ',', '.')); ?></p>
                                        <span class="inline-block px-2 py-1 text-xs font-black border-2 border-black
                                            <?php echo e($pembayaran->status_pembayaran == 'lunas' ? 'bg-emerald-400 text-black' :
                            ($pembayaran->status_pembayaran == 'pending' ? 'bg-yellow-400 text-black' :
                                ($pembayaran->status_pembayaran == 'terlambat' ? 'bg-red-400 text-white' :
                                    'bg-gray-200 text-black'))); ?>">
                                            <?php echo e(ucfirst($pembayaran->status_pembayaran)); ?>

                                        </span>
                                    </div>
                                </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-purple-400 border-2 border-black shadow-[2px_2px_0px_#000]  flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-credit-card text-black text-2xl"></i>
                        </div>
                        <p class="text-gray-700 font-black mb-3">Belum ada pembayaran</p>
                        <?php if($kontrakAktif->count() > 0): ?>
                            <a href="<?php echo e(route('penghuni.pembayaran.create')); ?>"
                                class="text-indigo-500 hover:text-indigo-600 text-sm font-black">
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
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-black text-black flex items-center">
                        <i class="fas fa-hourglass-end text-amber-500 mr-3"></i>
                        Kontrak Berakhir Segera
                    </h2>
                    <?php
                        $kontrakBerakhirSegera = $kontrakAktif->filter(function ($kontrak) {
                            return $kontrak->sisaHari <= 15 && !$kontrak->sudahBerakhir;
                        });
                    ?>
                    <?php if($kontrakBerakhirSegera->count() > 0): ?>
                        <span class="bg-yellow-400 border-2 border-black shadow-[2px_2px_0px_#000] text-black px-3 py-1 text-sm font-black">
                            <?php echo e($kontrakBerakhirSegera->count()); ?> kontrak
                        </span>
                    <?php endif; ?>
                </div>

                <?php if($kontrakBerakhirSegera->count() > 0): ?>
                    <div class="space-y-4">
                        <?php $__currentLoopData = $kontrakBerakhirSegera->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kontrak): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="bg-yellow-100 border-2 border-black p-4">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <h3 class="font-black text-black mb-2"><?php echo e($kontrak->kos->nama_kos); ?></h3>
                                        <p class="text-sm text-gray-600 mb-2">Kamar <?php echo e($kontrak->kamar->nomor_kamar); ?></p>
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs text-gray-600">
                                                <i class="fas fa-calendar-day mr-1"></i>
                                                <?php echo e(\Carbon\Carbon::parse($kontrak->tanggal_selesai)->format('d M Y')); ?>

                                            </span>
                                            <span class="inline-block px-2 py-1 text-xs font-black border-2 border-black bg-red-400 text-white">
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
                                    class="inline-flex items-center text-amber-600 hover:text-amber-700 text-sm font-black">
                                    Lihat semua <?php echo e($kontrakBerakhirSegera->count()); ?> kontrak
                                    <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-yellow-400 border-2 border-black shadow-[2px_2px_0px_#000]  flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-check-circle text-black text-2xl"></i>
                        </div>
                        <p class="text-gray-700 font-black">Tidak ada kontrak yang akan berakhir</p>
                        <p class="text-sm text-gray-600">Semua kontrak masih memiliki waktu yang cukup</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Informasi Status -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h2 class="text-xl font-black text-black mb-6 flex items-center">
                    <i class="fas fa-info-circle text-sky-500 mr-3"></i>
                    Informasi Status
                </h2>

                <div class="space-y-4">
                    <!-- Status Card -->
                    <div class="bg-gray-100 border-2 border-black p-4">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="font-black text-black">Status Saat Ini</h3>
                            <span class="px-3 py-1 text-sm font-black border-2 border-black
                                <?php echo e($user->status_penghuni == 'aktif' ? 'bg-emerald-400 text-black' :
        ($user->status_penghuni == 'calon' ? 'bg-yellow-400 text-black' :
            'bg-red-400 text-white')); ?>">
                                <?php echo e(ucfirst($user->status_penghuni)); ?>

                            </span>
                        </div>
                        <p class="text-sm text-gray-600">
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
                    <div class="bg-sky-100 border-2 border-black p-4">
                        <h3 class="font-black text-black mb-3 flex items-center">
                            <i class="fas fa-headset text-sky-500 mr-2"></i>
                            Kontak Bantuan
                        </h3>
                        <ul class="space-y-2 text-sm text-gray-600">
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
                            class="inline-flex items-center justify-center w-full py-3 bg-sky-400 hover:bg-sky-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] hover:translate-y-[-1px] transition-all uppercase tracking-wide">
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