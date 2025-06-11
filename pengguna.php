<?php

require 'koneksi.php';

$sql = "SELECT * FROM pengguna";
$result = $koneksi->query($sql);
$rows = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pengguna</title>
</head>
<body>
    <h1>Data Pengguna</h1>

    <a href="index.php">Kembali</a>
    <a href="pengguna-tambah.php">Tambah Pengguna</a>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pengguna</th>
                <th>Username</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($rows)) : ?>
                <?php $no = 0; foreach ($rows as $row) : ?>
                    <tr>
                        <td><?= ++$no ?></td>
                        <td><?= htmlspecialchars($row['nama']) ?></td>
                        <td><?= htmlspecialchars($row['username']) ?></td>
                        <td><?= htmlspecialchars($row['role']) ?></td>
                        <td>
                            <a href="pengguna-hapus.php?id=<?= $row['id_pengguna'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php else : ?>
                <tr>
                    <td colspan="5">Tidak ada data pengguna.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
