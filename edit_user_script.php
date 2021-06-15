<?php
 include 'config.php';
$created_on = date("d-m-Y h:i:sa"); 	
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
// $sql2=mysqli_query($con,"INSERT INTO canavas_image (image_name,canvas_details,created_on)VALUES('".$file."','".$canvas_details."','$created_on')");

$sql2=mysqli_query($con,"UPDATE tbl_users_cards set generated_pic='".$file."' where id='$id'");


// print $success ? $file : 'Unable to save the file.';
?>