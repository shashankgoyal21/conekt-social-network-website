<?php

include('config.php');
include('home.php');
$id1=$mysqli->query('SELECT user_id from users Where email="'.$email.'"');
$id1 = $id1->fetch_array(MYSQLI_NUM);

?>

<html>
<head>  
<link href="style.css" rel="stylesheet" title="Style" />
</head>
   <body>
<?php
   if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
	  echo $file_ext;
	  $file_name= $id1[0] . "." .$file_ext;
      $expensions= array("jpg","jpeg","png","bmp");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
		}
      
      if(empty($errors)==true){
		  echo $file_ext;
		  echo $file_name;
         move_uploaded_file($file_tmp,"uploads/".$file_name);
         echo "Success";
      }
      else{
         print_r($errors);
      }
   }
?>
      
	  <div class="center">
      <form action="" method="POST" enctype="multipart/form-data">
         <input type="file" name="image" />
         <input type="submit" /></div>
			<!--
         <ul>
            <li>Sent file: <?php echo $file_name;  ?>
            <li>File size: <?php echo $file_size;  ?>
            <li>File type: <?php echo $file_type; ?>
         </ul>-->
			
      </form>
      
   </body>
</html>