<?php include 'include/session.php'; ?>
<?php include 'config.php'; ?>


 

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Users List</title>

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
                                    <h4>Users List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tableExport" class="table table-striped table-hover" style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>Sl.</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                     <th>Password</th>
                                                     <th>Created</th>
                                                     <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                
<?php                                                
 $i = 1; 

$sql="SELECT * FROM `tbl_admin` WHERE role='2' ORDER BY `id` DESC";
	$result=mysqli_query($con,$sql);
	while(($row=mysqli_fetch_array($result)))
	{
 ?>           
                                                
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                  
                                                    <td><?php echo $row['name']; ?> </td>
                                                     <td><?php echo $row['email']; ?></td>
                                                     <td><?php echo $row['phone']; ?></td>
                                                       <td><?php echo $row['password']; ?></td>
                                                    <td><?php echo $row['datetime']; ?></td>
                                                    <td>
                                                        <a href="create_users.php?nid=<?php echo $row['id']; ?>&mode=edit" class="btn btn-secondary buttons-excel"><span><i class="fa fa-edit"></i></span></a> 
                                                    
                                                     <a name="delete_btn" data-id3="<?php echo $row['id'];?>" data-table="tbl_admin" class="btn btn-secondary buttons-pdf btn_delete"><span><i class="fa fa-trash"></i></span></a>
                                                    
                                                    </td>
                                                  
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