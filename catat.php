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

session_start(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['id_pengguna'], $_POST['bayi'], $_POST['tinggi'], $_POST['berat'])) {
        $id_kader = $_SESSION['id_pengguna'];
        $id_bayi = $_POST['bayi'];
        $tinggi = $_POST['tinggi'];
        $berat = $_POST['berat'];

        $sql = "INSERT INTO catatan (id_kader, id_bayi, tinggi, berat, tanggal) VALUES (?, ?, ?, ?, CURRENT_DATE)";
        $stmt = $koneksi->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("iidd", $id_kader, $id_bayi, $tinggi, $berat);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                header("Location: catat.php");
                exit;
            } else {
                echo "Gagal mencatat pertumbuhan.";
            }
        } else {
            echo "Query gagal disiapkan.";
        }
    } else {
        echo "Semua field harus diisi.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Catat Pertumbuhan</title>
</head>
<body>
    <h1>Catat Pertumbuhan Bayi</h1>

    <a href="index.php">Kembali</a>

    <form action="" method="post">
        <div class="form-item">
            <label for="bayi">Bayi</label>
            <select name="bayi" id="bayi" required>
                <?php foreach ($babies as $baby) : ?>
                    <option value="<?= $baby['id_bayi'] ?>"><?= htmlspecialchars($baby['nama']) ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="form-item">
            <label for="tinggi">Tinggi</label>
            <input type="number" name="tinggi" id="tinggi" step="any" required>
        </div>

        <div class="form-item">
            <label for="berat">Berat</label>
            <input type="number" name="berat" id="berat" step="any" required>
        </div>

        <button type="submit">Catat</button>
    </form>
</body>
</html>
