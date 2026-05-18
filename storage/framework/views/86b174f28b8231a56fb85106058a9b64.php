<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <?php if(session('success')): ?>
        <div class="bg-emerald-400 border-2 border-black text-black font-bold px-4 py-3 shadow-[3px_3px_0px_#000]">
            <div class="flex items-center"><i class="fas fa-check-circle mr-3"></i><?php echo e(session('success')); ?></div>
        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="bg-red-400 border-2 border-black text-black font-bold px-4 py-3 shadow-[3px_3px_0px_#000]">
            <div class="flex items-center"><i class="fas fa-exclamation-circle mr-3"></i><?php echo e(session('error')); ?></div>
        </div>
    <?php endif; ?>

    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-black text-black mb-2">Selamat Datang, <?php echo e(Auth::user()->nama ?? Auth::user()->name); ?>!</h1>
                <p class="text-gray-700 font-bold">Panel administrasi sistem AyoKos. Kelola seluruh aspek aplikasi dari sini.</p>
            </div>
            <div class="text-sm text-gray-600 font-black bg-yellow-400 border-2 border-black px-3 py-2">
                <i class="fas fa-calendar-alt mr-2"></i>
                <?php echo e(now()->format('l, d F Y')); ?>

            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 hover:shadow-[6px_6px_0px_#000] hover:-translate-y-1 transition-all">
            <div class="w-12 h-12 bg-sky-400 border-2 border-black flex items-center justify-center mb-4">
                <i class="fas fa-users text-black text-xl"></i>
            </div>
            <h3 class="text-3xl font-black text-black mb-1"><?php echo e($stats['total_users']); ?></h3>
            <p class="text-gray-600 font-bold text-sm">Total Users</p>
        </div>

        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 hover:shadow-[6px_6px_0px_#000] hover:-translate-y-1 transition-all">
            <div class="w-12 h-12 bg-emerald-400 border-2 border-black flex items-center justify-center mb-4">
                <i class="fas fa-home text-black text-xl"></i>
            </div>
            <h3 class="text-3xl font-black text-black mb-1"><?php echo e($stats['total_kos']); ?></h3>
            <p class="text-gray-600 font-bold text-sm">Total Kos</p>
        </div>

        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 hover:shadow-[6px_6px_0px_#000] hover:-translate-y-1 transition-all">
            <div class="w-12 h-12 bg-yellow-400 border-2 border-black flex items-center justify-center mb-4">
                <i class="fas fa-file-contract text-black text-xl"></i>
            </div>
            <h3 class="text-3xl font-black text-black mb-1"><?php echo e($stats['total_kontrak_aktif']); ?></h3>
            <p class="text-gray-600 font-bold text-sm">Kontrak Aktif</p>
        </div>

        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 hover:shadow-[6px_6px_0px_#000] hover:-translate-y-1 transition-all">
            <div class="w-12 h-12 bg-purple-400 border-2 border-black flex items-center justify-center mb-4">
                <i class="fas fa-credit-card text-black text-xl"></i>
            </div>
            <h3 class="text-3xl font-black text-black mb-1">Rp <?php echo e(number_format($stats['total_pembayaran_bulan_ini'], 0, ',', '.')); ?></h3>
            <p class="text-gray-600 font-bold text-sm">Pembayaran Bulan Ini</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 bg-sky-400 border-2 border-black flex items-center justify-center">
                    <i class="fas fa-user-tie text-black"></i>
                </div>
                <h3 class="text-lg font-black text-black">Pemilik</h3>
            </div>
            <p class="text-3xl font-black text-black"><?php echo e($stats['total_pemilik']); ?></p>
        </div>

        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 bg-emerald-400 border-2 border-black flex items-center justify-center">
                    <i class="fas fa-user text-black"></i>
                </div>
                <h3 class="text-lg font-black text-black">Penghuni</h3>
            </div>
            <p class="text-3xl font-black text-black"><?php echo e($stats['total_penghuni']); ?></p>
        </div>

        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 bg-red-400 border-2 border-black flex items-center justify-center">
                    <i class="fas fa-user-shield text-black"></i>
                </div>
                <h3 class="text-lg font-black text-black">Admin</h3>
            </div>
            <p class="text-3xl font-black text-black"><?php echo e($stats['total_admin']); ?></p>
        </div>
    </div>

    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
        <h3 class="text-lg font-black text-black mb-4">Quick Actions</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="<?php echo e(route('admin.users.index')); ?>" class="flex flex-col items-center gap-2 p-4 bg-sky-400 hover:bg-sky-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all">
                <i class="fas fa-users text-2xl"></i>
                <span class="text-sm">Kelola User</span>
            </a>
            <a href="<?php echo e(route('admin.kos.index')); ?>" class="flex flex-col items-center gap-2 p-4 bg-emerald-400 hover:bg-emerald-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all">
                <i class="fas fa-home text-2xl"></i>
                <span class="text-sm">Kelola Kos</span>
            </a>
            <a href="<?php echo e(route('admin.kontrak.index')); ?>" class="flex flex-col items-center gap-2 p-4 bg-yellow-400 hover:bg-yellow-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all">
                <i class="fas fa-file-contract text-2xl"></i>
                <span class="text-sm">Kelola Kontrak</span>
            </a>
            <a href="<?php echo e(route('admin.laporan.index')); ?>" class="flex flex-col items-center gap-2 p-4 bg-purple-400 hover:bg-purple-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all">
                <i class="fas fa-chart-bar text-2xl"></i>
                <span class="text-sm">Laporan</span>
            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views\admin\dashboard.blade.php ENDPATH**/ ?>