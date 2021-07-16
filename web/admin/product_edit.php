<?php
session_start();
include('connect.php');
require 'session_check.php';
$p_id=$_GET['pid'];
$fetch_sp_sql="SELECT * FROM `products` where `p_id` = ".$p_id;
$fetch_ss=mysqli_query($con,$fetch_sp_sql);
$row_ss = mysqli_fetch_assoc($fetch_ss);
$name = $row_ss['p_name'];
$code = $row_ss['p_code'];
$cat = $row_ss['p_cat'];
$qty = $row_ss['p_qty'];
$lending_price = $row_ss['p_lending_price'];
$mrp = $row_ss['p_mrp'];
$price1 = $row_ss['p_price1'];
$price2 = $row_ss['p_price2'];


if(isset($_POST['edit_p'])){
    $p_name=$_POST['p_name'];
    $p_code=$_POST['p_code'];
    $p_cat = $_POST['p_cat'];
    $p_qty=$_POST['p_qty'];
    $p_lending_price=$_POST['p_lending_price'];
    $p_mrp=$_POST['p_mrp'];
    $p_price1=$_POST['p_price1'];
    $p_price2=$_POST['p_price2'];



    $sql="UPDATE `products` SET `p_name`='".$p_name."' ,`p_code`='".$p_code."',`p_cat`='".$p_cat."',`p_qty`='".$p_qty."',`p_lending_price`='".$p_lending_price."' , `p_mrp`='$p_mrp' , `p_price1`='$p_price1'  , `p_price2`='$p_price2'  WHERE `p_id`= ".$p_id;
    $sql_query=mysqli_query($con,$sql);

    header("location:product.php");
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
 
    <title>Product Edit</title>
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
    <link href="lib/dt-picker/jquery.datetimepicker.min.css" rel="stylesheet">
    <link href="css/picker-custom.css" rel="stylesheet">
    <link href="lib/summernote/summernote-bs4.css" rel="stylesheet">
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
                                    <i class="icon-Edit"></i>
                                </div>
                                <div class="list-body">
                                    <div class="list-title fs-2x">
                                        <h3>Product Edit</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 d-flex justify-content-end h-md-down">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb no-padding bg-trans mb-30">
                                <li class="breadcrumb-item"><a href="dashboard.php"><i class="icon-Home mr-2 fs14"></i></a></li>
                                <li class="breadcrumb-item active">Product Edit</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content">
            <div class="container-fluid">
                <div class="row cancel-row">
                <div class="bg-white rounded portlet-box col-12 col-lg-7 shadow-sm">
                    <div class="portlet-header flex-row flex d-flex align-items-center b-b">
                        <div class="flex d-flex flex-column">
                            <h3>Edit Product</h3>
                        </div>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="portlet-body col-10">
                            <div class="form-group">
                                <label>Name:</label>
                                <input type="text" class="form-control" name="p_name" placeholder="Product Name" value="<?php echo $name; ?>">
                            </div>
                            <div class="form-group">
                                <label>Code</label>
                                <input type="text" class="form-control" name="p_code" placeholder="Product Code" value="<?php echo $code; ?>">
                            </div>
                            <div class="form-group">
                                <label>Category</label>
                                <input type="text" class="form-control" name="p_cat" placeholder="Product Category" value="<?php echo $cat; ?>">
                            </div>
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="text" class="form-control" name="p_qty" placeholder="Product Quantity" value="<?php echo $qty; ?>">
                            </div>
                            <div class="form-group">
                                <label>Lending Price</label>
                                <input type="text" class="form-control" name="p_lending_price" placeholder="Product Lending Price" value="<?php echo $lending_price; ?>">
                            </div>
                            
                            <div class="form-group">
                                <label>MRP</label>
                                <input type="text" class="form-control" name="p_mrp" placeholder="Product Mrp" value="<?php echo $mrp; ?>">
                            </div>
                           
                            <div class="form-group">
                                <label>Price 1</label>
                                <input type="text" class="form-control" name="p_price1" placeholder="Product Price 1" value="<?php echo $price1; ?>">
                            </div>
                            <div class="form-group">
                                <label>Price 2</label>
                                <input type="text" class="form-control" name="p_price2" placeholder="Product Price 2" value="<?php echo $price2; ?>">
                            </div>

                            <div class="form-group">
                                <a  class="btn btn-secondary" href="product.php">Close</a>
                                <button type="submit" name="edit_p" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </form>
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
<script type="text/javascript" src="lib/fullcalendar/moment.js"></script>
<script type="text/javascript" src="lib/dt-picker/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript" src="js/plugins-custom/pickers-custom.js"></script>


</body>
</html>
