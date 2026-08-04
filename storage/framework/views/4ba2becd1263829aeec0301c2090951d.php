<?php $__env->startSection('title', 'Detail Pemilik - Admin AyoKos'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-6">
    <div class="mb-6">
        <div class="flex items-center gap-2 text-sm text-gray-600 mb-4">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="hover:text-black transition">Dashboard</a>
            <span>></span>
            <a href="<?php echo e(route('admin.data-pemilik.index')); ?>" class="hover:text-black transition">Data Pemilik</a>
            <span>></span>
            <span class="font-black text-black">Detail</span>
        </div>
        <h1 class="text-3xl font-black text-black">Detail Pemilik</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <h2 class="text-xl font-black mb-4">Informasi User</h2>
            <div class="space-y-3">
                <div>
                    <p class="text-sm font-black text-gray-500">Username</p>
                    <p class="font-bold text-lg"><?php echo e($pemilik->user->username ?? $pemilik->username ?? '-'); ?></p>
                </div>
                <div>
                    <p class="text-sm font-black text-gray-500">Role</p>
                    <span class="bg-blue-200 border-2 border-black px-2 py-1 text-xs font-black">Pemilik</span>
                </div>
            </div>
        </div>

        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <h2 class="text-xl font-black mb-4">Informasi Pemilik</h2>
            <div class="space-y-3">
                <div>
                    <p class="text-sm font-black text-gray-500">Nama</p>
                    <p class="font-bold"><?php echo e($pemilik->user->name ?? $pemilik->name ?? '-'); ?></p>
                </div>
                <div>
                    <p class="text-sm font-black text-gray-500">Email</p>
                    <p class="font-bold"><?php echo e($pemilik->user->email ?? $pemilik->email ?? '-'); ?></p>
                </div>
                <div>
                    <p class="text-sm font-black text-gray-500">No HP</p>
                    <p class="font-bold"><?php echo e($pemilik->no_hp ?? '-'); ?></p>
                </div>
                <div>
                    <p class="text-sm font-black text-gray-500">Jenis Kelamin</p>
                    <p class="font-bold"><?php echo e($pemilik->jenis_kelamin ?? '-'); ?></p>
                </div>
                <div>
                    <p class="text-sm font-black text-gray-500">Tanggal Lahir</p>
                    <p class="font-bold"><?php echo e(isset($pemilik->tanggal_lahir) ? \Carbon\Carbon::parse($pemilik->tanggal_lahir)->format('d M Y') : '-'); ?></p>
                </div>
                <div>
                    <p class="text-sm font-black text-gray-500">Alamat</p>
                    <p class="font-bold"><?php echo e($pemilik->alamat ?? '-'); ?></p>
                </div>
                <div>
                    <p class="text-sm font-black text-gray-500">Status</p>
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
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <h2 class="text-xl font-black mb-4">Update Status</h2>
            <form action="<?php echo e(route('admin.data-pemilik.status', $pemilik->id_pemilik)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-black mb-1">Status</label>
                        <select name="status" class="w-full border-2 border-black px-3 py-2 font-bold bg-white focus:outline-none focus:ring-0">
                            <option value="aktif" <?php echo e($pemilik->status == 'aktif' ? 'selected' : ''); ?>>Aktif</option>
                            <option value="nonaktif" <?php echo e($pemilik->status == 'nonaktif' ? 'selected' : ''); ?>>Nonaktif</option>
                            <option value="dibatasi" <?php echo e($pemilik->status == 'dibatasi' ? 'selected' : ''); ?>>Dibatasi</option>
                            <option value="diblokir" <?php echo e($pemilik->status == 'diblokir' ? 'selected' : ''); ?>>Diblokir</option>
                        </select>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-black mb-1">Alasan</label>
                    <textarea name="alasan" rows="3" class="w-full border-2 border-black px-3 py-2 font-bold focus:outline-none focus:ring-0" placeholder="Alasan (wajib jika dibatasi/diblokir)"><?php echo e(old('alasan')); ?></textarea>
                </div>
                <button type="submit" class="bg-black text-white font-black px-6 py-2 border-2 border-black shadow-[4px_4px_0px_#000] hover:shadow-[2px_2px_0px_#000] transition-all">
                    <i class="fas fa-save mr-2"></i>Update Status
                </button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views\admin\data-pemilik\show.blade.php ENDPATH**/ ?>