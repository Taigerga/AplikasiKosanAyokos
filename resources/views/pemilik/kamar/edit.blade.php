@extends('layouts.app')

@section('title', 'Edit Kamar - AyoKos')

@section('content')
<div class="p-4 md:p-6 lg:p-8 space-y-6 max-w-7xl mx-auto">
    <!-- Breadcrumb -->
    <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-4 mb-6">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('pemilik.dashboard') }}" class="inline-flex items-center text-sm font-medium text-slate-100 hover:text-white transition-colors">
                        <i class="fas fa-home mr-2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="inline-flex items-center">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-white/50 text-xs mx-2"></i>
                        <a href="{{ route('pemilik.kamar.index') }}" class="inline-flex items-center text-sm font-medium text-slate-100 hover:text-white transition-colors">
                            <i class="fas fa-bed mr-2"></i>
                            Kelola Kamar
                        </a>
                    </div>
                </li>
                <li class="inline-flex items-center">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-white/50 text-xs mx-2"></i>
                        <span class="inline-flex items-center text-sm font-medium text-white">
                            <i class="fas fa-pencil mr-2"></i>
                            Edit Kamar
                        </span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
    <!-- Header -->
    <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-white mb-2">Edit Kamar {{ $kamar->nomor_kamar }}</h1>
                <p class="text-slate-100">Perbarui informasi dan fasilitas kamar</p>
            </div>
            <div class="flex items-center space-x-2">
                <span class="px-3 py-1 text-xs rounded-full backdrop-blur-sm
                    {{ $kamar->status_kamar == 'tersedia' ? 'bg-green-50 text-green-600' : 
                       ($kamar->status_kamar == 'terisi' ? 'bg-blue-50 text-blue-600' : 
                       'bg-yellow-50 text-yellow-600') }}">
                    {{ ucfirst($kamar->status_kamar) }}
                </span>
                <span class="px-3 py-1 text-xs rounded-full bg-sky-500/20 backdrop-blur-sm text-sky-300">
                    {{ $kamar->tipe_kamar }}
                </span>
            </div>
        </div>
    </div>

    @if($errors->any())
        <div class="bg-red-500/20 backdrop-blur-sm border border-red-500/20 text-red-300 px-6 py-4 rounded-2xl">
            <div class="flex items-center mb-2">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <span class="font-medium">Terjadi kesalahan:</span>
            </div>
            <ul class="text-sm space-y-1">
                @foreach($errors->all() as $error)
                <li class="flex items-start">
                    <i class="fas fa-chevron-right text-xs mt-1 mr-2 text-red-400"></i>
                    <span>{{ $error }}</span>
                </li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form -->
    <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
        <form method="POST" action="{{ route('pemilik.kamar.update', $kamar->id_kamar) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-6">
                    <!-- Pilih Kos -->
                    <div>
                        <label class="block text-sm font-medium text-white mb-3 flex items-center">
                            <i class="fas fa-home text-sky-400 mr-2 w-5"></i>
                            Pilih Kos <span class="text-red-400 ml-1">*</span>
                        </label>
                        <div class="relative">
                            <i class="fas fa-chevron-down absolute right-4 top-1/2 transform -translate-y-1/2 text-white/50 pointer-events-none"></i>
                            <select name="id_kos" 
                                    class="w-full pl-12 pr-10 py-3 bg-white/5 border border-white/20 text-white rounded-xl focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-500/30 appearance-none transition" required>
                                <option value="">Pilih Kos</option>
                                @foreach($kos as $k)
                                <option value="{{ $k->id_kos }}" {{ old('id_kos', $kamar->id_kos) == $k->id_kos ? 'selected' : '' }}>
                                    {{ $k->nama_kos }} - {{ $k->alamat }}
                                </option>
                                @endforeach
                            </select>
                            <i class="fas fa-building absolute left-4 top-1/2 transform -translate-y-1/2 text-white/50"></i>
                        </div>
                    </div>

                    <!-- Nomor Kamar -->
                    <div>
                        <label class="block text-sm font-medium text-white mb-3 flex items-center">
                            <i class="fas fa-hashtag text-sky-400 mr-2 w-5"></i>
                            Nomor Kamar <span class="text-red-400 ml-1">*</span>
                        </label>
                        <div class="relative">
                            <i class="fas fa-door-closed absolute left-4 top-1/2 transform -translate-y-1/2 text-white/50"></i>
                            <input type="text" 
                                   name="nomor_kamar" 
                                   value="{{ old('nomor_kamar', $kamar->nomor_kamar) }}" 
                                   class="w-full pl-12 pr-4 py-3 bg-white/5 border border-white/20 text-white rounded-xl focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-500/30 transition"
                                   placeholder="Contoh: A1, B2, 101"
                                   required maxlength="10">
                        </div>
                    </div>

                    <!-- Tipe Kamar -->
                    <div>
                        <label class="block text-sm font-medium text-white mb-3 flex items-center">
                            <i class="fas fa-star text-sky-400 mr-2 w-5"></i>
                            Tipe Kamar <span class="text-red-400 ml-1">*</span>
                        </label>
                        <div class="relative">
                            <i class="fas fa-chevron-down absolute right-4 top-1/2 transform -translate-y-1/2 text-white/50 pointer-events-none"></i>
                            <select name="tipe_kamar" 
                                    class="w-full pl-12 pr-10 py-3 bg-white/5 border border-white/20 text-white rounded-xl focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-500/30 appearance-none transition" required>
                                <option value="">Pilih Tipe Kamar</option>
                                <option value="Standar" {{ old('tipe_kamar', $kamar->tipe_kamar) == 'Standar' ? 'selected' : '' }}>Standar</option>
                                <option value="Deluxe" {{ old('tipe_kamar', $kamar->tipe_kamar) == 'Deluxe' ? 'selected' : '' }}>Deluxe</option>
                                <option value="VIP" {{ old('tipe_kamar', $kamar->tipe_kamar) == 'VIP' ? 'selected' : '' }}>VIP</option>
                                <option value="Superior" {{ old('tipe_kamar', $kamar->tipe_kamar) == 'Superior' ? 'selected' : '' }}>Superior</option>
                                <option value="Ekonomi" {{ old('tipe_kamar', $kamar->tipe_kamar) == 'Ekonomi' ? 'selected' : '' }}>Ekonomi</option>
                            </select>
                            <i class="fas fa-crown absolute left-4 top-1/2 transform -translate-y-1/2 text-white/50"></i>
                        </div>
                    </div>

                    <!-- Harga -->
                    <div>
                        <label class="block text-sm font-medium text-white mb-3 flex items-center">
                            <i class="fas fa-money-bill-wave text-sky-400 mr-2 w-5"></i>
                            Harga Sewa per Bulan <span class="text-red-400 ml-1">*</span>
                        </label>
                        <div class="relative">
                            <i class="fas fa-tag absolute left-4 top-1/2 transform -translate-y-1/2 text-white/50"></i>
                            <input type="number" 
                                   name="harga" 
                                   value="{{ old('harga', $kamar->harga) }}" 
                                   class="w-full pl-12 pr-4 py-3 bg-white/5 border border-white/20 text-white rounded-xl focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-500/30 transition"
                                   required min="0">
                            <span class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white/50">/bulan</span>
                        </div>
                    </div>

                    <!-- Luas Kamar -->
                    <div>
                        <label class="block text-sm font-medium text-white mb-3 flex items-center">
                            <i class="fas fa-ruler-combined text-sky-400 mr-2 w-5"></i>
                            Luas Kamar <span class="text-red-400 ml-1">*</span>
                        </label>
                        <div class="relative">
                            <i class="fas fa-expand absolute left-4 top-1/2 transform -translate-y-1/2 text-white/50"></i>
                            <input type="text" 
                                   name="luas_kamar" 
                                   value="{{ old('luas_kamar', $kamar->luas_kamar) }}" 
                                   class="w-full pl-12 pr-4 py-3 bg-white/5 border border-white/20 text-white rounded-xl focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-500/30 transition"
                                   placeholder="Contoh: 3x4 m²"
                                   required
                                   maxlength="20">
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Kapasitas -->
                    <div>
                        <label class="block text-sm font-medium text-white mb-3 flex items-center">
                            <i class="fas fa-users text-sky-400 mr-2 w-5"></i>
                            Kapasitas <span class="text-red-400 ml-1">*</span>
                        </label>
                        <div class="relative">
                            <i class="fas fa-chevron-down absolute right-4 top-1/2 transform -translate-y-1/2 text-white/50 pointer-events-none"></i>
                            <select name="kapasitas" 
                                    class="w-full pl-12 pr-10 py-3 bg-white/5 border border-white/20 text-white rounded-xl focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-500/30 appearance-none transition" required>
                                <option value="">Pilih Kapasitas</option>
                                @for($i = 1; $i <= 4; $i++)
                                <option value="{{ $i }}" {{ old('kapasitas', $kamar->kapasitas) == $i ? 'selected' : '' }}>
                                    {{ $i }} Orang
                                </option>
                                @endfor
                            </select>
                            <i class="fas fa-user-friends absolute left-4 top-1/2 transform -translate-y-1/2 text-white/50"></i>
                        </div>
                    </div>

                    <!-- Status Kamar -->
                    <div>
                        <label class="block text-sm font-medium text-white mb-3 flex items-center">
                            <i class="fas fa-info-circle text-sky-400 mr-2 w-5"></i>
                            Status Kamar <span class="text-red-400 ml-1">*</span>
                        </label>
                        <div class="grid grid-cols-3 gap-2">
                            <label class="cursor-pointer">
                                <input type="radio" 
                                       name="status_kamar" 
                                       value="tersedia" 
                                       class="hidden peer"
                                       {{ old('status_kamar', $kamar->status_kamar) == 'tersedia' ? 'checked' : '' }}>
                                <div class="p-3 text-center rounded-xl border border-white/20 peer-checked:border-emerald-500 peer-checked:bg-emerald-500/20 transition-all duration-300">
                                    <div class="text-emerald-400 mb-1">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <span class="text-sm font-medium text-white">Tersedia</span>
                                </div>
                            </label>
                            
                            <label class="cursor-pointer">
                                <input type="radio" 
                                       name="status_kamar" 
                                       value="terisi" 
                                       class="hidden peer"
                                       {{ old('status_kamar', $kamar->status_kamar) == 'terisi' ? 'checked' : '' }}>
                                <div class="p-3 text-center rounded-xl border border-white/20 peer-checked:border-blue-500 peer-checked:bg-blue-500/20 transition-all duration-300">
                                    <div class="text-blue-400 mb-1">
                                        <i class="fas fa-user-check"></i>
                                    </div>
                                    <span class="text-sm font-medium text-white">Terisi</span>
                                </div>
                            </label>
                            
                            <label class="cursor-pointer">
                                <input type="radio" 
                                       name="status_kamar" 
                                       value="maintenance" 
                                       class="hidden peer"
                                       {{ old('status_kamar', $kamar->status_kamar) == 'maintenance' ? 'checked' : '' }}>
                                <div class="p-3 text-center rounded-xl border border-white/20 peer-checked:border-yellow-500 peer-checked:bg-yellow-500/20 transition-all duration-300">
                                    <div class="text-yellow-400 mb-1">
                                        <i class="fas fa-tools"></i>
                                    </div>
                                    <span class="text-sm font-medium text-white">Maintenance</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Foto Kamar -->
                    <div>
                        <label class="block text-sm font-medium text-white mb-3 flex items-center">
                            <i class="fas fa-camera text-sky-400 mr-2 w-5"></i>
                            Foto Kamar
                        </label>
                        
                        <!-- Current Photo Preview -->
                        @if($kamar->foto_kamar)
                        <div class="mb-4">
                            <div class="relative rounded-xl overflow-hidden border border-white/20 mb-3">
                                <img src="{{ asset('storage/' . $kamar->foto_kamar) }}" 
                                     alt="Foto Kamar" 
                                     class="w-full h-48 object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent flex items-end">
                                    <div class="p-4">
                                        <a href="{{ asset('storage/' . $kamar->foto_kamar) }}" 
                                           target="_blank" 
                                           class="inline-flex items-center text-sm text-white hover:text-sky-300 transition">
                                            <i class="fas fa-expand mr-2"></i>
                                            Lihat Fullsize
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="text-xs text-slate-100">
                                Foto saat ini
                            </div>
                        </div>
                        @endif

                        <!-- File Upload -->
                        <div class="relative">
                            <input type="file" 
                                   name="foto_kamar" 
                                   id="foto_kamar"
                                   class="hidden"
                                   accept="image/*">
                            <label for="foto_kamar" 
                                   class="flex items-center justify-center w-full p-6 border-2 border-dashed border-white/20 rounded-xl cursor-pointer hover:border-sky-500/50 hover:bg-white/10 transition-all duration-300">
                                <div class="text-center">
                                    <div class="w-12 h-12 bg-sky-500/20 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <i class="fas fa-cloud-upload-alt text-sky-400 text-xl"></i>
                                    </div>
                                    <p class="text-sm text-white mb-1">
                                        <span class="text-sky-300">Klik untuk upload</span> atau drag & drop
                                    </p>
                                    <p class="text-xs text-slate-100">
                                        Kosongkan jika tidak ingin mengubah foto
                                    </p>
                                </div>
                            </label>
                        </div>
                        
                        <!-- File Preview -->
                        <div id="filePreview" class="hidden mt-3">
                            <div class="flex items-center justify-between p-3 bg-white/5 border border-white/20 rounded-xl">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-image text-sky-400"></i>
                                    <div>
                                        <p class="text-sm font-medium text-white" id="fileName"></p>
                                        <p class="text-xs text-slate-100" id="fileSize"></p>
                                    </div>
                                </div>
                                <button type="button" 
                                        onclick="removeFile()" 
                                        class="text-red-400 hover:text-red-300">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Fasilitas Kamar -->
            <div class="mt-8 pt-6 border-t border-white/10">
                <label class="block text-sm font-medium text-white mb-4 flex items-center">
                    <i class="fas fa-list-check text-sky-400 mr-2 w-5"></i>
                    Fasilitas Kamar
                </label>
                <div class="bg-white/5 border border-white/20 rounded-xl p-4">
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                        @php
                            $commonFacilities = [
                                'Kamar mandi dalam', 'AC', 'WiFi', 'Kasur', 'Lemari', 
                                'Meja belajar', 'Kursi', 'Kipas angin', 'TV', 'Kulkas mini',
                                'Dapur', 'Water heater', 'Jendela', 'Balkon'
                            ];
                            $currentFacilities = is_array($kamar->fasilitas_kamar) ? $kamar->fasilitas_kamar : json_decode($kamar->fasilitas_kamar, true) ?? [];
                            $currentFacilities = is_array($currentFacilities) ? $currentFacilities : [];
                            $facilityIcons = [
                                'Kamar mandi dalam' => 'fa-bath',
                                'AC' => 'fa-snowflake',
                                'WiFi' => 'fa-wifi',
                                'Kasur' => 'fa-bed',
                                'Lemari' => 'fa-box-archive',
                                'Meja belajar' => 'fa-table',
                                'Kursi' => 'fa-chair',
                                'Kipas angin' => 'fa-fan',
                                'TV' => 'fa-tv',
                                'Kulkas mini' => 'fa-temperature-low',
                                'Dapur' => 'fa-kitchen-set',
                                'Water heater' => 'fa-temperature-high',
                                'Jendela' => 'fa-window-maximize',
                                'Balkon' => 'fa-door-open'
                            ];
                        @endphp
                        @foreach($commonFacilities as $facility)
                        <label class="cursor-pointer">
                            <input type="checkbox" 
                                   name="fasilitas_kamar[]" 
                                   value="{{ $facility }}" 
                                   class="hidden peer"
                                   {{ in_array($facility, old('fasilitas_kamar', $currentFacilities)) ? 'checked' : '' }}>
                            <div class="flex items-center space-x-3 p-3 rounded-xl border border-white/20 peer-checked:border-sky-500 peer-checked:bg-sky-500/20 transition-all duration-300 hover:border-white/30">
                                <div class="w-8 h-8 rounded-lg bg-sky-500/20 flex items-center justify-center">
                                    <i class="fas {{ $facilityIcons[$facility] ?? 'fa-check' }} text-sky-400 text-sm"></i>
                                </div>
                                <span class="text-sm text-white">{{ $facility }}</span>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 pt-6 border-t border-white/10 flex flex-col sm:flex-row gap-4">
                <a href="{{ route('pemilik.kamar.index') }}" 
                   class="flex-1 px-6 py-3 bg-white/5 backdrop-blur-sm border border-white/20 text-white rounded-xl hover:bg-white/10 transition-all duration-300 font-medium text-center flex items-center justify-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
                <button type="submit" 
                        class="flex-1 px-6 py-3 bg-sky-500/20 backdrop-blur-sm border border-sky-500/20 hover:bg-sky-500/10 text-white rounded-xl transition-all duration-300 font-medium">
                    <i class="fas fa-save mr-2"></i>
                    Update Kamar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // File upload preview
    document.getElementById('foto_kamar').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const preview = document.getElementById('filePreview');
            const fileName = document.getElementById('fileName');
            const fileSize = document.getElementById('fileSize');
            
            // Show preview
            preview.classList.remove('hidden');
            
            // Set file info
            fileName.textContent = file.name;
            
            // Format file size
            const size = file.size;
            const i = size === 0 ? 0 : Math.floor(Math.log(size) / Math.log(1024));
            const formattedSize = (size / Math.pow(1024, i)).toFixed(2) * 1 + ' ' + ['B', 'KB', 'MB', 'GB'][i];
            fileSize.textContent = formattedSize;
        }
    });

    function removeFile() {
        const input = document.getElementById('foto_kamar');
        const preview = document.getElementById('filePreview');
        
        // Reset file input
        input.value = '';
        preview.classList.add('hidden');
    }

    // Format harga input
    document.querySelector('input[name="harga"]').addEventListener('input', function(e) {
        const value = e.target.value.replace(/\D/g, '');
        e.target.value = value ? parseInt(value, 10) : '';
    });

    // Add interactivity to facility checkboxes
    document.querySelectorAll('input[name="fasilitas_kamar[]"]').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const container = this.closest('label').querySelector('div');
            if (this.checked) {
                container.classList.add('ring-2', 'ring-sky-500/30');
            } else {
                container.classList.remove('ring-2', 'ring-sky-500/30');
            }
        });
    });

    // Auto-detect facility checkboxes state on load
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('input[name="fasilitas_kamar[]"]').forEach(checkbox => {
            if (checkbox.checked) {
                const container = checkbox.closest('label').querySelector('div');
                container.classList.add('ring-2', 'ring-sky-500/30');
            }
        });
    });

    // Form validation on submit
    document.querySelector('form').addEventListener('submit', function(e) {
        const form = this;
        let isValid = true;
        let firstInvalidField = null;
        
        // Clear previous error states
        form.querySelectorAll('.border-rose-500').forEach(el => {
            el.classList.remove('border-rose-500', 'ring-2', 'ring-rose-500/20');
        });

        // 1. Validate required inputs/selects
        const requiredInputs = form.querySelectorAll('input[required]:not([type="radio"]):not([type="checkbox"]), select[required]');
        requiredInputs.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                if (!firstInvalidField) firstInvalidField = field;
                field.classList.add('border-rose-500', 'ring-2', 'ring-rose-500/20');
            }
        });

        // 2. Validate radio groups (like status_kamar)
        const radioGroups = ['status_kamar'];
        radioGroups.forEach(groupName => {
            const radios = form.querySelectorAll(`input[name="${groupName}"]`);
            if (radios.length > 0) {
                const checked = form.querySelector(`input[name="${groupName}"]:checked`);
                if (!checked) {
                    isValid = false;
                    const container = radios[0].closest('.grid');
                    if (container) {
                        container.classList.add('border-rose-500', 'ring-2', 'ring-rose-500/20', 'p-2', 'rounded-xl');
                    }
                    if (!firstInvalidField) firstInvalidField = radios[0];
                }
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            if (firstInvalidField) {
                const scrollTarget = firstInvalidField.closest('div') || firstInvalidField;
                scrollTarget.scrollIntoView({ behavior: 'smooth', block: 'center' });
                if (firstInvalidField.focus && !firstInvalidField.readOnly) {
                    firstInvalidField.focus();
                }
            }
            if (typeof showToast === 'function') {
                showToast('Harap isi semua field yang wajib diisi', 'error');
            } else {
                alert('Harap isi semua field yang wajib diisi');
            }
        }
    });

    // Simple toast fallback if not defined in app.blade.php
    if (typeof showToast !== 'function') {
        window.showToast = function(message, type = 'info') {
            alert(message);
        };
    }
</script>
@endsection