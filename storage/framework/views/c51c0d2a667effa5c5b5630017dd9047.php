<?php $__env->startSection('title', 'Tentang Kami - AyoKos'); ?>

<?php $__env->startSection('content'); ?>

<style>
    /* Section Umum */
    .section-padding {
        padding: 6rem 0;
    }

    @media (max-width: 768px) {
        .section-padding {
            padding: 4rem 0;
        }
    }

    /* Badge */
    .badge-soft {
        display: inline-block;
        padding: 0.35rem 1rem;
        border-radius: 999px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    /* Card Hover */
    .card-hover {
        transition: all 0.3s ease;
    }
    .card-hover:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 40px -12px rgba(0,0,0,0.1);
        border-color: #cbd5e1;
    }

    /* Timeline */
    .timeline-line {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        top: 0;
        bottom: 0;
        width: 2px;
        background: linear-gradient(to bottom, #0ea5e9, #6366f1, #a855f7);
    }

    @media (max-width: 768px) {
        .timeline-line {
            left: 24px;
        }
    }

    .timeline-dot {
        width: 16px;
        height: 16px;
        border-radius: 50%;
        border: 3px solid #ffffff;
        box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.2);
        position: relative;
        z-index: 10;
    }

    /* Scroll halus */
    html {
        scroll-behavior: smooth;
    }

    /* Gradient text */
    .text-gradient {
        background: linear-gradient(135deg, #0ea5e9 0%, #6366f1 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
</style>

<!-- ==================== HERO SECTION ==================== -->
<section class="relative min-h-[60vh] flex items-center justify-center overflow-hidden" style="background: linear-gradient(160deg, #0f172a 0%, #1e293b 40%, #1e3a5f 100%);">
    <!-- Decorative gradients -->
    <div class="absolute top-[-30%] left-[-15%] w-[70%] h-[160%] bg-[radial-gradient(circle_at_35%_35%,rgba(56,189,248,0.12),transparent_60%)] pointer-events-none"></div>
    <div class="absolute bottom-[-20%] right-[-10%] w-[60%] h-[140%] bg-[radial-gradient(circle_at_70%_80%,rgba(99,102,241,0.08),transparent_60%)] pointer-events-none"></div>

    <div class="container mx-auto px-4 relative z-10 text-center" data-aos="fade-up" data-aos-duration="1000">
        <div class="w-20 h-20 md:w-24 md:h-24 bg-white/10 backdrop-blur-md border-2 border-white/20 rounded-2xl flex items-center justify-center mx-auto mb-8 shadow-2xl">
            <i class="fas fa-info-circle text-white text-3xl md:text-4xl"></i>
        </div>

        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-6 leading-tight tracking-tight">
            Tentang <span class="text-sky-300">AyoKos</span>
        </h1>

        <p class="text-lg md:text-xl text-slate-300 max-w-3xl mx-auto leading-relaxed mb-8">
            Platform terpercaya yang menghubungkan pencari kos dengan pemilik kos terbaik di seluruh Indonesia. 
            Kami hadir untuk membuat hunian sementara terasa seperti rumah.
        </p>

        <div class="flex flex-wrap justify-center gap-3">
            <span class="badge-soft bg-white/10 text-sky-200 border border-white/10 backdrop-blur-sm">
                <i class="fas fa-shield-alt mr-1.5 text-sky-300"></i> Terverifikasi
            </span>
            <span class="badge-soft bg-white/10 text-sky-200 border border-white/10 backdrop-blur-sm">
                <i class="fas fa-bolt mr-1.5 text-sky-300"></i> Cepat & Mudah
            </span>
            <span class="badge-soft bg-white/10 text-sky-200 border border-white/10 backdrop-blur-sm">
                <i class="fas fa-heart mr-1.5 text-sky-300"></i> Terpercaya
            </span>
        </div>
    </div>
</section>

<!-- ==================== MISI & VISI ==================== -->
<section class="section-padding bg-white">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-2 gap-8 items-stretch">
            <!-- Mission -->
            <div class="bg-white border border-slate-200 rounded-2xl p-8 md:p-10 shadow-sm card-hover flex flex-col" data-aos="fade-right">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-14 h-14 bg-gradient-to-br from-sky-50 to-blue-50 rounded-xl flex items-center justify-center text-sky-600 text-2xl shrink-0">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <div>
                        <span class="text-xs font-semibold text-sky-600 uppercase tracking-wider">Our Mission</span>
                        <h3 class="text-2xl font-bold text-slate-900">Misi Kami</h3>
                    </div>
                </div>
                <p class="text-slate-500 leading-relaxed flex-grow">
                    Menyediakan platform yang <strong class="text-slate-700">aman, transparan, dan mudah digunakan</strong> untuk mempermudah pencarian dan pengelolaan kos. Kami berkomitmen membangun ekosistem hunian yang menghubungkan penghuni dan pemilik kos secara langsung tanpa biaya tersembunyi.
                </p>
                <div class="mt-6 pt-6 border-t border-slate-100 flex gap-6">
                    <div class="text-center">
                        <div class="text-xl font-bold text-sky-600">100%</div>
                        <div class="text-xs text-slate-400">Transparan</div>
                    </div>
                    <div class="text-center">
                        <div class="text-xl font-bold text-sky-600">24/7</div>
                        <div class="text-xs text-slate-400">Dukungan</div>
                    </div>
                    <div class="text-center">
                        <div class="text-xl font-bold text-sky-600">0</div>
                        <div class="text-xs text-slate-400">Biaya Tersembunyi</div>
                    </div>
                </div>
            </div>

            <!-- Vision -->
            <div class="bg-white border border-slate-200 rounded-2xl p-8 md:p-10 shadow-sm card-hover flex flex-col" data-aos="fade-left">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-14 h-14 bg-gradient-to-br from-emerald-50 to-green-50 rounded-xl flex items-center justify-center text-emerald-600 text-2xl shrink-0">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div>
                        <span class="text-xs font-semibold text-emerald-600 uppercase tracking-wider">Our Vision</span>
                        <h3 class="text-2xl font-bold text-slate-900">Visi Kami</h3>
                    </div>
                </div>
                <p class="text-slate-500 leading-relaxed flex-grow">
                    Menjadi <strong class="text-slate-700">platform nomor satu di Indonesia</strong> dalam bidang pencarian dan pengelolaan kos, dengan memberikan pengalaman terbaik bagi semua pengguna melalui teknologi inovatif, data akurat, dan layanan yang terpercaya di setiap kota besar.
                </p>
                <div class="mt-6 pt-6 border-t border-slate-100 flex gap-6">
                    <div class="text-center">
                        <div class="text-xl font-bold text-emerald-600">#1</div>
                        <div class="text-xs text-slate-400">Di Indonesia</div>
                    </div>
                    <div class="text-center">
                        <div class="text-xl font-bold text-emerald-600">50+</div>
                        <div class="text-xs text-slate-400">Kota</div>
                    </div>
                    <div class="text-center">
                        <div class="text-xl font-bold text-emerald-600">∞</div>
                        <div class="text-xs text-slate-400">Inovasi</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== GAMBAR / GALLERY ==================== -->
<section class="pb-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4" data-aos="fade-up">
            <div class="relative group overflow-hidden rounded-2xl h-48 md:h-56">
                <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=500&h=400&fit=crop" alt="Kos modern" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">
                    <span class="text-white font-medium text-sm">Kos Modern</span>
                </div>
            </div>
            <div class="relative group overflow-hidden rounded-2xl h-48 md:h-56 mt-0 md:mt-8">
                <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=500&h=400&fit=crop" alt="Ruang bersama" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">
                    <span class="text-white font-medium text-sm">Ruang Bersama</span>
                </div>
            </div>
            <div class="relative group overflow-hidden rounded-2xl h-48 md:h-56">
                <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=500&h=400&fit=crop" alt="Fasilitas lengkap" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">
                    <span class="text-white font-medium text-sm">Fasilitas Lengkap</span>
                </div>
            </div>
            <div class="relative group overflow-hidden rounded-2xl h-48 md:h-56 mt-0 md:mt-8">
                <img src="https://images.unsplash.com/photo-1560185893-a55cbc8c57e8?w=500&h=400&fit=crop" alt="Kamar nyaman" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">
                    <span class="text-white font-medium text-sm">Kamar Nyaman</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== NILAI-NILAI KAMI ==================== -->
<section class="section-padding bg-slate-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="badge-soft bg-sky-50 text-sky-700 border border-sky-100 mb-3">Nilai-Nilai</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Prinsip yang Kami <span class="text-sky-600">Pegang Teguh</span></h2>
            <p class="text-slate-500 max-w-2xl mx-auto">Setiap keputusan dan layanan kami didasarkan pada nilai-nilai fundamental ini</p>
        </div>

        <div class="grid md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white border border-slate-200 rounded-2xl p-8 card-hover" data-aos="fade-up" data-aos-delay="0">
                <div class="w-14 h-14 bg-gradient-to-br from-sky-50 to-blue-50 rounded-xl flex items-center justify-center text-sky-600 text-2xl mb-5">
                    <i class="fas fa-lightbulb"></i>
                </div>
                <h3 class="text-xl font-semibold text-slate-900 mb-3">Inovasi Berkelanjutan</h3>
                <p class="text-slate-500 text-sm leading-relaxed">
                    Kami terus mengembangkan fitur baru seperti peta interaktif, filter pintar, dan sistem review untuk pengalaman terbaik.
                </p>
            </div>
            <div class="bg-white border border-slate-200 rounded-2xl p-8 card-hover" data-aos="fade-up" data-aos-delay="150">
                <div class="w-14 h-14 bg-gradient-to-br from-emerald-50 to-green-50 rounded-xl flex items-center justify-center text-emerald-600 text-2xl mb-5">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 class="text-xl font-semibold text-slate-900 mb-3">Keandalan & Keamanan</h3>
                <p class="text-slate-500 text-sm leading-relaxed">
                    Setiap kos diverifikasi dan data pengguna dilindungi dengan enkripsi. Keamanan adalah prioritas utama kami.
                </p>
            </div>
            <div class="bg-white border border-slate-200 rounded-2xl p-8 card-hover" data-aos="fade-up" data-aos-delay="300">
                <div class="w-14 h-14 bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl flex items-center justify-center text-purple-600 text-2xl mb-5">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="text-xl font-semibold text-slate-900 mb-3">Komunitas Terbuka</h3>
                <p class="text-slate-500 text-sm leading-relaxed">
                    Membangun ekosistem saling mendukung antara penghuni dan pemilik kos melalui forum, review, dan event komunitas.
                </p>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white border border-slate-100 rounded-xl p-5 text-center card-hover" data-aos="zoom-in" data-aos-delay="0">
                <div class="w-12 h-12 bg-amber-50 rounded-lg flex items-center justify-center mx-auto mb-3 text-amber-600 text-xl">
                    <i class="fas fa-handshake"></i>
                </div>
                <h4 class="font-semibold text-slate-900 text-sm">Integritas</h4>
                <p class="text-xs text-slate-400 mt-1">Jujur dalam setiap informasi</p>
            </div>
            <div class="bg-white border border-slate-100 rounded-xl p-5 text-center card-hover" data-aos="zoom-in" data-aos-delay="100">
                <div class="w-12 h-12 bg-rose-50 rounded-lg flex items-center justify-center mx-auto mb-3 text-rose-600 text-xl">
                    <i class="fas fa-heart"></i>
                </div>
                <h4 class="font-semibold text-slate-900 text-sm">Peduli</h4>
                <p class="text-xs text-slate-400 mt-1">Memahami kebutuhan pengguna</p>
            </div>
            <div class="bg-white border border-slate-100 rounded-xl p-5 text-center card-hover" data-aos="zoom-in" data-aos-delay="200">
                <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center mx-auto mb-3 text-blue-600 text-xl">
                    <i class="fas fa-rocket"></i>
                </div>
                <h4 class="font-semibold text-slate-900 text-sm">Efisiensi</h4>
                <p class="text-xs text-slate-400 mt-1">Proses cepat & responsif</p>
            </div>
            <div class="bg-white border border-slate-100 rounded-xl p-5 text-center card-hover" data-aos="zoom-in" data-aos-delay="300">
                <div class="w-12 h-12 bg-teal-50 rounded-lg flex items-center justify-center mx-auto mb-3 text-teal-600 text-xl">
                    <i class="fas fa-globe"></i>
                </div>
                <h4 class="font-semibold text-slate-900 text-sm">Aksesibilitas</h4>
                <p class="text-xs text-slate-400 mt-1">Untuk semua kalangan</p>
            </div>
        </div>
    </div>
</section>

<!-- ==================== STATISTIK ==================== -->
<section class="section-padding bg-white">
    <div class="container mx-auto px-4">
        <div class="relative rounded-3xl overflow-hidden" data-aos="fade-up">
            <!-- Background -->
            <div class="absolute inset-0 bg-gradient-to-r from-slate-800 via-slate-900 to-slate-800"></div>
            <div class="absolute top-0 right-0 w-[60%] h-full bg-[radial-gradient(circle_at_70%_50%,rgba(56,189,248,0.1),transparent_60%)] pointer-events-none"></div>
            
            <div class="relative z-10 py-16 px-8 md:px-16">
                <div class="text-center mb-12">
                    <span class="badge-soft bg-white/10 text-sky-200 border border-white/10 mb-3">Statistik</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Pertumbuhan Kami dalam <span class="text-sky-300">Angka</span></h2>
                    <p class="text-slate-300 max-w-xl mx-auto">Perjalanan AyoKos yang terus berkembang untuk melayani lebih banyak pengguna</p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                    <div class="p-4" data-aos="fade-up" data-aos-delay="0">
                        <div class="text-4xl md:text-5xl font-bold text-white mb-2">500+</div>
                        <div class="text-sky-200 text-sm font-medium">Kosan Terdaftar</div>
                        <div class="w-12 h-1 bg-sky-500/50 rounded-full mx-auto mt-3"></div>
                    </div>
                    <div class="p-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="text-4xl md:text-5xl font-bold text-white mb-2">2,000+</div>
                        <div class="text-sky-200 text-sm font-medium">Penghuni Aktif</div>
                        <div class="w-12 h-1 bg-indigo-500/50 rounded-full mx-auto mt-3"></div>
                    </div>
                    <div class="p-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="text-4xl md:text-5xl font-bold text-white mb-2">50+</div>
                        <div class="text-sky-200 text-sm font-medium">Kota Terjangkau</div>
                        <div class="w-12 h-1 bg-purple-500/50 rounded-full mx-auto mt-3"></div>
                    </div>
                    <div class="p-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="text-4xl md:text-5xl font-bold text-white mb-2">98%</div>
                        <div class="text-sky-200 text-sm font-medium">Kepuasan Pengguna</div>
                        <div class="w-12 h-1 bg-emerald-500/50 rounded-full mx-auto mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== TIM KAMI ==================== -->
<section class="section-padding bg-slate-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="badge-soft bg-sky-50 text-sky-700 border border-sky-100 mb-3">Tim Kami</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Orang-Orang <span class="text-sky-600">Hebat</span> di Balik Layar</h2>
            <p class="text-slate-500 max-w-2xl mx-auto">Didirikan dan dikelola oleh tim yang berdedikasi untuk memberikan pengalaman terbaik</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
            <!-- Founder -->
            <div class="bg-white border border-slate-200 rounded-2xl p-8 text-center card-hover group" data-aos="fade-up" data-aos-delay="0">
                <div class="w-32 h-32 mx-auto mb-6 rounded-full overflow-hidden relative ring-4 ring-sky-50 group-hover:ring-sky-100 transition-all">
                    <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=300&h=300&fit=crop&crop=face" alt="Muhammad Rizki" class="w-full h-full object-cover" loading="lazy">
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-1">Muhammad Rizki</h3>
                <p class="text-sky-600 font-medium text-sm mb-4">Founder & CEO</p>
                <p class="text-slate-500 text-sm leading-relaxed mb-5">
                    Bertanggung jawab atas visi, strategi, dan pertumbuhan perusahaan. Berpengalaman 8+ tahun di industri properti teknologi.
                </p>
                <div class="flex justify-center gap-3">
                    <a href="#" class="w-9 h-9 rounded-full bg-slate-50 border border-slate-200 flex items-center justify-center text-slate-400 hover:text-sky-600 hover:border-sky-200 transition">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="w-9 h-9 rounded-full bg-slate-50 border border-slate-200 flex items-center justify-center text-slate-400 hover:text-sky-600 hover:border-sky-200 transition">
                        <i class="fab fa-twitter"></i>
                    </a>
                </div>
            </div>

            <!-- CTO -->
            <div class="bg-white border border-slate-200 rounded-2xl p-8 text-center card-hover group" data-aos="fade-up" data-aos-delay="150">
                <div class="w-32 h-32 mx-auto mb-6 rounded-full overflow-hidden relative ring-4 ring-emerald-50 group-hover:ring-emerald-100 transition-all">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=300&h=300&fit=crop&crop=face" alt="Ahmad Fauzi" class="w-full h-full object-cover" loading="lazy">
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-1">Ahmad Fauzi</h3>
                <p class="text-emerald-600 font-medium text-sm mb-4">Chief Technology Officer</p>
                <p class="text-slate-500 text-sm leading-relaxed mb-5">
                    Mengelola arsitektur platform, keamanan data, dan inovasi teknologi untuk memastikan performa terbaik.
                </p>
                <div class="flex justify-center gap-3">
                    <a href="#" class="w-9 h-9 rounded-full bg-slate-50 border border-slate-200 flex items-center justify-center text-slate-400 hover:text-emerald-600 hover:border-emerald-200 transition">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="w-9 h-9 rounded-full bg-slate-50 border border-slate-200 flex items-center justify-center text-slate-400 hover:text-emerald-600 hover:border-emerald-200 transition">
                        <i class="fab fa-github"></i>
                    </a>
                </div>
            </div>

            <!-- Operations -->
            <div class="bg-white border border-slate-200 rounded-2xl p-8 text-center card-hover group" data-aos="fade-up" data-aos-delay="300">
                <div class="w-32 h-32 mx-auto mb-6 rounded-full overflow-hidden relative ring-4 ring-purple-50 group-hover:ring-purple-100 transition-all">
                    <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=300&h=300&fit=crop&crop=face" alt="Dewi Lestari" class="w-full h-full object-cover" loading="lazy">
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-1">Dewi Lestari</h3>
                <p class="text-purple-600 font-medium text-sm mb-4">Head of Operations</p>
                <p class="text-slate-500 text-sm leading-relaxed mb-5">
                    Mengawasi operasional harian, verifikasi kos, dan layanan pelanggan untuk memastikan kepuasan pengguna.
                </p>
                <div class="flex justify-center gap-3">
                    <a href="#" class="w-9 h-9 rounded-full bg-slate-50 border border-slate-200 flex items-center justify-center text-slate-400 hover:text-purple-600 hover:border-purple-200 transition">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="w-9 h-9 rounded-full bg-slate-50 border border-slate-200 flex items-center justify-center text-slate-400 hover:text-purple-600 hover:border-purple-200 transition">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== TIMELINE / MILESTONE ==================== -->
<section class="section-padding bg-white">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="badge-soft bg-sky-50 text-sky-700 border border-sky-100 mb-3">Perjalanan</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Milestone <span class="text-sky-600">AyoKos</span></h2>
            <p class="text-slate-500 max-w-xl mx-auto">Perjalanan kami dari ide sederhana hingga menjadi platform pencarian kos terdepan</p>
        </div>

        <div class="relative">
            <div class="timeline-line"></div>

            <!-- Milestone 1 -->
            <div class="flex flex-col md:flex-row items-center mb-12 relative" data-aos="fade-up">
                <div class="md:w-1/2 md:pr-12 md:text-right mb-4 md:mb-0 w-full pl-12 md:pl-0">
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm inline-block w-full md:w-auto text-left md:text-right card-hover">
                        <span class="inline-block px-3 py-1 rounded-full bg-sky-50 text-sky-700 text-xs font-semibold mb-2">Januari 2026</span>
                        <h4 class="text-lg font-bold text-slate-900 mb-2">Peluncuran AyoKos v1.0</h4>
                        <p class="text-slate-500 text-sm leading-relaxed">
                            Platform pertama kami diluncurkan dengan fokus pada kota Bandung dan sekitarnya.
                        </p>
                    </div>
                </div>
                <div class="absolute left-6 md:left-1/2 md:-translate-x-1/2 top-0 md:top-1/2 md:-translate-y-1/2">
                    <div class="timeline-dot bg-sky-500"></div>
                </div>
                <div class="md:w-1/2 md:pl-12 w-full pl-12 md:pl-0">
                    <div class="hidden md:block text-slate-300 text-sm font-medium">Awal Mula</div>
                </div>
            </div>

            <!-- Milestone 2 -->
            <div class="flex flex-col md:flex-row items-center mb-12 relative" data-aos="fade-up">
                <div class="md:w-1/2 md:pr-12 md:text-right w-full pl-12 md:pl-0 order-1 md:order-1 mb-4 md:mb-0">
                    <div class="hidden md:block text-slate-300 text-sm font-medium text-left md:text-right">Ekspansi</div>
                </div>
                <div class="absolute left-6 md:left-1/2 md:-translate-x-1/2 top-0 md:top-1/2 md:-translate-y-1/2">
                    <div class="timeline-dot bg-indigo-500"></div>
                </div>
                <div class="md:w-1/2 md:pl-12 w-full pl-12 md:pl-0 order-2 md:order-2">
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm inline-block w-full md:w-auto text-left card-hover">
                        <span class="inline-block px-3 py-1 rounded-full bg-indigo-50 text-indigo-700 text-xs font-semibold mb-2">Februari 2026</span>
                        <h4 class="text-lg font-bold text-slate-900 mb-2">Ekspansi ke 10 Kota Besar</h4>
                        <p class="text-slate-500 text-sm leading-relaxed">
                            Berhasil memperluas layanan ke Jakarta, Surabaya, Malang, Yogyakarta, dan kota besar lainnya.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Milestone 3 -->
            <div class="flex flex-col md:flex-row items-center mb-12 relative" data-aos="fade-up">
                <div class="md:w-1/2 md:pr-12 md:text-right mb-4 md:mb-0 w-full pl-12 md:pl-0">
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm inline-block w-full md:w-auto text-left md:text-right card-hover">
                        <span class="inline-block px-3 py-1 rounded-full bg-purple-50 text-purple-700 text-xs font-semibold mb-2">Maret 2026</span>
                        <h4 class="text-lg font-bold text-slate-900 mb-2">1.000+ Pengguna Aktif</h4>
                        <p class="text-slate-500 text-sm leading-relaxed">
                            Mencapai tonggak penting dengan ribuan pengguna aktif yang percaya pada platform kami.
                        </p>
                    </div>
                </div>
                <div class="absolute left-6 md:left-1/2 md:-translate-x-1/2 top-0 md:top-1/2 md:-translate-y-1/2">
                    <div class="timeline-dot bg-purple-500"></div>
                </div>
                <div class="md:w-1/2 md:pl-12 w-full pl-12 md:pl-0">
                    <div class="hidden md:block text-slate-300 text-sm font-medium">Komunitas</div>
                </div>
            </div>

            <!-- Milestone 4 -->
            <div class="flex flex-col md:flex-row items-center relative" data-aos="fade-up">
                <div class="md:w-1/2 md:pr-12 md:text-right w-full pl-12 md:pl-0 order-1 md:order-1 mb-4 md:mb-0">
                    <div class="hidden md:block text-slate-300 text-sm font-medium text-left md:text-right">Masa Depan</div>
                </div>
                <div class="absolute left-6 md:left-1/2 md:-translate-x-1/2 top-0 md:top-1/2 md:-translate-y-1/2">
                    <div class="timeline-dot bg-emerald-500"></div>
                </div>
                <div class="md:w-1/2 md:pl-12 w-full pl-12 md:pl-0 order-2 md:order-2">
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm inline-block w-full md:w-auto text-left card-hover">
                        <span class="inline-block px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold mb-2">Mendatang</span>
                        <h4 class="text-lg font-bold text-slate-900 mb-2">Fitur AI & Mobile App</h4>
                        <p class="text-slate-500 text-sm leading-relaxed">
                            Sedang mengembangkan rekomendasi berbasis AI dan aplikasi mobile native untuk pengalaman lebih baik.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== CTA FINAL ==================== -->
<section class="section-padding bg-gradient-to-r from-slate-800 via-slate-900 to-slate-800 text-white relative overflow-hidden">
    <div class="absolute top-0 right-0 w-[50%] h-full bg-[radial-gradient(circle_at_80%_50%,rgba(56,189,248,0.08),transparent_60%)] pointer-events-none"></div>
    
    <div class="container mx-auto px-4 text-center relative z-10" data-aos="fade-up">
        <h2 class="text-3xl md:text-5xl font-bold mb-4">Bergabunglah dengan Komunitas Kami</h2>
        <p class="text-lg text-slate-300 mb-8 max-w-2xl mx-auto">
            Baik Anda mencari kos impian atau memiliki properti untuk disewakan, AyoKos adalah platform yang tepat untuk memulai.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?php echo e(route('public.kos.index')); ?>" class="px-8 py-4 bg-sky-500 hover:bg-sky-600 text-white font-semibold rounded-xl transition shadow-lg text-lg">
                <i class="fas fa-search mr-2"></i> Cari Kos Sekarang
            </a>
            <?php if(auth()->guard()->guest()): ?>
            <a href="<?php echo e(route('register')); ?>" class="px-8 py-4 bg-white/10 backdrop-blur border border-white/20 text-white font-semibold rounded-xl hover:bg-white/20 transition text-lg">
                <i class="fas fa-user-plus mr-2"></i> Daftar sebagai Pemilik
            </a>
            <?php endif; ?>
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/public/pages/about.blade.php ENDPATH**/ ?>