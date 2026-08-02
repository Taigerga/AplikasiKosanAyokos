<!-- Dashboard Header -->
<header class="bg-white border-b-4 border-black h-16 flex items-center sticky top-0 z-[1002]">
    <div id="dashboardHeader" class="flex-1 px-4 transition-all duration-300 ease-in-out">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <!-- Mobile Toggle -->
                <button id="mobileSidebarToggle" class="md:hidden text-black hover:text-yellow-500">
                    <i class="fas fa-bars text-xl"></i>
                </button>

                <!-- Logo and Title -->
                <div class="hidden md:flex items-center gap-3">
                    <div class="w-10 h-10 bg-yellow-400 border-2 border-black shadow-[2px_2px_0px_#000] flex items-center justify-center">
                        <i class="fas fa-user-shield text-black"></i>
                    </div>
                    <div>
                        <h1 class="text-lg font-black text-black">Dashboard Admin</h1>
                        <p class="text-xs font-bold text-gray-500">Kelola sistem AyoKos</p>
                    </div>
                </div>
            </div>

            <!-- Right Side -->
            <div class="flex items-center gap-4">
                <!-- Profile Menu -->
                <div class="profile-menu relative">
                    <?php $adminUser = auth()->user(); ?>
                    <button class="flex items-center gap-2 p-2 border-2 border-transparent hover:border-black transition-colors">
                        <div class="w-8 h-8 bg-rose-400 border-2 border-black flex items-center justify-center">
                            <span class="text-white font-black"><?php echo e(substr($adminUser->admin->nama ?? $adminUser->username, 0, 1)); ?></span>
                        </div>
                        <span class="text-sm font-bold text-black hidden md:inline"><?php echo e($adminUser->admin->nama ?? $adminUser->username); ?></span>
                        <i class="fas fa-chevron-down text-black text-xs"></i>
                    </button>

                    <!-- Profile Dropdown -->
                    <div class="profile-dropdown absolute right-0 w-64 bg-white border-2 border-black shadow-[4px_4px_0px_#000] z-[1001]">
                        <div class="px-4 py-3 border-b-2 border-black">
                            <p class="text-sm font-black text-black"><?php echo e($adminUser->admin->nama ?? $adminUser->username); ?></p>
                            <p class="text-xs font-medium text-gray-600 truncate"><?php echo e($adminUser->admin->email ?? '-'); ?></p>
                        </div>

                        <div class="py-1">
                            <a href="<?php echo e(route('admin.dashboard')); ?>"
                                class="flex items-center px-4 py-2.5 text-gray-700 hover:bg-yellow-100 font-bold text-sm transition-colors">
                                <i class="fas fa-tachometer-alt w-5 mr-3 text-rose-500"></i>
                                <span>Dashboard</span>
                            </a>
                            <a href="<?php echo e(route('admin.users.index')); ?>"
                                class="flex items-center px-4 py-2.5 text-gray-700 hover:bg-yellow-100 font-bold text-sm transition-colors">
                                <i class="fas fa-users w-5 mr-3 text-blue-500"></i>
                                <span>Kelola User</span>
                            </a>
                            <a href="<?php echo e(route('admin.kos.index')); ?>"
                                class="flex items-center px-4 py-2.5 text-gray-700 hover:bg-yellow-100 font-bold text-sm transition-colors">
                                <i class="fas fa-home w-5 mr-3 text-emerald-500"></i>
                                <span>Kelola Kos</span>
                            </a>

                            <a href="<?php echo e(route('admin.analisis.index')); ?>"
                                class="flex items-center px-4 py-2.5 text-gray-700 hover:bg-yellow-100 font-bold text-sm transition-colors">
                                <i class="fas fa-chart-pie w-5 mr-3 text-purple-500"></i>
                                <span>Analisis</span>
                            </a>
                            <a href="<?php echo e(route('admin.laporan.index')); ?>"
                                class="flex items-center px-4 py-2.5 text-gray-700 hover:bg-yellow-100 font-bold text-sm transition-colors">
                                <i class="fas fa-chart-bar w-5 mr-3 text-orange-500"></i>
                                <span>Laporan</span>
                            </a>
                        </div>

                        <div class="border-t-2 border-black pt-1">
                            <button type="button"
                                class="flex items-center w-full text-left px-4 py-2.5 text-red-500 hover:bg-red-50 font-bold text-sm transition-colors"
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
        class="bg-black w-64 md:w-64 flex-shrink-0 fixed md:relative h-full md:h-auto z-[1005] -translate-x-full md:translate-x-0 transition-all duration-300 ease-in-out overflow-y-auto">

        <!-- Sidebar Header -->
        <div class="p-4 border-b-2 border-gray-800">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-yellow-400 border-2 border-black flex items-center justify-center">
                    <i class="fas fa-user-shield text-black text-sm"></i>
                </div>
                <span class="logo-text font-black text-white">AyoKos</span>
            </div>
        </div>

        <nav class="p-4">
            <ul class="space-y-1">
                <li>
                    <a href="<?php echo e(route('admin.dashboard')); ?>"
                        class="flex items-center gap-3 px-3 py-3 font-bold text-sm <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-yellow-400 text-black border-l-4 border-yellow-400' : 'text-gray-400 hover:bg-gray-800 hover:text-white border-l-4 border-transparent'); ?>">
                        <i class="fas fa-tachometer-alt w-5"></i>
                        <span class="sidebar-text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('admin.users.index')); ?>"
                        class="flex items-center gap-3 px-3 py-3 font-bold text-sm <?php echo e(request()->routeIs('admin.users.*') ? 'bg-yellow-400 text-black border-l-4 border-yellow-400' : 'text-gray-400 hover:bg-gray-800 hover:text-white border-l-4 border-transparent'); ?>">
                        <i class="fas fa-users w-5"></i>
                        <span class="sidebar-text">Kelola User</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('admin.kos.index')); ?>"
                        class="flex items-center gap-3 px-3 py-3 font-bold text-sm <?php echo e(request()->routeIs('admin.kos.*') ? 'bg-yellow-400 text-black border-l-4 border-yellow-400' : 'text-gray-400 hover:bg-gray-800 hover:text-white border-l-4 border-transparent'); ?>">
                        <i class="fas fa-home w-5"></i>
                        <span class="sidebar-text">Kelola Kos</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo e(route('admin.reviews.index')); ?>"
                        class="flex items-center gap-3 px-3 py-3 font-bold text-sm <?php echo e(request()->routeIs('admin.reviews.*') ? 'bg-yellow-400 text-black border-l-4 border-yellow-400' : 'text-gray-400 hover:bg-gray-800 hover:text-white border-l-4 border-transparent'); ?>">
                        <i class="fas fa-star w-5"></i>
                        <span class="sidebar-text">Moderasi Review</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('admin.analisis.index')); ?>"
                        class="flex items-center gap-3 px-3 py-3 font-bold text-sm <?php echo e(request()->routeIs('admin.analisis.*') ? 'bg-yellow-400 text-black border-l-4 border-yellow-400' : 'text-gray-400 hover:bg-gray-800 hover:text-white border-l-4 border-transparent'); ?>">
                        <i class="fas fa-chart-pie w-5"></i>
                        <span class="sidebar-text">Analisis</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('admin.laporan.index')); ?>"
                        class="flex items-center gap-3 px-3 py-3 font-bold text-sm <?php echo e(request()->routeIs('admin.laporan.*') ? 'bg-yellow-400 text-black border-l-4 border-yellow-400' : 'text-gray-400 hover:bg-gray-800 hover:text-white border-l-4 border-transparent'); ?>">
                        <i class="fas fa-chart-bar w-5"></i>
                        <span class="sidebar-text">Laporan</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('admin.aduan.index')); ?>"
                        class="flex items-center gap-3 px-3 py-3 font-bold text-sm <?php echo e(request()->routeIs('admin.aduan.*') ? 'bg-yellow-400 text-black border-l-4 border-yellow-400' : 'text-gray-400 hover:bg-gray-800 hover:text-white border-l-4 border-transparent'); ?>">
                        <i class="fas fa-headset w-5"></i>
                        <span class="sidebar-text">Kelola Aduan</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('admin.data-pemilik.index')); ?>"
                        class="flex items-center gap-3 px-3 py-3 font-bold text-sm <?php echo e(request()->routeIs('admin.data-pemilik.*') ? 'bg-yellow-400 text-black border-l-4 border-yellow-400' : 'text-gray-400 hover:bg-gray-800 hover:text-white border-l-4 border-transparent'); ?>">
                        <i class="fas fa-user-tie w-5"></i>
                        <span class="sidebar-text">Data Pemilik</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('admin.data-penghuni.index')); ?>"
                        class="flex items-center gap-3 px-3 py-3 font-bold text-sm <?php echo e(request()->routeIs('admin.data-penghuni.*') ? 'bg-yellow-400 text-black border-l-4 border-yellow-400' : 'text-gray-400 hover:bg-gray-800 hover:text-white border-l-4 border-transparent'); ?>">
                        <i class="fas fa-user w-5"></i>
                        <span class="sidebar-text">Data Penghuni</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('admin.keuangan.index')); ?>"
                        class="flex items-center gap-3 px-3 py-3 font-bold text-sm <?php echo e(request()->routeIs('admin.keuangan.*') ? 'bg-yellow-400 text-black border-l-4 border-yellow-400' : 'text-gray-400 hover:bg-gray-800 hover:text-white border-l-4 border-transparent'); ?>">
                        <i class="fas fa-coins w-5"></i>
                        <span class="sidebar-text">Keuangan Platform</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- System Stats -->
        <div class="p-4 border-t-2 border-gray-800">
            <div class="text-xs font-bold text-gray-500 mb-2 uppercase tracking-wider">Statistik Sistem</div>
            <div class="space-y-2">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-400 font-medium">Total User</span>
                    <span class="font-black text-white"><?php echo e(\App\Models\User::count()); ?></span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-400 font-medium">Total Kos</span>
                    <span class="font-black text-emerald-400"><?php echo e(\App\Models\Kos::count()); ?></span>
                </div>
            </div>
        </div>
    </aside>

    <!-- Sidebar Toggle Button (Desktop) -->
    <button id="desktopSidebarToggle" onclick="toggleSidebar()"
        class="hidden md:flex fixed top-20 left-64 z-[1004] bg-black border-2 border-black text-white hover:bg-yellow-400 hover:text-black p-1 items-center justify-center w-7 h-10 transition-all duration-300">
        <i id="sidebarToggleIcon" class="fas fa-chevron-left text-xs"></i>
    </button>

    <!-- Main Content -->
    <main id="mainContent" class="flex-1 min-w-0 w-full overflow-x-hidden transition-all duration-300 ease-in-out bg-gray-50">
        <div class="p-4 md:p-6">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </main>
</div><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/layouts/partials/dashboard-admin.blade.php ENDPATH**/ ?>