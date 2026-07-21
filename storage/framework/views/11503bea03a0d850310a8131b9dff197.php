<?php $__env->startSection('title', 'Cara Memesan - AyoKos'); ?>

<?php $__env->startSection('content'); ?>



<!-- ==================== HERO SECTION ==================== -->
<section class="bg-yellow-400 py-20 md:py-28 border-b-4 border-black">
    <div class="container mx-auto px-4 text-center" data-aos="fade-up" data-aos-duration="1000">
        <div class="w-20 h-20 md:w-24 md:h-24 bg-black border-4 border-black shadow-[4px_4px_0px_#000] flex items-center justify-center mx-auto mb-8">
            <i class="fas fa-map-signs text-white text-3xl md:text-4xl"></i>
        </div>

        <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-black mb-6 leading-tight tracking-tight">
            Cara Memesan <span class="bg-black text-white px-3">Kos Impian</span>
        </h1>

        <p class="text-lg md:text-xl text-gray-800 font-bold max-w-3xl mx-auto leading-relaxed mb-8">
            Ikuti panduan langkah demi langkah untuk menemukan dan memesan kos yang sempurna untuk Anda. 
            Proses mudah, transparan, dan aman.
        </p>

        <div class="flex flex-wrap justify-center gap-3">
            <span class="px-4 py-2 border-2 border-black bg-black text-white font-black text-sm shadow-[2px_2px_0px_#000]">
                <i class="fas fa-clock mr-1.5"></i> 5 Langkah Mudah
            </span>
            <span class="px-4 py-2 border-2 border-black bg-white text-black font-black text-sm shadow-[2px_2px_0px_#000]">
                <i class="fas fa-shield-alt mr-1.5"></i> Aman & Terpercaya
            </span>
            <span class="px-4 py-2 border-2 border-black bg-white text-black font-black text-sm shadow-[2px_2px_0px_#000]">
                <i class="fas fa-bolt mr-1.5"></i> Proses Cepat
            </span>
        </div>
    </div>
</section>

