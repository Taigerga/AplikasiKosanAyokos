<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'AyoKos'); ?></title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Vite CSS -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css']); ?>

    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> -->

</head>

<body class="text-black flex flex-col min-h-screen overflow-x-hidden">
    <!-- Dynamic Header Based on Auth Status -->
    <?php if(auth()->guard()->check()): ?>
        <?php if(auth()->user()->role === 'penghuni'): ?>
            <?php echo $__env->make('layouts.partials.dashboard-penghuni', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php elseif(auth()->user()->role === 'pemilik'): ?>
            <?php echo $__env->make('layouts.partials.dashboard-pemilik', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php elseif(auth()->user()->role === 'admin'): ?>
            <?php echo $__env->make('layouts.partials.dashboard-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php endif; ?>
    <?php else: ?>
        <!-- Public Layout: Neobrutalism Navbar -->
        <header class="bg-white border-b-4 border-black sticky top-0 z-50">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center h-16 md:h-20">
                    <div class="flex items-center gap-8">
                        <a href="<?php echo e(route('public.home')); ?>" class="flex items-center gap-2">
                            <div class="w-9 h-9 md:w-10 md:h-10 bg-black border-2 border-black flex items-center justify-center shadow-[2px_2px_0px_#000]">
                                <i class="fas fa-home text-white text-sm md:text-base"></i>
                            </div>
                            <span class="text-xl md:text-2xl font-black text-black">
                                AyoKos
                            </span>
                        </a>
                        <nav class="hidden md:flex gap-1">
                            <a href="<?php echo e(route('public.home')); ?>"
                                class="px-4 py-2 font-bold text-sm text-black hover:bg-yellow-400 transition-colors border-2 border-transparent <?php echo e(request()->routeIs('public.home') ? 'bg-yellow-400 border-black' : ''); ?>">
                                Home
                            </a>
                            <a href="<?php echo e(route('public.kos.index')); ?>"
                                class="px-4 py-2 font-bold text-sm text-black hover:bg-yellow-400 transition-colors border-2 border-transparent <?php echo e(request()->routeIs('public.kos.index') ? 'bg-yellow-400 border-black' : ''); ?>">
                                Cari Kos
                            </a>
                            <a href="<?php echo e(route('public.kos.peta')); ?>"
                                class="px-4 py-2 font-bold text-sm text-black hover:bg-yellow-400 transition-colors border-2 border-transparent <?php echo e(request()->routeIs('public.kos.peta') ? 'bg-yellow-400 border-black' : ''); ?>">
                                Peta
                            </a>
                        </nav>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="<?php echo e(route('login')); ?>"
                            class="px-5 py-2.5 bg-black text-white font-bold text-sm border-2 border-black shadow-[3px_3px_0px_#000] hover:shadow-[4px_4px_0px_#000] hover:translate-y-[-1px] transition-all uppercase tracking-wide">
                            Masuk
                        </a>
                        <a href="<?php echo e(route('register')); ?>"
                            class="px-5 py-2.5 bg-white text-black font-bold text-sm border-2 border-black shadow-[3px_3px_0px_#000] hover:shadow-[4px_4px_0px_#000] hover:translate-y-[-1px] transition-all uppercase tracking-wide">
                            Daftar
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Offline Banner -->
        <div id="offline-banner" class="hidden bg-red-500 text-white text-center py-2 px-4 font-bold text-sm">
            <i class="fas fa-wifi-slash mr-2"></i>
            Koneksi internet terputus. Beberapa fitur mungkin tidak berfungsi.
        </div>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col min-w-0 w-full overflow-x-hidden">
            <?php echo $__env->yieldContent('content'); ?>
        </main>

        <!-- Footer Neobrutalism -->
        <?php if(!isset($hideFooter) || !$hideFooter): ?> 
        <footer class="bg-black border-t-4 border-yellow-400">
            <div class="container mx-auto px-4 py-16">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                    <div>
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-10 h-10 bg-yellow-400 border-2 border-yellow-400 flex items-center justify-center shadow-[2px_2px_0px_#000]">
                                <i class="fas fa-home text-black"></i>
                            </div>
                            <span class="text-xl font-black text-white">AyoKos</span>
                        </div>
                        <p class="text-gray-400 text-sm leading-relaxed font-medium">Platform pencarian kos terbaik di Indonesia dengan pengalaman mudah, aman, dan terpercaya.</p>
                    </div>
                    <div>
                        <h4 class="font-bold text-white mb-4 text-sm uppercase tracking-wide">Tautan Cepat</h4>
                        <ul class="space-y-3 text-sm">
                            <li><a href="<?php echo e(route('public.home')); ?>" class="text-gray-400 hover:text-yellow-400 font-medium transition-colors">Home</a></li>
                            <li><a href="<?php echo e(route('public.kos.index')); ?>" class="text-gray-400 hover:text-yellow-400 font-medium transition-colors">Cari Kos</a></li>
                            <li><a href="<?php echo e(route('public.kos.peta')); ?>" class="text-gray-400 hover:text-yellow-400 font-medium transition-colors">Peta Kos</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold text-white mb-4 text-sm uppercase tracking-wide">Bantuan</h4>
                        <ul class="space-y-3 text-sm">
                            <li><a href="<?php echo e(route('public.about')); ?>" class="text-gray-400 hover:text-yellow-400 font-medium transition-colors">Tentang Kami</a></li>
                            <li><a href="<?php echo e(route('public.howto')); ?>" class="text-gray-400 hover:text-yellow-400 font-medium transition-colors">Cara Memesan</a></li>
                            <li><a href="<?php echo e(route('public.terms')); ?>" class="text-gray-400 hover:text-yellow-400 font-medium transition-colors">Syarat & Ketentuan</a></li>
                            <li><a href="<?php echo e(route('public.privacy')); ?>" class="text-gray-400 hover:text-yellow-400 font-medium transition-colors">Kebijakan Privasi</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold text-white mb-4 text-sm uppercase tracking-wide">Kontak</h4>
                        <ul class="space-y-3 text-sm">
                            <li class="flex items-center gap-3 text-gray-400">
                                <i class="fas fa-envelope w-4 text-yellow-400"></i>
                                <span>valorant270306@gmail.com</span>
                            </li>
                            <li class="flex items-center gap-3 text-gray-400">
                                <i class="fas fa-phone w-4 text-yellow-400"></i>
                                <span>+62 82121730722</span>
                            </li>
                            <li class="flex items-center gap-3 text-gray-400">
                                <i class="fas fa-map-marker-alt w-4 text-yellow-400"></i>
                                <span>Bandung, Indonesia</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="border-t-2 border-gray-800 mt-12 pt-8 text-center text-gray-500 text-sm font-medium">
                    <p>&copy; <?php echo e(date('Y')); ?> AyoKos. All rights reserved.</p>
                </div>
            </div>
        </footer>
        <?php endif; ?>
    <?php endif; ?>

    <!-- Logout Confirmation Modal -->
    <div id="logoutModal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4"
        aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="fixed inset-0 bg-black/70" data-modal-close></div>
        <div class="relative bg-white border-4 border-black shadow-[8px_8px_0px_#000] w-full max-w-md">
            <div class="border-b-4 border-black p-6">
                <h5 class="text-xl font-black text-black" id="logoutModalLabel">Konfirmasi Logout</h5>
            </div>
            <div class="p-6 text-center">
                <div class="mb-4 inline-block">
                    <div class="w-16 h-16 bg-red-500 border-2 border-black flex items-center justify-center mx-auto">
                        <i class="fas fa-sign-out-alt text-white text-2xl"></i>
                    </div>
                </div>
                <h5 class="text-lg font-bold text-black mb-2">Apakah Anda yakin ingin logout?</h5>
                <p class="text-gray-600 font-medium mb-6">Anda akan keluar dari akun ini dan harus login kembali.</p>
            </div>
            <div class="border-t-4 border-black p-6 flex justify-end gap-3">
                <button type="button" class="modal-close-btn px-5 py-2.5 bg-white text-black font-bold border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all">
                    Batal
                </button>
                <form id="logoutForm" method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="px-5 py-2.5 bg-red-500 text-white font-bold border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all">
                        Ya, Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Confirm Action Modal -->
    <div id="confirmModal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4">
        <div class="fixed inset-0 bg-black/70" id="confirmModalOverlay"></div>
        <div class="relative bg-white border-4 border-black shadow-[8px_8px_0px_#000] w-full max-w-md">
            <div class="p-6 text-center">
                <div id="confirmModalIcon" class="mb-4 inline-block">
                    <div class="w-16 h-16 bg-red-500 border-2 border-black flex items-center justify-center mx-auto">
                        <i id="confirmIcon" class="fas fa-exclamation-triangle text-white text-2xl"></i>
                    </div>
                </div>
                <h5 id="confirmModalTitle" class="text-lg font-black text-black mb-2">Konfirmasi</h5>
                <p id="confirmModalMessage" class="text-gray-600 font-medium mb-6">Apakah Anda yakin?</p>
            </div>
            <div class="border-t-4 border-black p-6 flex justify-end gap-3">
                <button type="button" id="confirmModalCancel"
                    class="px-5 py-2.5 bg-white text-black font-bold border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all">
                    Batal
                </button>
                <button type="button" id="confirmModalOk"
                    class="px-5 py-2.5 bg-red-500 text-white font-bold border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all">
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>

    <!-- Success Notification Modal -->
    <?php if(session('success')): ?>
        <div id="successModal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4">
            <div class="fixed inset-0 bg-black/70" data-modal-close></div>
            <div class="relative bg-white border-4 border-black shadow-[8px_8px_0px_#000] w-full max-w-md">
                <div class="p-8 text-center">
                    <div class="w-16 h-16 bg-emerald-500 border-2 border-black flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-check-circle text-white text-2xl"></i>
                    </div>
                    <h5 class="text-lg font-black text-black mb-2">Sukses!</h5>
                    <p class="text-gray-600 font-medium"><?php echo e(session('success')); ?></p>
                </div>
            </div>
        </div>
    <?php endif; ?>

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
            // Dropdown handled purely by CSS hover (.profile-menu:hover .profile-dropdown)
        }

        document.addEventListener('DOMContentLoaded', function () {
            setupProfileDropdown();
            fetchNotifCount();

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

            <?php if(session('success')): ?>
                setTimeout(() => {
                    successModal.show();
                    setTimeout(() => successModal.hide(), 3000);
                }, 500);
            <?php endif; ?>

            window.logoutModal = logoutModal;
            window.successModal = successModal;
        });

        function showLogoutModal() {
            if (window.logoutModal) window.logoutModal.show();
        }

        function showConfirmDialog(message, type = 'danger') {
            return new Promise((resolve) => {
                const modal = document.getElementById('confirmModal');
                const msgEl = document.getElementById('confirmModalMessage');
                const titleEl = document.getElementById('confirmModalTitle');
                const iconEl = document.getElementById('confirmIcon');
                const iconWrap = document.querySelector('#confirmModalIcon div');
                const okBtn = document.getElementById('confirmModalOk');

                msgEl.textContent = message;

                const config = {
                    danger: { icon: 'fa-exclamation-triangle', bg: 'bg-red-500', text: 'text-white', btn: 'bg-red-500', label: 'Ya, Hapus', title: 'Konfirmasi Hapus' },
                    success: { icon: 'fa-check-circle', bg: 'bg-emerald-500', text: 'text-white', btn: 'bg-emerald-500', label: 'Ya, Setujui', title: 'Konfirmasi' },
                    warning: { icon: 'fa-exclamation-circle', bg: 'bg-yellow-500', text: 'text-white', btn: 'bg-yellow-500', label: 'Ya', title: 'Perhatian' },
                };

                const c = config[type] || config.danger;
                iconEl.className = `fas ${c.icon} ${c.text} text-2xl`;
                iconWrap.className = `w-16 h-16 ${c.bg} border-2 border-black flex items-center justify-center mx-auto`;
                okBtn.className = `px-5 py-2.5 ${c.btn} text-white font-bold border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all`;
                okBtn.textContent = c.label;
                titleEl.textContent = c.title;

                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.style.overflow = 'hidden';

                function close() {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    document.body.style.overflow = '';
                }

                function cleanup() {
                    close();
                    document.getElementById('confirmModalOk').removeEventListener('click', handleOk);
                    document.getElementById('confirmModalCancel').removeEventListener('click', handleCancel);
                    document.getElementById('confirmModalOverlay').removeEventListener('click', handleOverlay);
                }

                function handleOk() { cleanup(); resolve(true); }
                function handleCancel() { cleanup(); resolve(false); }
                function handleOverlay() { cleanup(); resolve(false); }

                document.getElementById('confirmModalOk').addEventListener('click', handleOk);
                document.getElementById('confirmModalCancel').addEventListener('click', handleCancel);
                document.getElementById('confirmModalOverlay').addEventListener('click', handleOverlay);
            });
        }

        async function fetchNotifCount() {
            const badge = document.getElementById('notifBadge');
            if (!badge) return;
            try {
                const res = await axios.get('/api/notifications/unread-count');
                const count = res.data?.data?.unread_count || 0;
                if (count > 0) {
                    badge.textContent = count > 9 ? '9+' : count;
                    badge.classList.remove('hidden');
                }
            } catch (e) {
                // silently fail
            }
        }
    </script>
    <?php echo $__env->yieldPushContent('scripts'); ?>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/app.js']); ?>
</body>

</html><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/layouts/app.blade.php ENDPATH**/ ?>