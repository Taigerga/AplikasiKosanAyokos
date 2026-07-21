@extends('layouts.app', ['hideFooter' => true])

@section('title', 'Lupa Password - AyoKos')

@section('content')
@if(session('success'))
    <div class="bg-emerald-400 border-2 border-black text-black font-bold px-4 py-3 mb-6 shadow-[3px_3px_0px_#000]">
        <div class="flex items-center"><i class="fas fa-check-circle mr-3"></i>{{ session('success') }}</div>
    </div>
@endif
@if($errors->has('username'))
    <div class="bg-red-400 border-2 border-black text-black font-bold px-4 py-3 mb-6 shadow-[3px_3px_0px_#000]">
        <div class="flex items-center"><i class="fas fa-exclamation-circle mr-3"></i>{{ $errors->first('username') }}</div>
    </div>
@endif

<section class="bg-yellow-50 py-16 md:py-24 min-h-[calc(100vh-80px)]">
    <div class="container mx-auto px-4">
        <div class="flex justify-center">
            <div class="login-card w-full max-w-md">
                <div class="login-card-header">
                    <div class="w-14 h-14 bg-black border-2 border-black flex items-center justify-center mx-auto mb-4 shadow-[3px_3px_0px_#000]">
                        <i class="fas fa-key text-white text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-black text-black mb-1">Lupa Password</h2>
                    <p class="text-gray-600 font-bold text-sm">Masukkan username untuk reset password</p>
                </div>

                <div class="p-6 md:p-8">
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-5">
                            <label for="username" class="form-label">
                                <i class="fas fa-user mr-2 text-sky-400"></i>Username
                            </label>
                            <input
                                type="text"
                                name="username"
                                id="username"
                                class="form-input @error('username') is-invalid @enderror"
                                value="{{ old('username') }}"
                                placeholder="Masukkan username Anda"
                                required
                                autofocus
                            >
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn-submit">
                            <i class="fas fa-paper-plane mr-2"></i>Kirim Link Reset
                        </button>
                    </form>

                    <div class="text-center mt-6 pt-6 border-t-2 border-gray-200">
                        <a href="{{ route('login') }}" class="text-sky-500 hover:text-black font-bold text-sm transition-colors">
                            <i class="fas fa-arrow-left mr-1"></i>Kembali ke Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
