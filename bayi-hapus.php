<?php

require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id_bayi = $_GET['id'];

    $sql = "DELETE FROM bayi WHERE id_bayi = ?";
    $stmt = $koneksi->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id_bayi);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            header("Location: bayi.php");
            exit;
        } else {
            echo "Data bayi tidak ditemukan atau gagal dihapus.";
        }
    } else {
        echo "Query gagal disiapkan.";
    }
} else {
    echo "ID tidak valid.";
}
