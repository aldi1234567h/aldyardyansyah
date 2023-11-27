<?php
// Mulai sesi
session_start();

// Periksa apakah pengguna sudah masuk
if (!isset($_SESSION["username"])) {
    // Jika belum masuk, alihkan ke halaman login
    header("Location: login.php");
    exit();
}

// Jika sudah masuk, dapatkan username dari variabel sesi
$logged_in_username = $_SESSION["username"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <header>
        <h1>Dashboard</h1>
        <p>Selamat datang, <?php echo $logged_in_username; ?>!</p>
    </header>

    <nav>
        <ul>
            <!-- Tautan navigasi lainnya -->
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <main>
    <section id="banner">
                    <span class="image object">
                        <img src="images/gbr4.jpeg" alt="" />
                    </span>
                    <div class="content">
                
                      
                    </div>
                </section>


    </main>

     <!-- Footer -->
     <footer id="footer">
        <p class="copyright">&copy; NAMA: SALSA CAMELIA ZAHRA</p>
        <p>NPM: 21552011135</p>
        <p>UTS PEMROGRAMAN WEB 1</p>
    </footer>
</body>
</html>
