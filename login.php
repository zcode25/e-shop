<?php

session_start();
if (isset($_SESSION["login"])) {
    header("Location: dashboard.php");
    exit;
}

require 'functions.php';

if (isset($_POST["login"])) {

    $email_bisnis = $_POST["email_bisnis"];
    $email = $_POST["email"];
    $password = sha1($_POST["password"]);

    $result = mysqli_query($conn, "SELECT * FROM karyawan JOIN bisnis USING (kode_bisnis) WHERE email_bisnis= '$email_bisnis' AND email_karyawan= '$email'");

    //cek email
    if (mysqli_num_rows($result) === 1) {
        //cek password
        $row = mysqli_fetch_assoc($result);

        if ($password == $row["password"]) {
            //set session
            $_SESSION["id"] = $row["id_karyawan"];
            $_SESSION["nama"] = $row["nama_karyawan"];
            $_SESSION["bisnis"] = $row["kode_bisnis"];
            $_SESSION["nama_bisnis"] = $row["nama_bisnis"];
            $_SESSION["login"] = true;

            header("Location: dashboard.php");
            exit;
        }
    }

    $error = true;
}


?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <style>
        .judul {
            font-family: Arial, Helvetica, sans-serif !important;
            font-weight: ligh !important;
        }

        .login-box {
            height: 450px !important;
        }
    </style>
    <!-- Font-icon css-->
    <link rel="shortcut icon" href="img/eshop.png">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Electronic Shop</title>
</head>

<body>
    <section class="material-half-bg">
        <div class="cover"></div>
    </section>
    <section class="login-content">
        <div class="logo">
            <h1 class="judul">e-shop</h1>
        </div>
        <div class="login-box">
            <form class="login-form" action="" method="post">
                <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>Login</h3>
                <?php if (isset($error)) : ?>
                    <div class="alert alert-dismissible alert-danger">
                        <button class="close" type="button" data-dismiss="alert">×</button><strong>Email atau password salah</strong>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label class="control-label" for="email_bisnis">Email Bisnis</label>
                    <input class="form-control" type="email_bisnis" id="email_bisnis" name="email_bisnis" autofocus required>
                </div>
                <div class="form-group">
                    <label class="control-label" for="email">Email</label>
                    <input class="form-control" type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label class="control-label" for="password">Password</label>
                    <input class="form-control" type="password" id="password" name="password" required>
                </div>
                <div class="form-group btn-container">
                    <button class="btn btn-primary btn-block" type="submit" name="login"><i class="fa fa-sign-in fa-lg fa-fw"></i>Login</button>
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