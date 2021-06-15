<?php

//delete.php

include('../config.php');

$table = $_POST['table'];

$sql = "DELETE FROM $table WHERE image_id = '".$_POST["id"]."'";  
 if(mysqli_query($con, $sql))  
 {  
      echo 'Data Deleted';  
 }  
 ?>