<!-- ==================== LANGKAH-LANGKAH ==================== -->
<section class="section-padding bg-white">
    <div class="container mx-auto px-4 max-w-5xl">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="inline-block px-4 py-1 text-sm font-black bg-pink-400 text-black border-2 border-black shadow-[2px_2px_0px_#000] mb-3">Panduan</span>
            <h2 class="text-3xl md:text-4xl font-black text-black mb-4">5 Langkah <span class="bg-black text-white px-2">Sederhana</span></h2>
            <p class="text-gray-600 font-bold max-w-xl mx-auto">Dari pencarian hingga check-in, kami memandu Anda di setiap langkah</p>
        </div>

        <div class="relative space-y-12">
            <!-- Step 1: Cari Kos -->
            <div class="flex flex-col md:flex-row items-start gap-6 md:gap-10 relative" data-aos="fade-up">
                <div class="w-14 h-14 bg-yellow-400 text-black text-xl font-black border-2 border-black shadow-[3px_3px_0px_#000] flex items-center justify-center flex-shrink-0" data-aos="zoom-in">
                    1
                </div>
                <div class="flex-1 w-full">
                    <div class="flex items-center gap-3 mb-4">
                        <h3 class="text-xl md:text-2xl font-black text-black">Cari Kos yang Tepat</h3>
                        <span class="hidden md:inline-flex items-center px-3 py-1 text-xs font-black bg-lime-400 text-black border-2 border-black">
                            Mulai Disini
                        </span>
                    </div>
                    
                    <div class="bg-white border-2 border-black p-6 shadow-[3px_3px_0px_#000]">
                        <div class="grid md:grid-cols-3 gap-4 mb-6">
                            <div class="flex items-start gap-3 p-3 bg-gray-100 border-2 border-black">
                                <div class="w-10 h-10 bg-pink-400 border-2 border-black flex items-center justify-center text-black shrink-0">
                                    <i class="fas fa-search"></i>
                                </div>
                                <div>
                                    <h4 class="font-black text-black text-sm">Filter Pintar</h4>
                                    <p class="text-xs font-bold text-gray-600 mt-0.5">Cari berdasarkan lokasi, harga, dan fasilitas</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-gray-100 border-2 border-black">
                                <div class="w-10 h-10 bg-pink-400 border-2 border-black flex items-center justify-center text-black shrink-0">
                                    <i class="fas fa-images"></i>
                                </div>
                                <div>
                                    <h4 class="font-black text-black text-sm">Detail Lengkap</h4>
                                    <p class="text-xs font-bold text-gray-600 mt-0.5">Foto, fasilitas, dan peraturan kos</p>
                                </div>
                            </div>
            <div class="flex items-start gap-3 p-3 bg-gray-100 border-2 border-black">
                <div class="w-10 h-10 bg-pink-400 border-2 border-black flex items-center justify-center text-black shrink-0">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div>
                    <h4 class="font-black text-black text-sm">Peta Interaktif</h4>
                    <p class="text-xs font-bold text-gray-600 mt-0.5">Lihat lokasi kos di peta</p>
                </div>
            </div>
        </div>
        
        <div class="flex flex-wrap gap-2 mt-4">
            <span class="px-3 py-1 text-xs font-bold bg-yellow-100 text-black border-2 border-black"><i class="fas fa-check-circle mr-1 text-yellow-600"></i>Tips: Gunakan filter untuk hasil lebih akurat</span>
        </div>
        
        <a href="<?php echo e(route('public.kos.index')); ?>"
            class="inline-flex items-center px-5 py-2.5 bg-black text-white font-black border-2 border-black shadow-[3px_3px_0px_#000] hover:shadow-[4px_4px_0px_#000] hover:translate-y-[-1px] transition-all uppercase tracking-wide mt-4">
            <i class="fas fa-search mr-2"></i> Mulai Cari Kos
        </a>
    </div>
