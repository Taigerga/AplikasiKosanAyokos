<?php $__env->startSection('title', 'Detail Kontrak - AyoKos'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-4 md:p-6 lg:p-8 space-y-6 max-w-7xl mx-auto">
    <!-- Breadcrumb -->
    <nav class="bg-white border-2 border-black shadow-[2px_2px_0px_#000] p-4">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="<?php echo e(route('penghuni.dashboard')); ?>" class="inline-flex items-center text-sm font-black text-gray-600 hover:text-gray-700 font-black transition-colors">
                    <i class="fas fa-gauge mr-2"></i>
                    Dashboard
                </a>
            </li>
            <li class="inline-flex items-center">
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-600 text-xs mx-2"></i>
                    <a href="<?php echo e(route('penghuni.kontrak.index')); ?>" class="inline-flex items-center text-sm font-black text-gray-600 hover:text-gray-700 font-black transition-colors">
                        <i class="fas fa-file-contract mr-2"></i>
                        Riwayat Kontrak
                    </a>
                </div>
            </li>
            <li class="inline-flex items-center">
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-600 text-xs mx-2"></i>
                    <span class="inline-flex items-center text-sm font-black text-black">
                        <i class="fas fa-pencil mr-2"></i>
                        Detail Kontrak
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Notifications -->
    <?php if(session('success')): ?>
    <div class="bg-emerald-400 border-2 border-black shadow-[3px_3px_0px_#000] text-black px-4 py-3  mb-6">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-3"></i>
            <span><?php echo e(session('success')); ?></span>
        </div>
    </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
    <div class="bg-red-400 border-2 border-black shadow-[3px_3px_0px_#000] text-black px-4 py-3  mb-6">
        <div class="flex items-center">
            <i class="fas fa-exclamation-circle mr-3"></i>
            <span><?php echo e(session('error')); ?></span>
        </div>
    </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Status Badge -->
            <div class="flex items-center justify-between">
                <div>
                    <?php if($kontrak->status_kontrak === 'pending'): ?>
                    <span class="inline-flex items-center px-4 py-2 font-black bg-yellow-400 text-black border-2 border-black">
                        <i class="fas fa-clock mr-2"></i>
                        Menunggu Persetujuan
                    </span>
                    <?php elseif($kontrak->status_kontrak === 'aktif'): ?>
                    <span class="inline-flex items-center px-4 py-2 font-black bg-emerald-400 text-black border-2 border-black">
                        <i class="fas fa-check-circle mr-2"></i>
                        Kontrak Aktif
                    </span>
                    <?php elseif($kontrak->status_kontrak === 'selesai'): ?>
                    <span class="inline-flex items-center px-4 py-2 font-black bg-sky-400 text-black border-2 border-black">
                        <i class="fas fa-check-double mr-2"></i>
                        Kontrak Selesai
                    </span>
                    <?php else: ?>
                    <span class="inline-flex items-center px-4 py-2 font-black bg-red-400 text-black border-2 border-black">
                        <i class="fas fa-times-circle mr-2"></i>
                        Ditolak
                    </span>
                    <?php endif; ?>
                </div>
                
                <!-- ID Kontrak -->
                <div class="text-sm text-gray-600">
                    ID: <span class="font-mono text-black"><?php echo e($kontrak->id_kontrak); ?></span>
                </div>
            </div>

            <!-- Informasi Kos -->
            <div class="card-hover bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h2 class="text-2xl font-black text-black mb-4 flex items-center">
                    <i class="fas fa-home text-primary-400 mr-3"></i>
                    <?php echo e($kontrak->kos->nama_kos); ?>

                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <div class="flex items-start space-x-3">
                            <div class="p-2 bg-gray-100 border-2 border-black ">
                                <i class="fas fa-map-marker-alt text-primary-400"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Alamat</p>
                                <p class="font-black text-black"><?php echo e($kontrak->kos->alamat); ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex items-start space-x-3">
                            <div class="p-2 bg-gray-100 border-2 border-black ">
                                <i class="fas fa-door-closed text-green-400"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Kamar</p>
                                <div class="flex items-center space-x-2">
                                    <span class="font-black text-black">Kamar <?php echo e($kontrak->kamar->nomor_kamar); ?></span>
                                    <span class="text-xs px-2 py-1 bg-gray-200 border-2 border-black text-black font-black">
                                        <?php echo e($kontrak->kamar->tipe_kamar); ?>

                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Kontrak -->
            <div class="card-hover bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h3 class="text-xl font-black text-black mb-6 flex items-center">
                    <i class="fas fa-file-contract text-blue-400 mr-3"></i>
                    Detail Kontrak
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <div class="flex items-start space-x-3 mb-6">
                            <div class="p-2 bg-gray-100 border-2 border-black ">
                                <i class="fas fa-calendar-plus text-primary-400"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Tanggal Pendaftaran</p>
                                <p class="font-black text-black"><?php echo e($kontrak->tanggal_daftar->format('d M Y')); ?></p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <div class="p-2 bg-gray-100 border-2 border-black ">
                                <i class="fas fa-calendar-alt text-green-400"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Durasi Sewa</p>
                                <p class="font-black text-black"><?php echo e($kontrak->durasi_sewa); ?> <?php echo e($kontrak->unit_label_lower); ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <?php if($kontrak->tanggal_mulai): ?>
                    <div>
                        <div class="flex items-start space-x-3 mb-6">
                            <div class="p-2 bg-gray-100 border-2 border-black ">
                                <i class="fas fa-calendar-day text-yellow-400"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Tanggal Mulai</p>
                                <p class="font-black text-black"><?php echo e($kontrak->tanggal_mulai ? $kontrak->tanggal_mulai->format('d M Y') : 'Menunggu pembayaran pertama'); ?></p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <div class="p-2 bg-gray-100 border-2 border-black ">
                                <i class="fas fa-calendar-check text-rose-400"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Tanggal Selesai</p>
                                <p class="font-black text-black"><?php echo e($kontrak->tanggal_selesai ? $kontrak->tanggal_selesai->format('d M Y') : 'Menunggu pembayaran pertama'); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Harga Sewa -->
            <div class="card-hover bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h3 class="text-xl font-black text-black mb-4 flex items-center">
                    <i class="fas fa-wallet text-yellow-400 mr-3"></i>
                    Harga Sewa
                </h3>
                <div class="text-4xl font-black text-black mb-2">
                    Rp <?php echo e(number_format($kontrak->harga_sewa, 0, ',', '.')); ?>

                </div>
                <div class="flex items-center justify-between">
                    <p class="text-gray-700 text-sm">
                        Per <?php echo e($kontrak->durasi_sewa); ?> <?php echo e($kontrak->unit_label_lower); ?>

                    </p>
                    <?php if($kontrak->status_kontrak === 'aktif' && !$kontrak->sudahBerakhir): ?>
                    <div class="text-sm text-gray-600">
                        <i class="fas fa-clock mr-1"></i>
                        Berakhir dalam <?php echo e($kontrak->sisaHari ?? '?'); ?> hari
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Dokumen -->
            <div class="card-hover bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h3 class="text-xl font-black text-black mb-6 flex items-center">
                    <i class="fas fa-file-alt text-purple-400 mr-3"></i>
                    Dokumen
                </h3>
                
                <div class="space-y-6">
                    <div>
                        <p class="text-sm text-gray-600 mb-3">Foto KTP</p>
                        <?php if($kontrak->foto_ktp): ?>
                        <div class="relative">
                            <div class="border-2 border-black  overflow-hidden max-w-sm">
                                <img src="<?php echo e(asset('storage/' . $kontrak->foto_ktp)); ?>" 
                                     alt="Foto KTP" 
                                     class="w-full h-auto object-cover">
                            </div>
                            <a href="<?php echo e(asset('storage/' . $kontrak->foto_ktp)); ?>" 
                               target="_blank"
                               class="inline-flex items-center mt-3 text-primary-400 hover:text-primary-300 transition">
                                <i class="fas fa-external-link-alt mr-2"></i>
                                Lihat Fullsize
                            </a>
                        </div>
                        <?php else: ?>
                        <div class="text-center py-4 border-2 border-dashed border-black ">
                            <i class="fas fa-file-image text-3xl text-gray-600 mb-2"></i>
                            <p class="text-gray-600">Tidak ada dokumen</p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Alasan Ditolak -->
            <?php if($kontrak->status_kontrak === 'ditolak' && $kontrak->alasan_ditolak): ?>
            <div class="bg-red-100 border-2 border-black  p-6">
                <div class="flex items-start">
                    <div class="p-3 bg-red-400   mr-4">
                        <i class="fas fa-times-circle text-rose-400 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-black text-black mb-2">Alasan Penolakan</h3>
                        <p class="text-black"><?php echo e($kontrak->alasan_ditolak); ?></p>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Action Buttons -->
            <?php if($kontrak->status_kontrak === 'aktif' && !$kontrak->sudahBerakhir): ?>
            <div class="card-hover bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h3 class="text-lg font-black text-black mb-4 flex items-center">
                    <i class="fas fa-cogs text-yellow-400 mr-3"></i>
                    Aksi Kontrak
                </h3>
                <div class="flex flex-wrap gap-4">
                    <a href="<?php echo e(route('penghuni.pembayaran.create', ['kontrak_id' => $kontrak->id_kontrak])); ?>" 
                       class="px-6 py-3 bg-lime-400 border-2 border-black shadow-[2px_2px_0px_#000] text-black  hover:bg-yellow-500  transition-all duration-300 hover:shadow-[2px_2px_0px_#000]">
                        <i class="fas fa-credit-card mr-2"></i>
                        Bayar Sewa
                    </a>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Informasi Penghuni -->
            <div class="card-hover bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h3 class="text-lg font-black text-black mb-6 flex items-center">
                    <i class="fas fa-user-circle text-blue-400 mr-3"></i>
                    Informasi Penghuni
                </h3>
                
                <div class="space-y-5">
                    <div>
                        <div class="flex items-center space-x-2 mb-1">
                            <i class="fas fa-user text-primary-400 w-4"></i>
                            <p class="text-sm text-gray-600">Nama</p>
                        </div>
                        <p class="font-black text-black"><?php echo e($kontrak->penghuni->nama ?? 'N/A'); ?></p>
                    </div>
                    
                    <div>
                        <div class="flex items-center space-x-2 mb-1">
                            <i class="fas fa-id-card text-green-400 w-4"></i>
                            <p class="text-sm text-gray-600">NIK</p>
                        </div>
                        <p class="font-black text-black"><?php echo e($kontrak->penghuni->nik ?? 'N/A'); ?></p>
                    </div>
                    
                    <div>
                        <div class="flex items-center space-x-2 mb-1">
                            <i class="fas fa-phone text-yellow-400 w-4"></i>
                            <p class="text-sm text-gray-600">No. Telepon</p>
                        </div>
                        <p class="font-black text-black"><?php echo e($kontrak->penghuni->no_hp ?? 'N/A'); ?></p>
                    </div>
                    
                    <div>
                        <div class="flex items-center space-x-2 mb-1">
                            <i class="fas fa-envelope text-purple-400 w-4"></i>
                            <p class="text-sm text-gray-600">Email</p>
                        </div>
                        <p class="font-black text-black break-words"><?php echo e($kontrak->penghuni->email ?? 'N/A'); ?></p>
                    </div>
                </div>
            </div>

            <!-- Status Kontrak Timeline -->
            <div class="card-hover bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h3 class="text-lg font-black text-black mb-6 flex items-center">
                    <i class="fas fa-history text-indigo-400 mr-3"></i>
                    Timeline Kontrak
                </h3>
                
                <div class="space-y-4">
                    <div class="flex items-center">
                        <div class="w-3 h-3  bg-green-500 mr-3"></div>
                        <div>
                            <p class="text-sm font-black text-black">Pendaftaran</p>
                            <p class="text-xs text-gray-600"><?php echo e($kontrak->tanggal_daftar->format('d M Y H:i')); ?></p>
                        </div>
                    </div>
                    
                    <?php if($kontrak->tanggal_mulai): ?>
                    <div class="flex items-center">
                        <div class="w-3 h-3  bg-blue-500 mr-3"></div>
                        <div>
                            <p class="text-sm font-black text-black">Mulai Kontrak</p>
                            <p class="text-xs text-gray-600"><?php echo e($kontrak->tanggal_mulai->format('d M Y')); ?></p>
                        </div>
                    </div>
                    
                     <?php if($kontrak->tanggal_selesai): ?>
                     <div class="flex items-center">
                         <div class="w-3 h-3  bg-yellow-500 mr-3"></div>
                         <div>
                             <p class="text-sm font-black text-black">Berakhir Kontrak</p>
                             <p class="text-xs text-gray-600"><?php echo e($kontrak->tanggal_selesai->format('d M Y')); ?></p>
                         </div>
                     </div>
                     <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="card-hover bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h3 class="text-lg font-black text-black mb-6 flex items-center">
                    <i class="fas fa-link text-primary-400 mr-3"></i>
                    Tautan Cepat
                </h3>
                
                <div class="space-y-3">
                    <a href="<?php echo e(route('penghuni.pembayaran.index')); ?>" 
                       class="flex items-center justify-between p-3  bg-gray-100 border-2 border-black hover:bg-gray-100 transition">
                        <div class="flex items-center">
                            <i class="fas fa-credit-card text-green-400 mr-3"></i>
                            <span class="text-black">Lihat Pembayaran</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-600"></i>
                    </a>
                    
                    <a href="<?php echo e(route('penghuni.kontrak.index')); ?>" 
                       class="flex items-center justify-between p-3  bg-gray-100 border-2 border-black hover:bg-gray-100 transition">
                        <div class="flex items-center">
                            <i class="fas fa-file-contract text-blue-400 mr-3"></i>
                            <span class="text-black">Semua Kontrak</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-600"></i>
                    </a>
                    
                    <a href="<?php echo e(route('public.kos.show', $kontrak->kos->id_kos)); ?>" 
                       class="flex items-center justify-between p-3  bg-gray-100 border-2 border-black hover:bg-gray-100 transition">
                        <div class="flex items-center">
                            <i class="fas fa-home text-yellow-400 mr-3"></i>
                            <span class="text-black">Detail Kos</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-600"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views\penghuni\kontrak\show.blade.php ENDPATH**/ ?>