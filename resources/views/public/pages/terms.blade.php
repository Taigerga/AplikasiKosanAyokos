@extends('layouts.app')

@section('title', 'Syarat & Ketentuan - AyoKos')

@section('content')



<!-- ==================== HERO SECTION ==================== -->
<section class="bg-yellow-400 py-16 md:py-20 border-b-4 border-black">
    <div class="container mx-auto px-4 text-center" data-aos="fade-up" data-aos-duration="1000">
        <div class="w-20 h-20 md:w-24 md:h-24 bg-black border-4 border-black shadow-[4px_4px_0px_#000] flex items-center justify-center mx-auto mb-8">
            <i class="fas fa-file-contract text-white text-3xl md:text-4xl"></i>
        </div>

        <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-black mb-6 leading-tight tracking-tight">
            Syarat & <span class="bg-black text-white px-3">Ketentuan</span>
        </h1>

        <p class="text-lg md:text-xl text-gray-800 font-bold max-w-3xl mx-auto leading-relaxed mb-8">
            Mohon baca dengan seksama syarat dan ketentuan penggunaan platform AyoKos. 
            Dengan mengakses platform ini, Anda menyetujui semua ketentuan yang berlaku.
        </p>

        <div class="inline-flex items-center px-4 py-2 border-2 border-black bg-black text-white font-black text-sm shadow-[2px_2px_0px_#000]">
            <i class="fas fa-clock mr-2"></i>
            Terakhir diperbarui: {{ date('d F Y') }}
        </div>
    </div>
</section>

<!-- ==================== PENTING NOTICE ==================== -->
<section class="pt-12 pb-6 bg-white">
    <div class="container mx-auto px-4 max-w-5xl">
        <div class="bg-yellow-100 border-2 border-black p-5 flex items-start gap-3" data-aos="fade-up">
            <div class="w-12 h-12 bg-yellow-400 border-2 border-black flex items-center justify-center text-black shrink-0">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div>
                <h3 class="font-black text-black mb-1">Penting untuk Dibaca</h3>
                <p class="text-sm font-bold text-gray-700">Dengan mengakses dan menggunakan platform AyoKos, Anda dianggap telah membaca, memahami, dan menyetujui semua syarat dan ketentuan yang tercantum di bawah ini.</p>
            </div>
        </div>
            <div>
                <h3 class="font-bold text-amber-900 mb-1">Penting</h3>
                <p class="text-amber-700 text-sm leading-relaxed">
                    Dengan mengakses atau menggunakan platform AyoKos, Anda menyetujui untuk terikat dengan syarat dan ketentuan berikut. Jika Anda tidak setuju, mohon untuk tidak menggunakan platform kami.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ==================== KONTEN SYARAT & KETENTUAN ==================== -->
