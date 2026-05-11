<?php $__env->startSection('title', 'Daftar - AyoKos'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .register-bg {
        background: linear-gradient(160deg, #0f172a 0%, #1e293b 40%, #1e3a5f 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        padding-top: 5rem; /* jarak dari navbar */
        padding-bottom: 2rem;
    }

    .register-bg::before {
        content: '';
        position: absolute;
        top: -30%;
        left: -15%;
        width: 70%;
        height: 160%;
        background: radial-gradient(circle at 35% 35%, rgba(56, 189, 248, 0.12), transparent 60%);
        pointer-events: none;
    }

    .register-bg::after {
        content: '';
        position: absolute;
        bottom: -20%;
        right: -10%;
        width: 60%;
        height: 140%;
        background: radial-gradient(circle at 70% 80%, rgba(99, 102, 241, 0.08), transparent 60%);
        pointer-events: none;
    }

    .register-card {
        background: rgba(30, 41, 59, 0.85);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(226, 232, 240, 0.1);
        border-radius: 1.5rem;
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(255, 255, 255, 0.05);
        overflow: hidden;
        transition: all 0.3s ease;
        width: 100%;
        max-width: 500px;
        margin: auto;
    }

    .register-card:hover {
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(56, 189, 248, 0.2);
        transform: translateY(-3px);
    }

    .register-card-header {
        background: linear-gradient(135deg, rgba(56, 189, 248, 0.15) 0%, rgba(99, 102, 241, 0.1) 100%);
        padding: 2.5rem 2rem;
        text-align: center;
        border-bottom: 1px solid rgba(226, 232, 240, 0.08);
    }

    .step-indicator {
        display: flex;
        justify-content: space-between;
        position: relative;
        padding: 1.5rem 2rem 0;
    }

    .step-indicator::before {
        content: '';
        position: absolute;
        top: 2.5rem;
        left: 50px;
        right: 50px;
        height: 2px;
        background: rgba(226, 232, 240, 0.2);
        z-index: 1;
    }

    .step {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        z-index: 2;
        flex: 1;
    }

    .step-number {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: rgba(15, 23, 42, 0.8);
        border: 2px solid rgba(226, 232, 240, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: #94a3b8;
        margin-bottom: 0.5rem;
        transition: all 0.3s ease;
        font-size: 0.875rem;
    }

    .step.active .step-number {
        background: linear-gradient(135deg, #38bdf8 0%, #6366f1 100%);
        border-color: transparent;
        color: white;
        box-shadow: 0 4px 12px rgba(56, 189, 248, 0.3);
    }

    .step-label {
        font-size: 0.75rem;
        color: #94a3b8;
        text-align: center;
        font-weight: 500;
    }

    .step.active .step-label {
        color: #38bdf8;
        font-weight: 600;
    }

    .form-step {
        display: none;
        animation: fadeIn 0.3s ease;
    }

    .form-step.active {
        display: block;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
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

    .btn-outline {
        padding: 0.75rem 1.5rem;
        border-radius: 0.75rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        background: rgba(15, 23, 42, 0.6);
        border: 2px solid rgba(226, 232, 240, 0.15);
        color: #e2e8f0;
        cursor: pointer;
    }

    .btn-outline:hover {
        background: rgba(30, 41, 59, 0.8);
        border-color: rgba(226, 232, 240, 0.3);
        color: white;
    }

    .btn-outline:disabled {
        opacity: 0.4;
        cursor: not-allowed;
    }

    .is-invalid {
        border-color: #f87171 !important;
    }

    .invalid-feedback {
        color: #fca5a5;
        font-size: 0.8rem;
        margin-top: 0.35rem;
    }

    .file-upload {
        position: relative;
        width: 120px;
        height: 120px;
        margin: 0 auto 1.5rem;
    }

    .file-upload input[type="file"] {
        display: none;
    }

    .file-upload label {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        border: 3px dashed #38bdf8;
        cursor: pointer;
        transition: all 0.3s ease;
        background: rgba(15, 23, 42, 0.6);
        color: #94a3b8;
    }

    .file-upload label:hover {
        background: rgba(56, 189, 248, 0.1);
        transform: scale(1.05);
    }

    .file-upload .preview {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        display: none;
        border: 3px solid #38bdf8;
    }

    .toast-login {
        position: fixed;
        top: 5rem; /* di bawah navbar */
        right: 1.25rem;
        z-index: 9999;
        animation: slideInRight 0.4s ease-out;
    }

    @keyframes slideInRight {
        from { transform: translateX(120%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }

    .toast-body {
        background: rgba(30, 41, 59, 0.95);
        backdrop-filter: blur(16px);
        border: 1px solid rgba(226, 232, 240, 0.15);
        border-radius: 0.75rem;
        padding: 1rem 1.5rem;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
        color: #e2e8f0;
    }

    .bg-emerald-900\/80 { background: rgba(6, 78, 59, 0.8); }
    .bg-red-900\/80 { background: rgba(127, 29, 29, 0.8); }
</style>

<!-- Toast Notifications -->
<?php if(session('success') || $errors->any()): ?>
<div id="registerToast" class="toast-login">
    <div class="toast-body <?php echo e(session('success') ? 'bg-emerald-900/80 border-l-emerald-400' : 'bg-red-900/80 border-l-red-400'); ?> border-l-4">
        <div class="flex items-start gap-3">
            <i class="fas <?php echo e(session('success') ? 'fa-check-circle text-emerald-400' : 'fa-exclamation-circle text-red-400'); ?> text-lg mt-0.5"></i>
            <div>
                <?php if(session('success')): ?>
                    <?php echo e(session('success')); ?>

                <?php else: ?>
                    <strong>Terjadi kesalahan:</strong>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div><?php echo e($error); ?></div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
            <button onclick="document.getElementById('registerToast').remove()" class="ml-auto text-slate-400 hover:text-white transition">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Register Section -->
<section class="relative bg-gradient-to-br from-slate-800 to-slate-900 pt-28 pb-16 md:pt-32 md:pb-20 overflow-hidden">
    <div class="container mx-auto px-4 relative z-10">
        <div class="flex justify-center">
            <div class="register-card">
                <!-- Header -->
                <div class="register-card-header">
                    <div class="w-14 h-14 bg-white/10 backdrop-blur-md border-2 border-white/20 rounded-xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fas fa-user-plus text-white text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-1">Daftar Akun Baru</h2>
                    <p class="text-slate-300 text-sm">Bergabung dengan AyoKos dalam beberapa langkah mudah</p>
                </div>

                <!-- Step Indicator -->
                <div class="step-indicator">
                    <div class="step active" data-step="1">
                        <div class="step-number">1</div>
                        <div class="step-label">Data Pribadi</div>
                    </div>
                    <div class="step" data-step="2">
                        <div class="step-number">2</div>
                        <div class="step-label">Data Akun</div>
                    </div>
                    <div class="step" data-step="3">
                        <div class="step-number">3</div>
                        <div class="step-label">Konfirmasi</div>
                    </div>
                </div>

                <!-- Form -->
                <div class="p-6 md:p-8">
                    <form method="POST" action="<?php echo e(route('register')); ?>" enctype="multipart/form-data" id="registrationForm">
                        <?php echo csrf_field(); ?>

                        <!-- Step 1: Data Pribadi -->
                        <div class="form-step active" id="step1">
                            <h4 class="text-white font-semibold mb-4"><i class="fas fa-user mr-2 text-sky-400"></i>Data Pribadi</h4>

                            <!-- Nama -->
                            <div class="mb-4">
                                <label for="nama" class="form-label">Nama Lengkap <span class="text-red-400">*</span></label>
                                <input type="text" name="nama" id="nama" class="form-input <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    value="<?php echo e(old('nama')); ?>" placeholder="Masukkan nama lengkap" required>
                                <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Email & No HP -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="email" class="form-label">Email <span class="text-red-400">*</span></label>
                                    <input type="email" name="email" id="email" class="form-input <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        value="<?php echo e(old('email')); ?>" placeholder="email@example.com" required>
                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div>
                                    <label for="no_hp_display" class="form-label">No. HP <span class="text-red-400">*</span></label>
                                    <div class="flex">
                                        <span class="inline-flex items-center px-3 py-2 bg-white/10 border border-r-0 border-white/10 rounded-l-lg text-white font-semibold text-sm">
                                            +62
                                        </span>
                                        <input type="tel" id="no_hp_display" class="form-input rounded-l-none <?php $__errorArgs = ['no_hp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            value="<?php echo e(old('no_hp') ? (str_starts_with(old('no_hp'), '62') ? substr(old('no_hp'), 2) : old('no_hp')) : ''); ?>"
                                            placeholder="81234567890" required>
                                        <input type="hidden" name="no_hp" id="no_hp" value="<?php echo e(old('no_hp')); ?>">
                                    </div>
                                    <small class="text-slate-400 text-xs mt-1 block">Masukkan nomor setelah +62</small>
                                    <?php $__errorArgs = ['no_hp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <!-- Tanggal Lahir -->
                            <div class="mb-4">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="text-red-400">*</span></label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-input <?php $__errorArgs = ['tanggal_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    value="<?php echo e(old('tanggal_lahir')); ?>" max="<?php echo e(date('Y-m-d', strtotime('-17 years'))); ?>" required>
                                <div class="invalid-feedback" id="tanggal_lahir_error"><?php $__errorArgs = ['tanggal_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div>
                            </div>

                            <!-- Jenis Kelamin -->
                            <div class="mb-4">
                                <label class="form-label">Jenis Kelamin <span class="text-red-400">*</span></label>
                                <div class="flex gap-4">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="jenis_kelamin" value="L" class="w-4 h-4 text-sky-500 bg-white/10 border-white/20 focus:ring-sky-500" <?php echo e(old('jenis_kelamin') == 'L' ? 'checked' : ''); ?>>
                                        <span class="text-white text-sm"><i class="fas fa-male mr-1"></i> Laki-laki</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="jenis_kelamin" value="P" class="w-4 h-4 text-sky-500 bg-white/10 border-white/20 focus:ring-sky-500" <?php echo e(old('jenis_kelamin') == 'P' ? 'checked' : ''); ?>>
                                        <span class="text-white text-sm"><i class="fas fa-female mr-1"></i> Perempuan</span>
                                    </label>
                                </div>
                                <?php $__errorArgs = ['jenis_kelamin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Alamat -->
                            <div class="mb-4">
                                <label for="alamat" class="form-label">Alamat <span class="text-red-400">*</span></label>
                                <textarea name="alamat" id="alamat" rows="3" class="form-input <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    placeholder="Masukkan alamat lengkap" required><?php echo e(old('alamat')); ?></textarea>
                                <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Navigation -->
                            <div class="flex justify-between mt-6">
                                <button type="button" class="btn-outline opacity-40 cursor-not-allowed" disabled>
                                    <i class="fas fa-chevron-left"></i> Sebelumnya
                                </button>
                                <button type="button" class="btn-outline" onclick="nextStep()">
                                    Selanjutnya <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Step 2: Data Akun -->
                        <div class="form-step" id="step2">
                            <h4 class="text-white font-semibold mb-4"><i class="fas fa-key mr-2 text-sky-400"></i>Data Akun</h4>

                            <!-- Username -->
                            <div class="mb-4">
                                <label for="username" class="form-label">Username <span class="text-red-400">*</span></label>
                                <input type="text" name="username" id="username" class="form-input <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    value="<?php echo e(old('username')); ?>" placeholder="Pilih username unik" required>
                                <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Password -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="password" class="form-label">Password <span class="text-red-400">*</span></label>
                                    <div class="relative">
                                        <input type="password" name="password" id="password" class="form-input pr-12 <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            placeholder="Minimal 8 karakter" required>
                                        <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-sky-400" onclick="togglePassword('password')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div>
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="text-red-400">*</span></label>
                                    <div class="relative">
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-input pr-12"
                                            placeholder="Ulangi password" required>
                                        <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-sky-400" onclick="togglePassword('password_confirmation')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Foto Profil -->
                            <div class="mb-4 text-center">
                                <label class="form-label">Foto Profil (Opsional)</label>
                                <div class="file-upload">
                                    <input type="file" name="foto_profil" id="foto_profil" accept="image/*" onchange="previewImage(this)">
                                    <label for="foto_profil" id="fileUploadLabel">
                                        <i class="fas fa-camera text-2xl"></i>
                                    </label>
                                    <img id="imagePreview" class="preview" alt="Preview">
                                </div>
                                <p class="text-slate-400 text-xs">Klik untuk upload foto (opsional, max 2MB)</p>
                            </div>

                            <!-- Navigation -->
                            <div class="flex justify-between mt-6">
                                <button type="button" class="btn-outline" onclick="prevStep()">
                                    <i class="fas fa-chevron-left"></i> Sebelumnya
                                </button>
                                <button type="button" class="btn-outline" onclick="nextStep()">
                                    Selanjutnya <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Step 3: Konfirmasi -->
                        <div class="form-step" id="step3">
                            <h4 class="text-white font-semibold mb-4"><i class="fas fa-check-circle mr-2 text-sky-400"></i>Konfirmasi Pendaftaran</h4>

                            <!-- Role -->
                            <div class="mb-4">
                                <label class="form-label mb-3">Daftar Sebagai <span class="text-red-400">*</span></label>
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="role-card <?php if(old('role') == 'penghuni'): ?> active <?php endif; ?>" onclick="selectRole('penghuni')">
                                        <input type="radio" name="role" value="penghuni" id="rolePenghuni" class="hidden" <?php echo e(old('role') == 'penghuni' ? 'checked' : ''); ?> required>
                                        <i class="fas fa-user"></i>
                                        <div class="text-white font-semibold text-sm">Penghuni</div>
                                        <div class="text-slate-400 text-xs mt-1">Saya ingin mencari kos</div>
                                    </div>
                                    <div class="role-card <?php if(old('role') == 'pemilik'): ?> active <?php endif; ?>" onclick="selectRole('pemilik')">
                                        <input type="radio" name="role" value="pemilik" id="rolePemilik" class="hidden" <?php echo e(old('role') == 'pemilik' ? 'checked' : ''); ?> required>
                                        <i class="fas fa-building"></i>
                                        <div class="text-white font-semibold text-sm">Pemilik</div>
                                        <div class="text-slate-400 text-xs mt-1">Saya ingin menyewakan kos</div>
                                    </div>
                                </div>
                                <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback mt-2"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Alert -->
                            <div class="bg-sky-500/10 border border-sky-500/30 rounded-xl p-4 mb-4 flex gap-3 text-sm text-slate-300">
                                <i class="fas fa-info-circle text-sky-400 mt-0.5"></i>
                                <span><strong>Penting:</strong> Pastikan data yang Anda isi sudah benar. Data tidak dapat diubah setelah pendaftaran.</span>
                            </div>

                            <!-- Navigation -->
                            <div class="flex justify-between mt-6">
                                <button type="button" class="btn-outline" onclick="prevStep()">
                                    <i class="fas fa-chevron-left"></i> Sebelumnya
                                </button>
                                <button type="submit" class="btn-submit">
                                    <i class="fas fa-user-plus mr-2"></i> Daftar Sekarang
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Login Link -->
                <div class="px-6 pb-4 text-center border-t border-white/5 pt-4">
                    <p class="text-slate-400 text-sm mb-2">Sudah punya akun?</p>
                    <a href="<?php echo e(route('login')); ?>" class="text-sky-400 hover:text-sky-300 font-semibold text-sm transition">
                        <i class="fas fa-sign-in-alt mr-1"></i>Masuk Sekarang
                    </a>
                </div>

                <!-- Back to Home -->
                <div class="px-6 pb-6 text-center">
                    <a href="<?php echo e(route('public.home')); ?>" class="text-slate-400 hover:text-white text-sm transition">
                        <i class="fas fa-arrow-left mr-1"></i>Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    let currentStep = 1;
    const totalSteps = 3;

    function nextStep() {
        if (currentStep < totalSteps && validateStep(currentStep)) {
            document.getElementById(`step${currentStep}`).classList.remove('active');
            document.querySelector(`.step[data-step="${currentStep}"]`).classList.remove('active');
            currentStep++;
            document.getElementById(`step${currentStep}`).classList.add('active');
            document.querySelector(`.step[data-step="${currentStep}"]`).classList.add('active');
        }
    }

    function prevStep() {
        if (currentStep > 1) {
            document.getElementById(`step${currentStep}`).classList.remove('active');
            document.querySelector(`.step[data-step="${currentStep}"]`).classList.remove('active');
            currentStep--;
            document.getElementById(`step${currentStep}`).classList.add('active');
            document.querySelector(`.step[data-step="${currentStep}"]`).classList.add('active');
        }
    }

    function validateStep(step) {
        let isValid = true;

        if (step === 1) {
            const nama = document.getElementById('nama');
            const email = document.getElementById('email');
            const noHpDisplay = document.getElementById('no_hp_display');
            const tanggalLahir = document.getElementById('tanggal_lahir');
            const alamat = document.getElementById('alamat');
            const jenisKelamin = document.querySelector('input[name="jenis_kelamin"]:checked');

            if (!nama.value.trim()) { nama.classList.add('is-invalid'); isValid = false; } else { nama.classList.remove('is-invalid'); }
            if (!email.value.trim() || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) { email.classList.add('is-invalid'); isValid = false; } else { email.classList.remove('is-invalid'); }
            if (!noHpDisplay.value.trim()) { noHpDisplay.classList.add('is-invalid'); isValid = false; } else { formatPhoneNumber(); noHpDisplay.classList.remove('is-invalid'); }
            if (!tanggalLahir.value) {
                tanggalLahir.classList.add('is-invalid');
                document.getElementById('tanggal_lahir_error').textContent = 'Tanggal lahir wajib diisi';
                isValid = false;
            } else {
                const birthDate = new Date(tanggalLahir.value);
                const today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
                const m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) age--;
                if (age < 17) {
                    tanggalLahir.classList.add('is-invalid');
                    document.getElementById('tanggal_lahir_error').textContent = 'Umur minimal 17 tahun';
                    isValid = false;
                } else {
                    tanggalLahir.classList.remove('is-invalid');
                }
            }
            if (!alamat.value.trim()) { alamat.classList.add('is-invalid'); isValid = false; } else { alamat.classList.remove('is-invalid'); }
            if (!jenisKelamin) {
                const container = document.querySelector('.mb-4:has(input[name="jenis_kelamin"])');
                if (container) {
                    let error = container.querySelector('.invalid-feedback');
                    if (!error) {
                        error = document.createElement('div');
                        error.className = 'invalid-feedback';
                        container.appendChild(error);
                    }
                    error.textContent = 'Pilih jenis kelamin';
                }
                isValid = false;
            }
        } else if (step === 2) {
            const username = document.getElementById('username');
            const password = document.getElementById('password');
            const passwordConf = document.getElementById('password_confirmation');

            if (!username.value.trim()) { username.classList.add('is-invalid'); isValid = false; } else { username.classList.remove('is-invalid'); }
            if (!password.value || password.value.length < 8) { password.classList.add('is-invalid'); isValid = false; } else { password.classList.remove('is-invalid'); }
            if (!passwordConf.value || password.value !== passwordConf.value) { passwordConf.classList.add('is-invalid'); isValid = false; } else { passwordConf.classList.remove('is-invalid'); }
        } else if (step === 3) {
            const role = document.querySelector('input[name="role"]:checked');
            if (!role) {
                const container = document.querySelector('.grid.grid-cols-2.gap-3');
                if (container) {
                    let error = container.querySelector('.invalid-feedback');
                    if (!error) {
                        error = document.createElement('div');
                        error.className = 'invalid-feedback mt-2';
                        container.appendChild(error);
                    }
                    error.textContent = 'Pilih peran anda';
                }
                isValid = false;
            } else {
                const container = document.querySelector('.grid.grid-cols-2.gap-3');
                const error = container?.querySelector('.invalid-feedback');
                if (error) error.remove();
            }
        }

        return isValid;
    }

    function formatPhoneNumber() {
        const display = document.getElementById('no_hp_display');
        const hidden = document.getElementById('no_hp');
        let val = display.value.replace(/\D/g, '');
        if (val.startsWith('62')) val = val.substring(2);
        else if (val.startsWith('0')) val = val.substring(1);
        display.value = val;
        hidden.value = '62' + val;
    }

    function togglePassword(id) {
        const input = document.getElementById(id);
        const icon = input.nextElementSibling.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }

    function selectRole(role) {
        document.querySelectorAll('.role-card').forEach(c => c.classList.remove('active'));
        const radio = document.getElementById('role' + role.charAt(0).toUpperCase() + role.slice(1));
        if (radio) {
            radio.checked = true;
            radio.closest('.role-card').classList.add('active');
        }
    }

    function previewImage(input) {
        const preview = document.getElementById('imagePreview');
        const label = document.getElementById('fileUploadLabel');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                preview.style.display = 'block';
                label.style.display = 'none';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        // Toast auto-hide
        const toast = document.getElementById('registerToast');
        if (toast) setTimeout(() => { toast.style.opacity = '0'; setTimeout(() => toast.remove(), 300); }, 4000);

        // Format phone on load
        formatPhoneNumber();
        document.getElementById('no_hp_display').addEventListener('input', formatPhoneNumber);
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            for (let i = 1; i <= totalSteps; i++) {
                if (!validateStep(i)) {
                    e.preventDefault();
                    document.querySelectorAll('.form-step').forEach(s => s.classList.remove('active'));
                    document.querySelectorAll('.step').forEach(s => s.classList.remove('active'));
                    document.getElementById(`step${i}`).classList.add('active');
                    document.querySelector(`.step[data-step="${i}"]`).classList.add('active');
                    currentStep = i;
                    return;
                }
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', ['hideFooter' => true], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/auth/register.blade.php ENDPATH**/ ?>