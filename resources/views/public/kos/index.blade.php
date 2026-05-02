@extends('layouts.app')

@section('title', 'Cari Kos - AyoKos')

@section('content')
    <!-- Search Header Section -->
    <section class="relative bg-gradient-to-br from-slate-800 to-slate-900 pt-28 pb-16 md:pt-32 md:pb-20 overflow-hidden">
        {{-- decorative blobs --}}
        <div class="absolute inset-0 opacity-10 pointer-events-none">
            <div class="absolute top-0 left-0 w-72 h-72 bg-sky-400 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-indigo-400 rounded-full translate-x-1/3 translate-y-1/3 blur-3xl"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-6xl mx-auto">
                {{-- Heading & Quick Stats --}}
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-white mb-2 flex items-center gap-3">
                            <i class="fas fa-search text-sky-300"></i>
                            Temukan Kos <span class="text-sky-300">Terbaik</span> untuk Anda
                        </h1>
                        <p class="text-slate-300 text-lg">Jelajahi ratusan kos dengan filter lengkap dan informasi transparan</p>
                    </div>

                    <div class="flex items-center gap-4 mt-4 md:mt-0">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-white">{{ $kos->total() }}</div>
                            <div class="text-xs text-slate-400">Total Kos</div>
                        </div>
                        <div class="h-8 w-px bg-slate-600"></div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-emerald-400">
                                {{ $kos->filter(fn($k) => $k->kamar_tersedia_count > 0)->count() }}
                            </div>
                            <div class="text-xs text-slate-400">Tersedia</div>
                        </div>
                    </div>
                </div>

                {{-- Search Form Card --}}
                <div class="bg-white/10 backdrop-blur-md border border-white/15 rounded-2xl p-6 shadow-2xl">
                    <form method="GET" action="{{ route('public.kos.index') }}">
                        <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-4">
                            {{-- Kata Kunci --}}
                            <div>
                                <label class="block text-sm font-medium text-white mb-2">
                                    <i class="fas fa-search mr-2 text-slate-300"></i>Kata Kunci
                                </label>
                                <div class="relative">
                                    <input type="text" name="search" value="{{ request('search') }}"
                                           placeholder="Nama kos atau lokasi..."
                                           class="w-full pl-10 pr-4 py-3 bg-white/10 border border-white/10 text-white placeholder-slate-400 rounded-xl focus:outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-400/30 transition">
                                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                                </div>
                            </div>

                            {{-- Jenis Kos --}}
                            <div>
                                <label class="block text-sm font-medium text-white mb-2">
                                    <i class="fas fa-users mr-2 text-sky-300"></i>Jenis Kos
                                </label>
                                <select name="jenis_kos"
                                        class="w-full px-4 py-3 bg-white/10 border border-white/10 text-white rounded-xl focus:outline-none focus:border-sky-400 appearance-none transition">
                                    <option value="">Semua Jenis</option>
                                    <option value="putra" {{ request('jenis_kos') == 'putra' ? 'selected' : '' }}>Putra</option>
                                    <option value="putri" {{ request('jenis_kos') == 'putri' ? 'selected' : '' }}>Putri</option>
                                    <option value="campuran" {{ request('jenis_kos') == 'campuran' ? 'selected' : '' }}>Campuran</option>
                                </select>
                            </div>

                            {{-- Kota --}}
                            <div>
                                <label class="block text-sm font-medium text-white mb-2">
                                    <i class="fas fa-map-marker-alt mr-2 text-emerald-300"></i>Kota
                                </label>
                                <div class="relative">
                                    <input type="text" name="kota" value="{{ request('kota') }}"
                                           placeholder="Nama kota..."
                                           class="w-full pl-10 pr-4 py-3 bg-white/10 border border-white/10 text-white placeholder-slate-400 rounded-xl focus:outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-400/30 transition">
                                    <i class="fas fa-city absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                                </div>
                            </div>

                            {{-- Ketersediaan --}}
                            <div>
                                <label class="block text-sm font-medium text-white mb-2">
                                    <i class="fas fa-door-open mr-2 text-amber-300"></i>Ketersediaan
                                </label>
                                <select name="ketersediaan"
                                        class="w-full px-4 py-3 bg-white/10 border border-white/10 text-white rounded-xl focus:outline-none focus:border-sky-400 appearance-none transition">
                                    <option value="">Semua Status</option>
                                    <option value="tersedia" {{ request('ketersediaan') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                    <option value="penuh" {{ request('ketersediaan') == 'penuh' ? 'selected' : '' }}>Penuh</option>
                                </select>
                            </div>

                            {{-- Tombol Cari --}}
                            <div class="flex items-end">
                                <button type="submit"
                                        class="w-full bg-sky-600 hover:bg-sky-700 text-white font-semibold py-3 px-6 rounded-xl transition shadow-lg hover:shadow-xl">
                                    <i class="fas fa-search mr-2"></i>Cari Kos
                                </button>
                            </div>
                        </div>

                        {{-- Advanced Filters --}}
                        <div class="border-t border-white/10 pt-4 mt-4">
                            <button type="button" onclick="toggleAdvancedFilters()"
                                    class="flex items-center text-sky-300 hover:text-sky-200 mb-4 transition-colors text-sm font-medium">
                                <i class="fas fa-sliders-h mr-2"></i>
                                Filter Lanjutan
                                <i id="filter-arrow" class="fas fa-chevron-down ml-2 transition-transform"></i>
                            </button>

                            <div id="advancedFilters" class="grid grid-cols-1 md:grid-cols-4 gap-4 hidden">
                                {{-- Harga --}}
                                <div>
                                    <label class="block text-sm font-medium text-white mb-2">
                                        <i class="fas fa-money-bill-wave mr-2 text-emerald-300"></i>Harga per Bulan
                                    </label>
                                    <div class="flex gap-3">
                                        <input type="number" name="min_harga" value="{{ request('min_harga') }}"
                                               placeholder="Min" class="w-full px-4 py-3 bg-white/10 border border-white/10 text-white placeholder-slate-400 rounded-xl focus:outline-none focus:border-sky-400 transition">
                                        <input type="number" name="max_harga" value="{{ request('max_harga') }}"
                                               placeholder="Max" class="w-full px-4 py-3 bg-white/10 border border-white/10 text-white placeholder-slate-400 rounded-xl focus:outline-none focus:border-sky-400 transition">
                                    </div>
                                </div>

                                {{-- Rating --}}
                                <div>
                                    <label class="block text-sm font-medium text-white mb-2">
                                        <i class="fas fa-star mr-2 text-amber-300"></i>Rating Minimal
                                    </label>
                                    <select name="min_rating"
                                            class="w-full px-4 py-3 bg-white/10 border border-white/10 text-white rounded-xl focus:outline-none focus:border-sky-400 transition">
                                        <option value="">Semua Rating</option>
                                        @foreach([5, 4.5, 4, 3.5, 3] as $r)
                                            <option value="{{ $r }}" {{ request('min_rating') == $r ? 'selected' : '' }}>⭐ {{ $r }}+</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Fasilitas --}}
                                <div>
                                    <label class="block text-sm font-medium text-white mb-2">
                                        <i class="fas fa-list mr-2 text-purple-300"></i>Fasilitas
                                    </label>
                                    <select name="fasilitas[]" multiple
                                            class="w-full px-4 py-3 bg-white/10 border border-white/10 text-white rounded-xl focus:outline-none focus:border-sky-400 transition h-32 custom-scrollbar">
                                        @php
                                            $selectedFacilities = request('fasilitas', []);
                                        @endphp
                                        @foreach($fasilitasList as $fasilitas)
                                            <option value="{{ $fasilitas->id_fasilitas }}"
                                                    {{ in_array($fasilitas->id_fasilitas, $selectedFacilities) ? 'selected' : '' }}>
                                                <i class="fas fa-{{ $fasilitas->icon ?? 'check' }} mr-2"></i>
                                                {{ $fasilitas->nama_fasilitas }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="text-xs text-slate-400 mt-2">
                                        <i class="fas fa-info-circle mr-1"></i>Ctrl+klik untuk pilih banyak
                                    </p>
                                </div>

                                {{-- Sort --}}
                                <div>
                                    <label class="block text-sm font-medium text-white mb-2">
                                        <i class="fas fa-sort mr-2 text-cyan-300"></i>Urutkan
                                    </label>
                                    <select name="sort"
                                            class="w-full px-4 py-3 bg-white/10 border border-white/10 text-white rounded-xl focus:outline-none focus:border-sky-400 transition">
                                        <option value="">Default</option>
                                        <option value="harga_asc" {{ request('sort') == 'harga_asc' ? 'selected' : '' }}>Harga: Rendah → Tinggi</option>
                                        <option value="harga_desc" {{ request('sort') == 'harga_desc' ? 'selected' : '' }}>Harga: Tinggi → Rendah</option>
                                        <option value="rating_desc" {{ request('sort') == 'rating_desc' ? 'selected' : '' }}>Rating Tertinggi</option>
                                        <option value="nama_asc" {{ request('sort') == 'nama_asc' ? 'selected' : '' }}>Nama A-Z</option>
                                        <option value="created_desc" {{ request('sort') == 'created_desc' ? 'selected' : '' }}>Terbaru</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Active Filters --}}
                            @php
                                $hasActiveFilters = request()->hasAny(['search','jenis_kos','kota','ketersediaan','min_harga','max_harga','min_rating','fasilitas','sort']);
                            @endphp
                            @if($hasActiveFilters)
                            <div class="mt-4 pt-4 border-t border-white/10">
                                <div class="flex flex-wrap gap-2 items-center">
                                    <span class="text-sm font-medium text-white"><i class="fas fa-filter mr-1"></i>Filter Aktif:</span>
                                    @foreach([
                                        ['search', 'search', 'Kata Kunci', request('search')],
                                        ['jenis_kos', 'users', 'Jenis', ucfirst(request('jenis_kos'))],
                                        ['kota', 'map-marker-alt', 'Kota', request('kota')],
                                        ['ketersediaan', 'door-open', 'Status', request('ketersediaan') == 'tersedia' ? 'Tersedia' : 'Penuh'],
                                    ] as $filter)
                                        @if(request($filter[0]))
                                            @php
                                                $removeUrl = request()->fullUrlWithQuery([$filter[0] => null]);
                                            @endphp
                                            <span class="inline-flex items-center bg-white/10 text-white px-3 py-1.5 rounded-full text-sm">
                                                <i class="fas fa-{{ $filter[1] }} mr-1 opacity-70"></i>{{ $filter[3] }}
                                                <a href="{{ $removeUrl }}" class="ml-2 hover:text-slate-200">&times;</a>
                                            </span>
                                        @endif
                                    @endforeach

                                    @if(request('min_harga') || request('max_harga'))
                                        @php
                                            $min = request('min_harga') ? 'Min Rp '.number_format(request('min_harga'),0,',','.') : '';
                                            $max = request('max_harga') ? 'Max Rp '.number_format(request('max_harga'),0,',','.') : '';
                                            $removeUrl = request()->fullUrlWithQuery(['min_harga' => null, 'max_harga' => null]);
                                        @endphp
                                        <span class="inline-flex items-center bg-white/10 text-white px-3 py-1.5 rounded-full text-sm">
                                            <i class="fas fa-money-bill-wave mr-1 opacity-70"></i>{{ $min }} {{ $max }}
                                            <a href="{{ $removeUrl }}" class="ml-2 hover:text-slate-200">&times;</a>
                                        </span>
                                    @endif

                                    @if(request('min_rating'))
                                        @php $removeUrl = request()->fullUrlWithQuery(['min_rating' => null]); @endphp
                                        <span class="inline-flex items-center bg-white/10 text-white px-3 py-1.5 rounded-full text-sm">
                                            <i class="fas fa-star mr-1 opacity-70"></i>{{ request('min_rating') }}+
                                            <a href="{{ $removeUrl }}" class="ml-2 hover:text-slate-200">&times;</a>
                                        </span>
                                    @endif

                                    @if(request('fasilitas'))
                                        @foreach($fasilitasList->whereIn('id_fasilitas', request('fasilitas')) as $f)
                                            @php
                                                $current = request('fasilitas');
                                                $updated = array_values(array_diff($current, [$f->id_fasilitas]));
                                                $removeUrl = request()->fullUrlWithQuery(['fasilitas' => count($updated) ? $updated : null]);
                                            @endphp
                                            <span class="inline-flex items-center bg-white/10 text-white px-3 py-1.5 rounded-full text-sm">
                                                <i class="fas fa-check mr-1 opacity-70"></i>{{ $f->nama_fasilitas }}
                                                <a href="{{ $removeUrl }}" class="ml-2 hover:text-slate-200">&times;</a>
                                            </span>
                                        @endforeach
                                    @endif

                                    @if(request('sort'))
                                        @php
                                            $sortLabels = ['harga_asc'=>'Harga Rendah→Tinggi','harga_desc'=>'Harga Tinggi→Rendah','rating_desc'=>'Rating Tertinggi','nama_asc'=>'Nama A-Z','created_desc'=>'Terbaru'];
                                            $removeUrl = request()->fullUrlWithQuery(['sort' => null]);
                                        @endphp
                                        <span class="inline-flex items-center bg-white/10 text-white px-3 py-1.5 rounded-full text-sm">
                                            <i class="fas fa-sort mr-1 opacity-70"></i>{{ $sortLabels[request('sort')] ?? '' }}
                                            <a href="{{ $removeUrl }}" class="ml-2 hover:text-slate-200">&times;</a>
                                        </span>
                                    @endif

                                    <a href="{{ route('public.kos.index') }}" class="text-sm text-sky-300 hover:text-sky-200 ml-auto transition">
                                        <i class="fas fa-times mr-1"></i>Hapus Semua
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- Results Section --}}
    <section class="py-12 md:py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($kos as $k)
                <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-1" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    {{-- Image --}}
                    <div class="relative h-52 overflow-hidden">
                        @if($k->foto_utama)
                            <img src="{{ asset('storage/' . $k->foto_utama) }}"
                                 alt="{{ $k->nama_kos }}"
                                 class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                 onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1560185007-5f0bb1866cab?w=400&h=250&fit=crop';">
                        @else
                            <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                                <i class="fas fa-home text-4xl text-slate-300"></i>
                            </div>
                        @endif

                        {{-- Badges --}}
                        <div class="absolute top-3 left-3 flex flex-col gap-1.5">
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-sky-500/90 text-white shadow-sm backdrop-blur-sm">
                                {{ ucfirst($k->jenis_kos) }}
                            </span>
                            @if($k->kamar_tersedia_count > 0)
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-emerald-500/90 text-white shadow-sm backdrop-blur-sm">
                                {{ $k->kamar_tersedia_count }} Kamar Tersedia
                            </span>
                            @endif
                        </div>

                        @php
                            $avgRating = $k->reviews->avg('rating');
                            $reviewCount = $k->reviews->count();
                        @endphp
                        @if($avgRating)
                        <div class="absolute top-3 right-3 bg-amber-400/90 backdrop-blur-sm text-white px-3 py-1.5 rounded-full text-sm font-semibold shadow-sm flex items-center gap-1">
                            <span>{{ number_format($avgRating, 1) }}</span>
                            <i class="fas fa-star text-xs"></i>
                            <span class="text-xs opacity-80">({{ $reviewCount }})</span>
                        </div>
                        @endif
                    </div>

                    {{-- Content --}}
                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="text-lg font-semibold text-slate-900 mb-1 truncate">{{ $k->nama_kos }}</h3>
                        <div class="flex items-center text-slate-500 text-sm mb-3">
                            <i class="fas fa-map-marker-alt mr-2 text-sky-500"></i>
                            <span class="truncate">{{ $k->alamat }}, {{ $k->kota }}</span>
                        </div>

                        {{-- Fasilitas --}}
                        <div class="flex flex-wrap gap-1.5 mb-4">
                            @foreach($k->fasilitas->take(3) as $fas)
                            <span class="px-2.5 py-1 text-xs rounded-full bg-slate-100 text-slate-600 border border-slate-200">
                                <i class="fas fa-{{ $fas->icon ?? 'check' }} mr-1 text-sky-500"></i>{{ $fas->nama_fasilitas }}
                            </span>
                            @endforeach
                            @if($k->fasilitas->count() > 3)
                            <span class="px-2.5 py-1 text-xs rounded-full bg-slate-100 text-slate-400 border border-slate-200">
                                +{{ $k->fasilitas->count() - 3 }}
                            </span>
                            @endif
                        </div>

                        {{-- Price & Action --}}
                        <div class="mt-auto flex justify-between items-end">
                            <div>
                                @if($k->kamar_tersedia_count > 0)
                                    <div class="text-xl font-bold text-sky-600">
                                        Rp {{ number_format($k->harga_terendah_tersedia, 0, ',', '.') }}
                                    </div>
                                    <div class="text-xs text-slate-400">
                                        mulai / {{ $k->tipe_sewa ?? 'bulan' }}
                                    </div>
                                @else
                                    <span class="text-sm font-semibold text-red-500 bg-red-50 px-3 py-1.5 rounded-lg">Penuh</span>
                                @endif
                            </div>

                            <a href="{{ route('public.kos.show', $k->id_kos) }}"
                               class="px-5 py-2.5 bg-sky-600 hover:bg-sky-700 text-white text-sm font-semibold rounded-xl transition shadow-sm hover:shadow-md">
                                Lihat Detail <i class="fas fa-arrow-right ml-1.5 text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-16">
                    <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-search text-3xl text-slate-400"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-800 mb-2">Tidak ada kos ditemukan</h3>
                    <p class="text-slate-500 mb-6">Coba ubah filter atau kata kunci pencarian Anda</p>
                    <a href="{{ route('public.kos.index') }}"
                       class="inline-flex items-center px-6 py-3 bg-sky-600 text-white font-medium rounded-xl hover:bg-sky-700 transition shadow-sm">
                        <i class="fas fa-redo mr-2"></i> Reset Pencarian
                    </a>
                </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($kos->hasPages())
            <div class="mt-10 flex justify-center">
                {{ $kos->onEachSide(2)->links('vendor.pagination.tailwind') }}
            </div>
            @endif

            {{-- Stats Summary (optional) --}}
            @if($kos->isNotEmpty())
            <div class="mt-16 bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                    <i class="fas fa-chart-bar text-sky-500"></i> Ringkasan Pencarian
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                    <div class="bg-slate-50 rounded-xl p-4 text-center">
                        <div class="text-sm text-slate-500">Total Ditemukan</div>
                        <div class="text-2xl font-bold text-sky-600">{{ $kos->total() }}</div>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-4 text-center">
                        <div class="text-sm text-slate-500">Harga Rata-rata</div>
                        <div class="text-2xl font-bold text-emerald-600">
                            @php
                                $kosTersedia = $kos->filter(fn($k) => $k->kamar_tersedia_count > 0);
                                $avgPrice = $kosTersedia->avg('harga_terendah_tersedia');
                            @endphp
                            {{ $avgPrice ? 'Rp '.number_format($avgPrice,0,',','.') : '-' }}
                        </div>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-4 text-center">
                        <div class="text-sm text-slate-500">Kos Penuh</div>
                        <div class="text-2xl font-bold text-red-500">
                            {{ $kos->filter(fn($k) => $k->kamar_tersedia_count == 0)->count() }}
                        </div>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-4 text-center">
                        <div class="text-sm text-slate-500">Rating Tertinggi</div>
                        <div class="text-2xl font-bold text-amber-500">
                            @php
                                $maxRating = $kos->max(fn($k) => $k->reviews->avg('rating'));
                            @endphp
                            {{ $maxRating ? number_format($maxRating,1).' ⭐' : '-' }}
                        </div>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-4 text-center">
                        <div class="text-sm text-slate-500">Total Kamar Tersedia</div>
                        <div class="text-2xl font-bold text-indigo-500">
                            {{ $kos->sum(fn($k) => $k->kamar->where('status_kamar','tersedia')->count()) }}
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // Toggle advanced filters
    function toggleAdvancedFilters() {
        const filters = document.getElementById('advancedFilters');
        const arrow = document.getElementById('filter-arrow');
        const isHidden = filters.classList.contains('hidden');
        if (isHidden) {
            filters.classList.remove('hidden');
            filters.style.display = 'grid';
            arrow.style.transform = 'rotate(180deg)';
        } else {
            filters.classList.add('hidden');
            filters.style.display = 'none';
            arrow.style.transform = 'rotate(0deg)';
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Auto-expand if any advanced filter is active
        const hasAdvanced = {{ request()->hasAny(['min_harga','max_harga','min_rating','fasilitas','sort']) ? 'true' : 'false' }};
        if (hasAdvanced) {
            const filters = document.getElementById('advancedFilters');
            const arrow = document.getElementById('filter-arrow');
            filters.classList.remove('hidden');
            filters.style.display = 'grid';
            arrow.style.transform = 'rotate(180deg)';
        }

        // Auto-submit when sort changes
        document.querySelector('select[name="sort"]')?.addEventListener('change', function () {
            this.form.submit();
        });

        // Style for multi-select
        document.querySelectorAll('select[multiple]').forEach(select => {
            select.addEventListener('change', function () {
                this.style.backgroundColor = this.selectedOptions.length > 0 ? '#1e293b' : '';
            });
            select.dispatchEvent(new Event('change'));
        });
    });
</script>

<style>
    /* Custom scrollbar inside select[multiple] */
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: rgba(255,255,255,0.05); border-radius: 4px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 4px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.3); }

    /* Smooth transition for advanced filters */
    #advancedFilters {
        transition: all 0.3s ease;
    }

    /* Tambahan untuk animasi AOS jika diperlukan */
</style>
@endpush