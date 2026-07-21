<?php $__env->startSection('title', 'Kebijakan Privasi - AyoKos'); ?>

<?php $__env->startSection('content'); ?>



<!-- ==================== HERO SECTION ==================== -->
<section class="bg-yellow-400 py-16 md:py-20 border-b-4 border-black">
    <div class="container mx-auto px-4 text-center" data-aos="fade-up" data-aos-duration="1000">
        <div class="w-20 h-20 md:w-24 md:h-24 bg-black border-4 border-black shadow-[4px_4px_0px_#000] flex items-center justify-center mx-auto mb-8">
            <i class="fas fa-shield-alt text-white text-3xl md:text-4xl"></i>
        </div>

        <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-black mb-6 leading-tight tracking-tight">
            Kebijakan <span class="bg-black text-white px-3">Privasi</span>
        </h1>

        <p class="text-lg md:text-xl text-gray-800 font-black max-w-3xl mx-auto leading-relaxed mb-8">
            Kami menghargai privasi Anda dan berkomitmen untuk melindungi data pribadi yang Anda berikan. 
            Pelajari bagaimana kami mengelola informasi Anda.
        </p>

        <div class="inline-flex items-center px-4 py-2 border-2 border-black bg-black text-white font-black text-sm shadow-[2px_2px_0px_#000]">
            <i class="fas fa-calendar-alt mr-2"></i>
            Terakhir diperbarui: <?php echo e(date('d F Y')); ?>

        </div>
    </div>
</section>

