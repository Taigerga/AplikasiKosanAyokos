@extends('layouts.app')

@section('title', 'Beri Review - AyoKos')

@section('content')
<div class="p-4 md:p-6 max-w-2xl mx-auto space-y-6">
    <!-- Breadcrumb -->
    <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-xl p-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-2 md:space-x-4">
                <li class="inline-flex items-center">
                    <a href="{{ route('public.home') }}"
                       class="inline-flex items-center text-sm font-medium text-white/60 hover:text-white transition">
                        <i class="fas fa-gauge mr-2"></i>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-white/20 mx-2 text-sm"></i>
                        <a href="{{ route('public.kos.show', $kos->id_kos) }}"
                           class="ml-1 text-sm font-medium text-white/60 hover:text-white transition">
                            <i class="fas fa-home mr-2"></i>
                            {{ $kos->nama_kos }}
                        </a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-white/20 mx-2 text-sm"></i>
                        <span class="ml-1 text-sm font-medium text-white">
                            <i class="fas fa-plus mr-2"></i>
                            Beri Review
                        </span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-2xl overflow-hidden">
        <!-- Header -->
        <div class="bg-white/5 backdrop-blur-sm border-b border-white/20 p-6">
            <div class="text-center">
                <div class="w-16 h-16 bg-white/5 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-star text-white text-2xl"></i>
                </div>
                <h1 class="text-2xl md:text-3xl font-bold text-white mb-2">Beri Review untuk</h1>
                <h2 class="text-xl text-emerald-400 font-semibold">{{ $kos->nama_kos }}</h2>
                <p class="text-white/60 mt-2">Bagikan pengalaman Anda selama tinggal di kos ini</p>
            </div>
        </div>

        <!-- Content -->
        <div class="p-6">
            <form action="{{ route('penghuni.reviews.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_kos" value="{{ $kos->id_kos }}">

                <!-- Kos Info Card -->
                <div class="bg-white/5 backdrop-blur-sm border border-white/20 rounded-xl p-4 mb-6">
                    <div class="flex items-center space-x-4">
                        @if($kos->foto_utama)
                        @php
                        $filePath = storage_path('app/public/' . $kos->foto_utama);
                        $fileExists = file_exists($filePath);
                        @endphp
                        @if($fileExists)
                        <img src="{{ url('storage/' . $kos->foto_utama) }}"
                             alt="{{ $kos->nama_kos }}"
                             class="w-16 h-16 object-cover rounded-xl">
                        @else
                        <div class="w-16 h-16 bg-white/5 backdrop-blur-sm rounded-xl flex items-center justify-center">
                            <i class="fas fa-home text-2xl text-white/40"></i>
                        </div>
                        @endif
                        @else
                        <div class="w-16 h-16 bg-white/5 backdrop-blur-sm rounded-xl flex items-center justify-center">
                            <i class="fas fa-home text-2xl text-white/40"></i>
                        </div>
                        @endif
                        <div class="flex-1">
                            <h3 class="font-semibold text-white mb-1">{{ $kos->nama_kos }}</h3>
                            <div class="flex items-center text-white/60 text-sm">
                                <i class="fas fa-map-marker-alt mr-2 text-emerald-400"></i>
                                <span>{{ $kos->alamat }}, {{ $kos->kota }}</span>
                            </div>
                            <div class="mt-2 flex items-center">
                                <span class="px-2 py-1 text-xs rounded-lg bg-emerald-50 text-emerald-600">
                                    {{ ucfirst($kos->jenis_kos) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rating Section -->
                <div class="mb-8">
                    <label class="block text-white font-semibold mb-4 text-lg">
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
                        <p id="rating-text" class="text-white/60">Pilih rating dengan mengklik bintang di atas</p>
                        <p id="selected-rating" class="text-xl font-bold text-yellow-400 hidden mt-2"></p>
                    </div>

                    <div class="mt-2 text-sm text-red-400" id="rating-error"></div>
                    @error('rating')
                    <div class="mt-2 text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Komentar Section -->
                <div class="mb-8">
                    <label for="komentar" class="block text-white font-semibold mb-4 text-lg">
                        <i class="fas fa-edit text-emerald-400 mr-2"></i>
                        Ceritakan Pengalaman Anda
                    </label>

                    <div class="relative">
                        <textarea name="komentar" id="komentar"
                                  rows="6"
                                  class="w-full px-4 py-3 bg-white/5 backdrop-blur-sm border border-white/20 text-white rounded-xl focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/30 transition placeholder-white/40"
                                  placeholder="Bagaimana pengalaman Anda selama tinggal di kos ini? (minimal 10 karakter)"
                                  required>{{ old('komentar') }}</textarea>

                        <div class="absolute bottom-3 right-3 flex items-center space-x-2">
                            <span id="char-count" class="text-xs text-white/60">0/500</span>
                        </div>
                    </div>

                    <div class="mt-3">
                        <p class="text-sm text-white/60 mb-2">Saran topik yang bisa dibahas:</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 text-xs rounded-full bg-white/5 backdrop-blur-sm text-white/60">Kebersihan</span>
                            <span class="px-3 py-1 text-xs rounded-full bg-white/5 backdrop-blur-sm text-white/60">Fasilitas</span>
                            <span class="px-3 py-1 text-xs rounded-full bg-white/5 backdrop-blur-sm text-white/60">Lokasi</span>
                            <span class="px-3 py-1 text-xs rounded-full bg-white/5 backdrop-blur-sm text-white/60">Keamanan</span>
                            <span class="px-3 py-1 text-xs rounded-full bg-white/5 backdrop-blur-sm text-white/60">Layanan Pemilik</span>
                        </div>
                    </div>

                    @error('komentar')
                    <div class="mt-2 text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Foto Review Section -->
                <div class="mb-8">
                    <label class="block text-white font-semibold mb-4 text-lg">
                        <i class="fas fa-camera text-purple-400 mr-2"></i>
                        Upload Foto (Opsional)
                    </label>

                    <div class="space-y-4">
                        <div class="flex items-center justify-center w-full">
                            <label for="foto_review" class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-white/20 rounded-2xl cursor-pointer bg-white/5 backdrop-blur-sm hover:bg-white/10 transition group">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <div class="w-12 h-12 bg-white/5 backdrop-blur-sm rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                                        <i class="fas fa-cloud-upload-alt text-purple-400 text-xl"></i>
                                    </div>
                                    <p class="mb-2 text-sm text-white/60 group-hover:text-white transition">
                                        <span class="font-semibold">Klik untuk upload</span> atau drag & drop
                                    </p>
                                    <p class="text-xs text-white/60">PNG, JPG, GIF (Max 2MB)</p>
                                </div>
                                <input id="foto_review" name="foto_review" type="file" class="hidden" accept="image/*" />
                            </label>
                        </div>

                        <div id="image-preview" class="hidden">
                            <div class="flex items-center justify-between bg-white/5 backdrop-blur-sm border border-white/20 rounded-xl p-4">
                                <div class="flex items-center space-x-4">
                                    <img id="preview-image" class="w-16 h-16 object-cover rounded-lg" />
                                    <div>
                                        <p class="text-white font-medium">Foto terpilih</p>
                                        <p id="file-name" class="text-sm text-white/60"></p>
                                    </div>
                                </div>
                                <button type="button"
                                        onclick="removeImage()"
                                        class="text-red-400 hover:text-red-300 transition">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    @error('foto_review')
                    <div class="mt-2 text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Info Box -->
                <div class="bg-emerald-500/10 border border-emerald-500/20 rounded-xl p-4 mb-8">
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-white/5 backdrop-blur-sm rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-info-circle text-emerald-400"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-white mb-2">Info Penting</h4>
                            <ul class="text-sm text-white/60 space-y-2">
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
                <div class="flex justify-end space-x-3 pt-4 border-t border-white/20">
                    <a href="{{ route('public.kos.show', $kos->id_kos) }}"
                       class="px-6 py-3 bg-white/5 backdrop-blur-sm border border-white/20 text-white rounded-xl hover:bg-white/10 transition flex items-center">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </a>
                    <button type="submit"
                            id="submit-btn"
                            class="px-6 py-3 bg-emerald-500/20 backdrop-blur-sm border border-emerald-500/20 text-white rounded-xl hover:bg-emerald-500/30 font-semibold disabled:opacity-50 disabled:cursor-not-allowed transition flex items-center">
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
                star.classList.remove('text-white/60');
            } else {
                star.textContent = '\u2606';
                star.classList.remove('text-yellow-400');
                star.classList.add('text-white/60');
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
            charCount.classList.add('text-red-400');
        } else if (length >= 10) {
            charCount.classList.remove('text-red-400');
            charCount.classList.add('text-emerald-400');
        } else {
            charCount.classList.remove('text-red-400', 'text-emerald-400');
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
                    s.classList.add('text-yellow-300');
                }
            });
        });

        star.addEventListener('mouseleave', () => {
            stars.forEach((s, i) => {
                if (currentRating === 0 || i >= currentRating) {
                    s.classList.remove('text-yellow-300');
                }
            });
        });
    });
</script>

<style>
    .rating-star {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
    }

    .rating-star:hover {
        transform: scale(1.15);
    }

    textarea {
        resize: none;
    }

    #char-count {
        transition: color 0.2s ease;
    }

    textarea::-webkit-scrollbar {
        width: 6px;
    }

    textarea::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 3px;
    }

    textarea::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 3px;
    }

    textarea::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.3);
    }
</style>
@endsection
