<?php
session_start();
include 'link.php';


if (!isset($_SESSION['level'])) {
  header('location: login.php');
  exit();
} elseif ($_SESSION['level'] == 'user') {
  header('location: index.php');
  exit();
}
include 'koneksi.php';
if (isset($_POST['simpan'])) {
  // mengambil data saat submit
  $id_menu = $_POST['id_menu'];
  $nama_menu = $_POST['nama_menu'];
  $status_menu = $_POST['status_menu'];
  $harga = $_POST['harga'];
  $gambar = $_FILES['gambar']['name'];
  $tmp_name = $_FILES['gambar']['tmp_name'];
  move_uploaded_file($tmp_name, "images/" . $gambar);

  // ambil query
  $sql_cek = "SELECT * FROM data_menu WHERE id_menu = '" . $id_menu . "'";
  $cek = mysqli_query($koneksi, $sql_cek);
  $cek_data = mysqli_num_rows($cek);
  // cek data sudah ada atau belu jika belum melakukan insert menggunakan queri
  if ($cek_data > 0) {
    $_SESSION['idcek'] = "ID makanan sudah tersedia silahkan gunakan ID yang berbeda!!!";
  } else {
    $query = "INSERT INTO data_menu VALUES ('$id_menu','$nama_menu','$status_menu','$harga','$gambar') ";
    mysqli_query($koneksi, $query);
    $_SESSION['insert'] = "Tambah makanan berhasil!!!";
  }
}
?>

<?php
if (isset($_GET['id_menu'])) {
  $id_menuget = $_GET['id_menu'];
  $hapusget = mysqli_query($koneksi, "DELETE FROM data_menu WHERE id_menu='$id_menuget'");
  if ($hapusget) {
    $_SESSION['hapus'] = "Data berhasil dihapus!!!";
  } else {
    echo "Hapus data gagal";
  }
}
?>

<?php
if (isset($_GET['id'])) {
  $id_menuget = $_GET['id'];
  $hapusget = mysqli_query($koneksi, "DELETE FROM pesan_menu WHERE id='$id_menuget'");
  if ($hapusget) {
    $_SESSION['delete'] = "Data berhasil dihapus!!!";
  } else {
    echo "Hapus data gagal";
  }
}
?>
<title><?= $_SESSION['level']; ?></title>

