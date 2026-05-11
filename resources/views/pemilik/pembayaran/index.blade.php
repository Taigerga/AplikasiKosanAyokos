@extends('layouts.app')

@section('title', 'Kelola Pembayaran - AyoKos')

@section('content')
    <div class="max-w-7xl mx-auto p-4 md:p-6 lg:p-8 space-y-6">
        <!-- Breadcrumb -->
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-4">
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
                            <a href="{{ route('pemilik.pembayaran.index') }}" class="inline-flex items-center text-sm font-medium text-white">
                                <i class="fas fa-credit-card mr-2"></i>
                                Kelola Pembayaran
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
                    <h1 class="text-2xl md:text-3xl font-bold text-white mb-2 flex items-center">
                        <i class="fas fa-credit-card mr-3"></i>
                        Kelola Pembayaran
                    </h1>
                    <p class="text-slate-100">Kelola semua pembayaran sewa kos Anda di satu tempat.</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <span class="inline-flex items-center px-4 py-2 rounded-lg bg-white/5 backdrop-blur-sm border border-white/20 text-white">
                        <i class="fas fa-chart-bar mr-2 text-sky-400"></i>
                        Total: {{ $statistics['total'] }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Success Notification -->
        @if(session('success'))
            <div class="bg-white/5 backdrop-blur-sm border border-white/20 text-slate-100 px-4 py-3 rounded-xl">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-3 text-sky-400"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Lunas Card -->
            <div class="card-hover bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 rounded-lg bg-white/5 backdrop-blur-sm">
                        <i class="fas fa-check-circle text-white text-xl"></i>
                    </div>
                    <span class="text-sm font-medium px-2 py-1 rounded-full bg-white/5 backdrop-blur-sm text-white">
                        {{ $statistics['lunas'] > 0 ? '+'.$statistics['lunas'] : '0' }}
                    </span>
                </div>
                <h3 class="text-2xl font-bold text-white mb-1">{{ $statistics['lunas'] }}</h3>
                <p class="text-sm text-slate-100">Total Lunas</p>
            </div>

            <!-- Pending Card -->
            <div class="card-hover bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 rounded-lg bg-white/5 backdrop-blur-sm">
                        <i class="fas fa-clock text-white text-xl"></i>
                    </div>
                    <span class="text-sm font-medium px-2 py-1 rounded-full bg-white/5 backdrop-blur-sm text-white">
                        {{ $statistics['pending'] > 0 ? '+'.$statistics['pending'] : '0' }}
                    </span>
                </div>
                <h3 class="text-2xl font-bold text-white mb-1">{{ $statistics['pending'] }}</h3>
                <p class="text-sm text-slate-100">Pending</p>
            </div>

            <!-- Terlambat Card -->
            <div class="card-hover bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 rounded-lg bg-white/5 backdrop-blur-sm">
                        <i class="fas fa-exclamation-triangle text-white text-xl"></i>
                    </div>
                    <span class="text-sm font-medium px-2 py-1 rounded-full bg-white/5 backdrop-blur-sm text-white">
                        {{ $statistics['terlambat'] > 0 ? '+'.$statistics['terlambat'] : '0' }}
                    </span>
                </div>
                <h3 class="text-2xl font-bold text-white mb-1">{{ $statistics['terlambat'] }}</h3>
                <p class="text-sm text-slate-100">Terlambat</p>
            </div>

            <!-- Belum Bayar Card -->
            <div class="card-hover bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 rounded-lg bg-white/5 backdrop-blur-sm">
                        <i class="fas fa-calendar-times text-white text-xl"></i>
                    </div>
                    <span class="text-sm font-medium px-2 py-1 rounded-full bg-white/5 backdrop-blur-sm text-white">
                        {{ $statistics['belum'] > 0 ? '+'.$statistics['belum'] : '0' }}
                    </span>
                </div>
                <h3 class="text-2xl font-bold text-white mb-1">{{ $statistics['belum'] }}</h3>
                <p class="text-sm text-slate-100">Belum Bayar</p>
            </div>
        </div>

        <!-- Pembayaran Table -->
        <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl overflow-hidden">
            <!-- Table Header -->
            <div class="border-b border-white/20 px-6 py-4">
                <h2 class="text-lg font-semibold text-white flex items-center">
                    <i class="fas fa-list mr-3 text-sky-400"></i>
                    Daftar Pembayaran
                </h2>
            </div>
            
            <!-- Table Content -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-white/20">
                    <thead class="bg-white/5">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-100 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-user mr-2"></i>
                                    Penghuni & Kos
                                </div>
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-100 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    Periode
                                </div>
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-100 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-money-bill-wave mr-2"></i>
                                    Jumlah
                                </div>
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-100 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    Status
                                </div>
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-100 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-clock mr-2"></i>
                                    Tanggal Bayar
                                </div>
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-100 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class="fas fa-cogs mr-2"></i>
                                    Aksi
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/20">
                        @forelse($pembayaran as $item)
                        <tr class="hover:bg-white/5 transition-colors duration-200">
                            <!-- Penghuni & Kos -->
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-sky-500/20 backdrop-blur-sm border border-sky-500/20 flex items-center justify-center mr-3">
                                        <i class="fas fa-user text-sky-400"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-white">
                                            {{ $item->penghuni->nama }}
                                        </div>
                                        <div class="text-xs text-slate-100">
                                            {{ $item->kontrak->kos->nama_kos }} - Kamar {{ $item->kontrak->kamar->nomor_kamar ?? 'N/A' }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Periode -->
                            <td class="px-6 py-4">
                                <div class="text-sm text-white">{{ $item->bulan_tahun }}</div>
                                <div class="text-xs text-slate-100">
                                    <i class="fas fa-calendar-day mr-1"></i>
                                    Jatuh tempo: {{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d M Y') }}
                                </div>
                            </td>
                            
                            <!-- Jumlah -->
                            <td class="px-6 py-4">
                                <div class="text-sm font-bold text-white">
                                    Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                </div>
                            </td>
                            
                            <!-- Status -->
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                    {{ $item->status_pembayaran == 'lunas' ? 'bg-emerald-500/20 backdrop-blur-sm text-emerald-300 border border-emerald-500/20' : 
                                       ($item->status_pembayaran == 'pending' ? 'bg-yellow-500/20 backdrop-blur-sm text-yellow-300 border border-yellow-500/20' : 
                                       ($item->status_pembayaran == 'terlambat' ? 'bg-red-500/20 backdrop-blur-sm text-red-300 border border-red-500/20' : 
                                       'bg-slate-500/20 backdrop-blur-sm text-slate-300 border border-slate-500/20')) }}">
                                    <i class="fas 
                                        {{ $item->status_pembayaran == 'lunas' ? 'fa-check-circle' : 
                                           ($item->status_pembayaran == 'pending' ? 'fa-clock' : 
                                           ($item->status_pembayaran == 'terlambat' ? 'fa-exclamation-triangle' : 'fa-question-circle')) }} 
                                        mr-1"></i>
                                    {{ ucfirst($item->status_pembayaran) }}
                                </span>
                            </td>
                            
                            <!-- Tanggal Bayar -->
                            <td class="px-6 py-4">
                                @if($item->tanggal_bayar)
                                    <div class="text-sm text-white">
                                        <i class="fas fa-calendar-check mr-1 text-emerald-400"></i>
                                        {{ \Carbon\Carbon::parse($item->tanggal_bayar)->format('d M Y') }}
                                    </div>
                                    <div class="text-xs text-slate-100">
                                        {{ \Carbon\Carbon::parse($item->tanggal_bayar)->format('H:i') }}
                                    </div>
                                @else
                                    <span class="text-sm text-slate-100">
                                        <i class="fas fa-calendar-times mr-1"></i>
                                        Belum dibayar
                                    </span>
                                @endif
                            </td>
                            
                            <!-- Aksi -->
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-2">
                                    @if($item->bukti_pembayaran)
                                        <button onclick="showBuktiModal('{{ asset('storage/' . $item->bukti_pembayaran) }}')"
                                                class="p-2 text-sky-400 hover:text-sky-300 hover:bg-white/10 rounded-lg transition"
                                                title="Lihat Bukti Pembayaran">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    @endif
                                    
                                    @if($item->status_pembayaran == 'pending')
                                        <button type="button" 
                                                onclick="showApproveModal('{{ route('pemilik.pembayaran.approve', $item->id_pembayaran) }}')"
                                                class="p-2 text-emerald-400 hover:text-emerald-300 hover:bg-white/10 rounded-lg transition"
                                                title="Verifikasi Pembayaran">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        
                                        <button type="button" 
                                                onclick="showRejectModal('{{ route('pemilik.pembayaran.reject', $item->id_pembayaran) }}')"
                                                class="p-2 text-red-400 hover:text-red-300 hover:bg-white/10 rounded-lg transition"
                                                title="Tolak Pembayaran">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center">
                                <div class="text-center py-8">
                                    <div class="w-16 h-16 bg-white/5 backdrop-blur-sm border border-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i class="fas fa-credit-card text-sky-400 text-2xl"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-white mb-2">Belum ada data pembayaran</h3>
                                    <p class="text-slate-100">Tidak ada pembayaran yang perlu dikelola saat ini</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-white/20">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-slate-100">
                        Menampilkan {{ $pembayaran->firstItem() }} - {{ $pembayaran->lastItem() }} dari {{ $pembayaran->total() }} pembayaran
                    </div>
                    <div class="flex space-x-2">
                        {{ $pembayaran->links('vendor.pagination.custom-dark') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Back to Dashboard -->
        <div class="flex justify-center">
            <a href="{{ route('pemilik.dashboard') }}" 
               class="inline-flex items-center px-5 py-2.5 bg-white/5 backdrop-blur-sm border border-white/20 text-white rounded-xl hover:bg-white/10 transition-all duration-300 group">
                <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
                Kembali ke Dashboard
            </a>
        </div>
    </div>

    <!-- Bukti Pembayaran Modal -->
    <div id="buktiModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border border-slate-200 w-11/12 md:w-3/4 lg:w-1/2 shadow-2xl rounded-2xl bg-white">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold text-slate-800 flex items-center">
                    <i class="fas fa-receipt mr-2 text-sky-500"></i>
                    Bukti Pembayaran
                </h3>
                <button onclick="closeBuktiModal()" 
                        class="text-slate-500 hover:text-slate-700 transition">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="flex justify-center mb-6">
                <div class="bg-slate-100 border border-slate-200 rounded-xl p-4 max-w-2xl mx-auto">
                    <img id="buktiImage" src="" alt="Bukti Pembayaran" 
                         class="max-w-full h-auto rounded-lg shadow-lg">
                </div>
            </div>
            <div class="flex justify-center space-x-3">
                <a id="downloadBukti" href="#" target="_blank"
                   class="px-4 py-2 bg-sky-500/20 backdrop-blur-sm border border-sky-500/20 hover:bg-sky-500/10 text-sky-700 rounded-lg transition">
                    <i class="fas fa-download mr-2"></i>
                    Unduh
                </a>
                <button onclick="closeBuktiModal()" 
                        class="px-4 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition">
                    <i class="fas fa-times mr-2"></i>
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- Approve Confirmation Modal -->
    <div id="approveModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" onclick="closeApproveModal()"></div>
        <div class="relative bg-white border-slate-200 rounded-2xl w-full max-w-md overflow-hidden shadow-2xl">
            <div class="p-6 text-center">
                <div class="mb-4 inline-block">
                    <div class="w-16 h-16 rounded-full bg-emerald-100 flex items-center justify-center mx-auto">
                        <i class="fas fa-check-circle text-emerald-600 text-2xl"></i>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-2">Verifikasi Pembayaran</h3>
                <p class="text-slate-500 mb-6">Apakah Anda yakin ingin memverifikasi pembayaran ini sebagai lunas?</p>
                
                <div class="flex justify-center gap-3">
                    <button type="button" onclick="closeApproveModal()" 
                            class="px-5 py-2.5 bg-slate-100 text-slate-700 rounded-xl hover:bg-slate-200 transition">
                        Batal
                    </button>
                    <form id="approveForm" method="POST" action="">
                        @csrf
                        <button type="submit" 
                                class="px-5 py-2.5 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-xl hover:from-emerald-600 hover:to-emerald-700 transition shadow-lg">
                            Ya, Verifikasi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Confirmation Modal -->
    <div id="rejectModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" onclick="closeRejectModal()"></div>
        <div class="relative bg-white border-slate-200 rounded-2xl w-full max-w-md overflow-hidden shadow-2xl">
            <div class="p-6 text-center">
                <div class="mb-4 inline-block">
                    <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center mx-auto">
                        <i class="fas fa-times-circle text-red-500 text-2xl"></i>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-2">Tolak Pembayaran</h3>
                <p class="text-slate-500 mb-6">Tolak pembayaran ini? Penghuni akan diminta untuk mengunggah ulang bukti pembayaran yang valid.</p>
                
                <div class="flex justify-center gap-3">
                    <button type="button" onclick="closeRejectModal()" 
                            class="px-5 py-2.5 bg-slate-100 text-slate-700 rounded-xl hover:bg-slate-200 transition">
                        Batal
                    </button>
                    <form id="rejectForm" method="POST" action="">
                        @csrf
                        <button type="submit" 
                                class="px-5 py-2.5 bg-gradient-to-r from-red-500 to-rose-600 text-white rounded-xl hover:from-red-600 hover:to-rose-700 transition shadow-lg">
                            Ya, Tolak
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Bukti modal functionality
        function showBuktiModal(imageSrc) {
            const imageElement = document.getElementById('buktiImage');
            const downloadLink = document.getElementById('downloadBukti');
            
            imageElement.src = imageSrc;
            downloadLink.href = imageSrc;
            document.getElementById('buktiModal').classList.remove('hidden');
        }

        function closeBuktiModal() {
            document.getElementById('buktiModal').classList.add('hidden');
        }

        // Approve modal functions
        function showApproveModal(action) {
            document.getElementById('approveForm').action = action;
            document.getElementById('approveModal').classList.remove('hidden');
            document.getElementById('approveModal').classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeApproveModal() {
            document.getElementById('approveModal').classList.add('hidden');
            document.getElementById('approveModal').classList.remove('flex');
            document.body.style.overflow = '';
        }

        // Reject modal functions
        function showRejectModal(action) {
            document.getElementById('rejectForm').action = action;
            document.getElementById('rejectModal').classList.remove('hidden');
            document.getElementById('rejectModal').classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
            document.getElementById('rejectModal').classList.remove('flex');
            document.body.style.overflow = '';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const buktiModal = document.getElementById('buktiModal');
            const approveModal = document.getElementById('approveModal');
            const rejectModal = document.getElementById('rejectModal');
            
            if (event.target === buktiModal) {
                closeBuktiModal();
            } else if (event.target === approveModal) {
                closeApproveModal();
            } else if (event.target === rejectModal) {
                closeRejectModal();
            }
        }

        // Keyboard shortcut (ESC to close modal)
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeBuktiModal();
                closeApproveModal();
                closeRejectModal();
            }
        });
    </script>
@endsection