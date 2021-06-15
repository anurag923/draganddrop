<?php
include 'config.php'; 
if($_SESSION['userRole'] == 1){
	header('location: adminDashboard.php');
} elseif($_SESSION['userRole'] == 2) {
  header('location: userDashboard.php');   
}

?>


<?php 
        $errors = array();

    // LOGIN USER
	if (isset($_POST['login'])) {
		$email = mysqli_real_escape_string($con, $_POST['email']);
		$password = mysqli_real_escape_string($con, $_POST['password']);

		if (empty($email)) {
			array_push($errors, "Email is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
		//	$password = md5($password);
			$query = "SELECT * FROM tbl_admin WHERE email='$email' AND password='$password'";
			$results = mysqli_query($con, $query);

			if (mysqli_num_rows($results) == 1) {
		
		    $rows = mysqli_fetch_assoc($results);
		    
		     $_SESSION['userData'] = $rows['id'];
		     $_SESSION['userRole'] = $rows['role'];
		    
		    
		    if($rows['role'] == 1) {
		        
		     header('location: adminDashboard.php');
		     
		    } elseif($rows['role'] == 2) {
		       
		       header('location: userDashboard.php'); 
		    }
		
// 			$_SESSION['userData'] = $email;
// 				$_SESSION['success'] = "You are now logged in";
			
			}
			else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}



?>



<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>LOGIN</title>
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/bundles/bootstrap-social/bootstrap-social.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Login</h4>
                <?php                                                
$sql="SELECT * FROM `tbl_admin` WHERE id='1'";
	$result=mysqli_query($con,$sql);
	while(($row=mysqli_fetch_array($result)))
	{
 ?> 
  <img src="upload/<?php echo $row['pic']; ?>" style="width: 100px">             
  <?php } ?>              
              </div>
              <div class="card-body">
                  
         <?php  if (count($errors) > 0) : ?>
         	<?php foreach ($errors as $error) : ?>
          <div id="alert_placeholder">
    <div style="word-wrap: break-word;" class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><?php echo $error ?></div>
</div>  
	<?php endforeach ?>
         <?php  endif ?>
                  
                  
                  
                <form method="POST" action="" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your email
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                      <div class="float-right">
                        <a href="forgot-password.php" class="text-small">
                          Forgot Password?
                        </a>
                      </div>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div>
                  <div class="form-group">

                      <input type="submit" class="btn btn-success btn-lg btn-block" name="login" value="Login">
                  
                     
                   
                  </div>
                </form>
                 
               
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </section>
  </div>
  <script src="assets/js/app.min.js"></script>
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>
</body>


</html>