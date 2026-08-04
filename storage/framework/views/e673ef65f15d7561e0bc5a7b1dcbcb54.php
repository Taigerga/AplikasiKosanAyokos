<?php $__env->startSection('title', 'Login - AyoKos'); ?>

<?php $__env->startSection('content'); ?>
<?php if(session('success')): ?>
    <div class="bg-emerald-400 border-2 border-black text-black font-bold px-4 py-3 mb-6 shadow-[3px_3px_0px_#000]">
        <div class="flex items-center"><i class="fas fa-check-circle mr-3"></i><?php echo e(session('success')); ?></div>
    </div>
<?php endif; ?>
<?php if($errors->has('login')): ?>
    <div class="bg-red-400 border-2 border-black text-black font-bold px-4 py-3 mb-6 shadow-[3px_3px_0px_#000]">
        <div class="flex items-center"><i class="fas fa-exclamation-circle mr-3"></i><?php echo e($errors->first('login')); ?></div>
    </div>
<?php endif; ?>

<!-- Login Section -->
<section class="bg-yellow-50 py-16 md:py-24 min-h-[calc(100vh-80px)]">
    <div class="container mx-auto px-4">
        <div class="flex justify-center">
            <div class="login-card w-full max-w-md">
                <!-- Header Card -->
                <div class="login-card-header">
                    <div class="w-14 h-14 bg-black border-2 border-black flex items-center justify-center mx-auto mb-4 shadow-[3px_3px_0px_#000]">
                        <i class="fas fa-sign-in-alt text-white text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-black text-black mb-1">Selamat Datang</h2>
                    <p class="text-gray-600 font-bold text-sm">Masuk ke akun AyoKos Anda</p>
                </div>

                <!-- Form -->
                <div class="p-6 md:p-8">
                    <form method="POST" action="<?php echo e(route('login')); ?>" id="loginForm" data-ajax="true" data-ajax-action="/api/auth/login" data-redirect="<?php echo e(url('/redirect')); ?>" data-success-msg="Login berhasil!">
                        <?php echo csrf_field(); ?>

                        <!-- Username -->
                        <div class="mb-5">
                            <label for="username" class="form-label">
                                <i class="fas fa-user mr-2 text-sky-400"></i>Username
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
                                <i class="fas fa-lock mr-2 text-sky-400"></i>Password
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

                        <!-- Forgot Password -->
                        <div class="text-right mb-4">
                            <a href="<?php echo e(route('password.request')); ?>" class="text-red-500 hover:text-black font-bold text-sm transition-colors">
                                <i class="fas fa-key mr-1"></i>Lupa Password?
                            </a>
                        </div>

                        <!-- Submit -->
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-sign-in-alt mr-2"></i>Masuk
                        </button>
                    </form>

                    <!-- Register Link -->
                    <div class="text-center mt-6 pt-6 border-t-2 border-gray-200">
                        <p class="text-gray-600 font-bold text-sm mb-2">Belum punya akun?</p>
                        <a href="<?php echo e(route('register')); ?>" class="text-sky-500 hover:text-black font-bold text-sm transition-colors">
                            <i class="fas fa-user-plus mr-1"></i>Daftar Sekarang
                        </a>
                    </div>

                    <!-- Back to Home -->
                    <div class="text-center mt-4">
                        <a href="<?php echo e(route('public.home')); ?>" class="text-gray-500 hover:text-black font-bold text-sm transition-colors">
                            <i class="fas fa-arrow-left mr-1"></i>Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', ['hideFooter' => true], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views\auth\login.blade.php ENDPATH**/ ?>