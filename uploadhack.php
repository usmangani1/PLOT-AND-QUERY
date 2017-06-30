<?php
$folder="/Applications/XAMPP/xamppfiles/htdocs/hackathonnew/";
$target_file = $folder . basename($_FILES['file']['name']);
$upload = 1;

if(isset($_POST['btn-upload']))
{    
 $file = $_FILES['file']['name'];
 $file_loc = $_FILES['file']['tmp_name'];
 $file_size = $_FILES['file']['size']/1024;
 $file_type = pathinfo($target_file,PATHINFO_EXTENSION);

 if($file_type != "json" && $file_type != "Json" && $file_type != "JSON") {
    echo "<center>";
    echo "Sorry, only JSON files are allowed.";
   
    $upload = 0;
          }


$name= "location";
  move_uploaded_file($_FILES["file"]["tmp_name"], "/Applications/XAMPP/xamppfiles/htdocs/hackathon/" . $name.".".$file_type);
}
?>
<html>

    <body>
        <center>
    <link rel="stylesheet" type="text/css" href="hisstyle.php">
    <form method="post" action="googlemapphpwithoutcalender.php">
    <body>  
            <h1>PLOT AND QUERY</h1>
            <div class="login-box animated fadeInUp">
            <div class="box-header">
                
            <h2> File sucessfully uploaded </h2>
            </div>
            
            <br>
            <input type="submit" name="moveFile" value="PLOT DATA FROM FILE">
            <br>
            </form>
            <br/>

    <br/>
            
</body>

</form>
</center>

</html>

<body>