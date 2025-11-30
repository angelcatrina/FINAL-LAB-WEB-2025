Art Showcase Platform

Individual Project 2 – Web Application

Overview:
Art Showcase Platform adalah platform untuk memamerkan karya seni digital, yang berfungsi sebagai wadah bagi kreator (Member) untuk menampilkan portofolio mereka dan bagi pengguna lain untuk menemukan inspirasi. Sistem ini menghubungkan kreator dengan audiens melalui fitur interaktif seperti likes, komentar, dan favorites. Platform mendukung empat peran utama: Admin, Member (Kreator), Curator, dan Public User (Guest), dengan akses dan fitur yang disesuaikan untuk setiap level.

Platform ini juga menekankan keamanan melalui sistem pelaporan karya yang dilaporkan oleh Member dan ditinjau oleh Admin.

Table of Contents
1.User Roles
2.CMS Modules
3.Layout Requirements
4.Advanced Features (Optional)
5..Technologies
6.Setup & Installation
7.Usage

------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


User Roles
1. Admin
-Mengelola seluruh platform dengan akses penuh.
-Moderasi konten: Meninjau dan mengambil tindakan (approve/delete) terhadap karya atau komentar yang dilaporkan.
-Manajemen pengguna: CRUD Member, Curator, Admin lainnya.
-Manajemen kategori: CRUD kategori karya (Fotografi, UI/UX, 3D Art, dll.).
-Melihat data statistik platform.


2.Member (User/Creator)
-Unggah dan kelola karya (desain, ilustrasi, fotografi, tulisan, dll.).
-Membangun dan mengelola halaman profil pribadi.
-Interaksi dengan karya lain: like, comment, favorites.
-Melaporkan karya yang melanggar aturan.
-Mengikuti challenge dengan submit karya.

3.Curator
-Membuat dan mengelola event atau challenge.
-Melihat galeri partisipan dan karya yang di-submit.
-Memilih pemenang challenge setelah selesai.
-Akun Curator harus disetujui Admin sebelum bisa mengakses dashboard.

4.Public User (Guest)
-Menjelajahi karya seni, profil kreator, dan challenge.
-Harus login/register untuk berinteraksi lebih lanjut (like, comment, favorites, submit karya).


------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


CMS Modules
1. Artwork Management (Member)
- List, Create, Edit, Delete karya milik sendiri.
- Field penting: Judul, Deskripsi, Kategori, Tags, File upload.

2. User Management (Admin)
- View users (Admin, Member, Curator).
- Delete user (kecuali diri sendiri).
- Moderation handling: meninjau karya yang dilaporkan.

3. Interaction Management (Member)
- Like/Unlike, Favorites, Comment, Report content.
- Report fields: Alasan laporan (SARA, Plagiat, Konten Tidak Pantas).

4. Profile Management (Member)
- Kelola info publik: Nama tampilan, foto profil, bio, tautan eksternal.
-Kelola info privat: Email dan password.

5. Challenge Management (Curator)
- List, Create, Edit, Delete challenge.
- View submissions dan select winners setelah challenge berakhir.

6. Moderation Management (Admin)
- Manage Categories (CRUD kategori).
- Moderation Queue: Dismiss report atau Take down konten.



------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


Layout Requirements
1. Login/Register Page
- Login untuk Admin, Member, Curator.
- Register hanya untuk Member dan Curator (status Pending untuk Curator baru).

2. Homepage (Public User)
- Galeri karya featured, populer, terbaru.
- Daftar challenge aktif.
- Search bar dan filter kategori.

3. Homepage (Member)
- Sama dengan Public User, tombol interaksi aktif (like, comment, favorites).

4. Artwork Details Page
- Detail karya: judul, deskripsi, kreator, tanggal upload.
- Tombol interaksi untuk Member; Guest hanya bisa melihat.

5. Creator Profile Page
- Info kreator: foto profil, nama tampilan, bio, tautan eksternal.
- Galeri karya kreator.

6. Member Dashboard
- Profile Management, My Artworks, My Favorites, My Submissions.

7. Pending Curator Page
- Informasi akun Curator sedang ditinjau oleh Admin.

8. Curator Dashboard
- Challenge Management, Manage Submissions, Select Winners.

9. Challenge Details Page
- Info challenge lengkap, galeri submission, pemenang, tombol submit karya untuk Member.

10. Admin Dashboard
- User Management, Category Management, Content Moderation.


------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


Advanced Features (Optional)
- Following system: Member dapat follow kreator lain.

------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Technologies
- Backend: Laravel (PHP)
- Frontend: Blade Templates, Tailwind CSS / Bootstrap
- Database: MySQL / MariaDB
- Authentication: Laravel Auth
- File Storage: Local or Cloud Storage (gambar/media)


------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


Setup & Installation
1. Clone repository:
git clone <repository-url>
cd art-showcase-platform

2. Install dependencies:
composer install
npm install
npm run dev

3. Copy file environment dan konfigurasi database:
cp .env.example .env
php artisan key:generate

Sesuaikan konfigurasi database di .env.

4. Jalankan migration & seed:
php artisan migrate --seed


5. Jalankan server lokal:
php artisan serve


------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Usage
- Buka http://localhost:8000 di browser.
- Login atau register sebagai Member/Curator/Admin.
- Eksplor galeri, unggah karya, ikut challenge, atau moderasi konten sesuai peran.