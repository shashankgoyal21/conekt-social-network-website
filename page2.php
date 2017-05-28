<?php
include('create_page.php');
ob_get_contents();
ob_clean();
include('login.php');
ob_clean();
if(isset($_GET['id'])){
$pid = $_GET['id'];

$userID = $mysqli->query('SELECT user_id from users where email="'.$email.'" ');
$userID = $userID->fetch_array(MYSQLI_NUM);

$pageName = $mysqli->query('SELECT * from pages where p_id="'.$pid.'"');
$pn = $pageName->fetch_assoc();
$chk = $mysqli->query('SELECT user_id from create_pages WHERE user_id="'.$userID[0].'" and p_id="'.$pid.'"');
$chk = $chk->fetch_array(MYSQLI_NUM);
?>
<html>
<head>
<link href="style.css" rel="stylesheet" title="STYLE" />
</head>
<body bgcolor=LIGHTBLUE >
</body>
<div class="header1">
<div class="box_left" >
<a style="color:blue;z-index:400;font-size:100;font-style:italic"><?php echo $pn['p_name'];?></a>
</div>
<div class="box_right">
<div style="width:100px; margin:3 auto;" >	
</div>
<ul>
  <font size="6" color="GREEN">
  <li><a href="like.php?id=<?php echo $pid;?>" style="color:Lightblue">
  <?php 
  if($userID[0]==$chk[0])
  {?>
<img src="images/like.jpg" alt="" height="40" width="40">
<?php
}
else
{ 
?>
<img src="images/dislike.png" height="40" width="40">
<?php
}
?>
  </a><?php echo " (".$pn['likes'].")";?></li>
  <li><a href="" style="color:Lightblue">Share</a></li>
  <li><a href="ab.html" style="color:Lightblue">About</a></li>
	</font>
  
</ul>
</html>
<?php
}
else{
	echo "bye bye";
}
	
?>