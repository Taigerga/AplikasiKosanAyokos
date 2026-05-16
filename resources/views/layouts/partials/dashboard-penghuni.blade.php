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
                        <i class="fas fa-user text-black"></i>
                    </div>
                    <div>
                        <h1 class="text-lg font-black text-black">Dashboard Penghuni</h1>
                        <p class="text-xs font-bold text-gray-500">Kelola hunian Anda</p>
                    </div>
                </div>
            </div>

            <!-- Right Side -->
            <div class="flex items-center gap-4">
                <!-- Notifications -->
                <a href="{{ route('notifications.index') }}" class="relative p-2 text-black hover:text-yellow-500 transition-colors">
                    <i class="fas fa-bell text-lg"></i>
                    <span id="notifBadge" class="absolute -top-0.5 -right-0.5 w-4 h-4 bg-red-500 border border-black text-[10px] text-white font-black flex items-center justify-center hidden"></span>
                </a>

                <!-- Profile Menu -->
                <div class="profile-menu relative">
                    @php $user = auth()->user(); @endphp
                    <button class="flex items-center gap-2 p-2 border-2 border-transparent hover:border-black transition-colors">
                        @if($user && $user->penghuni && $user->penghuni->foto_profil)
                            <img src="{{ asset('storage/' . $user->penghuni->foto_profil) }}"
                                 alt="{{ $user->penghuni->nama ?? $user->nama }}"
                                 class="w-8 h-8 object-cover border-2 border-black">
                        @else
                            <div class="w-8 h-8 bg-emerald-400 border-2 border-black flex items-center justify-center">
                                <span class="text-white font-black">{{ ($user->penghuni->nama ?? $user->nama) ? substr($user->penghuni->nama ?? $user->nama, 0, 1) : '?' }}</span>
                            </div>
                        @endif
                        <span class="text-sm font-bold text-black hidden md:inline">{{ $user->penghuni->nama ?? $user->nama ?? 'User' }}</span>
                        <i class="fas fa-chevron-down text-black text-xs"></i>
                    </button>

                    <!-- Profile Dropdown -->
                    <div class="profile-dropdown absolute right-0 w-64 bg-white border-2 border-black shadow-[4px_4px_0px_#000] z-[1001]">
                        <div class="px-4 py-3 border-b-2 border-black">
                            <p class="text-sm font-black text-black">{{ $user->penghuni->nama ?? $user->nama ?? 'User' }}</p>
                            <p class="text-xs font-medium text-gray-600 truncate">{{ $user->penghuni->email ?? $user->email ?? '-' }}</p>
                        </div>

                        <div class="py-1">
                            <a href="{{ route('penghuni.dashboard') }}"
                                class="flex items-center px-4 py-2.5 text-gray-700 hover:bg-yellow-100 font-bold text-sm transition-colors">
                                <i class="fas fa-tachometer-alt w-5 mr-3 text-emerald-500"></i>
                                <span>Dashboard</span>
                            </a>
                            <a href="{{ route('penghuni.kontrak.index') }}"
                                class="flex items-center px-4 py-2.5 text-gray-700 hover:bg-yellow-100 font-bold text-sm transition-colors">
                                <i class="fas fa-file-contract w-5 mr-3 text-emerald-500"></i>
                                <span>Kontrak Saya</span>
                            </a>
                            <a href="{{ route('penghuni.pembayaran.index') }}"
                                class="flex items-center px-4 py-2.5 text-gray-700 hover:bg-yellow-100 font-bold text-sm transition-colors">
                                <i class="fas fa-credit-card w-5 mr-3 text-purple-500"></i>
                                <span>Pembayaran</span>
                            </a>
                            <a href="{{ route('penghuni.reviews.history') }}"
                                class="flex items-center px-4 py-2.5 text-gray-700 hover:bg-yellow-100 font-bold text-sm transition-colors">
                                <i class="fas fa-star w-5 mr-3 text-yellow-500"></i>
                                <span>Review Saya</span>
                            </a>
                            <a href="{{ route('penghuni.profile.show') }}"
                                class="flex items-center px-4 py-2.5 text-gray-700 hover:bg-yellow-100 font-bold text-sm transition-colors">
                                <i class="fas fa-user-cog w-5 mr-3 text-emerald-500"></i>
                                <span>Profil Saya</span>
                            </a>
                            <a href="{{ route('public.kos.peta') }}"
                                class="flex items-center px-4 py-2.5 text-gray-700 hover:bg-yellow-100 font-bold text-sm transition-colors">
                                <i class="fas fa-map-marked-alt w-5 mr-3 text-orange-500"></i>
                                <span>Peta Kos</span>
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

        <nav class="p-4 pt-8">
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('penghuni.dashboard') }}"
                        class="flex items-center gap-3 px-3 py-3 font-bold text-sm {{ request()->routeIs('penghuni.dashboard') ? 'bg-yellow-400 text-black border-l-4 border-yellow-400' : 'text-gray-400 hover:bg-gray-800 hover:text-white border-l-4 border-transparent' }}">
                        <i class="fas fa-tachometer-alt w-5"></i>
                        <span class="sidebar-text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('penghuni.cari-kos') }}"
                        class="flex items-center gap-3 px-3 py-3 font-bold text-sm {{ request()->routeIs('penghuni.cari-kos') ? 'bg-yellow-400 text-black border-l-4 border-yellow-400' : 'text-gray-400 hover:bg-gray-800 hover:text-white border-l-4 border-transparent' }}">
                        <i class="fas fa-search w-5"></i>
                        <span class="sidebar-text">Cari Kos</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('penghuni.kontrak.index') }}"
                        class="flex items-center gap-3 px-3 py-3 font-bold text-sm {{ request()->routeIs('penghuni.kontrak.*') ? 'bg-yellow-400 text-black border-l-4 border-yellow-400' : 'text-gray-400 hover:bg-gray-800 hover:text-white border-l-4 border-transparent' }}">
                        <i class="fas fa-file-contract w-5"></i>
                        <span class="sidebar-text">Kontrak Saya</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('penghuni.pembayaran.index') }}"
                        class="flex items-center gap-3 px-3 py-3 font-bold text-sm {{ request()->routeIs('penghuni.pembayaran.*') ? 'bg-yellow-400 text-black border-l-4 border-yellow-400' : 'text-gray-400 hover:bg-gray-800 hover:text-white border-l-4 border-transparent' }}">
                        <i class="fas fa-credit-card w-5"></i>
                        <span class="sidebar-text">Pembayaran</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('penghuni.reviews.history') }}"
                        class="flex items-center gap-3 px-3 py-3 font-bold text-sm {{ request()->routeIs('penghuni.reviews.*') ? 'bg-yellow-400 text-black border-l-4 border-yellow-400' : 'text-gray-400 hover:bg-gray-800 hover:text-white border-l-4 border-transparent' }}">
                        <i class="fas fa-star w-5"></i>
                        <span class="sidebar-text">Review Saya</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('penghuni.analisis.index') }}"
                        class="flex items-center gap-3 px-3 py-3 font-bold text-sm {{ request()->routeIs('penghuni.analisis.*') ? 'bg-yellow-400 text-black border-l-4 border-yellow-400' : 'text-gray-400 hover:bg-gray-800 hover:text-white border-l-4 border-transparent' }}">
                        <i class="fas fa-chart-bar w-5"></i>
                        <span class="sidebar-text">Analisis Saya</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Quick Stats -->
        <div class="p-4 border-t-2 border-gray-800 mt-4">
            <div class="text-xs font-bold text-gray-500 mb-2 uppercase tracking-wider">Status Anda</div>
            <div class="space-y-2">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-400 font-medium">Kontrak Aktif</span>
                    @php
                        $activeContracts = $user->penghuni?->kontrakSewa()->where('status_kontrak', 'aktif')->count() ?? 0;
                    @endphp
                    <span class="font-black {{ $activeContracts > 0 ? 'text-emerald-400' : 'text-yellow-400' }}">
                        {{ $activeContracts }}
                    </span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-400 font-medium">Status</span>
                    <span class="font-black capitalize
                        {{ ($user->penghuni?->status_penghuni ?? '') == 'aktif' ? 'text-emerald-400' :
    (($user->penghuni?->status_penghuni ?? '') == 'calon' ? 'text-yellow-400' : 'text-red-400') }}">
                        {{ $user->penghuni?->status_penghuni ?? 'N/A' }}
                    </span>
                </div>
            </div>
        </div>
    </aside>

    <!-- Sidebar Toggle Button (Desktop) -->
    <button id="desktopSidebarToggle" onclick="toggleSidebar()"
        class="hidden md:flex fixed top-1/2 -translate-y-1/2 left-64 z-[1004] bg-black border-2 border-black text-white hover:bg-yellow-400 hover:text-black p-1 items-center justify-center w-7 h-10 transition-all duration-300">
        <i id="sidebarToggleIcon" class="fas fa-chevron-left text-xs"></i>
    </button>

    <!-- Main Content -->
    <main id="mainContent" class="flex-1 transition-all duration-300 ease-in-out bg-gray-50">
        @yield('content')
    </main>
</div>