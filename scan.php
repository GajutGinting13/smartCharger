<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $judul = "Pachuraji";
    $page = "Scan";
    include 'head.php';
    session_start();
    $nama = $_SESSION['nama'];
    ?>
    <style>
        #video-container {
            position: relative;
            width: 100%;
            /* Sesuaikan dengan lebar layar HP */
            height: 70vh;
            /* Sesuaikan dengan tinggi layar HP */
        }

        #qr-video {
            width: 100%;
            height: 100%;
        }

        #qr-result {
            margin-top: 10px;
            font-size: 18px;
        }

        body {
            background-color: #003566;
        }

        .corner-border {
            position: absolute;
            width: 30px;
            /* Lebar dan tinggi border */
            height: 30px;
            border: 6px solid yellow;
            /* Warna dan ketebalan border */
        }

        .corner-border.top-left {
            top: 0;
            left: 0;
            border-right: none;
            border-bottom: none;
        }

        .corner-border.top-right {
            top: 0;
            right: 0;
            border-left: none;
            border-bottom: none;
        }

        .corner-border.bottom-left {
            bottom: 0;
            left: 0;
            border-right: none;
            border-top: none;
        }

        .corner-border.bottom-right {
            bottom: 0;
            right: 0;
            border-left: none;
            border-top: none;
        }
    </style>
</head>

<body>
    <div id="video-container">
        <video id="qr-video" width="100%" height="100%" playsinline></video>
        <div class="corner-border top-left"></div>
        <div class="corner-border top-right"></div>
        <div class="corner-border bottom-left"></div>
        <div class="corner-border bottom-right"></div>
    </div>
    <div class="heading_container heading_center">
        <h3 style="color: white;">Arahkan Kamera untuk Memindai Kode QR dan Nikmati Layanan Listrik di Kafe</h3>
    </div>

    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script>
        const key = CryptoJS.enc.Utf8.parse('1234567890123456'); // 16-byte key
        const iv = CryptoJS.enc.Utf8.parse('1234567890123456'); // 16-byte IV

        function encryptText(plainText) {
            const encrypted = CryptoJS.AES.encrypt(plainText, key, {
                iv: iv
            });
            return encrypted.toString();
        }

        function decryptText(encryptedText) {
            const decrypted = CryptoJS.AES.decrypt(encryptedText, key, {
                iv: iv
            });
            return decrypted.toString(CryptoJS.enc.Utf8);
        }
        // const encryptedText = encryptText("smartcharger/controller/validasi.php?station=1");
        // console.log(encryptedText);
        // Hasil Enkripsi = "ZEWop2GUZ/4ix1uWc9jK6BWiBw3AMfv7BuYp5mzzp6bNjd4maXdsyWs69UKlIC9s";
        // Mulai Scan
        const video = document.getElementById('qr-video');
        let scanner = new Instascan.Scanner({
            video,
            mirror: false
        });

        scanner.addListener('scan', function(content) {
            if (content == "ZEWop2GUZ/4ix1uWc9jK6BWiBw3AMfv7BuYp5mzzp6bNjd4maXdsyWs69UKlIC9s") {
                const decryptedText = decryptText(content);
                const url = "http://localhost/" + content + "&paket=<?php echo $_GET['paket'] ?>&nama=<?php echo $nama ?>";
                window.open(url);
            } else {
                alert("QRcode Tidak Dikenal.");
            }
        });

        function startScanner() {
            Instascan.Camera.getCameras().then(function(cameras) {
                if (cameras.length > 0) {
                    const constraints = {
                        video: {
                            deviceId: {
                                exact: cameras[cameras.length - 1].deviceId
                            },
                            facingMode: 'environment'
                        }
                    };
                    scanner.start(cameras[cameras.length - 1], constraints);
                } else {
                    console.error('Tidak ada kamera yang ditemukan.');
                }
            }).catch(function(e) {
                console.error(e);
            });
        }
        startScanner();
    </script>
</body>

</html>