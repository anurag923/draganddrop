 
<?php 
include 'config.php';
include 'include/session.php'; 
  
    $hash = bin2hex(random_bytes(16));

 $id = $_GET['nid'];
 

 //    $res_users=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM tbl_users_cards WHERE user_id='".$_SESSION['userData']."' AND id='$id' order by id desc limit 1"));
     

    
  $sql = "select * from canavas_image order by image_id desc limit 1";
$result=mysqli_query($con,$sql);
	while(($row=mysqli_fetch_array($result)))
	{
	    $image_name = $row['image_name'];
	    $canvas_details = $row['canvas_details'];
	  //  $template_id = $row['image_id'];
	    
	    
	     $getbase64 = (explode('"src"',$canvas_details)[1]);
         $getbase641 = (explode('"crossOrigin"',$getbase64)[0]);
         $getbase642 = substr($getbase641,2);
         $getbase643 = (explode('"',$getbase642)[0]);
        // echo $getbase643;
        
          if ( strstr( $canvas_details, '#name' ) ) {
                // echo "Text found";
                $replace_name = "Name: ";
            } else {
                  $hide_name = 'd-none';
                }
                
            if ( strstr( $canvas_details, '#phone' ) ) {
                // echo "Text found";
                $replace_phone = "Phone: ";
            } else {
                  $hide_phone = 'd-none';
                }
                
            if ( strstr( $canvas_details, '#email' ) ) {
                // echo "Text found";
                $replace_email = "Email: ";
            } else {
                  $hide_email = 'd-none';
                }
                
            if ( strstr( $canvas_details, '#address' ) ) {
                // echo "Text found";
                $replace_address = "Address: ";
            } else {
                  $hide_address = 'd-none';
                }
         
         $str_concat = '';
	    
	   
	  
	}  
    

if(isset($_POST['submit_info']) ) {
  
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $adress = $_POST['address'];
    $user_logo = $hash."-".$_FILES['user_logo']['name'];
    $file_loc = $_FILES['user_logo']['tmp_name'];
    $folder="upload/canvas/";
    move_uploaded_file($file_loc,$folder.$user_logo);

    $path = 'upload/canvas/'.$user_logo; 
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $datas = file_get_contents($path);
    $base641 = 'data:image/' . $type . ';base64,' . base64_encode($datas);
    
    // echo $base641;
    
  //  $str_concat = str_replace(["#name","#phone","#email","#address",$getbase643],[$name,$phone,$email,$adress,$base641], $canvas_details);
  
  $str_concat = str_replace(["#name","#phone","#email","#address"],[$name,$phone,$email,$adress], $canvas_details);

$sql="INSERT INTO tbl_users_cards (name,email,phone,address,created_on,user_id,user_logo,canvas_details) 
VALUES ('$name','$email','$phone','$address','".date("d-m-Y")."','".$_SESSION['userData']."','".$user_logo."','".$str_concat."')";


if ($con->query($sql) === TRUE) {
    
    $img_insert_id =mysqli_insert_id($con);  
    
$response1 = array(
            "type" => "success",
            "message" => "Your Details Submit Successfully, Please Procced to the Template"
        );

// header("location: userDashboard.php?id=$img_insert_id&message=success");


}
else
{
 $response = array(
            "type" => "error",
            "message" => "Something went wrong"
        );
}   
    
    
} 





// if(isset($_POST['procced_template'])) {
    
//     $sql2=mysqli_query($con,"UPDATE tbl_users_cards set generated_pic='".$file."', canvas_details='$canvas_details' where id='32'");

// }


?>


 

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Image List</title>

 <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">


  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
 	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.2.0/fabric.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js"></script> 
  	<style type="text/css">
		 #c, #canvas {
     border: 2px solid #233c46;
    
 }
 .main-content {
     padding-top: 84px;
 }
 /*#canvas {*/
 /*  margin-top: 1em;*/
 /*}*/
 
 .box {  
     margin-top: 10px;
 }
 
 /*.after-box {*/
 /*    clear: left;*/
 /*}*/
 .box-left {
     float: right;
 }
 .main-content {
         padding-left: 256px;
 }
	</style>

