<?php $__env->startSection('title', 'Kelola Kontrak - Admin AyoKos'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-4 md:p-6 lg:p-8 space-y-6 max-w-7xl mx-auto">
    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li><a href="<?php echo e(route('admin.dashboard')); ?>" class="text-sm font-bold text-gray-600 hover:text-black"><i class="fas fa-home mr-2"></i>Dashboard</a></li>
                <li><i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i></li>
                <li><span class="text-sm font-bold text-black">Kelola Kontrak</span></li>
            </ol>
        </nav>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
            <p class="text-3xl font-black text-black"><?php echo e($stats['total']); ?></p>
            <p class="text-sm font-bold text-gray-600">Total Kontrak</p>
        </div>
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
            <p class="text-3xl font-black text-yellow-500"><?php echo e($stats['pending']); ?></p>
            <p class="text-sm font-bold text-gray-600">Pending</p>
        </div>
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
            <p class="text-3xl font-black text-emerald-500"><?php echo e($stats['aktif']); ?></p>
            <p class="text-sm font-bold text-gray-600">Aktif</p>
        </div>
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
            <p class="text-3xl font-black text-blue-500"><?php echo e($stats['selesai']); ?></p>
            <p class="text-sm font-bold text-gray-600">Selesai</p>
        </div>
    </div>

    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
        <h2 class="text-xl font-black mb-6"><i class="fas fa-file-contract mr-3 text-yellow-500"></i>Daftar Kontrak</h2>

        <form method="GET" class="mb-6">
            <select name="status" class="border-2 border-black px-3 py-2 font-bold text-sm bg-white" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="pending" <?php echo e(request('status') === 'pending' ? 'selected' : ''); ?>>Pending</option>
                <option value="aktif" <?php echo e(request('status') === 'aktif' ? 'selected' : ''); ?>>Aktif</option>
                <option value="selesai" <?php echo e(request('status') === 'selesai' ? 'selected' : ''); ?>>Selesai</option>
                <option value="ditolak" <?php echo e(request('status') === 'ditolak' ? 'selected' : ''); ?>>Ditolak</option>
            </select>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-black text-white">
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">ID</th>
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">Penghuni</th>
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">Kos</th>
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">Kamar</th>
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">Mulai</th>
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">Selesai</th>
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $kontrakList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-yellow-50">
                            <td class="border-2 border-black px-4 py-3 text-sm font-bold"><?php echo e($k->id_kontrak); ?></td>
                            <td class="border-2 border-black px-4 py-3 text-sm"><?php echo e($k->penghuni->nama ?? '-'); ?></td>
                            <td class="border-2 border-black px-4 py-3 text-sm font-bold"><?php echo e($k->kos->nama_kos ?? '-'); ?></td>
                            <td class="border-2 border-black px-4 py-3 text-sm"><?php echo e($k->kamar->nomor_kamar ?? '-'); ?></td>
                            <td class="border-2 border-black px-4 py-3 text-sm"><?php echo e($k->tanggal_mulai ? $k->tanggal_mulai->format('d/m/Y') : '-'); ?></td>
                            <td class="border-2 border-black px-4 py-3 text-sm"><?php echo e($k->tanggal_selesai ? $k->tanggal_selesai->format('d/m/Y') : '-'); ?></td>
                            <td class="border-2 border-black px-4 py-3 text-sm">
                                <?php
                                    $c = ['pending' => 'bg-yellow-400', 'aktif' => 'bg-emerald-400', 'selesai' => 'bg-blue-400', 'ditolak' => 'bg-red-400'];
                                ?>
                                <span class="<?php echo e($c[$k->status_kontrak] ?? 'bg-gray-400'); ?> border-2 border-black px-2 py-1 text-xs font-bold"><?php echo e(ucfirst($k->status_kontrak)); ?></span>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="border-2 border-black px-4 py-8 text-center text-gray-500 font-bold">
                                <i class="fas fa-file-contract text-3xl block mb-2"></i>Tidak ada kontrak ditemukan.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4"><?php echo e($kontrakList->links('vendor.pagination.custom-dark')); ?></div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/admin/kontrak/index.blade.php ENDPATH**/ ?>