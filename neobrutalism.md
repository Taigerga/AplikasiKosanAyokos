# PROMPT REDESIGN UI/UX NEOBRUTALISM — WEB KOSAN LARAVEL 12

Analisis terlebih dahulu seluruh struktur project Laravel 12 website kosan ini sebelum melakukan perubahan apa pun. Identifikasi semua file yang berhubungan dengan tampilan seperti Blade, layout utama, komponen reusable, partial, Tailwind/Vite configuration, file CSS di `resources/css`, JavaScript frontend, icon set, font, serta pola styling yang sudah digunakan. Pahami juga struktur dashboard untuk seluruh role seperti admin, pemilik, dan penghuni agar redesign tetap konsisten di seluruh sistem. 

Lakukan redesign total pada tampilan UI/UX menggunakan tema **Neobrutalism Professional** yang modern, tegas, bersih, nyaman digunakan, dan tidak terlihat norak atau terlalu playful. Fokus utama redesign adalah meningkatkan kualitas visual, konsistensi layout, kenyamanan penggunaan, readability, serta kesan aplikasi manajemen kos yang premium dan profesional. Anda boleh menambahkan animasi yang unik dan menarik.

Gunakan ciri khas neobrutalism seperti:
- Border hitam tebal
- Shadow keras tanpa blur
- Bentuk card dan button tegas
- Warna kontras tinggi namun tetap nyaman dilihat
- Typography kuat dan modern
- Layout clean dengan spacing rapi
- Hover effect sederhana namun jelas
- Komponen UI yang solid dan konsisten

Gunakan kombinasi warna profesional seperti (ini hanya contoh sebenarnya bebas warnanya):
- Putih
- Hitam (biasanya untuk shadow)
- Abu terang
- Kuning mustard
- Biru electric
- Hijau lime soft
- Coral/red accent secukupnya
- Dan warna lainnya

Hindari:
- Gradient berlebihan
- Efek glassmorphism berlebihan
- Shadow blur modern
- UI terlalu ramai
- Warna terlalu mencolok
- Tampilan childish

Perbaiki seluruh tampilan:
- Navbar
- Sidebar
- Dashboard
- Card statistik
- Tabel data
- Form input
- Modal
- Button
- Badge status
- Pagination
- Alert
- Authentication page
- Profile page
- Halaman CRUD
- Halaman detail
- Empty state
- Loading state

Pastikan seluruh halaman responsive dan nyaman digunakan di desktop maupun mobile. Tingkatkan hierarchy visual, alignment, spacing, padding, margin, serta konsistensi ukuran komponen agar UI terlihat lebih modern dan profesional.

Gunakan font modern yang cocok dengan tema neobrutalism profesional seperti:
- Inter
- Space Grotesk
- IBM Plex Sans

PENTING:
- JANGAN mengubah logic aplikasi.
- JANGAN mengubah backend.
- JANGAN mengubah algoritma bisnis.
- JANGAN mengubah sistem CRUD.
- JANGAN mengubah relasi database.
- JANGAN mengubah routing.
- JANGAN mengubah controller logic.
- JANGAN mengubah validasi bisnis.
- JANGAN menghapus fitur existing.
- JANGAN mengubah struktur autentikasi dan role.
- Fokus perubahan hanya pada UI, UX, layout, styling, komponen frontend, dan visual improvement.

Pertahankan seluruh fitur agar tetap berjalan seperti sebelumnya tanpa breaking changes.

CSS project saat ini SUDAH DIPISAH di folder `resources/css`, jadi:
- Jangan menyatukan seluruh CSS ke satu file besar.
- Pertahankan struktur CSS modular.
- Rapikan arsitektur styling bila diperlukan.
- Pastikan reusable component tetap reusable.
- Jika ada inline style atau styling berantakan, refactor menjadi lebih modular dan scalable.

Jika menggunakan TailwindCSS:
- Optimalkan utility class dengan rapi.
- Gunakan component abstraction bila diperlukan.
- Hindari class yang berulang terlalu panjang.
- Pertahankan readability kode frontend.

Pastikan redesign tetap kompatibel dengan:
- Laravel 12
- Blade Component
- Vite
- TailwindCSS
- Existing frontend architecture

Hasil akhir harus memberikan kesan:
- Modern
- Profesional
- Clean
- Premium
- Powerful
- Nyaman digunakan
- Konsisten
- Responsive
- Neobrutalism yang elegan dan mature

Catatan Penting :
- Navbar, Sidebar, dan Footer diubah total menggunakan tema neobrutalism.
- Tampilan form input, modal, button, badge status, pagination, alert, authentication page, profile page, halaman CRUD, halaman detail, empty state, dan loading state diubah total menggunakan tema neobrutalism.
- Tambahkan animasi yang unik dan menarik. 
- Perhatikan folder resources/css, resource/js dan resources/views 