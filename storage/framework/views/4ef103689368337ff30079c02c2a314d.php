<?php $__env->startSection('title', 'Profil Saya - Pemilik Kos'); ?>

<?php $__env->startSection('content'); ?>
    <div class="p-4 md:p-6 lg:p-8 space-y-6 max-w-7xl mx-auto">
        <!-- Header -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 mb-6">
            <h1 class="text-2xl md:text-3xl font-black text-black flex items-center">
                <i class="fas fa-user-circle text-sky-600 mr-3"></i>
                Profil Pemilik Kos
            </h1>
            <p class="text-gray-500 mt-2">Kelola informasi profil dan akun Anda sebagai pemilik kos</p>
        </div>

        <?php if(session('success')): ?>
            <div class="bg-emerald-400 border-2 border-black text-black font-bold px-4 py-3 shadow-[3px_3px_0px_#000] mb-6">
                <div class="flex items-center"><i class="fas fa-check-circle mr-3"></i><?php echo e(session('success')); ?></div>
            </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="bg-red-400 border-2 border-black text-black font-bold px-4 py-3 shadow-[3px_3px_0px_#000] mb-6">
                <div class="flex items-center"><i class="fas fa-exclamation-circle mr-3"></i><?php echo e(session('error')); ?></div>
            </div>
        <?php endif; ?>

        <!-- Profile Card -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] overflow-hidden">
            <!-- Cover Photo -->
            <div class="h-40 bg-black relative">
                <!-- Profile Photo -->
                <div class="absolute -bottom-16 left-6 md:left-8">
                    <div class="relative">
                        <?php if($pemilik->foto_profil): ?>
                            <img src="<?php echo e(Storage::url($pemilik->foto_profil)); ?>" alt="Foto Profil"
                                class="w-32 h-32 md:w-40 md:h-40 border-4 border-black shadow-[4px_4px_0px_#000] object-cover">
                        <?php else: ?>
                            <div
                                class="w-32 h-32 md:w-40 md:h-40 border-4 border-black bg-sky-400 shadow-[4px_4px_0px_#000] flex items-center justify-center">
                                <span
                                    class="text-4xl md:text-5xl text-black font-black"><?php echo e(substr($pemilik->nama, 0, 1)); ?></span>
                            </div>
                        <?php endif; ?>

                        <!-- Upload Button -->
                        <button onclick="openUploadModal()"
                            class="absolute -bottom-2 -right-2 bg-black text-white p-2 md:p-3 border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all duration-300">
                            <i class="fas fa-camera text-sm md:text-base"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Profile Info -->
            <div class="pt-20 md:pt-24 px-4 md:px-8 pb-6 md:pb-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div class="flex-1">
                        <h2 class="text-xl md:text-2xl font-black text-black"><?php echo e($pemilik->nama); ?></h2>
                        <p class="text-gray-500 mt-1 flex items-center">
                            <i class="fas fa-envelope mr-2 text-sky-600"></i>
                            <?php echo e($pemilik->email); ?>

                        </p>
                        <div class="flex flex-wrap items-center gap-4 mt-2">
                            <span class="text-gray-500 flex items-center">
                                <i class="fas fa-phone mr-2 text-emerald-600"></i>
                                <?php echo e($pemilik->no_hp); ?>

                            </span>
                            <span class="text-gray-500 flex items-center">
                                <i class="fas fa-calendar-alt mr-2 text-yellow-600"></i>
                                Bergabung <?php echo e($pemilik->created_at->format('d M Y')); ?>

                            </span>
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        <a href="<?php echo e(route('pemilik.profile.edit')); ?>"
                            class="px-4 py-2 md:px-5 md:py-2.5 bg-black text-white font-black border-2 border-black shadow-[3px_3px_0px_#000] hover:shadow-[4px_4px_0px_#000] hover:translate-y-[-1px] transition-all duration-300 flex items-center uppercase tracking-wide text-sm">
                            <i class="fas fa-edit mr-2"></i>
                            Edit Profil
                        </a>
                    </div>
                </div>

                <!-- Quick Stats -->
                <?php
                    use App\Models\Kos;
                    use App\Models\Kamar;
                    use App\Models\KontrakSewa;

                    $totalKos = Kos::where('id_pemilik', $pemilik->id_pemilik)->count();
                    $totalKamar = Kamar::whereHas('kos', function ($q) use ($pemilik) {
                        $q->where('id_pemilik', $pemilik->id_pemilik);
                    })->count();

                    $kamarTerisi = Kamar::whereHas('kos', function ($q) use ($pemilik) {
                        $q->where('id_pemilik', $pemilik->id_pemilik);
                    })->where('status_kamar', 'terisi')->count();

                    $totalKontrak = KontrakSewa::whereHas('kos', function ($q) use ($pemilik) {
                        $q->where('id_pemilik', $pemilik->id_pemilik);
                    })->where('status_kontrak', 'aktif')->count();

                    $ratingKos = Kos::where('id_pemilik', $pemilik->id_pemilik)
                        ->withAvg('reviews', 'rating')
                        ->get()
                        ->avg('reviews_avg_rating');
                ?>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4 mt-6">
                    <!-- Total Kos -->
                    <div
                        class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4 md:p-5">
                        <div class="flex items-center">
                            <div class="p-2 md:p-3 bg-sky-400 border-2 border-black mr-3 md:mr-4">
                                <i class="fas fa-home text-black text-lg md:text-xl"></i>
                            </div>
                            <div>
                                <p class="text-xs md:text-sm text-gray-600 font-black">Total Kos</p>
                                <p class="text-xl md:text-2xl font-black text-black"><?php echo e($totalKos); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Total Kamar -->
                    <div
                        class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4 md:p-5">
                        <div class="flex items-center">
                            <div class="p-2 md:p-3 bg-emerald-400 border-2 border-black mr-3 md:mr-4">
                                <i class="fas fa-bed text-black text-lg md:text-xl"></i>
                            </div>
                            <div>
                                <p class="text-xs md:text-sm text-gray-600 font-black">Total Kamar</p>
                                <p class="text-xl md:text-2xl font-black text-black"><?php echo e($totalKamar); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Kamar Terisi -->
                    <div
                        class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4 md:p-5">
                        <div class="flex items-center">
                            <div class="p-2 md:p-3 bg-purple-400 border-2 border-black mr-3 md:mr-4">
                                <i class="fas fa-users text-black text-lg md:text-xl"></i>
                            </div>
                            <div>
                                <p class="text-xs md:text-sm text-gray-600 font-black">Kamar Terisi</p>
                                <p class="text-xl md:text-2xl font-black text-black"><?php echo e($kamarTerisi); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Rating Rata-rata -->
                    <div
                        class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4 md:p-5">
                        <div class="flex items-center">
                            <div class="p-2 md:p-3 bg-yellow-400 border-2 border-black mr-3 md:mr-4">
                                <i class="fas fa-star text-black text-lg md:text-xl"></i>
                            </div>
                            <div>
                                <p class="text-xs md:text-sm text-gray-600 font-black">Rating Rata-rata</p>
                                <p class="text-xl md:text-2xl font-black text-black">
                                    <?php echo e($ratingKos ? number_format($ratingKos, 1) : '-'); ?>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Details Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-6 mt-6 md:mt-8">
                    <!-- Personal Information -->
                    <div class="bg-gray-100 border-2 border-black p-5 md:p-6">
                        <h3 class="text-lg font-black text-black mb-4 flex items-center">
                            <i class="fas fa-user-circle text-sky-600 mr-3"></i>
                            Informasi Pribadi
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-500 font-black">Username</p>
                                <p class="font-bold text-black"><?php echo e($user->username); ?></p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500 font-black">Jenis Kelamin</p>
                                <p class="font-bold text-black">
                                    <?php if($pemilik->jenis_kelamin == 'L'): ?>
                                        Laki-laki
                                    <?php elseif($pemilik->jenis_kelamin == 'P'): ?>
                                        Perempuan
                                    <?php else: ?>
                                        <span class="text-gray-500">Belum diisi</span>
                                    <?php endif; ?>
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500 font-black">Tanggal Lahir</p>
                                <p class="font-bold text-black">
                                    <?php echo e($pemilik->tanggal_lahir ? \Carbon\Carbon::parse($pemilik->tanggal_lahir)->format('d M Y') : '<span class="text-gray-500">Belum diisi</span>'); ?>

                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="bg-gray-100 border-2 border-black p-5 md:p-6">
                        <h3 class="text-lg font-black text-black mb-4 flex items-center">
                            <i class="fas fa-address-book text-emerald-600 mr-3"></i>
                            Informasi Kontak
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-500 font-black">Nomor HP</p>
                                <p class="font-bold text-black flex items-center">
                                    <i class="fas fa-phone text-emerald-600 mr-2"></i>
                                    <?php echo e($pemilik->no_hp); ?>

                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 font-black">Email</p>
                                <p class="font-bold text-black flex items-center">
                                    <i class="fas fa-envelope text-sky-600 mr-2"></i>
                                    <?php echo e($pemilik->email); ?>

                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 font-black">Alamat</p>
                                <p class="font-bold text-black">
                                    <?php echo e($pemilik->alamat ?: '<span class="text-gray-500">Belum diisi</span>'); ?>

                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Bank Information -->
                    <div class="bg-gray-100 border-2 border-black p-5 md:p-6 lg:col-span-2">
                        <h3 class="text-lg font-black text-black mb-4 flex items-center">
                            <i class="fas fa-university text-sky-600 mr-3"></i>
                            Data Rekening Bank
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm text-gray-500 font-black">Nama Bank</p>
                                <p class="font-bold text-black flex items-center">
                                    <i class="fas fa-money-check mr-2 text-sky-600"></i>
                                    <?php echo e($pemilik->nama_bank ?: 'Belum diisi'); ?>

                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 font-black">Nomor Rekening</p>
                                <p class="font-bold text-black flex items-center">
                                    <i class="fas fa-credit-card mr-2 text-emerald-600"></i>
                                    <?php echo e($pemilik->nomor_rekening ?: 'Belum diisi'); ?>

                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Account Information -->
                    <div class="bg-gray-100 border-2 border-black p-5 md:p-6 lg:col-span-2">
                        <h3 class="text-lg font-black text-black mb-4 flex items-center">
                            <i class="fas fa-key text-yellow-600 mr-3"></i>
                            Informasi Akun
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <div class="space-y-4">
                                    <div>
                                        <p class="text-sm text-gray-500 font-black">Role</p>
                                        <p class="font-bold text-black">
                                            <span
                                                class="px-3 py-1 text-sm font-black bg-sky-400 text-black border-2 border-black">
                                                <?php echo e(ucfirst($pemilik->role)); ?>

                                            </span>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 font-black">Status Akun</p>
                                        <p class="font-bold text-black">
                                            <span
                                                class="px-3 py-1 text-sm font-black border-2 border-black
                                                <?php echo e($pemilik->status_pemilik == 'aktif' ? 'bg-emerald-400 text-black' :
        ($pemilik->status_pemilik == 'pending' ? 'bg-yellow-400 text-black' : 'bg-red-400 text-white')); ?>">
                                                <?php echo e(ucfirst($pemilik->status_pemilik)); ?>

                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="space-y-4">
                                    <div>
                                        <p class="text-sm text-gray-500 font-black">Terakhir Login</p>
                                        <p class="font-bold text-black">
                                            <i class="fas fa-clock text-gray-500 mr-2"></i>
                                            <?php echo e($pemilik->updated_at->format('d M Y H:i')); ?>

                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 font-black">Member Sejak</p>
                                        <p class="font-bold text-black">
                                            <i class="fas fa-calendar-check text-gray-500 mr-2"></i>
                                            <?php echo e($pemilik->created_at->format('d M Y')); ?>

                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Kos List -->
                <?php
                    $recentKos = Kos::where('id_pemilik', $pemilik->id_pemilik)
                        ->withCount([
                            'kamar as kamar_tersedia' => function ($q) {
                                $q->where('status_kamar', 'tersedia');
                            }
                        ])
                        ->latest()
                        ->take(3)
                        ->get();
                ?>

                <?php if($recentKos->count() > 0): ?>
                    <div class="mt-8">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-black text-black flex items-center">
                                <i class="fas fa-building text-sky-600 mr-3"></i>
                                Kos Terbaru
                            </h3>
                            <a href="<?php echo e(route('pemilik.kos.index')); ?>"
                                class="text-sm text-sky-600 hover:text-black font-black transition-colors flex items-center">
                                Lihat semua
                                <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <?php $__currentLoopData = $recentKos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="<?php echo e(route('pemilik.kos.show', $kos->id_kos)); ?>"
                                            class="bg-gray-100 border-2 border-black p-4 hover:border-yellow-400 transition-all duration-300">
                                            <div class="flex justify-between items-start mb-3">
                                                <h4 class="font-bold text-black truncate"><?php echo e($kos->nama_kos); ?></h4>
                                                <span
                                                    class="text-xs px-2 py-1 border-2 border-black font-black
                                                    <?php echo e($kos->status_kos == 'aktif' ? 'bg-emerald-400 text-black' :
                                                ($kos->status_kos == 'pending' ? 'bg-yellow-400 text-black' : 'bg-red-400 text-white')); ?>">
                                                    <?php echo e($kos->status_kos); ?>

                                                </span>
                                            </div>
                                            <p class="text-sm text-gray-500 mb-3 truncate flex items-center">
                                                <i class="fas fa-map-marker-alt mr-2 text-sky-600"></i>
                                                <?php echo e($kos->alamat); ?>

                                            </p>
                                            <div class="flex items-center justify-between mt-3">
                                                <div class="text-sm text-gray-500 flex items-center">
                                                    <i class="fas fa-users mr-2"></i>
                                                    <?php echo e($kos->jenis_kos); ?>

                                                </div>
                                                <div class="text-sm font-bold text-black">
                                                    <?php echo e($kos->kamar_tersedia); ?> kamar tersedia
                                                </div>
                                            </div>
                                        </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Upload Photo Modal -->
    <div id="uploadModal" class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50">
        <div class="bg-white border-4 border-black p-6 max-w-md w-full mx-4 shadow-[4px_4px_0px_#000]">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-black text-black">Upload Foto Profil</h3>
                <button onclick="closeUploadModal()" class="text-gray-600 hover:text-black">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <form id="uploadPhotoForm" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                        <div class="text-center mb-4">
                            <label for="photoInput" class="block w-full h-40 border-2 border-dashed border-black flex items-center justify-center cursor-pointer hover:bg-gray-100 transition">
                                <div id="photoPreview"
                            class="w-32 h-32 mx-auto border-2 border-dashed border-black bg-gray-100 flex items-center justify-center mb-4">
                            <i class="fas fa-user-circle text-4xl text-gray-500"></i>
                        </div>
                        <p class="text-sm text-gray-500">Pratinjau foto profil</p>
                    </div>

                    <!-- File Input -->
                    <div class="relative">
                        <input type="file" name="foto_profil" id="photoInput" accept="image/*" class="hidden" required>
                        <label for="photoInput"
                            class="block w-full px-4 py-3 border-2 border-dashed border-black text-center cursor-pointer hover:bg-gray-100 transition">
                            <i class="fas fa-cloud-upload-alt text-sky-600 text-xl mb-2"></i>
                            <p class="text-black font-black">Pilih Foto</p>
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF. Max: 2MB</p>
                        </label>
                    </div>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeUploadModal()"
                        class="px-4 py-2.5 border-2 border-black text-black font-black hover:bg-gray-100 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2.5 bg-black text-white font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all duration-300 flex items-center uppercase tracking-wide text-sm">
                        <i class="fas fa-upload mr-2"></i>
                        Upload
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
        <script>
            function openUploadModal() {
                document.getElementById('uploadModal').classList.remove('hidden');
                document.getElementById('uploadModal').classList.add('flex');
                document.body.classList.add('overflow-hidden');
            }

            function closeUploadModal() {
                document.getElementById('uploadModal').classList.add('hidden');
                document.getElementById('uploadModal').classList.remove('flex');
                document.getElementById('photoInput').value = '';
                document.body.classList.remove('overflow-hidden');
            }

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') closeUploadModal();
            });
            document.getElementById('uploadModal')?.addEventListener('click', function (e) {
                if (e.target === this) closeUploadModal();
            });
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/pemilik/profile/show.blade.php ENDPATH**/ ?>