<?php $__env->startSection('title', 'Analisis Data Penghuni - AyoKos'); ?>

<?php $__env->startSection('content'); ?>
    <div class="p-4 md:p-6 lg:p-8 max-w-7xl mx-auto space-y-6">
        <?php if(session('success')): ?>
            <div class="bg-emerald-400 border-2 border-black shadow-[3px_3px_0px_#000] text-black px-4 py-3  mb-6">
                <div class="flex items-center"><i class="fas fa-check-circle mr-3"></i><?php echo e(session('success')); ?></div>
            </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="bg-red-400 border-2 border-black shadow-[3px_3px_0px_#000] text-black px-4 py-3  mb-6">
                <div class="flex items-center"><i class="fas fa-exclamation-circle mr-3"></i><?php echo e(session('error')); ?></div>
            </div>
        <?php endif; ?>
        <!-- Breadcrumb -->
        <div class="bg-white border-2 border-black shadow-[2px_2px_0px_#000] p-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="<?php echo e(route('penghuni.dashboard')); ?>" class="inline-flex items-center text-sm font-black text-gray-600 hover:text-black transition-colors">
                            <i class="fas fa-gauge mr-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="inline-flex items-center">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-500 text-xs mx-2"></i>
                            <a href="<?php echo e(route('penghuni.analisis.index')); ?>" class="inline-flex items-center text-sm font-black text-black">
                                <i class="fas fa-chart-bar mr-2"></i>
                                Analisis Data Saya
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
                    <div class="flex items-center space-x-3 mb-3">
                        <div>
                            <h1 class="text-2xl md:text-3xl font-black text-black">
                            <i class="fas fa-chart-bar text-black mr-3"></i>
                            Analisis Data Kosan</h1>
                            <p class="text-gray-600">Analisis statistik dan visualisasi data properti Anda</p>
                        </div>
                    </div>
                </div>
                <div class="mt-4 md:mt-0 flex gap-3">
                    <a href="<?php echo e(route('penghuni.dashboard')); ?>"
                    class="inline-flex items-center px-4 py-2.5 bg-white border-2 border-black shadow-[2px_2px_0px_#000] text-black  hover:bg-gray-100 transition">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali ke Dashboard
                    </a>
                    <button id="exportPdfPenghuni"
                        class="inline-flex items-center px-4 py-2.5 bg-emerald-400 border-2 border-black shadow-[3px_3px_0px_#000] text-black  hover:bg-emerald-500/30 transition">
                        <i class="fas fa-file-pdf mr-2"></i>
                        Export PDF
                    </button>
                </div>
            </div>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-5">
                <div class="flex items-center">
                    <div class="p-3  bg-gray-100 border-2 border-black">
                        <i class="fas fa-file-contract text-black text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-black text-gray-600">Total Kontrak</h3>
                        <p class="text-2xl font-black text-black"><?php echo e($statistikRingkasan['total_kontrak']); ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-5">
                <div class="flex items-center">
                    <div class="p-3  bg-gray-100 border-2 border-black">
                        <i class="fas fa-wallet text-black text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-black text-gray-600">Total Pengeluaran</h3>
                        <p class="text-2xl font-black text-black">
                            Rp <?php echo e(number_format($statistikRingkasan['total_pembayaran'], 0, ',', '.')); ?>

                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-5">
                <div class="flex items-center">
                    <div class="p-3  bg-gray-100 border-2 border-black">
                        <i class="fas fa-star text-black text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-black text-gray-600">Review Diberikan</h3>
                        <p class="text-2xl font-black text-black"><?php echo e($statistikRingkasan['jumlah_review']); ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-5">
                <div class="flex items-center">
                    <div class="p-3  bg-gray-100 border-2 border-black">
                        <i class="fas fa-chart-line text-black text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-black text-gray-600">Rating Rata-rata</h3>
                        <p class="text-2xl font-black text-black"><?php echo e(number_format($statistikRingkasan['rata_rata_rating'], 1)); ?>/5</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Chart 1: Riwayat Pengeluaran 6 Bulan -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-black text-black flex items-center">
                        <i class="fas fa-wallet text-black mr-3"></i>
                        Riwayat Pengeluaran
                    </h2>
                    <span class="text-xs px-3 py-1 bg-emerald-400 text-black border-2 border-black font-black">
                        6 Bulan Terakhir
                    </span>
                </div>
                <div class="h-80">
                    <canvas id="pengeluaranChart"></canvas>
                </div>
                <div class="mt-4 p-3 bg-gray-100 border-2 border-black ">
                    <p class="text-sm text-gray-600 flex items-center">
                        <i class="fas fa-chart-bar text-emerald-400 mr-2"></i>
                        Total pengeluaran 6 bulan terakhir:
                        <span class="font-black text-emerald-400 ml-1">
                            Rp <?php echo e(number_format($pembayaranPerBulan->sum('total'), 0, ',', '.')); ?>

                        </span>
                    </p>
                </div>
            </div>

            <!-- Chart 2: Status Pembayaran -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h2 class="text-xl font-black text-black mb-6 flex items-center">
                    <i class="fas fa-credit-card text-black mr-3"></i>
                    Distribusi Status Pembayaran
                </h2>
                <div class="h-80">
                    <canvas id="statusPembayaranChart"></canvas>
                </div>
                <div class="mt-4 grid grid-cols-3 gap-2">
                    <?php $__currentLoopData = $statusPembayaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="text-center p-2 bg-gray-100 border-2 border-black ">
                            <div class="inline-block w-2 h-2  mb-1
                                <?php if($status->status_pembayaran == 'lunas'): ?> bg-emerald-500
                                <?php elseif($status->status_pembayaran == 'pending'): ?> bg-yellow-500
                                <?php elseif($status->status_pembayaran == 'terlambat'): ?> bg-rose-500
                                <?php else: ?> bg-gray-500 <?php endif; ?>">
                            </div>
                            <div class="text-xs font-black text-gray-600">
                                <?php echo e(ucfirst($status->status_pembayaran)); ?>

                            </div>
                            <div class="text-xs font-black text-black">
                                <?php echo e($status->jumlah); ?>

                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        <!-- Row 2 -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Chart 3: Preferensi Jenis Kos -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h2 class="text-xl font-black text-black mb-6 flex items-center">
                    <i class="fas fa-home text-black mr-3"></i>
                    Preferensi Jenis Kos
                </h2>
                <div class="h-80">
                    <canvas id="jenisKosChart"></canvas>
                </div>
                <?php if($jenisKosDisewa->isNotEmpty()): ?>
                <div class="mt-4 p-3 bg-gray-100 border-2 border-black ">
                    <p class="text-sm text-gray-600 flex items-center">
                        <i class="fas fa-crown text-yellow-400 mr-2"></i>
                        Jenis kos favorit:
                        <span class="font-black text-emerald-400 ml-1">
                            <?php echo e(ucfirst($jenisKosDisewa->sortByDesc('jumlah_sewa')->first()->jenis_kos)); ?>

                        </span>
                        (<?php echo e($jenisKosDisewa->sortByDesc('jumlah_sewa')->first()->jumlah_sewa); ?>x)
                    </p>
                </div>
                <?php endif; ?>
            </div>

            <!-- Chart 4: Distribusi Rating Review -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-black text-black flex items-center">
                        <i class="fas fa-star text-black mr-3"></i>
                        Distribusi Rating Review
                    </h2>
                    <?php if($statistikRingkasan['rata_rata_rating'] > 0): ?>
                    <div class="flex items-center bg-yellow-400 border-2 border-black px-3 py-1">
                        <span class="text-black font-black mr-1">&#11088;</span>
                        <span class="text-sm font-black text-black">
                            <?php echo e(number_format($statistikRingkasan['rata_rata_rating'], 1)); ?>

                        </span>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="h-80">
                    <canvas id="ratingChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Row 3: Tabel Data -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Tabel: Riwayat Kontrak -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h2 class="text-xl font-black text-black mb-6 flex items-center">
                    <i class="fas fa-history text-black mr-3"></i>
                    Riwayat Kontrak
                </h2>
                <div class="overflow-x-auto  border-2 border-black">
                    <table class="min-w-full divide-y divide-black">
                        <thead class="bg-gray-100 border-2 border-black">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-black text-gray-600 uppercase tracking-wider">Kos</th>
                                <th class="px-4 py-3 text-left text-xs font-black text-gray-600 uppercase tracking-wider">Durasi</th>
                                <th class="px-4 py-3 text-left text-xs font-black text-gray-600 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-black">
                            <?php $__currentLoopData = $riwayatKontrak->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kontrak): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="hover:bg-gray-100 transition">
                                    <td class="px-4 py-3">
                                        <div class="text-sm font-black text-black"><?php echo e($kontrak->kos->nama_kos); ?></div>
                                        <div class="text-xs text-gray-600">Kamar <?php echo e($kontrak->kamar->nomor_kamar); ?></div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="text-sm text-black"><?php echo e($kontrak->durasi_sewa); ?> <?php echo e($kontrak->unit_label_lower); ?></div>
                                        <div class="text-xs text-gray-600">
                                            <?php echo e(\Carbon\Carbon::parse($kontrak->tanggal_mulai)->format('d M Y')); ?>

                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 text-xs font-black border-2 border-black
                                            <?php echo e($kontrak->status_kontrak == 'aktif' ? 'bg-emerald-400 text-black' :
                                               ($kontrak->status_kontrak == 'selesai' ? 'bg-sky-400 text-black' :
                                               ($kontrak->status_kontrak == 'pending' ? 'bg-yellow-400 text-black' :
                                               'bg-rose-400 text-black'))); ?>">
                                            <?php echo e(ucfirst($kontrak->status_kontrak)); ?>

                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <?php if($riwayatKontrak->count() > 5): ?>
                <div class="text-center pt-4 border-t border-black mt-4">
                    <a href="<?php echo e(route('penghuni.kontrak.index')); ?>"
                       class="inline-flex items-center text-emerald-400 hover:text-emerald-300 text-sm font-black">
                        Lihat semua <?php echo e($riwayatKontrak->count()); ?> kontrak
                        <i class="fas fa-arrow-right ml-1 transition-transform group-hover:translate-x-1"></i>
                    </a>
                </div>
                <?php endif; ?>
            </div>

            <!-- Tabel: Preferensi Tipe Kamar -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h2 class="text-xl font-black text-black mb-6 flex items-center">
                    <i class="fas fa-bed text-black mr-3"></i>
                    Preferensi Tipe Kamar
                </h2>
                <div class="overflow-x-auto  border-2 border-black">
                    <table class="min-w-full divide-y divide-black">
                        <thead class="bg-gray-100 border-2 border-black">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-black text-gray-600 uppercase tracking-wider">Tipe Kamar</th>
                                <th class="px-4 py-3 text-left text-xs font-black text-gray-600 uppercase tracking-wider">Jumlah Sewa</th>
                                <th class="px-4 py-3 text-left text-xs font-black text-gray-600 uppercase tracking-wider">Harga Rata-rata</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-black">
                            <?php $__currentLoopData = $tipeKamarDisewa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="hover:bg-gray-100 transition">
                                    <td class="px-4 py-3">
                                        <div class="text-sm font-black text-black"><?php echo e($tipe->tipe_kamar); ?></div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="text-sm text-black"><?php echo e($tipe->jumlah_sewa); ?> kali</div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="text-sm font-black text-emerald-400">
                                            Rp <?php echo e(number_format($tipe->rata_rata_harga, 0, ',', '.')); ?>

                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Insight Section -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <h2 class="text-xl font-black text-black mb-6 flex items-center">
                <i class="fas fa-lightbulb text-yellow-400 mr-3"></i>
                Insight untuk Anda
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <?php
                    $kosFavorit = $jenisKosDisewa->sortByDesc('jumlah_sewa')->first();
                    $tipeFavorit = $tipeKamarDisewa->sortByDesc('jumlah_sewa')->first();
                    $rataPengeluaran = $pembayaranPerBulan->avg('total') ?? 0;
                ?>

                <div class="bg-white border-2 border-black shadow-[2px_2px_0px_#000] p-4">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10  bg-gray-100 border-2 border-black flex items-center justify-center mr-3">
                            <i class="fas fa-crown text-yellow-400"></i>
                        </div>
                        <h3 class="font-black text-black">Jenis Kos Favorit</h3>
                    </div>
                    <p class="text-sm text-gray-600">
                        Anda paling sering menyewa kos
                        <span class="font-black text-emerald-400"><?php echo e($kosFavorit->jenis_kos ?? '-'); ?></span>
                        sebanyak <?php echo e($kosFavorit->jumlah_sewa ?? 0); ?> kali.
                    </p>
                </div>

                <div class="bg-white border-2 border-black shadow-[2px_2px_0px_#000] p-4">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10  bg-gray-100 border-2 border-black flex items-center justify-center mr-3">
                            <i class="fas fa-chart-line text-black"></i>
                        </div>
                        <h3 class="font-black text-black">Pengeluaran Rata-rata</h3>
                    </div>
                    <p class="text-sm text-gray-600">
                        Rata-rata pengeluaran per bulan:
                        <span class="font-black text-emerald-400">
                            Rp <?php echo e(number_format($rataPengeluaran, 0, ',', '.')); ?>

                        </span>
                    </p>
                </div>

                <div class="bg-white border-2 border-black shadow-[2px_2px_0px_#000] p-4">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10  bg-gray-100 border-2 border-black flex items-center justify-center mr-3">
                            <i class="fas fa-bed text-purple-400"></i>
                        </div>
                        <h3 class="font-black text-black">Preferensi Kamar</h3>
                    </div>
                    <p class="text-sm text-gray-600">
                        Tipe kamar favorit:
                        <span class="font-black text-emerald-400"><?php echo e($tipeFavorit->tipe_kamar ?? '-'); ?></span>
                        dengan harga rata-rata
                        <span class="font-black text-emerald-400">
                            Rp <?php echo e(number_format($tipeFavorit->rata_rata_harga ?? 0, 0, ',', '.')); ?>

                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof window.initPenghuniCharts === 'function') {
            window.initPenghuniCharts({
                pembayaranPerBulan: <?php echo json_encode($pembayaranPerBulan, 15, 512) ?>,
                statusPembayaran: <?php echo json_encode($statusPembayaran, 15, 512) ?>,
                jenisKosDisewa: <?php echo json_encode($jenisKosDisewa, 15, 512) ?>,
                reviewStats: <?php echo json_encode($reviewStats, 15, 512) ?>,
            });
        }
    });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

    <div id="penghuniData"
         data-nama="<?php echo e(auth()->user()->nama ?? 'Penghuni'); ?>"
         style="display: none;">
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/penghuni/analisis/index.blade.php ENDPATH**/ ?>