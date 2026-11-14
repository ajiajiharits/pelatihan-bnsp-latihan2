<?php
require "auth.php";
require "koneksi.php";

if (isset($_GET["id"])) {
    $stmt = $pdo->prepare("DELETE FROM siswa WHERE id = ?");
    $stmt->execute([$_GET["id"]]);
}

header("Location: index.php");
exit;
?>
