<?php $__env->startSection('title', 'Kelola Pembayaran - AyoKos'); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl mx-auto p-4 md:p-6 lg:p-8 space-y-6">
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
                            <a href="<?php echo e(route('pemilik.pembayaran.index')); ?>" class="inline-flex items-center text-sm font-bold text-black">
                                <i class="fas fa-credit-card mr-2"></i>
                                Kelola Pembayaran
                            </a>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>  
        <!-- Header -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between">
                <div>
                    <h1 class="text-2xl md:text-3xl font-black text-black mb-2 flex items-center">
                        <i class="fas fa-credit-card mr-3"></i>
                        Kelola Pembayaran
                    </h1>
                    <p class="text-gray-700">Kelola semua pembayaran sewa kos Anda di satu tempat.</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <span class="inline-flex items-center px-4 py-2 bg-black text-white font-black border-2 border-black">
                        <i class="fas fa-chart-bar mr-2 text-sky-400"></i>
                        Total: <?php echo e($statistics['total']); ?>

                    </span>
                </div>
            </div>
        </div>

        <!-- Success/Error Notification -->
        <?php if(session('success')): ?>
            <div class="bg-emerald-400 border-2 border-black text-black font-bold px-4 py-3 shadow-[3px_3px_0px_#000]">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-3"></i>
                    <span><?php echo e(session('success')); ?></span>
                </div>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="bg-red-400 border-2 border-black text-black font-bold px-4 py-3 shadow-[3px_3px_0px_#000]">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-3"></i>
                    <span><?php echo e(session('error')); ?></span>
                </div>
            </div>
        <?php endif; ?>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Lunas Card -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-green-400 border-2 border-black">
                        <i class="fas fa-check-circle text-black text-xl"></i>
                    </div>
                    <span class="text-sm font-black px-2 py-1 bg-black text-white border-2 border-black">
                        <?php echo e($statistics['lunas'] > 0 ? '+'.$statistics['lunas'] : '0'); ?>

                    </span>
                </div>
                <h3 class="text-2xl font-black text-black mb-1"><?php echo e($statistics['lunas']); ?></h3>
                <p class="text-sm text-gray-600">Total Lunas</p>
            </div>

            <!-- Pending Card -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-yellow-400 border-2 border-black">
                        <i class="fas fa-clock text-black text-xl"></i>
                    </div>
                    <span class="text-sm font-black px-2 py-1 bg-black text-white border-2 border-black">
                        <?php echo e($statistics['pending'] > 0 ? '+'.$statistics['pending'] : '0'); ?>

                    </span>
                </div>
                <h3 class="text-2xl font-black text-black mb-1"><?php echo e($statistics['pending']); ?></h3>
                <p class="text-sm text-gray-600">Pending</p>
            </div>

            <!-- Terlambat Card -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-indigo-400 border-2 border-black">
                        <i class="fas fa-exclamation-triangle text-black text-xl"></i>
                    </div>
                    <span class="text-sm font-black px-2 py-1 bg-black text-white border-2 border-black">
                        <?php echo e($statistics['terlambat'] > 0 ? '+'.$statistics['terlambat'] : '0'); ?>

                    </span>
                </div>
                <h3 class="text-2xl font-black text-black mb-1"><?php echo e($statistics['terlambat']); ?></h3>
                <p class="text-sm text-gray-600">Terlambat</p>
            </div>

            <!-- Belum Bayar Card -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-red-400 border-2 border-black">
                        <i class="fas fa-calendar-times text-black text-xl"></i>
                    </div>
                    <span class="text-sm font-black px-2 py-1 bg-black text-white border-2 border-black">
                        <?php echo e($statistics['belum'] > 0 ? '+'.$statistics['belum'] : '0'); ?>

                    </span>
                </div>
                <h3 class="text-2xl font-black text-black mb-1"><?php echo e($statistics['belum']); ?></h3>
                <p class="text-sm text-gray-600">Belum Bayar</p>
            </div>
        </div>

        <!-- Pembayaran Table -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] overflow-hidden">
            <!-- Table Header -->
            <div class="border-b-2 border-black px-6 py-4">
                <h2 class="text-lg font-black text-black flex items-center">
                    <i class="fas fa-list mr-3 text-sky-600"></i>
                    Daftar Pembayaran
                </h2>
            </div>
            
            <!-- Table Content -->
            <div class="overflow-x-auto w-full hidden md:block">
                <table class="w-full min-w-[850px] text-left border-collapse">
                    <thead class="bg-black">
                        <tr>
                            <th class="px-4 py-3.5 text-left text-xs font-black text-white uppercase tracking-wider min-w-[200px]">
                                <div class="flex items-center">
                                    <i class="fas fa-user mr-2"></i>
                                    Penghuni & Kos
                                </div>
                            </th>
                            <th class="px-4 py-3.5 text-left text-xs font-black text-white uppercase tracking-wider min-w-[150px]">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    Periode
                                </div>
                            </th>
                            <th class="px-4 py-3.5 text-left text-xs font-black text-white uppercase tracking-wider min-w-[130px]">
                                <div class="flex items-center">
                                    <i class="fas fa-money-bill-wave mr-2"></i>
                                    Jumlah
                                </div>
                            </th>
                            <th class="px-4 py-3.5 text-left text-xs font-black text-white uppercase tracking-wider min-w-[120px]">
                                <div class="flex items-center">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    Status
                                </div>
                            </th>
                            <th class="px-4 py-3.5 text-left text-xs font-black text-white uppercase tracking-wider min-w-[140px]">
                                <div class="flex items-center">
                                    <i class="fas fa-clock mr-2"></i>
                                    Tanggal Bayar
                                </div>
                            </th>
                            <th class="px-4 py-3.5 text-left text-xs font-black text-white uppercase tracking-wider min-w-[140px]">
                                <div class="flex items-center">
                                    <i class="fas fa-cogs mr-2"></i>
                                    Aksi
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-gray-200">
                        <?php $__empty_1 = true; $__currentLoopData = $pembayaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-yellow-100 transition-colors duration-200">
                            <!-- Penghuni & Kos -->
                            <td class="px-4 py-4">
                                <div class="flex items-center gap-3 min-w-0">
                                    <div class="w-10 h-10 shrink-0 bg-sky-400 border-2 border-black flex items-center justify-center">
                                        <i class="fas fa-user text-black"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <div class="text-sm font-bold text-black truncate">
                                            <?php echo e($item->penghuni->nama); ?>

                                        </div>
                                        <div class="text-xs text-gray-600 truncate">
                                            <?php echo e($item->kontrak->kos->nama_kos); ?> - Kamar <?php echo e($item->kontrak->kamar->nomor_kamar ?? 'N/A'); ?>

                                        </div>
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Periode -->
                            <td class="px-4 py-4">
                                <div class="text-sm text-black whitespace-nowrap"><?php echo e($item->bulan_tahun); ?></div>
                                <div class="text-xs text-gray-600 whitespace-nowrap">
                                    <i class="fas fa-calendar-day mr-1"></i>
                                    Jatuh tempo: <?php echo e(\Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d M Y')); ?>

                                </div>
                            </td>
                            
                            <!-- Jumlah -->
                            <td class="px-4 py-4">
                                <div class="text-sm font-bold text-black whitespace-nowrap">
                                    Rp <?php echo e(number_format($item->jumlah, 0, ',', '.')); ?>

                                </div>
                            </td>
                            
                            <!-- Status -->
                            <td class="px-4 py-4">
                                <span class="inline-flex items-center px-3 py-1 text-xs font-black border-2 border-black whitespace-nowrap
                                    <?php echo e($item->status_pembayaran == 'lunas' ? 'bg-emerald-400 text-black' : 
                                       ($item->status_pembayaran == 'pending' ? 'bg-yellow-400 text-black' : 
                                       ($item->status_pembayaran == 'terlambat' ? 'bg-red-400 text-white' : 
                                       'bg-gray-200 text-black'))); ?>">
                                    <i class="fas 
                                        <?php echo e($item->status_pembayaran == 'lunas' ? 'fa-check-circle' : 
                                           ($item->status_pembayaran == 'pending' ? 'fa-clock' : 
                                           ($item->status_pembayaran == 'terlambat' ? 'fa-exclamation-triangle' : 'fa-question-circle'))); ?> 
                                        mr-1"></i>
                                    <?php echo e(ucfirst($item->status_pembayaran)); ?>

                                </span>
                            </td>
                            
                            <!-- Tanggal Bayar -->
                            <td class="px-4 py-4">
                                <?php if($item->tanggal_bayar): ?>
                                    <div class="text-sm text-black whitespace-nowrap">
                                        <i class="fas fa-calendar-check mr-1 text-emerald-600"></i>
                                        <?php echo e(\Carbon\Carbon::parse($item->tanggal_bayar)->format('d M Y')); ?>

                                    </div>
                                    <div class="text-xs text-gray-600 whitespace-nowrap">
                                        <?php echo e(\Carbon\Carbon::parse($item->tanggal_bayar)->format('H:i')); ?>

                                    </div>
                                <?php else: ?>
                                    <span class="text-sm text-gray-600 whitespace-nowrap">
                                        <i class="fas fa-calendar-times mr-1"></i>
                                        Belum dibayar
                                    </span>
                                <?php endif; ?>
                            </td>
                            
                            <!-- Aksi -->
                            <td class="px-4 py-4">
                                <div class="flex items-center gap-2 whitespace-nowrap">
                                    <?php if($item->bukti_pembayaran): ?>
                                        <button onclick="showBuktiModal('<?php echo e(asset('storage/' . $item->bukti_pembayaran)); ?>')"
                                                class="p-2 text-sky-600 hover:text-black hover:bg-yellow-100 border-2 border-black transition"
                                                title="Lihat Bukti Pembayaran">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    <?php endif; ?>
                                    
                                    <?php if($item->status_pembayaran == 'pending'): ?>
                                        <button type="button" 
                                                onclick="showApproveModal('<?php echo e(route('pemilik.pembayaran.approve', $item->id_pembayaran)); ?>')"
                                                class="p-2 text-lime-600 hover:text-black hover:bg-lime-100 border-2 border-black transition"
                                                title="Verifikasi Pembayaran">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        
                                        <button type="button" 
                                                onclick="showRejectModal('<?php echo e(route('pemilik.pembayaran.reject', $item->id_pembayaran)); ?>')"
                                                class="p-2 text-red-600 hover:text-black hover:bg-red-100 border-2 border-black transition"
                                                title="Tolak Pembayaran">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="px-3 md:px-6 py-8 text-center">
                                <div class="text-center py-8">
                                    <div class="w-16 h-16 bg-gray-200 border-2 border-black shadow-[2px_2px_0px_#000] flex items-center justify-center mx-auto mb-4">
                                        <i class="fas fa-credit-card text-gray-700 text-2xl"></i>
                                    </div>
                                    <h3 class="text-lg font-black text-gray-700 mb-2">Belum ada data pembayaran</h3>
                                    <p class="text-gray-600">Tidak ada pembayaran yang perlu dikelola saat ini</p>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="md:hidden divide-y-2 divide-gray-200">
                <?php $__empty_1 = true; $__currentLoopData = $pembayaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="p-4 space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 shrink-0 bg-sky-400 border-2 border-black flex items-center justify-center">
                                <i class="fas fa-user text-black"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="text-sm font-bold text-black truncate"><?php echo e($item->penghuni->nama); ?></div>
                                <div class="text-xs text-gray-600 truncate"><?php echo e($item->kontrak->kos->nama_kos); ?> - Kamar <?php echo e($item->kontrak->kamar->nomor_kamar ?? 'N/A'); ?></div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-xs text-gray-500">Periode</div>
                                <div class="text-sm text-black truncate"><?php echo e($item->bulan_tahun); ?></div>
                                <div class="text-xs text-gray-600">
                                    <i class="fas fa-calendar-day mr-1"></i><?php echo e(\Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d M Y')); ?>

                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-xs text-gray-500">Jumlah</div>
                                <div class="text-sm font-bold text-black">Rp <?php echo e(number_format($item->jumlah, 0, ',', '.')); ?></div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center px-3 py-1 text-xs font-black border-2 border-black whitespace-nowrap
                                <?php echo e($item->status_pembayaran == 'lunas' ? 'bg-emerald-400 text-black' : 
                                   ($item->status_pembayaran == 'pending' ? 'bg-yellow-400 text-black' : 
                                   ($item->status_pembayaran == 'terlambat' ? 'bg-red-400 text-white' : 
                                   'bg-gray-200 text-black'))); ?>">
                                <i class="fas 
                                    <?php echo e($item->status_pembayaran == 'lunas' ? 'fa-check-circle' : 
                                       ($item->status_pembayaran == 'pending' ? 'fa-clock' : 
                                       ($item->status_pembayaran == 'terlambat' ? 'fa-exclamation-triangle' : 'fa-question-circle'))); ?> 
                                    mr-1"></i>
                                <?php echo e(ucfirst($item->status_pembayaran)); ?>

                            </span>
                            <div>
                                <?php if($item->tanggal_bayar): ?>
                                    <div class="text-xs text-black">
                                        <i class="fas fa-calendar-check mr-1 text-emerald-600"></i>
                                        <?php echo e(\Carbon\Carbon::parse($item->tanggal_bayar)->format('d M Y')); ?>

                                    </div>
                                <?php else: ?>
                                    <span class="text-xs text-gray-600"><i class="fas fa-calendar-times mr-1"></i>Belum dibayar</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <?php if($item->bukti_pembayaran): ?>
                                <button onclick="showBuktiModal('<?php echo e(asset('storage/' . $item->bukti_pembayaran)); ?>')" class="px-3 py-1.5 text-xs font-black bg-white border-2 border-black text-sky-600" title="Lihat Bukti Pembayaran">
                                    <i class="fas fa-eye mr-1"></i>Lihat Bukti
                                </button>
                            <?php endif; ?>
                            <?php if($item->status_pembayaran == 'pending'): ?>
                                <button type="button" onclick="showApproveModal('<?php echo e(route('pemilik.pembayaran.approve', $item->id_pembayaran)); ?>')" class="px-3 py-1.5 text-xs font-black bg-lime-400 border-2 border-black text-black">
                                    <i class="fas fa-check mr-1"></i>Verifikasi
                                </button>
                                <button type="button" onclick="showRejectModal('<?php echo e(route('pemilik.pembayaran.reject', $item->id_pembayaran)); ?>')" class="px-3 py-1.5 text-xs font-black bg-red-400 border-2 border-black text-white">
                                    <i class="fas fa-times mr-1"></i>Tolak
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <?php endif; ?>
            </div>
            
            <!-- Pagination -->
            <?php if($pembayaran->hasPages()): ?>
            <div class="px-4 sm:px-6 py-4 border-t-2 border-black">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-sm text-gray-700 text-center sm:text-left">
                        Menampilkan <span class="font-black text-black"><?php echo e($pembayaran->firstItem()); ?></span> - 
                        <span class="font-black text-black"><?php echo e($pembayaran->lastItem()); ?></span> dari 
                        <span class="font-black text-black"><?php echo e($pembayaran->total()); ?></span> pembayaran
                    </div>
                    <div class="flex space-x-2">
                        <?php echo e($pembayaran->links('vendor.pagination.custom-dark')); ?>

                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Back to Dashboard -->
        <div class="flex justify-center">
            <a href="<?php echo e(route('pemilik.dashboard')); ?>" 
               class="inline-flex items-center px-5 py-2.5 bg-white text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all duration-300 group">
                <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
                Kembali ke Dashboard
            </a>
        </div>
    </div>

    <!-- Bukti Pembayaran Modal -->
    <div id="buktiModal" class="fixed inset-0 bg-black/70 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border-4 border-black w-11/12 md:w-3/4 lg:w-1/2 shadow-[4px_4px_0px_#000] bg-white">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-black text-black flex items-center">
                    <i class="fas fa-receipt mr-2 text-sky-600"></i>
                    Bukti Pembayaran
                </h3>
                <button onclick="closeBuktiModal()" 
                        class="text-gray-600 hover:text-black transition">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="flex justify-center mb-6">
                <div class="bg-gray-100 border-2 border-black p-4 max-w-2xl mx-auto">
                    <img id="buktiImage" src="" alt="Bukti Pembayaran" 
                         class="max-w-full h-auto border-2 border-black">
                </div>
            </div>
            <div class="flex justify-center space-x-3">
                <a id="downloadBukti" href="#" target="_blank"
                   class="px-4 py-2 bg-sky-400 hover:bg-sky-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition">
                    <i class="fas fa-download mr-2"></i>
                    Unduh
                </a>
                <button onclick="closeBuktiModal()" 
                        class="px-4 py-2 bg-white text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition">
                    <i class="fas fa-times mr-2"></i>
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- Approve Confirmation Modal -->
    <div id="approveModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
        <div class="fixed inset-0 bg-black/60" onclick="closeApproveModal()"></div>
        <div class="relative bg-white border-4 border-black w-full max-w-md overflow-hidden shadow-[4px_4px_0px_#000]">
            <div class="p-6 text-center">
                <div class="mb-4 inline-block">
                    <div class="w-16 h-16 bg-emerald-100 border-2 border-black flex items-center justify-center mx-auto">
                        <i class="fas fa-check-circle text-emerald-600 text-2xl"></i>
                    </div>
                </div>
                <h3 class="text-xl font-black text-black mb-2">Verifikasi Pembayaran</h3>
                <p class="text-gray-600 mb-6">Apakah Anda yakin ingin memverifikasi pembayaran ini sebagai lunas?</p>
                
                <div class="flex justify-center gap-3">
                    <button type="button" onclick="closeApproveModal()" 
                            class="px-5 py-2.5 bg-white text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition">
                        Batal
                    </button>
                    <form id="approveForm" method="POST" action="" data-ajax="true" data-success-msg="Pembayaran berhasil dikonfirmasi" data-redirect="<?php echo e(route('pemilik.pembayaran.index')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" 
                                class="px-5 py-2.5 bg-lime-400 hover:bg-lime-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition uppercase tracking-wide text-sm">
                            Ya, Verifikasi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Confirmation Modal -->
    <div id="rejectModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
        <div class="fixed inset-0 bg-black/60" onclick="closeRejectModal()"></div>
        <div class="relative bg-white border-4 border-black w-full max-w-md overflow-hidden shadow-[4px_4px_0px_#000]">
            <div class="p-6 text-center">
                <div class="mb-4 inline-block">
                    <div class="w-16 h-16 bg-red-100 border-2 border-black flex items-center justify-center mx-auto">
                        <i class="fas fa-times-circle text-red-500 text-2xl"></i>
                    </div>
                </div>
                <h3 class="text-xl font-black text-black mb-2">Tolak Pembayaran</h3>
                <p class="text-gray-600 mb-6">Tolak pembayaran ini? Penghuni akan diminta untuk mengunggah ulang bukti pembayaran yang valid.</p>
                
                <div class="flex justify-center gap-3">
                    <button type="button" onclick="closeRejectModal()" 
                            class="px-5 py-2.5 bg-white text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition">
                        Batal
                    </button>
                    <form id="rejectForm" method="POST" action="" data-ajax="true" data-success-msg="Pembayaran ditolak" data-redirect="<?php echo e(route('pemilik.pembayaran.index')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" 
                                class="px-5 py-2.5 bg-red-400 hover:bg-red-500 text-white font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition uppercase tracking-wide text-sm">
                            Ya, Tolak
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Bukti modal functionality
        function showBuktiModal(imageSrc) {
            const imageElement = document.getElementById('buktiImage');
            const downloadLink = document.getElementById('downloadBukti');
            
            imageElement.src = imageSrc;
            downloadLink.href = imageSrc;
            document.getElementById('buktiModal').classList.remove('hidden');
        }

        function closeBuktiModal() {
            document.getElementById('buktiModal').classList.add('hidden');
        }

        // Approve modal functions
        function showApproveModal(action) {
            const form = document.getElementById('approveForm');
            form.dataset.ajaxAction = action.replace('/pemilik/', '/api/pemilik/');
            form.action = action;
            document.getElementById('approveModal').classList.remove('hidden');
            document.getElementById('approveModal').classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeApproveModal() {
            document.getElementById('approveModal').classList.add('hidden');
            document.getElementById('approveModal').classList.remove('flex');
            document.body.style.overflow = '';
        }

        // Reject modal functions
        function showRejectModal(action) {
            const form = document.getElementById('rejectForm');
            form.dataset.ajaxAction = action.replace('/pemilik/', '/api/pemilik/');
            form.action = action;
            document.getElementById('rejectModal').classList.remove('hidden');
            document.getElementById('rejectModal').classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
            document.getElementById('rejectModal').classList.remove('flex');
            document.body.style.overflow = '';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const buktiModal = document.getElementById('buktiModal');
            const approveModal = document.getElementById('approveModal');
            const rejectModal = document.getElementById('rejectModal');
            
            if (event.target === buktiModal) {
                closeBuktiModal();
            } else if (event.target === approveModal) {
                closeApproveModal();
            } else if (event.target === rejectModal) {
                closeRejectModal();
            }
        }

        // Keyboard shortcut (ESC to close modal)
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeBuktiModal();
                closeApproveModal();
                closeRejectModal();
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/pemilik/pembayaran/index.blade.php ENDPATH**/ ?>