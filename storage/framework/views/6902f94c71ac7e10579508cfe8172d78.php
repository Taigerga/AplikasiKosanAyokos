<?php $__env->startSection('title', 'Detail Aduan - Admin AyoKos'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-6">
    <div class="mb-6">
        <div class="flex items-center gap-2 text-sm text-gray-600 mb-4">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="hover:text-black transition">Dashboard</a>
            <span>></span>
            <a href="<?php echo e(route('admin.aduan.index')); ?>" class="hover:text-black transition">Aduan</a>
            <span>></span>
            <span class="font-black text-black">Detail</span>
        </div>
        <h1 class="text-3xl font-black text-black">Detail Aduan</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <div class="flex items-start justify-between mb-4">
                    <h2 class="text-xl font-black"><?php echo e($aduan->judul); ?></h2>
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
                    <span class="<?php echo e($color); ?> border-2 border-black px-3 py-1 text-sm font-black whitespace-nowrap"><?php echo e(ucfirst($aduan->status)); ?></span>
                </div>

                <div class="flex items-center gap-2 mb-4">
                    <span class="bg-gray-200 border-2 border-black px-2 py-1 text-xs font-black"><?php echo e($aduan->kategori); ?></span>
                    <span class="text-sm font-bold text-gray-600"><?php echo e($aduan->created_at->format('d M Y H:i')); ?></span>
                </div>

                <div class="border-t-2 border-black pt-4">
                    <p class="font-bold text-gray-800 whitespace-pre-wrap"><?php echo e($aduan->deskripsi); ?></p>
                </div>

                <?php if($aduan->lampiran): ?>
                    <div class="mt-4 pt-4 border-t-2 border-black">
                        <p class="text-sm font-black mb-2">Lampiran:</p>
                        <a href="<?php echo e(asset('storage/' . $aduan->lampiran)); ?>" target="_blank" class="bg-black text-white font-black px-3 py-1 text-sm border-2 border-black inline-block">
                            <i class="fas fa-download mr-1"></i>Lihat Lampiran
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h3 class="text-lg font-black mb-4">Komentar</h3>

                <form action="<?php echo e(route('admin.aduan.komentar', $aduan->id_aduan)); ?>" method="POST" enctype="multipart/form-data" class="mb-6">
                    <?php echo csrf_field(); ?>
                    <div class="mb-4">
                        <label class="block text-sm font-black mb-1">Tambah Komentar</label>
                        <textarea name="isi" rows="3" class="w-full border-2 border-black px-3 py-2 font-bold focus:outline-none focus:ring-0" placeholder="Tulis komentar..." required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-black mb-1">Lampiran (opsional)</label>
                        <input type="file" name="lampiran" class="w-full border-2 border-black px-3 py-2 font-bold focus:outline-none focus:ring-0">
                    </div>
                    <button type="submit" class="bg-black text-white font-black px-6 py-2 border-2 border-black shadow-[4px_4px_0px_#000] hover:shadow-[2px_2px_0px_#000] transition-all">
                        <i class="fas fa-paper-plane mr-2"></i>Kirim Komentar
                    </button>
                </form>

                <div class="space-y-4">
                    <?php $__empty_1 = true; $__currentLoopData = $aduan->komentar->sortByDesc('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $komentar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="border-2 border-black p-4 <?php echo e($loop->first ? 'bg-blue-50' : ''); ?>">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-black"><?php echo e($komentar->pengirim->name ?? 'Sistem'); ?></span>
                                <span class="text-sm font-bold text-gray-500"><?php echo e($komentar->created_at->format('d M Y H:i')); ?></span>
                            </div>
                            <p class="font-bold text-gray-700 whitespace-pre-wrap"><?php echo e($komentar->isi); ?></p>
                            <?php if($komentar->lampiran): ?>
                                <a href="<?php echo e(asset('storage/' . $komentar->lampiran)); ?>" target="_blank" class="text-sm font-black text-blue-600 hover:underline mt-2 inline-block">
                                    <i class="fas fa-paperclip mr-1"></i>Lihat Lampiran
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-center font-bold text-gray-500 py-4">Belum ada komentar</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h3 class="text-lg font-black mb-4">Info Pengirim</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm font-black text-gray-500">Nama</p>
                        <p class="font-bold"><?php echo e($aduan->pengirim->name ?? '-'); ?></p>
                    </div>
                    <div>
                        <p class="text-sm font-black text-gray-500">Role</p>
                        <span class="bg-gray-200 border-2 border-black px-2 py-1 text-xs font-black"><?php echo e(ucfirst($aduan->pengirim_role)); ?></span>
                    </div>
                </div>
            </div>

            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h3 class="text-lg font-black mb-4">Update Status</h3>
                <form action="<?php echo e(route('admin.aduan.status', $aduan->id_aduan)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="mb-4">
                        <label class="block text-sm font-black mb-1">Status</label>
                        <select name="status" class="w-full border-2 border-black px-3 py-2 font-bold bg-white focus:outline-none focus:ring-0">
                            <option value="diajukan" <?php echo e($aduan->status == 'diajukan' ? 'selected' : ''); ?>>Diajukan</option>
                            <option value="ditinjau" <?php echo e($aduan->status == 'ditinjau' ? 'selected' : ''); ?>>Ditinjau</option>
                            <option value="diproses" <?php echo e($aduan->status == 'diproses' ? 'selected' : ''); ?>>Diproses</option>
                            <option value="menunggu_info" <?php echo e($aduan->status == 'menunggu_info' ? 'selected' : ''); ?>>Menunggu Info</option>
                            <option value="selesai" <?php echo e($aduan->status == 'selesai' ? 'selected' : ''); ?>>Selesai</option>
                            <option value="ditolak" <?php echo e($aduan->status == 'ditolak' ? 'selected' : ''); ?>>Ditolak</option>
                            <option value="ditutup" <?php echo e($aduan->status == 'ditutup' ? 'selected' : ''); ?>>Ditutup</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-black mb-1">Alasan (opsional)</label>
                        <textarea name="alasan" rows="3" class="w-full border-2 border-black px-3 py-2 font-bold focus:outline-none focus:ring-0" placeholder="Alasan perubahan status..."></textarea>
                    </div>
                    <button type="submit" class="w-full bg-black text-white font-black px-4 py-2 border-2 border-black shadow-[4px_4px_0px_#000] hover:shadow-[2px_2px_0px_#000] transition-all">
                        <i class="fas fa-sync-alt mr-2"></i>Update Status
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/admin/aduan/show.blade.php ENDPATH**/ ?>