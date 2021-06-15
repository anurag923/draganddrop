<?php include 'config.php'; ?>
<?php include 'include/session.php';
$id = $_GET['nid'];
$sql = "select * from canavas_image where image_id='$id'";
$result=mysqli_query($con,$sql);
	while(($row=mysqli_fetch_array($result)))
	{
	    $image_name = $row['image_name'];
	    $canvas_details = $row['canvas_details'];
	   
	}
?>

<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Dashboard</title>
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
        <section class="section">
        <div class="col-md-12">
          <div class="row">
       
    <button onclick="AddtextName()" class="btn-xs btn-primary">Add Name</button>
<button onclick="AddtextEmail()" class="btn-xs btn-primary">Add Email</button>
<button onclick="AddtextPhone()" class="btn-xs btn-primary">Add Phone</button>
<button onclick="AddtextAddress()" class="btn-xs btn-primary">Add Address</button>
<button onclick="deleteObject()" class="btn-xs btn-danger">Delete</button>
<button onclick="clearfullcanvas()" class="btn-xs btn-primary">Clear Full Canavas</button>
<button id="download" class="btn-xs btn-success">Download as pdf</button>
<button id="downloadImg" type="button" class="btn-xs btn-primary">Save as Image</button>
<!--<button onclick="loadJson2Canvas()" class="btn-xs btn-info">Use Border</button>-->
<button onclick="Useborder()" class="btn-xs btn-info">Use Border </button>
<button  onclick="uploadEx()" class="btn-xs btn-success">Upload as Image</button>
<div class="col-sm-6">
 Upload image <input id="file" type="file" class="form-control" > 
 </div>
 <div class="col-sm-4">
Upload background <input id="background" type="file" class="form-control" >
 </div>

<div class="col-md-9">

<div class="box">
    <canvas id="c"></canvas>
    <!--<textarea id='myTextArea' name="canvas_details"></textarea>-->
    <!--<button onclick="canvas2json()" class="btn-xs btn-primary">Add Texto</button>-->
    <button onclick="loadJson2Canvas()" id ="loadJson2Canvas" class="btn-xs btn-primary d-none">Add Texto</button>
</div>

 </div>
            
 <div class="col-md-3">  
<div class="box-left"> 
 <form method="post" accept-charset="utf-8" name="form1">
      <input name="hidden_data" id='hidden_data' type="hidden" value="<?php echo $image_name; ?>"/>
      <input name="id" id="id" type="hidden" value="<?echo $_GET['nid']; ?>">
      <!--<input name="canvas_details" id='canvas_details' type="text"/>-->
      <textarea id='canvas_details' name="canvas_details" style="display:none"><?php echo $canvas_details; ?></textarea>
    </form>

<div id="text-wrapper" ng-show="getText()" style="margin-top: 10px">
  
     
      <label for="font-family" style="display:inline-block">
          Font family:
      </label>
      <select id="font-family" class="form-control">
          <option value="arial">Arial</option>
          <option selected="" value="helvetica">Helvetica</option>
          <option value="myriad pro">Myriad Pro</option>
          <option value="delicious">Delicious</option>
          <option value="verdana">Verdana</option>
          <option value="georgia">Georgia</option>
          <option value="courier">Courier</option>
          <option value="comic sans ms">Comic Sans MS</option>
          <option value="impact">Impact</option>
          <option value="monaco">Monaco</option>
          <option value="optima">Optima</option>
          
      </select>
      <br/>
      <!-- <label for="text-align" style="display:inline-block">
          Text align:
      </label>
      <select id="text-align">
          <option value="left">Left</option>
          <option value="center">Center</option>
          <option value="right">Right</option>
          <option value="justify">Justify</option>
      </select> -->
      <div>
          <label for="text-color">Text color:</label>
           <input id="text-color" size="10" type="color" value=""/>
      </div>
      <div>
          <label for="text-bg-color">Text background color:</label>
          <input id="text-bg-color" size="10" type="color" value="" />
      </div>
      
      <!-- <div>
          <label for="text-stroke-color">Stroke color:</label>
          <input id="text-stroke-color" type="color" value=""/>
      </div> -->
      <!-- <div>
          <label for="text-stroke-width">Stroke width:</label>
          <input id="text-stroke-width" max="5" min="1" type="range" value="1" />
      </div> -->
      <div>
          <label for="text-font-size">Font size:</label>
           <select id="text-font-size">
            <?php   for ($x = 1; $x <= 40; $x++) {   ?>
          <option value="<?=$x?>"><?=$x?></option>
          <?php } ?> 
      </select> 
          <!--<input id="text-font-size" max="120" min="1" step="1" type="range" value="" />-->
      </div>
       <div>
           <label for="background-opacity">Opacity:</label>
    <input id="background-opacity" max="1" min="0" step="0.1" type="range" value="1" />
      </div>
  </div>
  <div id="text-controls-additional">
      <input id="text-cmd-bold" name="fonttype" type="checkbox" />
      Bold
      <input id="text-cmd-italic" name="fonttype" type="checkbox" />
      Italic
      <!-- <input id="text-cmd-underline" name="fonttype" type="checkbox" />
      Underline
      <input id="text-cmd-linethrough" name="fonttype" type="checkbox" />
      Linethrough
      <input id="text-cmd-overline" name="fonttype" type="checkbox" />
      Overline -->
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

// Canvas Boundary Limit

canvas.on("object:moving", function(e){
    var obj = e.target;
    obj.setCoords();

    var bound = obj.getBoundingRect(true);
    var width = obj.canvas.width;
    var height = obj.canvas.height;

    obj.left = Math.min(Math.max(3, bound.left), width - bound.width);
    obj.top = Math.min(Math.max(3, bound.top), height - bound.height);
})

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


function AddtextName() {
var movingtext =  canvas.add(new fabric.IText('Name: #name', {
      left: 50,
      top: 100,
      fontFamily: 'arial black',
      fill: '#333',
      fontSize: 20
      
  }));
}
function AddtextEmail() {
  canvas.add(new fabric.IText('Email: #email', {
      left: 50,
      top: 100,
      fontFamily: 'arial black',
      fill: '#333',
      fontSize: 20
  }));
}

function AddtextPhone() {
  canvas.add(new fabric.IText('Phone: #phone', {
      left: 50,
      top: 100,
      fontFamily: 'arial black',
      fill: '#333',
      fontSize: 20
  }));
}

function AddtextAddress() {
  canvas.add(new fabric.IText('Address: #address', {
      left: 50,
      top: 100,
      fontFamily: 'arial black',
      fill: '#333',
      fontSize: 20
  }));
}

// add text function
function Useborder() {

var rect = new fabric.Rect({
    top: 7,
    left: 7,
    width: 985,
    height: 485,
    fill: 'transparent',
    stroke: 'black',
    strokeWidth: 0.3
    
});

canvas.add(rect);
canvas.renderAll();

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
        xhr.open('POST', 'edit_script.php', true);

        xhr.upload.onprogress = function(e) {
          if (e.lengthComputable) {
            var percentComplete = (e.loaded / e.total) * 100;
            console.log(percentComplete + '% uploaded');
           alert('Succesfully uploaded');
            window.location.href = "template_list.php";
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