<!-- ==================== KONTEN KEBIJAKAN PRIVASI ==================== -->
<section class="section-padding bg-white">
    <div class="container mx-auto px-4 max-w-4xl">
        
        <!-- Pengantar -->
        <div class="mb-16" data-aos="fade-up">
            <div class="bg-white border-2 border-black  p-8 shadow-[2px_2px_0px_#000] card-hover">
                <div class="flex items-start gap-5">
                <div class="w-14 h-14 bg-pink-400 border-2 border-black flex items-center justify-center text-black text-2xl shrink-0">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-black text-black mb-4">Pengantar</h2>
                    <div class="space-y-3 text-gray-600 font-bold leading-relaxed">
                            <p>
                                Kebijakan Privasi ini menjelaskan bagaimana AyoKos mengumpulkan, menggunakan, menyimpan, 
                                dan melindungi informasi pribadi Anda ketika Anda menggunakan platform kami.
                            </p>
                            <p>
                                Dengan menggunakan AyoKos, Anda menyetujui pengumpulan dan penggunaan informasi sesuai dengan 
                                kebijakan ini. Jika Anda tidak setuju, mohon untuk tidak menggunakan platform kami.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 1: Informasi yang Kami Kumpulkan -->
        <div class="mb-16" data-aos="fade-up">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-10 h-10 bg-yellow-400 border-2 border-black flex items-center justify-center text-black font-black">1</div>
                <h2 class="text-2xl md:text-3xl font-black text-black">Informasi yang Kami Kumpulkan</h2>
            </div>

            <!-- Informasi Pribadi -->
            <div class="bg-white border-2 border-black p-6 md:p-8 shadow-[3px_3px_0px_#000] mb-6">
                <h3 class="text-xl font-black text-black mb-6 flex items-center">
                    <i class="fas fa-user-circle text-sky-500 mr-3"></i> Informasi Pribadi
                </h3>
                
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="p-5 bg-gray-100  border-2 border-black">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-sky-100  flex items-center justify-center text-sky-600">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <h4 class="font-black text-black">Saat Pendaftaran</h4>
                        </div>
                        <ul class="space-y-2.5">
                            <li class="list-check text-sm text-gray-600">
                                <i class="fas fa-circle text-sky-500"></i>
                                <span>Nama lengkap</span>
                            </li>
                            <li class="list-check text-sm text-gray-600">
                                <i class="fas fa-circle text-sky-500"></i>
                                <span>Alamat email</span>
                            </li>
                            <li class="list-check text-sm text-gray-600">
                                <i class="fas fa-circle text-sky-500"></i>
                                <span>Nomor telepon</span>
                            </li>
                            <li class="list-check text-sm text-gray-600">
                                <i class="fas fa-circle text-sky-500"></i>
                                <span>Username dan password</span>
                            </li>
                        </ul>
                    </div>

                    <div class="p-5 bg-gray-100  border-2 border-black">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-emerald-100  flex items-center justify-center text-emerald-600">
                                <i class="fas fa-file-contract"></i>
                            </div>
                            <h4 class="font-black text-black">Saat Transaksi</h4>
                        </div>
                        <ul class="space-y-2.5">
                            <li class="list-check text-sm text-gray-600">
                                <i class="fas fa-circle text-emerald-500"></i>
                                <span>Foto KTP (untuk verifikasi)</span>
                            </li>
                            <li class="list-check text-sm text-gray-600">
                                <i class="fas fa-circle text-emerald-500"></i>
                                <span>Alamat domisili</span>
                            </li>
                            <li class="list-check text-sm text-gray-600">
                                <i class="fas fa-circle text-emerald-500"></i>
                                <span>Data pembayaran</span>
                            </li>
                            <li class="list-check text-sm text-gray-600">
                                <i class="fas fa-circle text-emerald-500"></i>
                                <span>Bukti pembayaran</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Informasi Penggunaan -->
            <div class="bg-white border-2 border-black p-6 md:p-8 shadow-[3px_3px_0px_#000]">
                <h3 class="text-xl font-black text-black mb-6 flex items-center">
                    <i class="fas fa-chart-line text-sky-500 mr-3"></i> Informasi Penggunaan
                </h3>
                
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="p-5 bg-gray-100  border-2 border-black">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-indigo-100  flex items-center justify-center text-indigo-600">
                                <i class="fas fa-server"></i>
                            </div>
                            <h4 class="font-black text-black">Data Teknis</h4>
                        </div>
                        <ul class="space-y-2.5">
                            <li class="list-check text-sm text-gray-600">
                                <i class="fas fa-circle text-indigo-500"></i>
                                <span>Alamat IP</span>
                            </li>
                            <li class="list-check text-sm text-gray-600">
                                <i class="fas fa-circle text-indigo-500"></i>
                                <span>Jenis browser dan versi</span>
                            </li>
                            <li class="list-check text-sm text-gray-600">
                                <i class="fas fa-circle text-indigo-500"></i>
                                <span>Sistem operasi</span>
                            </li>
                            <li class="list-check text-sm text-gray-600">
                                <i class="fas fa-circle text-indigo-500"></i>
                                <span>Data cookies</span>
                            </li>
                        </ul>
                    </div>

                    <div class="p-5 bg-gray-100  border-2 border-black">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-purple-100  flex items-center justify-center text-purple-600">
                                <i class="fas fa-mouse-pointer"></i>
                            </div>
                            <h4 class="font-black text-black">Data Aktivitas</h4>
                        </div>
                        <ul class="space-y-2.5">
                            <li class="list-check text-sm text-gray-600">
                                <i class="fas fa-circle text-purple-500"></i>
                                <span>Halaman yang dikunjungi</span>
                            </li>
                            <li class="list-check text-sm text-gray-600">
                                <i class="fas fa-circle text-purple-500"></i>
                                <span>Waktu akses</span>
                            </li>
                            <li class="list-check text-sm text-gray-600">
                                <i class="fas fa-circle text-purple-500"></i>
                                <span>Interaksi dengan platform</span>
                            </li>
                            <li class="list-check text-sm text-gray-600">
                                <i class="fas fa-circle text-purple-500"></i>
                                <span>Pencarian yang dilakukan</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 2: Bagaimana Kami Menggunakan Informasi -->
        <div class="mb-16" data-aos="fade-up">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-10 h-10 bg-yellow-400 border-2 border-black flex items-center justify-center text-black font-black">2</div>
                <h2 class="text-2xl md:text-3xl font-black text-black">Bagaimana Kami Menggunakan Informasi Anda</h2>
            </div>

            <div class="grid md:grid-cols-2 gap-5">
                <div class="bg-white border-2 border-black  p-6 shadow-[2px_2px_0px_#000] card-hover border-transition">
                    <div class="w-12 h-12 bg-sky-50  flex items-center justify-center text-sky-600 text-xl mb-4">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <h4 class="font-black text-black mb-2">Menyediakan Layanan</h4>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Untuk memproses pendaftaran, mengelola akun, dan menyediakan layanan yang Anda minta secara optimal.
                    </p>
                </div>

                <div class="bg-white border-2 border-black  p-6 shadow-[2px_2px_0px_#000] card-hover border-transition">
                    <div class="w-12 h-12 bg-emerald-50  flex items-center justify-center text-emerald-600 text-xl mb-4">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4 class="font-black text-black mb-2">Verifikasi & Keamanan</h4>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Untuk memverifikasi identitas, mencegah penipuan, dan melindungi keamanan platform.
                    </p>
                </div>

                <div class="bg-white border-2 border-black  p-6 shadow-[2px_2px_0px_#000] card-hover border-transition">
                    <div class="w-12 h-12 bg-purple-50  flex items-center justify-center text-purple-600 text-xl mb-4">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <h4 class="font-black text-black mb-2">Analisis & Pengembangan</h4>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Untuk menganalisis penggunaan platform dan mengembangkan fitur-fitur baru yang bermanfaat.
                    </p>
                </div>

                <div class="bg-white border-2 border-black  p-6 shadow-[2px_2px_0px_#000] card-hover border-transition">
                    <div class="w-12 h-12 bg-amber-50  flex items-center justify-center text-amber-600 text-xl mb-4">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h4 class="font-black text-black mb-2">Komunikasi</h4>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Untuk mengirim notifikasi, pembaruan, dan informasi penting terkait layanan Anda.
                    </p>
                </div>
            </div>
        </div>

        <!-- Section 3: Berbagi Data -->
        <div class="mb-16" data-aos="fade-up">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-10 h-10 bg-yellow-400 border-2 border-black flex items-center justify-center text-black font-black">3</div>
                <h2 class="text-2xl md:text-3xl font-black text-black">Berbagi Data dengan Pihak Ketiga</h2>
            </div>

            <!-- Alert -->
            <div class="bg-yellow-100 border-2 border-black p-5 mb-8 flex items-start gap-3">
                <div class="w-10 h-10 bg-amber-100  flex items-center justify-center text-amber-600 shrink-0">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div>
                    <p class="font-black text-amber-900 text-sm">Prinsip Kami</p>
                    <p class="text-amber-700 text-sm mt-1">Kami <strong>tidak menjual</strong> data pribadi Anda kepada pihak ketiga. Data hanya dibagikan sesuai kebutuhan operasional dan kewajiban hukum.</p>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-white border-2 border-black  p-6 shadow-[2px_2px_0px_#000] card-hover">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-sky-100  flex items-center justify-center text-sky-600">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <h4 class="font-black text-black">Penyedia Layanan</h4>
                    </div>
                    <ul class="space-y-2.5">
                        <li class="list-check text-sm text-gray-600">
                            <i class="fas fa-circle text-sky-500"></i>
                            <span>Penyedia hosting dan server</span>
                        </li>
                        <li class="list-check text-sm text-gray-600">
                            <i class="fas fa-circle text-sky-500"></i>
                            <span>Layanan pembayaran</span>
                        </li>
                        <li class="list-check text-sm text-gray-600">
                            <i class="fas fa-circle text-sky-500"></i>
                            <span>Layanan analitik</span>
                        </li>
                        <li class="list-check text-sm text-gray-600">
                            <i class="fas fa-circle text-sky-500"></i>
                            <span>Layanan email marketing</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-white border-2 border-black  p-6 shadow-[2px_2px_0px_#000] card-hover">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-rose-100  flex items-center justify-center text-rose-600">
                            <i class="fas fa-balance-scale"></i>
                        </div>
                        <h4 class="font-black text-black">Situasi Khusus</h4>
                    </div>
                    <ul class="space-y-2.5">
                        <li class="list-check text-sm text-gray-600">
                            <i class="fas fa-circle text-rose-500"></i>
                            <span>Kepatuhan hukum</span>
                        </li>
                        <li class="list-check text-sm text-gray-600">
                            <i class="fas fa-circle text-rose-500"></i>
                            <span>Perlindungan hak dan properti</span>
                        </li>
                        <li class="list-check text-sm text-gray-600">
                            <i class="fas fa-circle text-rose-500"></i>
                            <span>Keamanan publik</span>
                        </li>
                        <li class="list-check text-sm text-gray-600">
                            <i class="fas fa-circle text-rose-500"></i>
                            <span>Merger atau akuisisi</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Section 4: Keamanan Data -->
        <div class="mb-16" data-aos="fade-up">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-10 h-10 bg-yellow-400 border-2 border-black flex items-center justify-center text-black font-black">4</div>
                <h2 class="text-2xl md:text-3xl font-black text-black">Keamanan Data</h2>
            </div>

            <div class="bg-white border-2 border-black p-6 md:p-8 shadow-[3px_3px_0px_#000]">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-14 h-14 bg-white  flex items-center justify-center text-emerald-600 text-2xl">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-black">Kami Melindungi Data Anda dengan</h3>
                        <p class="text-gray-600 text-sm mt-1">Sistem keamanan berlapis untuk melindungi informasi Anda</p>
                    </div>
                </div>

                <div class="grid md:grid-cols-3 gap-5">
                    <div class="bg-gray-100 border-2 border-black  p-6 text-center card-hover">
                        <div class="w-14 h-14 bg-emerald-100  flex items-center justify-center mx-auto mb-4 text-emerald-600 text-2xl">
                            <i class="fas fa-lock"></i>
                        </div>
                        <h4 class="font-black text-black mb-2">Enkripsi SSL</h4>
                        <p class="text-gray-600 text-sm">Data ditransmisikan secara aman dengan enkripsi end-to-end</p>
                    </div>

                    <div class="bg-gray-100 border-2 border-black  p-6 text-center card-hover">
                        <div class="w-14 h-14 bg-emerald-100  flex items-center justify-center mx-auto mb-4 text-emerald-600 text-2xl">
                            <i class="fas fa-shield-virus"></i>
                        </div>
                        <h4 class="font-black text-black mb-2">Firewall</h4>
                        <p class="text-gray-600 text-sm">Perlindungan dari akses tidak sah dan serangan siber</p>
                    </div>

                    <div class="bg-gray-100 border-2 border-black  p-6 text-center card-hover">
                        <div class="w-14 h-14 bg-emerald-100  flex items-center justify-center mx-auto mb-4 text-emerald-600 text-2xl">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h4 class="font-black text-black mb-2">Monitoring 24/7</h4>
                        <p class="text-gray-600 text-sm">Pemantauan keamanan terus menerus oleh tim kami</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 5: Hak-Hak Anda -->
        <div class="mb-16" data-aos="fade-up">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-10 h-10 bg-yellow-400 border-2 border-black flex items-center justify-center text-black font-black">5</div>
                <h2 class="text-2xl md:text-3xl font-black text-black">Hak-Hak Anda</h2>
            </div>

            <div class="bg-white border-2 border-black p-6 md:p-8 shadow-[3px_3px_0px_#000]">
                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div class="p-5 bg-sky-50  border border-sky-100">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-sky-100  flex items-center justify-center text-sky-600">
                                <i class="fas fa-user-check"></i>
                            </div>
                            <h4 class="font-black text-black">Akses dan Koreksi</h4>
                        </div>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3 text-sm text-gray-600">
                                <i class="fas fa-eye text-sky-500 mt-0.5"></i>
                                <span>Hak untuk mengakses data pribadi Anda kapan saja</span>
                            </li>
                            <li class="flex items-start gap-3 text-sm text-gray-600">
                                <i class="fas fa-edit text-sky-500 mt-0.5"></i>
                                <span>Hak untuk memperbaiki data yang tidak akurat</span>
                            </li>
                        </ul>
                    </div>

                    <div class="p-5 bg-rose-50  border border-rose-100">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-rose-100  flex items-center justify-center text-rose-600">
                                <i class="fas fa-user-slash"></i>
                            </div>
                            <h4 class="font-black text-black">Penghapusan dan Pembatasan</h4>
                        </div>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3 text-sm text-gray-600">
                                <i class="fas fa-trash-alt text-rose-500 mt-0.5"></i>
                                <span>Hak untuk meminta penghapusan data</span>
                            </li>
                            <li class="flex items-start gap-3 text-sm text-gray-600">
                                <i class="fas fa-ban text-amber-500 mt-0.5"></i>
                                <span>Hak untuk membatasi pemrosesan data</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="bg-gray-100 border-2 border-black  p-5 flex items-start gap-4">
                    <div class="w-10 h-10 bg-sky-100  flex items-center justify-center text-sky-600 shrink-0">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Untuk menggunakan hak-hak Anda, silakan hubungi kami melalui email di 
                            <a href="mailto:valorant270306@gmail.com" class="text-sky-600 hover:text-sky-700 font-bold hover:underline">valorant270306@gmail.com</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hubungi Kami -->
        <div class="mb-16" data-aos="fade-up">
            <div class="bg-white border-2 border-black p-6 md:p-8 shadow-[3px_3px_0px_#000]">
                <h2 class="text-2xl font-black text-black mb-6 flex items-center">
                    <i class="fas fa-headset text-sky-500 mr-3"></i> Hubungi Kami
                </h2>
                
                <p class="text-gray-600 mb-8 leading-relaxed">
                    Jika Anda memiliki pertanyaan tentang Kebijakan Privasi ini, jangan ragu untuk menghubungi kami. Tim kami siap membantu Anda.
                </p>

                <div class="grid md:grid-cols-2 gap-6">
                    <div class="p-5 bg-gray-100  border-2 border-black">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-sky-100  flex items-center justify-center text-sky-600">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <h4 class="font-black text-black">Petugas Privasi Data</h4>
                        </div>
                        <div class="space-y-3 ml-13">
                            <div class="flex items-center gap-3 text-sm text-gray-600">
                                <i class="fas fa-envelope text-sky-500 w-4"></i>
                                <a href="mailto:valorant270306@gmail.com" class="hover:text-sky-600 transition">valorant270306@gmail.com</a>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-600">
                                <i class="fas fa-phone text-sky-500 w-4"></i>
                                <span>+6282121730722</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-5 bg-gray-100  border-2 border-black">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-emerald-100  flex items-center justify-center text-emerald-600">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <h4 class="font-black text-black">Alamat Kantor</h4>
                        </div>
                        <div class="space-y-1 text-sm text-gray-600 ml-13">
                            <p>Jl. Kebijakan Privasi No. 123</p>
                            <p>Jakarta Selatan, DKI Jakarta</p>
                            <p>Indonesia 12560</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- ==================== CTA FINAL ==================== -->
<section class="section-padding bg-black border-t-4 border-yellow-400">
    <div class="container mx-auto px-4 text-center" data-aos="fade-up">
        <h2 class="text-3xl md:text-5xl font-black text-yellow-400 mb-4">Punya Pertanyaan?</h2>
        <p class="text-lg text-gray-300 font-black mb-8 max-w-2xl mx-auto">
            Kami siap membantu menjawab segala pertanyaan terkait privasi dan keamanan data Anda.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="mailto:valorant270306@gmail.com" class="px-8 py-4 bg-yellow-400 hover:bg-yellow-500 text-black font-black border-2 border-yellow-400 shadow-[4px_4px_0px_#fff] hover:translate-y-[-2px] transition-all uppercase tracking-wide text-lg">
                <i class="fas fa-envelope mr-2"></i> Hubungi Kami
            </a>
            <a href="<?php echo e(route('public.kos.index')); ?>" class="px-8 py-4 bg-white text-black font-black border-2 border-white shadow-[4px_4px_0px_#fff] hover:bg-gray-200 hover:translate-y-[-2px] transition-all uppercase tracking-wide text-lg">
                <i class="fas fa-search mr-2"></i> Jelajahi Kos
            </a>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Mobile touch feedback
    document.addEventListener('DOMContentLoaded', function() {
        const interactiveElements = document.querySelectorAll('button, a, .card-hover');
        interactiveElements.forEach(el => {
            el.addEventListener('touchstart', function() { this.style.opacity = '0.85'; });
            el.addEventListener('touchend', function() { this.style.opacity = '1'; });
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/public/pages/privacy.blade.php ENDPATH**/ ?>