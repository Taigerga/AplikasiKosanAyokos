@extends('layouts.app')

@section('title', 'Beri Review - AyoKos')

@section('content')
<div class="p-4 md:p-6 max-w-2xl mx-auto space-y-6">
    <!-- Breadcrumb -->
    <div class="bg-white border-2 border-black shadow-[2px_2px_0px_#000] p-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-2 md:space-x-4">
                <li class="inline-flex items-center">
                    <a href="{{ route('public.home') }}"
                       class="inline-flex items-center text-sm font-black text-gray-600 hover:text-black transition">
                        <i class="fas fa-gauge mr-2"></i>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-black/20 mx-2 text-sm"></i>
                        <a href="{{ route('public.kos.show', $kos->id_kos) }}"
                           class="ml-1 text-sm font-black text-gray-600 hover:text-black transition">
                            <i class="fas fa-home mr-2"></i>
                            {{ $kos->nama_kos }}
                        </a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-black/20 mx-2 text-sm"></i>
                        <span class="ml-1 text-sm font-black text-black">
                            <i class="fas fa-plus mr-2"></i>
                            Beri Review
                        </span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <div class="bg-white border-4 border-black shadow-[4px_4px_0px_#000] overflow-hidden">
        <!-- Header -->
        <div class="bg-gray-100 border-b-2 border-black p-6">
            <div class="text-center">
                <div class="w-16 h-16 bg-gray-100 border-2 border-black  flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-star text-black text-2xl"></i>
                </div>
                <h1 class="text-2xl md:text-3xl font-black text-black mb-2">Beri Review untuk</h1>
                <h2 class="text-xl text-emerald-400 font-black">{{ $kos->nama_kos }}</h2>
                <p class="text-gray-600 mt-2">Bagikan pengalaman Anda selama tinggal di kos ini</p>
            </div>
        </div>

        <!-- Content -->
        <div class="p-6">
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
            <form action="{{ route('penghuni.reviews.store') }}" method="POST" enctype="multipart/form-data" data-ajax="true" data-ajax-action="/api/penghuni/reviews" data-redirect="{{ route('penghuni.reviews.history') }}" data-success-msg="Review berhasil ditambahkan!">
                @csrf
                <input type="hidden" name="id_kos" value="{{ $kos->id_kos }}">

                <!-- Kos Info Card -->
                <div class="bg-white border-2 border-black shadow-[2px_2px_0px_#000] p-4 mb-6">
                    <div class="flex items-center space-x-4">
                        @if($kos->foto_utama)
                        @php
                        $filePath = storage_path('app/public/' . $kos->foto_utama);
                        $fileExists = file_exists($filePath);
                        @endphp
                        @if($fileExists)
                        <img src="{{ url('storage/' . $kos->foto_utama) }}"
                             alt="{{ $kos->nama_kos }}"
                             class="w-16 h-16 object-cover ">
                        @else
                        <div class="w-16 h-16 bg-gray-100 border-2 border-black  flex items-center justify-center">
                            <i class="fas fa-home text-2xl text-gray-500"></i>
                        </div>
                        @endif
                        @else
                        <div class="w-16 h-16 bg-gray-100 border-2 border-black  flex items-center justify-center">
                            <i class="fas fa-home text-2xl text-gray-500"></i>
                        </div>
                        @endif
                        <div class="flex-1">
                            <h3 class="font-black text-black mb-1">{{ $kos->nama_kos }}</h3>
                            <div class="flex items-center text-gray-600 text-sm">
                                <i class="fas fa-map-marker-alt mr-2 text-emerald-400"></i>
                                <span>{{ $kos->alamat }}, {{ $kos->kota }}</span>
                            </div>
                            <div class="mt-2 flex items-center">
                                <span class="px-2 py-1 text-xs  bg-emerald-50 text-emerald-600">
                                    {{ ucfirst($kos->jenis_kos) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rating Section -->
                <div class="mb-8">
                    <label class="block text-black font-black mb-4 text-lg">
                        <i class="fas fa-star text-yellow-400 mr-2"></i>
                        Berapa Rating Anda?
                    </label>

                    <div class="flex items-center justify-center space-x-1 mb-2">
                        @for($i = 1; $i <= 5; $i++)
                        <button type="button"
                                onclick="setRating({{ $i }})"
                                class="text-5xl rating-star focus:outline-none transition-transform duration-200 hover:scale-110"
                                data-rating="{{ $i }}">
                            ☆
                        </button>
                        @endfor
                    </div>

                    <input type="hidden" name="rating" id="rating-input" value="0" required>

                    <div class="text-center mt-4">
                        <p id="rating-text" class="text-gray-600">Pilih rating dengan mengklik bintang di atas</p>
                        <p id="selected-rating" class="text-xl font-black text-yellow-400 hidden mt-2"></p>
                    </div>

                    <div class="mt-2 text-sm text-rose-400" id="rating-error"></div>
                    @error('rating')
                    <div class="mt-2 text-sm text-rose-400">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Komentar Section -->
                <div class="mb-8">
                    <label for="komentar" class="block text-black font-black mb-4 text-lg">
                        <i class="fas fa-edit text-emerald-400 mr-2"></i>
                        Ceritakan Pengalaman Anda
                    </label>

                    <div class="relative">
                        <textarea name="komentar" id="komentar"
                                  rows="6"
                                  class="w-full px-4 py-3 bg-white border-2 border-black shadow-[2px_2px_0px_#000] text-black  focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/30 transition placeholder-white/40"
                                  placeholder="Bagaimana pengalaman Anda selama tinggal di kos ini? (minimal 10 karakter)"
                                  required>{{ old('komentar') }}</textarea>

                        <div class="absolute bottom-3 right-3 flex items-center space-x-2">
                            <span id="char-count" class="text-xs text-gray-600">0/500</span>
                        </div>
                    </div>

                    <div class="mt-3">
                        <p class="text-sm text-gray-600 mb-2">Saran topik yang bisa dibahas:</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 text-xs  bg-gray-100 border-2 border-black text-gray-600">Kebersihan</span>
                            <span class="px-3 py-1 text-xs  bg-gray-100 border-2 border-black text-gray-600">Fasilitas</span>
                            <span class="px-3 py-1 text-xs  bg-gray-100 border-2 border-black text-gray-600">Lokasi</span>
                            <span class="px-3 py-1 text-xs  bg-gray-100 border-2 border-black text-gray-600">Keamanan</span>
                            <span class="px-3 py-1 text-xs  bg-gray-100 border-2 border-black text-gray-600">Layanan Pemilik</span>
                        </div>
                    </div>

                    @error('komentar')
                    <div class="mt-2 text-sm text-rose-400">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Foto Review Section -->
                <div class="mb-8">
                    <label class="block text-black font-black mb-4 text-lg">
                        <i class="fas fa-camera text-purple-400 mr-2"></i>
                        Upload Foto (Opsional)
                    </label>

                    <div class="space-y-4">
                        <div class="flex items-center justify-center w-full">
                            <label for="foto_review" class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-black  cursor-pointer bg-gray-100 border-2 border-black hover:bg-gray-100 transition group">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <div class="w-12 h-12 bg-gray-100 border-2 border-black  flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                                        <i class="fas fa-cloud-upload-alt text-purple-400 text-xl"></i>
                                    </div>
                                    <p class="mb-2 text-sm text-gray-600 group-hover:text-black transition">
                                        <span class="font-black">Klik untuk upload</span> atau drag & drop
                                    </p>
                                    <p class="text-xs text-gray-600">PNG, JPG, GIF (Max 2MB)</p>
                                </div>
                                <input id="foto_review" name="foto_review" type="file" class="hidden" accept="image/*" />
                            </label>
                        </div>

                        <div id="image-preview" class="hidden">
                            <div class="flex items-center justify-between bg-white border-2 border-black shadow-[2px_2px_0px_#000] p-4">
                                <div class="flex items-center space-x-4">
                                    <img id="preview-image" class="w-16 h-16 object-cover " />
                                    <div>
                                        <p class="text-black font-black">Foto terpilih</p>
                                        <p id="file-name" class="text-sm text-gray-600"></p>
                                    </div>
                                </div>
                                <button type="button"
                                        onclick="removeImage()"
                                        class="text-rose-400 hover:text-rose-300 transition">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    @error('foto_review')
                    <div class="mt-2 text-sm text-rose-400">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Info Box -->
                <div class="bg-emerald-100 border-2 border-black  p-4 mb-8">
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-gray-100 border-2 border-black  flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-info-circle text-emerald-400"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-black text-black mb-2">Info Penting</h4>
                            <ul class="text-sm text-gray-600 space-y-2">
                                <li class="flex items-start">
                                    <i class="fas fa-chevron-right text-emerald-400 mt-1 mr-2 text-xs"></i>
                                    <span>Review akan langsung ditampilkan di halaman kos untuk membantu calon penghuni</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-chevron-right text-emerald-400 mt-1 mr-2 text-xs"></i>
                                    <span>Anda dapat mengedit atau menghapus review kapan saja</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-chevron-right text-emerald-400 mt-1 mr-2 text-xs"></i>
                                    <span>Review yang baik membantu pemilik meningkatkan pelayanan</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-3 pt-4 border-t border-black">
                    <a href="{{ route('public.kos.show', $kos->id_kos) }}"
                       class="px-6 py-3 bg-white border-2 border-black shadow-[2px_2px_0px_#000] text-black  hover:bg-gray-100 transition flex items-center">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </a>
                    <button type="submit"
                            id="submit-btn"
                            class="px-6 py-3 bg-emerald-400 border-2 border-black shadow-[3px_3px_0px_#000] text-black  hover:bg-emerald-500/30 font-black disabled:opacity-50 disabled:cursor-not-allowed transition flex items-center">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Kirim Review
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let currentRating = 0;
    const stars = document.querySelectorAll('.rating-star');
    const ratingInput = document.getElementById('rating-input');
    const submitBtn = document.getElementById('submit-btn');
    const ratingError = document.getElementById('rating-error');
    const ratingText = document.getElementById('rating-text');
    const selectedRating = document.getElementById('selected-rating');

    const ratingMessages = [
        "Pilih rating dengan mengklik bintang di atas",
        "Sangat Buruk",
        "Buruk",
        "Cukup",
        "Baik",
        "Sangat Baik"
    ];

    function setRating(rating) {
        currentRating = rating;
        ratingInput.value = rating;

        stars.forEach((star, index) => {
            if (index < rating) {
                star.textContent = '\u2605';
                star.classList.add('text-yellow-400');
                star.classList.remove('text-gray-600');
            } else {
                star.textContent = '\u2606';
                star.classList.remove('text-yellow-400');
                star.classList.add('text-gray-600');
            }
        });

        ratingText.classList.add('hidden');
        selectedRating.textContent = `${rating}/5 - ${ratingMessages[rating]}`;
        selectedRating.classList.remove('hidden');

        if (rating > 0) {
            submitBtn.disabled = false;
            ratingError.textContent = '';
        } else {
            submitBtn.disabled = true;
            ratingError.textContent = 'Silakan beri rating sebelum mengirim review';
        }
    }

    setRating(0);

    const fileInput = document.getElementById('foto_review');
    const previewContainer = document.getElementById('image-preview');
    const previewImage = document.getElementById('preview-image');
    const fileName = document.getElementById('file-name');

    fileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const file = this.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                previewImage.src = e.target.result;
                fileName.textContent = file.name;
                previewContainer.classList.remove('hidden');
            }

            reader.readAsDataURL(file);
        }
    });

    function removeImage() {
        fileInput.value = '';
        previewContainer.classList.add('hidden');
        previewImage.src = '';
        fileName.textContent = '';
    }

    const komentarTextarea = document.getElementById('komentar');
    const charCount = document.getElementById('char-count');

    komentarTextarea.addEventListener('input', function() {
        const length = this.value.length;
        charCount.textContent = `${length}/500`;

        if (length > 500) {
            charCount.classList.add('text-rose-400');
        } else if (length >= 10) {
            charCount.classList.remove('text-rose-400');
            charCount.classList.add('text-emerald-400');
        } else {
            charCount.classList.remove('text-rose-400', 'text-emerald-400');
        }
    });

    document.querySelector('form').addEventListener('submit', function(e) {
        const komentar = komentarTextarea.value;
        const rating = ratingInput.value;

        if (rating == 0) {
            e.preventDefault();
            ratingError.textContent = 'Silakan beri rating sebelum mengirim review';
            stars[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
            return;
        }

        if (komentar.trim().length < 10) {
            e.preventDefault();
            ratingError.textContent = 'Komentar harus minimal 10 karakter';
            komentarTextarea.focus();
            return;
        }

        if (komentar.length > 500) {
            e.preventDefault();
            ratingError.textContent = 'Komentar maksimal 500 karakter';
            komentarTextarea.focus();
            return;
        }

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengirim...';
    });

    stars.forEach((star, index) => {
        star.addEventListener('mouseenter', () => {
            stars.forEach((s, i) => {
                if (i <= index) {
                    s.classList.add('text-black');
                }
            });
        });

        star.addEventListener('mouseleave', () => {
            stars.forEach((s, i) => {
                if (currentRating === 0 || i >= currentRating) {
                    s.classList.remove('text-black');
                }
            });
        });
    });
</script>


@endsection
