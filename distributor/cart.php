<?php
session_start();
include('connect.php');
require 'session_check.php';
$wx=0;
$c_id=$_SESSION['cart'];
$u_id=$_SESSION['u_id'];
$ut=$_SESSION['u_tier'];
$cg_sql="SELECT `cart_size`,`o_price` from `cart` where cart_id = ".$c_id;
$cg_query=mysqli_query($con,$cg_sql);

$cg_acc=mysqli_fetch_assoc($cg_query);
$size=$cg_acc['cart_size'];
$total_p=$cg_acc['o_price'];
echo $of_sql="SELECT * FROM `orders` WHERE cart_id =".$c_id;
$of_query=mysqli_query($con,$of_sql);




if(isset($_POST['del_sub']))
{
    $del_id=$_POST['del_id'];
    $size=$size-1;
    $cu_sql="UPDATE `cart` SET `cart_size`= '$size'  WHERE cart_id =".$c_id;
    $cu_query=mysqli_query($con,$cu_sql);
    $del_sql="DELETE FROM orders WHERE o_id =".$del_id ;
    $del_query=mysqli_query($con,$del_sql);
    header("location:cart.php");
}

if(isset($_POST['cart_clear']))
{
    $del_id=$_POST['cart_id'];
    $size=$size-1;
    $cu_sql="UPDATE `cart` SET `cart_size`= '0' , `o_price` = '0' WHERE cart_id =".$c_id;
    $cu_query=mysqli_query($con,$cu_sql);
    $del_sql="DELETE FROM orders WHERE cart_id =".$del_id ;
    $del_query=mysqli_query($con,$del_sql);
    header("location:cart.php");
}


if(isset($_POST['cart_confirm']))
{
    $conf_id=$_POST['cart_id'];
    $size=$size-1;
    $cu_sql="UPDATE `cart` SET `cart_status`= '1'  WHERE cart_id =".$conf_id;
    $cu_query=mysqli_query($con,$cu_sql);
    $orderc_sql= "UPDATE `orders` SET `o_status`= '1'  WHERE cart_id =".$conf_id ;
    $orderc_query=mysqli_query($con,$orderc_sql);
    $cc_sql= "INSERT INTO `cart` (`cart_uid`) value ('$u_id')";
    $cc_query = mysqli_query($con,$cc_sql);
    $gcid_sql="SELECT MAX(`cart_id`) FROM `cart` where `cart_uid`=".$u_id;
    $gcid_q=mysqli_query($con,$gcid_sql);
    $r=mysqli_fetch_assoc($gcid_q);
    echo $cid = implode(" ",$r);
    if ($cid==NULL){
        $cid=0;
    }
    $upc_id="UPDATE `distributor` SET `f_cart`= 1 , `dcart_id`= '$cid' where `d_id`=".$u_id;
    $upc_query=mysqli_query($con,$upc_id);
    $_SESSION['cart']=$cid;
    header("location:cart.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cart</title>
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
    <link href="css/chosen.css" rel="stylesheet">
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
    <link rel="icon" href="./favicon.ico" type="image/x-icon">
    <script type="text/javascript">
        var $perror = <?php if(isset($_GET['e'])){ echo "1";} else { echo "0";} ?>;
        var $puploaded = <?php if(isset($_GET['s'])){ echo "1";}  else { echo "0";}?>;
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
                                    <i class="icon-On-Off-3"></i>
                                </div>
                                <div class="list-body">
                                    <div class="list-title fs-2x">
                                        <h3>Cart</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 d-flex justify-content-end h-md-down">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb no-padding bg-trans mb-30">
                                <li class="breadcrumb-item"><a href="dashboard.php"><i class="icon-Home mr-2 fs14"></i></a></li>
                                <li class="breadcrumb-item active">Cart</li>
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
                                    <h3>Cart Summary</h3>
                                </div>
                            </div>
                            <div class="portlet-body row">
                                <div class="col-lg-10 col-md-10 col-sm-10 row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="list-alt bg-success-light rounded ">
                                        <div class="list-item">
                                            <div class="list-thumb">
                                                <i class="icon-Full-Cart fs-2x"></i>
                                            </div>
                                            <div class="list-body">
                                            <span class="list-title">
                                                <?php echo $size;?>
                                            </span>
                                                <span class="list-content">
                                                Products
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="list-alt bg-danger-light rounded ">
                                            <div class="list-item">
                                                <div class="list-thumb">
                                                    <i class="icon-Money-2 fs-2x"></i>
                                                </div>
                                                <div class="list-body">
                                            <span class="list-title">
                                                <?php echo $total_p;?>
                                            </span>
                                                    <span class="list-content">
                                                Total
                                            </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="portlet-box portlet-gutter  mb-10 row">
                            <div class="portlet-header flex-row flex d-flex align-items-center b-b">
                                <div class="flex d-flex flex-column">
                                    <h3>Cart Actions</h3>
                                </div>
                            </div>
                            <div class="portlet-body row">
                                <div class="col-lg-4 col-md-5 col-sm-6 m-2">
                                    <form method="post" name="cart_conf">
                                        <input type="hidden" name="cart_id" value="<?php echo $c_id;?>">
                                        <button class="btn btn-xl btn-icon  btn-rounded  btn-outline-dark ml-1 add_prod" type="submit" name="cart_confirm">
                                            <i class="fa fa-cart-plus"></i>
                                            Confirm Orders
                                        </button>
                                    </form>
                                </div>
                                <div class="col-lg-4 col-md-5 col-sm-6 m-2">
                                    <form method="post" name="cart_clr">
                                        <input type="hidden" name="cart_id" value="<?php echo $c_id;?>">
                                        <button class="btn btn-xl btn-icon  btn-rounded  btn-outline-danger ml-1 add_prod" type="submit" name="cart_clear">
                                            <i class="fa fa-trash-alt"></i>
                                            Clear Cart
                                        </button>
                                    </form>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white table-responsive rounded shadow-sm pt-3 pb-3 mb-30 row">
                    <h6 class="pl-3 pr-3 text-capitalize font400 mb-20">Cart List</h6>
                    <table id="data-table" class="table mb-0 table-striped" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Product Code</th>
                            <th>Price Per Item</th>
                            <th>Total Price</th>
                            <th>Qty</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while ($row=mysqli_fetch_assoc($of_query)){
                            $wx++;
                            ?>
                            <tr>
                                <td><?php echo $wx; ?></td>
                                <td><?php echo $row['o_product_code'];?></td>
                                <td><?php echo $row['o_price'] ; ?></td>
                                <td><?php echo $row['o_price_total'] ; ?></td>
                                <td><?php echo $row['o_quantity']; ?></td>
                                <td>
                                    <form method="post" name="del_f">
                                        <input type="hidden" name="del_id" value="<?php echo $row['o_id'];?>">
                                    <button class="btn btn-icon  btn-rounded  btn-gradient-danger ml-1 add_prod" type="submit" name="del_sub">
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

<script src="js/chosen.jquery.js" type="text/javascript"></script>


</body>
</html>
