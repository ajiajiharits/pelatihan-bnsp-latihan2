<?php
require "auth.php";
require "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$id = $_POST["id"] ?? "";
$nama = trim($_POST["nama"] ?? "");
$alamat = trim($_POST["alamat"] ?? "");
$tempatLahir = trim($_POST["tempat_lahir"] ?? "");
$tanggalLahir = $_POST["tanggal_lahir"] ?? "";
$paketBelajar = $_POST["paket_belajar"] ?? "";
$paketValid = ["Paket A", "Paket B", "Paket C"];

if ($nama === "" || $alamat === "" || $tempatLahir === "" ||
    $tanggalLahir === "" || !in_array($paketBelajar, $paketValid, true)) {
    die("Data tidak lengkap atau paket tidak valid. <a href='index.php'>Kembali</a>");
}

if ($id !== "") {
    $stmt = $pdo->prepare(
        "UPDATE siswa SET nama=?, alamat=?, tempat_lahir=?, tanggal_lahir=?, paket_belajar=? WHERE id=?"
    );
    $stmt->execute([$nama, $alamat, $tempatLahir, $tanggalLahir, $paketBelajar, $id]);
} else {
    $stmt = $pdo->prepare(
        "INSERT INTO siswa (nama, alamat, tempat_lahir, tanggal_lahir, paket_belajar) VALUES (?, ?, ?, ?, ?)"
    );
    $stmt->execute([$nama, $alamat, $tempatLahir, $tanggalLahir, $paketBelajar]);
}

header("Location: index.php");
exit;
?>
