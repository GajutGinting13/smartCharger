<header class="header_section">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="index.html">
                <span><?= $judul ?></span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class=""> </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav  ">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="service.html">Daftar</a>
                    </li>
                    <?php
                    if ($_SESSION['nama'] == null) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="modal" data-target="#login"> <i class="fa fa-user" aria-hidden="true"></i> Login</a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="controller/logout.php">Logout</a>
                        </li>
                    <?php
                        echo "<h4 style='color:white;'>" . $_SESSION['nama'] . "</h4>";
                    }
                    ?>
                </ul>
            </div>
        </nav>
    </div>
</header>