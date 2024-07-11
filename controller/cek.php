<?php
include '../database/connect.php';
$station = intval($_GET['station']);
$sql = mysqli_query($koneksi, "SELECT * FROM listrik WHERE station = $station");
if (mysqli_num_rows($sql) > 0) {
    $data = mysqli_fetch_array($sql);
    echo $data['kwh'];
}