</head>

<body>

  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
     <?php include 'include/nav.php'; ?>
    <?php include 'include/sidebar.php'; ?>
      <!-- Main Content -->
      <div class="main-content">
     
        
      <?php
        if (! empty($response1)) {
            ?>
          <div id="alert_placeholder">
    <div style="word-wrap: break-word;" class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><?php echo $response1["message"]; ?></div>
</div>  
            
    <?php } ?>      
        
        
        
           <div class="clearfix"></div>
           <section class="section">
                <div class="section-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                   <div id="alert_placeholder">
    <div style="word-wrap: break-word;" class="alert alert-warning" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> </button>Submit Bellow Details to get the Template</div>
</div>  
                                </div>
                                <div class="card-body">
                                                                
                              <div class="box" style="display: none">
    <canvas id="c" ></canvas>
    <textarea id='myTextArea' name="canvas_details"></textarea>
    <button onclick="canvas2json()" class="btn-xs btn-primary">Add Texto</button>
    <button onclick="loadJson2Canvas()" id ="loadJson2Canvas" class="btn-xs btn-primary d-none">Add Text</button>
</div>  
                                    
                                     <form action="" method="post" class="needs-validation" enctype="multipart/form-data">
          
                      
      
                          <div class="card-body">
                               
                              <div class="row">
                                 
                                 <div class="col-md-7">
                                  
                                  <?php if(empty($hide_name)) { ?>
                                  <div class="form-group col-sm-8">
                                      <label>Company Name</label>
                                      <input type="text" class="form-control" name="name" id="name" placeholder="Company Name" required>

                                  </div>
                                  <?php } ?>
                                   <?php if(empty($hide_email)) { ?>
                                  <div class="form-group col-sm-8">
                                      <label>Email</label>
                                      <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>

                                  </div>
                                  <?php } ?>
                                   <?php if(empty($hide_phone)) { ?>
                                    <div class="form-group col-md-8 col-12">
                                      <label>Phone</label>
                                      <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" required>

                                  </div>
                                    <?php } ?>
                                     <?php if(empty($hide_address)) { ?>
                                   <div class="form-group col-md-8 col-12">
                                      <label>Address</label>
                                      <input type="text" class="form-control" name="address" id="address" placeholder="Address" required>

                                  </div>
                                   <?php } ?>
                                   <?php if(!empty($getbase643)) { ?>
                                 <!-- <div class="form-group col-md-6 col-12">-->
                                 <!--     <label>Logo</label>-->
                                 <!--     <input type="file" class="form-control" name="user_logo" placeholder="Address" accept=".jpg,.png,.jpeg,.JPG,.JPEG" required>-->
                                 <!--<span style="color: red">Please Upload Logo below 300 X 300 Px Resolution</span>-->
                                 <!-- </div>-->
                                    <?php } ?>
                                  <div class="form-group col-md-12 col-12">
                                     <div class="card-footer text-left">
                                       <?php if(empty($response1)){ ?>       
                               <button type="submit" class="btn btn-primary" name="submit_info">Submit Details</button>
                             <?php } ?>
                          </div>
                                  </div>
                                  </div>
                                  
                                  <div class="col-md-5">
                                      <h4>Template </h4>
                                      <img src="<?php echo $image_name; ?>" style="width: 100%">
                                  </div>
                                  
                              </div>

                            
                              
                            
                              
                          </div>
                         
                      </form>
                      
                        <?php if(!empty($response1)){ ?>                  
          <button  onclick="uploadEx()" class="alert alert-success">Procced to Template</button>
          <?php } ?>
                      
                                
                            <form method="post" accept-charset="utf-8" name="form1">
      <input name="hidden_data" id='hidden_data' type="hidden" value="<?php echo $image_name; ?>"/>
      <input name="id" id="id" type="hidden" value="<?=$img_insert_id?>">
     
      <textarea id='canvas_details' name="canvas_details" style="display:none"><?php echo $str_concat; ?></textarea>
      
        
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
  
  
   <script type="text/javascript">
 
 $(document).ready(function(){
    // alert(123);
    $("#loadJson2Canvas").click(); 
});
	fabric.Object.prototype.transparentCorners = false;
