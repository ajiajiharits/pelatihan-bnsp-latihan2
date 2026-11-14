APLIKASI PENDAFTARAN SISWA - KHUSUS ADMIN

FITUR:
- Login admin menggunakan username dan password.
- Password disimpan dalam bentuk hash menggunakan password_hash().
- Halaman dashboard, tambah, edit, dan hapus data dilindungi session login.
- CRUD data siswa.

CARA INSTALASI:
1. Install XAMPP.
2. Jalankan Apache dan MySQL.
3. Ekstrak folder pendaftaran_siswa_admin ke C:\xampp\htdocs\
4. Buka http://localhost/phpmyadmin
5. Import file database.sql.
6. Buka http://localhost/pendaftaran_siswa_admin/setup_admin.php satu kali.
7. Setelah muncul pesan akun berhasil dibuat, HAPUS file setup_admin.php.
8. Buka http://localhost/pendaftaran_siswa_admin/login.php

LOGIN AWAL:
Username: admin
Password: Admin123!

PENTING:
- Segera ubah password awal sebelum aplikasi digunakan sungguhan.
- Hapus setup_admin.php setelah akun dibuat.
- Jangan bagikan username/password admin.
- Pengaturan database ada di koneksi.php.
- Ini login dasar untuk praktik lokal. Untuk penggunaan online, gunakan HTTPS,
  password unik, dan tambahkan fitur penggantian password serta perlindungan CSRF.

KEAMANAN AKSES:
File index.php, proses.php, dan hapus.php memanggil auth.php.
Jika belum login, pengguna akan diarahkan ke login.php.
Jadi membuka URL dashboard atau file proses secara langsung tetap memerlukan login.
