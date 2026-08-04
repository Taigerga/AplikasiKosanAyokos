<?php $__env->startSection('title', 'Tambah Kamar - AyoKos'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto p-4 md:p-6">
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
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 mb-6">

            <div>
                <h1 class="text-2xl md:text-3xl font-black text-black mb-4">Tambah Kamar Baru</h1>
                <p class="text-gray-700 mt-1 mb-4">Isi form berikut untuk menambahkan kamar baru ke kos Anda</p>
            </div>
        </div>
        

    <?php if($errors->any()): ?>
        <div class="mb-6 p-4 bg-red-400 border-2 border-black text-black font-black shadow-[3px_3px_0px_#000]">
            <div class="flex items-start space-x-3">
                <div class="p-2 bg-red-400 border-2 border-black">
                    <i class="fas fa-exclamation-circle text-black"></i>
                </div>
                <div class="flex-1">
                    <h3 class="text-black font-black mb-1">Ada beberapa kesalahan:</h3>
                    <ul class="text-black text-sm space-y-1">
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
    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] overflow-hidden">
        <form method="POST" action="<?php echo e(route('pemilik.kamar.store')); ?>" enctype="multipart/form-data" data-ajax="true" data-ajax-action="/api/pemilik/kamar" data-redirect="<?php echo e(route('pemilik.kamar.index')); ?>" data-success-msg="Kamar berhasil ditambahkan!" data-confirm="Apakah Anda yakin data kamar yang dimasukkan sudah benar?" novalidate>
            <?php echo csrf_field(); ?>

            <!-- Form Content -->
            <div class="p-6">
                <div class="space-y-8">
                    <!-- Section 1: Informasi Dasar -->
                    <div class="border-b-2 border-gray-200 pb-8">
                        <h2 class="text-lg font-black text-black mb-6 flex items-center">
                            <i class="fas fa-info-circle text-sky-400 mr-3"></i>
                            Informasi Dasar Kamar
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Pilih Kos -->
                            <div class="relative z-20">
                                <label class="block text-sm font-black text-black mb-3">
                                    Pilih Kos <span class="text-rose-400">*</span>
                                </label>
                                <div class="relative z-30">
                                    <i class="fas fa-home absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                    <select name="id_kos" data-searchable 
                                            class="w-full pl-12 pr-10 py-3 border-2 border-black text-black font-black placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white appearance-none transition"
                                            required>
                                        <option value="">Pilih Kos...</option>
                                        <?php $__currentLoopData = $kos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($k->id_kos); ?>" <?php echo e(old('id_kos') == $k->id_kos ? 'selected' : ''); ?>>
                                            <?php echo e($k->nama_kos); ?> - <?php echo e($k->alamat); ?>

                                        </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <i class="fas fa-chevron-down absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                                </div>
                                <p class="text-sm text-gray-700 mt-2">Pilih kos tempat kamar ini akan ditambahkan</p>
                            </div>

                            <!-- Nomor Kamar -->
                            <div>
                                <label class="block text-sm font-black text-black mb-3">
                                    Nomor Kamar <span class="text-rose-400">*</span>
                                </label>
                                <div class="relative">
                                    <i class="fas fa-hashtag absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                    <input type="text" 
                                           name="nomor_kamar" 
                                           value="<?php echo e(old('nomor_kamar')); ?>" 
                                           class="w-full pl-12 pr-4 py-3 border-2 border-black text-black font-black placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white transition"
                                           placeholder="A1, B2, 101"
                                           required 
                                           maxlength="10">
                                </div>
                                <p class="text-sm text-gray-700 mt-2">Nomor unik untuk identifikasi kamar</p>
                            </div>

                            <!-- Tipe Kamar -->
                            <div>
                                <label class="block text-sm font-black text-black mb-3">
                                    Tipe Kamar <span class="text-rose-400">*</span>
                                </label>
                                <div class="grid grid-cols-2 gap-3">
                                    <?php
                                        $tipeOptions = [
                                            'Standar' => ['color' => 'bg-blue-400', 'icon' => 'fa-home'],
                                            'Deluxe' => ['color' => 'bg-purple-400', 'icon' => 'fa-crown'],
                                            'VIP' => ['color' => 'bg-yellow-400', 'icon' => 'fa-gem'],
                                            'Superior' => ['color' => 'bg-emerald-400', 'icon' => 'fa-star'],
                                            'Ekonomi' => ['color' => 'bg-gray-400', 'icon' => 'fa-wallet'],
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
                                        <div class="p-4 border-2 border-black peer-checked:bg-sky-200 transition-all duration-300">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-10 h-10 <?php echo e($style['color']); ?> border-2 border-black flex items-center justify-center">
                                                    <i class="fas <?php echo e($style['icon']); ?> text-black text-sm"></i>
                                                </div>
                                                <div>
                                                    <span class="block font-black text-black"><?php echo e($value); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>

                            <!-- Harga Sewa -->
                            <div>
                                <label class="block text-sm font-black text-black mb-3">
                                    Harga Sewa per Bulan <span class="text-rose-400">*</span>
                                </label>
                                <div class="relative">
                                    <i class="fas fa-money-bill-wave absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                    <input type="number" 
                                           name="harga" 
                                           value="<?php echo e(old('harga')); ?>" 
                                           class="w-full pl-12 pr-4 py-3 border-2 border-black text-black font-black placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white transition"
                                           placeholder="1500000"
                                           required 
                                           min="0">
                                </div>
                                <p class="text-sm text-gray-700 mt-2">Harga sewa dalam Rupiah</p>
                            </div>

                            <!-- Luas Kamar -->
                            <div>
                                <label class="block text-sm font-black text-black mb-3">
                                    Luas Kamar <span class="text-rose-400">*</span>
                                </label>
                                <div class="relative">
                                    <i class="fas fa-ruler-combined absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                    <input type="text" 
                                           name="luas_kamar" 
                                           value="<?php echo e(old('luas_kamar')); ?>" 
                                           class="w-full pl-12 pr-4 py-3 border-2 border-black text-black font-black placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white transition"
                                           placeholder="3x4, 4x4"
                                           required
                                           maxlength="20">
                                </div>
                                <p class="text-sm text-gray-700 mt-2">Ukuran kamar dalam meter (panjang x lebar)</p>
                            </div>

                            <!-- Kapasitas -->
                            <div>
                                <label class="block text-sm font-black text-black mb-3">
                                    Kapasitas <span class="text-rose-400">*</span>
                                </label>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                    <?php for($i = 1; $i <= 4; $i++): ?>
                                    <label class="cursor-pointer">
                                        <input type="radio" 
                                               name="kapasitas" 
                                               value="<?php echo e($i); ?>" 
                                               class="hidden peer"
                                               <?php echo e(old('kapasitas') == $i ? 'checked' : ''); ?>

                                               required>
                                        <div class="p-4 border-2 border-black text-center peer-checked:bg-sky-200 transition-all duration-300">
                                            <div class="text-2xl font-black text-black mb-1"><?php echo e($i); ?></div>
                                            <div class="text-xs text-gray-700">
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
                    <div class="border-b-2 border-gray-200 pb-8">
                        <h2 class="text-lg font-black text-black mb-6 flex items-center">
                            <i class="fas fa-list-check text-emerald-400 mr-3"></i>
                            Fasilitas Kamar
                        </h2>
                        
                        <div class="bg-gray-100 border-2 border-black p-4">
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
                                    <h4 class="text-sm font-black text-gray-700 mb-3"><?php echo e($group); ?></h4>
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
                                        <label class="flex items-center space-x-3 cursor-pointer p-2 rounded-lg hover:bg-gray-100 transition-all duration-200 group">
                                            
                                            <!-- WRAPPER CHECKBOX: Menggunakan relative untuk memposisikan ikon centang -->
                                            <div class="relative flex items-center justify-center w-5 h-5 flex-shrink-0">
                                                <!-- TAMBAHKAN appearance-none untuk menghapus total style default browser (penyebab warna merah/pink) -->
                                                <input type="checkbox" 
                                                    name="fasilitas_kamar[]" 
                                                    value="<?php echo e($facility); ?>" 
                                                    class="peer w-5 h-5 border-2 border-black rounded-sm appearance-none bg-white cursor-pointer checked:bg-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500 transition-colors"
                                                    <?php echo e(in_array($facility, old('fasilitas_kamar', [])) ? 'checked' : ''); ?>>
                                                
                                                <!-- IKON CENTANG: Muncul otomatis saat checkbox dicentang -->
                                                <i class="fas fa-check text-white text-[10px] absolute pointer-events-none opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                                            </div>
                                            
                                            <!-- TEKS & IKON FASILITAS -->
                                            <div class="flex-1 flex items-center p-1 rounded-lg peer-checked:bg-sky-50 transition-colors">
                                                <i class="fas <?php echo e($icons[$facility] ?? 'fa-check'); ?> w-5 text-gray-500 peer-checked:text-sky-600 transition-colors mr-2"></i>
                                                <span class="text-sm font-bold text-black peer-checked:text-sky-600 transition-colors">
                                                    <?php echo e($facility); ?>

                                                </span>
                                            </div>
                                        </label>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <p class="text-sm text-gray-700 mt-4">
                                <i class="fas fa-info-circle mr-1"></i>
                                Pilih fasilitas yang tersedia di kamar ini
                            </p>
                        </div>
                    </div>

                    <!-- Section 3: Foto & Status -->
                    <div>
                        <h2 class="text-lg font-black text-black mb-6 flex items-center">
                            <i class="fas fa-camera text-yellow-400 mr-3"></i>
                            Foto & Status Kamar
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Foto Kamar -->
                            <div>
                                <label class="block text-sm font-black text-black mb-3">
                                    Foto Kamar
                                </label>
                                <div class="bg-white border-2 border-dashed border-black p-6 text-center hover:border-sky-500 transition">
                                    <div class="mb-4">
                                        <div class="w-16 h-16 bg-gray-200 border-2 border-black shadow-[2px_2px_0px_#000] flex items-center justify-center mx-auto">
                                            <i class="fas fa-camera text-2xl text-gray-400"></i>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <input type="file" 
                                               name="foto_kamar" 
                                               id="foto_kamar"
                                               class="hidden"
                                               accept="image/*"
                                               data-preview="#preview-wrap">
                                        <label for="foto_kamar" 
                                               class="inline-block px-4 py-2 bg-sky-400 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition cursor-pointer uppercase tracking-wide text-sm">
                                            <i class="fas fa-upload mr-2"></i>
                                            Unggah Foto
                                        </label>
                                    </div>
                                    <p class="text-sm text-gray-700">Format: JPG, PNG, JPEG (max 2 MB)</p>
                                    <div id="file-name" class="text-xs text-sky-600 mt-2"></div>

                                    
                                    <div id="preview-wrap" class="hidden mt-4 flex justify-center">
                                        <img id="preview-img" class="max-w-full max-h-48 border-2 border-black" alt="Preview">
                                    </div>
                                </div>
                            </div>

                            <!-- Status Kamar -->
                            <div>
                                <label class="block text-sm font-black text-black mb-3">
                                    Status Kamar <span class="text-rose-400">*</span>
                                </label>
                                <div class="space-y-3">
                                    <?php
                                        $statusOptions = [
                                            'tersedia' => ['color' => 'bg-emerald-400', 'icon' => 'fa-check-circle', 'label' => 'Tersedia'],
                                            'terisi' => ['color' => 'bg-blue-400', 'icon' => 'fa-user-check', 'label' => 'Terisi'],
                                            'maintenance' => ['color' => 'bg-yellow-400', 'icon' => 'fa-tools', 'label' => 'Maintenance'],
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
                                        <div class="p-4 border-2 border-black peer-checked:bg-sky-200 transition-all duration-300">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center space-x-3">
                                                    <div class="w-10 h-10 <?php echo e($style['color']); ?> border-2 border-black flex items-center justify-center">
                                                        <i class="fas <?php echo e($style['icon']); ?> text-black"></i>
                                                    </div>
                                                    <div>
                                                        <span class="block font-black text-black"><?php echo e($style['label']); ?></span>
                                                        <span class="text-xs text-gray-700">
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
                                                <div class="w-6 h-6 border-2 border-black peer-checked:bg-sky-500 flex items-center justify-center">
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
                <div class="mt-10 pt-8 border-t-2 border-gray-200 flex flex-col sm:flex-row justify-between space-y-4 sm:space-y-0">
                    <div>
                        <a href="<?php echo e(route('pemilik.kamar.index')); ?>" 
                           class="inline-flex items-center px-6 py-3 bg-white text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali ke Daftar
                        </a>
                    </div>
                    
                    <div class="flex space-x-4">
                        <button type="button" onclick="resetForm()"
                                class="px-6 py-3 bg-white text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition">
                            <i class="fas fa-redo mr-2"></i>
                            Reset Form
                        </button>
                        <button type="submit" 
                                class="px-8 py-3 bg-sky-400 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all uppercase tracking-wide text-sm">
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
<div id="resetModal" class="fixed inset-0 bg-black/50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border-4 border-black w-96 shadow-[4px_4px_0px_#000] bg-white">
        <div class="mt-3 text-center">
            <div class="mb-4 inline-block">
                <div class="w-16 h-16 bg-orange-100 border-2 border-black shadow-[2px_2px_0px_#000] flex items-center justify-center mx-auto">
                    <i class="fas fa-exclamation-triangle text-orange-500 text-2xl"></i>
                </div>
            </div>
            <h3 class="text-xl font-black text-black mb-2">Konfirmasi Reset</h3>
            <p class="text-gray-500 mb-6">Apakah Anda yakin ingin mengosongkan semua isian form? Tindakan ini tidak dapat dibatalkan.</p>
            
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <button type="button" data-modal-close
                        class="flex-1 px-6 py-2.5 bg-white text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition">
                    Batal
                </button>
                <button type="button" id="confirmResetBtn"
                        class="flex-1 px-6 py-2.5 bg-yellow-400 text-white font-black border-2 border-black shadow-[3px_3px_0px_#000] hover:shadow-[4px_4px_0px_#000] transition uppercase tracking-wide">
                    Ya, Reset Form
                </button>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    function resetForm() {
        const modal = document.getElementById('resetModal');
        if (modal) modal.classList.remove('hidden');
    }
    function executeReset() {
        const form = document.querySelector('form');
        if (form) form.reset();
        document.getElementById('file-name')?.classList.add('hidden');
        document.getElementById('preview-wrap')?.classList.add('hidden');
        const p = document.getElementById('preview-img');
        if (p) p.src = '';
        document.querySelector('input[name="status_kamar"][value="tersedia"]')?.click();
        document.querySelector('input[name="kapasitas"][value="1"]')?.click();
        window.showSuccess('Form berhasil dikosongkan');
    }
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('confirmResetBtn')?.addEventListener('click', function () {
            executeReset();
            document.getElementById('resetModal')?.classList.add('hidden');
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views\pemilik\kamar\create.blade.php ENDPATH**/ ?>