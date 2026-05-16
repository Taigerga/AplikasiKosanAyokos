@extends('layouts.app', ['hideFooter' => true])

@section('title', 'Daftar - AyoKos')

@section('content')
@if(session('success'))
    <div class="bg-emerald-400 border-2 border-black text-black font-bold px-4 py-3 mb-6 shadow-[3px_3px_0px_#000]">
        <div class="flex items-center"><i class="fas fa-check-circle mr-3"></i>{{ session('success') }}</div>
    </div>
@endif
@if($errors->any())
    <div class="bg-red-400 border-2 border-black text-black font-bold px-4 py-3 mb-6 shadow-[3px_3px_0px_#000]">
        <div class="flex items-center"><i class="fas fa-exclamation-circle mr-3"></i>{{ $errors->first() }}</div>
    </div>
@endif

<!-- Register Section -->
<section class="bg-yellow-50 py-16 md:py-24 min-h-[calc(100vh-80px)]">
    <div class="container mx-auto px-4">
        <div class="flex justify-center">
            <div class="register-card w-full max-w-xl">
                <!-- Header -->
                <div class="register-card-header">
                    <div class="w-14 h-14 bg-black border-2 border-black flex items-center justify-center mx-auto mb-4 shadow-[3px_3px_0px_#000]">
                        <i class="fas fa-user-plus text-white text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-black text-black mb-1">Daftar Akun Baru</h2>
                    <p class="text-gray-600 font-bold text-sm">Bergabung dengan AyoKos dalam beberapa langkah mudah</p>
                </div>

                <!-- Step Indicator -->
                <div class="step-indicator">
                    <div class="step active" data-step="1">
                        <div class="step-number">1</div>
                        <div class="step-label">Data Pribadi</div>
                    </div>
                    <div class="step" data-step="2">
                        <div class="step-number">2</div>
                        <div class="step-label">Data Akun</div>
                    </div>
                    <div class="step" data-step="3">
                        <div class="step-number">3</div>
                        <div class="step-label">Konfirmasi</div>
                    </div>
                </div>

                <!-- Form -->
                <div class="p-6 md:p-8">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" id="registrationForm" data-ajax="true" data-ajax-action="/api/auth/register" data-redirect="{{ url('/redirect') }}">
                        @csrf

                        <!-- Step 1: Data Pribadi -->
                        <div class="form-step active" id="step1">
                            <h4 class="text-black font-black mb-4"><i class="fas fa-user mr-2 text-sky-400"></i>Data Pribadi</h4>

                            <!-- Nama -->
                            <div class="mb-4">
                                <label for="nama" class="form-label">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" name="nama" id="nama" class="form-input @error('nama') is-invalid @enderror"
                                    value="{{ old('nama') }}" placeholder="Masukkan nama lengkap" required>
                                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <!-- Email & No HP -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="email" class="form-label">Email <span class="text-red-500">*</span></label>
                                    <input type="email" name="email" id="email" class="form-input @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" placeholder="email@example.com" required>
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div>
                                    <label for="no_hp_display" class="form-label">No. HP <span class="text-red-500">*</span></label>
                                    <div class="flex">
                                        <span class="inline-flex items-center px-3 py-2 bg-gray-100 border-2 border-r-0 border-black font-black text-sm">
                                            +62
                                        </span>
                                        <input type="tel" id="no_hp_display" class="form-input border-l-0 @error('no_hp') is-invalid @enderror"
                                            value="{{ old('no_hp') ? (str_starts_with(old('no_hp'), '62') ? substr(old('no_hp'), 2) : old('no_hp')) : '' }}"
                                            placeholder="81234567890" required>
                                        <input type="hidden" name="no_hp" id="no_hp" value="{{ old('no_hp') }}">
                                    </div>
                                    <small class="text-gray-500 text-xs mt-1 block font-medium">Masukkan nomor setelah +62</small>
                                    @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <!-- Tanggal Lahir -->
                            <div class="mb-4">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="text-red-500">*</span></label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-input @error('tanggal_lahir') is-invalid @enderror"
                                    value="{{ old('tanggal_lahir') }}" max="{{ date('Y-m-d', strtotime('-17 years')) }}" required>
                                <div class="invalid-feedback" id="tanggal_lahir_error">@error('tanggal_lahir'){{ $message }}@enderror</div>
                            </div>

                            <!-- Jenis Kelamin -->
                            <div class="mb-4">
                                <label class="form-label">Jenis Kelamin <span class="text-red-500">*</span></label>
                                <div class="flex gap-4">
                                    <label class="flex items-center gap-2 cursor-pointer border-2 border-black px-4 py-2 hover:bg-yellow-100 transition-colors">
                                        <input type="radio" name="jenis_kelamin" value="L" class="w-4 h-4 accent-black" {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }}>
                                        <span class="text-black font-bold text-sm"><i class="fas fa-male mr-1"></i> Laki-laki</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer border-2 border-black px-4 py-2 hover:bg-yellow-100 transition-colors">
                                        <input type="radio" name="jenis_kelamin" value="P" class="w-4 h-4 accent-black" {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }}>
                                        <span class="text-black font-bold text-sm"><i class="fas fa-female mr-1"></i> Perempuan</span>
                                    </label>
                                </div>
                                @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <!-- Alamat -->
                            <div class="mb-4">
                                <label for="alamat" class="form-label">Alamat <span class="text-red-500">*</span></label>
                                <textarea name="alamat" id="alamat" rows="3" class="form-input @error('alamat') is-invalid @enderror"
                                    placeholder="Masukkan alamat lengkap" required>{{ old('alamat') }}</textarea>
                                @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <!-- Navigation -->
                            <div class="flex justify-between mt-6">
                                <button type="button" class="btn-outline opacity-40 cursor-not-allowed" disabled>
                                    <i class="fas fa-chevron-left"></i> Sebelumnya
                                </button>
                                <button type="button" class="btn-outline" onclick="nextStep()">
                                    Selanjutnya <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Step 2: Data Akun -->
                        <div class="form-step" id="step2">
                            <h4 class="text-black font-black mb-4"><i class="fas fa-key mr-2 text-sky-400"></i>Data Akun</h4>

                            <!-- Username -->
                            <div class="mb-4">
                                <label for="username" class="form-label">Username <span class="text-red-500">*</span></label>
                                <input type="text" name="username" id="username" class="form-input @error('username') is-invalid @enderror"
                                    value="{{ old('username') }}" placeholder="Pilih username unik" required>
                                @error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <!-- Password -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="password" class="form-label">Password <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <input type="password" name="password" id="password" class="form-input pr-12 @error('password') is-invalid @enderror"
                                            placeholder="Minimal 8 karakter" required>
                                        <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-black" onclick="togglePassword('password')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div>
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-input pr-12"
                                            placeholder="Ulangi password" required>
                                        <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-black" onclick="togglePassword('password_confirmation')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Foto Profil -->
                            <div class="mb-4 text-center">
                                <label class="form-label">Foto Profil (Opsional)</label>
                                <div class="file-upload">
                                    <input type="file" name="foto_profil" id="foto_profil" accept="image/*" onchange="previewImage(this)">
                                    <label for="foto_profil" id="fileUploadLabel">
                                        <i class="fas fa-camera text-2xl"></i>
                                    </label>
                                    <img id="imagePreview" class="preview" alt="Preview">
                                </div>
                                <p class="text-gray-500 text-xs font-medium">Klik untuk upload foto (opsional, max 2MB)</p>
                            </div>

                            <!-- Navigation -->
                            <div class="flex justify-between mt-6">
                                <button type="button" class="btn-outline" onclick="prevStep()">
                                    <i class="fas fa-chevron-left"></i> Sebelumnya
                                </button>
                                <button type="button" class="btn-outline" onclick="nextStep()">
                                    Selanjutnya <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Step 3: Konfirmasi -->
                        <div class="form-step" id="step3">
                            <h4 class="text-black font-black mb-4"><i class="fas fa-check-circle mr-2 text-sky-400"></i>Konfirmasi Pendaftaran</h4>

                            <!-- Role -->
                            <div class="mb-4">
                                <label class="form-label mb-3 font-black">Daftar Sebagai <span class="text-red-500">*</span></label>
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="role-card @if(old('role') == 'penghuni') active @endif" onclick="selectRole('penghuni')">
                                        <input type="radio" name="role" value="penghuni" id="rolePenghuni" class="hidden" {{ old('role') == 'penghuni' ? 'checked' : '' }} required>
                                        <i class="fas fa-user"></i>
                                        <div class="text-black font-black text-sm">Penghuni</div>
                                        <div class="text-gray-500 font-medium text-xs mt-1">Saya ingin mencari kos</div>
                                    </div>
                                    <div class="role-card @if(old('role') == 'pemilik') active @endif" onclick="selectRole('pemilik')">
                                        <input type="radio" name="role" value="pemilik" id="rolePemilik" class="hidden" {{ old('role') == 'pemilik' ? 'checked' : '' }} required>
                                        <i class="fas fa-building"></i>
                                        <div class="text-black font-black text-sm">Pemilik</div>
                                        <div class="text-gray-500 font-medium text-xs mt-1">Saya ingin menyewakan kos</div>
                                    </div>
                                </div>
                                @error('role')<div class="invalid-feedback mt-2">{{ $message }}</div>@enderror
                            </div>

                            <!-- Alert -->
                            <div class="bg-yellow-100 border-2 border-black p-4 mb-4 flex gap-3 text-sm text-black font-bold">
                                <i class="fas fa-info-circle text-black mt-0.5"></i>
                                <span>Pastikan data yang Anda isi sudah benar. Data tidak dapat diubah setelah pendaftaran.</span>
                            </div>

                            <!-- Navigation -->
                            <div class="flex justify-between mt-6">
                                <button type="button" class="btn-outline" onclick="prevStep()">
                                    <i class="fas fa-chevron-left"></i> Sebelumnya
                                </button>
                                <button type="submit" class="btn-submit">
                                    <i class="fas fa-user-plus mr-2"></i> Daftar Sekarang
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Login Link -->
                <div class="px-6 pb-4 text-center border-t-2 border-gray-200 pt-4">
                    <p class="text-gray-600 font-bold text-sm mb-2">Sudah punya akun?</p>
                    <a href="{{ route('login') }}" class="text-sky-500 hover:text-black font-bold text-sm transition-colors">
                        <i class="fas fa-sign-in-alt mr-1"></i>Masuk Sekarang
                    </a>
                </div>

                <!-- Back to Home -->
                <div class="px-6 pb-6 text-center">
                    <a href="{{ route('public.home') }}" class="text-gray-500 hover:text-black font-bold text-sm transition-colors">
                        <i class="fas fa-arrow-left mr-1"></i>Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (window.initRegisterForm) window.initRegisterForm();
    });
</script>
@endpush