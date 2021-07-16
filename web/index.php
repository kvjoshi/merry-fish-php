<?php
        ob_start();
        session_start();
        require 'connect.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Merry Fish Distributor Sign In</title>
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
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
    <link rel="icon" href="./favicon.ico" type="image/x-icon">

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
                                {       $sql="select * from `distributor` where d_username='".$_POST['uname']."' and d_password='".$_POST['password']."'";
                                     $query = mysqli_query($con,$sql);
                                    $row = mysqli_num_rows($query);

                                    if($row>0)
                                    {
                                        $data = mysqli_fetch_array($query);
                                        if($data['d_status']==1){
                                        $_SESSION['u_email'] = $data['d_email'];
                                        $_SESSION['u_id'] = $data['d_id'];
                                        $_SESSION['u_name']= $data['d_name'];
                                        $_SESSION['u_tier'] = $data['d_tier'];
                                        $_SESSION['cart']=$data['dcart_id'];
                                        //$_SESSION['role'] = $data['role'];
                                        header("location:dashboard.php");
                                        }
                                        else{
                                            ?>
                                            <div class="alert alert-danger" role="alert">
                                                User Account Not Activated.
                                            </div>
                                            <?php
                                        }
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
                                                    <label class="flex d-flex mr-auto" for='uname'>Username</label>

                                                </div>
                                                <div class='input-icon-append'>
                                                    <i class="fa fa-user"></i>
                                                    <input placeholder="User Name" type="text" class="form-control" id="uname" name="uname" required>
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
                                        <div class="pt-20 text-center">
                                            Don't have an account? <a href='sign_up.php' class='text-primary ml-2 b-b d-inline-block pb-1'>Sign Up Here</a>
                                        </div>
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
