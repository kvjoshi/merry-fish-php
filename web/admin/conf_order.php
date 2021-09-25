<?php
session_start();
include('connect.php');
require 'session_check.php';
$wx=0;
if(isset($_GET['cid'])){
$cart_id=$_GET['cid'];
$o_sql="SELECT * FROM `orders` WHERE `cart_id` = ".$cart_id;
$o_query=mysqli_query($con,$o_sql);
$o_query0=mysqli_query($con,$o_sql);
$o_assoc=mysqli_fetch_assoc($o_query0);
$user_teir=$o_assoc['o_user_teir'];
$user_id=$o_assoc['o_uid'][0];
$cart_sql="SELECT * FROM `cart` WHERE `cart_id` =".$cart_id;
$cart_query=mysqli_query($con,$cart_sql);
$cart_assoc=mysqli_fetch_assoc($cart_query);
$cart_size=$cart_assoc['cart_size'];
$cart_total=$cart_assoc['o_price'];


if(isset($_POST['add_p'])){
    $o_product_code=$_POST['o_product_code'];
    $o_product_name=$_POST['o_product_name'];
    $o_price=$_POST['o_price'];
    $o_quantity=$_POST['o_quantity'];
    $o_price_total=$_POST['o_quantity']*$_POST['o_price'];
    $o_status=1;
    $o_product_id=0;
    $cart_new=$cart_total+$o_price_total;
    $size_new=$cart_size+1;

    $add_p_sql="INSERT INTO `orders`(`o_uid`, `cart_id`, `o_status`, `o_product_id`, `o_product_code`, `o_product_name`, `o_quantity`, `o_price`, `o_price_total`, `o_user_teir`) VALUES ('$user_id','$cart_id','$o_status','$o_product_id','$o_product_code','$o_product_name','$o_quantity','$o_price','$o_price_total','$user_teir')";
    $add_p_query=mysqli_query($con,$add_p_sql);
    $new_cart_sql="UPDATE `cart` SET `cart_size`='$size_new',`o_price`='$cart_new' WHERE `cart_id`='$cart_id'";
    $new_cart_query=mysqli_query($con,$new_cart_sql);


    header( "location:conf_order.php?cid=".$cart_id );
}

if(isset($_POST['del_sub'])){
    $del_o_id=$_POST['order_id'];
    $del_cart_id=$_POST['cart_id'];
    $o_price_total=$_POST['o_price_total'];
    $cart_new=$cart_total-$o_price_total;
    $size_new=$cart_size-1;

    $del_sql="DELETE FROM `orders` WHERE `o_id` = '$del_o_id'";
    $del_query=mysqli_query($con,$del_sql);
    $del_cart_sql="UPDATE `cart` SET `cart_size`='$size_new',`o_price`='$cart_new' WHERE `cart_id`='$cart_id'";
    $del_cart_query=mysqli_query($con,$del_cart_sql);
    header( "location:conf_order.php?cid=".$cart_id );

}
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
                                        <div class="form-group col-lg-4 col-md-4  col-sm-6 p-3">
                                            <button type="button" class="btn btn-icon btn-lg btn-light-primary mb-30" data-toggle="modal" data-target="#product_add">
                                                <i class="icon-Add"></i>
                                                Add Product
                                            </button>

                                        </div>
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
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total Price</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php while ($row=mysqli_fetch_assoc($o_query)){
                            $wx++;
                            ?>
                            <tr>
                                <td><?php echo $wx; ?></td>
                                <td><?php echo $row['o_product_name'];?></td>
                                <td><?php echo $row['o_price'] ; ?></td>
                                <td><?php echo $row['o_quantity']; ?></td>
                                <td><?php echo $row['o_price_total']; ?></td>
                                <td>
                                    <form name="del<?php echo $wx; ?>" method="post">

                                        <input type="hidden" name="order_id" value="<?php echo $row['o_id']; ?>" />
                                        <input type="hidden" name="cart_id" value="<?php echo $row['cart_id']; ?>" />
                                        <input type="hidden" name="o_price_total" value="<?php echo $row['o_price_total']; ?>" />
                                        <button class="btn btn-icon btn-rounded btn-danger ml-1" type="submit" name="del_sub">
                                            <i class="fa fa-trash"></i>
                                            Delete
                                        </button>
                                    </form>
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

        <div class="modal fade" id="product_add" tabindex="-1" role="dialog" aria-labelledby="product_addTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add Product To Order</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" class="form-control" name="o_product_name" placeholder="Product Name">
                                <input type="hidden" class="form-control" name="o_user_teir" value="<?php echo $user_teir ;?>">
                                <input type="hidden" class="form-control" name="cid" value="<?php echo $_POST['cid'] ;?>">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="o_product_code" placeholder="Product Code" value="00">
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" name="o_quantity" placeholder="Product Quantity">
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" name="o_price" placeholder="Product Price">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="add_p" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


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
