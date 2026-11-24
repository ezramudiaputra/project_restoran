<?php
session_start();
include 'koneksi.php';

// Jika pengguna sudah login, langsung alihkan ke index.php
if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit();
}

$error = false;

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Memeriksa username dan password di database
    $result = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username' AND password = '$password'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['login'] = true;
        $_SESSION['username'] = $row['username'];
        header("Location: index.php");
        exit();
    } else {
        $error = true;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Restoran</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container" style="max-width: 400px; margin-top: 50px;">
        <h2>Login Restoran</h2>
        
        <?php if ($error) : ?>
            <p style="color: red; margin-bottom: 15px;">Username atau password salah!</p>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" required placeholder="Masukkan username">
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required placeholder="Masukkan password">
            </div>
            <button type="submit" name="login" class="btn btn-tambah" style="width: 100%;">Login</button>
        </form>G
    </div>

</body>
</html>