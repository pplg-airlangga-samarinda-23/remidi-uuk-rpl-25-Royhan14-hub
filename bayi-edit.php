<?php
require 'koneksi.php';

$bayi = null;
$id_bayi = isset($_GET['id']) ? $_GET['id'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id_bayi) {
    $nama = $_POST['nama'];
    $nama_ibu = $_POST['nama_ibu'];
    $nama_ayah = $_POST['nama_ayah'];
    $tanggal_lahir = $_POST['tanggal_lahir'];

    $sql = "UPDATE bayi SET nama=?, nama_ibu=?, nama_ayah=?, tanggal_lahir=? WHERE id_bayi=?";
    $stmt = $koneksi->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssssi", $nama, $nama_ibu, $nama_ayah, $tanggal_lahir, $id_bayi);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            header("Location: bayi.php");
            exit;
        } else {
            echo "Gagal memperbarui data atau tidak ada perubahan.";
        }
    } else {
        echo "Query gagal disiapkan.";
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $id_bayi) {
    $sql = "SELECT * FROM bayi WHERE id_bayi=?";
    $stmt = $koneksi->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id_bayi);
        $stmt->execute();
        $result = $stmt->get_result();
        $bayi = $result->fetch_assoc();

        if (!$bayi) {
            echo "Data bayi tidak ditemukan.";
            exit;
        }
    }
} else {
    echo "ID tidak valid.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Bayi</title>
</head>
<body>
    <h1>Edit Bayi</h1>
    <a href="bayi.php">Kembali</a>

    <form action="" method="post">
        <div class="form-item">
            <label for="nama">Nama Bayi</label>
            <input type="text" name="nama" id="nama" value="<?= htmlspecialchars($bayi['nama']) ?>" required>
        </div>
        <div class="form-item">
            <label for="nama_ibu">Nama Ibu</label>
            <input type="text" name="nama_ibu" id="nama_ibu" value="<?= htmlspecialchars($bayi['nama_ibu']) ?>" required>
        </div>
        <div class="form-item">
            <label for="nama_ayah">Nama Ayah</label>
            <input type="text" name="nama_ayah" id="nama_ayah" value="<?= htmlspecialchars($bayi['nama_ayah']) ?>" required>
        </div>
        <div class="form-item">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="<?= htmlspecialchars($bayi['tanggal_lahir']) ?>" required>
        </div>
        <button type="submit">Edit</button>
    </form>
</body>
</html>
