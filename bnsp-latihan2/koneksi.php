<?php
$host = "localhost";
$dbname = "db_pendaftaran_siswa";
$username = "root";
$password = ""; // Default XAMPP biasanya kosong.

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die("Koneksi database gagal. Periksa pengaturan di koneksi.php.");
}
?>
