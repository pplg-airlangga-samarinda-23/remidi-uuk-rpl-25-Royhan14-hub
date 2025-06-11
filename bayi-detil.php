<?php
require 'koneksi.php';

$detailts = [];
if (isset($_GET['id'])) {
    $id_bayi = $_GET['id'];

    $sql = "SELECT c.id, p.nama AS kader, c.id_bayi, c.tinggi, c.berat, c.tanggal
            FROM catatan c
            INNER JOIN pengguna p ON c.id_kader = p.id_pengguna
            WHERE c.id_bayi = ?
            ORDER BY c.id DESC";

    $stmt = $koneksi->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $id_bayi);
        $stmt->execute();
        $result = $stmt->get_result();
        $detailts = $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detil Bayi</title>
</head>
<body>
    <h1>Detil Bayi</h1>
    <h2>Catatan Pertumbuhan Bayi</h2>

    <a href="bayi.php">Kembali</a>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Tinggi</th>
                <th>Berat</th>
                <th>Kader</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($detailts)) : ?>
                <?php $no = 0; foreach ($detailts as $detail) : ?>
                <tr>
                    <td><?= ++$no ?></td>
                    <td><?= htmlspecialchars($detail['tanggal']) ?></td>
                    <td><?= htmlspecialchars($detail['tinggi']) ?></td>
                    <td><?= htmlspecialchars($detail['berat']) ?></td>
                    <td><?= htmlspecialchars($detail['kader']) ?></td>
                </tr>
                <?php endforeach ?>
            <?php else : ?>
                <tr>
                    <td colspan="5">Tidak ada catatan pertumbuhan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
