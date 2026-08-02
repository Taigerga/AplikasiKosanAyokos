<?php $__env->startSection('title', 'Dashboard Pemilik - AyoKos'); ?>

<?php $__env->startSection('content'); ?>
    <div class="p-4 md:p-6 lg:p-8 space-y-6 max-w-7xl mx-auto">
        <!-- Auto Refresh Indicator -->
        <div id="auto-refresh-indicator" data-refresh-interval="60" class="flex items-center justify-end gap-2 text-xs text-gray-500 font-medium">
            <i class="fas fa-sync-alt text-gray-400"></i>
            <span>Terakhir diperbarui: <span data-refresh-time></span></span>
            <button data-refresh-btn class="ml-2 px-2 py-1 bg-gray-100 border border-gray-300 rounded text-xs hover:bg-gray-200 transition-colors">
                <i class="fas fa-redo-alt mr-1"></i>Refresh
            </button>
        </div>
        <!-- Welcome Banner -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between">
                <div>
                    <h1 class="text-2xl md:text-3xl font-black text-black mb-2">
                        <i class="fas fa-home mr-3"></i>
                        Selamat datang, <?php echo e($user->pemilik->nama); ?>!</h1>
                    <p class="text-gray-700 font-bold">Kelola properti kos Anda dengan mudah dan efisien</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <span class="inline-flex items-center px-3 py-1 text-xs font-black bg-sky-400 text-black border-2 border-black">
                        <i class="fas fa-user-tie mr-2"></i>
                        Pemilik Kos
                    </span>
                </div>
            </div>
        </div>

        <?php if(session('success')): ?>
            <div class="bg-emerald-400 border-2 border-black text-black font-bold px-4 py-3 shadow-[3px_3px_0px_#000]">
                <div class="flex items-center"><i class="fas fa-check-circle mr-3"></i><?php echo e(session('success')); ?></div>
            </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="bg-red-400 border-2 border-black text-black font-bold px-4 py-3 shadow-[3px_3px_0px_#000]">
                <div class="flex items-center"><i class="fas fa-exclamation-circle mr-3"></i><?php echo e(session('error')); ?></div>
            </div>
        <?php endif; ?>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 hover:shadow-[6px_6px_0px_#000] hover:-translate-y-1 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-sky-400 border-2 border-black flex items-center justify-center">
                        <i class="fas fa-home text-black text-xl"></i>
                    </div>
                    <span class="text-xs font-black px-2 py-1 border-2 border-black bg-yellow-400 text-black">
                        <?php echo e($statistics['total_kos'] > 0 ? '+' . $statistics['total_kos'] : '0'); ?>

                    </span>
                </div>
                <h3 class="text-2xl font-black text-black mb-1"><?php echo e($statistics['total_kos']); ?></h3>
                <p class="text-sm font-bold text-gray-600">Total Kos</p>
            </div>

            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 hover:shadow-[6px_6px_0px_#000] hover:-translate-y-1 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-emerald-400 border-2 border-black flex items-center justify-center">
                        <i class="fas fa-bed text-black text-xl"></i>
                    </div>
                    <span class="text-xs font-black px-2 py-1 border-2 border-black bg-yellow-400 text-black">
                        <?php echo e($statistics['total_kamar'] > 0 ? '+' . $statistics['total_kamar'] : '0'); ?>

                    </span>
                </div>
                <h3 class="text-2xl font-black text-black mb-1"><?php echo e($statistics['total_kamar']); ?></h3>
                <p class="text-sm font-bold text-gray-600">Total Kamar</p>
            </div>

            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 hover:shadow-[6px_6px_0px_#000] hover:-translate-y-1 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-green-400 border-2 border-black flex items-center justify-center">
                        <i class="fas fa-door-open text-black text-xl"></i>
                    </div>
                    <span class="text-xs font-black px-2 py-1 border-2 border-black bg-yellow-400 text-black">
                        <?php echo e($statistics['kamar_tersedia'] > 0 ? '+' . $statistics['kamar_tersedia'] : '0'); ?>

                    </span>
                </div>
                <h3 class="text-2xl font-black text-black mb-1"><?php echo e($statistics['kamar_tersedia']); ?></h3>
                <p class="text-sm font-bold text-gray-600">Kamar Tersedia</p>
            </div>

            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 hover:shadow-[6px_6px_0px_#000] hover:-translate-y-1 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-purple-400 border-2 border-black flex items-center justify-center">
                        <i class="fas fa-wallet text-black text-xl"></i>
                    </div>
                    <span class="text-xs font-black px-2 py-1 border-2 border-black bg-yellow-400 text-black">
                        Bulan Ini
                    </span>
                </div>
                <h3 class="text-2xl font-black text-black mb-1">Rp <?php echo e(number_format($pendapatanBulanIni, 0, ',', '.')); ?></h3>
                <p class="text-sm font-bold text-gray-600">Pendapatan Bulan Ini</p>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <h2 class="text-xl font-black text-black mb-4 flex items-center">
                <i class="fas fa-bolt text-yellow-500 mr-3"></i>
                Aksi Cepat
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-3">
                <a href="<?php echo e(route('pemilik.kos.index')); ?>"
                    class="bg-sky-400 hover:bg-sky-500 text-black font-black text-center py-3 border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] hover:translate-y-[-1px] transition-all flex flex-col items-center justify-center uppercase tracking-wide text-sm">
                    <i class="fas fa-home text-lg mb-1"></i>
                    <span class="truncate max-w-full px-1">Kelola Kos</span>
                </a>
                <a href="<?php echo e(route('pemilik.kamar.index')); ?>"
                    class="bg-emerald-400 hover:bg-emerald-500 text-black font-black text-center py-3 border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] hover:translate-y-[-1px] transition-all flex flex-col items-center justify-center uppercase tracking-wide text-sm">
                    <i class="fas fa-bed text-lg mb-1"></i>
                    <span class="truncate max-w-full px-1">Kelola Kamar</span>
                </a>
                <a href="<?php echo e(route('pemilik.kontrak.index')); ?>"
                    class="bg-yellow-400 hover:bg-yellow-500 text-black font-black text-center py-3 border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] hover:translate-y-[-1px] transition-all flex flex-col items-center justify-center uppercase tracking-wide text-sm">
                    <i class="fas fa-file-contract text-lg mb-1"></i>
                    <span class="truncate max-w-full px-1">Kelola Kontrak</span>
                </a>
                <a href="<?php echo e(route('pemilik.pembayaran.index')); ?>"
                    class="bg-purple-400 hover:bg-purple-500 text-black font-black text-center py-3 border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] hover:translate-y-[-1px] transition-all flex flex-col items-center justify-center uppercase tracking-wide text-sm">
                    <i class="fas fa-credit-card text-lg mb-1"></i>
                    <span class="truncate max-w-full px-1">Pembayaran</span>
                </a>
                <a href="<?php echo e(route('pemilik.analisis.index')); ?>"
                    class="bg-pink-400 hover:bg-pink-500 text-black font-black text-center py-3 border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] hover:translate-y-[-1px] transition-all flex flex-col items-center justify-center uppercase tracking-wide text-sm">
                    <i class="fas fa-chart-bar text-lg mb-1"></i>
                    <span class="truncate max-w-full px-1">Analisis Data</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Kos Saya Section -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-black text-black flex items-center">
                        <i class="fas fa-building text-sky-500 mr-3"></i>
                        Kos Saya
                    </h2>
                    <a href="<?php echo e(route('pemilik.kos.create')); ?>"
                        class="px-4 py-2 bg-lime-400 hover:bg-lime-500 text-black font-black text-sm border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all flex items-center uppercase tracking-wide">
                        <i class="fas fa-plus mr-2"></i> Tambah
                    </a>
                </div>

                <?php if($kos->count() > 0): ?>
                    <div class="space-y-4">
                    <?php $__currentLoopData = $kos->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-gray-100 border-2 border-black p-4">
                            <div class="flex items-start justify-between">
                                <div class="flex-1 overflow-hidden">
                                    <div class="flex items-center justify-between mb-2">
                                        <h3 class="font-black text-black truncate"><?php echo e($k->nama_kos); ?></h3>
                                    </div>
                                    <p class="text-sm font-bold text-gray-700 mb-3 truncate"><?php echo e($k->alamat); ?></p>
                                    <div class="flex items-center gap-4 flex-wrap text-xs font-bold text-gray-500">
                                        <span class="flex items-center"><i class="fas fa-bed mr-1"></i> <?php echo e($k->kamar_count); ?> Kamar</span>
                                        <span class="flex items-center"><i class="fas fa-users mr-1"></i> <?php echo e($k->jenis_kos); ?></span>
                                    </div>
                                </div>
                                <div class="flex gap-2 ml-4 shrink-0">
                                    <a href="<?php echo e(route('pemilik.kos.show', $k->id_kos)); ?>"
                                    class="p-2 text-gray-600 hover:text-black hover:bg-yellow-200 border-2 border-transparent hover:border-black transition">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="<?php echo e(route('pemilik.kos.edit', $k->id_kos)); ?>"
                                    class="p-2 text-gray-600 hover:text-black hover:bg-yellow-200 border-2 border-transparent hover:border-black transition">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </div>

                            <span class="inline-block mt-2 text-xs font-black px-2 py-1 border-2 border-black
                                <?php echo e($k->status_kos == 'aktif' ? 'bg-emerald-400 text-black' :
                                ($k->status_kos == 'nonaktif' ? 'bg-yellow-400 text-black' :
                                    'bg-red-400 text-black')); ?>">
                                <?php echo e(ucfirst($k->status_kos)); ?>

                            </span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php if($kos->count() > 3): ?>
                            <div class="text-center pt-2">
                                <a href="<?php echo e(route('pemilik.kos.index')); ?>"
                                    class="inline-flex items-center text-sky-600 hover:text-black font-black text-sm transition-colors">
                                    Lihat semua <?php echo e($kos->count()); ?> kos <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-gray-200 border-2 border-black flex items-center justify-center mx-auto mb-4 shadow-[2px_2px_0px_#000]">
                            <i class="fas fa-home text-gray-500 text-2xl"></i>
                        </div>
                        <p class="text-gray-700 font-bold mb-3">Belum ada kos terdaftar</p>
                        <a href="<?php echo e(route('pemilik.kos.create')); ?>"
                            class="text-lime-600 hover:text-black font-black text-sm">
                            <i class="fas fa-plus mr-1"></i> Tambah kos pertama Anda
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Kamar Terbaru Section -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-black text-black flex items-center">
                        <i class="fas fa-door-closed text-emerald-500 mr-3"></i>
                        Kamar Terbaru
                    </h2>
                    <a href="<?php echo e(route('pemilik.kamar.create')); ?>"
                        class="px-4 py-2 bg-lime-400 hover:bg-lime-500 text-black font-black text-sm border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all flex items-center uppercase tracking-wide">
                        <i class="fas fa-plus mr-2"></i> Tambah
                    </a>
                </div>

                <?php if($kamar->count() > 0): ?>
                    <div class="space-y-4">
                        <?php $__currentLoopData = $kamar->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $km): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="bg-gray-100 border-2 border-black p-4">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between mb-2 gap-2">
                                            <h3 class="font-black text-black truncate">Kamar <?php echo e($km->nomor_kamar); ?></h3>
                                            <span class="text-xs font-black px-2 py-1 border-2 border-black shrink-0
                                                <?php echo e($km->status_kamar == 'tersedia' ? 'bg-emerald-400 text-black' :
                                                ($km->status_kamar == 'terisi' ? 'bg-red-400 text-black' :
                                                    'bg-yellow-400 text-black')); ?>">
                                                <?php echo e(ucfirst($km->status_kamar)); ?>

                                            </span>
                                        </div>
                                        <p class="text-sm font-bold text-gray-700 mb-2 truncate"><?php echo e($km->kos->nama_kos); ?></p>
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm font-bold text-gray-500"><?php echo e($km->tipe_kamar); ?></span>
                                            <span class="text-sm font-black text-black">Rp <?php echo e(number_format($km->harga, 0, ',', '.')); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php if($kamar->count() > 3): ?>
                            <div class="text-center pt-2">
                                <a href="<?php echo e(route('pemilik.kamar.index')); ?>"
                                    class="inline-flex items-center text-emerald-600 hover:text-black font-black text-sm transition-colors">
                                    Lihat semua <?php echo e($kamar->count()); ?> kamar <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-gray-200 border-2 border-black flex items-center justify-center mx-auto mb-4 shadow-[2px_2px_0px_#000]">
                            <i class="fas fa-bed text-gray-500 text-2xl"></i>
                        </div>
                        <p class="text-gray-700 font-bold mb-3">Belum ada kamar terdaftar</p>
                        <a href="<?php echo e(route('pemilik.kamar.create')); ?>"
                            class="text-lime-600 hover:text-black font-black text-sm">
                            <i class="fas fa-plus mr-1"></i> Tambah kamar pertama
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Permohonan Pending -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-black text-black flex items-center">
                        <i class="fas fa-clock text-yellow-500 mr-3"></i>
                        Permohonan Pending
                    </h2>
                    <span class="text-xs font-black px-3 py-1 border-2 border-black bg-yellow-400 text-black">
                        <?php echo e($kontrakPending->count()); ?> menunggu
                    </span>
                </div>

                <?php if($kontrakPending->count() > 0): ?>
                    <div class="space-y-4">
                        <?php $__currentLoopData = $kontrakPending->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kontrak): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="bg-yellow-100 border-2 border-black p-4">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between mb-2 gap-2">
                                            <h3 class="font-black text-black truncate"><?php echo e($kontrak->penghuni->nama); ?></h3>
                                            <span class="text-xs font-bold text-gray-600 shrink-0"><?php echo e($kontrak->created_at->format('d M Y')); ?></span>
                                        </div>
                                        <p class="text-sm font-bold text-gray-700 mb-3 truncate">
                                            <?php echo e($kontrak->kos->nama_kos); ?> - Kamar <?php echo e($kontrak->kamar->nomor_kamar); ?>

                                        </p>
                                        <div class="flex gap-2 flex-wrap">
                                            <button onclick="showApproveModal('<?php echo e(route('pemilik.kontrak.approve', $kontrak->id_kontrak)); ?>', '<?php echo e($kontrak->penghuni->nama ?? 'Penghuni'); ?>')"
                                                class="px-3 py-1.5 bg-lime-400 hover:bg-lime-500 text-black font-black text-sm border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all uppercase tracking-wide">
                                                <i class="fas fa-check mr-1"></i> Setujui
                                            </button>
                                            <button onclick="showRejectModal(<?php echo e($kontrak->id_kontrak); ?>, '<?php echo e($kontrak->penghuni->nama ?? 'Penghuni'); ?>')"
                                                class="px-3 py-1.5 bg-red-400 hover:bg-red-500 text-white font-black text-sm border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all uppercase tracking-wide">
                                                <i class="fas fa-times mr-1"></i> Tolak
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php if($kontrakPending->count() > 3): ?>
                            <div class="text-center pt-2">
                                <a href="<?php echo e(route('pemilik.kontrak.index')); ?>"
                                    class="inline-flex items-center text-yellow-600 hover:text-black font-black text-sm transition-colors">
                                    Lihat semua <?php echo e($kontrakPending->count()); ?> permohonan <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-gray-200 border-2 border-black flex items-center justify-center mx-auto mb-4 shadow-[2px_2px_0px_#000]">
                            <i class="fas fa-check-circle text-gray-500 text-2xl"></i>
                        </div>
                        <p class="text-gray-700 font-bold">Tidak ada permohonan pending</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Pembayaran Terbaru -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h2 class="text-xl font-black text-black mb-6 flex items-center">
                    <i class="fas fa-credit-card text-purple-500 mr-3"></i>
                    Pembayaran Terbaru
                </h2>

                <?php if($pembayaranTerbaru->count() > 0): ?>
                    <div class="space-y-4">
                        <?php $__currentLoopData = $pembayaranTerbaru->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pembayaran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-center justify-between bg-gray-100 border-2 border-black p-4">
                                <div class="flex items-center gap-3 min-w-0">
                                    <div class="w-10 h-10 shrink-0 border-2 border-black flex items-center justify-center
                                        <?php echo e($pembayaran->status_pembayaran == 'lunas' ? 'bg-emerald-400' :
                                        ($pembayaran->status_pembayaran == 'pending' ? 'bg-yellow-400' :
                                        ($pembayaran->status_pembayaran == 'terlambat' ? 'bg-red-400' :
                                            'bg-gray-200'))); ?>">
                                        <i class="fas fa-<?php echo e($pembayaran->status_pembayaran == 'lunas' ? 'check' : 'clock'); ?> text-black"></i>
                                    </div>
                                    <div>
                                        <p class="font-black text-black"><?php echo e($pembayaran->penghuni->nama); ?></p>
                                        <p class="text-xs font-bold text-gray-600 truncate"><?php echo e($pembayaran->kontrak->kos->nama_kos); ?></p>
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

                        <?php if($pembayaranTerbaru->count() > 5): ?>
                            <div class="text-center pt-4">
                                <a href="<?php echo e(route('pemilik.pembayaran.index')); ?>"
                                    class="inline-flex items-center text-purple-600 hover:text-black font-black text-sm transition-colors">
                                    Lihat semua pembayaran <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-gray-200 border-2 border-black flex items-center justify-center mx-auto mb-4 shadow-[2px_2px_0px_#000]">
                            <i class="fas fa-credit-card text-gray-500 text-2xl"></i>
                        </div>
                        <p class="text-gray-700 font-bold">Belum ada pembayaran</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="fixed inset-0 bg-black/70 overflow-y-auto h-full w-full hidden z-50 items-center justify-center p-4">
        <div class="relative mx-auto bg-white border-4 border-black shadow-[8px_8px_0px_#000] w-full max-w-md">
            <div class="p-6">
                <h3 class="text-lg font-black text-black mb-4 flex items-center">
                    <i class="fas fa-times-circle text-red-500 mr-2"></i>
                    Tolak Permohonan Kontrak
                </h3>
                <p class="text-sm font-bold text-gray-600 mb-4" id="rejectUserName">
                    Alasan penolakan untuk: <span class="text-black font-black"></span>
                </p>
                
                <form method="POST" action="" id="rejectForm" data-ajax="true" data-success-msg="Kontrak ditolak" data-redirect="<?php echo e(route('pemilik.kontrak.index')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="mb-4">
                        <label class="block text-sm font-black text-black mb-2">Alasan Penolakan *</label>
                        <textarea name="alasan_ditolak" 
                                  class="w-full px-3 py-2 border-2 border-black text-black font-bold focus:shadow-[3px_3px_0px_#000] outline-none"
                                  rows="4" 
                                  placeholder="Berikan alasan penolakan yang jelas..."
                                  required></textarea>
                    </div>
                    
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeRejectModal()"
                                class="px-4 py-2 bg-white text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 bg-red-500 text-white font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all">
                            <i class="fas fa-times mr-2"></i> Tolak Kontrak
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Approve Modal -->
    <div id="approveModal" class="fixed inset-0 bg-black/70 overflow-y-auto h-full w-full hidden z-50 items-center justify-center p-4">
        <div class="relative mx-auto bg-white border-4 border-black shadow-[8px_8px_0px_#000] w-full max-w-md">
            <div class="p-6">
                <h3 class="text-lg font-black text-black mb-4 flex items-center">
                    <i class="fas fa-check-circle text-emerald-500 mr-2"></i>
                    Setujui Permohonan Kontrak
                </h3>
                <p class="text-sm font-bold text-gray-600 mb-4" id="approveUserName">
                    Konfirmasi persetujuan untuk: <span class="text-black font-black"></span>
                </p>
                
                <form method="POST" action="" id="approveForm" data-ajax="true" data-success-msg="Kontrak berhasil disetujui" data-redirect="<?php echo e(route('pemilik.kontrak.index')); ?>">
                    <?php echo csrf_field(); ?>
                    
                    <p class="text-sm font-bold text-gray-600 mb-6">
                        Apakah Anda yakin ingin menyetujui kontrak ini? Status kamar akan berubah menjadi terisi dan kontrak akan aktif.
                    </p>
                    
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeApproveModal()"
                                class="px-4 py-2 bg-white text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 bg-lime-400 hover:bg-lime-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all">
                            <i class="fas fa-check mr-2"></i> Setujui Kontrak
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showRejectModal(kontrakId, userName) {
            document.querySelector('#rejectUserName span').textContent = userName;
            const form = document.getElementById('rejectForm');
            form.dataset.ajaxAction = '/api/pemilik/kontrak/' + kontrakId + '/reject';
            form.action = '/pemilik/kontrak/' + kontrakId + '/reject';
            document.getElementById('rejectModal').classList.remove('hidden');
            document.getElementById('rejectModal').classList.add('flex');
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
            document.getElementById('rejectModal').classList.remove('flex');
            document.getElementById('rejectForm').reset();
        }

        function showApproveModal(actionUrl, userName) {
            document.querySelector('#approveUserName span').textContent = userName;
            const form = document.getElementById('approveForm');
            form.dataset.ajaxAction = actionUrl.replace('/pemilik/', '/api/pemilik/');
            form.action = actionUrl;
            document.getElementById('approveModal').classList.remove('hidden');
            document.getElementById('approveModal').classList.add('flex');
        }

        function closeApproveModal() {
            document.getElementById('approveModal').classList.add('hidden');
            document.getElementById('approveModal').classList.remove('flex');
        }

        window.onclick = function(event) {
            const rejectModal = document.getElementById('rejectModal');
            const approveModal = document.getElementById('approveModal');
            if (event.target === rejectModal) closeRejectModal();
            if (event.target === approveModal) closeApproveModal();
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/pemilik/dashboard.blade.php ENDPATH**/ ?>