<?php include 'include/session.php'; ?>
<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Change Password</title>
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
                    <?php
                        
if(isset($_POST['changepass'])){

$sql="UPDATE `tbl_admin` SET  `password` = '".$_POST['password']."' where id='$session'";

if ($con->query($sql) === TRUE) {
$response1 = array(
            "type" => "success",
            "message" => "Password Changed Successfully"
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
                      <?php
        if (! empty($response1)) {
            ?>
          <div id="alert_placeholder">
    <div style="word-wrap: break-word;" class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><?php echo $response1["message"]; ?></div>
</div>  
            
    <?php } ?>       
   
                      

                      <form action="" method="post" class="needs-validation" enctype="multipart/form-data">
                          <div class="card-header">
                              <h4>Change Password</h4>
                          </div>
                          <div class="card-body">
                               
                              <div class="row">
                                  <div class="form-group col-md-6 col-12">
                                      <label>New Password</label>
                                      <input type="password" class="form-control" name="password" placeholder="Password" required>

                                  </div>
                                  <div class="form-group col-md-6 col-12">
                                     <div class="card-footer text-right">
                              <button type="submit" class="btn btn-primary" name="changepass">Save Changes</button>
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
  
  
 
  
  
  
  <script src="assets/js/app.min.js"></script>
  <script src="assets/bundles/summernote/summernote-bs4.js"></script>
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>
</body>
</html>