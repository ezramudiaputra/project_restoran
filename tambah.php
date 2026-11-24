<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $nama      = $_POST['nama_menu'];
    $kategori  = $_POST['kategori'];
    $harga     = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    $query = "INSERT INTO menu_makanan (nama_menu, kategori, harga, deskripsi) 
              VALUES ('$nama', '$kategori', '$harga', '$deskripsi')";
    
    if (mysqli_query($koneksi, $query)) {
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Menu</title>
    <link rel="stylesheet" href="style.css?v=2">
</head>
<body>

    <div class="container">
        <h2>Tambah Menu Makanan Baru</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label>Nama Menu:</label>
                <input type="text" name="nama_menu" required placeholder="Contoh: Ayam Bakar">
            </div>
            <div class="form-group">
                <label>Kategori:</label>
                <select name="kategori">
                    <option value="Makanan Utama">Makanan Utama</option>
                    <option value="Minuman">Minuman</option>
                    <option value="Dessert">Dessert</option>
                </select>
            </div>
            <div class="form-group">
                <label>Harga (Rp):</label>
                <input type="number" name="harga" required placeholder="Contoh: 20000">
            </div>
            <div class="form-group">
                <label>Deskripsi:</label>
                <textarea name="deskripsi" rows="4" placeholder="Keterangan singkat..."></textarea>
            </div>
            <button type="submit" name="simpan" class="btn btn-tambah">Simpan Data</button>
            <a href="index.php" class="btn btn-batal">Batal</a>
        </form>
    </div>

</body>
</html>