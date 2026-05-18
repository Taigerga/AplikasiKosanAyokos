<?php $__env->startSection('title', 'Edit Kamar - AyoKos'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-4 md:p-6 lg:p-8 space-y-6 max-w-7xl mx-auto">
    <!-- Breadcrumb -->
    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 mb-6">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="<?php echo e(route('pemilik.dashboard')); ?>" class="inline-flex items-center text-sm font-black text-gray-700 hover:text-black transition-colors">
                        <i class="fas fa-home mr-2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="inline-flex items-center">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                        <a href="<?php echo e(route('pemilik.kamar.index')); ?>" class="inline-flex items-center text-sm font-black text-gray-700 hover:text-black transition-colors">
                            <i class="fas fa-bed mr-2"></i>
                            Kelola Kamar
                        </a>
                    </div>
                </li>
                <li class="inline-flex items-center">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                        <span class="inline-flex items-center text-sm font-black text-black">
                            <i class="fas fa-pencil mr-2"></i>
                            Edit Kamar
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
                <h1 class="text-2xl md:text-3xl font-black text-black mb-2">Edit Kamar <?php echo e($kamar->nomor_kamar); ?></h1>
                <p class="text-gray-700">Perbarui informasi dan fasilitas kamar</p>
            </div>
            <div class="flex items-center space-x-2">
                <span class="px-3 py-1 text-xs font-black border-2 border-black shadow-[2px_2px_0px_#000]
                    <?php echo e($kamar->status_kamar == 'tersedia' ? 'bg-emerald-400 text-black' : 
                       ($kamar->status_kamar == 'terisi' ? 'bg-blue-400 text-black' : 
                       'bg-yellow-400 text-black')); ?>">
                    <?php echo e(ucfirst($kamar->status_kamar)); ?>

                </span>
                <span class="px-3 py-1 text-xs font-black bg-sky-400 text-black border-2 border-black shadow-[2px_2px_0px_#000]">
                    <?php echo e($kamar->tipe_kamar); ?>

                </span>
            </div>
        </div>
    </div>

    <?php if($errors->any()): ?>
        <div class="bg-red-400 border-2 border-black text-black font-black px-6 py-4 shadow-[3px_3px_0px_#000]">
            <div class="flex items-center mb-2">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <span class="font-black">Terjadi kesalahan:</span>
            </div>
            <ul class="text-sm space-y-1">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="flex items-start">
                    <i class="fas fa-chevron-right text-xs mt-1 mr-2 text-rose-400"></i>
                    <span><?php echo e($error); ?></span>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if(session('success')): ?>
        <div class="bg-emerald-400 border-2 border-black text-black font-black px-4 py-3 shadow-[3px_3px_0px_#000] mb-6">
            <div class="flex items-center"><i class="fas fa-check-circle mr-3"></i><?php echo e(session('success')); ?></div>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="bg-red-400 border-2 border-black text-black font-black px-4 py-3 shadow-[3px_3px_0px_#000] mb-6">
            <div class="flex items-center"><i class="fas fa-exclamation-circle mr-3"></i><?php echo e(session('error')); ?></div>
        </div>
    <?php endif; ?>

    <!-- Form -->
    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
        <form method="POST" action="<?php echo e(route('pemilik.kamar.update', $kamar->id_kamar)); ?>" enctype="multipart/form-data" data-ajax="true" data-ajax-action="/api/pemilik/kamar/<?php echo e($kamar->id_kamar); ?>" data-ajax-method="PUT" data-redirect="<?php echo e(route('pemilik.kamar.index')); ?>" data-success-msg="Kamar berhasil diperbarui!" data-confirm="Apakah Anda yakin data kamar yang diubah sudah benar?">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-6">
                    <!-- Pilih Kos -->
                    <div>
                        <label class="block text-sm font-black text-black mb-3 flex items-center">
                            <i class="fas fa-home text-sky-400 mr-2 w-5"></i>
                            Pilih Kos <span class="text-rose-400 ml-1">*</span>
                        </label>
                        <div class="relative">
                            <i class="fas fa-chevron-down absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                            <select name="id_kos" data-searchable
                                    class="w-full pl-12 pr-10 py-3 border-2 border-black text-black font-black placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white appearance-none transition" required>
                                <option value="">Pilih Kos</option>
                                <?php $__currentLoopData = $kos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($k->id_kos); ?>" <?php echo e(old('id_kos', $kamar->id_kos) == $k->id_kos ? 'selected' : ''); ?>>
                                    <?php echo e($k->nama_kos); ?> - <?php echo e($k->alamat); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <i class="fas fa-building absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                    </div>

                    <!-- Nomor Kamar -->
                    <div>
                        <label class="block text-sm font-black text-black mb-3 flex items-center">
                            <i class="fas fa-hashtag text-sky-400 mr-2 w-5"></i>
                            Nomor Kamar <span class="text-rose-400 ml-1">*</span>
                        </label>
                        <div class="relative">
                            <i class="fas fa-door-closed absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <input type="text" 
                                   name="nomor_kamar" 
                                   value="<?php echo e(old('nomor_kamar', $kamar->nomor_kamar)); ?>" 
                                   class="w-full pl-12 pr-4 py-3 border-2 border-black text-black font-black placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white transition"
                                   placeholder="Contoh: A1, B2, 101"
                                   required maxlength="10">
                        </div>
                    </div>

                    <!-- Tipe Kamar -->
                    <div>
                        <label class="block text-sm font-black text-black mb-3 flex items-center">
                            <i class="fas fa-star text-sky-400 mr-2 w-5"></i>
                            Tipe Kamar <span class="text-rose-400 ml-1">*</span>
                        </label>
                        <div class="relative">
                            <i class="fas fa-chevron-down absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                            <select name="tipe_kamar" 
                                    class="w-full pl-12 pr-10 py-3 border-2 border-black text-black font-black placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white appearance-none transition" required>
                                <option value="">Pilih Tipe Kamar</option>
                                <option value="Standar" <?php echo e(old('tipe_kamar', $kamar->tipe_kamar) == 'Standar' ? 'selected' : ''); ?>>Standar</option>
                                <option value="Deluxe" <?php echo e(old('tipe_kamar', $kamar->tipe_kamar) == 'Deluxe' ? 'selected' : ''); ?>>Deluxe</option>
                                <option value="VIP" <?php echo e(old('tipe_kamar', $kamar->tipe_kamar) == 'VIP' ? 'selected' : ''); ?>>VIP</option>
                                <option value="Superior" <?php echo e(old('tipe_kamar', $kamar->tipe_kamar) == 'Superior' ? 'selected' : ''); ?>>Superior</option>
                                <option value="Ekonomi" <?php echo e(old('tipe_kamar', $kamar->tipe_kamar) == 'Ekonomi' ? 'selected' : ''); ?>>Ekonomi</option>
                            </select>
                            <i class="fas fa-crown absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                    </div>

                    <!-- Harga -->
                    <div>
                        <label class="block text-sm font-black text-black mb-3 flex items-center">
                            <i class="fas fa-money-bill-wave text-sky-400 mr-2 w-5"></i>
                            Harga Sewa per Bulan <span class="text-rose-400 ml-1">*</span>
                        </label>
                        <div class="relative">
                            <i class="fas fa-tag absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <input type="number" 
                                   name="harga" 
                                   value="<?php echo e(old('harga', $kamar->harga)); ?>" 
                                   class="w-full pl-12 pr-4 py-3 border-2 border-black text-black font-black placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white transition"
                                   required min="0">
                            <span class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400">/bulan</span>
                        </div>
                    </div>

                    <!-- Luas Kamar -->
                    <div>
                        <label class="block text-sm font-black text-black mb-3 flex items-center">
                            <i class="fas fa-ruler-combined text-sky-400 mr-2 w-5"></i>
                            Luas Kamar <span class="text-rose-400 ml-1">*</span>
                        </label>
                        <div class="relative">
                            <i class="fas fa-expand absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <input type="text" 
                                   name="luas_kamar" 
                                   value="<?php echo e(old('luas_kamar', $kamar->luas_kamar)); ?>" 
                                   class="w-full pl-12 pr-4 py-3 border-2 border-black text-black font-black placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white transition"
                                   placeholder="Contoh: 3x4 m²"
                                   required
                                   maxlength="20">
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Kapasitas -->
                    <div>
                        <label class="block text-sm font-black text-black mb-3 flex items-center">
                            <i class="fas fa-users text-sky-400 mr-2 w-5"></i>
                            Kapasitas <span class="text-rose-400 ml-1">*</span>
                        </label>
                        <div class="relative">
                            <i class="fas fa-chevron-down absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                            <select name="kapasitas" 
                                    class="w-full pl-12 pr-10 py-3 border-2 border-black text-black font-black placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white appearance-none transition" required>
                                <option value="">Pilih Kapasitas</option>
                                <?php for($i = 1; $i <= 4; $i++): ?>
                                <option value="<?php echo e($i); ?>" <?php echo e(old('kapasitas', $kamar->kapasitas) == $i ? 'selected' : ''); ?>>
                                    <?php echo e($i); ?> Orang
                                </option>
                                <?php endfor; ?>
                            </select>
                            <i class="fas fa-user-friends absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                    </div>

                    <!-- Status Kamar -->
                    <div>
                        <label class="block text-sm font-black text-black mb-3 flex items-center">
                            <i class="fas fa-info-circle text-sky-400 mr-2 w-5"></i>
                            Status Kamar <span class="text-rose-400 ml-1">*</span>
                        </label>
                        <div class="grid grid-cols-3 gap-2">
                            <label class="cursor-pointer">
                                <input type="radio" 
                                       name="status_kamar" 
                                       value="tersedia" 
                                       class="hidden peer"
                                       <?php echo e(old('status_kamar', $kamar->status_kamar) == 'tersedia' ? 'checked' : ''); ?>>
                                <div class="p-3 text-center border-2 border-black peer-checked:bg-emerald-200 transition-all duration-300">
                                    <div class="text-emerald-400 mb-1">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <span class="text-sm font-black text-black">Tersedia</span>
                                </div>
                            </label>
                            
                            <label class="cursor-pointer">
                                <input type="radio" 
                                       name="status_kamar" 
                                       value="terisi" 
                                       class="hidden peer"
                                       <?php echo e(old('status_kamar', $kamar->status_kamar) == 'terisi' ? 'checked' : ''); ?>>
                                <div class="p-3 text-center border-2 border-black peer-checked:bg-blue-200 transition-all duration-300">
                                    <div class="text-blue-400 mb-1">
                                        <i class="fas fa-user-check"></i>
                                    </div>
                                    <span class="text-sm font-black text-black">Terisi</span>
                                </div>
                            </label>
                            
                            <label class="cursor-pointer">
                                <input type="radio" 
                                       name="status_kamar" 
                                       value="maintenance" 
                                       class="hidden peer"
                                       <?php echo e(old('status_kamar', $kamar->status_kamar) == 'maintenance' ? 'checked' : ''); ?>>
                                <div class="p-3 text-center border-2 border-black peer-checked:bg-yellow-200 transition-all duration-300">
                                    <div class="text-yellow-400 mb-1">
                                        <i class="fas fa-tools"></i>
                                    </div>
                                    <span class="text-sm font-black text-black">Maintenance</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Foto Kamar -->
                    <div>
                        <label class="block text-sm font-black text-black mb-3 flex items-center">
                            <i class="fas fa-camera text-sky-400 mr-2 w-5"></i>
                            Foto Kamar
                        </label>
                        
                        <!-- Current Photo Preview -->
                        <?php if($kamar->foto_kamar): ?>
                        <div class="mb-4">
                            <div class="relative overflow-hidden border-2 border-black mb-3">
                                <img src="<?php echo e(asset('storage/' . $kamar->foto_kamar)); ?>" 
                                     alt="Foto Kamar" 
                                     class="w-full h-48 object-cover">
                                <div class="absolute inset-0 bg-black/60 flex items-end">
                                    <div class="p-4">
                                        <a href="<?php echo e(asset('storage/' . $kamar->foto_kamar)); ?>" 
                                           target="_blank" 
                                           class="inline-flex items-center text-sm text-white hover:text-black font-black transition">
                                            <i class="fas fa-expand mr-2"></i>
                                            Lihat Fullsize
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="text-xs text-gray-700">
                                Foto saat ini
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- File Upload -->
                        <div class="relative">
                            <input type="file" 
                                   name="foto_kamar" 
                                   id="foto_kamar"
                                   class="hidden"
                                   accept="image/*"
                                   data-preview="#preview-edit">
                            <label for="foto_kamar" 
                                   class="flex items-center justify-center w-full p-6 bg-white border-2 border-dashed border-black cursor-pointer hover:border-sky-500 transition-all duration-300">
                                <div class="text-center">
                                    <div class="w-12 h-12 bg-sky-400 border-2 border-black shadow-[2px_2px_0px_#000] flex items-center justify-center mx-auto mb-3">
                                        <i class="fas fa-cloud-upload-alt text-black text-xl"></i>
                                    </div>
                                    <p class="text-sm text-black mb-1">
                                        <span class="text-sky-600 font-black">Klik untuk upload</span> atau drag & drop
                                    </p>
                                    <p class="text-xs text-gray-700">
                                        Kosongkan jika tidak ingin mengubah foto
                                    </p>
                                </div>
                            </label>
                        </div>
                        
                        <!-- File Preview -->
                        <div id="filePreview" class="hidden mt-3">
                            <div class="flex items-center justify-between p-3 bg-gray-100 border-2 border-black">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-image text-sky-400"></i>
                                    <div>
                                        <p class="text-sm font-black text-black" id="fileName"></p>
                                        <p class="text-xs text-gray-500" id="fileSize"></p>
                                    </div>
                                </div>
                                <button type="button" 
                                        onclick="removeFile()" 
                                        class="text-rose-400 hover:text-rose-300">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Image Preview -->
                        <div id="preview-edit" class="hidden mt-3">
                            <p class="text-sm text-gray-500 mb-2">Preview:</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Fasilitas Kamar -->
            <div class="mt-8 pt-6 border-t-2 border-gray-200">
                <label class="block text-sm font-black text-black mb-4 flex items-center">
                    <i class="fas fa-list-check text-sky-400 mr-2 w-5"></i>
                    Fasilitas Kamar
                </label>
                <div class="bg-gray-100 border-2 border-black p-4">
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                        <?php
                            $commonFacilities = [
                                'Kamar mandi dalam', 'AC', 'WiFi', 'Kasur', 'Lemari', 
                                'Meja belajar', 'Kursi', 'Kipas angin', 'TV', 'Kulkas mini',
                                'Dapur', 'Water heater', 'Jendela', 'Balkon'
                            ];
                            $currentFacilities = is_array($kamar->fasilitas_kamar) ? $kamar->fasilitas_kamar : json_decode($kamar->fasilitas_kamar, true) ?? [];
                            $currentFacilities = is_array($currentFacilities) ? $currentFacilities : [];
                            $facilityIcons = [
                                'Kamar mandi dalam' => 'fa-bath',
                                'AC' => 'fa-snowflake',
                                'WiFi' => 'fa-wifi',
                                'Kasur' => 'fa-bed',
                                'Lemari' => 'fa-box-archive',
                                'Meja belajar' => 'fa-table',
                                'Kursi' => 'fa-chair',
                                'Kipas angin' => 'fa-fan',
                                'TV' => 'fa-tv',
                                'Kulkas mini' => 'fa-temperature-low',
                                'Dapur' => 'fa-kitchen-set',
                                'Water heater' => 'fa-temperature-high',
                                'Jendela' => 'fa-window-maximize',
                                'Balkon' => 'fa-door-open'
                            ];
                        ?>
                        <?php $__currentLoopData = $commonFacilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label class="cursor-pointer">
                            <input type="checkbox" 
                                   name="fasilitas_kamar[]" 
                                   value="<?php echo e($facility); ?>" 
                                   class="hidden peer"
                                   <?php echo e(in_array($facility, old('fasilitas_kamar', $currentFacilities)) ? 'checked' : ''); ?>>
                            <div class="flex items-center space-x-3 p-3 border-2 border-black peer-checked:bg-sky-200 transition-all duration-300">
                                <div class="w-8 h-8 bg-sky-400 border-2 border-black flex items-center justify-center">
                                    <i class="fas <?php echo e($facilityIcons[$facility] ?? 'fa-check'); ?> text-black text-sm"></i>
                                </div>
                                <span class="text-sm text-black"><?php echo e($facility); ?></span>
                            </div>
                        </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 pt-6 border-t-2 border-gray-200 flex flex-col sm:flex-row gap-4">
                <a href="<?php echo e(route('pemilik.kamar.index')); ?>" 
                   class="flex-1 px-6 py-3 bg-white text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all text-center flex items-center justify-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
                <button type="submit" 
                        class="flex-1 px-6 py-3 bg-black text-white font-black border-2 border-black shadow-[3px_3px_0px_#000] hover:shadow-[4px_4px_0px_#000] transition-all uppercase tracking-wide">
                    <i class="fas fa-save mr-2"></i>
                    Update Kamar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // File upload preview
    document.getElementById('foto_kamar').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const preview = document.getElementById('filePreview');
            const fileName = document.getElementById('fileName');
            const fileSize = document.getElementById('fileSize');
            
            // Show preview
            preview.classList.remove('hidden');
            
            // Set file info
            fileName.textContent = file.name;
            
            // Format file size
            const size = file.size;
            const i = size === 0 ? 0 : Math.floor(Math.log(size) / Math.log(1024));
            const formattedSize = (size / Math.pow(1024, i)).toFixed(2) * 1 + ' ' + ['B', 'KB', 'MB', 'GB'][i];
            fileSize.textContent = formattedSize;
        }
    });

    function removeFile() {
        const input = document.getElementById('foto_kamar');
        const preview = document.getElementById('filePreview');
        
        // Reset file input
        input.value = '';
        preview.classList.add('hidden');
    }

    // Format harga input
    document.querySelector('input[name="harga"]').addEventListener('input', function(e) {
        const value = e.target.value.replace(/\D/g, '');
        e.target.value = value ? parseInt(value, 10) : '';
    });

    // Add interactivity to facility checkboxes
    document.querySelectorAll('input[name="fasilitas_kamar[]"]').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const container = this.closest('label').querySelector('div');
            if (this.checked) {
                container.classList.add('ring-2', 'ring-sky-500/30');
            } else {
                container.classList.remove('ring-2', 'ring-sky-500/30');
            }
        });
    });

    // Auto-detect facility checkboxes state on load
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('input[name="fasilitas_kamar[]"]').forEach(checkbox => {
            if (checkbox.checked) {
                const container = checkbox.closest('label').querySelector('div');
                container.classList.add('ring-2', 'ring-sky-500/30');
            }
        });
    });

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

        // 2. Validate radio groups (like status_kamar)
        const radioGroups = ['status_kamar'];
        radioGroups.forEach(groupName => {
            const radios = form.querySelectorAll(`input[name="${groupName}"]`);
            if (radios.length > 0) {
                const checked = form.querySelector(`input[name="${groupName}"]:checked`);
                if (!checked) {
                    isValid = false;
                    const container = radios[0].closest('.grid');
                    if (container) {
                        container.classList.add('border-rose-500', 'ring-2', 'ring-rose-500/20', 'p-2');
                    }
                    if (!firstInvalidField) firstInvalidField = radios[0];
                }
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            if (firstInvalidField) {
                const scrollTarget = firstInvalidField.closest('div') || firstInvalidField;
                scrollTarget.scrollIntoView({ behavior: 'smooth', block: 'center' });
                if (firstInvalidField.focus && !firstInvalidField.readOnly) {
                    firstInvalidField.focus();
                }
            }
            if (typeof showToast === 'function') {
                showToast('Harap isi semua field yang wajib diisi', 'error');
            } else {
                alert('Harap isi semua field yang wajib diisi');
            }
        }
    });

    // Simple toast fallback if not defined in app.blade.php
    if (typeof showToast !== 'function') {
        window.showToast = function(message, type = 'info') {
            alert(message);
        };
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views\pemilik\kamar\edit.blade.php ENDPATH**/ ?>