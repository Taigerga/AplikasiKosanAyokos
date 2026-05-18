<?php $__env->startSection('title', 'Edit Profil - Pemilik Kos'); ?>

<?php $__env->startSection('content'); ?>
    <div class="p-4 md:p-6">
        <!-- Header -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 mb-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between">
                <div>
                    <h1 class="text-2xl md:text-3xl font-black text-black mb-2">
                        <i class="fas fa-user-edit mr-3 text-sky-600"></i>
                        Edit Profil Pemilik
                    </h1>
                    <p class="text-gray-600">Perbarui informasi profil Anda dengan data terbaru</p>
                </div>
                <a href="<?php echo e(route('pemilik.profile.show')); ?>" 
                class="inline-flex items-center px-4 py-2 bg-white text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition mt-4 md:mt-0">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Profil
                </a>
            </div>
        </div>



        <!-- Edit Form -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] overflow-hidden">
            <form action="<?php echo e(route('pemilik.profile.update')); ?>" method="POST" class="p-6 md:p-8"
                enctype="multipart/form-data" data-ajax="true" data-ajax-action="/api/pemilik/profile/update" data-ajax-method="PUT" data-redirect="<?php echo e(route('pemilik.profile.show')); ?>" data-success-msg="Profil berhasil diperbarui!" data-confirm="Apakah Anda yakin ingin menyimpan perubahan profil?">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <!-- Personal Information Section -->
                <div class="mb-8">
                    <h3
                        class="text-lg md:text-xl font-black text-black mb-6 pb-4 border-b-2 border-black flex items-center">
                        <i class="fas fa-user-circle text-sky-600 mr-3"></i>
                        Data Pribadi
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama -->
                        <div class="col-span-2">
                            <label for="nama" class="block text-sm font-black text-black mb-2">
                                Nama Lengkap *
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-500"></i>
                                </div>
                                <input type="text" id="nama" name="nama" value="<?php echo e(old('nama', $pemilik->nama)); ?>"
                                    class="w-full pl-10 pr-4 py-3 border-2 border-black text-black font-bold placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white transition <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    required placeholder="Masukkan nama lengkap">
                            </div>
                            <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-sm mt-2"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Username -->
                        <div>
                            <label for="username" class="block text-sm font-black text-black mb-2">
                                Username *
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-at text-gray-500"></i>
                                </div>
                                <input type="text" id="username" name="username"
                                    value="<?php echo e(old('username', $user->username)); ?>"
                                    class="w-full pl-10 pr-4 py-3 border-2 border-black text-black font-bold placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white transition <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    required placeholder="username">
                            </div>
                            <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-sm mt-2"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>



                        <!-- Jenis Kelamin -->
                        <div>
                            <label for="jenis_kelamin" class="block text-sm font-black text-black mb-2">
                                <i class="fas fa-venus-mars mr-2"></i>Jenis Kelamin
                            </label>
                            <select id="jenis_kelamin" name="jenis_kelamin"
                                class="w-full px-4 py-3 border-2 border-black text-black font-bold bg-white focus:shadow-[3px_3px_0px_#000] outline-none transition appearance-none <?php $__errorArgs = ['jenis_kelamin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L" <?php echo e(old('jenis_kelamin', $pemilik->jenis_kelamin) == 'L' ? 'selected' : ''); ?>>Laki-laki</option>
                                <option value="P" <?php echo e(old('jenis_kelamin', $pemilik->jenis_kelamin) == 'P' ? 'selected' : ''); ?>>Perempuan</option>
                            </select>
                            <?php $__errorArgs = ['jenis_kelamin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-sm mt-2"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Tanggal Lahir -->
                        <div>
                            <label for="tanggal_lahir" class="block text-sm font-black text-black mb-2">
                                <i class="fas fa-calendar-alt mr-2"></i>Tanggal Lahir
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-birthday-cake text-gray-500"></i>
                                </div>
                                <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                                    value="<?php echo e(old('tanggal_lahir', $pemilik->tanggal_lahir ? \Carbon\Carbon::parse($pemilik->tanggal_lahir)->format('Y-m-d') : '')); ?>"
                                    class="w-full pl-10 pr-4 py-3 border-2 border-black text-black font-bold bg-white focus:shadow-[3px_3px_0px_#000] outline-none transition <?php $__errorArgs = ['tanggal_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            </div>
                            <?php $__errorArgs = ['tanggal_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-sm mt-2"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <!-- Contact Information Section -->
                <div class="mb-8">
                    <h3
                        class="text-lg md:text-xl font-black text-black mb-6 pb-4 border-b-2 border-black flex items-center">
                        <i class="fas fa-address-book text-sky-600 mr-3"></i>
                        Data Kontak
                    </h3>

                    <div class="grid grid-cols-1 gap-6">
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-black text-black mb-2">
                                Email *
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-500"></i>
                                </div>
                                <input type="email" id="email" name="email" value="<?php echo e(old('email', $pemilik->email)); ?>"
                                    class="w-full pl-10 pr-4 py-3 border-2 border-black text-black font-bold placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white transition <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    required placeholder="email@contoh.com">
                            </div>
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-sm mt-2"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Nomor HP -->
                        <div>
                            <label for="no_hp" class="block text-sm font-black text-black mb-2">
                                Nomor HP *
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 font-bold">+62</span>
                                </div>
                                <input type="tel" id="no_hp" name="no_hp" value="<?php echo e(old('no_hp', $pemilik->no_hp)); ?>"
                                    class="w-full pl-14 pr-4 py-3 border-2 border-black text-black font-bold placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white transition <?php $__errorArgs = ['no_hp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    required placeholder="81234567890">
                            </div>
                            <?php $__errorArgs = ['no_hp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-sm mt-2"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Alamat -->
                        <div>
                            <label for="alamat" class="block text-sm font-black text-black mb-2">
                                <i class="fas fa-map-marker-alt mr-2"></i>Alamat
                            </label>
                            <textarea id="alamat" name="alamat" rows="3"
                                class="w-full px-4 py-3 border-2 border-black text-black font-bold placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white transition resize-none <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                placeholder="Alamat lengkap tempat tinggal"><?php echo e(old('alamat', $pemilik->alamat)); ?></textarea>
                            <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-sm mt-2"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <!-- Data Rekening Bank Section -->
                <div class="mb-8">
                    <h3
                        class="text-lg md:text-xl font-black text-black mb-6 pb-4 border-b-2 border-black flex items-center">
                        <i class="fas fa-money-check-alt text-sky-600 mr-3"></i>
                        Data Rekening Bank
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Bank -->
                        <div>
                            <label for="nama_bank" class="block text-sm font-black text-black mb-2">
                                Nama Bank
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-university text-gray-500"></i>
                                </div>
                                <input type="text" id="nama_bank" name="nama_bank"
                                    value="<?php echo e(old('nama_bank', $pemilik->nama_bank)); ?>"
                                    class="w-full pl-10 pr-4 py-3 border-2 border-black text-black font-bold placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white transition <?php $__errorArgs = ['nama_bank'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    placeholder="Contoh: BCA, Mandiri">
                            </div>
                            <?php $__errorArgs = ['nama_bank'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-sm mt-2"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Nomor Rekening -->
                        <div>
                            <label for="nomor_rekening" class="block text-sm font-black text-black mb-2">
                                Nomor Rekening
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-credit-card text-gray-500"></i>
                                </div>
                                <input type="text" id="nomor_rekening" name="nomor_rekening"
                                    value="<?php echo e(old('nomor_rekening', $pemilik->nomor_rekening)); ?>"
                                    class="w-full pl-10 pr-4 py-3 border-2 border-black text-black font-bold placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white transition <?php $__errorArgs = ['nomor_rekening'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    placeholder="Masukkan nomor rekening">
                            </div>
                            <?php $__errorArgs = ['nomor_rekening'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-sm mt-2"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>


                <!-- Security Section -->
                <div class="mb-8">
                    <h3
                        class="text-lg md:text-xl font-black text-black mb-6 pb-4 border-b-2 border-black flex items-center">
                        <i class="fas fa-shield-alt text-sky-600 mr-3"></i>
                        Keamanan Akun
                    </h3>

                    <!-- Security Info -->
                    <div class="bg-gray-100 border-2 border-black p-5 mb-6">
                        <div class="flex items-start">
                            <i class="fas fa-info-circle text-sky-600 text-lg mr-3 mt-0.5"></i>
                            <div>
                                <h4 class="font-black text-black mb-1">Ubah Password</h4>
                                <p class="text-gray-600 text-sm">Kosongkan kolom password jika tidak ingin mengubah
                                    password Anda.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Password Fields -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- New Password -->
                        <div>
                            <label for="password" class="block text-sm font-black text-black mb-2">
                                Password Baru
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-500"></i>
                                </div>
                                <input type="password" id="password" name="password"
                                    class="w-full pl-10 pr-10 py-3 border-2 border-black text-black font-bold placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white transition <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    placeholder="Password baru">
                                <button type="button" onclick="togglePassword('password')"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-black transition">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-sm mt-2"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-black text-black mb-2">
                                Konfirmasi Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-500"></i>
                                </div>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="w-full pl-10 pr-10 py-3 border-2 border-black text-black font-bold placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white transition <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    placeholder="Ulangi password baru">
                                <button type="button" onclick="togglePassword('password_confirmation')"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-black transition">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-sm mt-2"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div
                    class="flex flex-col-reverse md:flex-row justify-between items-center pt-8 border-t-2 border-black">
                    <div class="mt-4 md:mt-0">
                        <a href="<?php echo e(route('pemilik.profile.show')); ?>"
                            class="px-6 py-3 border-2 border-black text-black font-black hover:bg-gray-100 transition inline-flex items-center">
                            <i class="fas fa-times mr-2"></i>
                            Batalkan
                        </a>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <button type="button" onclick="resetForm()"
                            class="px-6 py-3 border-2 border-black text-black font-black hover:bg-gray-100 transition inline-flex items-center justify-center">
                            <i class="fas fa-redo mr-2"></i>
                            Reset Form
                        </button>
                        <button type="submit"
                            class="px-8 py-3 bg-black text-white font-black border-2 border-black shadow-[3px_3px_0px_#000] hover:shadow-[4px_4px_0px_#000] hover:translate-y-[-1px] transition-all duration-300 inline-flex items-center justify-center uppercase tracking-wide text-sm">
                            <i class="fas fa-save mr-2"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
        <script>
            // Toggle password visibility
            function togglePassword(fieldId) {
                const field = document.getElementById(fieldId);
                const button = field.nextElementSibling;
                const icon = button.querySelector('i');

                if (field.type === 'password') {
                    field.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    field.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            }

            // Format phone number input
            const phoneField = document.getElementById('no_hp');
            if (phoneField) {
                phoneField.addEventListener('input', function (e) {
                    let value = e.target.value.replace(/\D/g, '');
                    if (value.startsWith('0')) {
                        value = value.substring(1);
                    }
                    if (value.length > 12) {
                        value = value.substring(0, 12);
                    }
                    e.target.value = value;
                });
            }



            // Image preview
            function previewImage(event) {
                const input = event.target;
                const preview = document.getElementById('previewImage');
                const previewContainer = document.getElementById('imagePreview');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        preview.src = e.target.result;
                        previewContainer.classList.remove('hidden');
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            // Reset form
            async function resetForm() {
                const confirmed = await window.showConfirmDialog('Anda yakin ingin mengembalikan semua perubahan ke nilai awal?', 'warning');
                if (confirmed) {
                    window.location.reload();
                }
            }

            // Initialize form validation
            document.addEventListener('DOMContentLoaded', function () {
                const form = document.querySelector('form');
                if (form) {
                    // Add validation for required fields
                    const requiredFields = form.querySelectorAll('[required]');
                    requiredFields.forEach(field => {
                        field.addEventListener('blur', function () {
                            if (!this.value.trim()) {
                                this.classList.add('border-rose-500');
                            } else {
                                this.classList.remove('border-rose-500');
                            }
                        });
                    });


                }
            });
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views\pemilik\profile\edit.blade.php ENDPATH**/ ?>