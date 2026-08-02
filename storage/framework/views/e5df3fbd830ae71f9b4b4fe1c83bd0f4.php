<?php $__env->startSection('title', 'Kelola User - Admin AyoKos'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-4 md:p-6 lg:p-8 space-y-6 max-w-7xl mx-auto">
    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="inline-flex items-center text-sm font-bold text-gray-600 hover:text-black transition-colors">
                        <i class="fas fa-home mr-2"></i>Dashboard
                    </a>
                </li>
                <li class="inline-flex items-center">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                        <span class="text-sm font-bold text-black">Kelola User</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <?php if(session('success')): ?>
        <div class="bg-emerald-400 border-2 border-black text-black font-bold px-4 py-3 shadow-[3px_3px_0px_#000] flex items-center justify-between">
            <span><i class="fas fa-check-circle mr-2"></i><?php echo e(session('success')); ?></span>
            <button type="button" class="alert-close text-black hover:text-gray-700"><i class="fas fa-times"></i></button>
        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="bg-red-400 border-2 border-black text-black font-bold px-4 py-3 shadow-[3px_3px_0px_#000] flex items-center justify-between">
            <span><i class="fas fa-exclamation-circle mr-2"></i><?php echo e(session('error')); ?></span>
            <button type="button" class="alert-close text-black hover:text-gray-700"><i class="fas fa-times"></i></button>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
            <p class="text-3xl font-black text-black"><?php echo e($stats['total']); ?></p>
            <p class="text-sm font-bold text-gray-600">Total Admin</p>
        </div>
    </div>

    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
            <h2 class="text-xl font-black"><i class="fas fa-users mr-3 text-sky-500"></i>Daftar User</h2>
            <div class="flex gap-3">
                <a href="<?php echo e(route('admin.users.create')); ?>" class="bg-emerald-400 border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[4px_4px_0px_#000] hover:-translate-y-0.5 transition-all px-4 py-2 font-bold text-sm flex items-center gap-2">
                    <i class="fas fa-plus"></i>Tambah Admin
                </a>
            </div>
        </div>

        <form method="GET" class="flex flex-col md:flex-row gap-3 mb-6">
            <input type="text" name="search" placeholder="Cari username..." value="<?php echo e(request('search')); ?>" class="border-2 border-black px-3 py-2 font-bold text-sm flex-1">
            <button type="submit" class="bg-sky-400 border-2 border-black shadow-[2px_2px_0px_#000] px-4 py-2 font-bold text-sm hover:shadow-[4px_4px_0px_#000] transition-all">
                <i class="fas fa-search mr-1"></i>Cari
            </button>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-black text-white">
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">ID</th>
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">Username</th>
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">Nama</th>
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">Email</th>
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">No. HP</th>
                        <th class="border-2 border-black px-4 py-3 text-center text-sm font-bold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-yellow-50">
                            <td class="border-2 border-black px-4 py-3 text-sm font-bold"><?php echo e($user->id); ?></td>
                            <td class="border-2 border-black px-4 py-3 text-sm font-bold"><?php echo e($user->username); ?></td>
                            <td class="border-2 border-black px-4 py-3 text-sm">
                                <?php echo e($user->admin->nama ?? '-'); ?>

                            </td>
                            <td class="border-2 border-black px-4 py-3 text-sm">
                                <?php echo e($user->admin->email ?? '-'); ?>

                            </td>
                            <td class="border-2 border-black px-4 py-3 text-sm">
                                <?php echo e($user->admin->no_hp ?? '-'); ?>

                            </td>
                            <td class="border-2 border-black px-4 py-3 text-center">
                                <a href="<?php echo e(route('admin.users.edit', $user->id)); ?>" class="bg-sky-400 border-2 border-black px-2 py-1 text-xs font-bold hover:bg-sky-500 transition-colors inline-flex items-center gap-1">
                                    <i class="fas fa-edit"></i>Edit
                                </a>
                                <form method="POST" action="<?php echo e(route('admin.users.destroy', $user->id)); ?>" data-ajax="true" data-ajax-method="DELETE" data-confirm="Hapus admin ini?" data-confirm-type="danger" data-success-msg="Admin berhasil dihapus">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="bg-red-400 border-2 border-black px-2 py-1 text-xs font-bold hover:bg-red-500 transition-colors inline-flex items-center gap-1">
                                        <i class="fas fa-trash"></i>Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="border-2 border-black px-4 py-8 text-center text-gray-500 font-bold">
                                <i class="fas fa-users text-3xl block mb-2"></i>Tidak ada admin ditemukan.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <?php echo e($users->links('vendor.pagination.custom-dark')); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/admin/users/index.blade.php ENDPATH**/ ?>