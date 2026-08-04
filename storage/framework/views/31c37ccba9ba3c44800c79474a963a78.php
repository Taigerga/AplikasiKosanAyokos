<?php $__env->startSection('title', 'Buat Aduan - Penghuni AyoKos'); ?>

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
                                <i class="fas fa-plus mr-2"></i>
                                Buat
                            </span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Header -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl md:text-3xl font-black text-black mb-2">Buat Aduan Baru</h1>
                    <p class="text-gray-700 font-bold">Sampaikan masalah atau keluhan Anda melalui formulir berikut</p>
                </div>
                <div class="w-12 h-12 bg-white border-2 border-black shadow-[2px_2px_0px_#000] flex items-center justify-center">
                    <i class="fas fa-headset text-black text-xl"></i>
                </div>
            </div>
        </div>

        <?php if($errors->any()): ?>
            <div class="bg-white border-4 border-rose-500 text-rose-500 font-bold shadow-[4px_4px_0px_#000] p-4 mb-6">
                <div class="flex items-center mb-2">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <strong class="font-semibold">Terjadi kesalahan:</strong>
                </div>
                <ul class="text-sm list-disc list-inside space-y-1">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Form -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <form method="POST" action="<?php echo e(route('penghuni.aduan.store')); ?>" enctype="multipart/form-data" data-ajax="true" data-ajax-action="/api/penghuni/aduan" data-redirect="<?php echo e(route('penghuni.aduan.index')); ?>" data-success-msg="Aduan berhasil dikirim!">
                <?php echo csrf_field(); ?>

                <div class="space-y-8">
                    <!-- Judul -->
                    <div>
                        <label class="block text-sm font-black text-black mb-2">
                            Judul Aduan <span class="text-rose-400">*</span>
                        </label>
                        <div class="relative">
                            <i class="fas fa-heading absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <input type="text" name="judul" value="<?php echo e(old('judul')); ?>"
                                class="w-full pl-10 pr-3 py-3 border-2 border-black text-black font-bold placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white"
                                placeholder="Contoh: Keran air kamar mandi bocor" required maxlength="255">
                        </div>
                        <?php $__errorArgs = ['judul'];
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

                    <!-- Kategori -->
                    <div>
                        <label class="block text-sm font-black text-black mb-2">
                            Kategori <span class="text-rose-400">*</span>
                        </label>
                        <div class="relative">
                            <i class="fas fa-tag absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <select name="kategori"
                                class="w-full pl-10 pr-10 py-3 border-2 border-black text-black font-bold focus:shadow-[3px_3px_0px_#000] outline-none bg-white appearance-none"
                                required>
                                <option value="">Pilih Kategori</option>
                                <option value="kebersihan" <?php echo e(old('kategori') == 'kebersihan' ? 'selected' : ''); ?>>Kebersihan</option>
                                <option value="fasilitas" <?php echo e(old('kategori') == 'fasilitas' ? 'selected' : ''); ?>>Fasilitas</option>
                                <option value="keamanan" <?php echo e(old('kategori') == 'keamanan' ? 'selected' : ''); ?>>Keamanan</option>
                                <option value="kebisingan" <?php echo e(old('kategori') == 'kebisingan' ? 'selected' : ''); ?>>Kebisingan</option>
                                <option value="administrasi" <?php echo e(old('kategori') == 'administrasi' ? 'selected' : ''); ?>>Administrasi</option>
                                <option value="pembayaran" <?php echo e(old('kategori') == 'pembayaran' ? 'selected' : ''); ?>>Pembayaran</option>
                                <option value="penyewa_lain" <?php echo e(old('kategori') == 'penyewa_lain' ? 'selected' : ''); ?>>Penyewa Lain</option>
                                <option value="pemilik_kos" <?php echo e(old('kategori') == 'pemilik_kos' ? 'selected' : ''); ?>>Pemilik Kos</option>
                                <option value="lainnya" <?php echo e(old('kategori') == 'lainnya' ? 'selected' : ''); ?>>Lainnya</option>
                            </select>
                            <i class="fas fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                        </div>
                        <?php $__errorArgs = ['kategori'];
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

                    <!-- Deskripsi -->
                    <div>
                        <label class="block text-sm font-black text-black mb-2">
                            Deskripsi <span class="text-rose-400">*</span>
                        </label>
                        <div class="relative">
                            <i class="fas fa-align-left absolute left-3 top-3 text-gray-400"></i>
                            <textarea name="deskripsi" rows="6"
                                class="w-full pl-10 pr-3 py-3 border-2 border-black text-black font-bold placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white resize-none"
                                placeholder="Jelaskan secara detail masalah atau keluhan yang Anda alami..." required><?php echo e(old('deskripsi')); ?></textarea>
                        </div>
                        <?php $__errorArgs = ['deskripsi'];
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

                    <!-- Lampiran -->
                    <div>
                        <label class="block text-sm font-black text-black mb-2">Lampiran (Opsional)</label>
                        <div class="relative group">
                            <div class="flex items-center justify-center w-full">
                                <label for="lampiran"
                                    class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-black cursor-pointer bg-white hover:bg-gray-50 transition">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                        <p class="text-sm text-gray-700 font-bold mb-1">
                                            <span class="font-black">Klik untuk upload</span> atau drag & drop
                                        </p>
                                        <p class="text-xs text-gray-500 font-bold">JPEG, PNG, JPG, GIF, PDF, DOC, DOCX (Max. 5MB)</p>
                                    </div>
                                    <input id="lampiran" name="lampiran" type="file" class="hidden" accept=".jpeg,.png,.jpg,.gif,.pdf,.doc,.docx">
                                </label>
                            </div>
                        </div>
                        <div id="lampiran-preview" class="mt-2"></div>
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
                        <p class="text-sm text-gray-600 mt-3 flex items-center">
                            <i class="fas fa-info-circle mr-2"></i>
                            Lampirkan foto, dokumen, atau bukti pendukung lainnya (jika ada)
                        </p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 flex flex-col sm:flex-row gap-4">
                    <a href="<?php echo e(route('penghuni.aduan.index')); ?>"
                        class="flex-1 sm:flex-none px-6 py-3 bg-white text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all flex items-center justify-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                    <button type="submit"
                        class="flex-1 sm:flex-none px-6 py-3 bg-lime-400 hover:bg-lime-500 text-black font-black border-2 border-black shadow-[3px_3px_0px_#000] hover:shadow-[4px_4px_0px_#000] transition-all uppercase tracking-wide flex items-center justify-center">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Kirim Aduan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    document.getElementById('lampiran')?.addEventListener('change', function(e) {
        const preview = document.getElementById('lampiran-preview');
        preview.innerHTML = '';
        if (this.files && this.files[0]) {
            const file = this.files[0];
            const maxSize = 5 * 1024 * 1024;
            if (file.size > maxSize) {
                preview.innerHTML = '<p class="text-rose-500 font-bold text-sm flex items-center"><i class="fas fa-exclamation-circle mr-2"></i>File terlalu besar. Maksimal 5MB.</p>';
                this.value = '';
                return;
            }
            preview.innerHTML = '<div class="inline-flex items-center px-3 py-2 bg-gray-100 border-2 border-black text-sm font-bold text-gray-700"><i class="fas fa-paperclip mr-2"></i>' + file.name + ' <span class="ml-2 text-gray-500">(' + (file.size / 1024).toFixed(1) + ' KB)</span></div>';
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views\penghuni\aduan\create.blade.php ENDPATH**/ ?>