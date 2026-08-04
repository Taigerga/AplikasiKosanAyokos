<?php $__env->startSection('title', 'Edit Review - AyoKos'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-4 md:p-6 max-w-3xl mx-auto space-y-6">
    <!-- Breadcrumb -->
    <div class="bg-white border-2 border-black shadow-[2px_2px_0px_#000] p-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="<?php echo e(route('public.home')); ?>"
                       class="inline-flex items-center text-sm font-black text-gray-600 hover:text-black transition">
                        <i class="fas fa-gauge mr-2"></i>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-black/20 mx-2 text-xs"></i>
                        <a href="<?php echo e(route('penghuni.reviews.history')); ?>"
                           class="ml-1 text-sm font-black text-gray-600 hover:text-black transition">
                           <i class="fas fa-star mr-2"></i>
                            Review Saya
                        </a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-black/20 mx-2 text-xs"></i>
                        <span class="ml-1 text-sm font-black text-black">
                            <i class="fas fa-pencil mr-2"></i>
                            Edit Review
                        </span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <?php if(session('success')): ?>
        <div class="bg-emerald-400 border-2 border-black shadow-[3px_3px_0px_#000] text-black px-4 py-3  mb-6">
            <div class="flex items-center"><i class="fas fa-check-circle mr-3"></i><?php echo e(session('success')); ?></div>
        </div>
        <script>window.showSuccess && window.showSuccess('<?php echo e(session('success')); ?>');</script>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="bg-red-400 border-2 border-black shadow-[3px_3px_0px_#000] text-black px-4 py-3  mb-6">
            <div class="flex items-center"><i class="fas fa-exclamation-circle mr-3"></i><?php echo e(session('error')); ?></div>
        </div>
        <script>window.showError && window.showError('<?php echo e(session('error')); ?>');</script>
    <?php endif; ?>

    <!-- Main Card -->
    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] overflow-hidden">
        <!-- Header -->
        <div class="bg-gray-100 border-b-2 border-black p-6">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-gray-100 border-2 border-black  flex items-center justify-center">
                    <i class="fas fa-star text-black text-xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-black text-black">Edit Review</h1>
                    <p class="text-gray-600">Perbarui review Anda untuk <?php echo e($review->kos->nama_kos); ?></p>
                </div>
            </div>
        </div>

        <div class="p-6">
            <!-- Kos Info -->
            <div class="bg-white border-2 border-black shadow-[2px_2px_0px_#000] p-4 mb-6">
                <div class="flex items-center space-x-4">
                    <?php if($review->kos->foto_utama): ?>
                        <?php
                            $filePath = storage_path('app/public/' . $review->kos->foto_utama);
                            $fileExists = file_exists($filePath);
                        ?>
                        <?php if($fileExists): ?>
                            <img src="<?php echo e(url('storage/' . $review->kos->foto_utama)); ?>"
                                 alt="<?php echo e($review->kos->nama_kos); ?>"
                                 class="w-16 h-16 object-cover  border-2 border-black">
                        <?php else: ?>
                            <div class="w-16 h-16 bg-gray-100 border-2 border-black  border-2 border-black flex items-center justify-center">
                                <i class="fas fa-home text-gray-500 text-xl"></i>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="w-16 h-16 bg-gray-100 border-2 border-black  border-2 border-black flex items-center justify-center">
                            <i class="fas fa-home text-gray-500 text-xl"></i>
                        </div>
                    <?php endif; ?>
                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <h3 class="font-black text-black"><?php echo e($review->kos->nama_kos); ?></h3>
                            <span class="text-xs px-2 py-1 font-black bg-emerald-400 text-black border-2 border-black">
                                <?php echo e($review->kontrak->kamar->nomor_kamar ?? 'Kamar'); ?>

                            </span>
                        </div>
                        <p class="text-sm text-gray-600 mt-1"><?php echo e($review->kos->alamat); ?>, <?php echo e($review->kos->kota); ?></p>
                        <p class="text-xs text-gray-500 mt-1">
                            <i class="far fa-calendar-alt mr-1"></i>
                            Review dibuat: <?php echo e($review->created_at->format('d M Y')); ?>

                        </p>
                    </div>
                </div>
            </div>

            <form action="<?php echo e(route('penghuni.reviews.update', $review->id_review)); ?>" method="POST" enctype="multipart/form-data" id="reviewForm" data-ajax="true" data-ajax-action="/api/penghuni/reviews/<?php echo e($review->id_review); ?>" data-ajax-method="PUT" data-redirect="<?php echo e(route('penghuni.reviews.history')); ?>" data-success-msg="Review berhasil diperbarui!">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <!-- Rating -->
                <div class="mb-6">
                    <label class="block text-black font-black mb-3 flex items-center">
                        <i class="fas fa-star text-yellow-400 mr-2"></i>
                        Rating Anda
                    </label>
                    <div class="flex items-center space-x-1 mb-2">
                        <?php for($i = 1; $i <= 5; $i++): ?>
                        <button type="button"
                                onclick="setRating(<?php echo e($i); ?>)"
                                class="text-3xl rating-star focus:outline-none transition-all duration-200 hover:scale-110 hover:rotate-12"
                                data-rating="<?php echo e($i); ?>"
                                aria-label="Rating <?php echo e($i); ?> bintang">
                            <?php if($i <= $review->rating): ?>
                                <i class="fas fa-star text-yellow-400"></i>
                            <?php else: ?>
                                <i class="far fa-star text-gray-600"></i>
                            <?php endif; ?>
                        </button>
                        <?php endfor; ?>
                    </div>
                    <input type="hidden" name="rating" id="rating-input" value="<?php echo e($review->rating); ?>" required>
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-600">
                            <span id="rating-text">
                                <?php switch($review->rating):
                                    case (1): ?> Sangat Buruk <?php break; ?>
                                    <?php case (2): ?> Buruk <?php break; ?>
                                    <?php case (3): ?> Cukup <?php break; ?>
                                    <?php case (4): ?> Baik <?php break; ?>
                                    <?php case (5): ?> Sangat Baik <?php break; ?>
                                <?php endswitch; ?>
                            </span>
                        </div>
                        <div class="text-sm text-gray-600">
                            <?php echo e($review->rating); ?> dari 5 bintang
                        </div>
                    </div>
                    <?php $__errorArgs = ['rating'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="mt-2 text-sm text-rose-400"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Komentar -->
                <div class="mb-6">
                    <label for="komentar" class="block text-black font-black mb-3 flex items-center">
                        <i class="fas fa-edit text-emerald-400 mr-2"></i>
                        Komentar
                    </label>
                    <textarea name="komentar" id="komentar"
                              rows="6"
                              class="w-full px-4 py-3 bg-white border-2 border-black shadow-[2px_2px_0px_#000] text-black  focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/30 transition"
                              placeholder="Bagaimana pengalaman Anda selama tinggal di kos ini?"
                              required><?php echo e(old('komentar', $review->komentar)); ?></textarea>
                    <div class="flex items-center justify-between mt-2">
                        <div class="text-xs text-gray-600 flex items-center">
                            <i class="fas fa-lightbulb mr-1 text-yellow-400"></i>
                            Bagikan tentang fasilitas, kebersihan, lingkungan, dan layanan
                        </div>
                        <div class="text-xs text-gray-600">
                            <span id="char-count">0</span>/500 karakter
                        </div>
                    </div>
                    <?php $__errorArgs = ['komentar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="mt-2 text-sm text-rose-400"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Foto Review -->
                <div class="mb-8">
                    <label class="block text-black font-black mb-3 flex items-center">
                        <i class="fas fa-camera text-purple-400 mr-2"></i>
                        Foto Review
                    </label>

                    <?php if($review->foto_review): ?>
                    <div class="mb-4">
                        <p class="text-sm text-gray-600 mb-2">Foto saat ini:</p>
                        <div class="flex items-center space-x-4 p-4 bg-white border-2 border-black shadow-[2px_2px_0px_#000]">
                            <?php
                                $reviewFilePath = storage_path('app/public/' . $review->foto_review);
                                $reviewFileExists = file_exists($reviewFilePath);
                            ?>
                            <?php if($reviewFileExists): ?>
                                <img src="<?php echo e(url('storage/' . $review->foto_review)); ?>"
                                     alt="Foto review"
                                     class="w-24 h-24 object-cover  border-2 border-black">
                            <?php else: ?>
                                <div class="w-24 h-24 bg-gray-100 border-2 border-black  border-2 border-black flex items-center justify-center">
                                    <i class="fas fa-image text-gray-500 text-2xl"></i>
                                </div>
                            <?php endif; ?>
                            <div class="flex-1">
                                <div class="flex items-center space-x-3">
                                    <label class="flex items-center space-x-2 cursor-pointer group">
                                        <div class="relative">
                                            <input type="checkbox" name="hapus_foto" value="1" class="sr-only peer">
                                            <div class="w-6 h-6 bg-gray-100 border-2 border-black rounded-md peer-checked:bg-rose-500 peer-checked:border-rose-500 transition-all duration-200 group-hover:border-rose-400"></div>
                                            <i class="fas fa-check absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-black text-xs opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                                        </div>
                                        <span class="text-sm text-rose-400 group-hover:text-rose-300 transition">Hapus foto ini</span>
                                    </label>
                                </div>
                                <p class="text-xs text-gray-600 mt-2">Centang untuk menghapus foto saat ini</p>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <p class="text-sm text-gray-600 mb-3">Upload foto baru (opsional):</p>
                    <div class="flex items-center justify-center w-full">
                        <label for="foto_review" class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-black  cursor-pointer bg-gray-100 border-2 border-black hover:bg-gray-100 transition-all duration-300 group">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <div class="w-12 h-12 bg-gray-100 border-2 border-black  flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-cloud-upload-alt text-purple-400 text-xl"></i>
                                </div>
                                <p class="mb-2 text-sm text-gray-600 group-hover:text-black transition">
                                    <span class="font-black">Klik untuk upload</span> atau drag & drop
                                </p>
                                <p class="text-xs text-gray-600">PNG, JPG, GIF (Max 2MB)</p>
                            </div>
                            <input id="foto_review" name="foto_review" type="file" class="hidden" accept="image/*" />
                        </label>
                    </div>
                    <div id="image-preview" class="mt-4 hidden">
                        <p class="text-sm text-gray-600 mb-2">Pratinjau foto baru:</p>
                        <div class="relative inline-block">
                            <img id="preview-image" class="w-32 h-32 object-cover  border-2 border-black" />
                            <button type="button" onclick="removePreview()"
                                    class="absolute -top-2 -right-2 w-6 h-6 bg-rose-500 text-black  flex items-center justify-center hover:bg-rose-600 transition">
                                <i class="fas fa-times text-xs"></i>
                            </button>
                        </div>
                    </div>
                    <?php $__errorArgs = ['foto_review'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="mt-2 text-sm text-rose-400"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col-reverse sm:flex-row justify-between items-center space-y-4 sm:space-y-0 space-y-reverse pt-6 border-t border-black">
                    <button type="button"
                            onclick="showDeleteModal()"
                            class="px-6 py-3 bg-red-400 border-2 border-black shadow-[3px_3px_0px_#000] text-black  hover:bg-rose-500/30 transition-all duration-300 group flex items-center">
                        <i class="fas fa-trash-alt mr-2 group-hover:rotate-12 transition-transform"></i>
                        Hapus Review
                    </button>

                    <div class="flex space-x-3">
                        <a href="<?php echo e(route('penghuni.reviews.history')); ?>"
                           class="px-6 py-3 bg-white border-2 border-black shadow-[2px_2px_0px_#000] text-black  hover:bg-gray-100 transition-all duration-300 flex items-center">
                            <i class="fas fa-times mr-2"></i>
                            Batal
                        </a>
                        <button type="submit"
                                id="submit-btn"
                                class="px-6 py-3 bg-emerald-400 border-2 border-black shadow-[3px_3px_0px_#000] text-black  hover:bg-emerald-500/30 transition-all duration-300 flex items-center">
                            <i class="fas fa-save mr-2"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black/80 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border-4 border-black w-96 shadow-[8px_8px_0px_#000] bg-white">
        <div class="mt-3">
            <div class="w-16 h-16 bg-red-400 border-2 border-black flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-exclamation-triangle text-rose-400 text-2xl"></i>
            </div>
            <h3 class="text-lg font-black text-black text-center mb-3">Hapus Review</h3>
            <p class="text-sm text-gray-600 text-center mb-6">
                Apakah Anda yakin ingin menghapus review ini?
                <span class="block text-rose-400 mt-1">Tindakan ini tidak dapat dibatalkan.</span>
            </p>

            <div class="flex justify-center space-x-3">
                <button type="button"
                        onclick="closeDeleteModal()"
                        class="px-5 py-2.5 bg-white border-2 border-black shadow-[2px_2px_0px_#000] text-black  hover:bg-gray-100 transition">
                    Batal
                </button>
                <button type="button"
                        data-ajax-action="/api/penghuni/reviews/<?php echo e($review->id_review); ?>"
                        data-ajax-method="DELETE"
                        data-confirm="Hapus review ini?"
                        data-success-msg="Review berhasil dihapus"
                        data-redirect="<?php echo e(route('penghuni.reviews.history')); ?>"
                        class="px-5 py-2.5 bg-red-400 border-2 border-black shadow-[3px_3px_0px_#000] text-black  hover:bg-rose-500/30 transition">
                    <i class="fas fa-trash-alt mr-2"></i>
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let currentRating = <?php echo e($review->rating); ?>;
    const stars = document.querySelectorAll('.rating-star');
    const ratingInput = document.getElementById('rating-input');
    const ratingText = document.getElementById('rating-text');

    const ratingDescriptions = {
        1: 'Sangat Buruk',
        2: 'Buruk',
        3: 'Cukup',
        4: 'Baik',
        5: 'Sangat Baik'
    };

    function setRating(rating) {
        currentRating = rating;
        ratingInput.value = rating;
        ratingText.textContent = ratingDescriptions[rating];

        stars.forEach((star, index) => {
            const starIcon = star.querySelector('i');
            if (index < rating) {
                starIcon.className = 'fas fa-star text-yellow-400';
                starIcon.parentElement.classList.add('animate-pulse');
                setTimeout(() => {
                    starIcon.parentElement.classList.remove('animate-pulse');
                }, 300);
            } else {
                starIcon.className = 'far fa-star text-gray-600';
            }
        });
    }

    const komentarTextarea = document.getElementById('komentar');
    const charCount = document.getElementById('char-count');

    komentarTextarea.addEventListener('input', function() {
        charCount.textContent = this.value.length;
        if (this.value.length > 500) {
            charCount.classList.add('text-rose-400');
        } else {
            charCount.classList.remove('text-rose-400');
        }
    });

    charCount.textContent = komentarTextarea.value.length;
    if (komentarTextarea.value.length > 500) {
        charCount.classList.add('text-rose-400');
    }

    const fileInput = document.getElementById('foto_review');
    const previewContainer = document.getElementById('image-preview');
    const previewImage = document.getElementById('preview-image');

    fileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            if (this.files[0].size > 2 * 1024 * 1024) {
                alert('Ukuran file maksimal 2MB');
                this.value = '';
                return;
            }

            const reader = new FileReader();

            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.classList.remove('hidden');
            }

            reader.readAsDataURL(this.files[0]);
        }
    });

    function removePreview() {
        fileInput.value = '';
        previewContainer.classList.add('hidden');
        previewImage.src = '';
    }

    function showDeleteModal() {
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    window.onclick = function(event) {
        const modal = document.getElementById('deleteModal');
        if (event.target === modal) {
            closeDeleteModal();
        }
    }

    document.getElementById('reviewForm').addEventListener('submit', function(e) {
        const komentar = document.getElementById('komentar').value.trim();
        const rating = document.getElementById('rating-input').value;

        if (komentar.length < 10) {
            e.preventDefault();
            window.showError && window.showError('Komentar harus minimal 10 karakter');
            return;
        }

        if (komentar.length > 500) {
            e.preventDefault();
            window.showError && window.showError('Komentar maksimal 500 karakter');
            return;
        }

        if (!rating || rating < 1 || rating > 5) {
            e.preventDefault();
            window.showError && window.showError('Harap berikan rating');
            return;
        }
    });


</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views\penghuni\reviews\edit.blade.php ENDPATH**/ ?>