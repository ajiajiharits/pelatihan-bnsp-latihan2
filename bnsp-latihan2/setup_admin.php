<?php
// Jalankan file ini SATU KALI untuk membuat akun admin awal.
// Setelah berhasil, HAPUS file setup_admin.php dari folder proyek.
require "koneksi.php";

$username = "admin";
$passwordAwal = "Admin123!";
$passwordHash = password_hash($passwordAwal, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("SELECT id FROM admin WHERE username = ?");
$stmt->execute([$username]);

if ($stmt->fetch()) {
    echo "Akun admin sudah tersedia. Hapus file setup_admin.php sekarang.";
} else {
    $stmt = $pdo->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $passwordHash]);

    echo "Akun admin berhasil dibuat.<br>";
    echo "Username: admin<br>";
    echo "Password awal: Admin123!<br><br>";
    echo "PENTING: Hapus file setup_admin.php sekarang demi keamanan.";
}
?>
