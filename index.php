<?php
include 'koneksi.php';
session_start();
if (!isset($_SESSION['level'])) {
    header('location: login.php');
    exit();
}
?>
<?php include 'link.php'; ?>
<title>Waroeng Geh</title>

<body>
    <!-- Navbar -->
    <nav>
        <div class="logo">
            <h3>Waroeng<span>Geh</span><i class="far fa-laugh-wink"></i></h3>
        </div>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#menu">Menu</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#hub">Hubungi Kami</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
        <div class="menu_toggle">
            <input type="checkbox">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>
    <!-- Akhir navbar -->

    <!-- Slide foto -->
    <div class="slider_foto">
        <div class="myslider pudar" style="display: block;">
            <div class="teks">
                <h1>Bunderan Tugu Adipura</h1>
                <p>Bunderan Tugu Adipura sebagai lokasi favorit tempat kuliner dan cocok pengambilan untuk foto.</p>
            </div>
            <img class="image" src="images/templete1.jpg" alt="kopi" style="width:100%; height:100%;">
        </div>
        <div class="myslider pudar">
            <div class="teks">
                <h1>Sambal Khas Lampung</h1>
                <p>Ciri khas rasa sambal yang berbeda dari sambal lainnya.</p>
            </div>
            <img class="image" src="images/templete2.jpg" alt="kopi" style="width:100%; height:100%;">
        </div>
        <div class="myslider pudar">
            <div class="teks">
                <h1>Penyajian</h1>
                <p>Penyajian makanan masih tradisional.</p>
            </div>
            <img class="image" src="images/templete3.jpg" alt="kopi" style="width:100%; height:100%;">
        </div>
        <a class="kembali" onclick="plusSlides(-1)">&#60;</a>
        <a class="lanjut" onclick="plusSlides(1)">&#62;</a>
        <div class="dbox" style="text-align: center;">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>
    </div>
    <!-- Akhir slide foto -->

    <!-- conten -->
    <!-- menu -->
    <section id="menu">
        <div class="heading">
            <h1>Menu</h1>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <?php
                $sql = "SELECT * FROM data_menu";
                $query = mysqli_query($koneksi, $sql);
                foreach ($query as $menu) : ?>

                    <div class="col-md-4 mb-4">
                        <div class="card shadow text-center bg_cs">
                            <img src="images/<?= $menu['gambar'] ?>" class="card-img-top" alt="<?= $menu['gambar']; ?>" style="width: auto; height:250px;">
                            <div class="card-body">
                                <strong class="card-text txt"><?= $menu['nama_menu']; ?></strong><br>
                                <strong>Rp. </strong><?= $menu['harga']; ?><br>
                                <a href="pemesanan.php?id_menu=<?= $menu['id_menu']; ?>" class="btn bt">Pesan</a>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- akhir menu -->



    <!-- about -->
    <section id="about">
        <div class="container">
            <div class="heading">
                <h1>About</h1>
            </div>
            <div class="row about rounded shadow">
                <div class="col-sm-6 float-sm-left">
                    <img src="images/about.jpg" alt="cave" class="img-fluid rounded-left" style="width: 100%; height:400px;">
                </div>
                <div class="col-sm-6 float-sm-right mt-4 text-center">
                    <div class="logo">
                        <h3>Waroeng<span>Geh</span><i class="far fa-laugh-wink"></i></h3>
                    </div>
                    <div style="font-size: 20px;">
                        <p>Kota Bandar Lampung terkenal dengan hidangan pindang ikannya. Bagi penggemar pindang ikan, Rumah Waroeng Geh rasanya menjadi tempat yang wajib untuk dikunjungi. </p>
                        <p> Bahkan banyak para pelancong dari luar Kota Bandar Lampung yang menyempatkan untuk mencicipi kelezatan kuliner khas Bandar Lampung tersebut di Rumah Waroeng Geh.</p>
                    </div>
                    <a href="#" class="btn bt align-content-center">Lebih Detail</a>
                </div>
            </div>
        </div>
    </section>
    <!-- akhir about -->

    <!-- Hubungi Kami -->
    <section id="hub">
        <div class="container mb-5">
            <div class="heading">
                <h1>Hubungi Kami</h1>
            </div>
            <div class="row about rounded shadow">
                <div class="col-sm-6 float-sm-left pl-0">
                    <div class="embed-responsive embed-responsive-1by1">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d746.1106392809232!2d105.22530467361108!3d-5.3618820209410485!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40c5363829b655%3A0xf432698170ac37e6!2sBundaran%20Hajimena!5e1!3m2!1sid!2sid!4v1636920150427!5m2!1sid!2sid" width="700" height="450" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
                <div class="col-sm-6 float-sm-right mt-5 text-center">
                    <div class="row justify-content-center">
                        <div class="col-md-11">
                            <form>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="name" aria-describedby="name">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" aria-describedby="email">
                                </div>
                                <div class="mb-3">
                                    <label for="pesan" class="form-label">Pesan</label>
                                    <textarea class="form-control" id="pesan" rows="3"></textarea>
                                </div>
                                <a href="#" class="btn bt align-content-center">Kirim</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- akhir hubungi kami -->



    <!-- footer -->
    <footer class="text-center text-white mt-lg-5 shadow">

        <p> Created with <i class="text-danger"></i> by <a href="https://z-p4.www.instagram.com/fadilanzikril23/" target="blank" class="fw-bold">Fadilahn
                Dzikril</a></p>
    </footer>
    <!-- akhir footer -->
</body>
<!-- Link MYjs -->
<script src="js/scripweb2.js"></script>

</html>