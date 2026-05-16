@extends('layouts.app')

@section('title', 'Analisis Data Penghuni - AyoKos')

@section('content')
    <div class="p-4 md:p-6 lg:p-8 max-w-7xl mx-auto space-y-6">
        @if(session('success'))
            <div class="bg-emerald-400 border-2 border-black shadow-[3px_3px_0px_#000] text-emerald-300 px-4 py-3  mb-6">
                <div class="flex items-center"><i class="fas fa-check-circle mr-3"></i>{{ session('success') }}</div>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-400 border-2 border-black shadow-[3px_3px_0px_#000] text-rose-300 px-4 py-3  mb-6">
                <div class="flex items-center"><i class="fas fa-exclamation-circle mr-3"></i>{{ session('error') }}</div>
            </div>
        @endif
        <!-- Breadcrumb -->
        <div class="bg-white border-2 border-black shadow-[2px_2px_0px_#000] p-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('penghuni.dashboard') }}" class="inline-flex items-center text-sm font-black text-gray-600 hover:text-black transition-colors">
                            <i class="fas fa-gauge mr-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="inline-flex items-center">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-500 text-xs mx-2"></i>
                            <a href="{{ route('penghuni.analisis.index') }}" class="inline-flex items-center text-sm font-black text-black">
                                <i class="fas fa-chart-bar mr-2"></i>
                                Analisis Data Saya
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
                            <p class="text-gray-600">Analisis statistik dan visualisasi data properti Anda</p>
                        </div>
                    </div>
                </div>
                <div class="mt-4 md:mt-0 flex gap-3">
                    <a href="{{ route('penghuni.dashboard') }}"
                    class="inline-flex items-center px-4 py-2.5 bg-white border-2 border-black shadow-[2px_2px_0px_#000] text-black  hover:bg-gray-100 transition">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali ke Dashboard
                    </a>
                    <button id="exportPdfPenghuni"
                        class="inline-flex items-center px-4 py-2.5 bg-emerald-400 border-2 border-black shadow-[3px_3px_0px_#000] text-black  hover:bg-emerald-500/30 transition">
                        <i class="fas fa-file-pdf mr-2"></i>
                        Export PDF
                    </button>
                </div>
            </div>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-5">
                <div class="flex items-center">
                    <div class="p-3  bg-gray-100 border-2 border-black">
                        <i class="fas fa-file-contract text-black text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-black text-gray-600">Total Kontrak</h3>
                        <p class="text-2xl font-black text-black">{{ $statistikRingkasan['total_kontrak'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-5">
                <div class="flex items-center">
                    <div class="p-3  bg-gray-100 border-2 border-black">
                        <i class="fas fa-wallet text-black text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-black text-gray-600">Total Pengeluaran</h3>
                        <p class="text-2xl font-black text-black">
                            Rp {{ number_format($statistikRingkasan['total_pembayaran'], 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-5">
                <div class="flex items-center">
                    <div class="p-3  bg-gray-100 border-2 border-black">
                        <i class="fas fa-star text-black text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-black text-gray-600">Review Diberikan</h3>
                        <p class="text-2xl font-black text-black">{{ $statistikRingkasan['jumlah_review'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-5">
                <div class="flex items-center">
                    <div class="p-3  bg-gray-100 border-2 border-black">
                        <i class="fas fa-chart-line text-black text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-black text-gray-600">Rating Rata-rata</h3>
                        <p class="text-2xl font-black text-black">{{ number_format($statistikRingkasan['rata_rata_rating'], 1) }}/5</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Chart 1: Riwayat Pengeluaran 6 Bulan -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-black text-black flex items-center">
                        <i class="fas fa-wallet text-black mr-3"></i>
                        Riwayat Pengeluaran
                    </h2>
                    <span class="text-xs px-3 py-1  bg-emerald-50 text-emerald-600">
                        6 Bulan Terakhir
                    </span>
                </div>
                <div class="h-80">
                    <canvas id="pengeluaranChart"></canvas>
                </div>
                <div class="mt-4 p-3 bg-gray-100 border-2 border-black ">
                    <p class="text-sm text-gray-600 flex items-center">
                        <i class="fas fa-chart-bar text-emerald-400 mr-2"></i>
                        Total pengeluaran 6 bulan terakhir:
                        <span class="font-black text-emerald-400 ml-1">
                            Rp {{ number_format($pembayaranPerBulan->sum('total'), 0, ',', '.') }}
                        </span>
                    </p>
                </div>
            </div>

            <!-- Chart 2: Status Pembayaran -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h2 class="text-xl font-black text-black mb-6 flex items-center">
                    <i class="fas fa-credit-card text-black mr-3"></i>
                    Distribusi Status Pembayaran
                </h2>
                <div class="h-80">
                    <canvas id="statusPembayaranChart"></canvas>
                </div>
                <div class="mt-4 grid grid-cols-3 gap-2">
                    @foreach($statusPembayaran as $status)
                        <div class="text-center p-2 bg-gray-100 border-2 border-black ">
                            <div class="inline-block w-2 h-2  mb-1
                                @if($status->status_pembayaran == 'lunas') bg-emerald-500
                                @elseif($status->status_pembayaran == 'pending') bg-yellow-500
                                @elseif($status->status_pembayaran == 'terlambat') bg-rose-500
                                @else bg-gray-500 @endif">
                            </div>
                            <div class="text-xs font-black text-gray-600">
                                {{ ucfirst($status->status_pembayaran) }}
                            </div>
                            <div class="text-xs font-black text-black">
                                {{ $status->jumlah }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Row 2 -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Chart 3: Preferensi Jenis Kos -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h2 class="text-xl font-black text-black mb-6 flex items-center">
                    <i class="fas fa-home text-black mr-3"></i>
                    Preferensi Jenis Kos
                </h2>
                <div class="h-80">
                    <canvas id="jenisKosChart"></canvas>
                </div>
                @if($jenisKosDisewa->isNotEmpty())
                <div class="mt-4 p-3 bg-gray-100 border-2 border-black ">
                    <p class="text-sm text-gray-600 flex items-center">
                        <i class="fas fa-crown text-yellow-400 mr-2"></i>
                        Jenis kos favorit:
                        <span class="font-black text-emerald-400 ml-1">
                            {{ ucfirst($jenisKosDisewa->sortByDesc('jumlah_sewa')->first()->jenis_kos) }}
                        </span>
                        ({{ $jenisKosDisewa->sortByDesc('jumlah_sewa')->first()->jumlah_sewa }}x)
                    </p>
                </div>
                @endif
            </div>

            <!-- Chart 4: Distribusi Rating Review -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-black text-black flex items-center">
                        <i class="fas fa-star text-black mr-3"></i>
                        Distribusi Rating Review
                    </h2>
                    @if($statistikRingkasan['rata_rata_rating'] > 0)
                    <div class="flex items-center bg-yellow-50 px-3 py-1 ">
                        <span class="text-yellow-600 font-black mr-1">&#11088;</span>
                        <span class="text-sm font-black text-yellow-700">
                            {{ number_format($statistikRingkasan['rata_rata_rating'], 1) }}
                        </span>
                    </div>
                    @endif
                </div>
                <div class="h-80">
                    <canvas id="ratingChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Row 3: Tabel Data -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Tabel: Riwayat Kontrak -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h2 class="text-xl font-black text-black mb-6 flex items-center">
                    <i class="fas fa-history text-black mr-3"></i>
                    Riwayat Kontrak
                </h2>
                <div class="overflow-x-auto  border-2 border-black">
                    <table class="min-w-full divide-y divide-black">
                        <thead class="bg-gray-100 border-2 border-black">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-black text-gray-600 uppercase tracking-wider">Kos</th>
                                <th class="px-4 py-3 text-left text-xs font-black text-gray-600 uppercase tracking-wider">Durasi</th>
                                <th class="px-4 py-3 text-left text-xs font-black text-gray-600 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-black">
                            @foreach($riwayatKontrak->take(5) as $kontrak)
                                <tr class="hover:bg-gray-100 transition">
                                    <td class="px-4 py-3">
                                        <div class="text-sm font-black text-black">{{ $kontrak->kos->nama_kos }}</div>
                                        <div class="text-xs text-gray-600">Kamar {{ $kontrak->kamar->nomor_kamar }}</div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="text-sm text-black">{{ $kontrak->durasi_sewa }} {{ $kontrak->unit_label_lower }}</div>
                                        <div class="text-xs text-gray-600">
                                            {{ \Carbon\Carbon::parse($kontrak->tanggal_mulai)->format('d M Y') }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 text-xs 
                                            {{ $kontrak->status_kontrak == 'aktif' ? 'bg-emerald-50 text-emerald-600' :
                                               ($kontrak->status_kontrak == 'selesai' ? 'bg-blue-50 text-blue-600' :
                                               ($kontrak->status_kontrak == 'pending' ? 'bg-yellow-50 text-yellow-600' :
                                               'bg-rose-50 text-rose-600')) }}">
                                            {{ ucfirst($kontrak->status_kontrak) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if($riwayatKontrak->count() > 5)
                <div class="text-center pt-4 border-t border-black mt-4">
                    <a href="{{ route('penghuni.kontrak.index') }}"
                       class="inline-flex items-center text-emerald-400 hover:text-emerald-300 text-sm font-black">
                        Lihat semua {{ $riwayatKontrak->count() }} kontrak
                        <i class="fas fa-arrow-right ml-1 transition-transform group-hover:translate-x-1"></i>
                    </a>
                </div>
                @endif
            </div>

            <!-- Tabel: Preferensi Tipe Kamar -->
            <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
                <h2 class="text-xl font-black text-black mb-6 flex items-center">
                    <i class="fas fa-bed text-black mr-3"></i>
                    Preferensi Tipe Kamar
                </h2>
                <div class="overflow-x-auto  border-2 border-black">
                    <table class="min-w-full divide-y divide-black">
                        <thead class="bg-gray-100 border-2 border-black">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-black text-gray-600 uppercase tracking-wider">Tipe Kamar</th>
                                <th class="px-4 py-3 text-left text-xs font-black text-gray-600 uppercase tracking-wider">Jumlah Sewa</th>
                                <th class="px-4 py-3 text-left text-xs font-black text-gray-600 uppercase tracking-wider">Harga Rata-rata</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-black">
                            @foreach($tipeKamarDisewa as $tipe)
                                <tr class="hover:bg-gray-100 transition">
                                    <td class="px-4 py-3">
                                        <div class="text-sm font-black text-black">{{ $tipe->tipe_kamar }}</div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="text-sm text-black">{{ $tipe->jumlah_sewa }} kali</div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="text-sm font-black text-emerald-400">
                                            Rp {{ number_format($tipe->rata_rata_harga, 0, ',', '.') }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Insight Section -->
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
            <h2 class="text-xl font-black text-black mb-6 flex items-center">
                <i class="fas fa-lightbulb text-yellow-400 mr-3"></i>
                Insight untuk Anda
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @php
                    $kosFavorit = $jenisKosDisewa->sortByDesc('jumlah_sewa')->first();
                    $tipeFavorit = $tipeKamarDisewa->sortByDesc('jumlah_sewa')->first();
                    $rataPengeluaran = $pembayaranPerBulan->avg('total') ?? 0;
                @endphp

                <div class="bg-white border-2 border-black shadow-[2px_2px_0px_#000] p-4">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10  bg-gray-100 border-2 border-black flex items-center justify-center mr-3">
                            <i class="fas fa-crown text-yellow-400"></i>
                        </div>
                        <h3 class="font-black text-black">Jenis Kos Favorit</h3>
                    </div>
                    <p class="text-sm text-gray-600">
                        Anda paling sering menyewa kos
                        <span class="font-black text-emerald-400">{{ $kosFavorit->jenis_kos ?? '-' }}</span>
                        sebanyak {{ $kosFavorit->jumlah_sewa ?? 0 }} kali.
                    </p>
                </div>

                <div class="bg-white border-2 border-black shadow-[2px_2px_0px_#000] p-4">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10  bg-gray-100 border-2 border-black flex items-center justify-center mr-3">
                            <i class="fas fa-chart-line text-black"></i>
                        </div>
                        <h3 class="font-black text-black">Pengeluaran Rata-rata</h3>
                    </div>
                    <p class="text-sm text-gray-600">
                        Rata-rata pengeluaran per bulan:
                        <span class="font-black text-emerald-400">
                            Rp {{ number_format($rataPengeluaran, 0, ',', '.') }}
                        </span>
                    </p>
                </div>

                <div class="bg-white border-2 border-black shadow-[2px_2px_0px_#000] p-4">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10  bg-gray-100 border-2 border-black flex items-center justify-center mr-3">
                            <i class="fas fa-bed text-purple-400"></i>
                        </div>
                        <h3 class="font-black text-black">Preferensi Kamar</h3>
                    </div>
                    <p class="text-sm text-gray-600">
                        Tipe kamar favorit:
                        <span class="font-black text-emerald-400">{{ $tipeFavorit->tipe_kamar ?? '-' }}</span>
                        dengan harga rata-rata
                        <span class="font-black text-emerald-400">
                            Rp {{ number_format($tipeFavorit->rata_rata_harga ?? 0, 0, ',', '.') }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof Chart === 'undefined') return;
        Chart.defaults.color = '#94a3b8';
        Chart.defaults.borderColor = 'rgba(255,255,255,0.2)';
        Chart.defaults.backgroundColor = 'rgba(255,255,255,0.05)';

        var pengData = @json($pembayaranPerBulan);
        var spData = @json($statusPembayaran);
        var jkData = @json($jenisKosDisewa);
        var rvData = @json($reviewStats);

        if (document.getElementById('pengeluaranChart')) {
            new Chart(document.getElementById('pengeluaranChart').getContext('2d'), {
                type: 'line', data: {
                    labels: pengData.map(function(i) { var p = i.bulan.split('-'); var m = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des']; return m[parseInt(p[1])-1]; }),
                    datasets: [{ label: 'Pengeluaran', data: pengData.map(function(i) { return i.total; }), borderColor: 'rgb(239,68,68)', backgroundColor: 'rgba(239,68,68,0.1)', fill: true, tension: 0.4, borderWidth: 2, pointBackgroundColor: 'rgb(239,68,68)', pointBorderColor: '#fff', pointBorderWidth: 2, pointRadius: 4 }]
                },
                options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { callback: function(v) { return 'Rp '+v.toLocaleString('id-ID'); } } }, x: { grid: { color: 'rgba(255,255,255,0.05)' } } }, plugins: { legend: { labels: { color: '#e2e8f0', font: { size: 12 } } }, tooltip: { backgroundColor: 'rgba(30,41,59,0.9)', titleColor: '#e2e8f0', bodyColor: '#cbd5e1', borderColor: '#334155', borderWidth: 1, callbacks: { label: function(ctx) { return 'Rp '+ctx.parsed.y.toLocaleString('id-ID'); } } } } }
            });
        }

        if (document.getElementById('statusPembayaranChart')) {
            new Chart(document.getElementById('statusPembayaranChart').getContext('2d'), {
                type: 'doughnut', data: {
                    labels: spData.map(function(i) { return i.status_pembayaran.charAt(0).toUpperCase() + i.status_pembayaran.slice(1); }),
                    datasets: [{ data: spData.map(function(i) { return i.jumlah; }), backgroundColor: ['rgba(34,197,94,0.8)', 'rgba(59,130,246,0.8)', 'rgba(234,179,8,0.8)', 'rgba(239,68,68,0.8)'] }]
                },
                options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { color: '#e2e8f0', padding: 12, font: { size: 11 } } } } }
            });
        }

        if (document.getElementById('jenisKosChart')) {
            new Chart(document.getElementById('jenisKosChart').getContext('2d'), {
                type: 'bar', data: {
                    labels: jkData.map(function(i) { return i.jenis_kos.charAt(0).toUpperCase() + i.jenis_kos.slice(1); }),
                    datasets: [{ label: 'Jumlah', data: jkData.map(function(i) { return i.jumlah_sewa; }), backgroundColor: ['rgba(59,130,246,0.7)', 'rgba(236,72,153,0.7)', 'rgba(168,85,247,0.7)'], borderRadius: 6 }]
                },
                options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { stepSize: 1 } }, x: { grid: { display: false } } }, plugins: { legend: { display: false } } }
            });
        }

        if (document.getElementById('ratingChart')) {
            new Chart(document.getElementById('ratingChart').getContext('2d'), {
                type: 'bar', data: {
                    labels: rvData.map(function(i) { return i.rating_bulat + ' Bintang'; }),
                    datasets: [{ label: 'Jumlah', data: rvData.map(function(i) { return i.jumlah; }), backgroundColor: ['rgba(239,68,68,0.7)', 'rgba(251,146,60,0.7)', 'rgba(234,179,8,0.7)', 'rgba(34,197,94,0.7)', 'rgba(59,130,246,0.7)'], borderRadius: 6 }]
                },
                options: { indexAxis: 'y', responsive: true, maintainAspectRatio: false, scales: { x: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { stepSize: 1 } }, y: { grid: { display: false } } }, plugins: { legend: { display: false } } }
            });
        }
    });
    </script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

    <div id="penghuniData"
         data-nama="{{ auth()->user()->nama ?? 'Penghuni' }}"
         style="display: none;">
    </div>

    @include('penghuni.analisis.pdf-export')
@endsection