<body>
  <!-- Navbar -->
  <nav>
    <div class="logo">
      <h3>Waroeng<span>Geh</span><i class="far fa-laugh-wink"></i></h3>
    </div>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="#tambah_menu">Tambah Menu</a></li>
      <li><a href="#tabel">Tabel</a></li>
      <li><a href="#"><?= $_SESSION['level']; ?></a></li>
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
  <!-- form -->
  <div class="container">
    <section id="tambah_menu">
      <div class="heading">
        <h1>Tambah Menu</h1>
      </div>

      <?php
      if (isset($_SESSION['idcek'])) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong><?php echo $_SESSION['idcek']; ?></strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php
        unset($_SESSION['idcek']);
      } ?>
      <?php
      if (isset($_SESSION['insert'])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong><?php echo $_SESSION['insert']; ?></strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php
        unset($_SESSION['insert']);
      } ?>

      <div class="row tambah rounded shadow">
        <div class="col-sm-5 float-sm-left image_pratinjau">
          <div class="card shadow">
            <div class="card-header">Gambar Preview</div>
            <div class="card-body">
              <img id="box" class="img-fluid preview" />
            </div>
          </div>
        </div>
        <div class="col-sm-7 float-sm-right">
          <div class="tambah_form">
            <form action="" method="POST" enctype="multipart/form-data">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">ID menu</label>
                <div class="col-sm-12">
                  <input type="number" name="id_menu" class="form-control" placeholder="ID Menu">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Nama Menu </label>
                <div class="col-sm-12">
                  <input type="text" name="nama_menu" class="form-control" placeholder="Nama Menu">
                </div>
              </div>
              <label class="col-sm-4 col-form-label" style="margin-left: -13px;">Status Menu</label>
              <div class="form-group input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="inputGroupSelect01">Pilih</label>
                </div>
                <select class="custom-select" name="status_menu">
                  <option value="Tersedia">Tersedia</option>
                  <option value="Kosong">Kosong</option>
                </select>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Harga</label>
                <div class="col-sm-12">
                  <input type="number" name="harga" class="form-control" placeholder="Harga">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Gambar</label>
                <div class="col-sm-12">
                  <input id="input" type="file" name="gambar">
                </div>
              </div>
              <div class="form-group row mt-2 pt-4">
                <div class="col-sm-5">
                  <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- table -->
    <section id="tabel">
      <div class="heading">
        <h1>Tabel Menu</h1>
      </div>
      <?php
      if (isset($_SESSION['hapus'])) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong><?php echo $_SESSION['hapus']; ?></strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php
        unset($_SESSION['hapus']);
      } ?>
      <table class="table table-striped table-dark shadow">
        <thead>
          <tr class="text-center">
            <th scope="col">No</th>
            <th scope="col">ID Menu</th>
            <th scope="col">Nama Menu</th>
            <th scope="col">Status Menu</th>
            <th scope="col">Harga</th>
            <th scope="col">Gambar</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql_cek = "SELECT * FROM data_menu";
          $cek = mysqli_query($koneksi, $sql_cek);
          $cek_data = mysqli_num_rows($cek);
          if ($cek_data > 0) {
            $nomor = 1;
            foreach ($cek as $menu) { ?>
              <tr class="text-center">
                <td><?= $nomor; ?></td>
                <td><?= $menu['id_menu']; ?></td>
                <td><?= $menu['nama_menu']; ?></td>
                <?php if ($menu['status_menu'] == 'Tersedia') { ?>
                  <td class="text-success"><?= $menu['status_menu']; ?></td>
                <?php } else { ?>
                  <td class="text-danger"><?= $menu['status_menu']; ?></td>
                <?php  } ?>

                <td><?= $menu['harga']; ?></td>
                <td>
                  <img style="width: 100px; height:80px;" src="images/<?= $menu['gambar']; ?>" alt="">
                </td>
                <td>
                  <a href="edit.php?id=<?= $menu['id_menu']; ?>" class="btn btn-success">Edit</a>
                  <a href="tambah.php?id=<?= $menu['id_menu']; ?>" class="btn btn-danger">Hapus</a>
                </td>
              </tr>
            <?php $nomor++;
            }
          } else { ?>
            <p>data kosong</p>
          <?php } ?>

        </tbody>
      </table>
    </section>


    <!-- table -->
    <section id="tabel_pesan">
      <div class="heading">
        <h1>Tabel Pemesanan User</h1>
      </div>
      <?php
      if (isset($_SESSION['delete'])) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong><?php echo $_SESSION['delete']; ?></strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php
        unset($_SESSION['delete']);
      } ?>
      <table class="table table-striped table-dark shadow">
        <thead>
          <tr class="text-center">
            <th scope="col">No</th>
            <th scope="col">Nama Menu</th>
            <th scope="col">Total</th>
            <th scope="col">Waktu</th>
            <th scope="col">Nama Pemesan</th>
            <th scope="col">Email</th>
            <th scope="col">Alamat</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql_cek = "SELECT * FROM pesan_menu";
          $cek = mysqli_query($koneksi, $sql_cek);
          $cek_data = mysqli_num_rows($cek);
          if ($cek_data > 0) {
            $nomor = 1;
            foreach ($cek as $menu) { ?>
              <tr class="text-center">
                <td><?= $nomor; ?></td>
                <td><?= $menu['nama_menu']; ?></td>
                <td><?= $menu['total']; ?></td>
                <td><?= $menu['waktu']; ?></td>
                <td><?= $menu['nama_lengkap']; ?></td>
                <td><?= $menu['email']; ?></td>
                <td><?= $menu['alamat']; ?></td>
                <td>
                  <a href="edit.php" class="btn btn-success">Edit</a>
                  <a href="tambah.php?id=<?= $menu['id']; ?>" class="btn btn-danger">Hapus</a>
                </td>
              </tr>
            <?php $nomor++;
            }
          } else { ?>
            <p>data kosong</p>
          <?php } ?>


        </tbody>
      </table>
    </section>
  </div>
  <footer class="text-center text-white mt-lg-5 shadow">
    <p> Created with <i class="text-danger"></i> by <a href="https://z-p4.www.instagram.com/fadilanzikril23/" target="blank" class="fw-bold">Fadilahn
        Dzikril</a></p>
  </footer>



</body>
<!-- Link MYjs -->
<script src="js/scripweb2.js"></script>
<script type="text/javascript">
  inputBox = document.getElementById("input");
  inputBox.addEventListener('change', function(input) {
    var box = document.getElementById("box");
    var img = input.target.files;
    var reader = new FileReader();
    reader.onload = function(e) {
      box.setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(img[0]);
  });
</script>

</html>