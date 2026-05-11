<?php $__env->startSection('title', 'Kelola Kamar - AyoKos'); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl mx-auto p-4 md:p-6 lg:p-8 space-y-6">
        <!-- Breadcrumb -->
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="<?php echo e(route('pemilik.dashboard')); ?>"
                            class="inline-flex items-center text-sm font-medium text-slate-100 hover:text-white transition-colors">
                            <i class="fas fa-home mr-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="inline-flex items-center">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-white/50 text-xs mx-2"></i>
                            <a href="<?php echo e(route('pemilik.kamar.index')); ?>"
                                class="inline-flex items-center text-sm font-medium text-white">
                                <i class="fas fa-bed mr-2"></i>
                                Kelola Kamar
                            </a>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <!-- Header -->
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6 mb-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-white mb-2">
                        <i class="fas fa-bed mr-3"></i>
                        Kelola Kamar</h1>
                    <p class="text-slate-100">Kelola semua kamar kos Anda di satu tempat yang terorganisir</p>
                </div>
                <a href="<?php echo e(route('pemilik.kamar.create')); ?>"
                    class="mt-4 md:mt-0 px-6 py-3 bg-sky-500/20 backdrop-blur-sm border border-sky-500/20 hover:bg-sky-500/10 text-white font-semibold rounded-xl transition-all duration-300 flex items-center justify-center">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Kamar Baru
                </a>
            </div>
        </div>

        <?php if(session('success')): ?>
            <div class="bg-white/5 backdrop-blur-sm border border-white/20 text-slate-100 px-4 py-3 rounded-xl mb-6 flex items-center">
                <i class="fas fa-check-circle mr-3 text-sky-400"></i>
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <!-- Filter Section -->
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
            <h2 class="text-lg font-semibold text-white mb-4 flex items-center">
                <i class="fas fa-filter text-sky-400 mr-3"></i>
                Filter Kamar
            </h2>
            <form method="GET" action="<?php echo e(route('pemilik.kamar.index')); ?>"
                class="space-y-4 md:space-y-0 md:grid md:grid-cols-4 md:gap-4">
                <div>
                    <label class="block text-sm font-medium text-white mb-2">Pilih Kos</label>
                    <div class="relative">
                        <i class="fas fa-home absolute left-3 top-1/2 transform -translate-y-1/2 text-white/50"></i>
                        <select name="kos"
                            class="w-full pl-10 pr-4 py-2.5 bg-white/5 border border-white/20 text-white rounded-lg focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-500/30 appearance-none transition">
                            <option value="">Semua Kos</option>
                            <?php $__currentLoopData = $kos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($k->id_kos); ?>" <?php echo e(request('kos') == $k->id_kos ? 'selected' : ''); ?>>
                                    <?php echo e($k->nama_kos); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <i
                            class="fas fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-white/50 pointer-events-none"></i>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-white mb-2">Status</label>
                    <div class="relative">
                        <i class="fas fa-circle absolute left-3 top-1/2 transform -translate-y-1/2 text-white/50"></i>
                        <select name="status"
                            class="w-full pl-10 pr-4 py-2.5 bg-white/5 border border-white/20 text-white rounded-lg focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-500/30 appearance-none transition">
                            <option value="">Semua Status</option>
                            <option value="tersedia" <?php echo e(request('status') == 'tersedia' ? 'selected' : ''); ?>>Tersedia</option>
                            <option value="terisi" <?php echo e(request('status') == 'terisi' ? 'selected' : ''); ?>>Terisi</option>
                            <option value="maintenance" <?php echo e(request('status') == 'maintenance' ? 'selected' : ''); ?>>Maintenance
                            </option>
                        </select>
                        <i
                            class="fas fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-white/50 pointer-events-none"></i>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-white mb-2">Tipe Kamar</label>
                    <div class="relative">
                        <i class="fas fa-bed absolute left-3 top-1/2 transform -translate-y-1/2 text-white/50"></i>
                        <select name="tipe"
                            class="w-full pl-10 pr-4 py-2.5 bg-white/5 border border-white/20 text-white rounded-lg focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-500/30 appearance-none transition">
                            <option value="">Semua Tipe</option>
                            <option value="Standar" <?php echo e(request('tipe') == 'Standar' ? 'selected' : ''); ?>>Standar</option>
                            <option value="Deluxe" <?php echo e(request('tipe') == 'Deluxe' ? 'selected' : ''); ?>>Deluxe</option>
                            <option value="VIP" <?php echo e(request('tipe') == 'VIP' ? 'selected' : ''); ?>>VIP</option>
                            <option value="Superior" <?php echo e(request('tipe') == 'Superior' ? 'selected' : ''); ?>>Superior</option>
                            <option value="Ekonomi" <?php echo e(request('tipe') == 'Ekonomi' ? 'selected' : ''); ?>>Ekonomi</option>
                        </select>
                        <i
                            class="fas fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-white/50 pointer-events-none"></i>
                    </div>
                </div>
                <div class="flex items-end">
                    <button type="submit"
                        class="w-full px-6 py-2.5 bg-sky-500/20 backdrop-blur-sm border border-sky-500/20 hover:bg-sky-500/10 text-white font-medium rounded-lg transition-all duration-300">
                        <i class="fas fa-filter mr-2"></i>
                        Terapkan Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Total Kamar -->
            <div class="card-hover bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 rounded-lg bg-white/5 backdrop-blur-sm">
                        <i class="fas fa-bed text-white text-xl"></i>
                    </div>
                     <span class="text-sm font-medium px-2 py-1 rounded-full bg-white/5 backdrop-blur-sm text-white">
                         <?php echo e($stats['tersedia']); ?>

                     </span>
                </div>
                 <h3 class="text-2xl font-bold text-white mb-1"><?php echo e($stats['total_kamar']); ?></h3>
                <p class="text-sm text-slate-100">Total Kamar</p>
            </div>

            <!-- Tersedia -->
            <div class="card-hover bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 rounded-lg bg-white/5 backdrop-blur-sm">
                        <i class="fas fa-door-open text-white text-xl"></i>
                    </div>
                    <span class="text-sm font-medium px-2 py-1 rounded-full bg-white/5 backdrop-blur-sm text-white">
                        <?php echo e($kamar->where('status_kamar', 'tersedia')->count()); ?>

                    </span>
                </div>
                 <h3 class="text-2xl font-bold text-white mb-1"><?php echo e($stats['tersedia']); ?></h3>
                <p class="text-sm text-slate-100">Tersedia</p>
            </div>

            <!-- Terisi -->
            <div class="card-hover bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 rounded-lg bg-white/5 backdrop-blur-sm">
                        <i class="fas fa-users text-white text-xl"></i>
                    </div>
                     <span class="text-sm font-medium px-2 py-1 rounded-full bg-white/5 backdrop-blur-sm text-white">
                         <?php echo e($stats['terisi']); ?>

                     </span>
                </div>
                 <h3 class="text-2xl font-bold text-white mb-1"><?php echo e($stats['terisi']); ?></h3>
                <p class="text-sm text-slate-100">Terisi</p>
            </div>

            <!-- Maintenance -->
            <div class="card-hover bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 rounded-lg bg-white/5 backdrop-blur-sm">
                        <i class="fas fa-tools text-white text-xl"></i>
                    </div>
                     <span class="text-sm font-medium px-2 py-1 rounded-full bg-white/5 backdrop-blur-sm text-white">
                         <?php echo e($stats['maintenance']); ?>

                     </span>
                </div>
                 <h3 class="text-2xl font-bold text-white mb-1"><?php echo e($stats['maintenance']); ?>

                 </h3>
                <p class="text-sm text-slate-100">Maintenance</p>
            </div>
        </div>

        <!-- Kamar List -->
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl overflow-hidden">
            <div class="p-6 border-b border-white/20">
                <h2 class="text-lg font-semibold text-white flex items-center">
                    <i class="fas fa-list mr-3 text-sky-400"></i>
                    Daftar Kamar (<?php echo e($kamar->count()); ?>)
                </h2>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-white/20">
                    <thead>
                        <tr class="bg-white/5">
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-100 uppercase tracking-wider">
                                <i class="fas fa-bed mr-2"></i>Kamar & Kos
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-100 uppercase tracking-wider">
                                <i class="fas fa-cogs mr-2"></i>Tipe & Fasilitas
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-100 uppercase tracking-wider">
                                <i class="fas fa-money-bill-wave mr-2"></i>Harga
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-100 uppercase tracking-wider">
                                <i class="fas fa-circle mr-2"></i>Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-100 uppercase tracking-wider">
                                <i class="fas fa-edit mr-2"></i>Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/20">
                        <?php $__empty_1 = true; $__currentLoopData = $kamar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr class="hover:bg-white/5 transition-colors duration-200">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div
                                                        class="flex-shrink-0 w-14 h-14 bg-white/5 border border-white/20 rounded-lg overflow-hidden">
                                                        <?php if($item->foto_kamar): ?>
                                                            <img src="<?php echo e(asset('storage/' . $item->foto_kamar)); ?>" alt="Foto Kamar"
                                                                class="w-full h-full object-cover">
                                                        <?php else: ?>
                                                            <div class="w-full h-full bg-white/5 flex items-center justify-center">
                                                                <i class="fas fa-bed text-white/50 text-lg"></i>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="flex items-center">
                                                            <div class="text-sm font-bold text-white">
                                                                Kamar <?php echo e($item->nomor_kamar); ?>

                                                            </div>
                                                        </div>
                                                        <div class="text-sm text-sky-400 font-medium mt-1">
                                                            <?php echo e($item->kos->nama_kos); ?>

                                                        </div>
                                                        <div class="text-xs text-slate-100 mt-1">
                                                            <i class="fas fa-ruler-combined mr-1"></i>
                                                            <?php echo e($item->luas_kamar ?? 'N/A'); ?> •
                                                            <i class="fas fa-user mr-1 ml-2"></i>
                                                            <?php echo e($item->kapasitas); ?> orang
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="mb-2">
                                                    <span
                                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white/5 backdrop-blur-sm text-sky-400 border border-sky-500/30">
                                                        <i class="fas fa-star mr-1 text-xs"></i>
                                                        <?php echo e($item->tipe_kamar); ?>

                                                    </span>
                                                </div>
                                                <div class="text-sm text-slate-100 max-w-xs truncate">
                                                    <?php if($item->fasilitas_kamar): ?>
                                                        <?php
                                                            if (is_array($item->fasilitas_kamar)) {
                                                                $fasilitas = $item->fasilitas_kamar;
                                                            } else {
                                                                $fasilitas = json_decode($item->fasilitas_kamar, true) ?? [];
                                                            }
                                                        ?>

                                                            <?php if(is_array($fasilitas) && count($fasilitas) > 0): ?>
                                                            <?php $__currentLoopData = array_slice($fasilitas, 0, 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fasilitasItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <span class="inline-block text-xs px-2 py-1 rounded-lg bg-white/5 backdrop-blur-sm mr-1 mb-1">
                                                                    <i class="fas fa-check text-emerald-400 mr-1"></i>
                                                                    <?php echo e($fasilitasItem); ?>

                                                                </span>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if(count($fasilitas) > 2): ?>
                                                                <span class="text-xs text-slate-100/70">
                                                                    +<?php echo e(count($fasilitas) - 2); ?> lagi
                                                                </span>
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <span class="text-slate-400">-</span>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <span class="text-slate-400">-</span>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-lg font-bold text-white">
                                                    Rp <?php echo e(number_format($item->harga, 0, ',', '.')); ?>

                                                </div>
                                                <div class="text-xs text-slate-100">
                                                    per bulan
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex items-center px-3 py-1.5 text-xs font-semibold rounded-full 
                                                    <?php echo e($item->status_kamar == 'tersedia' ? 'bg-emerald-500/20 backdrop-blur-sm text-emerald-300 border border-emerald-500/20' :
                            ($item->status_kamar == 'terisi' ? 'bg-blue-500/20 backdrop-blur-sm text-blue-300 border border-blue-500/20' :
                                'bg-yellow-500/20 backdrop-blur-sm text-yellow-300 border border-yellow-500/20')); ?>">
                                                    <i class="fas 
                                                        <?php echo e($item->status_kamar == 'tersedia' ? 'fa-door-open' :
                            ($item->status_kamar == 'terisi' ? 'fa-user-check' : 'fa-tools')); ?> 
                                                        mr-1.5 text-xs"></i>
                                                    <?php echo e(ucfirst($item->status_kamar)); ?>

                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center space-x-3">
                                                    <a href="<?php echo e(route('pemilik.kamar.edit', $item->id_kamar)); ?>"
                                                        class="inline-flex items-center px-3 py-1.5 bg-sky-500/20 backdrop-blur-sm border border-sky-500/20 hover:bg-sky-500/10 text-white rounded-lg text-sm font-medium transition-all duration-300">
                                                        <i class="fas fa-edit mr-2 text-xs"></i>
                                                        Edit
                                                    </a>
                                                    <button type="button"
                                                        onclick="showDeleteModal('<?php echo e(route('pemilik.kamar.destroy', $item->id_kamar)); ?>', '<?php echo e($item->nomor_kamar); ?>')"
                                                        class="inline-flex items-center px-3 py-1.5 bg-red-500/20 backdrop-blur-sm border border-red-500/20 hover:bg-red-500/10 text-red-300 rounded-lg text-sm font-medium transition-all duration-300">
                                                        <i class="fas fa-trash-alt mr-2 text-xs"></i>
                                                        Hapus
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div
                                            class="w-20 h-20 bg-white/5 backdrop-blur-sm border border-white/20 rounded-full flex items-center justify-center mb-4">
                                            <i class="fas fa-bed text-sky-400 text-3xl"></i>
                                        </div>
                                        <h3 class="text-lg font-semibold text-white mb-2">Belum ada kamar</h3>
                                        <p class="text-slate-100 mb-4">Mulai tambahkan kamar pertama Anda</p>
                                        <a href="<?php echo e(route('pemilik.kamar.create')); ?>"
                                            class="inline-flex items-center px-4 py-2 bg-sky-500/20 backdrop-blur-sm border border-sky-500/20 hover:bg-sky-500/10 text-white rounded-lg transition-all duration-300">
                                            <i class="fas fa-plus mr-2"></i>
                                            Tambah Kamar
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Kamar List Pagination -->
        <?php if($kamar->hasPages()): ?>
            <div class="mt-4 px-6 py-4 bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                    <div class="text-sm text-slate-100">
                        Menampilkan <span class="font-semibold text-white"><?php echo e($kamar->firstItem()); ?></span> - 
                        <span class="font-semibold text-white"><?php echo e($kamar->lastItem()); ?></span> dari 
                        <span class="font-semibold text-white"><?php echo e($kamar->total()); ?></span> kamar
                    </div>
                    <div class="flex space-x-2">
                        <?php echo e($kamar->links('vendor.pagination.custom-dark')); ?>

                    </div>
                </div>
            </div>
        <?php endif; ?>
        <!-- Back to Dashboard -->
        <div class="mt-8 flex justify-center">
            <a href="<?php echo e(route('pemilik.dashboard')); ?>"
                class="inline-flex items-center px-6 py-3 bg-white/5 backdrop-blur-sm border border-white/20 hover:bg-white/10 text-white rounded-xl transition-all duration-300 group">
                <i class="fas fa-arrow-left mr-3 transition-transform group-hover:-translate-x-1"></i>
                Kembali ke Dashboard
            </a>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" onclick="closeDeleteModal()"></div>
        <div class="relative bg-white border-slate-200 rounded-2xl w-full max-w-md overflow-hidden shadow-2xl">
            <div class="p-6 text-center">
                <div class="mb-4 inline-block">
                    <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center mx-auto">
                        <i class="fas fa-exclamation-triangle text-red-500 text-2xl"></i>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-2">Hapus Kamar?</h3>
                <p class="text-slate-500 mb-1">Apakah Anda yakin ingin menghapus <span
                        class="font-semibold text-slate-800">Kamar <span id="kamarNomor"></span></span>?</p>
                <p class="text-red-500 text-sm mb-6">Data kamar dan sejarah penyewaan terkait kamar ini akan terhapus secara
                    permanen.</p>

                <div class="flex justify-center gap-3">
                    <button type="button" onclick="closeDeleteModal()"
                        class="px-5 py-2.5 bg-slate-100 text-slate-700 rounded-xl hover:bg-slate-200 transition">
                        Batal
                    </button>
                    <form id="deleteForm" method="POST" action="">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit"
                            class="px-5 py-2.5 bg-gradient-to-r from-red-500 to-rose-600 text-white rounded-xl hover:from-red-600 hover:to-rose-700 transition shadow-lg">
                            Ya, Hapus Kamar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDeleteModal(action, nomor) {
            document.getElementById('deleteForm').action = action;
            document.getElementById('kamarNomor').textContent = nomor;
            const modal = document.getElementById('deleteModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
        }

        // Close on ESC
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeDeleteModal();
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/pemilik/kamar/index.blade.php ENDPATH**/ ?>