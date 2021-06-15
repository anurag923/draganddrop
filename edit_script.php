<?php
 include 'config.php';
$created_on = date("d-m-Y h:i:sa"); 	
//	mysql_select_db("crexinco_protype",$con) or die("Mysql Database missing.");
$upload_dir = "upload/canvas/";
$img = $_POST['hidden_data'];
$canvas_details = $_POST['canvas_details'];
$id = $_POST['id'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$file = $upload_dir . mktime() . ".png";
$success = file_put_contents($file, $data);
 
echo "this is the id".$id;
 
$sql2=mysqli_query($con,"UPDATE canavas_image set image_name='".$file."', canvas_details='".$canvas_details."', hidden_data='".$img."', created_on='$created_on' where image_id='$id'");

$sql2=mysqli_query($con,"UPDATE tbl_users_cards set canvas_details='".$canvas_details."'");


// print $success ? $file : 'Unable to save the file.';
?>