<?php

//delete.php

include('../config.php');

$table = $_POST['table'];

$res_users=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM $table WHERE id='".$_POST["id"]."'"));
$user_logo = $res_users['user_logo'];
$str = $res_users['generated_pic'];
$exp = (explode("/",$str));
$generated_pic = $exp[2];

unlink("../upload/canvas/$generated_pic");
unlink("../upload/$user_logo");

$sql = "DELETE FROM $table WHERE id = '".$_POST["id"]."'";  



 if(mysqli_query($con, $sql))  
 {  
      echo 'Data Deleted';  
 }  
 ?>