# Panduan Migrasi: Arsitektur Web Berbasis REST API

## 1. Tujuan Utama
Merubah arsitektur website **AyoKos** dari sistem *Traditional Monolith* (Server-Side Rendering dengan Blade) menjadi *API-Driven Web Application*. Nantinya, Frontend (Browser) akan berkomunikasi langsung dengan **API Controllers** menggunakan JavaScript (AJAX/Fetch), bukan lagi melalui Web Controllers.

## 2. Kenapa Migrasi?
- **Single Source of Truth**: Satu API Controller untuk Web, Android, dan iOS.
- **Better UX**: Interaksi di website menjadi lebih cepat karena tidak perlu reload halaman (SPA/Partial Reload).
- **Modern Stack**: Memudahkan integrasi dengan framework modern seperti React, Vue, atau Mobile Apps.

## 3. Langkah-Langkah Teknis

### Tahap 1: Persiapan Autentikasi (Laravel Sanctum)
Karena API tidak menggunakan Session browser biasa, kita harus menggunakan **Laravel Sanctum**.
- Install Sanctum.
- Gunakan Trait `HasApiTokens` di Model `User`.
- Pastikan login via API mengembalikan **Bearer Token**.

### Tahap 2: Setup Frontend (JavaScript)
Gunakan library seperti **Axios** untuk mempermudah pemanggilan API.
- Tambahkan library Axios di `app.blade.php`.
- Buat file JavaScript khusus (misal: `api-client.js`) untuk menyimpan base URL API dan header token.

### Tahap 3: Refactor Form Blade ke AJAX
Ubah setiap Form di file Blade dari:
```html
<!-- LAMA -->
<form method="POST" action="{{ route('pemilik.kos.update') }}">

<!-- BARU -->
<form id="formUpdateKos">

const form = document.getElementById('formUpdateKos');
form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(form);
    const response = await axios.post('/api/pemilik/kos/update/1', formData);
    // Tampilkan notifikasi sukses tanpa reload
});

### Tahap 5: Manajemen File JavaScript (Vite)
Untuk menjaga kode tetap rapi dan ringan, pisahkan kodingan JavaScript berdasarkan fungsi atau halaman.
1. **Struktur File**:
   - `resources/js/kos.js` (Logika khusus Kos)
   - `resources/js/kamar.js` (Logika khusus Kamar)
2. **Konfigurasi `vite.config.js`**:
   Daftarkan file baru ke dalam array `input` agar diproses oleh Vite:
   ```javascript
   laravel({
       input: [
           'resources/css/app.css',
           'resources/js/app.js',
           'resources/js/kos.js',
           'resources/js/kamar.js'
       ],
       refresh: true,
   }),

@push('scripts')
    @vite('resources/js/kos.js')
@endpush