fabric.Object.prototype.padding = 5;

var $ = function(id) {
  return document.getElementById(id)
};
var canvas = new fabric.Canvas('c');
// var canvas = this.__canvas = new fabric.Canvas('c');
canvas.setHeight(500);
canvas.setWidth(1001);



// selected object always infront
canvas.on("object:selected", function(options) {
  options.target.bringToFront();
});

// add text function
function Addtext() {
  canvas.add(new fabric.IText('Tap and Type', {
      left: 50,
      top: 100,
      fontFamily: 'arial black',
      fill: '#333',
      fontSize: 50
  }));
}

function canvas2json() {
    
    var json = canvas.toJSON();
                $("#canvas_details").text(JSON.stringify(json));
}
function loadJson2Canvas() {
    
   canvas.loadFromJSON(
                $("#canvas_details").val(),
                canvas.renderAll.bind(canvas));
}

// JavaScript template engine 
// http://krasimirtsonev.com/blog/article/Javascript-template-engine-in-just-20-line
var TemplateEngine = function(html, options) {
  var re = /<%([^%>]+)?%>/g, 
      reExp = /(^( )?(if|for|else|switch|case|break|{|}))(.*)?/g, 
      code = 'var r=[];\n', 
      cursor = 0, 
      match;
  var add = function(line, js) {
    js? (code += line.match(reExp) ? line + '\n' : 'r.push(' + line + ');\n') :
        (code += line != '' ? 'r.push("' + line.replace(/"/g, '\\"') + '");\n' : '');
    return add;
  }
  while(match = re.exec(html)) {
    add(html.slice(cursor, match.index))(match[1], true);
    cursor = match.index + match[0].length;
  }
  add(html.substr(cursor, html.length - cursor));
  code += 'return r.join("");';
  return new Function(code.replace(/[\r\t\n]/g, '')).apply(options);
}

// Check if a string is a valid url
function ValidURL(s) {
  var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
  return regexp.test(s);
}

// text editor functions 
document.getElementById('text-color').onchange = function() {
  
canvas.getActiveObject().set("fill", this.value);
    canvas.renderAll();
};
document.getElementById('text-color').onchange = function() {
  
canvas.getActiveObject().set("fill", this.value);
    canvas.renderAll();
};
document.getElementById('text-bg-color').onchange = function() {
  //canvas.getActiveObject().setBackgroundColor(this.value);
  canvas.getActiveObject().set("backgroundColor", this.value);
  
  canvas.renderAll();
};
// document.getElementById('text-lines-bg-color').onchange = function() {
//   // canvas.getActiveObject().setTextBackgroundColor(this.value);
//   // canvas.renderAll();
  
//   canvas.getActiveObject().set("TextBackgroundColor", this.value);
//   canvas.renderAll();

// };
// document.getElementById('text-stroke-color').onchange = function() {
//   // canvas.getActiveObject().setStroke(this.value);

//   // canvas.renderAll();
//   canvas.getActiveObject().set("Stroke", this.value);
//   canvas.renderAll();


// };
// document.getElementById('text-stroke-width').onchange = function() {
//   //canvas.getActiveObject().setStrokeWidth(this.value);
//   canvas.getActiveObject().set("StrokeWidth", this.value);
//   canvas.renderAll();
// };
document.getElementById('font-family').onchange = function() {
  // canvas.getActiveObject().setFontFamily(this.value);
  // canvas.renderAll();

  canvas.getActiveObject().set("fontFamily", this.value);
  canvas.renderAll();


};
document.getElementById('text-font-size').onchange = function() {
 // canvas.getActiveObject().setFontSize(this.value);
  canvas.getActiveObject().set("fontSize", this.value);
  
  canvas.renderAll();
};
// document.getElementById('text-line-height').onchange = function() {
//   canvas.getActiveObject().setLineHeight(this.value);
//   canvas.renderAll();
// };
// document.getElementById('text-align').onchange = function() {
//   canvas.getActiveObject().setTextAlign(this.value);
//   canvas.renderAll();
// };

// change font decoration
radios5 = document.getElementsByName("fonttype");
for (var i = 0, max = radios5.length; i < max; i++) {
  radios5[i].onclick = function() {
    if (document.getElementById(this.id).checked == true) {
      if (this.id == "text-cmd-bold") {
          canvas.getActiveObject().set("fontWeight", "bold");
      }
      if (this.id == "text-cmd-italic") {
          canvas.getActiveObject().set("fontStyle", "italic");
      }
      if (this.id == "text-cmd-underline") {
          canvas.getActiveObject().set("textDecoration", "underline");
      }
      if (this.id == "text-cmd-linethrough") {
          canvas.getActiveObject().set("textDecoration", "line-through");
      }
      if (this.id == "text-cmd-overline") {
          canvas.getActiveObject().set("textDecoration", "overline");
      }
    } else {
      if (this.id == "text-cmd-bold") {
          canvas.getActiveObject().set("fontWeight", "");
      }
      if (this.id == "text-cmd-italic") {
          canvas.getActiveObject().set("fontStyle", "");
      }
      if (this.id == "text-cmd-underline") {
          canvas.getActiveObject().set("textDecoration", "");
      }
      if (this.id == "text-cmd-linethrough") {
          canvas.getActiveObject().set("textDecoration", "");
      }
      if (this.id == "text-cmd-overline") {
          canvas.getActiveObject().set("textDecoration", "");
      }
    }
    canvas.renderAll();
  }
}

// upload image file
document.getElementById('file').addEventListener("change", function(e) {
  var file = e.target.files[0];
  var reader = new FileReader();
  reader.onload = function(f) {
    var data = f.target.result;
    fabric.Image.fromURL(data, function(img) {
      var oImg = img.set({
        left: 0,
        top: 0,
        angle: 00,
        width: 1920,
        height: 1080
      }).scale(0.9);
      canvas.add(oImg).renderAll();
      var a = canvas.setActiveObject(oImg);
      var dataURL = canvas.toDataURL({
        format: 'png',
        quality: 0.8
      });
    });
  };
  reader.readAsDataURL(file);
});

// upload background image
document.getElementById('background').addEventListener("change", function(e) {
  var file = e.target.files[0];
  var reader = new FileReader();
  reader.onload = function(f) {
    var data = f.target.result;
    fabric.Image.fromURL(data, function(img) {
      var bgImg = canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas), {
        backgroundImageOpacity: 0.5,
        backgroundImageStretch: false
      });
    });
  };
  reader.readAsDataURL(file);
});

