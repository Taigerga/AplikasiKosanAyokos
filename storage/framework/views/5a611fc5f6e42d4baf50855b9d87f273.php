<?php $__env->startSection('title', 'Laporan - Admin AyoKos'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-4 md:p-6 lg:p-8 space-y-6 max-w-7xl mx-auto">
    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li><a href="<?php echo e(route('admin.dashboard')); ?>" class="text-sm font-bold text-gray-600 hover:text-black"><i class="fas fa-home mr-2"></i>Dashboard</a></li>
                <li><i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i></li>
                <li><span class="text-sm font-bold text-black">Laporan</span></li>
            </ol>
        </nav>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
            <h3 class="text-sm font-bold text-gray-600 mb-2"><i class="fas fa-users mr-2"></i>Sebaran Pengguna</h3>
            <div class="space-y-2">
                <?php $__currentLoopData = $sebaranRole; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-bold capitalize"><?php echo e($role); ?></span>
                        <span class="font-black text-lg"><?php echo e($count); ?></span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
            <h3 class="text-sm font-bold text-gray-600 mb-2"><i class="fas fa-home mr-2"></i>Kos Terpopuler</h3>
            <?php $__empty_1 = true; $__currentLoopData = $kosTerpopuler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="flex justify-between items-center mb-1">
                    <span class="text-sm font-bold truncate"><?php echo e($kos->nama_kos); ?></span>
                    <span class="text-xs font-bold bg-emerald-400 border border-black px-1"><?php echo e($kos->kontrak_sewa_count); ?> kontrak</span>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-sm text-gray-500">Belum ada data.</p>
            <?php endif; ?>
        </div>

        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
            <h3 class="text-sm font-bold text-gray-600 mb-2"><i class="fas fa-chart-line mr-2"></i>Pendapatan Terakhir</h3>
            <?php $__empty_1 = true; $__currentLoopData = $pendapatanBulanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="flex justify-between items-center mb-1">
                    <span class="text-sm font-bold"><?php echo e(date('M Y', mktime(0, 0, 0, $p->bulan, 1, $p->tahun))); ?></span>
                    <span class="text-xs font-bold">Rp <?php echo e(number_format($p->total, 0, ',', '.')); ?></span>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-sm text-gray-500">Belum ada data pendapatan.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
        <h2 class="text-lg font-black mb-4"><i class="fas fa-file-alt mr-3 text-orange-500"></i>Statistik Kontrak</h2>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-black text-white">
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">Periode</th>
                        <th class="border-2 border-black px-4 py-3 text-right text-sm font-bold">Jumlah Kontrak Baru</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $kontrakPerBulan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-yellow-50">
                            <td class="border-2 border-black px-4 py-3 text-sm font-bold"><?php echo e(date('M Y', mktime(0, 0, 0, $k->bulan, 1, $k->tahun))); ?></td>
                            <td class="border-2 border-black px-4 py-3 text-sm font-bold text-right"><?php echo e($k->total); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="2" class="border-2 border-black px-4 py-8 text-center text-gray-500 font-bold">Belum ada data kontrak.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/admin/laporan/index.blade.php ENDPATH**/ ?>