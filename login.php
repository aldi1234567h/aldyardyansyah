<?php
require 'koneksi/koneksi.php';

// Mulai sesi
session_start();

// Periksa apakah formulir dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Periksa apakah kunci username dan password ada dalam array $_POST
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Gunakan prepared statements untuk mencegah SQL injection
        $query_sql = "SELECT * FROM `tbl_user` WHERE username = ? AND password = ?";
        $stmt = mysqli_prepare($koneksi, $query_sql);

        // Bind parameter
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);

        // Jalankan pernyataan
        mysqli_stmt_execute($stmt);

        // Dapatkan hasil
        $result = mysqli_stmt_get_result($stmt);

        // Periksa apakah ada baris dengan username dan password yang diberikan
        if (mysqli_num_rows($result) > 0) {
            // Tetapkan variabel sesi
            $_SESSION["username"] = $username;

            // Alihkan ke dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Username atau password salah";
        }

        // Tutup pernyataan
        mysqli_stmt_close($stmt);
    } else {
        echo "Username atau password tidak dikirimkan";
    }
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>SALSA CAMELIA ZAHRA - Login</title>
</head>
<body>
    <header>
        <nav>
            <div class="logo">LOGIN LES ONLINE BAHASA INGGRIS</div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="register.php">Register</a></li>
                <!-- Add more navigation links as needed -->
            </ul>
        </nav>
    </header>

    <main>
        <div class="container">
            <div class="login-container">
            <form id="login-form" class="form" action="login.php" method="post">
                    <h2>Login</h2>
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" class="username" required>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" class="password" required>
                    <button type="submit">Login</button>
                </form>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer id="footer">
        <p class="copyright">&copy; NAMA: SALSA CAMELIA ZAHRA</p>
        <p>NPM: 21552011135</p>
        <p>UTS PEMROGRAMAN WEB 1</p>
    </footer>
</body>
</html>
