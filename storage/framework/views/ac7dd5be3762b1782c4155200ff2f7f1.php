<?php $__env->startSection('title', 'Moderasi Review - Admin AyoKos'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-4 md:p-6 lg:p-8 space-y-6 max-w-7xl mx-auto">
    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li><a href="<?php echo e(route('admin.dashboard')); ?>" class="text-sm font-bold text-gray-600 hover:text-black"><i class="fas fa-home mr-2"></i>Dashboard</a></li>
                <li><i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i></li>
                <li><span class="text-sm font-bold text-black">Moderasi Review</span></li>
            </ol>
        </nav>
    </div>

    <?php if(session('success')): ?>
        <div class="bg-emerald-400 border-2 border-black text-black font-bold px-4 py-3 shadow-[3px_3px_0px_#000] flex items-center justify-between">
            <span><i class="fas fa-check-circle mr-2"></i><?php echo e(session('success')); ?></span>
            <button type="button" class="alert-close"><i class="fas fa-times"></i></button>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
            <p class="text-3xl font-black text-black"><?php echo e($stats['total']); ?></p>
            <p class="text-sm font-bold text-gray-600">Total Review</p>
        </div>
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
            <p class="text-3xl font-black text-yellow-500"><?php echo e(number_format($stats['avg_rating'], 1)); ?></p>
            <p class="text-sm font-bold text-gray-600">Rata-rata Rating</p>
        </div>
    </div>

    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
        <h2 class="text-xl font-black mb-6"><i class="fas fa-star mr-3 text-yellow-500"></i>Daftar Review</h2>

        <form method="GET" class="mb-6">
            <select name="rating" class="border-2 border-black px-3 py-2 font-bold text-sm bg-white" onchange="this.form.submit()">
                <option value="">Semua Rating</option>
                <?php for($i = 1; $i <= 5; $i++): ?>
                    <option value="<?php echo e($i); ?>" <?php echo e(request('rating') == $i ? 'selected' : ''); ?>><?php echo e($i); ?> Bintang</option>
                <?php endfor; ?>
            </select>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-black text-white">
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">ID</th>
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">Penghuni</th>
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">Kos</th>
                        <th class="border-2 border-black px-4 py-3 text-center text-sm font-bold">Rating</th>
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">Komentar</th>
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">Tanggal</th>
                        <th class="border-2 border-black px-4 py-3 text-center text-sm font-bold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-yellow-50">
                            <td class="border-2 border-black px-4 py-3 text-sm font-bold"><?php echo e($review->id_review); ?></td>
                            <td class="border-2 border-black px-4 py-3 text-sm"><?php echo e($review->penghuni->nama ?? '-'); ?></td>
                            <td class="border-2 border-black px-4 py-3 text-sm font-bold"><?php echo e($review->kos->nama_kos ?? '-'); ?></td>
                            <td class="border-2 border-black px-4 py-3 text-center">
                                <span class="font-black text-yellow-500"><?php echo e($review->rating); ?>/5</span>
                            </td>
                            <td class="border-2 border-black px-4 py-3 text-sm max-w-xs truncate"><?php echo e($review->komentar ?? '-'); ?></td>
                            <td class="border-2 border-black px-4 py-3 text-sm"><?php echo e($review->created_at->format('d/m/Y')); ?></td>
                            <td class="border-2 border-black px-4 py-3 text-center">
                                <form method="POST" action="<?php echo e(route('admin.reviews.destroy', $review->id_review)); ?>" data-ajax="true" data-ajax-method="DELETE" data-confirm="Hapus review ini?" data-confirm-type="danger" data-success-msg="Review berhasil dihapus">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="bg-red-400 border-2 border-black px-2 py-1 text-xs font-bold hover:bg-red-500 transition-colors">
                                        <i class="fas fa-trash mr-1"></i>Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="border-2 border-black px-4 py-8 text-center text-gray-500 font-bold">
                                <i class="fas fa-star text-3xl block mb-2"></i>Tidak ada review ditemukan.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4"><?php echo e($reviews->links('vendor.pagination.custom-dark')); ?></div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views\admin\reviews\index.blade.php ENDPATH**/ ?>