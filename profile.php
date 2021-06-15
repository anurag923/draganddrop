<?php include 'include/session.php'; ?>
<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Profile</title>
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/bundles/bootstrap-social/bootstrap-social.css">
  <link rel="stylesheet" href="assets/bundles/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
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
                      
                      
                                   <!----================== Normal Login ====================  --->
    <?php
$sql="select * from tbl_admin where id='$session'";
	$result=mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($result))
	{
 
	
?>      
                      

                      <form action="" method="post" class="needs-validation" enctype="multipart/form-data">
                          <div class="card-header">
                              <h4>Edit Profile</h4>
                          </div>
                          <div class="card-body">
                              <div class="row">
                                  <div class="form-group col-md-12 col-12">
                                      <label>First Name</label>
                                      <input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>" placeholder="First Your Full Name">
                                      
                                  </div>
                                   
                              </div>
                              <div class="row">
                                  <div class="form-group col-md-6 col-12">
                                      <label>Email</label>
                                      <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>" placeholder="Email">

                                  </div>
                                  <div class="form-group col-md-6 col-12">
                                      <label>Phone</label>
                                      <input type="tel" class="form-control" name="phone" value="<?php echo $row['phone']; ?>" placeholder="Phone No">
                                  </div>
                              </div>

                               
                              <div class="row">
                                  <div class="form-group col-md-6 col-12">
                                      <div class="row">
                                          <div class="col-md-8"> <label>Profile Photo</label>

                                        <input type="file" class="form-control" name="Uploadpic" placeholder=""></div>
                                          <div class="col-md-4"><img src="upload/<?php echo $row['pic']; ?>" style="width: 150px"></div>
                                      </div>
                                      
                                     
                                  </div>
                                 
                              </div>
                              
                            
                              
                          </div>
                          <div class="card-footer text-right">
                              <button type="submit" class="btn btn-primary" name="update">Save Changes</button>
                          </div>
                      </form>
                    <?php } ?>
                    
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
  
  
 <!-------================================= normal email login ===============================-------->

<?php
if(isset($_POST['update'])){

$name=$_POST['name'];
 $email = $_POST['email'];
$phone = $_POST['phone'];


 $uploaded_name =  uniqid('uploaded-', true) 
    . '.' . strtolower(pathinfo($_FILES['Uploadpic']['name'], PATHINFO_EXTENSION));
    $uploaded_type = $_FILES[ 'Uploadpic' ][ 'type' ]; 
    $uploaded_size = $_FILES[ 'Uploadpic' ][ 'size' ]; 

    $target_path  = 'upload/'; 
    $target_path .= $uploaded_name;

    
        if( !move_uploaded_file( $_FILES[ 'Uploadpic' ][ 'tmp_name' ], $target_path ) ) { 
            
           $sql2="update tbl_admin set name='$name', email='$email',phone='$phone' where id='$session'";
			
			if ($con->query($sql2) === TRUE) {
			   
			 ?>
			<script>
			alert("Profile Details Updated Successfully");
			location.href="profile.php";
			
			</script>
		<?php
			} else {
			    echo "Error updating record: " . $con->error;
			}
           
        } 
        else { 
            // Yes! 
            $sql1="update tbl_admin set name='$name', email='$email',phone='$phone', pic='$uploaded_name'  where id='$session'";
			
			
			if ($con->query($sql1) === TRUE) {
			   
			 ?>
			<script>
				alert("Profile Details Updated Successfully");
			location.href="profile.php";
			
			</script>
		<?php
			} else {
			    echo "Error updating record: " . $con->error;
			}
           
        } 
            
               
              
          }
?> 
  
  
  
  
  <script src="assets/js/app.min.js"></script>
  <script src="assets/bundles/summernote/summernote-bs4.js"></script>
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>
</body>
</html>