@extends('layouts.app')

@section('title', 'Ulasan Kos Saya - AyoKos')

@section('content')
<div class="max-w-7xl mx-auto p-4 md:p-6 lg:p-8 space-y-6">
    <!-- Alerts -->
    @if(session('success'))
        <div class="bg-emerald-400 border-2 border-black shadow-[3px_3px_0px_#000] p-6 mb-6">
            <div class="flex items-start space-x-4">
                <div class="p-2 bg-emerald-400 border-2 border-black">
                    <i class="fas fa-check-circle text-black"></i>
                </div>
                <div>
                    <h3 class="text-black font-black">Berhasil!</h3>
                    <p class="text-black text-sm mt-1">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-400 border-2 border-black shadow-[3px_3px_0px_#000] p-6 mb-6">
            <div class="flex items-start space-x-4">
                <div class="p-2 bg-red-400 border-2 border-black">
                    <i class="fas fa-exclamation-circle text-black"></i>
                </div>
                <div>
                    <h3 class="text-black font-black">Gagal!</h3>
                    <p class="text-black text-sm mt-1">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Breadcrumb -->
    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
        <nav class="flex overflow-x-auto" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3 whitespace-nowrap">
                <li class="inline-flex items-center">
                    <a href="{{ route('pemilik.dashboard') }}" class="inline-flex items-center text-sm font-bold text-gray-600 hover:text-black transition-colors">
                        <i class="fas fa-home mr-2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="inline-flex items-center">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                        <a href="{{ route('pemilik.reviews.index') }}" class="inline-flex items-center text-sm font-bold text-black">
                            <i class="fas fa-star mr-2"></i>
                            Kelola Reviews
                        </a>
                    </div>
                </li>
            </ol>
        </nav>
    </div>   
    
    <!-- Header Section -->
    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4 sm:p-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>

                <h1 class="text-xl sm:text-2xl md:text-3xl font-black text-black mb-2 flex items-center">
                    <i class="fas fa-star mr-3"></i>
                    Ulasan untuk Kos Saya
                </h1>
                <p class="text-xs sm:text-sm text-gray-700">Semua ulasan yang diberikan penghuni untuk kos yang Anda miliki</p>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4 sm:p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-lime-400 border-2 border-black">
                    <i class="fas fa-comment-alt text-black text-xl"></i>
                </div>
                <span class="text-sm font-black px-2 py-1 bg-black text-white border-2 border-black">
                    Total
                </span>
            </div>
            <h3 class="text-2xl font-black text-black mb-1">{{ $reviews->total() }}</h3>
            <p class="text-sm text-gray-600">Total Ulasan</p>
        </div>

        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4 sm:p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-yellow-400 border-2 border-black">
                    <i class="fas fa-star text-black text-xl"></i>
                </div>
                <span class="text-sm font-black px-2 py-1 bg-black text-white border-2 border-black">
                    Rata-rata
                </span>
            </div>
             <h3 class="text-2xl font-black text-black mb-1">{{ number_format($overall_avg_rating ?? 0, 1) }}</h3>
            <p class="text-sm text-gray-600">Rating Rata-rata</p>
        </div>

        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4 sm:p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-pink-400 border-2 border-black">
                    <i class="fas fa-calendar-alt text-black text-xl"></i>
                </div>
                <span class="text-sm font-black px-2 py-1 bg-black text-white border-2 border-black">
                    Terbaru
                </span>
            </div>
             <h3 class="text-2xl font-black text-black mb-1">
                 {{ $latest_review ? $latest_review->created_at->format('d M Y') : '-' }}
             </h3>
            <p class="text-sm text-gray-600">Terakhir Diterima</p>
        </div>
    </div>

    <!-- Reviews List -->
    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] overflow-hidden">
        @if($reviews->count() > 0)
            <div class="divide-y-2 divide-gray-200">
                @foreach($reviews as $review)
                <div class="p-4 sm:p-6 w-full hover:bg-yellow-100 transition-all duration-300">
                    <div class="flex flex-col lg:flex-row lg:items-start justify-between gap-4 sm:gap-6">
                        <!-- Left Content -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start gap-3 sm:gap-4 min-w-0">
                                <!-- Kos Image -->
                                <div class="shrink-0">
                                    @if($review->kos && $review->kos->foto_utama)
                                        <?php
                                        $filePath = storage_path('app/public/' . $review->kos->foto_utama);
                                        $fileExists = file_exists($filePath);
                                        ?>
                                        @if($fileExists)
                                            <img src="{{ url('storage/' . $review->kos->foto_utama) }}" 
                                                 alt="{{ $review->kos->nama_kos }}" 
                                                 class="w-14 h-14 sm:w-20 sm:h-20 object-cover border-2 border-black">
                                        @else
                                            <div class="w-14 h-14 sm:w-20 sm:h-20 bg-gray-200 border-2 border-black flex items-center justify-center">
                                                <i class="fas fa-home text-xl sm:text-2xl text-gray-500"></i>
                                            </div>
                                        @endif
                                    @else
                                        <div class="w-14 h-14 sm:w-20 sm:h-20 bg-gray-200 border-2 border-black flex items-center justify-center">
                                            <i class="fas fa-home text-xl sm:text-2xl text-gray-500"></i>
                                        </div>
                                    @endif
                                </div>

                                <!-- Review Content -->
                                <div class="min-w-0 flex-1">
                                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-1 mb-2">
                                        <div class="min-w-0">
                                            <h3 class="font-black text-black text-base sm:text-lg truncate">
                                                {{ optional($review->kos)->nama_kos ?? '—' }}
                                            </h3>
                                            <div class="flex items-center text-xs sm:text-sm text-gray-600 mt-0.5 min-w-0">
                                                <i class="fas fa-map-marker-alt mr-1.5 text-sky-600 shrink-0"></i>
                                                <span class="truncate">{{ optional($review->kos)->alamat ?? '-' }}, {{ optional($review->kos)->kota ?? '-' }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Rating -->
                                    <div class="flex items-center flex-wrap gap-2 sm:gap-3 mb-3">
                                        <div class="flex text-yellow-500">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $review->rating)
                                                    <i class="fas fa-star text-xs sm:text-sm"></i>
                                                @else
                                                    <i class="far fa-star text-xs sm:text-sm"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <span class="text-xs sm:text-sm font-bold text-black">{{ $review->rating }}/5</span>
                                        <span class="text-gray-500">•</span>
                                        <span class="text-xs sm:text-sm text-gray-500">{{ $review->created_at->format('d M Y H:i') }}</span>
                                    </div>

                                    <!-- Comment -->
                                    <p class="text-black text-xs sm:text-sm mt-2 bg-gray-100 p-3 sm:p-4 border-2 border-black [overflow-wrap:anywhere] break-words">
                                        <i class="fas fa-quote-left text-sky-400 mr-2"></i>
                                        {{ $review->komentar }}
                                    </p>

                                    <!-- Review Image -->
                                    @if($review->foto_review)
                                    <div class="mt-3">
                                        <img src="{{ asset('storage/' . $review->foto_review) }}" 
                                             alt="Foto review" 
                                             class="w-20 h-20 sm:w-24 sm:h-24 object-cover border-2 border-black hover:border-yellow-400 cursor-pointer transition-all duration-300 hover:scale-105"
                                             onclick="openImage('{{ asset('storage/' . $review->foto_review) }}')">
                                        <p class="text-xs text-gray-500 mt-1">Klik untuk memperbesar</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Right Actions -->
                        <div class="w-full lg:w-48 shrink-0 flex flex-col sm:flex-row lg:flex-col gap-3">
                            <a href="{{ route('pemilik.kos.show', optional($review->kos)->id_kos) }}" 
                               class="flex-1 lg:flex-none flex items-center justify-center gap-2 px-4 py-2.5 bg-sky-400 hover:bg-sky-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all duration-300 uppercase tracking-wide text-xs sm:text-sm">
                                <i class="fas fa-eye"></i>
                                <span>Lihat Kos</span>
                            </a>
                            
                            <div class="flex-1 lg:flex-none bg-gray-100 border-2 border-black p-3 min-w-0">
                                <div class="flex items-center gap-2 min-w-0">
                                    @if($review->penghuni && $review->penghuni->foto_profil)
                                        <?php
                                        $filePath = storage_path('app/public/' . $review->penghuni->foto_profil);
                                        $fileExists = file_exists($filePath);
                                        ?>
                                        @if($fileExists)
                                            <img src="{{ url('storage/' . $review->penghuni->foto_profil) }}" 
                                                 alt="{{ $review->penghuni->nama }}" 
                                                 class="w-8 h-8 object-cover border-2 border-emerald-400 shrink-0">
                                        @else
                                            <div class="w-8 h-8 bg-emerald-400 border-2 border-black flex items-center justify-center shrink-0">
                                                <span class="text-black font-black text-xs">{{ strtoupper(substr($review->penghuni->nama, 0, 1)) }}</span>
                                            </div>
                                        @endif
                                    @else
                                        <div class="w-8 h-8 bg-emerald-400 border-2 border-black flex items-center justify-center shrink-0">
                                            <i class="fas fa-user text-black text-xs"></i>
                                        </div>
                                    @endif
                                    <div class="min-w-0 flex-1">
                                        <p class="text-[10px] text-gray-500 font-bold uppercase">Penghuni</p>
                                        <p class="text-xs sm:text-sm font-bold text-black truncate">{{ optional($review->penghuni)->nama ?? 'Penghuni' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Table Footer -->
            @if($reviews->hasPages())
                <div class="px-4 sm:px-6 py-4 border-t-2 border-black">
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="text-sm text-gray-700 text-center sm:text-left">
                            Menampilkan <span class="font-black text-black">{{ $reviews->firstItem() }}</span> - 
                            <span class="font-black text-black">{{ $reviews->lastItem() }}</span> dari 
                            <span class="font-black text-black">{{ $reviews->total() }}</span> ulasan
                        </div>
                        <div class="flex gap-2">
                            {{ $reviews->links('vendor.pagination.custom-dark') }}
                        </div>
                    </div>
                </div>
            @endif
        @else
        <!-- Empty State -->
        <div class="text-center py-16">
            <div class="w-24 h-24 bg-gray-200 border-2 border-black shadow-[2px_2px_0px_#000] flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-comment-slash text-4xl text-gray-700"></i>
            </div>
            <h3 class="text-xl font-black text-gray-700 mb-2">Belum Ada Ulasan</h3>
            <p class="text-gray-600 max-w-md mx-auto mb-6">
                Belum ada ulasan untuk kos Anda. Ulasan akan muncul di sini setelah penghuni memberikan rating.
            </p>
            <a href="{{ route('pemilik.kos.index') }}" 
               class="inline-flex items-center gap-2 px-6 py-3 bg-white text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all duration-300">
                <i class="fas fa-home"></i>
                <span>Kelola Kos Anda</span>
            </a>
        </div>
        @endif
    </div>
</div>

<!-- Image Modal -->
<div id="image-modal" class="fixed inset-0 bg-black/90 z-50 hidden items-center justify-center p-4">
    <div class="relative max-w-4xl max-h-full">
        <button onclick="closeImage()" 
                class="absolute -top-12 right-0 text-white text-2xl hover:text-gray-300 transition">
            <i class="fas fa-times"></i>
        </button>
        <img id="modal-image" class="max-w-full max-h-[80vh] border-4 border-black shadow-[4px_4px_0px_#000]">
        <div class="text-center text-white text-sm mt-4 opacity-75">
            Klik di luar gambar untuk menutup
        </div>
    </div>
</div>

<script>
    function openImage(src) {
        document.getElementById('modal-image').src = src;
        document.getElementById('image-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    
    function closeImage() {
        document.getElementById('image-modal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
    
    // Close modal when clicking outside
    document.getElementById('image-modal').addEventListener('click', function(e) {
        if (e.target.id === 'image-modal') closeImage();
    });
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) { 
        if (e.key === 'Escape') closeImage(); 
    });
</script>


@endsection