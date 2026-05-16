@extends('layouts.app')

@section('title', 'Ajukan Kontrak - AyoKos')

@section('content')
    <div class="p-4 md:p-6 lg:p-8 max-w-7xl mx-auto">
        <div class="max-w-4xl mx-auto space-y-6">
            <!-- Breadcrumb -->
            <div class="bg-white border-2 border-black shadow-[2px_2px_0px_#000] p-4">
                <nav aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('penghuni.dashboard') }}"
                                class="inline-flex items-center text-sm text-gray-600 hover:text-black font-black transition">
                                <i class="fas fa-gauge mr-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-600 text-xs"></i>
                                <a href="{{ route('public.kos.show', $kos->id_kos) }}"
                                    class="ml-1 md:ml-3 text-sm text-gray-600 hover:text-black font-black transition">
                                    <i class="fas fa-file-contract mr-2"></i>
                                    {{ Str::limit($kos->nama_kos, 20) }}
                                </a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-600 text-xs"></i>
                                <span class="ml-1 md:ml-3 text-sm font-black text-black">
                                    <i class="fas fa-plus mr-2"></i>
                                    Ajukan Kontrak
                                </span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Header Section -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <div class="flex flex-col md:flex-row md:items-center justify-between">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-black text-black mb-2">Ajukan Kontrak Kos</h1>
                        <p class="text-gray-700 font-black">Lengkapi formulir untuk mengajukan kontrak sewa kamar</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <a href="{{ route('public.kos.show', $kos->id_kos) }}"
                            class="inline-flex items-center px-4 py-2 bg-white border-2 border-black shadow-[2px_2px_0px_#000] text-black  hover:bg-gray-100 transition">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali ke Detail Kos
                        </a>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-emerald-400 border-2 border-black shadow-[3px_3px_0px_#000] text-emerald-300 px-4 py-3 ">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-3"></i>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-400 border-2 border-black shadow-[3px_3px_0px_#000] text-rose-300 px-4 py-3 ">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            <!-- Informasi Kos -->
            <div class="bg-sky-100 border-2 border-black  p-6">
                <h2 class="text-xl font-black text-black mb-4 flex items-center">
                    <i class="fas fa-home text-sky-500 mr-3"></i>
                    Informasi Kos
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-center">
                        <i class="fas fa-building text-sky-500 mr-3 w-5"></i>
                        <div>
                            <p class="text-sm text-gray-600">Nama Kos</p>
                            <p class="font-black text-black">{{ $kos->nama_kos }}</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-map-marker-alt text-sky-500 mr-3 w-5"></i>
                        <div>
                            <p class="text-sm text-gray-600">Lokasi</p>
                            <p class="font-black text-black">{{ $kos->alamat }}, {{ $kos->kota }}</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-users text-sky-500 mr-3 w-5"></i>
                        <div>
                            <p class="text-sm text-gray-600">Jenis Kos</p>
                            <p class="font-black text-black">{{ ucfirst($kos->jenis_kos) }}</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-sky-500 mr-3 w-5"></i>
                        <div>
                            <p class="text-sm text-gray-600">Status</p>
                            <span class="px-3 py-1  text-xs font-black bg-emerald-50 text-emerald-600">
                                {{ ucfirst($kos->status_kos) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Pengajuan -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h2 class="text-xl font-black text-black mb-6 flex items-center">
                    <i class="fas fa-file-contract text-sky-500 mr-3"></i>
                    Formulir Pengajuan Kontrak
                </h2>

                @if($errors->any())
                    <div class="bg-red-100 border-2 border-black text-black px-4 py-3  mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            <span>Terjadi kesalahan. Silakan periksa formulir Anda.</span>
                        </div>
                        <ul class="mt-2 ml-6 list-disc text-sm text-gray-600">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('penghuni.kontrak.store') }}" enctype="multipart/form-data" data-ajax="true" data-ajax-action="/api/penghuni/kontrak" data-redirect="{{ route('penghuni.dashboard') }}" data-success-msg="Pengajuan kos berhasil dikirim!" data-confirm="Apakah Anda yakin data pengajuan kontrak sudah benar?" novalidate>
                    @csrf
                    <input type="hidden" name="id_kos" value="{{ $kos->id_kos }}">

                    <div class="space-y-6">
                        <!-- Pilih Kamar -->
                        <div>
                            <label class="block text-sm font-black text-black mb-2">
                                <i class="fas fa-bed text-sky-500 mr-2"></i>
                                Pilih Kamar *
                            </label>
                            <select id="id_kamar" name="id_kamar"
                                class="w-full px-4 py-3 bg-gray-100 border-2 border-black text-black  focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-500/30 transition @error('id_kamar') border-rose-500 focus:ring-rose-500/30 @enderror"
                                required>
                                <option value="" class="bg-white">-- Pilih Kamar --</option>
                                @foreach($kos->kamar as $kamar)
                                    @if($kamar->status_kamar == 'tersedia')
                                        <option value="{{ $kamar->id_kamar }}" data-harga="{{ $kamar->harga }}"
                                            data-tipe="{{ $kamar->tipe_kamar }}" data-luas="{{ $kamar->luas_kamar }}"
                                            data-nomor="{{ $kamar->nomor_kamar }}" data-kapasitas="{{ $kamar->kapasitas }}">
                                            Kamar {{ $kamar->nomor_kamar }} - {{ $kamar->tipe_kamar }}
                                            @if($kamar->luas_kamar)
                                                ({{ $kamar->luas_kamar }})
                                            @endif
                                            - Rp {{ number_format($kamar->harga, 0, ',', '.') }}/
                                            @if($kos->tipe_sewa == 'harian')
                                                hari
                                            @elseif($kos->tipe_sewa == 'mingguan')
                                                minggu
                                            @elseif($kos->tipe_sewa == 'bulanan')
                                                bulan
                                            @elseif($kos->tipe_sewa == 'tahunan')
                                                tahun
                                            @else
                                                bulan
                                            @endif
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('id_kamar')
                                <p class="text-rose-400 text-sm mt-1">{{ $message }}</p>
                            @enderror

                            <!-- Kamar Detail Info -->
                            <div id="kamar-detail" class="mt-4 p-4 bg-gray-100 border-2 border-black hidden">
                                <h3 class="font-black text-black mb-3 flex items-center">
                                    <i class="fas fa-info-circle text-sky-500 mr-2"></i>
                                    Detail Kamar
                                </h3>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                                    <div>
                                        <p class="text-gray-600">Nomor Kamar</p>
                                        <p id="detail-nomor" class="font-black text-black">-</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600">Tipe Kamar</p>
                                        <p id="detail-tipe" class="font-black text-black">-</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600">Luas</p>
                                        <p id="detail-luas" class="font-black text-black">-</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600">Kapasitas</p>
                                        <p id="detail-kapasitas" class="font-black text-black">-</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tanggal Mulai Sewa -->
                        <div>
                            <label class="block text-sm font-black text-black mb-2">
                                <i class="fas fa-calendar-day text-sky-500 mr-2"></i>
                                Tanggal Mulai Sewa *
                            </label>
                            <input type="date" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai', date('Y-m-d')) }}"
                                class="w-full px-4 py-3 bg-gray-100 border-2 border-black text-black  focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-500/30 transition"
                                required>
                            @error('tanggal_mulai')
                                <p class="text-rose-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Durasi Sewa -->
                        <div>
                            <label class="block text-sm font-black text-black mb-2">
                                <i class="fas fa-calendar-alt text-sky-500 mr-2"></i>
                                Durasi Sewa *
                            </label>
                            <select id="durasi_sewa" name="durasi_sewa"
                                class="w-full px-4 py-3 bg-gray-100 border-2 border-black text-black  focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-500/30 transition"
                                required>
                                <option value="">-- Pilih Durasi --</option>
                            </select>
                            @error('durasi_sewa')
                                <p class="text-rose-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Preview Tanggal Selesai -->
                        <div id="preview-selesai-container" class="bg-sky-100 border-2 border-black  p-5 hidden">
                            <h3 class="font-black text-black mb-3 flex items-center">
                                <i class="fas fa-calendar-check text-sky-500 mr-3"></i>
                                Periode Sewa
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-600">Tanggal Mulai</p>
                                    <p id="preview-tanggal-mulai" class="text-lg font-black text-black">-</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Tanggal Selesai</p>
                                    <p id="preview-tanggal-selesai" class="text-lg font-black text-emerald-400">-</p>
                                </div>
                            </div>
                        </div>

                        <!-- Total Biaya Summary -->
                        <div class="bg-emerald-100 border-2 border-black  p-5">
                            <h3 class="font-black text-black mb-4 flex items-center">
                                <i class="fas fa-calculator text-emerald-500 mr-3"></i>
                                Ringkasan Biaya
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-600">Harga/
                                        @if($kos->tipe_sewa == 'harian')
                                            Hari
                                        @elseif($kos->tipe_sewa == 'mingguan')
                                            Minggu
                                        @elseif($kos->tipe_sewa == 'bulanan')
                                            Bulan
                                        @elseif($kos->tipe_sewa == 'tahunan')
                                            Tahun
                                        @else
                                            Bulan
                                        @endif
                                    </p>
                                    <p id="harga-per-bulan" class="text-lg font-black text-black">Rp 0</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Total Biaya</p>
                                    <p id="total-biaya" class="text-2xl font-black text-emerald-500">Rp 0</p>
                                </div>
                            </div>
                            <div class="mt-3 text-sm text-gray-600" id="detail-kamar-summary">
                                <i class="fas fa-info-circle mr-2"></i>
                                Pilih kamar dan durasi untuk melihat detail
                            </div>
                        </div>

                        <!-- Data Diri -->
                        <div class="border-t border-black pt-6">
                            <h3 class="text-lg font-black text-black mb-4 flex items-center">
                                <i class="fas fa-user-circle text-sky-500 mr-3"></i>
                                Data Diri
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="bg-gray-100 border-2 border-black p-4">
                                    <p class="text-sm text-gray-600 mb-1">No. Handphone</p>
                                    <p class="font-black text-black">{{ auth()->user()->penghuni->no_hp }}</p>

                                </div>
                                <div class="bg-gray-100 border-2 border-black p-4">
                                    <p class="text-sm text-gray-600 mb-1">Email</p>
                                    <p class="font-black text-black">{{ auth()->user()->penghuni->email }}</p>
                                    <p class="text-xs text-gray-600 mt-2">
                                        <i class="fas fa-envelope text-sky-500 mr-1"></i>
                                        Notifikasi Email akan dikirim ke kontak ini
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Upload Dokumen -->
                        <div class="border-t border-black pt-6">
                            <h3 class="text-lg font-black text-black mb-4 flex items-center">
                                <i class="fas fa-file-upload text-indigo-500 mr-3"></i>
                                Dokumen Persyaratan
                            </h3>

                            <div class="space-y-4">
                                <!-- KTP Upload -->
                                <div>
                                    <label class="block text-sm font-black text-black mb-2">
                                        Foto KTP *
                                        <span class="text-xs text-gray-600 ml-2">(JPG/PNG, max 2MB)</span>
                                    </label>
                                    <div
                                        class="border-2 border-dashed border-black  p-6 text-center hover:border-black transition @error('foto_ktp') border-rose-500 focus:ring-rose-500/30 @enderror">
                                        <input type="file" name="foto_ktp" id="foto_ktp" class="hidden" accept="image/*"
                                            required>
                                        <label for="foto_ktp" class="cursor-pointer">
                                            <div class="mb-3">
                                                <div
                                                    class="w-16 h-16 bg-sky-400  flex items-center justify-center mx-auto">
                                                    <i class="fas fa-id-card text-2xl text-sky-500"></i>
                                                </div>
                                            </div>
                                            <div class="text-sky-500 font-black">Upload Foto KTP</div>
                                            <div class="text-xs text-gray-600 mt-1">
                                                Klik atau drag & drop file ke sini
                                            </div>
                                        </label>
                                        <div id="ktp-preview" class="mt-4 hidden">
                                            <p class="text-sm text-gray-600 mb-2">Preview:</p>
                                            <img src="" alt="Preview KTP"
                                                class="max-h-40 mx-auto  border-2 border-black">
                                        </div>
                                    </div>
                                    @error('foto_ktp')
                                        <p class="text-rose-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Penting -->
                        <div class="bg-yellow-100 border-2 border-black  p-5">
                            <h3 class="font-black text-black mb-3 flex items-center">
                                <i class="fas fa-info-circle text-amber-500 mr-3"></i>
                                Informasi Penting
                            </h3>
                            <ul class="space-y-3">
                                <li class="flex items-start">
                                    <div
                                        class="w-6 h-6  bg-emerald-400 flex items-center justify-center mr-3 flex-shrink-0">
                                        <i class="fas fa-check text-emerald-500 text-xs"></i>
                                    </div>
                                    <span class="text-sm text-gray-600">Setelah mengajukan, Anda akan menerima notifikasi
                                        Email</span>
                                </li>
                                <li class="flex items-start">
                                    <div
                                        class="w-6 h-6  bg-sky-400 flex items-center justify-center mr-3 flex-shrink-0">
                                        <i class="fas fa-clock text-sky-500 text-xs"></i>
                                    </div>
                                    <span class="text-sm text-gray-600">Pemilik akan meninjau dalam 1-3 hari kerja</span>
                                </li>
                                <li class="flex items-start">
                                    <div
                                        class="w-6 h-6  bg-purple-400 flex items-center justify-center mr-3 flex-shrink-0">
                                        <i class="fas fa-chart-line text-indigo-500 text-xs"></i>
                                    </div>
                                    <span class="text-sm text-gray-600">Status bisa dipantau di dashboard Anda</span>
                                </li>
                                <li class="flex items-start">
                                    <div
                                        class="w-6 h-6  bg-sky-400 flex items-center justify-center mr-3 flex-shrink-0">
                                        <i class="fas fa-envelope text-sky-500 text-xs"></i>
                                    </div>
                                    <div>
                                        <span class="text-sm text-gray-600">Notifikasi akan dikirim ke:</span>
                                        <p class="text-sm font-black text-black mt-1">{{ auth()->user()->penghuni->email }}
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8 pt-6 border-t border-black flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('public.kos.show', $kos->id_kos) }}"
                            class="flex-1 px-6 py-3 bg-white border-2 border-black shadow-[2px_2px_0px_#000] text-black  hover:bg-gray-100 transition text-center">
                            <i class="fas fa-times mr-2"></i>
                            Batal
                        </a>
                        <button type="submit"
                            class="flex-1 px-6 py-3 bg-sky-400 border-2 border-black shadow-[2px_2px_0px_#000] hover:bg-sky-500 text-black  font-black transition">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Ajukan Kontrak
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // ========================================
            // KONFIGURASI TIPE SEWA
            // ========================================
            const TIPE_SEWA = '{{ $kos->tipe_sewa }}';
            const DURATION_CONFIG = {
                harian:  { label: 'Hari',  unit: 'day',    max: 30,  step: 1 },
                mingguan:{ label: 'Minggu',unit: 'week',   max: 52,  step: 1 },
                bulanan: { label: 'Bulan', unit: 'month',  max: 12,  step: 1 },
                tahunan: { label: 'Tahun', unit: 'year',   max: 5,   step: 1 }
            };
            const config = DURATION_CONFIG[TIPE_SEWA] || DURATION_CONFIG.bulanan;

            // ========================================
            // ELEMEN DOM
            // ========================================
            const kamarSelect = document.getElementById('id_kamar');
            const durasiSelect = document.getElementById('durasi_sewa');
            const tanggalMulaiInput = document.getElementById('tanggal_mulai');
            const hargaPerBulanElement = document.getElementById('harga-per-bulan');
            const totalBiayaElement = document.getElementById('total-biaya');
            const detailKamarSummary = document.getElementById('detail-kamar-summary');
            const kamarDetailBox = document.getElementById('kamar-detail');
            const previewContainer = document.getElementById('preview-selesai-container');
            const previewMulai = document.getElementById('preview-tanggal-mulai');
            const previewSelesai = document.getElementById('preview-tanggal-selesai');

            // Kamar detail elements
            const detailNomor = document.getElementById('detail-nomor');
            const detailTipe = document.getElementById('detail-tipe');
            const detailLuas = document.getElementById('detail-luas');
            const detailKapasitas = document.getElementById('detail-kapasitas');

            // File upload preview
            const ktpInput = document.getElementById('foto_ktp');
            const ktpPreview = document.getElementById('ktp-preview');

            // Kamar data from server
            const kamarData = {};
            @foreach($kos->kamar as $kamar)
                @if($kamar->status_kamar == 'tersedia')
                    kamarData[{{ $kamar->id_kamar }}] = {
                        nomor: "{{ $kamar->nomor_kamar }}",
                        tipe: "{{ $kamar->tipe_kamar }}",
                        luas: "{{ $kamar->luas_kamar }}",
                        harga: {{ $kamar->harga }},
                        kapasitas: {{ $kamar->kapasitas }}
                    };
                @endif
            @endforeach

            // ========================================
            // HELPER FUNCTIONS
            // ========================================
            function formatRupiah(angka) {
                if (!angka || isNaN(angka) || angka === 0) return 'Rp 0';
                return 'Rp ' + angka.toLocaleString('id-ID');
            }

            function formatDate(date) {
                const d = new Date(date);
                const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                return d.getDate() + ' ' + months[d.getMonth()] + ' ' + d.getFullYear();
            }

            function addDateUnit(date, value, unit) {
                const d = new Date(date);
                switch (unit) {
                    case 'day':   d.setDate(d.getDate() + value); break;
                    case 'week':  d.setDate(d.getDate() + value * 7); break;
                    case 'month': d.setMonth(d.getMonth() + value); break;
                    case 'year':  d.setFullYear(d.getFullYear() + value); break;
                }
                return d;
            }

            // ========================================
            // GENERATE DURASI OPTIONS
            // ========================================
            function generateDurasiOptions() {
                durasiSelect.innerHTML = '<option value="">-- Pilih Durasi --</option>';
                for (let i = 1; i <= config.max; i += config.step) {
                    const option = document.createElement('option');
                    option.value = i;
                    option.textContent = i + ' ' + config.label + (i > 1 && TIPE_SEWA !== 'harian' ? '' : '');
                    durasiSelect.appendChild(option);
                }
                // Set default: 1 for most, but for bulanan set 1 as well
                durasiSelect.value = '1';
            }

            // ========================================
            // CALCULATE TANGGAL SELESAI
            // ========================================
            function calculateTanggalSelesai(tanggalMulai, durasi) {
                if (!tanggalMulai || !durasi) return null;
                const start = new Date(tanggalMulai);
                return addDateUnit(start, parseInt(durasi), config.unit);
            }

            // ========================================
            // UPDATE ALL
            // ========================================
            function updateAll() {
                const selectedKamarId = kamarSelect.value;
                const durasi = parseInt(durasiSelect.value) || 0;
                const tanggalMulai = tanggalMulaiInput.value;

                if (!selectedKamarId) {
                    hargaPerBulanElement.textContent = 'Rp 0';
                    totalBiayaElement.textContent = 'Rp 0';
                    detailKamarSummary.innerHTML = '<i class="fas fa-info-circle mr-2"></i>Pilih kamar dan durasi untuk melihat detail';
                    kamarDetailBox.classList.add('hidden');
                    previewContainer.classList.add('hidden');
                    return;
                }

                const kamar = kamarData[selectedKamarId];
                if (!kamar) return;

                // Calculate total
                const total = kamar.harga * (durasi || 1);

                // Update display
                hargaPerBulanElement.textContent = formatRupiah(kamar.harga);
                totalBiayaElement.textContent = formatRupiah(total);

                // Update kamar summary
                let summary = 'Kamar ' + kamar.nomor + ' - ' + kamar.tipe;
                if (kamar.luas) summary += ' • ' + kamar.luas;
                if (durasi > 0) summary += ' • ' + durasi + ' ' + config.label.toLowerCase();
                detailKamarSummary.textContent = summary;

                // Update kamar detail box
                detailNomor.textContent = kamar.nomor;
                detailTipe.textContent = kamar.tipe;
                detailLuas.textContent = kamar.luas || '-';
                detailKapasitas.textContent = kamar.kapasitas + ' orang';
                kamarDetailBox.classList.remove('hidden');

                // Update tanggal selesai preview
                if (tanggalMulai && durasi > 0) {
                    const tanggalSelesai = calculateTanggalSelesai(tanggalMulai, durasi);
                    previewMulai.textContent = formatDate(tanggalMulai);
                    previewSelesai.textContent = formatDate(tanggalSelesai);
                    previewContainer.classList.remove('hidden');
                } else {
                    previewContainer.classList.add('hidden');
                }
            }

            // ========================================
            // FILE UPLOAD
            // ========================================
            ktpInput.addEventListener('change', function (e) {
                const file = e.target.files[0];
                if (file) {
                    if (file.size > 2 * 1024 * 1024) {
                        alert('File KTP terlalu besar. Maksimal 2MB.');
                        this.value = '';
                        return;
                    }
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        ktpPreview.querySelector('img').src = e.target.result;
                        ktpPreview.classList.remove('hidden');
                    }
                    reader.readAsDataURL(file);
                } else {
                    ktpPreview.classList.add('hidden');
                }
            });

            const dropZone = document.querySelector('label[for="foto_ktp"]');
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                }, false);
            });

            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, function() {
                    dropZone.parentElement.classList.add('border-sky-500', 'bg-sky-500/10');
                }, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, function() {
                    dropZone.parentElement.classList.remove('border-sky-500', 'bg-sky-500/10');
                }, false);
            });

            dropZone.addEventListener('drop', function(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                if (files.length > 0) {
                    ktpInput.files = files;
                    ktpInput.dispatchEvent(new Event('change'));
                }
            }, false);

            // ========================================
            // EVENT LISTENERS
            // ========================================
            kamarSelect.addEventListener('change', updateAll);
            durasiSelect.addEventListener('change', updateAll);
            tanggalMulaiInput.addEventListener('change', updateAll);

            // ========================================
            // INIT
            // ========================================
            generateDurasiOptions();

            if (kamarSelect.value) {
                updateAll();
            }

            // Form validation before submit
            const form = document.querySelector('form');
            form.addEventListener('submit', function (e) {
                if (!kamarSelect.value) {
                    e.preventDefault();
                    alert('Silakan pilih kamar terlebih dahulu');
                    kamarSelect.focus();
                    return false;
                }
                if (!durasiSelect.value) {
                    e.preventDefault();
                    alert('Silakan pilih durasi sewa');
                    durasiSelect.focus();
                    return false;
                }
                if (!tanggalMulaiInput.value) {
                    e.preventDefault();
                    alert('Silakan pilih tanggal mulai');
                    tanggalMulaiInput.focus();
                    return false;
                }
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengajukan...';
                submitBtn.disabled = true;
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 5000);
            });
        });
    </script>
@endsection
