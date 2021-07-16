<?php
        ob_start();
        session_start();
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
<link rel="manifest" href="manifest.json">

<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="application-name" content="Merry Fish">
<meta name="apple-mobile-web-app-title" content="Merry Fish">
<meta name="theme-color" content="#000000">
<meta name="msapplication-navbutton-color" content="#000000">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="msapplication-starturl" content="/">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="icon" sizes="316x374" href="./images/logo.png">
<link rel="apple-touch-icon" sizes="316x374" href="./images/logo.png">
 
    <title>Merry Fish Login</title>
    <!-- Bootstrap-->
    <!-- Bootstrap-->
    <link href="lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--Common Plugins CSS -->
    <link href="css/plugins/plugins.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-P4L8S9EXV2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-P4L8S9EXV2');
</script>
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
                                        $_SESSION['u_role'] = $data['u_role'];
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
