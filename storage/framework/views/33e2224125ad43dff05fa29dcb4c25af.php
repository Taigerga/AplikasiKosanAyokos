<?php $__env->startSection('title', 'Profil Saya - Penghuni'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-4 md:p-6 lg:p-8 space-y-6 max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-6 bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
        <h1 class="text-2xl md:text-3xl font-black text-black flex items-center">
            <i class="fas fa-user-circle text-green-400 mr-3"></i>
            Profil Saya
        </h1>
        <p class="text-gray-600 mt-2">Kelola informasi profil dan akun Anda</p>
    </div>

    <?php if(session('success')): ?>
        <div class="bg-emerald-400 border-2 border-black shadow-[3px_3px_0px_#000] text-black px-4 py-3  mb-6">
            <div class="flex items-center"><i class="fas fa-check-circle mr-3"></i><?php echo e(session('success')); ?></div>
        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="bg-red-400 border-2 border-black shadow-[3px_3px_0px_#000] text-black px-4 py-3  mb-6">
            <div class="flex items-center"><i class="fas fa-exclamation-circle mr-3"></i><?php echo e(session('error')); ?></div>
        </div>
    <?php endif; ?>

    <!-- Profile Card -->
    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] overflow-hidden shadow-[4px_4px_0px_#000]">
        <!-- Cover Photo -->
        <div class="h-40 bg-lime-400 border-b-4 border-black relative">
            <!-- Cover Pattern -->
            <div class="absolute inset-0 opacity-20">
                <div class="absolute top-4 right-4 w-32 h-32 bg-white  "></div>
                <div class="absolute bottom-4 left-4 w-24 h-24 bg-green-400  "></div>
            </div>

            <!-- Profile Photo -->
            <div class="absolute -bottom-16 left-6 md:left-8">
                <div class="relative">
                    <?php if($penghuni->foto_profil): ?>
                        <img src="<?php echo e(Storage::url($penghuni->foto_profil)); ?>" alt="Foto Profil"
                            class="w-32 h-32 md:w-40 md:h-40  border-4 border-black shadow-[4px_4px_0px_#000] object-cover">
                    <?php else: ?>
                        <div
                            class="w-32 h-32 md:w-40 md:h-40  border-4 border-black bg-emerald-100 shadow-[4px_4px_0px_#000] flex items-center justify-center">
                            <span
                                class="text-4xl md:text-5xl text-black font-black"><?php echo e(substr($penghuni->nama, 0, 1)); ?></span>
                        </div>
                    <?php endif; ?>

                    <!-- Upload Button -->
                    <button onclick="openUploadModal()"
                        class="absolute -bottom-2 -right-2 bg-lime-400 border-2 border-black shadow-[2px_2px_0px_#000] text-black p-2 md:p-3  hover:bg-yellow-500  transition-all duration-300 shadow-[3px_3px_0px_#000] hover:scale-110">
                        <i class="fas fa-camera text-sm md:text-base"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Profile Info -->
        <div class="pt-20 md:pt-24 px-4 md:px-8 pb-6 md:pb-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div class="flex-1">
                    <div class="flex items-center space-x-3 mb-2">
                        <h2 class="text-xl md:text-2xl font-black text-black"><?php echo e($penghuni->nama); ?></h2>
                        <?php if($penghuni->status_penghuni == 'aktif'): ?>
                            <span class="px-2 py-1 bg-emerald-400 text-black text-xs font-black border-2 border-black">
                                <i class="fas fa-check-circle mr-1"></i>
                                Aktif
                            </span>
                        <?php elseif($penghuni->status_penghuni == 'calon'): ?>
                            <span class="px-2 py-1 bg-yellow-400 text-black text-xs font-black border-2 border-black">
                                <i class="fas fa-clock mr-1"></i>
                                Calon
                            </span>
                        <?php endif; ?>
                    </div>
                    <p class="text-gray-600 mt-1 flex items-center">
                        <i class="fas fa-envelope mr-2 text-green-400"></i>
                        <?php echo e($penghuni->email); ?>

                    </p>
                    <div class="flex flex-wrap items-center gap-4 mt-2">
                        <span class="text-gray-600 flex items-center">
                            <i class="fas fa-phone mr-2 text-green-400"></i>
                            <?php echo e($penghuni->no_hp); ?>

                        </span>
                        <span class="text-gray-600 flex items-center">
                            <i class="fas fa-calendar-alt mr-2 text-yellow-400"></i>
                            Bergabung <?php echo e($penghuni->created_at->format('d M Y')); ?>

                        </span>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <a href="<?php echo e(route('penghuni.profile.edit')); ?>"
                        class="px-4 py-2 md:px-5 md:py-2.5 bg-lime-400 border-2 border-black shadow-[2px_2px_0px_#000] text-black  hover:bg-yellow-500  transition-all duration-300 flex items-center shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] hover:-translate-y-1">
                        <i class="fas fa-edit mr-2"></i>
                        Edit Profil
                    </a>
                </div>
            </div>

            <!-- Quick Stats -->
            <?php
                $kontrakAktif = $penghuni->kontrakSewa()->where('status_kontrak', 'aktif')->count();
                $totalReview = $penghuni->reviews()->count();
                $totalPembayaran = $penghuni->pembayaran()->where('status_pembayaran', 'lunas')->count();
            ?>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4 mt-6">
                <!-- Kontrak Aktif -->
                <div
                    class="card-hover bg-white border-2 border-black shadow-[2px_2px_0px_#000] p-4 md:p-5">
                    <div class="flex items-center">
                        <div class="p-2 md:p-3 bg-emerald-400 border-2 border-black mr-3 md:mr-4">
                            <i class="fas fa-file-contract text-black text-lg md:text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs md:text-sm text-black">Kontrak Aktif</p>
                            <p class="text-xl md:text-2xl font-black text-black"><?php echo e($kontrakAktif); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Total Review -->
                <div
                    class="card-hover bg-white border-2 border-black shadow-[2px_2px_0px_#000] p-4 md:p-5">
                    <div class="flex items-center">
                        <div class="p-2 md:p-3 bg-yellow-400 border-2 border-black mr-3 md:mr-4">
                            <i class="fas fa-star text-black text-lg md:text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs md:text-sm text-black">Total Review</p>
                            <p class="text-xl md:text-2xl font-black text-black"><?php echo e($totalReview); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Pembayaran Lunas -->
                <div
                    class="card-hover bg-white border-2 border-black shadow-[2px_2px_0px_#000] p-4 md:p-5">
                    <div class="flex items-center">
                        <div class="p-2 md:p-3 bg-sky-400 border-2 border-black mr-3 md:mr-4">
                            <i class="fas fa-credit-card text-black text-lg md:text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs md:text-sm text-black">Pembayaran Lunas</p>
                            <p class="text-xl md:text-2xl font-black text-black"><?php echo e($totalPembayaran); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div
                    class="card-hover bg-white border-2 border-black shadow-[2px_2px_0px_#000] p-4 md:p-5">
                    <div class="flex items-center">
                        <div class="p-2 md:p-3 bg-purple-400 border-2 border-black mr-3 md:mr-4">
                            <i class="fas fa-user-tag text-black text-lg md:text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs md:text-sm font-bold text-black">Status</p>
                            <p class="text-xl md:text-2xl font-black text-black capitalize"><?php echo e($penghuni->status_penghuni); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Details Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-6 mt-6 md:mt-8">
                <!-- Personal Information -->
                <div class="bg-gray-100 border-2 border-black p-5 md:p-6">
                    <h3 class="text-lg font-black text-black mb-4 flex items-center">
                        <i class="fas fa-user-circle text-green-400 mr-3"></i>
                        Informasi Pribadi
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-600">Username</p>
                            <p class="font-black text-black"><?php echo e($user->username); ?></p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">Jenis Kelamin</p>
                            <p class="font-black text-black">
                                <?php if($penghuni->jenis_kelamin == 'L'): ?>
                                    <i class="fas fa-mars text-blue-400 mr-1"></i>Laki-laki
                                <?php elseif($penghuni->jenis_kelamin == 'P'): ?>
                                    <i class="fas fa-venus text-pink-400 mr-1"></i>Perempuan
                                <?php else: ?>
                                    <span class="text-gray-600">Belum diisi</span>
                                <?php endif; ?>
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">Tanggal Lahir</p>
                            <p class="font-black text-black">
                                <?php echo e($penghuni->tanggal_lahir ? \Carbon\Carbon::parse($penghuni->tanggal_lahir)->format('d M Y') : '<span class="text-gray-600">Belum diisi</span>'); ?>

                            </p>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="bg-gray-100 border-2 border-black p-5 md:p-6">
                    <h3 class="text-lg font-black text-black mb-4 flex items-center">
                        <i class="fas fa-address-book text-blue-400 mr-3"></i>
                        Informasi Kontak
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-600">Nomor HP</p>
                            <p class="font-black text-black flex items-center">
                                <i class="fas fa-phone text-green-400 mr-2"></i>
                                <?php echo e($penghuni->no_hp); ?>

                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Email</p>
                            <p class="font-black text-black flex items-center">
                                <i class="fas fa-envelope text-green-400 mr-2"></i>
                                <?php echo e($penghuni->email); ?>

                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Alamat</p>
                            <p class="font-black text-black">
                                <?php echo e($penghuni->alamat ?: '<span class="text-gray-600">Belum diisi</span>'); ?>

                            </p>
                        </div>
                    </div>
                </div>

                <!-- Bank Information -->
                <div class="bg-gray-100 border-2 border-black p-5 md:p-6 lg:col-span-2">
                    <h3 class="text-lg font-black text-black mb-4 flex items-center">
                        <i class="fas fa-university text-green-400 mr-3"></i>
                        Data Rekening Bank
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm text-gray-600">Nama Bank</p>
                            <p class="font-black text-black flex items-center">
                                <i class="fas fa-money-check mr-2 text-green-400"></i>
                                <?php echo e($penghuni->nama_bank ?: 'Belum diisi'); ?>

                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Nomor Rekening</p>
                            <p class="font-black text-black flex items-center">
                                <i class="fas fa-credit-card mr-2 text-blue-400"></i>
                                <?php echo e($penghuni->nomor_rekening ?: 'Belum diisi'); ?>

                            </p>
                        </div>
                    </div>
                </div>

                <!-- Account Information -->
                <div class="bg-gray-100 border-2 border-black p-5 md:p-6 lg:col-span-2">
                    <h3 class="text-lg font-black text-black mb-4 flex items-center">
                        <i class="fas fa-key text-yellow-400 mr-3"></i>
                        Informasi Akun
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm text-gray-600">Role</p>
                                    <p class="font-black text-black">
                                        <span
                                            class="px-3 py-1 text-sm font-black bg-emerald-400 text-black border-2 border-black">
                                            <?php echo e(ucfirst($penghuni->role)); ?>

                                        </span>
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Status Akun</p>
                                    <p class="font-black text-black">
                                        <span
                                            class="px-3 py-1 text-sm font-black border-2 border-black
                                            <?php echo e($penghuni->status_penghuni == 'aktif' ? 'bg-emerald-400 text-black' :
                        ($penghuni->status_penghuni == 'calon' ? 'bg-yellow-400 text-black' : 'bg-red-400 text-black')); ?>">
                                            <?php echo e(ucfirst($penghuni->status_penghuni)); ?>

                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm text-gray-600">Terakhir Login</p>
                                    <p class="font-black text-black">
                                        <i class="fas fa-clock text-gray-600 mr-2"></i>
                                        <?php echo e($penghuni->updated_at->format('d M Y H:i')); ?>

                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Member Sejak</p>
                                    <p class="font-black text-black">
                                        <i class="fas fa-calendar-check text-gray-600 mr-2"></i>
                                        <?php echo e($penghuni->created_at->format('d M Y')); ?>

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="<?php echo e(route('penghuni.kontrak.index')); ?>" 
           class="bg-white border-2 border-black shadow-[2px_2px_0px_#000] p-4 hover:border-emerald-500 transition-all duration-300 group">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-emerald-400 border-2 border-black flex items-center justify-center mr-3">
                    <i class="fas fa-file-contract text-black"></i>
                </div>
                <div>
                    <h4 class="font-black text-black group-hover:text-black">Kontrak Saya</h4>
                    <p class="text-xs text-gray-600"><?php echo e($kontrakAktif ?? 0); ?> kontrak aktif</p>
                </div>
            </div>
        </a>
        
        <a href="<?php echo e(route('penghuni.pembayaran.index')); ?>" 
           class="bg-white border-2 border-black shadow-[2px_2px_0px_#000] p-4 hover:border-sky-500 transition-all duration-300 group">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-sky-400 border-2 border-black flex items-center justify-center mr-3">
                    <i class="fas fa-credit-card text-black"></i>
                </div>
                <div>
                    <h4 class="font-black text-black group-hover:text-black">Pembayaran</h4>
                    <p class="text-xs text-gray-600"><?php echo e($totalPembayaran ?? 0); ?> pembayaran lunas</p>
                </div>
            </div>
        </a>
        
        <a href="<?php echo e(route('penghuni.reviews.history')); ?>" 
           class="bg-white border-2 border-black shadow-[2px_2px_0px_#000] p-4 hover:border-yellow-500 transition-all duration-300 group">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-yellow-400 border-2 border-black flex items-center justify-center mr-3">
                    <i class="fas fa-star text-black"></i>
                </div>
                <div>
                    <h4 class="font-black text-black group-hover:text-black">Review Saya</h4>
                    <p class="text-xs text-gray-600"><?php echo e($totalReview ?? 0); ?> review ditulis</p>
                </div>
            </div>
        </a>
    </div>
</div>

    <!-- Upload Photo Modal -->
    <div id="uploadModal" class="fixed inset-0 bg-black/70  hidden items-center justify-center z-50">
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 max-w-md w-full mx-4 shadow-[4px_4px_0px_#000]">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-black text-black">Upload Foto Profil</h3>
                <button onclick="closeUploadModal()" class="text-gray-600 hover:text-black">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <form id="uploadPhotoForm" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                        <div class="text-center mb-4">
                            <label for="photoInput" 
                                   class="block w-full h-40 border-2 border-dashed border-black  flex items-center justify-center cursor-pointer hover:border-green-500 transition">
                                <div id="photoPreview"
                            class="w-32 h-32 mx-auto  border-2 border-dashed border-black bg-gray-100 flex items-center justify-center mb-4">
                            <i class="fas fa-user-circle text-4xl text-gray-600"></i>
                        </div>
                        <p class="text-sm text-gray-600">Pratinjau foto profil</p>
                    </div>

                    <!-- File Input -->
                    <div class="relative">
                        <input type="file" name="foto_profil" id="photoInput" accept="image/*" class="hidden" required>
                        <label for="photoInput"
                            class="block w-full px-4 py-3 border-2 border-dashed border-black  text-center cursor-pointer hover:border-green-500 transition">
                            <i class="fas fa-cloud-upload-alt text-green-400 text-xl mb-2"></i>
                            <p class="text-black font-black">Pilih Foto</p>
                            <p class="text-xs text-gray-600 mt-1">Format: JPG, PNG, GIF. Max: 2MB</p>
                        </label>
                    </div>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeUploadModal()"
                        class="px-4 py-2.5 border-2 border-black text-gray-600  hover:text-black hover:border-black/80 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2.5 bg-lime-400 border-2 border-black shadow-[2px_2px_0px_#000] text-black  hover:bg-yellow-500  transition-all duration-300 flex items-center">
                        <i class="fas fa-upload mr-2"></i>
                        Upload
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
        <script>
            // Image preview
            const photoInput = document.getElementById('photoInput');
            const imagePreview = document.getElementById('imagePreview');

            photoInput.addEventListener('change', function (e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        imagePreview.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover ">`;
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Modal functions
            function openUploadModal() {
                document.getElementById('uploadModal').classList.remove('hidden');
                document.getElementById('uploadModal').classList.add('flex');
                document.body.classList.add('overflow-hidden');
            }

            function closeUploadModal() {
                document.getElementById('uploadModal').classList.add('hidden');
                document.getElementById('uploadModal').classList.remove('flex');
                document.getElementById('photoInput').value = '';
                imagePreview.innerHTML = '<i class="fas fa-user-circle text-4xl text-gray-600"></i>';
                document.body.classList.remove('overflow-hidden');
            }

            // Form submission
            document.getElementById('uploadForm').addEventListener('submit', function (e) {
                e.preventDefault();

                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Uploading...';
                submitBtn.disabled = true;

                const formData = new FormData(this);

                fetch('/api/penghuni/profile/upload-photo', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                        'Accept': 'application/json'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            submitBtn.innerHTML = '<i class="fas fa-check mr-2"></i> Success!';
                            submitBtn.classList.remove('from-green-500', 'to-emerald-500', 'hover:bg-yellow-500', '');
                            submitBtn.classList.add('from-green-500', 'to-green-600');

                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        } else {
                            alert('Upload gagal: ' + (data.message || 'Terjadi kesalahan'));
                            submitBtn.innerHTML = originalText;
                            submitBtn.disabled = false;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat upload');
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    });
            });

            // Close modal on ESC key
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    closeUploadModal();
                }
            });

            // Close modal when clicking outside
            document.getElementById('uploadModal').addEventListener('click', function (e) {
                if (e.target === this) {
                    closeUploadModal();
                }
            });
    </script>
    <?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views\penghuni\profile\show.blade.php ENDPATH**/ ?>