<?php $__env->startSection('title', 'Tambah Kamar - AyoKos'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto p-4 md:p-6">
    <!-- Breadcrumb -->
    <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-4 mb-6">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="<?php echo e(route('pemilik.dashboard')); ?>" class="inline-flex items-center text-sm font-medium text-slate-100 hover:text-white transition-colors">
                        <i class="fas fa-home mr-2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="inline-flex items-center">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-white/50 text-xs mx-2"></i>
                        <a href="<?php echo e(route('pemilik.kamar.index')); ?>" class="inline-flex items-center text-sm font-medium text-slate-100 hover:text-white transition-colors">
                            <i class="fas fa-bed mr-2"></i>
                            Kelola Kamar
                        </a>
                    </div>
                </li>
                <li class="inline-flex items-center">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-white/50 text-xs mx-2"></i>
                        <span class="inline-flex items-center text-sm font-medium text-white">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Kamar
                        </span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
    <!-- Header -->
    <div class="mb-8">
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6 mb-6">

            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-white mb-4">Tambah Kamar Baru</h1>
                <p class="text-slate-100 mt-1 mb-4">Isi form berikut untuk menambahkan kamar baru ke kos Anda</p>
            </div>
        </div>
        

    <?php if($errors->any()): ?>
        <div class="mb-6 p-4 bg-red-500/20 backdrop-blur-sm border border-red-500/20 rounded-xl">
            <div class="flex items-start space-x-3">
                <div class="p-2 bg-red-500/20 rounded-lg">
                    <i class="fas fa-exclamation-circle text-red-400"></i>
                </div>
                <div class="flex-1">
                    <h3 class="text-white font-medium mb-1">Ada beberapa kesalahan:</h3>
                    <ul class="text-red-300 text-sm space-y-1">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="flex items-center">
                            <i class="fas fa-circle text-xs mr-2"></i>
                            <?php echo e($error); ?>

                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Form -->
    <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl overflow-hidden">
        <form method="POST" action="<?php echo e(route('pemilik.kamar.store')); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <!-- Form Content -->
            <div class="p-6">
                <div class="space-y-8">
                    <!-- Section 1: Informasi Dasar -->
                    <div class="border-b border-white/10 pb-8">
                        <h2 class="text-lg font-bold text-white mb-6 flex items-center">
                            <i class="fas fa-info-circle text-sky-400 mr-3"></i>
                            Informasi Dasar Kamar
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Pilih Kos -->
                            <div>
                                <label class="block text-sm font-medium text-white mb-3">
                                    Pilih Kos <span class="text-red-400">*</span>
                                </label>
                                <div class="relative">
                                    <i class="fas fa-home absolute left-4 top-1/2 transform -translate-y-1/2 text-white/50"></i>
                                    <select name="id_kos" 
                                            class="w-full pl-12 pr-10 py-3 bg-white/5 border border-white/20 text-white rounded-xl focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-500/30 appearance-none transition"
                                            required>
                                        <option value="">Pilih Kos...</option>
                                        <?php $__currentLoopData = $kos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($k->id_kos); ?>" <?php echo e(old('id_kos') == $k->id_kos ? 'selected' : ''); ?>>
                                            <?php echo e($k->nama_kos); ?> - <?php echo e($k->alamat); ?>

                                        </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <i class="fas fa-chevron-down absolute right-4 top-1/2 transform -translate-y-1/2 text-white/50 pointer-events-none"></i>
                                </div>
                                <p class="text-sm text-slate-100 mt-2">Pilih kos tempat kamar ini akan ditambahkan</p>
                            </div>

                            <!-- Nomor Kamar -->
                            <div>
                                <label class="block text-sm font-medium text-white mb-3">
                                    Nomor Kamar <span class="text-red-400">*</span>
                                </label>
                                <div class="relative">
                                    <i class="fas fa-hashtag absolute left-4 top-1/2 transform -translate-y-1/2 text-white/50"></i>
                                    <input type="text" 
                                           name="nomor_kamar" 
                                           value="<?php echo e(old('nomor_kamar')); ?>" 
                                           class="w-full pl-12 pr-4 py-3 bg-white/5 border border-white/20 text-white rounded-xl focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-500/30 transition"
                                           placeholder="A1, B2, 101"
                                           required 
                                           maxlength="10">
                                </div>
                                <p class="text-sm text-slate-100 mt-2">Nomor unik untuk identifikasi kamar</p>
                            </div>

                            <!-- Tipe Kamar -->
                            <div>
                                <label class="block text-sm font-medium text-white mb-3">
                                    Tipe Kamar <span class="text-red-400">*</span>
                                </label>
                                <div class="grid grid-cols-2 gap-3">
                                    <?php
                                        $tipeOptions = [
                                            'Standar' => ['color' => 'bg-blue-500/20', 'icon' => 'fa-home'],
                                            'Deluxe' => ['color' => 'bg-purple-500/20', 'icon' => 'fa-crown'],
                                            'VIP' => ['color' => 'bg-yellow-500/20', 'icon' => 'fa-gem'],
                                            'Superior' => ['color' => 'bg-emerald-500/20', 'icon' => 'fa-star'],
                                            'Ekonomi' => ['color' => 'bg-gray-500/20', 'icon' => 'fa-wallet'],
                                        ];
                                    ?>
                                    <?php $__currentLoopData = $tipeOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $style): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <label class="cursor-pointer">
                                        <input type="radio" 
                                               name="tipe_kamar" 
                                               value="<?php echo e($value); ?>" 
                                               class="hidden peer"
                                               <?php echo e(old('tipe_kamar') == $value ? 'checked' : ''); ?>

                                               required>
                                        <div class="p-4 border-2 border-white/20 rounded-xl peer-checked:border-sky-500 peer-checked:bg-sky-500/20 transition-all duration-300">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-10 h-10 <?php echo e($style['color']); ?> backdrop-blur-sm border border-white/20 rounded-lg flex items-center justify-center">
                                                    <i class="fas <?php echo e($style['icon']); ?> text-white text-sm"></i>
                                                </div>
                                                <div>
                                                    <span class="block font-medium text-white"><?php echo e($value); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>

                            <!-- Harga Sewa -->
                            <div>
                                <label class="block text-sm font-medium text-white mb-3">
                                    Harga Sewa per Bulan <span class="text-red-400">*</span>
                                </label>
                                <div class="relative">
                                    <i class="fas fa-money-bill-wave absolute left-4 top-1/2 transform -translate-y-1/2 text-white/50"></i>
                                    <input type="number" 
                                           name="harga" 
                                           value="<?php echo e(old('harga')); ?>" 
                                           class="w-full pl-12 pr-4 py-3 bg-white/5 border border-white/20 text-white rounded-xl focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-500/30 transition"
                                           placeholder="1500000"
                                           required 
                                           min="0">
                                </div>
                                <p class="text-sm text-slate-100 mt-2">Harga sewa dalam Rupiah</p>
                            </div>

                            <!-- Luas Kamar -->
                            <div>
                                <label class="block text-sm font-medium text-white mb-3">
                                    Luas Kamar <span class="text-red-400">*</span>
                                </label>
                                <div class="relative">
                                    <i class="fas fa-ruler-combined absolute left-4 top-1/2 transform -translate-y-1/2 text-white/50"></i>
                                    <input type="text" 
                                           name="luas_kamar" 
                                           value="<?php echo e(old('luas_kamar')); ?>" 
                                           class="w-full pl-12 pr-4 py-3 bg-white/5 border border-white/20 text-white rounded-xl focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-500/30 transition"
                                           placeholder="3x4, 4x4"
                                           required
                                           maxlength="20">
                                </div>
                                <p class="text-sm text-slate-100 mt-2">Ukuran kamar dalam meter (panjang x lebar)</p>
                            </div>

                            <!-- Kapasitas -->
                            <div>
                                <label class="block text-sm font-medium text-white mb-3">
                                    Kapasitas <span class="text-red-400">*</span>
                                </label>
                                <div class="grid grid-cols-4 gap-3">
                                    <?php for($i = 1; $i <= 4; $i++): ?>
                                    <label class="cursor-pointer">
                                        <input type="radio" 
                                               name="kapasitas" 
                                               value="<?php echo e($i); ?>" 
                                               class="hidden peer"
                                               <?php echo e(old('kapasitas') == $i ? 'checked' : ''); ?>

                                               required>
                                        <div class="p-4 border-2 border-white/20 rounded-xl text-center peer-checked:border-sky-500 peer-checked:bg-sky-500/20 transition-all duration-300">
                                            <div class="text-2xl font-bold text-white mb-1"><?php echo e($i); ?></div>
                                            <div class="text-xs text-slate-100">
                                                <?php if($i == 1): ?> 1 Orang <?php else: ?> <?php echo e($i); ?> Orang <?php endif; ?>
                                            </div>
                                        </div>
                                    </label>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Fasilitas Kamar -->
                    <div class="border-b border-white/10 pb-8">
                        <h2 class="text-lg font-bold text-white mb-6 flex items-center">
                            <i class="fas fa-list-check text-emerald-400 mr-3"></i>
                            Fasilitas Kamar
                        </h2>
                        
                        <div class="bg-white/5 border border-white/20 rounded-xl p-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                <?php
                                    $facilityGroups = [
                                        'Kamar Mandi' => ['Kamar mandi dalam', 'Water heater'],
                                        'Elektronik' => ['AC', 'Kipas angin', 'TV', 'Kulkas mini', 'WiFi'],
                                        'Furniture' => ['Kasur', 'Lemari', 'Meja belajar', 'Kursi'],
                                        'Lainnya' => ['Dapur', 'Jendela', 'Balkon']
                                    ];
                                ?>
                                
                                <?php $__currentLoopData = $facilityGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group => $facilities): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div>
                                    <h4 class="text-sm font-medium text-slate-100 mb-3"><?php echo e($group); ?></h4>
                                    <div class="space-y-2">
                                        <?php $__currentLoopData = $facilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $icons = [
                                                'Kamar mandi dalam' => 'fa-bath',
                                                'Water heater' => 'fa-temperature-high',
                                                'AC' => 'fa-snowflake',
                                                'Kipas angin' => 'fa-fan',
                                                'TV' => 'fa-tv',
                                                'Kulkas mini' => 'fa-refrigerator',
                                                'WiFi' => 'fa-wifi',
                                                'Kasur' => 'fa-bed',
                                                'Lemari' => 'fa-archive',
                                                'Meja belajar' => 'fa-table',
                                                'Kursi' => 'fa-chair',
                                                'Dapur' => 'fa-kitchen-set',
                                                'Jendela' => 'fa-window-maximize',
                                                'Balkon' => 'fa-building'
                                            ];
                                        ?>
                                        <label class="flex items-center space-x-3 cursor-pointer p-2 hover:bg-white/10 rounded-lg transition">
                                            <input type="checkbox" 
                                                   name="fasilitas_kamar[]" 
                                                   value="<?php echo e($facility); ?>" 
                                                   class="w-4 h-4 bg-white/5 border-white/20 rounded text-sky-500 focus:ring-sky-500 focus:ring-2"
                                                   <?php echo e(in_array($facility, old('fasilitas_kamar', [])) ? 'checked' : ''); ?>>
                                            <div class="flex-1 flex items-center">
                                                <i class="fas <?php echo e($icons[$facility] ?? 'fa-check'); ?> w-5 text-white/50 mr-2"></i>
                                                <span class="text-sm text-white"><?php echo e($facility); ?></span>
                                            </div>
                                        </label>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <p class="text-sm text-slate-100 mt-4">
                                <i class="fas fa-info-circle mr-1"></i>
                                Pilih fasilitas yang tersedia di kamar ini
                            </p>
                        </div>
                    </div>

                    <!-- Section 3: Foto & Status -->
                    <div>
                        <h2 class="text-lg font-bold text-white mb-6 flex items-center">
                            <i class="fas fa-camera text-yellow-400 mr-3"></i>
                            Foto & Status Kamar
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Foto Kamar -->
                            <div>
                                <label class="block text-sm font-medium text-white mb-3">
                                    Foto Kamar
                                </label>
                                <div class="border-2 border-dashed border-white/20 rounded-xl p-6 text-center hover:border-sky-500/50 transition">
                                    <div class="mb-4">
                                        <div class="w-16 h-16 bg-white/5 rounded-full flex items-center justify-center mx-auto">
                                            <i class="fas fa-camera text-2xl text-white/50"></i>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <input type="file" 
                                               name="foto_kamar" 
                                               id="foto_kamar"
                                               class="hidden"
                                               accept="image/*">
                                        <label for="foto_kamar" 
                                               class="inline-block px-4 py-2 bg-sky-500/20 backdrop-blur-sm border border-sky-500/20 hover:bg-sky-500/10 text-white rounded-lg cursor-pointer transition">
                                            <i class="fas fa-upload mr-2"></i>
                                            Unggah Foto
                                        </label>
                                    </div>
                                    <p class="text-sm text-slate-100">Format: JPG, PNG, JPEG (max 2 MB)</p>
                                    <div id="file-name" class="text-xs text-sky-400 mt-2"></div>

                                    
                                    <div id="preview-wrap" class="hidden mt-4 flex justify-center">
                                        <img id="preview-img" class="max-w-full max-h-48 rounded-xl border border-white/20" alt="Preview">
                                    </div>
                                </div>
                            </div>

                            <!-- Status Kamar -->
                            <div>
                                <label class="block text-sm font-medium text-white mb-3">
                                    Status Kamar <span class="text-red-400">*</span>
                                </label>
                                <div class="space-y-3">
                                    <?php
                                        $statusOptions = [
                                            'tersedia' => ['color' => 'bg-emerald-500/20', 'icon' => 'fa-check-circle', 'label' => 'Tersedia'],
                                            'terisi' => ['color' => 'bg-blue-500/20', 'icon' => 'fa-user-check', 'label' => 'Terisi'],
                                            'maintenance' => ['color' => 'bg-yellow-500/20', 'icon' => 'fa-tools', 'label' => 'Maintenance'],
                                        ];
                                    ?>
                                    
                                    <?php $__currentLoopData = $statusOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $style): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <label class="cursor-pointer block">
                                        <input type="radio" 
                                               name="status_kamar" 
                                               value="<?php echo e($value); ?>" 
                                               class="hidden peer"
                                               <?php echo e(old('status_kamar') == $value ? 'checked' : ($value == 'tersedia' && !old('status_kamar') ? 'checked' : '')); ?>

                                               required>
                                        <div class="p-4 border-2 border-white/20 rounded-xl peer-checked:border-sky-500 peer-checked:bg-sky-500/20 transition-all duration-300">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center space-x-3">
                                                    <div class="w-10 h-10 <?php echo e($style['color']); ?> backdrop-blur-sm border border-white/20 rounded-lg flex items-center justify-center">
                                                        <i class="fas <?php echo e($style['icon']); ?> text-white"></i>
                                                    </div>
                                                    <div>
                                                        <span class="block font-medium text-white"><?php echo e($style['label']); ?></span>
                                                        <span class="text-xs text-slate-100">
                                                            <?php if($value == 'tersedia'): ?>
                                                            Kamar siap disewa
                                                            <?php elseif($value == 'terisi'): ?>
                                                            Kamar sedang ditempati
                                                            <?php else: ?>
                                                            Kamar sedang diperbaiki
                                                            <?php endif; ?>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="w-6 h-6 border-2 border-white/20 rounded-full peer-checked:border-sky-500 peer-checked:bg-sky-500 flex items-center justify-center">
                                                    <i class="fas fa-check text-white text-xs hidden peer-checked:block"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-10 pt-8 border-t border-white/10 flex flex-col sm:flex-row justify-between space-y-4 sm:space-y-0">
                    <div>
                        <a href="<?php echo e(route('pemilik.kamar.index')); ?>" 
                           class="inline-flex items-center px-6 py-3 border-2 border-white/20 text-white rounded-xl hover:bg-white/10 transition">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali ke Daftar
                        </a>
                    </div>
                    
                    <div class="flex space-x-4">
                        <button type="button" onclick="resetForm()"
                                class="px-6 py-3 border-2 border-white/20 text-white rounded-xl hover:border-red-500 hover:text-red-400 transition">
                            <i class="fas fa-redo mr-2"></i>
                            Reset Form
                        </button>
                        <button type="submit" 
                                class="px-8 py-3 bg-sky-500/20 backdrop-blur-sm border border-sky-500/20 hover:bg-sky-500/10 text-white font-semibold rounded-xl transition-all duration-300">
                            <i class="fas fa-save mr-2"></i>
                            Simpan Kamar Baru
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Reset Confirmation Modal -->
<div id="resetModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border border-slate-200 w-96 shadow-2xl rounded-2xl bg-white">
        <div class="mt-3 text-center">
            <div class="mb-4 inline-block">
                <div class="w-16 h-16 rounded-full bg-orange-100 flex items-center justify-center mx-auto">
                    <i class="fas fa-exclamation-triangle text-orange-500 text-2xl"></i>
                </div>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-2">Konfirmasi Reset</h3>
            <p class="text-slate-500 mb-6">Apakah Anda yakin ingin mengosongkan semua isian form? Tindakan ini tidak dapat dibatalkan.</p>
            
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <button type="button" data-modal-close
                        class="flex-1 px-6 py-2.5 bg-slate-100 text-slate-700 rounded-xl hover:bg-slate-200 transition font-medium">
                    Batal
                </button>
                <button type="button" id="confirmResetBtn"
                        class="flex-1 px-6 py-2.5 bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold rounded-xl hover:from-orange-600 hover:to-red-600 transition shadow-lg">
                    Ya, Reset Form
                </button>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    let resetModal;
    
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Modal using class from app.blade.php
        // Wrap in a small timeout to ensure Modal class is globally available
        setTimeout(() => {
            if (typeof Modal !== 'undefined') {
                resetModal = new Modal('resetModal');
                
                // Custom animation for the modal content
                const originalShow = resetModal.show.bind(resetModal);
                const originalHide = resetModal.hide.bind(resetModal);
                const modalContent = document.getElementById('resetModalContent');
                
                if (modalContent) {
                    resetModal.show = function() {
                        originalShow();
                        setTimeout(() => {
                            modalContent.classList.remove('scale-95', 'opacity-0');
                            modalContent.classList.add('scale-100', 'opacity-100');
                        }, 10);
                    };
                    
                    resetModal.hide = function() {
                        modalContent.classList.remove('scale-100', 'opacity-100');
                        modalContent.classList.add('scale-95', 'opacity-0');
                        setTimeout(() => {
                            originalHide();
                        }, 300);
                    };
                }
            } else {
                console.error('Modal class not found. Make sure app.blade.php defines it.');
            }
        }, 100);

        // Handle confirm reset button click
        const confirmBtn = document.getElementById('confirmResetBtn');
        if (confirmBtn) {
            confirmBtn.addEventListener('click', function() {
                executeReset();
                if (resetModal) resetModal.hide();
            });
        }
        
        // Setup specialized modal closing if not already handled
        document.querySelectorAll('[data-modal-close]').forEach(el => {
            el.addEventListener('click', () => {
                if (resetModal) resetModal.hide();
            });
        });
    });

    // File input display with preview
    document.getElementById('foto_kamar').addEventListener('change', function (e) {
        const fileName   = document.getElementById('file-name');
        const previewImg = document.getElementById('preview-img');
        const previewWrap= document.getElementById('preview-wrap');

        if (this.files && this.files[0]) {
            const file = this.files[0];

            if (!file.type.startsWith('image/')) {
                showToast('File harus berupa gambar', 'error');
                this.value = '';
                if (fileName) fileName.classList.add('hidden');
                if (previewWrap) previewWrap.classList.add('hidden');
                return;
            }

            if (fileName) {
                fileName.textContent = file.name;
                fileName.classList.remove('hidden');
            }

            const url = URL.createObjectURL(file);
            if (previewImg) {
                previewImg.src = url;
                if (previewWrap) previewWrap.classList.remove('hidden');
                previewImg.onload = () => URL.revokeObjectURL(url);
            }
        } else {
            if (fileName) fileName.classList.add('hidden');
            if (previewWrap) previewWrap.classList.add('hidden');
        }
    });

    // Function called by the Reset Form button
    function resetForm() {
        if (resetModal) {
            resetModal.show();
        } else {
            // Fallback to native confirm if Modal class failed to load
            if (confirm('Apakah Anda yakin ingin mengosongkan semua isian form?')) {
                executeReset();
            }
        }
    }

    // Logic to actually clear the form
    function executeReset() {
        const form = document.querySelector('form');
        if (form) form.reset();

        // Clear file display elements
        const fileName = document.getElementById('file-name');
        const previewWrap = document.getElementById('preview-wrap');
        const previewImg = document.getElementById('preview-img');
        
        if (fileName) {
            fileName.textContent = '';
            fileName.classList.add('hidden');
        }
        if (previewWrap) previewWrap.classList.add('hidden');
        if (previewImg) previewImg.src = '';

        // Restore radio button defaults
        const statusTersedia = document.querySelector('input[name="status_kamar"][value="tersedia"]');
        if (statusTersedia) statusTersedia.checked = true;
        
        const kapasitasOne = document.querySelector('input[name="kapasitas"][value="1"]');
        if (kapasitasOne) kapasitasOne.checked = true;

        showToast('Form berhasil dikosongkan', 'success');
    }

    // Form validation on submit
    document.querySelector('form').addEventListener('submit', function(e) {
        const form = this;
        let isValid = true;
        let firstInvalidField = null;
        
        // Clear previous error states
        form.querySelectorAll('.border-rose-500').forEach(el => {
            el.classList.remove('border-rose-500', 'ring-2', 'ring-rose-500/20');
        });

        // 1. Validate required inputs/selects
        const requiredInputs = form.querySelectorAll('input[required]:not([type="radio"]):not([type="checkbox"]), select[required]');
        requiredInputs.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                if (!firstInvalidField) firstInvalidField = field;
                field.classList.add('border-rose-500', 'ring-2', 'ring-rose-500/20');
            }
        });

        // 2. Validate radio groups (tipe_kamar, kapasitas, status_kamar)
        const radioGroups = ['tipe_kamar', 'kapasitas', 'status_kamar'];
        radioGroups.forEach(groupName => {
            const radios = form.querySelectorAll(`input[name="${groupName}"]`);
            if (radios.length > 0) {
                const isRequired = Array.from(radios).some(r => r.hasAttribute('required'));
                if (isRequired) {
                    const checked = form.querySelector(`input[name="${groupName}"]:checked`);
                    if (!checked) {
                        isValid = false;
                        // Target the main container for this section
                        const radioContainer = radios[0].closest('.grid') || radios[0].closest('.space-y-3');
                        if (radioContainer) {
                            radioContainer.classList.add('border-rose-500', 'ring-2', 'ring-rose-500/20', 'p-2', 'rounded-xl');
                            radioContainer.querySelectorAll('.border-2').forEach(el => {
                                el.classList.add('border-rose-500/50');
                            });
                        }
                        if (!firstInvalidField) firstInvalidField = radioContainer || radios[0];
                    }
                }
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            if (firstInvalidField) {
                const scrollTarget = firstInvalidField.closest('div') || firstInvalidField;
                scrollTarget.scrollIntoView({ behavior: 'smooth', block: 'center' });
                // If it's a normal input, focus it
                if (firstInvalidField.focus && !firstInvalidField.readOnly) {
                    firstInvalidField.focus();
                }
            }
            showToast('Harap isi semua field yang wajib diisi', 'error');
        }
    });

    // Premium Toast notification system
    function showToast(message, type = 'info') {
        const toast = document.createElement('div');
        
        const styles = {
            success: 'bg-emerald-500/10 border-emerald-500/20 text-emerald-400 glow-emerald',
            error: 'bg-rose-500/10 border-rose-500/20 text-rose-400 glow-rose',
            info: 'bg-blue-500/10 border-blue-500/20 text-blue-400 glow-blue'
        };
        
        const icons = {
            success: 'fa-check-circle',
            error: 'fa-exclamation-circle',
            info: 'fa-info-circle'
        };
        
        const styleClass = styles[type] || styles.info;
        const iconClass = icons[type] || icons.info;

        toast.className = `fixed top-6 right-6 px-6 py-4 rounded-2xl shadow-2xl z-[10001] border backdrop-blur-md transform transition-all duration-500 translate-x-12 opacity-0 ${styleClass}`;
        
        toast.innerHTML = `
            <div class="flex items-center space-x-4 min-w-[280px]">
                <div class="flex-shrink-0 w-10 h-10 rounded-xl flex items-center justify-center ${type === 'success' ? 'bg-emerald-500/20' : type === 'error' ? 'bg-rose-500/20' : 'bg-blue-500/20'}">
                    <i class="fas ${iconClass} text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="font-bold text-white text-sm tracking-tight capitalize leading-none text-nowrap">${type}</p>
                    <p class="text-white/70 text-xs mt-1.5">${message}</p>
                </div>
                <button class="text-white/30 hover:text-white transition-colors ml-2 p-1" onclick="this.closest('.fixed').remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        
        document.body.appendChild(toast);
        
        requestAnimationFrame(() => {
            toast.classList.remove('translate-x-12', 'opacity-0');
            toast.classList.add('translate-x-0', 'opacity-100');
        });
        
        setTimeout(() => {
            if (toast.parentElement) {
                toast.classList.remove('translate-x-0', 'opacity-100');
                toast.classList.add('translate-x-12', 'opacity-0');
                setTimeout(() => toast.remove(), 500);
            }
        }, 5000);
    }
</script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* Custom styles for radio and checkbox */
    input[type="radio"]:checked + div {
        border-color: #0ea5e9;
        background-color: rgba(14, 165, 233, 0.1);
    }
    
    input[type="checkbox"]:checked {
        background-color: #0ea5e9;
        border-color: #0ea5e9;
    }
    
    label:has(input[type="checkbox"]:checked) .fa-check {
        color: #0ea5e9;
    }
    
    #foto_kamar + label:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.2);
    }
    
    input:focus, select:focus, textarea:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
    }
    
    input, select, textarea, button, label {
        transition: all 0.2s ease;
    }

    /* Glow effects for toasts */
    .glow-emerald { box-shadow: 0 10px 40px -10px rgba(16, 185, 129, 0.4); }
    .glow-rose { box-shadow: 0 10px 40px -10px rgba(244, 63, 94, 0.4); }
    .glow-blue { box-shadow: 0 10px 40px -10px rgba(14, 165, 233, 0.4); }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/pemilik/kamar/create.blade.php ENDPATH**/ ?>