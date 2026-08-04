<?php $__env->startSection('title', 'Kelola Kos - AyoKos'); ?>

<?php $__env->startSection('content'); ?>
    <div class="p-4 md:p-6 lg:p-8 space-y-6 max-w-7xl mx-auto">
        <!-- Breadcrumb -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="<?php echo e(route('pemilik.dashboard')); ?>"
                            class="inline-flex items-center text-sm font-bold text-gray-600 hover:text-black transition-colors">
                            <i class="fas fa-home mr-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="inline-flex items-center">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                            <a href="<?php echo e(route('pemilik.kos.index')); ?>"
                                class="inline-flex items-center text-sm font-bold text-black">
                                <i class="fas fa-file-contract mr-2"></i>
                                Kelola Kos
                            </a>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <!-- Header -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 mb-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between">
                <div>
                    <h1 class="text-2xl md:text-3xl font-black text-black mb-2">
                        <i class="fas fa-home mr-3"></i>
                        Kelola Kos</h1>
                    <p class="text-gray-600">Kelola semua properti kos Anda di satu tempat</p>
                </div>
                <a href="<?php echo e(route('pemilik.kos.create')); ?>"
                    class="mt-4 md:mt-0 px-6 py-3 bg-lime-400 hover:bg-lime-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all uppercase tracking-wide">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Kos Baru
                </a>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 mb-6">
            <form method="GET" action="<?php echo e(route('pemilik.kos.index')); ?>">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <div class="relative">
                            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                                class="w-full pl-10 pr-4 py-3 bg-white border-2 border-black text-black font-black focus:shadow-[3px_3px_0px_#000] outline-none"
                                placeholder="Cari nama kos, alamat, kecamatan, atau kota...">
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit"
                            class="px-6 py-3 bg-black text-white font-black border-2 border-black shadow-[3px_3px_0px_#000] hover:shadow-[4px_4px_0px_#000] hover:translate-y-[-1px] transition-all uppercase tracking-wide">
                            <i class="fas fa-search mr-2"></i>
                            Cari
                        </button>
                        <?php if(request('search')): ?>
                            <a href="<?php echo e(route('pemilik.kos.index')); ?>"
                                class="px-6 py-3 bg-gray-100 text-gray-700 font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] hover:translate-y-[-1px] transition-all uppercase tracking-wide">
                                <i class="fas fa-times mr-2"></i>
                                Reset
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>

        <?php if(session('success')): ?>
            <div class="bg-emerald-400 border-2 border-black text-black font-black px-4 py-3 shadow-[3px_3px_0px_#000] mb-6">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-3"></i>
                    <?php echo e(session('success')); ?>

                </div>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="bg-red-400 border-2 border-black text-black font-black px-4 py-3 shadow-[3px_3px_0px_#000] mb-6">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-3"></i>
                    <?php echo e(session('error')); ?>

                </div>
            </div>
        <?php endif; ?>

        <!-- Kos List -->
        <?php if($kos->count() > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php $__currentLoopData = $kos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div
                        class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] overflow-hidden transition-all duration-300">
                        <!-- Foto Kos -->
                        <div class="relative h-56 overflow-hidden">
                            <?php if($item->foto_utama): ?>
                                <img src="<?php echo e(asset('storage/' . $item->foto_utama)); ?>" alt="<?php echo e($item->nama_kos); ?>"
                                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                            <?php else: ?>
                                <div
                                    class="w-full h-full bg-gray-100 flex items-center justify-center">
                                    <i class="fas fa-home text-4xl text-gray-400"></i>
                                </div>
                            <?php endif; ?>

                            <!-- Status Badge -->
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 text-xs font-black border-2 border-black
                                    <?php echo e($item->status_kos == 'aktif' ? 'bg-emerald-400 text-black' :
                            ($item->status_kos == 'pending' ? 'bg-yellow-400 text-black' :
                                'bg-red-400 text-black')); ?>">
                                    <?php echo e(ucfirst($item->status_kos)); ?>

                                </span>
                            </div>

                            <!-- Overlay on Hover -->
                            <div
                                class="absolute inset-0 bg-black/60 opacity-0 hover:opacity-100 transition-opacity duration-300">
                            </div>
                        </div>

                        <!-- Info Kos -->
                        <div class="p-5">
                            <div class="flex items-start justify-between mb-3">
                                <h3 class="text-lg font-black text-black truncate"><?php echo e($item->nama_kos); ?></h3>
                            </div>

                            <div class="flex items-center text-gray-600 text-sm mb-3">
                                <i class="fas fa-map-marker-alt mr-2 text-cyan-600"></i>
                                <span class="line-clamp-1"><?php echo e($item->alamat); ?></span>
                            </div>

                            <div class="flex items-center justify-between text-sm mb-4">
                                <div class="flex items-center space-x-4">
                                    <span class="flex items-center text-gray-600">
                                        <i class="fas fa-bed mr-2 text-emerald-600"></i>
                                        <?php echo e($item->kamar_count); ?> Kamar
                                    </span>
                                    <span class="flex items-center text-gray-600">
                                        <i class="fas fa-users mr-2 text-cyan-600"></i>
                                        <?php echo e(ucfirst($item->jenis_kos)); ?>

                                    </span>
                                </div>
                                <span class="font-black text-gray-900">
                                    <?php echo e(ucfirst($item->tipe_sewa)); ?>

                                </span>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex justify-between items-center pt-4 border-t-2 border-gray-200">
                                <!-- Left Side: Detail Button -->
                                <a href="<?php echo e(route('pemilik.kos.show', $item->id_kos)); ?>"
                                    class="inline-flex items-center text-sky-600 hover:text-black font-black transition-colors group">
                                    <i class="fas fa-eye mr-2 group-hover:scale-110 transition-transform"></i>
                                    Detail
                                </a>

                                <!-- Right Side: Edit, Kamar, Delete -->
                                <div class="flex items-center space-x-4">
                                    <a href="<?php echo e(route('pemilik.kos.edit', $item->id_kos)); ?>"
                                        class="inline-flex items-center text-sky-600 hover:text-black font-black transition-colors group">
                                        <i class="fas fa-edit mr-2 group-hover:scale-110 transition-transform"></i>
                                        Edit
                                    </a>

                                    <a href="<?php echo e(route('pemilik.kamar.index', ['kos' => $item->id_kos])); ?>"
                                        class="inline-flex items-center text-sky-600 hover:text-black font-black transition-colors group">
                                        <i class="fas fa-bed mr-2 group-hover:scale-110 transition-transform"></i>
                                        Kamar
                                    </a>

                                    <button type="button"
                                        data-ajax-action="/api/pemilik/kos/<?php echo e($item->id_kos); ?>"
                                        data-ajax-method="DELETE"
                                        data-confirm="Hapus kos <?php echo e($item->nama_kos); ?>? Semua data terkait akan terhapus permanen."
                                        data-success-msg="Kos berhasil dihapus"
                                        data-redirect="<?php echo e(route('pemilik.kos.index')); ?>"
                                        class="inline-flex items-center text-red-600 hover:text-black font-black transition-colors group">
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
            <div class="bg-gray-200 border-2 border-black shadow-[2px_2px_0px_#000] p-8">
                <div class="text-center">
                    <div
                        class="w-24 h-24 bg-white border-2 border-black flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-home text-4xl text-black"></i>
                    </div>
                    <h3 class="text-xl font-black text-black mb-3">Belum Ada Kos</h3>
                    <p class="text-gray-600 mb-6 max-w-md mx-auto">
                        Mulai dengan menambahkan kos pertama Anda untuk mengelola properti Anda
                    </p>
                    <a href="<?php echo e(route('pemilik.kos.create')); ?>"
                        class="inline-flex items-center justify-center px-6 py-3 bg-lime-400 hover:bg-lime-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all uppercase tracking-wide">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Kos Pertama
                    </a>
                </div>
            </div>
        <?php endif; ?>

            <!-- Table Footer -->
        <?php if($kos->hasPages()): ?>
            <div class="px-6 py-4 border-t-2 border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-600">
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
            class="inline-flex items-center px-5 py-2.5 bg-gray-100 text-gray-700 font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] hover:translate-y-[-1px] transition-all group">
            <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
            Kembali ke Dashboard
        </a>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/pemilik/kos/index.blade.php ENDPATH**/ ?>