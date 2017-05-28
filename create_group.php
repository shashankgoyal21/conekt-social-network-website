<html>
<body bgcolor=LIGHTBLUE>
<div  align="middle" >
<font size="35" color="GREEN">
<head ><link href="style.css" rel="stylesheet" title="Style" /><title>CREATE NEW GROUP</title></head>
</font>
</div>
<body>
<?php
include('config.php');
$form1=true;
include('home.php');
if(isset($_POST['create']))
{
	if($_POST['gname']!='')
	{
	if(get_magic_quotes_gpc())
	{
		$_POST['type']=stripslashes($_POST['type']);
		$_POST['gname']=stripslashes($_POST['gname']);
	}
	$type = $_POST['type'];
	$gname = $_POST['gname'];
	
		if($_POST['gmember']!='')
		{
			$nmbr=$mysqli->query("SELECT count(*) from groups");
			$nmbr = $nmbr->fetch_array(MYSQLI_NUM);
			$quer = $mysqli->query('INSERT into groups(g_id,g_type,g_name) values("'.$nmbr[0].'","'.$type.'","'.$gname.'")');
			$nmbr[0] =$nmbr[0]+1;
			
			$query1 = $mysqli->prepare('INSERT INTO create_groups(g_id, user_id) VALUES (:g_id, :user_id)');
$flag=1;
$i=0;
    foreach($_POST['gmember'] as $option){
        $insert = $query1->execute(array(':g_id' => $nmbr, ':user_id' => $option));
$i++;			}
			$flag=0;
			$form1=false;
		}
	
		else{
			$form1=true;
			$message1="Select atleast one member";
		}
	}
	else{
		$form1=true;
		$message1="Enter Group Name";
	}
}
else{$form1=true;}
if($form1){
	if(isset($message1)){
	?>
	<div class="message"><?php echo $message1; ?>
	</div>
	<?php
	}
}
?>

<form action="create_group.php" method="POST">
<div align="middle">
<br> <br> 
<a style="color:red">GROUP NAME:
<input type="text" name="gname">
<br><br>
 MEMBERS:<br> <br> 
<?php
$mysqli = new mysqli("localhost", "root", "","conekt");
	$result1 = $mysqli->query("SELECT * FROM users");
	?>
<select name="gmember"	multiple value="" type="tel">
<?php

while($result2 = $result1->fetch_assoc())
{
?>
<option value="<?php echo $result2['user_id'];?>" name="<?php echo $result2['user_id'];?>"><?php echo $result2["fname"]; echo " "; echo $result2['lname'];?></option>
<?php 
} ?></select>
<br><br> PRIVACY
<br>
&nbsp <br> 
<input name="type" type="radio" value="Public">
Public<br> 
<br>&nbsp;
<input name="type" type="radio" value="Closed">Closed
<br><br>
<input name="type" type="radio" value="Secret">
Secret
<br><br><br><div class="button_color">
<input type="submit" value="Cancel" name="cancel" />
<input type="submit" value="Create" name="create" />
</div>
</a>
</div>
</form>
</body>
</html>