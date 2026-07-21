@extends('layouts.app')

@section('title', 'Tambah Admin - AyoKos')

@section('content')
<div class="p-4 md:p-6 lg:p-8 space-y-6 max-w-2xl mx-auto">
    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li><a href="{{ route('admin.dashboard') }}" class="text-sm font-bold text-gray-600 hover:text-black"><i class="fas fa-home mr-2"></i>Dashboard</a></li>
                <li><i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i></li>
                <li><a href="{{ route('admin.users.index') }}" class="text-sm font-bold text-gray-600 hover:text-black">Kelola User</a></li>
                <li><i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i></li>
                <li><span class="text-sm font-bold text-black">Tambah Admin</span></li>
            </ol>
        </nav>
    </div>

    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] p-6">
        <h2 class="text-xl font-black mb-6"><i class="fas fa-user-shield mr-3 text-rose-500"></i>Tambah Admin Baru</h2>

        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="form-label"><i class="fas fa-user mr-2 text-sky-400"></i>Username</label>
                    <input type="text" name="username" value="{{ old('username') }}" class="form-input @error('username') is-invalid @enderror" required>
                    @error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="form-label"><i class="fas fa-lock mr-2 text-sky-400"></i>Password</label>
                    <input type="password" name="password" class="form-input @error('password') is-invalid @enderror" required>
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="form-label"><i class="fas fa-check-circle mr-2 text-sky-400"></i>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-input" required>
                </div>
                <div>
                    <label class="form-label"><i class="fas fa-id-card mr-2 text-sky-400"></i>Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" class="form-input @error('nama') is-invalid @enderror" required>
                    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="form-label"><i class="fas fa-envelope mr-2 text-sky-400"></i>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-input @error('email') is-invalid @enderror" required>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="form-label"><i class="fas fa-phone mr-2 text-sky-400"></i>No. HP</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp') }}" class="form-input @error('no_hp') is-invalid @enderror" required>
                    @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-emerald-400 border-2 border-black shadow-[3px_3px_0px_#000] hover:shadow-[5px_5px_0px_#000] hover:-translate-y-0.5 transition-all px-6 py-3 font-bold">
                    <i class="fas fa-save mr-2"></i>Simpan
                </button>
                <a href="{{ route('admin.users.index') }}" class="bg-gray-200 border-2 border-black shadow-[3px_3px_0px_#000] px-6 py-3 font-bold text-center hover:bg-gray-300 transition-all">
                    <i class="fas fa-arrow-left mr-2"></i>Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
