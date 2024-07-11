<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .form-control-sm {
            max-width: 100px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="controller/logout.php">Logout</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                </ul>
                <span class="navbar-text">
                    Selamat Datang Admin
                </span>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <h1>Data User</h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahUserModal">
            Tambah User
        </button>

        <!-- Modal Tambah User -->
        <div class="modal fade" id="tambahUserModal" tabindex="-1" aria-labelledby="tambahUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahUserModalLabel">Tambah User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formTambahUser">
                            <div class="mb-3">
                                <label for="inputNama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="inputNama" name="nama">
                            </div>
                            <div class="mb-3">
                                <label for="inputPassword" class="form-label">Password</label>
                                <input type="password" class="form-control" id="inputPassword" name="password">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="hapusUserModal" tabindex="-1" aria-labelledby="hapusUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="hapusUserModalLabel">Hapus User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Anda yakin ingin menghapus user ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form id="formHapusUser" method="POST" action="controller/hapus_user.php">
                            <input type="hidden" id="id_hapus" name="id">
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tabel Data User -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Saldo</th>
                    <th scope="col">Top-Up Saldo</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require 'database/connect.php';
                $sql = "SELECT * FROM user";
                $result = $koneksi->query($sql);

                if ($result->num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<th scope='row'>" . $no . "</th>";
                        echo "<td>" . $row["nama"] . "</td>";
                        echo "<td>Rp. <span id='saldo_" . $row["id"] . "'>" . number_format($row["saldo"], 0, ',', '.') . "</span></td>";
                        // Formulir Top-Up Saldo
                        echo "<td>";
                        echo "<div class='input-group input-group-sm'>";
                        echo "<input type='number' id='topup_" . $row["id"] . "' class='form-control form-control-sm' placeholder='Top-Up'>";
                        echo "<button class='btn btn-success' type='button' onclick='topupSaldo(" . $row["id"] . ")'>Top-Up</button>";
                        echo "</div>";
                        echo "</td>";
                        // Aksi Hapus User
                        echo "<td>";
                        echo "<button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#hapusUserModal' onclick=\"document.getElementById('id_hapus').value = " . $row["id"] . "\">Hapus</button>";
                        echo "</td>";
                        echo "</tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='5'>Tidak ada data user</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.getElementById('formTambahUser').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah form untuk submit default

            var formData = new FormData(this);

            // Kirim data form ke backend (contoh menggunakan fetch API)
            fetch('controller/tambah_user.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('User berhasil ditambahkan.');
                        location.reload(); // Muat ulang halaman setelah berhasil tambah user
                    } else {
                        alert('Gagal menambahkan user.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menambahkan user.');
                });
        });

        function topupSaldo(id) {
            var topupAmount = document.getElementById('topup_' + id).value;
            if (topupAmount.trim() === '' || isNaN(topupAmount) || topupAmount <= 0) {
                alert('Masukkan jumlah top-up yang valid.');
                return;
            }

            // Kirim permintaan top-up saldo ke backend (contoh menggunakan fetch API)
            fetch('controller/topup_saldo.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        id: id,
                        amount: topupAmount,
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update saldo di tabel
                        document.getElementById('saldo_' + id).textContent = data.updated_saldo;
                        alert('Saldo berhasil ditambahkan.');
                    } else {
                        alert('Gagal top-up saldo.');
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memproses permintaan.');
                });
        }
    </script>
</body>

</html>