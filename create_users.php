<?php include 'include/session.php'; ?>
<?php include 'config.php'; 

     $errors = array();
   
if (isset($_POST['add_users'])) {
		// receive all input values from the form
		$name = mysqli_real_escape_string($con, $_POST['name']); 
		$email = mysqli_real_escape_string($con, $_POST['email']);
		$password = mysqli_real_escape_string($con, $_POST['password']);
		$phone = mysqli_real_escape_string($con, $_POST['phone']);
		
        

		// form validation: ensure that the form is correctly filled
		if (empty($name)) { array_push($errors, "Name is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($phone)) { array_push($errors, "Phone no is required"); }

		
 
  $user_check_query = "SELECT * FROM tbl_admin WHERE email='$email' OR phone='$phone' LIMIT 1";
  $result = mysqli_query($con, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) {  
    
     if ($user['phone'] == $phone) {
      array_push($errors, "Phone No already exists");
    }

    if ($user['email'] == $email) {
      array_push($errors, "Email already exists");
    }
    
    
  }   
		// register user if there are no errors in the form
		if (count($errors) == 0) {
		//	$password = md5($password);
			$query = "INSERT INTO tbl_admin (name,email,phone,password,role) VALUES ('$name','$email','$phone','$password','2')";
			mysqli_query($con, $query);
	    



    //  OTP TEMPLATE
            
	         $to = $email;
			$subject = 'Your Account Login Details';
			$message = "<p>Login ID - $email</p><br>
			            <p>Password: - $password</p><br>
			            <p>URL: $appurl</p>
			";
			$headers = 'MIME-Version: 1.0' . "\r\n";
			$headers.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers.= 'From: <'.$contact_email.'>' . "\r\n";
			mail($to, $subject, $message, $headers);
			
			
		$response1 = array(
            "type" => "success",
            "message" => "User Registered Successfully"
        );
			
 		
		}
		}


$sql_users=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM tbl_admin WHERE id='".$_GET['nid']."'"));


if(isset($_POST['update'])){
    
        $name = mysqli_real_escape_string($con, $_POST['name']); 
		$email = mysqli_real_escape_string($con, $_POST['email']);
		$password = mysqli_real_escape_string($con, $_POST['password']);
		$phone = mysqli_real_escape_string($con, $_POST['phone']);

$sql="UPDATE tbl_admin SET name='$name',email='$email',password='$password',phone='$phone' WHERE id='".$_GET['nid']."'";

if ($con->query($sql) === TRUE) {
$response1 = array(
            "type" => "success",
            "message" => "Users Details Updated Successfully"
        );
}
else
{
 $response = array(
            "type" => "error",
            "message" => "Something went wrong"
        );
}
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Add Users</title>
  <link rel="stylesheet" href="assets/css/app.min.css">
 
 

  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css'>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'> 

  
</head>

<body>

  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
    <?php include 'include/nav.php'; ?>
        <?php include 'include/sidebar.php'; ?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row mt-sm-4">
              
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="padding-20">
     <?php
        if (! empty($response1)) {
            ?>
          <div id="alert_placeholder">
    <div style="word-wrap: break-word;" class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><?php echo $response1["message"]; ?></div>
</div>  
            
    <?php } ?>   
                       <?php  if (count($errors) > 0) : ?>
  <div class="error">
  	<?php foreach ($errors as $error) : ?>
  	  <p style="color: red"><?php echo $error ?></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>     
   
                      
                                        
                      <form action="" method="post" class="needs-validation" enctype="multipart/form-data">
                          <div class="card-header">
                              <h4>Add Users</h4>
                          </div>
                          <div class="card-body">
                               
                              <div class="row">
                                  
                                  <div class="form-group col-md-6 col-12">
                                      <label>Name</label>
                                      <input type="text" class="form-control" name="name" value="<?=$sql_users['name']?>" placeholder="Full Name" required>

                                  </div>
                                  <div class="form-group col-md-6 col-12">
                                      <label>Email</label>
                                      <input type="email" class="form-control" name="email" value="<?=$sql_users['email']?>" placeholder="Email" required>

                                  </div>
                                    <div class="form-group col-md-6 col-12">
                                      <label>Phone</label>
                                      <input type="text" class="form-control" name="phone" value="<?=$sql_users['phone']?>" placeholder="Phone">

                                  </div>
                                   <div class="form-group col-md-6 col-12">
                                      <label>Password</label>
                                      <input type="password" class="form-control" name="password" value="<?=$sql_users['password']?>" placeholder="Password" required>

                                  </div>
                                 
                                  
                                  <div class="form-group col-md-6 col-12">
                                     <div class="card-footer text-right">
                                         <?php if($_GET['mode'] == 'edit') { ?>
                              <button type="submit" class="btn btn-primary" name="update">Update Users</button>
                              <?php } else { ?>
                               <button type="submit" class="btn btn-primary" name="add_users">Add Users</button>
                              <?php } ?>
                          </div>
                                  </div>
                              </div>

                            
                              
                            
                              
                          </div>
                         
                      </form>
                  
                    
                  </div>
                </div>
                
                 
              </div>
            </div>
          </div>
        </section>
        
      </div>
     <?php include 'include/footer.php'; ?>
    </div>
  </div>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js'></script>
    <script  src="assets/js/script.js"></script>
  
  <script src="assets/js/app.min.js"></script>
  
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>
</body>
</html>