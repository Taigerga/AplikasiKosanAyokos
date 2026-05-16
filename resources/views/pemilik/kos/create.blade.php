@extends('layouts.app')

@section('title', 'Tambah Kos - AyoKos')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-4xl mx-auto">
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
                                <a href="{{ route('pemilik.kos.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-black transition-colors">
                                    <i class="fas fa-file-contract mr-2"></i>
                                    Kelola Kos
                                </a>
                            </div>
                        </li>
                        <li class="inline-flex items-center">
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                                <a href="{{ route('pemilik.kos.create') }}" class="inline-flex items-center text-sm font-medium text-black">
                                    <i class="fas fa-plus mr-2"></i>
                                    Tambah Kos
                                </a>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
            
            <!-- Header -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6 mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-black mb-2">Tambah Kos Baru</h1>
                        <p class="text-gray-700">Lengkapi formulir untuk menambahkan properti kos baru ke sistem</p>
                    </div>
                    <div class="w-12 h-12 bg-white border-2 border-black shadow-[2px_2px_0px_#000] flex items-center justify-center">
                        <i class="fas fa-plus text-black text-xl"></i>
                    </div>
                </div>
            </div>

            @if($errors->any())
                <div class="bg-white border-4 border-rose-500 text-rose-500 font-bold shadow-[4px_4px_0px_#000] p-4 mb-6">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <strong class="font-semibold">Terjadi kesalahan:</strong>
                    </div>
                    <ul class="text-sm list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="bg-white border-4 border-emerald-500 text-emerald-500 font-bold shadow-[4px_4px_0px_#000] px-4 py-3 mb-6">
                    <div class="flex items-center"><i class="fas fa-check-circle mr-3"></i>{{ session('success') }}</div>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-white border-4 border-rose-500 text-rose-500 font-bold shadow-[4px_4px_0px_#000] px-4 py-3 mb-6">
                    <div class="flex items-center"><i class="fas fa-exclamation-circle mr-3"></i>{{ session('error') }}</div>
                </div>
            @endif

            <!-- Form -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <form method="POST" action="{{ route('pemilik.kos.store') }}" enctype="multipart/form-data" data-ajax="true" data-ajax-action="/api/pemilik/kos" data-redirect="{{ route('pemilik.kos.index') }}" data-success-msg="Kos berhasil ditambahkan!" data-confirm="Apakah Anda yakin data kos yang dimasukkan sudah benar?">
                    @csrf

                    <div class="space-y-8">
                        <!-- Informasi Dasar -->
                        <div class="border-b-2 border-black pb-8">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 bg-white border-2 border-black shadow-[2px_2px_0px_#000] flex items-center justify-center mr-3">
                                    <i class="fas fa-info-circle text-black"></i>
                                </div>
                                <h2 class="text-xl font-semibold text-black">🏠 Informasi Dasar</h2>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Nama Kos -->
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-black text-black mb-2">
                                        Nama Kos <span class="text-rose-400">*</span>
                                    </label>
                                    <div class="relative">
                                        <i class="fas fa-home absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                        <input type="text" name="nama_kos" value="{{ old('nama_kos') }}"
                                            class="w-full pl-10 pr-3 py-3 border-2 border-black text-black font-bold placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white"
                                            placeholder="Contoh: Kos Bahagia Sentosa" required maxlength="255">
                                    </div>
                                </div>

                                <!-- Alamat -->
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-black text-black mb-2">
                                        Alamat Lengkap <span class="text-rose-400">*</span>
                                    </label>
                                    <div class="relative">
                                        <i class="fas fa-map-marker-alt absolute left-3 top-3 text-gray-400"></i>
                                        <textarea name="alamat" rows="3"
                                            class="w-full pl-10 pr-3 py-3 border-2 border-black text-black font-bold placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white resize-none"
                                            placeholder="Jl. Merdeka No. 123, Kelurahan..."
                                            required>{{ old('alamat') }}</textarea>
                                    </div>
                                </div>

                                <!-- Kecamatan -->
                                <div>
                                    <label class="block text-sm font-black text-black mb-2">
                                        Kecamatan <span class="text-rose-400">*</span>
                                    </label>
                                    <div class="relative">
                                        <i class="fas fa-map-pin absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                        <input type="text" name="kecamatan" value="{{ old('kecamatan') }}"
                                            class="w-full pl-10 pr-3 py-3 border-2 border-black text-black font-bold placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white"
                                            required maxlength="100">
                                    </div>
                                </div>

                                <!-- Kota -->
                                <div>
                                    <label class="block text-sm font-black text-black mb-2">
                                        Kota <span class="text-rose-400">*</span>
                                    </label>
                                    <div class="relative">
                                        <i class="fas fa-city absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                        <input type="text" name="kota" value="{{ old('kota') }}"
                                            class="w-full pl-10 pr-3 py-3 border-2 border-black text-black font-bold placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white"
                                            required maxlength="100">
                                    </div>
                                </div>

                                <!-- Provinsi -->
                                <div>
                                    <label class="block text-sm font-black text-black mb-2">
                                        Provinsi <span class="text-rose-400">*</span>
                                    </label>
                                    <div class="relative">
                                        <i class="fas fa-globe-asia absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                        <input type="text" name="provinsi" value="{{ old('provinsi') }}"
                                            class="w-full pl-10 pr-3 py-3 border-2 border-black text-black font-bold placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white"
                                            required maxlength="100">
                                    </div>
                                </div>

                                <!-- Kode Pos -->
                                <div>
                                    <label class="block text-sm font-black text-black mb-2">
                                        Kode Pos
                                    </label>
                                    <div class="relative">
                                        <i class="fas fa-mail-bulk absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                        <input type="text" name="kode_pos" value="{{ old('kode_pos') }}"
                                            class="w-full pl-10 pr-3 py-3 border-2 border-black text-black font-bold placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white"
                                            maxlength="10">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Tambahan -->
                        <div class="border-b-2 border-black pb-8">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 bg-white border-2 border-black shadow-[2px_2px_0px_#000] flex items-center justify-center mr-3">
                                    <i class="fas fa-file-alt text-black"></i>
                                </div>
                                <h2 class="text-xl font-semibold text-black">📋 Informasi Tambahan</h2>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Jenis Kos -->
                                <div>
                                    <label class="block text-sm font-black text-black mb-2">
                                        Jenis Kos <span class="text-rose-400">*</span>
                                    </label>
                                    <div class="relative">
                                        <i class="fas fa-users absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                        <select name="jenis_kos"
                                            class="w-full pl-10 pr-10 py-3 border-2 border-black text-black font-bold focus:shadow-[3px_3px_0px_#000] outline-none bg-white appearance-none"
                                            required>
                                            <option value="">Pilih Jenis Kos</option>
                                            <option value="putra" {{ old('jenis_kos') == 'putra' ? 'selected' : '' }}>Putra</option>
                                            <option value="putri" {{ old('jenis_kos') == 'putri' ? 'selected' : '' }}>Putri</option>
                                            <option value="campuran" {{ old('jenis_kos') == 'campuran' ? 'selected' : '' }}>Campuran</option>
                                        </select>
                                        <i class="fas fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                                    </div>
                                </div>

                                <!-- Tipe Sewa -->
                                <div>
                                    <label class="block text-sm font-black text-black mb-2">
                                        Tipe Sewa <span class="text-rose-400">*</span>
                                    </label>
                                    <div class="relative">
                                        <i class="fas fa-calendar-alt absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                        <select name="tipe_sewa"
                                            class="w-full pl-10 pr-10 py-3 border-2 border-black text-black font-bold focus:shadow-[3px_3px_0px_#000] outline-none bg-white appearance-none"
                                            required>
                                            <option value="">Pilih Tipe Sewa</option>
                                            <option value="harian" {{ old('tipe_sewa') == 'harian' ? 'selected' : '' }}>Harian</option>
                                            <option value="mingguan" {{ old('tipe_sewa') == 'mingguan' ? 'selected' : '' }}>Mingguan</option>
                                            <option value="bulanan" {{ old('tipe_sewa') == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                                            <option value="tahunan" {{ old('tipe_sewa') == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                                        </select>
                                        <i class="fas fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Deskripsi -->
                            <div class="mt-6">
                                <label class="block text-sm font-black text-black mb-2">
                                    Deskripsi Kos
                                </label>
                                <div class="relative">
                                    <i class="fas fa-align-left absolute left-3 top-3 text-gray-400"></i>
                                    <textarea name="deskripsi" rows="4"
                                        class="w-full pl-10 pr-3 py-3 border-2 border-black text-black font-bold placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white resize-none"
                                        placeholder="Deskripsikan keunggulan dan fasilitas kos...">{{ old('deskripsi') }}</textarea>
                                </div>
                            </div>

                            <!-- Peraturan -->
                            <div class="mt-6">
                                <label class="block text-sm font-black text-black mb-2">
                                    Peraturan Kos
                                </label>
                                <div class="relative">
                                    <i class="fas fa-clipboard-list absolute left-3 top-3 text-gray-400"></i>
                                    <textarea name="peraturan" rows="4"
                                        class="w-full pl-10 pr-3 py-3 border-2 border-black text-black font-bold placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white resize-none"
                                        placeholder="Tuliskan peraturan yang berlaku di kos...">{{ old('peraturan') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Map Section -->
                        <div class="border-b-2 border-black pb-8">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 bg-white border-2 border-black shadow-[2px_2px_0px_#000] flex items-center justify-center mr-3">
                                    <i class="fas fa-map-marked-alt text-black"></i>
                                </div>
                                <h2 class="text-xl font-semibold text-black">🗺️ Pilih Lokasi di Peta</h2>
                            </div>

                            <!-- Koordinat Input -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <div>
                                    <label class="block text-sm font-black text-black mb-2">Latitude</label>
                                    <div class="relative">
                                        <i class="fas fa-location-arrow absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                        <input type="text" name="latitude" id="latitude"
                                            value="{{ old('latitude') }}"
                                            class="w-full pl-10 pr-3 py-3 border-2 border-black text-black font-bold placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white"
                                            placeholder="-6.208763" required>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-black text-black mb-2">Longitude</label>
                                    <div class="relative">
                                        <i class="fas fa-location-arrow absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                        <input type="text" name="longitude" id="longitude"
                                            value="{{ old('longitude') }}"
                                            class="w-full pl-10 pr-3 py-3 border-2 border-black text-black font-bold placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white"
                                            placeholder="106.845599" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Pencarian Alamat -->
                            <div class="mb-6">
                                <label class="block text-sm font-black text-black mb-2">Cari Alamat</label>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="md:col-span-2">
                                        <div class="relative">
                                            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                            <input type="text" id="address-search" 
                                                class="w-full pl-10 pr-3 py-3 border-2 border-black text-black font-bold placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none bg-white"
                                                placeholder="Masukkan alamat lengkap (contoh: Jl. Sudirman No. 123, Jakarta)">
                                        </div>
                                    </div>
                                    <div class="flex items-end">
                                        <button type="button" id="search-btn" 
                                            class="w-full px-4 py-3 bg-white text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all flex items-center justify-center">
                                            <i class="fas fa-search mr-2"></i>
                                            Cari Alamat
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol Lokasi -->
                            <div class="mb-6">
                                <div class="flex flex-col sm:flex-row gap-4">
                                    <button type="button" id="current-location-btn" 
                                        class="flex-1 px-6 py-3 bg-white text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all flex items-center justify-center">
                                        <i class="fas fa-location-arrow mr-2"></i>
                                        Gunakan Lokasi Saat Ini
                                    </button>
                                    <button type="button" id="detect-nearby-btn" 
                                        class="flex-1 px-6 py-3 bg-white text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all flex items-center justify-center">
                                        <i class="fas fa-map-marker-alt mr-2"></i>
                                        Cari Tempat Terdekat
                                    </button>
                                </div>
                                <p class="text-sm text-gray-700 mt-2 flex items-center">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    Izinkan akses lokasi di browser untuk fitur "Sekitar Saya"
                                </p>
                            </div>

                            <!-- Map Container -->
                            <div id="map" class="h-96 w-full border-2 border-black mb-6 bg-white"></div>

                            <!-- Instructions -->
                            <div class="bg-white border-2 border-black p-4">
                                <div class="flex items-start">
                                    <i class="fas fa-info-circle text-emerald-600 mt-1 mr-3"></i>
                                    <div>
                                        <p class="text-sm text-emerald-700 font-black mb-1">Petunjuk Penggunaan:</p>
                                        <ol class="text-sm text-emerald-700 list-decimal list-inside space-y-1">
                                            <li><strong>Cari alamat</strong> atau <strong>klik tombol lokasi</strong> untuk mendapatkan posisi</li>
                                            <li><strong>Klik pada peta</strong> untuk menandai lokasi kos secara manual</li>
                                            <li><strong>Koordinat dan alamat</strong> akan otomatis terisi</li>
                                            <li><strong>Geser marker</strong> untuk menyesuaikan posisi yang lebih akurat</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Fasilitas Umum -->
                        <div class="border-b-2 border-black pb-8">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 bg-white border-2 border-black shadow-[2px_2px_0px_#000] flex items-center justify-center mr-3">
                                    <i class="fas fa-concierge-bell text-black"></i>
                                </div>
                                <h2 class="text-xl font-semibold text-black">🏗️ Fasilitas Umum</h2>
                            </div>

                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                @foreach($fasilitas as $fasilitasItem)
                                    <label class="flex items-center space-x-3 p-3 bg-white border-2 border-black hover:shadow-[3px_3px_0px_#000] transition cursor-pointer">
                                        <div class="relative">
                                            <input type="checkbox" name="fasilitas[]" value="{{ $fasilitasItem->id_fasilitas }}"
                                                class="accent-black border-2 border-black"
                                                {{ in_array($fasilitasItem->id_fasilitas, old('fasilitas', [])) ? 'checked' : '' }}>
                                        </div>
                                        <div class="flex-1">
                                            <span class="text-sm font-medium text-black">{{ $fasilitasItem->nama_fasilitas }}</span>
                                            <span class="text-xs text-gray-600 block">{{ $fasilitasItem->kategori }}</span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Foto Utama -->
                        <div>
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 bg-white border-2 border-black shadow-[2px_2px_0px_#000] flex items-center justify-center mr-3">
                                    <i class="fas fa-camera text-black"></i>
                                </div>
                                <h2 class="text-xl font-semibold text-black">📷 Foto Utama</h2>
                            </div>

                            <div>
                                <label class="block text-sm font-black text-black mb-2">Foto Utama Kos</label>
                                <div class="relative group">
                                    <div class="flex items-center justify-center w-full">
                                        <label for="foto-utama"
                                            class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-black cursor-pointer bg-white">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                                <p class="text-sm text-gray-700 mb-1">
                                                    <span class="font-semibold">Klik untuk upload</span> atau drag & drop
                                                </p>
                                                <p class="text-xs text-gray-400">PNG, JPG, JPEG (Max. 2MB)</p>
                                            </div>
                                            <input id="foto-utama" name="foto_utama" type="file" class="hidden" accept="image/*" data-preview="#new-photo-preview">
                                        </label>
                                    </div>
                                </div>
                                <div id="new-photo-preview" class="mt-2"></div>
                                <p class="text-sm text-gray-700 mt-3 flex items-center">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    Gambar utama yang akan ditampilkan di halaman pencarian
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-8 flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('pemilik.kos.index') }}"
                            class="flex-1 sm:flex-none px-6 py-3 bg-white text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition-all flex items-center justify-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali
                        </a>
                        <button type="submit"
                            class="flex-1 sm:flex-none px-6 py-3 bg-black text-white font-black border-2 border-black shadow-[3px_3px_0px_#000] hover:shadow-[4px_4px_0px_#000] transition-all uppercase tracking-wide flex items-center justify-center">
                            <i class="fas fa-save mr-2"></i>
                            Simpan Kos
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>



@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (window.initKosMap) window.initKosMap();
    });
</script>
@endpush
@endsection
