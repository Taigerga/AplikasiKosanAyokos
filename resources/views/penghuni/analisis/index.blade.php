@extends('layouts.app')

@section('title', 'Analisis Data Penghuni - AyoKos')

@section('content')
    <div class="p-4 md:p-6 lg:p-8 max-w-7xl mx-auto space-y-6">
        <!-- Breadcrumb -->
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-xl p-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('penghuni.dashboard') }}" class="inline-flex items-center text-sm font-medium text-white/60 hover:text-white transition-colors">
                            <i class="fas fa-gauge mr-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="inline-flex items-center">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-white/40 text-xs mx-2"></i>
                            <a href="{{ route('penghuni.analisis.index') }}" class="inline-flex items-center text-sm font-medium text-white">
                                <i class="fas fa-chart-bar mr-2"></i>
                                Analisis Data Saya
                            </a>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Header -->
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between">
                <div>
                    <div class="flex items-center space-x-3 mb-3">
                        <div>
                            <h1 class="text-2xl md:text-3xl font-bold text-white">
                            <i class="fas fa-chart-bar text-white mr-3"></i>
                            Analisis Data Kosan</h1>
                            <p class="text-white/60">Analisis statistik dan visualisasi data properti Anda</p>
                        </div>
                    </div>
                </div>
                <div class="mt-4 md:mt-0 flex gap-3">
                    <a href="{{ route('penghuni.dashboard') }}"
                    class="inline-flex items-center px-4 py-2.5 bg-white/5 backdrop-blur-sm border border-white/20 text-white rounded-xl hover:bg-white/10 transition">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali ke Dashboard
                    </a>
                    <button id="exportPdfPenghuni"
                        class="inline-flex items-center px-4 py-2.5 bg-emerald-500/20 backdrop-blur-sm border border-emerald-500/20 text-white rounded-xl hover:bg-emerald-500/30 transition">
                        <i class="fas fa-file-pdf mr-2"></i>
                        Export PDF
                    </button>
                </div>
            </div>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-5">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-white/5 backdrop-blur-sm">
                        <i class="fas fa-file-contract text-white text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-white/60">Total Kontrak</h3>
                        <p class="text-2xl font-bold text-white">{{ $statistikRingkasan['total_kontrak'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-5">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-white/5 backdrop-blur-sm">
                        <i class="fas fa-wallet text-white text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-white/60">Total Pengeluaran</h3>
                        <p class="text-2xl font-bold text-white">
                            Rp {{ number_format($statistikRingkasan['total_pembayaran'], 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-5">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-white/5 backdrop-blur-sm">
                        <i class="fas fa-star text-white text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-white/60">Review Diberikan</h3>
                        <p class="text-2xl font-bold text-white">{{ $statistikRingkasan['jumlah_review'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-5">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-white/5 backdrop-blur-sm">
                        <i class="fas fa-chart-line text-white text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-white/60">Rating Rata-rata</h3>
                        <p class="text-2xl font-bold text-white">{{ number_format($statistikRingkasan['rata_rata_rating'], 1) }}/5</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Chart 1: Riwayat Pengeluaran 6 Bulan -->
            <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-wallet text-white mr-3"></i>
                        Riwayat Pengeluaran
                    </h2>
                    <span class="text-xs px-3 py-1 rounded-full bg-emerald-50 text-emerald-600">
                        6 Bulan Terakhir
                    </span>
                </div>
                <div class="h-80">
                    <canvas id="pengeluaranChart"></canvas>
                </div>
                <div class="mt-4 p-3 bg-white/5 backdrop-blur-sm rounded-xl">
                    <p class="text-sm text-white/60 flex items-center">
                        <i class="fas fa-chart-bar text-emerald-400 mr-2"></i>
                        Total pengeluaran 6 bulan terakhir:
                        <span class="font-bold text-emerald-400 ml-1">
                            Rp {{ number_format($pembayaranPerBulan->sum('total'), 0, ',', '.') }}
                        </span>
                    </p>
                </div>
            </div>

            <!-- Chart 2: Status Pembayaran -->
            <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
                <h2 class="text-xl font-bold text-white mb-6 flex items-center">
                    <i class="fas fa-credit-card text-white mr-3"></i>
                    Distribusi Status Pembayaran
                </h2>
                <div class="h-80">
                    <canvas id="statusPembayaranChart"></canvas>
                </div>
                <div class="mt-4 grid grid-cols-3 gap-2">
                    @foreach($statusPembayaran as $status)
                        <div class="text-center p-2 bg-white/5 backdrop-blur-sm rounded-lg">
                            <div class="inline-block w-2 h-2 rounded-full mb-1
                                @if($status->status_pembayaran == 'lunas') bg-emerald-500
                                @elseif($status->status_pembayaran == 'pending') bg-yellow-500
                                @elseif($status->status_pembayaran == 'terlambat') bg-red-500
                                @else bg-gray-500 @endif">
                            </div>
                            <div class="text-xs font-medium text-white/60">
                                {{ ucfirst($status->status_pembayaran) }}
                            </div>
                            <div class="text-xs font-bold text-white">
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
            <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
                <h2 class="text-xl font-bold text-white mb-6 flex items-center">
                    <i class="fas fa-home text-white mr-3"></i>
                    Preferensi Jenis Kos
                </h2>
                <div class="h-80">
                    <canvas id="jenisKosChart"></canvas>
                </div>
                @if($jenisKosDisewa->isNotEmpty())
                <div class="mt-4 p-3 bg-white/5 backdrop-blur-sm rounded-xl">
                    <p class="text-sm text-white/60 flex items-center">
                        <i class="fas fa-crown text-yellow-400 mr-2"></i>
                        Jenis kos favorit:
                        <span class="font-bold text-emerald-400 ml-1">
                            {{ ucfirst($jenisKosDisewa->sortByDesc('jumlah_sewa')->first()->jenis_kos) }}
                        </span>
                        ({{ $jenisKosDisewa->sortByDesc('jumlah_sewa')->first()->jumlah_sewa }}x)
                    </p>
                </div>
                @endif
            </div>

            <!-- Chart 4: Distribusi Rating Review -->
            <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-star text-white mr-3"></i>
                        Distribusi Rating Review
                    </h2>
                    @if($statistikRingkasan['rata_rata_rating'] > 0)
                    <div class="flex items-center bg-yellow-50 px-3 py-1 rounded-full">
                        <span class="text-yellow-600 font-bold mr-1">&#11088;</span>
                        <span class="text-sm font-bold text-yellow-700">
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
            <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
                <h2 class="text-xl font-bold text-white mb-6 flex items-center">
                    <i class="fas fa-history text-white mr-3"></i>
                    Riwayat Kontrak
                </h2>
                <div class="overflow-x-auto rounded-xl border border-white/20">
                    <table class="min-w-full divide-y divide-white/20">
                        <thead class="bg-white/5 backdrop-blur-sm">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-white/60 uppercase tracking-wider">Kos</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-white/60 uppercase tracking-wider">Durasi</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-white/60 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/20">
                            @foreach($riwayatKontrak->take(5) as $kontrak)
                                <tr class="hover:bg-white/5 transition">
                                    <td class="px-4 py-3">
                                        <div class="text-sm font-medium text-white">{{ $kontrak->kos->nama_kos }}</div>
                                        <div class="text-xs text-white/60">Kamar {{ $kontrak->kamar->nomor_kamar }}</div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="text-sm text-white">{{ $kontrak->durasi_sewa }} {{ $kontrak->unit_label_lower }}</div>
                                        <div class="text-xs text-white/60">
                                            {{ \Carbon\Carbon::parse($kontrak->tanggal_mulai)->format('d M Y') }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 text-xs rounded-full
                                            {{ $kontrak->status_kontrak == 'aktif' ? 'bg-emerald-50 text-emerald-600' :
                                               ($kontrak->status_kontrak == 'selesai' ? 'bg-blue-50 text-blue-600' :
                                               ($kontrak->status_kontrak == 'pending' ? 'bg-yellow-50 text-yellow-600' :
                                               'bg-red-50 text-red-600')) }}">
                                            {{ ucfirst($kontrak->status_kontrak) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if($riwayatKontrak->count() > 5)
                <div class="text-center pt-4 border-t border-white/20 mt-4">
                    <a href="{{ route('penghuni.kontrak.index') }}"
                       class="inline-flex items-center text-emerald-400 hover:text-emerald-300 text-sm font-medium">
                        Lihat semua {{ $riwayatKontrak->count() }} kontrak
                        <i class="fas fa-arrow-right ml-1 transition-transform group-hover:translate-x-1"></i>
                    </a>
                </div>
                @endif
            </div>

            <!-- Tabel: Preferensi Tipe Kamar -->
            <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
                <h2 class="text-xl font-bold text-white mb-6 flex items-center">
                    <i class="fas fa-bed text-white mr-3"></i>
                    Preferensi Tipe Kamar
                </h2>
                <div class="overflow-x-auto rounded-xl border border-white/20">
                    <table class="min-w-full divide-y divide-white/20">
                        <thead class="bg-white/5 backdrop-blur-sm">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-white/60 uppercase tracking-wider">Tipe Kamar</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-white/60 uppercase tracking-wider">Jumlah Sewa</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-white/60 uppercase tracking-wider">Harga Rata-rata</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/20">
                            @foreach($tipeKamarDisewa as $tipe)
                                <tr class="hover:bg-white/5 transition">
                                    <td class="px-4 py-3">
                                        <div class="text-sm font-medium text-white">{{ $tipe->tipe_kamar }}</div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="text-sm text-white">{{ $tipe->jumlah_sewa }} kali</div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="text-sm font-bold text-emerald-400">
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
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
            <h2 class="text-xl font-bold text-white mb-6 flex items-center">
                <i class="fas fa-lightbulb text-yellow-400 mr-3"></i>
                Insight untuk Anda
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @php
                    $kosFavorit = $jenisKosDisewa->sortByDesc('jumlah_sewa')->first();
                    $tipeFavorit = $tipeKamarDisewa->sortByDesc('jumlah_sewa')->first();
                    $rataPengeluaran = $pembayaranPerBulan->avg('total') ?? 0;
                @endphp

                <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-xl p-4">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10 rounded-lg bg-white/5 backdrop-blur-sm flex items-center justify-center mr-3">
                            <i class="fas fa-crown text-yellow-400"></i>
                        </div>
                        <h3 class="font-semibold text-white">Jenis Kos Favorit</h3>
                    </div>
                    <p class="text-sm text-white/60">
                        Anda paling sering menyewa kos
                        <span class="font-bold text-emerald-400">{{ $kosFavorit->jenis_kos ?? '-' }}</span>
                        sebanyak {{ $kosFavorit->jumlah_sewa ?? 0 }} kali.
                    </p>
                </div>

                <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-xl p-4">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10 rounded-lg bg-white/5 backdrop-blur-sm flex items-center justify-center mr-3">
                            <i class="fas fa-chart-line text-white"></i>
                        </div>
                        <h3 class="font-semibold text-white">Pengeluaran Rata-rata</h3>
                    </div>
                    <p class="text-sm text-white/60">
                        Rata-rata pengeluaran per bulan:
                        <span class="font-bold text-emerald-400">
                            Rp {{ number_format($rataPengeluaran, 0, ',', '.') }}
                        </span>
                    </p>
                </div>

                <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-xl p-4">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10 rounded-lg bg-white/5 backdrop-blur-sm flex items-center justify-center mr-3">
                            <i class="fas fa-bed text-purple-400"></i>
                        </div>
                        <h3 class="font-semibold text-white">Preferensi Kamar</h3>
                    </div>
                    <p class="text-sm text-white/60">
                        Tipe kamar favorit:
                        <span class="font-bold text-emerald-400">{{ $tipeFavorit->tipe_kamar ?? '-' }}</span>
                        dengan harga rata-rata
                        <span class="font-bold text-emerald-400">
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
        document.addEventListener('DOMContentLoaded', function() {
            Chart.defaults.color = '#94a3b8';
            Chart.defaults.borderColor = 'rgba(255, 255, 255, 0.2)';
            Chart.defaults.backgroundColor = 'rgba(255, 255, 255, 0.05)';

            const pengeluaranData = @json($pembayaranPerBulan);
            const statusPembayaranData = @json($statusPembayaran);
            const jenisKosData = @json($jenisKosDisewa);
            const reviewData = @json($reviewStats);
            const durasiData = @json($durasiTinggal);
            const tipeKamarData = @json($tipeKamarDisewa);

            function formatBulanLabel(dateString) {
                const [year, month] = dateString.split('-');
                const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                                   'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                return `${monthNames[parseInt(month)-1]} ${year}`;
            }

            if (document.getElementById('pengeluaranChart')) {
                const pengeluaranCtx = document.getElementById('pengeluaranChart').getContext('2d');
                new Chart(pengeluaranCtx, {
                    type: 'line',
                    data: {
                        labels: pengeluaranData.map(item => formatBulanLabel(item.bulan)),
                        datasets: [{
                            label: 'Total Pengeluaran',
                            data: pengeluaranData.map(item => item.total),
                            borderColor: '#10b981',
                            backgroundColor: 'rgba(16, 185, 129, 0.1)',
                            fill: true,
                            tension: 0.4,
                            borderWidth: 3,
                            pointBackgroundColor: '#10b981',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 5,
                            pointHoverRadius: 7
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                labels: {
                                    color: '#e2e8f0',
                                    font: {
                                        size: 12
                                    }
                                }
                            },
                            tooltip: {
                                backgroundColor: 'rgba(255, 255, 255, 0.1)',
                                titleColor: '#e2e8f0',
                                bodyColor: '#94a3b8',
                                borderColor: 'rgba(255, 255, 255, 0.2)',
                                borderWidth: 1,
                                callbacks: {
                                    label: function(context) {
                                        return 'Pengeluaran: Rp ' + context.parsed.y.toLocaleString('id-ID');
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    color: 'rgba(255, 255, 255, 0.1)'
                                },
                                ticks: {
                                    color: '#94a3b8'
                                }
                            },
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(255, 255, 255, 0.1)'
                                },
                                ticks: {
                                    color: '#94a3b8',
                                    callback: function(value) {
                                        if (value >= 1000000) return 'Rp ' + (value / 1000000).toFixed(1) + ' jt';
                                        if (value >= 1000) return 'Rp ' + (value / 1000).toFixed(0) + ' rb';
                                        return 'Rp ' + value;
                                    }
                                }
                            }
                        }
                    }
                });
            }

            if (document.getElementById('statusPembayaranChart')) {
                const statusPembayaranCtx = document.getElementById('statusPembayaranChart').getContext('2d');
                new Chart(statusPembayaranCtx, {
                    type: 'doughnut',
                    data: {
                        labels: statusPembayaranData.map(item => ucFirst(item.status_pembayaran)),
                        datasets: [{
                            data: statusPembayaranData.map(item => item.jumlah),
                            backgroundColor: [
                                'rgba(16, 185, 129, 0.8)',
                                'rgba(245, 158, 11, 0.8)',
                                'rgba(239, 68, 68, 0.8)',
                                'rgba(107, 114, 128, 0.8)'
                            ],
                            borderColor: 'rgba(255, 255, 255, 0.1)',
                            borderWidth: 2,
                            hoverBorderWidth: 3
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    color: '#e2e8f0',
                                    font: {
                                        size: 11
                                    },
                                    boxWidth: 12,
                                    padding: 15
                                }
                            },
                            tooltip: {
                                backgroundColor: 'rgba(255, 255, 255, 0.1)',
                                titleColor: '#e2e8f0',
                                bodyColor: '#94a3b8',
                                borderColor: 'rgba(255, 255, 255, 0.2)',
                                borderWidth: 1,
                                callbacks: {
                                    label: function(context) {
                                        const label = context.label || '';
                                        const value = context.raw || 0;
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = Math.round((value / total) * 100);
                                        return `${label}: ${value} transaksi (${percentage}%)`;
                                    }
                                }
                            }
                        }
                    }
                });
            }

            if (document.getElementById('jenisKosChart')) {
                const jenisKosCtx = document.getElementById('jenisKosChart').getContext('2d');
                new Chart(jenisKosCtx, {
                    type: 'bar',
                    data: {
                        labels: jenisKosData.map(item => {
                            const jenis = item.jenis_kos;
                            return jenis === 'putra' ? 'Putra' :
                                   jenis === 'putri' ? 'Putri' : 'Campuran';
                        }),
                        datasets: [{
                            label: 'Jumlah Sewa',
                            data: jenisKosData.map(item => item.jumlah_sewa),
                            backgroundColor: 'rgba(139, 92, 246, 0.7)',
                            borderColor: 'rgb(139, 92, 246)',
                            borderWidth: 2,
                            borderRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                labels: {
                                    color: '#e2e8f0'
                                }
                            },
                            tooltip: {
                                backgroundColor: 'rgba(255, 255, 255, 0.1)',
                                titleColor: '#e2e8f0',
                                bodyColor: '#94a3b8',
                                borderColor: 'rgba(255, 255, 255, 0.2)',
                                borderWidth: 1
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    color: 'rgba(255, 255, 255, 0.1)',
                                    drawBorder: false
                                },
                                ticks: {
                                    color: '#94a3b8'
                                }
                            },
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(255, 255, 255, 0.1)',
                                    drawBorder: false
                                },
                                ticks: {
                                    color: '#94a3b8',
                                    stepSize: 1
                                }
                            }
                        }
                    }
                });
            }

            if (document.getElementById('ratingChart')) {
                const ratingCtx = document.getElementById('ratingChart').getContext('2d');

                const ratingMap = {};
                for (let i = 1; i <= 5; i++) {
                    ratingMap[i] = 0;
                }

                if (reviewData && reviewData.length > 0) {
                    reviewData.forEach(item => {
                        ratingMap[item.rating_bulat] = item.jumlah;
                    });
                }

                new Chart(ratingCtx, {
                    type: 'bar',
                    data: {
                        labels: ['\u2605', '\u2605\u2605', '\u2605\u2605\u2605', '\u2605\u2605\u2605\u2605', '\u2605\u2605\u2605\u2605\u2605'],
                        datasets: [{
                            label: 'Jumlah Review',
                            data: [ratingMap[1], ratingMap[2], ratingMap[3], ratingMap[4], ratingMap[5]],
                            backgroundColor: [
                                'rgba(239, 68, 68, 0.7)',
                                'rgba(245, 158, 11, 0.7)',
                                'rgba(234, 179, 8, 0.7)',
                                'rgba(34, 197, 94, 0.7)',
                                'rgba(34, 197, 94, 0.9)'
                            ],
                            borderColor: [
                                'rgb(239, 68, 68)',
                                'rgb(245, 158, 11)',
                                'rgb(234, 179, 8)',
                                'rgb(34, 197, 94)',
                                'rgb(34, 197, 94)'
                            ],
                            borderWidth: 1,
                            borderRadius: 4
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: 'rgba(255, 255, 255, 0.1)',
                                titleColor: '#e2e8f0',
                                bodyColor: '#94a3b8',
                                borderColor: 'rgba(255, 255, 255, 0.2)',
                                borderWidth: 1
                            }
                        },
                        scales: {
                            x: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(255, 255, 255, 0.1)',
                                    drawBorder: false
                                },
                                ticks: {
                                    color: '#94a3b8',
                                    stepSize: 1
                                }
                            },
                            y: {
                                grid: {
                                    color: 'rgba(255, 255, 255, 0.1)',
                                    drawBorder: false
                                },
                                ticks: {
                                    color: '#94a3b8'
                                }
                            }
                        }
                    }
                });
            }

            function ucFirst(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }
        });
    </script>

    <style>
        .chart-container {
            position: relative;
        }

        .overflow-x-auto::-webkit-scrollbar {
            height: 6px;
        }

        .overflow-x-auto::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 3px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        tbody tr {
            transition: background-color 0.2s ease;
        }

        tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
        }

        .grid > div:hover {
            transform: translateY(-3px);
            transition: transform 0.3s ease;
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

    <div id="penghuniData"
         data-nama="{{ auth()->user()->nama ?? 'Penghuni' }}"
         style="display: none;">
    </div>

    @include('penghuni.analisis.pdf-export')
@endsection
