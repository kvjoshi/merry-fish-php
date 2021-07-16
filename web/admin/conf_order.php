<?php
session_start();
include('connect.php');
require 'session_check.php';
$wx=0;
if(isset($_POST['cid'])){
$cart_id=$_POST['cid'];
$o_sql="SELECT * FROM `orders` WHERE `cart_id` = ".$cart_id;
$o_query=mysqli_query($con,$o_sql);
$cart_sql="SELECT * FROM `cart` WHERE `cart_id` =".$cart_id;
$cart_query=mysqli_query($con,$cart_sql);
$cart_assoc=mysqli_fetch_assoc($cart_query);
$cart_size=$cart_assoc['cart_size'];
$cart_total=$cart_assoc['o_price'];
}
else{
    header( "location:pend_ord.php" );
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
 
    <title>Confirm | View Order</title>
    <!-- Bootstrap-->
    <link href="lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--Common Plugins CSS -->
    <link href="css/plugins/plugins.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
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
                                    <i class="icon-Receipt"></i>
                                </div>
                                <div class="list-body">
                                    <div class="list-title fs-2x">
                                        <h3>Confirm | View Order</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 d-flex justify-content-end h-md-down">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb no-padding bg-trans mb-30">
                                <li class="breadcrumb-item"><a href="dashboard.php"><i class="icon-Home mr-2 fs14"></i></a></li>
                                <li class="breadcrumb-item active">Confirm | View Order</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content">
            <div class="container-fluid">
                <div class="">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="portlet-box portlet-gutter  mb-10 ">
                            <div class="portlet-header flex-row flex d-flex align-items-center b-b">
                                <div class="flex d-flex flex-column">
                                    <h3>Confirm Order</h3>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <form method="post" enctype="multipart/form-data" action="conf-script.php">
                                    <div class="form-row">
                                        <div class="form-group col-lg-2 col-md-4 col-sm-6">
                                            <span> Cart Size : </span>
                                            <h3><?php echo $cart_size; ?></h3>
                                        </div>
                                        <div class="form-group col-lg-2 col-md-4 col-sm-6">
                                            <span> Cart Total : </span>
                                            <h3><?php echo $cart_total; ?></h3>
                                        </div>

                                        <div class="form-group col-lg-2 col-md-4 col-sm-6">
                                            <input type="hidden" name="cart_id" value="<?php echo $cart_id;?>">
                                            <label for="cart_order"> Order Id : </label>
                                            <input type="text" name="cart_order" id="cart_order" class="form-control" placeholder="Order ID">
                                        </div>
                                        <div class="form-group col-lg-2 col-md-4 col-sm-6">
                                            <label for="o_price"> Invoice Amount : </label>
                                            <input type="text" name="o_price" id="o_price" class="form-control" placeholder="Invoice Price">
                                        </div>
                                        <!-- UNCOMMENT TO ENABLE UPLOAD
                                        <div class="form-group col-lg-2 col-md-4 col-sm-6">
                                            <label> Order File : </label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="invoice" name="invoice">
                                                <label class="custom-file-label" for="invoice">Choose file</label>
                                            </div>

                                        </div>
                                        -->
                                        </div>
                                        <div class="form-row ">
                                            <div class="form-group col-lg-3 col-md-4 col-sm-6">
                                                <a href="pend_ord.php" class="btn btn-outline-danger">Cancel</a>
                                                <button type="submit" class="btn btn-outline-success" name="confirm_s">Confirm</button>
                                            </div>
                                        </div>
                                    </form>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white table-responsive rounded shadow-sm pt-3 pb-3 mb-30">
                    <h6 class="pl-3 pr-3 text-capitalize  mb-20">Order List</h6>
                    <table id="data-table" class="table mb-0 table-striped" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Product Code</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while ($row=mysqli_fetch_assoc($o_query)){
                            $wx++;
                            ?>
                            <tr>
                                <td><?php echo $wx; ?></td>
                                <td><?php echo $row['o_product_code'];?></td>
                                <td><?php echo $row['o_price'] ; ?></td>
                                <td><?php echo $row['o_quantity']; ?></td>
                                <td><?php echo $row['o_price_total']; ?></td>
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



</body>
</html>
