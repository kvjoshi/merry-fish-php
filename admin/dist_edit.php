<?php
session_start();
include('connect.php');
require 'session_check.php';
$wx=0;
$d_id=$_GET['d_id'];
$dist_sql="SELECT * FROM `distributor` WHERE `d_id`=".$d_id;
$dist_query=mysqli_query($con,$dist_sql);
$row_d = mysqli_fetch_assoc($dist_query);
$up_status = $row_d['d_status'];
$up_tier = $row_d['d_tier'];
$f_cart=$row_d['f_cart'];
$cart_id=$row_d['dcart_id'];
$gcid_sql1="SELECT MAX(`cart_id`) FROM `cart` where `cart_uid`=".$d_id;
$gcid_q1=mysqli_query($con,$gcid_sql1);
$r1=mysqli_fetch_assoc($gcid_q1);
echo $cid1 = implode(" ",$r1);
if ($cid1 == NULL ){
    echo "NULL";
}

if(isset($_POST['stat_up'])){
    $e_id=$_POST['e_id'];
    $e_tier=$_POST['e_tier'];
    if(isset($_POST['e_status'])){
    $e_status=$_POST['e_status'];
    if($f_cart==0){
     $fc_sql="INSERT INTO `cart` (`cart_uid`) value ('$e_id')";
     $fc_q=mysqli_query($con,$fc_sql);
     $gcid_sql="SELECT MAX(`cart_id`) FROM `cart` where `cart_uid`=".$e_id;
     $gcid_q=mysqli_query($con,$gcid_sql);
     $r=mysqli_fetch_assoc($gcid_q);
     echo $cid = implode(" ",$r);
     if ($cid==NULL){
         $cid=0;
     }
     $upc_id="UPDATE `distributor` SET `f_cart`= 1 , `dcart_id`= '$cid' where `d_id`=".$e_id;
     $upc_query=mysqli_query($con,$upc_id);
    }
    }
    $e_sql="UPDATE `distributor` SET `d_status`='$e_status' , `d_tier` = '$e_tier' WHERE `d_id`=".$e_id;
    $e_query=mysqli_query($con,$e_sql);
    header("location:dist_list.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Distributor Edit Status</title>
    <!-- Bootstrap-->
    <link href="lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--Common Plugins CSS -->
    <link href="css/plugins/plugins.css" rel="stylesheet">
    <!--fonts-->
    <link href="lib/line-icons/line-icons.css" rel="stylesheet">
    <link href="lib/font-awesome/css/fontawesome-all.min.css" rel="stylesheet">
    <link href="lib/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="lib/data-tables/responsive.bootstrap4.min.css" rel="stylesheet">
    

    <link href="css/style.css" rel="stylesheet">
    
</head>
<body>

<div class="page-wrapper" id="page-wrapper">
    <?php include('nav.php');?>
    <main class="content">
        <?php include('header.php'); ?>
        <div class="page-subheader mb-30">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <div class="list">
                            <div class="list-item pl-0">
                                <div class="list-thumb ml-0 mr-3 pr-3  b-r text-muted">
                                    <i class="icon-Conference"></i>
                                </div>
                                <div class="list-body">
                                    <div class="list-title fs-2x">
                                        <h3>Distributor Account Status</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 d-flex justify-content-end h-md-down">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb no-padding bg-trans mb-30">
                                <li class="breadcrumb-item"><a href="dashboard.php"><i class="icon-Home mr-2 fs14"></i></a></li>
                                <li class="breadcrumb-item active">Distributors</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-10 col-md-12 col-sm-12">
                        <div class="portlet-box portlet-gutter  mb-10 row">
                            <div class="portlet-header flex-row flex d-flex align-items-center b-b">
                                <div class="flex d-flex flex-column">
                                    <h3>Change Account Status</h3>
                                </div>
                            </div>
                            <div class="portlet-body row">
                                <div class="col-lg-6 col-md-8 col-sm-12">
                                    <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                    <div class=" customUi-switchToggle  switchToggle-primary">
                                        <input type="hidden" name="e_id" value="<?php echo $d_id;?>">
                                        <input type="checkbox" id="switch--toggle" name="e_status" value="1" <?php if ($up_status==1){ echo "checked ";}?>>
                                        <label for="switch--toggle">
                                            <span class="label-switchToggle"> </span>
                                            <span class="label-helper"> <?php if ($up_status==1){ echo "Deactivate Account";} else{echo "Activate Account";}?> </span>
                                        </label>
                                    </div>
                                    </div>
                                    <div class="form-group">
                                            <label for="e_tier"> Distributor Tier : </label>
                                            <select name="e_tier" id="e_tier" class="form-control">

                                            <option value="0" <?php if ($up_tier==0){ echo "selected";} ?> >Select Distributor Tier</option>
                                            <option value="1" <?php if ($up_tier==1){ echo "selected";} ?> >Tier 1</option>
                                            <option value="2" <?php if ($up_tier==2){ echo "selected";} ?> >Tier 2</option>
                                            </select>
                                    </div>
                                        <div class="form-group">
                                            <a href="dist_list.php" class="btn btn-outline-danger">Cancel</a>
                                            <button type="submit" class="btn btn-outline-success" name="stat_up">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>





            </div>
        </div>
        <footer class="content-footer bg-light b-t">
            <div class="d-flex flex align-items-center pl-15 pr-15">
                <div class="d-flex flex p-3 ml-auto">
                    <div>

                    </div>
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
<!-- Required datatable js -->

<script type="text/javascript" src="lib/data-tables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="lib/data-tables/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="lib/data-tables/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="lib/data-tables/responsive.bootstrap4.min.js"></script>
<script src="js/plugins-custom/datatables-custom.js"></script>



</body>
</html>
