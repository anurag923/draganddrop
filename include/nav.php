
<?php

$session = $_SESSION['userData'];

include 'config.php';
?>

 <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                <i data-feather="maximize"></i>
              </a></li>
            <li>
               
            </li>
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
           
          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user"> 
           <?php
$sql="select * from tbl_admin where id='$session'";
	$result=mysqli_query($con,$sql);
	while($rowss=mysqli_fetch_array($result))
	{
 
	
?>       
              <?php if($rowss['pic'] == '') { ?>
             <img alt="image" src="assets/img/no-image.png" class="user-img-radious-style" style="width: 60px"> 
              <?php } else { ?>
              <img alt="image" src="upload/<?php echo $rowss['pic']; ?>" class="user-img-radious-style" style="width: 60px">
              <?php } ?>
              
                
           
                <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">Hello <?php echo $rowss['name']; ?></div>
              <a href="profile.php" class="dropdown-item has-icon"> <i class="far fa-user"></i> Profile
              </a> 
              <a href="update-password.php" class="dropdown-item has-icon"> <i class="fas fa-bolt"></i>
                Change Password
              </a>
              
              <div class="dropdown-divider"></div>
              <a href="include/logout.php" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                Logout
              </a>
            </div>
              <?php } ?>
          </li>
        </ul>
      </nav>