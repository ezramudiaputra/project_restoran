<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}
include 'koneksi.php';

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM menu_makanan WHERE id_menu='$id'");
$row  = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
    $nama      = $_POST['nama_menu'];
    $kategori  = $_POST['kategori'];
    $harga     = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    $query = "UPDATE menu_makanan SET 
                nama_menu='$nama', 
                kategori='$kategori', 
                harga='$harga', 
                deskripsi='$deskripsi' 
              WHERE id_menu='$id'";

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
    <title>Edit Menu</title>
    <link rel="stylesheet" href="style.css?v=2">
</head>
<body>

    <div class="container">
        <h2>Edit Menu Makanan</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label>Nama Menu:</label>
                <input type="text" name="nama_menu" value="<?= $row['nama_menu']; ?>" required>
            </div>
            <div class="form-group">
                <label>Kategori:</label>
                <select name="kategori">
                    <option value="Makanan Utama" <?= ($row['kategori'] == 'Makanan Utama') ? 'selected' : ''; ?>>Makanan Utama</option>
                    <option value="Minuman" <?= ($row['kategori'] == 'Minuman') ? 'selected' : ''; ?>>Minuman</option>
                    <option value="Dessert" <?= ($row['kategori'] == 'Dessert') ? 'selected' : ''; ?>>Dessert</option>
                </select>
            </div>
            <div class="form-group">
                <label>Harga (Rp):</label>
                <input type="number" name="harga" value="<?= $row['harga']; ?>" required>
            </div>
            <div class="form-group">
                <label>Deskripsi:</label>
                <textarea name="deskripsi" rows="4"><?= $row['deskripsi']; ?></textarea>
            </div>
            <button type="submit" name="update" class="btn btn-edit">Update Data</button>
            <a href="index.php" class="btn btn-batal">Batal</a>
        </form>
    </div>

</body>
</html>