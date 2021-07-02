<?php
session_start();
include('connect.php');
require 'session_check.php';
$wx=0;
$cart_sql="SELECT * FROM `cart` WHERE `cart_status` = 2 OR `cart_status` = 3";
$cart_query=mysqli_query($con,$cart_sql);
$cart_count = mysqli_num_rows($cart_query);
$ords_sql="SELECT * FROM `cart`,`distributor` where `distributor`.`d_id`=`cart`.`cart_uid` AND `cart_status` = 2 OR `cart_status` = 3 ORDER BY `cart_id` DESC ";
$ords_query=mysqli_query($con,$ords_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Past Orders</title>
    <!-- Bootstrap-->
    <link href="lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--Common Plugins CSS -->
    <link href="css/plugins/plugins.css" rel="stylesheet">
    <!--fonts-->
    <link href="lib/line-icons/line-icons.css" rel="stylesheet">
    <link href="lib/font-awesome/css/fontawesome-all.min.css" rel="stylesheet">
    <link href="lib/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="lib/data-tables/responsive.bootstrap4.min.css" rel="stylesheet">
    <link href="lib/summernote/summernote-bs4.css" rel="stylesheet">
    <link href="lib/sweet-alerts2/sweetalert2.min.css" rel="stylesheet">
    <link href="css/sweet-alert-custom.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">
    <script type="text/javascript">
        var $serror = <?php if(isset($_GET['e'])){ echo "1";} else { echo "0";} ?>;
        var $suploaded = <?php if(isset($_GET['s'])){ echo "1";}  else { echo "0";}?>;
    </script>
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
                                    <i class="icon-Full-Cart"></i>
                                </div>
                                <div class="list-body">
                                    <div class="list-title fs-2x">
                                        <h3>Past Orders</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 d-flex justify-content-end h-md-down">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb no-padding bg-trans mb-30">
                                <li class="breadcrumb-item"><a href="dashboard.php"><i class="icon-Home mr-2 fs14"></i></a></li>
                                <li class="breadcrumb-item active">Past Orders</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="portlet-box portlet-gutter  mb-10 row">
                            <div class="portlet-header flex-row flex d-flex align-items-center b-b">
                                <div class="flex d-flex flex-column">
                                    <h3>Total Past Orders</h3>
                                </div>
                            </div>
                            <div class="portlet-body row">
                                <div class="col-lg-10 col-md-10 col-sm-10">
                                    <div class="list-alt bg-warning-light rounded ">
                                        <div class="list-item">
                                            <div class="list-thumb">
                                                <i class="icon-Full-Cart fs-2x"></i>
                                            </div>
                                            <div class="list-body">
                                            <span class="list-title">
                                                <?php echo $cart_count;?>
                                            </span>
                                                <span class="list-content">
                                                Past Orders
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>


                </div>




                <div class="row bg-white table-responsive rounded shadow-sm pt-3 pb-3 mb-30 ">
                    <h6 class="pl-3 pr-3 text-capitalize font400 mb-20">Past Orders Summary</h6>
                    <table id="data-table" class="table mb-0 table-striped">
                        <thead>
                        <tr>

                            <th>Sr. No.</th>
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Dist Name</th>
                            <th>Tier</th>
                            <th>Tracking ID</th>
                            <th>Status</th>
                            <th>View Order</th>
                            <th>Invoice Amount</th>
                            <th>Invoice</th>
                            <th>Edit</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php while ($row=mysqli_fetch_assoc($ords_query)){
                            $wx++;
                            ?>
                            <tr>
                                <td><?php echo $wx; ?></td>
                                <td><?php echo $row['cart_order'];?></td>
                                <td><?php echo $row['cart_end_date'];?></td>
                                <td><?php echo $row['d_name'];?></td>
                                <td><?php echo $row['cart_size'];?></td>
                                <td><?php if ($row['cart_status']==2){ echo "Not Shipped";} elseif ($row['cart_status']==3){ echo $row['o_tracking_id']; }?>

                                <td><?php if ($row['cart_status']==2){ echo "Confirmed";} elseif($row['cart_status']==3) { echo "Shipped"; } ?></td>
                                <td><a style="text-decoration: none" href="view_order.php?cid=<?php echo $row['cart_id'];?>">Click Here</a></td>

                                <td><?php echo $row['o_price'];?></td>
                                <td>
                                    <a class=" btn-icon-o radius100 btn-icon-md btn btn-success mr-2 mb-2 " href="../distributor/<?php echo $row['invoice_file'];?>" download>
                                        <i class="fa fa-download"></i>
                                    </a>
                                </td>
                                <td>
                                    <?php if ($row['cart_status']==2){
                                        ?>
                                        <form>
                                            <input name="cid" value="<?php echo $row['cart_id'];?>" type="hidden">
                                        <button class="btn btn-icon btn-rounded btn-success ml-1" type="submit" name="del_sub">
                                            <i class="fa fa-edit"></i>
                                            Edit
                                        </button>
                                        </form>
                                        <?php }
                                        elseif($row['cart_status']==3)
                                        { echo "Shipped"; }
                                        ?>

                                </td>
                            </tr>

                        <?php } ?>
                        </tbody>
                    </table>
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

<!-- Sweetalerts2 js -->
<script type="text/javascript" src="lib/sweet-alerts2/sweetalert2.min.js"></script>
<script src="js/plugins-custom/sweetalert2-custom.js"></script>

</body>
</html>
