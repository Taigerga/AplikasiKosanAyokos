@extends('layouts.app')

@section('title', 'Bayar Sewa - AyoKos')

@section('content')
    <div class="p-4 md:p-6 lg:p-8 max-w-7xl mx-auto">
        <div class="max-w-4xl mx-auto space-y-6">
            <!-- Breadcrumb -->
            <div class="bg-white border-2 border-black shadow-[2px_2px_0px_#000] p-4">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('penghuni.dashboard') }}"
                                class="inline-flex items-center text-sm font-black text-gray-600 hover:text-black font-black transition-colors">
                                <i class="fas fa-gauge mr-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="inline-flex items-center">
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-600 text-xs mx-2"></i>
                                <a href="{{ route('penghuni.pembayaran.index') }}"
                                    class="inline-flex items-center text-sm font-black text-gray-600 hover:text-black font-black transition-colors">
                                    <i class="fas fa-credit-card mr-2"></i>
                                    Riwayat Pembayaran
                                </a>
                            </div>
                        </li>
                        <li class="inline-flex items-center">
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-600 text-xs mx-2"></i>
                                <span class="ml-1 text-sm font-black text-black">
                                    <i class="fas fa-plus mr-2"></i>
                                    Buat Pembayaran
                                </span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Header -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-black text-black mb-2">Bayar Sewa Kos</h1>
                        <p class="text-gray-700 font-black">Bayar sewa bulanan atau bayar di muka untuk beberapa bulan</p>
                    </div>
                    <div
                        class="w-12 h-12 bg-gray-100 border-2 border-black  flex items-center justify-center">
                        <i class="fas fa-credit-card text-black text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Success/Error Messages from Session -->
            @if(session('success'))
                <div class="bg-emerald-400 border-2 border-black shadow-[3px_3px_0px_#000] text-black px-4 py-3 ">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-3 text-emerald-400"></i>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-400 border-2 border-black shadow-[3px_3px_0px_#000] text-black px-4 py-3 ">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-3 text-rose-400"></i>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            <!-- Info Kontrak -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h2 class="text-xl font-black text-black mb-4 flex items-center">
                    <i class="fas fa-file-contract text-sky-500 mr-3"></i>
                    Informasi Kontrak
                </h2>

                @if($kontrakAktif->count() > 1)
                    <div class="mb-6">
                        <label class="block text-sm font-black text-black mb-3">Pilih Kontrak *</label>
                        <div class="relative">
                            <i class="fas fa-home absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-600"></i>
                            <select id="kontrak-select" data-searchable
                                class="w-full pl-12 pr-10 py-3 bg-gray-100 border-2 border-black text-black  focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-500/30 appearance-none transition">
                                @foreach($kontrakAktif as $k)
                                    <option value="{{ $k->id_kontrak }}" data-harga="{{ $k->harga_sewa }}"
                                        data-mulai="{{ $k->tanggal_mulai ? $k->tanggal_mulai->format('d M Y') : '-' }}"
                                        data-selesai="{{ $k->tanggal_selesai ? $k->tanggal_selesai->format('d M Y') : '-' }}"
                                        data-pemilik="{{ $k->kos->pemilik->nama }}" data-kos="{{ $k->kos->nama_kos }}"
                                        data-kamar="{{ $k->kamar->nomor_kamar }}"
                                        data-grace-period="{{ $k->tanggal_selesai ? \Carbon\Carbon::parse($k->tanggal_selesai)->addDays(7)->format('d M Y') : '-' }}"
                                        data-nama-bank="{{ $k->kos->pemilik->nama_bank ?? 'Belum Diatur' }}"
                                        data-nomor-rekening="{{ $k->kos->pemilik->nomor_rekening ?? '-' }}"
                                        @if($k->id_kontrak == $selectedKontrak->id_kontrak) selected @endif>
                                        {{ $k->kos->nama_kos }} - Kamar {{ $k->kamar->nomor_kamar }}
                                    </option>
                                @endforeach
                            </select>
                            <i
                                class="fas fa-chevron-down absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-600 pointer-events-none"></i>
                        </div>
                    </div>
                @endif

                <div
                    class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm kontrak-info bg-gray-100 border-2 border-black p-4">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-building text-sky-500 w-5"></i>
                        <div>
                            <div class="text-gray-600 text-xs">Kos</div>
                            <div class="font-black text-black" id="info-kos">{{ $selectedKontrak->kos->nama_kos }}</div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-door-closed text-emerald-500 w-5"></i>
                        <div>
                            <div class="text-gray-600 text-xs">Kamar</div>
                            <div class="font-black text-black" id="info-kamar">{{ $selectedKontrak->kamar->nomor_kamar }}
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-tag text-amber-500 w-5"></i>
                        <div>
                            <div class="text-gray-600 text-xs">Harga Sewa</div>
                            <div class="font-black text-black">Rp <span
                                    id="info-harga">{{ number_format($selectedKontrak->harga_sewa, 0, ',', '.') }}</span>/{{ strtolower($unitLabel) }}
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-calendar-alt text-blue-500 w-5"></i>
                        <div>
                            <div class="text-gray-600 text-xs">Periode Kontrak</div>
                            <div class="font-black text-black" id="info-periode">
                                @if($selectedKontrak->tanggal_mulai && $selectedKontrak->tanggal_selesai)
                                    {{ \Carbon\Carbon::parse($selectedKontrak->tanggal_mulai)->format('d M Y') }} -
                                    {{ \Carbon\Carbon::parse($selectedKontrak->tanggal_selesai)->format('d M Y') }}
                                @else
                                    <span class="text-amber-400">Menunggu pembayaran pertama</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="md:col-span-2 flex items-center space-x-2 bg-yellow-100 border-2 border-black p-3 ">
                        <i class="fas fa-clock text-amber-500 w-5"></i>
                        <div>
                            <div class="text-gray-600 text-xs">Tenggat Pembayaran</div>
                            <div class="font-black text-amber-400" id="info-grace-period">
                                @if($selectedKontrak->tanggal_selesai)
                                    {{ \Carbon\Carbon::parse($selectedKontrak->tanggal_selesai)->addDays(7)->format('d M Y') }}
                                @else
                                    -
                                @endif
                            </div>
                            <div class="text-xs text-gray-600 mt-1">(7 hari setelah kontrak berakhir)</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Pembayaran -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h2 class="text-xl font-black text-black mb-6 flex items-center">
                    <i class="fas fa-money-check-alt text-emerald-500 mr-3"></i>
                    Formulir Pembayaran
                </h2>

                @if($errors->any())
                    <div class="bg-red-100 border-2 border-black text-black px-4 py-3  mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle mr-3 text-rose-400"></i>
                            <div>
                                @foreach($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('penghuni.pembayaran.store') }}" enctype="multipart/form-data"
                    id="paymentForm" data-ajax="true" data-ajax-action="/api/penghuni/pembayaran" data-redirect="{{ route('penghuni.pembayaran.index') }}" data-success-msg="Pembayaran berhasil dikirim!" data-confirm="Apakah Anda yakin data pembayaran sudah benar?" novalidate>
                    @csrf
                    <input type="hidden" id="id_kontrak" name="id_kontrak" value="{{ $selectedKontrak->id_kontrak }}">

                    <div class="space-y-6">

                        @if(isset($isFirstPayment) && $isFirstPayment)
                            <!-- Pembayaran Pertama: Fixed sesuai kontrak -->
                            <input type="hidden" name="jumlah_waktu" value="{{ $paymentOptions[0]['value'] ?? $selectedKontrak->durasi_sewa }}">

                            <div class="bg-emerald-400 border-2 border-black shadow-[2px_2px_0px_#000] p-5">
                                <h3 class="font-black text-black mb-4 flex items-center">
                                    <i class="fas fa-file-contract mr-2"></i>
                                    Pembayaran Pertama
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <p class="text-sm font-bold text-black">Periode Mulai</p>
                                        <p class="text-lg font-black text-black">
                                            {{ \Carbon\Carbon::parse($selectedKontrak->tanggal_mulai)->format('d M Y') }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-black">Periode Selesai</p>
                                        <p class="text-lg font-black text-black">
                                            {{ \Carbon\Carbon::parse($selectedKontrak->tanggal_selesai)->format('d M Y') }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-black">Total Pembayaran</p>
                                        <p class="text-lg font-black text-black">
                                            Rp {{ number_format($paymentOptions[0]['total'] ?? ($selectedKontrak->harga_sewa * $selectedKontrak->durasi_sewa), 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="mt-3 text-xs font-bold text-black bg-emerald-500 border-2 border-black p-2">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Pembayaran pertama sesuai durasi kontrak awal. Untuk perpanjangan, lakukan pembayaran berikutnya setelah periode ini berakhir.
                                </div>
                            </div>

                            <!-- Preview Masa Pembayaran (first payment - fixed) -->
                            <div id="masa-pembayaran-preview"
                                class="bg-yellow-400 border-2 border-black shadow-[2px_2px_0px_#000] p-4">
                                <h3 class="font-black text-black mb-3 flex items-center">
                                    <i class="fas fa-calendar-day mr-2"></i>
                                    Masa Pembayaran
                                </h3>
                                <div class="text-sm font-bold text-black grid grid-cols-2 gap-2">
                                    <div>
                                        <div class="text-xs font-black text-black">Mulai</div>
                                        <div id="preview-mulai" class="font-black text-black">
                                            {{ \Carbon\Carbon::parse($selectedKontrak->tanggal_mulai)->format('d M Y') }}
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-xs font-black text-black">Selesai</div>
                                        <div id="preview-selesai" class="font-black text-black">
                                            {{ \Carbon\Carbon::parse($selectedKontrak->tanggal_selesai)->format('d M Y') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Jumlah Waktu Pembayaran (Perpanjangan) -->
                            <div>
                                <label class="block text-sm font-black text-black mb-3">Bayar Berapa {{ $unitLabel }}?
                                    *</label>
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                    @foreach($paymentOptions as $option)
                                        <label
                                            class="flex items-center p-3 border-2 border-black  cursor-pointer hover:border-black bg-gray-100 transition-all duration-200 jumlah-bulan-option group">
                                            <input type="radio" name="jumlah_waktu" value="{{ $option['value'] }}"
                                                data-harga="{{ $option['total'] }}"
                                                data-max-date="{{ $option['max_date'] ? $option['max_date']->format('d M Y') : '' }}"
                                                class="mr-3 jumlah-bulan-radio" @if($loop->first) checked @endif>
                                            <div class="flex-1">
                                                <div class="font-black text-black text-sm">{{ $option['label'] }}</div>
                                                <div class="text-xs text-gray-600">Rp
                                                    {{ number_format($option['total'], 0, ',', '.') }}</div>
                                                @if($option['max_date'])
                                                    <div class="text-xs text-amber-400 mt-1 hidden md:block"
                                                        id="max-date-{{ $option['value'] }}">
                                                        <i class="fas fa-clock mr-1"></i>
                                                        Max: {{ $option['max_date']->format('d M Y') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div
                                                class="w-6 h-6  border-2 border-black group-hover:border-sky-500 flex items-center justify-center">
                                                <div class="w-3 h-3  bg-sky-500 hidden radio-checked"></div>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Preview Masa Pembayaran -->
                            <div id="masa-pembayaran-preview"
                                class="bg-yellow-100 border-2 border-black  p-4">
                                <h3 class="font-black text-black mb-3 flex items-center">
                                    <i class="fas fa-calendar-day mr-2"></i>
                                    Masa Pembayaran
                                </h3>
                                <div class="text-sm text-black grid grid-cols-2 gap-2">
                                    <div>
                                        <div class="text-xs font-bold">Mulai</div>
                                        <div id="preview-mulai">{{ $unitLabel == 'Hari' ? 'Hari berikutnya yang belum dibayar' : ($unitLabel == 'Minggu' ? 'Minggu berikutnya yang belum dibayar' : ($unitLabel == 'Tahun' ? 'Tahun berikutnya yang belum dibayar' : 'Bulan berikutnya yang belum dibayar')) }}</div>
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold">Selesai</div>
                                        <div id="preview-selesai" class="font-black">-</div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Total Pembayaran Summary -->
                        <div
                            class="bg-emerald-100 border-2 border-black  p-5">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-black font-bold mb-1">Harga/{{ $unitLabel }}:</p>
                                    <p id="harga-per-bulan" class="text-xl md:text-2xl font-black text-black">
                                        Rp {{ number_format($selectedKontrak->harga_sewa, 0, ',', '.') }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-black font-bold mb-1">Total Pembayaran:</p>
                                    <p id="total-bayar" class="text-xl md:text-2xl font-black text-black">Rp
                                        {{ number_format($selectedKontrak->harga_sewa, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Metode Pembayaran -->
                        <div>
                            <label class="block text-sm font-black text-black mb-3">Metode Pembayaran *</label>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                <label
                                    class="flex items-center p-3 border-2 border-black  cursor-pointer hover:border-sky-500 bg-gray-100 transition-all duration-200">
                                    <input type="radio" name="metode_pembayaran" value="transfer" class="mr-3" checked>
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-sky-400 border-2 border-black flex items-center justify-center">
                                            <i class="fas fa-university text-black"></i>
                                        </div>
                                        <span class="text-black">Transfer Bank</span>
                                    </div>
                                    <div
                                        class="ml-auto w-4 h-4  border-2 border-black flex items-center justify-center">
                                        <div class="w-2 h-2  bg-black radio-checked"></div>
                                    </div>
                                </label>
                                <label
                                    class="flex items-center p-3 border-2 border-black  cursor-pointer hover:border-emerald-500 bg-gray-100 transition-all duration-200">
                                    <input type="radio" name="metode_pembayaran" value="qris" class="mr-3">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-emerald-400 border-2 border-black flex items-center justify-center">
                                            <i class="fas fa-qrcode text-black"></i>
                                        </div>
                                        <span class="text-black">QRIS</span>
                                    </div>
                                    <div
                                        class="ml-auto w-4 h-4  border-2 border-black flex items-center justify-center">
                                        <div class="w-2 h-2  bg-emerald-500 hidden"></div>
                                    </div>
                                </label>
                                    </div>
                                @error('metode_pembayaran')
                                    <p class="text-rose-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                        <!-- Info Rekening -->
                        <div class="bg-emerald-100 border-2 border-black  p-5">
                            <h3 class="font-black text-black mb-3 flex items-center">
                                <i class="fas fa-info-circle mr-2"></i>
                                Informasi Transfer
                            </h3>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <div>
                                    <div class="text-xs font-bold mb-1 text-black">Bank</div>
                                    <div class="text-black font-black" id="info-nama-bank">
                                        {{ $selectedKontrak->kos->pemilik->nama_bank ?? 'Belum Diatur' }}</div>
                                </div>
                                <div>
                                    <div class="text-xs font-bold mb-1 text-black">No. Rekening</div>
                                    <div class="text-black font-black" id="info-nomor-rekening">
                                        {{ $selectedKontrak->kos->pemilik->nomor_rekening ?? '-' }}</div>
                                </div>
                                <div class="md:col-span-2">
                                    <div class="text-black text-xs mb-1 font-bold">Atas Nama</div>
                                    <div class="text-black font-black" id="info-pemilik">
                                        {{ $selectedKontrak->kos->pemilik->nama }}</div>
                                </div>
                            </div>
                            <div class="mt-3 text-xs text-black bg-emerald-400 border-2 border-black p-2 font-bold">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                Harap transfer sesuai jumlah dan tambahkan kode unik
                            </div>
                        </div>

                        <!-- Bukti Pembayaran -->
                        <div class="mt-6">
                            <label class="block text-sm font-black text-black mb-3">
                                Upload Bukti Pembayaran *
                                <span class="text-xs text-gray-600">(Format: JPG, PNG, maksimal 2MB)</span>
                            </label>
                            <div id="upload-area"
                                class="mt-1 border-2 border-dashed border-black  hover:border-black transition-all duration-200 cursor-pointer bg-gray-100 overflow-hidden @error('bukti_pembayaran') border-rose-500 focus:ring-rose-500/30 @enderror">
                                <div class="p-6 text-center">
                                    <div
                                        class="w-16 h-16 bg-sky-400 border-2 border-black flex items-center justify-center mx-auto mb-4">
                                        <i class="fas fa-cloud-upload-alt text-2xl text-black"></i>
                                    </div>
                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <label for="bukti_pembayaran"
                                            class="relative cursor-pointer bg-gray-100 px-4 py-2  font-black text-sky-500 hover:text-sky-400 transition">
                                            <span>Klik untuk upload file</span>
                                            <input id="bukti_pembayaran" name="bukti_pembayaran" type="file" class="sr-only"
                                                accept="image/jpeg,image/png,image/jpg" required>
                                        </label>
                                        <p class="pl-3 self-center">atau drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-600 mt-2">PNG, JPG, JPEG up to 2MB</p>
                                    <div id="file-name" class="text-sm mt-4"></div>
                                    <div id="file-error" class="text-sm text-rose-400 mt-2 hidden"></div>
                                    <div id="preview-container" class="mt-4"></div>
                                </div>
                            </div>
                            @error('bukti_pembayaran')
                                <p class="mt-2 text-sm text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Info Penting -->
                        <div class="bg-sky-100 border-2 border-black  p-5">
                            <h3 class="font-black text-black mb-3 flex items-center">
                                <i class="fas fa-info-circle mr-2"></i>
                                Informasi Pembayaran
                            </h3>
                            <ul class="space-y-2">
                                @if(isset($isFirstPayment) && $isFirstPayment)
                                <li class="flex items-start text-sm text-black">
                                    <i class="fas fa-file-contract text-black mr-3 mt-0.5"></i>
                                    <span>Pembayaran pertama sesuai durasi kontrak awal (<strong class="text-black">{{ $selectedKontrak->durasi_sewa }} {{ strtolower($unitLabel) }}</strong>)</span>
                                </li>
                                <li class="flex items-start text-sm text-black">
                                    <i class="fas fa-redo text-black mr-3 mt-0.5"></i>
                                    <span>Setelah periode ini berakhir, Anda bisa <strong class="text-black">memperpanjang</strong> dengan jumlah {{ strtolower($unitLabel) }} berapa pun</span>
                                </li>
                                @else
                                <li class="flex items-start text-sm text-black">
                                    <i class="fas fa-calendar text-black mr-3 mt-0.5"></i>
                                    <span>Anda dapat membayar maksimal <strong class="text-black">{{ $maxLimit }} {{ strtolower($unitLabel) }} ke
                                             depan</strong></span>
                                </li>
                                @endif
                                <li class="flex items-start text-sm text-black">
                                    <i class="fas fa-clock text-black mr-3 mt-0.5"></i>
                                    <span>Setelah kontrak berakhir, ada <strong class="text-black">grace period 7
                                             hari</strong> untuk membayar</span>
                                </li>
                                <li class="flex items-start text-sm text-black">
                                    <i class="fas fa-redo text-black mr-3 mt-0.5"></i>
                                    <span>Pembayaran advance akan <strong class="text-black">memperpanjang kontrak
                                             otomatis</strong></span>
                                </li>
                                <li class="flex items-start text-sm text-black">
                                    <i class="fas fa-times-circle text-black mr-3 mt-0.5"></i>
                                    <span>Setelah grace period, harus perpanjang kontrak untuk membayar lagi</span>
                                </li>
                                <li class="flex items-start text-sm text-black">
                                    <i class="fas fa-check-circle text-black mr-3 mt-0.5"></i>
                                    <span>Satu pembayaran = satu bukti transfer untuk multiple {{ strtolower($unitLabel) }}</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-8 flex flex-col sm:flex-row gap-4">
                            <a href="{{ route('penghuni.pembayaran.index') }}"
                                class="flex-1 bg-gray-100 border-2 border-black text-black px-6 py-3  hover:bg-black transition-all duration-200 font-black text-center">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Kembali
                            </a>
                            <button type="submit"
                                class="flex-1 bg-sky-400 border-2 border-black shadow-[2px_2px_0px_#000] hover:bg-sky-500 text-black px-6 py-3  transition-all duration-200 font-black">
                                <i class="fas fa-upload mr-2"></i>
                                Upload Bukti Bayar
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // ========================================
            // INISIALISASI ELEMEN DOM
            // ========================================

            // Kontrak dropdown
            const kontrakSelect = document.getElementById('kontrak-select');
            const idKontrakInput = document.getElementById('id_kontrak');

            // Info Kontrak Elements
            const infoKos = document.getElementById('info-kos');
            const infoKamar = document.getElementById('info-kamar');
            const infoHarga = document.getElementById('info-harga');
            const infoPeriode = document.getElementById('info-periode');
            const infoGrace = document.getElementById('info-grace-period');
            const infoPemilik = document.getElementById('info-pemilik');
            const infoNamaBank = document.getElementById('info-nama-bank');
            const infoNomorRekening = document.getElementById('info-nomor-rekening');

            // Pembayaran Elements
            const hargaPerBulanElement = document.getElementById('harga-per-bulan');
            const totalBayarElement = document.getElementById('total-bayar');
            const previewSelesai = document.getElementById('preview-selesai');
            const jumlahTimeInputs = document.querySelectorAll('input[name="jumlah_waktu"]');
            const unitLabel = "{{ $unitLabel ?? 'Bulan' }}";

            // File Upload Elements
            const fileInput = document.getElementById('bukti_pembayaran');
            const uploadArea = document.getElementById('upload-area');
            const fileNameDisplay = document.getElementById('file-name');
            const fileErrorDisplay = document.getElementById('file-error');
            const previewContainer = document.getElementById('preview-container');


            // ========================================
            // HELPER FUNCTIONS
            // ========================================

            /**
             * Format angka ke format Rupiah
             */
            function formatRupiah(angka) {
                return new Intl.NumberFormat('id-ID').format(angka);
            }

            /**
             * Mendapatkan harga kontrak yang sedang aktif/dipilih
             */
            function getCurrentHarga() {
                if (kontrakSelect) {
                    const selectedOption = kontrakSelect.options[kontrakSelect.selectedIndex];
                    return parseInt(selectedOption.getAttribute('data-harga'));
                }
                const hargaText = infoHarga.textContent.replace(/\./g, '');
                return parseInt(hargaText) || 0;
            }

            /**
             * Update radio button visual states
             */
            function updateRadioVisuals() {
                // Update jumlah bulan radio visuals
                document.querySelectorAll('.jumlah-bulan-option').forEach(option => {
                    const radio = option.querySelector('input[type="radio"]');
                    const checkIndicator = option.querySelector('.radio-checked');
                    if (radio && checkIndicator) {
                        if (radio.checked) {
                            option.classList.add('border-sky-500', 'bg-sky-500/10');
                            option.classList.remove('border-black');
                            checkIndicator.classList.remove('hidden');
                        } else {
                            option.classList.remove('border-sky-500', 'bg-sky-500/10');
                            option.classList.add('border-black');
                            checkIndicator.classList.add('hidden');
                        }
                    }
                });

                // Update metode pembayaran radio visuals
                document.querySelectorAll('input[name="metode_pembayaran"]').forEach(radio => {
                    const label = radio.closest('label');
                    const checkIndicator = label?.querySelector('.radio-checked');
                    if (checkIndicator) {
                        if (radio.checked) {
                            label.classList.add('border-sky-500');
                            checkIndicator.classList.remove('hidden');
                        } else {
                            label.classList.remove('border-sky-500');
                            checkIndicator.classList.add('hidden');
                        }
                    }
                });
            }


            // ========================================
            // FUNGSI UPDATE INFO KONTRAK
            // ========================================

            /**
             * Update semua informasi kontrak berdasarkan pilihan dropdown
             */
            function updateKontrakInfo() {
                if (!kontrakSelect) return;

                const selectedOption = kontrakSelect.options[kontrakSelect.selectedIndex];

                // Ambil data dari option yang dipilih
                const harga = parseInt(selectedOption.getAttribute('data-harga'));
                const kos = selectedOption.getAttribute('data-kos');
                const kamar = selectedOption.getAttribute('data-kamar');
                const mulai = selectedOption.getAttribute('data-mulai');
                const selesai = selectedOption.getAttribute('data-selesai');
                const pemilik = selectedOption.getAttribute('data-pemilik');
                const gracePeriod = selectedOption.getAttribute('data-grace-period');
                const namaBank = selectedOption.getAttribute('data-nama-bank');
                const nomorRekening = selectedOption.getAttribute('data-nomor-rekening');
                const kontrakId = selectedOption.value;

                // Update semua elemen info
                if (infoKos) infoKos.textContent = kos;
                if (infoKamar) infoKamar.textContent = kamar;
                if (infoHarga) infoHarga.textContent = formatRupiah(harga);
                if (infoPeriode) infoPeriode.textContent = `${mulai} - ${selesai}`;
                if (infoGrace) infoGrace.textContent = gracePeriod;
                if (infoPemilik) infoPemilik.textContent = pemilik;
                if (infoNamaBank) infoNamaBank.textContent = namaBank;
                if (infoNomorRekening) infoNomorRekening.textContent = nomorRekening;
                if (hargaPerBulanElement) hargaPerBulanElement.textContent = `Rp ${formatRupiah(harga)}`;
                if (idKontrakInput) idKontrakInput.value = kontrakId;

                // Update total pembayaran
                updateTotalBayar(harga);
            }


            // ========================================
            // FUNGSI UPDATE TOTAL BAYAR
            // ========================================

            /**
             * Update total bayar berdasarkan jumlah waktu yang dipilih
             */
            function updateTotalBayar(hargaPerUnit) {
                const selectedJumlah = document.querySelector('input[name="jumlah_waktu"]:checked');

                if (!selectedJumlah) {
                    return;
                }

                const jumlahWaktu = parseInt(selectedJumlah.value);
                const preCalcTotal = selectedJumlah.getAttribute('data-harga');
                const total = preCalcTotal ? parseInt(preCalcTotal) : (jumlahWaktu * hargaPerUnit);

                // Update tampilan total
                if (totalBayarElement) {
                    totalBayarElement.textContent = `Rp ${formatRupiah(total)}`;
                }

                // Update preview masa pembayaran
                if (previewSelesai) {
                     const maxDate = selectedJumlah.getAttribute('data-max-date');
                     if (maxDate) {
                         previewSelesai.innerHTML = `Sampai <span class="text-black">${maxDate}</span>`;
                     } else {
                         previewSelesai.textContent = `${jumlahWaktu} ${unitLabel} ke depan`;
                     }
                }

                updateRadioVisuals();
            }


            // ========================================
            // FUNGSI FILE UPLOAD PREVIEW
            // ========================================

            /**
             * Reset tampilan upload area
             */
            function resetUploadDisplay() {
                if (fileNameDisplay) {
                    fileNameDisplay.textContent = '';
                    fileNameDisplay.className = 'text-sm mt-4';
                }

                if (fileErrorDisplay) {
                    fileErrorDisplay.textContent = '';
                    fileErrorDisplay.classList.add('hidden');
                }

                if (uploadArea) {
                    uploadArea.classList.remove('border-sky-500', 'border-rose-500');
                    uploadArea.classList.add('border-black');
                }

                if (previewContainer) {
                    previewContainer.innerHTML = '';
                }
            }

            /**
             * Tampilkan error upload
             */
            function showUploadError(message) {
                if (fileErrorDisplay) {
                    fileErrorDisplay.innerHTML = `
                        <div class="flex items-center text-rose-400">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <span>${message}</span>
                        </div>
                    `;
                    fileErrorDisplay.classList.remove('hidden');
                }

                if (uploadArea) {
                    uploadArea.classList.add('border-rose-500');
                    uploadArea.classList.remove('border-black');
                }
            }

            /**
             * Tampilkan success upload dengan preview
             */
            function showUploadSuccess(file) {
                const fileName = file.name;
                const fileSize = (file.size / 1024 / 1024).toFixed(2);

                // Tampilkan nama file
                if (fileNameDisplay) {
                    fileNameDisplay.innerHTML = `
                        <div class="flex items-center text-emerald-400">
                            <i class="fas fa-check-circle mr-2"></i>
                            <span class="font-black">File berhasil dipilih</span>
                        </div>
                        <div class="text-sm text-gray-600 mt-1 ml-7">
                            ${fileName} (${fileSize} MB)
                        </div>
                    `;
                }

                // Update upload area styling
                if (uploadArea) {
                    uploadArea.classList.add('border-sky-500');
                    uploadArea.classList.remove('border-black');
                }

                // Buat preview gambar
                const reader = new FileReader();
                reader.onload = function (e) {
                    if (previewContainer) {
                        previewContainer.innerHTML = `
                            <div class="relative inline-block">
                                <img src="${e.target.result}" 
                                     class="max-w-full max-h-64  shadow-[2px_2px_0px_#000] border-2 border-black">
                                <div class="absolute top-2 right-2 bg-black   w-8 h-8 flex items-center justify-center">
                                    <i class="fas fa-image text-sky-500"></i>
                                </div>
                            </div>
                        `;
                    }
                };

                reader.readAsDataURL(file);
            }

            /**
             * Validasi file upload
             */
            function validateFile(file) {
                const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                const maxSize = 2 * 1024 * 1024; // 2MB

                // Validasi tipe file
                if (!allowedTypes.includes(file.type)) {
                    return {
                        valid: false,
                        error: 'Format file tidak didukung. Gunakan JPG, PNG, atau JPEG.'
                    };
                }

                // Validasi ukuran file
                if (file.size > maxSize) {
                    return {
                        valid: false,
                        error: 'Ukuran file melebihi 2MB. Silakan pilih file yang lebih kecil.'
                    };
                }

                return { valid: true };
            }

            /**
             * Handle file input change
             */
            function handleFileChange(e) {
                resetUploadDisplay();

                const files = e.target.files;

                if (!files || files.length === 0) {
                    return;
                }

                const file = files[0];

                // Validasi file
                const validation = validateFile(file);

                if (!validation.valid) {
                    showUploadError(validation.error);
                    e.target.value = '';
                    return;
                }

                // Tampilkan success dan preview
                showUploadSuccess(file);
            }


            // ========================================
            // DRAG & DROP FUNCTIONALITY
            // ========================================

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            function highlight(e) {
                if (uploadArea) {
                    uploadArea.classList.add('border-sky-500', 'bg-sky-500/10');
                }
            }

            function unhighlight(e) {
                if (uploadArea) {
                    uploadArea.classList.remove('border-sky-500', 'bg-sky-500/10');
                }
            }

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;

                if (files.length > 0 && fileInput) {
                    fileInput.files = files;
                    fileInput.dispatchEvent(new Event('change', { bubbles: true }));
                }
            }

            /**
             * Setup drag and drop
             */
            function setupDragAndDrop() {
                if (!uploadArea) return;

                // Prevent defaults
                ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                    uploadArea.addEventListener(eventName, preventDefaults, false);
                });

                // Highlight on drag
                ['dragenter', 'dragover'].forEach(eventName => {
                    uploadArea.addEventListener(eventName, highlight, false);
                });

                // Unhighlight on leave/drop
                ['dragleave', 'drop'].forEach(eventName => {
                    uploadArea.addEventListener(eventName, unhighlight, false);
                });

                // Handle drop
                uploadArea.addEventListener('drop', handleDrop, false);


            }


            // ========================================
            // EVENT LISTENERS
            // ========================================

            /**
             * Setup semua event listeners
             */
            function setupEventListeners() {
                // Dropdown kontrak
                if (kontrakSelect) {
                    kontrakSelect.addEventListener('change', function() {
                         window.location.href = '?id_kontrak=' + this.value;
                    });
                }

                // Radio button jumlah waktu
                jumlahTimeInputs.forEach(input => {
                    input.addEventListener('change', function () {
                        const harga = getCurrentHarga();
                        updateTotalBayar(harga);
                    });
                });

                // Radio button metode pembayaran
                document.querySelectorAll('input[name="metode_pembayaran"]').forEach(radio => {
                    radio.addEventListener('change', updateRadioVisuals);
                });

                // File input
                if (fileInput) {
                    fileInput.addEventListener('change', handleFileChange);
                }

                // Form submission validation
                const paymentForm = document.getElementById('paymentForm');
                if (paymentForm) {
                    paymentForm.addEventListener('submit', function (e) {
                        if (!fileInput || !fileInput.files || fileInput.files.length === 0) {
                            e.preventDefault();
                            showUploadError('Harap pilih file bukti pembayaran terlebih dahulu');
                            return false;
                        }

                        const file = fileInput.files[0];
                        const validation = validateFile(file);

                        if (!validation.valid) {
                            e.preventDefault();
                            showUploadError(validation.error);
                            return false;
                        }

                        // Show loading state
                        const submitBtn = paymentForm.querySelector('button[type="submit"]');
                        if (submitBtn) {
                            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Mengunggah...';
                            submitBtn.disabled = true;
                        }
                    });
                }

                // Drag and drop
                setupDragAndDrop();
            }


            // ========================================
            // INISIALISASI
            // ========================================

            /**
             * Inisialisasi aplikasi
             */
            function init() {
                // Setup event listeners
                setupEventListeners();

                // Update visual state pertama kali
                updateRadioVisuals();

                // Update info kontrak pertama kali (jika ada dropdown)
                if (kontrakSelect) {
                    updateKontrakInfo();
                } else {
                    // Jika tidak ada dropdown, update total bayar langsung
                    const harga = getCurrentHarga();
                    updateTotalBayar(harga);
                }
            }

            // Jalankan inisialisasi
            init();
        });
    </script>

@endsection