</div>
            </div>
            <div class="step-connector hidden md:block"></div>
        </div>

            <!-- Step 2: Daftar/Login -->
            <div class="flex flex-col md:flex-row items-start gap-6 md:gap-10 relative" data-aos="fade-up">
                <div class="w-14 h-14 bg-yellow-400 text-black text-xl font-black border-2 border-black shadow-[3px_3px_0px_#000] flex items-center justify-center flex-shrink-0" data-aos="zoom-in" data-aos-delay="100">
                    2
                </div>
                <div class="flex-1 w-full">
                    <div class="flex items-center gap-3 mb-4">
                        <h3 class="text-xl md:text-2xl font-black text-black">Daftar atau Login Akun</h3>
                    </div>
                    
                    <div class="bg-white border-2 border-black p-6 shadow-[3px_3px_0px_#000]">
                        <div class="grid md:grid-cols-2 gap-6">
                            <!-- Register -->
                            <div class="p-5 bg-gray-100 border-2 border-black">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="w-10 h-10 bg-pink-400 border-2 border-black flex items-center justify-center text-black">
                                        <i class="fas fa-user-plus"></i>
                                    </div>
                                    <h4 class="font-black text-black">Belum Punya Akun?</h4>
                                </div>
                                <ul class="space-y-3 text-sm font-bold text-gray-600">
                                    <li class="flex items-start gap-2">
                                        <i class="fas fa-check text-pink-500 mt-0.5 text-xs"></i>
                                        <span>Klik tombol <strong class="text-black">"Daftar"</strong> di pojok kanan atas</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <i class="fas fa-check text-pink-500 mt-0.5 text-xs"></i>
                                        <span>Isi data diri lengkap dengan benar</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <i class="fas fa-check text-pink-500 mt-0.5 text-xs"></i>
                                        <span>Verifikasi email untuk mengaktifkan akun</span>
                                    </li>
                                </ul>
                            </div>
                            
                            <!-- Login -->
                            <div class="p-5 bg-gray-100 border-2 border-black">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="w-10 h-10 bg-yellow-400 border-2 border-black flex items-center justify-center text-black">
                                        <i class="fas fa-sign-in-alt"></i>
                                    </div>
                                    <h4 class="font-black text-black">Sudah Punya Akun?</h4>
                                </div>
                                <ul class="space-y-3 text-sm font-bold text-gray-600">
                                    <li class="flex items-start gap-2">
                                        <i class="fas fa-check text-emerald-500 mt-0.5 text-xs"></i>
                                        <span>Login dengan <strong class="text-black">username dan password</strong></span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <i class="fas fa-check text-emerald-500 mt-0.5 text-xs"></i>
                                        <span>Pastikan data profil sudah lengkap</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <i class="fas fa-check text-emerald-500 mt-0.5 text-xs"></i>
                                        <span>Siap untuk mengajukan kontrak sewa</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="step-connector hidden md:block"></div>
            </div>

            <!-- Step 3: Ajukan Kontrak -->
            <div class="flex flex-col md:flex-row items-start gap-6 md:gap-10 relative" data-aos="fade-up">
                <div class="w-14 h-14 bg-yellow-400 text-black text-xl font-black border-2 border-black shadow-[3px_3px_0px_#000] flex items-center justify-center flex-shrink-0" data-aos="zoom-in" data-aos-delay="200">
                    3
                </div>
                <div class="flex-1 w-full">
                    <div class="flex items-center gap-3 mb-4">
                        <h3 class="text-xl md:text-2xl font-black text-black">Ajukan Kontrak Sewa</h3>
                    </div>
                    
                    <div class="bg-white border-2 border-black p-6 shadow-[3px_3px_0px_#000]">
                        <div class="grid md:grid-cols-2 gap-4 mb-6">
                            <div class="flex items-start gap-3 p-3 bg-gray-100 border-2 border-black">
                                <div class="w-8 h-8 bg-purple-300 border-2 border-black flex items-center justify-center text-black text-sm">
                                    <i class="fas fa-door-open"></i>
                                </div>
                                <div>
                                    <h4 class="font-black text-black text-sm">Pilih Kamar</h4>
                                    <p class="text-xs font-bold text-gray-600 mt-0.5">Pilih kamar yang tersedia pada kos yang diinginkan</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-gray-100 border-2 border-black">
                                <div class="w-8 h-8 bg-purple-300 border-2 border-black flex items-center justify-center text-black text-sm">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <div>
                                    <h4 class="font-black text-black text-sm">Isi Formulir</h4>
                                    <p class="text-xs font-bold text-gray-600 mt-0.5">Lengkapi data pengajuan kontrak dengan benar</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-gray-100 border-2 border-black">
                                <div class="w-8 h-8 bg-purple-300 border-2 border-black flex items-center justify-center text-black text-sm">
                                    <i class="fas fa-id-card"></i>
                                </div>
                                <div>
                                    <h4 class="font-black text-black text-sm">Upload KTP</h4>
                                    <p class="text-xs font-bold text-gray-600 mt-0.5">Foto KTP yang jelas dan valid untuk verifikasi</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-gray-100 border-2 border-black">
                                <div class="w-8 h-8 bg-purple-300 border-2 border-black flex items-center justify-center text-black text-sm">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div>
                                    <h4 class="font-black text-black text-sm">Tentukan Durasi</h4>
                                    <p class="text-xs font-bold text-gray-600 mt-0.5">Pilih periode sewa yang sesuai kebutuhan Anda</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-purple-200 border-2 border-black p-4 flex items-start gap-3">
                            <i class="fas fa-info-circle text-black mt-0.5"></i>
                            <div>
                                <p class="text-sm font-black text-black">Proses Verifikasi</p>
                                <p class="text-xs font-bold text-gray-700 mt-1 leading-relaxed">
                                    Pengajuan kontrak akan diverifikasi oleh pemilik kos dalam waktu <strong>1-3 hari kerja</strong>. Anda akan menerima notifikasi via email dan dashboard.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="step-connector hidden md:block"></div>
            </div>

            <!-- Step 4: Bayar Uang Muka -->
            <div class="flex flex-col md:flex-row items-start gap-6 md:gap-10 relative" data-aos="fade-up">
                <div class="w-14 h-14 bg-yellow-400 text-black text-xl font-black border-2 border-black shadow-[3px_3px_0px_#000] flex items-center justify-center flex-shrink-0" data-aos="zoom-in" data-aos-delay="300">
                    4
                </div>
                <div class="flex-1 w-full">
                    <div class="flex items-center gap-3 mb-4">
                        <h3 class="text-xl md:text-2xl font-black text-black">Bayar Uang Muka</h3>
                    </div>
                    
                    <div class="bg-white border-2 border-black p-6 shadow-[3px_3px_0px_#000]">
                        <div class="mb-6">
                            <h4 class="font-black text-black mb-4 flex items-center text-sm uppercase tracking-wider">
                                <i class="fas fa-credit-card text-yellow-500 mr-2"></i> Metode Pembayaran
                            </h4>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                <div class="bg-white border-2 border-black p-4 text-center hover:shadow-[2px_2px_0px_#000] transition-shadow">
                                    <div class="w-10 h-10 bg-yellow-100 border-2 border-black flex items-center justify-center mx-auto mb-2 text-black">
                                        <i class="fas fa-university"></i>
                                    </div>
                                    <p class="text-xs font-black text-black">Transfer Bank</p>
                                </div>
                                <div class="bg-white border-2 border-black p-4 text-center hover:shadow-[2px_2px_0px_#000] transition-shadow">
                                    <div class="w-10 h-10 bg-yellow-100 border-2 border-black flex items-center justify-center mx-auto mb-2 text-black">
                                        <i class="fas fa-qrcode"></i>
                                    </div>
                                    <p class="text-xs font-black text-black">QRIS</p>
                                </div>
                                <div class="bg-white border-2 border-black p-4 text-center hover:shadow-[2px_2px_0px_#000] transition-shadow">
                                    <div class="w-10 h-10 bg-yellow-100 border-2 border-black flex items-center justify-center mx-auto mb-2 text-black">
                                        <i class="fas fa-wallet"></i>
                                    </div>
                                    <p class="text-xs font-black text-black">E-Wallet</p>
                                </div>
                                <div class="bg-white border-2 border-black p-4 text-center hover:shadow-[2px_2px_0px_#000] transition-shadow">
                                    <div class="w-10 h-10 bg-yellow-100 border-2 border-black flex items-center justify-center mx-auto mb-2 text-black">
                                        <i class="fas fa-mobile-alt"></i>
                                    </div>
                                    <p class="text-xs font-black text-black">Virtual Account</p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <div class="flex items-start gap-3 p-3 bg-gray-100 border-2 border-black">
                                <i class="fas fa-clock text-yellow-600 mt-0.5"></i>
                                <p class="text-sm font-bold text-gray-700">Lakukan pembayaran uang muka setelah kontrak disetujui pemilik kos</p>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-gray-100 border-2 border-black">
                                <i class="fas fa-upload text-yellow-600 mt-0.5"></i>
                                <p class="text-sm font-bold text-gray-700">Upload bukti pembayaran melalui dashboard Anda</p>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-gray-100 border-2 border-black">
                                <i class="fas fa-hourglass-half text-yellow-600 mt-0.5"></i>
                                <p class="text-sm font-bold text-gray-700">Tunggu konfirmasi dari sistem (maksimal <strong class="text-black">24 jam</strong>)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="step-connector hidden md:block"></div>
            </div>

            <!-- Step 5: Mulai Tinggal -->
            <div class="flex flex-col md:flex-row items-start gap-6 md:gap-10 relative" data-aos="fade-up">
                <div class="w-14 h-14 bg-yellow-400 text-black text-xl font-black border-2 border-black shadow-[3px_3px_0px_#000] flex items-center justify-center flex-shrink-0" data-aos="zoom-in" data-aos-delay="400">
                    5
                </div>
                <div class="flex-1 w-full">
                    <div class="flex items-center gap-3 mb-4">
                        <h3 class="text-xl md:text-2xl font-black text-black">Mulai Tinggal</h3>
                        <span class="hidden md:inline-flex items-center px-3 py-1 text-xs font-black bg-emerald-400 text-black border-2 border-black">
                            <i class="fas fa-check mr-1"></i> Selesai
                        </span>
                    </div>
                    
                    <div class="bg-white border-2 border-black p-6 shadow-[3px_3px_0px_#000]">
                        <div class="bg-emerald-200 border-2 border-black p-4 mb-6 flex items-center gap-3">
                            <div class="w-12 h-12 bg-emerald-400 border-2 border-black flex items-center justify-center text-black shrink-0">
                                <i class="fas fa-check-circle text-xl"></i>
                            </div>
                            <div>
                                <p class="font-black text-black">Kontrak Anda telah aktif!</p>
                                <p class="text-xs font-bold text-gray-700 mt-0.5">Sekarang Anda bisa mulai koordinasi check-in dengan pemilik kos</p>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-4 mb-6">
                            <div class="flex items-start gap-3 p-3 bg-gray-100 border-2 border-black">
                                <div class="w-8 h-8 bg-rose-300 border-2 border-black flex items-center justify-center text-black text-sm">
                                    <i class="fas fa-search"></i>
                                </div>
                                <div>
                                    <h4 class="font-black text-black text-sm">Cek Kondisi</h4>
                                    <p class="text-xs font-bold text-gray-600 mt-0.5">Lakukan pengecekan kondisi kamar bersama pemilik</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-gray-100 border-2 border-black">
                                <div class="w-8 h-8 bg-rose-300 border-2 border-black flex items-center justify-center text-black text-sm">
                                    <i class="fas fa-home"></i>
                                </div>
                                <div>
                                    <h4 class="font-black text-black text-sm">Check-in</h4>
                                    <p class="text-xs font-bold text-gray-600 mt-0.5">Anda sudah bisa menempati kamar yang dipesan</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-sky-200 border-2 border-black p-4 flex items-start gap-3">
                            <i class="fas fa-lightbulb text-black mt-0.5"></i>
                            <div>
                                <p class="text-sm font-black text-black">Tips Penting</p>
                                <p class="text-xs font-bold text-gray-700 mt-1 leading-relaxed">
                                    Jangan lupa untuk membayar tagihan bulanan tepat waktu melalui dashboard Anda. Aktifkan notifikasi untuk pengingat pembayaran otomatis.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== FAQ SECTION ==================== -->
