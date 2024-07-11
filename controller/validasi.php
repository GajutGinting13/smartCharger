<?php
require '../database/connect.php';

$station = intval($_GET['station']);
$paket = intval($_GET['paket']);
$nama = $_GET['nama'];
$harga = 1000; // Rp. 1000/Kwh
$kwh = $paket / 1000;
$cek = mysqli_query($koneksi, "SELECT * FROM listrik WHERE station = '$station'");
if (mysqli_num_rows($cek) > 0) {
    echo "<script>alert('station masih ada paket');window.location.href = '../index.php';</script>";
} else {
    $sql = mysqli_query($koneksi, "SELECT * FROM user WHERE nama = '$nama'");
    $saldo = mysqli_fetch_array($sql);
    if (intval($saldo['saldo']) >= $paket) {
        $simpan = mysqli_query($koneksi, "INSERT INTO `listrik` (`status`, `kwh`, `station`) VALUES (1, '$kwh', $station)");
        if ($simpan) {
            $saldo_terakhir = intval($saldo['saldo']) - $paket;
            mysqli_query($koneksi, "UPDATE `user` SET saldo = $saldo_terakhir WHERE nama = '$nama'");
            echo "<script>window.location.href = '../index.php';</script>";
        } else {
            echo "<script>alert('Gagal menyimpan data listrik');window.location.href = '../index.php';</script>";
        }
    } else {
        echo "<script>alert('Saldo Anda Kurang');window.location.href = '../index.php';</script>";
    }
}
