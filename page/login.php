<?php
require 'backend/function.php';
require 'layout/head.php';

session_start();
if (isset($_SESSION["login"])) {
    header("Location:index.php");
    exit;
}
if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];
    $result = mysqli_query($conn,  "SELECT * FROM users WHERE username = '$username'");


    // Cek Username
    if (mysqli_num_rows($result) === 1) {

        // Cek Password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {


            //cek session'
            print_r($row);
            $_SESSION["login"] = true;
            $_SESSION['username'] = $row['username'];
            $_SESSION['nama_user'] = $row['nama_user'];
            $_SESSION['role'] = $row['role'];
            header("Location: index.php");
        }
    }

    $error = true;
}

?>

<body>
    <section class="material-half-bg">
        <div class="cover"></div>
    </section>
    <section class="login-content">
        <div class="logo">
            <h1>Forecasting Perencanaan Produksi</h1>
        </div>
        <div class="login-box">
            <form class="login-form" action="" method="post">
                <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
                <?php if (isset($error)) : ?>
                    <p style="color: red; font-style: italic;">username/password salah</p>
                <?php endif; ?>
                <div class="form-group">
                    <label class="control-label">USERNAME</label>
                    <input class="form-control" type="text" name="username" id="username" placeholder="Username" autofocus>
                </div>
                <div class="form-group">
                    <label class="control-label">PASSWORD</label>
                    <input class="form-control" type="password" name="password" id="password placeholder =" Password" autofocus>
                </div>
                <div class="form-group btn-container">
                    <button class="btn btn-primary btn-block" type="submit" name="login"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
                </div>
            </form>
        </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <script type="text/javascript">
        // Login Page Flipbox control
        $('.login-content [data-toggle="flip"]').click(function() {
            $('.login-box').toggleClass('flipped');
            return false;
        });
    </script>
</body>

</html>
