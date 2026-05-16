<?php $__env->startSection('title', 'Analisis Data - AyoKos'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto p-4 md:p-6 lg:p-8 space-y-6">
    <?php if(session('success')): ?>
        <div class="bg-emerald-400 border-2 border-black text-black font-bold px-4 py-3 shadow-[3px_3px_0px_#000] mb-6">
            <div class="flex items-center"><i class="fas fa-check-circle mr-3"></i><?php echo e(session('success')); ?></div>
        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="bg-red-400 border-2 border-black text-black font-bold px-4 py-3 shadow-[3px_3px_0px_#000] mb-6">
            <div class="flex items-center"><i class="fas fa-exclamation-circle mr-3"></i><?php echo e(session('error')); ?></div>
        </div>
    <?php endif; ?>
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
                        <a href="<?php echo e(route('pemilik.analisis.index')); ?>" class="inline-flex items-center text-sm font-bold text-black">
                            <i class="fas fa-chart-bar mr-2"></i>
                            Analisis Data
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
                        <p class="text-gray-700">Analisis statistik dan visualisasi data properti Anda</p>
                    </div>
                </div>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="<?php echo e(route('pemilik.dashboard')); ?>" 
                   class="inline-flex items-center px-4 py-2.5 bg-white text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Dashboard
                </a>
                <button id="exportPdfBtn" 
                    class="inline-flex items-center px-4 py-2.5 bg-sky-400 hover:bg-sky-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition uppercase tracking-wide text-sm">
                    <i class="fas fa-file-pdf mr-2"></i>
                    Export PDF
                </button>
            </div>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Total Pendapatan -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex items-center">
                <div class="p-3 bg-gray-200 border-2 border-black mr-4">
                    <i class="fas fa-wallet text-black text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-black mb-1">Total Pendapatan Tahun Ini</p>
                     <p class="text-2xl font-black text-black" data-total-pendapatan>
                         Rp <?php echo e(number_format($pendapatanPerKosFull->sum('total_pendapatan'), 0, ',', '.')); ?>

                     </p>
                </div>
            </div>
        </div>

        <!-- Total Penghuni -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex items-center">
                <div class="p-3 bg-gray-200 border-2 border-black mr-4">
                    <i class="fas fa-users text-black text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-black mb-1">Total Penghuni Aktif</p>
                     <p class="text-2xl font-black text-black" data-total-penghuni>
                         <?php echo e($penghuniPerKosFull->sum('jumlah_penghuni')); ?>

                     </p>
                </div>
            </div>
        </div>

        <!-- Okupansi -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex items-center">
                <div class="p-3 bg-gray-200 border-2 border-black mr-4">
                    <i class="fas fa-chart-line text-black text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-black mb-1">Rata-rata Okupansi</p>
                    <p class="text-2xl font-black text-black" data-rata-rata-okupansi>
                        <?php
                            $terisi = $statusKamar->where('status_kamar', 'terisi')->first()->jumlah ?? 0;
                            $total = $statusKamar->sum('jumlah') ?: 1;
                            $okupansi = ($terisi / $total) * 100;
                        ?>
                        <?php echo e(number_format($okupansi, 1)); ?>%
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Chart 1: Pendapatan 6 Bulan Terakhir -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-black text-black flex items-center">
                    <i class="fas fa-money-bill-wave text-sky-600 mr-3"></i>
                    Trend Pendapatan (12 Bulan)
                </h2>
                <span class="text-xs px-3 py-1 bg-black text-white font-black border-2 border-black">
                    <?php echo e(date('Y')); ?>

                </span>
            </div>
            <div class="h-72">
                <canvas id="pendapatanChart"></canvas>
            </div>
        </div>

        <!-- Chart 2: Status Kamar -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-black text-black flex items-center">
                    <i class="fas fa-bed text-emerald-600 mr-3"></i>
                    Distribusi Status Kamar
                </h2>
                <span class="text-xs px-3 py-1 bg-black text-white font-black border-2 border-black">
                    <?php echo e($statusKamar->sum('jumlah')); ?> Kamar
                </span>
            </div>
            <div class="h-72">
                <canvas id="statusKamarChart"></canvas>
            </div>
            <!-- Legend -->
            <div class="grid grid-cols-3 gap-3 mt-4">
                <?php $__currentLoopData = $statusKamar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex items-center">
                        <div class="w-3 h-3 mr-2 border border-black
                            <?php if($status->status_kamar == 'tersedia'): ?> bg-green-500
                            <?php elseif($status->status_kamar == 'terisi'): ?> bg-blue-500
                            <?php else: ?> bg-yellow-500 <?php endif; ?>">
                        </div>
                        <span class="text-sm text-gray-600">
                            <?php echo e(ucfirst($status->status_kamar)); ?>

                        </span>
                        <span class="ml-auto text-sm font-bold text-black">
                            <?php echo e($status->jumlah); ?>

                        </span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <!-- Row 2 -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Chart 3: Jenis Kos -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-black text-black flex items-center">
                    <i class="fas fa-home text-blue-600 mr-3"></i>
                    Distribusi Jenis Kos
                </h2>
                <span class="text-xs px-3 py-1 bg-black text-white font-black border-2 border-black">
                    <?php echo e($jenisKos->sum('jumlah')); ?> Kos
                </span>
            </div>
            <div class="h-72">
                <canvas id="jenisKosChart"></canvas>
            </div>
        </div>

        <!-- Chart 4: Status Kontrak -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-black text-black flex items-center">
                    <i class="fas fa-file-contract text-purple-600 mr-3"></i>
                    Status Kontrak
                </h2>
                <span class="text-xs px-3 py-1 bg-black text-white font-black border-2 border-black">
                    <?php echo e($statusKontrak->sum('jumlah')); ?> Kontrak
                </span>
            </div>
            <div class="h-72">
                <canvas id="statusKontrakChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Row 3: Additional Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Chart 5: Review/Rating -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-black text-black flex items-center">
                    <i class="fas fa-star text-yellow-600 mr-3"></i>
                    Distribusi Rating
                </h2>
                <span class="text-xs px-3 py-1 bg-black text-white font-black border-2 border-black">
                    <?php echo e($reviewData->sum('jumlah')); ?> Review
                </span>
            </div>
            <div class="h-72">
                <canvas id="reviewChart"></canvas>
            </div>
        </div>

        <!-- Chart 6: Tipe Kamar -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-black text-black flex items-center">
                    <i class="fas fa-door-open text-cyan-600 mr-3"></i>
                    Distribusi Tipe Kamar
                </h2>
                <span class="text-xs px-3 py-1 bg-black text-white font-black border-2 border-black">
                    <?php echo e($tipeKamar->sum('jumlah')); ?> Kamar
                </span>
            </div>
            <div class="h-72">
                <canvas id="tipeKamarChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Row 4: Tabel Data -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Tabel: Pendapatan per Kos -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-black text-black flex items-center">
                    <i class="fas fa-trophy text-yellow-600 mr-3"></i>
                    Pendapatan per Kos
                </h2>
                <span class="text-xs px-3 py-1 bg-black text-white font-black border-2 border-black">
                    Tahun <?php echo e(date('Y')); ?>

                </span>
            </div>
            
            <div class="space-y-4">
                <?php $__currentLoopData = $pendapatanPerKos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-gray-100 border-2 border-black p-4 hover:border-yellow-400 transition">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-sky-400 border-2 border-black flex items-center justify-center mr-3">
                                    <i class="fas fa-home text-black"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-black"><?php echo e($kos->nama_kos); ?></h3>
                                    <p class="text-xs text-gray-600">Kos terbaik</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-black text-emerald-600">
                                    Rp <?php echo e(number_format($kos->total_pendapatan, 0, ',', '.')); ?>

                                </p>
                                 <div class="w-32 h-1 bg-gray-200 border border-black overflow-hidden mt-1">
                                      <div class="h-full bg-emerald-500"
                                           style="width: <?php echo e(($pendapatanPerKosFull->max('total_pendapatan') > 0 ? ($kos->total_pendapatan / $pendapatanPerKosFull->max('total_pendapatan')) * 100 : 0)); ?>%">
                                      </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                 <?php if($pendapatanPerKos->isEmpty()): ?>
                     <div class="text-center py-8">
                         <div class="w-16 h-16 bg-gray-200 border-2 border-black shadow-[2px_2px_0px_#000] flex items-center justify-center mx-auto mb-4">
                             <i class="fas fa-chart-line text-gray-700 text-2xl"></i>
                         </div>
                         <p class="text-gray-600">Belum ada data pendapatan</p>
                     </div>
                 <?php endif; ?>

                 <?php if($pendapatanPerKos->hasPages()): ?>
                 <div class="px-6 py-4 border-t-2 border-black">
                     <div class="flex items-center justify-between">
                         <div class="text-sm text-gray-700">
                             Menampilkan <?php echo e($pendapatanPerKos->firstItem()); ?> - <?php echo e($pendapatanPerKos->lastItem()); ?> dari <?php echo e($pendapatanPerKos->total()); ?> kos
                         </div>
                         <div class="flex space-x-2">
                             <?php echo e($pendapatanPerKos->links('vendor.pagination.custom-dark')); ?>

                         </div>
                     </div>
                 </div>
                 <?php endif; ?>
             </div>
         </div>

        <!-- Tabel: Penghuni per Kos -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-black text-black flex items-center">
                    <i class="fas fa-user-friends text-blue-600 mr-3"></i>
                    Penghuni per Kos
                </h2>
                <span class="text-xs px-3 py-1 bg-black text-white font-black border-2 border-black">
                    Penghuni Aktif
                </span>
            </div>
            
            <div class="space-y-4">
                <?php $__currentLoopData = $penghuniPerKos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-gray-100 border-2 border-black p-4 hover:border-yellow-400 transition">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-blue-400 border-2 border-black flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-black"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-black"><?php echo e($kos->nama_kos); ?></h3>
                                    <p class="text-xs text-gray-600"><?php echo e($kos->jumlah_penghuni); ?> penghuni</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="flex items-center justify-end">
                                     <div class="w-24 h-6 bg-gray-200 border border-black overflow-hidden mr-3">
                                          <div class="h-full bg-blue-500"
                                               style="width: <?php echo e(($penghuniPerKosFull->max('jumlah_penghuni') > 0 ? ($kos->jumlah_penghuni / $penghuniPerKosFull->max('jumlah_penghuni')) * 100 : 0)); ?>%">
                                          </div>
                                     </div>
                                    <span class="text-lg font-black text-black">
                                        <?php echo e($kos->jumlah_penghuni); ?>

                                    </span>
                                </div>
                                 <p class="text-xs text-gray-600 mt-1">
                                     <?php echo e(round(($kos->jumlah_penghuni / ($penghuniPerKosFull->sum('jumlah_penghuni') ?: 1)) * 100, 1)); ?>% dari total
                                 </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                 <?php if($penghuniPerKos->isEmpty()): ?>
                     <div class="text-center py-8">
                         <div class="w-16 h-16 bg-gray-200 border-2 border-black shadow-[2px_2px_0px_#000] flex items-center justify-center mx-auto mb-4">
                             <i class="fas fa-users text-gray-700 text-2xl"></i>
                         </div>
                         <p class="text-gray-600">Belum ada data penghuni</p>
                     </div>
                 <?php endif; ?>

                 <?php if($penghuniPerKos->hasPages()): ?>
                 <div class="px-6 py-4 border-t-2 border-black">
                     <div class="flex items-center justify-between">
                         <div class="text-sm text-gray-700">
                             Menampilkan <?php echo e($penghuniPerKos->firstItem()); ?> - <?php echo e($penghuniPerKos->lastItem()); ?> dari <?php echo e($penghuniPerKos->total()); ?> kos
                         </div>
                         <div class="flex space-x-2">
                             <?php echo e($penghuniPerKos->links('vendor.pagination.custom-dark')); ?>

                         </div>
                     </div>
                 </div>
                 <?php endif; ?>
             </div>
          </div>
      </div>

        <!-- Insight Section -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <h2 class="text-xl font-black text-black mb-6 flex items-center">
                <i class="fas fa-lightbulb text-yellow-600 mr-3"></i>
                Insight Bisnis Anda
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <?php
                    $kosTerbaik = $pendapatanPerKosFull->sortByDesc('total_pendapatan')->first();
                    $kosPalingBanyakPenghuni = $penghuniPerKosFull->sortByDesc('jumlah_penghuni')->first();
                    $rataPendapatan = $pendapatanPerKosFull->avg('total_pendapatan') ?? 0;
                    $persentaseTerisi = ($statusKamar->where('status_kamar', 'terisi')->sum('jumlah') / ($statusKamar->sum('jumlah') ?: 1)) * 100;
                ?>
                
                <!-- Insight 1: Kos Terbaik -->
                <div class="bg-gray-100 border-2 border-black p-4">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10 bg-yellow-400 border-2 border-black flex items-center justify-center mr-3">
                            <i class="fas fa-trophy text-black"></i>
                        </div>
                        <h3 class="font-black text-black">Kos Terbaik</h3>
                    </div>
                    <p class="text-sm text-gray-600">
                        Kos 
                        <span class="font-black text-black"><?php echo e($kosTerbaik->nama_kos ?? '-'); ?></span> 
                        menghasilkan pendapatan tertinggi sebesar 
                        <span class="font-black text-black">
                            Rp <?php echo e(number_format($kosTerbaik->total_pendapatan ?? 0, 0, ',', '.')); ?>

                        </span>
                    </p>
                </div>

                <!-- Insight 2: Okupansi Tinggi -->
                <div class="bg-gray-100 border-2 border-black p-4">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10 bg-emerald-400 border-2 border-black flex items-center justify-center mr-3">
                            <i class="fas fa-chart-line text-black"></i>
                        </div>
                        <h3 class="font-black text-black">Tingkat Okupansi</h3>
                    </div>
                    <p class="text-sm text-gray-600">
                        Okupansi saat ini: 
                        <span class="font-black text-black"><?php echo e(number_format($persentaseTerisi, 1)); ?>%</span>
                        dari total kamar, dengan 
                        <span class="font-black text-black">
                            <?php echo e($statusKamar->where('status_kamar', 'terisi')->sum('jumlah')); ?>

                        </span> kamar terisi.
                    </p>
                </div>

                <!-- Insight 3: Potensi Pengembangan -->
                <div class="bg-gray-100 border-2 border-black p-4">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10 bg-purple-400 border-2 border-black flex items-center justify-center mr-3">
                            <i class="fas fa-users text-black"></i>
                        </div>
                        <h3 class="font-black text-black">Penghuni Terbanyak</h3>
                    </div>
                    <p class="text-sm text-gray-600">
                        Kos 
                        <span class="font-black text-black"><?php echo e($kosPalingBanyakPenghuni->nama_kos ?? '-'); ?></span> 
                        memiliki penghuni terbanyak: 
                        <span class="font-black text-black"><?php echo e($kosPalingBanyakPenghuni->jumlah_penghuni ?? 0); ?> orang</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    if (typeof Chart === 'undefined') return;

    Chart.defaults.color = '#94a3b8';
    Chart.defaults.borderColor = '#334155';

    var pd = <?php echo json_encode($pendapatanPerBulan, 15, 512) ?>;
    var sk = <?php echo json_encode($statusKamar, 15, 512) ?>;
    var jk = <?php echo json_encode($jenisKos, 15, 512) ?>;
    var skn = <?php echo json_encode($statusKontrak, 15, 512) ?>;
    var rd = <?php echo json_encode($reviewData, 15, 512) ?>;
    var tk = <?php echo json_encode($tipeKamar, 15, 512) ?>;

    if (document.getElementById('pendapatanChart')) {
        new Chart(document.getElementById('pendapatanChart').getContext('2d'), {
            type: 'line', data: {
                labels: pd.map(function(i) { var p = i.bulan.split('-'); return new Date(p[0], p[1]-1).toLocaleDateString('id-ID', {month:'short'}); }),
                datasets: [{ label: 'Pendapatan', data: pd.map(function(i) { return i.total; }), borderColor: 'rgb(59,130,246)', backgroundColor: 'rgba(59,130,246,0.1)', fill: true, tension: 0.4, borderWidth: 2, pointBackgroundColor: 'rgb(59,130,246)', pointBorderColor: '#fff', pointBorderWidth: 2, pointRadius: 4 }]
            },
            options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { callback: function(v) { return v >= 1e6 ? 'Rp '+(v/1e6).toFixed(1)+' jt' : v >= 1e3 ? 'Rp '+(v/1e3).toFixed(0)+' rb' : 'Rp '+v; } } }, x: { grid: { color: 'rgba(255,255,255,0.05)' } } }, plugins: { legend: { labels: { color: '#e2e8f0', font: { size: 12 } } }, tooltip: { backgroundColor: 'rgba(30,41,59,0.9)', titleColor: '#e2e8f0', bodyColor: '#cbd5e1', borderColor: '#334155', borderWidth: 1, callbacks: { label: function(ctx) { return 'Pendapatan: Rp '+ctx.parsed.y.toLocaleString('id-ID'); } } } } }
        });
    }

    if (document.getElementById('statusKamarChart')) {
        new Chart(document.getElementById('statusKamarChart').getContext('2d'), {
            type: 'doughnut', data: {
                labels: sk.map(function(i) { return i.status_kamar === 'tersedia' ? 'Tersedia' : i.status_kamar === 'terisi' ? 'Terisi' : 'Maintenance'; }),
                datasets: [{ data: sk.map(function(i) { return i.jumlah; }), backgroundColor: ['rgba(34,197,94,0.8)', 'rgba(59,130,246,0.8)', 'rgba(234,179,8,0.8)'] }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { color: '#e2e8f0', padding: 12, font: { size: 11 } } } } }
        });
    }

    if (document.getElementById('jenisKosChart')) {
        new Chart(document.getElementById('jenisKosChart').getContext('2d'), {
            type: 'bar', data: {
                labels: jk.map(function(i) { return i.jenis_kos.charAt(0).toUpperCase() + i.jenis_kos.slice(1); }),
                datasets: [{ label: 'Jumlah Kos', data: jk.map(function(i) { return i.jumlah; }), backgroundColor: ['rgba(59,130,246,0.7)', 'rgba(236,72,153,0.7)', 'rgba(168,85,247,0.7)'], borderRadius: 6 }]
            },
            options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { stepSize: 1 } }, x: { grid: { display: false } } }, plugins: { legend: { display: false } } }
        });
    }

    if (document.getElementById('statusKontrakChart')) {
        new Chart(document.getElementById('statusKontrakChart').getContext('2d'), {
            type: 'pie', data: {
                labels: skn.map(function(i) { return i.status_kontrak.charAt(0).toUpperCase() + i.status_kontrak.slice(1); }),
                datasets: [{ data: skn.map(function(i) { return i.jumlah; }), backgroundColor: ['rgba(34,197,94,0.8)', 'rgba(59,130,246,0.8)', 'rgba(100,116,139,0.8)', 'rgba(239,68,68,0.8)'] }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { color: '#e2e8f0', padding: 10, font: { size: 11 } } } } }
        });
    }

    if (document.getElementById('reviewChart')) {
        new Chart(document.getElementById('reviewChart').getContext('2d'), {
            type: 'bar', data: {
                labels: rd.map(function(i) { return i.rating + ' Bintang'; }),
                datasets: [{ label: 'Jumlah Review', data: rd.map(function(i) { return i.jumlah; }), backgroundColor: ['rgba(239,68,68,0.7)', 'rgba(251,146,60,0.7)', 'rgba(234,179,8,0.7)', 'rgba(34,197,94,0.7)', 'rgba(59,130,246,0.7)'], borderRadius: 6 }]
            },
            options: { indexAxis: 'y', responsive: true, maintainAspectRatio: false, scales: { x: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { stepSize: 1 } }, y: { grid: { display: false } } }, plugins: { legend: { display: false } } }
        });
    }

    if (document.getElementById('tipeKamarChart')) {
        new Chart(document.getElementById('tipeKamarChart').getContext('2d'), {
            type: 'doughnut', data: {
                labels: tk.map(function(i) { return i.tipe_kamar; }),
                datasets: [{ data: tk.map(function(i) { return i.jumlah; }), backgroundColor: ['rgba(99,102,241,0.8)', 'rgba(168,85,247,0.8)', 'rgba(236,72,153,0.8)', 'rgba(34,197,94,0.8)', 'rgba(234,179,8,0.8)'] }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { color: '#e2e8f0', padding: 10, font: { size: 11 } } } } }
        });
    }
});
</script>



<!-- Include library PDF dan script export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<!-- Di kedua index.blade.php (pemilik dan penghuni) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<!-- Data pemilik untuk PDF (hidden element) -->
<div id="pemilikData" 
     data-nama="<?php echo e(auth()->user()->nama ?? 'Pemilik'); ?>"
     data-tanggal="<?php echo e(now()->format('d F Y')); ?>"
     style="display: none;">
</div>

<!-- Include PDF export script dari blade file -->
<?php echo $__env->make('pemilik.analisis.pdf-export', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/pemilik/analisis/index.blade.php ENDPATH**/ ?>