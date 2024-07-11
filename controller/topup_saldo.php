<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari body POST dan mengurai JSON
    $data = json_decode(file_get_contents("php://input"));

    // Validasi data yang diterima
    if (isset($data->id) && isset($data->amount)) {
        // Koneksi ke database (contoh menggunakan mysqli)
        require '../database/connect.php'; // Sesuaikan dengan file koneksi database Anda

        // Escape data untuk menghindari SQL Injection
        $id = mysqli_real_escape_string($koneksi, $data->id);
        $amount = mysqli_real_escape_string($koneksi, $data->amount);

        // Query untuk mendapatkan saldo user sebelum ditambahkan
        $querySelect = "SELECT saldo FROM user WHERE id = $id";
        $resultSelect = $koneksi->query($querySelect);

        if ($resultSelect) {
            $row = $resultSelect->fetch_assoc();
            $currentSaldo = $row['saldo'];

            // Menghitung saldo baru setelah ditambahkan
            $newSaldo = $currentSaldo + $amount;

            // Query untuk update saldo user
            $queryUpdate = "UPDATE user SET saldo = $newSaldo WHERE id = $id";
            $resultUpdate = $koneksi->query($queryUpdate);

            if ($resultUpdate) {
                // Berhasil mengupdate saldo
                $response = [
                    'success' => true,
                    'updated_saldo' => $newSaldo
                ];
                echo json_encode($response);
            } else {
                // Gagal mengupdate saldo
                $response = [
                    'success' => false,
                    'message' => 'Gagal mengupdate saldo.'
                ];
                echo json_encode($response);
            }
        } else {
            // Gagal mendapatkan saldo user
            $response = [
                'success' => false,
                'message' => 'Gagal mendapatkan saldo user.'
            ];
            echo json_encode($response);
        }
    } else {
        // Data tidak lengkap
        $response = [
            'success' => false,
            'message' => 'Data tidak lengkap.'
        ];
        echo json_encode($response);
    }
} else {
    // Metode request yang tidak diizinkan
    http_response_code(405);
    echo json_encode(['message' => 'Metode request tidak diizinkan.']);
}
