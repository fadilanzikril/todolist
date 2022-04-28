<?php
session_start();
include 'link.php'; ?>
<?php
include 'koneksi.php';
if (isset($_GET['id_menu'])) {
    $id = $_GET['id_menu'];
    $sql = "SELECT * FROM data_menu WHERE id_menu = $id";
    $query = mysqli_query($koneksi, $sql);
    $row = mysqli_num_rows($query);
    if ($row == 1) {
        $fetch = mysqli_fetch_assoc($query);
        $nama_menu = $fetch['nama_menu'];
        $harga_menu = $fetch['harga'];
        $gambar = $fetch['gambar'];
    } else {
        header('location:index.php');
    }
} else {
    header('location:index.php');
}
?>
<!-- tambah pesanan -->
<!-- Masih karena bego -->
<?php
if (isset($_POST['submit'])) {
    $menu = $_POST['nama_menu'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];

    $status = "Di Pemesanan";
    $total = $jumlah * $harga;
    $date = date('Y-m-d H:i:s ');
    $nama_lengkap = $_POST['nama_lengkap'];
    $notel = $_POST['notelepon'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];

    $insert = "INSERT INTO pesan_menu SET 
        nama_menu = '$menu',
        harga = $harga,
        jumlah = $jumlah,
        total = $total,
        waktu = '$date',
        status = '$status',
        nama_lengkap = '$nama_lengkap',
        telepon = '$notel',
        email = '$email',
        alamat = '$alamat' ";
    // echo $insert;die();
    $res2 = mysqli_query($koneksi, $insert);

    if ($res2 == true) {
        $_SESSION['pemesanan'] = "Data pesanan berhasil di kirim";
    } else {
        $_SESSION['pemesanan_gagal'] = "Data pesanan berhasil di kirim";
    }
}
?>
<!-- akhir pesanan -->

<!-- form -->

<title>Pemesanan</title>

<body>
    <!-- Navbar -->
    <nav>
        <div class="logo">
            <h3>Waroeng<span>Geh</span><i class="far fa-laugh-wink"></i></h3>
        </div>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="#lokasi">Tabel</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
        <div class="menu_toggle">
            <input type="checkbox">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>
    <div class="container">
        <section id="tambah_menu">
            <div class="heading">
                <h1>Pemesanan</h1>
            </div>

            <?php
            if (isset($_SESSION['pemesanan'])) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><?php echo $_SESSION['pemesanan']; ?></strong>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                        <span aria-hidden="true">Lihat detail pesanan</span>
                    </button>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php
                unset($_SESSION['pemesanan']);
            } ?>
            <?php
            if (isset($_SESSION['pemesanan_gagal'])) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><?php echo $_SESSION['pemesanan_gagal']; ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php
                unset($_SESSION['pemesanan_gagal']);
            } ?>
            <div class="row tambah rounded shadow box">
                <div class="col-sm-5 float-sm-left image_pratinjau">
                    <div class="card shadow">
                        <div class="card-header text-center"><?= $nama_menu; ?></div>

                        <div class="card-body" style="height: 350px;">
                            <img src="images/<?= $gambar; ?>" alt="" class="img-fluid"><br><br>
                            <label class="col-sm-12 col-form-label text-center">Harga : Rp. <?= $harga_menu; ?></label><br>

                        </div>
                    </div>
                </div>
                <div class="col-sm-7 float-sm-right">
                    <div class="tambah_form">
                        <form action="" method="POST">
                            <input type="hidden" name="nama_menu" value="<?= $nama_menu; ?>">
                            <input type="hidden" name="harga" value="<?= $harga_menu; ?>">
                            <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Jumlah Pesan</label>
                                <div class="col-sm-12">
                                    <input type="number" name="jumlah" class="form-control" value="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-12">
                                    <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">No Telepon</label>
                                <div class="col-sm-12">
                                    <input type="number" name="notelepon" class="form-control" placeholder="+62xxxxxxxxxxx">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-12">
                                    <input type="email" name="email" class="form-control" placeholder="fadilanzikrili@gmail.com">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Alamat</label>
                                <div class="col-sm-12">
                                    <textarea name="alamat" class="form-control" cols="10" rows="5" placeholder="Alamat"></textarea>
                                </div>
                            </div>

                            <div class="form-group row mt-2 pt-4 text-center">
                                <div class="col-sm-12">
                                    <input type="submit" name="submit" class="btn bt" value="Pesan">
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- akhir pemesanan -->


    <!-- Detail pesanan -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <pre>Nama Menu      : <?= $menu; ?></pre>
                        </li>
                        <li class="list-group-item">
                            <pre>Jumlah Pesanan : <?= $jumlah; ?></pre>
                        </li>
                        <li class="list-group-item">
                            <pre>Harga          : <?= $harga; ?></pre>
                        </li>
                        <li class="list-group-item">
                            <pre>Total          : <?= $total; ?></pre>
                        </li>
                        <li class="list-group-item">
                            <pre>Nama Pemesan   : <?= $nama_lengkap; ?></pre>
                        </li>
                        <li class="list-group-item">
                            <pre>No.Telepon     : <?= $notel; ?></pre>
                        </li>
                        <li class="list-group-item">
                            <pre>Email          : <?= $email; ?></pre>
                        </li>
                        <li class="list-group-item">
                            <pre>Alamat         : <?= $alamat; ?></pre>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success"><a href="edit.php"></a>Edit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Akhir pesanan -->

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