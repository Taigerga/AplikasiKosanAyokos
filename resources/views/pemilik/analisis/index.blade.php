@extends('layouts.app')

@section('title', 'Analisis Data - AyoKos')

@section('content')
<div class="max-w-7xl mx-auto p-4 md:p-6 lg:p-8 space-y-6">
    @if(session('success'))
        <div class="bg-emerald-400 border-2 border-black text-black font-bold px-4 py-3 shadow-[3px_3px_0px_#000] mb-6">
            <div class="flex items-center"><i class="fas fa-check-circle mr-3"></i>{{ session('success') }}</div>
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-400 border-2 border-black text-black font-bold px-4 py-3 shadow-[3px_3px_0px_#000] mb-6">
            <div class="flex items-center"><i class="fas fa-exclamation-circle mr-3"></i>{{ session('error') }}</div>
        </div>
    @endif
    <!-- Breadcrumb -->
    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('pemilik.dashboard') }}" class="inline-flex items-center text-sm font-bold text-gray-600 hover:text-black transition-colors">
                        <i class="fas fa-home mr-2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="inline-flex items-center">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                        <a href="{{ route('pemilik.analisis.index') }}" class="inline-flex items-center text-sm font-bold text-black">
                            <i class="fas fa-chart-bar mr-2"></i>
                            Analisis Data
                        </a>
                    </div>
                </li>
            </ol>
        </nav>
    </div>  
    <!-- Header -->
    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between">
            <div>
                <div class="flex items-center space-x-3 mb-3">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-black text-black">
                        <i class="fas fa-chart-bar text-black mr-3"></i>    
                        Analisis Data Kosan</h1>
                        <p class="text-gray-700">Analisis statistik dan visualisasi data properti Anda</p>
                    </div>
                </div>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('pemilik.dashboard') }}" 
                   class="inline-flex items-center px-4 py-2.5 bg-white text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Dashboard
                </a>
                <button id="exportPdfBtn" 
                    class="inline-flex items-center px-4 py-2.5 bg-sky-400 hover:bg-sky-500 text-black font-black border-2 border-black shadow-[2px_2px_0px_#000] hover:shadow-[3px_3px_0px_#000] transition uppercase tracking-wide text-sm">
                    <i class="fas fa-file-pdf mr-2"></i>
                    Export PDF
                </button>
            </div>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Total Pendapatan -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex items-center">
                <div class="p-3 bg-gray-200 border-2 border-black mr-4">
                    <i class="fas fa-wallet text-black text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-black mb-1">Total Pendapatan Tahun Ini</p>
                     <p class="text-2xl font-black text-black" data-total-pendapatan>
                         Rp {{ number_format($pendapatanPerKosFull->sum('total_pendapatan'), 0, ',', '.') }}
                     </p>
                </div>
            </div>
        </div>

        <!-- Total Penghuni -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex items-center">
                <div class="p-3 bg-gray-200 border-2 border-black mr-4">
                    <i class="fas fa-users text-black text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-black mb-1">Total Penghuni Aktif</p>
                     <p class="text-2xl font-black text-black" data-total-penghuni>
                         {{ $penghuniPerKosFull->sum('jumlah_penghuni') }}
                     </p>
                </div>
            </div>
        </div>

        <!-- Okupansi -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex items-center">
                <div class="p-3 bg-gray-200 border-2 border-black mr-4">
                    <i class="fas fa-chart-line text-black text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-black mb-1">Rata-rata Okupansi</p>
                    <p class="text-2xl font-black text-black" data-rata-rata-okupansi>
                        @php
                            $terisi = $statusKamar->where('status_kamar', 'terisi')->first()->jumlah ?? 0;
                            $total = $statusKamar->sum('jumlah') ?: 1;
                            $okupansi = ($terisi / $total) * 100;
                        @endphp
                        {{ number_format($okupansi, 1) }}%
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Chart 1: Pendapatan 6 Bulan Terakhir -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-black text-black flex items-center">
                    <i class="fas fa-money-bill-wave text-sky-600 mr-3"></i>
                    Trend Pendapatan (12 Bulan)
                </h2>
                <span class="text-xs px-3 py-1 bg-black text-white font-black border-2 border-black">
                    {{ date('Y') }}
                </span>
            </div>
            <div class="h-72">
                <canvas id="pendapatanChart"></canvas>
            </div>
        </div>

        <!-- Chart 2: Status Kamar -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-black text-black flex items-center">
                    <i class="fas fa-bed text-emerald-600 mr-3"></i>
                    Distribusi Status Kamar
                </h2>
                <span class="text-xs px-3 py-1 bg-black text-white font-black border-2 border-black">
                    {{ $statusKamar->sum('jumlah') }} Kamar
                </span>
            </div>
            <div class="h-72">
                <canvas id="statusKamarChart"></canvas>
            </div>
            <!-- Legend -->
            <div class="grid grid-cols-3 gap-3 mt-4">
                @foreach($statusKamar as $status)
                    <div class="flex items-center">
                        <div class="w-3 h-3 mr-2 border-2 border-black
                            @if($status->status_kamar == 'tersedia') bg-green-500
                            @elseif($status->status_kamar == 'terisi') bg-blue-500
                            @else bg-yellow-500 @endif">
                        </div>
                        <span class="text-sm text-gray-600">
                            {{ ucfirst($status->status_kamar) }}
                        </span>
                        <span class="ml-auto text-sm font-bold text-black">
                            {{ $status->jumlah }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Row 2 -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Chart 3: Jenis Kos -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-black text-black flex items-center">
                    <i class="fas fa-home text-blue-600 mr-3"></i>
                    Distribusi Jenis Kos
                </h2>
                <span class="text-xs px-3 py-1 bg-black text-white font-black border-2 border-black">
                    {{ $jenisKos->sum('jumlah') }} Kos
                </span>
            </div>
            <div class="h-72">
                <canvas id="jenisKosChart"></canvas>
            </div>
        </div>

        <!-- Chart 4: Status Kontrak -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-black text-black flex items-center">
                    <i class="fas fa-file-contract text-purple-600 mr-3"></i>
                    Status Kontrak
                </h2>
                <span class="text-xs px-3 py-1 bg-black text-white font-black border-2 border-black">
                    {{ $statusKontrak->sum('jumlah') }} Kontrak
                </span>
            </div>
            <div class="h-72">
                <canvas id="statusKontrakChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Row 3: Additional Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Chart 5: Review/Rating -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-black text-black flex items-center">
                    <i class="fas fa-star text-yellow-600 mr-3"></i>
                    Distribusi Rating
                </h2>
                <span class="text-xs px-3 py-1 bg-black text-white font-black border-2 border-black">
                    {{ $reviewData->sum('jumlah') }} Review
                </span>
            </div>
            <div class="h-72">
                <canvas id="reviewChart"></canvas>
            </div>
        </div>

        <!-- Chart 6: Tipe Kamar -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-black text-black flex items-center">
                    <i class="fas fa-door-open text-cyan-600 mr-3"></i>
                    Distribusi Tipe Kamar
                </h2>
                <span class="text-xs px-3 py-1 bg-black text-white font-black border-2 border-black">
                    {{ $tipeKamar->sum('jumlah') }} Kamar
                </span>
            </div>
            <div class="h-72">
                <canvas id="tipeKamarChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Row 4: Tabel Data -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Tabel: Pendapatan per Kos -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-black text-black flex items-center">
                    <i class="fas fa-trophy text-yellow-600 mr-3"></i>
                    Pendapatan per Kos
                </h2>
                <span class="text-xs px-3 py-1 bg-black text-white font-black border-2 border-black">
                    Tahun {{ date('Y') }}
                </span>
            </div>
            
            <div class="space-y-4">
                @foreach($pendapatanPerKos as $kos)
                    <div class="bg-gray-100 border-2 border-black p-4 hover:border-yellow-400 transition">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-sky-400 border-2 border-black flex items-center justify-center mr-3">
                                    <i class="fas fa-home text-black"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-black">{{ $kos->nama_kos }}</h3>
                                    <p class="text-xs text-gray-600">Kos terbaik</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-black text-emerald-600">
                                    Rp {{ number_format($kos->total_pendapatan, 0, ',', '.') }}
                                </p>
                                 <div class="w-32 h-1 bg-gray-200 border-2 border-black overflow-hidden mt-1">
                                      <div class="h-full bg-emerald-500"
                                           style="width: {{ ($pendapatanPerKosFull->max('total_pendapatan') > 0 ? ($kos->total_pendapatan / $pendapatanPerKosFull->max('total_pendapatan')) * 100 : 0) }}%">
                                      </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                
                 @if($pendapatanPerKos->isEmpty())
                     <div class="text-center py-8">
                         <div class="w-16 h-16 bg-gray-200 border-2 border-black shadow-[2px_2px_0px_#000] flex items-center justify-center mx-auto mb-4">
                             <i class="fas fa-chart-line text-gray-700 text-2xl"></i>
                         </div>
                         <p class="text-gray-600">Belum ada data pendapatan</p>
                     </div>
                 @endif

                 @if($pendapatanPerKos->hasPages())
                 <div class="px-6 py-4 border-t-2 border-black">
                     <div class="flex items-center justify-between">
                         <div class="text-sm text-gray-700">
                             Menampilkan {{ $pendapatanPerKos->firstItem() }} - {{ $pendapatanPerKos->lastItem() }} dari {{ $pendapatanPerKos->total() }} kos
                         </div>
                         <div class="flex space-x-2">
                             {{ $pendapatanPerKos->links('vendor.pagination.custom-dark') }}
                         </div>
                     </div>
                 </div>
                 @endif
             </div>
         </div>

        <!-- Tabel: Penghuni per Kos -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-black text-black flex items-center">
                    <i class="fas fa-user-friends text-blue-600 mr-3"></i>
                    Penghuni per Kos
                </h2>
                <span class="text-xs px-3 py-1 bg-black text-white font-black border-2 border-black">
                    Penghuni Aktif
                </span>
            </div>
            
            <div class="space-y-4">
                @foreach($penghuniPerKos as $kos)
                    <div class="bg-gray-100 border-2 border-black p-4 hover:border-yellow-400 transition">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-blue-400 border-2 border-black flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-black"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-black">{{ $kos->nama_kos }}</h3>
                                    <p class="text-xs text-gray-600">{{ $kos->jumlah_penghuni }} penghuni</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="flex items-center justify-end">
                                     <div class="w-24 h-6 bg-gray-200 border-2 border-black overflow-hidden mr-3">
                                          <div class="h-full bg-blue-500"
                                               style="width: {{ ($penghuniPerKosFull->max('jumlah_penghuni') > 0 ? ($kos->jumlah_penghuni / $penghuniPerKosFull->max('jumlah_penghuni')) * 100 : 0) }}%">
                                          </div>
                                     </div>
                                    <span class="text-lg font-black text-black">
                                        {{ $kos->jumlah_penghuni }}
                                    </span>
                                </div>
                                 <p class="text-xs text-gray-600 mt-1">
                                     {{ round(($kos->jumlah_penghuni / ($penghuniPerKosFull->sum('jumlah_penghuni') ?: 1)) * 100, 1) }}% dari total
                                 </p>
                            </div>
                        </div>
                    </div>
                @endforeach
                
                 @if($penghuniPerKos->isEmpty())
                     <div class="text-center py-8">
                         <div class="w-16 h-16 bg-gray-200 border-2 border-black shadow-[2px_2px_0px_#000] flex items-center justify-center mx-auto mb-4">
                             <i class="fas fa-users text-gray-700 text-2xl"></i>
                         </div>
                         <p class="text-gray-600">Belum ada data penghuni</p>
                     </div>
                 @endif

                 @if($penghuniPerKos->hasPages())
                 <div class="px-6 py-4 border-t-2 border-black">
                     <div class="flex items-center justify-between">
                         <div class="text-sm text-gray-700">
                             Menampilkan {{ $penghuniPerKos->firstItem() }} - {{ $penghuniPerKos->lastItem() }} dari {{ $penghuniPerKos->total() }} kos
                         </div>
                         <div class="flex space-x-2">
                             {{ $penghuniPerKos->links('vendor.pagination.custom-dark') }}
                         </div>
                     </div>
                 </div>
                 @endif
             </div>
          </div>
      </div>

        <!-- Insight Section -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <h2 class="text-xl font-black text-black mb-6 flex items-center">
                <i class="fas fa-lightbulb text-yellow-600 mr-3"></i>
                Insight Bisnis Anda
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @php
                    $kosTerbaik = $pendapatanPerKosFull->sortByDesc('total_pendapatan')->first();
                    $kosPalingBanyakPenghuni = $penghuniPerKosFull->sortByDesc('jumlah_penghuni')->first();
                    $rataPendapatan = $pendapatanPerKosFull->avg('total_pendapatan') ?? 0;
                    $persentaseTerisi = ($statusKamar->where('status_kamar', 'terisi')->sum('jumlah') / ($statusKamar->sum('jumlah') ?: 1)) * 100;
                @endphp
                
                <!-- Insight 1: Kos Terbaik -->
                <div class="bg-gray-100 border-2 border-black p-4">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10 bg-yellow-400 border-2 border-black flex items-center justify-center mr-3">
                            <i class="fas fa-trophy text-black"></i>
                        </div>
                        <h3 class="font-black text-black">Kos Terbaik</h3>
                    </div>
                    <p class="text-sm text-gray-600">
                        Kos 
                        <span class="font-black text-black">{{ $kosTerbaik->nama_kos ?? '-' }}</span> 
                        menghasilkan pendapatan tertinggi sebesar 
                        <span class="font-black text-black">
                            Rp {{ number_format($kosTerbaik->total_pendapatan ?? 0, 0, ',', '.') }}
                        </span>
                    </p>
                </div>

                <!-- Insight 2: Okupansi Tinggi -->
                <div class="bg-gray-100 border-2 border-black p-4">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10 bg-emerald-400 border-2 border-black flex items-center justify-center mr-3">
                            <i class="fas fa-chart-line text-black"></i>
                        </div>
                        <h3 class="font-black text-black">Tingkat Okupansi</h3>
                    </div>
                    <p class="text-sm text-gray-600">
                        Okupansi saat ini: 
                        <span class="font-black text-black">{{ number_format($persentaseTerisi, 1) }}%</span>
                        dari total kamar, dengan 
                        <span class="font-black text-black">
                            {{ $statusKamar->where('status_kamar', 'terisi')->sum('jumlah') }}
                        </span> kamar terisi.
                    </p>
                </div>

                <!-- Insight 3: Potensi Pengembangan -->
                <div class="bg-gray-100 border-2 border-black p-4">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10 bg-purple-400 border-2 border-black flex items-center justify-center mr-3">
                            <i class="fas fa-users text-black"></i>
                        </div>
                        <h3 class="font-black text-black">Penghuni Terbanyak</h3>
                    </div>
                    <p class="text-sm text-gray-600">
                        Kos 
                        <span class="font-black text-black">{{ $kosPalingBanyakPenghuni->nama_kos ?? '-' }}</span> 
                        memiliki penghuni terbanyak: 
                        <span class="font-black text-black">{{ $kosPalingBanyakPenghuni->jumlah_penghuni ?? 0 }} orang</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    if (typeof window.initAnalisisCharts === 'function') {
        window.initAnalisisCharts({
            pendapatanPerBulan: @json($pendapatanPerBulan),
            statusKamar: @json($statusKamar),
            jenisKos: @json($jenisKos),
            statusKontrak: @json($statusKontrak),
            reviewData: @json($reviewData),
            tipeKamar: @json($tipeKamar),
        });
    }
});
</script>



<!-- Include library PDF dan script export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<div id="pemilikData" 
     data-nama="{{ auth()->user()->nama ?? 'Pemilik' }}"
     data-tanggal="{{ now()->format('d F Y') }}"
     style="display: none;">
</div>
@endsection