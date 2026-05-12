<?php $__env->startSection('title', 'Dashboard Pemilik - AyoKos'); ?>

<?php $__env->startSection('content'); ?>
    <div class="p-4 md:p-6 lg:p-8 space-y-6 max-w-7xl mx-auto">
        <!-- Welcome Banner -->
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-white mb-2">
                        <i class="fas fa-home mr-3"></i>
                        Selamat datang, <?php echo e($user->pemilik->nama); ?>! 👋</h1>
                    <p class="text-slate-100">Kelola properti kos Anda dengan mudah dan efisien</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-50 text-blue-600 border border-blue-200">
                        <i class="fas fa-user-tie mr-2"></i>
                        Pemilik Kos
                    </span>
                </div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Total Kos Card -->
            <div class="card-hover bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 rounded-lg bg-white/5 backdrop-blur-sm">
                        <i class="fas fa-home text-white text-xl"></i>
                    </div>
                    <span class="text-sm font-medium px-2 py-1 rounded-full bg-white/5 backdrop-blur-sm text-white">
                        <?php echo e($statistics['total_kos'] > 0 ? '+' . $statistics['total_kos'] : '0'); ?>

                    </span>
                </div>
                <h3 class="text-2xl font-bold text-white mb-1"><?php echo e($statistics['total_kos']); ?></h3>
                <p class="text-sm text-slate-100">Total Kos</p>
            </div>

            <!-- Total Kamar Card -->
            <div class="card-hover bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 rounded-lg bg-white/5 backdrop-blur-sm">
                        <i class="fas fa-bed text-white text-xl"></i>
                    </div>
                    <span class="text-sm font-medium px-2 py-1 rounded-full bg-white/5 backdrop-blur-sm text-white">
                        <?php echo e($statistics['total_kamar'] > 0 ? '+' . $statistics['total_kamar'] : '0'); ?>

                    </span>
                </div>
                <h3 class="text-2xl font-bold text-white mb-1"><?php echo e($statistics['total_kamar']); ?></h3>
                <p class="text-sm text-slate-100">Total Kamar</p>
            </div>

            <!-- Kamar Tersedia Card -->
            <div class="card-hover bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 rounded-lg bg-white/5 backdrop-blur-sm">
                        <i class="fas fa-door-open text-white text-xl"></i>
                    </div>
                    <span class="text-sm font-medium px-2 py-1 rounded-full bg-white/5 backdrop-blur-sm text-white">
                        <?php echo e($statistics['kamar_tersedia'] > 0 ? '+' . $statistics['kamar_tersedia'] : '0'); ?>

                    </span>
                </div>
                <h3 class="text-2xl font-bold text-white mb-1"><?php echo e($statistics['kamar_tersedia']); ?></h3>
                <p class="text-sm text-slate-100">Kamar Tersedia</p>
            </div>

            <!-- Pendapatan Bulan Ini Card -->
            <div class="card-hover bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 rounded-lg bg-white/5 backdrop-blur-sm">
                        <i class="fas fa-wallet text-white text-xl"></i>
                    </div>
                    <span class="text-sm font-medium px-2 py-1 rounded-full bg-white/5 backdrop-blur-sm text-white">
                        Bulan Ini
                    </span>
                </div>
                <h3 class="text-2xl font-bold text-white mb-1">Rp <?php echo e(number_format($pendapatanBulanIni, 0, ',', '.')); ?></h3>
                <p class="text-sm text-slate-100">Pendapatan Bulan Ini</p>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
            <h2 class="text-xl font-bold text-white mb-4 flex items-center">
                <i class="fas fa-bolt text-yellow-600 mr-3"></i>
                Aksi Cepat
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
                <a href="<?php echo e(route('pemilik.kos.index')); ?>"
                    class="bg-sky-500/20 backdrop-blur-sm border border-sky-500/20 hover:bg-sky-500/10 text-white text-center py-3 rounded-xl transition-all duration-300 flex flex-col items-center justify-center">
                    <i class="fas fa-home text-lg mb-1"></i>
                    <span class="text-sm font-medium">Kelola Kos</span>
                </a>
                <a href="<?php echo e(route('pemilik.kamar.index')); ?>"
                    class="bg-emerald-500/20 backdrop-blur-sm border border-emerald-500/20 hover:bg-emerald-500/10 text-white text-center py-3 rounded-xl transition-all duration-300 flex flex-col items-center justify-center">
                    <i class="fas fa-bed text-lg mb-1"></i>
                    <span class="text-sm font-medium">Kelola Kamar</span>
                </a>
                <a href="<?php echo e(route('pemilik.kontrak.index')); ?>"
                    class="bg-amber-500/20 backdrop-blur-sm border border-amber-500/20 hover:bg-amber-500/10 text-white text-center py-3 rounded-xl transition-all duration-300 flex flex-col items-center justify-center">
                    <i class="fas fa-file-contract text-lg mb-1"></i>
                    <span class="text-sm font-medium">Kelola Kontrak</span>
                </a>
                <a href="<?php echo e(route('pemilik.pembayaran.index')); ?>"
                    class="bg-indigo-500/20 backdrop-blur-sm border border-indigo-500/20 hover:bg-indigo-500/10 text-white text-center py-3 rounded-xl transition-all duration-300 flex flex-col items-center justify-center">
                    <i class="fas fa-credit-card text-lg mb-1"></i>
                    <span class="text-sm font-medium">Pembayaran</span>
                </a>
                <a href="<?php echo e(route('pemilik.analisis.index')); ?>"
                    class="bg-blue-500/20 backdrop-blur-sm border border-blue-500/20 hover:bg-blue-500/10 text-white text-center py-3 rounded-xl transition-all duration-300 flex flex-col items-center justify-center">
                    <i class="fas fa-chart-bar text-lg mb-1"></i>
                    <span class="text-sm font-medium">Analisis Data</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Kos Saya Section -->
            <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-building text-sky-500 mr-3"></i>
                        Kos Saya
                    </h2>
                    <a href="<?php echo e(route('pemilik.kos.create')); ?>"
                        class="px-4 py-2 bg-sky-500/20 backdrop-blur-sm border border-sky-500/20 hover:bg-sky-500/10 text-white rounded-lg text-sm font-medium transition flex items-center">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah
                    </a>
                </div>

                <?php if($kos->count() > 0): ?>
                    <div class="space-y-4">
                    <?php $__currentLoopData = $kos->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="relative bg-slate-900/50 backdrop-blur-sm border border-sky-900/50 rounded-xl p-4 hover:border-sky-500 transition-all duration-300">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-2">
                                        <h3 class="font-semibold text-white"><?php echo e($k->nama_kos); ?></h3>
                                    </div>
                                    <p class="text-sm text-white mb-3"><?php echo e($k->alamat); ?></p>
                                    <div class="flex items-center space-x-4 text-xs">
                                        <span class="flex items-center text-slate-400">
                                            <i class="fas fa-bed mr-1"></i>
                                            <?php echo e($k->kamar_count); ?> Kamar
                                        </span>
                                        <span class="flex items-center text-slate-400">
                                            <i class="fas fa-users mr-1"></i>
                                            <?php echo e($k->jenis_kos); ?>

                                        </span>
                                    </div>
                                </div>
                                <div class="flex space-x-2 ml-4">
                                    <a href="<?php echo e(route('pemilik.kos.show', $k->id_kos)); ?>"
                                    class="p-2 text-sky-600 hover:text-sky-700 hover:bg-sky-50 rounded-lg transition">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="<?php echo e(route('pemilik.kos.edit', $k->id_kos)); ?>"
                                    class="p-2 text-sky-600 hover:text-sky-700 hover:bg-sky-50 rounded-lg transition">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </div>

                            <span class="absolute bottom-3 right-3 text-xs px-2 py-1 rounded-full
                                <?php echo e($k->status_kos == 'aktif' ? 'bg-sky-500/20 backdrop-blur-sm border border-sky-500/20 text-white' :
                                ($k->status_kos == 'nonaktif' ? 'bg-yellow-500/20 backdrop-blur-sm border border-yellow-500/20 text-white' :
                                    'bg-red-500/20 backdrop-blur-sm border border-red-500/20 text-white')); ?>">
                                <?php echo e(ucfirst($k->status_kos)); ?>

                            </span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php if($kos->count() > 3): ?>
                            <div class="text-center pt-2">
                                <a href="<?php echo e(route('pemilik.kos.index')); ?>"
                                    class="inline-flex items-center text-blue-600 hover:text-blue-700 text-sm font-medium">
                                    Lihat semua <?php echo e($kos->count()); ?> kos
                                    <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-sky-500/20 backdrop-blur-sm border border-sky-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-home text-white text-2xl"></i>
                        </div>
                        <p class="text-slate-100 mb-3">Belum ada kos terdaftar</p>
                        <a href="<?php echo e(route('pemilik.kos.create')); ?>"
                            class="text-sky-500 hover:text-sky-600 text-sm font-medium">
                            <i class="fas fa-plus mr-1"></i>
                            Tambah kos pertama Anda
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Kamar Terbaru Section -->
            <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-door-closed text-emerald-500 mr-3"></i>
                        Kamar Terbaru
                    </h2>
                    <a href="<?php echo e(route('pemilik.kamar.create')); ?>"
                        class="px-4 py-2 bg-emerald-500/20 backdrop-blur-sm border border-emerald-500/20 hover:bg-emerald-500/10 text-white rounded-lg text-sm font-medium transition flex items-center">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah
                    </a>
                </div>

                <?php if($kamar->count() > 0): ?>
                    <div class="space-y-4">
                        <?php $__currentLoopData = $kamar->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $km): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div
                                    class="relative bg-slate-900/50 backdrop-blur-sm border border-emerald-900/50 rounded-xl p-4 hover:border-sky-500 transition-all duration-300">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between mb-2">
                                                <h3 class="font-semibold text-white">Kamar <?php echo e($km->nomor_kamar); ?></h3>
                                                <span class="text-xs px-2 py-1 rounded-full 
                                                    <?php echo e($km->status_kamar == 'tersedia' ? 'bg-emerald-50 text-emerald-600' :
                            ($km->status_kamar == 'terisi' ? 'bg-red-50 text-red-600' :
                                'bg-yellow-50 text-yellow-600')); ?>">
                                                    <?php echo e(ucfirst($km->status_kamar)); ?>

                                                </span>
                                            </div>
                                            <p class="text-sm text-slate-200 mb-2"><?php echo e($km->kos->nama_kos); ?></p>
                                            <div class="flex items-center justify-between">
                                                <span class="text-sm text-slate-400">
                                                    <?php echo e($km->tipe_kamar); ?>

                                                </span>
                                                <span class="text-sm font-bold text-white">
                                                    Rp <?php echo e(number_format($km->harga, 0, ',', '.')); ?>

                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php if($kamar->count() > 3): ?>
                            <div class="text-center pt-2">
                                <a href="<?php echo e(route('pemilik.kamar.index')); ?>"
                                    class="inline-flex items-center text-green-600 hover:text-green-700 text-sm font-medium">
                                    Lihat semua <?php echo e($kamar->count()); ?> kamar
                                    <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-emerald-500/20 backdrop-blur-sm border border-emerald-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-bed text-white text-2xl"></i>
                        </div>
                        <p class="text-slate-100 mb-3">Belum ada kamar terdaftar</p>
                        <a href="<?php echo e(route('pemilik.kamar.create')); ?>"
                            class="text-emerald-500 hover:text-emerald-600 text-sm font-medium">
                            <i class="fas fa-plus mr-1"></i>
                            Tambah kamar pertama
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Permohonan Pending -->
            <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-clock text-amber-500 mr-3"></i>
                        Permohonan Pending
                    </h2>
                    <span class="bg-amber-500/20 backdrop-blur-sm border border-amber-500/20 text-white px-3 py-1 rounded-full text-sm font-medium">
                        <?php echo e($kontrakPending->count()); ?> menunggu
                    </span>
                </div>

                <?php if($kontrakPending->count() > 0): ?>
                    <div class="space-y-4">
                        <?php $__currentLoopData = $kontrakPending->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kontrak): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between mb-2">
                                            <h3 class="font-semibold text-slate-800"><?php echo e($kontrak->penghuni->nama); ?></h3>
                                            <span class="text-xs text-slate-500">
                                                <?php echo e($kontrak->created_at->format('d M Y')); ?>

                                            </span>
                                        </div>
                                        <p class="text-sm text-slate-500 mb-3">
                                            <?php echo e($kontrak->kos->nama_kos); ?> - Kamar <?php echo e($kontrak->kamar->nomor_kamar); ?>

                                        </p>
                                        <div class="flex space-x-2">
                                            <button onclick="showApproveModal('<?php echo e(route('pemilik.kontrak.approve', $kontrak->id_kontrak)); ?>', '<?php echo e($kontrak->penghuni->nama ?? 'Penghuni'); ?>')"
                                                    class="px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm font-medium transition">
                                                <i class="fas fa-check mr-1"></i>
                                                Setujui
                                            </button>
                                            <button
                                                onclick="showRejectModal(<?php echo e($kontrak->id_kontrak); ?>, '<?php echo e($kontrak->penghuni->nama ?? 'Penghuni'); ?>')"
                                                class="px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition">
                                                <i class="fas fa-times mr-1"></i>
                                                Tolak
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php if($kontrakPending->count() > 3): ?>
                            <div class="text-center pt-2">
                                <a href="<?php echo e(route('pemilik.kontrak.index')); ?>"
                                    class="inline-flex items-center text-yellow-600 hover:text-yellow-700 text-sm font-medium">
                                    Lihat semua <?php echo e($kontrakPending->count()); ?> permohonan
                                    <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-yellow-500/20 backdrop-blur-sm border border-yellow-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-check-circle text-white text-2xl"></i>
                        </div>
                        <p class="text-slate-100">Tidak ada permohonan pending</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Pembayaran Terbaru -->
            <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
                <h2 class="text-xl font-bold text-white mb-6 flex items-center">
                    <i class="fas fa-credit-card text-indigo-500 mr-3"></i>
                    Pembayaran Terbaru
                </h2>

                <?php if($pembayaranTerbaru->count() > 0): ?>
                    <div class="space-y-4">
                        <?php $__currentLoopData = $pembayaranTerbaru->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pembayaran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div
                                    class="flex items-center justify-between border-b border-slate-200 pb-4 last:border-b-0 last:pb-0">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 rounded-full 
                                            <?php echo e($pembayaran->status_pembayaran == 'lunas' ? 'bg-green-50' :
                            ($pembayaran->status_pembayaran == 'pending' ? 'bg-yellow-50' :
                                ($pembayaran->status_pembayaran == 'terlambat' ? 'bg-red-50' :
                                    'bg-gray-100'))); ?> flex items-center justify-center">
                                            <i class="fas fa-<?php echo e($pembayaran->status_pembayaran == 'lunas' ? 'check' : 'clock'); ?> 
                                                <?php echo e($pembayaran->status_pembayaran == 'lunas' ? 'text-green-600' :
                            ($pembayaran->status_pembayaran == 'pending' ? 'text-yellow-600' :
                                ($pembayaran->status_pembayaran == 'terlambat' ? 'text-red-600' :
                                    'text-slate-500'))); ?>"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-slate-800"><?php echo e($pembayaran->penghuni->nama); ?></p>
                                            <p class="text-xs text-slate-500"><?php echo e($pembayaran->kontrak->kos->nama_kos); ?></p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-bold text-slate-800">Rp <?php echo e(number_format($pembayaran->jumlah, 0, ',', '.')); ?></p>
                                        <span class="inline-block px-2 py-1 text-xs rounded-full 
                                            <?php echo e($pembayaran->status_pembayaran == 'lunas' ? 'bg-green-50 text-green-600' :
                            ($pembayaran->status_pembayaran == 'pending' ? 'bg-yellow-50 text-yellow-600' :
                                ($pembayaran->status_pembayaran == 'terlambat' ? 'bg-red-50 text-red-600' :
                                    'bg-gray-100 text-slate-500'))); ?>">
                                            <?php echo e(ucfirst($pembayaran->status_pembayaran)); ?>

                                        </span>
                                    </div>
                                </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php if($pembayaranTerbaru->count() > 5): ?>
                            <div class="text-center pt-4">
                                <a href="<?php echo e(route('pemilik.pembayaran.index')); ?>"
                                    class="inline-flex items-center text-purple-600 hover:text-purple-700 text-sm font-medium">
                                    Lihat semua pembayaran
                                    <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-indigo-500/20 backdrop-blur-sm border border-indigo-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-credit-card text-white text-2xl"></i>
                        </div>
                        <p class="text-slate-100">Belum ada pembayaran</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Success Notification Modal -->


    <!-- Reject Modal -->
    <div id="rejectModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border border-slate-200 w-96 shadow-2xl rounded-2xl bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                    <i class="fas fa-times-circle text-red-600 mr-2"></i>
                    Tolak Permohonan Kontrak
                </h3>
                <p class="text-sm text-slate-500 mb-4" id="rejectUserName">
                    Alasan penolakan untuk: <span class="text-slate-800 font-medium"></span>
                </p>
                
                <form method="POST" action="" id="rejectForm">
                    <?php echo csrf_field(); ?>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-slate-800 mb-2">Alasan Penolakan *</label>
                        <textarea name="alasan_ditolak" 
                                  class="w-full px-3 py-2 bg-slate-100 border border-slate-200 text-slate-700 rounded-lg focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-500/30"
                                  rows="4" 
                                  placeholder="Berikan alasan penolakan yang jelas..."
                                  required></textarea>
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <button type="button" 
                                onclick="closeRejectModal()"
                                class="px-4 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition">
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

    <!-- Approve Modal -->
    <div id="approveModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border border-slate-200 w-96 shadow-2xl rounded-2xl bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                    <i class="fas fa-check-circle text-green-600 mr-2"></i>
                    Setujui Permohonan Kontrak
                </h3>
                <p class="text-sm text-slate-500 mb-4" id="approveUserName">
                    Konfirmasi persetujuan untuk: <span class="text-slate-800 font-medium"></span>
                </p>
                
                <form method="POST" action="" id="approveForm">
                    <?php echo csrf_field(); ?>
                    
                    <p class="text-sm text-slate-500 mb-6">
                        Apakah Anda yakin ingin menyetujui kontrak ini? Status kamar akan berubah menjadi terisi dan kontrak akan aktif.
                    </p>
                    
                    <div class="flex justify-end space-x-3">
                        <button type="button" 
                                onclick="closeApproveModal()"
                                class="px-4 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition">
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
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/pemilik/dashboard.blade.php ENDPATH**/ ?>