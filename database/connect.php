<?php
$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "charger";
$koneksi = new mysqli($servername, $username, $password, $dbname);
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
