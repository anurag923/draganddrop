  <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a href="#">
  <?php
$sql="select * from tbl_admin where id='$session'";
	$result=mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($result))
	{
?> 
                   <?php if($row['pic'] == '') { ?>
             <img alt="image" src="assets/img/no-image.png" class="user-img-radious-style" style="width: 60px"> 
              <?php } else { ?>
              <img alt="image" src="upload/<?php echo $row['pic']; ?>" class="user-img-radious-style" style="width: 60px">
              <?php } ?>
               
               <?php } ?>
                </a>
            </div>
          <ul class="sidebar-menu">
           
            <li class="dropdown active">
               <?php if($_SESSION['userRole'] == 1) { ?>
               <a href="adminDashboard.php" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
               <?php } elseif($_SESSION['userRole'] == 2) { ?>
                <a href="userDashboard.php" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
               <?php } ?>
              
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="user"></i><span>Account</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="profile.php">Profile Information</a></li>
                    <li><a class="nav-link" href="update-password.php">Change Password</a></li>
                    
                </ul>
            </li>
       
          <?php if($_SESSION['userRole'] == 2) { ?>
        <li class="dropdown">
          
        <a href="user_current_template.php" class="nav-link"><i data-feather="monitor"></i><span>Current Template</span></a>
       </li>
           <?php } ?>
           
              <?php if( $_SESSION['userRole'] == 1) { ?> 
              <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="file"></i><span>Template List</span></a>
                <ul class="dropdown-menu">
                    
                    <li><a class="nav-link" href="current_template_list.php">Current Template</a></li>
                     <li><a class="nav-link" href="template_list.php">Template History</a></li>
                    
                </ul>
            </li>
             <?php } ?>
             
              <?php if( $_SESSION['userRole'] == 1) { ?> 
              <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="file"></i><span>Submitted User Details</span></a>
                <ul class="dropdown-menu">
                    
                    <li><a class="nav-link" href="submitted_user_details.php">Submitted List</a></li>
                    
                </ul>
            </li>
             <?php } ?>
    
             <?php if( $_SESSION['userRole'] == 1) { ?>
             <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="file"></i><span>Users</span></a>
                <ul class="dropdown-menu">
                    <li> <a href="create_users.php" class="nav-link">Create Users</a></li>
                    <li><a class="nav-link" href="users_list.php">Users List</a></li>
                     
                     
                </ul>
            </li>
            <?php } ?>
          </ul>
        </aside>
      </div>