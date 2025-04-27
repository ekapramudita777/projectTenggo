<?php
include ('koneksi.php')

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kodeBarang = $_POST['kodeBarang'];
    $namaBarang = $_POST['namaBarang'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];

    $sql = "UPDATE tb_barang (namaBarang, stok, harga) WHERE VALUES (?,?,?,?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ssdi", $kodeBarang, $namaBarang, $stok, $harga);

    if ($stmt->execute()){
        echo "Data Berhasil Disimpan!";
    }else{
        echo"Data Gagal Disimpan" . $stmt -> error;
    }

    $stmt->close();
    $conn->close();
}
?>

?>