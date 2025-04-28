<?php
session_start();
unset($_SESSION['keranjang']);
session_destroy();
header("Location: kasir.php");
    exit;
?>