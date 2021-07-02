<?php
        ob_start();
        session_start();
ini_set('session.save_handler', 'memcached');
ini_set('session.save_path', getenv('MEMCACHIER_SERVERS'));
if(version_compare(phpversion('memcached'), '3', '>=')) {
    ini_set('memcached.sess_persistent', 1);
    ini_set('memcached.sess_binary_protocol', 1);
} else {
    ini_set('session.save_path', 'PERSISTENT=myapp_session ' . ini_get('session.save_path'));
    ini_set('memcached.sess_binary', 1);
}
ini_set('memcached.sess_sasl_username', getenv('MEMCACHIER_USERNAME'));
ini_set('memcached.sess_sasl_password', getenv('MEMCACHIER_PASSWORD'));
        require 'connect.php';
if(isset($_SESSION['u_id']))
{
    header('location:dashboard.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Merry Fish Login</title>
    <!-- Bootstrap-->
    <!-- Bootstrap-->
    <link href="lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--Common Plugins CSS -->
    <link href="css/plugins/plugins.css" rel="stylesheet">
    <!--fonts-->
    <link href="lib/line-icons/line-icons.css" rel="stylesheet">
    <link href="lib/font-awesome/css/fontawesome-all.min.css" rel="stylesheet">
    <link href="lib/dt-picker/jquery.datetimepicker.min.css" rel="stylesheet">
    <link href="lib/select2/dist/css/select2.min.css" rel="stylesheet">
    <link href="lib/chartist/chartist.min.css" rel="stylesheet" />
    <link href="lib/chartist/chartist.min.css" rel="stylesheet" />
    <link href="css/chartist-custom.css" rel="stylesheet" />
    <link href="css/picker-custom.css" rel="stylesheet" />
    <link href="css/select2-custom.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>


    <body class='bg-white'>


        <div class="page-wrapper" id="page-wrapper">

            <main class="content">

                <div class="container-fluid flex d-flex">
                    <div class='row flex align-items-center'>
                        <div class='col-lg-3 col-md-5 col-sm-6 ml-auto flex d-flex mr-auto full-height pt-40 pb-20'>
                            <div class="w100 d-block">
                                <div class="align-content-center">
                                    <img class="img-fluid" src="images/logo.png" >
                                </div>
                                <div class="title-sep text-center sep-white mt-20 mb-30">
                                    <span class='font600 fs16 text-dark'>Sign In</span>

                                </div>
                                <?php
                                 if(isset($_POST['submit']))
                                {
                                    $query = mysqli_query($con,"select * from user where u_email='".$_POST['email']."' and u_password='".$_POST['password']."'");
                                    $row = mysqli_num_rows($query);

                                    if($row>0)
                                    {
                                        $data = mysqli_fetch_array($query);
                                        $_SESSION['u_email'] = $data['u_email'];
                                        $_SESSION['u_id'] = $data['u_id'];
                                        $_SESSION['u_name']= $data['u_name'];
                                        //$_SESSION['role'] = $data['role'];
                                        header("location:dashboard.php");
                                    }
                                    else
                                    {
                                ?>
                                    <div class="alert alert-danger" role="alert">
                                        Invalid Username/Password
                                    </div>
                                    <?php
                                    }
                                 }
                                ?>

                                    <div>

                                        <form role="form" method="POST">
                                            <div class="input-icon-group">
                                                <div class="d-flex flex flex-row">
                                                    <label class="flex d-flex mr-auto" for='pass'>Username</label>

                                                </div>
                                                <div class='input-icon-append'>
                                                    <i class="fa fa-user"></i>
                                                    <input placeholder="email address" type="text" class="form-control" name="email" required>
                                                </div>
                                            </div>
                                            <div class="input-icon-group">
                                                <div class="d-flex flex flex-row">
                                                    <label class="flex d-flex mr-auto" for='pass'>password</label>
                                                </div>
                                                <div class='input-icon-append'>
                                                    <i class="fa fa-lock"></i>
                                                    <input id="pass" placeholder="Password" type="password" class="form-control" name="password" required>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-gradient-primary btn-block btn-lg" name="submit">Sign In</button>

                                        </form>

                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- main end-->

            </main>
            <!-- page content end-->
        </div>
        <!-- app's main wrapper end -->
        <!-- Common plugins -->
        <script type="text/javascript" src="js/plugins/plugins.js"></script>
        <script type="text/javascript" src="js/appUi-custom.js"></script>

    </body>

</html>
