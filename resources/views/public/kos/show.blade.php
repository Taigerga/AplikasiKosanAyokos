@extends('layouts.app', ['hideFooter' => true])

@section('title', $kos->nama_kos . ' - AyoKos')

@section('content')
<div class="relative bg-gradient-to-br from-slate-800 to-slate-900 pt-28 pb-16 md:pt-32 md:pb-20 overflow-hidden min-h-screen">
    <div class="container mx-auto px-4 space-y-6 relative z-10">
        <!-- Breadcrumb -->
        <nav class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-4" data-aos="fade-down">
            <ol class="inline-flex items-center space-x-1 md:space-x-3 text-sm">
                <li class="inline-flex items-center">
                    <a href="{{ route('public.home') }}" class="text-slate-300 hover:text-white transition">
                        <i class="fas fa-home mr-1"></i> Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right mx-2 text-slate-500 text-xs"></i>
                        <a href="{{ route('public.kos.index') }}" class="text-slate-300 hover:text-white transition">
                            Kos
                        </a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right mx-2 text-slate-500 text-xs"></i>
                        <span class="text-white font-medium truncate max-w-xs">
                            {{ $kos->nama_kos }}
                        </span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Gallery -->
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl overflow-hidden" data-aos="fade-up" data-aos-duration="800">
                    @if($kos->foto_utama)
                        <img src="{{ asset('storage/' . $kos->foto_utama) }}" 
                             alt="{{ $kos->nama_kos }}" 
                             class="w-full h-64 md:h-80 object-cover hover:scale-105 transition-transform duration-700">
                    @else
                        <div class="w-full h-64 md:h-80 bg-white/5 flex items-center justify-center">
                            <i class="fas fa-home text-6xl text-slate-400"></i>
                        </div>
                    @endif
                </div>

                <!-- Basic Info -->
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-6">
                        <div class="flex-1">
                            <h1 class="text-2xl md:text-3xl font-bold text-white mb-2">{{ $kos->nama_kos }}</h1>
                            <div class="flex items-start text-slate-300 mb-4">
                                <i class="fas fa-map-marker-alt text-sky-400 mr-2 mt-0.5 flex-shrink-0"></i>
                                <span class="leading-relaxed">{{ $kos->alamat }}, {{ $kos->kecamatan }}, {{ $kos->kota }}</span>
                            </div>
                            
                            @if($kos->reviews->count() > 0)
                            <div class="flex items-center">
                                <div class="flex items-center">
                                    <div class="flex text-amber-400 mr-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= floor($averageRating))
                                                <i class="fas fa-star"></i>
                                            @elseif($i - 0.5 <= $averageRating)
                                                <i class="fas fa-star-half-alt"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="text-lg font-semibold text-white mr-2">{{ number_format($averageRating, 1) }}</span>
                                </div>
                                <span class="text-slate-400">({{ $totalReviews }} ulasan)</span>
                            </div>
                            @endif
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3">
                            <div class="flex flex-wrap gap-2">
                                <span class="px-3 py-1.5 rounded-full text-sm font-medium bg-sky-500/20 text-sky-300 border border-sky-400/30 capitalize">
                                    {{ $kos->jenis_kos }}
                                </span>
                                <span class="px-3 py-1.5 rounded-full text-sm font-medium bg-emerald-500/20 text-emerald-300 border border-emerald-400/30">
                                    {{ $kos->kamar->count() }} Kamar
                                </span>
                            </div>
                            <button onclick="shareKos()" 
                                    class="px-3 py-1.5 rounded-full text-sm font-medium bg-white/10 text-white border border-white/20 hover:bg-white/20 transition flex items-center">
                                <i class="fas fa-share-alt mr-1"></i> Bagikan
                            </button>
                        </div>
                    </div>
                    
                    <!-- Pemilik Info Card -->
                    @if($kos->pemilik)
                    <div class="">
                        <div class="flex items-center space-x-4">
                            @if($kos->pemilik->foto_profil)
                                @php
                                    $filePath = storage_path('app/public/' . $kos->pemilik->foto_profil);
                                    $fileExists = file_exists($filePath);
                                @endphp
                                @if($fileExists)
                                    <img src="{{ url('storage/' . $kos->pemilik->foto_profil) }}" 
                                         alt="{{ $kos->pemilik->nama }}" 
                                         class="w-12 h-12 rounded-full object-cover border-2 border-sky-400">
                                @else
                                    <div class="w-12 h-12 rounded-full flex items-center justify-center">
                                        <span class="text-white font-semibold text-lg">{{ strtoupper(substr($kos->pemilik->nama, 0, 1)) }}</span>
                                    </div>
                                @endif
                            @else
                                <div class="w-12 h-12 bg-white/10 backdrop-blur-sm border border-white/10 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user-tie text-white text-lg"></i>
                                </div>
                            @endif
                            <div class="flex-1">
                                <h3 class="font-semibold text-white text-lg">Pemilik Kos</h3>
                                <p class="text-sm text-sky-300">{{ $kos->pemilik->nama }}</p>
                                <p class="text-xs text-slate-400 mt-1">Terverifikasi • {{ $kos->created_at->format('Y') }}</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></div>
                                <span class="text-xs text-emerald-300 font-medium">Aktif</span>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Description -->
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6" data-aos="fade-up" data-aos-delay="150">
                    <h2 class="text-xl font-bold text-white mb-4 flex items-center">
                        <i class="fas fa-file-alt text-sky-400 mr-3"></i>
                        Deskripsi Kos
                    </h2>
                    <div class="prose max-w-none text-slate-300 leading-relaxed whitespace-pre-line">
                        {{ $kos->deskripsi }}
                    </div>
                </div>

                <!-- Facilities -->
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6" data-aos="fade-up" data-aos-delay="200">
                    <h2 class="text-xl font-bold text-white mb-6 flex items-center">
                        <i class="fas fa-th-large text-sky-400 mr-3"></i>
                        Fasilitas
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($kos->fasilitas->groupBy('kategori') as $kategori => $fasilitasList)
                        <div>
                            <h3 class="font-semibold text-sky-300 mb-4 capitalize text-lg">
                                {{ str_replace('_', ' ', $kategori) }}
                            </h3>
                            <div class="space-y-3">
                                @foreach($fasilitasList as $fasilitas)
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 rounded-lg bg-sky-500/20 flex items-center justify-center text-sky-400">
                                        @switch($fasilitas->kategori)
                                            @case('umum') <i class="fas fa-wifi"></i> @break
                                            @case('kamar_mandi') <i class="fas fa-shower"></i> @break
                                            @case('dapur') <i class="fas fa-utensils"></i> @break
                                            @case('parkir') <i class="fas fa-parking"></i> @break
                                            @case('keamanan') <i class="fas fa-shield-alt"></i> @break
                                            @default <i class="fas fa-check text-emerald-400"></i>
                                        @endswitch
                                    </div>
                                    <span class="text-slate-300">{{ $fasilitas->nama_fasilitas }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Available Rooms -->
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6" data-aos="fade-up" data-aos-delay="250">
                    <h2 class="text-xl font-bold text-white mb-6 flex items-center">
                        <i class="fas fa-door-open text-sky-400 mr-3"></i>
                        Kamar Tersedia
                    </h2>
                    <div class="space-y-6">
                        @forelse($kos->kamar as $kamar)
                        <div class="bg-white/5 border border-white/10 rounded-xl p-6 hover:border-sky-400/30 transition-all duration-300" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="flex flex-col lg:flex-row gap-6">
                                <div class="flex-1">
                                    <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-4">
                                        <div>
                                            <h3 class="text-xl font-semibold text-white">Kamar {{ $kamar->nomor_kamar }}</h3>
                                            <div class="flex items-center space-x-3 mt-2">
                                                <span class="text-sm text-slate-300 bg-white/10 px-3 py-1 rounded-lg">{{ $kamar->tipe_kamar }}</span>
                                                <span class="text-sm text-slate-300 bg-white/10 px-3 py-1 rounded-lg">{{ $kamar->luas_kamar }}</span>
                                                <span class="text-sm text-slate-300 bg-white/10 px-3 py-1 rounded-lg">Untuk {{ $kamar->kapasitas }} orang</span>
                                            </div>
                                        </div>
                                        <span class="px-3 py-1.5 rounded-full text-sm font-medium bg-emerald-500/20 text-emerald-300 border border-emerald-400/30">
                                            Tersedia
                                        </span>
                                    </div>
                                    
                                    @php
                                        $fasilitasKamar = $kamar->fasilitas_kamar;
                                        $maxAttempts = 3;
                                        $attempts = 0;
                                        while (is_string($fasilitasKamar) && $attempts < $maxAttempts) {
                                            $decoded = json_decode($fasilitasKamar, true);
                                            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                                $fasilitasKamar = $decoded;
                                            } else {
                                                break;
                                            }
                                            $attempts++;
                                        }
                                        if (is_string($fasilitasKamar)) {
                                            $fasilitasKamar = [$fasilitasKamar];
                                        }
                                        $fasilitasKamar = is_array($fasilitasKamar) ? $fasilitasKamar : [];
                                        $fasilitasKamar = array_filter($fasilitasKamar);
                                    @endphp

                                    @if(count($fasilitasKamar) > 0)
                                    <div class="mb-4">
                                        <h4 class="font-medium text-sky-300 mb-3">Fasilitas Kamar:</h4>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($fasilitasKamar as $fasilitas)
                                                @if(is_string($fasilitas))
                                                <span class="px-3 py-1.5 rounded-lg text-sm bg-sky-500/20 text-sky-300 border border-sky-400/30">
                                                    <i class="fas fa-check-circle mr-1"></i>
                                                    {{ $fasilitas }}
                                                </span>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                
                                <div class="lg:text-right lg:border-l lg:border-white/10 lg:pl-6 lg:min-w-48">
                                    <div class="mb-4">
                                        <p class="text-3xl font-bold text-emerald-400 mb-1">
                                            Rp {{ number_format($kamar->harga, 0, ',', '.') }}
                                        </p>
                                        <p class="text-sm text-white">per 
                                            @if($kos->tipe_sewa == 'harian') hari
                                            @elseif($kos->tipe_sewa == 'mingguan') minggu
                                            @elseif($kos->tipe_sewa == 'bulanan') bulan
                                            @elseif($kos->tipe_sewa == 'tahunan') tahun
                                            @else bulan
                                            @endif
                                        </p>
                                    </div>
                                    @auth('penghuni')
                                        @php
                                            $user = Auth::guard('penghuni')->user();
                                            $isAllowed = true;
                                            if ($kos->jenis_kos == 'putra' && $user->penghuni->jenis_kelamin != 'L') $isAllowed = false;
                                            if ($kos->jenis_kos == 'putri' && $user->penghuni->jenis_kelamin != 'P') $isAllowed = false;
                                        @endphp
                                        @if($isAllowed)
                                        <a href="{{ route('penghuni.kontrak.create', $kos->id_kos) }}" 
                                           class="w-full lg:w-auto px-6 py-3 bg-sky-500 text-white rounded-xl hover:bg-sky-600 font-semibold inline-block transition shadow-lg">
                                            <i class="fas fa-check mr-2"></i> Pilih Kamar Ini
                                        </a>
                                        @else
                                        <button disabled 
                                                class="w-full lg:w-auto px-6 py-3 bg-red-500/20 text-red-400 border border-red-400/30 rounded-xl font-semibold inline-block cursor-not-allowed">
                                            <i class="fas fa-ban mr-2"></i> Khusus {{ ucfirst($kos->jenis_kos) }}
                                        </button>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" 
                                           class="w-full lg:w-auto px-6 py-3 bg-sky-500 text-white rounded-xl hover:bg-sky-600 font-semibold inline-block transition shadow-lg">
                                            <i class="fas fa-sign-in-alt mr-2"></i> Login untuk Pesan
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-12" data-aos="fade-up">
                            <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-door-closed text-3xl text-slate-400"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-white mt-4">Tidak Ada Kamar Tersedia</h3>
                            <p class="text-slate-400 mt-2">Semua kamar sudah terisi untuk saat ini.</p>
                            <a href="{{ route('public.kos.index') }}" 
                               class="inline-block mt-6 px-6 py-3 bg-sky-500 text-white rounded-xl hover:bg-sky-600 transition shadow-lg">
                                <i class="fas fa-search mr-2"></i> Cari Kos Lainnya
                            </a>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Rules -->
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6" data-aos="fade-up" data-aos-delay="300">
                    <h2 class="text-xl font-bold text-white mb-6 flex items-center">
                        <i class="fas fa-clipboard-list text-sky-400 mr-3"></i>
                        Peraturan Kos
                    </h2>
                    <div class="bg-white/5 rounded-xl p-5 border border-white/10">
                        <pre class="whitespace-pre-wrap font-sans text-slate-300 text-sm leading-relaxed">{{ $kos->peraturan }}</pre>
                    </div>
                </div>

                <!-- Reviews -->
                @if($kos->reviews->count() > 0)
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6" data-aos="fade-up" data-aos-delay="350">
                    <h2 class="text-xl font-bold text-white mb-6 flex items-center">
                        <i class="fas fa-comments text-sky-500 mr-3"></i>
                        Ulasan Penghuni
                    </h2>
                    
                    <div class="bg-white/5 backdrop-blur-sm rounded-xl p-6 mb-8 border border-white/10">
                        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                            <div class="text-center md:text-left">
                                    <div class="text-5xl font-bold text-white mb-2">{{ number_format($averageRating, 1) }}</div>
                                <div class="flex justify-center md:justify-start text-amber-500 text-xl mb-3">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= floor($averageRating))
                                            <i class="fas fa-star"></i>
                                        @elseif($i - 0.5 <= $averageRating)
                                            <i class="fas fa-star-half-alt"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </div>
                                <div class="text-slate-400">Berdasarkan {{ $totalReviews }} ulasan</div>
                            </div>
                            <div class="w-full md:w-64">
                                @for($rating = 5; $rating >= 1; $rating--)
                                @php
                                    $count = $kos->reviews->where('rating', $rating)->count();
                                    $percentage = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
                                @endphp
                                <div class="flex items-center mb-3">
                                    <span class="text-sm text-slate-400 w-8">{{ $rating }} <i class="fas fa-star text-amber-500"></i></span>
                                    <div class="flex-1 bg-white/10 rounded-full h-2 mx-3">
                                        <div class="bg-amber-500 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <span class="text-sm text-slate-400 w-8 text-right">{{ $count }}</span>
                                </div>
                                @endfor
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        @foreach($kos->reviews as $review)
                        <div class="border-b border-white/20 pb-6 last:border-b-0">
                            <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-4">
                                <div class="flex items-center space-x-4">
                                    @if($review->penghuni->foto_profil)
                                        @php
                                            $filePath = storage_path('app/public/' . $review->penghuni->foto_profil);
                                            $fileExists = file_exists($filePath);
                                        @endphp
                                        @if($fileExists)
                                            <img src="{{ url('storage/' . $review->penghuni->foto_profil) }}" 
                                                 alt="{{ $review->penghuni->nama }}" 
                                                 class="w-12 h-12 rounded-full object-cover border-2 border-sky-400">
                                        @else
                                        <div class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center text-white font-semibold text-lg">
                                                {{ strtoupper(substr($review->penghuni->nama, 0, 1)) }}
                                            </div>
                                        @endif
                                    @else
                                        <div class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center text-white font-semibold text-lg">
                                            {{ strtoupper(substr($review->penghuni->nama, 0, 1)) }}
                                        </div>
                                    @endif
                                    <div>
                                        <h4 class="font-semibold text-white">{{ $review->penghuni->nama }}</h4>
                                        <p class="text-sm text-slate-400">
                                            {{ $review->created_at->format('d M Y') }}
                                            @if($review->updated_at->gt($review->created_at))
                                            <span class="text-xs text-slate-400 ml-1">(diedit)</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="flex text-amber-500">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->rating)
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    
                                    @auth('penghuni')
                                        @php $authPenghuni = Auth::guard('penghuni')->user()->penghuni; @endphp
                                        @if($authPenghuni && $authPenghuni->id_penghuni == $review->id_penghuni)
                                        <div class="relative review-action-btn">
                                            <button type="button" 
                                                    class="text-slate-400 hover:text-white focus:outline-none px-2 py-1 rounded-lg hover:bg-white/10">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="absolute right-0 mt-2 w-40 bg-slate-800 border border-white/20 rounded-xl shadow-lg hidden group-hover:block z-10">
                                                <a href="{{ route('penghuni.reviews.edit', $review->id_review) }}" 
                                                   class="flex items-center px-4 py-3 text-sm text-slate-300 hover:bg-white/10 transition">
                                                    <i class="fas fa-edit mr-3 text-sky-500"></i> Edit
                                                </a>
                                                <form action="{{ route('penghuni.reviews.destroy', $review->id_review) }}" method="POST" onsubmit="return confirmDeleteReview()">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="flex items-center w-full text-left px-4 py-3 text-sm text-red-400 hover:bg-white/10 transition">
                                                        <i class="fas fa-trash mr-3"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                            <p class="text-slate-300 leading-relaxed whitespace-pre-line">{{ $review->komentar }}</p>
                            
                            @if($review->foto_review)
                            <div class="mt-4">
                                <img src="{{ asset('storage/' . $review->foto_review) }}" 
                                     alt="Foto review" 
                                     class="w-40 h-40 object-cover rounded-xl cursor-pointer hover:scale-105 transition-transform duration-300"
                                     onclick="openImageModal('{{ asset('storage/' . $review->foto_review) }}')">
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                @else
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6 text-center shadow-sm" data-aos="fade-up" data-aos-delay="350">
                    <div class="w-20 h-20 bg-amber-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-comment text-3xl text-amber-400"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-white">Belum Ada Ulasan</h3>
                    <p class="text-slate-300 mt-2">Jadilah yang pertama memberikan ulasan untuk kos ini.</p>
                     
                     @auth('penghuni')
                         @php
                             $penghuni = Auth::guard('penghuni')->user()->penghuni;
                             $canReview = false;
                             $hasReviewed = false;
                             if ($penghuni) {
                                 $kontrak = \App\Models\KontrakSewa::where('id_penghuni', $penghuni->id_penghuni)
                                     ->where('id_kos', $kos->id_kos)
                                     ->whereIn('status_kontrak', ['aktif', 'selesai'])
                                     ->first();
                                 if ($kontrak) {
                                     $canReview = true;
                                     $existingReview = \App\Models\Review::where('id_penghuni', $penghuni->id_penghuni)
                                         ->where('id_kos', $kos->id_kos)
                                         ->first();
                                     if ($existingReview) $hasReviewed = true;
                                 }
                             }
                         @endphp
                         
                         @if($canReview && !$hasReviewed)
                         <div class="mt-6">
                             <a href="{{ route('penghuni.reviews.create', $kos->id_kos) }}" 
                                class="inline-flex items-center px-6 py-3 bg-amber-500 text-white rounded-xl hover:bg-amber-600 font-semibold transition shadow-sm">
                                 <i class="fas fa-star mr-2"></i> Beri Review Pertama
                             </a>
                         </div>
                         @elseif($hasReviewed)
                         <p class="text-emerald-500 mt-6">✅ Anda sudah memberikan review untuk kos ini.</p>
                         @endif
                     @endauth
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-6 ">
                <!-- Action Card -->
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6" data-aos="fade-left" data-aos-delay="0">
                    <h2 class="text-xl font-bold text-white mb-6 flex items-center">
                        <i class="fas fa-calendar-check text-sky-500 mr-3"></i>
                        Informasi Booking
                    </h2>
                    
                    @if($kos->kamar->min('harga') > 0)
                        <div class="mb-6">
                            <h3 class="font-semibold text-sky-500 mb-1">Harga Mulai Dari</h3>
                            <p class="text-4xl font-bold text-emerald-400">Rp {{ number_format($kos->kamar->min('harga'), 0, ',', '.') }}</p>
                            <p class="text-sm text-slate-300 mt-1">per {{ $kos->tipe_sewa ?? 'bulan' }}</p>
                        </div>
                    @else
                        <p class="text-lg font-bold text-red-400 bg-red-500/20 rounded-lg px-3 py-2 mb-6">Penuh</p>
                    @endif

                    <div class="space-y-3 mb-6 text-sm">
                        <div class="flex justify-between"><span class="text-white">Jenis Kos:</span><span class="font-medium text-white capitalize">{{ $kos->jenis_kos }}</span></div>
                        <div class="flex justify-between"><span class="text-white">Tipe Sewa:</span><span class="font-medium text-white capitalize">{{ $kos->tipe_sewa }}</span></div>
                        <div class="flex justify-between"><span class="text-white">Kamar Tersedia:</span><span class="font-medium text-white">{{ $kos->kamar->count() }} kamar</span></div>
                        <div class="flex justify-between"><span class="text-white">Lokasi:</span><span class="font-medium text-white text-right">{{ $kos->kota }}, {{ $kos->provinsi }}</span></div>
                    </div>

                    @auth('penghuni')
                        @php
                            $user = Auth::guard('penghuni')->user();
                            $isAllowed = true;
                            if ($kos->jenis_kos == 'putra' && $user->penghuni->jenis_kelamin != 'L') $isAllowed = false;
                            if ($kos->jenis_kos == 'putri' && $user->penghuni->jenis_kelamin != 'P') $isAllowed = false;
                        @endphp
                        @if($kos->kamar->count() > 0)
                            @if($isAllowed)
                            <a href="{{ route('penghuni.kontrak.create', $kos->id_kos) }}" 
                               class="block w-full px-6 py-3 bg-sky-600 text-white text-center rounded-xl hover:bg-sky-700 font-semibold transition shadow-sm">
                                <i class="fas fa-home mr-2"></i> Daftar Sekarang
                            </a>
                            @else
                            <button disabled class="block w-full px-6 py-3 bg-red-500/20 text-red-400 border border-red-500/20 rounded-xl font-semibold cursor-not-allowed">
                                <i class="fas fa-ban mr-2"></i> Khusus {{ ucfirst($kos->jenis_kos) }}
                            </button>
                            @endif
                        @else
                        <button disabled class="block w-full px-6 py-3 bg-white/5 text-slate-400 border border-white/20 rounded-xl font-semibold cursor-not-allowed">
                            <i class="fas fa-times mr-2"></i> Penuh
                        </button>
                        @endif
                    @else
                        <div class="text-center">
                            <p class="text-slate-300 mb-4">Login untuk mendaftar</p>
                            <div class="space-y-3">
                                <a href="{{ route('login') }}" class="block w-full px-6 py-3 bg-sky-600 text-white rounded-xl hover:bg-sky-700 transition">Login</a>
                                <a href="{{ route('register') }}" class="block w-full px-6 py-3 bg-emerald-500 text-white rounded-xl hover:bg-emerald-600 transition">Daftar Akun Baru</a>
                            </div>
                        </div>
                    @endauth

                    <!-- Review Section for Sidebar -->
                    @auth('penghuni')
                        @php
                            $penghuni = Auth::guard('penghuni')->user()->penghuni;
                            $canReview = false;
                            $hasReviewed = false;
                            if ($penghuni) {
                                $kontrak = \App\Models\KontrakSewa::where('id_penghuni', $penghuni->id_penghuni)
                                    ->where('id_kos', $kos->id_kos)
                                    ->whereIn('status_kontrak', ['aktif', 'selesai'])
                                    ->first();
                                if ($kontrak) {
                                    $canReview = true;
                                    $existingReview = \App\Models\Review::where('id_penghuni', $penghuni->id_penghuni)
                                        ->where('id_kos', $kos->id_kos)
                                        ->first();
                                    if ($existingReview) $hasReviewed = true;
                                }
                            }
                        @endphp
                        @if($canReview && !$hasReviewed)
                        <div class="mt-6 pt-6 border-t border-white/20">
                            <a href="{{ route('penghuni.reviews.create', $kos->id_kos) }}" 
                               class="block w-full px-6 py-3 bg-amber-500 text-white text-center rounded-xl hover:bg-amber-600 font-semibold transition">
                                <i class="fas fa-star mr-2"></i> Beri Review
                            </a>
                        </div>
                        @elseif($hasReviewed)
                        <div class="mt-6 pt-6 border-t border-white/20">
                            <p class="text-sm text-slate-400 mb-3">Review Anda:</p>
                            <a href="{{ route('penghuni.reviews.edit', $existingReview->id_review) }}" 
                               class="block w-full px-6 py-3 bg-emerald-500 text-white text-center rounded-xl hover:bg-emerald-600 font-semibold transition">
                                <i class="fas fa-edit mr-2"></i> Edit Review
                            </a>
                        </div>
                        @endif
                    @endauth

                    <!-- Contact -->
                    @if($kos->pemilik)
                    <div class="mt-6 pt-6 border-t border-white/20">
                        <h3 class="font-semibold text-white mb-3 flex items-center"><i class="fas fa-headset text-sky-500 mr-2"></i>Butuh Bantuan?</h3>
                        <div class="space-y-3">
                            @php
                                $waNumber = $kos->pemilik->no_hp;
                                if (str_starts_with($waNumber, '0')) $waNumber = '62' . substr($waNumber, 1);
                                elseif (str_starts_with($waNumber, '+')) $waNumber = substr($waNumber, 1);
                            @endphp
                            <a href="https://wa.me/{{ $waNumber }}?text=Halo%20{{ urlencode($kos->pemilik->nama) }},%20saya%20tertarik%20dengan%20kos%20{{ urlencode($kos->nama_kos) }}" 
                               target="_blank"
                               class="flex items-center justify-center px-4 py-3 bg-emerald-500 text-white rounded-xl hover:bg-emerald-600 transition">
                                <i class="fab fa-whatsapp mr-2"></i> WhatsApp
                            </a>
                            <button onclick="showContactModal()" class="w-full px-4 py-3 bg-white/5 backdrop-blur-sm border border-white/20 text-white rounded-xl hover:bg-white/10 transition">
                                <i class="fas fa-phone mr-2"></i> Telepon
                            </button>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Location Card -->
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6" data-aos="fade-left" data-aos-delay="100">
                    <h2 class="text-xl font-bold text-white mb-4 flex items-center">
                        <i class="fas fa-map-marker-alt text-sky-500 mr-3"></i> Lokasi
                    </h2>
                    <div class="space-y-3 text-sm">
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-location-dot text-sky-500 mt-1"></i>
                            <div>
                                <p class="font-medium text-white">{{ $kos->alamat }}</p>
                                <p class="text-white">{{ $kos->kecamatan }}, {{ $kos->kota }} - {{ $kos->kode_pos }}</p>
                            </div>
                        </div>
                        @if($kos->latitude && $kos->longitude)
                        <div id="map" class="h-64 rounded-xl z-0 mt-4"></div>
                        <div class="flex justify-between mt-3">
                            <button id="locate-btn" class="text-sky-600 hover:text-sky-700 text-sm flex items-center">
                                <i class="fas fa-location-crosshairs mr-1"></i> Lokasi Saya
                            </button>
                            <a href="https://www.google.com/maps/dir/?api=1&destination={{ $kos->latitude }},{{ $kos->longitude }}" target="_blank" class="text-emerald-600 hover:text-emerald-700 text-sm flex items-center">
                                <i class="fas fa-directions mr-1"></i> Petunjuk Arah
                            </a>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Similar Kos -->
                @if($similarKos->count() > 0)
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6" data-aos="fade-left" data-aos-delay="200">
                    <h2 class="text-xl font-bold text-white mb-4 flex items-center">
                        <i class="fas fa-building text-sky-500 mr-3"></i> Kos Serupa
                    </h2>
                    <div class="space-y-4">
                        @foreach($similarKos as $similar)
                        <a href="{{ route('public.kos.show', $similar->id_kos) }}" class="block bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-4 hover:border-sky-300 transition" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                            <div class="flex space-x-4">
                                @if($similar->foto_utama)
                                    <img src="{{ asset('storage/' . $similar->foto_utama) }}" alt="{{ $similar->nama_kos }}" class="w-16 h-16 rounded-lg object-cover flex-shrink-0">
                                @else
                                    <div class="w-16 h-16 bg-slate-200 rounded-lg flex items-center justify-center text-slate-400"><i class="fas fa-home"></i></div>
                                @endif
                                <div class="min-w-0">
                                    <h4 class="font-semibold text-white text-sm truncate">{{ $similar->nama_kos }}</h4>
                                    <p class="text-emerald-600 font-bold text-sm mt-1">
                                        @if($similar->kamar->count() > 0)
                                            Rp {{ number_format($similar->kamar->min('harga'), 0, ',', '.') }}
                                        @else
                                            Penuh
                                        @endif
                                    </p>
                                    <div class="flex items-center mt-1 gap-2 text-xs text-white">
                                        <span class="capitalize">{{ $similar->jenis_kos }}</span>
                                        <span>•</span>
                                        <span>{{ $similar->kota }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div id="image-modal" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
    <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white text-2xl bg-black/40 rounded-full w-10 h-10 flex items-center justify-center hover:bg-black/60 transition">
        <i class="fas fa-times"></i>
    </button>
    <img id="modal-image" class="max-w-full max-h-[90vh] rounded-xl shadow-2xl">
</div>

@if($kos->pemilik)
<!-- Contact Owner Modal -->
<div id="contactModal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4">
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" data-modal-close></div>
    <div class="relative bg-white border border-slate-200 rounded-2xl w-full max-w-sm overflow-hidden shadow-xl">
        <div class="border-b border-slate-200 p-5">
            <h5 class="text-lg font-semibold text-slate-800 flex items-center">
                <i class="fas fa-headset text-sky-500 mr-2"></i> Hubungi Pemilik
            </h5>
        </div>
        <div class="p-6 text-center">
            <div class="mb-4">
                @if($kos->pemilik->foto_profil)
                    <img src="{{ url('storage/' . $kos->pemilik->foto_profil) }}" alt="{{ $kos->pemilik->nama }}" class="w-20 h-20 rounded-full object-cover border-4 border-sky-100 mx-auto">
                @else
                    <div class="w-20 h-20 bg-gradient-to-br from-sky-500 to-indigo-500 rounded-full flex items-center justify-center mx-auto">
                        <i class="fas fa-user-tie text-white text-3xl"></i>
                    </div>
                @endif
            </div>
            <h5 class="text-xl font-bold text-slate-800">{{ $kos->pemilik->nama }}</h5>
            <p class="text-slate-500 text-sm mb-4">Pemilik {{ $kos->nama_kos }}</p>
            <div class="bg-slate-50 rounded-2xl p-4 border border-slate-200 mb-4">
                <p class="text-xs text-slate-500 uppercase font-semibold mb-1">Nomor Telepon</p>
                <p class="text-2xl font-bold text-sky-600">{{ $kos->pemilik->no_hp }}</p>
            </div>
            <div class="grid grid-cols-1 gap-3">
                <a href="tel:{{ $kos->pemilik->no_hp }}" class="flex items-center justify-center px-6 py-3 bg-sky-600 text-white rounded-xl hover:bg-sky-700 transition font-semibold">
                    <i class="fas fa-phone-alt mr-2"></i> Telepon Sekarang
                </a>
                @php
                    $waNumber = $kos->pemilik->no_hp;
                    if (str_starts_with($waNumber, '0')) $waNumber = '62' . substr($waNumber, 1);
                    elseif (str_starts_with($waNumber, '+')) $waNumber = substr($waNumber, 1);
                @endphp
                <a href="https://wa.me/{{ $waNumber }}?text=Halo%20{{ urlencode($kos->pemilik->nama) }},%20saya%20ingin%20bertanya%20tentang%20kos%20{{ urlencode($kos->nama_kos) }}" target="_blank"
                   class="flex items-center justify-center px-6 py-3 bg-emerald-500 text-white rounded-xl hover:bg-emerald-600 transition font-semibold">
                    <i class="fab fa-whatsapp mr-2"></i> WhatsApp
                </a>
            </div>
        </div>
        <div class="p-4 bg-slate-50 text-center border-t border-slate-200">
            <button type="button" class="modal-close-btn text-slate-500 hover:text-slate-700 text-sm font-medium">Kembali</button>
        </div>
    </div>
</div>
@endif
@endsection

@push('scripts')
<script>
    // Image modal
    function openImageModal(src) {
        document.getElementById('modal-image').src = src;
        document.getElementById('image-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeImageModal() {
        document.getElementById('image-modal').classList.add('hidden');
        document.body.style.overflow = '';
    }
    document.getElementById('image-modal').addEventListener('click', function(e) {
        if (e.target.id === 'image-modal') closeImageModal();
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeImageModal();
    });

    function confirmDeleteReview() {
        return confirm('Apakah Anda yakin ingin menghapus review ini? Tindakan ini tidak dapat dibatalkan.');
    }

    // Share functionality
    function shareKos() {
        const url = window.location.href;
        if (navigator.share) {
            navigator.share({
                title: '{{ $kos->nama_kos }}',
                text: 'Lihat kos ini: {{ $kos->nama_kos }} - {{ $kos->alamat }}, {{ $kos->kota }}',
                url: url
            }).catch(() => copyToClipboard(url));
        } else {
            copyToClipboard(url);
        }
    }
    function copyToClipboard(text) {
        const textarea = document.createElement('textarea');
        textarea.value = text;
        document.body.appendChild(textarea);
        textarea.select();
        try {
            document.execCommand('copy');
            alert('Link berhasil disalin!');
        } catch (err) {
            prompt('Salin link ini:', text);
        }
        document.body.removeChild(textarea);
    }

    // Map initialization (if coordinates exist)
    document.addEventListener('DOMContentLoaded', function() {
        @if($kos->latitude && $kos->longitude)
        const map = L.map('map').setView([{{ $kos->latitude }}, {{ $kos->longitude }}], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        const houseIcon = L.divIcon({
            html: `<div class="relative"><div class="absolute -inset-1 bg-sky-400/30 rounded-full animate-ping"></div><div class="relative bg-sky-600 rounded-full w-10 h-10 flex items-center justify-center shadow-lg border-2 border-white"><i class="fas fa-home text-white text-sm"></i></div></div>`,
            iconSize: [40, 40],
            iconAnchor: [20, 40],
            popupAnchor: [0, -40]
        });
        const marker = L.marker([{{ $kos->latitude }}, {{ $kos->longitude }}], { icon: houseIcon }).addTo(map);
        marker.bindPopup(`<b>{{ $kos->nama_kos }}</b><br>{{ $kos->alamat }}`);

        document.getElementById('locate-btn').addEventListener('click', function() {
            if (navigator.geolocation) {
                this.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Mencari...';
                navigator.geolocation.getCurrentPosition(function(position) {
                    const userLat = position.coords.latitude;
                    const userLng = position.coords.longitude;
                    if (window.userMarker) map.removeLayer(window.userMarker);
                    const userIcon = L.divIcon({
                        html: `<div class="relative"><div class="absolute -inset-1 bg-blue-500/30 rounded-full animate-ping"></div><div class="relative bg-blue-600 rounded-full w-8 h-8 flex items-center justify-center shadow-lg border-2 border-white"><i class="fas fa-location-dot text-white text-xs"></i></div></div>`,
                        iconSize: [32, 32],
                        iconAnchor: [16, 32]
                    });
                    window.userMarker = L.marker([userLat, userLng], { icon: userIcon }).addTo(map).bindPopup('Lokasi Anda').openPopup();
                    const bounds = L.latLngBounds([[userLat, userLng], [{{ $kos->latitude }}, {{ $kos->longitude }}]]);
                    map.fitBounds(bounds, { padding: [50, 50] });
                    document.getElementById('locate-btn').innerHTML = '<i class="fas fa-location-crosshairs mr-1"></i> Lokasi Saya';
                }, function() {
                    alert('Tidak dapat mengakses lokasi. Periksa izin.');
                    document.getElementById('locate-btn').innerHTML = '<i class="fas fa-location-crosshairs mr-1"></i> Lokasi Saya';
                });
            } else {
                alert('Geolokasi tidak didukung.');
            }
        });
        @endif

        // Contact modal
        @if($kos->pemilik)
        const contactModal = new Modal('contactModal');
        window.showContactModal = () => contactModal.show();
        @endif

        // Review action hover
        document.querySelectorAll('.review-action-btn').forEach(btn => {
            const button = btn.querySelector('button');
            const menu = btn.querySelector('.absolute');
            if (!button || !menu) return;
            button.addEventListener('mouseenter', () => menu.classList.remove('hidden'));
            btn.addEventListener('mouseleave', () => setTimeout(() => { if (!menu.matches(':hover')) menu.classList.add('hidden'); }, 100));
            menu.addEventListener('mouseenter', () => menu.classList.remove('hidden'));
            menu.addEventListener('mouseleave', () => menu.classList.add('hidden'));
        });
    });
</script>
@endpush