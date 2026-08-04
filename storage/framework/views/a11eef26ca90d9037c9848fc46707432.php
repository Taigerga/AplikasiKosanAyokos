<?php $__env->startSection('title', 'Detail Aduan - Penghuni AyoKos'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-6">
    <div class="max-w-4xl mx-auto">
        <!-- Breadcrumb -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4 mb-6">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="<?php echo e(route('penghuni.dashboard')); ?>" class="inline-flex items-center text-sm font-bold text-gray-700 hover:text-black transition-colors">
                            <i class="fas fa-home mr-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="inline-flex items-center">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                            <a href="<?php echo e(route('penghuni.aduan.index')); ?>" class="inline-flex items-center text-sm font-bold text-gray-700 hover:text-black transition-colors">
                                <i class="fas fa-headset mr-2"></i>
                                Aduan
                            </a>
                        </div>
                    </li>
                    <li class="inline-flex items-center">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                            <span class="inline-flex items-center text-sm font-bold text-black">
                                <i class="fas fa-eye mr-2"></i>
                                Detail
                            </span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <?php if(session('success')): ?>
            <div class="bg-emerald-400 border-2 border-black text-black font-black px-4 py-3 shadow-[3px_3px_0px_#000] mb-6">
                <div class="flex items-center"><i class="fas fa-check-circle mr-3"></i><?php echo e(session('success')); ?></div>
            </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="bg-rose-400 border-2 border-black text-black font-black px-4 py-3 shadow-[3px_3px_0px_#000] mb-6">
                <div class="flex items-center"><i class="fas fa-exclamation-circle mr-3"></i><?php echo e(session('error')); ?></div>
            </div>
        <?php endif; ?>

        <!-- Detail Aduan -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 mb-6">
            <div class="flex items-start justify-between mb-6">
                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 bg-gray-100 border-2 border-black flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-headset text-sky-400 text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-black text-black mb-1"><?php echo e($aduan->judul); ?></h1>
                        <div class="flex items-center space-x-3 text-sm text-gray-600">
                            <span><i class="fas fa-calendar-alt mr-1"></i><?php echo e(\Carbon\Carbon::parse($aduan->created_at)->format('d M Y H:i')); ?></span>
                            <span><i class="fas fa-tag mr-1"></i><?php echo e(ucfirst(str_replace('_', ' ', $aduan->kategori))); ?></span>
                        </div>
                    </div>
                </div>
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
                <span class="inline-flex items-center px-3 py-1.5 text-sm font-black border-2 border-black <?php echo e($color); ?> text-black flex-shrink-0">
                    <i class="fas fa-<?php echo e($aduan->status_aduan == 'diajukan' ? 'clock' : ($aduan->status_aduan == 'selesai' ? 'check-circle' : ($aduan->status_aduan == 'ditolak' || $aduan->status_aduan == 'ditutup' ? 'times-circle' : 'spinner'))); ?> mr-2"></i>
                    <?php echo e(ucfirst(str_replace('_', ' ', $aduan->status_aduan))); ?>

                </span>
            </div>

            <!-- Deskripsi -->
            <div class="bg-gray-100 border-2 border-black p-4 mb-6">
                <h3 class="text-sm font-black text-black mb-3 flex items-center"><i class="fas fa-align-left mr-2"></i>Deskripsi</h3>
                <p class="text-gray-700 font-bold whitespace-pre-line"><?php echo e($aduan->deskripsi); ?></p>
            </div>

            <!-- Lampiran -->
            <?php if($aduan->lampiran): ?>
                <div class="mb-6">
                    <h3 class="text-sm font-black text-black mb-3 flex items-center"><i class="fas fa-paperclip mr-2"></i>Lampiran</h3>
                    <a href="<?php echo e(asset('storage/' . $aduan->lampiran)); ?>" target="_blank"
                        class="inline-flex items-center px-4 py-2 bg-sky-400 hover:bg-sky-500 text-black font-black text-sm border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all">
                        <i class="fas fa-download mr-2"></i>
                        Unduh Lampiran
                    </a>
                </div>
            <?php endif; ?>

            <!-- Status Timeline -->
            <div class="border-t-2 border-gray-200 pt-6">
                <h3 class="text-sm font-black text-black mb-4 flex items-center"><i class="fas fa-history mr-2"></i>Riwayat Status</h3>
                <div class="space-y-3">
                    <?php
                        $statuses = ['diajukan', 'ditinjau', 'diproses', 'menunggu_info', 'selesai'];
                        $currentIndex = array_search($aduan->status_aduan, $statuses);
                        if ($currentIndex === false) $currentIndex = count($statuses);
                        $closedOrRejected = in_array($aduan->status_aduan, ['ditolak', 'ditutup']);
                    ?>
                    <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $isActive = $i <= $currentIndex && !$closedOrRejected;
                            $isCurrent = $i == $currentIndex && !$closedOrRejected;
                        ?>
                        <div class="flex items-start">
                            <div class="flex flex-col items-center mr-4">
                                <div class="w-8 h-8 border-2 border-black flex items-center justify-center
                                    <?php echo e($isCurrent ? 'bg-sky-400' : ($isActive ? 'bg-emerald-400' : 'bg-gray-200')); ?>">
                                    <i class="fas fa-<?php echo e($isActive ? 'check' : 'circle'); ?> text-black text-xs"></i>
                                </div>
                                <?php if($i < count($statuses) - 1): ?>
                                    <div class="w-0.5 h-8 <?php echo e($i < $currentIndex && !$closedOrRejected ? 'bg-emerald-400' : 'bg-gray-300'); ?>"></div>
                                <?php endif; ?>
                            </div>
                            <div class="pt-1">
                                <p class="text-sm font-black <?php echo e($isCurrent ? 'text-black' : ($isActive ? 'text-gray-700' : 'text-gray-400')); ?>">
                                    <?php echo e(ucfirst(str_replace('_', ' ', $status))); ?>

                                </p>
                                <?php if($isCurrent): ?>
                                    <p class="text-xs text-gray-500">Status saat ini</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if($closedOrRejected): ?>
                        <div class="flex items-start">
                            <div class="flex flex-col items-center mr-4">
                                <div class="w-8 h-8 border-2 border-black flex items-center justify-center
                                    <?php echo e($aduan->status_aduan == 'ditolak' ? 'bg-rose-400' : 'bg-gray-400'); ?>">
                                    <i class="fas fa-<?php echo e($aduan->status_aduan == 'ditolak' ? 'times' : 'ban'); ?> text-black text-xs"></i>
                                </div>
                            </div>
                            <div class="pt-1">
                                <p class="text-sm font-black text-black">
                                    <?php echo e(ucfirst(str_replace('_', ' ', $aduan->status_aduan))); ?>

                                </p>
                                <p class="text-xs text-gray-500">Status akhir</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Komentar Section -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 mb-6">
            <h2 class="text-xl font-black text-black mb-6 flex items-center">
                <i class="fas fa-comments mr-3"></i>
                Komentar (<?php echo e($aduan->komentar->count()); ?>)
            </h2>

            <?php if($aduan->komentar->count() > 0): ?>
                <div class="space-y-4">
                    <?php $__currentLoopData = $aduan->komentar->sortByDesc('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $komentar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-gray-100 border-2 border-black p-4">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center space-x-2">
                                    <div class="w-8 h-8 bg-black border-2 border-black flex items-center justify-center">
                                        <i class="fas fa-user text-white text-xs"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-black text-black"><?php echo e($komentar->pengirim->name ?? 'Pengguna'); ?></p>
                                        <p class="text-xs font-bold text-gray-500">
                                            <?php echo e(\Carbon\Carbon::parse($komentar->created_at)->format('d M Y H:i')); ?>

                                        </p>
                                    </div>
                                </div>
                            </div>
                            <p class="text-sm text-gray-700 font-bold whitespace-pre-line mb-3"><?php echo e($komentar->isi); ?></p>
                            <?php if($komentar->lampiran): ?>
                                <a href="<?php echo e(asset('storage/' . $komentar->lampiran)); ?>" target="_blank"
                                    class="inline-flex items-center px-3 py-1.5 bg-sky-400 hover:bg-sky-500 text-black font-black text-xs border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all">
                                    <i class="fas fa-paperclip mr-1"></i>
                                    Unduh Lampiran
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="text-center py-8">
                    <div class="w-16 h-16 bg-gray-200 border-2 border-black flex items-center justify-center mx-auto mb-4 shadow-[2px_2px_0px_#000]">
                        <i class="fas fa-comment-dots text-gray-500 text-2xl"></i>
                    </div>
                    <p class="text-gray-700 font-black mb-2">Belum Ada Komentar</p>
                    <p class="text-sm text-gray-600 font-bold">Belum ada tanggapan untuk aduan ini</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Form Komentar -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <h2 class="text-xl font-black text-black mb-6 flex items-center">
                <i class="fas fa-reply mr-3"></i>
                Tambah Komentar
            </h2>

            <form method="POST" action="<?php echo e(route('penghuni.aduan.komentar', $aduan->id_aduan)); ?>" enctype="multipart/form-data" data-ajax="true" data-ajax-action="/api/penghuni/aduan/<?php echo e($aduan->id_aduan); ?>/komentar" data-success-msg="Komentar berhasil ditambahkan" data-reload="true">
                <?php echo csrf_field(); ?>

                <div class="mb-4">
                    <label class="block text-sm font-black text-black mb-2">Isi Komentar <span class="text-rose-400">*</span></label>
                    <textarea name="isi" rows="4"
                        class="w-full px-3 py-3 border-2 border-black text-black font-bold placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white resize-none"
                        placeholder="Tulis tanggapan Anda..." required></textarea>
                    <?php $__errorArgs = ['isi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm font-bold text-rose-500 flex items-center"><i class="fas fa-exclamation-circle mr-2"></i><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-black text-black mb-2">Lampiran (Opsional)</label>
                    <div class="relative">
                        <div class="flex items-center justify-center w-full">
                            <label for="komentar-lampiran"
                                class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-black cursor-pointer bg-white hover:bg-gray-50 transition">
                                <div class="flex flex-col items-center justify-center pt-4 pb-4">
                                    <i class="fas fa-cloud-upload-alt text-2xl text-gray-400 mb-2"></i>
                                    <p class="text-sm text-gray-700 font-bold"><span class="font-black">Klik untuk upload</span></p>
                                    <p class="text-xs text-gray-500 font-bold">JPEG, PNG, JPG, GIF, PDF, DOC, DOCX (Max. 5MB)</p>
                                </div>
                                <input id="komentar-lampiran" name="lampiran" type="file" class="hidden" accept=".jpeg,.png,.jpg,.gif,.pdf,.doc,.docx">
                            </label>
                        </div>
                    </div>
                    <?php $__errorArgs = ['lampiran'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm font-bold text-rose-500 flex items-center"><i class="fas fa-exclamation-circle mr-2"></i><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="<?php echo e(route('penghuni.aduan.index')); ?>"
                        class="px-6 py-3 bg-white text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all flex items-center justify-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                    <button type="submit"
                        class="px-6 py-3 bg-lime-400 hover:bg-lime-500 text-black font-black border-2 border-black shadow-[3px_3px_0px_#000] hover:shadow-[4px_4px_0px_#000] transition-all uppercase tracking-wide flex items-center justify-center">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Kirim Komentar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views\penghuni\aduan\show.blade.php ENDPATH**/ ?>