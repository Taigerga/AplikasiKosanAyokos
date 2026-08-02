<?php $__env->startSection('title', 'Analisis - Admin AyoKos'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-4 md:p-6 lg:p-8 space-y-6 max-w-7xl mx-auto">
    <?php if(session('success')): ?>
        <div class="bg-emerald-400 border-2 border-black shadow-[3px_3px_0px_#000] text-black font-bold px-4 py-3">
            <div class="flex items-center"><i class="fas fa-check-circle mr-3"></i><?php echo e(session('success')); ?></div>
        </div>
    <?php endif; ?>

    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li><a href="<?php echo e(route('admin.dashboard')); ?>" class="text-sm font-bold text-gray-600 hover:text-black"><i class="fas fa-home mr-2"></i>Dashboard</a></li>
                <li><i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i></li>
                <li><span class="text-sm font-bold text-black">Analisis</span></li>
            </ol>
        </nav>
    </div>

    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-black text-black">
                    <i class="fas fa-chart-bar mr-3"></i>Analisis Platform
                </h1>
                <p class="text-gray-700 font-bold">Analisis dan visualisasi data seluruh platform AyoKos</p>
            </div>
            <div class="flex gap-3">
                <button id="exportPdfBtn"
                    class="inline-flex items-center px-4 py-2.5 bg-sky-400 hover:bg-sky-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition text-sm">
                    <i class="fas fa-file-pdf mr-2"></i>Export PDF
                </button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-5">
            <div class="flex items-center">
                <div class="p-3 bg-gray-200 border-2 border-black mr-4">
                    <i class="fas fa-coins text-black text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-black text-gray-600">Pendapatan Platform</p>
                    <p class="text-2xl font-black text-black">Rp <?php echo e(number_format($totalPendapatan, 0, ',', '.')); ?></p>
                </div>
            </div>
        </div>
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-5">
            <div class="flex items-center">
                <div class="p-3 bg-gray-200 border-2 border-black mr-4">
                    <i class="fas fa-home text-black text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-black text-gray-600">Total Kos</p>
                    <p class="text-2xl font-black text-black"><?php echo e($totalKos); ?></p>
                </div>
            </div>
        </div>
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-5">
            <div class="flex items-center">
                <div class="p-3 bg-gray-200 border-2 border-black mr-4">
                    <i class="fas fa-headset text-black text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-black text-gray-600">Aduan Terbuka</p>
                    <p class="text-2xl font-black text-black"><?php echo e($totalAduanTerbuka); ?></p>
                </div>
            </div>
        </div>
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-5">
            <div class="flex items-center">
                <div class="p-3 bg-gray-200 border-2 border-black mr-4">
                    <i class="fas fa-file-contract text-black text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-black text-gray-600">Kontrak Aktif</p>
                    <p class="text-2xl font-black text-black"><?php echo e($totalKontrakAktif); ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-black text-black flex items-center">
                    <i class="fas fa-money-bill-wave text-sky-600 mr-3"></i>
                    Pendapatan Platform (12 Bulan)
                </h2>
            </div>
            <div class="h-72">
                <canvas id="pendapatanChart"></canvas>
            </div>
        </div>

        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-black text-black flex items-center">
                    <i class="fas fa-home text-emerald-600 mr-3"></i>
                    Status Kos
                </h2>
            </div>
            <div class="h-72">
                <canvas id="statusKosChart"></canvas>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-black text-black flex items-center">
                    <i class="fas fa-headset text-rose-600 mr-3"></i>
                    Aduan per Status
                </h2>
            </div>
            <div class="h-72">
                <canvas id="aduanChart"></canvas>
            </div>
        </div>

        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-black text-black flex items-center">
                    <i class="fas fa-users text-blue-600 mr-3"></i>
                    Pertumbuhan User (12 Bulan)
                </h2>
            </div>
            <div class="h-72">
                <canvas id="userGrowthChart"></canvas>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-black text-black flex items-center">
                    <i class="fas fa-chart-pie text-purple-600 mr-3"></i>
                    Sebaran Role User
                </h2>
            </div>
            <div class="h-72">
                <canvas id="sebaranRoleChart"></canvas>
            </div>
        </div>

        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-black text-black flex items-center">
                    <i class="fas fa-trophy text-yellow-600 mr-3"></i>
                    Top Pemilik by Revenue
                </h2>
            </div>
            <div class="h-72">
                <canvas id="topPemilikChart"></canvas>
            </div>
        </div>
    </div>

    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
        <h2 class="text-xl font-black text-black mb-6 flex items-center">
            <i class="fas fa-lightbulb text-yellow-600 mr-3"></i>
            Insight Platform
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <?php
                $pemilikTop = $topPemilik->first();
                $pendapatanRata = $pendapatanPerBulan->avg('total') ?? 0;
                $totalUser = array_sum($sebaranRole);
            ?>
            <div class="bg-gray-100 border-2 border-black p-4">
                <div class="flex items-center mb-3">
                    <div class="w-10 h-10 bg-yellow-400 border-2 border-black flex items-center justify-center mr-3">
                        <i class="fas fa-trophy text-black"></i>
                    </div>
                    <h3 class="font-black text-black">Pemilik Teratas</h3>
                </div>
                <p class="text-sm text-gray-600">
                    <span class="font-black text-black"><?php echo e($pemilikTop->nama ?? '-'); ?></span>
                    dengan pendapatan
                    <span class="font-black text-black">Rp <?php echo e(number_format($pemilikTop->total_pendapatan ?? 0, 0, ',', '.')); ?></span>
                </p>
            </div>
            <div class="bg-gray-100 border-2 border-black p-4">
                <div class="flex items-center mb-3">
                    <div class="w-10 h-10 bg-emerald-400 border-2 border-black flex items-center justify-center mr-3">
                        <i class="fas fa-chart-line text-black"></i>
                    </div>
                    <h3 class="font-black text-black">Rata-rata Bulanan</h3>
                </div>
                <p class="text-sm text-gray-600">
                    Pendapatan platform rata-rata per bulan:
                    <span class="font-black text-black">Rp <?php echo e(number_format($pendapatanRata, 0, ',', '.')); ?></span>
                </p>
            </div>
            <div class="bg-gray-100 border-2 border-black p-4">
                <div class="flex items-center mb-3">
                    <div class="w-10 h-10 bg-purple-400 border-2 border-black flex items-center justify-center mr-3">
                        <i class="fas fa-users text-black"></i>
                    </div>
                    <h3 class="font-black text-black">Total Pengguna</h3>
                </div>
                <p class="text-sm text-gray-600">
                    <span class="font-black text-black"><?php echo e($totalUser); ?></span> pengguna terdaftar
                    (<?php echo e($sebaranRole['admin']); ?> admin, <?php echo e($sebaranRole['pemilik']); ?> pemilik, <?php echo e($sebaranRole['penghuni']); ?> penghuni)
                </p>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    if (typeof window.initAdminCharts === 'function') {
        window.initAdminCharts({
            pendapatanPerBulan: <?php echo json_encode($pendapatanPerBulan, 15, 512) ?>,
            statusKos: <?php echo json_encode($statusKos, 15, 512) ?>,
            aduanPerStatus: <?php echo json_encode($aduanPerStatus, 15, 512) ?>,
            userGrowth: <?php echo json_encode($userGrowth, 15, 512) ?>,
            sebaranRole: <?php echo json_encode($sebaranRole, 15, 512) ?>,
            topPemilik: <?php echo json_encode($topPemilik, 15, 512) ?>,
        });
    }
});
</script>

<div id="adminAnalisisData"
     data-nama="<?php echo e(auth()->user()->nama ?? 'Admin'); ?>"
     data-tanggal="<?php echo e(now()->format('d F Y')); ?>"
     style="display: none;">
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/admin/analisis/index.blade.php ENDPATH**/ ?>