<?php
session_start();
include('connect.php');
require 'session_check.php';
$wx=0;
$c_id=$_SESSION['cart'];
$u_id=$_SESSION['u_id'];
$ut=$_SESSION['u_tier'];
$cg_sql="SELECT `cart_size` , `o_price` from `cart` where cart_id = ".$c_id;
$cg_query=mysqli_query($con,$cg_sql);
$cg_acc=mysqli_fetch_assoc($cg_query);
$size=$cg_acc['cart_size'];
$total_p=$cg_acc['o_price'];

$prod_sql="SELECT * FROM `products`" ;
$prod_query=mysqli_query($con,$prod_sql);

if(isset($_POST['submit_add'])) {
    $prod_id = $_POST['prod_id'];
    $prod_price = $_POST['prod_price'];
    $prod_code = $_POST['prod_code'];
    $add_qty = $_POST['add_qty'];


    $check_in_cart_sql = "SELECT * FROM `orders` WHERE `o_product_id` = " . $prod_id . " AND `cart_id` = " . $c_id;
    $check_in_cart_query = mysqli_query($con, $check_in_cart_sql);
    $check_assoc = mysqli_fetch_assoc($check_in_cart_query);
    if ($check_assoc === NULL) {
        $tot_p = $prod_price * $add_qty;
        $n_op = $total_p + $tot_p;
        $n_size = $size + 1;
        $cu_sql = "UPDATE `cart` SET `cart_size`= '$n_size' , `o_price` = '$n_op'  WHERE cart_id =" . $c_id;
        $cu_query = mysqli_query($con, $cu_sql);
        $oadd_sql = "INSERT INTO `orders`(`o_uid`, `cart_id`, `o_product_id`, `o_product_code`, `o_quantity`, `o_price`, `o_price_total`, `o_user_teir`) VALUES ('$u_id','$c_id','$prod_id','$prod_code','$add_qty','$prod_price','$tot_p','$ut')";
        $oadd_query = mysqli_query($con, $oadd_sql);
        echo "<script>alert('Added To Cart');</script>";
    } else {
        $existing_total = $check_assoc['o_price_total'];
        $tot_p = $prod_price * $add_qty;
        $n_op = $total_p + $tot_p - $existing_total;
        $cu_sql = "UPDATE `cart` SET `o_price` = '$n_op'  WHERE cart_id =" . $c_id;
        $cu_query = mysqli_query($con, $cu_sql);
        $oadd_sql = "UPDATE `orders` SET `o_quantity` = '$add_qty' , `o_price_total` = '$tot_p' WHERE `o_product_id`='$prod_id' AND `cart_id` = '$c_id'";
        $oadd_query = mysqli_query($con, $oadd_sql);
        echo "<script>alert('Qty Updated In Cart');</script>";

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Place Order</title>
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
    <link href="css/chosen.css" rel="stylesheet">
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
    <link rel="icon" href="./favicon.ico" type="image/x-icon">
    
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
                                        <h3>Products</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 d-flex justify-content-end h-md-down">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb no-padding bg-trans mb-30">
                                <li class="breadcrumb-item"><a href="dashboard.php"><i class="icon-Home mr-2 fs14"></i></a></li>
                                <li class="breadcrumb-item active">Product</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content">
            <div class="container-fluid">

                <div class="bg-white table-responsive rounded shadow-sm pt-3 pb-3 mb-30">
                    <h6 class="pl-3 pr-3 text-capitalize font400 mb-20">Product List</h6>
                    <table id="data-table" class="table mb-0 table-striped" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <!-- <th>Sr. No.</th> -->
                            
                            <th>Name</th>
                            <th>Code</th>
                            <!-- <th>MRP</th> -->
                            <th>Price</th>
                            <!-- <?php if ($ut==='1'){?><th>Price 2</th><?php }?> -->
                            <!-- <th>Qty</th> -->
                            <th>Add To Cart</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while ($row=mysqli_fetch_assoc($prod_query)){
                            $wx++;
                            ?>
                            <tr>
                                <!-- <td><?php echo $wx; ?></td> -->
                                <td><?php echo $row['p_name'];?></td>
                                <td><?php echo $row['p_code'];?></td>
                                <!-- <td><?php echo $row['p_mrp'];?></td> -->
                                <?php if($ut==='2'){ ?><td><?php echo $row['p_price2']; ?> </td> <?php } else { ?><td><?php echo $row['p_price1'];?></td><?php }?>
                                <!-- <?php if($ut==='1'){ ?><td><?php echo $row['p_price2']; ?> </td> <?php }?> -->
                                <!-- <td><?php echo $row['p_qty']; ?></td> -->
                                <td>
                                    <button class="btn btn-icon  btn-rounded  btn-outline-success add_prod" type="button" data-toggle="modal" data-target="#add_qty_modal" onclick="$add_prod_id = '<?php echo $row['p_id'];?>' ; $add_prod_code= '<?php echo $row['p_code'];?>'; $add_price= '<?php if($ut==='1'){echo $row['p_price1'];} elseif($ut==='2'){echo $row['p_price2'];}?>';">
                                        <i class="fa fa-cart-plus"></i>   
                                        Add                         
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="modal fade" id="add_qty_modal" tabindex="-1" role="dialog" aria-labelledby="add_qty_modal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal_title">Add Product </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form name="add_qty_f" method="post">
                            <div class="modal-body">
                                    <div class="form-group" id="add_modal_div">
                                        <label for="add_qty">Product Quantity</label>
                                        <input  type="number" id="add_qty" class="form-control" name="add_qty">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="submit_add" >Save changes</button>
                            </div>
                            </form>
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

<script src="js/chosen.jquery.js" type="text/javascript"></script>

<script>
    $(document).ready(function(){
        $(".add_prod").click(function(){
            $("#add_modal_div").append("<input type='hidden' name='prod_id' value='"+$add_prod_id+"'> <input type='hidden' name='prod_price' value='"+$add_price+"'> <input type='hidden' name='prod_code' value='"+$add_prod_code+"'>");
        });
    });
</script>
</body>
</html>
