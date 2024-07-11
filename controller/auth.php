<?php
require '../database/connect.php';
session_start();
$nama = $_POST['nama'];
$password = $_POST['password'];

if ($nama == "Admin") {
    $sql = mysqli_query($koneksi, "SELECT * FROM `admin` WHERE `nama` = '$nama' AND `password` = '$password'");
} else {
    $sql = mysqli_query($koneksi, "SELECT * FROM `user` WHERE `nama` = '$nama' AND `password` = '$password'");
}

$hasil = mysqli_fetch_array($sql);
if ($hasil == true and $nama == "Admin") {
    $_SESSION['nama'] = $nama;
    header("Location: ../admin.php");
} else if ($hasil) {
    $_SESSION['nama'] = $nama;
    header("Location: ../index.php");
} else {
    echo "<script>alert('Nama Atau Password Salah')
    window.location.href = '../index.php';</script>";
}
