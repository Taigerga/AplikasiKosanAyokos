<?php $__env->startSection('title', 'Keuangan Platform - Admin AyoKos'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-6">
    <div class="mb-6">
        <div class="flex items-center gap-2 text-sm text-gray-600 mb-4">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="hover:text-black transition">Dashboard</a>
            <span>></span>
            <span class="font-black text-black">Keuangan Platform</span>
        </div>
        <h1 class="text-3xl font-black text-black">Keuangan Platform</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
        <div class="bg-green-300 border-4 border-black p-4 shadow-[4px_4px_0px_#000]">
            <p class="text-sm font-black text-gray-700 uppercase">Total Pendapatan Platform</p>
            <p class="text-2xl font-black mt-1">Rp<?php echo e(number_format($ringkasan['totalPendapatanPlatform'] ?? 0, 0, ',', '.')); ?></p>
        </div>
        <div class="bg-blue-300 border-4 border-black p-4 shadow-[4px_4px_0px_#000]">
            <p class="text-sm font-black text-gray-700 uppercase">Tahun Ini</p>
            <p class="text-2xl font-black mt-1">Rp<?php echo e(number_format($ringkasan['totalPendapatanTahun'] ?? 0, 0, ',', '.')); ?></p>
        </div>
        <div class="bg-yellow-300 border-4 border-black p-4 shadow-[4px_4px_0px_#000]">
            <p class="text-sm font-black text-gray-700 uppercase">Bulan Ini</p>
            <p class="text-2xl font-black mt-1">Rp<?php echo e(number_format($ringkasan['totalPendapatanBulan'] ?? 0, 0, ',', '.')); ?></p>
        </div>
        <div class="bg-purple-300 border-4 border-black p-4 shadow-[4px_4px_0px_#000]">
            <p class="text-sm font-black text-gray-700 uppercase">Total Transaksi Lunas</p>
            <p class="text-2xl font-black mt-1"><?php echo e($ringkasan['totalTransaksiLunas'] ?? 0); ?></p>
        </div>
        <div class="bg-orange-300 border-4 border-black p-4 shadow-[4px_4px_0px_#000]">
            <p class="text-sm font-black text-gray-700 uppercase">Transaksi Tahun Ini</p>
            <p class="text-2xl font-black mt-1"><?php echo e($ringkasan['totalTransaksiTahun'] ?? 0); ?></p>
        </div>
    </div>

    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 mb-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-black">Pendapatan Bulanan</h2>
            <form method="GET" action="<?php echo e(route('admin.keuangan.index')); ?>" class="flex items-center gap-2">
                <label class="text-sm font-black">Tahun:</label>
                <select name="tahun" class="border-2 border-black px-3 py-2 font-bold bg-white focus:outline-none focus:ring-0" onchange="this.form.submit()">
                    <?php for($t = date('Y'); $t >= date('Y') - 5; $t--): ?>
                        <option value="<?php echo e($t); ?>" <?php echo e(request('tahun', date('Y')) == $t ? 'selected' : ''); ?>><?php echo e($t); ?></option>
                    <?php endfor; ?>
                </select>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 border-b-4 border-black">
                        <th class="text-left px-4 py-3 font-black text-sm">Bulan</th>
                        <th class="text-left px-4 py-3 font-black text-sm">Pendapatan Pemilik (90%)</th>
                        <th class="text-left px-4 py-3 font-black text-sm">Pendapatan Platform (10%)</th>
                        <th class="text-left px-4 py-3 font-black text-sm">Jumlah Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $pendapatanBulanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-b-2 border-black hover:bg-gray-50">
                            <td class="px-4 py-3 font-bold"><?php echo e($item->bulan_nama ?? $item['bulan_nama'] ?? '-'); ?></td>
                            <td class="px-4 py-3 font-bold">Rp<?php echo e(number_format($item->pendapatan_pemilik ?? $item['pendapatan_pemilik'] ?? 0, 0, ',', '.')); ?></td>
                            <td class="px-4 py-3 font-bold text-green-700">Rp<?php echo e(number_format($item->pendapatan_platform ?? $item['pendapatan_platform'] ?? 0, 0, ',', '.')); ?></td>
                            <td class="px-4 py-3 font-bold"><?php echo e($item->jumlah_transaksi ?? $item['jumlah_transaksi'] ?? 0); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center font-bold text-gray-500">Belum ada data</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 mb-6">
        <h2 class="text-xl font-black mb-4">Transaksi Terbaru</h2>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 border-b-4 border-black">
                        <th class="text-left px-4 py-3 font-black text-sm">Kos</th>
                        <th class="text-left px-4 py-3 font-black text-sm">Penghuni</th>
                        <th class="text-left px-4 py-3 font-black text-sm">Tanggal</th>
                        <th class="text-left px-4 py-3 font-black text-sm">Total Bayar</th>
                        <th class="text-left px-4 py-3 font-black text-sm">Bagian Pemilik</th>
                        <th class="text-left px-4 py-3 font-black text-sm">Bagian Platform</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $transaksiTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-b-2 border-black hover:bg-gray-50">
                            <td class="px-4 py-3 font-bold"><?php echo e($t->kos->nama_kos ?? $t['nama_kos'] ?? '-'); ?></td>
                            <td class="px-4 py-3 font-bold"><?php echo e($t->penghuni->user->name ?? $t['nama_penghuni'] ?? '-'); ?></td>
                            <td class="px-4 py-3 font-bold"><?php echo e(($t->created_at ?? $t['tanggal'] ?? now())->format('d M Y')); ?></td>
                            <td class="px-4 py-3 font-bold">Rp<?php echo e(number_format($t->total_bayar ?? $t['total_bayar'] ?? 0, 0, ',', '.')); ?></td>
                            <td class="px-4 py-3 font-bold">Rp<?php echo e(number_format($t->bagian_pemilik ?? $t['bagian_pemilik'] ?? 0, 0, ',', '.')); ?></td>
                            <td class="px-4 py-3 font-bold text-green-700">Rp<?php echo e(number_format($t->bagian_platform ?? $t['bagian_platform'] ?? 0, 0, ',', '.')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center font-bold text-gray-500">Belum ada transaksi</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-black">Statistik per Pemilik</h2>
            <?php $totalPemilikBerbayar = count($statistikPemilik); ?>
            <span class="bg-green-300 border-2 border-black px-3 py-1 text-sm font-black">Total Pemilik Berbayar: <?php echo e($totalPemilikBerbayar); ?></span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 border-b-4 border-black">
                        <th class="text-left px-4 py-3 font-black text-sm">Nama Kos</th>
                        <th class="text-left px-4 py-3 font-black text-sm">Pendapatan Pemilik</th>
                        <th class="text-left px-4 py-3 font-black text-sm">Pendapatan Platform</th>
                        <th class="text-left px-4 py-3 font-black text-sm">Jumlah Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $statistikPemilik; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-b-2 border-black hover:bg-gray-50">
                            <td class="px-4 py-3 font-bold"><?php echo e($sp->nama_kos ?? $sp['nama_kos'] ?? '-'); ?></td>
                            <td class="px-4 py-3 font-bold">Rp<?php echo e(number_format($sp->pendapatan_pemilik ?? $sp['pendapatan_pemilik'] ?? 0, 0, ',', '.')); ?></td>
                            <td class="px-4 py-3 font-bold text-green-700">Rp<?php echo e(number_format($sp->pendapatan_platform ?? $sp['pendapatan_platform'] ?? 0, 0, ',', '.')); ?></td>
                            <td class="px-4 py-3 font-bold"><?php echo e($sp->jumlah_transaksi ?? $sp['jumlah_transaksi'] ?? 0); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center font-bold text-gray-500">Belum ada data</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/admin/keuangan/index.blade.php ENDPATH**/ ?>