<section class="section-padding bg-white border-t-4 border-black">
    <div class="container mx-auto px-4 max-w-3xl">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="inline-block px-4 py-1 text-sm font-black bg-pink-400 text-black border-2 border-black shadow-[2px_2px_0px_#000] mb-3">FAQ</span>
            <h2 class="text-3xl md:text-4xl font-black text-black mb-4">Pertanyaan <span class="bg-black text-white px-2">Umum</span></h2>
            <p class="text-gray-600 font-bold max-w-xl mx-auto">Temukan jawaban untuk pertanyaan yang sering diajukan</p>
        </div>

        <div data-aos="fade-up">
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFAQ(this)">
                    <span>Berapa lama proses verifikasi kontrak?</span>
                    <i class="fas fa-chevron-down faq-icon"></i>
                </button>
                <div class="faq-answer">
                    Proses verifikasi biasanya memakan waktu <strong>1-3 hari kerja</strong>. Pemilik kos akan mengecek kelengkapan data dan dokumen yang Anda submit. Anda akan menerima notifikasi via email dan dashboard setelah verifikasi selesai.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question" onclick="toggleFAQ(this)">
                    <span>Apa yang terjadi jika kontrak ditolak?</span>
                    <i class="fas fa-chevron-down faq-icon"></i>
                </button>
                <div class="faq-answer">
                    Jika kontrak ditolak, Anda akan mendapatkan notifikasi beserta alasannya. Anda dapat mengajukan ulang dengan melengkapi data yang diminta atau mencari kos lain yang lebih sesuai.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question" onclick="toggleFAQ(this)">
                    <span>Bagaimana jika ada masalah selama tinggal?</span>
                    <i class="fas fa-chevron-down faq-icon"></i>
                </button>
                <div class="faq-answer">
                    Anda dapat melaporkan masalah melalui dashboard atau menghubungi pemilik kos langsung. AyoKos juga menyediakan fitur pelaporan dan mediasi jika diperlukan.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question" onclick="toggleFAQ(this)">
                    <span>Apakah uang muka bisa dikembalikan?</span>
                    <i class="fas fa-chevron-down faq-icon"></i>
                </button>
                <div class="faq-answer">
                    Kebijakan pengembalian uang muka tergantung pada ketentuan masing-masing pemilik kos. Pastikan untuk membaca syarat dan ketentuan kontrak sebelum melakukan pembayaran.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question" onclick="toggleFAQ(this)">
                    <span>Bisakah saya mengubah durasi sewa setelah kontrak aktif?</span>
                    <i class="fas fa-chevron-down faq-icon"></i>
                </button>
                <div class="faq-answer">
                    Ya, Anda dapat mengajukan perpanjangan atau perubahan durasi sewa melalui dashboard. Namun, perubahan tersebut memerlukan persetujuan dari pemilik kos.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== CTA FINAL ==================== -->
