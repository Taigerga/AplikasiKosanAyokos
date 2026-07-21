@extends('layouts.app')

@section('title', 'Laporan - Admin AyoKos')

@section('content')
<div class="p-4 md:p-6 lg:p-8 space-y-6 max-w-7xl mx-auto">
    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li><a href="{{ route('admin.dashboard') }}" class="text-sm font-bold text-gray-600 hover:text-black"><i class="fas fa-home mr-2"></i>Dashboard</a></li>
                <li><i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i></li>
                <li><span class="text-sm font-bold text-black">Laporan</span></li>
            </ol>
        </nav>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
            <h3 class="text-sm font-bold text-gray-600 mb-2"><i class="fas fa-users mr-2"></i>Sebaran Pengguna</h3>
            <div class="space-y-2">
                @foreach($sebaranRole as $role => $count)
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-bold capitalize">{{ $role }}</span>
                        <span class="font-black text-lg">{{ $count }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
            <h3 class="text-sm font-bold text-gray-600 mb-2"><i class="fas fa-home mr-2"></i>Kos Terpopuler</h3>
            @forelse($kosTerpopuler as $kos)
                <div class="flex justify-between items-center mb-1">
                    <span class="text-sm font-bold truncate">{{ $kos->nama_kos }}</span>
                    <span class="text-xs font-bold bg-emerald-400 border border-black px-1">{{ $kos->kontrak_sewa_count }} kontrak</span>
                </div>
            @empty
                <p class="text-sm text-gray-500">Belum ada data.</p>
            @endforelse
        </div>

        <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
            <h3 class="text-sm font-bold text-gray-600 mb-2"><i class="fas fa-chart-line mr-2"></i>Pendapatan Terakhir</h3>
            @forelse($pendapatanBulanan as $p)
                <div class="flex justify-between items-center mb-1">
                    <span class="text-sm font-bold">{{ date('M Y', mktime(0, 0, 0, $p->bulan, 1, $p->tahun)) }}</span>
                    <span class="text-xs font-bold">Rp {{ number_format($p->total, 0, ',', '.') }}</span>
                </div>
            @empty
                <p class="text-sm text-gray-500">Belum ada data pendapatan.</p>
            @endforelse
        </div>
    </div>

    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
        <h2 class="text-lg font-black mb-4"><i class="fas fa-file-alt mr-3 text-orange-500"></i>Statistik Kontrak</h2>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-black text-white">
                        <th class="border-2 border-black px-4 py-3 text-left text-sm font-bold">Periode</th>
                        <th class="border-2 border-black px-4 py-3 text-right text-sm font-bold">Jumlah Kontrak Baru</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kontrakPerBulan as $k)
                        <tr class="hover:bg-yellow-50">
                            <td class="border-2 border-black px-4 py-3 text-sm font-bold">{{ date('M Y', mktime(0, 0, 0, $k->bulan, 1, $k->tahun)) }}</td>
                            <td class="border-2 border-black px-4 py-3 text-sm font-bold text-right">{{ $k->total }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="2" class="border-2 border-black px-4 py-8 text-center text-gray-500 font-bold">Belum ada data kontrak.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
