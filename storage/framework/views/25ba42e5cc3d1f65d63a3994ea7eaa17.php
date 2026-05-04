<?php $__env->startSection('title', 'Login - AyoKos'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .login-bg {
        background: linear-gradient(160deg, #0f172a 0%, #1e293b 40%, #1e3a5f 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .login-bg::before {
        content: '';
        position: absolute;
        top: -30%;
        left: -15%;
        width: 70%;
        height: 160%;
        background: radial-gradient(circle at 35% 35%, rgba(56, 189, 248, 0.12), transparent 60%);
        pointer-events: none;
    }

    .login-bg::after {
        content: '';
        position: absolute;
        bottom: -20%;
        right: -10%;
        width: 60%;
        height: 140%;
        background: radial-gradient(circle at 70% 80%, rgba(99, 102, 241, 0.08), transparent 60%);
        pointer-events: none;
    }

    .role-card {
        background: rgba(255, 255, 255, 0.05);
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: 1rem;
        padding: 1.5rem 1rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        backdrop-filter: blur(4px);
    }

    .role-card:hover {
        background: rgba(56, 189, 248, 0.1);
        border-color: rgba(56, 189, 248, 0.3);
        transform: translateY(-2px);
    }

    .role-card.active {
        background: rgba(56, 189, 248, 0.15);
        border-color: rgba(56, 189, 248, 0.5);
        box-shadow: 0 0 0 1px rgba(56, 189, 248, 0.3);
    }

    .role-card i {
        font-size: 1.75rem;
        margin-bottom: 0.75rem;
        background: linear-gradient(135deg, #38bdf8 0%, #6366f1 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .login-card {
        background: rgba(30, 41, 59, 0.85);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(226, 232, 240, 0.1);
        border-radius: 1.5rem;
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(255, 255, 255, 0.05);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .login-card:hover {
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(56, 189, 248, 0.2);
        transform: translateY(-3px);
    }

    .login-card-header {
        background: linear-gradient(135deg, rgba(56, 189, 248, 0.15) 0%, rgba(99, 102, 241, 0.1) 100%);
        padding: 2.5rem 2rem;
        text-align: center;
        border-bottom: 1px solid rgba(226, 232, 240, 0.08);
    }

    .form-input {
        width: 100%;
        padding: 0.85rem 1rem;
        background: rgba(15, 23, 42, 0.6);
        border: 2px solid rgba(226, 232, 240, 0.15);
        border-radius: 0.85rem;
        color: #e2e8f0;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        font-family: 'Inter', sans-serif;
    }

    .form-input:focus {
        outline: none;
        border-color: #38bdf8;
        background: rgba(15, 23, 42, 0.8);
        box-shadow: 0 0 0 4px rgba(56, 189, 248, 0.15);
    }

    .form-input::placeholder {
        color: #94a3b8;
    }

    .form-label {
        color: #e2e8f0;
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
        display: block;
    }

    .btn-submit {
        width: 100%;
        padding: 0.9rem;
        background: linear-gradient(135deg, #38bdf8 0%, #6366f1 100%);
        color: white;
        border: none;
        border-radius: 0.85rem;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 16px rgba(56, 189, 248, 0.25);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(56, 189, 248, 0.4);
        background: linear-gradient(135deg, #0ea5e9 0%, #4f46e5 100%);
    }

    .btn-toggle-password {
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        background: transparent;
        border: none;
        color: #94a3b8;
        padding: 0.5rem 1rem;
        cursor: pointer;
        transition: color 0.2s ease;
    }

    .btn-toggle-password:hover {
        color: #38bdf8;
    }

    .text-sky-custom {
        color: #38bdf8;
    }

    .text-muted-custom {
        color: #94a3b8;
    }

    .border-custom {
        border-color: rgba(226, 232, 240, 0.1);
    }

    .invalid-feedback {
        color: #fca5a5;
        font-size: 0.8rem;
        margin-top: 0.35rem;
    }

    .is-invalid {
        border-color: #fca5a5 !important;
    }

    .is-invalid:focus {
        box-shadow: 0 0 0 4px rgba(252, 165, 165, 0.15) !important;
    }

    /* Toast */
    .toast-login {
        position: fixed;
        top: 1.25rem;
        right: 1.25rem;
        z-index: 9999;
        animation: slideInRight 0.4s ease-out;
    }

    @keyframes slideInRight {
        from {
            transform: translateX(120%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .toast-body {
        background: rgba(30, 41, 59, 0.95);
        backdrop-filter: blur(16px);
        border: 1px solid rgba(226, 232, 240, 0.15);
        border-radius: 0.75rem;
        padding: 1rem 1.5rem;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: #e2e8f0;
    }

    .toast-body.success {
        border-left: 3px solid #34d399;
    }

    .toast-body.error {
        border-left: 3px solid #f87171;
    }
</style>

<!-- Toast Notifications -->
<?php if(session('success') || $errors->has('login')): ?>
<div id="loginToast" class="toast-login">
    <div class="toast-body <?php echo e(session('success') ? 'success' : 'error'); ?>">
        <i class="fas <?php echo e(session('success') ? 'fa-check-circle text-emerald-400' : 'fa-exclamation-circle text-red-400'); ?> text-lg"></i>
        <span><?php echo e(session('success') ?? $errors->first('login')); ?></span>
        <button onclick="document.getElementById('loginToast').remove()" class="ml-auto text-slate-400 hover:text-white transition">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>
<?php endif; ?>

<!-- Login Section -->
<section class="login-bg">
    <div class="container mx-auto px-4 relative z-10 py-6">
        <div class="flex justify-center">
            <div class="login-card w-full max-w-md">
                <!-- Header Card -->
                <div class="login-card-header">
                    <div class="w-14 h-14 bg-white/10 backdrop-blur-md border-2 border-white/20 rounded-xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fas fa-sign-in-alt text-white text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-1">Selamat Datang</h2>
                    <p class="text-slate-300 text-sm">Masuk ke akun AyoKos Anda</p>
                </div>

                <!-- Form -->
                <div class="p-6 md:p-8">
                    <form method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo csrf_field(); ?>

                        <!-- Username -->
                        <div class="mb-5">
                            <label for="username" class="form-label">
                                <i class="fas fa-user mr-2 text-sky-custom"></i>Username
                            </label>
                            <input 
                                type="text" 
                                name="username" 
                                id="username" 
                                class="form-input <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('username')); ?>" 
                                placeholder="Masukkan username" 
                                required 
                                autofocus
                            >
                            <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Password -->
                        <div class="mb-5">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock mr-2 text-sky-custom"></i>Password
                            </label>
                            <div class="relative">
                                <input 
                                    type="password" 
                                    name="password" 
                                    id="password" 
                                    class="form-input pr-12 <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    placeholder="Masukkan password" 
                                    required
                                >
                                <button type="button" id="togglePassword" class="btn-toggle-password">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Role Selection -->
                        <div class="mb-6">
                            <label class="form-label mb-3">
                                <i class="fas fa-user-tag mr-2 text-sky-custom"></i>Login Sebagai
                            </label>
                            <div class="grid grid-cols-2 gap-3">
                                <div 
                                    class="role-card <?php if(old('role') == 'penghuni'): ?> active <?php endif; ?>" 
                                    onclick="selectRole('penghuni')"
                                >
                                    <input type="radio" name="role" value="penghuni" id="rolePenghuni" 
                                           class="hidden" <?php echo e(old('role') == 'penghuni' ? 'checked' : ''); ?>>
                                    <i class="fas fa-user"></i>
                                    <div class="text-white font-semibold text-sm">Penghuni</div>
                                    <div class="text-slate-400 text-xs mt-1">Pencari kos</div>
                                </div>
                                <div 
                                    class="role-card <?php if(old('role') == 'pemilik'): ?> active <?php endif; ?>" 
                                    onclick="selectRole('pemilik')"
                                >
                                    <input type="radio" name="role" value="pemilik" id="rolePemilik" 
                                           class="hidden" <?php echo e(old('role') == 'pemilik' ? 'checked' : ''); ?>>
                                    <i class="fas fa-building"></i>
                                    <div class="text-white font-semibold text-sm">Pemilik</div>
                                    <div class="text-slate-400 text-xs mt-1">Pemilik kos</div>
                                </div>
                            </div>
                            <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-red-400 text-xs mt-2"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Submit -->
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-sign-in-alt mr-2"></i>Masuk
                        </button>
                    </form>

                    <!-- Register Link -->
                    <div class="text-center mt-6 pt-6 border-t border-custom">
                        <p class="text-muted-custom text-sm mb-2">Belum punya akun?</p>
                        <a href="<?php echo e(route('register')); ?>" class="text-sky-custom hover:text-sky-400 font-semibold text-sm transition">
                            <i class="fas fa-user-plus mr-1"></i>Daftar Sekarang
                        </a>
                    </div>

                    <!-- Back to Home -->
                    <div class="text-center mt-4">
                        <a href="<?php echo e(route('public.home')); ?>" class="text-slate-400 hover:text-white text-sm transition">
                            <i class="fas fa-arrow-left mr-1"></i>Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Toggle Password Visibility
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const icon = this.querySelector('i');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });

    // Role Selection
    function selectRole(role) {
        document.querySelectorAll('.role-card').forEach(card => {
            card.classList.remove('active');
        });
        const radio = document.getElementById('role' + role.charAt(0).toUpperCase() + role.slice(1));
        if (radio) {
            radio.checked = true;
            radio.closest('.role-card').classList.add('active');
        }
    }

    // Auto-select role based on old input
    document.addEventListener('DOMContentLoaded', function () {
        const oldRole = "<?php echo e(old('role')); ?>";
        if (oldRole) {
            selectRole(oldRole);
        }

        // Auto-hide toast after 4 seconds
        const toast = document.getElementById('loginToast');
        if (toast) {
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transition = 'opacity 0.3s ease';
                setTimeout(() => toast.remove(), 300);
            }, 4000);
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', ['hideFooter' => true], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/auth/login.blade.php ENDPATH**/ ?>