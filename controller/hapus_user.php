<?php
// Pastikan request yang diterima adalah metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil ID user yang akan dihapus
    $id = $_POST['id'];

    // Koneksi ke database (contoh menggunakan mysqli)
    require '../database/connect.php'; // Sesuaikan dengan file koneksi database Anda

    // Query untuk menghapus user berdasarkan ID
    $query = "DELETE FROM user WHERE id = '$id'";
    if ($koneksi->query($query) === TRUE) {
        // Jika query berhasil dieksekusi
        header("Location: ../admin.php");
    } else {
        // Jika terjadi kesalahan saat eksekusi query
        echo json_encode([
            'success' => false,
            'message' => 'Gagal menghapus user: ' . $koneksi->error
        ]);
    }

    // Tutup koneksi ke database
    $koneksi->close();
} else {
    // Metode request yang tidak diizinkan
    header("Location: ../admin.php");
}
