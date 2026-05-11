<?php $__env->startSection('title', 'Kelola Kos - AyoKos'); ?>

<?php $__env->startSection('content'); ?>
    <div class="p-4 md:p-6 lg:p-8 space-y-6 max-w-7xl mx-auto">
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
                            <a href="<?php echo e(route('pemilik.kos.index')); ?>"
                                class="inline-flex items-center text-sm font-medium text-white">
                                <i class="fas fa-file-contract mr-2"></i>
                                Kelola Kos
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
                        <i class="fas fa-home mr-3"></i>
                        Kelola Kos</h1>
                    <p class="text-slate-100">Kelola semua properti kos Anda di satu tempat</p>
                </div>
                <a href="<?php echo e(route('pemilik.kos.create')); ?>"
                    class="mt-4 md:mt-0 px-6 py-3 bg-sky-500/20 backdrop-blur-sm border border-sky-500/20 hover:bg-sky-500/10 text-white font-semibold rounded-xl transition-all duration-300">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Kos Baru
                </a>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6 mb-6">
            <form method="GET" action="<?php echo e(route('pemilik.kos.index')); ?>">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <div class="relative">
                            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-white/50"></i>
                            <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                                class="w-full pl-10 pr-4 py-3 bg-sky-500/20 backdrop-blur-sm border border-sky-500/20 text-white rounded-xl focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-500/30 transition"
                                placeholder="Cari nama kos, alamat, kecamatan, atau kota...">
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit"
                            class="px-6 py-3 bg-sky-500/20 backdrop-blur-sm border border-sky-500/20 hover:bg-sky-500/10 text-white rounded-xl transition-all duration-300 font-semibold">
                            <i class="fas fa-search mr-2"></i>
                            Cari
                        </button>
                        <?php if(request('search')): ?>
                            <a href="<?php echo e(route('pemilik.kos.index')); ?>"
                                class="px-6 py-3 bg-white/5 backdrop-blur-sm border border-white/20 text-white rounded-xl hover:bg-white/10 transition font-semibold">
                                <i class="fas fa-times mr-2"></i>
                                Reset
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>

        <?php if(session('success')): ?>
            <div class="bg-green-500/20 backdrop-blur-sm border border-green-500/20 text-green-300 px-4 py-3 rounded-xl mb-6">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-3"></i>
                    <?php echo e(session('success')); ?>

                </div>
            </div>
        <?php endif; ?>

        <!-- Kos List -->
        <?php if($kos->count() > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php $__currentLoopData = $kos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div
                        class="card-hover bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl overflow-hidden transition-all duration-300">
                        <!-- Foto Kos -->
                        <div class="relative h-56 overflow-hidden">
                            <?php if($item->foto_utama): ?>
                                <img src="<?php echo e(asset('storage/' . $item->foto_utama)); ?>" alt="<?php echo e($item->nama_kos); ?>"
                                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                            <?php else: ?>
                                <div
                                    class="w-full h-full bg-white/5 flex items-center justify-center">
                                    <i class="fas fa-home text-4xl text-white/50"></i>
                                </div>
                            <?php endif; ?>

                            <!-- Status Badge -->
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 rounded-full text-xs font-medium backdrop-blur-sm
                                    <?php echo e($item->status_kos == 'aktif' ? 'bg-green-50 text-green-600' :
                        ($item->status_kos == 'pending' ? 'bg-yellow-50 text-yellow-600' :
                            'bg-red-50 text-red-600')); ?>">
                                    <?php echo e(ucfirst($item->status_kos)); ?>

                                </span>
                            </div>

                            <!-- Overlay on Hover -->
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300">
                            </div>
                        </div>

                        <!-- Info Kos -->
                        <div class="p-5">
                            <div class="flex items-start justify-between mb-3">
                                <h3 class="text-lg font-semibold text-white truncate"><?php echo e($item->nama_kos); ?></h3>
                            </div>

                            <div class="flex items-center text-slate-100 text-sm mb-3">
                                <i class="fas fa-map-marker-alt mr-2 text-sky-400"></i>
                                <span class="line-clamp-1"><?php echo e($item->alamat); ?></span>
                            </div>

                            <div class="flex items-center justify-between text-sm mb-4">
                                <div class="flex items-center space-x-4">
                                    <span class="flex items-center text-slate-100">
                                        <i class="fas fa-bed mr-2 text-emerald-400"></i>
                                        <?php echo e($item->kamar_count); ?> Kamar
                                    </span>
                                    <span class="flex items-center text-slate-100">
                                        <i class="fas fa-users mr-2 text-sky-400"></i>
                                        <?php echo e(ucfirst($item->jenis_kos)); ?>

                                    </span>
                                </div>
                                <span class="font-semibold text-sky-300">
                                    <?php echo e(ucfirst($item->tipe_sewa)); ?>

                                </span>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex justify-between items-center pt-4 border-t border-white/10">
                                <!-- Left Side: Detail Button -->
                                <a href="<?php echo e(route('pemilik.kos.show', $item->id_kos)); ?>"
                                    class="inline-flex items-center text-sky-400 hover:text-sky-300 font-medium group">
                                    <i class="fas fa-eye mr-2 group-hover:scale-110 transition-transform"></i>
                                    Detail
                                </a>

                                <!-- Right Side: Edit, Kamar, Delete -->
                                <div class="flex items-center space-x-4">
                                    <a href="<?php echo e(route('pemilik.kos.edit', $item->id_kos)); ?>"
                                        class="inline-flex items-center text-blue-400 hover:text-blue-300 font-medium group">
                                        <i class="fas fa-edit mr-2 group-hover:scale-110 transition-transform"></i>
                                        Edit
                                    </a>

                                    <a href="<?php echo e(route('pemilik.kamar.index', ['kos' => $item->id_kos])); ?>"
                                        class="inline-flex items-center text-emerald-400 hover:text-emerald-300 font-medium group">
                                        <i class="fas fa-bed mr-2 group-hover:scale-110 transition-transform"></i>
                                        Kamar
                                    </a>

                                    <button type="button"
                                        onclick="showDeleteModal('<?php echo e(route('pemilik.kos.destroy', $item->id_kos)); ?>', '<?php echo e($item->nama_kos); ?>')"
                                        class="inline-flex items-center text-red-400 hover:text-red-300 font-medium group">
                                        <i class="fas fa-trash mr-2 group-hover:scale-110 transition-transform"></i>
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <!-- Empty State -->
            <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-8">
                <div class="text-center">
                    <div
                        class="w-24 h-24 bg-sky-500/20 backdrop-blur-sm border border-sky-500/20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-home text-4xl text-sky-400"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-3">Belum Ada Kos</h3>
                    <p class="text-slate-100 mb-6 max-w-md mx-auto">
                        Mulai dengan menambahkan kos pertama Anda untuk mengelola properti Anda
                    </p>
                    <a href="<?php echo e(route('pemilik.kos.create')); ?>"
                        class="inline-flex items-center justify-center px-6 py-3 bg-sky-500/20 backdrop-blur-sm border border-sky-500/20 hover:bg-sky-500/10 text-white font-semibold rounded-xl transition-all duration-300">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Kos Pertama
                    </a>
                </div>
            </div>
        <?php endif; ?>

            <!-- Table Footer -->
        <?php if($kos->hasPages()): ?>
            <div class="px-6 py-4 border-t border-white/10">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-slate-100">
                        Menampilkan <?php echo e($kos->firstItem()); ?> - <?php echo e($kos->lastItem()); ?> dari <?php echo e($kos->total()); ?> kos
                    </div>
                    <div class="flex space-x-2">
                        <?php echo e($kos->links('vendor.pagination.custom-dark')); ?>

                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Back to Dashboard -->
    <div class="flex justify-center pt-6">
        <a href="<?php echo e(route('pemilik.dashboard')); ?>"
            class="inline-flex items-center px-5 py-2.5 bg-white/5 backdrop-blur-sm border border-white/20 text-white rounded-xl hover:border-sky-500 hover:text-sky-300 transition-all duration-300 group">
            <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
            Kembali ke Dashboard
        </a>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border border-slate-200 w-96 shadow-2xl rounded-2xl bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                    <i class="fas fa-exclamation-triangle text-red-600 mr-2"></i>
                    Hapus Kos?
                </h3>
                <p class="text-sm text-slate-500 mb-4">Apakah Anda yakin ingin menghapus <span id="kosNama"
                        class="font-semibold text-slate-800"></span>?</p>
                <p class="text-red-500 text-sm mb-6">Semua data kamar dan kontrak yang terkait dengan kos ini juga akan
                    terhapus secara permanen.</p>

                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeDeleteModal()"
                        class="px-4 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition">
                        Batal
                    </button>
                    <form id="deleteForm" method="POST" action="">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit"
                            class="px-4 py-2 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-lg hover:from-red-700 hover:to-red-800 transition shadow-lg">
                            Ya, Hapus Kos
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDeleteModal(action, nama) {
            document.getElementById('deleteForm').action = action;
            document.getElementById('kosNama').textContent = nama;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('deleteModal');
            if (event.target === modal) {
                closeDeleteModal();
            }
        }

        // Close on ESC
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeDeleteModal();
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/pemilik/kos/index.blade.php ENDPATH**/ ?>