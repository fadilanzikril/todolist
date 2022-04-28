<?php
session_start();
include 'koneksi.php';
?>
<?php
if (isset($_POST['login'])) {
    $user = $_POST['user'];
    $pass = md5($_POST['pass']);
    $data_user = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$user' AND password = '$pass'");
    $baca_array = mysqli_fetch_array($data_user);
    $level = $baca_array['level'];
    if ($user == $baca_array['username'] && $pass == $baca_array['password']) {
        $_SESSION['level'] = $level;
        if ($level == 'user') {
            header('location:index.php');
        } elseif ($level == 'admin') {
            header('location:tambah.php');
        }
    } else {
        $_SESSION['login_eror'] = "Username dan Password Salah !!!";
        header('location: login.php?error=' . 'Username dan Password Salah!!!');
        exit();
    }
}
?>
<?php include 'link.php'; ?>
<title>Login</title>

<body class="bgron_login">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4  text-white text-uppercase mb-4">Waroeng Geh</h1>
                                    </div>

                                    <?php
                                    if (isset($_SESSION['login_eror'])) { ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong><?php echo $_SESSION['login_eror']; ?></strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php
                                        unset($_SESSION['login_eror']);
                                    } ?>

                                    <form method="POST" action="">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user shadow-lg" name="user" placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user shadow-lg" name="pass" placeholder="Password">
                                        </div>
                                        <button type="submit" name="login" class="btn btn-primary btn-user btn-block shadow-lg">
                                            <i class="fas fa-sign-in-alt"></i> Login
                                        </button>
                                    </form>
                                    <hr>
                                    <p class="font-weight-bold bg-light" style="color:black; padding:10px;"> Login Pelanggan<br>
                                        <i>
                                            Username : user <br>
                                            Password : 123 <br>
                                        </i><br>
                                        Login Admin<br>
                                        <i>
                                            Username : admin <br>
                                            Password : 123 <br>
                                        </i>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>