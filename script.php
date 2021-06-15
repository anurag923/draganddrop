<?php
 include 'config.php';
$created_on = date("d-m-Y h:i:sa"); 	
//	mysql_select_db("crexinco_protype",$con) or die("Mysql Database missing.");
$upload_dir = "upload/canvas/";
$img = $_POST['hidden_data'];
$canvas_details = $_POST['canvas_details'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$file = $upload_dir . mktime() . ".png";
$success = file_put_contents($file, $data);
 

$sql2=mysqli_query($con,"INSERT INTO canavas_image (image_name,canvas_details,created_on,hidden_data)VALUES('".$file."','".$canvas_details."','$created_on','$img')");
    

// print $success ? $file : 'Unable to save the file.';
?>