<section class="pb-20 bg-white">
    <div class="container mx-auto px-4 max-w-5xl">
        <div class="space-y-12">

            <!-- Section 1: Definisi -->
            <div class="bg-white border-2 border-black p-6 md:p-8 shadow-[3px_3px_0px_#000]" data-aos="fade-up">
                <div class="flex items-start gap-5">
                    <div class="w-10 h-10 bg-yellow-400 border-2 border-black flex items-center justify-center text-black font-black">1</div>
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-slate-900 mb-4">Definisi</h2>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div class="p-4 bg-slate-50 rounded-xl border border-slate-100">
                                <p class="text-sm text-slate-600 leading-relaxed">
                                    <strong class="text-sky-600">"Platform"</strong> mengacu pada website, aplikasi mobile, dan layanan lainnya yang disediakan oleh AyoKos.
                                </p>
                            </div>
                            <div class="p-4 bg-slate-50 rounded-xl border border-slate-100">
                                <p class="text-sm text-slate-600 leading-relaxed">
                                    <strong class="text-sky-600">"Pengguna"</strong> adalah individu yang mengakses atau menggunakan Platform, termasuk Penghuni dan Pemilik Kos.
                                </p>
                            </div>
                            <div class="p-4 bg-slate-50 rounded-xl border border-slate-100">
                                <p class="text-sm text-slate-600 leading-relaxed">
                                    <strong class="text-sky-600">"Penghuni"</strong> adalah pengguna yang mencari, menyewa, atau tinggal di kos yang terdaftar di Platform.
                                </p>
                            </div>
                            <div class="p-4 bg-slate-50 rounded-xl border border-slate-100">
                                <p class="text-sm text-slate-600 leading-relaxed">
                                    <strong class="text-sky-600">"Pemilik Kos"</strong> adalah pengguna yang memiliki, mengelola, atau menyewakan kos melalui Platform.
                                </p>
                            </div>
                            <div class="p-4 bg-slate-50 rounded-xl border border-slate-100 md:col-span-2">
                                <p class="text-sm text-slate-600 leading-relaxed">
                                    <strong class="text-sky-600">"Konten"</strong> mencakup teks, gambar, video, dan materi lainnya yang diunggah ke Platform.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2: Pendaftaran dan Akun -->
            <div class="bg-white border-2 border-black p-6 md:p-8 shadow-[3px_3px_0px_#000]" data-aos="fade-up">
                <div class="flex items-start gap-5">
                    <div class="w-10 h-10 bg-yellow-400 border-2 border-black flex items-center justify-center text-black font-black">2</div>
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-slate-900 mb-4">Pendaftaran dan Akun</h2>
                        <div class="space-y-3">
                            <div class="list-item p-3 bg-slate-50 rounded-xl">
                                <span class="w-6 h-6 bg-sky-100 rounded-lg flex items-center justify-center text-sky-600 text-xs font-bold shrink-0">1</span>
                                <p class="text-sm text-slate-600">Anda harus berusia minimal <strong class="text-slate-800">17 tahun</strong> untuk menggunakan Platform ini.</p>
                            </div>
                            <div class="list-item p-3 bg-slate-50 rounded-xl">
                                <span class="w-6 h-6 bg-sky-100 rounded-lg flex items-center justify-center text-sky-600 text-xs font-bold shrink-0">2</span>
                                <p class="text-sm text-slate-600">Informasi yang Anda berikan selama pendaftaran harus <strong class="text-slate-800">akurat, lengkap, dan terbaru</strong>.</p>
                            </div>
                            <div class="list-item p-3 bg-slate-50 rounded-xl">
                                <span class="w-6 h-6 bg-sky-100 rounded-lg flex items-center justify-center text-sky-600 text-xs font-bold shrink-0">3</span>
                                <p class="text-sm text-slate-600">Anda bertanggung jawab penuh atas <strong class="text-slate-800">kerahasiaan informasi akun</strong> Anda.</p>
                            </div>
                            <div class="list-item p-3 bg-slate-50 rounded-xl">
                                <span class="w-6 h-6 bg-sky-100 rounded-lg flex items-center justify-center text-sky-600 text-xs font-bold shrink-0">4</span>
                                <p class="text-sm text-slate-600">AyoKos berhak <strong class="text-slate-800">menangguhkan atau menghentikan</strong> akun yang melanggar syarat dan ketentuan.</p>
                            </div>
                            <div class="list-item p-3 bg-slate-50 rounded-xl">
                                <span class="w-6 h-6 bg-sky-100 rounded-lg flex items-center justify-center text-sky-600 text-xs font-bold shrink-0">5</span>
                                <p class="text-sm text-slate-600">Setiap pengguna hanya boleh memiliki <strong class="text-slate-800">satu akun</strong>, kecuali dengan izin tertulis dari AyoKos.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 3: Penggunaan Platform -->
            <div class="bg-white border-2 border-black p-6 md:p-8 shadow-[3px_3px_0px_#000]" data-aos="fade-up">
                <div class="flex items-start gap-5">
                    <div class="w-10 h-10 bg-yellow-400 border-2 border-black flex items-center justify-center text-black font-black">3</div>
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-slate-900 mb-4">Penggunaan Platform</h2>
                        <p class="text-slate-500 mb-4 text-sm">Anda setuju untuk <strong class="text-slate-700">tidak</strong> melakukan hal-hal berikut:</p>
                        
                        <div class="grid md:grid-cols-2 gap-3">
                            <div class="flex items-start gap-3 p-3 bg-rose-50 rounded-xl border border-rose-100">
                                <i class="fas fa-ban text-rose-500 mt-0.5"></i>
                                <p class="text-sm text-slate-600">Menggunakan Platform untuk tujuan ilegal atau tidak sah</p>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-rose-50 rounded-xl border border-rose-100">
                                <i class="fas fa-ban text-rose-500 mt-0.5"></i>
                                <p class="text-sm text-slate-600">Melanggar hak kekayaan intelektual pihak lain</p>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-rose-50 rounded-xl border border-rose-100">
                                <i class="fas fa-ban text-rose-500 mt-0.5"></i>
                                <p class="text-sm text-slate-600">Mengunggah konten yang mengandung virus atau kode berbahaya</p>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-rose-50 rounded-xl border border-rose-100">
                                <i class="fas fa-ban text-rose-500 mt-0.5"></i>
                                <p class="text-sm text-slate-600">Melakukan scraping atau pengumpulan data otomatis tanpa izin</p>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-rose-50 rounded-xl border border-rose-100">
                                <i class="fas fa-ban text-rose-500 mt-0.5"></i>
                                <p class="text-sm text-slate-600">Mengganggu atau merusak integritas Platform</p>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-rose-50 rounded-xl border border-rose-100">
                                <i class="fas fa-ban text-rose-500 mt-0.5"></i>
                                <p class="text-sm text-slate-600">Mencoba mendapatkan akses tidak sah ke sistem kami</p>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-rose-50 rounded-xl border border-rose-100">
                                <i class="fas fa-ban text-rose-500 mt-0.5"></i>
                                <p class="text-sm text-slate-600">Menyebarkan informasi palsu atau menyesatkan</p>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-rose-50 rounded-xl border border-rose-100">
                                <i class="fas fa-ban text-rose-500 mt-0.5"></i>
                                <p class="text-sm text-slate-600">Melakukan transaksi di luar Platform untuk menghindari komisi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 4: Kontrak Sewa dan Pembayaran -->
            <div class="bg-white border-2 border-black p-6 md:p-8 shadow-[3px_3px_0px_#000]" data-aos="fade-up">
                <div class="flex items-start gap-5">
                    <div class="w-10 h-10 bg-yellow-400 border-2 border-black flex items-center justify-center text-black font-black">4</div>
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-slate-900 mb-4">Kontrak Sewa dan Pembayaran</h2>
                        <div class="space-y-3 mb-6">
                            <div class="list-item p-3 bg-slate-50 rounded-xl">
                                <span class="w-6 h-6 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 text-xs font-bold shrink-0">1</span>
                                <p class="text-sm text-slate-600">Kontrak sewa merupakan <strong class="text-slate-800">perjanjian langsung</strong> antara Penghuni dan Pemilik Kos.</p>
                            </div>
                            <div class="list-item p-3 bg-slate-50 rounded-xl">
                                <span class="w-6 h-6 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 text-xs font-bold shrink-0">2</span>
                                <p class="text-sm text-slate-600">AyoKos berperan sebagai <strong class="text-slate-800">platform perantara</strong> dan tidak bertanggung jawab atas pelaksanaan kontrak.</p>
                            </div>
                            <div class="list-item p-3 bg-slate-50 rounded-xl">
                                <span class="w-6 h-6 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 text-xs font-bold shrink-0">3</span>
                                <p class="text-sm text-slate-600">Semua transaksi pembayaran harus dilakukan <strong class="text-slate-800">melalui sistem</strong> yang disediakan Platform.</p>
                            </div>
                            <div class="list-item p-3 bg-slate-50 rounded-xl">
                                <span class="w-6 h-6 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 text-xs font-bold shrink-0">4</span>
                                <p class="text-sm text-slate-600">Pembatalan kontrak setelah disetujui dikenakan <strong class="text-slate-800">ketentuan yang disepakati</strong> dalam kontrak.</p>
                            </div>
                            <div class="list-item p-3 bg-slate-50 rounded-xl">
                                <span class="w-6 h-6 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 text-xs font-bold shrink-0">5</span>
                                <p class="text-sm text-slate-600">AyoKos berhak mengenakan <strong class="text-slate-800">biaya layanan</strong> sesuai dengan ketentuan yang berlaku.</p>
                            </div>
                        </div>

                        <div class="bg-sky-50 border border-sky-100 rounded-xl p-4 flex items-start gap-3">
                            <i class="fas fa-info-circle text-sky-500 mt-0.5"></i>
                            <div>
                                <p class="text-sm font-medium text-sky-900">Catatan Penting</p>
                                <p class="text-xs text-sky-700 mt-1 leading-relaxed">Selalu simpan bukti pembayaran dan komunikasi penting selama proses sewa untuk keamanan Anda.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 5: Konten Pengguna -->
            <div class="bg-white border-2 border-black p-6 md:p-8 shadow-[3px_3px_0px_#000]" data-aos="fade-up">
                <div class="flex items-start gap-5">
                    <div class="w-10 h-10 bg-yellow-400 border-2 border-black flex items-center justify-center text-black font-black">5</div>
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-slate-900 mb-4">Konten Pengguna</h2>
                        <div class="space-y-3">
                            <div class="list-item p-3 bg-slate-50 rounded-xl">
                                <span class="w-6 h-6 bg-purple-100 rounded-lg flex items-center justify-center text-purple-600 text-xs font-bold shrink-0">1</span>
                                <p class="text-sm text-slate-600">Anda mempertahankan <strong class="text-slate-800">kepemilikan</strong> atas konten yang Anda unggah ke Platform.</p>
                            </div>
                            <div class="list-item p-3 bg-slate-50 rounded-xl">
                                <span class="w-6 h-6 bg-purple-100 rounded-lg flex items-center justify-center text-purple-600 text-xs font-bold shrink-0">2</span>
                                <p class="text-sm text-slate-600">Dengan mengunggah konten, Anda memberikan AyoKos <strong class="text-slate-800">lisensi untuk menggunakan</strong>, menampilkan, dan mendistribusikan konten tersebut.</p>
                            </div>
                            <div class="list-item p-3 bg-slate-50 rounded-xl">
                                <span class="w-6 h-6 bg-purple-100 rounded-lg flex items-center justify-center text-purple-600 text-xs font-bold shrink-0">3</span>
                                <p class="text-sm text-slate-600">Anda bertanggung jawab penuh atas <strong class="text-slate-800">keaslian dan legalitas</strong> konten yang Anda unggah.</p>
                            </div>
                            <div class="list-item p-3 bg-slate-50 rounded-xl">
                                <span class="w-6 h-6 bg-purple-100 rounded-lg flex items-center justify-center text-purple-600 text-xs font-bold shrink-0">4</span>
                                <p class="text-sm text-slate-600">AyoKos berhak <strong class="text-slate-800">menghapus konten</strong> yang melanggar syarat dan ketentuan tanpa pemberitahuan.</p>
                            </div>
                            <div class="list-item p-3 bg-slate-50 rounded-xl">
                                <span class="w-6 h-6 bg-purple-100 rounded-lg flex items-center justify-center text-purple-600 text-xs font-bold shrink-0">5</span>
                                <p class="text-sm text-slate-600">Dilarang mengunggah konten yang mengandung <strong class="text-slate-800">materi pornografi, kekerasan, atau diskriminatif</strong>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 6: Batasan Tanggung Jawab -->
            <div class="bg-white border-2 border-black p-6 md:p-8 shadow-[3px_3px_0px_#000]" data-aos="fade-up">
                <div class="flex items-start gap-5">
                    <div class="w-10 h-10 bg-yellow-400 border-2 border-black flex items-center justify-center text-black font-black">6</div>
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-slate-900 mb-4">Batasan Tanggung Jawab</h2>
                        <div class="space-y-3 mb-4">
                            <div class="list-item p-3 bg-slate-50 rounded-xl">
                                <span class="w-6 h-6 bg-rose-100 rounded-lg flex items-center justify-center text-rose-600 text-xs font-bold shrink-0">1</span>
                                <p class="text-sm text-slate-600">Platform disediakan <strong class="text-slate-800">"sebagaimana adanya"</strong> tanpa jaminan apapun.</p>
                            </div>
                            <div class="list-item p-3 bg-slate-50 rounded-xl">
                                <span class="w-6 h-6 bg-rose-100 rounded-lg flex items-center justify-center text-rose-600 text-xs font-bold shrink-0">2</span>
                                <p class="text-sm text-slate-600">AyoKos <strong class="text-slate-800">tidak bertanggung jawab</strong> atas:</p>
                            </div>
                        </div>
                        
                        <div class="grid md:grid-cols-2 gap-3 mb-4">
                            <div class="flex items-start gap-3 p-3 bg-rose-50 rounded-xl border border-rose-100">
                                <i class="fas fa-times text-rose-500 mt-0.5"></i>
                                <p class="text-sm text-slate-600">Keterlambatan atau gangguan dalam layanan</p>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-rose-50 rounded-xl border border-rose-100">
                                <i class="fas fa-times text-rose-500 mt-0.5"></i>
                                <p class="text-sm text-slate-600">Kerugian dari penggunaan Platform</p>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-rose-50 rounded-xl border border-rose-100">
                                <i class="fas fa-times text-rose-500 mt-0.5"></i>
                                <p class="text-sm text-slate-600">Konten yang diunggah pengguna lain</p>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-rose-50 rounded-xl border border-rose-100">
                                <i class="fas fa-times text-rose-500 mt-0.5"></i>
                                <p class="text-sm text-slate-600">Perselisihan antara Penghuni dan Pemilik</p>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-rose-50 rounded-xl border border-rose-100 md:col-span-2">
                                <i class="fas fa-times text-rose-500 mt-0.5"></i>
                                <p class="text-sm text-slate-600">Kerusakan atau kehilangan properti selama masa sewa</p>
                            </div>
                        </div>

                        <div class="list-item p-3 bg-slate-50 rounded-xl">
                            <span class="w-6 h-6 bg-rose-100 rounded-lg flex items-center justify-center text-rose-600 text-xs font-bold shrink-0">3</span>
                            <p class="text-sm text-slate-600">Tanggung jawab AyoKos dibatasi sesuai dengan <strong class="text-slate-800">ketentuan hukum yang berlaku</strong>.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 7: Perubahan Syarat -->
            <div class="bg-white border-2 border-black p-6 md:p-8 shadow-[3px_3px_0px_#000]" data-aos="fade-up">
                <div class="flex items-start gap-5">
                    <div class="w-10 h-10 bg-yellow-400 border-2 border-black flex items-center justify-center text-black font-black">7</div>
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-slate-900 mb-4">Perubahan Syarat dan Ketentuan</h2>
                        <div class="space-y-3 mb-4">
                            <div class="list-item p-3 bg-slate-50 rounded-xl">
                                <span class="w-6 h-6 bg-cyan-100 rounded-lg flex items-center justify-center text-cyan-600 text-xs font-bold shrink-0">1</span>
                                <p class="text-sm text-slate-600">AyoKos berhak <strong class="text-slate-800">mengubah syarat dan ketentuan</strong> ini kapan saja.</p>
                            </div>
                            <div class="list-item p-3 bg-slate-50 rounded-xl">
                                <span class="w-6 h-6 bg-cyan-100 rounded-lg flex items-center justify-center text-cyan-600 text-xs font-bold shrink-0">2</span>
                                <p class="text-sm text-slate-600">Perubahan akan diberitahukan melalui <strong class="text-slate-800">Platform atau email</strong>.</p>
                            </div>
                            <div class="list-item p-3 bg-slate-50 rounded-xl">
                                <span class="w-6 h-6 bg-cyan-100 rounded-lg flex items-center justify-center text-cyan-600 text-xs font-bold shrink-0">3</span>
                                <p class="text-sm text-slate-600">Penggunaan berlanjut setelah perubahan berarti Anda <strong class="text-slate-800">menerima syarat baru</strong>.</p>
                            </div>
                            <div class="list-item p-3 bg-slate-50 rounded-xl">
                                <span class="w-6 h-6 bg-cyan-100 rounded-lg flex items-center justify-center text-cyan-600 text-xs font-bold shrink-0">4</span>
                                <p class="text-sm text-slate-600">Tanggal efektif akan <strong class="text-slate-800">dicantumkan pada halaman ini</strong>.</p>
                            </div>
                        </div>

                        <div class="bg-amber-50 border border-amber-100 rounded-xl p-4 flex items-start gap-3">
                            <i class="fas fa-lightbulb text-amber-500 mt-0.5"></i>
                            <div>
                                <p class="text-sm font-medium text-amber-900">Saran</p>
                                <p class="text-xs text-amber-700 mt-1 leading-relaxed">Periksa halaman ini secara berkala untuk mengetahui pembaruan terbaru dari kami.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 8: Hukum yang Berlaku -->
            <div class="bg-white border-2 border-black p-6 md:p-8 shadow-[3px_3px_0px_#000]" data-aos="fade-up">
                <div class="flex items-start gap-5">
                    <div class="w-10 h-10 bg-yellow-400 border-2 border-black flex items-center justify-center text-black font-black">8</div>
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-slate-900 mb-4">Hukum yang Berlaku</h2>
                        <div class="space-y-3">
                            <div class="list-item p-3 bg-slate-50 rounded-xl">
                                <span class="w-6 h-6 bg-slate-200 rounded-lg flex items-center justify-center text-slate-700 text-xs font-bold shrink-0">1</span>
                                <p class="text-sm text-slate-600">Syarat dan ketentuan ini diatur oleh <strong class="text-slate-800">hukum Republik Indonesia</strong>.</p>
                            </div>
                            <div class="list-item p-3 bg-slate-50 rounded-xl">
                                <span class="w-6 h-6 bg-slate-200 rounded-lg flex items-center justify-center text-slate-700 text-xs font-bold shrink-0">2</span>
                                <p class="text-sm text-slate-600">Setiap sengketa akan diselesaikan melalui <strong class="text-slate-800">jalur musyawarah</strong> terlebih dahulu.</p>
                            </div>
                            <div class="list-item p-3 bg-slate-50 rounded-xl">
                                <span class="w-6 h-6 bg-slate-200 rounded-lg flex items-center justify-center text-slate-700 text-xs font-bold shrink-0">3</span>
                                <p class="text-sm text-slate-600">Jika musyawarah gagal, sengketa akan diselesaikan melalui <strong class="text-slate-800">pengadilan di Jakarta</strong>.</p>
                            </div>
                            <div class="list-item p-3 bg-slate-50 rounded-xl">
                                <span class="w-6 h-6 bg-slate-200 rounded-lg flex items-center justify-center text-slate-700 text-xs font-bold shrink-0">4</span>
                                <p class="text-sm text-slate-600">Klausul yang tidak dapat dilaksanakan <strong class="text-slate-800">tidak mempengaruhi</strong> keberlakuan klausul lainnya.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 9: Hubungi Kami -->
            <div class="bg-white border-2 border-black p-6 md:p-8 shadow-[3px_3px_0px_#000]" data-aos="fade-up">
                <div class="flex items-start gap-5">
                    <div class="w-10 h-10 bg-yellow-400 border-2 border-black flex items-center justify-center text-black font-black">9</div>
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-slate-900 mb-4">Hubungi Kami</h2>
                        <p class="text-slate-500 mb-6 text-sm">Jika Anda memiliki pertanyaan tentang Syarat dan Ketentuan ini, silakan hubungi kami:</p>
                        
                        <div class="grid md:grid-cols-2 gap-4">
                            <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-xl border border-slate-100">
                                <div class="w-12 h-12 bg-sky-100 rounded-xl flex items-center justify-center text-sky-600 text-xl">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Email</p>
                                    <a href="mailto:valorant270306@gmail.com" class="text-sm text-slate-700 font-medium hover:text-sky-600 transition">valorant270306@gmail.com</a>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-xl border border-slate-100">
                                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center text-emerald-600 text-xl">
                                    <i class="fas fa-headset"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Layanan Pelanggan</p>
                                    <p class="text-sm text-slate-700 font-medium">+62 82121730722</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ==================== ACCEPTANCE SECTION ==================== -->
