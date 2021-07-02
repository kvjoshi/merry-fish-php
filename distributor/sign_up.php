<?php
session_start();
require 'connect.php';

if (isset($_POST['sign_up'])){
    $pass=$_POST['pass'];
    $c_pass=$_POST['c_pass'];
    $d_name=$_POST['d_name'];
    $dist_id=$_POST['dist_id'];
    $d_address=$_POST['d_address'];
    $d_phone=$_POST['d_phone'];
    $d_email=$_POST['d_email'];
    $d_gst=$_POST['d_gst'];
    $d_username=$_POST['d_username'];


   /*
    $mail_sql="SELECT * FROM `distributor` WHERE `d_email`= '$d_email' ";
    $mail_query=mysqli_query($con,$mail_sql);
    if(!isset($mail_query)){
        echo "email exists";
    }
   */
    if($pass===$c_pass){
        $signup_sql="INSERT INTO `distributor`(`d_name`, `dist_id`, `d_address`, `d_username`, `d_password`, `d_phone`,`d_gst`, `d_email`) VALUES ('$d_name','$dist_id','$d_address','$d_username','$pass','$d_phone','$d_gst','$d_email')";
        $signup_query=mysqli_query($con,$signup_sql);

        header("location:index.php");

    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Merry Fish Distributor Sign Up</title>
    <!-- Bootstrap-->
    <link href="lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--Common Plugins CSS -->
    <link href="css/plugins/plugins.css" rel="stylesheet">
    <!--fonts-->
    <link href="lib/line-icons/line-icons.css" rel="stylesheet">
    <link href="lib/font-awesome/css/fontawesome-all.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
    <link rel="icon" href="./favicon.ico" type="image/x-icon">
</head>
<body class='bg-white'>

<div class="page-wrapper" id="page-wrapper">

    <main class="content">

        <div class="container-fluid flex d-flex">
            <div class='row flex align-items-center'>

                <div class='col-lg-5 col-md-6 col-sm-10 d-flex flex ml-auto mr-auto full-height pt-40 pb-20'>
                    <div class="w100">
                        <div class="align-content-center">
                            <img class="img-fluid" src="images/logo.png" >
                        </div>
                        <div class="title-sep text-center sep-white mt-20 mb-30">
                            <span class='font600 fs16 text-dark'>Create your account here </span>
                        </div>
                        <div>
                            <form role="form" method="POST">

                                <div class="input-icon-group">
                                    <div class='input-icon-append'>
                                        <i class="fa fa-user"></i>
                                        <input id="d_name" name="d_name" placeholder="Firm Name" type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="input-icon-group">
                                    <div class='input-icon-append'>
                                        <i class="fa fa-book"></i>
                                        <input id="dist_id" placeholder="Distributor ID" name="dist_id" type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="input-icon-group">
                                    <div class='input-icon-append'>
                                        <i class="fa fa-address-card"></i>
                                        <input id="d_address" name="d_address" placeholder="Address" type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="input-icon-group">
                                    <div class='input-icon-append'>
                                        <i class="fa fa-rupee-sign"></i>
                                        <input id="d_gst" name="d_gst" placeholder="GST No." type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="input-icon-group">
                                    <div class='input-icon-append'>
                                        <i class="fa fa-phone"></i>
                                        <input id="d_phone" name="d_phone" placeholder="Phone" type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="input-icon-group">
                                    <div class='input-icon-append'>
                                        <i class="fa fa-user"></i>
                                        <input id="d_username" name="d_username" placeholder="Username" type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="input-icon-group">
                                    <div class='input-icon-append'>
                                        <i class="fa fa-envelope"></i>
                                        <input id="email" name="d_email" placeholder="Email" type="email" class="form-control" required>
                                    </div>
                                </div>

                                <div class="input-icon-group">
                                    <div class='input-icon-append'>
                                        <i class="fa fa-lock"></i>
                                        <input id="pass" name="pass" placeholder="Password" type="password" class="form-control" required>
                                    </div>
                                </div>
                                <div class="input-icon-group">
                                    <div class='input-icon-append'>
                                        <i class="fa fa-lock"></i>
                                        <input id="c_pass" name="c_pass" placeholder="Confirm Password" type="password" class="form-control" required>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-gradient-primary btn-block btn-lg" name="sign_up">Create account</button>

                                <div class="pt-20 text-center">
                                    Already have an account? <a href='index.php' class='text-primary ml-2 b-b d-inline-block pb-1'>Sign In Here</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- main end-->

    </main><!-- page content end-->
</div><!-- app's main wrapper end -->
<!-- Common plugins -->
<script type="text/javascript" src="js/plugins/plugins.js"></script>
<script type="text/javascript" src="js/appUi-custom.js"></script>
</body>
</html>
