<?php
session_start();
require 'connect.php';
require 'session_check.php';
$uid=$_SESSION['u_id'];
//$uid = $_SESSION['u_id'];
if(isset($_POST["confirm_s"])) {
    $check = getimagesize($_FILES["invoice"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ". ";
        $uploadOk = 1;
    } else {
        echo "File is not an image. ";
        $uploadOk = 0;
    }
}
$target_dir = "../distributor/upload/invoice/";
$target_file = $target_dir . basename($_FILES["invoice"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if (file_exists("./".$target_file)) {
    echo "Sorry, file already exists. Try Renaming File";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["invoice"]["tmp_name"], $target_file)) {
        echo "\n The file ". basename( $_FILES["invoice"]["name"]). " has been uploaded.";
        $file_name=$_FILES["invoice"]["name"];
        $cart_order=$_POST['cart_order'];
        $cart_id=$_POST['cart_id'];
        $o_price=$_POST['o_price'];
        $file_path="./upload/invoice/".$file_name;
        $confirm="UPDATE `cart` SET `cart_status` = 2 , `cart_order` = '$cart_order' , `o_price` = '$o_price' , `invoice_file` = '$file_path' WHERE `cart_id` = ".$cart_id;
        $update_query = mysqli_query($con,$confirm) or die('Upload query failed');
        if ($update_query) {
            $success=1;
//            header( "location:mcb_series.php?s" );
        } }
    else
    {
        echo "\n Sorry, there was an error uploading your file.";
//        header( "location:mcb_series.php" );
    }

}

// Check if image file is a actual image or fake image

// Check if file already exists

// Check file size
// if ($_FILES["s_image"]["size"] > 500000) {
//     echo "Sorry, your file is too large.";
//     $uploadOk = 0;
// }
// Allow certain file formats



?>
