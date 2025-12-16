# Dokumentasi Perubahan Web RST dr Asmir Salatiga

## Tanggal Pembuatan Dokumen: 11 Desember 2025
## Status Proyek: Sedang Berjalan

---

## Daftar Isi
1. Perubahan pada Halaman Home
2. Perubahan pada Gambar Layanan
3. Perubahan pada Tampilan Dokter
4. Perubahan pada Artikel
5. Perubahan pada Layanan (Fitur Dropdown)
6. Error dan Solusi
7. Status Penyelesaian
8. Perbaikan Sesi Lanjutan (11 Desember 2025)
9. Peningkatan Fitur Lanjutan (16 Desember 2025)

---

## 1. Perubahan pada Halaman Home

### 1.1 Pindahkan Bagian "Tentang Kami"
- **Deskripsi**: Memindahkan bagian "Tentang Kami" dari posisi tengah ke posisi paling bawah halaman home
- **File Terpengaruh**: `resources/views/home.blade.php`
- **Status**: ✅ SELESAI

### 1.2 Perbaikan Gambar Layanan
- **Deskripsi**: Memastikan gambar layanan seperti "Laborat" dan "Konsultasi Gigi" muncul dengan benar
- **File Terpengaruh**: `resources/views/home.blade.php`
- **Status**: ✅ SELESAI

---

## 2. Perubahan pada Gambar Layanan

### 2.1 Mapping Nama File Gambar
- **Deskripsi**: Membuat mapping antara judul layanan dan nama file gambar yang sesuai
- **File Terpengaruh**: `resources/views/home.blade.php`
- **Status**: ✅ SELESAI

### 2.2 Pencarian Gambar Alternatif
- **Deskripsi**: Menambahkan logika untuk mencari file gambar dengan beberapa kemungkinan nama
- **File Terpengaruh**: `resources/views/home.blade.php`
- **Status**: ✅ SELESAI

---

## 3. Perubahan pada Tampilan Dokter

### 3.1 Tampilan 4 Dokter Acak
- **Deskripsi**: Menampilkan 4 dokter secara acak di halaman home
- **File Terpengaruh**: `resources/views/home.blade.php`
- **Status**: ✅ SELESAI

### 3.2 Penyesuaian Path Gambar Dokter
- **Deskripsi**: Mengganti path akses gambar dokter dari storage ke uploads
- **File Terpengaruh**: `resources/views/home.blade.php`
- **Status**: ✅ SELESAI

### 3.3 Placeholder Gambar Dokter
- **Deskripsi**: Menampilkan placeholder generik jika file gambar tidak ditemukan
- **File Terpengaruh**: `resources/views/home.blade.php`
- **Status**: ✅ SELESAI

---

## 4. Perubahan pada Artikel

### 4.1 Pembuatan Route Artikel
- **Deskripsi**: Menambahkan route untuk halaman artikel
- **File Terpengaruh**: `routes/web.php`
- **Status**: ✅ SELESAI

### 4.2 Pembuatan Controller Artikel
- **Deskripsi**: Membuat ArticleController untuk menangani halaman artikel
- **File Terpengaruh**: `app/Http/Controllers/ArticleController.php`
- **Status**: ✅ SELESAI

### 4.3 Pembuatan View Artikel
- **Deskripsi**: Membuat view untuk halaman daftar dan detail artikel
- **File Terpengaruh**: 
  - `resources/views/articles/index.blade.php`
  - `resources/views/articles/show.blade.php`
- **Status**: ✅ SELESAI

### 4.4 Perbaikan Filter Tanggal Publikasi
- **Deskripsi**: Menambahkan filter untuk hanya menampilkan artikel yang sudah waktunya dipublikasikan
- **File Terpengaruh**: 
  - `app/Http/Controllers/ArticleController.php`
  - `app/Http/Controllers/HomeController.php`
- **Status**: ✅ SELESAI

### 4.5 Perbaikan Akses Gambar Artikel
- **Deskripsi**: Mengganti path akses gambar artikel dari storage ke uploads
- **File Terpengaruh**: 
  - `resources/views/articles/index.blade.php`
  - `resources/views/articles/show.blade.php`
  - `resources/views/home.blade.php`
- **Status**: ✅ SELESAI

### 4.6 Perbaikan Format Tanggal
- **Deskripsi**: Memperbaiki error tanggal karena disimpan sebagai string
- **File Terpengaruh**: 
  - `resources/views/articles/index.blade.php`
  - `resources/views/articles/show.blade.php`
  - `app/Http/Controllers/ArticleController.php`
