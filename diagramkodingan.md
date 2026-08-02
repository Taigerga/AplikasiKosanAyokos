# TUGAS: ANALISIS KODE UNTUK PENYUSUNAN SKPL DAN DDPL

Saya ingin Anda terlebih dahulu **membaca, memahami, dan menganalisis seluruh source code proyek ini secara menyeluruh** sebelum memberikan hasil analisis.

Jangan langsung membuat atau menggambar diagram. Jangan mengubah, menambahkan, atau menghapus kode apa pun.

Tujuan utama Anda adalah membuat **ketentuan, spesifikasi, dan panduan lengkap** mengenai apa saja yang harus dimasukkan ke dalam dokumen **SKPL (Spesifikasi Kebutuhan Perangkat Lunak)** dan **DDPL (Desain/Deskripsi Detail Perangkat Lunak)** berdasarkan implementasi sistem yang benar-benar ada di dalam source code.

Jangan membuat asumsi yang tidak didukung oleh source code. Jika terdapat fitur yang direncanakan tetapi belum diimplementasikan, pisahkan dengan jelas antara:

* Fitur yang sudah benar-benar diimplementasikan
* Fitur yang sebagian sudah diimplementasikan
* Fitur yang belum diimplementasikan
* Fitur yang ditemukan di dokumentasi tetapi tidak ditemukan implementasinya di source code

---

# TAHAP 1 — PAHAMI DAN ANALISIS SOURCE CODE

Sebelum memberikan hasil, lakukan analisis terhadap:

1. Struktur folder dan file proyek
2. Framework dan versi yang digunakan jika dapat ditemukan
3. Bahasa pemrograman yang digunakan
4. Frontend
5. Backend
6. Database dan struktur tabel/migrasi
7. Model dan relasi antar model
8. Controller
9. Service/Repository jika ada
10. Route dan endpoint API
11. Middleware
12. Authentication dan Authorization
13. Role dan Permission
14. Validasi input
15. Business Logic
16. Integrasi dengan layanan eksternal
17. File upload dan penyimpanan
18. Notifikasi
19. Payment jika ada
20. Struktur UI dan halaman
21. Deployment atau konfigurasi server jika dapat ditemukan
22. Konfigurasi environment yang relevan
23. Keamanan sistem
24. Fitur setiap role/stakeholder

Jika proyek memiliki beberapa stakeholder/role, identifikasi seluruh role yang benar-benar ditemukan dalam kode.

Contoh jika terdapat:

* Admin
* Pemilik
* Penghuni

Maka analisis hak akses dan fitur masing-masing role secara terpisah.

---

# BAGIAN A — SKPL

Buat analisis dan ketentuan untuk isi SKPL berdasarkan source code.

## 1. Kebutuhan Fungsional

Jangan hanya memberikan contoh umum.

Identifikasi dan sebutkan **seluruh kebutuhan fungsional yang benar-benar dapat dibuktikan dari source code**.

Kelompokkan berdasarkan aktor/role.

Contoh struktur:

### Admin

* Admin dapat ...
* Admin dapat ...
* Admin dapat ...

### Pemilik

* Pemilik dapat ...
* Pemilik dapat ...

### Penghuni

* Penghuni dapat ...
* Penghuni dapat ...

Untuk setiap kebutuhan, jika memungkinkan, sebutkan bukti implementasinya, misalnya:

* Route
* Controller
* Model
* Service
* View/Page
* API Endpoint

Tujuannya agar kebutuhan fungsional dapat ditelusuri kembali ke implementasi.

---

## 2. Kebutuhan Nonfungsional

Identifikasi kebutuhan nonfungsional yang **sudah diterapkan atau dapat dibuktikan dari source code dan konfigurasi proyek**.

Kelompokkan, jika relevan, menjadi:

* Security
* Performance
* Availability
* Reliability
* Usability
* Maintainability
* Scalability
* Compatibility
* Authentication
* Authorization
* Rate Limiting
* Data Validation
* Error Handling
* Logging
* Backup
* Privacy
* dan aspek lain yang relevan

Untuk setiap kebutuhan nonfungsional, jelaskan:

