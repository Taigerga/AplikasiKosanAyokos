<?php $__env->startSection('title', 'Kelola Kamar - AyoKos'); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl mx-auto p-4 md:p-6 lg:p-8 space-y-6">
        <!-- Breadcrumb -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="<?php echo e(route('pemilik.dashboard')); ?>"
                            class="inline-flex items-center text-sm font-black text-gray-700 hover:text-black transition-colors">
                            <i class="fas fa-home mr-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="inline-flex items-center">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                            <a href="<?php echo e(route('pemilik.kamar.index')); ?>"
                                class="inline-flex items-center text-sm font-black text-black">
                                <i class="fas fa-bed mr-2"></i>
                                Kelola Kamar
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
                        <i class="fas fa-bed mr-3"></i>
                        Kelola Kamar</h1>
                    <p class="text-gray-700">Kelola semua kamar kos Anda di satu tempat yang terorganisir</p>
                </div>
                <a href="<?php echo e(route('pemilik.kamar.create')); ?>"
                    class="mt-4 md:mt-0 px-6 py-3 bg-sky-400 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all uppercase tracking-wide text-sm flex items-center justify-center">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Kamar Baru
                </a>
            </div>
        </div>

        <?php if(session('success')): ?>
            <div class="bg-emerald-400 border-2 border-black text-black font-bold px-4 py-3 shadow-[3px_3px_0px_#000] mb-6 flex items-center">
                <i class="fas fa-check-circle mr-3"></i>
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="bg-red-400 border-2 border-black text-black font-bold px-4 py-3 shadow-[3px_3px_0px_#000] mb-6 flex items-center">
                <i class="fas fa-exclamation-circle mr-3"></i>
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        <!-- Filter Section -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <h2 class="text-lg font-black text-black mb-4 flex items-center">
                <i class="fas fa-filter text-sky-400 mr-3"></i>
                Filter Kamar
            </h2>
            <form method="GET" action="<?php echo e(route('pemilik.kamar.index')); ?>"
                class="space-y-4 md:space-y-0 md:grid md:grid-cols-4 md:gap-4">
                <div>
                    <label class="block text-sm font-black text-black mb-2">Pilih Kos</label>
                    <div class="relative">
                        <i class="fas fa-home absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <select name="kos"
                            class="w-full pl-10 pr-4 py-2.5 border-2 border-black text-black font-bold placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white appearance-none transition">
                            <option value="">Semua Kos</option>
                            <?php $__currentLoopData = $kos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($k->id_kos); ?>" <?php echo e(request('kos') == $k->id_kos ? 'selected' : ''); ?>>
                                    <?php echo e($k->nama_kos); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <i
                            class="fas fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-black text-black mb-2">Status</label>
                    <div class="relative">
                        <i class="fas fa-circle absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <select name="status"
                            class="w-full pl-10 pr-4 py-2.5 border-2 border-black text-black font-bold placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white appearance-none transition">
                            <option value="">Semua Status</option>
                            <option value="tersedia" <?php echo e(request('status') == 'tersedia' ? 'selected' : ''); ?>>Tersedia</option>
                            <option value="terisi" <?php echo e(request('status') == 'terisi' ? 'selected' : ''); ?>>Terisi</option>
                            <option value="maintenance" <?php echo e(request('status') == 'maintenance' ? 'selected' : ''); ?>>Maintenance
                            </option>
                        </select>
                        <i
                            class="fas fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-black text-black mb-2">Tipe Kamar</label>
                    <div class="relative">
                        <i class="fas fa-bed absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <select name="tipe"
                            class="w-full pl-10 pr-4 py-2.5 border-2 border-black text-black font-bold placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white appearance-none transition">
                            <option value="">Semua Tipe</option>
                            <option value="Standar" <?php echo e(request('tipe') == 'Standar' ? 'selected' : ''); ?>>Standar</option>
                            <option value="Deluxe" <?php echo e(request('tipe') == 'Deluxe' ? 'selected' : ''); ?>>Deluxe</option>
                            <option value="VIP" <?php echo e(request('tipe') == 'VIP' ? 'selected' : ''); ?>>VIP</option>
                            <option value="Superior" <?php echo e(request('tipe') == 'Superior' ? 'selected' : ''); ?>>Superior</option>
                            <option value="Ekonomi" <?php echo e(request('tipe') == 'Ekonomi' ? 'selected' : ''); ?>>Ekonomi</option>
                        </select>
                        <i
                            class="fas fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                    </div>
                </div>
                <div class="flex items-end">
                    <button type="submit"
                        class="w-full px-6 py-2.5 bg-sky-400 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all uppercase tracking-wide text-sm">
                        <i class="fas fa-filter mr-2"></i>
                        Terapkan Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Total Kamar -->
            <div class="card-hover bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-sky-400 border-2 border-black">
                        <i class="fas fa-bed text-black text-xl"></i>
                    </div>
                     <span class="text-sm font-black px-2 py-1 bg-gray-200 border-2 border-black shadow-[2px_2px_0px_#000]">
                         <?php echo e($stats['tersedia']); ?>

                     </span>
                </div>
                 <h3 class="text-2xl font-black text-black mb-1"><?php echo e($stats['total_kamar']); ?></h3>
                <p class="text-sm text-gray-700">Total Kamar</p>
            </div>

            <!-- Tersedia -->
            <div class="card-hover bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-green-400 border-2 border-black">
                        <i class="fas fa-door-open text-black text-xl"></i>
                    </div>
                    <span class="text-sm font-black px-2 py-1 bg-gray-200 border-2 border-black shadow-[2px_2px_0px_#000]">
                        <?php echo e($kamar->where('status_kamar', 'tersedia')->count()); ?>

                    </span>
                </div>
                 <h3 class="text-2xl font-black text-black mb-1"><?php echo e($stats['tersedia']); ?></h3>
                <p class="text-sm text-gray-700">Tersedia</p>
            </div>

            <!-- Terisi -->
            <div class="card-hover bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-red-400 border-2 border-black">
                        <i class="fas fa-users text-black text-xl"></i>
                    </div>
                     <span class="text-sm font-black px-2 py-1 bg-gray-200 border-2 border-black shadow-[2px_2px_0px_#000]">
                         <?php echo e($stats['terisi']); ?>

                     </span>
                </div>
                 <h3 class="text-2xl font-black text-black mb-1"><?php echo e($stats['terisi']); ?></h3>
                <p class="text-sm text-gray-700">Terisi</p>
            </div>

            <!-- Maintenance -->
            <div class="card-hover bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-yellow-400 border-2 border-black">
                        <i class="fas fa-tools text-black text-xl"></i>
                    </div>
                     <span class="text-sm font-black px-2 py-1 bg-gray-200 border-2 border-black shadow-[2px_2px_0px_#000]">
                         <?php echo e($stats['maintenance']); ?>

                     </span>
                </div>
                 <h3 class="text-2xl font-black text-black mb-1"><?php echo e($stats['maintenance']); ?>

                 </h3>
                <p class="text-sm text-gray-700">Maintenance</p>
            </div>
        </div>

        <!-- Kamar List -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] overflow-hidden">
            <div class="p-6 border-b-2 border-gray-200">
                <h2 class="text-lg font-black text-black flex items-center">
                    <i class="fas fa-list mr-3 text-sky-400"></i>
                    Daftar Kamar (<?php echo e($kamar->count()); ?>)
                </h2>
            </div>

            <div class="overflow-x-auto w-full">
                <table class="w-full divide-y-2 divide-gray-200">
                    <thead>
                        <tr class="bg-black">
                            <th class="px-6 py-3 text-left text-xs font-black text-white uppercase tracking-wider">
                                <i class="fas fa-bed mr-2"></i>Kamar & Kos
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-black text-white uppercase tracking-wider">
                                <i class="fas fa-cogs mr-2"></i>Tipe & Fasilitas
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-black text-white uppercase tracking-wider">
                                <i class="fas fa-money-bill-wave mr-2"></i>Harga
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-black text-white uppercase tracking-wider">
                                <i class="fas fa-circle mr-2"></i>Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-black text-white uppercase tracking-wider">
                                <i class="fas fa-edit mr-2"></i>Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-gray-200">
                        <?php $__empty_1 = true; $__currentLoopData = $kamar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr class="hover:bg-gray-100 transition-colors duration-200">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div
                                                        class="flex-shrink-0 w-14 h-14 bg-gray-200 border-2 border-black overflow-hidden">
                                                        <?php if($item->foto_kamar): ?>
                                                            <img src="<?php echo e(asset('storage/' . $item->foto_kamar)); ?>" alt="Foto Kamar"
                                                                class="w-full h-full object-cover">
                                                        <?php else: ?>
                                                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                                                <i class="fas fa-bed text-gray-400 text-lg"></i>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="flex items-center">
                                                            <div class="text-sm font-black text-black">
                                                                Kamar <?php echo e($item->nomor_kamar); ?>

                                                            </div>
                                                        </div>
                                                        <div class="text-sm text-sky-600 font-black mt-1">
                                                            <?php echo e($item->kos->nama_kos); ?>

                                                        </div>
                                                        <div class="text-xs text-gray-700 mt-1">
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
                                                        class="inline-flex items-center px-3 py-1 text-xs font-black bg-gray-200 border-2 border-black shadow-[2px_2px_0px_#000] text-sky-600">
                                                        <i class="fas fa-star mr-1 text-xs"></i>
                                                        <?php echo e($item->tipe_kamar); ?>

                                                    </span>
                                                </div>
                                                <div class="text-sm text-gray-700 max-w-xs truncate">
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
                                                                <span class="inline-block text-xs px-2 py-1 bg-gray-100 border-2 border-black mr-1 mb-1">
                                                                    <i class="fas fa-check text-emerald-400 mr-1"></i>
                                                                    <?php echo e($fasilitasItem); ?>

                                                                </span>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if(count($fasilitas) > 2): ?>
                                                                <span class="text-xs text-gray-500">
                                                                    +<?php echo e(count($fasilitas) - 2); ?> lagi
                                                                </span>
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <span class="text-gray-500">-</span>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <span class="text-gray-500">-</span>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-lg font-black text-black">
                                                    Rp <?php echo e(number_format($item->harga, 0, ',', '.')); ?>

                                                </div>
                                                <div class="text-xs text-gray-500">
                                                    per bulan
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex items-center px-3 py-1.5 text-xs font-black border-2 border-black
                                                    <?php echo e($item->status_kamar == 'tersedia' ? 'bg-emerald-400 text-black' :
                            ($item->status_kamar == 'terisi' ? 'bg-blue-400 text-black' :
                                'bg-yellow-400 text-black')); ?>">
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
                                                        class="inline-flex items-center px-3 py-1.5 bg-sky-400 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all text-sm uppercase tracking-wide">
                                                        <i class="fas fa-edit mr-2 text-xs"></i>
                                                        Edit
                                                    </a>
                                                    <button type="button"
                                                        data-ajax-action="/api/pemilik/kamar/<?php echo e($item->id_kamar); ?>"
                                                        data-ajax-method="DELETE"
                                                        data-confirm="Hapus kamar <?php echo e($item->nomor_kamar); ?>?"
                                                        data-success-msg="Kamar berhasil dihapus"
                                                        data-redirect="<?php echo e(route('pemilik.kamar.index')); ?>"
                                                        class="inline-flex items-center px-3 py-1.5 bg-red-400 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all text-sm uppercase tracking-wide">
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
                                            class="w-20 h-20 bg-gray-200 border-2 border-black shadow-[2px_2px_0px_#000] flex items-center justify-center mb-4">
                                            <i class="fas fa-bed text-sky-400 text-3xl"></i>
                                        </div>
                                        <h3 class="text-lg font-black text-black mb-2">Belum ada kamar</h3>
                                        <p class="text-gray-700 mb-4">Mulai tambahkan kamar pertama Anda</p>
                                        <a href="<?php echo e(route('pemilik.kamar.create')); ?>"
                                            class="inline-flex items-center px-4 py-2 bg-sky-400 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all uppercase tracking-wide text-sm">
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
            <div class="mt-4 px-6 py-4 bg-white border-4 border-black shadow-[4px_4px_0px_#000]">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                    <div class="text-sm text-gray-700">
                        Menampilkan <span class="font-black text-black"><?php echo e($kamar->firstItem()); ?></span> - 
                        <span class="font-black text-black"><?php echo e($kamar->lastItem()); ?></span> dari 
                        <span class="font-black text-black"><?php echo e($kamar->total()); ?></span> kamar
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
                class="inline-flex items-center px-6 py-3 bg-white text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all group">
                <i class="fas fa-arrow-left mr-3 transition-transform group-hover:-translate-x-1"></i>
                Kembali ke Dashboard
            </a>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/pemilik/kamar/index.blade.php ENDPATH**/ ?>