// stretch background image
fabric.util.addListener(document.getElementById('toggle-stretch'), 'click', function() {
  if (!canvas.backgroundImage) return;
  canvas.backgroundImage.width = canvas.getWidth();
  canvas.backgroundImage.height = canvas.getHeight();
  canvas.renderAll();
});

// change background opacity
document.getElementById('background-opacity').onchange = function() {
  //canvas.backgroundImage.opacity = this.value;
  canvas.getActiveObject().set("opacity", this.value);
  //canvas.renderAll();
  canvas.renderAll();
};


// var deleteSelectedObject = document.getElementById('delete-item');
// deleteSelectedObject.onclick = function()
// {
// if(canvas.getActiveGroup()){
//       canvas.getActiveGroup().forEachObject(function(o){ canvas.remove(o) });
//       canvas.discardActiveGroup().renderAll();
//     } else {
//       canvas.remove(canvas.getActiveObject());
//     }
// };

//delete object
window.deleteObject = function() {
  // canvas.getActiveObject().remove();

  canvas.remove(canvas.getActiveObject());
}


// clear canvas
//delete object
window.clearfullcanvas = function() {
canvas.clear();
}

// window.deleteObject = function() {
//         canvas.getActiveObject().remove();
// }

// function deleteObject(){
// 	var activeObject = canvas.getActiveObject(),
//     activeGroup = canvas.getActiveGroup();
//     if (activeObject) {
//         if (confirm('Are you sure?')) {
//             canvas.remove(activeObject);
//         }
//     }
//     else if (activeGroup) {
//         if (confirm('Are you sure?')) {
//             var objectsInGroup = activeGroup.getObjects();
//             canvas.discardActiveGroup();
//             objectsInGroup.forEach(function(object) {
//             canvas.remove(object);
//             });
//         }
//     }
// }




