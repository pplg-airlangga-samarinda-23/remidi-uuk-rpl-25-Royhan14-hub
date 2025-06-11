<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard Posyandu</title>
</head>
<body>
    <h1>Sistem Posyandu</h1>
    <h2>Selamat Datang, <?= $_SESSION['nama'] ?></h2>
    <a href="logout.php">Logout</a>

    <nav>
        <ul>
            <?php if ($_SESSION['role'] == 'admin') : ?>
                <li><a href="pengguna.php">Data Pengguna</a></li>
            <?php endif ?>

            <li><a href="bayi.php">Data Bayi</a></li>
            <li><a href="catat.php">Catat Pertumbuhan</a></li>
        </ul>
    </nav>
</body>
</html>