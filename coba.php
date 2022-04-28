<?php include 'link.php';
include 'koneksi.php';
if (isset($_POST['simpan'])) {
    $status = $_POST['status'];
    echo $status;
    $sql = "INSERT INTO status VALUES('$status')";
    $res2 = mysqli_query($koneksi, $sql);
}
?>

<form action="" method="POST">

</form>