1. Ketentuan/kebutuhannya
2. Implementasi yang ditemukan
3. Bukti dari source code/configuration
4. Status: Implemented / Partial / Not Found

Jangan mengarang angka atau standar jika tidak ditemukan dalam kode.

---

## 3. Use Case Diagram — KETENTUAN PEMBUATAN

Jangan membuat Use Case Diagram.

Berikan **ketentuan lengkap mengenai bagaimana Use Case Diagram harus dibuat berdasarkan source code**.

Sebutkan:

### Aktor

Identifikasi seluruh aktor yang harus ada.

### Use Case

Sebutkan seluruh use case yang harus dimasukkan.

### Relasi Aktor → Use Case

Jelaskan aktor mana yang terhubung dengan use case mana.

### Relasi antar Use Case

Jika terdapat:

* <<include>>
* <<extend>>
* Generalization

Identifikasi dan jelaskan relasinya berdasarkan alur sistem.

### Batas Sistem

Jelaskan apa yang harus menjadi System Boundary.

### Ketentuan Diagram

Jelaskan:

* Nama sistem
* Aktor di luar boundary
* Use case di dalam boundary
* Penamaan use case
* Relasi yang harus digunakan

Hasil akhir harus berupa **spesifikasi untuk membuat Use Case Diagram**, bukan gambar diagram.

---

## 4. Activity Diagram — KETENTUAN PEMBUATAN

Jangan membuat Activity Diagram.

Identifikasi proses-proses utama yang **wajib atau disarankan dibuat Activity Diagram** berdasarkan source code.

Untuk setiap Activity Diagram, jelaskan:

1. Nama proses
2. Aktor yang terlibat
3. Kondisi awal
4. Trigger
5. Langkah-langkah proses secara berurutan
6. Percabangan/Decision
7. Kondisi sukses
8. Kondisi gagal
9. Kondisi akhir
10. Proses yang berjalan di backend
11. Interaksi dengan database jika relevan

Prioritaskan proses utama seperti:

* Authentication
* Registrasi
* Login
* Pengelolaan data
* Pengajuan
* Persetujuan
* Pembayaran
* Pengaduan
* dan proses bisnis utama lainnya yang benar-benar ditemukan.

Hasil akhir harus berupa **ketentuan/alur yang dapat digunakan untuk membuat Activity Diagram**, bukan diagram.

---

# BAGIAN B — DDPL

## 5. Arsitektur Sistem — KETENTUAN

Jangan membuat gambar arsitektur.

Berdasarkan source code, jelaskan arsitektur sistem yang sebenarnya digunakan.

Sebutkan:

1. Frontend
2. Backend
3. Framework
4. Database
5. API
6. Authentication
7. Authorization
8. Middleware
9. Storage
10. Third-party service
11. Web Server jika diketahui
12. Hosting/VPS jika diketahui
13. Protokol komunikasi
14. Alur komunikasi antar komponen

Buat dalam bentuk penjelasan dan struktur teks.

Contoh:

User
→ Frontend
→ API
→ Backend
→ Database

Jika arsitekturnya berbeda, gunakan arsitektur yang benar-benar sesuai dengan source code.

---

## 6. ERD — KETENTUAN PEMBUATAN

Jangan membuat ERD.

Analisis database dan tentukan spesifikasi ERD yang harus dibuat.

Sebutkan:

### Entitas/Tabel

Identifikasi seluruh tabel utama.

Untuk setiap tabel:

* Nama tabel
* Primary Key
* Foreign Key
* Kolom penting
* Tipe data jika relevan

### Relasi

Jelaskan seluruh hubungan antar entitas:

* One-to-One
* One-to-Many
* Many-to-Many

### Kardinalitas

Jelaskan kardinalitas setiap relasi.

### Pivot/Junction Table

Jika ada relasi Many-to-Many, identifikasi tabel pivot.

### Ketentuan ERD

Jelaskan tabel dan relasi apa saja yang wajib ditampilkan dalam ERD utama.

Hasil harus berupa spesifikasi ERD, bukan gambar.

---

