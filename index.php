<?php
session_set_cookie_params(0);
session_start();
include('koneksi.php');  // Menyertakan file koneksi database

// Cek jika sudah login, langsung redirect ke dashboard
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

// Proses login ketika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Mengecek apakah username dan password valid
    $sql = "SELECT * FROM tb_user WHERE username = '$user' AND password = '$pass'";
    $result = $conn->query($sql);

    // Jika ditemukan data yang cocok
    if ($result->num_rows > 0) {
        $_SESSION['username'] = $user; // Set session
        header("Location: dashboard.php");
        exit();
    } else {
        // Jika username/password salah
        $error_message = "Username atau password salah.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    <!-- Menampilkan pesan error jika ada -->
    <?php if (isset($error_message)): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <!-- Form login -->
    <form action="index.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>