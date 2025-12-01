# Art Showcase Platform

Art Showcase Platform adalah aplikasi web untuk memamerkan karya seni digital, di mana para kreator (Member) dapat membangun portofolio, berinteraksi, serta mengikuti challenge yang dibuat oleh Curator. Sistem ini menyediakan peran berbeda seperti Admin, Member, Curator, dan Public User dengan dashboard serta akses yang disesuaikan.

Fitur utama meliputi pengelolaan karya seni, interaksi (likes, comments, favorites), pelaporan konten, manajemen challenge, dan moderasi oleh Admin. Sistem juga didukung tampilan modern, navigasi jelas, dan alur pengguna yang mudah dipahami.

-------------------------------------------------

## Rincian Alur Aplikasi
1. *Login / Registrasi*
- Admin login menggunakan akun bawaan (seeded).
- Member dan Curator dapat mendaftar melalui halaman register.
- Akun Curator akan berstatus Pending sampai disetujui oleh Admin.
- Public User (guest) bisa menjelajahi galeri tanpa login.

----------------------

2. *Dashboard Berdasarkan Role*
*Admin*
- Mengelola pengguna (Admin, Member, Curator).
- Mengelola kategori karya.
- Menangani laporan konten.
- Melihat statistik platform.

*Member (Creator)*
- Mengunggah, mengedit, dan menghapus karya.
- Mengelola profil kreator.
- Memberi like, comment, favorites.
- Melapor karya lain.
- Mengikuti challenge dan mengirim karya.

*Curator*
- Membuat dan mengelola challenge.
- Melihat submission peserta.
- Memilih pemenang challenge.
- Mengelola informasi challenge.

-*Public User (Guest)*-
- Melihat galeri karya, profil kreator, dan challenge aktif.
- Harus login untuk berinteraksi.


-----------------------

3. *Manajemen Karya (Member)*
- CRUD karya: Judul, deskripsi, kategori, tags, file upload.
- Galeri pribadi dalam dashboard Member.

-------------------------

4. *Interaksi (Member)*
- Like / Unlike karya.
- Tambahkan karya ke Favorites.
- Beri komentar.
- Report konten (SARA, Plagiarisme, Konten Tidak Pantas).

-----

5. *Challenge System (Curator)*
- Membuat challenge baru.
- Mengelola dan menampilkan submission.
- Memilih pemenang di akhir challenge.
- Menampilkan pemenang di halaman challenge.

-----------

6. *Moderation System (Admin)*
- Menangani konten yang dilaporkan pengguna.
- Approve / Dismiss laporan.
- Menghapus karya yang melanggar.

------

7. *Halaman Tampilan Utama*
- Homepage menampilkan:
- Karya featured/popular.
- Karya terbaru.
- Daftar challenge aktif.
- Pencarian dan filter kategori.

-----------


## Teknologi dan Tools

- *XAMPP* — Server lokal yang menyediakan Apache, PHP, dan MySQL untuk menjalankan aplikasi. 
- *Composer* — Dependency manager untuk menginstal dan mengelola paket Laravel.
 - *Laravel* — Framework utama untuk pengembangan backend, routing, autentikasi, dan manajemen data. 
 - *Visual Studio Code (VS Code)* — Code editor utama untuk menulis dan mengelola proyek. 
 - *GitHub* — Platform untuk penyimpanan kode, version control, dan kolaborasi.

----------------------


### Langkah-Langkah Penggunaan 
1. *Clone Repositori:* 
bash git clone https://github.com/angelcatrina/FINAL-LAB-WEB-2025
2. *Masuk ke Direktori Proyek:* bash cd Manajemen-Perpustakaan 
3. *Instal Dependensi Laravel:* bash composer install 
3. *ketik "kode ." lalu masuk ke .env dan ubah bagian DB_DATABASE seperti berikut :
* bash DB_CONNECTION=mysql
 DB_HOST=127.0.0.1 DB_PORT=3306 
 DB_DATABASE=artshowcase_db 
 DB_USERNAME=root 
 DB_PASSWORD= 
 
 Jika nama filenya hanya ada .env.example maka ubah dulu menjadi .env lalu ubah isinya bagian DB_DATABASE seperti di atas. 
 4. *Buka XAMPP lalu start MySQL* 
 5. *Masuk ke VS Code lalu buka terminal dan jalankan migrasi dan seeder database:* 
 bash 
 php artisan migrate --seed

  6. *Jalankan Server Aplikasi:* 
  bash 
  php artisan serve 
  
  7. *Install dependensi npm:* 
  bash 
  npm install 
  
  8. *Jalankan Vite pada terminal lain:* 
  bash 
  npm run dev 
  
  9. *Jalankan perintah ini di root folder proyek Laravel fungsinya untuk membuat dan menaruh APP_KEY baru ke dalam file .env.:* 
  bash 
  php artisan key:generate 
  
  10 *Jalankan symlink untuk menghubungkan folder penyimpanan file pribadi ke folder yang dapat diakses publik oleh browser. :* 
  bash php 
  artisan storage:link 
  Akses aplikasi di: http://127.0.0.1:8000/

----------------------

*Kredensial Penting (Setelah Seeder)*
Setelah menjalankan seeder, sistem akan memiliki:
*Admin Utama*
Cek file:
- database/seeders/AdminSeeder.php
- Di dalamnya terdapat email & password Admin bawaan.
- Akun Member / Curator
- Member dan Curator dapat mendaftar langsung dari halaman register.
- Curator akan berstatus Pending sampai disetujui admin.