<section class="pb-20 bg-white">
    <div class="container mx-auto px-4 max-w-5xl">
        <div class="bg-lime-100 border-2 border-black p-6 md:p-8" data-aos="fade-up">
            <div class="flex flex-col md:flex-row items-center gap-8">
                <div class="flex-1">
                    <h3 class="text-xl font-black text-black mb-4 flex items-center">
                        <i class="fas fa-file-signature text-lime-700 mr-3"></i>
                        Pernyataan Persetujuan
                    </h3>
                    <p class="text-gray-600 font-bold text-sm mb-4">Dengan menggunakan AyoKos, saya menyatakan:</p>
                    <div class="space-y-3">
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 bg-lime-400 border-2 border-black flex items-center justify-center text-black">
                                <i class="fas fa-check text-xs"></i>
                            </div>
                            <p class="text-sm font-bold text-gray-700">Saya telah membaca dan memahami Syarat & Ketentuan ini</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 bg-lime-400 border-2 border-black flex items-center justify-center text-black">
                                <i class="fas fa-check text-xs"></i>
                            </div>
                            <p class="text-sm font-bold text-gray-700">Saya setuju untuk terikat dengan semua ketentuan yang tercantum</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 bg-lime-400 border-2 border-black flex items-center justify-center text-black">
                                <i class="fas fa-check text-xs"></i>
                            </div>
                            <p class="text-sm font-bold text-gray-700">Saya akan mematuhi semua peraturan yang berlaku</p>
                        </div>
                    </div>
                </div>
                <div class="text-center md:text-right shrink-0">
                    <div class="w-20 h-20 bg-white border-4 border-black flex items-center justify-center mx-auto md:mx-0 mb-3 shadow-[4px_4px_0px_#000]">
                        <i class="fas fa-file-signature text-black text-3xl"></i>
                    </div>
                    <p class="text-sm font-black text-black">Menyetujui</p>
                    <p class="text-xs font-bold text-gray-600 mt-1">Terakhir diperbarui: {{ date('d F Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== CTA FINAL ==================== -->
<section class="section-padding bg-black border-t-4 border-yellow-400">
    <div class="container mx-auto px-4 text-center" data-aos="fade-up">
        <h2 class="text-3xl md:text-5xl font-black text-yellow-400 mb-4">Siap Bergabung?</h2>
        <p class="text-lg text-gray-300 font-bold mb-8 max-w-2xl mx-auto">
            Dengan memahami syarat dan ketentuan, Anda siap untuk menikmati pengalaman terbaik bersama AyoKos.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('public.kos.index') }}" class="px-8 py-4 bg-yellow-400 hover:bg-yellow-500 text-black font-black border-2 border-yellow-400 shadow-[4px_4px_0px_#fff] hover:translate-y-[-2px] transition-all uppercase tracking-wide text-lg">
                <i class="fas fa-search mr-2"></i> Jelajahi Kos
            </a>
            @guest
            <a href="{{ route('register') }}" class="px-8 py-4 bg-white text-black font-black border-2 border-white shadow-[4px_4px_0px_#fff] hover:bg-gray-200 hover:translate-y-[-2px] transition-all uppercase tracking-wide text-lg">
                <i class="fas fa-user-plus mr-2"></i> Daftar Sekarang
            </a>
            @endguest
        </div>
    </div>
</section>

@endsection

@push('scripts')
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
@endpush