<?php
$servername = "localhost";
$username = "u387258854_project";
$password = "Project12345678";
$dbname = "u387258854_charger";
$koneksi = new mysqli($servername, $username, $password, $dbname);
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
