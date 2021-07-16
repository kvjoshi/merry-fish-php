<?php
session_start();
include('connect.php');
require 'session_check.php';
$u_id=$_SESSION['u_id'];
$user_sql="SELECT * FROM `distributor` WHERE `d_id` =".$u_id;
$user_query=mysqli_query($con,$user_sql);
$row_u = mysqli_fetch_assoc($user_query);
$up_name = $row_u['d_name'];
$up_username = $row_u['d_username'];
$up_dist_id = $row_u['dist_id'];
$up_phone = $row_u['d_phone'];
$up_email = $row_u['d_email'];
$up_address = $row_u['d_address'];
$up_gst = $row_u['d_gst'];
$up_password = $row_u['d_password'];

if (isset($_POST['e_profile'])){
    $new_email=$_POST['new_email'];
    $new_phone=$_POST['new_phone'];

    $update_profile_sql="UPDATE `distributor` SET `d_phone` = '$new_phone' , `d_email` = '$new_email' WHERE `d_id` = ".$u_id;
    $update_profile_query=mysqli_query($con,$update_profile_sql);
    header("location:profile.php");
}
if(isset($_POST['e_pass'])){
    $new_pass=$_POST['n_pass'];
    $conf_pass=$_POST['c_pass'];
    $check_pass=$_POST['current_pass'];
    if ($up_password===$check_pass && $new_pass === $conf_pass)
    {
        $update_pass_sql="UPDATE `distributor` SET `d_password` = '$new_pass' WHERE `d_id` = ".$u_id;
        $update_pass_query=mysqli_query($con,$update_pass_sql);
        echo '<script>alert("Password Changed!");</script>';

    }
    else
    {
        if($up_password!==$check_pass){
        echo '<script>alert("Check Current Password")</script>';
        }
        if($new_pass!==$conf_pass){
            echo '<script>alert("Password and Confirm Password Not Same")</script>';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Profile</title>
    <!-- Bootstrap-->
    <link href="lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--Common Plugins CSS -->
    <link href="css/plugins/plugins.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <!--fonts-->
    <link href="lib/line-icons/line-icons.css" rel="stylesheet">
    <link href="lib/font-awesome/css/fontawesome-all.min.css" rel="stylesheet">
    <link href="lib/select2/dist/css/select2.min.css" rel="stylesheet">
    <link href="css/select2-custom.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
    <link rel="icon" href="./favicon.ico" type="image/x-icon">
</head>
<body>

<div class="page-wrapper" id="page-wrapper">
    <?php include ('nav.php');?>
    <main class="content">
        <?php include('header.php'); ?>
        <div class="page-content d-flex flex pl-0 pr-0">
            <div class="flex d-flex b-l">
                <div class="d-flex flex flex-column">
                    <div class="flex p-3 pt-0 pb-0">
                        <div class="row fullscreen">
                            <div class="col-xl-3 col-lg-4 b-r col-md-5 bg-white d-flex flex-column p-4">
                                <div class="text-center">
                                    <div class="progress-thumb">
                                        <i class="on states"></i>
                                        <span class="donut1" data-peity='{}'>100</span>
                                        <img src="images/avatar1.jpg" alt="" class="img-fluid rounded-circle">
                                    </div>
                                    <div class="p-3">
                                        <h5 class="fs-1x mb-0 font400"><?php echo $up_name;?></h5>
                                        <p class="text-muted">
                                            Distributor<br><i class="fa fa-map-marker text-muted mr-2 fs12"></i> <?php echo $up_address;?>
                                        </p>
                                        <div class="pb-3">
                                            <a class="btn btn-block mb-2 btn-icon btn-info" href="tel:">
                                                <i class="fa fa-phone"></i> Contact Support
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-9 col-lg-8 col-md-7 d-flex no-padding flex-column">


                                <div class="profile-content p-4">
                                    <div class="profile-cover">
                                    </div>
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-pills profile-tabs pb-3" role="tablist">
                                        <li role="presentation" class="nav-item"><a class="nav-link active"  href="#tb1" aria-controls="tb1" role="tab" data-toggle="tab"><i class="fa fa-user-circle fs10 mr-1"></i> Profile</a></li>
                                        <li role="presentation" class="nav-item"><a class="nav-link" href="#tb2" aria-controls="tb2" role="tab" data-toggle="tab"><i class="fa fa-cog fs10 mr-1"></i> Settings</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">

                                        <div role="tabpanel" class="tab-pane active show" id="tb1">
                                            <div class="bg-white  p-3 border1 rounded">
                                                <div class="row mb-2">
                                                    <div class="col-6">
                                                        <small class="text-muted">Distributor ID</small>
                                                        <div class="font500"><?php echo $up_dist_id;?>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <small class="text-muted">Firm Name</small>
                                                        <div class="font500"><?php echo $up_name;?></div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-6">
                                                        <small class="text-muted">Username</small>
                                                        <div class="font500"><?php echo $up_username;?>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <small class="text-muted">Email</small>
                                                        <div class="font500">
                                                            <?php echo $up_email;?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-6">
                                                        <small class="text-muted">Phone</small>
                                                        <div class="font500"><?php echo $up_phone;?>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <small class="text-muted">GST No.</small>
                                                        <div class="font500"><?php echo $up_gst;?>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-8">
                                                        <small class="text-muted">Address</small>
                                                        <div class="font500"><?php echo $up_address;?>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="tb2">
                                            <div class="bg-white  p-3 border1 rounded">
                                                <div role="form">
                                                    <div class="title-sep sep-white text-left text-primary mb-10">
                                                        <span class="rounded">Profile Settings</span>
                                                    </div>
                                                    <form method="post" enctype="multipart/form-data">

                                                        <div class="row">

                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="new_email">Email Address</label>
                                                                    <input type="email" class="form-control" name="new_email" id="new_email" value="<?php echo $up_email; ?>" placeholder="Email" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="new_phone">Phone</label>
                                                                    <input type="text" class="form-control" name="new_phone" id="new_phone" value="<?php echo $up_phone; ?>" placeholder="Phone" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <a href="dashboard.php" class="btn btn-outline-danger btn-lg" >Discard Changes</a>
                                                                    <button type="submit" class="btn btn-outline-primary btn-lg" name="e_profile">Save Changes</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>

                                                    <div class="title-sep sep-white text-left text-primary  mt-30 mb-10">
                                                        <span class="rounded">Account Settings</span>
                                                    </div>
                                                    <form method="post" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="current_pass">Old Password</label>
                                                                    <input type="password" class="form-control" name="current_pass" id="current_pass" placeholder="*****" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="n_pass">New Password</label>
                                                                    <input type="password" class="form-control" name="n_pass" id="n_pass" placeholder="New Password" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="c_pass">Confirm Password</label>
                                                                    <input type="text" class="form-control" name="c_pass" id="c_pass" placeholder="Confirm Password" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <a href="dashboard.php" class="btn btn-outline-danger btn-lg" >Discard</a>
                                                                    <button type="submit" class="btn btn-light-primary btn-lg" name="e_pass">Update Password</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div><!-- content-->

                </div>
            </div>
        </div>
        <footer class="content-footer bg-light b-t">
            <div class="d-flex flex align-items-center pl-15 pr-15">
                <div class="d-flex flex p-3 ml-auto">

                </div>
                <div class="d-flex flex p-3 mr-auto justify-content-end">
                    <div class="text-muted">© Copyright 2021  Merry Fish™</div>
                </div>
            </div>
        </footer>
    </main><!-- page content end-->
</div><!-- app's main wrapper end -->
<!-- Common plugins -->
<script type="text/javascript" src="js/plugins/plugins.js"></script>
<script type="text/javascript" src="js/appUi-custom.js"></script>
<script type="text/javascript" src="lib/peity/jquery.peity.min.js"></script>
<script src="lib/select2/dist/js/select2.min.js"></script>
<script>
    $(function () {
        $(document).ready(
            function () {
                $("#skills").select2();
            }
        );
        /**peity**/
        $(".donut1").peity("donut", {
            fill: ["#0084ff", "#fff"],
            width: 120,
            height: 120
        });
    });
</script>
</body>
</html>
