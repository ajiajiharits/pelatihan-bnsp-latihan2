<?php
require "auth.php";
require "koneksi.php";

$edit = false;
$siswaEdit = [
    "id" => "",
    "nama" => "",
    "alamat" => "",
    "tempat_lahir" => "",
    "tanggal_lahir" => "",
    "paket_belajar" => ""
];

if (isset($_GET["edit"])) {
    $stmt = $pdo->prepare("SELECT * FROM siswa WHERE id = ?");
    $stmt->execute([$_GET["edit"]]);
    $data = $stmt->fetch();

    if ($data) {
        $edit = true;
        $siswaEdit = $data;
    }
}

$daftarSiswa = $pdo->query("SELECT * FROM siswa ORDER BY id DESC")->fetchAll();

function e($nilai) {
    return htmlspecialchars((string)$nilai, ENT_QUOTES, "UTF-8");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Pendaftaran Siswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<main class="container">
    <header class="dashboard-header">
        <div>
            <p class="eyebrow">DASHBOARD ADMIN</p>
            <h1>Aplikasi Pendaftaran Siswa</h1>
            <p class="subtitle">Selamat datang, <?= e($_SESSION["admin_username"]) ?>.</p>
        </div>
        <a href="logout.php" class="logout-button"
           onclick="return confirm('Yakin ingin keluar?')">Logout</a>
    </header>

    <section class="card">
        <div class="card-heading">
            <div>
                <h2><?= $edit ? "Edit Data Siswa" : "Form Pendaftaran Siswa" ?></h2>
                <p>Data hanya dapat dikelola setelah admin login.</p>
            </div>
        </div>

        <form action="proses.php" method="POST">
            <input type="hidden" name="id" value="<?= e($siswaEdit["id"]) ?>">

            <div class="form-group">
                <label for="nama">Nama lengkap</label>
                <input type="text" id="nama" name="nama"
                       value="<?= e($siswaEdit["nama"]) ?>" required>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea id="alamat" name="alamat" rows="3" required><?= e($siswaEdit["alamat"]) ?></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="tempat_lahir">Tempat lahir</label>
                    <input type="text" id="tempat_lahir" name="tempat_lahir"
                           value="<?= e($siswaEdit["tempat_lahir"]) ?>" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal lahir</label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                           value="<?= e($siswaEdit["tanggal_lahir"]) ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="paket_belajar">Paket belajar</label>
                <select id="paket_belajar" name="paket_belajar" required>
                    <option value="">Pilih paket belajar</option>
                    <?php foreach (["Paket A", "Paket B", "Paket C"] as $paket): ?>
                        <option value="<?= e($paket) ?>"
                            <?= $siswaEdit["paket_belajar"] === $paket ? "selected" : "" ?>>
                            <?= e($paket) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="submit-button">
                <?= $edit ? "Simpan Perubahan" : "Daftarkan Siswa" ?>
            </button>
            <?php if ($edit): ?>
                <a href="index.php" class="cancel-button">Batal</a>
            <?php endif; ?>
        </form>
    </section>

    <section class="card">
        <h2>Data Siswa Terdaftar</h2>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>No.</th><th>Nama</th><th>Alamat</th>
                        <th>TTL</th><th>Paket</th><th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($daftarSiswa): ?>
                    <?php foreach ($daftarSiswa as $nomor => $siswa): ?>
                    <tr>
                        <td><?= $nomor + 1 ?></td>
                        <td><?= e($siswa["nama"]) ?></td>
                        <td><?= e($siswa["alamat"]) ?></td>
                        <td><?= e($siswa["tempat_lahir"]) ?>,
                            <?= date("d-m-Y", strtotime($siswa["tanggal_lahir"])) ?></td>
                        <td><?= e($siswa["paket_belajar"]) ?></td>
                        <td class="aksi">
                            <a class="edit-button" href="index.php?edit=<?= e($siswa["id"]) ?>">Edit</a>
                            <a class="delete-button" href="hapus.php?id=<?= e($siswa["id"]) ?>"
                               onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6" class="empty">Belum ada data siswa.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>
</body>
</html>
