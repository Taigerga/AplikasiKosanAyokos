<?php $__env->startSection('title', 'Detail Kontrak - AyoKos'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto p-4 md:p-6 lg:p-8 space-y-6">
    <!-- Breadcrumb -->
    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="<?php echo e(route('pemilik.dashboard')); ?>" class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-black transition-colors">
                        <i class="fas fa-home mr-2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="inline-flex items-center">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                        <a href="<?php echo e(route('pemilik.kontrak.index')); ?>" class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-black transition-colors">
                            <i class="fas fa-file-contract mr-2"></i>
                            Kelola Kontrak
                        </a>
                    </div>
                </li>
                <li class="inline-flex items-center">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                        <span class="inline-flex items-center text-sm font-medium text-black">
                            <i class="fas fa-eye mr-2"></i>
                            Detail Kontrak
                        </span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
    <!-- Back Button -->
    <div>
        <a href="<?php echo e(route('pemilik.kontrak.index')); ?>" 
           class="inline-flex items-center text-sky-600 hover:text-sky-700 font-bold transition">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Kelola Kontrak
        </a>
    </div>

    <!-- Success/Error Messages -->
    <?php if(session('success')): ?>
    <div class="p-4 bg-emerald-400 border-2 border-black text-black font-bold">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-3"></i>
            <span><?php echo e(session('success')); ?></span>
        </div>
    </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
    <div class="p-4 bg-red-400 border-2 border-black text-white font-bold">
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
                        <span class="inline-flex items-center px-4 py-2 font-black bg-yellow-400 border-2 border-black text-black">
                            <i class="fas fa-clock mr-2"></i>
                            Menunggu Persetujuan
                        </span>
                    <?php elseif($kontrak->status_kontrak === 'aktif'): ?>
                        <span class="inline-flex items-center px-4 py-2 font-black bg-emerald-400 border-2 border-black text-black">
                            <i class="fas fa-check-circle mr-2"></i>
                            Kontrak Aktif
                        </span>
                    <?php elseif($kontrak->status_kontrak === 'selesai'): ?>
                        <span class="inline-flex items-center px-4 py-2 font-black bg-blue-400 border-2 border-black text-black">
                            <i class="fas fa-flag-checkered mr-2"></i>
                            Kontrak Selesai
                        </span>
                    <?php else: ?>
                        <span class="inline-flex items-center px-4 py-2 font-black bg-red-400 border-2 border-black text-white">
                            <i class="fas fa-times-circle mr-2"></i>
                            Ditolak
                        </span>
                    <?php endif; ?>
                </div>
                
                <!-- Quick Actions -->
                <?php if($kontrak->status_kontrak === 'pending'): ?>
                <div class="flex space-x-3">
                    <button type="button"
                            data-ajax-action="/api/pemilik/kontrak/<?php echo e($kontrak->id_kontrak); ?>/approve"
                            data-confirm="Setujui kontrak ini?"
                            data-success-msg="Kontrak berhasil disetujui"
                            data-redirect="<?php echo e(route('pemilik.kontrak.index', ['tab' => 'aktif'])); ?>"
                            class="px-4 py-2 bg-lime-400 hover:bg-lime-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] transition flex items-center">
                        <i class="fas fa-check mr-2"></i>
                        Setujui
                    </button>
                    <button onclick="openRejectModal()" 
                            class="px-4 py-2 bg-red-400 hover:bg-red-500 text-white font-black border-2 border-black shadow-[2px_2px_0px_#000] transition flex items-center">
                        <i class="fas fa-times mr-2"></i>
                        Tolak
                    </button>
                </div>
                <?php endif; ?>
            </div>

            <!-- Informasi Kos & Kamar -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h2 class="text-2xl font-black text-black mb-2"><?php echo e($kontrak->kos->nama_kos); ?></h2>
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-map-marker-alt mr-2 text-sky-600"></i>
                            <span><?php echo e($kontrak->kos->alamat); ?></span>
                        </div>
                    </div>
                    <span class="px-3 py-1 text-sm font-black bg-sky-400 border-2 border-black text-black">
                        <i class="fas fa-door-open mr-1"></i>
                        Kamar <?php echo e($kontrak->kamar->nomor_kamar); ?>

                    </span>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Tipe Kamar</p>
                        <p class="font-bold text-black"><?php echo e($kontrak->kamar->tipe_kamar); ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Status Kamar</p>
                        <p class="font-bold capitalize 
                            <?php echo e($kontrak->kamar->status_kamar == 'tersedia' ? 'text-emerald-600' : 
                               ($kontrak->kamar->status_kamar == 'terisi' ? 'text-blue-600' : 'text-yellow-600')); ?>">
                            <?php echo e($kontrak->kamar->status_kamar); ?>

                        </p>
                    </div>
                </div>
            </div>

            <!-- Detail Kontrak -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h3 class="text-xl font-black text-black mb-4 flex items-center">
                    <i class="fas fa-file-contract text-sky-600 mr-3"></i>
                    Detail Kontrak
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-100 border-2 border-black p-4">
                        <p class="text-sm text-gray-600 mb-1">Tanggal Pendaftaran</p>
                        <p class="font-bold text-black"><?php echo e($kontrak->tanggal_daftar->format('d M Y')); ?></p>
                    </div>
                    <div class="bg-gray-100 border-2 border-black p-4">
                        <p class="text-sm text-gray-600 mb-1">Durasi Sewa</p>
                        <p class="font-bold text-black"><?php echo e($kontrak->durasi_sewa); ?> <?php echo e($kontrak->unit_label_lower); ?></p>
                    </div>
                    
                    <?php if($kontrak->tanggal_mulai): ?>
                    <div class="bg-gray-100 border-2 border-black p-4">
                        <p class="text-sm text-gray-600 mb-1">Tanggal Mulai</p>
                        <p class="font-bold text-black"><?php echo e($kontrak->tanggal_mulai->format('d M Y')); ?></p>
                    </div>
                    <div class="bg-gray-100 border-2 border-black p-4">
                        <p class="text-sm text-gray-600 mb-1">Tanggal Selesai</p>
                        <p class="font-bold text-black"><?php echo e($kontrak->tanggal_selesai->format('d M Y')); ?></p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Informasi Penghuni -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h3 class="text-xl font-black text-black mb-4 flex items-center">
                    <i class="fas fa-user text-emerald-600 mr-3"></i>
                    Data Calon Penghuni
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <div class="flex items-center mb-2">
                            <div class="w-10 h-10 bg-emerald-400 border-2 border-black flex items-center justify-center mr-3">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Nama Lengkap</p>
                                <p class="font-bold text-black"><?php echo e($kontrak->penghuni->nama ?? 'N/A'); ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex items-center mb-2">
                            <div class="w-10 h-10 bg-blue-400 border-2 border-black flex items-center justify-center mr-3">
                                <i class="fas fa-id-card text-white"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">NIK</p>
                                <p class="font-bold text-black"><?php echo e($kontrak->penghuni->nik ?? 'N/A'); ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex items-center mb-2">
                            <div class="w-10 h-10 bg-purple-400 border-2 border-black flex items-center justify-center mr-3">
                                <i class="fas fa-phone text-white"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">No. Telepon</p>
                                <p class="font-bold text-black"><?php echo e($kontrak->penghuni->no_telepon ?? 'N/A'); ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex items-center mb-2">
                            <div class="w-10 h-10 bg-orange-400 border-2 border-black flex items-center justify-center mr-3">
                                <i class="fas fa-envelope text-white"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Email</p>
                                <p class="font-bold text-black break-words"><?php echo e($kontrak->penghuni->email ?? 'N/A'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Harga Sewa -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h3 class="text-xl font-black text-black mb-4 flex items-center">
                    <i class="fas fa-wallet text-yellow-600 mr-3"></i>
                    Informasi Pembayaran
                </h3>
                
                <div class="bg-gray-100 border-2 border-black p-6">
                    <div class="text-center mb-4">
                        <p class="text-sm text-gray-600">Harga Sewa per Bulan</p>
                        <div class="text-3xl font-black text-black mt-1">
                            Rp <?php echo e(number_format($kontrak->harga_sewa, 0, ',', '.')); ?>

                        </div>
                    </div>
                    
                    <div class="text-center">
                        <p class="text-sm text-gray-600">
                            Total untuk <?php echo e($kontrak->durasi_sewa); ?> <?php echo e($kontrak->unit_label_lower); ?>:
                            <span class="text-black font-bold ml-2">
                                Rp <?php echo e(number_format($kontrak->harga_sewa * $kontrak->durasi_sewa, 0, ',', '.')); ?>

                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Dokumen KTP -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h3 class="text-xl font-black text-black mb-4 flex items-center">
                    <i class="fas fa-file-alt text-blue-600 mr-3"></i>
                    Dokumen
                </h3>
                
                <div>
                    <p class="text-sm text-gray-600 mb-3">Foto KTP Penghuni</p>
                    <?php if($kontrak->foto_ktp): ?>
                        <div class="border-2 border-black overflow-hidden">
                            <img src="<?php echo e(asset('storage/' . $kontrak->foto_ktp)); ?>" 
                                 alt="Foto KTP" 
                                 class="w-full h-auto max-h-80 object-contain bg-gray-100">
                        </div>
                        <div class="mt-3">
                            <a href="<?php echo e(asset('storage/' . $kontrak->foto_ktp)); ?>" 
                               target="_blank" 
                               class="inline-flex items-center text-sky-600 hover:text-sky-700 font-bold transition">
                                <i class="fas fa-external-link-alt mr-2"></i>
                                Buka dokumen lengkap
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="bg-gray-200 border-2 border-black shadow-[2px_2px_0px_#000] p-8 text-center">
                            <i class="fas fa-file-image text-4xl text-gray-500 mb-3"></i>
                            <p class="text-gray-600">Tidak ada dokumen tersedia</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Alasan Ditolak -->
            <?php if($kontrak->status_kontrak === 'ditolak' && $kontrak->alasan_ditolak): ?>
            <div class="bg-red-100 border-2 border-black p-6">
                <h3 class="text-lg font-black text-red-700 mb-3 flex items-center">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Alasan Penolakan
                </h3>
                <div class="bg-white border-2 border-black p-4">
                    <p class="text-red-700"><?php echo e($kontrak->alasan_ditolak); ?></p>
                </div>
            </div>
            <?php endif; ?>

            <!-- Action Button untuk Aktif -->
            <?php if($kontrak->status_kontrak === 'aktif'): ?>
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h3 class="text-lg font-black text-black mb-4">Aksi Kontrak</h3>
                <button type="button"
                        data-ajax-action="/api/pemilik/kontrak/<?php echo e($kontrak->id_kontrak); ?>/selesai"
                        data-confirm="Yakin ingin menandai kontrak ini sebagai selesai?"
                        data-success-msg="Kontrak berhasil diselesaikan"
                        data-redirect="<?php echo e(route('pemilik.kontrak.index', ['tab' => 'selesai'])); ?>"
                        class="px-6 py-3 bg-sky-400 hover:bg-sky-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] transition-all duration-300 flex items-center">
                    <i class="fas fa-flag-checkered mr-2"></i>
                    Tandai Kontrak Selesai
                </button>
            </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 sticky top-6">
                <h3 class="text-lg font-black text-black mb-6 flex items-center">
                    <i class="fas fa-history text-purple-600 mr-3"></i>
                    Timeline Kontrak
                </h3>
                
                <div class="space-y-6">
                    <div class="relative pl-8 pb-6">
                        <div class="absolute left-0 top-0 w-3 h-3 bg-sky-500 border-2 border-black"></div>
                        <div class="absolute left-[5px] top-3 w-[2px] h-full bg-gray-300"></div>
                        <div>
                            <p class="text-sm text-gray-600">Diajukan</p>
                            <p class="font-bold text-black"><?php echo e($kontrak->created_at->format('d M Y H:i')); ?></p>
                        </div>
                    </div>
                    
                    <?php if($kontrak->tanggal_mulai): ?>
                    <div class="relative pl-8 pb-6">
                        <div class="absolute left-0 top-0 w-3 h-3 bg-emerald-500 border-2 border-black"></div>
                        <div class="absolute left-[5px] top-3 w-[2px] h-full bg-gray-300"></div>
                        <div>
                            <p class="text-sm text-gray-600">Mulai Kontrak</p>
                            <p class="font-bold text-black"><?php echo e($kontrak->tanggal_mulai->format('d M Y')); ?></p>
                        </div>
                    </div>
                    
                    <div class="relative pl-8 pb-6">
                        <div class="absolute left-0 top-0 w-3 h-3 bg-blue-500 border-2 border-black"></div>
                        <div class="absolute left-[5px] top-3 w-[2px] h-full bg-gray-300"></div>
                        <div>
                            <p class="text-sm text-gray-600">Berakhir Kontrak</p>
                            <p class="font-bold text-black"><?php echo e($kontrak->tanggal_selesai->format('d M Y')); ?></p>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <div class="relative pl-8">
                        <div class="absolute left-0 top-0 w-3 h-3 bg-yellow-500 border-2 border-black"></div>
                        <div>
                            <p class="text-sm text-gray-600">Update Terakhir</p>
                            <p class="font-bold text-black"><?php echo e($kontrak->updated_at->format('d M Y H:i')); ?></p>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Info -->
                <div class="mt-8 pt-6 border-t-2 border-black">
                    <h4 class="text-sm font-bold text-black mb-3">Informasi Cepat</h4>
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">ID Kontrak</span>
                            <span class="text-black font-bold font-mono">#<?php echo e($kontrak->id_kontrak); ?></span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Status Penghuni</span>
                            <span class="capitalize font-bold
                                <?php echo e($kontrak->penghuni->status_penghuni == 'aktif' ? 'text-emerald-600' : 
                                   ($kontrak->penghuni->status_penghuni == 'calon' ? 'text-yellow-600' : 'text-red-600')); ?>">
                                <?php echo e($kontrak->penghuni->status_penghuni ?? 'N/A'); ?>

                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<?php if($kontrak->status_kontrak === 'pending'): ?>
<div id="rejectModal" class="hidden fixed inset-0 bg-black/60 flex items-center justify-center z-50 p-4">
    <div class="bg-white border-4 border-black p-8 max-w-md w-full shadow-[8px_8px_0px_#000]">
        <div class="flex items-center mb-6">
            <div class="w-12 h-12 bg-red-200 border-2 border-black flex items-center justify-center mr-4">
                <i class="fas fa-times text-red-600 text-xl"></i>
            </div>
            <h2 class="text-2xl font-black text-black">Tolak Kontrak</h2>
        </div>
        
        <form action="<?php echo e(route('pemilik.kontrak.reject', $kontrak->id_kontrak)); ?>" method="POST" data-ajax="true" data-ajax-action="/api/pemilik/kontrak/<?php echo e($kontrak->id_kontrak); ?>/reject" data-success-msg="Kontrak ditolak" data-redirect="<?php echo e(route('pemilik.kontrak.index')); ?>">
            <?php echo csrf_field(); ?>
            <div class="mb-6">
                <label class="block text-black font-bold mb-3">Alasan Penolakan <span class="text-red-600">*</span></label>
                <textarea name="alasan_ditolak" 
                          required 
                          rows="4"
                          class="w-full px-4 py-3 border-2 border-black text-black font-bold bg-white focus:shadow-[3px_3px_0px_#000] outline-none transition resize-none"
                          placeholder="Berikan alasan penolakan yang jelas dan konstruktif..."></textarea>
            </div>
            
            <div class="flex gap-4">
                <button type="submit" 
                        class="flex-1 px-4 py-3 bg-red-400 hover:bg-red-500 text-white font-black border-2 border-black shadow-[2px_2px_0px_#000] transition">
                    <i class="fas fa-times mr-2"></i>
                    Tolak Kontrak
                </button>
                <button type="button" 
                        onclick="closeRejectModal()" 
                        class="flex-1 px-4 py-3 bg-gray-200 text-black font-bold border-2 border-black hover:bg-gray-300 transition">
                    <i class="fas fa-times mr-2"></i>
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>

<script>
    function openRejectModal() {
        document.getElementById('rejectModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeRejectModal() {
        document.getElementById('rejectModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Close modal when clicking outside
    window.addEventListener('click', function(event) {
        const modal = document.getElementById('rejectModal');
        if (event.target === modal) {
            closeRejectModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeRejectModal();
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views\pemilik\kontrak\show.blade.php ENDPATH**/ ?>