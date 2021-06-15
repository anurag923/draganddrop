<?php 
 
include '../config.php';
if($_POST['password']!=""):
    $pass_encrypt=mysqli_real_escape_string($con,$_POST['password']);
    $user_id=mysqli_real_escape_string($con,$_POST['id']);
    $fetch=$con->query("UPDATE `tbl_admin` SET `password` = '$pass_encrypt',`active_code`='' WHERE id='$user_id'");
    if($fetch): echo 1;  
    else : echo 0;
    endif;
else :
    header("Location: $appurl");
endif;
?>