- **Status**: ✅ SELESAI

---

## 5. Perubahan pada Layanan (Fitur Dropdown)

### 5.1 Penambahan Kolom is_featured
- **Deskripsi**: Menambahkan kolom is_featured ke tabel services
- **File Terpengaruh**: 
  - `database/migrations/2025_12_11_071305_add_is_featured_to_services_table.php` (migration)
  - `app/Models/Service.php` (model)
- **Status**: ✅ SELESAI

### 5.2 Perbaikan ServiceResource di Filament
- **Deskripsi**: Menambahkan toggle is_featured di form dan kolom di tabel
- **File Terpengaruh**: `app/Filament/Resources/ServiceResource.php`
- **Status**: ✅ SELESAI

### 5.3 Pembuatan Route Layanan
- **Deskripsi**: Menambahkan route untuk layanan utama dan lainnya
- **File Terpengaruh**: `routes/web.php`
- **Status**: ✅ SELESAI

### 5.4 Pembuatan ServiceController
- **Deskripsi**: Membuat controller untuk mengelola layanan utama dan lainnya
- **File Terpengaruh**: `app/Http/Controllers/ServiceController.php`
- **Status**: ✅ SELESAI

### 5.5 Pembuatan View Layanan
- **Deskripsi**: Membuat view untuk halaman layanan utama dan lainnya
- **File Terpengaruh**: 
  - `resources/views/services/featured.blade.php`
  - `resources/views/services/other.blade.php`
- **Status**: ✅ SELESAI

### 5.6 Perbaikan HomeController
- **Deskripsi**: Mengubah query untuk hanya mengambil layanan utama (is_featured = true)
- **File Terpengaruh**: `app/Http/Controllers/HomeController.php`
- **Status**: ✅ SELESAI

### 5.7 Perbaikan Navbar
- **Deskripsi**: Menambahkan dropdown untuk layanan di navbar
- **File Terpengaruh**: `resources/views/layouts/app.blade.php`
- **Status**: ✅ SELESAI

### 5.8 Perbaikan Pencarian Gambar Layanan
- **Deskripsi**: Menyamakan logika pencarian gambar layanan di semua halaman
- **File Terpengaruh**: 
  - `resources/views/home.blade.php`
  - `resources/views/services/featured.blade.php`
  - `resources/views/services/other.blade.php`
- **Status**: ✅ SELESAI

---

## 6. Error dan Solusi

### 6.1 Error: Call to a member function format() on string
- **Deskripsi**: Error terjadi karena tanggal disimpan sebagai string, bukan objek Carbon
- **File Terpengaruh**: 
  - `resources/views/articles/index.blade.php`
  - `resources/views/articles/show.blade.php`
- **Solusi**: Menggunakan `\Carbon\Carbon::parse($date)->format('format')`
- **Status**: ✅ DIPERBAIKI

### 6.2 Error: Target class [ServiceController] does not exist
- **Deskripsi**: Error karena tidak ada use statement untuk ServiceController
- **File Terpengaruh**: `routes/web.php`
- **Solusi**: Menambahkan `use App\Http\Controllers\ServiceController;`
- **Status**: ✅ DIPERBAIKI

### 6.3 Error: Call to a member function gt() on string
- **Deskripsi**: Error karena published_at disimpan sebagai string, bukan objek Carbon
- **File Terpengaruh**: `app/Http/Controllers/ArticleController.php`
- **Solusi**: Menggunakan `\Carbon\Carbon::parse($date)->gt(now())`
- **Status**: ✅ DIPERBAIKI

### 6.4 Error: Mismatch Gambar Artikel
- **Deskripsi**: Gambar artikel tidak muncul karena path yang salah
- **File Terpengaruh**: 
  - `resources/views/articles/index.blade.php`
  - `resources/views/articles/show.blade.php`
  - `resources/views/home.blade.php`
- **Solusi**: Mengganti path dari Storage::disk('public') ke asset('uploads/')
- **Status**: ✅ DIPERBAIKI

### 6.5 Error: Dropdown Menghilang Saat Kursor Dipindahkan
- **Deskripsi**: Dropdown layanan menghilang saat kursor dipindahkan dari link ke dropdown
- **File Terpengaruh**: `resources/views/layouts/app.blade.php`
- **Solusi**: Menambahkan area transisi untuk hover
- **Status**: ✅ DIPERBAIKI

