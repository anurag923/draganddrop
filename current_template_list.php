<?php include 'include/session.php'; ?>
<?php include 'config.php'; ?>


 

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Current Template</title>

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
                                    <h4>Current Template</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tableExport" class="table table-striped table-hover" style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>Sl.</th>
                                                    <th>Image</th>
                                                    <th>Date & Time</th>
                                                    <th>Download</th>
                                                     <?php if( $_SESSION['userRole'] == 1) { ?>
                                                     
                                                    <th>Action</th>
                                                    <?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                
<?php                                                
 $i = 1; 

$sql="SELECT * FROM `canavas_image` ORDER BY `image_id` DESC LIMIT 1";
	$result=mysqli_query($con,$sql);
	while(($row=mysqli_fetch_array($result)))
	{
	    
  // $row['canvas_details'];	    
	    
 ?>           
                                                
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                  
                                                    <td> <img src="<?php echo $row['image_name']; ?>" style="width: 80px"></td>
                                                     <td><?php echo $row['created_on']; ?></td>
                                                     <td><a href="<?php echo $row['image_name']; ?>" class="btn-sm btn-success" download>Download</a></td>
                                                     
                                                   <?php if($_SESSION['userRole'] == 1) { ?>   
                                                  
                                                    <td>
                                                        <a href="edit_image.php?nid=<?php echo $row['image_id']; ?>" class="btn-sm btn-secondary buttons-excel"><span><i class="fa fa-edit"></i></span></a> 
                                                    
                                                     <a name="delete_btn" data-id3="<?php echo $row['image_id'];?>" data-table="canavas_image" class="btn-sm btn-secondary buttons-pdf btn_delete"><span><i class="fa fa-trash"></i></span></a>
                                                    
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
                     url:"ng-data/del_table_data.php",  
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