<?php include '../include/config.php'; ?>
<?php 
// $con = new mysqli('localhost', 'thema0sa_unocard', 'thema0sa_unocard', 'thema0sa_unocard');
include '../include/config.php';
    if($_GET['user_id']!="" && $_GET['key']!=""):
        $user_id=mysqli_real_escape_string($con,$_GET['user_id']);
        $active_code=mysqli_real_escape_string($con,$_GET['key']);
        $fetch=$con->query("SELECT * FROM `tbl_admin` WHERE id='$user_id'");
        $count=mysqli_num_rows($fetch);
        if($count!=1) :
          header("Location: index");
        endif;
    else :
        header("Location: index");
    endif;
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Change Password</title>
<link rel="stylesheet" href="assets/css/app.min.css">
 <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <link rel="stylesheet" href="assets/css/custom.css">

 
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
  
  
  
  
</head>

<body>

  <div>
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Change Password</h4>
              </div>
              <div class="card-body">
                
            <form method="post" autocomplete="off" id="password_form">
          <div class="modal-body with-padding">                             
          <div class="form-group">
            <div class="row">
              <div class="col-sm-12">
                <label>New Password</label>
                <input type="password" id="passwords" name="password"  class="form-control required">
              </div>
            </div>
          </div>
          <div class="form-group">
          <div class="row">
            <div class="col-sm-12">
              <label>Confirm password</label>
              <input type="password" id="cpassword" name="cpassword" title="Password is mismatch" equalto="#passwords" class="form-control required" value="">
            </div>
          </div>
          </div>         
          </div>
          <div id="error_result"></div>
          <!-- end Add popup  -->  
          <div class="modal-footer">
            <input type="hidden" name="id" value="<?php echo $user_id; ?>" id="id">
            <button type="submit" id="btn-pwd" class="btn btn-primary btn-lg btn-block">Submit</button>              
          </div>
        </form> 
         
              </div>
              
            </div>
            
          <div class="mb-4 text-muted text-center">
                Remember Password? <a href="index">Login</a>
              </div>
            
          </div>
        </div>
      </div>
    </section>
  </div>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script> 
 <script>  
  $(document).ready(function(){
    $(document).on('click','#btn-pwd',function(){
      var url = "ng-data/new_password";       
      if($('#password_form').valid()){
        $('#error_result').html('<img src="ajax.gif" align="absmiddle"> Please wait...');  
        $.ajax({
        type: "POST",
        url: url,
        data: $("#password_form").serialize(),
          success: function(data) {                    
            if(data==1)
            {
              $('#error_result').html('Password reset successfully.');
              window.setTimeout(function() {
              window.location.href = 'login?sucess=1';
              }, 1000);
            } 
            else
            {
              $('#error_result').html('Password reset failed. Enter again.');              
            }
          }
        });
      }
      return false;
    });
});
</script>
  
  

</body>
</html>