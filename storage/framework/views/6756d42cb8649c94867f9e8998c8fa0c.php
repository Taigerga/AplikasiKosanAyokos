<?php $__env->startSection('title', 'Kelola Pembayaran - Admin AyoKos'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-4 md:p-6 lg:p-8 space-y-6 max-w-7xl mx-auto">
    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li><a href="<?php echo e(route('admin.dashboard')); ?>" class="text-sm font-bold text-gray-600 hover:text-black"><i class="fas fa-home mr-2"></i>Dashboard</a></li>
                <li><i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i></li>
                <li><span class="text-sm font-bold text-black">Pembayaran</span></li>
            </ol>
        </nav>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
            <p class="text-3xl font-black text-black"><?php echo e($stats['total']); ?></p>
            <p class="text-sm font-bold text-gray-600">Total Transaksi</p>
        </div>
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
            <p class="text-3xl font-black text-emerald-500"><?php echo e($stats['lunas']); ?></p>
            <p class="text-sm font-bold text-gray-600">Lunas</p>
        </div>
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
            <p class="text-3xl font-black text-yellow-500"><?php echo e($stats['pending']); ?></p>
            <p class="text-sm font-bold text-gray-600">Pending</p>
        </div>
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
            <p class="text-3xl font-black text-purple-500">Rp <?php echo e(number_format($stats['total_bulan_ini'], 0, ',', '.')); ?></p>
            <p class="text-sm font-bold text-gray-600">Pendapatan Bulan Ini</p>
        </div>
    </div>

    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
        <h2 class="text-xl font-black mb-6"><i class="fas fa-credit-card mr-3 text-purple-500"></i>Daftar Pembayaran</h2>

        <form method="GET" class="mb-6">
            <select name="status" class="border-2 border-black px-3 py-2 font-bold text-sm bg-white" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="lunas" <?php echo e(request('status') === 'lunas' ? 'selected' : ''); ?>>Lunas</option>
                <option value="pending" <?php echo e(request('status') === 'pending' ? 'selected' : ''); ?>>Pending</option>
                <option value="belum" <?php echo e(request('status') === 'belum' ? 'selected' : ''); ?>>Belum Bayar</option>
                <option value="terlambat" <?php echo e(request('status') === 'terlambat' ? 'selected' : ''); ?>>Terlambat</option>
            </select>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-black text-white">
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">ID</th>
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">Penghuni</th>
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">Kos</th>
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">Periode</th>
                        <th class="border-2 border-black px-4 py-3 text-right text-sm font-bold">Jumlah</th>
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">Status</th>
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">Tanggal Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $pembayaranList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-yellow-50">
                            <td class="border-2 border-black px-4 py-3 text-sm font-bold"><?php echo e($p->id_pembayaran); ?></td>
                            <td class="border-2 border-black px-4 py-3 text-sm"><?php echo e($p->penghuni->nama ?? '-'); ?></td>
                            <td class="border-2 border-black px-4 py-3 text-sm font-bold"><?php echo e($p->kontrak->kos->nama_kos ?? '-'); ?></td>
                            <td class="border-2 border-black px-4 py-3 text-sm"><?php echo e($p->bulan_tahun); ?></td>
                            <td class="border-2 border-black px-4 py-3 text-sm font-bold text-right">Rp <?php echo e(number_format($p->total_bayar ?? $p->jumlah, 0, ',', '.')); ?></td>
                            <td class="border-2 border-black px-4 py-3 text-sm">
                                <?php
                                    $sc = ['lunas' => 'bg-emerald-400', 'pending' => 'bg-yellow-400', 'belum' => 'bg-gray-400', 'terlambat' => 'bg-red-400'];
                                ?>
                                <span class="<?php echo e($sc[$p->status_pembayaran] ?? 'bg-gray-400'); ?> border-2 border-black px-2 py-1 text-xs font-bold"><?php echo e(ucfirst($p->status_pembayaran)); ?></span>
                            </td>
                            <td class="border-2 border-black px-4 py-3 text-sm"><?php echo e($p->tanggal_bayar ? $p->tanggal_bayar->format('d/m/Y') : '-'); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="border-2 border-black px-4 py-8 text-center text-gray-500 font-bold">
                                <i class="fas fa-credit-card text-3xl block mb-2"></i>Tidak ada pembayaran ditemukan.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4"><?php echo e($pembayaranList->links('vendor.pagination.custom-dark')); ?></div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/admin/pembayaran/index.blade.php ENDPATH**/ ?>