## 7. Class Diagram — KETENTUAN PEMBUATAN

Jangan membuat Class Diagram.

Identifikasi class utama berdasarkan source code.

Kelompokkan jika relevan:

* Model
* Controller
* Service
* Repository
* Middleware
* Request/DTO
* Resource
* Helper
* dan class penting lainnya

Untuk setiap class utama, jelaskan:

1. Nama class
2. Tanggung jawab
3. Attribute/properties penting
4. Method/function penting
5. Relasi antar class
6. Inheritance
7. Dependency
8. Association
9. Aggregation/Composition jika memang ada

Jelaskan class mana yang sebaiknya dimasukkan dalam Class Diagram utama dan mana yang tidak perlu ditampilkan agar diagram tidak terlalu kompleks.

Jangan mengarang class yang tidak ada.

---

## 8. Sequence Diagram — KETENTUAN PEMBUATAN

Jangan membuat Sequence Diagram.

Identifikasi proses-proses utama yang perlu dibuat Sequence Diagram berdasarkan source code.

Untuk setiap Sequence Diagram, tentukan:

1. Nama proses
2. Actor
3. Boundary/UI
4. Controller
5. Service jika ada
6. Model
7. Database
8. External Service jika ada

Kemudian jelaskan urutan interaksi:

Actor
→ UI/Frontend
→ API/Route
→ Middleware
→ Controller
→ Service
→ Model
→ Database
→ Response

Sesuaikan dengan arsitektur aktual proyek.

Untuk setiap proses, jelaskan:

* Request
* Validasi
* Authorization
* Business Logic
* Database Query
* Response
* Error Handling

Hasil harus berupa spesifikasi urutan interaksi yang dapat digunakan untuk membuat Sequence Diagram.

---

## 9. Desain API — KETENTUAN

Jangan membuat atau menulis ulang API.

Analisis API yang sudah ada dari source code.

Buat daftar:

* HTTP Method
* Endpoint
* Authentication
* Authorization/Role
* Controller
* Fungsi
* Request Parameter
* Request Body
* Response
* HTTP Status Code jika dapat ditemukan
* Validasi
* Error Response

Kelompokkan berdasarkan modul atau role.

Contoh:

### Authentication API

* POST /...
* POST /...
* GET /...

### Admin API

* ...

### Pemilik API

* ...

### Penghuni API

* ...

Jika proyek tidak menggunakan REST API untuk bagian tertentu, jelaskan mekanisme komunikasi yang digunakan.

Bedakan dengan jelas antara:

* API yang benar-benar ada
* API yang dipanggil frontend
* API yang direncanakan tetapi belum ada

---

## 10. UI / Mockup — KETENTUAN

Jangan membuat desain UI atau mockup.

Analisis tampilan yang sudah ada dalam source code.

Identifikasi halaman berdasarkan role.

Contoh:

### Admin

* Login
* Dashboard
* User Management
* ...

### Pemilik

* Dashboard
* Data Kos
* Data Kamar
* ...

### Penghuni

* Dashboard
* ...

Untuk setiap halaman, jelaskan:

1. Nama halaman
2. Role yang dapat mengakses
3. Tujuan halaman
4. Komponen UI utama
5. Data yang ditampilkan
6. Tombol/aksi
7. Form input
8. Navigasi
9. Status/feedback
10. Responsive behavior jika dapat ditemukan

Hasil ini digunakan sebagai **ketentuan untuk membuat UI/Mockup dokumentasi DDPL**, bukan membuat desainnya.

---

## 11. Deployment Diagram — KETENTUAN PEMBUATAN

Jangan membuat Deployment Diagram.

Jika terdapat informasi deployment dalam source code, dokumentasi, konfigurasi, Docker, Nginx, VPS, atau environment, identifikasi:

* Client/User Device
* Browser/Mobile App
* Internet
* Domain
* Web Server
* Application Server
* Backend
* Database Server
* File Storage
* External Service
* Queue/Worker
* Cache
* dan komponen deployment lain yang ditemukan.

Jelaskan hubungan antar node.

