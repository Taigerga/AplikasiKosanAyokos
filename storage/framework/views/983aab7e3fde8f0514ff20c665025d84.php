<?php $__env->startSection('title', 'Analisis Data - AyoKos'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto p-4 md:p-6 lg:p-8 space-y-6">
    <!-- Breadcrumb -->
    <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-4">
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
                        <a href="<?php echo e(route('pemilik.analisis.index')); ?>" class="inline-flex items-center text-sm font-medium text-white">
                            <i class="fas fa-chart-bar mr-2"></i>
                            Analisis Data
                        </a>
                    </div>
                </li>
            </ol>
        </nav>
    </div>  
    <!-- Header -->
    <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between">
            <div>
                <div class="flex items-center space-x-3 mb-3">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-white">
                        <i class="fas fa-chart-bar text-white mr-3"></i>    
                        Analisis Data Kosan</h1>
                        <p class="text-slate-100">Analisis statistik dan visualisasi data properti Anda</p>
                    </div>
                </div>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="<?php echo e(route('pemilik.dashboard')); ?>" 
                   class="inline-flex items-center px-4 py-2.5 bg-white/5 backdrop-blur-sm border border-white/20 hover:bg-white/10 text-white rounded-xl transition">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Dashboard
                </a>
                <button id="exportPdf" 
                    class="inline-flex items-center px-4 py-2.5 bg-sky-500/20 backdrop-blur-sm border border-sky-500/20 hover:bg-sky-500/10 text-white rounded-xl transition">
                    <i class="fas fa-file-pdf mr-2"></i>
                    Export PDF
                </button>
            </div>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Total Pendapatan -->
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-white/5 backdrop-blur-sm mr-4">
                    <i class="fas fa-wallet text-white text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-slate-100 font-medium mb-1">Total Pendapatan Tahun Ini</p>
                     <p class="text-2xl font-bold text-white" data-total-pendapatan>
                         Rp <?php echo e(number_format($pendapatanPerKosFull->sum('total_pendapatan'), 0, ',', '.')); ?>

                     </p>
                </div>
            </div>
        </div>

        <!-- Total Penghuni -->
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-white/5 backdrop-blur-sm mr-4">
                    <i class="fas fa-users text-white text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-slate-100 font-medium mb-1">Total Penghuni Aktif</p>
                     <p class="text-2xl font-bold text-white" data-total-penghuni>
                         <?php echo e($penghuniPerKosFull->sum('jumlah_penghuni')); ?>

                     </p>
                </div>
            </div>
        </div>

        <!-- Okupansi -->
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-white/5 backdrop-blur-sm mr-4">
                    <i class="fas fa-chart-line text-white text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-slate-100 font-medium mb-1">Rata-rata Okupansi</p>
                    <p class="text-2xl font-bold text-white" data-rata-rata-okupansi>
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
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6 card-hover">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-money-bill-wave text-sky-400 mr-3"></i>
                    Trend Pendapatan (12 Bulan)
                </h2>
                <span class="text-xs px-3 py-1 rounded-full bg-white/5 backdrop-blur-sm text-white">
                    <?php echo e(date('Y')); ?>

                </span>
            </div>
            <div class="h-72">
                <canvas id="pendapatanChart"></canvas>
            </div>
        </div>

        <!-- Chart 2: Status Kamar -->
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6 card-hover">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-bed text-emerald-400 mr-3"></i>
                    Distribusi Status Kamar
                </h2>
                <span class="text-xs px-3 py-1 rounded-full bg-white/5 backdrop-blur-sm text-white">
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
                        <div class="w-3 h-3 rounded-full mr-2
                            <?php if($status->status_kamar == 'tersedia'): ?> bg-green-500
                            <?php elseif($status->status_kamar == 'terisi'): ?> bg-blue-500
                            <?php else: ?> bg-yellow-500 <?php endif; ?>">
                        </div>
                        <span class="text-sm text-slate-100">
                            <?php echo e(ucfirst($status->status_kamar)); ?>

                        </span>
                        <span class="ml-auto text-sm font-medium text-white">
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
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6 card-hover">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-home text-blue-400 mr-3"></i>
                    Distribusi Jenis Kos
                </h2>
                <span class="text-xs px-3 py-1 rounded-full bg-white/5 backdrop-blur-sm text-white">
                    <?php echo e($jenisKos->sum('jumlah')); ?> Kos
                </span>
            </div>
            <div class="h-72">
                <canvas id="jenisKosChart"></canvas>
            </div>
        </div>

        <!-- Chart 4: Status Kontrak -->
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6 card-hover">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-file-contract text-purple-400 mr-3"></i>
                    Status Kontrak
                </h2>
                <span class="text-xs px-3 py-1 rounded-full bg-white/5 backdrop-blur-sm text-white">
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
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6 card-hover">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-star text-yellow-400 mr-3"></i>
                    Distribusi Rating
                </h2>
                <span class="text-xs px-3 py-1 rounded-full bg-white/5 backdrop-blur-sm text-white">
                    <?php echo e($reviewData->sum('jumlah')); ?> Review
                </span>
            </div>
            <div class="h-72">
                <canvas id="reviewChart"></canvas>
            </div>
        </div>

        <!-- Chart 6: Tipe Kamar -->
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6 card-hover">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-door-open text-cyan-400 mr-3"></i>
                    Distribusi Tipe Kamar
                </h2>
                <span class="text-xs px-3 py-1 rounded-full bg-white/5 backdrop-blur-sm text-white">
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
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-trophy text-yellow-400 mr-3"></i>
                    Pendapatan per Kos
                </h2>
                <span class="text-xs px-3 py-1 rounded-full bg-white/5 backdrop-blur-sm text-white">
                    Tahun <?php echo e(date('Y')); ?>

                </span>
            </div>
            
            <div class="space-y-4">
                <?php $__currentLoopData = $pendapatanPerKos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white/5 border border-white/20 rounded-xl p-4 hover:border-sky-500/50 transition">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-sky-500/20 backdrop-blur-sm border border-sky-500/20 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-home text-sky-400"></i>
                                </div>
                                <div>
                                    <h3 class="font-medium text-white"><?php echo e($kos->nama_kos); ?></h3>
                                    <p class="text-xs text-slate-100">Kos terbaik</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-bold text-emerald-400">
                                    Rp <?php echo e(number_format($kos->total_pendapatan, 0, ',', '.')); ?>

                                </p>
                                 <div class="w-32 h-1 bg-white/20 rounded-full overflow-hidden mt-1">
                                      <div class="h-full bg-emerald-500 rounded-full"
                                           style="width: <?php echo e(($pendapatanPerKosFull->max('total_pendapatan') > 0 ? ($kos->total_pendapatan / $pendapatanPerKosFull->max('total_pendapatan')) * 100 : 0)); ?>%">
                                      </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                 <?php if($pendapatanPerKos->isEmpty()): ?>
                     <div class="text-center py-8">
                         <div class="w-16 h-16 bg-white/5 backdrop-blur-sm border border-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                             <i class="fas fa-chart-line text-slate-100 text-2xl"></i>
                         </div>
                         <p class="text-slate-100">Belum ada data pendapatan</p>
                     </div>
                 <?php endif; ?>

                 <?php if($pendapatanPerKos->hasPages()): ?>
                 <div class="px-6 py-4 border-t border-white/20">
                     <div class="flex items-center justify-between">
                         <div class="text-sm text-slate-100">
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
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-user-friends text-blue-400 mr-3"></i>
                    Penghuni per Kos
                </h2>
                <span class="text-xs px-3 py-1 rounded-full bg-white/5 backdrop-blur-sm text-white">
                    Penghuni Aktif
                </span>
            </div>
            
            <div class="space-y-4">
                <?php $__currentLoopData = $penghuniPerKos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white/5 border border-white/20 rounded-xl p-4 hover:border-blue-500/50 transition">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-blue-500/20 backdrop-blur-sm border border-blue-500/20 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-blue-400"></i>
                                </div>
                                <div>
                                    <h3 class="font-medium text-white"><?php echo e($kos->nama_kos); ?></h3>
                                    <p class="text-xs text-slate-100"><?php echo e($kos->jumlah_penghuni); ?> penghuni</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="flex items-center justify-end">
                                     <div class="w-24 h-6 bg-white/20 rounded-full overflow-hidden mr-3">
                                          <div class="h-full bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full"
                                               style="width: <?php echo e(($penghuniPerKosFull->max('jumlah_penghuni') > 0 ? ($kos->jumlah_penghuni / $penghuniPerKosFull->max('jumlah_penghuni')) * 100 : 0)); ?>%">
                                          </div>
                                     </div>
                                    <span class="text-lg font-bold text-white">
                                        <?php echo e($kos->jumlah_penghuni); ?>

                                    </span>
                                </div>
                                 <p class="text-xs text-slate-100 mt-1">
                                     <?php echo e(round(($kos->jumlah_penghuni / ($penghuniPerKosFull->sum('jumlah_penghuni') ?: 1)) * 100, 1)); ?>% dari total
                                 </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                 <?php if($penghuniPerKos->isEmpty()): ?>
                     <div class="text-center py-8">
                         <div class="w-16 h-16 bg-white/5 backdrop-blur-sm border border-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                             <i class="fas fa-users text-slate-100 text-2xl"></i>
                         </div>
                         <p class="text-slate-100">Belum ada data penghuni</p>
                     </div>
                 <?php endif; ?>

                 <?php if($penghuniPerKos->hasPages()): ?>
                 <div class="px-6 py-4 border-t border-white/20">
                     <div class="flex items-center justify-between">
                         <div class="text-sm text-slate-100">
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
        <div class="bg-dark-card border border-dark-border rounded-2xl p-6 card-hover">
            <h2 class="text-xl font-bold text-white mb-6 flex items-center">
                <i class="fas fa-lightbulb text-yellow-400 mr-3"></i>
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
                <div class="bg-primary-900/20 border border-primary-500/30 p-4 rounded-xl">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10 rounded-lg bg-primary-900/30 flex items-center justify-center mr-3">
                            <i class="fas fa-trophy text-primary-400"></i>
                        </div>
                        <h3 class="font-semibold text-white">Kos Terbaik</h3>
                    </div>
                    <p class="text-sm text-dark-muted">
                        Kos 
                        <span class="font-bold text-primary-300"><?php echo e($kosTerbaik->nama_kos ?? '-'); ?></span> 
                        menghasilkan pendapatan tertinggi sebesar 
                        <span class="font-bold text-primary-300">
                            Rp <?php echo e(number_format($kosTerbaik->total_pendapatan ?? 0, 0, ',', '.')); ?>

                        </span>
                    </p>
                </div>

                <!-- Insight 2: Okupansi Tinggi -->
                <div class="bg-green-900/20 border border-green-500/30 p-4 rounded-xl">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10 rounded-lg bg-green-900/30 flex items-center justify-center mr-3">
                            <i class="fas fa-chart-line text-green-400"></i>
                        </div>
                        <h3 class="font-semibold text-white">Tingkat Okupansi</h3>
                    </div>
                    <p class="text-sm text-dark-muted">
                        Okupansi saat ini: 
                        <span class="font-bold text-green-300"><?php echo e(number_format($persentaseTerisi, 1)); ?>%</span>
                        dari total kamar, dengan 
                        <span class="font-bold text-green-300">
                            <?php echo e($statusKamar->where('status_kamar', 'terisi')->sum('jumlah')); ?>

                        </span> kamar terisi.
                    </p>
                </div>

                <!-- Insight 3: Potensi Pengembangan -->
                <div class="bg-purple-900/20 border border-purple-500/30 p-4 rounded-xl">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10 rounded-lg bg-purple-900/30 flex items-center justify-center mr-3">
                            <i class="fas fa-users text-purple-400"></i>
                        </div>
                        <h3 class="font-semibold text-white">Penghuni Terbanyak</h3>
                    </div>
                    <p class="text-sm text-dark-muted">
                        Kos 
                        <span class="font-bold text-purple-300"><?php echo e($kosPalingBanyakPenghuni->nama_kos ?? '-'); ?></span> 
                        memiliki penghuni terbanyak: 
                        <span class="font-bold text-purple-300"><?php echo e($kosPalingBanyakPenghuni->jumlah_penghuni ?? 0); ?> orang</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Chart.js theme configuration
        Chart.defaults.color = '#94a3b8';
        Chart.defaults.borderColor = '#334155';
        
        // Data from PHP
        const pendapatanData = <?php echo json_encode($pendapatanPerBulan, 15, 512) ?>;
        const statusKamarData = <?php echo json_encode($statusKamar, 15, 512) ?>;
        const jenisKosData = <?php echo json_encode($jenisKos, 15, 512) ?>;
        const statusKontrakData = <?php echo json_encode($statusKontrak, 15, 512) ?>;
        const reviewData = <?php echo json_encode($reviewData, 15, 512) ?>;
        const tipeKamarData = <?php echo json_encode($tipeKamar, 15, 512) ?>;

        // Chart 1: Pendapatan 6 Bulan Terakhir
        const pendapatanCtx = document.getElementById('pendapatanChart').getContext('2d');
        new Chart(pendapatanCtx, {
            type: 'line',
            data: {
                labels: pendapatanData.map(item => {
                    const [year, month] = item.bulan.split('-');
                    return new Date(year, month-1).toLocaleDateString('id-ID', { month: 'short' });
                }),
                datasets: [{
                    label: 'Pendapatan',
                    data: pendapatanData.map(item => item.total),
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 2,
                    pointBackgroundColor: 'rgb(59, 130, 246)',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.05)'
                        },
                        ticks: {
                            callback: function(value) {
                                if (value >= 1000000) return 'Rp ' + (value / 1000000).toFixed(1) + ' jt';
                                if (value >= 1000) return 'Rp ' + (value / 1000).toFixed(0) + ' rb';
                                return 'Rp ' + value;
                            }
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.05)'
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: '#e2e8f0',
                            font: {
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(30, 41, 59, 0.9)',
                        titleColor: '#e2e8f0',
                        bodyColor: '#cbd5e1',
                        borderColor: '#334155',
                        borderWidth: 1,
                        callbacks: {
                            label: function(context) {
                                return 'Pendapatan: Rp ' + context.parsed.y.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });

        // Chart 2: Status Kamar
        const statusKamarCtx = document.getElementById('statusKamarChart').getContext('2d');
        new Chart(statusKamarCtx, {
            type: 'doughnut',
            data: {
                labels: statusKamarData.map(item => {
                    return item.status_kamar === 'tersedia' ? 'Tersedia' :
                           item.status_kamar === 'terisi' ? 'Terisi' : 'Maintenance';
                }),
                datasets: [{
                    data: statusKamarData.map(item => item.jumlah),
                    backgroundColor: [
                        'rgba(34, 197, 94, 0.8)',   // Green
                        'rgba(59, 130, 246, 0.8)',  // Blue
                        'rgba(234, 179, 8, 0.8)'    // Yellow
                    ],
                    borderColor: [
                        'rgb(34, 197, 94)',
                        'rgb(59, 130, 246)',
                        'rgb(234, 179, 8)'
                    ],
                    borderWidth: 2,
                    hoverOffset: 15
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#e2e8f0',
                            padding: 20,
                            font: {
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(30, 41, 59, 0.9)',
                        titleColor: '#e2e8f0',
                        bodyColor: '#cbd5e1',
                        borderColor: '#334155'
                    }
                }
            }
        });

        // Chart 3: Jenis Kos
        const jenisKosCtx = document.getElementById('jenisKosChart').getContext('2d');
        new Chart(jenisKosCtx, {
            type: 'bar',
            data: {
                labels: jenisKosData.map(item => {
                    return item.jenis_kos === 'putra' ? 'Putra' : 
                           item.jenis_kos === 'putri' ? 'Putri' : 'Campuran';
                }),
                datasets: [{
                    label: 'Jumlah Kos',
                    data: jenisKosData.map(item => item.jumlah),
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.7)',   // Blue
                        'rgba(244, 63, 94, 0.7)',    // Pink
                        'rgba(139, 92, 246, 0.7)'    // Purple
                    ],
                    borderColor: [
                        'rgb(59, 130, 246)',
                        'rgb(244, 63, 94)',
                        'rgb(139, 92, 246)'
                    ],
                    borderWidth: 2,
                    borderRadius: 6,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.05)'
                        },
                        ticks: {
                            stepSize: 1
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(30, 41, 59, 0.9)',
                        titleColor: '#e2e8f0',
                        bodyColor: '#cbd5e1'
                    }
                }
            }
        });

        // Chart 4: Status Kontrak
        const statusKontrakCtx = document.getElementById('statusKontrakChart').getContext('2d');
        new Chart(statusKontrakCtx, {
            type: 'pie',
            data: {
                labels: statusKontrakData.map(item => {
                    const status = item.status_kontrak;
                    return status === 'aktif' ? 'Aktif' :
                           status === 'pending' ? 'Pending' :
                           status === 'selesai' ? 'Selesai' : 'Ditolak';
                }),
                datasets: [{
                    data: statusKontrakData.map(item => item.jumlah),
                    backgroundColor: [
                        'rgba(34, 197, 94, 0.8)',   // Green
                        'rgba(234, 179, 8, 0.8)',   // Yellow
                        'rgba(59, 130, 246, 0.8)',  // Blue
                        'rgba(239, 68, 68, 0.8)'    // Red
                    ],
                    borderColor: [
                        'rgb(34, 197, 94)',
                        'rgb(234, 179, 8)',
                        'rgb(59, 130, 246)',
                        'rgb(239, 68, 68)'
                    ],
                    borderWidth: 2,
                    hoverOffset: 15
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            color: '#e2e8f0',
                            padding: 15,
                            font: {
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(30, 41, 59, 0.9)',
                        titleColor: '#e2e8f0',
                        bodyColor: '#cbd5e1',
                        borderColor: '#334155'
                    }
                }
            }
        });

        // Chart 5: Review/Rating
        const reviewCtx = document.getElementById('reviewChart').getContext('2d');
        new Chart(reviewCtx, {
            type: 'bar',
            data: {
                labels: reviewData.map(item => `${item.rating} ⭐`),
                datasets: [{
                    label: 'Jumlah Review',
                    data: reviewData.map(item => item.jumlah),
                    backgroundColor: [
                        'rgba(239, 68, 68, 0.7)',    // 1 star - Red
                        'rgba(234, 179, 8, 0.7)',    // 2 stars - Yellow
                        'rgba(59, 130, 246, 0.7)',   // 3 stars - Blue
                        'rgba(34, 197, 94, 0.7)',    // 4 stars - Green
                        'rgba(139, 92, 246, 0.7)'    // 5 stars - Purple
                    ],
                    borderColor: [
                        'rgb(239, 68, 68)',
                        'rgb(234, 179, 8)',
                        'rgb(59, 130, 246)',
                        'rgb(34, 197, 94)',
                        'rgb(139, 92, 246)'
                    ],
                    borderWidth: 2,
                    borderRadius: 6,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.05)'
                        },
                        ticks: {
                            stepSize: 1
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(30, 41, 59, 0.9)',
                        titleColor: '#e2e8f0',
                        bodyColor: '#cbd5e1',
                        callbacks: {
                            label: function(context) {
                                return `${context.parsed.y} review`;
                            }
                        }
                    }
                }
            }
        });

        // Chart 6: Tipe Kamar
        const tipeKamarCtx = document.getElementById('tipeKamarChart').getContext('2d');
        new Chart(tipeKamarCtx, {
            type: 'doughnut',
            data: {
                labels: tipeKamarData.map(item => {
                    return item.tipe_kamar ? item.tipe_kamar.charAt(0).toUpperCase() + item.tipe_kamar.slice(1) : 'Tidak Diketahui';
                }),
                datasets: [{
                    data: tipeKamarData.map(item => item.jumlah),
                    backgroundColor: [
                        'rgba(6, 182, 212, 0.8)',   // Cyan
                        'rgba(168, 85, 247, 0.8)',  // Purple
                        'rgba(236, 72, 153, 0.8)',  // Pink
                        'rgba(20, 184, 166, 0.8)',   // Teal
                        'rgba(251, 146, 60, 0.8)'    // Orange
                    ],
                    borderColor: [
                        'rgb(6, 182, 212)',
                        'rgb(168, 85, 247)',
                        'rgb(236, 72, 153)',
                        'rgb(20, 184, 166)',
                        'rgb(251, 146, 60)'
                    ],
                    borderWidth: 2,
                    hoverOffset: 15
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#e2e8f0',
                            padding: 20,
                            font: {
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(30, 41, 59, 0.9)',
                        titleColor: '#e2e8f0',
                        bodyColor: '#cbd5e1',
                        borderColor: '#334155'
                    }
                }
            }
        });
    });
   
</script>

<style>
    /* Custom chart styles for dark theme */
    .chart-container {
        position: relative;
    }
    
    /* Custom scrollbar for tables */
    .overflow-x-auto::-webkit-scrollbar {
        height: 6px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-track {
        background: #1e293b;
        border-radius: 3px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-thumb {
        background: #475569;
        border-radius: 3px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
        background: #64748b;
    }
    
    /* Table hover effects */
    tbody tr {
        transition: background-color 0.2s ease;
    }
    
    tbody tr:hover {
        background-color: rgba(51, 65, 85, 0.3);
    }
    
    /* Card animations */
    .card-hover {
        transition: all 0.3s ease;
    }
    
    .card-hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
    }
    
    /* Insight cards hover */
    .grid > div:hover {
        transform: translateY(-3px);
        transition: transform 0.3s ease;
    }
</style>

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