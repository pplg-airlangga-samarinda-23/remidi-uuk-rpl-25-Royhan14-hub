<?php
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $nama_ibu = $_POST['nama_ibu'];
    $nama_ayah = $_POST['nama_ayah'];
    $tanggal_lahir = $_POST['tanggal_lahir'];

    $sql = "INSERT INTO bayi (nama, nama_ibu, nama_ayah, tanggal_lahir) VALUES (?,?,?,?)";
    $row = $koneksi->execute_query($sql, [$nama, $nama_ibu, $nama_ayah, $tanggal_lahir]);

    if ($row) {
        header("location:bayi.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tambah Bayi</title>
</head>
<body>
    <h1>Tambah Bayi</h1>

    <a href="bayi.php">Kembali</a>

    <form action="" method="post">
        <div class="form-item">
            <label for="nama">Nama Bayi</label>
            <input type="text" name="nama" id="nama">
        </div>

        <div class="form-item">
            <label for="nama_ibu">Nama Ibu</label>
            <input type="text" name="nama_ibu" id="nama_ibu">
        </div>

        <div class="form-item">
            <label for="nama_ayah">Nama Ayah</label>
            <input type="text" name="nama_ayah" id="nama_ayah">
        </div>

        <div class="form-item">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir">
        </div>

        <button type="submit">Tambah</button>
    </form>
</body>
</html>