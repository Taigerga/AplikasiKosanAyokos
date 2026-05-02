<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AyoKos')</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Vite CSS -->
    @vite(['resources/css/app.css'])

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <!-- AOS Animation CSS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />

    <style>
        :root {
            --sidebar-width: 260px;
            --sidebar-collapsed-width: 70px;
            --header-height: 64px;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.7;
            background-color: #fafafa;
            color: #1e293b;
        }

        /* Smooth transitions */
        * {
            transition: background-color 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 8px;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 8px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Card hover effects */
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 40px -12px rgba(0, 0, 0, 0.1);
        }

        /* Navbar Public - Overlay Mulus */
        #publicNavbar {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 50;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            background-color: transparent;
            border-bottom: 1px solid transparent;
            padding: 0.75rem 0;
        }

        #publicNavbar.navbar-scrolled {
            position: fixed;
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 2px 24px rgba(0, 0, 0, 0.06);
            padding: 0.5rem 0;
        }

        /* Brand & Nav Link */
        .brand-text,
        .nav-link {
            color: #ffffff;
            transition: color 0.3s ease;
        }

        .navbar-scrolled .brand-text,
        .navbar-scrolled .nav-link {
            color: #1e293b;
        }

        .navbar-scrolled .nav-link:hover {
            color: #2563eb;
        }

        .nav-link.active-link {
            background-color: rgba(255, 255, 255, 0.15);
            border-radius: 0.75rem;
        }

        .navbar-scrolled .nav-link.active-link {
            background-color: rgba(37, 99, 235, 0.08);
            color: #2563eb;
        }

        /* Tombol Login/Register - Solid */
        .btn-masuk {
            background-color: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: #ffffff;
            font-weight: 500;
            padding: 0.5rem 1.5rem;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .btn-masuk:hover {
            background-color: rgba(255, 255, 255, 0.22);
            border-color: rgba(255, 255, 255, 0.45);
            color: #ffffff;
        }

        .btn-daftar {
            background-color: #ffffff;
            color: #1e293b;
            font-weight: 600;
            padding: 0.5rem 1.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            font-size: 0.9rem;
            border: none;
        }

        .btn-daftar:hover {
            background-color: #f8fafc;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
            color: #0f172a;
        }

        .navbar-scrolled .btn-masuk {
            background-color: #f1f5f9;
            border: 1px solid #cbd5e1;
            color: #334155;
        }

        .navbar-scrolled .btn-masuk:hover {
            background-color: #e2e8f0;
            border-color: #94a3b8;
        }

        .navbar-scrolled .btn-daftar {
            background-color: #2563eb;
            color: #ffffff;
            border: none;
        }

        .navbar-scrolled .btn-daftar:hover {
            background-color: #1d4ed8;
        }

        /* Notification toast */
        .notification-toast {
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* Dashboard specific */
        .dashboard-container {
            min-height: calc(100vh - var(--header-height));
        }

        /* Profile dropdown fix */
        .profile-menu {
            position: relative;
        }

        .profile-dropdown {
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.2s ease;
        }

        .profile-menu:hover .profile-dropdown,
        .profile-dropdown.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
    </style>
</head>

<body class="text-slate-800 min-h-screen">
    <!-- Dynamic Header Based on Auth Status -->
    @if(auth('penghuni')->check())
        @include('layouts.partials.dashboard-penghuni')
    @elseif(auth('pemilik')->check())
        @include('layouts.partials.dashboard-pemilik')
    @elseif(auth('admin')->check())
        @include('layouts.partials.dashboard-admin')
    @else
        <!-- Public Layout: Overlay Navbar -->
        <header id="publicNavbar" class="transition-all duration-300">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-8">
                        <a href="{{ route('public.home') }}" class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-white/15 backdrop-blur-sm rounded-xl flex items-center justify-center shadow-sm border border-white/20 transition-all duration-300" id="brandIcon">
                                <i class="fas fa-home text-white text-lg"></i>
                            </div>
                            <span class="text-xl font-bold brand-text">
                                AyoKos
                            </span>
                        </a>
                        <nav class="hidden md:flex gap-4">
                            <a href="{{ route('public.home') }}"
                                class="nav-link flex items-center gap-2 px-3 py-2 rounded-lg font-medium text-sm {{ request()->routeIs('public.home') ? 'active-link' : '' }}">
                                <i class="fas fa-home w-4"></i>
                                <span>Home</span>
                            </a>
                            <a href="{{ route('public.kos.index') }}"
                                class="nav-link flex items-center gap-2 px-3 py-2 rounded-lg font-medium text-sm {{ request()->routeIs('public.kos.index') ? 'active-link' : '' }}">
                                <i class="fas fa-search w-4"></i>
                                <span>Cari Kos</span>
                            </a>
                            <a href="{{ route('public.kos.peta') }}"
                                class="nav-link flex items-center gap-2 px-3 py-2 rounded-lg font-medium text-sm {{ request()->routeIs('public.kos.peta') ? 'active-link' : '' }}">
                                <i class="fas fa-map-marker-alt w-4"></i>
                                <span>Peta</span>
                            </a>
                        </nav>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('login') }}" class="btn-masuk">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="btn-daftar">
                            Daftar
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1">
            @yield('content')
        </main>

        <!-- Footer (Only for Public Pages) -->
        <footer class="bg-white border-t border-slate-200">
            <div class="container mx-auto px-4 py-16">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                    <div>
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-800 rounded-xl flex items-center justify-center shadow-md">
                                <i class="fas fa-home text-white"></i>
                            </div>
                            <span class="text-xl font-bold text-slate-900">AyoKos</span>
                        </div>
                        <p class="text-slate-500 text-sm leading-relaxed">Platform pencarian kos terbaik di Indonesia dengan pengalaman modern, aman, dan terpercaya.</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-slate-900 mb-4 text-sm uppercase tracking-wide">Tautan Cepat</h4>
                        <ul class="space-y-3 text-slate-500 text-sm">
                            <li><a href="{{ route('public.home') }}" class="hover:text-blue-600 transition-colors">Home</a></li>
                            <li><a href="{{ route('public.kos.index') }}" class="hover:text-blue-600 transition-colors">Cari Kos</a></li>
                            <li><a href="{{ route('public.kos.peta') }}" class="hover:text-blue-600 transition-colors">Peta Kos</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold text-slate-900 mb-4 text-sm uppercase tracking-wide">Bantuan</h4>
                        <ul class="space-y-3 text-slate-500 text-sm">
                            <li><a href="{{ route('public.about') }}" class="hover:text-blue-600 transition-colors">Tentang Kami</a></li>
                            <li><a href="{{ route('public.howto') }}" class="hover:text-blue-600 transition-colors">Cara Memesan</a></li>
                            <li><a href="{{ route('public.terms') }}" class="hover:text-blue-600 transition-colors">Syarat & Ketentuan</a></li>
                            <li><a href="{{ route('public.privacy') }}" class="hover:text-blue-600 transition-colors">Kebijakan Privasi</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold text-slate-900 mb-4 text-sm uppercase tracking-wide">Kontak</h4>
                        <ul class="space-y-3 text-slate-500 text-sm">
                            <li class="flex items-center gap-3">
                                <i class="fas fa-envelope w-4 text-blue-600"></i>
                                <span>valorant270306@gmail.com</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <i class="fas fa-phone w-4 text-blue-600"></i>
                                <span>+62 82121730722</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <i class="fas fa-map-marker-alt w-4 text-blue-600"></i>
                                <span>Bandung, Indonesia</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-slate-100 mt-12 pt-8 text-center text-slate-400 text-sm">
                    <p>&copy; {{ date('Y') }} AyoKos. All rights reserved.</p>
                </div>
            </div>
        </footer>
    @endif

    <!-- Logout Confirmation Modal -->
    <div id="logoutModal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4"
        aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" data-modal-close></div>
        <div class="relative bg-white border border-slate-200 rounded-2xl w-full max-w-md overflow-hidden shadow-xl">
            <div class="border-b border-slate-100 p-6">
                <h5 class="text-xl font-semibold text-slate-800" id="logoutModalLabel">Konfirmasi Logout</h5>
            </div>
            <div class="p-6 text-center">
                <div class="mb-4 inline-block">
                    <div class="w-16 h-16 rounded-full bg-red-50 flex items-center justify-center mx-auto">
                        <i class="fas fa-sign-out-alt text-red-500 text-2xl"></i>
                    </div>
                </div>
                <h5 class="text-lg font-medium text-slate-800 mb-2">Apakah Anda yakin ingin logout?</h5>
                <p class="text-slate-500 mb-6">Anda akan keluar dari akun ini dan harus login kembali.</p>
            </div>
            <div class="border-t border-slate-100 p-6 flex justify-end gap-3">
                <button type="button" class="modal-close-btn px-5 py-2.5 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition-colors font-medium">
                    Batal
                </button>
                <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-5 py-2.5 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors shadow-sm font-medium">
                        Ya, Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Success Notification Modal -->
    @if(session('success'))
        <div id="successModal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4">
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" data-modal-close></div>
            <div class="relative bg-white border border-slate-200 rounded-2xl w-full max-w-md overflow-hidden shadow-xl">
                <div class="p-6 text-center">
                    <div class="w-16 h-16 rounded-full bg-emerald-50 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-check-circle text-emerald-500 text-2xl"></i>
                    </div>
                    <h5 class="text-lg font-medium text-slate-800 mb-2">Sukses!</h5>
                    <p class="text-slate-500">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- AOS Animation JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Leaflet JavaScript -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        class Modal {
            constructor(modalId) {
                this.modal = document.getElementById(modalId);
                this.init();
            }

            init() {
                if (!this.modal) return;
                const closeButtons = this.modal.querySelectorAll('.modal-close-btn, [data-modal-close]');
                closeButtons.forEach(btn => {
                    btn.addEventListener('click', () => this.hide());
                });
                this.modal.addEventListener('click', (e) => {
                    if (e.target === this.modal) this.hide();
                });
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape' && !this.modal.classList.contains('hidden')) this.hide();
                });
            }

            show() {
                this.modal.classList.remove('hidden');
                this.modal.classList.add('flex');
                document.body.style.overflow = 'hidden';
            }

            hide() {
                this.modal.classList.add('hidden');
                this.modal.classList.remove('flex');
                document.body.style.overflow = '';
            }
        }

        // Sidebar functionality
        let sidebarCollapsed = false;

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const dashboardHeader = document.getElementById('dashboardHeader');
            const toggleIcon = document.getElementById('sidebarToggleIcon');
            const toggleBtn = document.getElementById('desktopSidebarToggle');
            const logoText = document.querySelector('.logo-text');

            if (!sidebar) return;
            sidebarCollapsed = !sidebarCollapsed;

            if (sidebarCollapsed) {
                sidebar.classList.remove('w-64', 'md:w-64');
                sidebar.classList.add('w-0', 'overflow-hidden');
                if (dashboardHeader) {
                    dashboardHeader.classList.remove('md:ml-64');
                    dashboardHeader.classList.add('md:ml-0');
                }
                if (toggleIcon) {
                    toggleIcon.classList.remove('fa-chevron-left');
                    toggleIcon.classList.add('fa-chevron-right');
                }
                if (toggleBtn) {
                    toggleBtn.classList.remove('left-64');
                    toggleBtn.classList.add('left-0');
                    toggleBtn.classList.remove('rounded-r-lg');
                    toggleBtn.classList.add('rounded-lg');
                }
                if (logoText) logoText.classList.add('hidden');
            } else {
                sidebar.classList.remove('w-0', 'overflow-hidden');
                sidebar.classList.add('w-64', 'md:w-64');
                if (dashboardHeader) {
                    dashboardHeader.classList.remove('md:ml-0');
                    dashboardHeader.classList.add('md:ml-64');
                }
                if (toggleIcon) {
                    toggleIcon.classList.remove('fa-chevron-right');
                    toggleIcon.classList.add('fa-chevron-left');
                }
                if (toggleBtn) {
                    toggleBtn.classList.remove('left-0');
                    toggleBtn.classList.add('left-64');
                    toggleBtn.classList.remove('rounded-lg');
                    toggleBtn.classList.add('rounded-r-lg');
                }
                if (logoText) logoText.classList.remove('hidden');
            }
        }

        function setupProfileDropdown() {
            const profileButtons = document.querySelectorAll('.profile-menu');
            profileButtons.forEach(button => {
                const dropdown = button.querySelector('.profile-dropdown');
                if (!dropdown) return;
                const bridge = document.createElement('div');
                bridge.className = 'profile-bridge';
                button.appendChild(bridge);
                button.addEventListener('mouseenter', () => dropdown.classList.add('show'));
                button.addEventListener('mouseleave', (e) => {
                    if (!dropdown.contains(e.relatedTarget)) dropdown.classList.remove('show');
                });
                dropdown.addEventListener('mouseenter', () => dropdown.classList.add('show'));
                dropdown.addEventListener('mouseleave', () => dropdown.classList.remove('show'));
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            // AOS Init
            AOS.init({
                duration: 800,
                easing: 'ease-out-cubic',
                once: true,
                offset: 40,
                disable: 'mobile'
            });

            // Navbar scroll effect
            const navbar = document.getElementById('publicNavbar');
            if (navbar) {
                function updateNavbar() {
                    if (window.scrollY > 50) {
                        navbar.classList.add('navbar-scrolled');
                    } else {
                        navbar.classList.remove('navbar-scrolled');
                    }
                }
                updateNavbar();
                window.addEventListener('scroll', updateNavbar);
            }

            setupProfileDropdown();

            const mobileToggle = document.getElementById('mobileSidebarToggle');
            const sidebar = document.getElementById('sidebar');
            if (mobileToggle && sidebar) {
                mobileToggle.addEventListener('click', () => {
                    sidebar.classList.toggle('-translate-x-full');
                });
            }

            document.addEventListener('click', function (e) {
                if (sidebar && window.innerWidth < 768) {
                    const isClickInsideSidebar = sidebar.contains(e.target);
                    const isClickOnToggle = mobileToggle && mobileToggle.contains(e.target);
                    if (!isClickInsideSidebar && !isClickOnToggle && !sidebar.classList.contains('-translate-x-full')) {
                        sidebar.classList.add('-translate-x-full');
                    }
                }
            });

            const logoutModal = new Modal('logoutModal');
            const successModal = new Modal('successModal');

            @if(session('success'))
                setTimeout(() => {
                    successModal.show();
                    setTimeout(() => successModal.hide(), 3000);
                }, 500);
            @endif

            window.logoutModal = logoutModal;
            window.successModal = successModal;
        });

        function showLogoutModal() {
            if (window.logoutModal) window.logoutModal.show();
        }
    </script>
    @stack('scripts')
</body>

</html>