<?php
include('koneksi.php');

$kodeBarang = $_POST['kodeBarang'];
$namaBarang = $_POST['namaBarang'];
$stok = $_POST['stok'];
$harga = $_POST['harga'];
$aksi = $_POST['aksi'];

if ($aksi == "Simpan") {
    $cek = $conn->prepare("SELECT * FROM tb_barang WHERE kodeBarang = ?");
    $cek->bind_param("s", $kodeBarang);
    $cek->execute();
    $result = $cek->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Kode Barang sudah ada! Gunakan kode lain.'); window.history.back();</script>";
        exit();
    }
    
    $stmt = $conn->prepare("INSERT INTO tb_barang (kodeBarang, namaBarang, stok, harga) VALUES (?,?,?,?)");
    $stmt->bind_param("ssdi", $kodeBarang, $namaBarang, $stok, $harga);
    if ($stmt->execute()){
        echo "<script>alert('Berhasil Simpan Data'); window.location.href='barang.php';</script>";
    }else{
        echo "<script>alert('Gagal Simpan Data ".$stmt->error."'); window.history.back();</script>";
    }
}elseif ($aksi == "Ubah"){
    $stmt = $conn->prepare("UPDATE tb_barang SET namaBarang=?, stok=?, harga=? WHERE kodeBarang=?");
    $stmt->bind_param("sdis", $namaBarang, $stok, $harga, $kodeBarang);
    if ($stmt->execute()){
        echo "<script>alert('Berhasil Ubah Data'); window.location.href='barang.php';</script>";
    }else{
        echo "<script>alert('Gagal Ubah Data ".$stmt->error."'); window.history.back();</script>";
    }
} elseif ($aksi == "Hapus") {
    $stmt = $conn->prepare("DELETE FROM tb_barang WHERE kodeBarang=?");
    $stmt->bind_param("s", $kodeBarang);
    if ($stmt->execute()){
        echo "<script>alert('Berhasil Hapus Data'); window.location.href='barang.php';</script>";
    }else{
        echo "<script>alert('Gagal Hapus Data ".$stmt->error."'); window.history.back();</script>";
    }
}
if (isset($stmt)) $stmt->close();
$conn->close();