<?php $__env->startSection('title', 'Kelola Aduan - Admin AyoKos'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-6">
    <div class="mb-6">
        <div class="flex items-center gap-2 text-sm text-gray-600 mb-4">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="hover:text-black transition">Dashboard</a>
            <span>></span>
            <span class="font-black text-black">Aduan</span>
        </div>
        <h1 class="text-3xl font-black text-black">Kelola Aduan</h1>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
        <div class="bg-white border-4 border-black p-4 shadow-[4px_4px_0px_#000]">
            <p class="text-sm font-black text-gray-600 uppercase">Total</p>
            <p class="text-2xl font-black mt-1"><?php echo e($statistik['total'] ?? 0); ?></p>
        </div>
        <div class="bg-yellow-300 border-4 border-black p-4 shadow-[4px_4px_0px_#000]">
            <p class="text-sm font-black text-gray-700 uppercase">Diajukan</p>
            <p class="text-2xl font-black mt-1"><?php echo e($statistik['diajukan'] ?? 0); ?></p>
        </div>
        <div class="bg-blue-300 border-4 border-black p-4 shadow-[4px_4px_0px_#000]">
            <p class="text-sm font-black text-gray-700 uppercase">Ditinjau</p>
            <p class="text-2xl font-black mt-1"><?php echo e($statistik['ditinjau'] ?? 0); ?></p>
        </div>
        <div class="bg-orange-300 border-4 border-black p-4 shadow-[4px_4px_0px_#000]">
            <p class="text-sm font-black text-gray-700 uppercase">Diproses</p>
            <p class="text-2xl font-black mt-1"><?php echo e($statistik['diproses'] ?? 0); ?></p>
        </div>
        <div class="bg-green-300 border-4 border-black p-4 shadow-[4px_4px_0px_#000]">
            <p class="text-sm font-black text-gray-700 uppercase">Selesai</p>
            <p class="text-2xl font-black mt-1"><?php echo e($statistik['selesai'] ?? 0); ?></p>
        </div>
        <div class="bg-red-300 border-4 border-black p-4 shadow-[4px_4px_0px_#000]">
            <p class="text-sm font-black text-gray-700 uppercase">Ditolak</p>
            <p class="text-2xl font-black mt-1"><?php echo e($statistik['ditolak'] ?? 0); ?></p>
        </div>
    </div>

    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
        <form method="GET" action="<?php echo e(route('admin.aduan.index')); ?>" class="flex flex-wrap gap-4 mb-6">
            <div>
                <label class="block text-sm font-black mb-1">Status</label>
                <select name="status" class="border-2 border-black px-3 py-2 font-bold bg-white focus:outline-none focus:ring-0">
                    <option value="">Semua Status</option>
                    <option value="diajukan" <?php echo e(request('status') == 'diajukan' ? 'selected' : ''); ?>>Diajukan</option>
                    <option value="ditinjau" <?php echo e(request('status') == 'ditinjau' ? 'selected' : ''); ?>>Ditinjau</option>
                    <option value="diproses" <?php echo e(request('status') == 'diproses' ? 'selected' : ''); ?>>Diproses</option>
                    <option value="menunggu_info" <?php echo e(request('status') == 'menunggu_info' ? 'selected' : ''); ?>>Menunggu Info</option>
                    <option value="selesai" <?php echo e(request('status') == 'selesai' ? 'selected' : ''); ?>>Selesai</option>
                    <option value="ditolak" <?php echo e(request('status') == 'ditolak' ? 'selected' : ''); ?>>Ditolak</option>
                    <option value="ditutup" <?php echo e(request('status') == 'ditutup' ? 'selected' : ''); ?>>Ditutup</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-black mb-1">Kategori</label>
                <select name="kategori" class="border-2 border-black px-3 py-2 font-bold bg-white focus:outline-none focus:ring-0">
                    <option value="">Semua Kategori</option>
                    <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($k); ?>" <?php echo e(request('kategori') == $k ? 'selected' : ''); ?>><?php echo e($k); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div>
                <label class="block text-sm font-black mb-1">Role</label>
                <select name="role" class="border-2 border-black px-3 py-2 font-bold bg-white focus:outline-none focus:ring-0">
                    <option value="">Semua Role</option>
                    <option value="penghuni" <?php echo e(request('role') == 'penghuni' ? 'selected' : ''); ?>>Penghuni</option>
                    <option value="pemilik" <?php echo e(request('role') == 'pemilik' ? 'selected' : ''); ?>>Pemilik</option>
                </select>
            </div>
            <div class="self-end">
                <button type="submit" class="bg-black text-white font-black px-6 py-2 border-2 border-black shadow-[4px_4px_0px_#000] hover:shadow-[2px_2px_0px_#000] transition-all">
                    <i class="fas fa-filter mr-2"></i>Filter
                </button>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 border-b-4 border-black">
                        <th class="text-left px-4 py-3 font-black text-sm">No</th>
                        <th class="text-left px-4 py-3 font-black text-sm">Judul</th>
                        <th class="text-left px-4 py-3 font-black text-sm">Kategori</th>
                        <th class="text-left px-4 py-3 font-black text-sm">Pengirim</th>
                        <th class="text-left px-4 py-3 font-black text-sm">Status</th>
                        <th class="text-left px-4 py-3 font-black text-sm">Tanggal</th>
                        <th class="text-left px-4 py-3 font-black text-sm">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $aduans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $aduan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-b-2 border-black hover:bg-gray-50">
                            <td class="px-4 py-3 font-bold"><?php echo e($loop->iteration); ?></td>
                            <td class="px-4 py-3 font-bold"><?php echo e($aduan->judul); ?></td>
                            <td class="px-4 py-3">
                                <span class="bg-gray-200 border-2 border-black px-2 py-1 text-xs font-black"><?php echo e($aduan->kategori); ?></span>
                            </td>
                            <td class="px-4 py-3 font-bold"><?php echo e($aduan->pengirim->name ?? '-'); ?></td>
                            <td class="px-4 py-3">
                                <?php
                                    $statusColors = [
                                        'diajukan' => 'bg-yellow-300',
                                        'ditinjau' => 'bg-blue-300',
                                        'diproses' => 'bg-orange-300',
                                        'menunggu_info' => 'bg-purple-300',
                                        'selesai' => 'bg-green-300',
                                        'ditolak' => 'bg-red-300',
                                        'ditutup' => 'bg-gray-300',
                                    ];
                                    $color = $statusColors[$aduan->status] ?? 'bg-gray-200';
                                ?>
                                <span class="<?php echo e($color); ?> border-2 border-black px-2 py-1 text-xs font-black"><?php echo e(ucfirst($aduan->status)); ?></span>
                            </td>
                            <td class="px-4 py-3 font-bold"><?php echo e($aduan->created_at->format('d M Y')); ?></td>
                            <td class="px-4 py-3">
                                <a href="<?php echo e(route('admin.aduan.show', $aduan->id_aduan)); ?>" class="bg-black text-white font-black px-3 py-1 text-sm border-2 border-black shadow-[3px_3px_0px_#000] hover:shadow-[1px_1px_0px_#000] transition-all inline-block">
                                    <i class="fas fa-eye mr-1"></i>Detail
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center font-bold text-gray-500">Belum ada aduan</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            <?php echo e($aduans->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/admin/aduan/index.blade.php ENDPATH**/ ?>