<?php
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id_pengguna, nama, password, role FROM pengguna WHERE username = ?";
    $stmt = $koneksi->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row && password_verify($password, $row['password'])) {
            session_start();
            session_regenerate_id();

            $_SESSION['id_pengguna'] = $row['id_pengguna'];
            $_SESSION['nama'] = $row['nama'];
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'];

            header("Location: index.php");
            exit();
        } else {
            echo "<p style='color:red;'>Username atau password salah!</p>";
        }
    } else {
        echo "<p style='color:red;'>Terjadi kesalahan saat memproses data!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Login Posyandu</h1>

    <form action="" method="post">
        <div class="form-item">
            <label for="username">Username</label><br>
            <input type="text" name="username" id="username" required>
        </div>

        <div class="form-item">
            <label for="password">Password</label><br>
            <input type="password" name="password" id="password" required>
        </div>

        <button type="submit">Login</button>
    </form>
</body>
</html>
