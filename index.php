<?php
session_start();

// Proteksi Session: Jika belum login, alihkan ke login.php
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

include 'koneksi.php';

// Mengambil data menu dari database restoran
$result = mysqli_query($koneksi, "SELECT * FROM menu_makanan ORDER BY id_menu DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Katalog Menu Makanan</title>
    <link rel="stylesheet" href="style.css?v=2">
</head>
<body>

    <div class="container">
        <!-- Baris Informasi User & Tombol Logout -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <span>Selamat Datang, <strong><?= $_SESSION['username']; ?></strong>!</span>
            <a href="logout.php" class="btn btn-hapus">Logout</a>
        </div>

        <h2>Daftar Menu Restoran</h2>
        
        <!-- Tombol Tambah Menu Baru -->
        <a href="tambah.php" class="btn btn-tambah">+ Tambah Menu Baru</a>

        <!-- Tabel Daftar Menu (Read, Edit, Hapus) -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Menu</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?= $row['id_menu']; ?></td>
                    <td><?= $row['nama_menu']; ?></td>
                    <td><?= $row['kategori']; ?></td>
                    <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                    <td><?= $row['deskripsi']; ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id_menu']; ?>" class="btn btn-edit">Edit</a>
                        <a href="hapus.php?id=<?= $row['id_menu']; ?>" class="btn btn-hapus" onclick="return confirm('Yakin hapus menu ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</body>
</html>