<?php $__env->startSection('title', 'Kelola Kos - Admin AyoKos'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-4 md:p-6 lg:p-8 space-y-6 max-w-7xl mx-auto">
    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li><a href="<?php echo e(route('admin.dashboard')); ?>" class="text-sm font-bold text-gray-600 hover:text-black"><i class="fas fa-home mr-2"></i>Dashboard</a></li>
                <li><i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i></li>
                <li><span class="text-sm font-bold text-black">Kelola Kos</span></li>
            </ol>
        </nav>
    </div>

    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
            <h2 class="text-xl font-black"><i class="fas fa-home mr-3 text-emerald-500"></i>Daftar Kos</h2>
        </div>

        <form method="GET" class="flex flex-col md:flex-row gap-3 mb-6">
            <select name="status" class="border-2 border-black px-3 py-2 font-bold text-sm bg-white" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="aktif" <?php echo e(request('status') === 'aktif' ? 'selected' : ''); ?>>Aktif</option>
                <option value="nonaktif" <?php echo e(request('status') === 'nonaktif' ? 'selected' : ''); ?>>Nonaktif</option>
                <option value="pending" <?php echo e(request('status') === 'pending' ? 'selected' : ''); ?>>Pending</option>
            </select>
            <input type="text" name="search" placeholder="Cari nama kos..." value="<?php echo e(request('search')); ?>" class="border-2 border-black px-3 py-2 font-bold text-sm flex-1">
            <button type="submit" class="bg-sky-400 border-2 border-black shadow-[2px_2px_0px_#000] px-4 py-2 font-bold text-sm hover:shadow-[4px_4px_0px_#000] transition-all">
                <i class="fas fa-search mr-1"></i>Cari
            </button>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-black text-white">
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">ID</th>
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">Nama Kos</th>
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">Pemilik</th>
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">Kota</th>
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">Jenis</th>
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $kosList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-yellow-50">
                            <td class="border-2 border-black px-4 py-3 text-sm font-bold"><?php echo e($kos->id_kos); ?></td>
                            <td class="border-2 border-black px-4 py-3 text-sm font-bold"><?php echo e($kos->nama_kos); ?></td>
                            <td class="border-2 border-black px-4 py-3 text-sm"><?php echo e($kos->pemilik->nama ?? '-'); ?></td>
                            <td class="border-2 border-black px-4 py-3 text-sm"><?php echo e($kos->kota ?? '-'); ?></td>
                            <td class="border-2 border-black px-4 py-3 text-sm"><?php echo e(ucfirst($kos->jenis_kos)); ?></td>
                            <td class="border-2 border-black px-4 py-3 text-sm">
                                <?php
                                    $statusColors = ['aktif' => 'bg-emerald-400', 'nonaktif' => 'bg-red-400', 'pending' => 'bg-yellow-400'];
                                ?>
                                <span class="<?php echo e($statusColors[$kos->status_kos] ?? 'bg-gray-400'); ?> border-2 border-black px-2 py-1 text-xs font-bold"><?php echo e(ucfirst($kos->status_kos)); ?></span>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="border-2 border-black px-4 py-8 text-center text-gray-500 font-bold">
                                <i class="fas fa-home text-3xl block mb-2"></i>Tidak ada kos ditemukan.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4"><?php echo e($kosList->links('vendor.pagination.custom-dark')); ?></div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views\admin\kos\index.blade.php ENDPATH**/ ?>