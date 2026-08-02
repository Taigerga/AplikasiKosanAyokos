@extends('layouts.app')

@section('title', $kos->nama_kos . ' - AyoKos')

@section('content')
    <div class="container mx-auto px-4 py-6 md:py-8">
        <div class="max-w-7xl mx-auto">
            <!-- Breadcrumb -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4 mb-6">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('pemilik.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-black transition-colors">
                                <i class="fas fa-home mr-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="inline-flex items-center">
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                                <a href="{{ route('pemilik.kos.show', $kos->id_kos) }}" class="inline-flex items-center text-sm font-medium text-black">
                                    <i class="fas fa-eye mr-2"></i>
                                    Detail Kos
                                </a>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            @if(session('success'))
                <div class="bg-emerald-400 border-4 border-black text-black px-4 py-3 mb-6 font-black shadow-[4px_4px_0px_#000]">
                    <div class="flex items-center"><i class="fas fa-check-circle mr-3"></i>{{ session('success') }}</div>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-rose-400 border-4 border-black text-black px-4 py-3 mb-6 font-black shadow-[4px_4px_0px_#000]">
                    <div class="flex items-center"><i class="fas fa-exclamation-circle mr-3"></i>{{ session('error') }}</div>
                </div>
            @endif

            <!-- Header Card -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 mb-6">
                <div class="flex flex-col md:flex-row md:items-start justify-between">
                    <div class="flex-1">
                        <div class="flex items-center mb-2">
                            <div class="w-12 h-12 bg-gray-100 border-2 border-black flex items-center justify-center mr-4">
                                <i class="fas fa-home text-sky-400 text-lg"></i>
                            </div>
                            <div>
                                <h1 class="text-2xl md:text-3xl font-black text-black mb-1">{{ $kos->nama_kos }}</h1>
                                <div class="flex items-center text-gray-700">
                                    <i class="fas fa-map-marker-alt text-sm mr-2 text-sky-400"></i>
                                    <span>{{ $kos->alamat }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <span class="inline-flex items-center px-3 py-1.5 text-sm font-black border-2 border-black
                            {{ $kos->status_kos == 'aktif' ? 'bg-emerald-400 text-black' : 
                               ($kos->status_kos == 'pending' ? 'bg-yellow-400 text-black' : 
                               'bg-rose-400 text-black') }}">
                            <i class="fas 
                                {{ $kos->status_kos == 'aktif' ? 'fa-check-circle' : 
                                   ($kos->status_kos == 'pending' ? 'fa-clock' : 'fa-times-circle') }} mr-2"></i>
                            {{ ucfirst($kos->status_kos) }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Left Column: Information & Rooms -->
                <div class="space-y-6">
                    <!-- Information Card -->
                    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 bg-gray-100 border-2 border-black flex items-center justify-center mr-3">
                                <i class="fas fa-info-circle text-sky-400 text-lg"></i>
                            </div>
                            <h2 class="text-xl font-black text-black">Informasi Kos</h2>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-3">
                                    <div>
                                        <div class="text-sm text-gray-700 mb-1 flex items-center">
                                            <i class="fas fa-map-pin mr-2 text-sky-400"></i>
                                            Alamat
                                        </div>
                                        <p class="text-black">{{ $kos->alamat }}</p>
                                    </div>
                                    <div>
                                        <div class="text-sm text-gray-700 mb-1 flex items-center">
                                            <i class="fas fa-city mr-2 text-blue-400"></i>
                                            Kota
                                        </div>
                                        <p class="text-black">{{ $kos->kota }}</p>
                                    </div>
                                    <div>
                                        <div class="text-sm text-gray-700 mb-1 flex items-center">
                                            <i class="fas fa-users mr-2 text-emerald-400"></i>
                                            Jenis Kos
                                        </div>
                                        <p class="text-black capitalize">{{ $kos->jenis_kos }}</p>
                                    </div>
                                </div>
                                
                                <div class="space-y-3">
                                    <div>
                                        <div class="text-sm text-gray-700 mb-1 flex items-center">
                                            <i class="fas fa-calendar-alt mr-2 text-purple-400"></i>
                                            Tipe Sewa
                                        </div>
                                        <p class="text-black capitalize">{{ $kos->tipe_sewa }}</p>
                                    </div>
                                    <div>
                                        <div class="text-sm text-gray-700 mb-1 flex items-center">
                                            <i class="fas fa-code-branch mr-2 text-yellow-400"></i>
                                            Kecamatan
                                        </div>
                                        <p class="text-black">{{ $kos->kecamatan }}</p>
                                    </div>
                                    <div>
                                        <div class="text-sm text-gray-700 mb-1 flex items-center">
                                            <i class="fas fa-globe mr-2 text-rose-400"></i>
                                            Provinsi
                                        </div>
                                        <p class="text-black">{{ $kos->provinsi }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Coordinates -->
                            <div class="pt-4 border-t-2 border-gray-200">
                                <div class="text-sm text-gray-700 mb-2 flex items-center">
                                    <i class="fas fa-location-dot mr-2 text-orange-400"></i>
                                    Koordinat
                                </div>
                                <div class="bg-gray-100 border-2 border-black p-3">
                                    <div class="flex items-center justify-between">
                                        <span class="text-black font-mono text-sm">
                                            {{ $kos->latitude }}, {{ $kos->longitude }}
                                        </span>
                                        <button onclick="copyCoordinates()" 
                                                class="text-gray-600 hover:text-black transition">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kamar di Kos Ini -->
                    @if($kos->kamar->count() > 0)
                    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gray-100 border-2 border-black flex items-center justify-center mr-3">
                                    <i class="fas fa-bed text-emerald-400 text-lg"></i>
                                </div>
                                <h2 class="text-xl font-black text-black">Kamar Tersedia</h2>
                            </div>
                            <span class="px-3 py-1 text-sm font-black bg-cyan-400 text-black border-2 border-black">
                                {{ $kos->kamar->count() }} Kamar
                            </span>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($kos->kamar as $kamar)
                            <div class="bg-gray-100 border-2 border-black p-4 hover:border-gray-500 transition-all duration-300">
                                <div class="flex items-start justify-between mb-3">
                                    <div>
                                        <h3 class="font-black text-black mb-1">Kamar {{ $kamar->nomor_kamar }}</h3>
                                        <p class="text-sm text-gray-700">{{ $kamar->tipe_kamar }}</p>
                                    </div>
                                    <span class="px-2 py-1 text-xs font-black border-2 border-black
                                        {{ $kamar->status_kamar == 'tersedia' ? 'bg-emerald-400 text-black' : 
                                           ($kamar->status_kamar == 'terisi' ? 'bg-blue-400 text-black' : 
                                           'bg-yellow-400 text-black') }}">
                                        {{ ucfirst($kamar->status_kamar) }}
                                    </span>
                                </div>
                                
                                <div class="flex items-center justify-between mt-4">
                                    <div class="text-sm text-gray-700">
                                        <i class="fas fa-expand-arrows-alt mr-1"></i>
                                        {{ $kamar->luas_kamar ?? 'N/A' }}
                                    </div>
                                    <div class="text-lg font-bold text-black">
                                        Rp {{ number_format($kamar->harga, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Right Column: Map & Features -->
                <div class="space-y-6">
                    <!-- Lokasi di Peta -->
                    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 bg-gray-100 border-2 border-black flex items-center justify-center mr-3">
                                <i class="fas fa-map-marked-alt text-blue-400 text-lg"></i>
                            </div>
                            <h2 class="text-xl font-black text-black">Lokasi di Peta</h2>
                        </div>
                        
                        <div id="map" class="h-96 w-full border-2 border-black mb-4"></div>
                        
                        <div class="flex items-center justify-between text-sm text-gray-700 bg-gray-100 border-2 border-black p-3">
                            <div class="flex items-center">
                                <i class="fas fa-location-dot mr-2 text-orange-400"></i>
                                <span>Koordinat GPS</span>
                            </div>
                            <span class="font-mono text-black">
                                {{ $kos->latitude }}, {{ $kos->longitude }}
                            </span>
                        </div>
                    </div>

                    <!-- Fasilitas -->
                    @if($kos->fasilitas->count() > 0)
                    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 bg-gray-100 border-2 border-black flex items-center justify-center mr-3">
                                <i class="fas fa-list-check text-purple-400 text-lg"></i>
                            </div>
                            <h2 class="text-xl font-black text-black">Fasilitas Kos</h2>
                        </div>
                        
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                            @foreach($kos->fasilitas as $fasilitas)
                            <div class="flex items-center p-3 bg-gray-100 border-2 border-black hover:border-gray-500 transition">
                                <div class="w-8 h-8 bg-cyan-400 border-2 border-black flex items-center justify-center mr-3">
                                    <i class="fas fa-{{ $fasilitas->icon ?? 'check' }} text-black text-sm"></i>
                                </div>
                                <span class="text-sm text-black">{{ $fasilitas->nama_fasilitas }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h3 class="text-lg font-black text-black mb-4">Kelola Kos</h3>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('pemilik.kos.index') }}" 
                       class="flex items-center px-5 py-3 bg-gray-100 border-2 border-black text-black hover:bg-gray-200 transition font-black shadow-[2px_2px_0px_#000]">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali ke Daftar
                    </a>
                    <a href="{{ route('pemilik.kos.edit', $kos->id_kos) }}" 
                       class="flex items-center px-5 py-3 bg-cyan-400 border-2 border-black hover:bg-cyan-300 text-black transition font-black shadow-[2px_2px_0px_#000]">
                        <i class="fas fa-edit mr-2"></i>
                        Edit Kos
                    </a>
                    <a href="{{ route('pemilik.kamar.create') }}?kos={{ $kos->id_kos }}" 
                       class="flex items-center px-5 py-3 bg-emerald-400 border-2 border-black hover:bg-emerald-300 text-black transition font-black shadow-[2px_2px_0px_#000]">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Kamar
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if($kos->latitude && $kos->longitude)
                const lat = {{ $kos->latitude }};
                const lng = {{ $kos->longitude }};
                
                // Initialize map dengan dark theme
                const map = L.map('map', {
                    zoomControl: true,
                    scrollWheelZoom: true
                }).setView([lat, lng], 15);

                // Add dark tile layer
                L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
                    subdomains: 'abcd',
                    maxZoom: 19
                }).addTo(map);

                // Custom marker icon
                const customIcon = L.divIcon({
                    html: `
                        <div class="relative">
                            <div class="w-10 h-10 bg-cyan-400 border-2 border-black flex items-center justify-center shadow-lg">
                                <i class="fas fa-home text-black text-sm"></i>
                            </div>
                            <div class="absolute -bottom-1 left-1/2 transform -translate-x-1/2 w-4 h-4 bg-cyan-400 rotate-45"></div>
                        </div>
                    `,
                    className: 'custom-marker',
                    iconSize: [40, 40],
                    iconAnchor: [20, 40],
                    popupAnchor: [0, -35]
                });

                // Add marker
                const marker = L.marker([lat, lng], { 
                    icon: customIcon,
                    riseOnHover: true
                }).addTo(map);

                // Custom popup content
                const popupContent = `
                    <div class="p-4 max-w-xs">
                        <div class="flex items-start mb-3">
                            <div class="w-10 h-10 bg-cyan-400 border-2 border-black flex items-center justify-center mr-3">
                                <i class="fas fa-home text-black"></i>
                            </div>
                            <div>
                                <h3 class="font-black text-black text-lg mb-1">{{ $kos->nama_kos }}</h3>
                                <p class="text-sm text-gray-700">{{ Str::limit($kos->alamat, 60) }}</p>
                            </div>
                        </div>
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center text-gray-700">
                                <i class="fas fa-users w-4 mr-2 text-sky-400"></i>
                                <span>{{ ucfirst($kos->jenis_kos) }}</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <i class="fas fa-tag w-4 mr-2 text-emerald-400"></i>
                                <span>{{ ucfirst($kos->tipe_sewa) }}</span>
                            </div>
                        </div>
                        <div class="mt-3 pt-3 border-t-2 border-gray-200">
                            <span class="inline-flex items-center px-2 py-1 text-xs font-black border-2 border-black
                                {{ $kos->status_kos == 'aktif' ? 'bg-emerald-400 text-black' : 
                                   ($kos->status_kos == 'pending' ? 'bg-yellow-400 text-black' : 
                                   'bg-rose-400 text-black') }}">
                                <i class="fas 
                                    {{ $kos->status_kos == 'aktif' ? 'fa-check-circle' : 
                                       ($kos->status_kos == 'pending' ? 'fa-clock' : 'fa-times-circle') }} mr-1"></i>
                                {{ ucfirst($kos->status_kos) }}
                            </span>
                        </div>
                    </div>
                `;

                marker.bindPopup(popupContent, {
                    className: 'custom-popup',
                    maxWidth: 350,
                    closeButton: true
                }).openPopup();

                // Add zoom control dengan style custom
                L.control.zoom({
                    position: 'topright'
                }).addTo(map);

            @else
                // Jika koordinat tidak ada
                document.getElementById('map').innerHTML = `
                    <div class="h-full flex items-center justify-center">
                        <div class="text-center p-8">
                            <div class="w-20 h-20 bg-cyan-400 border-4 border-black flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-map text-3xl text-black"></i>
                            </div>
                            <h3 class="text-black font-bold mb-2">Lokasi Belum Ditentukan</h3>
                            <p class="text-gray-700 text-sm mb-4">Edit kos untuk menambahkan koordinat lokasi</p>
                            <a href="{{ route('pemilik.kos.edit', $kos->id_kos) }}" 
                               class="inline-flex items-center px-4 py-2 bg-cyan-400 border-2 border-black hover:bg-cyan-300 text-black transition text-sm font-black shadow-[2px_2px_0px_#000]">
                                <i class="fas fa-edit mr-2"></i>
                                Tambah Lokasi
                            </a>
                        </div>
                    </div>
                `;
            @endif
        });

        function copyCoordinates() {
            const coords = "{{ $kos->latitude }}, {{ $kos->longitude }}";
            navigator.clipboard.writeText(coords).then(() => {
                if (window.showSuccess) window.showSuccess('Koordinat disalin!');
            }).catch(() => {
                if (window.showError) window.showError('Gagal menyalin koordinat');
            });
        }
    </script>
@endsection