---

## 7. Status Penyelesaian (Diperbarui)

### ✅ TELAH SELESAI:
1. Memindahkan bagian "Tentang Kami" ke posisi paling bawah halaman home.
2. Memastikan gambar layanan "Laborat" dan "Konsultasi Gigi" muncul dengan benar.
3. Menampilkan 4 dokter secara acak di halaman home.
4. Memperbaiki path gambar dokter dari storage ke uploads.
5. Membuat halaman artikel lengkap dengan route, controller, dan view.
6. Menambahkan filter tanggal publikasi artikel.
7. Memperbaiki path gambar artikel dari storage ke uploads.
8. Menambahkan kolom is_featured ke tabel services.
9. Membuat dropdown layanan di navbar dengan opsi "Layanan Utama" dan "Layanan Lainnya".
10. Menyelesaikan error-error yang muncul selama proses.
11. **(Baru)** Memperbaiki bug upload gambar di CMS.
12. **(Baru)** Mengoptimalkan performa halaman daftar artikel di CMS.
13. **(Baru)** Menyatukan logika penyimpanan dan penampilan gambar layanan.
14. **(Baru)** Mengimplementasikan auto-clear cache untuk data layanan.
15. **(Baru)** Menambahkan tombol "Clear Cache" di dashboard CMS.
16. **(Baru)** Menambahkan slider layanan di homepage.
17. **(Baru)** Mengubah dropdown navigasi menjadi berbasis klik.
18. **(Baru)** Memperbaiki masalah tampilan layanan yang terbalik dengan mengisi data yang benar melalui seeder dan memastikan controller berfungsi.

### ❌ BELUM SELESAI:
- (Tidak ada masalah yang diketahui saat ini)

### Catatan Tambahan:
- Sistem layanan sekarang sepenuhnya dikontrol oleh database dan CMS. Perubahan pada judul, gambar, atau status "Layanan Utama" (`is_featured`) akan secara otomatis tampil di frontend setelah cache dibersihkan (yang juga terjadi otomatis).

---

## 8. Perbaikan Sesi Lanjutan (11 Desember 2025)

### 8.1 Perbaikan Upload Gambar di CMS
- **Deskripsi**: Memperbaiki bug di mana upload gambar di CMS (Layanan, Dokter, dll.) macet atau tidak menyimpan perubahan.
- **Solusi**:
    1.  Memperbaiki konfigurasi `config/filesystems.php` ke standar Laravel.
    2.  Membuat ulang symbolic link `public/storage` dengan benar.
    3.  Menyesuaikan `APP_URL` di file `.env`.
    4.  Memastikan komponen `FileUpload` di Filament menggunakan `disk('public')`.
- **Status**: ✅ DIPERBAIKI

### 8.2 Perbaikan Error Timeout di Halaman Artikel
- **Deskripsi**: Mengatasi error `Maximum execution time exceeded` saat membuka halaman daftar Artikel di CMS.
- **Solusi**: Mengoptimalkan query tabel dengan menambahkan `searchable()` dan `sortable()` pada kolom yang relevan di `ArticleResource.php`.
- **Status**: ✅ DIPERBAIKI

### 8.3 Perbaikan Inkonsistensi Gambar Layanan
- **Deskripsi**: Gambar yang baru di-upload via CMS tidak muncul di frontend karena lokasi penyimpanan berbeda dengan yang diharapkan oleh view.
- **Solusi**:
    1.  Memindahkan semua gambar layanan ke `storage/app/public/services`.
    2.  Memperbaiki `ServiceSeeder` untuk menyimpan path yang benar (`services/namafile.png`).
    3.  Memperbaiki semua view (`home`, `featured`, `other`) untuk mengambil gambar dari `storage`.
- **Status**: ✅ DIPERBAIKI

### 8.4 Implementasi Auto-Clear Cache
- **Deskripsi**: Perubahan data di CMS tidak langsung tampil di frontend karena data lama masih tersimpan di cache.
- **Solusi**: Membuat `ServiceObserver` untuk secara otomatis membersihkan semua cache yang relevan (`home_services`, `services.featured`, `services.other`) setiap kali ada perubahan pada data layanan.
- **Status**: ✅ DITERAPKAN

