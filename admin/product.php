<?php
session_start();
include('connect.php');
require 'session_check.php';
$wx=0;
$prod_sql="SELECT * FROM `products`";
$prod_query=mysqli_query($con,$prod_sql);
$prod_count = mysqli_num_rows($prod_query);

if(isset($_POST['del_sub'])){
    $del_id=$_POST['adel_id'];
    $del_sql="DELETE FROM `products` WHERE `p_id` = ".$del_id;
    $del_query=mysqli_query($con,$del_sql);
    header("location:product.php");
}
if (isset($_POST['add_p'])){
    $p_name=$_POST['p_name'];
    $p_code=$_POST['p_code'];
    $p_qty=$_POST['p_qty'];
    $p_lending_price=$_POST['p_lending_price'];
    $p_mrp=$_POST['p_mrp'];
    $p_price1=$_POST['p_price1'];
    $p_price2=$_POST['p_price2'];

    $prod_add_sql="INSERT INTO products (p_code, p_name, p_qty, p_mrp, p_lending_price, p_price1, p_price2) VALUES ('$p_code','$p_name','$p_qty','$p_mrp','$p_lending_price','$p_price1','$p_price2')";
    $prod_add_query=mysqli_query($con,$prod_add_sql);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Products</title>
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
                                    <i class="icon-Basket-Items"></i>
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
                                <li class="breadcrumb-item active">Products</li>
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
                                    <h3>Total Live Products</h3>
                                </div>
                            </div>
                            <div class="portlet-body row">
                                <div class="col-lg-10 col-md-10 col-sm-10">
                                    <div class="list-alt bg-warning-light rounded ">
                                        <div class="list-item">
                                            <div class="list-thumb">
                                                <i class="icon-Basket-Quantity fs-2x"></i>
                                            </div>
                                            <div class="list-body">
                                            <span class="list-title">
                                                <?php echo $prod_count;?>
                                            </span>
                                                <span class="list-content">
                                                Product listings
                                            </span>
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
                                    <h3>Create Product</h3>
                                </div>

                            </div>
                            <div class="portlet-body row align-content-center">
                                <div class="col-lg-10 col-md-10 col-sm-10">
                                    <button type="button" class="btn btn-icon btn-lg btn-light-primary mb-30" data-toggle="modal" data-target="#product_add">
                                        <i class="icon-Add"></i>
                                        Add Product
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>




                <div class="bg-white table-responsive rounded shadow-sm pt-3 pb-3 mb-30 row">
                    <h6 class="pl-3 pr-3 text-capitalize font400 mb-20">Product List</h6>
                    <table id="data-table" class="table mb-0 table-striped" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Product Quantity</th>
                            <th>Product L.P.</th>
                            <th>Product MRP</th>
                            <th>Product Price 1</th>
                            <th>Product Price 2</th>
                            <th>Last Update On | Posted On</th>
                            <th>Edit</th>
                            <th>Delete</th>



                        </tr>
                        </thead>
                        <tbody>
                        <?php while ($row=mysqli_fetch_assoc($prod_query)){
                            $wx++;
                            ?>
                            <tr>
                                <td><?php echo $wx; ?></td>
                                <td><?php echo $row['p_code'];?></td>
                                <td><?php echo $row['p_name'];?></td>
                                <td><?php echo $row['p_qty'];?></td>
                                <td><?php echo $row['p_lending_price']; ?></td>
                                <td><?php echo $row['p_mrp'];?></td>
                                <td><?php echo $row['p_price1'];?></td>
                                <td><?php echo $row['p_price2'];?></td>
                                <td><?php
                                    if($row['p_create_date']===$row['p_update_date']){ echo $row['p_create_date']." || Not Changed";}
                                    else {echo $row['p_update_date']." || ".$row['p_update_date'];}
                                    ?>
                                </td>
                                <td>
                                    <form name="edit_<?php echo $wx; ?>" method="get" action="product_edit.php">
                                        <input type="hidden" name="pid" value="<?php echo $row['p_id'];?>">
                                        <button class="btn btn-icon  btn-rounded  btn-gradient-primary ml-1" type="submit" name="edit">
                                            <i class="fa fa-edit"></i>
                                            Edit
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form name="del<?php echo $wx; ?>" method="post">
                                        <input type="hidden" name="adel_id" value="<?php echo $row['p_id'];?>">
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
                        <h5 class="modal-title" id="exampleModalLongTitle">Create Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form method="post" enctype="multipart/form-data">
                        <div class="modal-body">

                            <div class="form-group">
                                <input type="text" class="form-control" name="p_name" placeholder="Product Name">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="p_code" placeholder="Product Code">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="p_qty" placeholder="Product Quantity">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="p_lending_price" placeholder="Product Lending Price">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="p_mrp" placeholder="Product Mrp">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="p_price1" placeholder="Product Price 1">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="p_price2" placeholder="Product Price 2">
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
