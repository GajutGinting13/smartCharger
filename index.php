<?php
$judul = "Pachuraji";
$page = "Home";
session_start();
error_reporting(1);
?>
<!DOCTYPE html>
<html>

<head>
  <?php
  include 'head.php';
  ?>
</head>

<body>
  <div class="hero_area">
    <div class="hero_bg_box">
      <div class="bg_img_box">
        <img src="images/hero-bg.png" alt="">
      </div>
    </div>
    <?php include 'header.php';
    include 'pembuka.php';
    ?>
  </div>
  <?php
  if ($_SESSION['nama'] != null) {
  ?>
    <section class="service_section layout_padding">
      <div class="service_container">
        <div class="container ">
          <div class="heading_container heading_center">
            <h2>Daftar <span>Paket</span></h2>
          </div>
          <div class="row">
            <div class="col-md-4 ">
              <div class="box ">
                <div class="img-box">
                  <img src="images/s1.png" alt="">
                </div>
                <div class="detail-box">
                  <h5>Paket A</h5>
                  <p>Paket A menawarkan pengguna bisa menggunakan Rp. 5000/Kwh</p>
                  <a href="scan.php?paket=5000">Beli Sekarang</a>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="box">
                <div class="img-box">
                  <img src="images/s1.png" alt="">
                </div>
                <div class="detail-box">
                  <h5>Paket B</h5>
                  <p> Paket B menawarkan pengguna bisa menggunakan Rp. 10.000/Kwh</p>
                  <a href="scan.php?paket=10000">Beli Sekarang</a>
                </div>
              </div>
            </div>
            <div class="col-md-4 ">
              <div class="box ">
                <div class="img-box">
                  <img src="images/s3.png" alt="">
                </div>
                <div class="detail-box">
                  <h5>Custom</h5>
                  <p>Di paket custom anda bisa memilih berapa yang akan anda gunakan.</p>
                  <a data-toggle="modal" data-target="#custom">Beli Sekarang</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php
  }
  ?>
  <div class="modal fade" id="custom" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="customLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="customLabel">Custom Paket</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-sm-12">
            <div class="col-auto">
              <label class="sr-only" for="custompaket">Username</label>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text">Rp. </div>
                </div>
                <input type="number" class="form-control" id="custompaket" placeholder="Minimal Rp. 1000">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="belicustom">Beli</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Login-->
  <div class="modal fade" id="login" tabindex="-1" aria-labelledby="loginLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginLabel">Login</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="controller/auth.php" method="post">
            <div class="mb-3 row">
              <label for="staticEmail" class="col-sm-2 col-form-label">Nama</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nama" id="staticEmail">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" name="password" id="inputPassword">
              </div>
            </div>
            <input type="submit" value="Login" class="btn btn-success">
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php
  include 'footer.php';
  include 'library.php'; ?>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#belicustom').click(function() {
        let harga = $('#custompaket').val();
        if (harga < 1000) {
          alert('Minimal Pembelian Rp. 1.000');
        } else {
          window.location.href = 'scan.php?paket=' + harga;
        }
      })
    })
  </script>

</body>

</html>