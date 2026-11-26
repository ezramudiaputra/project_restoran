
<?php
include 'koneksi.php';

// Mengambil data menu dari database
$query = "SELECT * FROM menu_makanan ORDER BY id_menu DESC";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Gagal mengambil data menu: " . mysqli_error($koneksi));
}

// Mengamankan teks yang ditampilkan
function e($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>HIHUU RESTAURANT - Menu</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS utama website -->
    <link rel="stylesheet" href="CSS/style.css">

</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">

            <a class="navbar-brand fw-bold" href="index.html">
                HIHUU RESTAURANT
            </a>

            <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#menu">

                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="about.html">About</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="menu.php">Menu</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">Contact</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <!-- Menu makanan dan minuman -->
    <section class="food-menu-section">

        <div class="container">

            <h1 class="food-menu-title">Our Menu</h1>

            <p class="food-menu-subtitle">
                Discover our delicious food selection.
            </p>

            <div class="row g-4">

                <?php if (mysqli_num_rows($result) > 0): ?>

                    <?php while ($row = mysqli_fetch_assoc($result)): ?>

                        <div class="col-lg-4 col-md-6">

                            <div class="food-card">

                                <div class="food-image">

                                    <?php if (!empty($row['gambar'])): ?>

                                        <img
                                            src="<?= e($row['gambar']); ?>"
                                            alt="<?= e($row['nama_menu']); ?>">

                                    <?php else: ?>

                                        <div style="
                                            min-height: 220px;
                                            display: flex;
                                            align-items: center;
                                            justify-content: center;
                                            flex-direction: column;
                                            background: #eeeeee;
                                            color: #777;
                                        ">
                                            <i class="bi bi-image" style="font-size: 35px;"></i>
                                            <span>Foto belum tersedia</span>
                                        </div>

                                    <?php endif; ?>

                                </div>

                                
<div class="food-info">

    <!-- Nama makanan -->
    <h3><?= e($row['nama_menu']); ?></h3>

    <!-- Harga makanan -->
    <p class="food-price">
        Rp<?= number_format((int) $row['harga'], 0, ',', '.'); ?>
    </p>

    <!-- Kategori makanan -->
    <span class="food-category">
        <?= e($row['kategori']); ?>
    </span>

    <!-- Deskripsi makanan -->
    <?php if (!empty($row['deskripsi'])): ?>
        <p class="food-description">
            <?= e($row['deskripsi']); ?>
        </p>
    <?php endif; ?>

</div>


                            </div>

                        </div>

                    <?php endwhile; ?>

                <?php else: ?>

                    <div class="col-12 text-center">
                        <p>Belum ada menu yang tersedia.</p>
                    </div>

                <?php endif; ?>

            </div>

        </div>

    </section>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
