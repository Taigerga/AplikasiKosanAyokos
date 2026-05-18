@extends('layouts.app')

@section('title', 'Detail Kontrak - AyoKos')

@section('content')
<div class="p-4 md:p-6 lg:p-8 space-y-6 max-w-7xl mx-auto">
    <!-- Breadcrumb -->
    <nav class="bg-white border-2 border-black shadow-[2px_2px_0px_#000] p-4">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('penghuni.dashboard') }}" class="inline-flex items-center text-sm font-black text-gray-600 hover:text-gray-700 font-black transition-colors">
                    <i class="fas fa-gauge mr-2"></i>
                    Dashboard
                </a>
            </li>
            <li class="inline-flex items-center">
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-600 text-xs mx-2"></i>
                    <a href="{{ route('penghuni.kontrak.index') }}" class="inline-flex items-center text-sm font-black text-gray-600 hover:text-gray-700 font-black transition-colors">
                        <i class="fas fa-file-contract mr-2"></i>
                        Riwayat Kontrak
                    </a>
                </div>
            </li>
            <li class="inline-flex items-center">
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-600 text-xs mx-2"></i>
                    <span class="inline-flex items-center text-sm font-black text-black">
                        <i class="fas fa-pencil mr-2"></i>
                        Detail Kontrak
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Notifications -->
    @if(session('success'))
    <div class="bg-emerald-400 border-2 border-black shadow-[3px_3px_0px_#000] text-black px-4 py-3  mb-6">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-3"></i>
            <span>{{ session('success') }}</span>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-400 border-2 border-black shadow-[3px_3px_0px_#000] text-black px-4 py-3  mb-6">
        <div class="flex items-center">
            <i class="fas fa-exclamation-circle mr-3"></i>
            <span>{{ session('error') }}</span>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Status Badge -->
            <div class="flex items-center justify-between">
                <div>
                    @if($kontrak->status_kontrak === 'pending')
                    <span class="inline-flex items-center px-4 py-2 font-black bg-yellow-400 text-black border-2 border-black">
                        <i class="fas fa-clock mr-2"></i>
                        Menunggu Persetujuan
                    </span>
                    @elseif($kontrak->status_kontrak === 'aktif')
                    <span class="inline-flex items-center px-4 py-2 font-black bg-emerald-400 text-black border-2 border-black">
                        <i class="fas fa-check-circle mr-2"></i>
                        Kontrak Aktif
                    </span>
                    @elseif($kontrak->status_kontrak === 'selesai')
                    <span class="inline-flex items-center px-4 py-2 font-black bg-sky-400 text-black border-2 border-black">
                        <i class="fas fa-check-double mr-2"></i>
                        Kontrak Selesai
                    </span>
                    @else
                    <span class="inline-flex items-center px-4 py-2 font-black bg-red-400 text-black border-2 border-black">
                        <i class="fas fa-times-circle mr-2"></i>
                        Ditolak
                    </span>
                    @endif
                </div>
                
                <!-- ID Kontrak -->
                <div class="text-sm text-gray-600">
                    ID: <span class="font-mono text-black">{{ $kontrak->id_kontrak }}</span>
                </div>
            </div>

            <!-- Informasi Kos -->
            <div class="card-hover bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h2 class="text-2xl font-black text-black mb-4 flex items-center">
                    <i class="fas fa-home text-primary-400 mr-3"></i>
                    {{ $kontrak->kos->nama_kos }}
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <div class="flex items-start space-x-3">
                            <div class="p-2 bg-gray-100 border-2 border-black ">
                                <i class="fas fa-map-marker-alt text-primary-400"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Alamat</p>
                                <p class="font-black text-black">{{ $kontrak->kos->alamat }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex items-start space-x-3">
                            <div class="p-2 bg-gray-100 border-2 border-black ">
                                <i class="fas fa-door-closed text-green-400"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Kamar</p>
                                <div class="flex items-center space-x-2">
                                    <span class="font-black text-black">Kamar {{ $kontrak->kamar->nomor_kamar }}</span>
                                    <span class="text-xs px-2 py-1 bg-gray-200 border-2 border-black text-black font-black">
                                        {{ $kontrak->kamar->tipe_kamar }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Kontrak -->
            <div class="card-hover bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h3 class="text-xl font-black text-black mb-6 flex items-center">
                    <i class="fas fa-file-contract text-blue-400 mr-3"></i>
                    Detail Kontrak
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <div class="flex items-start space-x-3 mb-6">
                            <div class="p-2 bg-gray-100 border-2 border-black ">
                                <i class="fas fa-calendar-plus text-primary-400"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Tanggal Pendaftaran</p>
                                <p class="font-black text-black">{{ $kontrak->tanggal_daftar->format('d M Y') }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <div class="p-2 bg-gray-100 border-2 border-black ">
                                <i class="fas fa-calendar-alt text-green-400"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Durasi Sewa</p>
                                <p class="font-black text-black">{{ $kontrak->durasi_sewa }} {{ $kontrak->unit_label_lower }}</p>
                            </div>
                        </div>
                    </div>
                    
                    @if($kontrak->tanggal_mulai)
                    <div>
                        <div class="flex items-start space-x-3 mb-6">
                            <div class="p-2 bg-gray-100 border-2 border-black ">
                                <i class="fas fa-calendar-day text-yellow-400"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Tanggal Mulai</p>
                                <p class="font-black text-black">{{ $kontrak->tanggal_mulai ? $kontrak->tanggal_mulai->format('d M Y') : 'Menunggu pembayaran pertama' }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <div class="p-2 bg-gray-100 border-2 border-black ">
                                <i class="fas fa-calendar-check text-rose-400"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Tanggal Selesai</p>
                                <p class="font-black text-black">{{ $kontrak->tanggal_selesai ? $kontrak->tanggal_selesai->format('d M Y') : 'Menunggu pembayaran pertama' }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Harga Sewa -->
            <div class="card-hover bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h3 class="text-xl font-black text-black mb-4 flex items-center">
                    <i class="fas fa-wallet text-yellow-400 mr-3"></i>
                    Harga Sewa
                </h3>
                <div class="text-4xl font-black text-black mb-2">
                    Rp {{ number_format($kontrak->harga_sewa, 0, ',', '.') }}
                </div>
                <div class="flex items-center justify-between">
                    <p class="text-gray-700 text-sm">
                        Per {{ $kontrak->durasi_sewa }} {{ $kontrak->unit_label_lower }}
                    </p>
                    @if($kontrak->status_kontrak === 'aktif' && !$kontrak->sudahBerakhir)
                    <div class="text-sm text-gray-600">
                        <i class="fas fa-clock mr-1"></i>
                        Berakhir dalam {{ $kontrak->sisaHari ?? '?' }} hari
                    </div>
                    @endif
                </div>
            </div>

            <!-- Dokumen -->
            <div class="card-hover bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h3 class="text-xl font-black text-black mb-6 flex items-center">
                    <i class="fas fa-file-alt text-purple-400 mr-3"></i>
                    Dokumen
                </h3>
                
                <div class="space-y-6">
                    <div>
                        <p class="text-sm text-gray-600 mb-3">Foto KTP</p>
                        @if($kontrak->foto_ktp)
                        <div class="relative">
                            <div class="border-2 border-black  overflow-hidden max-w-sm">
                                <img src="{{ asset('storage/' . $kontrak->foto_ktp) }}" 
                                     alt="Foto KTP" 
                                     class="w-full h-auto object-cover">
                            </div>
                            <a href="{{ asset('storage/' . $kontrak->foto_ktp) }}" 
                               target="_blank"
                               class="inline-flex items-center mt-3 text-primary-400 hover:text-primary-300 transition">
                                <i class="fas fa-external-link-alt mr-2"></i>
                                Lihat Fullsize
                            </a>
                        </div>
                        @else
                        <div class="text-center py-4 border-2 border-dashed border-black ">
                            <i class="fas fa-file-image text-3xl text-gray-600 mb-2"></i>
                            <p class="text-gray-600">Tidak ada dokumen</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Alasan Ditolak -->
            @if($kontrak->status_kontrak === 'ditolak' && $kontrak->alasan_ditolak)
            <div class="bg-red-100 border-2 border-black  p-6">
                <div class="flex items-start">
                    <div class="p-3 bg-red-400   mr-4">
                        <i class="fas fa-times-circle text-rose-400 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-black text-black mb-2">Alasan Penolakan</h3>
                        <p class="text-black">{{ $kontrak->alasan_ditolak }}</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Action Buttons -->
            @if($kontrak->status_kontrak === 'aktif' && !$kontrak->sudahBerakhir)
            <div class="card-hover bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h3 class="text-lg font-black text-black mb-4 flex items-center">
                    <i class="fas fa-cogs text-yellow-400 mr-3"></i>
                    Aksi Kontrak
                </h3>
                <div class="flex flex-wrap gap-4">
 
                    
                    <a href="{{ route('penghuni.pembayaran.create', ['kontrak_id' => $kontrak->id_kontrak]) }}" 
                       class="px-6 py-3 bg-lime-400 border-2 border-black shadow-[2px_2px_0px_#000] text-black  hover:bg-yellow-500  transition-all duration-300 hover:shadow-[2px_2px_0px_#000]">
                        <i class="fas fa-credit-card mr-2"></i>
                        Bayar Sewa
                    </a>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Informasi Penghuni -->
            <div class="card-hover bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h3 class="text-lg font-black text-black mb-6 flex items-center">
                    <i class="fas fa-user-circle text-blue-400 mr-3"></i>
                    Informasi Penghuni
                </h3>
                
                <div class="space-y-5">
                    <div>
                        <div class="flex items-center space-x-2 mb-1">
                            <i class="fas fa-user text-primary-400 w-4"></i>
                            <p class="text-sm text-gray-600">Nama</p>
                        </div>
                        <p class="font-black text-black">{{ $kontrak->penghuni->nama ?? 'N/A' }}</p>
                    </div>
                    
                    <div>
                        <div class="flex items-center space-x-2 mb-1">
                            <i class="fas fa-id-card text-green-400 w-4"></i>
                            <p class="text-sm text-gray-600">NIK</p>
                        </div>
                        <p class="font-black text-black">{{ $kontrak->penghuni->nik ?? 'N/A' }}</p>
                    </div>
                    
                    <div>
                        <div class="flex items-center space-x-2 mb-1">
                            <i class="fas fa-phone text-yellow-400 w-4"></i>
                            <p class="text-sm text-gray-600">No. Telepon</p>
                        </div>
                        <p class="font-black text-black">{{ $kontrak->penghuni->no_hp ?? 'N/A' }}</p>
                    </div>
                    
                    <div>
                        <div class="flex items-center space-x-2 mb-1">
                            <i class="fas fa-envelope text-purple-400 w-4"></i>
                            <p class="text-sm text-gray-600">Email</p>
                        </div>
                        <p class="font-black text-black break-words">{{ $kontrak->penghuni->email ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <!-- Status Kontrak Timeline -->
            <div class="card-hover bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h3 class="text-lg font-black text-black mb-6 flex items-center">
                    <i class="fas fa-history text-indigo-400 mr-3"></i>
                    Timeline Kontrak
                </h3>
                
                <div class="space-y-4">
                    <div class="flex items-center">
                        <div class="w-3 h-3  bg-green-500 mr-3"></div>
                        <div>
                            <p class="text-sm font-black text-black">Pendaftaran</p>
                            <p class="text-xs text-gray-600">{{ $kontrak->tanggal_daftar->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                    
                    @if($kontrak->tanggal_mulai)
                    <div class="flex items-center">
                        <div class="w-3 h-3  bg-blue-500 mr-3"></div>
                        <div>
                            <p class="text-sm font-black text-black">Mulai Kontrak</p>
                            <p class="text-xs text-gray-600">{{ $kontrak->tanggal_mulai->format('d M Y') }}</p>
                        </div>
                    </div>
                    
                     @if($kontrak->tanggal_selesai)
                     <div class="flex items-center">
                         <div class="w-3 h-3  bg-yellow-500 mr-3"></div>
                         <div>
                             <p class="text-sm font-black text-black">Berakhir Kontrak</p>
                             <p class="text-xs text-gray-600">{{ $kontrak->tanggal_selesai->format('d M Y') }}</p>
                         </div>
                     </div>
                     @endif
                    @endif
                </div>
            </div>

            <!-- Quick Links -->
            <div class="card-hover bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h3 class="text-lg font-black text-black mb-6 flex items-center">
                    <i class="fas fa-link text-primary-400 mr-3"></i>
                    Tautan Cepat
                </h3>
                
                <div class="space-y-3">
                    <a href="{{ route('penghuni.pembayaran.index') }}" 
                       class="flex items-center justify-between p-3  bg-gray-100 border-2 border-black hover:bg-gray-100 transition">
                        <div class="flex items-center">
                            <i class="fas fa-credit-card text-green-400 mr-3"></i>
                            <span class="text-black">Lihat Pembayaran</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-600"></i>
                    </a>
                    
                    <a href="{{ route('penghuni.kontrak.index') }}" 
                       class="flex items-center justify-between p-3  bg-gray-100 border-2 border-black hover:bg-gray-100 transition">
                        <div class="flex items-center">
                            <i class="fas fa-file-contract text-blue-400 mr-3"></i>
                            <span class="text-black">Semua Kontrak</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-600"></i>
                    </a>
                    
                    <a href="{{ route('public.kos.show', $kontrak->kos->id_kos) }}" 
                       class="flex items-center justify-between p-3  bg-gray-100 border-2 border-black hover:bg-gray-100 transition">
                        <div class="flex items-center">
                            <i class="fas fa-home text-yellow-400 mr-3"></i>
                            <span class="text-black">Detail Kos</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-600"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Extend Modal -->
<div id="extendModal" class="hidden fixed inset-0 bg-black/70  flex items-center justify-center z-50 p-4">
    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-8 max-w-md w-full shadow-[4px_4px_0px_#000]">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-black text-black flex items-center">
                <i class="fas fa-calendar-plus text-primary-400 mr-3"></i>
                Perpanjang Kontrak
            </h2>
            <button onclick="closeExtendModal()" class="text-gray-600 hover:text-black transition">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <form action="{{ route('penghuni.kontrak.extend', $kontrak->id_kontrak) }}" method="POST" data-ajax="true" data-ajax-action="/api/penghuni/kontrak/{{ $kontrak->id_kontrak }}/extend" data-success-msg="Kontrak berhasil diperpanjang" data-redirect="{{ route('penghuni.kontrak.show', $kontrak->id_kontrak) }}" data-confirm="Apakah Anda yakin ingin memperpanjang kontrak?">
            @csrf
            
            <div class="mb-6">
                <label class="block text-black font-black mb-3">
                    Durasi Perpanjangan <span class="text-rose-400">*</span>
                </label>
                
                <div class="relative">
                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-600">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <input type="number" 
                           name="durasi_perpanjangan" 
                           min="1" 
                           max="24"
                           required 
                           class="w-full pl-12 pr-4 py-3 bg-gray-100 border-2 border-black text-black  focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/30 transition"
                           placeholder="Masukkan jumlah bulan">
                </div>
                
                @error('durasi_perpanjangan')
                <p class="text-rose-400 text-sm mt-2">
                    <i class="fas fa-exclamation-circle mr-1"></i>
                    {{ $message }}
                </p>
                @enderror
                
                <div class="mt-3 text-sm text-gray-600">
                    <i class="fas fa-info-circle mr-1"></i>
                    Maksimal 24 bulan per perpanjangan
                </div>
            </div>
            
            <div class="flex gap-3">
                <button type="submit" 
                        class="flex-1 bg-sky-400 hover:bg-sky-500 text-black font-black px-6 py-3 border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all duration-300">
                    <i class="fas fa-check mr-2"></i>
                    Perpanjang
                </button>
                <button type="button" 
                        onclick="closeExtendModal()" 
                        class="flex-1 bg-gray-100 border-2 border-black text-black px-6 py-3  hover:bg-gray-100 transition">
                    <i class="fas fa-times mr-2"></i>
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openExtendModal() {
        document.getElementById('extendModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeExtendModal() {
        document.getElementById('extendModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Close modal when clicking outside
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('extendModal');
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeExtendModal();
            }
        });

        // Escape key to close modal
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeExtendModal();
            }
        });
    });
</script>
@endsection