<section class="section-padding bg-black border-t-4 border-yellow-400">
    <div class="container mx-auto px-4 text-center" data-aos="fade-up">
        <h2 class="text-3xl md:text-5xl font-black text-yellow-400 mb-4">Siap Mencari Kos Impian Anda?</h2>
        <p class="text-lg text-gray-300 font-bold mb-8 max-w-2xl mx-auto">
            Bergabunglah dengan ribuan penghuni yang telah menemukan rumah kedua mereka melalui AyoKos. Proses mudah, transparan, dan aman.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?php echo e(route('public.kos.index')); ?>" class="px-8 py-4 bg-yellow-400 hover:bg-yellow-500 text-black font-black border-2 border-yellow-400 shadow-[4px_4px_0px_#fff] hover:translate-y-[-2px] transition-all uppercase tracking-wide text-lg">
                <i class="fas fa-search mr-2"></i> Mulai Pencarian
            </a>
            <?php if(auth()->guard()->guest()): ?>
            <a href="<?php echo e(route('register')); ?>" class="px-8 py-4 bg-white text-black font-black border-2 border-white shadow-[4px_4px_0px_#fff] hover:bg-gray-200 hover:translate-y-[-2px] transition-all uppercase tracking-wide text-lg">
                <i class="fas fa-user-plus mr-2"></i> Daftar Gratis
            </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // FAQ Toggle
    function toggleFAQ(btn) {
        const item = btn.closest('.faq-item');
        const isActive = item.classList.contains('active');
        
        // Tutup semua
        document.querySelectorAll('.faq-item').forEach(el => el.classList.remove('active'));
        
        // Buka yang diklik jika sebelumnya tidak aktif
        if (!isActive) {
            item.classList.add('active');
        }
    }

    // Mobile touch feedback
    document.addEventListener('DOMContentLoaded', function() {
        const interactiveElements = document.querySelectorAll('button, a, .card-hover, .payment-card');
        interactiveElements.forEach(el => {
            el.addEventListener('touchstart', function() { this.style.opacity = '0.85'; });
            el.addEventListener('touchend', function() { this.style.opacity = '1'; });
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/public/pages/howto.blade.php ENDPATH**/ ?>