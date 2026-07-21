<?php $__env->startSection('title', 'Data Pemilik - Admin AyoKos'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-6">
    <div class="mb-6">
        <div class="flex items-center gap-2 text-sm text-gray-600 mb-4">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="hover:text-black transition">Dashboard</a>
            <span>></span>
            <span class="font-black text-black">Data Pemilik</span>
        </div>
        <h1 class="text-3xl font-black text-black">Data Pemilik</h1>
    </div>

    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
        <form method="GET" action="<?php echo e(route('admin.data-pemilik.index')); ?>" class="flex flex-wrap gap-4 mb-6">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-sm font-black mb-1">Cari</label>
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Nama / Email / No HP" class="w-full border-2 border-black px-3 py-2 font-bold focus:outline-none focus:ring-0">
            </div>
            <div>
                <label class="block text-sm font-black mb-1">Status</label>
                <select name="status" class="border-2 border-black px-3 py-2 font-bold bg-white focus:outline-none focus:ring-0">
                    <option value="">Semua Status</option>
                    <option value="aktif" <?php echo e(request('status') == 'aktif' ? 'selected' : ''); ?>>Aktif</option>
                    <option value="nonaktif" <?php echo e(request('status') == 'nonaktif' ? 'selected' : ''); ?>>Nonaktif</option>
                    <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>Pending</option>
                    <option value="dibatasi" <?php echo e(request('status') == 'dibatasi' ? 'selected' : ''); ?>>Dibatasi</option>
                    <option value="diblokir" <?php echo e(request('status') == 'diblokir' ? 'selected' : ''); ?>>Diblokir</option>
                </select>
            </div>
            <div class="self-end">
                <button type="submit" class="bg-black text-white font-black px-6 py-2 border-2 border-black shadow-[4px_4px_0px_#000] hover:shadow-[2px_2px_0px_#000] transition-all">
                    <i class="fas fa-search mr-2"></i>Cari
                </button>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 border-b-4 border-black">
                        <th class="text-left px-4 py-3 font-black text-sm">No</th>
                        <th class="text-left px-4 py-3 font-black text-sm">Nama</th>
                        <th class="text-left px-4 py-3 font-black text-sm">Email</th>
                        <th class="text-left px-4 py-3 font-black text-sm">No HP</th>
                        <th class="text-left px-4 py-3 font-black text-sm">Status</th>
                        <th class="text-left px-4 py-3 font-black text-sm">Tanggal Daftar</th>
                        <th class="text-left px-4 py-3 font-black text-sm">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $dataPemilik; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $pemilik): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-b-2 border-black hover:bg-gray-50">
                            <td class="px-4 py-3 font-bold"><?php echo e($loop->iteration); ?></td>
                            <td class="px-4 py-3 font-bold"><?php echo e($pemilik->user->name ?? $pemilik->name ?? '-'); ?></td>
                            <td class="px-4 py-3 font-bold"><?php echo e($pemilik->user->email ?? $pemilik->email ?? '-'); ?></td>
                            <td class="px-4 py-3 font-bold"><?php echo e($pemilik->no_hp ?? '-'); ?></td>
                            <td class="px-4 py-3">
                                <?php
                                    $statusColor = [
                                        'aktif' => 'bg-green-300',
                                        'nonaktif' => 'bg-gray-300',
                                        'pending' => 'bg-yellow-300',
                                        'dibatasi' => 'bg-orange-300',
                                        'diblokir' => 'bg-red-300',
                                    ];
                                    $st = $pemilik->status ?? 'aktif';
                                    $sc = $statusColor[$st] ?? 'bg-gray-200';
                                ?>
                                <span class="<?php echo e($sc); ?> border-2 border-black px-2 py-1 text-xs font-black"><?php echo e(ucfirst($st)); ?></span>
                            </td>
                            <td class="px-4 py-3 font-bold"><?php echo e(($pemilik->created_at ?? now())->format('d M Y')); ?></td>
                            <td class="px-4 py-3">
                                <a href="<?php echo e(route('admin.data-pemilik.show', $pemilik->id_pemilik)); ?>" class="bg-black text-white font-black px-3 py-1 text-sm border-2 border-black shadow-[3px_3px_0px_#000] hover:shadow-[1px_1px_0px_#000] transition-all inline-block">
                                    <i class="fas fa-eye mr-1"></i>Lihat
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center font-bold text-gray-500">Tidak ada data pemilik</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            <?php echo e($dataPemilik->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/admin/data-pemilik/index.blade.php ENDPATH**/ ?>