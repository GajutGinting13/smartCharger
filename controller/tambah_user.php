<?php
// Pastikan request yang diterima adalah metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form POST
    $nama = $_POST['nama'];
    $password = $_POST['password'];

    // Koneksi ke database (contoh menggunakan mysqli)
    require '../database/connect.php'; // Sesuaikan dengan file koneksi database Anda

    // Escape data untuk menghindari SQL Injection
    $nama = mysqli_real_escape_string($koneksi, $nama);
    $password = mysqli_real_escape_string($koneksi, $password);

    // Query untuk menambahkan user baru
    $query = "INSERT INTO user (nama, password, saldo) VALUES ('$nama', '$password', 0)";
    if ($koneksi->query($query) === TRUE) {
        // Jika query berhasil dieksekusi
        $response = [
            'success' => true
        ];
        echo json_encode($response);
    } else {
        // Jika terjadi kesalahan saat eksekusi query
        $response = [
            'success' => false,
            'message' => 'Gagal menambahkan user: ' . $koneksi->error
        ];
        echo json_encode($response);
    }

    // Tutup koneksi ke database
    $koneksi->close();
} else {
    // Metode request yang tidak diizinkan
    http_response_code(405);
    echo json_encode(['message' => 'Metode request tidak diizinkan.']);
}
