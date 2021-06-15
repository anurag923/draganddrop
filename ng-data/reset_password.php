<?php 
 
include '../config.php';  
  if($_POST['email']!=""):
      $email=mysqli_real_escape_string($con,$_POST['email']);
      $db_check=$con->query("SELECT * FROM `tbl_admin` WHERE email='$email'");
      $count=mysqli_num_rows($db_check);
      if($count==1) :
         $row=mysqli_fetch_array($db_check);
         $active_code=md5(uniqid(rand(5, 15), true));
         $link = $appurl.'/admin/change-password.php?user_id='.$row['id'].'&key='.$active_code;         
         $fetch=$con->query("UPDATE `tbl_admin` SET `active_code` = '$active_code' WHERE `email`='$email' ");
         $to="$email"; //change to ur mail address
         $strSubject="Password Recovery Link";
         $message = '<p>Password Recovery Link : '.$link.'</p>' ;              
         $headers = 'MIME-Version: 1.0'."\r\n";
         $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
         $headers .= "From: $contact_email";            
         $mail_sent=mail($to, $strSubject, $message, $headers);  
          if($mail_sent) echo 1;
          else echo 0;  
      else :
        echo 0;
      endif;
  else :
      header("Location: $appurl");
  endif;
?>
