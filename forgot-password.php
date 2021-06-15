<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>FORGOT PASSWORD</title>
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
                <h4>Forgot Password</h4>
              </div>
              <div class="card-body">
                
                <form class="form-horizontal"  action="#" id="form_reset_pwd">
      <fieldset>        
        <p>Enter your Email Address here to receive a linkdd to change password.</p>
        <div class="form-group">
             <div id="error_result"></div>
          <label class="col-sm-3 control-label"></label>
          
          <div class="col-sm-12">
              
            <input type="text" class="form-control required email" name="email" placeholder="Email"/>
          </div>
        </div>
       
        <div class="form-group">
          <div class="col-md-12">
            <button type="button" class="btn btn-primary btn-lg btn-block forgot_password">Send Email</button>           
          </div>
        </div>
      </fieldset>
       </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script> 
  <script>  
  $(document).ready(function(){
    $('#login_form').validate();   
   
    $(document).on('click','.forgot_password',function(){
      var url = "ng-data/reset_password.php";       
      if($('#form_reset_pwd').valid()){
        $('#error_result').html('<img src="ajax.gif" align="absmiddle"> Please wait...');  
        $.ajax({
        type: "POST",
        url: url,
        data: $("#form_reset_pwd").serialize(), // serializes the form's elements.
          success: function(data) {                    
            if(data==1)
            {
              $('#error_result').html('<p style="color: green">Reset Link has been Sent Check Your Email</p>');
              $('#error_result').addClass("green");
            } 
            else
            {
              $('#error_result').html('<p style="color: red">Invalid email id. Please check your email id.</p>');
              $('#error_result').addClass("red");
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