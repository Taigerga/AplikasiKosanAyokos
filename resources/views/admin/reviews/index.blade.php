@extends('layouts.app')

@section('title', 'Moderasi Review - Admin AyoKos')

@section('content')
<div class="p-4 md:p-6 lg:p-8 space-y-6 max-w-7xl mx-auto">
    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li><a href="{{ route('admin.dashboard') }}" class="text-sm font-bold text-gray-600 hover:text-black"><i class="fas fa-home mr-2"></i>Dashboard</a></li>
                <li><i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i></li>
                <li><span class="text-sm font-bold text-black">Moderasi Review</span></li>
            </ol>
        </nav>
    </div>

    @if(session('success'))
        <div class="bg-emerald-400 border-2 border-black text-black font-bold px-4 py-3 shadow-[3px_3px_0px_#000] flex items-center justify-between">
            <span><i class="fas fa-check-circle mr-2"></i>{{ session('success') }}</span>
            <button type="button" class="alert-close"><i class="fas fa-times"></i></button>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
            <p class="text-3xl font-black text-black">{{ $stats['total'] }}</p>
            <p class="text-sm font-bold text-gray-600">Total Review</p>
        </div>
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
            <p class="text-3xl font-black text-yellow-500">{{ number_format($stats['avg_rating'], 1) }}</p>
            <p class="text-sm font-bold text-gray-600">Rata-rata Rating</p>
        </div>
    </div>

    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
        <h2 class="text-xl font-black mb-6"><i class="fas fa-star mr-3 text-yellow-500"></i>Daftar Review</h2>

        <form method="GET" class="mb-6">
            <select name="rating" class="border-2 border-black px-3 py-2 font-bold text-sm bg-white" onchange="this.form.submit()">
                <option value="">Semua Rating</option>
                @for($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ request('rating') == $i ? 'selected' : '' }}>{{ $i }} Bintang</option>
                @endfor
            </select>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-black text-white">
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">ID</th>
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">Penghuni</th>
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">Kos</th>
                        <th class="border-2 border-black px-4 py-3 text-center text-sm font-bold">Rating</th>
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">Komentar</th>
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">Tanggal</th>
                        <th class="border-2 border-black px-4 py-3 text-center text-sm font-bold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reviews as $review)
                        <tr class="hover:bg-yellow-50">
                            <td class="border-2 border-black px-4 py-3 text-sm font-bold">{{ $review->id_review }}</td>
                            <td class="border-2 border-black px-4 py-3 text-sm">{{ $review->penghuni->nama ?? '-' }}</td>
                            <td class="border-2 border-black px-4 py-3 text-sm font-bold">{{ $review->kos->nama_kos ?? '-' }}</td>
                            <td class="border-2 border-black px-4 py-3 text-center">
                                <span class="font-black text-yellow-500">{{ $review->rating }}/5</span>
                            </td>
                            <td class="border-2 border-black px-4 py-3 text-sm max-w-xs truncate">{{ $review->komentar ?? '-' }}</td>
                            <td class="border-2 border-black px-4 py-3 text-sm">{{ $review->created_at->format('d/m/Y') }}</td>
                            <td class="border-2 border-black px-4 py-3 text-center">
                                <form method="POST" action="{{ route('admin.reviews.destroy', $review->id_review) }}" class="inline" onsubmit="return confirm('Hapus review ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="bg-red-400 border-2 border-black px-2 py-1 text-xs font-bold hover:bg-red-500 transition-colors">
                                        <i class="fas fa-trash mr-1"></i>Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="border-2 border-black px-4 py-8 text-center text-gray-500 font-bold">
                                <i class="fas fa-star text-3xl block mb-2"></i>Tidak ada review ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $reviews->links('vendor.pagination.custom-dark') }}</div>
    </div>
</div>
@endsection
