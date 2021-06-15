<?php include 'include/session.php'; ?>
<?php include 'config.php'; ?>


 

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Submitted List</title>

<?php include 'css.php'; ?>


</head>

<body>

  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
     <?php include 'include/nav.php'; ?>
    <?php include 'include/sidebar.php'; ?>
      <!-- Main Content -->
      <div class="main-content">
     
        
        
        
        
        
           <div class="clearfix"></div>
           <section class="section">
                <div class="section-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Submitted User Info List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tableExport" class="table table-striped table-hover" style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>Sl.</th>
                                                    <th>Design</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Address</th>
                                                    <th>Phone</th>
                                                    <th>Created On</th>
                                                    <th>Logo</th>
                                                    <th>Download</th>
                                                     <?php if( $_SESSION['userRole'] == 1) { ?>
                                                    <th>Action</th>
                                                    <?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                
<?php                                                
 $i = 1; 

$sql="SELECT * FROM `tbl_users_cards` ORDER BY `id` DESC";
	$result=mysqli_query($con,$sql);
	while(($row=mysqli_fetch_array($result)))
	{
 ?>           
                                                
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                  
                                                    <td> <img src="<?php echo $row['generated_pic']; ?>" style="width: 80px"></td>
                                                     <td><?php echo $row['name']; ?></td>
                                                      <td><?php echo $row['email']; ?></td>
                                                       <td><?php echo $row['address']; ?></td>
                                                        <td><?php echo $row['phone']; ?></td>
                                                      <td><?php echo $row['created_on']; ?></td>
                                                       <td><a href="upload/canvas/<?php echo $row['user_logo']; ?>" download><img src="upload/canvas/<?php echo $row['user_logo']; ?>" style="width: 50px"></a> </td>
                                                     <td><a href="<?php echo $row['generated_pic']; ?>" class="btn-sm btn-success" download>Download</a></td>
                                                     
                                                   <?php if($_SESSION['userRole'] == 1) { ?>   
                                                    <td>
                                                        <a href="edit_user_template.php?nid=<?php echo $row['id']; ?>" class="btn-sm btn-secondary buttons-excel"><span><i class="fa fa-edit"></i></span></a> 
                                                    
                                                     <a name="delete_btn" data-id3="<?php echo $row['id'];?>" data-table="tbl_users_cards"  class="btn-sm btn-secondary buttons-pdf btn_delete"><span><i class="fa fa-trash"></i></span></a>
                                                    
                                                    </td>
                                                    <?php } ?>
                                                </tr>
                                                
     
                                             <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
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
  
  
   
  
  
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
  
    <script type="text/javascript">
 
$(document).on('click', '.btn_delete', function(){  
           var id=$(this).data("id3");  
           var table=$(this).data("table");  
           if(confirm("Are you sure you want to delete this?"))  
           {  
                $.ajax({  
                     url:"ng-data/del_table_data2.php",  
                     method:"POST",  
                     data:{id:id,table:table},  
                     dataType:"text",  
                     success:function(data){  
                         
                           location.reload();
                     }  
                });  
           }  
      });  
</script>  
  
      <?php include 'js.php'; ?>
  
 
</body>
</html>