<?php
session_start();



require 'connect.php';
require 'session_check.php';
$uid=$_SESSION['u_id'];
//$uid = $_SESSION['u_id'];
if(isset($_POST["edit_img"])) {
    $check = getimagesize($_FILES["ser_image"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ". ";
        $uploadOk = 1;
    } else {
        echo "File is not an image. ";
        $uploadOk = 0;
    }
}
$target_dir = "../product/switch_products/";
$target_file = $target_dir . basename($_FILES["ser_image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if (file_exists("./".$target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["ser_image"]["tmp_name"], $target_file)) {
        echo "\n The file ". basename( $_FILES["ser_image"]["name"]). " has been uploaded.";
        echo $file_name=$_FILES["ser_image"]["name"];
        $ser_id=$_POST['ser_id'];

        $file_path="./product/switch_products/".$file_name;
        $up_by=$uid;

        $old_sql="SELECT `sp_image` FROM `switch_products` WHERE `sp_id` = '$ser_id' ";
        $old_query=mysqli_query($con,$old_sql);
        $old_assoc=mysqli_fetch_assoc($old_query);
        $old_file = $old_assoc['sp_image'];

        $del_shell = shell_exec("rm ../".$old_file);
        echo $del_shell;

        echo   $update= "UPDATE `switch_products` SET `sp_image` = '$file_path' where `sp_id` = '$ser_id'";
        $update_query = mysqli_query($con,$update) or die('Upload query failed');
        if ($update_query) {
            $success=1;
            header( "location:product.php?s" );
        } }
    else
    {
        echo "\n Sorry, there was an error uploading your file.";
        header( "location:product.php?e" );
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
