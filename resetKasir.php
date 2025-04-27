<?php
session_start();
unset($_SESSION['keranjang']);

header("Location: kasir.php");
    exit;
?>