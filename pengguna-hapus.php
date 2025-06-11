<?php

require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id_pengguna = $_GET['id'];

    $sql = "DELETE FROM pengguna WHERE id_pengguna = ?";
    $stmt = $koneksi->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id_pengguna);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            header("Location: pengguna.php");
            exit;
        } else {
            echo "Data tidak ditemukan atau gagal dihapus.";
        }
    } else {
        echo "Query gagal disiapkan.";
    }
} else {
    echo "ID tidak valid.";
}
