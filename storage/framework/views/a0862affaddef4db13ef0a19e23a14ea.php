<?php $__env->startSection('title', 'Tentang Kami - AyoKos'); ?>

<?php $__env->startSection('content'); ?>

<!-- ==================== HERO SECTION ==================== -->
<section class="bg-yellow-400 py-20 md:py-28 border-b-4 border-black">
    <div class="container mx-auto px-4 text-center" data-aos="fade-up" data-aos-duration="1000">
        <div class="w-20 h-20 md:w-24 md:h-24 bg-black border-4 border-black shadow-[4px_4px_0px_#000] flex items-center justify-center mx-auto mb-8">
            <i class="fas fa-info-circle text-white text-3xl md:text-4xl"></i>
        </div>

        <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-black mb-6 leading-tight tracking-tight">
            Tentang <span class="bg-black text-white px-3">AyoKos</span>
        </h1>

        <p class="text-lg md:text-xl text-gray-800 font-bold max-w-3xl mx-auto leading-relaxed mb-8">
            Platform terpercaya yang menghubungkan pencari kos dengan pemilik kos terbaik di seluruh Indonesia. 
            Kami hadir untuk membuat hunian sementara terasa seperti rumah.
        </p>

        <div class="flex flex-wrap justify-center gap-3">
            <span class="inline-block px-4 py-2 border-2 border-black bg-black text-white font-black text-sm shadow-[2px_2px_0px_#000]">Pencari Kos</span>
            <span class="inline-block px-4 py-2 border-2 border-black bg-white text-black font-black text-sm shadow-[2px_2px_0px_#000]">Pemilik Kos</span>
            <span class="inline-block px-4 py-2 border-2 border-black bg-white text-black font-black text-sm shadow-[2px_2px_0px_#000]">Mitra Terpercaya</span>
        </div>
    </div>
</section>

<!-- ==================== CONTENT ==================== -->
<section class="bg-white py-16 border-t-4 border-black">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-8" data-aos="fade-up">
                    <div class="w-14 h-14 bg-pink-400 border-2 border-black flex items-center justify-center mb-5">
                        <i class="fas fa-eye text-black text-xl"></i>
                    </div>
                    <h3 class="text-xl font-black text-black mb-3">Visi Kami</h3>
                    <p class="text-gray-700 font-medium leading-relaxed">Menjadi platform pencarian kos nomor satu di Indonesia yang memberikan pengalaman terbaik bagi setiap pencari hunian.</p>
                </div>
                <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-8" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-14 h-14 bg-yellow-400 border-2 border-black flex items-center justify-center mb-5">
                        <i class="fas fa-rocket text-black text-xl"></i>
                    </div>
                    <h3 class="text-xl font-black text-black mb-3">Misi Kami</h3>
                    <p class="text-gray-700 font-medium leading-relaxed">Menyediakan informasi kos yang akurat, transparan, dan terpercaya dengan teknologi modern yang mudah digunakan.</p>
                </div>
            </div>

            <div class="mt-12">
                <!-- Timeline -->
                <h2 class="text-2xl font-black text-black mb-8 text-center">Perjalanan <span class="bg-black text-white px-2">Kami</span></h2>
                <div class="relative" data-aos="fade-up">
                    <div class="timeline-line"></div>
                    <div class="space-y-12">
                        <div class="relative pl-12 md:pl-0 md:flex md:justify-start">
                            <div class="md:w-1/2 md:pr-12 md:text-right">
                                <div class="timeline-dot bg-pink-400"></div>
                                <span class="inline-block px-3 py-1 bg-pink-400 text-black text-xs font-black border-2 border-black mb-2">2024</span>
                                <h3 class="text-lg font-black text-black">AyoKos Didirikan</h3>
                                <p class="text-gray-600 font-medium">Platform ini lahir dari kebutuhan akan hunian sementara yang mudah dicari.</p>
                            </div>
                        </div>
                        <div class="relative pl-12 md:pl-0 md:flex md:justify-end">
                            <div class="md:w-1/2 md:pl-12">
                                <div class="timeline-dot bg-yellow-400"></div>
                                <span class="inline-block px-3 py-1 bg-yellow-400 text-black text-xs font-black border-2 border-black mb-2">2025</span>
                                <h3 class="text-lg font-black text-black">Berkembang ke 25+ Kota</h3>
                                <p class="text-gray-600 font-medium">Jangkauan kami meluas ke berbagai kota besar di Indonesia.</p>
                            </div>
                        </div>
                        <div class="relative pl-12 md:pl-0 md:flex md:justify-start">
                            <div class="md:w-1/2 md:pr-12 md:text-right">
                                <div class="timeline-dot bg-lime-400"></div>
                                <span class="inline-block px-3 py-1 bg-lime-400 text-black text-xs font-black border-2 border-black mb-2">2026</span>
                                <h3 class="text-lg font-black text-black">100.000+ Penghuni Terbantu</h3>
                                <p class="text-gray-600 font-medium">Lebih dari 100 ribu penghuni telah menemukan kos impian melalui AyoKos.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12 text-center" data-aos="fade-up">
                <a href="<?php echo e(route('public.kos.index')); ?>" class="inline-flex items-center px-8 py-4 bg-lime-400 hover:bg-lime-500 text-black font-black border-2 border-black shadow-[4px_4px_0px_#000] hover:shadow-[6px_6px_0px_#000] hover:translate-y-[-2px] transition-all uppercase tracking-wide">
                    <i class="fas fa-search mr-2"></i> Mulai Cari Kos
                </a>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views\public\pages\about.blade.php ENDPATH**/ ?>