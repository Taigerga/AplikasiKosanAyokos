# AGENT.md

# AI Migration Agent — Panduan Migrasi AyoKos ke REST API Architecture

## 1. Tujuan Utama

AI Agent ini bertugas untuk membantu:
- menganalisis
- mendokumentasikan
- merapikan
- dan melakukan migrasi

website **AyoKos** dari arsitektur:

```text
Traditional Laravel Monolith
(Blade + Web Controller + Server Side Rendering)
```

menjadi:

```text
Hybrid REST API Architecture
(Web Controller + API Controller + AJAX/Axios)
```

Migrasi WAJIB tetap mempertahankan (kalau dibutuhkan berubah ubah saja ):
- seluruh fitur existing
- business logic existing
- role pengguna
- middleware
- relasi database
- struktur folder existing
- tampilan existing

---

# 2. Prinsip Utama Migrasi

Migrasi menggunakan:

```text
Incremental Migration Strategy
```

Artinya:
- sistem lama tetap berjalan
- Blade tetap digunakan
- Web Controller tetap digunakan
- API Controller digunakan bertahap
- migrasi dilakukan per fitur
- tidak melakukan rewrite total

---

# 3. Struktur Project Existing

Project Laravel memiliki struktur controller seperti berikut:

```text
app/Http/Controllers/
├── Pemilik/
├── Penghuni/
├── Public/
├── Auth/
├── Admin/
├── Controller.php
├── KosanController.php
├── ProfileController.php
│
└── API/
    ├── Pemilik/
    ├── Penghuni/
    ├── Admin/
    ├── Public/
    └── Auth/
```

CATATAN:
- Folder `API/` sudah ada namun implementasinya belum tentu benar.
- AI Agent wajib mengecek:
  - struktur API
  - penamaan controller
  - response JSON
  - route API
  - middleware API
  - consistency architecture

AI Agent wajib merapikan dan menyesuaikan struktur tersebut tanpa merusak sistem existing.

---

# 4. Tujuan Penggunaan Web Controller dan API Controller

---

# Web Controller

Web Controller digunakan hanya untuk:

- return Blade view
- render halaman
- initial page load
- passing data awal ke view
- layout rendering

Web Controller TIDAK BOLEH:
- berisi business logic besar
- menangani proses CRUD berat
- return JSON
- menangani AJAX response

Contoh:

```php
return view('pemilik.dashboard');
```

---

# API Controller

API Controller digunakan untuk:

- CRUD data
- AJAX request
- JSON response
- validasi API
- komunikasi frontend JavaScript
- REST API endpoint

Fitur berikut bersifat OPSIONAL:
- mobile apps
- React
- Vue
- Next.js

API Controller TIDAK BOLEH:
- return Blade
- redirect()
- menggunakan session flash

Contoh:

```php
return response()->json([
    'success' => true,
    'data' => $data
]);
```

---

# 5. Service Layer Rules

Laravel 12 tidak memiliki folder `Services` bawaan.

Namun untuk project AyoKos yang memiliki:
- banyak role
- banyak CRUD
- Web Controller
- API Controller
- shared business logic

maka AI Agent DIWAJIBKAN membuat folder:

```text
app/Services/
```

Tujuannya agar:
- business logic tidak duplikat
- Web Controller dan API Controller dapat memakai logic yang sama
- controller tetap kecil
- maintenance lebih mudah

Contoh struktur:

```text
app/Services/
├── Pemilik/
├── Penghuni/
├── Auth/
├── Pembayaran/
└── Kos/
```

Contoh penggunaan:

```text
Web Controller
    ↓
Service
    ↓
Model

API Controller
    ↓
Service
    ↓
Model
```

Business logic utama HARUS dipindahkan ke Service Layer.

---

# 6. Target Arsitektur Akhir

Target arsitektur:

```text
Blade Frontend
        ↓
AJAX / Axios 
        ↓
API Controller
        ↓
Service Layer
        ↓
Model
        ↓
Database
```

---

# 7. Rules Routing

AI Agent wajib mengecek dan menyesuaikan:

```text
routes/web.php
routes/api.php
```

---

# web.php

