<?php
include '../database/connect.php';
$station = intval($_GET['station']);
$sql = mysqli_query($koneksi, "DELETE FROM listrik WHERE station = $station");