Jika informasi deployment tidak ditemukan dalam source code, katakan dengan jelas bahwa informasi tersebut tidak dapat dipastikan dari source code dan jangan mengarang.

---

# BAGIAN C — RINGKASAN KETENTUAN DOKUMENTASI

Setelah semua analisis selesai, buat tabel ringkasan:

| Dokumen | Bagian                  | Perlu Dibuat | Sumber/Bukti       | Status |
| ------- | ----------------------- | ------------ | ------------------ | ------ |
| SKPL    | Kebutuhan Fungsional    | Ya           | Source Code        | ...    |
| SKPL    | Kebutuhan Nonfungsional | Ya           | Source Code/Config | ...    |
| SKPL    | Use Case Diagram        | Ya           | Role & Feature     | ...    |
| SKPL    | Activity Diagram        | Ya           | Business Process   | ...    |
| DDPL    | Arsitektur Sistem       | Ya           | Architecture       | ...    |
| DDPL    | ERD                     | Ya           | Database           | ...    |
| DDPL    | Class Diagram           | Ya           | Source Code        | ...    |
| DDPL    | Sequence Diagram        | Ya           | Flow/Controller    | ...    |
| DDPL    | Desain API              | Ya           | Routes/API         | ...    |
| DDPL    | UI/Mockup               | Ya           | Frontend/View      | ...    |
| DDPL    | Deployment Diagram      | Ya/Tidak     | Deployment Config  | ...    |

---

# ATURAN PENTING

1. Jangan membuat diagram dalam bentuk gambar.
2. Jangan membuat kode baru.
3. Jangan mengubah source code.
4. Jangan langsung mengimplementasikan hasil analisis.
5. Jangan membuat asumsi yang tidak memiliki bukti.
6. Semua hasil harus berdasarkan source code aktual.
7. Jika data tidak ditemukan, tulis "Tidak ditemukan dalam source code".
8. Bedakan antara fitur yang sudah ada dan fitur yang belum ada.
9. Jangan menganggap semua route sebagai fitur yang selesai jika implementasinya belum lengkap.
10. Jangan menganggap semua tabel sebagai fitur yang digunakan jika tidak ada alur penggunaannya.
11. Gunakan nama class, tabel, route, controller, endpoint, dan komponen sesuai nama sebenarnya di source code.
12. Jika terdapat ketidaksesuaian antara database, backend, API, dan frontend, identifikasi ketidaksesuaian tersebut.
13. Jika ada fitur yang sudah direncanakan tetapi belum diimplementasikan, masukkan ke bagian "Gap/Temuan".
14. Jika ada fitur yang diimplementasikan tetapi belum terdokumentasi dalam kebutuhan, identifikasi juga.
15. Prioritaskan akurasi berdasarkan source code daripada asumsi atau dokumentasi lama.

# FORMAT HASIL AKHIR

Susun hasil analisis dengan struktur:

# ANALISIS SKPL DAN DDPL

## A. Ringkasan Proyek

## B. Teknologi dan Stack

## C. Role/Stakeholder

## D. SKPL

### D.1 Kebutuhan Fungsional

### D.2 Kebutuhan Nonfungsional

### D.3 Ketentuan Use Case Diagram

### D.4 Ketentuan Activity Diagram

## E. DDPL

### E.1 Ketentuan Arsitektur Sistem

### E.2 Ketentuan ERD

### E.3 Ketentuan Class Diagram

### E.4 Ketentuan Sequence Diagram

### E.5 Ketentuan Desain API

### E.6 Ketentuan UI/Mockup

### E.7 Ketentuan Deployment Diagram

## F. Gap Analysis

* Fitur yang sudah ada tetapi belum terdokumentasi
* Fitur yang terdokumentasi tetapi belum ada
* Fitur yang hanya sebagian diimplementasikan
* Ketidaksesuaian antar komponen sistem

## G. Tabel Ringkasan Ketentuan SKPL dan DDPL

Sekali lagi, **jangan membuat diagramnya**. Saya hanya ingin Anda **menganalisis source code dan memberikan ketentuan/spesifikasi detail mengenai apa yang harus dibuat dalam setiap diagram dan bagian SKPL/DDPL**.
