<?php
session_start();
include 'koneksi.php';


if(isset($_POST['kodeBayar'],$_POST['waktu'], $_POST['kasir'])){
    $kodeBayar =$_POST['kodeBayar'];
    $waktu = $_POST['waktu'];
    $kasir = $_POST['kasir'];
    
}

if (isset($_POST['tambah'])) {
    $kodeBarang = $_POST['kodeBarang'];
    $qty = $_POST['qty'];

    

    $query = mysqli_query($conn, "SELECT * FROM tb_barang WHERE kodeBarang = '$kodeBarang'");
    $barang = mysqli_fetch_assoc($query);

    if ($barang) {
        $subtotal = $qty * $barang['harga'];
        $_SESSION['keranjang'][] = [
            'kodeBarang' => $barang['kodeBarang'],
            'namaBarang' => $barang['namaBarang'],
            'harga' => $barang['harga'],
            'qty' => $qty,
            'subTotal' => $subtotal
        ];
    }

    header("Location: kasir.php");
    exit;
}

if (isset($_POST['kodeBayar'], $_POST['waktu'], $_POST['kasir'], $_POST['totalBayar'], $_POST['metodeBayar'], $_POST['bayar'], $_POST['kembalian'])) {
    $kodeBayar = $_POST['kodeBayar'];
    $waktu = $_POST['waktu'];
    $kasir = $_POST['kasir'];
    $totalBayar = $_POST['totalBayar'];
    $metodeBayar = $_POST['metodeBayar'];
    $bayar = $_POST['bayar'];
    $kembalian = $_POST['kembalian'];

    // Query untuk menyimpan transaksi ke tb_penjualan
    $query = "INSERT INTO tb_penjualan (kodeBayar, tglPenjualan, kasir, totalBayar, metodeBayar, jumlahBayar, kembali) 
              VALUES ('$kodeBayar', '$waktu', '$kasir', '$totalBayar', '$metodeBayar', '$bayar', '$kembalian')";
    
    // Eksekusi query
    if (mysqli_query($conn, $query)) {
        echo "Transaksi berhasil disimpan!";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Data transaksi tidak lengkap!";
}
?>

