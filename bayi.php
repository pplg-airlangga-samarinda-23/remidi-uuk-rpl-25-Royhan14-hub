<?php

require 'koneksi.php';

$sql = "SELECT * FROM bayi";
$result = $koneksi->query($sql);
$babies = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $babies[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Data Bayi</title>
</head>
<body>
    <h1>Data Bayi</h1>

    <a href="index.php">Kembali</a>
    <a href="bayi-tambah.php">Tambah Bayi</a>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Nama Ibu</th>
                <th>Nama Ayah</th>
                <th>Tanggal Lahir</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($babies)) : ?>
                <?php $no = 0; foreach ($babies as $baby) : ?>
                <tr>
                    <td><?= ++$no ?></td>
                    <td><?= htmlspecialchars($baby['nama']) ?></td>
                    <td><?= htmlspecialchars($baby['nama_ibu']) ?></td>
                    <td><?= htmlspecialchars($baby['nama_ayah']) ?></td>
                    <td><?= htmlspecialchars($baby['tanggal_lahir']) ?></td>
                    <td>
                        <a href="bayi-detil.php?id=<?= $baby['id_bayi'] ?>">Detil</a>
                        <a href="bayi-edit.php?id=<?= $baby['id_bayi'] ?>">Edit</a>
                        <a href="bayi-hapus.php?id=<?= $baby['id_bayi'] ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach ?>
            <?php else : ?>
                <tr>
                    <td colspan="6">Tidak ada data bayi.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