// delete background
window.deleteBackground = function() {
  canvas.backgroundImage = 0;
  canvas.renderAll();
}

// download pdf
download.addEventListener("click", function() {
  // only jpeg is supported by jsPDF
  var imgData = canvas.toDataURL("image/jpeg", 1.0);
  var pdf = new jsPDF();
  pdf.addImage(imgData, 'JPEG', 0, 0);
  var download = document.getElementById('download');
  pdf.save("download.pdf");
}, false);

// download image
downloadImg.addEventListener("click", function() {
  canvas.getElement().toBlob(function(blob) {
      saveAs(blob, "canvas.png");
  });
});







// insert text
var text = '';
canvas.add(new fabric.IText(text, {
  fill: 'black',
  fontSize: 17,
  left: 30,
  top: 10
}));
var logo = '';
canvas.add(new fabric.IText(logo, {
  fill: 'black',
  fontSize: 17,
  left: 50,
  top: 60
}));

// canvas to show json data
var canvas_ = new fabric.Canvas('canvas');
canvas_.setHeight(300);
canvas_.setWidth(500);

// document.getElementById('btn_export_import_json').onclick = function() {
//   var json_data = canvas.toDatalessJSON();
//   var jsfiddleLogoUrl;
//   console.log(JSON.stringify(json_data));
  
//   // change object data, use TemplateEngine
//   json_data.objects.forEach(function(obj) {
//     if(obj.type === "i-text"){
//       jsfiddleLogoUrl = TemplateEngine(obj.text, {
//         jsfiddleLogo: "http://doc.jsfiddle.net/_downloads/jsfiddle-logo-white.png",
//       });

//       // image
//       // insert image if the string is a valid url
//       if(ValidURL(jsfiddleLogoUrl)) {
//         fabric.Image.fromURL(jsfiddleLogoUrl, function(img) {
//             canvas_.add(img.set({
//                 width: 200,
//                 height: 200,
//                 left: obj.left,
//                 top: obj.top
//             }));
//         });
//       }

//       obj.text = TemplateEngine(obj.text, {
//         name: "John Doe",
//         age: 29,
//       });
//     }
//    });

//   canvas_.loadFromJSON(json_data, function(obj) {
//     canvas_.renderAll();
//     console.log(' this is a callback. invoked when canvas is loaded!xxx ');
//     canvas_.forEachObject(function(obj) {
//       if (obj.name === 'recta') {
//         obj.set({
//           left: 100,
//           top: 200,
//           height: 700,
//           width: 700,
//           scaleX: .35,
//           scaleY: .35,
//           lockScalingY: .35
//         });
//         canvas_.add(obj);
//       }
//     });
//   });
// };
</script>

<script type="text/javascript">
// $(document).ready(function(){
//     alert(123);
//     $("#loadJson2Canvas").click(); 
// });
</script>

<script>
      function uploadEx() {
          
        //   alert(123);
          canvas2json();
          
        //   alert(1234);
        var canvas = document.getElementById("c");
        // var dataURL = canvas.toDataURL("image/png");
        
        var dataURL = canvas.toDataURL({
                    format: "png",
                    left: 0,
                    top: 0,
                    width: canvas.width ,
                    height: canvas.height ,
                });
                
        document.getElementById('hidden_data').value = dataURL;
        
        var fd = new FormData(document.forms["form1"]);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'edit_user_script.php', true);

        xhr.upload.onprogress = function(e) {
          if (e.lengthComputable) {
            var percentComplete = (e.loaded / e.total) * 100;
            console.log(percentComplete + '% uploaded');
           alert('Succesfully uploaded');
            window.location.href = "userDashboard.php";
          }
        };

        xhr.onload = function() {

        };
        xhr.send(fd);
      };
    </script> 
  
  

  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
 
  <!-- Page Specific JS File -->
  <script src="assets/js/page/index.js"></script>
 
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
  
 
</body>
</html>