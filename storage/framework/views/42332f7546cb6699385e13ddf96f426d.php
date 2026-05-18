<?php $__env->startSection('title', 'Notifikasi - AyoKos'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-4 md:p-6 lg:p-8 max-w-4xl mx-auto space-y-6">
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
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h1 class="text-2xl font-black text-black flex items-center">
                <i class="fas fa-bell mr-3 text-yellow-500"></i>
                Notifikasi
            </h1>
            <button onclick="markAllRead()"
                class="px-4 py-2 bg-yellow-400 hover:bg-yellow-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all uppercase tracking-wide text-sm">
                <i class="fas fa-check-double mr-2"></i>
                Tandai Semua Dibaca
            </button>
        </div>
    </div>

    <?php if($notifications->count() > 0): ?>
        <div class="space-y-3">
            <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white border-2 border-black shadow-[2px_2px_0px_#000] p-4 <?php echo e(!$notif->is_read ? 'border-l-8 border-l-sky-500' : ''); ?>">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-sm font-black text-black"><?php echo e($notif->title); ?></span>
                                <?php if(!$notif->is_read): ?>
                                    <span class="w-3 h-3 bg-sky-400 border-2 border-black"></span>
                                <?php endif; ?>
                            </div>
                            <p class="text-sm text-gray-700 font-bold mb-2"><?php echo e($notif->body); ?></p>
                            <div class="flex flex-wrap items-center gap-3 text-xs text-gray-600 font-bold">
                                <span><?php echo e($notif->created_at->diffForHumans()); ?></span>
                                <?php if($notif->link): ?>
                                    <a href="<?php echo e($notif->link); ?>" class="text-sky-600 hover:text-black font-black">
                                        <i class="fas fa-external-link-alt mr-1"></i>Lihat Detail
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if(!$notif->is_read): ?>
                            <button onclick="markRead('<?php echo e($notif->id_notifikasi); ?>')"
                                class="px-3 py-2 bg-emerald-400 hover:bg-emerald-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] transition-all">
                                <i class="fas fa-check"></i>
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="mt-6">
            <?php echo e($notifications->links('vendor.pagination.custom-dark')); ?>

        </div>
    <?php else: ?>
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] text-center py-16 px-6">
            <div class="w-20 h-20 bg-gray-200 border-2 border-black shadow-[2px_2px_0px_#000] flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-bell-slash text-black text-3xl"></i>
            </div>
            <h3 class="text-black font-black mb-2">Belum ada notifikasi</h3>
            <p class="text-gray-600 text-sm font-bold">Notifikasi akan muncul di sini setelah ada aktivitas</p>
        </div>
    <?php endif; ?>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    async function markRead(id) {
        try {
            await axios.post('/api/notifications/' + id + '/read');
            location.reload();
        } catch (e) {
            console.error(e);
        }
    }

    async function markAllRead() {
        try {
            await axios.post('/api/notifications/mark-all-read');
            location.reload();
        } catch (e) {
            console.error(e);
        }
    }
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views\notifications\index.blade.php ENDPATH**/ ?>