Digunakan untuk:
- halaman
- Blade
- dashboard
- page rendering

---

# api.php

Digunakan untuk:
- CRUD API
- AJAX endpoint
- JSON response

---

# 8. Rules JavaScript

JavaScript TIDAK BOLEH inline di Blade jika logic sudah besar.

Semua JavaScript wajib dipisahkan ke:

```text
resources/js/
```

Contoh struktur:

```text
resources/js/
├── app.js
├── services/
│   └── api-client.js
│
├── modules/
│   ├── kos/
│   ├── kamar/
│   ├── pembayaran/
│   └── auth/
```

AI Agent wajib:
- memindahkan script besar dari Blade
- memisahkan JS berdasarkan fitur
- menggunakan Vite
- menggunakan Axios API

---

# 9. Rules Refactor Form

Form lama:

```html
<form method="POST">
```

harus secara bertahap diubah menjadi:

```text
AJAX Submission
```

menggunakan:
- preventDefault()
- async/await
- Axios
- FormData
- JSON response

Tanpa:
- full reload
- redirect back
- session flash dependency

---

# 10. Standarisasi JSON API

Success response:

```json
{
    "success": true,
    "message": "Berhasil",
    "data": {}
}
```

Error response:

```json
{
    "success": false,
    "message": "Validation Error",
    "errors": {}
}
```

---

# 11. Standard HTTP Status

| Status | Fungsi |
|---|---|
| 200 | Success |
| 201 | Created |
| 401 | Unauthorized |
| 403 | Forbidden |
| 404 | Not Found |
| 422 | Validation Error |
| 500 | Server Error |

---

# 12. Authentication Rules

Gunakan:

```text
Laravel Sanctum
```

Untuk:
- API Authentication
- Bearer Token
- AJAX Authentication

AI Agent wajib:
- mempertahankan login existing
- mempertahankan middleware
- mempertahankan role access

---

# 13. Database Rules

AI Agent TIDAK BOLEH:
- menghapus tabel
- mengubah relasi sembarangan
- menghapus foreign key
- mengubah struktur tanpa instruksi

AI Agent wajib:
- mempertahankan migration
- mempertahankan relasi
- mempertahankan transaction logic

---

# 14. Error Handling Rules

Frontend wajib menangani:
- validation error
- unauthorized
- token expired
- network error
- internal server error

Contoh:

```javascript
try {

} catch(error) {

    console.error(error);

}
```

---

# 15. AI Agent Mandatory Behavior

AI Agent WAJIB:
- membaca seluruh struktur project terlebih dahulu
- mengecek controller existing
- mengecek route existing
- mengecek API existing
- mengecek JavaScript existing
- mengecek middleware existing
- mengecek business logic existing

AI Agent wajib:
- menjaga kompatibilitas sistem
- menjaga struktur folder
- menjaga naming convention
- menghindari duplicate logic
- mendokumentasikan perubahan

AI Agent TIDAK BOLEH:
- rewrite total project (kecuali dibutuhkan)
- menghapus fitur existing
- memindahkan file sembarangan
- membuat duplicate CRUD logic

---

# 16. Workflow Migrasi yang Direkomendasikan

```text
1. Analisis Struktur Laravel Existing
2. Analisis Route web.php dan api.php
3. Analisis Controller Existing
4. Analisis API Existing
5. Membuat/Merapikan Service Layer
6. Memindahkan Business Logic ke Service
7. Merapikan API Controller
8. Refactor Form Blade menjadi AJAX
9. Memindahkan JavaScript ke resources/js
10. Menambahkan Axios/API Client
11. Standarisasi JSON Response
12. Menambahkan Error Handling
13. Optimasi Struktur Frontend
```

---

# 17. Target Akhir Sistem

Hasil akhir yang diharapkan:

✅ Hybrid Laravel Architecture  
✅ Web Controller tetap digunakan  
✅ API Controller berjalan normal  
✅ Shared Service Layer  
✅ AJAX-based Blade  
✅ REST API terpusat  
✅ Struktur code lebih rapi  
✅ Tidak ada duplicate business logic  
✅ Siap dikembangkan ke Vue/React jika diperlukan  
✅ Maintainable dan scalable  