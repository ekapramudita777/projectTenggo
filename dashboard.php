<?php
session_set_cookie_params(0);
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: index.php"); // Jika belum login, arahkan ke halaman login
    exit();
}

// Tampilkan pesan selamat datang
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h2>Selamat datang, <?php echo htmlspecialchars($username); ?>!</h2>
    <p>Ini adalah halaman dashboard Anda.</p>

    <a href="logout.php">Logout</a>
</body>
</html>