<!-- Dashboard Header -->
<header class="bg-slate-900 border-b border-slate-700 h-16 flex items-center sticky top-0 z-[1002]">
    <div id="dashboardHeader" class="flex-1 px-4 transition-all duration-300 ease-in-out">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <!-- Mobile Toggle -->
                <button id="mobileSidebarToggle" class="md:hidden text-slate-400 hover:text-slate-800">
                    <i class="fas fa-bars text-xl"></i>
                </button>

                <!-- Logo and Title -->
                <div class="hidden md:flex items-center gap-3">
                    <div
                        class="w-10 h-10 bg-white/10 backdrop-blur-md rounded-lg flex items-center justify-center">
                        <i class="fas fa-user text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold text-white">Dashboard Penghuni</h1>
                        <p class="text-xs text-slate-400">Kelola hunian Anda</p>
                    </div>
                </div>
            </div>

            <!-- Right Side -->
            <div class="flex items-center gap-4">
                <!-- Notifications -->
                <button class="relative p-2 text-slate-400 hover:text-slate-800">
                    <i class="fas fa-bell text-lg"></i>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>

                <!-- Profile Menu -->
                <div class="profile-menu relative">
                    <?php $user = auth('penghuni')->user(); ?>
                    <button class="flex items-center gap-2 p-2 rounded-lg hover:bg-slate-700">
                        <?php if($user && $user->penghuni && $user->penghuni->foto_profil): ?>
                            <img src="<?php echo e(asset('storage/' . $user->penghuni->foto_profil)); ?>"
                                 alt="<?php echo e($user->penghuni->nama ?? $user->nama); ?>"
                                 class="w-8 h-8 rounded-full object-cover border-2 border-slate-400">
                        <?php else: ?>
                            <div
                                class="w-8 h-8 bg-gradient-to-br from-blue-400 to-indigo-400 rounded-full flex items-center justify-center">
                                <span
                                    class="text-white font-medium"><?php echo e(($user->penghuni->nama ?? $user->nama) ? substr($user->penghuni->nama ?? $user->nama, 0, 1) : '?'); ?></span>
                            </div>
                        <?php endif; ?>
                        <span
                            class="text-sm font-medium text-white hidden md:inline"><?php echo e($user->penghuni->nama ?? $user->nama ?? 'User'); ?></span>
                        <i class="fas fa-chevron-down text-white text-xs"></i>
                    </button>

                    <!-- Profile Dropdown -->
                    <div
                        class="profile-dropdown absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-2xl border border-slate-200 py-2 z-[1001]">
                        <!-- User Info -->
                        <div class="px-4 py-3 border-b border-slate-200">
                            <p class="text-sm font-semibold text-slate-800"><?php echo e($user->penghuni->nama ?? $user->nama ?? 'User'); ?></p>
                            <p class="text-xs text-slate-500 truncate"><?php echo e($user->penghuni->email ?? $user->email ?? '-'); ?></p>
                        </div>

                        <!-- Menu Items -->
                        <div class="py-2">
                            <a href="<?php echo e(route('penghuni.dashboard')); ?>"
                                class="flex items-center px-4 py-2.5 text-slate-700 hover:bg-slate-100 hover:text-slate-900 transition-colors">
                                <i class="fas fa-tachometer-alt w-5 mr-3 text-blue-500"></i>
                                <span>Dashboard</span>
                            </a>
                            <a href="<?php echo e(route('penghuni.kontrak.index')); ?>"
                                class="flex items-center px-4 py-2.5 text-slate-700 hover:bg-slate-100 hover:text-slate-900 transition-colors">
                                <i class="fas fa-file-contract w-5 mr-3 text-blue-500"></i>
                                <span>Kontrak Saya</span>
                            </a>
                            <a href="<?php echo e(route('penghuni.pembayaran.index')); ?>"
                                class="flex items-center px-4 py-2.5 text-slate-700 hover:bg-slate-100 hover:text-slate-900 transition-colors">
                                <i class="fas fa-credit-card w-5 mr-3 text-purple-500"></i>
                                <span>Pembayaran</span>
                            </a>
                            <a href="<?php echo e(route('penghuni.reviews.history')); ?>"
                                class="flex items-center px-4 py-2.5 text-slate-700 hover:bg-slate-100 hover:text-slate-900 transition-colors">
                                <i class="fas fa-star w-5 mr-3 text-yellow-500"></i>
                                <span>Review Saya</span>
                            </a>
                            <a href="<?php echo e(route('penghuni.profile.show')); ?>"
                                class="flex items-center px-4 py-2.5 text-slate-700 hover:bg-slate-100 hover:text-slate-900 transition-colors">
                                <i class="fas fa-user-cog w-5 mr-3 text-blue-500"></i>
                                <span>Profil Saya</span>
                            </a>
                            <a href="<?php echo e(route('public.kos.peta')); ?>"
                                class="flex items-center px-4 py-2.5 text-slate-700 hover:bg-slate-100 hover:text-slate-900 transition-colors">
                                <i class="fas fa-map-marked-alt w-5 mr-3 text-orange-500"></i>
                                <span>Peta Kos</span>
                            </a>
                        </div>

                        <!-- Logout -->
                        <div class="border-t border-slate-200 pt-2">
                            <button type="button"
                                class="flex items-center w-full text-left px-4 py-2.5 text-red-500 hover:bg-red-50 transition-colors"
                                onclick="showLogoutModal()">
                                <i class="fas fa-sign-out-alt w-5 mr-3"></i>
                                <span>Logout</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Layout -->
