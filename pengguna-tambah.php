<?php

require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $sql = "INSERT INTO pengguna (nama, username, password, role) VALUES (?,?,?,?)";
    $row = $koneksi->execute_query($sql, [$nama, $username, $password, $role]);

    if ($row) {
        header("Location: pengguna.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tambah Pengguna</title>
</head>
<body>
    <h1>Tambah Pengguna</h1>

    <form action="" method="post">
        <div class="form-item">
            <label for="nama">Nama Pengguna</label>
            <input type="text" name="nama" id="nama">
        </div>
        <div class="form-item">
            <label for="username">Username</label>
            <input type="text" name="username" id="username">
        </div>
        <div class="form-item">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
        </div>
        <div class="form-item">
            <label for="role">Role</label>
            <select name="role" id="role">
                <option value="admin">Admin</option>
                <option value="kader">Kader</option>
            </select>
        </div>
        <button type="submit">Tambah</button>
    </form>

    <a href="pengguna.php">Batal</a>
</body>
</html>