### 8.5 Penambahan Fitur Tombol "Clear Cache"
- **Deskripsi**: Menambahkan tombol untuk membersihkan cache secara manual langsung dari dashboard CMS.
- **Solusi**: Membuat file `app/Filament/Pages/Dashboard.php` dan menambahkan `Action` untuk menjalankan perintah `cache:clear`, `config:clear`, dan `view:clear`.
- **Status**: ✅ DITERAPKAN

### 8.6 Peningkatan UI/UX
- **Slider Layanan**: Mengubah tampilan "Layanan Unggulan" di homepage menjadi slider horizontal.
- **Dropdown Klik**: Mengubah dropdown "Layanan" di navigasi dari hover menjadi klik menggunakan Alpine.js untuk pengalaman pengguna yang lebih baik.
- **Status**: ✅ DITERAPKAN

---

## 9. Peningkatan Fitur Lanjutan (16 Desember 2025)

### 9.1 Pengaturan Situs Terpusat (CMS)
- **Deskripsi**: Menambahkan halaman "Site Settings" baru di panel admin Filament untuk memungkinkan admin mengelola konten global dengan mudah.
- **Fitur**:
    -   Mengubah nomor telepon IGD.
    -   Mengganti logo website.
    -   Mengganti gambar banner utama di halaman home.
- **File Terpengaruh**:
    -   `app/Filament/Pages/SiteSettings.php`
    -   `app/Models/Setting.php`
    -   `app/Providers/ViewServiceProvider.php`
    -   `resources/views/layouts/app.blade.php` (untuk menampilkan data)
    -   `resources/views/home.blade.php` (untuk menampilkan data)
- **Status**: ✅ DITERAPKAN

### 9.2 Peningkatan Tampilan (UI/UX)
- **Deskripsi**: Melakukan serangkaian perbaikan pada antarmuka untuk meningkatkan pengalaman pengguna.
- **Perubahan**:
    -   **Navbar**: Didesain ulang agar lebih tegas, dengan penambahan efek "active state" (penanda halaman aktif) dan efek hover yang lebih jelas pada menu.
    -   **Tombol IGD**: Diubah menjadi link WhatsApp dan digabungkan dengan navigasi utama agar lebih bersih.
    -   **Kartu Konten**: Kartu untuk Layanan, Dokter, dan Artikel di halaman utama diberi bingkai (border) dan dibuat bisa di-klik untuk navigasi ke halaman detail.
- **File Terpengaruh**:
    -   `resources/views/layouts/app.blade.php`
    -   `resources/views/home.blade.php`
- **Status**: ✅ DITERAPKAN

### 9.3 Fitur Galeri & Kontak (Layanan & Artikel)
- **Deskripsi**: Menambahkan fungsionalitas baru pada modul Layanan dan Artikel agar lebih dinamis.
- **Struktur Database**:
    -   Menambahkan tabel `service_images` dan `article_images` untuk mendukung galeri foto.
    -   Menambahkan kolom `contact_link` dan `contact_icon` pada tabel `services` dan `articles`.
- **Fitur CMS**:
    -   Pada halaman edit Layanan & Artikel di CMS, ditambahkan bagian "Kontak Tambahan" untuk mengisi URL dan memilih ikon kontak (WhatsApp, IG, dll).
    -   Di bawah form utama, ditambahkan tabel untuk mengelola (upload/hapus) banyak gambar untuk galeri.
- **Frontend**:
    -   Membuat halaman detail untuk Layanan.
    -   Halaman detail Layanan dan Artikel sekarang menampilkan galeri foto dan tombol kontak tambahan jika data diisi dari CMS.
- **File Terpengaruh**:
    -   `app/Filament/Resources/ServiceResource.php`
    -   `app/Filament/Resources/ArticleResource.php`
    -   `app/Http/Controllers/ServiceController.php`
    -   `app/Http/Controllers/ArticleController.php`
    -   `resources/views/services/show.blade.php`
    -   `resources/views/articles/show.blade.php`
    -   Model & Migrasi terkait.
- **Status**: ✅ DITERAPKAN

### 9.4 Perbaikan Bug Internal CMS
- **Deskripsi**: Mengatasi error `RouteNotFoundException` yang terjadi pada resource `Services` dan `Articles` di panel admin.
- **Solusi**: Error disebabkan karena file-file standar untuk halaman CMS (List, Create, Edit) tidak ada. Solusinya adalah dengan membuat ulang file-file yang hilang tersebut untuk kedua resource dan memastikan file utama resource merujuk pada file-file tersebut dengan benar.
- **Status**: ✅ DIPERBAIKI