<div class="flex min-h-[calc(100vh-64px)] relative">
    <!-- Sidebar -->
    <aside id="sidebar"
        class="bg-slate-900 border-r border-slate-700 w-64 md:w-64 flex-shrink-0 fixed md:relative h-full md:h-auto z-[1005] -translate-x-full md:translate-x-0 transition-all duration-300 ease-in-out">

        <!-- Navigation -->
        <nav class="p-4">
            <ul class="space-y-1">
                <li>
                    <a href="<?php echo e(route('penghuni.dashboard')); ?>"
                        class="flex items-center gap-3 px-3 py-3 rounded-lg font-medium <?php echo e(request()->routeIs('penghuni.dashboard') ? 'bg-blue-50 text-blue-600 border-l-4 border-blue-500' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-100'); ?>">
                        <i class="fas fa-tachometer-alt w-5"></i>
                        <span class="sidebar-text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('penghuni.cari-kos')); ?>"
                        class="flex items-center gap-3 px-3 py-3 rounded-lg font-medium <?php echo e(request()->routeIs('penghuni.cari-kos') ? 'bg-blue-50 text-blue-600 border-l-4 border-blue-500' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-100'); ?>">
                        <i class="fas fa-search w-5"></i>
                        <span class="sidebar-text">Cari Kos</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('penghuni.kontrak.index')); ?>"
                        class="flex items-center gap-3 px-3 py-3 rounded-lg font-medium <?php echo e(request()->routeIs('penghuni.kontrak.*') ? 'bg-blue-50 text-blue-600 border-l-4 border-blue-500' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-100'); ?>">
                        <i class="fas fa-file-contract w-5"></i>
                        <span class="sidebar-text">Kontrak Saya</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('penghuni.pembayaran.index')); ?>"
                        class="flex items-center gap-3 px-3 py-3 rounded-lg font-medium <?php echo e(request()->routeIs('penghuni.pembayaran.*') ? 'bg-blue-50 text-blue-600 border-l-4 border-blue-500' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-100'); ?>">
                        <i class="fas fa-credit-card w-5"></i>
                        <span class="sidebar-text">Pembayaran</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('penghuni.reviews.history')); ?>"
                        class="flex items-center gap-3 px-3 py-3 rounded-lg font-medium <?php echo e(request()->routeIs('penghuni.reviews.*') ? 'bg-blue-50 text-blue-600 border-l-4 border-blue-500' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-100'); ?>">
                        <i class="fas fa-star w-5"></i>
                        <span class="sidebar-text">Review Saya</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('penghuni.analisis.index')); ?>"
                        class="flex items-center gap-3 px-3 py-3 rounded-lg font-medium <?php echo e(request()->routeIs('penghuni.analisis.*') ? 'bg-blue-50 text-blue-600 border-l-4 border-blue-500' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-100'); ?>">
                        <i class="fas fa-chart-bar w-5"></i>
                        <span class="sidebar-text">Analisis Saya</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Quick Stats -->
        <div class="p-4 border-t">
            <div class="text-xs text-slate-500 mb-2">Status Anda</div>
                <div class="space-y-2">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-slate-500">Kontrak Aktif</span>
                    <?php
                        $activeContracts = $user->penghuni?->kontrakSewa()->where('status_kontrak', 'aktif')->count() ?? 0;
                    ?>
                    <span class="font-bold <?php echo e($activeContracts > 0 ? 'text-emerald-400' : 'text-yellow-400'); ?>">
                        <?php echo e($activeContracts); ?>

                    </span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-slate-500">Status</span>
                    <span class="font-bold capitalize
                        <?php echo e(($user->penghuni?->status_penghuni ?? '') == 'aktif' ? 'text-emerald-400' :
    (($user->penghuni?->status_penghuni ?? '') == 'calon' ? 'text-yellow-400' : 'text-red-400')); ?>">
                        <?php echo e($user->penghuni?->status_penghuni ?? 'N/A'); ?>

                    </span>
                </div>
            </div>
        </div>
    </aside>

    <!-- Sidebar Toggle Button (Desktop) -->
    <button id="desktopSidebarToggle" onclick="toggleSidebar()"
        class="hidden md:flex fixed top-1/2 -translate-y-1/2 left-64 z-[1004] bg-white border border-slate-200 text-slate-400 hover:text-slate-800 p-1 rounded-r-lg shadow-lg items-center justify-center w-8 h-10 transition-all duration-300">
        <i id="sidebarToggleIcon" class="fas fa-chevron-left text-xs"></i>
    </button>

    <!-- Main Content -->
    <main id="mainContent" class="flex-1 transition-all duration-300 ease-in-out bg-slate-700">

            <?php echo $__env->yieldContent('content'); ?>

    </main>
</div><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/layouts/partials/dashboard-penghuni.blade.php ENDPATH**/ ?>