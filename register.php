<?php
include("koneksi/koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["new-username"]) && isset($_POST["new-password"]) && isset($_POST["confirm-password"]) && isset($_POST["telepon"])) {
        $username = $_POST["new-username"];
        $password = $_POST["new-password"];
        $confirmPassword = $_POST["confirm-password"];
        $telepon = $_POST["telepon"];

        // Check if passwords match
        if ($password != $confirmPassword) {
            echo '<scrip;>alert("Password and Confirm Password do not match.")</script>';
        } else {
           
            // Check if username exists
            $checkQuery = "SELECT * FROM `tbl_user` WHERE `username` = '$username'";
            $result = mysqli_query($koneksi, $checkQuery);

            if (mysqli_num_rows($result) > 0) {
                echo "Username already exists. Please choose another username.";
            } else {
                // Use prepared statement to prevent SQL injection
                $query = "INSERT INTO `tbl_user`(`username`, `password`, `telepon`) VALUES (?, ?, ?)";
                $stmt = mysqli_prepare($koneksi, $query);

                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "sss", $username, $password, $telepon);
                    mysqli_stmt_execute($stmt);

                    echo "Registration successful. Redirecting to login page.";
                    header("Location: login.php");
                    exit();
                } else {
                    echo "Registration failed: " . mysqli_error($koneksi);
                }
            }
        }
    } else {
        echo "Form fields are not set.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css"> <!-- You can create a separate CSS file for styling -->
    <title>SALSA CAMELIA ZAHRA - Register</title>
</head>
<body>
    <header>
    <nav>
            <div class="logo">LOGIN LES ONLINE BAHASA INGGRIS</div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="login.php">Login</a></li>
                <!-- Add more navigation links as needed -->
            </ul>
        </nav>
    </header>

    <main>
        <div class="container">
            <!-- Registration Form -->
            <div class="register-container">
                <form id="register-form" action="register.php" method="post">
                    <h2>Register</h2>
                    <label for="new-username">Username:</label>
                    <input type="text" id="new-username" name="new-username" required>
                    <label for="new-password">Password:</label>
                    <input type="password" id="new-password" name="new-password" required>
                    <label for="confirm-password">Confirm Password:</label>
                    <input type="password" id="confirm-password" name="confirm-password" required>
                    <label for="telepon">NoTelepon:</label>
                    <input type="text" id="telepon" name="telepon" required>
                    <button type="submit">Register</button>
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
