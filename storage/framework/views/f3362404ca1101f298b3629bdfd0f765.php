<?php $__env->startSection('title', 'Aduan Saya - Pemilik AyoKos'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-4 md:p-6 lg:p-8 space-y-6 max-w-7xl mx-auto">
    <!-- Breadcrumb -->
    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="<?php echo e(route('pemilik.dashboard')); ?>" class="inline-flex items-center text-sm font-bold text-gray-600 hover:text-black transition-colors">
                        <i class="fas fa-home mr-2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="inline-flex items-center">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                        <span class="inline-flex items-center text-sm font-bold text-black">
                            <i class="fas fa-headset mr-2"></i>
                            Aduan Saya
                        </span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Header -->
    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between">
            <div>
                <h1 class="text-2xl md:text-3xl font-black text-black mb-2">
                    <i class="fas fa-headset mr-3"></i>
                    Aduan Saya
                </h1>
                <p class="text-gray-600 font-bold">Kelola dan pantau semua aduan yang Anda buat</p>
            </div>
            <a href="<?php echo e(route('pemilik.aduan.create')); ?>" class="mt-4 md:mt-0 px-6 py-3 bg-lime-400 hover:bg-lime-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all uppercase tracking-wide">
                <i class="fas fa-plus mr-2"></i>
                Buat Aduan Baru
            </a>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="bg-emerald-400 border-2 border-black text-black font-black px-4 py-3 shadow-[3px_3px_0px_#000]">
            <div class="flex items-center"><i class="fas fa-check-circle mr-3"></i><?php echo e(session('success')); ?></div>
        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="bg-rose-400 border-2 border-black text-black font-black px-4 py-3 shadow-[3px_3px_0px_#000]">
            <div class="flex items-center"><i class="fas fa-exclamation-circle mr-3"></i><?php echo e(session('error')); ?></div>
        </div>
    <?php endif; ?>

    <!-- Stats Cards -->
    <?php
        $totalAduan = $aduans->total();
        $countDiajukan = $aduans->filter(fn($a) => $a->status_aduan == 'diajukan')->count();
        $countDiproses = $aduans->filter(fn($a) => in_array($a->status_aduan, ['ditinjau', 'diproses', 'menunggu_info']))->count();
        $countSelesai = $aduans->filter(fn($a) => in_array($a->status_aduan, ['selesai', 'ditolak', 'ditutup']))->count();
    ?>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 hover:shadow-[6px_6px_0px_#000] hover:-translate-y-1 transition-all">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-sky-400 border-2 border-black flex items-center justify-center">
                    <i class="fas fa-headset text-black text-xl"></i>
                </div>
                <span class="text-xs font-black px-2 py-1 border-2 border-black bg-yellow-400 text-black">Total</span>
            </div>
            <h3 class="text-2xl font-black text-black mb-1"><?php echo e($totalAduan); ?></h3>
            <p class="text-sm font-bold text-gray-600">Total Aduan</p>
        </div>
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 hover:shadow-[6px_6px_0px_#000] hover:-translate-y-1 transition-all">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-yellow-400 border-2 border-black flex items-center justify-center">
                    <i class="fas fa-clock text-black text-xl"></i>
                </div>
                <span class="text-xs font-black px-2 py-1 border-2 border-black bg-yellow-400 text-black"><?php echo e($countDiajukan); ?></span>
            </div>
            <h3 class="text-2xl font-black text-black mb-1"><?php echo e($countDiajukan); ?></h3>
            <p class="text-sm font-bold text-gray-600">Diajukan</p>
        </div>
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 hover:shadow-[6px_6px_0px_#000] hover:-translate-y-1 transition-all">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-purple-400 border-2 border-black flex items-center justify-center">
                    <i class="fas fa-spinner text-black text-xl"></i>
                </div>
                <span class="text-xs font-black px-2 py-1 border-2 border-black bg-yellow-400 text-black"><?php echo e($countDiproses); ?></span>
            </div>
            <h3 class="text-2xl font-black text-black mb-1"><?php echo e($countDiproses); ?></h3>
            <p class="text-sm font-bold text-gray-600">Diproses</p>
        </div>
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 hover:shadow-[6px_6px_0px_#000] hover:-translate-y-1 transition-all">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-emerald-400 border-2 border-black flex items-center justify-center">
                    <i class="fas fa-check-circle text-black text-xl"></i>
                </div>
                <span class="text-xs font-black px-2 py-1 border-2 border-black bg-yellow-400 text-black"><?php echo e($countSelesai); ?></span>
            </div>
            <h3 class="text-2xl font-black text-black mb-1"><?php echo e($countSelesai); ?></h3>
            <p class="text-sm font-bold text-gray-600">Selesai/Ditutup</p>
        </div>
    </div>

    <!-- Filter & Table -->
    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] overflow-hidden">
        <div class="p-6 border-b-2 border-gray-200">
            <form method="GET" action="<?php echo e(route('pemilik.aduan.index')); ?>">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="w-full md:w-48">
                        <select name="status" class="w-full px-3 py-3 border-2 border-black text-black font-bold focus:shadow-[3px_3px_0px_#000] outline-none bg-white appearance-none">
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
                    <div class="flex gap-2">
                        <button type="submit" class="px-6 py-3 bg-black text-white font-black border-2 border-black shadow-[3px_3px_0px_#000] hover:shadow-[4px_4px_0px_#000] hover:translate-y-[-1px] transition-all uppercase tracking-wide">
                            <i class="fas fa-filter mr-2"></i>
                            Filter
                        </button>
                        <?php if(request('status')): ?>
                            <a href="<?php echo e(route('pemilik.aduan.index')); ?>" class="px-6 py-3 bg-gray-100 text-gray-700 font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] hover:translate-y-[-1px] transition-all uppercase tracking-wide">
                                <i class="fas fa-times mr-2"></i>
                                Reset
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>

        <?php if($aduans->count() > 0): ?>
            <!-- Desktop Table View -->
            <div class="overflow-x-auto w-full hidden md:block">
                <table class="w-full min-w-[750px] text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100 border-b-2 border-black">
                            <th class="px-4 py-4 text-left text-sm font-black text-black uppercase tracking-wide min-w-[50px] w-14">No</th>
                            <th class="px-4 py-4 text-left text-sm font-black text-black uppercase tracking-wide min-w-[200px]">Judul</th>
                            <th class="px-4 py-4 text-left text-sm font-black text-black uppercase tracking-wide min-w-[130px]">Kategori</th>
                            <th class="px-4 py-4 text-left text-sm font-black text-black uppercase tracking-wide min-w-[130px]">Status</th>
                            <th class="px-4 py-4 text-left text-sm font-black text-black uppercase tracking-wide min-w-[120px]">Tanggal</th>
                            <th class="px-4 py-4 text-center text-sm font-black text-black uppercase tracking-wide min-w-[100px]">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-gray-200">
                        <?php $__currentLoopData = $aduans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $aduan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-4 text-sm font-bold text-gray-700 whitespace-nowrap"><?php echo e($aduans->firstItem() + $index); ?></td>
                                <td class="px-4 py-4 text-sm font-black text-black"><?php echo e($aduan->judul); ?></td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-1 text-xs font-black border-2 border-black bg-gray-100 text-black">
                                        <?php echo e(ucfirst(str_replace('_', ' ', $aduan->kategori))); ?>

                                    </span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <?php
                                        $statusColors = [
                                            'diajukan' => 'bg-yellow-400',
                                            'ditinjau' => 'bg-sky-400',
                                            'diproses' => 'bg-orange-400',
                                            'menunggu_info' => 'bg-purple-400',
                                            'selesai' => 'bg-emerald-400',
                                            'ditolak' => 'bg-rose-400',
                                            'ditutup' => 'bg-gray-400',
                                        ];
                                        $color = $statusColors[$aduan->status_aduan] ?? 'bg-gray-200';
                                    ?>
                                    <span class="inline-flex items-center px-2.5 py-1 text-xs font-black border-2 border-black <?php echo e($color); ?> text-black">
                                        <?php echo e(ucfirst(str_replace('_', ' ', $aduan->status_aduan))); ?>

                                    </span>
                                </td>
                                <td class="px-4 py-4 text-sm font-bold text-gray-600 whitespace-nowrap"><?php echo e(\Carbon\Carbon::parse($aduan->created_at)->format('d M Y')); ?></td>
                                <td class="px-4 py-4 text-center whitespace-nowrap">
                                    <a href="<?php echo e(route('pemilik.aduan.show', $aduan->id_aduan)); ?>" class="inline-flex items-center px-3 py-1.5 bg-sky-400 hover:bg-sky-500 text-black font-black text-xs border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all">
                                        <i class="fas fa-eye mr-1"></i>
                                        Lihat
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="md:hidden divide-y-2 divide-gray-200">
                <?php $__currentLoopData = $aduans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $aduan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $statusColors = [
                            'diajukan' => 'bg-yellow-400',
                            'ditinjau' => 'bg-sky-400',
                            'diproses' => 'bg-orange-400',
                            'menunggu_info' => 'bg-purple-400',
                            'selesai' => 'bg-emerald-400',
                            'ditolak' => 'bg-rose-400',
                            'ditutup' => 'bg-gray-400',
                        ];
                        $color = $statusColors[$aduan->status_aduan] ?? 'bg-gray-200';
                    ?>
                    <div class="p-4 space-y-3">
                        <div class="flex items-start justify-between gap-2">
                            <div class="min-w-0 flex-1">
                                <span class="text-xs text-gray-500 font-bold">#<?php echo e($aduans->firstItem() + $index); ?></span>
                                <h4 class="text-base font-black text-black truncate mt-0.5"><?php echo e($aduan->judul); ?></h4>
                            </div>
                            <span class="inline-flex items-center px-2 py-1 text-xs font-black border-2 border-black <?php echo e($color); ?> text-black shrink-0 whitespace-nowrap">
                                <?php echo e(ucfirst(str_replace('_', ' ', $aduan->status_aduan))); ?>

                            </span>
                        </div>
                        <div class="flex items-center justify-between text-xs text-gray-600 pt-1">
                            <span class="inline-flex items-center px-2 py-0.5 font-black border-2 border-black bg-gray-100 text-black">
                                <?php echo e(ucfirst(str_replace('_', ' ', $aduan->kategori))); ?>

                            </span>
                            <span>
                                <i class="fas fa-calendar-alt mr-1"></i>
                                <?php echo e(\Carbon\Carbon::parse($aduan->created_at)->format('d M Y')); ?>

                            </span>
                        </div>
                        <div class="pt-2 flex justify-end">
                            <a href="<?php echo e(route('pemilik.aduan.show', $aduan->id_aduan)); ?>" class="inline-flex items-center px-3 py-1.5 bg-sky-400 text-black font-black text-xs border-2 border-black shadow-[2px_2px_0px_#000]">
                                <i class="fas fa-eye mr-1"></i>
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Pagination -->
            <?php if($aduans->hasPages()): ?>
            <div class="px-4 sm:px-6 py-4 border-t-2 border-gray-200">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-sm font-bold text-gray-600 text-center sm:text-left">
                        Menampilkan <?php echo e($aduans->firstItem()); ?> - <?php echo e($aduans->lastItem()); ?> dari <?php echo e($aduans->total()); ?> aduan
                    </div>
                    <div class="flex space-x-2">
                        <?php echo e($aduans->links('vendor.pagination.custom-dark')); ?>

                    </div>
                </div>
            </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="text-center py-12">
                <div class="w-20 h-20 bg-gray-200 border-2 border-black flex items-center justify-center mx-auto mb-4 shadow-[2px_2px_0px_#000]">
                    <i class="fas fa-headset text-gray-500 text-3xl"></i>
                </div>
                <h3 class="text-xl font-black text-black mb-3">Belum Ada Aduan</h3>
                <p class="text-gray-600 font-bold mb-6">Anda belum membuat aduan apapun. Silakan buat aduan baru jika ada masalah.</p>
                <a href="<?php echo e(route('pemilik.aduan.create')); ?>" class="inline-flex items-center px-6 py-3 bg-lime-400 hover:bg-lime-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all uppercase tracking-wide">
                    <i class="fas fa-plus mr-2"></i>
                    Buat Aduan Baru
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/pemilik/aduan/index.blade.php ENDPATH**/ ?>