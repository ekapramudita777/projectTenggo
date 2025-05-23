<?php
session_start();

date_default_timezone_set('Asia/Jakarta');

$tanggal = date('Ymd');
$jam_menit_detik = date('His');
$random = rand(100,999);
$kodeBayar = "TRX-".$tanggal."-".$jam_menit_detik."-".$random;
$waktu = date('d-m-Y H:i');

if (!isset($_SESSION['kodeBayar'])) {
    $tanggal = date('Ymd');
    $jam_menit_detik = date('His');
    $random = rand(100,999);
    $_SESSION['kodeBayar'] = "TRX-".$tanggal."-".$jam_menit_detik."-".$random;
    $_SESSION['waktu']= date('Y-m-d');
}
?>

<form id="infoTransaksi" method="POST" action="prosesKasir.php">
    <label for="kodeBayar">Kode Bayar: </label>
    <input type="text" name="kodeBayar" id="kodeBayar" value="<?php echo isset($_SESSION['kodeBayar']) ? $_SESSION['kodeBayar']: ''; ?>" readonly><br>

    <label for="waktu">Waktu: </label>
    <input type="text" name="waktu" id="waktu" value="<?php echo isset($_SESSION['waktu']) ? $_SESSION['waktu']: ''; ?>" readonly><br>

    <label for="kasir">Kasir:</label>
    <input type="text" name="kasir" id="kasir" required value="<?php echo isset($_POST['kasir']) ? $_POST['kasir'] : ''; ?>"><br><br>
</form>



<form id="kirim"action="prosesKasir.php" method="POST">
    <label for="kodeBarang">Kode Barang:</label>
    <input type="text" name="kodeBarang" id="kodeBarang" required>
    <label for="qty">Quantity:</label>
    <input type="number" name="qty" id="qty" required min="1">

    <input type="hidden" name="kodeBayar" id="hiddenKodeBayar" value="<?php echo $_SESSION['kodeBayar']; ?>">
    <input type="hidden" name="waktu" id="hiddenWaktu" value="<?php echo $_SESSION['waktu']; ?>">
    <input type="hidden" name="kasir" id="hiddenKasir" value="<?php echo $_SESSION['kasir']; ?>">

    <button type="submit" name="tambah">Tambah ke Keranjang</button>
</form>

<script>
     document.getElementById('kasir').addEventListener('input', function() {


    document.getElementById('hiddenKodeBayar').value = document.querySelector('[name="kodeBayar"]').value;
    document.getElementById('hiddenWaktu').value = document.querySelector('[name="waktu"]').value;
    document.getElementById('hiddenKasir').value = document.querySelector('[name="kasir"]').value;
    

    document.getElementById('kirim').submit();
     });
</script>

<h2>KERANJANG</h2>
<table>
    <thead>
        <tr>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Sub Total</th>
        </tr>
    </thead>
    <tbody>
    <?php if (isset($_SESSION['keranjang']) && is_array($_SESSION['keranjang'])): ?>
        <?php foreach ($_SESSION['keranjang'] as $item) : ?>
            <tr>
                <td><?php echo $item['kodeBarang']; ?></td>
                <td><?php echo $item['namaBarang']; ?></td>
                <td><?php echo number_format($item['harga'], 2); ?></td>
                <td><?php echo $item['qty']; ?></td>
                <td><?php echo number_format($item['subTotal'], 2); ?></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>

<p><strong>Total: </strong>
<?php
if (isset($_SESSION['keranjang']) && is_array($_SESSION['keranjang'])) {
    echo number_format(array_sum(array_column($_SESSION['keranjang'], 'subTotal')), 2);
} else {
    echo '0.00';
}
?>
</p>
<form action="" method="POST">
<label for ="metodeBayar">Metode Bayar:</label>
<select name="metodeBayar" id="metodeBayar">
    <optio value="" disabled selected>Pilih Metode Bayar...</option>
    <option value="Tunai">Tunai</option>
    <option value="Debit">Debit</option>
    <option value="Qris">Qris</option>
    <option value="Transfer">Transfer</option>
</select>
    <label for="bayar">Jumlah Bayar:</label>
    <input type="number" name="bayar" id="bayar" required min="1" 
        value="<?php echo isset($_POST['bayar'])? $_POST['bayar']:'';?>">
    
    <button type="submit" name="hitungKembali">Hitung Kembalian</button>
</form>

<P> KEMBALIAN : 
<?php
if (isset($_POST['hitungKembali'])){
    if(isset($_SESSION['keranjang'])&& is_array($_SESSION['keranjang'])){
        $total = array_sum(array_column($_SESSION['keranjang'], 'subTotal'));
        $bayar = $_POST['bayar'];
        $kembali = $bayar-$total;

        echo number_format($kembali,2);
    }
}
?>
</p>

<form action="prosesKasir.php" method="POST">
    <input type="hidden" name="kodeBayar" value="<?php echo $_SESSION['kodeBayar']; ?>">
    <input type="hidden" name="waktu" value="<?php echo $_SESSION['kodeBayar']; ?>">
    <input type="hidden" name="kasir" value="<?php echo $_SESSION['kodeBayar']; ?>">
    <input type="hidden" name="totalBayar" value="<?php echo isset($_SESSION['keranjang']) ? array_sum(array_column($_SESSION['keranjang'], 'subTotal')) : 0; ?>">
    <input type="hidden" name="metodeBayar" value="<?php echo isset($_POST['metodeBayar']) ? $_POST['metodeBayar'] : ''; ?>">
    <input type="hidden" name="bayar" value="<?php echo isset($_POST['bayar']) ? $_POST['bayar'] : ''; ?>">
    <input type="hidden" name="kembalian" value="<?php echo isset($_POST['hitungKembali']) ? number_format($kembali, 2) : ''; ?>">

    <button type="submit" name="simpanTransaksi">Simpan Transaksi</button>
</form>

<form action="resetKasir.php" method="POST">
    <button type="submit">Reset Keranjang</button>
</form>

