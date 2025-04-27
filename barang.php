
<form action="prosesBarang.php" method="post">
        <label for="kodeBarang">Kode Barang:</label>
        <input type="text" name="kodeBarang" id="kodeBarang" required><br><br>
        <label for="namaBarang">Nama Barang</label>
        <input type="text" name="namaBarang" id="namaBarang" required><br><br>
        <label for="stok">Stok</label>
        <input type="text" name="stok" id="stok" required><br><br>
        <label for="harga">Harga</label>
        <input type="text" name="harga" id="harga" required><br><br>
        <input type="submit" name="aksi" value="Simpan">
        <input type="submit" name="aksi" value="Ubah">
        <input type="submit" name="aksi" value="Hapus">
</form>

<?php
include 'koneksi.php';

$sql = "SELECT*FROM tb_barang";
$result = $conn->query($sql);

if ($result->num_rows > 0){
    echo"<h3> DAFTAR BARANG <h3>";
    echo"<table border='1' cellpadding='10' cellspacing='0'>";
    echo"<tr>
         <th>Kode Barang</th>
         <th>Nama Barang</th>
         <th>Stok</th>
         <th>Harga</th>
         </tr>";

         while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['kodeBarang']}</td>
                    <td>{$row['namaBarang']}</td>
                    <td>{$row['stok']}</td>
                    <td>{$row['harga']}</td>
                  </tr>";   
}

echo "</table>";
} else {
    echo "<p>Belum ada data barang.</p>";
}

$conn->close();
?>